# Testing Guide: Cart to Checkout Flow

This guide provides step-by-step instructions for testing the complete cart-to-checkout flow with OTP authentication.

## Quick Summary of Changes

### Files Modified
1. **`resources/views/frontend/add-to-cart.blade.php`**
   - Updated login redirect to use `sign-in` route
   - Added sessionStorage for intended URL tracking
   - Enhanced prepareCheckout function

2. **`resources/views/frontend/checkout.blade.php`**
   - Complete checkout page created with all sections
   - Integration with cart localStorage/sessionStorage
   - Payment gateway integration ready

3. **`app/Http/Controllers/Front/CheckoutController.php`**
   - Fixed redirect to use `sign-in` route
   - Added session storage for intended URL

4. **`app/Http/Controllers/User/LoginController.php`**
   - Updated to use `sign-in` view instead of `login`

5. **`app/Http/Controllers/Auth/User/LoginController.php`**
   - Added redirect_url in OTP verify response
   - Support for intended URL after login

6. **`resources/views/frontend/sign-in.blade.php`**
   - Enhanced redirect logic to check sessionStorage
   - Support for post-checkout redirect

---

## Prerequisites

### 1. Environment Setup
Ensure your `.env` file has these settings:

```env
# Database
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3307
DB_DATABASE=us_devceligin_1nov25
DB_USERNAME=root
DB_PASSWORD=

# OTP Configuration (Development)
OTP_LENGTH=6
OTP_EXPIRY_MINUTES=10
OTP_DEVELOPMENT_CODE=123456
OTP_LOG_IN_DEVELOPMENT=true
```

### 2. Database Setup
Make sure your database is running on port 3307 and migrations are up to date:

```bash
php artisan migrate
```

### 3. Server Running
Start your development server:

**Option 1: Laravel Serve**
```bash
php artisan serve
```
Access at: `http://localhost:8000`

**Option 2: XAMPP/WAMP**
Access at: `http://localhost/usceligin`

---

## Testing Scenarios

### Scenario 1: Guest User - Cart to Checkout Flow

#### Step 1: Add Products to Cart
1. Navigate to homepage: `http://localhost/usceligin`
2. Browse products and click "Add to Cart" on any product
3. Go to cart page: `http://localhost/usceligin/cart`
4. Verify cart items display correctly

**Expected Result:**
- ✅ Products appear in cart
- ✅ Quantities can be updated
- ✅ Total price calculates correctly

#### Step 2: Save Item for Later (Optional)
1. In cart, click "Save for Later" on any item
2. Item should move to "Saved for Later" section

**Expected Result:**
- ✅ Item removed from main cart
- ✅ Item appears in "Saved for Later" section
- ✅ Data persists in localStorage

#### Step 3: Attempt Checkout (Unauthenticated)
1. Click "Proceed to Checkout" button
2. Should be redirected to sign-in page

**Expected Result:**
- ✅ Toast notification: "Please login to proceed to checkout"
- ✅ Redirect to: `http://localhost/usceligin/sign-in`
- ✅ Sign-in page loads correctly (no "View not found" error)
- ✅ Intended URL stored in sessionStorage

#### Step 4: Sign In with OTP
1. On sign-in page, enter phone number: `9876543210`
2. Click "Send OTP"
3. Check Laravel logs or use development OTP: `123456`
4. Enter OTP: `123456`
5. Click "Verify OTP"

**Expected Result:**
- ✅ OTP sent successfully message
- ✅ OTP verification screen appears
- ✅ Success message: "✓ OTP verified successfully! Redirecting..."
- ✅ Auto-redirect to checkout page after 2 seconds

#### Step 5: Complete Checkout
1. After redirect, verify you're on checkout page
2. Cart items should display in checkout
3. Saved items section appears if you saved items earlier

**Expected Result:**
- ✅ Checkout page loads: `http://localhost/usceligin/checkout`
- ✅ Cart items display correctly
- ✅ User address pre-filled (if available)
- ✅ Saved items can be moved back to cart
- ✅ Order summary shows correct totals

---

### Scenario 2: Authenticated User - Direct Checkout

#### Step 1: Sign In First
1. Navigate to: `http://localhost/usceligin/sign-in`
2. Sign in with OTP (phone: `9876543210`, OTP: `123456`)
3. You'll be redirected to homepage

#### Step 2: Add Products to Cart
1. Add products to cart from any product page
2. Navigate to cart page

#### Step 3: Proceed to Checkout
1. Click "Proceed to Checkout"

**Expected Result:**
- ✅ Direct redirect to checkout page (no login required)
- ✅ No authentication prompt
- ✅ User data pre-populated

---

### Scenario 3: Saved Items Management

#### Test Moving Items Back to Cart
1. In checkout page, if saved items exist
2. Click "Move to Cart" on any saved item

**Expected Result:**
- ✅ Item added back to cart via AJAX
- ✅ Page refreshes with updated cart
- ✅ Item removed from saved list
- ✅ localStorage updated

#### Test Removing Saved Items
1. Click "Remove" on any saved item

**Expected Result:**
- ✅ Item removed from saved list
- ✅ localStorage updated
- ✅ Toast notification shown

---

### Scenario 4: Order Placement

#### Step 1: Fill Shipping Address
1. If no address on file, fill shipping address form
2. Click "Save Address" (if editing)

**Expected Result:**
- ✅ Form validation works
- ✅ Address saved to sessionStorage
- ✅ Success toast appears

#### Step 2: Set Billing Address
1. Leave "Same as shipping" checked (default)
2. OR uncheck and fill different billing address

**Expected Result:**
- ✅ Billing form shows/hides correctly
- ✅ Validation works when different

#### Step 3: Select Payment Method
1. Choose a payment method from available gateways

**Expected Result:**
- ✅ Payment methods display
- ✅ Radio button selection works

#### Step 4: Place Order
1. Click "Place your order" button

**Expected Result:**
- ✅ Validation runs (address, payment method)
- ✅ Button shows "Processing..."
- ✅ Form data submits to payment gateway
- ✅ Error handling works if validation fails

---

## Creating Test Users

### Method 1: Using OTP Sign-In (Recommended)
The system auto-creates users on first OTP verification:

1. Go to sign-in page
2. Enter new phone number (e.g., `9123456789`)
3. Use development OTP: `123456`
4. User will be auto-created on successful verification

### Method 2: Database Insert (Manual)
Run this SQL in phpMyAdmin or MySQL client:

```sql
INSERT INTO `users` (
    `name`,
    `phone`,
    `email`,
    `email_verified`,
    `affilate_code`,
    `refferel_code`,
    `verification_link`,
    `created_at`,
    `updated_at`
) VALUES (
    'Test User',
    '9876543210',
    'testuser@example.com',
    'Yes',
    MD5(CONCAT('testuser@example.com', NOW())),
    MD5(CONCAT('testuser@example.com', RAND())),
    MD5(CONCAT('Test User', NOW())),
    NOW(),
    NOW()
);
```

### Method 3: Laravel Tinker
```bash
php artisan tinker
```

```php
$user = new App\Models\User;
$user->name = 'Test User';
$user->phone = '9876543210';
$user->email = 'test@example.com';
$user->email_verified = 'Yes';
$user->affilate_code = md5('test@example.com' . time());
$user->refferel_code = md5('test@example.com' . rand(1111, 9999));
$user->verification_link = md5('Test User' . time());
$user->save();
```

---

## Test Data Examples

### Valid Indian Phone Numbers
- `9876543210`
- `8765432109`
- `7654321098`
- `6543210987`

### Development OTP
Always use: `123456` (configured in `.env`)

### Test Products
Add products through admin panel or use existing seeded data.

---

## Expected Flow Diagram

```
┌─────────────────────────┐
│   Browse Products       │
│   (Homepage/Category)   │
└───────────┬─────────────┘
            │
            ↓
┌─────────────────────────┐
│   Add to Cart           │
│   (Product Detail)      │
└───────────┬─────────────┘
            │
            ↓
┌─────────────────────────┐
│   View Cart             │
│   /cart                 │
│                         │
│   - Update quantities   │
│   - Save for later      │
│   - Apply coupons       │
└───────────┬─────────────┘
            │
            ↓ Proceed to Checkout
            │
┌───────────┴─────────────┐
│   Check Authentication  │
└───────────┬─────────────┘
            │
     ┌──────┴──────┐
     │             │
  No Auth      Authenticated
     │             │
     ↓             ↓
┌─────────┐   ┌──────────────┐
│ Sign In │   │   Checkout   │
│ /sign-in│   │   /checkout  │
│         │   │              │
│ OTP     │   │ - Addresses  │
│ Verify  │   │ - Payment    │
└────┬────┘   │ - Summary    │
     │        └──────┬───────┘
     │               │
     └───────┬───────┘
             │
             ↓
     ┌──────────────┐
     │ Place Order  │
     └──────┬───────┘
            │
            ↓
     ┌──────────────┐
     │   Payment    │
     │   Gateway    │
     └──────┬───────┘
            │
            ↓
     ┌──────────────┐
     │   Success    │
     │   Page       │
     └──────────────┘
```

---

## Troubleshooting

### Issue 1: "View [frontend.login] not found"
**Solution:** ✅ FIXED
- Updated `LoginController` to use `frontend.sign-in`
- Use route `sign-in` instead of `user.login`

### Issue 2: Redirect Loop After Login
**Cause:** Intended URL not clearing
**Solution:**
- Check sessionStorage is being cleared
- Verify `session()->forget('url.intended')` in LoginController

### Issue 3: Cart Items Not Showing in Checkout
**Cause:** Cart session not available
**Solution:**
- Ensure you have items in cart before checkout
- Check Laravel session is working
- Verify route points to correct controller

### Issue 4: OTP Not Received
**Development Mode:**
- Use hardcoded OTP: `123456`
- Check `.env` has `OTP_DEVELOPMENT_CODE=123456`

**Production Mode:**
- Check SMS API credentials
- Verify phone number format
- Check Laravel logs: `storage/logs/laravel.log`

### Issue 5: Saved Items Not Persisting
**Cause:** localStorage disabled or full
**Solution:**
- Check browser allows localStorage
- Clear localStorage: `localStorage.clear()`
- Try different browser

### Issue 6: Payment Gateway Errors
**Cause:** Gateway not configured
**Solution:**
- Configure payment gateway in admin panel
- Ensure gateway is active
- Check API credentials in database

---

## Testing Checklist

### Pre-Checkout
- [ ] Can add products to cart
- [ ] Cart displays correct items and prices
- [ ] Quantity update works
- [ ] Remove from cart works
- [ ] Save for later works
- [ ] Saved items persist on page reload

### Authentication Flow
- [ ] Unauthenticated users redirected to sign-in
- [ ] Sign-in page loads without errors
- [ ] OTP can be requested for phone
- [ ] OTP can be requested for email
- [ ] Development OTP (123456) works
- [ ] OTP verification succeeds
- [ ] Auto-redirect to checkout after login
- [ ] Intended URL preserved

### Checkout Page
- [ ] Checkout page loads for authenticated users
- [ ] Cart items display correctly
- [ ] Saved items section appears if items exist
- [ ] Can move saved items back to cart
- [ ] User address pre-fills if available
- [ ] Shipping address form works
- [ ] Billing address toggle works
- [ ] Order summary calculates correctly
- [ ] Payment methods display
- [ ] Can select payment method

### Order Placement
- [ ] Form validation works
- [ ] Address validation works
- [ ] Payment method validation works
- [ ] Submit button disables during processing
- [ ] Error messages display correctly
- [ ] Success redirect works

### Data Persistence
- [ ] localStorage data survives page reload
- [ ] sessionStorage clears on order completion
- [ ] Cart session maintained across pages
- [ ] Coupon codes persist (if applied)

---

## Performance Testing

### Page Load Times
- **Cart Page:** < 2 seconds
- **Checkout Page:** < 2 seconds
- **Sign-in Page:** < 1 second

### AJAX Operations
- **Add to Cart:** < 1 second
- **Update Quantity:** < 1 second
- **OTP Send:** < 3 seconds
- **OTP Verify:** < 2 seconds

---

## Browser Compatibility

Test on multiple browsers:
- ✅ Chrome/Edge (Latest)
- ✅ Firefox (Latest)
- ✅ Safari (Latest - Mac only)
- ✅ Mobile Chrome (Android)
- ✅ Mobile Safari (iOS)

---

## Security Considerations

### What's Protected
- ✅ CSRF protection on all forms
- ✅ OTP expiry (10 minutes)
- ✅ Rate limiting on OTP requests
- ✅ Open redirect prevention
- ✅ XSS protection via Blade escaping
- ✅ SQL injection protection via Eloquent

### What to Test
- [ ] CSRF token validates
- [ ] Expired OTP rejected
- [ ] Invalid OTP rejected
- [ ] Rate limiting works
- [ ] External redirects blocked
- [ ] Injection attempts fail

---

## Success Criteria

### All Tests Pass When:
1. ✅ Guest users can add to cart
2. ✅ Unauthenticated checkout redirects to sign-in
3. ✅ Sign-in page loads (no view errors)
4. ✅ OTP authentication works
5. ✅ Post-login redirects to checkout
6. ✅ Checkout displays cart correctly
7. ✅ Address forms work
8. ✅ Payment selection works
9. ✅ Order can be placed
10. ✅ Data persists correctly

---

## Quick Start Testing Script

Run these steps in order for a complete test:

```bash
# 1. Clear cache
php artisan cache:clear
php artisan config:clear
php artisan route:clear

# 2. Ensure assets are built
npm run build
# OR for development
npm run dev

# 3. Start server
php artisan serve
```

Then in browser:
1. Visit: `http://localhost:8000`
2. Add product to cart
3. Go to cart: `http://localhost:8000/cart`
4. Click "Proceed to Checkout"
5. Sign in with phone: `9876543210`
6. Enter OTP: `123456`
7. Verify redirect to checkout
8. Fill address if needed
9. Select payment method
10. Click "Place your order"

---

## Support & Documentation

### Related Files
- **Cart Page:** `resources/views/frontend/add-to-cart.blade.php`
- **Checkout Page:** `resources/views/frontend/checkout.blade.php`
- **Sign-in Page:** `resources/views/frontend/sign-in.blade.php`
- **Integration Doc:** `CART_CHECKOUT_INTEGRATION.md`

### Laravel Commands
```bash
# View routes
php artisan route:list | grep checkout
php artisan route:list | grep sign-in

# Clear everything
php artisan optimize:clear

# View logs
tail -f storage/logs/laravel.log
```

### Browser DevTools
- **Console:** Check for JavaScript errors
- **Network:** Monitor AJAX requests
- **Application:** Check localStorage/sessionStorage
- **Console Commands:**
  ```javascript
  // View saved items
  console.log(localStorage.getItem('savedForLater'));

  // View cart metadata
  console.log(sessionStorage.getItem('cartMetadata'));

  // View intended URL
  console.log(sessionStorage.getItem('intendedUrl'));
  ```

---

## Next Steps After Testing

1. **Production Deployment:**
   - Configure real SMS gateway
   - Set production OTP settings
   - Enable payment gateways
   - Update `.env` for production

2. **Optional Enhancements:**
   - Guest checkout option
   - Multiple address support
   - Coupon system integration
   - Email notifications
   - Order tracking

3. **Performance Optimization:**
   - Enable Laravel caching
   - Optimize database queries
   - Add CDN for assets
   - Implement Redis for sessions

---

**Last Updated:** 2025-01-24
**Version:** 1.0
**Status:** Ready for Testing
