<?php

namespace App\Http\Controllers\User;

use App\{
    Models\Order,
    Models\User,
    Models\Product,
    Models\Address,

    Classes\GeniusMailer
};
use Illuminate\Http\Request;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;


class OrderController extends UserBaseController
{

    public function orders()
    {
        $user = $this->user;
        $orders = Order::where('user_id', '=', $user->id)->latest('id')->get();
        return view('user.order.index', compact('user', 'orders'));
    }

    public function ordertrack()
    {
        $user = $this->user;
        return view('user.order-track', compact('user'));
    }

    public function trackload($id)
    {
        $user = $this->user;
        $order = $user->orders()->where('order_number', '=', $id)->first();
        $datas = array('Pending', 'Processing', 'On Delivery', 'Completed');
        return view('load.track-load', compact('order', 'datas'));
    }


    public function order($id)
    {
        $user = $this->user;


        $order = $user->orders()->whereId($id)->firstOrFail();

        $cart = json_decode($order->cart, true);

        $address = $user->address()->where('address_category', '=', 'delivery')->first(); // ya addresses



        return view('user.order.details', compact('user', 'order', 'cart', 'address'));
    }

    public function orderdownload($slug, $id)
    {
        $user = $this->user;
        $order = Order::where('order_number', '=', $slug)->first();
        $prod = Product::findOrFail($id);
        if (!isset($order) || $prod->type == 'Physical' || $order->user_id != $user->id) {
            return redirect()->back();
        }
        return response()->download(public_path('assets/files/' . $prod->file));
    }

    public function orderprint($id)
    {
        $user = $this->user;
        $order = Order::findOrfail($id);
        $cart = json_decode($order->cart, true);
        return view('user.order.print', compact('user', 'order', 'cart'));
    }

    public function trans()
    {
        $id = $_GET['id'];
        $trans = $_GET['tin'];
        $order = Order::findOrFail($id);
        $order->txnid = $trans;
        $order->update();
        $data = $order->txnid;


        return response()->json($data);
    }

    // public function cancel_order_old(Request $request, $id)
    // {

    //     $this->cancelWaybill($id);
    //     $data = Order::findOrFail($id);
    //     if ($data->user_id != 0) {
    //         if ($data->wallet_price != 0) {
    //             $user = User::find($data->user_id);
    //             if ($user) {
    //                 $user->balance = $user->balance + $data->wallet_price;
    //                 $user->save();
    //             }
    //         }
    //     }
    //     $cart = json_decode($data->cart, true);
    //     foreach ($cart['items'] ?? [] as $prod) {
    //         $x = (string)$prod['stock'];
    //         if ($x != null) {
    //             $product = Product::findOrFail($prod['item']['id']);
    //             $product->stock = $product->stock + $prod['qty'];
    //             $product->update();
    //         }
    //     }
    //     // Restore Product Size Qty If Any
    //     foreach ($cart['items'] ?? [] as $prod) {
    //         $x = (string)$prod['size_qty'];
    //         if (!empty($x)) {
    //             $product = Product::findOrFail($prod['item']['id']);
    //             $x = (int)$x;
    //             $temp = $product->size_qty;
    //             $temp[$prod['size_key']] = $x;
    //             $temp1 = implode(',', $temp);
    //             $product->size_qty =  $temp1;
    //             $product->update();
    //         }
    //     }


    //     $mailer = new GeniusMailer();
    //     $htmlBody = View::make('emails.order_cancel', [
    //         'name'       => $data->customer_name,
    //         'headline'   => "Your order $data->order_number has been cancelled as requested.",
    //         'total'   => "$data->pay_amount will be credited back to your original payment method within 5–7 business days.",
    //         'subject'    => "Order $data->order_number has been cancelled",
    //         'cta_label'  => 'Visit Website',
    //         'cta_url'    => url('/')
    //     ])->render();

    //     if (empty($htmlBody)) {
    //         Log::error('❌ Email body empty');
    //     }

    //     $data = [
    //         'to'      => 'vinay.jaisval2015@gmail.com' ?? Auth::user()->email,
    //         'subject' => "Your order $data->order_number  is Declined!",
    //         'body'    => $htmlBody
    //     ];

    //     $mailer->sendCustomMail($data);


    //     $status = "declined";
    //     $data->update(['status' => $status]);
    //     return redirect()->back()->with('message', 'Order Canceled Successfully');
    // }

    public function cancel_order(Request $request, $id)
    {
        $order = Order::findOrFail($id);
       

        $this->cancelWaybill($request, $id);

        // Wallet refund
        if ($order->user_id != 0 && $order->wallet_price != 0) {
            $user = User::find($order->user_id);
            if ($user) {
                $user->balance += $order->wallet_price;
                $user->save();
            }
        }

        // Restore stock

        $cart = json_decode($order->cart, true);
        foreach ($cart['items'] ?? [] as $prod) {
            if (!empty($prod['stock'])) {
                $product = Product::find($prod['item']['id']);
                if ($product) {
                    $product->stock += $prod['qty'];
                    $product->save();
                }
            }
        }

        // Restore size qty
        foreach ($cart['items'] ?? [] as $prod) {
            if (!empty($prod['size_qty'])) {
                $product = Product::find($prod['item']['id']);
                if ($product) {
                    $temp = $product->size_qty;
                    $temp[$prod['size_key']] = (int)$prod['size_qty'];
                    $product->size_qty = implode(',', $temp);
                    $product->save();
                }
            }
        }

        // Update order status
        $order->status = "declined";
        $order->save();

        // Email body
        $mailer = new GeniusMailer();

        $htmlBody = View::make('emails.order_cancel', [
            'name'     => $order->customer_name,
            'headline' => "Your order $order->order_number has been cancelled as requested.",
            'total'    => "$order->pay_amount will be credited back to your original payment method within 5–7 business days.",
            'subject'  => "Order $order->order_number has been cancelled",
            'cta_label' => 'Visit Website',
            'cta_url'  => url('/')
        ])->render();

        if (empty($htmlBody)) {
            Log::error('Email body empty');
        }

        $mailData = [
            'to'      => 'vinay.jaisval2015@gmail.com' ?? Auth::user()->email,
            'subject' => "Your order $order->order_number is Declined!",
            'body'    => $htmlBody
        ];

        $mailer->sendCustomMail($mailData);
        return response()->json([
        'success' => true,
        'message' => 'Order cancelled successfully'
          ]);

        // return redirect()->back()->with('message', 'Order Canceled Successfully');
    }


    public function refund_request(Request $request, $id)
    {
        $user = $this->user;
        $order = Order::where('id', $id)->where('user_id', $user->id)->first();

        if (!$order) {
            return response()->json(['error' => 'Order not found.'], 404);
        }

        if ($order->status === 'refund_requested') {
            return response()->json(['error' => 'A refund request already exists for this order.'], 422);
        }

        if ($order->status !== 'completed') {
            return response()->json(['error' => 'Only delivered orders can be refunded.'], 422);
        }

        $daysLeft = max(0, 5 - (int) $order->updated_at->diffInDays(now()));
        if ($daysLeft <= 0) {
            return response()->json(['error' => 'The 5-day refund window has expired.'], 422);
        }

        $order->update(['status' => 'refund_requested']);

        // Notify admin via email
        try {
            $gs     = \App\Models\Generalsetting::findOrFail(1);
            $mailer = new GeniusMailer();
            $mailer->sendCustomMail([
                'to'      => $gs->from_email,
                'subject' => 'Refund Request — Order #' . $order->order_number,
                'body'    => "Customer " . $user->name . " has requested a refund for order #" . $order->order_number . " (Amount: " . $order->currency_sign . number_format($order->pay_amount, 2) . ").\n\nPlease review it in the admin panel.",
            ]);
        } catch (\Exception $e) {
            // Mail failure should not block the request
        }

        return response()->json(['success' => true, 'message' => 'Refund request submitted. Our team will review it within 1–2 business days.']);
    }

    public function cancelWaybill(Request $request, $id)
    {
       
        $order = Order::find($id);

        // ✅ Validate order
        if (!$order) {
            return response()->json(['error' => 'Order not found'], 404);
        }

        // ✅ Validate waybill
        if (empty($order->third_party_delivery_tracking_id)) {
            return response()->json(['error' => 'Waybill not found'], 400);
        }

        // ✅ Prevent double cancel
        if ($order->shipment_status === 'cancelled') {
            return response()->json(['message' => 'Already cancelled']);
        }

        $client = new Client();

        try {
            $response = $client->post('https://track.delhivery.com/api/p/edit', [
                'headers' => [
                    'Authorization' => 'Token 4fe90509d391df11535a3533bc932022b11f9fd4',
                    'Accept' => 'application/json',
                ],

                // ✅ IMPORTANT FIX
                'form_params' => [
                    'waybill' => $order->third_party_delivery_tracking_id,
                    'cancellation' => 'true',
                ],

                // ⚠️ only for local (fix SSL properly in production)
                'verify' => false,
            ]);

            $content = $response->getBody()->getContents();
            $data = json_decode($content, true);

            Log::info('Delhivery Cancel Response', $data);

            // ✅ Update DB after success
            if (!empty($data['status']) && $data['status'] === true) {

                $order->update([
                    'status' => 'declined',
                    'shipment_status' => 'cancelled',
                    'cancelled_at' => now(),
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Shipment cancelled successfully',
                    'data' => $data
                ]);
            }

            // ❌ API failed
            return response()->json([
                'success' => false,
                'message' => 'Cancel failed',
                'data' => $data
            ], 400);
        } catch (\Exception $e) {

            Log::error('Cancel Error: ' . $e->getMessage());

            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
