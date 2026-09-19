<?php

namespace App\Http\Controllers\Payment\Checkout;

use App\{
    Models\Cart,
    Models\Order,
    Classes\GeniusMailer,
    Jobs\ShippedToDelivery
};
use App\Helpers\PriceHelper;
use App\Models\Address;
use App\Models\Country;

use App\Models\Package;
use App\Models\Reward;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Helpers\OrderHelper;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

class CashOnDeliveryController extends CheckoutBaseControlller
{
    public function store(Request $request)
    {


        $input = $request->all();

        if ($request->pass_check) {

            $auth = OrderHelper::auth_check($input); // For Authentication Checking
            if (!$auth['auth_success']) {
                return redirect()->back()->with('unsuccess', $auth['error_message']);
            }
        }

        if (!Session::has('cart')) {


            return redirect()->route('front.cart')->with('success', __("You don't have any product to checkout."));
        }

        // ---- Address is required and must belong to the logged-in user ----
        $request->validate(['shipping_address_id' => 'required|integer']);

        $shippingAddress = Address::where('id', $request->shipping_address_id)
            ->where('user_id', Auth::id())
            ->first();

        if (!$shippingAddress) {
            return redirect()->back()->with('unsuccess', __('Please select a valid delivery address.'));
        }

        $billingAddress = $request->billing_address_id
            ? Address::where('id', $request->billing_address_id)->where('user_id', Auth::id())->first()
            : null;
        $billingAddress = $billingAddress ?: $shippingAddress;

        $totalQuantity = 0;
        $oldCart = Session::get('cart');

        // $cart = new Cart($oldCart);
        $cart = Cart::restoreCart($oldCart);
        OrderHelper::license_check($cart); // For License Checking
        $t_oldCart = Session::get('cart');
        $t_cart = Cart::restoreCart($t_oldCart);
        $products = $t_cart->items;
        foreach ($products as $key => $value) {
            $totalQuantity += $value['qty'];
        }
        // $t_cart = new Cart($t_oldCart);

        $new_cart = [];
        $new_cart['totalQty'] = $totalQuantity;
        $new_cart['totalPrice'] = $t_cart->totalPrice;
        $new_cart['items'] = $t_cart->items;
        $new_cart = json_encode($new_cart);
        $temp_affilate_users = OrderHelper::product_affilate_check($cart); // For Product Based Affilate Checking
        $affilate_users = $temp_affilate_users == null ? null : json_encode($temp_affilate_users);

        $user = Auth::user();

        // ---- All amounts recalculated server-side; client-submitted totals are never trusted ----
        $totals = OrderHelper::buildOrderTotals($request, $t_cart, $user, $this->gs, $this->curr);

        $order = new Order;


        $success_url = route('front.payment.return');
        // $success_url=route('user-orders') ;
        $input['user_id'] = $user->id;
        $input['cart'] = $new_cart;
        $input['totalQty'] = $totalQuantity;

        // ---- Address/contact fields populated from the authoritative Address record, not raw request text ----
        $input['shipping_address_id'] = $shippingAddress->id;
        $input['billing_address_id'] = $billingAddress->id;
        $input['customer_name'] = $shippingAddress->name;
        $input['customer_phone'] = $shippingAddress->phone;
        $input['customer_email'] = $user->email;
        $input['customer_address'] = trim($shippingAddress->address_line_1 . ' ' . $shippingAddress->address_line_2);
        $input['customer_city'] = $shippingAddress->city;
        $input['customer_state'] = $shippingAddress->state;
        $input['customer_zip'] = $shippingAddress->pincode;
        $input['customer_country'] = $shippingAddress->country;
        $input['shipping_name'] = $billingAddress->name;
        $input['shipping_phone'] = $billingAddress->phone;
        $input['shipping_address'] = trim($billingAddress->address_line_1 . ' ' . $billingAddress->address_line_2);
        $input['shipping_city'] = $billingAddress->city;
        $input['shipping_state'] = $billingAddress->state;
        $input['shipping_zip'] = $billingAddress->pincode;
        $input['shipping_country'] = $billingAddress->country;

        $input['method'] = $request->selected_payment_method == 1
            ? 'COD'
            : ($request->selected_payment_method == 9 ? 'online' : null);

        // ---- Recalculated totals (server-derived, not client-submitted) ----
        $input['coupon_code'] = $totals['coupon_code'];
        $input['coupon_discount'] = $totals['coupon_discount'];
        $input['refferal_discount'] = $totals['referral_discount'];
        $input['shipping_cost'] = $totals['shipping_cost'];
        $input['tax'] = $totals['tax_amount'];
        $input['points_used'] = $totals['points_used'];
        $input['pay_amount'] = $totals['pay_amount'];

        $input['affilate_users'] = $affilate_users ?? $user->affiliated_by;
        $input['order_number'] = Str::random(4) . time();
        $input['wallet_price'] = $request->wallet_price / $this->curr->value;


        if (Session::has('refferel_user_id')) {
            $val = $totals['subtotal'] / $this->curr->value;
            $val = $val / 100;
            $sub = $val * $this->gs->affilate_charge;
            if ($temp_affilate_users != null) {
                $t_sub = 0;
                foreach ($temp_affilate_users as $t_cost) {
                    $t_sub += $t_cost['charge'];
                }
                $sub = $sub - $t_sub;
            }
            if ($sub > 0) {
                // $user = OrderHelper::affilate_check(Session::get('refferel_user_id'), $sub, $input['dp']); // For Affiliate Checking
                $input['affilate_user'] = Session::get('refferel_user_id');
                $input['affilate_charge'] = $sub;
            }
            Session::forget('refferel_user_id');
        }

        if (Session::has('affilate')) {
            $val = $totals['subtotal'] / $this->curr->value;
            $val = $val / 100;
            $sub = $val * $this->gs->affilate_charge;
            if ($temp_affilate_users != null) {
                $t_sub = 0;
                foreach ($temp_affilate_users as $t_cost) {
                    $t_sub += $t_cost['charge'];
                }
                $sub = $sub - $t_sub;
            }
            if ($sub > 0) {
                // $user = OrderHelper::affilate_check(Session::get('affilate'), $sub, $input['dp']); // For Affiliate Checking
                $input['affilate_user'] = Session::get('affilate');
                $input['affilate_charge'] = $sub;
            }
            Session::forget('affilate');
        }


        $order->fill($input)->save();
        $order->tracks()->create(['title' => 'Pending', 'text' => 'You have successfully placed your order.']);
        $order->notifications()->create();

        ShippedToDelivery::dispatch($input['order_number']);


        if (!empty($input['coupon_code'])) {
            OrderHelper::coupon_check($input['coupon_code']); // For Coupon Checking
        }
        if (Auth::check()) {
            if ($this->gs->is_reward == 1) {
                $num = $order->pay_amount;
                $rewards = Reward::get();
                foreach ($rewards as $i) {
                    $smallest[$i->order_amount] = abs($i->order_amount - $num);
                }

                if (isset($smallest)) {
                    asort($smallest);
                    $final_reword = Reward::where('order_amount', key($smallest))->first();
                    Auth::user()->update(['reward' => (Auth::user()->reward + $final_reword->reward)]);
                }
            }
        }
        OrderHelper::size_qty_check($cart); // For Size Quantiy Checking
        OrderHelper::stock_check($cart); // For Stock Checking
        OrderHelper::vendor_order_check($cart, $order); // For Vendor Order Checking
        Session::put('temporder', $order);
        Session::put('tempcart', $cart);
        Session::forget('cart');
        Session::forget('already');
        Session::forget('coupon');
        Session::forget('coupon_total');
        Session::forget('coupon_total1');
        Session::forget('coupon_percentage');
        if ($order->user_id != 0 && $order->wallet_price != 0) {
            OrderHelper::add_to_transaction($order, $order->wallet_price); // Store To Transactions
        }


        try {


            $mailer = new GeniusMailer();

            $htmlBody = View::make('emails.order', [
                'name'       => $order->customer_name,
                'headline'   => 'Your order is confirmed and we are getting it ready.',
                'order_id'   => $order->order_number,
                'status'   => $order->status,
                'payment_method'   => $order->method,
                'order_date'   => $order->created_at->toDayDateTimeString(),
                'total'      => $order->pay_amount,
                'subject'    => "Order $order->order_number confirmed — thanks!",
                'cta_label'  => 'Visit Website',
                'cta_url'    => url('/')
            ])->render();

            if (empty($htmlBody)) {
                Log::error('❌ Email body empty');
            }

            $data = [
               'to' => Auth::user()->email ?? 'vinay.jaisval2015@gmail.com',
                'subject' => "Order $order->order_number confirmed  thanks!",
                'body'    => $htmlBody
            ];
            //      $data = [
            //     'to' => $this->ps->contact_email,
            //     'subject' => "New Order Recieved!!",
            //     'body' => "Hello Admin!<br>Your store has received a new order.<br>Order Number is " . $order->order_number . ".Please login to your panel to check. <br>Thank you.",
            // ];

            // Log::info('📧 Sending mail...', $data);

            $result = $mailer->sendCustomMail($data);

            // Log::info('📧 Mail response', ['result' => $result]);
        } catch (\Exception $e) {

            Log::error('❌ Mail failed', [
                'error' => $e->getMessage(),
                'line' => $e->getLine(),
                'file' => $e->getFile()
            ]);
        }

        return redirect($success_url);
    }
}
