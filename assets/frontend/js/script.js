// CELIGIN Website JavaScript - Optimized Implementation

class CeliginWebsite {
    constructor() {
        this.searchData = [
            {
                name: 'skin care',
                image: '/assets/images/main-banner-1.png',
                category: 'Skincare',
                description: 'Complete skincare solutions',
                price: '₹1,299'
            },
            {
                name: 'skin care set',
                image: '/assets/images/main-banner-2.png',
                category: 'Skincare',
                description: 'Curated skincare sets',
                price: '₹2,499'
            },
            {
                name: 'skin care for kids',
                image: '/assets/images/main-banner-3.png',
                category: 'Skincare',
                description: 'Gentle kids skincare',
                price: '₹899'
            },
            {
                name: 'skin care organizer',
                image: '/assets/images/main-banner-1.png',
                category: 'Accessories',
                description: 'Storage solutions',
                price: '₹1,599'
            },
            {
                name: 'skin care fridge',
                image: '/assets/images/main-banner-2.png',
                category: 'Accessories',
                description: 'Beauty refrigerator',
                price: '₹4,299'
            },
            {
                name: 'skin care kit',
                image: '/assets/images/main-banner-3.png',
                category: 'Skincare',
                description: 'Essential skincare kit',
                price: '₹1,899'
            },
            {
                name: 'skin care tools',
                image: '/assets/images/main-banner-1.png',
                category: 'Tools',
                description: 'Professional skincare tools',
                price: '₹3,299'
            },
            {
                name: 'skin care headband',
                image: '/assets/images/main-banner-2.png',
                category: 'Accessories',
                description: 'Beauty headbands'
            },
            {
                name: 'skin care coreano',
                image: '/assets/images/main-banner-3.png',
                category: 'Skincare',
                description: 'Korean skincare products'
            },
            {
                name: 'skin care bubble',
                image: '/assets/images/main-banner-1.png',
                category: 'Skincare',
                description: 'Bubble skincare products'
            },
            {
                name: 'vitamin c serum',
                image: '/assets/images/main-banner-2.png',
                category: 'Serums',
                description: 'Brightening vitamin C serum'
            },
            {
                name: 'vitamin c brightening',
                image: '/assets/images/main-banner-3.png',
                category: 'Serums',
                description: 'Vitamin C brightening products'
            },
            {
                name: 'retinol serum',
                image: '/assets/images/main-banner-1.png',
                category: 'Serums',
                description: 'Anti-aging retinol serum'
            },
            {
                name: 'hyaluronic acid',
                image: '/assets/images/main-banner-2.png',
                category: 'Serums',
                description: 'Hydrating hyaluronic acid'
            },
            {
                name: 'face cream',
                image: '/assets/images/main-banner-3.png',
                category: 'Moisturizers',
                description: 'Daily face cream'
            },
            {
                name: 'moisturizer',
                image: '/assets/images/main-banner-1.png',
                category: 'Moisturizers',
                description: 'Hydrating moisturizers'
            },
            {
                name: 'sunscreen',
                image: '/assets/images/main-banner-2.png',
                category: 'Sun Protection',
                description: 'SPF protection products'
            },
            {
                name: 'cleansing oil',
                image: '/assets/images/main-banner-3.png',
                category: 'Cleansers',
                description: 'Deep cleansing oil'
            },
            {
                name: 'toner',
                image: '/assets/images/main-banner-1.png',
                category: 'Toners',
                description: 'Balancing toners'
            },
            {
                name: 'face mask',
                image: '/assets/images/main-banner-2.png',
                category: 'Masks',
                description: 'Treatment face masks'
            },
            {
                name: 'anti aging cream',
                image: '/assets/images/main-banner-3.png',
                category: 'Anti-Aging',
                description: 'Anti-aging skincare'
            },
            {
                name: 'eye cream',
                image: '/assets/images/main-banner-1.png',
                category: 'Eye Care',
                description: 'Specialized eye cream'
            },
            {
                name: 'body lotion',
                image: '/assets/images/main-banner-2.png',
                category: 'Body Care',
                description: 'Nourishing body lotion'
            },
            {
                name: 'foundation',
                image: '/assets/images/main-banner-3.png',
                category: 'Makeup',
                description: 'Full coverage foundation'
            },
            {
                name: 'concealer',
                image: '/assets/images/main-banner-1.png',
                category: 'Makeup',
                description: 'High coverage concealer'
            },
            {
                name: 'mascara',
                image: '/assets/images/main-banner-2.png',
                category: 'Makeup',
                description: 'Lengthening mascara'
            },
            {
                name: 'lipstick',
                image: '/assets/images/main-banner-3.png',
                category: 'Makeup',
                description: 'Long-lasting lipstick'
            }
        ];
        this.currentSearchIndex = -1;
        this.searchResults = [];
        this.init();
    }

    init() {
        this.initializeSearch();
        this.initializePromoBar();
        this.initializeMobileMenu();
        this.initializeSwipers();
        this.initializeScrollToTop();
        this.initializeCategoryPage();
    }

    // Search Functionality - Amazon Style
    initializeSearch() {
        const searchInput = document.getElementById('search-input');
        const searchDropdown = document.getElementById('search-dropdown');
        const searchSuggestionsList = document.getElementById('search-suggestions-list');

        if (!searchInput || !searchDropdown || !searchSuggestionsList) return;

        let searchTimeout;

        // Input event - show suggestions as user types
        searchInput.addEventListener('input', (e) => {
            clearTimeout(searchTimeout);
            const query = e.target.value.trim();

            if (query.length === 0) {
                this.hideSearchDropdown();
                return;
            }

            // Debounce search
            searchTimeout = setTimeout(() => {
                this.showSearchSuggestions(query);
            }, 200);
        });

        // Focus event - show suggestions if there's a value
        searchInput.addEventListener('focus', (e) => {
            const query = e.target.value.trim();
            if (query.length > 0) {
                this.showSearchSuggestions(query);
            }
        });

        // Keyboard navigation
        searchInput.addEventListener('keydown', (e) => {
            this.handleKeyboardNavigation(e);
        });

        // Click outside to hide
        document.addEventListener('click', (e) => {
            if (!e.target.closest('.search-bar')) {
                this.hideSearchDropdown();
            }
        });

        // Escape key to hide
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                this.hideSearchDropdown();
            }
        });
    }

    showSearchSuggestions(query) {
        const suggestions = this.generateSuggestions(query);
        this.searchResults = suggestions;
        this.currentSearchIndex = -1;

        if (suggestions.length === 0) {
            this.renderEmptyState(query);
        } else {
            this.renderSuggestions(suggestions, query);
        }
        this.showSearchDropdown();
    }

    generateSuggestions(query) {
        const lowercaseQuery = query.toLowerCase();
        return this.searchData
            .filter(item => item.name.toLowerCase().includes(lowercaseQuery) || 
                          item.category.toLowerCase().includes(lowercaseQuery) ||
                          item.description.toLowerCase().includes(lowercaseQuery))
            .slice(0, 8); // Limit to 8 suggestions
    }

    renderSuggestions(suggestions, query) {
        const searchSuggestionsList = document.getElementById('search-suggestions-list');
        const lowercaseQuery = query.toLowerCase();

        searchSuggestionsList.innerHTML = suggestions.map((item, index) => {
            // Highlight matching text in name
            const highlightedName = item.name.replace(
                new RegExp(`(${query})`, 'gi'),
                '<strong>$1</strong>'
            );

            return `
                <div class="search-suggestion-item" data-index="${index}" data-suggestion="${item.name}" role="option" tabindex="-1">
                    <div class="suggestion-img">
                        <img src="${item.image}" alt="${item.name}" width="40" height="40" loading="lazy" decoding="async">
                    </div>
                    <div class="suggestion-content">
                        <div class="suggestion-name">${highlightedName}</div>
                        <div class="suggestion-category">${item.category}</div>
                    </div>
                    ${item.price ? `<div class="suggestion-price">${item.price}</div>` : ''}
                </div>
            `;
        }).join('');

        // Add "View all results" at the bottom if there are suggestions
        if (suggestions.length > 0) {
            searchSuggestionsList.innerHTML += `
                <div class="search-view-all">
                    <a href="/search?q=${encodeURIComponent(query)}" class="view-all-link">
                        View all results for "${query}"
                    </a>
                </div>
            `;
        }

        // Add click handlers
        searchSuggestionsList.querySelectorAll('.search-suggestion-item').forEach((item, index) => {
            item.addEventListener('click', () => {
                this.selectSuggestion(index);
            });
        });
    }

    renderEmptyState(query) {
        const searchSuggestionsList = document.getElementById('search-suggestions-list');
        const creativeMessages = [
            {
                icon: '🔍',
                title: 'No matches found',
                subtitle: `Try searching for "skincare", "vitamin C", or "moisturizer"`
            },
            {
                icon: '✨',
                title: 'Discover something new',
                subtitle: 'Browse our curated skincare collections instead'
            },
            {
                icon: '💡',
                title: 'Need skincare inspiration?',
                subtitle: 'Try "anti-aging", "hydrating serum", or "daily routine"'
            }
        ];

        const randomMessage = creativeMessages[Math.floor(Math.random() * creativeMessages.length)];

        searchSuggestionsList.innerHTML = `
            <div class="search-empty-state">
                <div class="empty-icon">${randomMessage.icon}</div>
                <div class="empty-title">${randomMessage.title}</div>
                <div class="empty-subtitle">${randomMessage.subtitle}</div>
            </div>
            <div class="search-view-all">
                <a href="/search?q=${encodeURIComponent(query)}" class="view-all-link">
                    Search anyway for "${query}"
                </a>
            </div>
        `;
    }

    handleKeyboardNavigation(e) {
        const dropdown = document.getElementById('search-dropdown');
        if (!dropdown.classList.contains('show')) return;

        switch (e.key) {
            case 'ArrowDown':
                e.preventDefault();
                this.navigateResults(1);
                break;
            case 'ArrowUp':
                e.preventDefault();
                this.navigateResults(-1);
                break;
            case 'Enter':
                e.preventDefault();
                if (this.currentSearchIndex >= 0) {
                    this.selectSuggestion(this.currentSearchIndex);
                }
                break;
            case 'Escape':
                e.preventDefault();
                this.hideSearchDropdown();
                break;
        }
    }

    navigateResults(direction) {
        const maxIndex = this.searchResults.length - 1;
        
        // Remove current highlight
        if (this.currentSearchIndex >= 0) {
            const currentItem = document.querySelector(`.search-suggestion-item[data-index="${this.currentSearchIndex}"]`);
            if (currentItem) currentItem.classList.remove('highlighted');
        }

        // Calculate new index
        if (direction > 0) {
            this.currentSearchIndex = this.currentSearchIndex < maxIndex ? 
                this.currentSearchIndex + 1 : 0;
        } else {
            this.currentSearchIndex = this.currentSearchIndex <= 0 ? 
                maxIndex : this.currentSearchIndex - 1;
        }

        // Highlight new item
        const newItem = document.querySelector(`.search-suggestion-item[data-index="${this.currentSearchIndex}"]`);
        if (newItem) {
            newItem.classList.add('highlighted');
            newItem.scrollIntoView({ block: 'nearest' });
        }
    }

    selectSuggestion(index) {
        const suggestionItem = this.searchResults[index];
        if (suggestionItem) {
            const searchInput = document.getElementById('search-input');
            searchInput.value = suggestionItem.name;
            this.hideSearchDropdown();
            
            // Perform search (placeholder for actual search functionality)
            this.performSearch(suggestionItem.name);
        }
    }

    performSearch(query) {
        window.location.href = `/search?q=${encodeURIComponent(query)}`;
    }

    showSearchDropdown() {
        const dropdown = document.getElementById('search-dropdown');
        const searchInput = document.getElementById('search-input');
        
        dropdown.classList.add('show');
        searchInput.setAttribute('aria-expanded', 'true');
    }

    hideSearchDropdown() {
        const dropdown = document.getElementById('search-dropdown');
        const searchInput = document.getElementById('search-input');
        
        dropdown.classList.remove('show');
        searchInput.setAttribute('aria-expanded', 'false');
        this.currentSearchIndex = -1;
        
        // Clear highlights
        document.querySelectorAll('.search-suggestion-item.highlighted').forEach(item => {
            item.classList.remove('highlighted');
        });
    }


    // Promo Bar Close
    initializePromoBar() {
        const promoClose = document.querySelector('.close-btn');
        if (promoClose) {
            promoClose.addEventListener('click', () => {
                const promoBar = document.querySelector('.promo-bar');
                if (promoBar) {
                    promoBar.style.display = 'none';
                    sessionStorage.setItem('promoClosed', 'true');
                }
            });
        }

        // Hide if previously closed in this session
        if (sessionStorage.getItem('promoClosed') === 'true') {
            const promoBar = document.querySelector('.promo-bar');
            if (promoBar) {
                promoBar.style.display = 'none';
            }
        }
    }

    // Mobile Menu Functionality
    initializeMobileMenu() {
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const mobileMenuClose = document.querySelector('.mobile-close-btn');

        if (!mobileMenuToggle || !mobileMenuOverlay || !mobileMenuClose) {
            return;
        }

        // Toggle mobile menu
        mobileMenuToggle.addEventListener('click', () => {
            this.toggleMobileMenu();
        });

        // Close mobile menu
        mobileMenuClose.addEventListener('click', () => {
            this.closeMobileMenu();
        });

        // Close menu when clicking overlay
        mobileMenuOverlay.addEventListener('click', (e) => {
            if (e.target === mobileMenuOverlay) {
                this.closeMobileMenu();
            }
        });

        // Close menu on escape key
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape' && mobileMenuOverlay.classList.contains('show')) {
                this.closeMobileMenu();
            }
        });

        // Close menu when clicking navigation links
        const mobileNavLinks = document.querySelectorAll('.mobile-nav-list a');
        mobileNavLinks.forEach(link => {
            link.addEventListener('click', () => {
                this.closeMobileMenu();
            });
        });

    }

    toggleMobileMenu() {
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const body = document.body;

        const isOpen = mobileMenuOverlay.classList.contains('show');

        if (isOpen) {
            this.closeMobileMenu();
        } else {
            // Open menu
            mobileMenuOverlay.classList.add('show');
            mobileMenuToggle.classList.add('active');
            mobileMenuToggle.setAttribute('aria-expanded', 'true');
            body.style.overflow = 'hidden'; // Prevent background scrolling
        }
    }

    closeMobileMenu() {
        const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
        const mobileMenuOverlay = document.getElementById('mobile-menu-overlay');
        const body = document.body;

        mobileMenuOverlay.classList.remove('show');
        mobileMenuToggle.classList.remove('active');
        mobileMenuToggle.setAttribute('aria-expanded', 'false');
        body.style.overflow = ''; // Restore scrolling
    }

    // SwiperJS Initialization
    initializeSwipers() {
        if (typeof Swiper === 'undefined') return;

        this.initHeroSwiper();
        this.initBestsellerSwiper();
        this.initHotdealsSwiper();
    }

    initHeroSwiper() {
        const heroSwiper = document.querySelector('.hero-swiper');
        if (!heroSwiper) return;

        try {
            new Swiper('.hero-swiper', {
                // Loop for infinite scroll
                loop: true,
                
                // Auto play
                autoplay: {
                    delay: 5000,
                    disableOnInteraction: false,
                },
                
                // Fade effect
                effect: 'fade',
                fadeEffect: {
                    crossFade: true
                },
                
                // Speed
                speed: 600,
                
                // Navigation arrows
                navigation: {
                    nextEl: '.hero-nav-next',
                    prevEl: '.hero-nav-prev',
                },
                
                // Pagination dots
                pagination: {
                    el: '.hero-pagination',
                    clickable: true,
                },
                
                // Accessibility
                a11y: {
                    enabled: true,
                }
            });
        } catch (error) {
        }
    }

    initBestsellerSwiper() {
        const bestsellerSwiper = document.querySelector('.bestseller-swiper');
        if (!bestsellerSwiper) return;

        try {
            new Swiper('.bestseller-swiper', {
                // Slides per view
                slidesPerView: 1,
                spaceBetween: 20,
                
                // Responsive breakpoints
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 20,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                },
                
                // Navigation arrows
                navigation: {
                    nextEl: '.bestseller-nav-next',
                    prevEl: '.bestseller-nav-prev',
                },
                
                // Loop
                loop: false,
                
                // Speed
                speed: 400,
                
                // Grab cursor
                grabCursor: false,
                
                // Accessibility
                a11y: {
                    enabled: true,
                }
            });
        } catch (error) {
        }
    }

    initHotdealsSwiper() {
        const hotdealsSwiper = document.querySelector('.hotdeals-swiper');
        if (!hotdealsSwiper) return;

        try {
            new Swiper('.hotdeals-swiper', {
                // Slides per view
                slidesPerView: 1,
                spaceBetween: 20,
                
                // Responsive breakpoints
                breakpoints: {
                    640: {
                        slidesPerView: 2,
                        spaceBetween: 20,
                    },
                    768: {
                        slidesPerView: 3,
                        spaceBetween: 20,
                    },
                    1024: {
                        slidesPerView: 4,
                        spaceBetween: 30,
                    },
                },
                
                // Navigation arrows
                navigation: {
                    nextEl: '.hotdeals-nav-next',
                    prevEl: '.hotdeals-nav-prev',
                },
                
                // Auto play for hot deals
                autoplay: {
                    delay: 4000,
                    disableOnInteraction: true,
                },
                
                // Loop
                loop: false,
                
                // Speed
                speed: 400,
                
                // Grab cursor
                grabCursor: false,
                
                // Accessibility
                a11y: {
                    enabled: true,
                }
            });
        } catch (error) {
        }
    }

    // Scroll to Top Functionality
    initializeScrollToTop() {
        const scrollToTopBtn = document.getElementById('scrollToTop');
        
        if (!scrollToTopBtn) return;

        // Show/hide button based on scroll position
        const toggleScrollButton = () => {
            if (window.pageYOffset > 300) {
                scrollToTopBtn.classList.add('show');
            } else {
                scrollToTopBtn.classList.remove('show');
            }
        };

        // Smooth scroll to top
        const scrollToTop = () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        };

        // Event listeners
        window.addEventListener('scroll', toggleScrollButton);
        scrollToTopBtn.addEventListener('click', scrollToTop);

        // Initial check
        toggleScrollButton();
    }

    // Category Page Lazy Loading
    initializeCategoryPage() {
        if (!document.querySelector('.products-grid')) return;
        
        this.initializeProductGrid();
        this.initializeFilters();
    }

    initializeProductGrid() {
        const productsGrid = document.getElementById('productsGrid');
        if (!productsGrid) return;

        // Sample product data for demonstration
        const sampleProducts = [
            {
                id: 1,
                name: "Vitamin C Brightening Serum",
                price: 45.99,
                originalPrice: 55.99,
                image: "assets/images/product-1.jpg",
                category: "serums",
                rating: 4.8,
                reviews: 124,
                badge: "Best Seller",
                discount: 18
            },
            {
                id: 2,
                name: "Hydrating Face Cream",
                price: 32.99,
                originalPrice: 39.99,
                image: "assets/images/product-2.jpg",
                category: "moisturizers",
                rating: 4.6,
                reviews: 89,
                badge: "New",
                discount: 18
            },
            {
                id: 3,
                name: "Gentle Cleansing Foam",
                price: 24.99,
                originalPrice: null,
                image: "assets/images/product-3.jpg",
                category: "cleansers",
                rating: 4.7,
                reviews: 156,
                badge: null,
                discount: 0
            },
            {
                id: 4,
                name: "Anti-Aging Night Cream",
                price: 65.99,
                originalPrice: 79.99,
                image: "assets/images/product-4.jpg",
                category: "anti-aging",
                rating: 4.9,
                reviews: 67,
                badge: "Premium",
                discount: 18
            },
            {
                id: 5,
                name: "Nourishing Face Oil",
                price: 38.99,
                originalPrice: 45.99,
                image: "assets/images/product-5.jpg",
                category: "oils",
                rating: 4.5,
                reviews: 92,
                badge: "Organic",
                discount: 15
            },
            {
                id: 6,
                name: "Exfoliating Scrub",
                price: 28.99,
                originalPrice: 34.99,
                image: "assets/images/product-6.jpg",
                category: "exfoliants",
                rating: 4.4,
                reviews: 78,
                badge: "Sale",
                discount: 17
            },
            {
                id: 7,
                name: "Rejuvenating Eye Cream",
                price: 42.99,
                originalPrice: 49.99,
                image: "assets/images/product-1.jpg",
                category: "eye-care",
                rating: 4.6,
                reviews: 103,
                badge: "Trending",
                discount: 14
            },
            {
                id: 8,
                name: "Brightening Toner",
                price: 26.99,
                originalPrice: 31.99,
                image: "assets/images/product-2.jpg",
                category: "toners",
                rating: 4.3,
                reviews: 145,
                badge: "New",
                discount: 16
            },
            {
                id: 9,
                name: "Hydrating Face Mask",
                price: 19.99,
                originalPrice: 24.99,
                image: "assets/images/product-3.jpg",
                category: "masks",
                rating: 4.7,
                reviews: 189,
                badge: "Popular",
                discount: 20
            },
            {
                id: 10,
                name: "Repair Serum Duo",
                price: 89.99,
                originalPrice: 109.99,
                image: "assets/images/product-4.jpg",
                category: "sets",
                rating: 4.8,
                reviews: 56,
                badge: "Bundle",
                discount: 18
            },
            {
                id: 11,
                name: "Daily Sunscreen SPF 50",
                price: 34.99,
                originalPrice: 39.99,
                image: "assets/images/product-5.jpg",
                category: "sunscreen",
                rating: 4.9,
                reviews: 234,
                badge: "Essential",
                discount: 13
            },
            {
                id: 12,
                name: "Lip Care Treatment",
                price: 16.99,
                originalPrice: 19.99,
                image: "assets/images/product-6.jpg",
                category: "lip-care",
                rating: 4.5,
                reviews: 167,
                badge: "Travel Size",
                discount: 15
            }
        ];

        // Simulate loading delay
        setTimeout(() => {
            this.renderProducts(sampleProducts, productsGrid);
            this.setupLazyLoading();
        }, 1000);
    }

    renderProducts(products, container) {
        // Remove loading placeholder
        container.innerHTML = '';

        products.forEach((product, index) => {
            const productCard = document.createElement('div');
            productCard.className = 'product-card lazy-loading';
            productCard.setAttribute('data-product-id', product.id);
            productCard.style.animationDelay = `${index * 100}ms`;

            const badgeHtml = product.badge ? `<span class="product-badge">${product.badge}</span>` : '';
            const discountHtml = product.discount > 0 ? `<span class="discount-badge">-${product.discount}%</span>` : '';
            const originalPriceHtml = product.originalPrice ? `<span class="original-price">$${product.originalPrice}</span>` : '';

            productCard.innerHTML = `
                <div class="product-image">
                    <img src="${product.image}" alt="${product.name}" loading="lazy">
                    ${badgeHtml}
                    ${discountHtml}
                    <div class="product-overlay">
                        <button class="quick-view-btn" data-product-id="${product.id}">Quick View</button>
                    </div>
                </div>
                <div class="product-info">
                    <h3 class="product-title">${product.name}</h3>
                    <div class="product-rating">
                        <div class="stars" data-rating="${product.rating}">
                            ${'★'.repeat(Math.floor(product.rating))}${'☆'.repeat(5 - Math.floor(product.rating))}
                        </div>
                        <span class="rating-count">(${product.reviews})</span>
                    </div>
                    <div class="product-price">
                        <span class="current-price">$${product.price}</span>
                        ${originalPriceHtml}
                    </div>
                </div>
                <div class="product-actions">
                    <button class="wishlist-btn" data-product-id="${product.id}" aria-label="Add to Wishlist">
                        <svg width="18" height="18" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M3.172 5.172a4 4 0 015.656 0L10 6.343l1.172-1.171a4 4 0 115.656 5.656L10 17.657l-6.828-6.829a4 4 0 010-5.656z" clip-rule="evenodd" />
                        </svg>
                    </button>
                    <button class="cart-btn" data-product-id="${product.id}">
                        Add to Cart
                    </button>
                </div>
            `;

            container.appendChild(productCard);
        });

        // Update products count
        const productsCount = document.querySelector('.products-count');
        if (productsCount) {
            productsCount.textContent = `Showing ${products.length} products`;
        }
    }

    setupLazyLoading() {
        const productCards = document.querySelectorAll('.product-card.lazy-loading');
        
        // Use Intersection Observer for smooth lazy loading animation
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.classList.remove('lazy-loading');
                        entry.target.classList.add('lazy-loaded');
                        observer.unobserve(entry.target);
                    }, index * 100);
                }
            });
        }, {
            threshold: 0.1,
            rootMargin: '50px'
        });

        productCards.forEach(card => {
            observer.observe(card);
        });

        // Setup product interactions
        this.setupProductInteractions();
    }

    setupProductInteractions() {
        // Quick view functionality
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('quick-view-btn')) {
                const productId = e.target.getAttribute('data-product-id');
                this.showQuickView(productId);
            }

            // Wishlist functionality
            if (e.target.closest('.wishlist-btn')) {
                const button = e.target.closest('.wishlist-btn');
                const productId = button.getAttribute('data-product-id');
                this.toggleWishlist(button, productId);
            }

            // Add to cart functionality
            if (e.target.classList.contains('cart-btn')) {
                const productId = e.target.getAttribute('data-product-id');
                this.addToCart(productId);
            }
        });
    }

    showQuickView(productId) {
        // Placeholder for quick view modal
        console.log(`Opening quick view for product ${productId}`);
        // In a real implementation, this would open a modal with product details
    }

    toggleWishlist(button, productId) {
        button.classList.toggle('active');
        const isActive = button.classList.contains('active');
        
        if (isActive) {
            button.setAttribute('aria-label', 'Remove from Wishlist');
            console.log(`Added product ${productId} to wishlist`);
        } else {
            button.setAttribute('aria-label', 'Add to Wishlist');
            console.log(`Removed product ${productId} from wishlist`);
        }
    }

    addToCart(productId) {
        console.log(`Added product ${productId} to cart`);
        // Show success message or update cart count
        this.showAddToCartNotification();
    }

    showAddToCartNotification() {
        // Create temporary notification
        const notification = document.createElement('div');
        notification.className = 'cart-notification';
        notification.innerHTML = '✓ Product added to cart!';
        notification.style.cssText = `
            position: fixed;
            top: 2rem;
            right: 2rem;
            background: var(--accent-primary);
            color: white;
            padding: 1rem 1.5rem;
            border-radius: var(--radius-none);
            z-index: 10000;
            animation: slideInRight 0.3s ease;
        `;
        
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.remove();
        }, 3000);
    }

    initializeFilters() {
        const filterSelect = document.querySelector('.filter-select');
        if (!filterSelect) return;

        filterSelect.addEventListener('change', (e) => {
            const sortBy = e.target.value;
            this.sortProducts(sortBy);
        });
    }

    sortProducts(sortBy) {
        const productsGrid = document.getElementById('productsGrid');
        const productCards = Array.from(productsGrid.querySelectorAll('.product-card'));

        productCards.sort((a, b) => {
            switch (sortBy) {
                case 'price-low':
                    return this.getProductPrice(a) - this.getProductPrice(b);
                case 'price-high':
                    return this.getProductPrice(b) - this.getProductPrice(a);
                case 'rating':
                    return this.getProductRating(b) - this.getProductRating(a);
                case 'discount':
                    return this.getProductDiscount(b) - this.getProductDiscount(a);
                case 'newest':
                    return this.getProductId(b) - this.getProductId(a);
                default:
                    return 0;
            }
        });

        // Re-append sorted elements
        productCards.forEach(card => productsGrid.appendChild(card));
    }

    getProductPrice(card) {
        const priceText = card.querySelector('.current-price').textContent;
        return parseFloat(priceText.replace('$', ''));
    }

    getProductRating(card) {
        const rating = card.querySelector('.stars').getAttribute('data-rating');
        return parseFloat(rating);
    }

    getProductDiscount(card) {
        const discountBadge = card.querySelector('.discount-badge');
        if (!discountBadge) return 0;
        return parseInt(discountBadge.textContent.replace(/[-%]/g, ''));
    }

    getProductId(card) {
        return parseInt(card.getAttribute('data-product-id'));
    }
}

// Initialize when DOM is ready
document.addEventListener('DOMContentLoaded', () => {
    window.celiginApp = new CeliginWebsite();
});