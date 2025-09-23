<?php

namespace App\Services;

use App\Models\OtpVerification;
use App\Models\User;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\RateLimiter;
use Carbon\Carbon;

class OtpService
{
    // Using configuration instead of hardcoded constants

    /**
     * Generate and send OTP
     */
    public function generateAndSendOtp($contact, $method = 'phone', $type = 'login'): array
    {
        try {
            // Rate limiting check
            if (!$this->checkRateLimit($contact, $method)) {
                return [
                    'success' => false,
                    'message' => 'Too many OTP requests. Please try again after 1 hour.',
                    'error_code' => 'RATE_LIMIT_EXCEEDED'
                ];
            }

            // Clean up old OTPs for this contact
            $this->cleanupOldOtps($contact, $method);

            // Generate OTP
            $otpCode = $this->generateOtpCode();

            // Create OTP record
            $otpVerification = OtpVerification::create([
                $method => $contact,
                'otp_code' => $otpCode,
                'expires_at' => now()->addMinutes(config('otp.expiry_minutes', 10)),
                'type' => $type,
                'method' => $method,
                'ip_address' => request()->ip(),
                'user_agent' => request()->userAgent(),
            ]);

            // Send OTP
            $sent = $this->sendOtp($contact, $otpCode, $method);

            if ($sent) {
                // Log for development only
                if (config('app.debug') && config('otp.security.log_otp_in_development', true)) {
                    Log::info("OTP Generated", [
                        'contact' => $this->maskContact($contact, $method),
                        'method' => $method,
                        'otp' => $otpCode,
                        'expires_at' => $otpVerification->expires_at
                    ]);
                }

                return [
                    'success' => true,
                    'message' => $method === 'phone'
                        ? 'OTP sent to your phone number successfully.'
                        : 'OTP sent to your email address successfully.',
                    'otp_id' => $otpVerification->id,
                    'expires_at' => $otpVerification->expires_at,
                    'development_otp' => config('app.debug') ? $otpCode : null // Only in debug mode
                ];
            } else {
                $otpVerification->delete();
                return [
                    'success' => false,
                    'message' => 'Failed to send OTP. Please try again.',
                    'error_code' => 'SEND_FAILED'
                ];
            }

        } catch (\Exception $e) {
            Log::error('OTP Generation Failed', [
                'contact' => $contact,
                'method' => $method,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Something went wrong. Please try again.',
                'error_code' => 'GENERATION_FAILED'
            ];
        }
    }

    /**
     * Verify OTP
     */
    public function verifyOtp($contact, $otpCode, $method = 'phone'): array
    {
        try {
            // Find valid OTP
            $otpVerification = OtpVerification::where($method, $contact)
                ->where('otp_code', $otpCode)
                ->valid()
                ->latest()
                ->first();

            if (!$otpVerification) {
                // Check if there's any recent OTP for this contact
                $recentOtp = OtpVerification::where($method, $contact)
                    ->recent()
                    ->latest()
                    ->first();

                if ($recentOtp) {
                    $recentOtp->incrementAttempts();

                    if ($recentOtp->attempts >= config('otp.max_verification_attempts', 3)) {
                        return [
                            'success' => false,
                            'message' => 'Maximum verification attempts exceeded. Please request a new OTP.',
                            'error_code' => 'MAX_ATTEMPTS_EXCEEDED'
                        ];
                    }
                }

                return [
                    'success' => false,
                    'message' => 'Invalid or expired OTP. Please try again.',
                    'error_code' => 'INVALID_OTP'
                ];
            }

            // Check attempts limit
            if ($otpVerification->attempts >= config('otp.max_verification_attempts', 3)) {
                return [
                    'success' => false,
                    'message' => 'Maximum verification attempts exceeded. Please request a new OTP.',
                    'error_code' => 'MAX_ATTEMPTS_EXCEEDED'
                ];
            }

            // Mark as verified
            $otpVerification->markAsVerified();

            // Update user verification status
            $this->updateUserVerificationStatus($contact, $method);

            Log::info('OTP Verified Successfully', [
                'contact' => $contact,
                'method' => $method,
                'otp_id' => $otpVerification->id
            ]);

            return [
                'success' => true,
                'message' => 'OTP verified successfully.',
                'user' => $this->findOrCreateUser($contact, $method)
            ];

        } catch (\Exception $e) {
            Log::error('OTP Verification Failed', [
                'contact' => $contact,
                'method' => $method,
                'error' => $e->getMessage()
            ]);

            return [
                'success' => false,
                'message' => 'Verification failed. Please try again.',
                'error_code' => 'VERIFICATION_FAILED'
            ];
        }
    }

    /**
     * Generate random OTP code
     */
    private function generateOtpCode(): string
    {
        // For development, you can use a fixed OTP
        if (config('app.debug') && config('app.env') === 'local') {
            return config('otp.development_otp', '123456');
        }

        $length = config('otp.length', 6);
        $max = pow(10, $length) - 1;
        return str_pad(random_int(0, $max), $length, '0', STR_PAD_LEFT);
    }

    /**
     * Send OTP via appropriate method
     */
    private function sendOtp($contact, $otpCode, $method): bool
    {
        try {
            if ($method === 'email') {
                return $this->sendOtpViaEmail($contact, $otpCode);
            } else {
                return $this->sendOtpViaSms($contact, $otpCode);
            }
        } catch (\Exception $e) {
            Log::error('OTP Send Failed', [
                'contact' => $contact,
                'method' => $method,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Send OTP via Email
     */
    private function sendOtpViaEmail($email, $otpCode): bool
    {
        try {
            // For development: Log the email instead of sending
            Log::info('Email OTP (Development Mode)', [
                'email' => $email,
                'otp' => $otpCode,
                'subject' => 'Your CELIGIN Verification Code',
                'message' => "Your CELIGIN verification code is: {$otpCode}. Valid for " . config('otp.expiry_minutes', 10) . " minutes."
            ]);

            return true;
        } catch (\Exception $e) {
            Log::error('Email OTP Send Failed', [
                'email' => $email,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Send OTP via SMS (placeholder for future SMS integration)
     */
    private function sendOtpViaSms($phone, $otpCode): bool
    {
        // For development: Log the SMS instead of sending
        Log::info('SMS OTP (Development Mode)', [
            'phone' => $phone,
            'otp' => $otpCode,
            'message' => "Your CELIGIN verification code is: {$otpCode}. Valid for " . config('otp.expiry_minutes', 10) . " minutes."
        ]);

        // TODO: Integrate with SMS service provider
        // Example integrations:
        // - Twilio: $this->sendViaTwilio($phone, $otpCode);
        // - MSG91: $this->sendViaMsg91($phone, $otpCode);
        // - TextLocal: $this->sendViaTextLocal($phone, $otpCode);

        return true; // Return true for development
    }

    /**
     * Check rate limiting
     */
    private function checkRateLimit($contact, $method): bool
    {
        $key = "otp:{$method}:{$contact}";

        return RateLimiter::attempt(
            $key,
            config('otp.max_attempts_per_hour', 5),
            function() {},
            3600 // 1 hour
        );
    }

    /**
     * Clean up old OTPs for contact
     */
    private function cleanupOldOtps($contact, $method): void
    {
        OtpVerification::where($method, $contact)
            ->where('created_at', '<', now()->subMinutes(config('otp.expiry_minutes', 10)))
            ->delete();
    }

    /**
     * Update user verification status
     */
    private function updateUserVerificationStatus($contact, $method): void
    {
        $user = $method === 'phone'
            ? User::where('phone', $contact)->first()
            : User::where('email', $contact)->first();

        if ($user) {
            if ($method === 'phone') {
                $user->update(['phone_verified_at' => now()]);
            } else {
                $user->update(['email_verified_at' => now()]);
            }
        }
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
                    'password' => bcrypt(\Illuminate\Support\Str::random(16)), // Random password (not used)
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
                    'password' => bcrypt(\Illuminate\Support\Str::random(16)), // Random password (not used)
                    'status' => 1,
                ]);
            }

            return $user;
        }
    }

    /**
     * Get remaining time for rate limit
     */
    public function getRateLimitRemainingTime($contact, $method): int
    {
        $key = "otp:{$method}:{$contact}";
        return RateLimiter::availableIn($key);
    }

    /**
     * Mask contact information for logging
     */
    private function maskContact($contact, $method): string
    {
        if ($method === 'phone') {
            return strlen($contact) > 4
                ? substr($contact, 0, 2) . str_repeat('*', strlen($contact) - 4) . substr($contact, -2)
                : str_repeat('*', strlen($contact));
        } else {
            $parts = explode('@', $contact);
            if (count($parts) === 2) {
                $username = $parts[0];
                $domain = $parts[1];
                $maskedUsername = strlen($username) > 2
                    ? substr($username, 0, 1) . str_repeat('*', strlen($username) - 2) . substr($username, -1)
                    : str_repeat('*', strlen($username));
                return $maskedUsername . '@' . $domain;
            }
        }
        return str_repeat('*', strlen($contact));
    }

    /**
     * Hash OTP for database storage (optional security feature)
     */
    private function hashOtp($otp): string
    {
        return config('otp.security.hash_otp_in_database', false)
            ? hash('sha256', $otp)
            : $otp;
    }

    /**
     * Verify hashed OTP
     */
    private function verifyHashedOtp($inputOtp, $storedOtp): bool
    {
        if (config('otp.security.hash_otp_in_database', false)) {
            return hash('sha256', $inputOtp) === $storedOtp;
        }
        return $inputOtp === $storedOtp;
    }
}