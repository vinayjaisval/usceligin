<?php

namespace App\Http\Controllers\Payment\Checkout;

use App\{
    Models\Cart,
    Models\Order,
    Models\PaymentGateway,
    Classes\GeniusMailer,
    Jobs\PaymentGetways
};
use App\Helpers\PriceHelper;
use App\Models\Address;
use App\Models\Country;
use App\Models\Reward;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;
use Illuminate\Support\Str;
use App\Helpers\OrderHelper;

class RazorpayController extends CheckoutBaseControlller
{
    private $displayCurrency;
    private $api;
    private $keyId;
    private $keySecret;

    public function __construct()
    {
        parent::__construct();
        $data = PaymentGateway::whereKeyword('razorpay')->first();
        $paydata = $data->convertAutoData();
        $this->keyId = $paydata['key'];
        $this->keySecret = $paydata['secret'];
        $this->displayCurrency = 'INR';
        $this->api = new Api($this->keyId, $this->keySecret);
    }



    public function store(Request $request)
    {
        $input = $request->all();



        // Check currency
        if ($this->curr->name !== "INR") {
            return redirect()->back()->with('unsuccess', __('Please Select INR Currency For This Payment.'));
        }

        // Authentication check
        if ($request->pass_check) {
            $auth = OrderHelper::auth_check($input);
            if (!$auth['auth_success']) {
                return redirect()->back()->with('unsuccess', $auth['error_message']);
            }
        }

        // Check cart session
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

        $cart = Cart::restoreCart(Session::get('cart'));
        $user = Auth::user();

        // ---- Amount recalculated server-side; client-submitted totals are never trusted ----
        $totals = OrderHelper::buildOrderTotals($request, $cart, $user, $this->gs, $this->curr);
        $total = round($totals['pay_amount'], 2);

        // Minimum order amount check
        if ($total < 1) {
            return redirect()->back()->with('unsuccess', __('Minimum order amount must be at least ₹1.'));
        }

        // Prepare order meta
        $order = [
            'item_name'   => $this->gs->title . " Order",
            'item_number' => Str::random(4) . time(),
            'item_amount' => $total,
        ];

        $notify_url = route('front.razorpay.notify');

        Log::info('Checkout Total: ' . $total);

        // Create Razorpay order
        $razorpayOrder = $this->api->order->create([
            'receipt'         => $order['item_number'],
            'amount'          => (int) round($total * 100), // Cast to int
            'currency'        => 'INR',
            'payment_capture' => 1,
        ]);

        // Persist the validated address IDs + server-computed totals for notify() to reuse —
        // guarantees the amount charged by Razorpay is exactly what gets saved on the Order.
        $input['shipping_address_id'] = $shippingAddress->id;
        $input['billing_address_id'] = $billingAddress->id;

        Session::put('input_data', $input);
        Session::put('order_data', $order);
        Session::put('order_payment_id', $razorpayOrder['id']);
        Session::put('order_totals', $totals);

        $amount = $razorpayOrder['amount'];
        $displayAmount = $amount;

        // Currency conversion (if not INR)
        if ($this->displayCurrency !== 'INR') {
            $url = "https://api.fixer.io/latest?symbols={$this->displayCurrency}&base=INR";
            $exchange = json_decode(file_get_contents($url), true);
            $displayAmount = $exchange['rates'][$this->displayCurrency] * $amount / 100;
        }

        // Razorpay checkout config
        $data = [
            "key"         => $this->keyId,
            "amount"      => $amount,
            "name"        => $order['item_name'],
            "description" => $order['item_name'],
            "prefill"     => [
                "name"    => $shippingAddress->name,
                "email"   => $user->email,
                "contact" => $shippingAddress->phone,
            ],
            "notes"       => [
                "address"           => $shippingAddress->address_line_1,
                "merchant_order_id" => $order['item_number'],
            ],
            "theme"       => [
                "color" => $this->gs->colors,
            ],
            "order_id"    => $razorpayOrder['id'],
        ];

        if ($this->displayCurrency !== 'INR') {
            $data['display_currency'] = $this->displayCurrency;
            $data['display_amount'] = $displayAmount;
        }

        $json = json_encode($data);

        return view('frontend.razorpay-checkout', compact('data', 'json', 'notify_url', ));
    }




    public function notify(Request $request)
    {


        $input = Session::get('input_data');
        $totals = Session::get('order_totals');

        $order_data = Session::get('order_data');
        $success_url = route('front.payment.return');
        $cancel_url = route('front.payment.cancle');
        $input_data = $request->all();
        //  dd($input_data);
        $payment_id = Session::get('order_payment_id');
        $success = false;

        if (!empty($input_data['razorpay_payment_id']) && !empty($input_data['razorpay_signature'])) {
            try {
                $attributes = [
                    'razorpay_order_id'   => $payment_id,
                    'razorpay_payment_id' => $input_data['razorpay_payment_id'],
                    'razorpay_signature'  => $input_data['razorpay_signature'],
                ];
                $this->api->utility->verifyPaymentSignature($attributes);
                $success = true;
            } catch (SignatureVerificationError $e) {
                $success = false;
            }
        }

        if ($success === true && $totals && !empty($input['shipping_address_id']) && Auth::check()) {
            $user = Auth::user();

            // Re-fetch the address by ID (defense in depth — don't trust the session-cached text fields)
            $shippingAddress = Address::where('id', $input['shipping_address_id'])
                ->where('user_id', $user->id)
                ->first();

            if (!$shippingAddress) {
                return redirect($cancel_url)->with('unsuccess', __('Delivery address could not be verified.'));
            }

            $billingAddress = !empty($input['billing_address_id'])
                ? Address::where('id', $input['billing_address_id'])->where('user_id', $user->id)->first()
                : null;
            $billingAddress = $billingAddress ?: $shippingAddress;

            $cart = Cart::restoreCart(Session::get('cart'));
            $new_cart = json_encode([
                'totalQty'   => $cart->totalQty,
                'totalPrice' => $cart->totalPrice,
                'items'      => $cart->items,
            ]);

            $temp_affilate_users = OrderHelper::product_affilate_check($cart);

            $affilate_users = $temp_affilate_users ? json_encode($temp_affilate_users) : null;

            // Create order
            $order = new Order;
            $input['cart'] = $new_cart;
            $input['user_id'] = $user->id;

            // ---- Address/contact fields from the authoritative Address record ----
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

            $input['method'] = 'online';

            // ---- Recalculated totals, computed once server-side in store() and reused here
            //      so the amount saved matches exactly what Razorpay charged ----
            $input['shipping_cost'] = $totals['shipping_cost'];
            $input['coupon_discount'] = $totals['coupon_discount'];
            $input['coupon_code'] = $totals['coupon_code'];
            $input['refferal_discount'] = $totals['referral_discount'];
            $input['tax'] = $totals['tax_amount'];
            $input['points_used'] = $totals['points_used'];
            $input['pay_amount'] = $totals['pay_amount'];

            $input['totalQty'] =  $cart->totalQty;
            $input['affilate_user'] = $affilate_users ?? $user->reffered_by;
            $input['affilate_users'] = $affilate_users ?? $user->affiliated_by;

            $input['order_number'] = $order_data['item_number'];
            $input['wallet_price'] = ($input['wallet_price'] ?? 0) / $this->curr->value;
            $input['payment_status'] = "Completed";
            $input['txnid'] = $input_data['razorpay_payment_id'];

            $input['status'] = 'pending';

            foreach (['refferel_user_id', 'affilate'] as $key) {
                if (Session::has($key)) {
                    $val = $totals['subtotal'] / $this->curr->value;
                    $percentage = $this->gs->affilate_charge; // e.g., 10
                    $sub = $val * ($percentage / 100); // convert to decimal


                    if ($temp_affilate_users) {
                        foreach ($temp_affilate_users as $t_cost) {
                            $sub -= $t_cost['charge'];
                        }
                    }

                    if ($sub > 0) {

                        // $user = OrderHelper::affilate_check(Session::get($key), $sub, $input['dp']);
                        $input['affilate_user'] = Session::get($key);
                        $input['affilate_charge'] = $sub;
                    }

                    Session::forget($key);
                }
            }

            $order->fill($input)->save();
            $order->tracks()->create([
                'title' => 'Pending',
                'text'  => 'You have successfully placed your order.',
            ]);
            $order->notifications()->create();

            PaymentGetways::dispatch($order_data['item_number']);

            if (!empty($input['coupon_code'])) {
                OrderHelper::coupon_check($input['coupon_code']);
            }

            OrderHelper::size_qty_check($cart);
            OrderHelper::stock_check($cart);
            OrderHelper::vendor_order_check($cart, $order);

            // Clear cart & coupon session
            Session::put('temporder', $order);
            Session::put('tempcart', $cart);
            Session::forget(['cart', 'already', 'coupon', 'coupon_total', 'coupon_total1', 'coupon_percentage', 'order_totals']);

            // Wallet transaction
            if ($order->user_id && $order->wallet_price > 0) {
                OrderHelper::add_to_transaction($order, $order->wallet_price);
            }

            // Reward logic
            if (Auth::check() && $this->gs->is_reward == 1) {
                $rewards = Reward::all();
                $num = $order->pay_amount;
                $closest = null;

                foreach ($rewards as $reward) {
                    $diff = abs($reward->order_amount - $num);
                    if ($closest === null || $diff < $closest['diff']) {
                        $closest = ['reward' => $reward, 'diff' => $diff];
                    }
                }

                if (isset($closest['reward']) && Auth::check()) {
                    $user = Auth::user();
                    $user->reward += $closest['reward']->reward;
                    $user->save();
                }
            }


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
                'subject' => "Order $order->order_number confirmed — thanks!",
                'body'    => $htmlBody
            ];

            $result = $mailer->sendCustomMail($data);
            // Send emails
            // $mailer = new GeniusMailer();


            // $mailer->sendCustomMail([
            //     'to'      => $this->ps->contact_email,
            //     'subject' => "New Order Recieved!!",
            //     'body'    => "Hello Admin!<br>Your store has received a new order.<br>Order Number is " . $order->order_number . ". Please login to your panel to check.<br>Thank you.",
            // ]);

            return redirect($success_url);
        }

        return redirect($cancel_url);
    }
  
  
  
  
}
