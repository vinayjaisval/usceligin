# Cart & Checkout Integration Documentation

This document explains how the shopping cart and checkout pages are integrated to provide a seamless user experience.

## Overview

The cart (`add-to-cart.blade.php`) and checkout (`checkout.blade.php`) pages are connected through:
- **localStorage**: For "Save for Later" items
- **sessionStorage**: For cart metadata and coupon state
- **Laravel Session**: For cart data server-side
- **AJAX APIs**: For real-time cart operations

## Data Flow Diagram

```
┌─────────────────┐
│   Cart Page     │
│                 │
│  - Cart Items   │──────┐
│  - Saved Items  │      │ localStorage: savedForLater
│  - Quantities   │      │ sessionStorage: cartMetadata
│  - Coupons      │      │ sessionStorage: appliedCoupon
└─────────────────┘      │
        │                │
        │ Proceed to     │
        │ Checkout       │
        ↓                ↓
┌─────────────────────────────┐
│    Checkout Page            │
│                             │
│  - Shipping Address         │
│  - Billing Address          │
│  - Order Summary            │
│  - Payment Method           │
│  - Saved Items (movable)    │
└─────────────────────────────┘
        │
        │ Place Order
        ↓
┌─────────────────┐
│ Payment Gateway │
└─────────────────┘
```

## Features Integration

### 1. Save for Later (localStorage)

**Storage Key**: `savedForLater`
**Data Structure**:
```javascript
[
  {
    key: "product_id_size_color_values",
    id: "product_id",
    size: "M",
    color: "Red",
    values: "",
    name: "Product Name",
    image: "full_image_url"
  }
]
```

**Cart Page** (`add-to-cart.blade.php:566-604`):
- Save items from cart to localStorage
- Display saved items section
- Remove items from cart when saved

**Checkout Page** (`checkout.blade.php:242-253`, `checkout.blade.php:514-612`):
- Load saved items on page load
- Display in separate "Saved for Later" section
- Move items back to cart with AJAX
- Remove saved items

### 2. Cart Metadata (sessionStorage)

**Storage Key**: `cartMetadata`
**Data Structure**:
```javascript
{
  itemCount: 5,
  totalPrice: 2500.00,
  timestamp: 1234567890
}
```

**Purpose**: Track cart state between page navigations
**Location**: `add-to-cart.blade.php:607-630`

### 3. Coupon State (sessionStorage)

**Storage Key**: `appliedCoupon`
**Data Structure**:
```javascript
{
  code: "SAVE20",
  discount: 100.00
}
```

**Cart Page**: Apply coupon and store state
**Checkout Page** (`checkout.blade.php:509-519`):
- Auto-restore coupon on page load
- Display discount in order summary
- Recalculate total with discount

### 4. Address Management

**Shipping Address** (`checkout.blade.php:114-238`):
- Auto-populate from Auth::user() if available
- Toggle between display and edit modes
- Save changes to sessionStorage temporarily
- Full form validation

**Billing Address** (`checkout.blade.php:255-344`):
- "Same as shipping" checkbox (default: checked)
- Conditionally show/hide billing form
- Separate address fields when different

### 5. Order Placement Flow

**Step 1: Validation** (`checkout.blade.php:645-669`)
```javascript
- Check payment method selected
- Validate shipping address filled
- Validate billing address (if different)
```

**Step 2: Form Data Preparation** (`checkout.blade.php:671-698`)
```javascript
FormData includes:
- shipping_name, shipping_phone, shipping_address
- shipping_city, shipping_state, shipping_zip
- billing_same or full billing address fields
- paymentMethod (gateway ID)
- coupon_code
- refferal_discount
- total
```

**Step 3: Submit to Payment Gateway** (`checkout.blade.php:714-744`)
```javascript
- POST to gateway-specific route
- Show loading state
- Handle success/error responses
- Clear cart on success
- Redirect to payment or success page
```

## API Endpoints Used

### Cart Operations
| Endpoint | Method | Purpose | File Reference |
|----------|--------|---------|----------------|
| `details.cart` | POST | Add/Update cart item | `add-to-cart.blade.php:432`, `checkout.blade.php:576` |
| `product.cart.remove` | GET | Remove cart item | `add-to-cart.blade.php:187` |
| `front.cart` | GET | View cart page | Both files |
| `front.checkout` | GET | View checkout page | `add-to-cart.blade.php:254` |

### Checkout Operations
| Endpoint | Method | Purpose | File Reference |
|----------|--------|---------|----------------|
| `front.{gateway}.submit` | POST | Submit payment | `checkout.blade.php:750-753` |
| `front.payment.return` | GET | Payment success | `checkout.blade.php:731` |
| `front.coupon.apply` | POST | Apply coupon code | `checkout.blade.php:587` |

### Available Payment Gateways
- `front.paypal.submit`
- `front.stripe.submit`
- `front.razorpay.submit`
- `front.cod.submit` (Cash on Delivery)
- `front.wallet.submit`
- Plus 10+ other gateways

## JavaScript Functions Reference

### Cart Page Functions
```javascript
showLoader()              // Show loading overlay
hideLoader()              // Hide loading overlay
showToast(message, type)  // Display notification
loadSavedItems()          // Load saved items from localStorage
prepareCheckout(event)    // Prepare data before checkout navigation
```

### Checkout Page Functions
```javascript
loadSavedItems()          // Load and display saved items
loadCheckoutState()       // Restore coupon and other state
toggleAddressEdit(type)   // Toggle address edit mode
toggleBillingAddress()    // Show/hide billing form
saveAddress(type)         // Save address changes
applyCoupon()             // Apply and validate coupon
updateOrderSummary(disc)  // Update prices with discount
placeOrder()              // Submit order to payment gateway
getPaymentRoute(id)       // Get payment gateway route
showToast(message, type)  // Display notification
```

## User Authentication

**Cart Page**:
- Allows viewing cart without login
- "Save for Later" works without login (localStorage)
- Checkout button checks authentication (`add-to-cart.blade.php:619-626`)
- Redirects to login if not authenticated

**Checkout Page**:
- Requires authentication (server-side)
- Auto-populates user data (name, phone, address)
- Handles referral discounts for first-time users

## Local Storage Management

### Data Persistence
- **Save for Later**: Persists across sessions until manually cleared
- **Cart Metadata**: Cleared on order completion
- **Applied Coupon**: Cleared on order completion

### Cleanup Events
1. **Order Success** (`checkout.blade.php:726-728`):
   ```javascript
   localStorage.removeItem('savedForLater');
   sessionStorage.removeItem('appliedCoupon');
   sessionStorage.removeItem('cartMetadata');
   ```

2. **Manual Cleanup**: User can remove saved items individually

## Error Handling

### Cart Page
- Network errors during quantity update
- Product removal failures
- Save for later conflicts

### Checkout Page
- Invalid coupon codes
- Payment method not selected
- Address validation failures
- Payment gateway errors
- Network timeouts

All errors show user-friendly toast notifications.

## Responsive Design

Both pages use Tailwind CSS with:
- **Mobile** (default): Single column, stacked layout
- **Tablet** (sm/md): Optimized spacing, 2-column forms
- **Desktop** (lg+): 2/3 content + 1/3 sidebar layout
- **Sticky Sidebar**: Order summary sticks on desktop scroll

## Accessibility Features

- Semantic HTML5 elements (`<main>`, `<section>`, `<nav>`)
- ARIA labels and roles
- Keyboard navigation support
- Focus states on interactive elements
- Required field indicators
- Screen reader friendly labels
- Dark mode support throughout

## Testing Checklist

### Cart to Checkout Flow
- [ ] Items display correctly in checkout
- [ ] Quantities match between pages
- [ ] Saved items persist
- [ ] Coupon codes carry over
- [ ] Total calculations are accurate
- [ ] Authentication check works
- [ ] Back to cart maintains state

### Save for Later
- [ ] Save items from cart
- [ ] Display in both cart and checkout
- [ ] Move back to cart works
- [ ] Remove from saved works
- [ ] Persist across page reloads
- [ ] Clear on order completion

### Order Placement
- [ ] Address validation works
- [ ] Payment method selection
- [ ] Billing same as shipping toggle
- [ ] Form data submits correctly
- [ ] Success redirect works
- [ ] Error handling displays
- [ ] Cart clears on success

## Future Enhancements

1. **Real-time Inventory Check**: Validate stock before order placement
2. **Guest Checkout**: Allow checkout without account
3. **Address Book**: Multiple saved addresses
4. **Coupon Suggestions**: Show available coupons
5. **Order Notes**: Allow customer notes
6. **Express Checkout**: One-click checkout for returning users
7. **Shipping Calculator**: Real-time shipping cost updates
8. **Tax Calculator**: Real-time tax calculation
9. **Gift Options**: Gift wrapping and messages
10. **Multiple Payment Methods**: Split payment across methods

## Troubleshooting

### Issue: Saved items not showing in checkout
**Solution**: Check browser localStorage permissions

### Issue: Coupon not applying
**Solution**: Verify `front.coupon.apply` route exists and returns JSON

### Issue: Order placement fails
**Solution**: Check payment gateway configuration and routes

### Issue: Address not pre-filling
**Solution**: Ensure user is authenticated and has address data

### Issue: Total calculation wrong
**Solution**: Check shipping cost, tax, and discount calculations

## Support

For issues or questions:
1. Check browser console for errors
2. Verify Laravel session is active
3. Check payment gateway configuration
4. Review server logs for API errors
5. Test with network inspector open

---

**Last Updated**: 2025-01-24
**Version**: 1.0
**Maintainer**: Development Team
