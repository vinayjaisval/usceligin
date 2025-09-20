# 🔐 OTP-Based Sign-In System

A secure, server-side OTP authentication system for CELIGIN platform that replaces client-side OTP generation with robust email/SMS verification.

---

## 📋 Quick Overview

### **What This System Does:**
- ✅ Generates secure OTPs server-side (no client-side generation)
- ✅ Sends OTP via Email (SMS ready for future)
- ✅ Validates user identity with 6-digit codes
- ✅ Rate limiting and security protection
- ✅ Session management with "keep me signed in"

### **Technologies Used:**
- **Backend**: Laravel 10, PHP 8.1+
- **Database**: MySQL (XAMPP)
- **Email**: SMTP (Gmail for development)
- **Frontend**: Vanilla JavaScript with AJAX
- **Security**: CSRF, Rate limiting, Input validation

---

## 🗂️ Files Structure

### **📁 Database Files**
```
database/migrations/
├── 2024_09_19_000001_create_otp_verifications_table.php    # OTP storage table
└── 2024_09_19_000002_add_phone_verification_to_users_table.php    # User phone fields
```

### **📁 Models**
```
app/Models/
├── OtpVerification.php    # OTP lifecycle management
└── User.php              # Updated with phone verification methods
```

### **📁 Business Logic**
```
app/Services/
└── OtpService.php         # Core OTP generation, sending, verification logic
```

### **📁 Controllers**
```
app/Http/Controllers/Auth/
└── OtpController.php      # API endpoints for OTP flow
```

### **📁 Validation**
```
app/Http/Requests/
├── SendOtpRequest.php     # Validates OTP sending requests
└── VerifyOtpRequest.php   # Validates OTP verification requests
```

### **📁 Frontend**
```
resources/views/
├── frontend/sign-in-secure.blade.php    # New secure sign-in page
└── emails/otp.blade.php                 # OTP email template
```

### **📁 Configuration**
```
config/
└── otp.php               # OTP system configuration

routes/
└── web.php               # OTP routes (updated)

.env                      # Environment variables (updated)
```

### **📁 Setup & Testing**
```
database_setup.sql        # Manual database setup
test_otp_setup.php       # System verification script
```

---

## 🔄 How OTP System Works

### **Step 1: User Requests OTP**
```
User enters phone/email → SendOtpRequest validates → OtpService generates OTP → Email/SMS sent
```

### **Step 2: OTP Generation Process**
```php
// OtpService.php
1. Check rate limiting (5 attempts/hour)
2. Clean up old OTPs
3. Generate 6-digit random OTP
4. Store in database with expiry (10 minutes)
5. Send via email/SMS
6. Log for development (masked contact info)
```

### **Step 3: User Verifies OTP**
```
User enters OTP → VerifyOtpRequest validates → OtpService verifies → User authenticated
```

### **Step 4: OTP Verification Process**
```php
// OtpService.php
1. Find valid OTP in database
2. Check expiry and usage status
3. Verify code matches
4. Mark as used
5. Update user verification status
6. Log user in with session
```

---

## 🛠️ Quick Setup Guide

### **1. Start XAMPP**
```bash
# Start MySQL (port 3307) and Apache
```

### **2. Run Database Setup**
```bash
cd C:\xampp\htdocs\usceligin
php artisan migrate
```

### **3. Configure Email (.env)**
```env
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_USERNAME=your-email@gmail.com
MAIL_PASSWORD=your-app-password
MAIL_FROM_ADDRESS="noreply@celigin.com"

# OTP Settings
OTP_DEVELOPMENT_CODE=123456
OTP_EXPIRY_MINUTES=10
```

### **4. Test Setup**
Visit: `http://localhost/usceligin/test_otp_setup.php`

### **5. Test OTP Flow**
Visit: `http://localhost/usceligin/public/sign-in`

---

## 🎯 Key Components Explained

### **OtpService.php - The Heart of the System**
```php
generateAndSendOtp()     // Creates and sends OTP
verifyOtp()              // Validates OTP code
checkRateLimit()         // Prevents abuse
cleanupOldOtps()         // Maintains database
```

### **OtpController.php - API Endpoints**
```php
POST /otp/send          // Send OTP to user
POST /otp/verify        // Verify OTP code
POST /otp/resend        // Resend OTP
POST /user/check        // Check if user exists
```

### **Database Tables**
```sql
otp_verifications       // Stores OTP codes, attempts, expiry
users                   // Updated with phone_verified_at, etc.
```

### **Frontend (sign-in-secure.blade.php)**
```javascript
// AJAX-based, no client-side OTP generation
SecureSignInPage.handleSubmit()    // Sends OTP request
SecureSignInPage.verifyOtp()       // Verifies OTP code
```

---

## 🔐 Security Features

### **Server-Side Security**
- ✅ OTP generated server-side only
- ✅ CSRF protection on all requests
- ✅ Rate limiting (5 OTP/hour, 10 verify/minute)
- ✅ IP and user agent tracking
- ✅ Contact info masking in logs

### **Validation & Protection**
- ✅ Phone format validation (Indian mobile)
- ✅ Email format validation
- ✅ OTP expiry (10 minutes)
- ✅ Max 3 verification attempts per OTP
- ✅ Automatic cleanup of expired OTPs

---

## 📧 Email vs SMS Testing

### **Email Testing (Current)**
```
1. Enter email at /sign-in
2. Check inbox for OTP email
3. Enter 6-digit code
4. Successfully authenticated
```

### **Phone Testing (Development)**
```
1. Enter phone number
2. Check storage/logs/laravel.log for OTP
3. Or use development OTP: 123456
4. Enter code to authenticate
```

### **SMS Integration (Future)**
```php
// In OtpService.php - ready for SMS providers
SMS_PROVIDER=twilio    // or msg91, textlocal
SMS_ENABLED=true
```

---

## 🐛 Common Issues & Solutions

### **Database Connection**
```bash
# Check MySQL running on port 3307
php artisan tinker
DB::connection()->getPdo();
```

### **Email Not Sending**
```
1. Check Gmail app password (not regular password)
2. Enable 2FA on Gmail account
3. Check storage/logs/laravel.log for errors
```

### **OTP Not Working**
```
1. Check OTP hasn't expired (10 minutes)
2. Verify 6-digit format
3. Check attempt limit (max 3 tries)
4. Look for rate limiting (max 5 OTP/hour)
```

### **Routes Not Found**
```bash
php artisan route:clear
php artisan route:cache
php artisan route:list | grep otp
```

---

## 🚀 For Production

### **Essential Changes**
```env
APP_DEBUG=false
APP_KEY=generate-new-key
# Use production email service (not Gmail)
# Add SMS provider credentials
```

### **Security Checklist**
- [ ] SSL/HTTPS enabled
- [ ] Production email service configured
- [ ] SMS provider integrated
- [ ] Rate limiting configured for scale
- [ ] Monitoring and alerts set up
- [ ] Database backups automated

---

## 🧪 Testing Files

### **test_otp_setup.php**
```
Verifies: Database → Tables → Models → Config → Email
Usage: http://localhost/usceligin/test_otp_setup.php
```

### **database_setup.sql**
```
Manual database setup if migrations fail
Contains: Table creation + indexes + test data
```

---

## 💡 Developer Tips

### **Development Flow**
1. Use `test_otp_setup.php` first to verify setup
2. Check logs: `storage/logs/laravel.log` for OTP codes
3. Use development OTP `123456` for quick testing
4. Test email flow before implementing SMS

### **Debugging**
```php
// Check OTP in logs
Log::info('OTP Generated', ['otp' => $otpCode]);

// Test email configuration
php artisan tinker
Mail::raw('Test', function($message) {
    $message->to('test@example.com')->subject('Test');
});
```

### **Customization**
```php
// config/otp.php - Adjust these as needed
'length' => 6,                    // OTP length
'expiry_minutes' => 10,           // How long OTP is valid
'max_attempts_per_hour' => 5,     // Rate limiting
'development_otp' => '123456',    // Fixed OTP for testing
```

---

## 📞 Support

**For Issues:**
1. Run `test_otp_setup.php` first
2. Check `storage/logs/laravel.log`
3. Verify XAMPP MySQL is running (port 3307)
4. Confirm email settings in `.env`

**Quick Test:**
Email OTP → Check inbox → Enter code → Success ✅

---

*Last Updated: September 19, 2024*
*Version: 1.0.0*
*Ready for Development & Testing*