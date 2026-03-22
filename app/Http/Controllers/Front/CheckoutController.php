<?php

namespace App\Http\Controllers\Front;

use App\{
    Models\Cart,
    Models\Order,
    Models\PaymentGateway,
    Models\User,
};
use App\Models\City;
use App\Models\State;
use App\Models\Address;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class CheckoutController extends FrontBaseController
{
    // Loading Payment Gateways

    public function loadpayment($slug1, $slug2)
    {

        $curr = $this->curr;
        $payment = $slug1;
        $pay_id = $slug2;
        $gateway = '';
        if ($pay_id != 0) {
            $gateway = PaymentGateway::findOrFail($pay_id);
        }
        return view('load.payment', compact('payment', 'pay_id', 'gateway', 'curr'));
    }

    // Wallet Amount Checking

    public function walletcheck()
    {
        $amount = (float)$_GET['code'];
        $total = (float)$_GET['total'];
        $balance = Auth::user()->balance;
        if ($amount <= $balance) {
            if ($amount > 0 && $amount <= $total) {
                $total -= $amount;
                $data[0] = $total;
                $data[1] = $amount;
                $data[2] = \PriceHelper::showCurrencyPrice($total);
                $data[3] = \PriceHelper::showCurrencyPrice($amount);
                return response()->json($data);
            } else {
                return response()->json(0);
            }
        } else {
            return response()->json(0);
        }
    }

   

    public function checkout()
    {
        // -----------------------------------------------------------
        // 🔹 REMOVE COUPON (IF ?remove_coupon PRESENT IN URL)
        // -----------------------------------------------------------
        if (request()->has('remove_coupon')) {
            Session::forget([
                'already',
                'coupon',
                'coupon_code',
                'coupon_id',
                'coupon_total1',
                'coupon_percentage',
                'coupon_total'
            ]);
        }

        // -----------------------------------------------------------
        // 🔹 IF CART EMPTY → REDIRECT TO CART
        // -----------------------------------------------------------
        if (!Session::has('cart')) {
            return redirect()->route('front.cart')
                ->with('success', __("You don't have any product to checkout."));
        }

        // -----------------------------------------------------------
        // 🔹 BASE DATA
        // -----------------------------------------------------------
        $cart = Session::get('cart');
        
        
        $products = $cart->items;
        $totalQuantity = collect($products)->sum('qty');

        $currency = $this->curr;

        $gateways = PaymentGateway::scopeHasGateway($currency->id);

        $pickups = DB::table('pickups')->get();

        $paystack = PaymentGateway::whereKeyword('paystack')->first();
        $paystackData = $paystack ? $paystack->convertAutoData() : null;

        // -----------------------------------------------------------
        // 🔹 IF USER LOGGED IN
        // -----------------------------------------------------------
        if (Auth::check()) {

            $total = $cart->totalPrice;

            // -----------------------------------------------------------
            // 🔹 APPLY COUPON IF EXISTS
            // -----------------------------------------------------------
            // if (Session::has('coupon_total')) {
                
            //     $total = (float) preg_replace('/[^0-9.]/', '', Session::get('coupon_total'));
               
            // } else {
                
            //     $total -= Session::get('coupon', 0);
               
                
            // }
          
            // -----------------------------------------------------------
            // 🔹 REFERRAL DISCOUNT (APPLIED ONLY ON FIRST ORDER)
            // -----------------------------------------------------------
            $referralDiscount = 0;
            $user = Auth::user();
           
            $orderCount = Order::where('user_id', $user->id)->count();

            if ($orderCount == 0 && $user->reffered_by) {
                $referralDiscount = $total * ($this->gs->referral_bonus / 100);
               
                $total -= $referralDiscount;
            }

            // -----------------------------------------------------------
            // 🔹 ORDER TOTALS (single source of truth — avoids @php in view)
            // -----------------------------------------------------------
            $subtotalMRP  = $cart->totalPrice;           // pre-discount cart total
            $discountMRP  = 0;
            $shippingCost = $subtotalMRP >= ($this->gs->free_shipping_amount ?? 500)
                ? 0
                : ($this->gs->shipping_cost ?? 50);
            $taxRate      = 0.18;
            $taxAmount    = $subtotalMRP * $taxRate;
            $finalTotal   = $total + $shippingCost + $taxAmount;  // $total already has referral deducted
            $points       = (int) round($user->current_balance ?? 0);

            // -----------------------------------------------------------
            // 🔹 GATEWAY FILTER (COD + Razorpay only)
            // -----------------------------------------------------------
            $codGateway      = $gateways->first(fn($g) => $g->checkout == 1 && strtolower($g->keyword) === 'cod');
            $razorpayGateway = $gateways->first(fn($g) => $g->checkout == 1 && str_contains(strtolower($g->keyword), 'razorpay'));

            // -----------------------------------------------------------
            // 🔹 LOAD USER ADDRESSES (Delivery & Billing separately)
            // -----------------------------------------------------------
            $deliveryAddresses = Address::where('user_id', $user->id)
                ->where(function($query) {
                    $query->where('address_category', 'delivery')
                          ->orWhereNull('address_category');
                })
                ->get();
               

            $billingAddresses = Address::where('user_id', $user->id)
                ->where('address_category', 'billing')
                ->get();
             
            // For backward compatibility, also pass combined addresses
            $addresses = $deliveryAddresses;
            $defaultAddress = $deliveryAddresses->firstWhere('is_default', true);
            $defaultBillingAddress = $billingAddresses->firstWhere('is_default', false);

            // -----------------------------------------------------------
            // 🔹 RETURN VIEW
            // -----------------------------------------------------------

          
            return view('frontend.checkout', [
                'products'              => $products,
                'refferal_discount'     => $referralDiscount,
                'totalPrice'            => $total,
                'subtotalMRP'           => $subtotalMRP,
                'discountMRP'           => $discountMRP,
                'shippingCost'          => $shippingCost,
                'taxAmount'             => $taxAmount,
                'finalTotal'            => $finalTotal,
                'points'                => $points,
                'orderCount'            => $orderCount,
                'codGateway'            => $codGateway,
                'razorpayGateway'       => $razorpayGateway,
                'pickups'               => $pickups,
                'totalQty'              => $totalQuantity,
                'gateways'              => $gateways,
                'digital'               => 1,
                'curr'                  => $currency,
                'vendor_shipping_id'    => 0,
                'vendor_packing_id'     => 0,
                'paystack'              => $paystackData,
                'addresses'             => $addresses,
                'deliveryAddresses'     => $deliveryAddresses,
                'billingAddresses'      => $billingAddresses,
                'defaultAddress'        => $defaultAddress,
                'defaultBillingAddress' => $defaultBillingAddress,
                'user'                  => $user,
            ]);
        }

        // -----------------------------------------------------------
        // 🔹 NOT LOGGED IN → REDIRECT TO LOGIN
        // -----------------------------------------------------------
        session(['url.intended' => route('front.checkout')]);

        return redirect()->route('sign-in')
            ->with('error', 'Please login to proceed to checkout.');
    }

    public function getState($country_id)
    {

        $states = State::where('country_id', $country_id)->get();

        if (Auth::user()) {
            $user_state = Auth::user()->state;
        } else {
            $user_state = 0;
        }


        $html_states = '<option value="" > Select State </option>';
        foreach ($states as $state) {
            if ($state->id == $user_state) {
                $check = 'selected';
            } else {

                $check = '';
            }
            $html_states .= '<option value="' . $state->id . '"   rel="' . $state->country->id . '" ' . $check . ' >' . $state->state . '</option>';
        }

        return response()->json(["data" => $html_states, "state" => $user_state]);
    }

    public function getCity(Request $request)
    {

        $cities = City::where('state_id', $request->state_id)->get();

        if (Auth::user()) {
            $user_city = Auth::user()->city;
        } else {
            $user_city = 0;
        }

        $html_cities = '<option value="" > Select City </option>';
        foreach ($cities as $city) {
            if ($city->id == $user_city) {
                $check = 'selected';
            } else {
                $check = '';
            }
            $html_cities .= '<option value="' . $city->city_name . '"   ' . $check . ' >' . $city->city_name . '</option>';
        }

        return response()->json(["data" => $html_cities, "state" => $user_city]);
    }


    // Redirect To Checkout Page If Payment is Cancelled

    public function paycancle()
    {

        return redirect()->route('front.checkout')->with('unsuccess', __('Payment Cancelled.'));
    }


    // Redirect To Success Page If Payment is Comleted

    public function payreturn()
    {
         $billingAddress=Address::where('user_id', Auth::user()->id)->where('address_category', 'delivery')->get();
        

        if (Session::has('tempcart')) {
            $oldCart = Session::get('tempcart');          
            // $tempcart = new Cart($oldCart);
            $tempcart = $oldCart;
             
            $order = Session::get('temporder');
        } else {
            $tempcart = '';
            return redirect()->back();
        }
        
        $cart = json_decode($order->cart ,true);
        $paymentInfo=$order;

        return view('frontend.payment-status', compact('tempcart', 'order' ,'billingAddress', 'paymentInfo'));
    }

    // Payment Status Page (Success/Failed/Pending)
    public function paymentStatus(Request $request)
    {
       
        // Get the payment status from query parameter (success, failed, pending)
        $status = $request->get('status', 'success');

        // Get order data from session or request
        // In production, you'll fetch this from the database based on order ID
        $order = Session::get('temporder');
        $cart = Session::get('tempcart');

        // Settings for support contact
        $settings = [
            'support_email' => $this->gs->contact_email ?? config('mail.from.address', 'support@example.com'),
            'support_phone' => $this->gs->contact_phone ?? '+1234567890',
        ];

        // You can pass additional data like order details, payment info, etc.
        return view('frontend.payment-status', compact('status', 'order', 'cart', 'settings'));
    }
}
