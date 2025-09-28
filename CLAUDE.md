# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

This is a Laravel-based e-commerce platform called "Usceligin" - a multi-vendor marketplace with extensive payment gateway integrations and user management features.

## Development Commands

### Build and Development
- `npm run dev` - Start Vite development server for asset compilation
- `npm run build` - Build assets for production using Vite
- `php artisan serve` - Start Laravel development server (typically on http://localhost:8000)

### Testing and Quality
- `vendor/bin/phpunit` - Run PHPUnit tests
- `php artisan test` - Alternative Laravel test runner
- `vendor/bin/pint` - Laravel Pint code formatter (if available)

### Database Operations
- `php artisan migrate` - Run database migrations
- `php artisan migrate:fresh --seed` - Fresh migration with seeders
- `php artisan db:seed` - Run database seeders

### Cache and Optimization
- `php artisan config:cache` - Cache configuration files
- `php artisan route:cache` - Cache routes for production
- `php artisan view:cache` - Cache compiled views
- `php artisan optimize:clear` - Clear all cached data

## Architecture Overview

### Multi-Role System
The application supports multiple user types with dedicated controllers:
- **Admin**: Full platform management (`app/Http/Controllers/Admin/`)
- **Vendor**: Seller/merchant functionality (`app/Http/Controllers/Vendor/`)
- **User**: Customer functionality (`app/Http/Controllers/User/`)
- **Rider**: Delivery personnel (`app/Http/Controllers/Rider/`)
- **Front**: Public-facing pages (`app/Http/Controllers/Front/`)

### Key Business Models
- **Product**: Complex e-commerce product model with variants, attributes, and inventory management
- **Order**: Comprehensive order management with vendor order splitting
- **Cart**: Shopping cart with session and user persistence
- **User**: Multi-role user system with vendor capabilities
- **PaymentGateway**: Extensive payment provider integrations

### Payment Integration
The platform integrates with multiple payment providers:
- Stripe, Razorpay, PayPal, Mollie, Authorize.net
- Instamojo, MercadoPago
- Custom payment gateway configurations

### API Structure
- REST API endpoints in `routes/api.php`
- JWT authentication via `tymon/jwt-auth`
- API controllers in `app/Http/Controllers/Api/`

## Database Configuration

- Default connection: MySQL
- Database name: `us_devceligin`
- Port: 3307 (non-standard MySQL port)
- Configured for local development with XAMPP

### OTP Authentication System
- **OTP Service**: `app/Services/OtpService.php` - Complete OTP generation, sending, and verification
- **OTP Model**: `app/Models/OtpVerification.php` - Database model for OTP storage
- **Migration**: OTP verification table with phone/email support
- **Configuration**: `.env` variables for OTP length, expiry, rate limiting
- **Security**: Rate limiting, attempt tracking, IP logging, auto-cleanup

## Asset Management

- Vite-powered asset compilation
- Entry points: `resources/css/app.css`, `resources/js/app.js`
- Laravel Vite plugin with hot reloading enabled

## Key Features

### E-commerce Core
- Multi-vendor marketplace
- Product variants and attributes
- Shopping cart and wishlist
- Order management and tracking
- Inventory management

### User Management
- Role-based access control
- Vendor registration and management
- Customer accounts with addresses
- **OTP Authentication**: Phone and email verification system
- Auto-user creation on OTP verification
- Phone verification status tracking
- Social login integration

### Content Management
- Blog system with categories
- CMS pages and SEO tools
- Banner and slider management
- Testimonials and reviews

### Communication
- Admin-user messaging system
- Notifications and email templates
- SMS integration capabilities

## Development Notes

- Laravel 10.x framework
- PHP 8.1+ requirement
- Extensive use of Eloquent relationships
- Multi-language support structure
- Image processing via Intervention Image
- PDF generation with DomPDF

## Tailwind CSS Migration Plan

### Current State ✅ COMPLETED
- ✅ Custom CSS: Reduced from 7,396 to 458 lines (94% reduction)
- ✅ Tailwind CSS integration with Vite
- ✅ CSS variables preserved and converted to RGB format
- ✅ Modern component system (tooltips, alerts)
- ✅ WCAG AA accessibility compliance
- ✅ Full light/dark mode support

### Migration Strategy ✅ PHASE 1 COMPLETE
**✅ Phase 1: Setup & Foundation (COMPLETED)**
- ✅ Tailwind CSS installed and configured
- ✅ CSS variables extracted and preserved
- ✅ Tailwind configured to use existing design tokens
- ✅ Base configuration and build system working

**✅ Phase 2: Component Systems & Optimization (COMPLETED)**
- ✅ Modern alert system with 4 variants (info, success, error, warning)
- ✅ Reusable tooltip system with accessibility
- ✅ Semantic checkbox implementation
- ✅ **Sign-in page complete optimization with DRY principles**
- ✅ **OTP system optimization and production-ready configuration**
- ✅ **Auto-redirect functionality after OTP verification**
- ✅ **Component-based CSS architecture implementation**
- ✅ **DOM element caching and performance optimization**

**⏭️ Phase 3: Page Migration & Cleanup (UPCOMING)**
- Page-by-Page Tailwind migration (starting with other pages)
- Remove unused custom CSS
- Performance optimization and testing
- Cross-browser and accessibility testing

### Achievements So Far
- **CSS Bundle Size**: 7,396 lines → 458 lines (94% reduction)
- **Component System**: Modern, accessible, reusable
- **Accessibility**: WCAG 2.1 AA compliant
- **Theme Support**: Full light/dark mode with CSS variables
- **Performance**: Vite hot-reload optimized
- **OTP System**: Production-ready with comprehensive error handling
- **Sign-in Page**: Fully optimized with DRY principles and auto-redirect
- **XAMPP Integration**: Seamless deployment with traditional XAMPP setup

### Architecture Improvements
- **Design System**: CSS custom properties for consistent theming
- **Accessibility**: Proper ARIA roles, semantic HTML, screen reader support
- **Maintainability**: Single CSS file with organized layers
- **Future-proof**: Modern CSS features and Tailwind utilities
- **Configuration-Driven**: Centralized config objects for validation and settings
- **Performance**: DOM element caching and optimized event handling
- **Security**: Comprehensive OTP system with rate limiting and validation

## OTP Authentication System Details

### Core Files
- **Service**: `app/Services/OtpService.php` - Main OTP business logic
- **Model**: `app/Models/OtpVerification.php` - Database operations
- **Controller**: OTP endpoints for send/verify/resend operations
- **Frontend**: `resources/views/frontend/sign-in.blade.php` - Optimized UI
- **Styles**: `assets/frontend/css/styles.css` - Component-based CSS
- **Documentation**: `signIn.md` - Comprehensive technical documentation

### Key Features
- **Dual Method Support**: Phone and email OTP verification
- **Indian Phone Validation**: Supports 6-9 starting digit pattern
- **Rate Limiting**: 5 attempts per hour per contact
- **Auto-User Creation**: Creates users automatically on successful verification
- **Security**: IP logging, attempt tracking, auto-cleanup of expired OTPs
- **Development Mode**: Fixed OTP for testing, comprehensive logging
- **Production Ready**: XAMPP deployment, optimized asset building
- **Auto-Redirect**: 2-second auto-navigation after successful verification

### Environment Configuration
```env
# OTP Configuration
OTP_LENGTH=6
OTP_EXPIRY_MINUTES=10
OTP_MAX_ATTEMPTS_PER_HOUR=5
OTP_MAX_VERIFICATION_ATTEMPTS=3
OTP_DEVELOPMENT_CODE=123456

# Security Options
OTP_HASH_IN_DATABASE=false
OTP_LOG_IN_DEVELOPMENT=true
OTP_CLEANUP_EXPIRED=true
```

### Deployment
- **XAMPP Ready**: Works with `http://localhost/usceligin`
- **Production Assets**: Use `npm run build` for production deployment
- **Laravel Serve**: Alternative development with `php artisan serve`
- **Database**: MySQL on port 3307 with `us_devceligin` database