<?php

return [

    /*
    |--------------------------------------------------------------------------
    | OTP Configuration
    |--------------------------------------------------------------------------
    |
    | Here you may configure the OTP settings for your application.
    |
    */

    // OTP length (default: 6 digits)
    'length' => env('OTP_LENGTH', 6),

    // OTP expiry time in minutes (default: 10 minutes)
    'expiry_minutes' => env('OTP_EXPIRY_MINUTES', 10),

    // Maximum OTP attempts per hour
    'max_attempts_per_hour' => env('OTP_MAX_ATTEMPTS_PER_HOUR', 5),

    // Maximum verification attempts per OTP
    'max_verification_attempts' => env('OTP_MAX_VERIFICATION_ATTEMPTS', 3),

    // Development OTP (for testing without SMS)
    'development_otp' => env('OTP_DEVELOPMENT_CODE', '123456'),

    // SMS Configuration
    'sms' => [
        'enabled' => env('SMS_ENABLED', false),
        'provider' => env('SMS_PROVIDER', 'log'), // log, twilio, msg91, textlocal

        // Twilio Configuration
        'twilio' => [
            'sid' => env('TWILIO_SID'),
            'token' => env('TWILIO_TOKEN'),
            'from' => env('TWILIO_FROM'),
        ],

        // MSG91 Configuration
        'msg91' => [
            'auth_key' => env('MSG91_AUTH_KEY'),
            'sender_id' => env('MSG91_SENDER_ID'),
            'route' => env('MSG91_ROUTE', '4'),
        ],

        // TextLocal Configuration
        'textlocal' => [
            'api_key' => env('TEXTLOCAL_API_KEY'),
            'sender' => env('TEXTLOCAL_SENDER', 'CELIGIN'),
        ],
    ],

    // Email Configuration
    'email' => [
        'enabled' => env('EMAIL_OTP_ENABLED', true),
        'from_address' => env('MAIL_FROM_ADDRESS', 'noreply@celigin.com'),
        'from_name' => env('MAIL_FROM_NAME', 'CELIGIN'),
        'subject' => 'Your CELIGIN Verification Code',
    ],

    // Rate Limiting
    'rate_limiting' => [
        'enabled' => env('OTP_RATE_LIMITING_ENABLED', true),
        'max_requests_per_hour' => env('OTP_MAX_REQUESTS_PER_HOUR', 5),
        'block_duration_minutes' => env('OTP_BLOCK_DURATION_MINUTES', 60),
    ],

    // Security
    'security' => [
        'hash_otp_in_database' => env('OTP_HASH_IN_DATABASE', false),
        'log_otp_in_development' => env('OTP_LOG_IN_DEVELOPMENT', true),
        'cleanup_expired_otps' => env('OTP_CLEANUP_EXPIRED', true),
        'cleanup_interval_hours' => env('OTP_CLEANUP_INTERVAL_HOURS', 24),
    ],

    // Default country code for phone numbers
    'default_country_code' => env('DEFAULT_COUNTRY_CODE', '91'),

    // Allowed countries (empty array means all countries allowed)
    'allowed_countries' => [
        '91', // India
        // Add more country codes as needed
    ],

];