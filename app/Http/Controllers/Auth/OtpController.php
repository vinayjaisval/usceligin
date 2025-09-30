<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SendOtpRequest;
use App\Http\Requests\VerifyOtpRequest;
use App\Services\OtpService;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class OtpController extends Controller
{
    protected $otpService;

    public function __construct(OtpService $otpService)
    {
        $this->otpService = $otpService;
    }

    /**
     * Send OTP for authentication
     */
    public function sendOtp(SendOtpRequest $request): JsonResponse
    {
        
        try {
            $contact = $request->input('contact');
            $method = $request->input('method', 'phone');

            // Normalize phone number
            if ($method === 'phone') {
                $contact = $this->normalizePhoneNumber($contact);
            }

            $result = $this->otpService->generateAndSendOtp($contact, $method, 'login');

            return response()->json($result, $result['success'] ? 200 : 400);

        } catch (\Exception $e) {
            Log::error('Send OTP Controller Error', [
                'error' => $e->getMessage(),
                'method' => $request->input('method'),
                'ip' => $request->ip()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
                'error_code' => 'CONTROLLER_ERROR'
            ], 500);
        }
    }

    /**
     * Verify OTP and authenticate user
     */
    public function verifyOtp(VerifyOtpRequest $request): JsonResponse
    {
        try {
            $contact = $request->input('contact');
            $otpCode = $request->input('otp_code');
            $method = $request->input('method', 'phone');
            $keepSignedIn = $request->boolean('keep_signed_in', false);

            // Normalize phone number
            if ($method === 'phone') {
                $contact = $this->normalizePhoneNumber($contact);
            }

            $result = $this->otpService->verifyOtp($contact, $otpCode, $method);

            if ($result['success']) {
                // Find or create user
                $user = $this->findOrCreateUser($contact, $method);

                if ($user) {
                    // Log the user in
                    Auth::login($user, $keepSignedIn);

                    // Update last login (remove if column doesn't exist)
                    // $user->update(['last_otp_sent_at' => now()]);

                    return response()->json([
                        'success' => true,
                        'message' => 'Login successful!',
                        'user' => [
                            'id' => $user->id,
                            'name' => $user->name,
                            'email' => $user->email,
                            'phone' => $user->phone,
                        ],
                        'redirect_url' => $this->getRedirectUrl($user)
                    ]);
                } else {
                    return response()->json([
                        'success' => false,
                        'message' => 'User account not found. Please register first.',
                        'error_code' => 'USER_NOT_FOUND'
                    ], 404);
                }
            }

            return response()->json($result, 400);

        } catch (\Exception $e) {
            Log::error('Verify OTP Controller Error', [
                'error' => $e->getMessage(),
                'method' => $request->input('method'),
                'ip' => $request->ip()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Verification failed. Please try again.',
                'error_code' => 'CONTROLLER_ERROR'
            ], 500);
        }
    }

    /**
     * Resend OTP
     */
    public function resendOtp(Request $request): JsonResponse
    {
        $request->validate([
            'contact' => 'required|string',
            'method' => 'required|in:phone,email'
        ]);

        try {
            $contact = $request->input('contact');
            $method = $request->input('method');

            // Normalize phone number
            if ($method === 'phone') {
                $contact = $this->normalizePhoneNumber($contact);
            }

            // Check rate limit
            $remainingTime = $this->otpService->getRateLimitRemainingTime($contact, $method);
            if ($remainingTime > 0) {
                return response()->json([
                    'success' => false,
                    'message' => "Please wait {$remainingTime} seconds before requesting another OTP.",
                    'error_code' => 'RATE_LIMITED',
                    'remaining_time' => $remainingTime
                ], 429);
            }

            $result = $this->otpService->generateAndSendOtp($contact, $method, 'login');

            return response()->json($result, $result['success'] ? 200 : 400);

        } catch (\Exception $e) {
            Log::error('Resend OTP Controller Error', [
                'error' => $e->getMessage(),
                'method' => $request->input('method'),
                'ip' => $request->ip()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to resend OTP. Please try again.',
                'error_code' => 'CONTROLLER_ERROR'
            ], 500);
        }
    }

    /**
     * Check if user exists
     */
    public function checkUser(Request $request): JsonResponse
    {
        $request->validate([
            'contact' => 'required|string',
            'method' => 'required|in:phone,email'
        ]);

        try {
            $contact = $request->input('contact');
            $method = $request->input('method');

            // Normalize phone number
            if ($method === 'phone') {
                $contact = $this->normalizePhoneNumber($contact);
            }

            $user = $method === 'phone'
                ? User::where('phone', $contact)->first()
                : User::where('email', $contact)->first();

            return response()->json([
                'exists' => $user !== null,
                'user' => $user ? [
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                ] : null
            ]);

        } catch (\Exception $e) {
            Log::error('Check User Controller Error', [
                'error' => $e->getMessage(),
                'method' => $request->input('method'),
                'ip' => $request->ip()
            ]);

            return response()->json([
                'success' => false,
                'message' => 'Failed to check user status.',
                'error_code' => 'CONTROLLER_ERROR'
            ], 500);
        }
    }

    /**
     * Normalize phone number (remove spaces, add country code if needed)
     */
    private function normalizePhoneNumber($phone): string
    {
        // Remove all non-numeric characters
        $phone = preg_replace('/[^0-9]/', '', $phone);

        // Add country code if not present (assuming India +91)
        if (strlen($phone) === 10 && !str_starts_with($phone, '91')) {
            $phone = '91' . $phone;
        }

        return $phone;
    }

    /**
     * Find or create user based on contact
     */
    private function findOrCreateUser($contact, $method): ?User
    {
        if ($method === 'phone') {
            $user = User::where('phone', $contact)->first();

            if (!$user) {
                // Auto-create user with phone number
                $user = User::create([
                    'name' => 'User ' . substr($contact, -4), // Default name using last 4 digits
                    'phone' => $contact,
                    'email' => null,
                    'password' => bcrypt(Str::random(16)), // Random password (not used)
                    'status' => 1,
                ]);
            }

            return $user;
        } else {
            $user = User::where('email', $contact)->first();

            if (!$user) {
                // Auto-create user with email
                $user = User::create([
                    'name' => explode('@', $contact)[0], // Use email prefix as default name
                    'email' => $contact,
                    'phone' => null,
                    'password' => bcrypt(Str::random(16)), // Random password (not used)
                    'status' => 1,
                ]);
            }

            return $user;
        }
    }

    /**
     * Get redirect URL based on user role
     */
    private function getRedirectUrl(User $user): string
    {
        // Customize based on your application's routing
        if ($user->is_admin) {
            return url('/admin/dashboard');
        } elseif ($user->is_vendor) {
            return url('/vendor/dashboard');
        } else {
            return url('/myaccount');
        }
    }

    /**
     * Show OTP login form
     */
    public function showLoginForm()
    {
        return view('frontend.sign-in');
    }

    /**
     * Logout user
     */
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/');
    }
}