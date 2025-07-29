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
use App\Models\Country;
use App\Models\Reward;
use App\Models\State;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use OrderHelper;


use Razorpay\Api\Api;
use Illuminate\Support\Str;

class RazorpayController extends CheckoutBaseControlller
{
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


    // public function store(Request $request)
    // {
    //     // dd($request->all());
    //     $input = $request->all();

    //     $data = PaymentGateway::whereKeyword('razorpay')->first();
    //     $total = $request->total;


    //     if ($this->curr->name != "INR") {
    //         return redirect()->back()->with('unsuccess', __('Please Select INR Currency For This Payment.'));
    //     }
    //     if ($request->pass_check) {
    //         $auth = OrderHelper::auth_check($input); // For Authentication Checking
    //         if (!$auth['auth_success']) {
    //             return redirect()->back()->with('unsuccess', $auth['error_message']);
    //         }
    //     }

    //     if (!Session::has('cart')) {
    //         return redirect()->route('front.cart')->with('success', __("You don't have any product to checkout."));
    //     }

    //     $order['item_name'] = $this->gs->title . " Order";
    //     $order['item_number'] = Str::random(4) . time();
    //     $order['item_amount'] = round($total, 2);
    //     $cancel_url = route('front.payment.cancle');
    //     $notify_url = route('front.razorpay.notify');

    //     // $total = PriceHelper::getOrderTotalAmount($input, Session::get('cart'));
    //     $total = $request->total;


    //     if ($total < 1) {
    //         return redirect()->back()->with('unsuccess', __('Minimum order amount must be at least ₹1.'));
    //     }

    //     // Prepare Razorpay order data
    //     $orderData = [
    //         'receipt'         => $order['item_number'],
    //         'amount'          => round($total * 100), // Convert ₹ to paise
    //         'currency'        => 'INR',
    //         'payment_capture' => 1 // Auto capture
    //     ];



    //     \Log::info('Checkout Total: ' . $total);

    //     $razorpayOrder = $this->api->order->create($orderData);

    //     Session::put('input_data', $input);
    //     Session::put('order_data', $order);
    //     Session::put('order_payment_id', $razorpayOrder['id']);

    //     $displayAmount = $amount = $orderData['amount'];

    //     if ($this->displayCurrency !== 'INR') {
    //         $url = "https://api.fixer.io/latest?symbols=$this->displayCurrency&base=INR";
    //         $exchange = json_decode(file_get_contents($url), true);

    //         $displayAmount = $exchange['rates'][$this->displayCurrency] * $amount / 100;
    //     }


    //     $checkout = 'automatic';

    //     if (isset($_GET['checkout']) and in_array($_GET['checkout'], ['automatic', 'manual'], true)) {
    //         $checkout = $_GET['checkout'];
    //     }


    //     $data = [
    //         "key"               => $this->keyId,
    //         "amount"            => $amount,
    //         "name"              => $order['item_name'],
    //         "description"       => $order['item_name'],
    //         "prefill"           => [
    //             "name"              => $request->customer_name,
    //             "email"             => $request->customer_email,
    //             "contact"           => $request->customer_phone,
    //         ],
    //         "notes"             => [
    //             "address"           => $request->customer_address,
    //             "merchant_order_id" => $order['item_number'],
    //         ],
    //         "theme"             => [
    //             "color"             => "{{$this->gs->colors}}"
    //         ],
    //         "order_id"          => $razorpayOrder['id'],
    //     ];

    //     if ($this->displayCurrency !== 'INR') {
    //         $data['display_currency']  = $this->displayCurrency;
    //         $data['display_amount']    = $displayAmount;
    //     }

    //     $json = json_encode($data);

    //     $displayCurrency = $this->displayCurrency;


    //     view()->share('langg', $this->language);
    //     return view('frontend.razorpay-checkout', compact('data', 'displayCurrency', 'json', 'notify_url'));
    // }


    public function store(Request $request)
    {
        $input = $request->all();
        // dd($input);
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

        $total = round($request->total, 2);

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

        \Log::info('Checkout Total: ' . $total);

        // Create Razorpay order
        $razorpayOrder = $this->api->order->create([
            'receipt'         => $order['item_number'],
            'amount'          => (int) round($total * 100), // Cast to int
            'currency'        => 'INR',
            'payment_capture' => 1,
        ]);

        // Store session data
        Session::put('input_data', $input);
        Session::put('order_data', $order);
        Session::put('order_payment_id', $razorpayOrder['id']);

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
                "name"    => $request->customer_name,
                "email"   => $request->customer_email,
                "contact" => $request->customer_phone,
            ],
            "notes"       => [
                "address"           => $request->customer_address,
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
        $displayCurrency = $this->displayCurrency;


        view()->share('langg', $this->language);

        return view('frontend.razorpay-checkout', compact('data', 'displayCurrency', 'json', 'notify_url'));
    }


    // public function notify1(Request $request)
    // {

    //     $input = Session::get('input_data');
    //     $order_data = Session::get('order_data');
    //     $success_url = route('front.payment.return');
    //     $cancel_url = route('front.payment.cancle');
    //     $input_data = $request->all();
    //     /** Get the payment ID before session clear **/
    //     $payment_id = Session::get('order_payment_id');

    //     $success = true;

    //     if (empty($input_data['razorpay_payment_id']) === false) {

    //         try {
    //             $attributes = array(
    //                 'razorpay_order_id' => $payment_id,
    //                 'razorpay_payment_id' => $input_data['razorpay_payment_id'],
    //                 'razorpay_signature' => $input_data['razorpay_signature']
    //             );

    //             // $this->api->utility->verifyPaymentSignature($attributes);
    //         } catch (SignatureVerificationError $e) {
    //             $success = false;
    //         }
    //     }

    //     if ($success === true) {

    //         $oldCart = Session::get('cart');

    //         // $cart = new Cart($oldCart);

    //         $cart = Cart::restoreCart($oldCart);

    //         OrderHelper::license_check($cart); // For License Checking
    //         $t_oldCart = Session::get('cart');
    //         // $t_cart = new Cart($t_oldCart);

    //         $t_cart = Cart::restoreCart($t_oldCart);

    //         $new_cart = [];
    //         $new_cart['totalQty'] = $t_cart->totalQty;
    //         $new_cart['totalPrice'] = $t_cart->totalPrice;
    //         $new_cart['items'] = $t_cart->items;
    //         $new_cart = json_encode($new_cart);
    //         $temp_affilate_users = OrderHelper::product_affilate_check($cart); // For Product Based Affilate Checking
    //         $affilate_users = $temp_affilate_users == null ? null : json_encode($temp_affilate_users);

    //         // $orderCalculate = PriceHelper::getOrderTotal($input, $cart);
    //   // dd($orderCalculate);
    //         // if (isset($orderCalculate['success']) && $orderCalculate['success'] == false) {
    //         //     return redirect()->back()->with('unsuccess', $orderCalculate['message']);
    //         // }

    //         // if ($this->gs->multiple_shipping == 0) {
    //         //     $orderTotal = $orderCalculate['total_amount'];
    //         //     $shipping = $orderCalculate['shipping'];
    //         //     $packeing = $orderCalculate['packeing'];
    //         //     $is_shipping = $orderCalculate['is_shipping'];
    //         //     $vendor_shipping_ids = $orderCalculate['vendor_shipping_ids'];
    //         //     $vendor_packing_ids = $orderCalculate['vendor_packing_ids'];
    //         //     $vendor_ids = $orderCalculate['vendor_ids'];

    //         //     $input['shipping_title'] = $shipping->title;
    //         //     $input['vendor_shipping_id'] = $shipping->id;
    //         //     $input['packing_title'] = $packeing->title;
    //         //     $input['vendor_packing_id'] = $packeing->id;
    //         //    // $input['shipping_cost'] = $packeing->price; by vinay commeent 

    //         //     $input['shipping_cost'] =  $input['shipping_cost'];  // add by vinay
    //         //     $input['packing_cost'] = $packeing->price;
    //         //     $input['is_shipping'] = $is_shipping;
    //         //     $input['vendor_shipping_ids'] = $vendor_shipping_ids;
    //         //     $input['vendor_packing_ids'] = $vendor_packing_ids;
    //         //     $input['vendor_ids'] = $vendor_ids;
    //         // } else {


    //         //     // multi shipping

    //         //     $orderTotal = $orderCalculate['total_amount'];
    //         //     $shipping = $orderCalculate['shipping'];
    //         //     $packeing = $orderCalculate['packeing'];
    //         //     $is_shipping = $orderCalculate['is_shipping'];
    //         //     $vendor_shipping_ids = $orderCalculate['vendor_shipping_ids'];
    //         //     $vendor_packing_ids = $orderCalculate['vendor_packing_ids'];
    //         //     $vendor_ids = $orderCalculate['vendor_ids'];
    //         //    // $shipping_cost = $orderCalculate['shipping_cost'];
    //         //     $shipping_cost = $input['shipping_cost'];
    //         //     $packing_cost = $orderCalculate['packing_cost'];

    //         //     $input['shipping_title'] = $vendor_shipping_ids;
    //         //     $input['vendor_shipping_id'] = $vendor_shipping_ids;
    //         //     $input['packing_title'] = $vendor_packing_ids;
    //         //     $input['vendor_packing_id'] = $vendor_packing_ids;
    //         //     $input['shipping_cost'] = $shipping_cost;
    //         //     $input['packing_cost'] = $packing_cost;
    //         //     $input['is_shipping'] = $is_shipping;
    //         //     $input['vendor_shipping_ids'] = $vendor_shipping_ids;
    //         //     $input['vendor_packing_ids'] = $vendor_packing_ids;
    //         //     $input['vendor_ids'] = $vendor_ids;
    //         //     unset($input['shipping']);
    //         //     unset($input['packeging']);
    //         // }
    //         $orderTotal = $t_cart->totalPrice  + $input['shippingCost']  - $input['coupon_discount'];

    //         // $orderTotal = $orderCalculate['total_amount'];
    //     //  dd($input);
    //         $order = new Order;
    //         $input['cart'] = $new_cart;
    //         $input['user_id'] = Auth::check() ? Auth::user()->id : NULL;
    //         $input['affilate_users'] = $affilate_users;
    //         $input['pay_amount'] = $orderTotal;
    //         $input['order_number'] = $order_data['item_number'];
    //         $input['wallet_price'] = $input['wallet_price'] / $this->curr->value;
    //         $input['payment_status'] = "Completed";
    //         $input['txnid'] = $input_data['razorpay_payment_id'];
    //         if ($request->refferal_discount) {
    //             $input['refferal_discount'] = $request->refferal_discount;
    //         }

    //         // if ($input['tax_type'] == 'state_tax') {
    //         //     $input['tax_location'] = State::findOrFail($input['tax'])->state;
    //         // } else {
    //         //     $input['tax_location'] = Country::findOrFail($input['tax'])->pluck('country_name');
    //         // }

    //         // $input['tax'] = Session::get('current_tax');

    //         if ($input['dp'] == 1) {
    //             $input['status'] = 'completed';
    //         }

    //         if (Session::has('refferel_user_id')) {
    //             $val = (int) preg_replace('/\D/', '', $request->total) / $this->curr->value;
    //             $val = $val / 100;
    //             $sub = $val * $this->gs->affilate_charge;
    //             if ($temp_affilate_users != null) {
    //                 $t_sub = 0;
    //                 foreach ($temp_affilate_users as $t_cost) {
    //                     $t_sub += $t_cost['charge'];
    //                 }
    //                 $sub = $sub - $t_sub;
    //             }
    //             if ($sub > 0) {
    //                 $user = OrderHelper::affilate_check(Session::get('refferel_user_id'), $sub, $input['dp']); // For Affiliate Checking
    //                 $input['affilate_user'] = Session::get('refferel_user_id');
    //                 $input['affilate_charge'] = $sub;
    //             }
    //             Session::forget('refferel_user_id');
    //         }
    //         if (Session::has('affilate')) {
    //             $val = $request->total / $this->curr->value;
    //             $val = $val / 100;
    //             $sub = $val * $this->gs->affilate_charge;
    //             if ($temp_affilate_users != null) {
    //                 $t_sub = 0;
    //                 foreach ($temp_affilate_users as $t_cost) {
    //                     $t_sub += $t_cost['charge'];
    //                 }
    //                 $sub = $sub - $t_sub;
    //             }
    //             if ($sub > 0) {
    //                 $user = OrderHelper::affilate_check(Session::get('affilate'), $sub, $input['dp']); // For Affiliate Checking
    //                 $input['affilate_user'] = Session::get('affilate');
    //                 $input['affilate_charge'] = $sub;
    //             }
    //             Session::forget('affilate');
    //         }

    //         $order->fill($input)->save();
    //         $order->tracks()->create(['title' => 'Pending', 'text' => 'You have successfully placed your order.']);
    //         $order->notifications()->create();

    //         PaymentGetways::dispatch($order_data['item_number']);


    //         if ($input['coupon_id'] != "") {
    //             OrderHelper::coupon_check($input['coupon_id']); // For Coupon Checking
    //         }

    //         OrderHelper::size_qty_check($cart); // For Size Quantiy Checking
    //         OrderHelper::stock_check($cart); // For Stock Checking
    //         OrderHelper::vendor_order_check($cart, $order); // For Vendor Order Checking

    //         Session::put('temporder', $order);
    //         Session::put('tempcart', $cart);
    //         Session::forget('cart');
    //         Session::forget('already');
    //         Session::forget('coupon');
    //         Session::forget('coupon_total');
    //         Session::forget('coupon_total1');
    //         Session::forget('coupon_percentage');

    //         if ($order->user_id != 0 && $order->wallet_price != 0) {
    //             OrderHelper::add_to_transaction($order, $order->wallet_price); // Store To Transactions
    //         }

    //         if (Auth::check()) {
    //             if ($this->gs->is_reward == 1) {
    //                 $num = $order->pay_amount;
    //                 $rewards = Reward::get();
    //                 foreach ($rewards as $i) {
    //                     $smallest[$i->order_amount] = abs($i->order_amount - $num);
    //                 }

    //                 if (isset($smallest)) {
    //                     asort($smallest);
    //                     $final_reword = Reward::where('order_amount', key($smallest))->first();
    //                     Auth::user()->update(['reward' => (Auth::user()->reward + $final_reword->reward)]);
    //                 }
    //             }
    //         }


    //         //Sending Email To Buyer
    //         $data = [
    //             'to' => $order->customer_email,
    //             'type' => "new_order",
    //             'cname' => $order->customer_name,
    //             'oamount' => "",
    //             'aname' => "",
    //             'aemail' => "",
    //             'wtitle' => "",
    //             'onumber' => $order->order_number,
    //         ];

    //         $mailer = new GeniusMailer();
    //         $mailer->sendAutoOrderMail($data, $order->id);

    //         //Sending Email To Admin
    //         $data = [
    //             'to' => $this->ps->contact_email,
    //             'subject' => "New Order Recieved!!",
    //             'body' => "Hello Admin!<br>Your store has received a new order.<br>Order Number is " . $order->order_number . ".Please login to your panel to check. <br>Thank you.",
    //         ];
    //         $mailer = new GeniusMailer();
    //         $mailer->sendCustomMail($data);

    //         return redirect($success_url);
    //     }

    //     return redirect($cancel_url);
    // }

    public function notify(Request $request)
    {


        $input = Session::get('input_data');

        $order_data = Session::get('order_data');
        $success_url = route('front.payment.return');
        $cancel_url = route('front.payment.cancle');
        $input_data = $request->all();
        //  dd($input_data);
        $payment_id = Session::get('order_payment_id');
        $success = true;

        if (!empty($input_data['razorpay_payment_id'])) {
            try {
                $attributes = [
                    'razorpay_order_id'   => $payment_id,
                    'razorpay_payment_id' => $input_data['razorpay_payment_id'],
                    'razorpay_signature'  => $input_data['razorpay_signature'],
                ];
                // $this->api->utility->verifyPaymentSignature($attributes);
            } catch (SignatureVerificationError $e) {
                $success = false;
            }
        }

        if ($success === true) {
            $cart = Cart::restoreCart(Session::get('cart'));
            $new_cart = json_encode([
                'totalQty'   => $cart->totalQty,
                'totalPrice' => $cart->totalPrice,
                'items'      => $cart->items,
            ]);

            $temp_affilate_users = OrderHelper::product_affilate_check($cart);

            $affilate_users = $temp_affilate_users ? json_encode($temp_affilate_users) : null;

            // Calculate final order total
            $shippingCost = $input['shippingCost'] ?? 0;
            $couponDiscount = $input['coupon_discount'] ?? 0;
            $refferal_discount = $input['refferal_discount'] ?? 0;

            $orderTotal = $cart->totalPrice + $shippingCost - $couponDiscount - $refferal_discount;

            // Create order
            $order = new Order;
            $input['cart'] = $new_cart;
            $input['user_id'] = Auth::check() ? Auth::id() : null;
            $input['billing_address_id'] = $input['billingAddress'] ?? null;
            $input['shipping_address_id'] = $input['shippingAddress'] ?? null;
            $input['method'] = $input['selected_payment_method'] ?? null;

            $input['shipping_cost'] = $input['shippingCost'] ?? 0;
            $input['coupon_discount'] = $input['coupon_discount'] ?? 0;
            $input['coupon_code'] = $input['coupon_code'] ?? null;
            $input['totalQty'] =  $cart->totalQty;
            $input['affilate_user'] = $affilate_users ?? Auth::user()->reffered_by;
            $input['affilate_users'] = $affilate_users ?? Auth::user()->affiliated_by;

            $input['pay_amount'] = $orderTotal;
            $input['order_number'] = $order_data['item_number'];
            $input['wallet_price'] = ($input['wallet_price'] ?? 0) / $this->curr->value;
            $input['payment_status'] = "Completed";
            $input['txnid'] = $input_data['razorpay_payment_id'];
            // $input['status'] = $input['dp'] == 1 ? 'completed' : 'pending';
            $input['status'] = 'pending';

            // dd($input);
            if ($request->filled('refferal_discount')) {
                $input['refferal_discount'] = $request->refferal_discount;
            }

            // if (Session::has('refferel_user_id')) {
            //     $val = (int) preg_replace('/\D/', '', $input['total']) / $this->curr->value;
            //     $val = $val / 100;
            //     $sub = $val * $this->gs->affilate_charge;
            //     if ($temp_affilate_users != null) {
            //         $t_sub = 0;
            //         foreach ($temp_affilate_users as $t_cost) {
            //             $t_sub += $t_cost['charge'];
            //         }
            //         $sub = $sub - $t_sub;
            //     }
            //     if ($sub > 0) {
            //         // $user = OrderHelper::affilate_check(Session::get('refferel_user_id'), $sub, $input['dp']); // For Affiliate Checking
            //         $input['affilate_user'] = Session::get('refferel_user_id');
            //         $input['affilate_charge'] = $sub;
            //     }
            //     Session::forget('refferel_user_id');
            // }
            // if (Session::has('affilate')) {
            //     $val = $input['total'] / $this->curr->value;
            //     $val = $val / 100;
            //     $sub = $val * $this->gs->affilate_charge;
            //     if ($temp_affilate_users != null) {
            //         $t_sub = 0;
            //         foreach ($temp_affilate_users as $t_cost) {
            //             $t_sub += $t_cost['charge'];
            //         }
            //         $sub = $sub - $t_sub;
            //     }
            //     if ($sub > 0) {
            //         $user = OrderHelper::affilate_check(Session::get('affilate'), $sub, $input['dp']); // For Affiliate Checking
            //         $input['affilate_user'] = Session::get('affilate');
            //         $input['affilate_charge'] = $sub;
            //     }
            //     Session::forget('affilate');
            // }

           // Affiliate/referral check
            foreach (['refferel_user_id', 'affilate'] as $key) {
                if (Session::has($key)) {
                    $val = (float) preg_replace('/[^\d.]/', '', $input['total']); // Keep decimal
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

            if (!empty($input['coupon_id'])) {
                OrderHelper::coupon_check($input['coupon_id']);
            }

            OrderHelper::size_qty_check($cart);
            OrderHelper::stock_check($cart);
            OrderHelper::vendor_order_check($cart, $order);

            // Clear cart & coupon session
            Session::put('temporder', $order);
            Session::put('tempcart', $cart);
            Session::forget(['cart', 'already', 'coupon', 'coupon_total', 'coupon_total1', 'coupon_percentage']);

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

                if (isset($closest['reward'])) {
                    Auth::user()->increment('reward', $closest['reward']->reward);
                }
            }

            // Send emails
            $mailer = new GeniusMailer();

            // $mailer->sendAutoOrderMail([
            //     'to'       => $order->customer_email,
            //     'type'     => "new_order",
            //     'cname'    => $order->customer_name,
            //     'oamount'  => "",
            //     'aname'    => "",
            //     'aemail'   => "",
            //     'wtitle'   => "",
            //     'onumber'  => $order->order_number,
            // ], $order->id);

            $mailer->sendCustomMail([
                'to'      => $this->ps->contact_email,
                'subject' => "New Order Recieved!!",
                'body'    => "Hello Admin!<br>Your store has received a new order.<br>Order Number is " . $order->order_number . ". Please login to your panel to check.<br>Thank you.",
            ]);

            return redirect($success_url);
        }

        return redirect($cancel_url);
    }
}
