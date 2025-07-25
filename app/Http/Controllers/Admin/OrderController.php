<?php

namespace App\Http\Controllers\Admin;

use App\{
    Models\Cart,
    Models\User,
    Models\Order,
    Models\Product,
    Models\OrderTrack,
    Classes\GeniusMailer,
    Models\Generalsetting
};
use App\Models\AffliateBonus;
use App\Models\DeliveryRider;
use App\Models\Package;
use App\Models\PickupPoint;
use App\Models\Rider;
use App\Models\RiderServiceArea;
use App\Models\Shipping;
use Illuminate\Http\Request;
use Datatables;
use Illuminate\Support\Facades\Auth;
use Session;
use GuzzleHttp\Client;
use Log;

class OrderController extends AdminBaseController
{
    //*** GET Request
    public function orders(Request $request)
    {
        if ($request->status == 'pending') {
            return view('admin.order.pending');
        } else if ($request->status == 'processing') {
            return view('admin.order.processing');
        } else if ($request->status == 'completed') {
            return view('admin.order.completed');
        } else if ($request->status == 'declined') {
            return view('admin.order.declined');
        } else {

            return view('admin.order.index');
        }
    }

    public function processing()
    {
        return view('admin.order.processing');
    }

    public function completed()
    {
        return view('admin.order.completed');
    }

    public function declined()
    {
        return view('admin.order.declined');
    }

    public function datatables1($status)
    {
        if ($status == 'pending') {
            $datas = Order::where('status', '=', 'pending')->latest('id')->get();
        } elseif ($status == 'processing') {
            $datas = Order::where('status', '=', 'processing')->latest('id')->get();
        } elseif ($status == 'completed') {
            $datas = Order::where('status', '=', 'completed')->latest('id')->get();
        } elseif ($status == 'declined') {
            $datas = Order::where('status', '=', 'declined')->latest('id')->get();
        } else {


            $datas = Order::latest('id')->get();
          

        }

        //--- Integrating This Collection Into Datatables
        return Datatables::of($datas)
            ->editColumn('id', function (Order $data) {
                $id = '<a href="' . route('admin-order-invoice', $data->id) . '">' . $data->order_number . '</a>';
                return $id;
            })
            ->editColumn('pay_amount', function (Order $data) {
                return \PriceHelper::showOrderCurrencyPrice((($data->pay_amount + $data->wallet_price) * $data->currency_value), $data->currency_sign);
            })
            ->addColumn('action', function (Order $data) {
                $orders = '<a href="javascript:;" data-href="' . route('admin-order-edit', $data->id) . '" class="delivery" data-toggle="modal" data-target="#modal1"><i class="fas fa-dollar-sign"></i> ' . __('Delivery Status') . '</a>';
                return '<div class="godropdown"><button class="go-dropdown-toggle">' . __('Actions') . '<i class="fas fa-chevron-down"></i></button><div class="action-list"><a href="' . route('admin-order-show', $data->id) . '" > <i class="fas fa-eye"></i> ' . __('View Details') . '</a><a href="javascript:;" class="send" data-email="' . $data->customer_email . '" data-toggle="modal" data-target="#vendorform"><i class="fas fa-envelope"></i> ' . __('Send') . '</a><a href="javascript:;" data-href="' . route('admin-order-track', $data->id) . '" class="track" data-toggle="modal" data-target="#modal1"><i class="fas fa-truck"></i> ' . __('Track Order') . '</a>' . $orders . '</div></div>';
            })
            ->rawColumns(['id', 'action'])
            ->toJson(); //--- Returning Json Data To Client Side
    }
    public function datatables($status)
    {
       
        $query = Order::query()
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin('address', 'orders.shipping_address_id', '=', 'address.id')
        ->select(
            'orders.*',
            'address.customer_name as user_name',
            'users.phone as phone',
            'address.phone as shipping_phone'
        );
        if (in_array($status, ['pending', 'processing', 'completed', 'declined'])) {
            $query->where('orders.status', $status);
        }
    
        $datas = $query->latest('id')->get();
    
        return Datatables::of($datas)
            ->editColumn('id', function (Order $data) {
                return '<a href="' . route('admin-order-invoice', $data->id) . '">' . e($data->order_number) . '</a>';
            })
            ->editColumn('pay_amount', function (Order $data) {
                $total = ($data->pay_amount + $data->wallet_price) ;
                return \PriceHelper::showOrderCurrencyPrice($total, $data->currency_sign);
            })
            ->editColumn('created_at', function (Order $data) {
                $created_at = $data->created_at ;
                return $created_at->format('d M Y');
            })
            ->addColumn('phone', function (Order $data) {
                // You can change this logic depending on where phone is stored
                return e( $data->phone);
            })
            ->addColumn('action', function (Order $data) {
                $orders = '<a href="javascript:;" data-href="' . route('admin-order-edit', $data->id) . '" class="delivery" data-toggle="modal" data-target="#modal1">
                    <i class="fas fa-dollar-sign"></i> ' . __('Delivery Status') . '</a>';
    
                return '
                    <div class="godropdown">
                        <button class="go-dropdown-toggle">' . __('Actions') . '<i class="fas fa-chevron-down"></i></button>
                        <div class="action-list">
                            <a href="' . route('admin-order-show', $data->id) . '"><i class="fas fa-eye"></i> ' . __('View Details') . '</a>
                            <a href="javascript:;" class="send" data-email="' . e($data->customer_email) . '" data-toggle="modal" data-target="#vendorform">
                                <i class="fas fa-envelope"></i> ' . __('Send') . '</a>
                            <a href="javascript:;" data-href="' . route('admin-order-track', $data->id) . '" class="track" data-toggle="modal" data-target="#modal1">
                                <i class="fas fa-truck"></i> ' . __('Track Order') . '</a>' 
                                . $orders . '
                        </div>
                    </div>';
            })
            ->rawColumns(['id', 'action'])
            ->toJson();
    }
    
    public function show($id)
    {
        $order = Order::where('orders.id', $id)
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('address as shipping', 'orders.shipping_address_id', '=', 'shipping.id')
            ->leftJoin('address as billing', 'orders.billing_address_id', '=', 'billing.id')
            ->select(
                'orders.*',
                'users.name as user_name',
                'users.phone as user_phone',
                'shipping.phone as shipping_phone',

                'shipping.customer_name as shipping_customer_name',
                'shipping.zip as shipping_zip',
                'shipping.email as shipping_email',
                'shipping.country_id as shipping_country_id',
                'shipping.state_id as shipping_state_id',
                'shipping.city as shipping_city',
                'shipping.flat_no as shipping_flat_no',
                'shipping.landmark as shipping_landmark',
                'shipping.address as shipping_address',
                


                'billing.customer_name as customer_name',
                'billing.phone as billing_phone',
                'billing.zip as billing_zip',
                'billing.email as billing_email',
                'billing.country_id as billing_country_id',
                'billing.state_id as billing_state_id',
                'billing.city as billing_city',
                'billing.flat_no as billing_flat_no',
                'billing.landmark as billing_landmark',
                'billing.address as billing_address',
                'billing.same_address_shipping as same_address_shipping'



            )
            ->firstOrFail();

        $cart = json_decode($order->cart, true);
        return view('admin.order.details', compact('order', 'cart'));
    }

    public function invoice($id)
    {
        $order = Order::where('orders.id', $id)
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('address as shipping', 'orders.shipping_address_id', '=', 'shipping.id')
            ->leftJoin('address as billing', 'orders.billing_address_id', '=', 'billing.id')
            ->select(
                'orders.*',
                'users.name as user_name',
                'users.phone as user_phone',
                'shipping.phone as shipping_phone',

                'shipping.customer_name as shipping_customer_name',
                'shipping.zip as shipping_zip',
                'shipping.email as shipping_email',
                'shipping.country_id as shipping_country_id',
                'shipping.state_id as shipping_state_id',
                'shipping.city as shipping_city',
                'shipping.flat_no as shipping_flat_no',
                'shipping.landmark as shipping_landmark',
                'shipping.address as shipping_address',
                


                'billing.customer_name as customer_name',
                'billing.phone as billing_phone',
                'billing.zip as billing_zip',
                'billing.email as billing_email',
                'billing.country_id as billing_country_id',
                'billing.state_id as billing_state_id',
                'billing.city as billing_city',
                'billing.flat_no as billing_flat_no',
                'billing.landmark as billing_landmark',
                'billing.address as billing_address',
                'billing.same_address_shipping as same_address_shipping'



            )
            ->firstOrFail();
        $cart = json_decode($order->cart, true);
        return view('admin.order.invoice', compact('order', 'cart'));
    }

    public function emailsub(Request $request)
    {
        $gs = Generalsetting::findOrFail(1);
        if ($gs->is_smtp == 1) {
            $data = [
                'to' => $request->to,
                'subject' => $request->subject,
                'body' => $request->message,
            ];

            $mailer = new GeniusMailer();
            $mailer->sendCustomMail($data);
        } else {
            $data = 0;
            $headers = "From: " . $gs->from_name . "<" . $gs->from_email . ">";
            $mail = mail($request->to, $request->subject, $request->message, $headers);
            if ($mail) {
                $data = 1;
            }
        }

        return response()->json($data);
    }

    public function printpage($id)
    {
        $order = Order::where('orders.id', $id)
        ->leftJoin('users', 'orders.user_id', '=', 'users.id')
        ->leftJoin('address as shipping', 'orders.shipping_address_id', '=', 'shipping.id')
        ->leftJoin('address as billing', 'orders.billing_address_id', '=', 'billing.id')
        ->select(
            'orders.*',
            'users.name as user_name',
            'users.phone as user_phone',
            'shipping.phone as shipping_phone',

            'shipping.customer_name as shipping_customer_name',
            'shipping.zip as shipping_zip',
            'shipping.email as shipping_email',
            'shipping.country_id as shipping_country_id',
            'shipping.state_id as shipping_state_id',
            'shipping.city as shipping_city',
            'shipping.flat_no as shipping_flat_no',
            'shipping.landmark as shipping_landmark',
            'shipping.address as shipping_address',
            


            'billing.customer_name as customer_name',
            'billing.phone as billing_phone',
            'billing.zip as billing_zip',
            'billing.email as billing_email',
            'billing.country_id as billing_country_id',
            'billing.state_id as billing_state_id',
            'billing.city as billing_city',
            'billing.flat_no as billing_flat_no',
            'billing.landmark as billing_landmark',
            'billing.address as billing_address',
            'billing.same_address_shipping as same_address_shipping'



        )
        ->firstOrFail();
        $cart = json_decode($order->cart, true);
        return view('admin.order.print', compact('order', 'cart'));
    }

    public function license(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $cart = json_decode($order->cart, true);
        $cart['items'][$request->license_key]['license'] = $request->license;
        $new_cart = json_encode($cart);
        $order->cart = $new_cart;
        $order->update();
        $msg = __('Successfully Changed The License Key.');
        return redirect()->back()->with('license', $msg);
    }

    public function edit($id)
    {
        $data = Order::find($id);
        return view('admin.order.delivery', compact('data'));
    }

    //*** POST Request
    // public function update(Request $request, $id)
    // {
    //     //--- Logic Section
    //     $data = Order::findOrFail($id);
    //     $input = $request->all();
    //     if ($request->has('status')) {
    //         if ($data->status == "completed") {
    //             $input['status'] = "completed";
    //             $data->update($input);
    //             $msg = __('Status Updated Successfully.');
    //             return response()->json($msg);
    //         } 
    //         else {
    //             if ($input['status'] == "completed") {
    //                 if ($data->vendor_ids) {
    //                     $vendor_ids = json_decode($data->vendor_ids, true);
    //                     foreach ($vendor_ids as $vendor) {
    //                         $deliveryRider = DeliveryRider::where('order_id', $data->id)->where('vendor_id', $vendor)->first();
    //                         if ($deliveryRider) {
    //                             $rider = Rider::findOrFail($deliveryRider->rider_id);
    //                             $service_area = RiderServiceArea::findOrFail($deliveryRider->service_area_id);
    //                             $rider->balance += $service_area->price;
    //                             $rider->update();
    //                         }
    //                     }
    //                 }
    //                 foreach ($data->vendororders as $vorder) {
    //                     if ($uprice = User::find($vorder->user_id)) {
    //                         $uprice->current_balance = ($uprice->current_balance ?? 0) + ($vorder->price ?? 0);

    //                         $vorder->status = 'completed';
    //                         $vorder->update();

    //                         $uprice->update();
    //                         $uprice->update();
    //                     }
    //                 }

    //                 if ($data->is_shipping == 1) {
    //                     $vendor_ids = json_decode($data->vendor_ids, true);
    //                     $shipping_ids = json_decode($data->vendor_shipping_id, true);
    //                     $packaging_ids = json_decode($data->vendor_packing_id, true);

    //                     foreach ($vendor_ids as $vendor) {
    //                         $vendor = User::findOrFail($vendor);
    //                         if ($vendor) {
    //                             $shpping_id = $shipping_ids[$vendor->id];
    //                             $packaging_id = $packaging_ids[$vendor->id];
    //                             $shipping = Shipping::findOrFail($shpping_id);
    //                             $packaging = Package::findOrFail($packaging_id);
    //                             $extra = 0;
    //                             if ($shipping) {
    //                                 $extra += $shipping->price;
    //                             }
    //                             if ($packaging) {
    //                                 $extra += $packaging->price;
    //                             }
    //                             $vendor->current_balance = $vendor->current_balance + $extra;
    //                             if ($data->method == 'Cash On Delivery') {
    //                                 $vendor->admin_commission += $extra;
    //                             }
    //                             $vendor->update();
    //                         }
    //                     }
    //                 }

    //                 if (User::where('id', $data->affilate_user)->exists()) {
    //                     $user_referred_by = User::where('id', $data->affilate_user)->pluck('reffered_by');
    //                     if (count($user_referred_by) > 0) {
    //                         $sub_user_reffered_by = User::where('reffered_by', $user_referred_by)->pluck('id');
    //                         $product_orders = Order::whereIn('user_id', $sub_user_reffered_by)->where('status', 'completed')->pluck('user_id')->unique();
    //                         if (count($product_orders) > 1) {
    //                             $auser = User::where('id', $user_referred_by)->first();
    //                             $auser->affilate_income += $data->affilate_charge;
    //                             $auser->update();
    //                             $affiliate_bonus = new AffliateBonus();
    //                             $affiliate_bonus->refer_id = $auser->id;
    //                             $affiliate_bonus->bonus =  $data->affilate_charge;
    //                             $affiliate_bonus->type = 'Order';
    //                             $affiliate_bonus->user_id = $data->user_id;
    //                             $affiliate_bonus->save();
    //                         }
    //                     }
    //                 }



    //                 if ($data->affilate_users != null) {
    //                     $ausers = json_decode($data->affilate_users, true);

    //                     if (is_array($ausers)) {
    //                         foreach ($ausers as $auser) {
    //                             $user = User::find($auser['user_id']);
    //                             if ($user) {
    //                                 $user->affilate_income += $auser['charge'];
    //                                 $user->update();
    //                             }
    //                         }
    //                     } else {
    //                         // Optional: Log or handle unexpected data format
    //                         \Log::warning('Invalid affiliate_users format:', ['value' => $data->affilate_users]);
    //                     }
    //                 }

                    
    //             }
    //             if ($input['status'] == "declined") {
                   
    //                 if ($data->user_id != 0) {
    //                     if ($data->wallet_price != 0) {
    //                         $user = User::find($data->user_id);
    //                         if ($user) {
    //                             $user->balance = $user->balance + $data->wallet_price;
    //                             $user->save();
    //                         }
    //                     }
    //                 }

    //                 $cart = json_decode($data->cart, true);

    //                 // Restore Product Stock If Any
    //                 foreach ($cart['items'] ?? [] as $prod) {
    //                     $x = (string)$prod['stock'];
    //                     if ($x != null) {
    //                         $product = Product::findOrFail($prod['item']['id']);
    //                         $product->stock = $product->stock + $prod['qty'];
    //                         $product->update();
    //                     }
    //                 }

    //                 // Restore Product Size Qty If Any
    //                 foreach ($cart['items'] ?? [] as $prod) {
    //                     $x = (string)$prod['size_qty'];
    //                     if (!empty($x)) {
    //                         $product = Product::findOrFail($prod['item']['id']);
    //                         $x = (int)$x;
    //                         $temp = $product->size_qty;
    //                         $temp[$prod['size_key']] = $x;
    //                         $temp1 = implode(',', $temp);
    //                         $product->size_qty =  $temp1;
    //                         $product->update();
    //                     }
    //                 }

    //                 $maildata = [
    //                     'to' => $data->customer_email,
    //                     'subject' => 'Your order ' . $data->order_number . ' is Declined!',
    //                     'body' => "Hello " . $data->customer_name . "," . "\n We are sorry for the inconvenience caused. We are looking forward to your next visit.",
    //                 ];
    //                 $mailer = new GeniusMailer();
    //                 $mailer->sendCustomMail($maildata);
    //             }

    //             $data->update($input);
             
    //             if (User::where('id', $data->user_id)->exists()) {
    //                 $orderCount = Order::where('user_id', $data->user_id)->where('status', 'completed')->count();
    //                 if ($orderCount == 1) {
    //                     $user = User::where('id', $data->user_id)->select('reffered_by')->first();
    //                     if ($user && $user->reffered_by) {
    //                         $referrer = User::find($user->reffered_by);
    //                         if ($referrer) {
    //                             $referrer->referral_income += 250;
    //                             $referrer->reffered_times += 1;

    //                             $referrer->save();
    //                         }
    //                     }
    //                 }
    //             }
               
    //             if (User::where('id', $data->user_id)->exists()) {
    //                 $orderCount = Order::where('user_id', $data->user_id)->where('status', 'completed')->count();
    //                 if ($orderCount == 1) {
    //                     $user = User::where('id', $data->user_id)->select('affiliated_by')->first();
    //                     if ($user && $user->affiliated_by) {
    //                         $affilated = User::find($user->affiliated_by);
                        
    //                         if ($affilated) {
    //                             $total = $data->pay_amount;
    //                             $affilated->affilate_income += ($total / 100) * 10;
    //                             $affilated->save();
    //                             $sub_user = User::where('id', $affilated->id)->select('affiliated_by')->first();
    //                             if ($sub_user && $sub_user->affiliated_by) {
    //                                 $affiliated = User::find($sub_user->affiliated_by);
    //                                 if ($affiliated) {
    //                                     $affiliated->affilate_income += ($total / 100) * 5;
    //                                     $affiliated->save();
    //                                 }
    //                             }
    //                         }
    //                     }
    //                 }
    //             }
    //             if ($request->track_text) {
    //                 $title = ucwords($request->status);
    //                 $ck = OrderTrack::where('order_id', '=', $id)->where('title', '=', $title)->first();
    //                 if ($ck) {
    //                     $ck->order_id = $id;
    //                     $ck->title = $title;
    //                     $ck->text = $request->track_text;
    //                     $ck->update();
    //                 } else {
    //                     $data = new OrderTrack;
    //                     $data->order_id = $id;
    //                     $data->title = $title;
    //                     $data->text = $request->track_text;
    //                     $data->save();
    //                 }
    //             }
    //             $msg = __('Status Updated Successfully.');
    //             return response()->json($msg);
    //         }
    //     }

    //     $data->update($input);

    //     $msg = __('Data Updated Successfully.');
    //     return redirect()->back()->with('success', $msg);
    // }
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $input = $request->all();
    
        // Handle status update
        if ($request->has('status')) {
            $newStatus = $input['status'];
            $currentStatus = $order->status;
   
            // Prevent status change if already completed
            // if ($currentStatus === 'completed') {
            //     $input['status'] = 'completed'; // Force keep it as completed
            //     $order->update($input);
            //     return response()->json(__('Status already completed and cannot be changed.'));
            // }
    
            // Handle if status is being updated to 'completed'
            if ($newStatus === 'completed') {
                // 1. Rider payout
                // if ($order->vendor_ids) {
                //     $vendorIds = json_decode($order->vendor_ids, true);
                //     foreach ($vendorIds as $vendorId) {
                //         $deliveryRider = DeliveryRider::where('order_id', $order->id)->where('vendor_id', $vendorId)->first();
                //         if ($deliveryRider) {
                //             $rider = Rider::find($deliveryRider->rider_id);
                //             $serviceArea = RiderServiceArea::find($deliveryRider->service_area_id);
                //             if ($rider && $serviceArea) {
                //                 $rider->balance += $serviceArea->price;
                //                 $rider->update();
                //             }
                //         }
                //     }
                // }
    
                // 2. Vendor order update and payout
                // foreach ($order->vendororders as $vorder) {
                //     $user = User::find($vorder->user_id);
                //     if ($user) {
                //         $user->current_balance = ($user->current_balance ?? 0) + ($vorder->price ?? 0);
                //         $user->update();
    
                //         $vorder->status = 'completed';
                //         $vorder->update();
                //     }
                // }
    
                // 3. Shipping and packaging fees
                // if ($order->is_shipping == 1) {
                //     $vendorIds = json_decode($order->vendor_ids, true);
                //     $shippingIds = json_decode($order->vendor_shipping_id, true);
                //     $packagingIds = json_decode($order->vendor_packing_id, true);
    
                //     foreach ($vendorIds as $vendorId) {
                //         $vendor = User::find($vendorId);
                //         if ($vendor) {
                //             $shipping = Shipping::find($shippingIds[$vendorId] ?? null);
                //             $packaging = Package::find($packagingIds[$vendorId] ?? null);
    
                //             $extra = 0;
                //             if ($shipping) $extra += $shipping->price;
                //             if ($packaging) $extra += $packaging->price;
    
                //             $vendor->current_balance += $extra;
                //             if ($order->method === 'Cash On Delivery') {
                //                 $vendor->admin_commission += $extra;
                //             }
                //             $vendor->update();
                //         }
                //     }
                // }
    
                // 4. Affiliate bonuses
               
                if ($order->affilate_user) {
                    $userRefBy = User::where('id', $order->affilate_user)->pluck('reffered_by');
                    if ($userRefBy->count() > 0) {
                        $subUsers = User::where('reffered_by', $userRefBy)->pluck('id');
                        $productOrders = Order::whereIn('user_id', $subUsers)->where('status', 'completed')->pluck('user_id')->unique();
                        if ($productOrders->count() > 1) {
                            $auser = User::find($userRefBy);
                            if ($auser) {
                                $auser->affilate_income += $order->affilate_charge;
                                $auser->update();
    
                                $bonus = new AffliateBonus();
                                $bonus->refer_id = $auser->id;
                                $bonus->bonus = $order->affilate_charge;
                                $bonus->type = 'Order';
                                $bonus->user_id = $order->user_id;
                                $bonus->save();
                            }
                        }
                    }
                }
    
                // 5. Multiple affiliate users
                if (!empty($order->affilate_users)) {
                    $ausers = json_decode($order->affilate_users, true);
                    if (is_array($ausers)) {
                        foreach ($ausers as $auser) {
                            $user = User::find($auser['user_id']);
                            if ($user) {
                                $user->affilate_income += $auser['charge'];
                                $user->update();
                            }
                        }
                    } else {
                        \Log::warning('Invalid affiliate_users format', ['value' => $order->affilate_users]);
                    }
                }
            }
    
            // Handle if status is being updated to 'declined'
            elseif ($newStatus === 'declined') {
                if ($order->user_id != 0 && $order->wallet_price != 0) {
                    $user = User::find($order->user_id);
                    if ($user) {
                        $user->balance += $order->wallet_price;
                        $user->save();
                    }
                }
    
                $cart = json_decode($order->cart, true);
                foreach ($cart['items'] ?? [] as $prod) {
                    $product = Product::find($prod['item']['id']);
                    if ($product) {
                        $product->stock += $prod['qty'] ?? 0;
                        $product->update();
    
                        if (!empty($prod['size_qty']) && isset($prod['size_key'])) {
                            $temp = $product->size_qty;
                            $temp[$prod['size_key']] = (int)$prod['size_qty'];
                            $product->size_qty = implode(',', $temp);
                            $product->update();
                        }
                    }
                }
    
                // Send email
                $mailData = [
                    'to' => $order->customer_email,
                    'subject' => 'Your order ' . $order->order_number . ' is Declined!',
                    'body' => "Hello " . $order->customer_name . ",\n We are sorry for the inconvenience caused. We are looking forward to your next visit.",
                ];
                $mailer = new GeniusMailer();
                $mailer->sendCustomMail($mailData);
            }
    
            // Save new status
            $order->update($input);
    
            // Track order status if provided
            if ($request->track_text) {
                $title = ucwords($newStatus);
                $track = OrderTrack::firstOrNew(['order_id' => $id, 'title' => $title]);
                $track->text = $request->track_text;
                $track->save();
            }
    
            // Referral bonus logic
            
            if (User::where('id', $order->user_id)->exists()) {
                $orderCount = Order::where('user_id', $order->user_id)->where('status', 'completed')->count();
                if ($orderCount == 1) {
                    $user = User::find($order->user_id);
                    if ($user && $user->reffered_by) {
                        $referrer = User::find($user->reffered_by);
                        // dd($referrer);
                        if ($referrer) {
                            $referrer->referral_income += 250;
                            $referrer->current_balance += 250;
                            $referrer->reffered_times += 1;
                            $referrer->save();
                        }
                    }
    
                    if ($user && $user->affiliated_by) {
                       
                        $affiliated = User::find($user->affiliated_by);
                       
                        if ($affiliated) {
                            $total = $order->pay_amount;
                            $affiliated->affilate_income += ($total / 100) * 8;
                            $affiliated->current_balance += ($total / 100) * 8;
                            $affiliated->save();
    
                            $sub = User::find($affiliated->affiliated_by);
                            if ($sub) {
                                $sub->affilate_income += ($total / 100) * 5;
                                $sub->current_balance += ($total / 100) * 5;
                                $sub->save();
                            }
                        }
                    }
                }
            }
    
            return response()->json(__('Status Updated Successfully.'));
        }
    
        // Non-status update logic
        $order->update($input);
        return redirect()->back()->with('success', __('Data Updated Successfully.'));
    }
    

    public function product_submit(Request $request)
    {

        $sku = $request->sku;
        $product = Product::whereUserId($request->vendor_id)->whereStatus(1)->where('sku', $sku)->first();
        $data = array();
        if (!$product) {
            $data[0] = false;
            $data[1] = __('No Product Found');
        } else {
            $data[0] = true;
            $data[1] = $product->id;
        }
        return response()->json($data);
    }

    public function product_show($id)
    {
        $data['productt'] = Product::find($id);
        $data['curr'] = $this->curr;
        return view('admin.order.add-product', $data);
    }

    public function addcart($id)
    {
        $order = Order::find($id);
        $id = $_GET['id'];
        $qty = $_GET['qty'];
        $size = str_replace(' ', '-', $_GET['size']);
        $color = $_GET['color'];
        $size_qty = $_GET['size_qty'];
        $size_price = (float)$_GET['size_price'];
        $size_key = $_GET['size_key'];
        $affilate_user = isset($_GET['affilate_user']) ? $_GET['affilate_user'] : '0';
        $keys =  $_GET['keys'];
        $keys = explode(",", $keys);
        $values = $_GET['values'];
        $values = explode(",", $values);
        $prices = $_GET['prices'];
        $prices = explode(",", $prices);
        $keys = $keys == "" ? '' : implode(',', $keys);
        $values = $values == "" ? '' : implode(',', $values);
        $size_price = ($size_price / $order->currency_value);
        $prod = Product::where('id', '=', $id)->first(['id', 'user_id', 'slug', 'name', 'photo', 'size', 'size_qty', 'size_price', 'color', 'price', 'stock', 'type', 'file', 'link', 'license', 'license_qty', 'measure', 'whole_sell_qty', 'whole_sell_discount', 'attributes', 'minimum_qty']);

        if ($prod->user_id != 0) {
            $prc = $prod->price + $this->gs->fixed_commission + ($prod->price / 100) * $this->gs->percentage_commission;
            $prod->price = round($prc, 2);
        }
        if (!empty($prices)) {
            if (!empty($prices[0])) {
                foreach ($prices as $data) {
                    $prod->price += ($data / $order->currency_value);
                }
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

        if (empty($color)) {
            if (!empty($prod->color)) {
                $color = $prod->color[0];
            }
        }

        $color = str_replace('#', '', $color);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        if (!empty($cart->items)) {
            if (!empty($cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)])) {
                $minimum_qty = (int)$prod->minimum_qty;
                if ($cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'] < $minimum_qty) {
                    return redirect()->back()->with('unsuccess', __('Minimum Quantity is:') . ' ' . $prod->minimum_qty);
                }
            } else {
                if ($prod->minimum_qty != null) {
                    $minimum_qty = (int)$prod->minimum_qty;
                    if ($qty < $minimum_qty) {
                        return redirect()->back()->with('unsuccess', __('Minimum Quantity is:') . ' ' . $prod->minimum_qty);
                    }
                }
            }
        } else {
            $minimum_qty = (int)$prod->minimum_qty;
            if ($prod->minimum_qty != null) {
                if ($qty < $minimum_qty) {
                    return redirect()->back()->with('unsuccess', __('Minimum Quantity is:') . ' ' . $prod->minimum_qty);
                }
            }
        }

        $cart->addnum($prod, $prod->id, $qty, $size, $color, $size_qty, $size_price, $size_key, $keys, $values, $affilate_user);
        if ($cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['dp'] == 1) {
            return redirect()->back()->with('unsuccess', __('This item is already in the cart.'));
        }
        if ($cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['stock'] < 0) {
            return redirect()->back()->with('unsuccess', __('Out Of Stock.'));
        }
        if ($cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['size_qty']) {
            if ($cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'] > $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['size_qty']) {
                return redirect()->back()->with('unsuccess', __('Out Of Stock.'));
            }
        }

        $cart->totalPrice = 0;
        foreach ($cart->items as $data)
            $cart->totalPrice += $data['price'];
        $o_cart = json_decode($order->cart, true);

        $order->totalQty = $order->totalQty + $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'];
        $order->pay_amount = $order->pay_amount + $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['price'];

        $prev_qty = 0;
        $prev_price = 0;

        if (!empty($o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)])) {
            $prev_qty = $o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'];
            $prev_price = $o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['price'];
        }

        $prev_qty += $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'];
        $prev_price += $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['price'];

        $o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)] = $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)];
        $o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'] = $prev_qty;
        $o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['price'] = $prev_price;

        $order->cart = json_encode($o_cart);

        $order->update();
        return redirect()->back()->with('success', __('Successfully Added To Cart.'));
    }


    public function product_edit($id, $itemid, $orderid)
    {

        $product = Product::find($itemid);
        $order = Order::find($orderid);
        $cart = json_decode($order->cart, true);
        $data['productt'] = $product;
        $data['item_id'] = $id;
        $data['prod'] = $id;
        $data['order'] = $order;
        $data['item'] = $cart['items'][$id];
        $data['curr'] = $this->curr;

        return view('admin.order.edit-product', $data);
    }


    public function updatecart($id)
    {
        $order = Order::find($id);
       
        $id = $_GET['id'];
        $qty = $_GET['qty'];
        $size = str_replace(' ', '-', $_GET['size']);
        $color = $_GET['color'];
        $size_qty = $_GET['size_qty'];
        $size_price = (float)$_GET['size_price'];
        $size_key = $_GET['size_key'];
        $affilate_user = isset($_GET['affilate_user']) ? $_GET['affilate_user'] : '0';
        $keys =  $_GET['keys'];
        $keys = explode(",", $keys);
        $values = $_GET['values'];
        $values = explode(",", $values);
        $prices = $_GET['prices'];
        $prices = explode(",", $prices);
        $keys = $keys == "" ? '' : implode(',', $keys);
        $values = $values == "" ? '' : implode(',', $values);

        $item_id = $_GET['item_id'];


        $size_price = ($size_price);
        $prod = Product::where('id', '=', $id)->first(['id', 'user_id', 'slug', 'name', 'photo', 'size', 'size_qty', 'size_price', 'color', 'price', 'stock', 'type', 'file', 'link', 'license', 'license_qty', 'measure', 'whole_sell_qty', 'whole_sell_discount', 'attributes', 'minimum_qty']);

        if ($prod->user_id != 0) {
            $prc = $prod->price + $this->gs->fixed_commission + ($prod->price / 100) * $this->gs->percentage_commission;
            $prod->price = round($prc, 2);
        }
        if (!empty($prices)) {
            if (!empty($prices[0])) {
                foreach ($prices as $data) {
                    $prod->price += ($data / $order->currency_value);
                }
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

        if (empty($color)) {
            if (!empty($prod->color)) {
                $color = $prod->color[0];
            }
        }
        $color = str_replace('#', '', $color);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;

        $cart = Cart::restoreCart($oldCart);
        if (!empty($cart->items)) {
            if (!empty($cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)])) {
                $minimum_qty = (int)$prod->minimum_qty;
                if ($cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'] < $minimum_qty) {
                    return redirect()->back()->with('unsuccess', __('Minimum Quantity is:') . ' ' . $prod->minimum_qty);
                }
            } else {
                if ($prod->minimum_qty != null) {
                    $minimum_qty = (int)$prod->minimum_qty;
                    if ($qty < $minimum_qty) {
                        return redirect()->back()->with('unsuccess', __('Minimum Quantity is:') . ' ' . $prod->minimum_qty);
                    }
                }
            }
        } else {
            $minimum_qty = (int)$prod->minimum_qty;
            if ($prod->minimum_qty != null) {
                if ($qty < $minimum_qty) {
                    return redirect()->back()->with('unsuccess', __('Minimum Quantity is:') . ' ' . $prod->minimum_qty);
                }
            }
        }

        $cart->addnum($prod, $prod->id, $qty, $size, $color, $size_qty, $size_price, $size_key, $keys, $values, $affilate_user);
        if ($cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['dp'] == 1) {
            return redirect()->back()->with('unsuccess', __('This item is already in the cart.'));
        }
        if ($cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['stock'] < 0) {
            return redirect()->back()->with('unsuccess', __('Out Of Stock.'));
        }
        if ($cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['size_qty']) {
            if ($cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'] > $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['size_qty']) {
                return redirect()->back()->with('unsuccess', __('Out Of Stock.'));
            }
        }

        $cart->totalPrice = 0;
        foreach ($cart->items as $data)
            $cart->totalPrice += $data['price'];
        $o_cart = json_decode($order->cart, true);

        if (!empty($o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)])) {

            $cart_qty = $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'];
            $cart_price =  $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['price'];

            $prev_qty = $o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'];
            $prev_price = $o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['price'];

            $temp_qty = 0;
            $temp_price = 0;

            if ($o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'] < $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty']) {

                $temp_qty = $cart_qty - $prev_qty;
                $temp_price = $cart_price - $prev_price;

                $order->totalQty += $temp_qty;
                $order->pay_amount += $temp_price;
                $prev_qty += $temp_qty;
                $prev_price += $temp_price;
            } elseif ($o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'] > $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty']) {

                $temp_qty = $prev_qty - $cart_qty;
                $temp_price = $prev_price - $cart_price;

                $order->totalQty -= $temp_qty;
                $order->pay_amount -= $temp_price;
                $prev_qty -= $temp_qty;
                $prev_price -= $temp_price;
            }
        } else {

            $order->totalQty -= $o_cart['items'][$item_id]['qty'];

            $order->pay_amount -= $o_cart['items'][$item_id]['price'];

            unset($o_cart['items'][$item_id]);



            $order->totalQty = $order->totalQty + $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'];
            $order->pay_amount = $order->pay_amount + $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['price'];

            $prev_qty = 0;
            $prev_price = 0;

            if (!empty($o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)])) {
                $prev_qty = $o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'];
                $prev_price = $o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['price'];
            }

            $prev_qty += $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'];
            $prev_price += $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['price'];
        }

        $o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)] = $cart->items[$id . $size . $color . str_replace(str_split(' ,'), '', $values)];
        $o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['qty'] = $prev_qty;
        $o_cart['items'][$id . $size . $color . str_replace(str_split(' ,'), '', $values)]['price'] = $prev_price;

        $order->cart = json_encode($o_cart);

        $order->update();
        return redirect()->back()->with('success', __('Successfully Updated The Cart.'));
    }


    public function product_delete($id, $orderid)
    {


        $order = Order::find($orderid);
        $cart = json_decode($order->cart, true);

        $order->totalQty = $order->totalQty - $cart['items'][$id]['qty'];
        $order->pay_amount = $order->pay_amount - $cart['items'][$id]['price'];
        unset($cart['items'][$id]);
        $order->cart = json_encode($cart);

        $order->update();


        return redirect()->back()->with('success', __('Successfully Deleted From The Cart.'));
    }


    public function cancelWaybill(Request $request, $id)
    {

       

        $order = Order::where('id', $id)->first();

        $client = new Client();
        $url = 'https://track.delhivery.com/api/p/edit';
        $headers = [
            'Authorization' => 'Token 4fe90509d391df11535a3533bc932022b11f9fd4',  // Replace with your actual token
            'Content-Type' => 'application/json',
        ];
        $body = [
            'waybill' => $order->third_party_delivery_tracking_id,
            'cancellation' => 'true',
        ];
        try {
            $response = $client->post($url, [
                'headers' => $headers,
                'json' => $body,
            ]);
            $statusCode = $response->getStatusCode();
            $content = $response->getBody()->getContents();
            Log::info($content);
            // Handle the response as needed
            return response()->json([
                'status_code' => $statusCode,
                'content' => json_decode($content),
            ]);
        } catch (\Exception $e) {
            Log::info($e->getMessage());
            // Handle any errors that occur during the request
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
