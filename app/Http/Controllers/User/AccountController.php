<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Wishlist;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AccountController extends Controller
{
    /**
     * Show user account dashboard
     */
    public function index(Request $request)
    {
        if (!Auth::check()) {
            return redirect()->route('otp.login.form')
                ->with('error', 'Please login to access your account.');
        }

        $user = Auth::user();

        // Build orders query with search and time filter
        $ordersQuery = Order::where('user_id', $user->id);

        // Time period filter
        $period = $request->get('period', 'all');
        if ($period === '3months') {
            $ordersQuery->where('created_at', '>=', Carbon::now()->subMonths(3));
        } elseif ($period === '6months') {
            $ordersQuery->where('created_at', '>=', Carbon::now()->subMonths(6));
        } elseif ($period === 'year') {
            $ordersQuery->where('created_at', '>=', Carbon::now()->subYear());
        }

        // Search filter
        $search = $request->get('search', '');
        if (!empty($search)) {
            $ordersQuery->where(function ($q) use ($search) {
                $q->where('order_number', 'like', "%{$search}%")
                  ->orWhere('cart', 'like', "%{$search}%")
                  ->orWhere('customer_name', 'like', "%{$search}%");
            });
        }

        $orders = $ordersQuery->orderBy('created_at', 'desc')->get();

        // Build "Buy Again" products from past orders
        $allOrders = Order::where('user_id', $user->id)->orderBy('created_at', 'desc')->get();
        $buyAgainProducts = collect();
        foreach ($allOrders as $order) {
            $cart = json_decode($order->cart, true);
            if (!empty($cart['items'])) {
                foreach ($cart['items'] as $item) {
                    $productId = $item['item']['id'] ?? null;
                    if ($productId && !$buyAgainProducts->has($productId)) {
                        $product = Product::find($productId);
                        if ($product && $product->status == 1) {
                            $buyAgainProducts->put($productId, [
                                'product' => $product,
                                'last_purchased' => $order->created_at,
                                'currency_sign' => $order->currency_sign,
                            ]);
                        }
                    }
                }
            }
        }
        $buyAgainProducts = $buyAgainProducts->take(20);

        // Get user's wishlist items with product details
        $wishlist = Wishlist::where('user_id', $user->id)
            ->with('product')
            ->get();

        // Get user's addresses
        $addresses = Address::where('user_id', $user->id)->get();

        // Get user's points/rewards
        $points = $user->reward_points ?? 0;

        // Calculate total counts for dashboard stats
        $totalOrders = Order::where('user_id', $user->id)->count();
        $totalWishlistItems = $wishlist->count();

        $final_affilate_users = [];
        $final_affilate_users = DB::table('orders')
            // ->where('orders.status', 'completed')
            ->where('orders.affilate_users', $user->id)
            ->join('users as buyers', 'orders.user_id', '=', 'buyers.id')
            ->where('buyers.affiliated_by', $user->id)

            // ->leftJoin('address as billing_address', 'orders.billing_address_id', '=', 'billing_address.id') // 👈 JOIN here
            ->select(
                'orders.*',
                'buyers.name as customer_name',
                'buyers.id as buyer_id',

            )
            ->get();



        $final_refferal_users = [];
        $final_refferal_users = DB::table('orders')
            // ->where('orders.status', 'completed')
            ->where('orders.affilate_user', $user->id)
            ->join('users as buyers', 'orders.user_id', '=', 'buyers.id')
            ->where('buyers.reffered_by', $user->id)

            // ->leftJoin('address as billing_address', 'orders.billing_address_id', '=', 'billing_address.id') // 👈 JOIN here
            ->select(
                'orders.*',
                'buyers.name as customer_name',
                'buyers.id as buyer_id',

            )
            ->get();

        return view('user.account.index', compact(
            'user',
            'orders',
            'wishlist',
            'addresses',
            'points',
            'totalOrders',
            'totalWishlistItems',
            'final_affilate_users',
            'final_refferal_users',
            'buyAgainProducts',
            'search',
            'period'
        ));
    }
    public function addwish($id)
    {
        $user = Auth::user();
        $data[0] = 0;
        $ck = Wishlist::where('user_id', '=', $user->id)->where('product_id', '=', $id)->get()->count();
        if ($ck > 0) {
            $data['error'] = __('Already Added To The Wishlist.');
            return response()->json($data);
        }
        $wish = new Wishlist();
        $wish->user_id = $user->id;
        $wish->product_id = $id;
        $wish->save();
        $data[0] = 1;
        $data[1] = count($user->wishlists);
        $data['success'] = __('Successfully Added To The Wishlist.');
        return response()->json($data);
    }

    /**
     * Update user account information
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'nullable|email|unique:users,email,' . $user->id,
            'phone' => 'nullable|string|max:15|unique:users,phone,' . $user->id,
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
        ]);

        return redirect()->route('user.account')->with('success', 'Profile updated successfully!');
    }
}
