<?php

namespace App\Http\Controllers\Auth\User;

use App\{
  Models\User,
  Classes\GeniusMailer,
};
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
  public function __construct()
  {
    $this->middleware('guest', ['except' => ['logout', 'userLogout', 'loginotp']]);
  }

  public function login(Request $request)
  {

    //--- Validation Section
    $rules = [
      'email'   => 'required|email',
      'password' => 'required'
    ];

    $validator = Validator::make($request->all(), $rules);

    if ($validator->fails()) {
      return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
    }
    //--- Validation Section Ends

    // Attempt to log the user in
    if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
      // if successful, then redirect to their intended location
      // dd($request->all());die;
      // Check If Email is verified or not
      if (Auth::guard('web')->user()->email_verified == 'No') {
        Auth::guard('web')->logout();
        return response()->json(array('errors' => [0 => __('Your Email is not Verified!')]));
      }

      if (Auth::guard('web')->user()->ban == 1) {
        Auth::guard('web')->logout();
        return response()->json(array('errors' => [0 => __('Your Account Has Been Banned.')]));
      }

      // Login Via Modal
      if (empty($request->auth_modal)) {
        if (!empty($request->modal)) {
          // Login as Vendor
          if (!empty($request->vendor)) {
            if (Auth::guard('web')->user()->is_vendor == 2) {
              return response()->json(route('vendor.dashboard'));
            } else {
              return response()->json(route('user-package'));
            }
          }
          // Login as User
          return response()->json(1);
        }
      }

      // Login as User
      return response()->json(redirect()->intended(route('user-dashboard'))->getTargetUrl());
    }

    // if unsuccessful, then redirect back to the login with the form data
    return response()->json(array('errors' => [0 => __('Credentials Doesn\'t Match !')]));
  }

  public function logout()
  {
    Auth::logout();
    return redirect('/');
  }


  public function loginotp()
  {

    return view('frontend.loginotp');
  }


 

  public function resend_otp($number, $otp)
  {
    // $otp = rand(100000, 999999);

    // Prepend country code if missing
    if (strlen($number) === 10) {
      $number = '91' . $number;
    }

    $client = new \GuzzleHttp\Client();
    $url = "https://connectexpress.in/api/v3/index.php";
    $params = [
      'method' => 'sms',
      'api_key' => '05c05017988bc8087a13f2c950e9f33fb1cfd38a',
      'to' => $number,
      'sender' => 'CELIGN',
      'message' => "Your celigin account login OTP is $otp. CELIGN",
      'format' => 'php'
    ];
    // dd($params);

    try {
      $response = $client->request('GET', $url, [
        'query' => $params,
        'verify' => false,
      ]);

      $rawBody = (string) $response->getBody();

      // Try decoding JSON first
      $responseBody = json_decode($rawBody, true);

      // Fallback if not JSON: treat any non-empty response as success
      $isSuccess = false;

      if (is_array($responseBody)) {
        if (
          (isset($responseBody['status']) && $responseBody['status'] === 'success') ||
          (isset($responseBody['error']) && $responseBody['error'] == '0')
        ) {
          $isSuccess = true;
        }
      } elseif (!empty(trim($rawBody))) {
        // e.g. if API just returns "1" or "Message Sent"
        $isSuccess = true;
      }

      if ($isSuccess) {
        $user = User::where('phone', substr($number, -10))->first();
        if ($user) {
          $user->otp = $otp;
          $user->save();
        } else {
          User::create([
            'phone' => substr($number, -10),
            'otp' => $otp,
          ]);
        }

        return true;
      } else {
        Log::error('OTP not sent. Raw API response:', ['response' => $rawBody]);
        return false;
      }
    } catch (\Exception $e) {
      Log::error('SMS API Error: ' . $e->getMessage());
      return false;
    }
  }



  // public function send_otp(Request $request)
  // {



  //   $rules = [
  //     'phone' => 'required'
  //   ];

  //   $validator = Validator::make($request->all(), $rules);

  //   if ($validator->fails()) {
  //     return response()->json(array('errors' => $validator->getMessageBag()->toArray()));
  //   }

  //   $user = User::where(['phone' => $request['phone']])->first();


  //   if (!empty($user)) {
  //     $user->phone = $request['phone'];
  //     $user->email = $request['email'] ?? '';

  //     $user->name = $request['name'] ?? '';
  //     $user->save();
  //     $result =  $this->resend_otp($request['phone']);

  //     if ($result == true) {

  //       return response()->json([
  //         'status' => true,
  //         'message' => 'otp_sent',
  //         'profile_status' => false
  //       ], 200);
  //     } else {
  //       return response()->json(['status' => false, 'message' => 'otp_not_sent'], 200);
  //     }
  //   } else {
  //     //  die($request['phone']);
  //     $user = new User();
  //     $user->phone = $request['phone'];
  //     $user->email = $request['email'] ?? '';

  //     $user->name = $request['name'] ?? '';

  //     if ($user->save()) {
  //       $result =  $this->resend_otp($request['phone']);



  //       if ($result == true) {
  //         return response()->json([
  //           'status' => true,
  //           'message' => 'otp_sent',
  //           'profile_status' => false
  //         ], 200);
  //       } else {
  //         return response()->json(['status' => false, 'message' => 'otp_not_sent'], 200);
  //       }
  //     }
  //   }
  // }


  // public function send_otp(Request $request)
  // {
  //   dd($request->all());
  //   $rules = [
  //     'phone' => 'required'
  //   ];

  //   $validator = Validator::make($request->all(), $rules);

  //   if ($validator->fails()) {
  //     return response()->json(['errors' => $validator->getMessageBag()->toArray()]);
  //   }

  //   // Check if the user with the phone number already exists
  //   $user = User::where('phone', $request->phone)->first();

  //   if ($user) {
  //     // Update user info if exists
  //     $user->email = $request->email ?? $user->email;
  //     $user->name = $request->name ?? $user->name;
  //     $user->save();
  //   } else {
  //     // Create new user if not found
  //     $user = new User();
  //     $user->phone = $request->phone;
  //     $user->email = $request->email ?? '';
  //     $user->name = $request->name ?? '';
  //     $user->save();
  //   }

  //   // Send OTP
  //   $result = $this->resend_otp($request->phone);

  //   if ($result === true) {
  //     return response()->json([
  //       'status' => true,
  //       'message' => 'OTP Sent Successfully',
  //       'profile_status' => false
  //     ], 200);
  //   } else {
  //     return response()->json([
  //       'status' => false,
  //       'message' => 'OTP not Sent Successfully'
  //     ], 200);
  //   }
  // }


  // public function verify_otp1(Request $request)
  // {
  //   // dd($request->all());
  //   $validator = Validator::make($request->all(), [
  //     'otp' => 'required|numeric',

  //   ]);
  //   if ($validator->fails()) {
  //     return response()->json(['status' => false, 'errors' => $validator->errors()], 422);
  //   }
  //   $user = User::where(['otp' => $request['otp']])->first();

  //   // $storedOtp = session('otp');
  //   // dd($storedOtp);
  //   if ($user && $user->otp == $request->otp) {
  //     // Login the user manually without password
  //     Auth::login($user);

  //     // Check if email is verified
  //     if (Auth::guard('web')->user()->email_verified == 'yes') {
  //       Auth::guard('web')->logout();
  //       return response()->json(['errors' => ['Your Email is not Verified!']]);
  //     }

  //     // Check if the user is banned
  //     if (Auth::guard('web')->user()->ban == 1) {
  //       Auth::guard('web')->logout();
  //       return response()->json(['errors' => ['Your Account Has Been Banned.']]);
  //     }

  //     // Handle login via modal if needed


  //     // Redirect to user dashboard if everything is fine
  //     return response()->json(['redirect' => route('user-dashboard')]);
  //   } else {
  //     // If authentication fails
  //     return response()->json(['errors' => ['Invalid  OTP']]);
  //   }
  // }






  public function send_otp(Request $request)
  {
      $request->validate([
          'type' => 'required|in:email,phone',
          'email' => 'required_if:type,email|email',
          'phone' => 'required_if:type,phone|digits:10'
      ]);
  
      $identifier = $request->type === 'email' ? $request->email : $request->phone;
      $otp = rand(100000, 999999);
  
      // Save OTP session
      Session::put('otp_data', [
          'type' => $request->type,
          'identifier' => $identifier,
          'otp' => $otp,
          'expires_at' => now()->addMinutes(5)
      ]);
 
     
     
  
      // Send OTP
      if ($request->type === 'email') {
          $mailer = new GeniusMailer();
          $mailData = [
              'to' => $identifier,
              'subject' => 'Your Login OTP Code',
              'body' => "Your OTP code is: {$otp}"
          ];
          \Log::info("OTP for phone {$identifier}: {$otp}");
          $mailer->sendCustomMail($mailData);
      } elseif ($request->type === 'phone') {
        \Log::info("OTP for phone {$identifier}: {$otp}");

        // $result = $this->resend_otp($identifier, $otp);
          // You can replace this with actual SMS API
      }
  
      return response()->json(['message' => 'OTP sent successfully! '.$otp.']']);
  }
  public function verify_otp(Request $request)
  {

    
    $otpData = Session::get('otp_data');

    if (!$otpData || now()->gt($otpData['expires_at'])) {
      return response()->json(['message' => 'OTP expired.'], 400);
    }

    $identifier = $request->type === 'email' ? $request->email : $request->phone;

    

    $identifier = $request->{$request->type};

$user = User::where($request->type, $identifier)->first();

if (!$user) {
    $input = $request->all();
    $input['password'] = bcrypt($request->password);
    $input['verification_link'] = md5(time().$request->name.$request->email);
    $input['affilate_code'] = md5($request->name.$request->email);
    $input['refferel_code'] = md5($request->name.$request->email.rand(1111,9999));

    if (Session::has('refferel_user_id')) {
        $input['reffered_by'] = Session::get('refferel_user_id');
    }

    if(Session::has('affilate')) {
        $input['affiliated_by'] = Session::get('affilate');
    }

    

    $user = new User;
    $user->fill($input)->save();
}


    Auth::login($user);

    Session::forget([
      'otp_data',
      'refferel_user_id',
      'affilate',
  ]);
    return response()->json(['message' => 'Login successful!', 'success' => true]);
  }


 
}
