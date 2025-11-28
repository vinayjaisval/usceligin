# Cart & Wishlist Debugging Guide

## 🔍 Issues Fixed

### Issue #1: Incorrect API URLs ✅ FIXED
**Before:** `/celiginus/addcart/{id}` (404 error)
**After:** `/addcart/{id}` (correct)

### Issue #2: Event Listeners Not Working on Dynamic Content ✅ FIXED
**Before:** Direct event listeners attached only to buttons that exist on page load
**After:** Event delegation on document level (works with Swiper carousels, AJAX content, etc.)

### Issue #3: No Debugging Information ✅ FIXED
**Added:** Console logging for all requests and responses

---

## 🧪 How to Test (Step-by-Step)

### Step 1: Open Browser Console
1. Open your browser (Chrome, Firefox, Edge)
2. Press `F12` or `Ctrl+Shift+I` to open Developer Tools
3. Click on the **Console** tab
4. Keep it open while testing

### Step 2: Test Add to Cart
1. Go to **homepage** (`http://localhost/usceligin`)
2. Find any product card
3. Click **"Add to Cart"** button
4. **Check Console** for these messages:
   ```
   [CartWishlistManager] Initialized successfully
   [CartWishlistManager] Event delegation attached to document for cart and wishlist buttons
   [CartWishlistManager] Making request to: /addcart/123
   [CartWishlistManager] Response status: 200
   [CartWishlistManager] Response data: {success: true, message: "...", cart_count: 1}
   ```
5. **Expected Results:**
   - ✅ Green success notification appears
   - ✅ Cart counter in header updates (number increases)
   - ✅ No errors in console

### Step 3: Test Wishlist
1. On the same page, click the **heart icon** (wishlist button)
2. **Check Console** for:
   ```
   [CartWishlistManager] Making request to: /addwishlist/123
   [CartWishlistManager] Response status: 200
   [CartWishlistManager] Response data: {success: true, message: "...", wishlist_count: 1}
   ```
3. **Expected Results:**
   - ✅ Success notification
   - ✅ Wishlist counter updates

### Step 4: Verify Cart Page
1. Click the **cart icon** in header
2. Should redirect to `/add-to-cart`
3. **Expected:** Product appears in cart

### Step 5: Verify Wishlist Page
1. Click the **wishlist icon** in header
2. Should redirect to `/my-wishlist`
3. **Expected:** Product appears in wishlist

---

## 🐛 Common Issues & Solutions

### Issue: No console messages appear
**Problem:** JavaScript not loading
**Solution:**
1. Check browser console for JavaScript errors
2. Verify file exists: `public/assets/frontend/js/cart-wishlist-manager.js`
3. Hard refresh: `Ctrl+F5` or `Ctrl+Shift+R`
4. Clear browser cache

### Issue: "Product ID not found" error
**Problem:** Product card missing `data-id` attribute
**Solution:**
1. Inspect the button element (right-click → Inspect)
2. Check if it has `data-id="123"` attribute
3. If missing, check product card component

### Issue: 404 Error in console
**Problem:** Route not found
**Solution:**
1. Check console for exact URL being called
2. Verify routes are registered: Test manually in browser:
   - Visit: `http://localhost/usceligin/addcart/1`
   - Should return JSON, not 404
3. If 404, run: `php artisan route:clear`

### Issue: 500 Error
**Problem:** Server error in Laravel
**Solution:**
1. Check Laravel logs: `storage/logs/laravel.log`
2. Common causes:
   - Database connection error
   - Product not found in database
   - Session not working

### Issue: Toastr notification not showing
**Problem:** Toastr library not loaded
**Solution:**
1. Check browser console for toastr errors
2. Verify in `footer.blade.php`:
   ```html
   <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
   ```
3. Check in `header.blade.php`:
   ```html
   <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
   ```

### Issue: Counter not updating
**Problem:** Counter elements not found
**Solution:**
1. Check browser console for element IDs
2. Verify these elements exist in `header.blade.php`:
   - `#cart-count`
   - `#cart-count-mobile`
   - `#wishlist-count`
   - `#wishlist-count-mobile`

---

## 🔧 Manual API Testing

If buttons still don't work, test the API directly:

### Test Cart API:
1. Open browser
2. Type in address bar: `http://localhost/usceligin/addcart/1`
3. Press Enter
4. **Expected Response:**
   ```json
   {
     "success": true,
     "message": "Successfully added to cart.",
     "cart_count": 1
   }
   ```

### Test Wishlist API:
1. Type: `http://localhost/usceligin/addwishlist/1`
2. **Expected Response:**
   ```json
   {
     "success": true,
     "message": "Successfully added to wishlist.",
     "wishlist_count": 1
   }
   ```

### If API Returns Error:
```json
{
  "success": false,
  "message": "Product not found."
}
```
**Solution:** Use a valid product ID (check database `products` table)

---

## 📝 Verification Checklist

Before reporting issues, verify:

- [ ] Browser console is open
- [ ] No JavaScript errors in console
- [ ] Hard refresh done (Ctrl+F5)
- [ ] `cart-wishlist-manager.js` file exists
- [ ] Routes return JSON (not 404)
- [ ] Product IDs are valid
- [ ] Toastr library is loaded
- [ ] Counter elements exist in header
- [ ] CSRF token is present in page source

---

## 🎯 Files Modified (For Reference)

1. **public/assets/frontend/js/cart-wishlist-manager.js**
   - Changed URLs from `/celiginus/addcart/` to `/addcart/`
   - Changed event listeners to event delegation
   - Added console logging

2. **resources/views/frontend/product-detail.blade.php**
   - Fixed URLs in inline script

---

## 📞 Getting Help

If issues persist after following this guide:

1. **Copy the entire console output** (all red errors)
2. **Take a screenshot** of the Network tab showing the failed request
3. **Note which page** you're testing on
4. **Note which button** you clicked

### How to Check Network Tab:
1. Open Developer Tools (F12)
2. Click **Network** tab
3. Click the cart/wishlist button
4. Look for the request to `/addcart/` or `/addwishlist/`
5. Click on it to see:
   - Request URL
   - Response status
   - Response body

---

## ✅ Expected Console Output (Success)

When everything works correctly, you should see:

```
[CartWishlistManager] Initialized successfully
[CartWishlistManager] Event delegation attached to document for cart and wishlist buttons
[CartWishlistManager] Making request to: /addcart/5
[CartWishlistManager] Response status: 200
[CartWishlistManager] Response data: {success: true, message: "Successfully added to cart.", cart_count: 1}
```

**No errors** should appear in red.

---

## 🚀 Next Steps

Once verified working:
1. Test on all pages (homepage, best-sellers, new-arrivals, etc.)
2. Test on mobile/tablet viewports
3. Test adding multiple products
4. Test adding same product twice (should show "already in cart")
5. Clear cache and test again
