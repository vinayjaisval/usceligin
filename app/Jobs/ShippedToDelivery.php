<?php
namespace App\Jobs;

use App\Models\Cart;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use GuzzleHttp\Client;
use App\Models\ShippingAddress;
use App\Models\Shop;
use App\Utils\Helpers;
use Illuminate\Support\Facades\Log;
use DB;
class ShippedToDelivery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $input;
    /**
     * Create a new job instance.
     */
    public function __construct($input)
    {
        $this->input = $input;
        
    }
    /**
     * Execute the job.
     */
    // public function handle(): void
    // {
    //     $order = Order::where('status', 'pending')->where('order_number', $this->input)->get();
        
    //     foreach ($order as $key => $value) {
    //         dd($value);
    //         $value1 = Order::where('id', $value->id)->first();
    //         $data=$value1->cart;
    //         $array = json_decode($data, true);
        
    //         foreach($array['items'] as $val){

    //           $data_array= $val['item'];

    //          // foreach($order_details as $key1 => $value1){
                
    //             $product = Product::where(['id' => $data_array['id']])->first()->toArray();
    //             //  dd($product);
    //             // $total_cod_price = $value1->price*$value1->qty;
    //             $total_cod_price = $value1->pay_amount;
    //             // dd($total_cod_price);
    //             $totaltex = $value1->tax;
    //             $totaldiscount = $value1->coupon_discount;
    //             $totalshipping = $value1->shipping_cost;

    //             // dd($totalshipping);

    //             // $total_cod =  Helpers::delevery_currency_converter(($total_cod_price + $totaltex + $totalshipping-$totaldiscount));
               
    //             // $total_cod=$total_cod_price + $totaltex + $totalshipping-$totaldiscount;
                
    //              $total_cod= $total_cod_price - $totaldiscount;
                
    //             // dd($total_cod);
    //             $client = new Client();
    //             $url = 'https://track.delhivery.com/api/cmu/create.json';
    //             $token = '4fe90509d391df11535a3533bc932022b11f9fd4';
    //             $data1 = [
    //                 'shipments' => [
    //                     [
    //                         'name' => $value->customer_name,
    //                         'add' => $value->shipping_address ?? $value->customer_address,
    //                         'pin' => $value->customer_zip ?? $value->shipping_zip,
    //                         'city' => $value->customer_city ?? $value->shipping_city,
    //                         // 'state' => $value->shipping_address)->state,
    //                         'country' => $value->customer_country ?? $value->shipping_country,
    //                         'phone' => $value->customer_phone ?? $value->shipping_phone,
    //                         'order' => $value1['order_number'],
    //                         'payment_mode' => $value['method'],
    //                         'return_pin' => '',
    //                         'return_city' => '',
    //                         'return_phone' => '',
    //                         'return_add' => '',
    //                         'return_state' => '',
    //                         'return_country' => '',
    //                         'products_desc' => $product['name'],
    //                         'hsn_code' => $product['sku'],
    //                         'cod_amount' => $total_cod,
    //                         'order_date' => now(),
    //                         'total_amount' => $total_cod,
                           
    //                         'seller_inv' => '',
    //                         'quantity' => $value1['qty'],
    //                         'waybill' => '',
    //                         'shipment_width' => $product['weight'],
    //                         'shipment_height' => $product['weight'],
    //                         'weight' => $product['weight'],
    //                         'seller_gst_tin' => '',
    //                         'shipping_mode' => 'Surface',
    //                         // 'address_type' => Shop::where(['seller_id' => $value1['seller_id']])->first()->address_type,
    //                     ]
    //                 ],
                    
    //                 'pickup_location' => [
    //                     'name' => "Celigin Global Pvt Ltd",
    //                     'add' =>"3rd floor, A-78, Block A, Sector 4, Noida, Uttar Pradesh 201301",
    //                     'city' =>"Noida",
    //                     'pin_code' =>"201301",
    //                     'country' =>"india",
    //                     'phone' =>"9667054665",
    //                     ]
    //             ];

             
    //             try {
    //                 $response = $client->post($url, [
    //                     'headers' => [
    //                         'Authorization' => "Token $token",
    //                         'Accept'        => 'application/json',
    //                     ],
    //                     'form_params' => [
    //                         'format' => 'json',
    //                         'data'   => json_encode($data1)
    //                     ],
    //                     'verify' => false,
    //                 ]);
    //                 $responseBody = $response->getBody()->getContents();
    //                 dd($responseBody);
    //                 Log::info('onedelhivery order generate for awb ' . $responseBody);
    //                 $returnData =  json_decode($responseBody);
    //                 Log::info('create response================> ' .json_encode($data1));
    //                 Log::info('onedelhivery order generate for order id ' . $value1['order_number']);
    //                 DB::table('orders')->where('order_number', $value1['order_number'])
    //                     ->update([
    //                         'status' => "pending",
    //                         'third_party_delivery_tracking_id' => $returnData->packages[0]->waybill
    //                 ]);
    //                 Log::info('onedelhivery order generate for awb ' . $responseBody);
    //                 // return response()->json(json_decode($responseBody));
    //             } catch (\Exception $e) {
    //                 Log::info('onedelhivery order generate for order id ' . $e);
    //             }
    //         }
    //     }
    //     \Log::info('Processing job with data vinay');
    // }




    public function handle(): void
    {
        $orders = Order::where('orders.status', 'pending')
            ->where('orders.order_number', $this->input)
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('address as shipping', 'orders.shipping_address_id', '=', 'shipping.id')
            ->select(
                'orders.*',
                'users.name as customer_name',
                'users.phone as customer_phone',
                'shipping.address as shipping_address',
                'shipping.zip as shipping_zip',
                'shipping.city as shipping_city',
                'shipping.state_id as shipping_state',
                'shipping.country_id as shipping_country',
                'shipping.phone as shipping_phone'
            )
            ->get();
    
        if ($orders->isEmpty()) {
            Log::warning("Order not found: {$this->input}");
            return;
        }
    
        foreach ($orders as $order) {
            // Prevent duplicate shipment creation
            if (!empty($order->third_party_delivery_tracking_id)) {
                Log::info("Shipment already created for Order: {$order->order_number}");
                continue;
            }
    
            $cartItems = json_decode($order->cart, true);
    
            if (!isset($cartItems['items']) || empty($cartItems['items'])) {
                Log::warning("Cart items missing in order: {$order->order_number}");
                continue;
            }
    
            // Prepare product details summary (e.g., names, total qty, etc.)
            $productsDesc = [];
            $totalQuantity = 0;
            $totalWeight = 0;
    
            foreach ($cartItems['items'] as $item) {
                $productData = $item['item'];
                $product = Product::find($productData['id']);
    
                if (!$product) {
                    Log::warning("Product not found: ID {$productData['id']}");
                    continue;
                }
    
                $productsDesc[] = $product->name;
                $totalQuantity += $item['qty'];
                $totalWeight += $product->weight * $item['qty'];
            }
    
            if (empty($productsDesc)) {
                Log::warning("No valid products found for Order: {$order->order_number}");
                continue;
            }
    
            $codAmount = $order->pay_amount;
    
            $shipmentData = [
                'shipments' => [
                    [
                        'name'           => $order->customer_name,
                        'add'            => $order->shipping_address ?? '',
                        'pin'            => $order->shipping_zip ?? '',
                        'city'           => $order->shipping_city ?? '',
                        'state'          => $order->shipping_state ?? '',
                        'country'        => $order->shipping_country ?? '',
                        'phone'          => $order->shipping_phone ?? '',
                        'order'          => $order->order_number,
                        'payment_mode'   => $order->method,
                        'return_pin'     => '201301',
                        'return_city'    => 'Noida',
                        'return_phone'   => '9667054665',
                        'return_add'     => '3rd floor, A-78, Block A, Sector 4, Noida, Uttar Pradesh 201301',
                        'return_state'   => 'Uttar Pradesh',
                        'return_country' => 'India',
                        'products_desc'  => implode(', ', $productsDesc),
                        'hsn_code'       => '', // Optional
                        'cod_amount'     => $codAmount,
                        'order_date'     => now(),
                        'total_amount'   => $codAmount,
                        'seller_inv'     => '',
                        'quantity'       => $totalQuantity,
                        'waybill'        => '',
                        'shipment_width' => 10,
                        'shipment_height'=> 10,
                        'weight'         => $totalWeight ?: 1,
                        'seller_gst_tin' => '',
                        'shipping_mode'  => 'Surface',
                    ]
                ],
                'pickup_location' => [
                    'name'     => "Celigin Global Pvt Ltd",
                    'add'      => "3rd floor, A-78, Block A, Sector 4, Noida, Uttar Pradesh 201301",
                    'city'     => "Noida",
                    'pin_code' => "201301",
                    'country'  => "India",
                    'phone'    => "9667054665",
                ]
            ];
    
            try {
                $client = new \GuzzleHttp\Client();
                $response = $client->post('https://track.delhivery.com/api/cmu/create.json', [
                    'headers' => [
                        'Authorization' => 'Token 4fe90509d391df11535a3533bc932022b11f9fd4',
                        'Accept'        => 'application/json',
                    ],
                    'form_params' => [
                        'format' => 'json',
                        'data'   => json_encode($shipmentData),
                    ],
                    'verify' => false,
                ]);
    
                $responseBody = $response->getBody()->getContents();
                $responseDecoded = json_decode($responseBody);
    
                if (!empty($responseDecoded->packages[0]->waybill)) {
                    DB::table('orders')
                        ->where('order_number', $order->order_number)
                        ->update([
                            'status' => 'Pending',
                            'third_party_delivery_tracking_id' => $responseDecoded->packages[0]->waybill,
                        ]);
    
                    Log::info("AWB generated: {$responseDecoded->packages[0]->waybill} for Order: {$order->order_number}");
                } else {
                    Log::error("AWB not generated for Order: {$order->order_number}");
                }
    
            } catch (\Exception $e) {
                Log::error("Delhivery API error for order {$order->order_number}: " . $e->getMessage());
            }
        }
    
        Log::info('Delhivery shipment job completed.');
    }
    
}

