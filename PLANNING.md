# Project Planning & Roadmap

## Project Information
- **Name**: Usceligin E-commerce Platform
- **Type**: Multi-vendor Marketplace
- **Framework**: Laravel 10.x + Tailwind CSS
- **Started**: September 2025
- **Status**: Active Development

---

## Migration Goals

### Primary Objective
Modernize the frontend with Tailwind CSS while maintaining functionality and improving performance.

### Success Metrics
- **CSS Reduction**: Target 90%+ reduction (✅ Achieved: 94%)
- **Performance**: Faster page loads with optimized assets
- **Accessibility**: WCAG 2.1 AA compliance
- **Maintainability**: Component-based architecture
- **Dark Mode**: Full theme support across all pages

---

## Phase Overview

### ✅ Phase 1: Foundation (COMPLETED)
**Goal**: Set up Tailwind CSS and establish base systems

**Achievements**:
- Tailwind CSS installed and configured with Vite
- CSS variables extracted and converted to RGB format
- Modern component systems (alerts, tooltips, forms)
- WCAG AA accessibility compliance
- Full light/dark mode support
- CSS reduced from 7,396 to 458 lines (94% reduction)

### ✅ Phase 2: Authentication & Core Pages (COMPLETED)
**Goal**: Optimize sign-in and homepage

**Achievements**:
- **OTP System**: Production-ready authentication
  - Phone and email verification
  - Rate limiting and security features
  - Auto-user creation
  - XAMPP deployment ready

- **Sign-in Page**: Complete optimization
  - DRY principles implementation
  - Configuration-driven validation
  - DOM caching for performance
  - Component-based CSS architecture

- **Homepage**: Fully responsive design
  - Hero carousel DRY refactoring (47% code reduction)
  - Fluid responsive typography
  - Content width optimization
  - Search functionality fixes
  - Sharp design aesthetic (no rounded corners)
  - Dark mode fixes

- **My Account Page**: Modern dashboard
  - Sidebar navigation with Material Icons
  - Tab-based content switching
  - Quick stats (Total Orders, Wishlist Items, Points)
  - Purchase history and wishlist sections
  - Full dark mode support

### 🔄 Phase 3: E-commerce Pages (IN PROGRESS - 45% Complete)
**Goal**: Optimize shopping and product pages + Complete user journey

**Pages Completed**:
1. **My Account Page** ✅
   - ✅ Complete rebuild with sidebar navigation
   - ✅ Tab-based content switching (Dashboard, Purchases, Wishlists, Account, Support, Affiliate, Points)
   - ✅ Material Icons integration throughout
   - ✅ Quick stats display (Total Orders, Wishlist Items, Points Earned)
   - ✅ Full dark mode support
   - 🔄 Backend integration in progress (real order/wishlist data)
   - 🔄 Address management being implemented

2. **Wishlist Page** ✅ (Bug Fixes)
   - ✅ Fixed Tag::all() error in WishlistController
   - ✅ Updated to use join-celigin-banners component
   - ✅ Added proper empty tags array handling
   - ⏭️ Layout optimization pending

3. **Category Pages** ✅ (Bug Fixes)
   - ✅ Fixed Tags errors in all 4 pages: new-arrivals, best-sellers, sale, skin-care
   - ✅ Removed Tag model imports
   - ✅ Added empty tags arrays to prevent undefined variable errors
   - ⏭️ Standardize product listing layouts pending

**User Flow Implementation** 🔄 (NEW - In Progress):
- 🔄 **Phase 1-2**: Header authentication + middleware
- 🔄 **Phase 3-4**: Sign-in redirect logic + checkout auth
- ⏭️ **Phase 5**: Wishlist merge system (guest → user)
- ⏭️ **Phase 6**: Dynamic My Account data integration
- ⏭️ **Phase 7**: Address management CRUD
- ⏭️ **Phase 8**: Checkout address integration

**Pages to Complete**:
4. **Product Detail Page**
   - Product image gallery
   - Variant selection UI
   - Add-to-cart functionality
   - Related products section

5. **Shopping Cart**
   - Cart item layout
   - Quantity controls
   - Price calculation display
   - Checkout button
   - Authentication flow integration

### ⏭️ Phase 4: Content Pages (UPCOMING)
**Goal**: Optimize blog and informational pages

**Pages**:
- Blog listing page
- Blog detail page
- About page
- Contact page
- FAQ page

### ⏭️ Phase 5: Optimization & Polish (UPCOMING)
**Goal**: Final performance optimization and quality assurance

**Tasks**:
- Create comprehensive component library
- Remove remaining custom CSS
- Optimize Tailwind configuration for production
- Cross-browser testing
- Mobile responsiveness testing
- Accessibility audit
- Performance profiling

---

## Architecture Decisions

### Chosen Approaches

1. **XAMPP Deployment**
   - Traditional XAMPP setup for production
   - URL: `http://localhost/usceligin`
   - Rationale: Team familiarity, easier deployment

2. **Component Strategy**
   - Blade components for reusable UI elements
   - Tailwind utilities for styling
   - Custom CSS only for complex components
   - Rationale: Balance between flexibility and consistency

3. **Dark Mode Implementation**
   - CSS variables for theme colors
   - Tailwind `dark:` variants throughout
   - System preference detection
   - Rationale: Modern UX expectation

4. **Design System**
   - Sharp aesthetic (no rounded corners)
   - Orange primary color (#EA580C)
   - Fluid responsive typography
   - Rationale: Brand consistency and modern look

### Rejected Approaches

1. **Utility-First CSS Only**
   - Rejected: Too verbose for complex forms
   - Chosen: Component classes for common patterns

2. **Laravel Serve for Production**
   - Rejected: Team prefers XAMPP
   - Chosen: Traditional XAMPP deployment

3. **Tags Functionality**
   - Rejected: Building tags feature
   - Chosen: Disabled (table doesn't exist)

---

## Technical Achievements

### Performance Improvements
- **Before**:
  - CSS: 7,396 lines
  - Bundle Size: 134.60 kB

- **After Phase 2**:
  - CSS: 458 lines (94% reduction)
  - Bundle Size: 31.94 kB (76% reduction)
  - Vite hot-reload optimized
  - DOM caching in JavaScript

### Code Quality
- ✅ DRY principles throughout
- ✅ Configuration-driven validation
- ✅ Semantic HTML structure
- ✅ ARIA accessibility labels
- ✅ Component reusability
- ✅ Consistent naming conventions

### Security Features
- ✅ OTP rate limiting (5 attempts/hour)
- ✅ IP logging and attempt tracking
- ✅ Auto-cleanup of expired OTPs
- ✅ Secure password handling
- ✅ CSRF protection

---

## Known Issues & Solutions

### Active Issues
1. **Tags Table Missing**
   - Impact: Category filtering disabled
   - Solution: Empty arrays provided, functionality disabled
   - Files affected: CatalogController, WishlistController

2. **Legacy Custom CSS**
   - Impact: Minor code duplication
   - Plan: Remove during Phase 5 cleanup

### Resolved Issues
- ✅ Git .gitignore corruption (fixed)
- ✅ Phone validation too restrictive (fixed)
- ✅ APP_URL configuration mismatch (fixed)
- ✅ XAMPP vs Laravel Serve conflicts (resolved)
- ✅ CSS circular dependencies (fixed)
- ✅ Search dropdown mobile display (fixed)
- ✅ Dark mode text visibility (fixed)
- ✅ Route naming inconsistencies (fixed - front.celigin-join-club, otp.login.form)
- ✅ Wishlist banner component (fixed - changed to join-celigin-banners)
- ✅ My Account page layout (completely rebuilt with tabs)
- ✅ Tag model errors across 5 pages (CatalogController, WishlistController)
- ✅ Documentation sprawl (consolidated 22 files → 5 essential files)

---

## User Flow Implementation (Active)

### New Database Tables Required

#### 1. Wishlists Table
**Purpose**: Store user wishlist items (migrate from session to database)

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

**Features**:
- Guest wishlist stored in session
- On sign-in: merge session wishlist to database
- Prevent duplicate entries (unique constraint)
- Auto-delete on user/product deletion

#### 2. Addresses Table
**Purpose**: Store user delivery and billing addresses

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

**Features**:
- Max 3 addresses per user (enforced in controller)
- Only one default address (auto-managed in model)
- Types: home, work, other
- Integrated with checkout flow

### User Journey Flows

#### Flow 1: New User → My Account
1. User clicks "My Account" icon → Redirects to `/sign-in`
2. User enters phone/email → Receives OTP
3. User verifies OTP → Auto-create user account
4. Redirect to `/myaccount` dashboard
5. Dashboard shows empty states (no orders, no wishlist, no addresses)

#### Flow 2: Guest Cart → Checkout → Sign-In
1. Guest adds products to cart (session storage)
2. Guest clicks "Proceed to Checkout"
3. Middleware redirects to `/sign-in` (intended URL: `/checkout`)
4. Guest signs in with OTP
5. After verification → Redirect to `/checkout` with cart preserved
6. User must add delivery address to continue

#### Flow 3: Guest Wishlist → Sign-In → Merge
1. Guest adds 3 products to wishlist (session: `Session::get('wishlist')`)
2. Guest clicks "My Account" → Redirects to `/sign-in`
3. Guest signs in with OTP
4. **Wishlist Merge Service** runs automatically:
   - Reads session wishlist
   - Checks if products already in database wishlist
   - Adds new products to `wishlists` table
   - Clears session wishlist
5. User navigates to "Wishlists" tab → Sees all 3 items

#### Flow 4: Existing User with Data
1. User signs in
2. Dashboard loads with real data:
   - Total Orders: 5
   - Wishlist Items: 12
   - Points Earned: 250
3. User clicks "Purchase History" → Lists recent orders
4. User clicks "Manage Account" → Shows saved addresses
5. User can edit profile, add/edit addresses

### Implementation Checklist

**Phase 1-2: Header & Middleware** (Quick Wins)
- [ ] Update header My Account icon (`@auth` directive)
- [ ] Setup authentication middleware for protected routes
- [ ] Configure intended URL capture in `Authenticate.php`
- [ ] Apply middleware to `/myaccount` and `/checkout` routes

**Phase 3-4: Sign-In Redirects**
- [ ] Update `verify_otp()` to determine redirect URL
- [ ] Priority: intended URL → checkout (if cart) → my account
- [ ] Update frontend sign-in redirect logic
- [ ] Test all redirect scenarios

**Phase 5: Wishlist Merge**
- [ ] Create `wishlists` migration and model
- [ ] Create `WishlistMergeService.php`
- [ ] Integrate service into login flow
- [ ] Test guest-to-user wishlist merge

**Phase 6: Dynamic Dashboard**
- [ ] Update `AccountController` to pass real data
- [ ] Replace static "0" with order count, wishlist count, points
- [ ] Show actual purchase history
- [ ] Display real wishlist items
- [ ] Test with different user data states

**Phase 7: Address Management**
- [ ] Create `addresses` migration and model
- [ ] Create `AddressController` with CRUD methods
- [ ] Add routes for address management
- [ ] Build address UI in My Account (accordion)
- [ ] Enforce max 3 addresses per user
- [ ] Test add/edit/delete/set-default operations

**Phase 8: Checkout Integration**
- [ ] Update `CheckoutController` to load user addresses
- [ ] Display saved addresses in checkout view
- [ ] Pre-select default address
- [ ] Allow address selection before payment
- [ ] Save new addresses from checkout

## Future Enhancements

### Short Term (Next 2-4 Weeks)
- ✅ Complete user flow implementation (sign-in → cart → checkout → account)
- Complete Product Detail Page optimization
- Finish Shopping Cart styling
- Standardize all category page layouts
- Create comprehensive component documentation

### Medium Term (1-3 Months)
- Admin panel modernization
- Vendor dashboard optimization
- Mobile app considerations
- Progressive Web App features

### Long Term (3-6 Months)
- Performance monitoring dashboard
- A/B testing framework
- Advanced analytics integration
- Multi-language support enhancement

---

## Dependencies & Tools

### Frontend Stack
- Tailwind CSS 3.x
- Vite 4.x
- Alpine.js (minimal usage)
- Material Icons

### Backend Stack
- Laravel 10.x
- PHP 8.1+
- MySQL 8.x
- Intervention Image
- DomPDF

### Development Tools
- XAMPP 8.x
- npm/Node.js 18+
- Git version control
- VS Code (recommended)

---

## Team Guidelines

### Before Starting Work
1. Read CLAUDE.md for code guidelines
2. Check TASK.md for current priorities
3. Pull latest changes from repository
4. Run `npm run dev` for development

### During Development
1. Test in both light and dark modes
2. Verify responsive design (mobile → desktop)
3. Maintain accessibility standards
4. Follow existing component patterns

### Before Committing
1. Run `npm run build` to test production assets
2. Test all affected pages in XAMPP
3. Verify no console errors
4. Update documentation if needed

---

**Last Updated**: 2025-12-07 (User Flow Planning)
**Current Phase**: Phase 3 - E-commerce Pages (45% Complete)
**This Week**: My Account rebuild, User flow implementation, Documentation updates
**Next Milestone**: Complete user authentication journey (8 phases)
