# CLAUDE.md

This file provides guidance to Claude Code when working with code in this repository.

## Project Overview

**Usceligin** - A Laravel-based multi-vendor e-commerce marketplace with extensive payment gateway integrations and modern OTP authentication.

- **Framework**: Laravel 10.x with Vite
- **Frontend**: Tailwind CSS with Blade templates
- **Database**: MySQL (Port 3306)
- **Development**: WAMP (`http://localhost/usceligin`)

## Quick Start Commands

### Development
```bash
npm run dev              # Start Vite dev server with hot reload
php artisan serve       # Alternative: Laravel dev server
```

### Production
```bash
npm run build           # Build optimized assets
php artisan optimize    # Optimize Laravel
```

### Database
```bash
php artisan migrate              # Run migrations
php artisan migrate:fresh --seed # Fresh migration with seeders
```

### Cache Management
```bash
php artisan optimize:clear  # Clear all caches
php artisan config:cache    # Cache configuration
php artisan route:cache     # Cache routes
php artisan view:cache      # Cache views
```

## Architecture

### Directory Structure
```
app/Http/Controllers/
├── Admin/          # Admin panel management
├── Vendor/         # Seller/merchant functionality
├── User/           # Customer functionality
├── Rider/          # Delivery personnel
└── Front/          # Public-facing pages

resources/views/frontend/
├── include/        # Reusable components (header, footer, breadcrumb, etc.)
├── index.blade.php # Homepage
└── [pages]/        # Product, cart, wishlist, blog, etc.
```

### Key Models
- **Product**: E-commerce products with variants and attributes
- **Order**: Order management with vendor order splitting
- **Cart**: Session-based shopping cart (guest + user)
- **User**: Multi-role user system (admin, vendor, customer, rider)
- **OtpVerification**: Phone/email OTP authentication
- **Wishlist**: User wishlist items (NEW - being implemented)
- **Address**: User delivery/billing addresses (NEW - being implemented)

### Payment Gateways
Stripe • Razorpay • PayPal • Mollie • Authorize.net • Instamojo • MercadoPago

## Database Configuration

**Important**: The database is configured for WAMP with standard MySQL port.

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=us_devceligin_23dec25
```

## OTP Authentication System

### Core Files
- **Service**: `app/Services/OtpService.php`
- **Model**: `app/Models/OtpVerification.php`
- **Frontend**: `resources/views/frontend/sign-in.blade.php`

### Features
- Dual method support (phone + email)
- Indian phone validation (6-9 starting digits)
- Rate limiting (5 attempts/hour)
- Auto-user creation on verification
- IP logging and attempt tracking
- Development mode with fixed OTP (123456)

### Configuration
```env
OTP_LENGTH=6
OTP_EXPIRY_MINUTES=10
OTP_MAX_ATTEMPTS_PER_HOUR=5
OTP_MAX_VERIFICATION_ATTEMPTS=3
OTP_DEVELOPMENT_CODE=123456
OTP_HASH_IN_DATABASE=false
OTP_LOG_IN_DEVELOPMENT=true
```

## Frontend Development

### Tailwind CSS Setup
- **Config**: `tailwind.config.js`
- **Entry**: `resources/css/app.css`
- **Output**: `public/assets/frontend/css/styles.css`
- **Components**: Modern alert, tooltip, form, and button systems

### Design System
- **Colors**: Orange primary (#EA580C), gray scale
- **Typography**: Fluid responsive scaling
- **Theme**: Full light/dark mode support
- **Accessibility**: WCAG 2.1 AA compliant

### Reusable Components
```blade
@include('frontend.include.breadcrumb', ['items' => [...]])
@include('frontend.include.empty-state', ['icon' => '...', 'title' => '...'])
@include('frontend.include.accordion', ['items' => [...]])
<x-join-celigin-banners />
<x-cart-button :product-id="$id" />
```

## Known Issues & Fixes

### Tags Table Missing
The `tags` table doesn't exist in the database. When encountering Tag model errors:

1. Remove Tag model import
2. Comment out `Tag::all()` or `Tag::where()` calls
3. Replace with `$tags = []`

**Files Fixed**: CatalogController.php, WishlistController.php

### Route Naming
- Join Club: `front.celigin-join-club` (not `front.join-club`)
- Sign In: `otp.login.form` (not `front.sign-in`)

### XAMPP Deployment
- URL: `http://localhost/usceligin`
- Assets: Use `npm run build` for production
- Ensure `.env` has `APP_URL=http://localhost/usceligin`

## Code Guidelines

### When Making Changes
1. **Always read files first** before modifying
2. **Use existing patterns** - check similar pages for consistency
3. **Tailwind-first approach** - use utility classes over custom CSS
4. **Component reuse** - leverage existing Blade components
5. **Accessibility** - maintain ARIA labels and semantic HTML
6. **Dark mode** - always include `dark:` variants
7. **Mobile-first** - use responsive breakpoints (sm, md, lg, xl)

### Forbidden Actions
- ❌ Never commit hardcoded values
- ❌ Never use rounded corners (sharp design aesthetic)
- ❌ Never skip dark mode variants
- ❌ Never ignore accessibility attributes
- ❌ Never create duplicate components

### Performance Best Practices
- ✅ Use Vite for asset compilation
- ✅ Implement lazy loading for images
- ✅ Cache DOM queries in JavaScript
- ✅ Use configuration objects over inline validation
- ✅ Optimize CSS with Tailwind purge

## Current Project State

### Completed Features ✅
- ✅ OTP authentication system (production-ready)
- ✅ Homepage responsive design with DRY carousel
- ✅ Sign-in page optimization
- ✅ Tailwind CSS integration (94% CSS reduction: 7,396 → 458 lines)
- ✅ Component system (alerts, tooltips, forms, breadcrumb, accordion)
- ✅ Full dark mode support across all pages
- ✅ My Account page with sidebar navigation and tabs
- ✅ Category pages Tag model fixes (new-arrivals, best-sellers, sale, skin-care)
- ✅ Wishlist page Tag model fix and banner correction
- ✅ Documentation consolidation (22 → 5 essential files)

### Active Development 🔄
- **User Flow Implementation**: Complete sign-in → cart → checkout → my account journey
- **Wishlist Merge System**: Guest wishlist sync to user account on login
- **Address Management**: CRUD operations for delivery/billing addresses
- Shopping cart page optimization
- Product detail page

### Technical Debt 📋
- Tags functionality disabled (table doesn't exist)
- Some legacy custom CSS remaining
- Session-based cart/wishlist needs database migration for authenticated users

## User Flow & Authentication Logic

### Current Routes Structure
```php
// Authentication
GET  /sign-in           → Auth\OtpController@showLoginForm (otp.login.form)
POST /otp/send          → Auth\User\LoginController@send_otp
POST /otp/verify        → Auth\User\LoginController@verify_otp
POST /logout            → Auth\User\LoginController@logout

// Protected Routes (require auth middleware)
GET  /myaccount         → User\AccountController@index (user.account)
POST /myaccount/update  → User\AccountController@update

// Public Routes
GET  /carts             → Front\CartController@cart (front.cart)
GET  /checkout          → Front\CheckoutController@checkout (front.checkout)
GET  /wishlist          → Front\WishlistController@wishlist (front.wishlist)
```

### User Journey Requirements

#### 1. Header My Account Icon Logic
- **Guest User**: Click → Redirect to `/sign-in`
- **Authenticated User**: Click → Redirect to `/myaccount`
- **Implementation**: Use `@auth/@guest` directives in header

#### 2. Sign-In Redirect Priority
After successful OTP verification:
1. **Intended URL** (if redirected from protected route) → Go back
2. **Checkout** (if cart has items) → `/checkout`
3. **Default** → `/myaccount`

#### 3. Cart-to-Checkout Flow
- **Guest**: Can add to cart, but checkout requires sign-in
- **After Sign-In**: Automatically redirect to checkout with cart preserved
- **Implementation**: Add `auth` middleware to checkout route

#### 4. Wishlist Sync (Guest → User)
- **Guest**: Wishlist stored in session (`Session::get('wishlist')`)
- **On Sign-In**: Merge session wishlist to database (`wishlists` table)
- **After Merge**: Clear session wishlist
- **Result**: User sees all items (guest + previous user items)

#### 5. Address Management
- **Max Addresses**: 3 per user
- **Default Address**: Only one can be default
- **Checkout Integration**: Pre-select default address
- **Fields**: Name, Phone, Address Lines, City, State, Pincode, Type (home/work/other)

### Database Schema (New Tables Needed)

#### `wishlists` Table
```sql
CREATE TABLE wishlists (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    product_id BIGINT UNSIGNED NOT NULL,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE,
    FOREIGN KEY (product_id) REFERENCES products(id) ON DELETE CASCADE,
    UNIQUE KEY unique_user_product (user_id, product_id)
);
```

#### `addresses` Table
```sql
CREATE TABLE addresses (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id BIGINT UNSIGNED NOT NULL,
    type VARCHAR(255) DEFAULT 'home',
    name VARCHAR(255) NOT NULL,
    phone VARCHAR(15) NOT NULL,
    address_line_1 TEXT NOT NULL,
    address_line_2 TEXT NULL,
    city VARCHAR(100) NOT NULL,
    state VARCHAR(100) NOT NULL,
    pincode VARCHAR(6) NOT NULL,
    country VARCHAR(100) DEFAULT 'India',
    is_default BOOLEAN DEFAULT FALSE,
    created_at TIMESTAMP NULL,
    updated_at TIMESTAMP NULL,
    FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE CASCADE
);
```

### Implementation Phases

**See TASK.md for detailed implementation checklist**

1. **Phase 1-2**: Header icon + middleware setup
2. **Phase 3-4**: Sign-in redirects + checkout auth
3. **Phase 5**: Wishlist merge functionality
4. **Phase 6**: Dynamic My Account data
5. **Phase 7**: Address CRUD operations
6. **Phase 8**: Checkout address integration

## Getting Help

- **Documentation**: See PLANNING.md for roadmap, TASK.md for current tasks
- **Issues**: Check existing .md files before creating new ones
- **Code Review**: Always test in both light and dark modes
- **Deployment**: Test on XAMPP before considering production

---

**Last Updated**: 2025-12-07 (User Flow Planning Added)
**Database**: us_devceligin_23dec25
**PHP Version**: 8.1+
**Laravel Version**: 10.x
