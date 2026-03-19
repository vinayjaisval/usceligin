<?php

namespace App\Http\Controllers\Auth\User;

use App\{
  Models\User,
  Classes\GeniusMailer,
};
use App\Http\Controllers\Controller;
use App\Services\WishlistMergeService;
use Illuminate\Http\Request;
use Auth;
use Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;

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
    Session::flush();
    return redirect('/');
  }


  public function sign_in()
  {

    return view('frontend.sign-in');
  }



  public function send_otp(Request $request)
  {

 


    // Validate input
    $request->validate([

      'method' => 'required|in:email,phone'
    ]);

    // Determine identifier
    $method = $request->method;

    switch ($method) {
      case 'email':
        $identifier = $request->contact;
        break;

      case 'phone':
        $identifier = $request->contact;
        break;

      default:
        $identifier = null;
    }
    // Generate OTP
    $otp = rand(100000, 999999);

    // Save OTP in session
    Session::put('otp_data', [
      'type' => $method,
      'identifier' => $identifier,
      'otp' => $otp,
      'expires_at' => now()->addMinutes(5)
    ]);


    // Send OTP
    if ($method === 'email') {
      $mailer = new GeniusMailer();

      $htmlBody = View::make('emails.otp', [
       
        'name'       =>'User',
        'headline'   => 'Here`s your one-time login code:',
        'otp' => $otp,
        'subject' => ' Your login code is' . $otp,
        'cta_label'  => 'Visit Website',
        'cta_url'    => url('/')
      ])->render();

      $mailData = [
        'to' => $identifier,
        'subject' => 'Celigin Login OTP Code - '. $otp,
        'body' => $htmlBody
      ];
      
      \Log::info("OTP sent to email {$identifier}: {$otp}");
      $mailer->sendCustomMail($mailData);
    } elseif ($method === 'phone') {
      \Log::info("OTP sent to phone {$identifier}: {$otp}");
      // $this->resend_otp($identifier, $otp); // Replace with actual SMS logic
    }

    return response()->json(['message' => 'OTP sent successfully!', 'otp' => $otp]);
  }

  public function verify_otp(Request $request)
  {
    $otpData = Session::get('otp_data');

    if (!$otpData || now()->gt($otpData['expires_at'])) {
      return response()->json(['message' => 'OTP expired.'], 400);
    }

    // FIXED: Normalize both values before comparing
    if (trim((string) $otpData['otp']) !== trim((string) $request->otp_code)) {
      return response()->json(['message' => 'Invalid OTP.'], 400);
    }

    // Get the method (e.g., 'phone') and the identifier value (e.g., '9889259224')
    $method = $request->method;
    $identifier = $request->contact;

    // Find user by the given method
    $user = User::where($method, $identifier)->first();

    // If user doesn't exist, create one
    if (!$user) {
      $input = [
        'name' => $request->name ?? 'User', // fallback name if not provided
        $method => $identifier,
        'verification_link' => md5(time() . ($request->name ?? 'User') . $identifier),
        'affilate_code' => md5(($request->name ?? 'User') . $identifier),
        'refferel_code' => md5(($request->name ?? 'User') . $identifier . rand(1111, 9999)),
      ];


      if (Session::has('refferel_user_id')) {
        $input['reffered_by'] = Session::get('refferel_user_id');
      }

      if (Session::has('affilate')) {
        $input['affiliated_by'] = Session::get('affilate');
      }

      $user = User::create($input);
    }

    // Log in the user
    Auth::login($user, $request->keep_signed_in ?? false);

    // Merge guest wishlist to user account
    $wishlistService = new WishlistMergeService();
    $wishlistService->mergeGuestWishlistToUser();

    // Clear OTP session data
    Session::forget(['otp_data']);

    // Determine redirect URL with priority
    $redirectUrl = $this->getRedirectUrl();

    return response()->json([
      'message' => 'Login successful!',
      'success' => true,
      'redirect_url' => $redirectUrl
    ]);
  }


  public function resendOtp(Request $request)
  {
    // Validate input
    $request->validate([
      'method'  => 'required|in:email,phone',
      'contact' => 'required'
    ]);

    $method     = $request->method;
    $identifier = $request->contact;

    /* ================= RESEND COOLDOWN (1 min) ================= */
    $oldOtp = Session::get('otp_data');
    $cooldown = 60; // seconds

    if ($oldOtp && isset($oldOtp['created_at'])) {
      $diffSeconds = now()->diffInSeconds($oldOtp['created_at']);
      if ($diffSeconds < $cooldown) {
        $wait = $cooldown - $diffSeconds;
        return response()->json([
          'success' => false,
          'message' => "Please wait {$wait} seconds before resending OTP"
        ], 429);
      }
    }

    /* ================= GENERATE NEW OTP ================= */
    $otp = rand(100000, 999999);

    // Update session with new OTP
    Session::put('otp_data', [
      'type'       => $method,
      'identifier' => $identifier,
      'otp'        => $otp,
      'created_at' => now(),
      'expires_at' => now()->addMinutes(5)
    ]);

    /* ================= SEND OTP ================= */
    if ($method === 'email') {
      try {
        $mailer = new GeniusMailer();

        $htmlBody = View::make('emails.otp', [
      
        'name'       =>'User',
        'headline'   => 'You asked for a new code. Here it is:',
        'otp' => $otp,
        'subject' => 'Your login code is' . $otp,
        'cta_label'  => 'Visit Website',
        'cta_url'    => url('/')
      ])->render();
        $mailData = [
          'to'      => $identifier,
          'subject' => 'Here`s your new login code: ' . $otp,
          'body'    =>  $htmlBody
        ];
        $mailer->sendCustomMail($mailData);
        \Log::info("OTP resent to email {$identifier}: {$otp}");
      } catch (\Exception $e) {
        \Log::error('Email OTP resend failed', ['exception' => $e->getMessage()]);
        return response()->json([
          'success' => false,
          'message' => 'Failed to resend OTP via email. Try again later.'
        ], 400);
      }
    } else {
      $sent = $this->resend_otp($identifier, $otp); // SMS function
      if (!$sent) {
        return response()->json([
          'success' => false,
          'message' => 'Failed to resend OTP via SMS. Try again later.',
          'error_code' => 'SMS_FAILED'
        ], 400);
      }
      \Log::info("OTP resent to phone {$identifier}: {$otp}");
    }

    return response()->json([
      'success' => true,
      'message' => 'OTP resent successfully!',
      'otp'     => $otp // remove in production
    ]);
  }
  public function resend_otp($number, $otp)
  {

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

  /**
   * Get redirect URL after successful login
   * Priority: 1) Intended URL  2) Checkout (if cart)  3) My Account
   */
  private function getRedirectUrl()
  {
    // Priority 1: Intended URL from middleware
    if (session()->has('url.intended')) {
      $intendedUrl = session()->pull('url.intended');
      return $intendedUrl;
    }

    // Priority 2: Checkout if cart has items
    if (Session::has('cart')) {
      $cart = Session::get('cart');
      if (isset($cart->items) && count($cart->items) > 0) {
        return route('front.checkout');
      }
    }

    // Priority 3: Default to My Account
    return route('user.account');
  }
}
