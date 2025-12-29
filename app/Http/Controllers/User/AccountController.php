<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Wishlist;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountController extends Controller
{
    /**
     * Show user account dashboard
     */
    public function index()
    {
        // Check if user is authenticated
        if (!Auth::check()) {
            return redirect()->route('otp.login.form')
                ->with('error', 'Please login to access your account.');
        }

        $user = Auth::user();
       
        
         $data =[];

        $data = array_values(Session::get('wishlist') ?? []);

        foreach ($data as $item) {
            $this->addwish($item['id']);
        }


        // Get user's recent orders (limit to 5 most recent)
        $orders = Order::where('user_id', $user->id)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();

        // Get user's wishlist items with product details
        $wishlist = Wishlist::where('user_id', $user->id)
            ->with('product')
            ->get();

           

        // Get user's addresses
        $addresses = Address::where('user_id', $user->id)->get();

        // Get user's points/rewards (if column exists, otherwise default to 0)
        $points = $user->reward_points ?? 0;

        // Calculate total counts for dashboard stats
        $totalOrders = Order::where('user_id', $user->id)->count();
        $totalWishlistItems = $wishlist->count();

        return view('user.account.index', compact(
            'user',
            'orders',
            'wishlist',
            'addresses',
            'points',
            'totalOrders',
            'totalWishlistItems'
        ));
    }
     public function addwish($id)
    {
         $user = Auth::user();
        $data[0] = 0;
        $ck = Wishlist::where('user_id','=',$user->id)->where('product_id','=',$id)->get()->count();
        if($ck > 0)
        {
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