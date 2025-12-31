# Route Security Documentation

This document outlines the authentication and authorization security measures implemented across all routes in the application.

## Security Overview

All routes have been secured according to industry best practices:

1. **Guest-Only Routes**: Login pages redirect authenticated users to their dashboard
2. **Protected Routes**: Require authentication, redirect unauthenticated users to login
3. **Public Routes**: Accessible to everyone without authentication

---

## Authentication Middleware Applied

### 1. Guest Middleware (`guest`)
Redirects already authenticated users away from login pages.

**Routes Protected:**
- `GET /sign-in` → Login page (redirects logged-in users to `/myaccount`)

### 2. Auth Middleware (`auth`)
Requires users to be logged in. Redirects unauthenticated users to `/sign-in`.

**Routes Protected:**

#### User Account Section
- `GET /myaccount` → User dashboard
- `POST /myaccount/update` → Update user profile
- `POST /myaccount/addresses` → Create new address
- `PUT /myaccount/addresses/{id}` → Update address
- `DELETE /myaccount/addresses/{id}` → Delete address
- `POST /myaccount/addresses/{id}/set-default` → Set default address

#### Checkout Section
- `GET /checkout` → Checkout page
- `GET /buy-now/{id}` → Buy now (quick checkout)
- `GET /checkout/payment/{slug1}/{slug2}` → Load payment gateway
- `GET /checkout/payment/return` → Payment return handler
- `GET /checkout/payment/cancle` → Payment cancellation
- `GET /checkout/payment/wallet-check` → Wallet balance check
- `GET /payment/status` → Payment status page

#### Payment Gateway Submissions (ALL Protected)
**Paypal:**
- `POST /checkout/payment/paypal/submit`
- `GET /checkout/payment/paypal-notify`

**Stripe:**
- `POST /checkout/payment/stripe-submit`
- `GET /payment/stripe/notify`

**Instamojo:**
- `POST /checkout/payment/instamojo-submit`
- `GET /checkout/payment/instamojo-notify`

**Paystack:**
- `POST /checkout/payment/paystack-submit`

**PayTM:**
- `POST /checkout/payment/paytm-submit`
- `POST /checkout/payment/paytm-notify`

**Mollie:**
- `POST /checkout/payment/molly-submit`
- `GET /checkout/payment/molly-notify`

**RazorPay:**
- `GET|POST /checkout/payment/razorpay-submit`
- `POST /checkout/payment/razorpay-notify`

**Authorize.Net:**
- `POST /checkout/payment/authorize-submit`

**Mercadopago:**
- `POST /checkout/payment/mercadopago-submit`

**Flutterwave:**
- `POST /checkout/payment/flutter-submit`

**SSLCommerz:**
- `POST /checkout/payment/ssl-submit`
- `POST /checkout/payment/ssl-notify`

**Voguepay:**
- `POST /checkout/payment/voguepay-submit`

**Wallet:**
- `POST /checkout/payment/wallet-submit`

**Manual Payment:**
- `POST /checkout/payment/manual-submit`

**Cash on Delivery:**
- `POST /checkout/payment/cod-submit`

**Flutterwave Notify Routes:**
- `POST /dflutter/notify` (Deposit)
- `POST /uflutter/notify` (Subscription)
- `POST /cflutter/notify` (Checkout)

#### Logout
- `POST /logout` → User logout

---

## Public Routes (No Authentication Required)

These routes are accessible to all users without login:

### Frontend Pages
- `GET /` → Homepage
- `GET /sign-in` → Login page (guests only)
- `GET /blog` → Blog listing
- `GET /blog/{slug}` → Blog post
- `GET /contact` → Contact page
- `GET /faq` → FAQ page
- `GET /about` → About page
- `GET /brand-story` → Brand story
- `GET /testimonial` → Testimonials

### Product Catalog
- `GET /categories` → All categories
- `GET /category/{category?}/{subcategory?}/{childcategory?}` → Category page
- `GET /new-arrivals` → New arrivals
- `GET /best-sellers` → Best sellers
- `GET /sales` → Sale products
- `GET /skin-care` → Skin care products
- `GET /search` → Product search
- `GET /item/{slug}` → Product details

### Shopping Cart (Session-based)
- `GET /carts` → View cart
- `GET /addtocart/{id}` → Add to cart
- `POST /addnumcart` → Add with quantity
- `GET /removecart/{id}` → Remove from cart
- `GET /addbyone` → Increase quantity
- `GET /reducebyone` → Decrease quantity

### Wishlist (Session-based for guests)
- `GET /wishlist` → View wishlist
- `GET /addwishlist/{id}` → Add to wishlist
- `GET /addtowishlist/{id}` → Quick add to wishlist

### Compare
- `GET /item/compare/view` → View comparison
- `GET /item/compare/add/{id}` → Add to compare
- `GET /item/compare/remove/{id}` → Remove from compare

### CELIGIN Club
- `GET /celigin-join-club` → Club information
- `GET /join-now-club` → Join club page
- `POST /join-now-club-store` → Submit club registration

---

## Rate Limiting

### OTP Routes (Throttled)

**5 requests per minute:**
- `POST /otp/send` → Send OTP
- `POST /otp/resend` → Resend OTP

**10 requests per minute:**
- `POST /otp/verify` → Verify OTP
- `POST /user/check` → Check user existence

---

## Redirect Behavior

### When NOT Authenticated:
1. User tries to access `/myaccount`
2. Middleware intercepts the request
3. User redirected to `/sign-in`
4. Intended URL stored in session: `session(['url.intended' => '/myaccount'])`
5. After successful login → Redirected back to `/myaccount`

### When Already Authenticated:
1. User tries to access `/sign-in`
2. Guest middleware intercepts
3. User redirected to `/myaccount` (their dashboard)

---

## Security Best Practices Implemented

✅ **Authentication Required for Sensitive Operations**
- All payment submissions require authentication
- Account management requires authentication
- Checkout process requires authentication

✅ **Guest Protection**
- Login pages redirect authenticated users

✅ **Rate Limiting**
- OTP endpoints throttled to prevent abuse
- 5 requests/minute for sending OTP
- 10 requests/minute for verification

✅ **Session Management**
- Intended URL stored for post-login redirect
- Proper logout handling

✅ **CSRF Protection**
- All POST/PUT/DELETE routes protected by CSRF middleware
- Included in `web` middleware group

✅ **Input Validation**
- Controller-level validation for all form submissions
- Phone number format validation
- Email validation
- Address validation

---

## Testing the Security

### Test 1: Access Protected Route Without Login
```
1. Clear browser cookies
2. Try: http://localhost/usceligin/myaccount
3. Expected: Redirect to http://localhost/usceligin/sign-in
```

### Test 2: Access Login When Already Logged In
```
1. Login via /sign-in
2. Try: http://localhost/usceligin/sign-in
3. Expected: Redirect to http://localhost/usceligin/myaccount
```

### Test 3: Post-Login Redirect
```
1. While logged out, try: http://localhost/usceligin/myaccount
2. Get redirected to login
3. Complete OTP login
4. Expected: Redirect back to http://localhost/usceligin/myaccount
```

### Test 4: Checkout Flow
```
1. Add items to cart
2. Try: http://localhost/usceligin/checkout (without login)
3. Expected: Redirect to login
4. After login → Return to checkout page
```

---

## Migration from Previous Setup

### Changes Made:

1. **Guest Middleware Added:**
   - Sign-in route now has `guest` middleware
   - Redirects to `user.account` instead of `user-dashboard`

2. **Auth Middleware Applied:**
   - All payment submission routes wrapped in `auth` middleware group
   - Payment status page requires authentication

3. **Controller-Level Protection:**
   - `AccountController::index()` has explicit Auth::check()
   - Provides graceful redirect if middleware fails

4. **Cache Cleared:**
   - Route cache cleared
   - Config cache cleared
   - View cache cleared

---

## Maintenance

When adding new routes:

1. **Public routes** → No middleware needed
2. **Login/Register routes** → Use `guest` middleware
3. **User-specific routes** → Use `auth` middleware
4. **Payment routes** → Always use `auth` middleware
5. **API routes** → Use `auth:sanctum` or `auth:api`

---

**Last Updated:** 2025-12-21
**Status:** ✅ Production Ready
**Security Level:** Industry Standard
