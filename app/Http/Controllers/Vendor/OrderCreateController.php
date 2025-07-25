<?php

namespace App\Http\Controllers\Vendor;

use App\Classes\GeniusMailer;
use App\Helpers\OrderHelper;
use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Country;
use App\Models\Currency;
use App\Models\Order;
use App\Models\Pagesetting;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Validator;

class OrderCreateController extends VendorBaseController
{
    public function create(Request $request)
    {

      

      
        if ($request->products) {
            $selectd_products = $request->products;
            foreach ($selectd_products as $product) {
                $products[] = Product::findOrFail($product);
            }
        } else {
            $selectd_products = [];
            $products = [];
        }

        $sign = $this->curr;
        Session::forget('order_products');

        return view('vendor.orderpos.create.index', compact('products', 'selectd_products', 'sign'));
    }

    public function datatables()
    {

        //--- Integrating This Collection Into Datatables
        $datas = Product::whereStatus(1);
      
        return Datatables::of($datas)
            ->editColumn('name', function (Product $data) {
                $price = $data->price * $this->curr->value;
                $img = '<img src="' . asset('assets/images/thumbnails/' . $data->thumbnail) . '" alt="' . $data->name . '" class="img-thumbnail" width="100"> <br>';
                $name =  mb_strlen($data->name, 'UTF-8') > 50 ? mb_substr($data->name, 0, 50, 'UTF-8') . '...' : $data->name;
                
              
                return  $img . $name . $data->checkVendor() . '<br><small>' . __("Price") . ': ' . $price . ' ' . $this->curr->sign . '</small>';
            })

            ->addColumn('action', function (Product $data) {
                return '<div class="action-list"><a href="javascript:;" class="order_product_add" data-toggle="modal" class="add-btn-small pl-2" data-target="#add-product" data-href="' . $data->id . '"> <i class="fas fa-plus"></i></a></div>';
            })

            ->rawColumns(['name', 'action'])
            ->toJson();
    }


    public function addProduct($product_id)
    {

        $order_products = Session::get('order_products');
        if (!$order_products) {
            $order_products = [];
        }
        if (!in_array($product_id, $order_products)) {
            $order_products[] = $product_id;
        }

        Session::put('order_products', $order_products);

        $sign = $this->curr;
        return view('vendor.orderpos.partials.product_add_table', compact('sign'));
    }


    public function orderStore(Request $request)
    {
        dd($request->all());
    }


    public function removeOrderProduct($product_id)
    {
        $products = Session::get('order_products');
        foreach ($products as $key => $product) {
            if ($product == $product_id) {
                unset($products[$key]);
            }
        }
        $sign = $this->curr;
        if ($products) {
            Session::put('order_products', $products);
        } else {
            Session::forget('order_products');
        }

        return view('vendor.orderpos.partials.product_add_table', compact('sign'));
    }


    public function product_show($id)
    {
        $data['productt'] = Product::find($id);
        $data['curr'] = $this->curr;
        return view('vendor.orderpos.create.add-product', $data);
    }

    public function addcart(Request $request)
    {
    // dd($request->all());
        $id = $_GET['id'];
        $qty = $_GET['qty'];
        $size = str_replace(' ', '-', $_GET['size']);
        $color = $_GET['color'];
        $size_qty = $_GET['size_qty'];
        $size_price = (float)$_GET['size_price'];
        $size_key = $_GET['size_key'];
        $keys =  $_GET['keys'];
      
        $values = $_GET['values'] ? $_GET['values'] : null;
        $prices = $_GET['prices'] ? $_GET['prices'] : null;
        $affilate_user = isset($_GET['affilate_user']) ? $_GET['affilate_user'] : '0';
        $keys = $keys == "" ? '' : $keys;
        $values = $values == "" ? '' : $values;
        $curr = $this->curr;
       
        $size_price = ($size_price / $curr->value);
        $prod = Product::where('id', '=', $id)->first(['id', 'user_id', 'slug', 'name', 'photo', 'size', 'size_qty', 'size_price', 'color', 'price', 'stock', 'type', 'file', 'link', 'license', 'license_qty', 'measure', 'whole_sell_qty', 'whole_sell_discount', 'attributes', 'minimum_qty', 'stock_check', 'size_all', 'color_all']);
        if ($prod->type != 'Physical') {
            $qty = 1;
        }



        if ($prod->user_id != 0) {
            $prc = $prod->price + $this->gs->fixed_commission + ($prod->price / 100) * $this->gs->percentage_commission;
            $prod->price = round($prc, 2);
        }
        if (!empty($prices)) {
            foreach (explode(',',$prices) as $data) {
                $prod->price += ($data / $curr->value);
            }
        }

        if (!empty($prod->license_qty)) {
            $lcheck = 1;
            foreach ($prod->license_qty as $ttl => $dtl) {
                if ($dtl < 1) {
                    $lcheck = 0;
                } else {
                    $lcheck = 1;
                    break;
                }
            }
            if ($lcheck == 0) {
                return 0;
            }
        }


        if (empty($size)) {
            if (!empty($prod->size)) {
                $size = trim($prod->size[0]);
            }
            $size = str_replace(' ', '-', $size);
        }

        if ($size_qty == '0' && $prod->stock_check == 1) {

            return 0;
        }

        if (empty($color)) {
            if (!empty($prod->color)) {
                $color = $prod->color[0];
            }
        }


        if ($prod->stock_check == 0) {
            if (empty($size)) {

                if (!empty($prod->size_all)) {
                    $size = trim(explode(',', $prod->size_all)[0]);
                }
                $size = str_replace(' ', '-', $size);
            }

            if (empty($color)) {
                if (!empty($prod->color_all)) {
                    $color = explode(',', $prod->color_all)[0];
                }
            }
        }


        $color = str_replace('#', '', $color);
        $oldCart = Session::has('admin_cart') ? Session::get('admin_cart') : null;
        // $cart = new Cart($oldCart);
        $cart = Cart::restoreCart($oldCart);


        $cart->addnum($prod, $prod->id, $qty, $size, $color, $size_qty, $size_price, $size_key, $keys, $values, $affilate_user);


        if ($cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['dp'] == 1) {
            return view('admin.order.create.product_add_table');
        }
        if ($cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['stock'] < 0) {

            return view('admin.order.create.product_add_table');
        }
        if ($prod->stock_check == 1) {
            if ($cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['size_qty']) {
                if ($cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'] > $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['size_qty']) {
                    return view('admin.order.create.product_add_table');
                }
            }
        }


        $cart->totalPrice = 0;
        foreach ($cart->items as $data)
            $cart->totalPrice += $data['price'];
        Session::put('admin_cart', $cart);
        $data[0] = count($cart->items);
        $data[1] = $cart->totalPrice;
        $data[1] = \PriceHelper::showCurrencyPrice($data[1] * $curr->value);
        
        return view('vendor.orderpos.create.product_add_table');
    }



    public function removecart($id)
    {

        $oldCart = Session::has('admin_cart') ? Session::get('admin_cart') : null;
        // $cart = new Cart($oldCart);
        $cart = Cart::restoreCart($oldCart);

        $cart->removeItem($id);
        Session::forget('admin_cart');
        if (count($cart->items) > 0) {
            Session::put('admin_cart', $cart);
        }

        return view('vendor.orderpos.create.product_add_table');
    }


    public function userAddress(Request $request)
    {
        Session::forget('order_address');
        if ($request->user_id == 'guest') {
            $isUser = 0;
            $country = Country::all();
            return view('admin.order.create.address_form', compact('country', 'isUser'));
        } else {
            $isUser = 1;
            $user = User::findOrFail($request->user_id);
            $country = Country::all();
            return view('vendor.orderpos.create.address_form', compact('user', 'country', 'isUser'));
        }
    }


    public function userAddressSubmit(Request $request)
    {
        Session::put('order_address', $request->all());
        return back();
    }


    public function viewCreateOrder(Request $request)
    {
        
        Session::put('order_address', $request->all());
      
        $cart = Session::get('admin_cart');
        $address = Session::get('order_address');
   
        return view('vendor.orderpos.create.view', compact('cart', 'address'));
    }


    public function CreateOrderSubmit(Request $request)
    {
        // dd($request->all());
       
       
        $user = $this->user;
        $address = Session::get('order_address');
        $input = $address;
        // dd($input);
        $curr = Currency::where('is_default', '=', 1)->first();

        $oldCart = Session::get('admin_cart');
        // $cart = new Cart($oldCart);
        $cart = Cart::restoreCart($oldCart);

        OrderHelper::license_check($cart); // For License Checking
        $t_oldCart = Session::get('admin_cart');
        // $t_cart = new Cart($t_oldCart);
        $t_cart = Cart::restoreCart($t_oldCart);
        // dd($t_cart);
        $rules = [
            'customer_email'    => 'required',

            // 'photo'    => 'required|mimes:jpeg,jpg,png,svg',
            // 'password' => 'required'

        ];
        
        $validator = Validator::make($input, $rules);
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
        }
        
        // Check if the user already exists by email
        // $exits_user = User::where('email', $input['customer_email'])->first();
        $exits_user = User::where('email', $input['customer_email'])
                  ->where('phone', $input['customer_phone'])
                  ->first();

        // dd($user);
        if ($exits_user) {
            // User exists, update information

            $inputo['name'] =$input['customer_name'];
            $inputo['email'] =$input['customer_email'];
            $inputo['phone'] =$input['customer_phone'];
            $inputo['address'] =$input['customer_address'];
            $inputo['country'] =$input['customer_country'];
            $inputo['city_id'] =$input['customer_city'];
            $inputo['state_id'] =$input['customer_state'];
            $inputo['zip'] =$input['customer_zip'];
            $inputo['seller_id'] = $user->id ?? null;

            // $inputo['password'] = $input['password'];  // Ensure password is updated correctly
            $inputo['email_verified'] = 'Yes';
        
            // Optionally update photo if provided
           
            // Update the existing user
            $exits_user->update($inputo);
            // return response()->json(['message' => 'User updated successfully']);
        } else {
            // User does not exist, create a new user
            $inputo['name'] =$input['customer_name'];
            $inputo['email'] =$input['customer_email'];
            $inputo['phone'] =$input['customer_phone'];
            $inputo['address'] =$input['customer_address'];
            $inputo['country'] =$input['customer_country'];
            $inputo['city_id'] =$input['customer_city'];
            $inputo['state_id'] =$input['customer_state'];
            $inputo['zip'] =$input['customer_zip'];
            $inputo['seller_id'] = $user->id ?? null;
            // $inputo['password'] = $input['password'];  // Ensure password is updated correctly
            $inputo['email_verified'] = 'Yes';
        
            // Create new user
            $exits_user = new User();
            $exits_user->fill($inputo)->save();
        
            // return response()->json(['message' => 'User created successfully']);
        }
        

        $new_cart = [];
        $new_cart['totalQty'] = $t_cart->totalQty;
        $new_cart['totalPrice'] = $t_cart->totalPrice;
        $new_cart['items'] = $t_cart->items;
        $new_cart = json_encode($new_cart);
        $temp_affilate_users = OrderHelper::product_affilate_check($cart); // For Product Based Affilate Checking
        $affilate_users = $temp_affilate_users == null ? null : json_encode($temp_affilate_users);

        $order = new Order;
        $input['cart'] = $new_cart;
        $input['totalQty'] = $t_cart->totalQty;
        // $input['user_id'] = $address['user_id'] != 'guest' ? $address['user_id'] : NULL;
        $input['user_id'] = $exits_user->id ? $exits_user->id : NULL;

        $input['affilate_users'] = $affilate_users;
        $input['pay_amount'] = $request->total / $this->curr->value - $request->coupon_discount;

        $input['seller_commission']= $input['pay_amount'] * 0.05;
        $input['order_number'] = Str::random(8) . time();
        $input['payment_status'] = 'Pending';


        // $input['payment_status'] = "Completed";
        $input['txnid'] = Str::random(8) . time();
        $input['tax'] = 0;
        $input['method'] = $request->payment_method ?? null;
        $input['currency_sign'] = $curr->sign;
        $input['currency_name'] = $curr->name;
        $input['currency_value'] = $curr->value;
        $input['shipping_cost'] = $request->shipping_cost ?? 0;
        $input['coupon_discount'] = $request->coupon_discount ?? 0;

        $input['packing_cost'] = 0;
        $input['seller_id'] =  $user->id ?? null;

// dd($input);

        $order->fill($input)->save();
        $order->tracks()->create(['title' => 'Pending', 'text' => 'You have successfully placed your order.']);
        $order->notifications()->create();


        OrderHelper::size_qty_check($cart); // For Size Quantiy Checking
        OrderHelper::stock_check($cart); // For Stock Checking
        OrderHelper::vendor_order_check($cart, $order); // For Vendor Order Checking

        Session::forget('admin_cart');
        Session::forget('order_address');


        if ($order->user_id != 0 && $order->wallet_price != 0) {
            OrderHelper::add_to_transaction($order, $order->wallet_price); // Store To Transactions
        }

        //Sending Email To Buyer
        $data = [
            'to' => $order->customer_email,
            'type' => "new_order",
            'cname' => $order->customer_name,
            'oamount' => "",
            'aname' => "",
            'aemail' => "",
            'wtitle' => "",
            'onumber' => $order->order_number,
        ];

        $mailer = new GeniusMailer();
        $mailer->sendAutoOrderMail($data, $order->id);
        $ps = Pagesetting::first();
        $discouts = $request->coupon_discount ?? 0;
        $totalprice = (int)($request->total - $discouts);
        if($request->payment_method=="online"){
           $this->createPaymentLink($totalprice,$order->customer_email,$order->customer_phone,$order->order_number);
        }
        //Sending Email To Admin
        $data = [
            'to' => $ps->contact_email,
            'subject' => "New Order Recieved!!",
            'body' => "Hello Admin!<br>Your store has received a new order.<br>Order Number is " . $order->order_number . ".Please login to your panel to check. <br>Thank you.",
        ];
        $mailer = new GeniusMailer();
        $mailer->sendCustomMail($data);

        return redirect(route('vendor-order-show',$order->id))->with('added', 'Order has been placed successfully!');
    }








    public function CreateOrderSubmit2(Request $request)
    {   
        $address = Session::get('order_address');
        $input = $address;
        $curr = Currency::where('is_default', '=', 1)->first();

        $oldCart = Session::get('admin_cart');
        // $cart = new Cart($oldCart);
        $cart = Cart::restoreCart($oldCart);

        OrderHelper::license_check($cart); // For License Checking
        $t_oldCart = Session::get('admin_cart');
        // $t_cart = new Cart($t_oldCart);
        $t_cart = Cart::restoreCart($t_oldCart);
    
        $new_cart = [];
        // $new_cart['totalQty'] = $t_cart->totalQty; // commet by ankit
        $new_cart['totalQty']   = $address['totalqty'];
        $new_cart['totalPrice'] = $t_cart->totalPrice+$address['shipping_cost'];
        $new_cart['items']      = $t_cart->items;
        $new_cart               = json_encode($new_cart);
        $temp_affilate_users = OrderHelper::product_affilate_check($cart); // For Product Based Affilate Checking
        $affilate_users = $temp_affilate_users == null ? null : json_encode($temp_affilate_users);

        $order = new Order;
        $input['cart'] = $new_cart;
        // $input['totalQty'] = $t_cart->totalQty; //commit by ankit
        $input['totalQty']       = $address['totalqty'];
        $input['user_id']        = $address['user_id'] != 'guest' ? $address['user_id'] : NULL;
        $input['affilate_users'] = $affilate_users;
        $input['pay_amount']     = $cart->totalPrice+$address['shipping_cost'] / $this->curr->value;
        $input['order_number']   = Str::random(8) . time();
        $input['payment_status'] = 'Pending';

        // $input['payment_status'] = "Completed";
        $input['txnid']          = Str::random(8) . time();
        $input['tax']            = 0;
        $input['method']         = 'Created By Admin';
        $input['currency_sign']  = $curr->sign;
        $input['currency_name']  = $curr->name;
        $input['currency_value'] = $curr->value;
        $input['shipping_cost']  = $address['shipping_cost'];
        $input['packing_cost']   = 0;
        $input['coupon_discount'] = $request->code ?? 0;


        $order->fill($input)->save();
        $order->tracks()->create(['title' => 'Pending', 'text' => 'You have successfully placed your order.']);
        $order->notifications()->create();


        OrderHelper::size_qty_check($cart); // For Size Quantiy Checking
        OrderHelper::stock_check($cart); // For Stock Checking
        OrderHelper::vendor_order_check($cart, $order); // For Vendor Order Checking

        Session::forget('admin_cart');
        Session::forget('order_address');


        if ($order->user_id != 0 && $order->wallet_price != 0) {
            OrderHelper::add_to_transaction($order, $order->wallet_price); // Store To Transactions
        }

        //Sending Email To Buyer
        $data = [
            'to' => $order->customer_email,
            'type' => "new_order",
            'cname' => $order->customer_name,
            'oamount' => "",
            'aname' => "",
            'aemail' => "",
            'wtitle' => "",
            'onumber' => $order->order_number,
        ];

        $mailer = new GeniusMailer();
        $mailer->sendAutoOrderMail($data, $order->id);
        $ps = Pagesetting::first();
        $discouts = $request->code ?? 0;
        $totalprice = (int)($t_cart->totalPrice + $address['shipping_cost']-$discouts);
        if($request->method=="online"){
           $this->createPaymentLink($totalprice,$order->customer_email,$order->customer_phone,$order->order_number);
        }
        //Sending Email To Admin
        $data = [
            'to' => $ps->contact_email,
            'subject' => "New Order Recieved!!",
            'body' => "Hello Admin!<br>Your store has received a new order.<br>Order Number is " . $order->order_number . ".Please login to your panel to check. <br>Thank you.",
        ];
        $mailer = new GeniusMailer();
        $mailer->sendCustomMail($data);
        return redirect(route('admin-order-show',$order->id))->with('added', 'Order has been placed successfully!');
    }


    public function createPaymentLink($amount, $customer_email, $customer_phone, $order_id)
    {
        try {
            $api = new \Razorpay\Api\Api('rzp_test_nyTqNRxl8rWhmi', 'TFhnDfnlSG8gZawU15zboKGH');

            $paymentLink = $api->paymentLink->create([
                'amount'         => $amount * 100,
                'currency'       => 'INR',
                'accept_partial' => false,
                'reference_id'   => 'order_' . time(),
                'description'    => 'Payment for Order ID ' . time(),
                'customer' => [
                    'email' => $customer_email,
                    'contact' => $customer_phone 
                ],
                'notify' => [
                    'sms' => true,
                    'email' => true
                ],
                'callback_url' => url("/order/update/").'/'.$order_id, 
            ]);

            return $paymentLink;
        } catch (\Razorpay\Api\Errors\BadRequestError $e) {
            // Handle BadRequestError exception
            return ['error' => $e->getMessage()];
        }
    }

    public function orderUpdate(Request $request,$id){
        $order = Order::where('order_number', $id)->first();
        if ($order) {
            $order->payment_status = "Completed";
            $order->online = json_encode($request->all());
            if ($order->save()) {
                return redirect()->route('order-thankyou', $order->id)->with('added', 'Order has been updated successfully!');
            } else {
                echo "payment link expired";
            }
        } else {
            echo "payment link expired";
        }
    }


    public function thankyou(){
        return view('admin.thankyou');
    }
}
