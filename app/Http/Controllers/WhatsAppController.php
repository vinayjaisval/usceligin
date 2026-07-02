<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\Product;
use App\Models\Order;
use App\Models\Coupon;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;


class WhatsAppController extends Controller
{
    private $verifyToken = 'celiginapp';

    // ================= SESSION =================
    private function session($phone)
    {
        $s = DB::table('whatsapp_sessions')->where('phone', $phone)->first();

        if (!$s) {
            DB::table('whatsapp_sessions')->insert([
                'phone' => $phone,
                'step' => null,
                'name' => null,
                'address' => null,
                'created_at' => now(),
                'updated_at' => now()
            ]);

            $s = DB::table('whatsapp_sessions')->where('phone', $phone)->first();
        }

        return $s;
    }

    // ================= WEBHOOK =================
    public function webhook(Request $request)
    {
        if ($request->isMethod('GET')) {
            if ($request->hub_mode === 'subscribe' &&
                $request->hub_verify_token === $this->verifyToken) {
                return response($request->hub_challenge, 200);
            }
            return response('Invalid', 403);
        }

        $data = $request->all();
        Log::info('WHATSAPP WEBHOOK', $data);

        $message = $data['entry'][0]['changes'][0]['value']['messages'][0] ?? null;

        if (!$message) {
            return response()->json(['status' => 'ignored']);
        }

        $from = $message['from'] ?? null;

        $text = strtolower(trim(
            $message['text']['body']
            ?? $message['interactive']['button_reply']['id']
            ?? $message['interactive']['list_reply']['id']
            ?? ''
        ));

        if (!$from || $text === '') {
            return response()->json(['status' => 'invalid']);
        }

        Log::info("FROM: $from TEXT: $text");
        $this->recalculateCoupon($from);
        $session = $this->session($from);

        // ================= RESET =================
        if (in_array($text, ['hi','hello','hey'])) {

           DB::table('whatsapp_sessions')->where('phone',$from)->update([
    'step'=>null,
    'name'=>null,
    'address'=>null,
    'coupon_code'=>null,
    'coupon_discount'=>0
]);

            $this->sendMessage($from,"👋 Welcome\n\n1️⃣ Products\n2️⃣ Cart\n3️⃣ Checkout");
            return response()->json();
        }
      
      
      if (preg_match('/^remove\s+(\d+)$/', $text, $m)) {

    DB::table('whatsapp_cart')
        ->where('phone',$from)
        ->where('product_id',$m[1])
        ->delete();

    $this->recalculateCoupon($from);

    $this->sendCartView($from);

    return response()->json();
}

        // ================= PRODUCTS =================
       if ($text == '1') {

    $products = Product::where('status',1)->take(10)->get();

    foreach ($products as $product) {

        $imageUrl = asset('assets/images/products/'.$product->photo);

        Http::withToken(env('WHATSAPP_TOKEN'))->post(
            env('WHATSAPP_API').'/'.env('WHATSAPP_PHONE_ID').'/messages',
            [
                "messaging_product"=>"whatsapp",
                "to"=>$from,
                "type"=>"interactive",
                "interactive"=>[
                    "type"=>"button",
                    "header"=>[
                        "type"=>"image",
                        "image"=>[
                            "link"=>$imageUrl
                        ]
                    ],
                    "body"=>[
                        "text"=>"🛍 {$product->name}\n💰 Price: ₹{$product->price}"
                    ],
                    "action"=>[
                        "buttons"=>[
                            [
                                "type"=>"reply",
                                "reply"=>[
                                    "id"=>"add_".$product->id,
                                    "title"=>"Add Cart"
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        );
    }

    return response()->json();
}

        // ================= CART =================
       if ($text == '2') {

   $this->recalculateCoupon($from);

$this->sendCartView($from);

return response()->json();
}
      
      
      if (str_starts_with(strtolower($text), 'coupon ')) {

    $couponCode = strtoupper(trim(str_replace('coupon ', '', $text)));

    $coupon = DB::table('coupons')
        ->where('code', $couponCode)
        ->where('status', 1)
        ->first();

    if (!$coupon) {

        $this->sendMessage(
            $from,
            "❌ Invalid Coupon Code"
        );

        return response()->json();
    }
          if(($session->coupon_code ?? null) == $couponCode){

    $this->sendMessage(
        $from,
        "⚠ Coupon already applied"
    );

    return response()->json();
}

    $total = 0;

    $items = DB::table('whatsapp_cart')
        ->where('phone', $from)
        ->get();

    foreach ($items as $item) {

        $product = Product::find($item->product_id);

        if ($product) {
            $total += ($product->price * $item->qty);
        }
    }

    if($total <= 0){

    $this->sendMessage(
        $from,
        "🛒 Cart Empty. Add products first."
    );

    return response()->json();
}

    // BUY10 = 10% discount
if($coupon->type == 0){
    $discount = ($total * $coupon->price) / 100;
}else{
    $discount = min($coupon->price, $total);
}    
        
        
      

    DB::table('whatsapp_sessions')
        ->where('phone', $from)
        ->update([
            'coupon_code' => $couponCode,
            'coupon_discount' => $discount
        ]);

    $finalAmount = $total - $discount;

    $this->sendMessage(
        $from,
        "✅ Coupon Applied Successfully\n\n".
        "🎁 Coupon : {$couponCode}\n".
        "💸 Discount : ₹{$discount}\n".
        "💳 New Total : ₹{$finalAmount}\n\n".
        "Type 3 for Checkout"
    );

    return response()->json();
}
      
      
      
        // ================= CHECKOUT =================
        if ($text == '3') {

            if (!$session->name) {
                DB::table('whatsapp_sessions')->where('phone',$from)
                    ->update(['step'=>'ask_name']);

                $this->sendMessage($from,"👤 Enter Name:");
                return response()->json();
            }

            if (!$session->address) {
                DB::table('whatsapp_sessions')->where('phone',$from)
                    ->update(['step'=>'ask_address']);

                $this->sendMessage($from,"📍 Enter Address:");
                return response()->json();
            }

            $items = DB::table('whatsapp_cart')->where('phone',$from)->get();

            if ($items->count() == 0) {
                $this->sendMessage($from,"🛒 Cart Empty");
                return response()->json();
            }

            $total = 0;

            foreach ($items as $i) {
                $p = Product::find($i->product_id);
                if ($p) $total += $p->price * $i->qty;
            }
          
          $total = $total - ($session->coupon_discount ?? 0);

if ($total < 0) {
    $total = 0;
}

            $orderNumber = 'WA'.time();

           DB::table('whatsapp_orders')->insert([
    'order_number'      => $orderNumber,
    'phone'             => $from,
    'amount'            => $total,

    'coupon_code'       => $session->coupon_code ?? null,
    'coupon_discount'   => $session->coupon_discount ?? 0,

    'status'            => 'pending',
    'payment_method'    => null,
    'is_paid'           => 0,
    'payment_link_id'   => null,
    'created_at'        => now()
]);

            $this->sendPaymentOptions($from,$orderNumber,$total);

            return response()->json();
        }

        // ================= NAME =================
        if ($session->step == 'ask_name') {

            DB::table('whatsapp_sessions')->where('phone',$from)->update([
                'name'=>$text,
                'step'=>'ask_address'
            ]);

            $this->sendMessage($from,"📍 Enter Address:");
            return response()->json();
        }

        // ================= ADDRESS =================
        if ($session->step == 'ask_address') {

            DB::table('whatsapp_sessions')->where('phone',$from)->update([
                'address'=>$text,
                'step'=>'done'
            ]);

            $this->sendMessage($from,"💳 Type 3 for Checkout");
            return response()->json();
        }

        // ================= PAYMENT BUTTON =================
        if (str_starts_with($text,'cod_') || str_starts_with($text,'pay_')) {

            $orderNumber = str_replace(['cod_','pay_'],'',$text);

           if (str_starts_with($text,'cod_')) {

    DB::table('whatsapp_orders')
        ->where('order_number',$orderNumber)
        ->update([
            'payment_method'=>'COD',
            'status'=>'confirmed'
        ]);

$waOrder = DB::table('whatsapp_orders')
    ->where('order_number', $orderNumber)
    ->first();

if ($waOrder && $waOrder->is_paid) {

    Log::info(
        "Duplicate Razorpay Webhook Ignored : ".$orderNumber
    );

    return response()->json([
        'success' => true
    ]);
}

if (!$waOrder) {
    return response()->json([
        'success' => false,
        'message' => 'Whatsapp order not found'
    ]);
}

    if ($waOrder) {
        $this->createOrderFromWhatsapp(
            $waOrder,
            null,
            'COD'
        );
    }

    $this->sendMessage(
    $from,
    "🎉 Order Confirmed!\n\n" .
    "💵 Payment Method: Cash on Delivery\n" .
    "📦 Order Number: {$orderNumber}\n\n" .
    "🙏 Thank you for shopping with us."
);

    return response()->json();
}

            $order = DB::table('whatsapp_orders')
                ->where('order_number',$orderNumber)
                ->first();

            if (!$order) {
                $this->sendMessage($from,"❌ Order not found");
                return response()->json();
            }

            $payment = $this->createPayment($order->amount,$from,$orderNumber);

            if (!$payment || !$payment['short_url']) {
                $this->sendMessage($from,"❌ Payment failed. Try again.");
                return response()->json();
            }

            DB::table('whatsapp_orders')
                ->where('order_number',$orderNumber)
                ->update([
                    'payment_method'=>'PREPAID',
                    'payment_link_id'=>$payment['payment_link_id'],
                    'payment_url'=>$payment['short_url']
                ]);

            $this->sendMessage($from,"💳 Pay Here\n".$payment['short_url']);

            return response()->json();
        }
      
      
      if (str_starts_with($text,'add_')) {

    $productId = str_replace('add_','',$text);

   $product = Product::find($productId);

if (!$product) {
    return response()->json();
}

if($product->stock <= 0){

    $this->sendMessage(
        $from,
        "❌ Product Out Of Stock"
    );

    return response()->json();
}

    $cartItem = DB::table('whatsapp_cart')
        ->where('phone',$from)
        ->where('product_id',$productId)
        ->first();

  if ($cartItem) {

    if($cartItem->qty >= $product->stock){

        $this->sendMessage(
            $from,
            "❌ Maximum stock reached"
        );

        return response()->json();
    }

    DB::table('whatsapp_cart')
        ->where('id',$cartItem->id)
        ->increment('qty');

}
    
    else {

        DB::table('whatsapp_cart')->insert([
            'phone'=>$from,
            'product_id'=>$productId,
            'qty'=>1,
            'created_at'=>now(),
            'updated_at'=>now()
        ]);
    }

$this->recalculateCoupon($from);
$this->sendCartView($from);

return response()->json();
}
      
      
     if (preg_match('/^\+(\d+)$/', $text, $m)) {

    $product = Product::find($m[1]);

    if(!$product){
        return response()->json();
    }

    $cartItem = DB::table('whatsapp_cart')
        ->where('phone',$from)
        ->where('product_id',$m[1])
        ->first();

    if($cartItem && $cartItem->qty >= $product->stock){

        $this->sendMessage(
            $from,
            "❌ Maximum stock reached"
        );

        return response()->json();
    }

    DB::table('whatsapp_cart')
        ->where('phone',$from)
        ->where('product_id',$m[1])
        ->increment('qty');

    $this->recalculateCoupon($from);

    $this->sendCartView($from);

    return response()->json();
}

if (preg_match('/^\-(\d+)$/', $text, $m)) {

    $item = DB::table('whatsapp_cart')
        ->where('phone',$from)
        ->where('product_id',$m[1])
        ->first();

    if ($item) {

        if ($item->qty > 1) {

            DB::table('whatsapp_cart')
                ->where('id',$item->id)
                ->decrement('qty');

        } else {

            DB::table('whatsapp_cart')
                ->where('id',$item->id)
                ->delete();
        }
    }

   $this->recalculateCoupon($from);
$this->sendCartView($from);
return response()->json();
}

       // ================= ADD TO CART =================
if (is_numeric($text)) {

    $product = Product::find($text);

    if ($product) {

        $cartItem = DB::table('whatsapp_cart')
            ->where('phone', $from)
            ->where('product_id', $product->id)
            ->first();

        if ($cartItem) {

            DB::table('whatsapp_cart')
                ->where('id', $cartItem->id)
                ->increment('qty', 1, [
                    'updated_at' => now()
                ]);

        } else {

            DB::table('whatsapp_cart')->insert([
                'phone'      => $from,
                'product_id' => $product->id,
                'qty'        => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
        }
      $this->recalculateCoupon($from);

       $this->sendMessage(
            $from,
            "✅ Added: {$product->name}\nType 2 for Cart"
        );
    }

    return response()->json();
}

        return response()->json();
    }

    // ================= PAYMENT OPTIONS =================
    private function sendPaymentOptions($to,$orderNumber,$amount)
    {
        $url = env('WHATSAPP_API').'/'.env('WHATSAPP_PHONE_ID').'/messages';

        Http::withToken(env('WHATSAPP_TOKEN'))->post($url,[
            "messaging_product"=>"whatsapp",
            "to"=>$to,
            "type"=>"interactive",
            "interactive"=>[
                "type"=>"button",
                "body"=>[
                    "text"=>"💳 Choose Payment Method\nOrder: $orderNumber\nTotal: ₹$amount"
                ],
                "action"=>[
                    "buttons"=>[
                        [
                            "type"=>"reply",
                            "reply"=>[
                                "id"=>"cod_$orderNumber",
                                "title"=>"💵 COD"
                            ]
                        ],
                        [
                            "type"=>"reply",
                            "reply"=>[
                                "id"=>"pay_$orderNumber",
                                "title"=>"💳 Pay Now"
                            ]
                        ]
                    ]
                ]
            ]
        ]);
    }

    // ================= SEND MESSAGE =================
    private function sendMessage($to,$text)
    {
        $url = env('WHATSAPP_API').'/'.env('WHATSAPP_PHONE_ID').'/messages';

        Http::withToken(env('WHATSAPP_TOKEN'))->post($url,[
            'messaging_product'=>'whatsapp',
            'to'=>$to,
            'type'=>'text',
            'text'=>['body'=>$text]
        ]);
    }

    // ================= RAZORPAY =================
    private function createPayment($amount,$phone,$orderNumber)
    {
        $res = Http::withBasicAuth(
            env('RAZORPAY_KEY'),
            env('RAZORPAY_SECRET')
        )->post('https://api.razorpay.com/v1/payment_links',[
            'amount'=>$amount*100,
            'currency'=>'INR',
            'reference_id'=>$orderNumber,
            'customer'=>['contact'=>$phone],
            'callback_url'=>url('/razorpay/whatsapp/success'),
            'callback_method'=>'get'
        ]);

        if (!$res->successful()) {
            Log::error('RAZORPAY ERROR',$res->json());
            return null;
        }

        $data = $res->json();

        return [
            'payment_link_id'=>$data['id'] ?? null,
            'short_url'=>$data['short_url'] ?? null
        ];
    }
  
  
public function razorpayWebhook(Request $request)
{
    $payload = $request->all();

    Log::info('RAZORPAY WEBHOOK', $payload);

    if (!isset($payload['event'])) {
        return response()->json(['success' => false]);
    }

    /*
    |--------------------------------------------------------------------------
    | payment_link.paid
    |--------------------------------------------------------------------------
    */
    if ($payload['event'] == 'payment_link.paid') {

        $entity = $payload['payload']['payment_link']['entity'];

        $orderNumber = $entity['reference_id'];

        $waOrder = DB::table('whatsapp_orders')
            ->where('order_number', $orderNumber)
            ->first();

        if (!$waOrder) {
            return response()->json([
                'success' => false,
                'message' => 'Whatsapp order not found'
            ]);
        }

        DB::table('whatsapp_orders')
            ->where('id', $waOrder->id)
            ->update([
                'status' => 'paid',
                'is_paid' => 1,
                'updated_at' => now()
            ]);

       $this->createOrderFromWhatsapp(
    $waOrder,
    $payload['payload']['payment']['entity']['id'] ?? null,
    'Razorpay'
);

       $this->sendMessage(
    $waOrder->phone,
    "🎉 Payment Successful!\n\n" .
    "✅ Your order has been placed successfully.\n" .
    "📦 Order Number: {$orderNumber}\n\n" .
    "🙏 Thank you for shopping with us."
);

Log::info(
    "WhatsApp Order Created Successfully : {$orderNumber}"
);
    }

    return response()->json([
        'success' => true
    ]);
}
  
  
  private function createOrderFromWhatsapp($waOrder, $transactionId = null, $paymentMethod = 'COD')
{
    $session = DB::table('whatsapp_sessions')
        ->where('phone', $waOrder->phone)
        ->first();

    $user = User::where('phone', $waOrder->phone)->first();

    if (!$user) {
        $user = User::create([
            'name' => $session->name ?? 'WhatsApp Customer',
            'phone' => $waOrder->phone,
            'email' => 'wa_'.$waOrder->phone.'@temp.com',
            'password' => Hash::make(Str::random(10)),
            'status' => 1,
            'email_verified' => 'Yes'
        ]);
    }

    $existingOrder = Order::where('order_number', $waOrder->order_number)->first();

   if ($existingOrder) {

    $existingOrder->method = $paymentMethod;
    $existingOrder->payment_status =
        $paymentMethod == 'COD'
        ? 'Pending'
        : 'Completed';

    if ($transactionId) {
        $existingOrder->txnid = $transactionId;
    }

    $existingOrder->save();

    return true;
}

    $items = DB::table('whatsapp_cart')
        ->where('phone', $waOrder->phone)
        ->get();

    if ($items->count() == 0) {
        return false;
    }

    $cartItems = [];
    $totalQty = 0;
    $totalPrice = 0;

    foreach ($items as $row) {

        $product = Product::find($row->product_id);

        if (!$product) {
            continue;
        }

        $linePrice = $product->price * $row->qty;

        $cartItems[$product->id] = [
            'user_id' => $product->user_id,
            'qty' => $row->qty,
            'size_key' => 0,
            'size_qty' => '',
            'size_price' => '',
            'size' => '',
            'color' => '',
            'stock' => max(0, $product->stock - $row->qty),
            'price' => $linePrice,
            'item' => [
                'id' => $product->id,
                'user_id' => $product->user_id,
                'slug' => $product->slug,
                'name' => $product->name,
                'photo' => $product->photo,
                'size' => '',
                'size_qty' => '',
                'size_price' => '',
                'color' => '',
                'price' => $product->price,
                'stock' => $product->stock,
                'type' => $product->type
            ],
            'license' => '',
            'dp' => '0',
            'keys' => '',
            'values' => '',
            'item_price' => $product->price,
            'discount' => 0,
            'affilate_user' => 0
        ];

        $totalQty += $row->qty;
        $totalPrice += $linePrice;

        $product->update([
            'stock' => max(0, $product->stock - $row->qty)
        ]);
    }

    $cartJson = json_encode([
        'totalQty' => $totalQty,
        'totalPrice' => $totalPrice,
        'items' => $cartItems
    ]);

    $order = new Order();

    $order->user_id = $user->id;
    $order->cart = $cartJson;
    $order->method = $paymentMethod;
    $order->totalQty = $totalQty;
    $order->pay_amount = $waOrder->amount;
    $order->order_number = $waOrder->order_number;
    $order->coupon_code = $waOrder->coupon_code ?? null;

    $order->coupon_discount =
        $waOrder->coupon_discount ?? 0;

    $order->discount =
        $waOrder->coupon_discount ?? 0;
    $order->payment_status = $paymentMethod == 'COD' ? 'Pending' : 'Completed';

    $order->customer_name = $session->name ?? $user->name;
    $order->customer_phone = $waOrder->phone;
    $order->customer_email = $user->email;
    $order->customer_address = $session->address ?? '';

    $order->shipping_name = $session->name ?? $user->name;
    $order->shipping_phone = $waOrder->phone;
    $order->shipping_address = $session->address ?? '';

    $order->customer_country = 'India';
    $order->shipping_country = 'India';

    $order->currency_sign = '₹';
    $order->currency_name = 'INR';
    $order->currency_value = 1;

    $order->shipping_cost = 0;
    $order->packing_cost = 0;
    $order->tax = 0;

    $order->status = 'pending';
    $order->txnid = $transactionId;

    $order->save();

    try {
        $order->tracks()->create([
            'title' => 'Pending',
            'text' => 'Order placed from WhatsApp'
        ]);
    } catch (\Exception $e) {}

    try {
        $order->notifications()->create();
    } catch (\Exception $e) {}

    DB::table('whatsapp_cart')
        ->where('phone', $waOrder->phone)
        ->delete();
    
    DB::table('whatsapp_sessions')
    ->where('phone', $waOrder->phone)
    ->update([
        'coupon_code' => null,
        'coupon_discount' => 0
    ]);

    return true;
}
  
  
 private function sendCartView($phone)
{
    $items = DB::table('whatsapp_cart')
        ->join('products','products.id','=','whatsapp_cart.product_id')
        ->where('phone',$phone)
        ->select(
            'products.*',
            'whatsapp_cart.qty'
        )
        ->get();

    if ($items->count() == 0) {

        $this->sendMessage(
            $phone,
            "🛒 Your cart is empty"
        );

        return;
    }

    $msg = "🛒 YOUR CART\n\n";

    $total = 0;

    foreach($items as $item){

        $sub = $item->price * $item->qty;

        $total += $sub;

        $msg .=
        "📦 {$item->id}. {$item->name}\n".
        "💰 Price : ₹{$item->price}\n".
        "🔢 Qty : {$item->qty}\n".
        "💵 Amount : ₹{$sub}\n".
        "➕ +{$item->id}\n".
        "➖ -{$item->id}\n\n";
    }

    // Applied Coupon
    $session = DB::table('whatsapp_sessions')
        ->where('phone',$phone)
        ->first();

    $discount = $session->coupon_discount ?? 0;
    $couponCode = $session->coupon_code ?? null;

    $finalTotal = $total - $discount;

    if($finalTotal < 0){
        $finalTotal = 0;
    }

    $msg .= "━━━━━━━━━━━━━━\n";
    $msg .= "💳 Sub Total : ₹{$total}\n";

    if($couponCode){

        $msg .= "🎁 Coupon : {$couponCode}\n";
        $msg .= "💸 Discount : ₹{$discount}\n";
    }

    $msg .= "💰 Payable Amount : ₹{$finalTotal}\n\n";

    // Available Coupons
    $coupons = DB::table('coupons')
        ->where('status',1)
        ->get();

    if ($coupons->count()) {

        $msg .= "🎁 Available Coupons\n";

        foreach($coupons as $coupon){

            $msg .= "👉 {$coupon->code}\n";
        }

      $msg .= "\nApply Coupon:\n";
      $msg .= "Example: coupon ".$coupons->first()->code."\n\n";
    }

    $msg .= "🛍 Type 1 for Products\n";
    $msg .= "💳 Type 3 for Checkout";

    $this->sendMessage($phone,$msg);
}
  
  
  
  private function recalculateCoupon($phone)
{
    $session = DB::table('whatsapp_sessions')
        ->where('phone', $phone)
        ->first();

    if (!$session || empty($session->coupon_code)) {
        return;
    }

    $coupon = DB::table('coupons')
        ->where('code', $session->coupon_code)
        ->where('status', 1)
        ->first();

    if (!$coupon) {
        return;
    }

    $total = 0;

    $items = DB::table('whatsapp_cart')
        ->where('phone', $phone)
        ->get();

    foreach ($items as $item) {

        $product = Product::find($item->product_id);

        if ($product) {
            $total += $product->price * $item->qty;
        }
    }

    if ($coupon->type == 0) {

    $discount = ($total * $coupon->price) / 100;

} else {

    $discount = min($coupon->price, $total);
}

    DB::table('whatsapp_sessions')
        ->where('phone', $phone)
        ->update([
            'coupon_discount' => $discount
        ]);
}

}