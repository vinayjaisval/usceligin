<?php
/**
 * OTP System Test Script
 * Run this file to test the OTP system setup
 * Access via: http://localhost/usceligin/test_otp_setup.php
 */

// Include Laravel's bootstrap
require_once 'vendor/autoload.php';

$app = require_once 'bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;
use App\Models\OtpVerification;

echo "<h1>CELIGIN OTP System Test</h1>";
echo "<style>body{font-family:Arial;margin:20px;} .success{color:green;} .error{color:red;} .info{color:blue;}</style>";

try {
    // Test 1: Database Connection
    echo "<h2>1. Database Connection Test</h2>";
    $connection = DB::connection();
    $connection->getPdo();
    echo "<p class='success'>✅ Database connection successful!</p>";

    // Test 2: Check if tables exist
    echo "<h2>2. Table Structure Test</h2>";

    if (Schema::hasTable('otp_verifications')) {
        echo "<p class='success'>✅ otp_verifications table exists</p>";

        // Check columns
        $otpColumns = ['id', 'phone', 'email', 'otp_code', 'expires_at', 'attempts', 'verified_at', 'ip_address', 'user_agent', 'type', 'method', 'is_used', 'created_at', 'updated_at'];
        foreach ($otpColumns as $column) {
            if (Schema::hasColumn('otp_verifications', $column)) {
                echo "<p class='info'>  ✓ Column '$column' exists</p>";
            } else {
                echo "<p class='error'>  ✗ Column '$column' missing</p>";
            }
        }
    } else {
        echo "<p class='error'>❌ otp_verifications table missing</p>";
        echo "<p class='info'>Run: php artisan migrate</p>";
    }

    // Check users table columns
    if (Schema::hasTable('users')) {
        echo "<p class='success'>✅ users table exists</p>";

        $userColumns = ['phone', 'phone_verified_at', 'last_otp_sent_at', 'otp_attempts_count', 'is_phone_primary'];
        foreach ($userColumns as $column) {
            if (Schema::hasColumn('users', $column)) {
                echo "<p class='info'>  ✓ Column '$column' exists</p>";
            } else {
                echo "<p class='error'>  ✗ Column '$column' missing</p>";
            }
        }
    }

    // Test 3: Model Tests
    echo "<h2>3. Model Test</h2>";

    try {
        $userCount = User::count();
        echo "<p class='success'>✅ User model works - Found $userCount users</p>";
    } catch (Exception $e) {
        echo "<p class='error'>❌ User model error: " . $e->getMessage() . "</p>";
    }

    try {
        $otpCount = OtpVerification::count();
        echo "<p class='success'>✅ OtpVerification model works - Found $otpCount OTP records</p>";
    } catch (Exception $e) {
        echo "<p class='error'>❌ OtpVerification model error: " . $e->getMessage() . "</p>";
    }

    // Test 4: Configuration Test
    echo "<h2>4. Configuration Test</h2>";

    $configs = [
        'app.name' => config('app.name'),
        'app.env' => config('app.env'),
        'app.debug' => config('app.debug') ? 'true' : 'false',
        'database.default' => config('database.default'),
        'mail.mailers.smtp.host' => config('mail.mailers.smtp.host'),
        'otp.length' => config('otp.length'),
        'otp.expiry_minutes' => config('otp.expiry_minutes'),
    ];

    foreach ($configs as $key => $value) {
        echo "<p class='info'>$key: " . ($value ?: 'not set') . "</p>";
    }

    // Test 5: Route Test
    echo "<h2>5. Routes Test</h2>";
    echo "<p class='info'>Test these URLs manually:</p>";
    echo "<ul>";
    echo "<li><a href='/sign-in'>Sign-In Page: /sign-in</a></li>";
    echo "<li>POST /otp/send - Send OTP</li>";
    echo "<li>POST /otp/verify - Verify OTP</li>";
    echo "<li>POST /otp/resend - Resend OTP</li>";
    echo "</ul>";

    // Test 6: Email Configuration
    echo "<h2>6. Email Configuration</h2>";
    $mailHost = config('mail.mailers.smtp.host');
    $mailFrom = config('mail.from.address');

    if ($mailHost && $mailFrom) {
        echo "<p class='success'>✅ Email configured</p>";
        echo "<p class='info'>Host: $mailHost</p>";
        echo "<p class='info'>From: $mailFrom</p>";
    } else {
        echo "<p class='error'>❌ Email not properly configured</p>";
        echo "<p class='info'>Update MAIL_* settings in .env</p>";
    }

    echo "<h2>7. Next Steps</h2>";
    echo "<ol>";
    echo "<li>If tables are missing, run: <code>php artisan migrate</code></li>";
    echo "<li>Configure email settings in .env file</li>";
    echo "<li>Test the sign-in page at <a href='/sign-in'>/sign-in</a></li>";
    echo "<li>Check logs in storage/logs/laravel.log for OTP codes</li>";
    echo "</ol>";

} catch (Exception $e) {
    echo "<p class='error'>❌ Error: " . $e->getMessage() . "</p>";
    echo "<p class='info'>Make sure XAMPP MySQL is running and database exists.</p>";
}

echo "<hr><p><small>Test completed at " . date('Y-m-d H:i:s') . "</small></p>";
?>