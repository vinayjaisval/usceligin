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
   
    public function handle(): void
    {
        $orders = Order::where('orders.status', 'pending')
            ->where('orders.order_number', $this->input)
            ->leftJoin('users', 'orders.user_id', '=', 'users.id')
            ->leftJoin('addresses as shipping', 'orders.user_id', '=', 'shipping.user_id')
            ->select(
                'orders.*',
                'users.name as customer_name',
                'users.phone as customer_phone',
                'shipping.address_line_1 as shipping_address',
                'shipping.pincode as shipping_zip',
                'shipping.city as shipping_city',
                'shipping.state as shipping_state',
                'shipping.country as shipping_country',
                'shipping.phone as shipping_phone'
            )
            ->get();

        //    dd($orders);
               
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
            if($order->method  == 1){
                $paymentMode = 'COD';
            }
            else{
                $paymentMode = $order->method;
            }
                    // $paymentMode = $order->method == 1 ? 'COD' : 'Prepaid';
                    $codAmount = $paymentMode === 'COD' ? $order->pay_amount : 0;

    
            $shipmentData = [
                'shipments' => [
                    [
                        'name'           => $order->customer_name,
                        'add'            => $order->shipping_address ?? '',
                        'pin'            => $order->shipping_zip ?? '',
                        'city'           => $order->shipping_city ?? '',
                        'state'          => $order->shipping_state ?? '',
                        'country'        => $order->shipping_country ?? '',
                        'phone'          => $order->customer_phone ?? '',
                        'order'          => $order->shipping_phone,
                        'payment_mode'   => $paymentMode,
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

            // dd($shipmentData);
    
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

