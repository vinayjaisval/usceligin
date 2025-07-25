<?php

namespace App\Http\Controllers\User;

use App\Models\FavoriteSeller;
use App\Models\Order;
use App\Models\User;
use App\Models\PaymentGateway;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Validator;
use Auth;
use Illuminate\Support\Facades\DB;

class UserController extends UserBaseController
{

    public function index()
    {

        $user = $this->user;
        return view('user.dashboard', compact('user'));
    }


    public function profile()
    {
        $user = $this->user;
        return view('user.profile', compact('user'));
    }

    public function profileupdate(Request $request)
    {

        $rules = [
            'photo' => 'mimes:jpeg,jpg,png,svg',
            'email' => 'unique:users,email,' . $this->user->id,
            'phone' => [
                'required',
                'digits:10',
                'unique:users,phone,' . $this->user->id,
            ],
        ];



        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
        }
        //--- Validation Section Ends
        $input = $request->all();

        $data = $this->user;
        // dd($data);
        if ($file = $request->file('photo')) {
            $extensions = ['jpeg', 'jpg', 'png', 'svg'];
            if (!in_array($file->getClientOriginalExtension(), $extensions)) {
                return response()->json(array('errors' => ['Image format not supported']));
            }

            $name = \PriceHelper::ImageCreateName($file);
            $file->move('assets/images/users/', $name);
            if ($data->photo != null) {
                if (file_exists(public_path() . '/assets/images/users/' . $data->photo)) {
                    unlink(public_path() . '/assets/images/users/' . $data->photo);
                }
            }
            $input['photo'] = $name;
        }
        $data->update($input);
        $msg = __('Successfully updated your profile');
        return response()->json($msg);
    }

    public function resetform()
    {
        return view('user.reset');
    }

    public function reset(Request $request)
    {
        $user = $this->user;
        if ($request->cpass) {
            if (Hash::check($request->cpass, $user->password)) {
                if ($request->newpass == $request->renewpass) {
                    $input['password'] = Hash::make($request->newpass);
                } else {
                    return response()->json(array('errors' => [0 => __('Confirm password does not match.')]));
                }
            } else {
                return response()->json(array('errors' => [0 => __('Current password Does not match.')]));
            }
        }
        $user->update($input);
        $msg = __('Successfully changed your password');
        return response()->json($msg);
    }

    public function loadpayment($slug1, $slug2)
    {
        $data['payment'] = $slug1;
        $data['pay_id'] = $slug2;
        $data['gateway'] = '';
        if ($data['pay_id'] != 0) {
            $data['gateway'] = PaymentGateway::findOrFail($data['pay_id']);
        }
        return view('load.payment-user', $data);
    }

    public function favorite($id1, $id2)
    {
        $fav = new FavoriteSeller();
        $fav->user_id = $id1;
        $fav->vendor_id = $id2;
        $fav->save();
        $data['icon'] = '<i class="icofont-check"></i>';
        $data['text'] = __('Favorite');
        return response()->json($data);
    }

    public function favorites()
    {
        $user = $this->user;
        $favorites = FavoriteSeller::where('user_id', '=', $user->id)->get();
        return view('user.favorite', compact('user', 'favorites'));
    }

    public function favdelete($id)
    {
        $wish = FavoriteSeller::findOrFail($id);
        $wish->delete();
        return redirect()->route('user-favorites')->with('success', __('Successfully Removed The Seller.'));
    }

    public function affilate_code()
    {
        $user = $this->user;
        return view('user.affilate.affilate-program', compact('user'));
    }

    // public function affilate_history()
    // {
    //     $user = $this->user;
    //     $affilates = Order::where('status', '=', 'completed')->where('affilate_users', '!=', null)->get();

    //  //  dd($affilates);
    //     $final_affilate_users = array();
    //     $i = 0;
    //     foreach ($affilates as $order) {
    //         $affilate_users = json_decode($order->affilate_users, true);
    //         foreach ($affilate_users as $key => $auser) {
    //             if ($auser['user_id'] == $user->id) {
    //                 $final_affilate_users[$i]['customer_name'] = $order->customer_name;
    //                 $final_affilate_users[$i]['product_id'] = $auser['product_id'];
    //                 $final_affilate_users[$i]['charge'] = \PriceHelper::showOrderCurrencyPrice(($auser['charge'] * $order->currency_value), $order->currency_sign);

    //                 $i++;
    //             }
    //         }
    //     }

    //     return view('user.affilate.affilate-history', compact('user', 'final_affilate_users'));
    // }

    public function affilate_history()
    {
        $user = $this->user;
        $final_affilate_users = [];
        $final_affilate_users = DB::table('orders')
            ->where('orders.status', 'completed')
            ->where('orders.affilate_users', $user->id)
            ->join('users as buyers', 'orders.user_id', '=', 'buyers.id')
            ->where('buyers.affiliated_by', $user->id)
            ->leftJoin('address as billing_address', 'orders.billing_address_id', '=', 'billing_address.id') // 👈 JOIN here
            ->select(
                'orders.*',
                'buyers.name as customer_name',
                'buyers.id as buyer_id',
                'billing_address.address as billing_address',
                'billing_address.address as billing_address',

                'billing_address.zip as billing_zip',
                'billing_address.city as billing_city',
                'billing_address.state_id as billing_state'
            )
            ->get();


        
        return view('user.affilate.affilate-history', compact('user', 'final_affilate_users'));
    }


    public function referral_link()
    {
        $user = $this->user;
        return view('user.affilate.refferal-link', compact('user'));
    }

    public function logs()
    {
        $user_id = Auth::user()->id;
        $refferel_user = User::where('reffered_by', $user_id)->paginate(12);
        return view('user.logs', compact('refferel_user'));
    }

    public function addtowallet(Request $request)
    {

        $user = \App\Models\User::findOrFail($request->user_id);



        $user->balance = $user->balance + ($request->balance);

        if ($user->current_balance >= $request->balance) {

            $user->current_balance -= $request->balance;
        } else {
            $remaining_amount = $request->balance - $user->current_balance;
            $user->current_balance = 0;
            $user->current_balance -= $remaining_amount;
        }


        $user->current_balance;

        $user->balance;



        $user->save();
        $deposit = new \App\Models\Deposit();
        $deposit->user_id = $request->user_id;
        $deposit->amount = $request->amount;
        $deposit->currency_code = 'INR';
        $deposit->currency_value = 1;
        $deposit->method = $request->method;
        $deposit->txnid = 'WALLET-ADD';
        $deposit->status = 1;
        $deposit->save();
        return redirect()->back()->with('success', __('Added To Wallet'));
    }




    public function address()
    {

        $user = $this->user;
        $address=Address::where('user_id',$user->id)->get();
       
        return view('user.address.index', compact('user', 'address'));
    }
    public function address_add()
    {

        $user = $this->user;
       

        return view('user.address.add', compact('user'));
    }

    public function address_store(Request $request)
    {
        // Validation
        $request->validate([
            'phone'     => 'required|string|max:20',
            'zip'       => 'required|string|max:10',
            'country'   => 'required|string|max:100',
            'state_id'  => 'required|string|max:100',
            'city_id'   => 'required|string|max:100',
            'address'   => 'required|string',
        ]);
    
        // Fetch user
        $user = User::findOrFail($request->user_id);
    
        // Update user's name and email once (only if empty)
        if (empty($user->name) && $request->filled('customer_name')) {
            $user->name = $request->customer_name;
        }
        if (empty($user->email) && $request->filled('email')) {
            $user->email = $request->email;
        }
        $user->save();
    
        // Common address data
        $addressData = [
            'user_id'       => $user->id,
            'customer_name' => $request->customer_name,
            'phone'         => $request->phone,
            'zip'           => $request->zip,
            'email'         => $request->email,
            'country_id'    => $request->country,
            'state_id'      => $request->state_id,
            'city'          => $request->city_id,
            'flat_no'       => $request->flat_no,
            'landmark'      => $request->landmark,
            'address'       => $request->address,
            'same_address_shipping' => $request->same_address_shipping ?? 0
        ];
    
        // Save billing and shipping address accordingly
        if ($request->has('same_address_shipping') && $request->same_address_shipping == '1') {
            Address::create(array_merge($addressData, ['is_billing' => 1])); // Billing
            Address::create(array_merge($addressData, ['is_billing' => 2])); // Shipping
        } else {
            $isBilling = $request->save_button_type == 'BILLING' ? 1 : 2;
            Address::create(array_merge($addressData, ['is_billing' => $isBilling]));
        }
    
        return redirect()->back()->with('success', __('Address Added Successfully'));
    }
    
    



    public function address_edit($id)
    {

        $user = $this->user;

        $address=Address::where('id',$id)->first();
       
        return view('user.address.edit', compact('user', 'address'));
    }

    public function address_update(Request $request, $id)
    {
        $request->validate([
            'user_id'   => 'required|exists:users,id',
            'name'      => 'required|string|max:255',
            'phone'     => 'required|string|max:20',
            'zip'       => 'required|string|max:10',
            'country'   => 'required|string|max:100',
            'state_id'  => 'required|string|max:100',
            'city_id'   => 'required|string|max:100',
            'address'   => 'required|string',
        ]);
    
        // Find the address by ID
        $address = Address::findOrFail($id);
    
        $address->update([
            'user_id'   => $request->user_id,
            'name'      => $request->name,
            'phone'     => $request->phone,
            'pincode'   => $request->zip,
            'country_id'=> $request->country,
            'state_id'  => $request->state_id,
            'city'      => $request->city_id,
            'flat_no'   => $request->flat_no,
            'landmark'  => $request->landmark,
            'address'   => $request->address,
        ]);
    
        return redirect()->back()->with('success', __('Address Updated Successfully'));
    }
    public function address_delete($id)
    {
        
        $address = Address::findOrFail($id);
        $address->delete();

        return redirect()->back()->with('success', 'Address deleted successfully.');
    }


    public function journey()
    {
        return view('user.journey.index');
    }
}
