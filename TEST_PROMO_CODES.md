# Test Promo Codes - Setup Guide

## How to Create Test Promo Codes

You can create promo codes in two ways:

---

## Option 1: Using Admin Panel (Recommended)

1. **Login to Admin Panel**
   - URL: `http://localhost/usceligin/admin` (or your admin URL)
   - Login with admin credentials

2. **Navigate to Coupons**
   - Look for "Coupons" or "Promo Codes" menu
   - Click "Add New Coupon" or similar

3. **Fill Coupon Details**
   - **Code:** SAVE20 (example)
   - **Type:** Percentage or Fixed
   - **Price/Discount:** 20 (for 20% or ₹20)
   - **Times:** 100 (usage limit)
   - **Start Date:** Today's date
   - **End Date:** Future date (e.g., 1 month later)
   - **Status:** Active
   - **Coupon Type:** Choose "All Products" or specific category

4. **Save and Test**

---

## Option 2: Direct Database Insert (Quick Testing)

### For 20% Percentage Discount Coupon

```sql
INSERT INTO `coupons`
(`code`, `type`, `price`, `times`, `start_date`, `end_date`, `status`, `coupon_type`)
VALUES
('SAVE20', 0, 20, 100, '2025-01-01', '2025-12-31', 1, NULL);
```

### For Fixed ₹200 Discount Coupon

```sql
INSERT INTO `coupons`
(`code`, `type`, `price`, `times`, `start_date`, `end_date`, `status`, `coupon_type`)
VALUES
('FLAT200', 1, 200, 100, '2025-01-01', '2025-12-31', 1, NULL);
```

### For Category-Specific Coupon (10% off on Category ID 5)

```sql
INSERT INTO `coupons`
(`code`, `type`, `price`, `times`, `start_date`, `end_date`, `status`, `coupon_type`, `category`)
VALUES
('CAT10', 0, 10, 50, '2025-01-01', '2025-12-31', 1, 'category', 5);
```

---

## How to Run SQL Commands

### Using phpMyAdmin:
1. Open: `http://localhost/phpmyadmin`
2. Select database: `us_devceligin_1nov25`
3. Click "SQL" tab
4. Paste SQL command
5. Click "Go"

### Using MySQL Command Line:
```bash
mysql -u root -h 127.0.0.1 -P 3307 us_devceligin_1nov25
```
Then paste SQL commands.

---

## Test Promo Codes (Ready to Use)

### Simple Test Coupons

| Code | Type | Discount | Usage |
|------|------|----------|-------|
| **SAVE10** | Percentage | 10% off | Any product |
| **SAVE20** | Percentage | 20% off | Any product |
| **SAVE50** | Percentage | 50% off | Any product |
| **FLAT100** | Fixed | ₹100 off | Any product |
| **FLAT200** | Fixed | ₹200 off | Any product |
| **FLAT500** | Fixed | ₹500 off | Any product |
| **WELCOME** | Percentage | 15% off | First order |
| **NEWYEAR** | Percentage | 25% off | Any product |

---

## Coupon Field Explanations

### Database Fields:

| Field | Description | Example |
|-------|-------------|---------|
| **code** | Promo code text | SAVE20 |
| **type** | 0 = Percentage, 1 = Fixed | 0 |
| **price** | Discount value | 20 (for 20% or ₹20) |
| **times** | Usage limit | 100 |
| **start_date** | Valid from | 2025-01-24 |
| **end_date** | Valid until | 2025-12-31 |
| **status** | 1 = Active, 0 = Inactive | 1 |
| **coupon_type** | NULL = All, 'category', 'sub_category', 'child_category' | NULL |
| **category** | Category ID (if coupon_type = 'category') | 5 |
| **sub_category** | Sub-category ID | NULL |
| **child_category** | Child category ID | NULL |

---

## Quick SQL Script - Create Multiple Test Coupons

```sql
-- Delete old test coupons (optional)
DELETE FROM `coupons` WHERE `code` IN ('SAVE10', 'SAVE20', 'SAVE50', 'FLAT100', 'FLAT200', 'FLAT500');

-- Insert test coupons
INSERT INTO `coupons`
(`code`, `type`, `price`, `times`, `start_date`, `end_date`, `status`, `coupon_type`, `category`, `sub_category`, `child_category`)
VALUES
('SAVE10', 0, 10, 100, '2025-01-01', '2025-12-31', 1, NULL, NULL, NULL, NULL),
('SAVE20', 0, 20, 100, '2025-01-01', '2025-12-31', 1, NULL, NULL, NULL, NULL),
('SAVE50', 0, 50, 50, '2025-01-01', '2025-12-31', 1, NULL, NULL, NULL, NULL),
('FLAT100', 1, 100, 100, '2025-01-01', '2025-12-31', 1, NULL, NULL, NULL, NULL),
('FLAT200', 1, 200, 100, '2025-01-01', '2025-12-31', 1, NULL, NULL, NULL, NULL),
('FLAT500', 1, 500, 50, '2025-01-01', '2025-12-31', 1, NULL, NULL, NULL, NULL);
```

---

## How to Test in Checkout

### Step 1: Add Products to Cart
1. Go to homepage: `http://localhost/usceligin`
2. Add products to cart (minimum ₹1,000 total recommended)
3. Go to cart: `/cart`

### Step 2: Proceed to Checkout
1. Click "Proceed to Checkout"
2. Sign in with OTP (Phone: 9876543210, OTP: 123456)

### Step 3: Apply Promo Code
1. On checkout page, click "Apply Promo Code" collapsible
2. Enter one of the test codes (e.g., **SAVE20**)
3. Click "Apply"

### Step 4: Verify Results

**For SAVE20 (20% discount):**
```
Example Cart: ₹10,000

Subtotal MRP:        ₹10,000
Discount on MRP:         ₹0
Coupon Discount:    -₹2,000  [X]  ← 20% of ₹10,000
Shipping:              FREE
Estimated Taxes:     ₹1,440  ← 18% of ₹8,000
─────────────────────────────
Total:              ₹9,440
```

**For FLAT200 (Fixed ₹200 discount):**
```
Example Cart: ₹10,000

Subtotal MRP:        ₹10,000
Discount on MRP:         ₹0
Coupon Discount:      -₹200  [X]  ← Fixed amount
Shipping:              FREE
Estimated Taxes:     ₹1,764  ← 18% of ₹9,800
─────────────────────────────
Total:             ₹11,564
```

---

## Troubleshooting

### Problem 1: "Invalid or expired coupon code"

**Possible Causes:**
- Coupon doesn't exist in database
- Coupon is expired (check start_date/end_date)
- Coupon is inactive (status = 0)
- Times usage is exhausted (times = 0)

**Solution:**
```sql
-- Check coupon details
SELECT * FROM `coupons` WHERE `code` = 'SAVE20';

-- Update if needed
UPDATE `coupons` SET `status` = 1, `times` = 100, `end_date` = '2025-12-31' WHERE `code` = 'SAVE20';
```

### Problem 2: "Minimum order value not met"

**Cause:** Coupon discount is greater than or equal to cart total

**Solution:** Add more products to cart or reduce coupon discount value

### Problem 3: "You have already used this coupon"

**Cause:** User has previously used this coupon in a completed order

**Solution:** Use a different coupon code or create new user account

### Problem 4: Coupon doesn't apply

**Possible Causes:**
- Category mismatch (coupon is category-specific)
- Cart is empty
- Session issues

**Solution:**
```sql
-- Make coupon apply to all products
UPDATE `coupons` SET `coupon_type` = NULL, `category` = NULL WHERE `code` = 'SAVE20';
```

---

## Check Existing Coupons

### View All Active Coupons:
```sql
SELECT
    `code`,
    CASE WHEN `type` = 0 THEN CONCAT(`price`, '%') ELSE CONCAT('₹', `price`) END as 'Discount',
    `times` as 'Uses Left',
    `start_date`,
    `end_date`,
    CASE WHEN `status` = 1 THEN 'Active' ELSE 'Inactive' END as 'Status'
FROM `coupons`
WHERE `status` = 1
AND `end_date` >= CURDATE()
ORDER BY `code`;
```

### Check Specific Coupon:
```sql
SELECT * FROM `coupons` WHERE `code` = 'SAVE20';
```

---

## Response Codes Reference

When you apply a coupon, the API returns these codes:

| Code | Meaning | Message |
|------|---------|---------|
| `0` | Invalid/Expired | "Invalid or expired coupon code" |
| `2` | Already Applied | "Coupon already applied" |
| `3` | Min Order Not Met | "Minimum order value not met" |
| `8` | Already Used | "You have already used this coupon" |
| `[...data, 1]` | Success | "Coupon applied successfully!" |

---

## Quick Test Checklist

- [ ] Create test coupon in database
- [ ] Verify coupon is active (status = 1)
- [ ] Check dates are valid (start_date <= today <= end_date)
- [ ] Ensure times > 0
- [ ] Add products to cart (total > ₹1,000)
- [ ] Sign in to checkout
- [ ] Apply coupon code
- [ ] Verify discount appears
- [ ] Verify tax recalculates
- [ ] Verify total updates correctly
- [ ] Test remove coupon (click [X])
- [ ] Verify all amounts reset

---

## Example Testing Scenario

### 1. Create Test Coupon
```sql
INSERT INTO `coupons`
(`code`, `type`, `price`, `times`, `start_date`, `end_date`, `status`)
VALUES
('TESTCODE', 0, 15, 10, '2025-01-01', '2025-12-31', 1);
```

### 2. Test Application
- Cart Total: ₹5,000
- Apply Code: **TESTCODE**
- Expected Discount: ₹750 (15% of ₹5,000)
- Taxable Amount: ₹4,250
- Tax (18%): ₹765
- Final Total: ₹5,015

### 3. Verify in Order Summary
```
Subtotal MRP (X items)    ₹5,000
Coupon Discount (TESTCODE)  -₹750  [X]
Shipping                      FREE
Estimated Taxes (GST 18%)    ₹765
─────────────────────────────────
Total                      ₹5,015
```

---

## Advanced: Category-Specific Coupons

### Get Category IDs
```sql
SELECT `id`, `name` FROM `categories` ORDER BY `name`;
```

### Create Category-Specific Coupon
```sql
-- 25% off on Electronics (assuming category_id = 3)
INSERT INTO `coupons`
(`code`, `type`, `price`, `times`, `start_date`, `end_date`, `status`, `coupon_type`, `category`)
VALUES
('ELECTRONICS25', 0, 25, 50, '2025-01-01', '2025-12-31', 1, 'category', 3);
```

**Note:** This coupon will only work if cart contains products from category ID 3.

---

## Clean Up Test Data

### Delete Test Coupons
```sql
DELETE FROM `coupons` WHERE `code` IN ('SAVE10', 'SAVE20', 'SAVE50', 'FLAT100', 'FLAT200', 'TESTCODE');
```

### Clear Coupon Sessions (if needed)
Clear browser cookies and localStorage, then:
```sql
-- In Laravel, you can clear sessions via:
php artisan cache:clear
php artisan session:clear
```

---

## Production Recommendations

### Before Going Live:
1. ✅ Create real coupon codes (not test ones)
2. ✅ Set appropriate usage limits
3. ✅ Set realistic dates
4. ✅ Test all coupon types
5. ✅ Configure category-specific coupons correctly
6. ✅ Add coupon management in admin panel
7. ✅ Monitor coupon usage
8. ✅ Set up notifications for low coupon uses

### Security Considerations:
- Never share coupon codes publicly unless intended
- Monitor for coupon abuse
- Implement rate limiting on coupon API
- Track coupon usage per user
- Add CAPTCHA if needed

---

**Created:** 2025-01-24
**Purpose:** Testing checkout promo code functionality
**Database:** us_devceligin_1nov25
**Table:** coupons

---

## Need Help?

1. Check Laravel logs: `storage/logs/laravel.log`
2. Check browser console for JavaScript errors
3. Verify database connection
4. Clear all caches: `php artisan optimize:clear`
