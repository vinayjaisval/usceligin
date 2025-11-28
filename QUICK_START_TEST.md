# Quick Start Testing Guide

## 🚀 Fast Track: Test in 5 Minutes

### Prerequisites
- ✅ Database running on port 3307
- ✅ `.env` configured with OTP settings
- ✅ Server running (Laravel serve or XAMPP)

---

## Step-by-Step Test

### 1. Start Your Server
```bash
# Option A: Laravel Serve
php artisan serve

# Option B: Use XAMPP
# Just make sure Apache/MySQL is running
```

### 2. Clear Everything (Fresh Start)
```bash
php artisan cache:clear
php artisan config:clear
php artisan route:clear
```

### 3. Open Browser and Follow These Steps

#### ✅ Test 1: Add to Cart (Guest User)
1. Go to: `http://localhost/usceligin` (or `http://localhost:8000`)
2. Click on any product
3. Click "Add to Cart"
4. Go to cart: `/cart`

**Expected:** Cart shows your item(s)

---

#### ✅ Test 2: Try Checkout (Not Logged In)
5. Click **"Proceed to Checkout"**

**Expected:**
- 🔔 Toast: "Please login to proceed to checkout"
- 🔄 Redirect to `/sign-in` (NOT `/user/login`)
- ✅ Sign-in page loads (NO errors!)

---

#### ✅ Test 3: Sign In with OTP
6. On sign-in page, enter phone: **`9876543210`**
7. Click **"Send OTP"**
8. Enter OTP: **`123456`** (development code)
9. Click **"Verify OTP"**

**Expected:**
- ✅ Success message
- 🔄 Auto-redirect to checkout in 2 seconds
- OR click "Continue to Account" button

---

#### ✅ Test 4: Complete Checkout
10. You should now be on `/checkout` page

**Expected:**
- ✅ Cart items display
- ✅ Your address pre-fills (if you have one)
- ✅ Order summary shows correct total
- ✅ Payment methods available

11. Fill shipping address (if needed)
12. Leave "Same as shipping" checked
13. Select a payment method
14. Click **"Place your order"**

**Expected:**
- ✅ Validation passes
- ✅ Form submits (payment gateway response)

---

## 🎯 Success Indicators

### ✅ Everything Works If:
1. No "View [frontend.login] not found" error
2. Sign-in page loads properly
3. OTP verification works
4. After login, redirects to checkout
5. Cart items appear in checkout
6. Can fill addresses
7. Can select payment
8. Order placement doesn't throw errors

---

## ⚡ Quick Test Data

### Phone Numbers (Use any of these)
- `9876543210`
- `8765432109`
- `7654321098`

### OTP Code (Always use this in development)
- `123456`

### Email (If testing email OTP)
- `test@example.com`

---

## 🔍 Troubleshooting

### ❌ Problem: "View [frontend.login] not found"
**Fix:** Already fixed! Just clear cache:
```bash
php artisan view:clear
php artisan cache:clear
```

### ❌ Problem: OTP not received
**Fix:** Use development code `123456`

### ❌ Problem: Stuck on sign-in page
**Fix:** Check Laravel logs:
```bash
tail -f storage/logs/laravel.log
```

### ❌ Problem: Redirect loop
**Fix:**
1. Clear browser localStorage: `localStorage.clear()`
2. Clear sessionStorage: `sessionStorage.clear()`
3. Clear Laravel cache: `php artisan cache:clear`

---

## 📱 Test Saved Items Feature

### Save for Later Test
1. In cart, click "Save for Later" on any item
2. Item moves to "Saved for Later" section
3. Proceed to checkout
4. In checkout, find "Saved for Later" section
5. Click "Move to Cart"

**Expected:**
- ✅ Item returns to cart
- ✅ Page refreshes
- ✅ Updated total

---

## 🎨 Visual Checks

### Things to Look For:
- ✅ Clean, modern UI (Tailwind CSS)
- ✅ No rounded corners (sharp design)
- ✅ Orange accent color throughout
- ✅ Dark mode works (toggle in browser)
- ✅ Responsive on mobile (resize browser)
- ✅ Toast notifications appear
- ✅ Loading states show (spinners, "Processing...")

---

## 🐛 Common Issues & Quick Fixes

| Issue | Quick Fix |
|-------|-----------|
| Cart empty | Add products first! |
| OTP not working | Use `123456` |
| Page not found | Run `php artisan route:clear` |
| Assets not loading | Run `npm run build` |
| Database error | Check port 3307 |
| CSRF error | Clear cookies and cache |

---

## 📊 What To Check In Browser DevTools

### Console Tab
- ❌ No red errors
- ✅ May see some logs (normal)

### Network Tab
- ✅ All requests return 200 or 302
- ❌ No 404 or 500 errors

### Application > Storage
**localStorage:**
```javascript
savedForLater: [...]  // If you saved items
```

**sessionStorage:**
```javascript
cartMetadata: {...}
intendedUrl: "http://localhost/usceligin/checkout"
```

---

## 🎬 Video-Style Test Flow

```
Start → Homepage
  ↓
Add Product to Cart
  ↓
View Cart (/cart)
  ↓
Optional: Save Item for Later
  ↓
Click "Proceed to Checkout"
  ↓
[Not Logged In] → Redirect to /sign-in
  ↓
Enter Phone: 9876543210
  ↓
Click "Send OTP"
  ↓
Enter OTP: 123456
  ↓
Click "Verify OTP"
  ↓
✅ Success! → Auto-redirect to /checkout
  ↓
Fill Address (if needed)
  ↓
Select Payment Method
  ↓
Click "Place your order"
  ↓
🎉 Done!
```

---

## ⏱️ Expected Timings

- Add to cart: < 1 second
- Load cart page: < 2 seconds
- Redirect to sign-in: Instant
- Send OTP: < 3 seconds
- Verify OTP: < 2 seconds
- Load checkout: < 2 seconds
- Place order: < 3 seconds

**Total Time:** ~2-3 minutes for complete flow

---

## 📸 Screenshots to Take

If you're documenting:
1. Cart page with items
2. Sign-in page (clean, no errors)
3. OTP entry screen
4. Checkout page with all sections
5. Order summary
6. Success message (if applicable)

---

## 🎯 What Success Looks Like

### Perfect Run:
- ✅ Added 2 products to cart
- ✅ Saved 1 item for later
- ✅ Redirected to sign-in (no errors)
- ✅ Signed in with OTP
- ✅ Auto-redirected to checkout
- ✅ Saw cart items in checkout
- ✅ Saw saved items section
- ✅ Filled address
- ✅ Selected payment
- ✅ Order validated successfully

**Time Taken:** ~3 minutes
**Errors:** 0
**Status:** ✅ PASS

---

## 🚨 Stop Testing If You See:

1. "View [frontend.login] not found" ← Should be FIXED
2. Blank white page
3. 500 Internal Server Error
4. Database connection errors
5. Constant redirect loops

**Action:** Check `TESTING_GUIDE_CART_CHECKOUT.md` for detailed troubleshooting

---

## 📞 Get Help

### Check These First:
1. Laravel logs: `storage/logs/laravel.log`
2. Browser console (F12)
3. Network tab in DevTools

### Documentation:
- Full guide: `TESTING_GUIDE_CART_CHECKOUT.md`
- Integration: `CART_CHECKOUT_INTEGRATION.md`
- Changes: `CHANGES_SUMMARY.md`

---

## ✅ Final Checklist

Before you say "It Works!":
- [ ] Cart page loads
- [ ] Can add items to cart
- [ ] "Proceed to Checkout" works
- [ ] Sign-in page loads (NO ERRORS)
- [ ] OTP 123456 works
- [ ] Redirects to checkout after login
- [ ] Checkout shows cart items
- [ ] Can select payment method
- [ ] Validation works

---

**Happy Testing! 🎉**

If all checkboxes pass, you have a working cart-to-checkout flow!

---

**Created:** 2025-01-24
**For:** Development & QA Team
**Estimated Time:** 5-10 minutes for full test
