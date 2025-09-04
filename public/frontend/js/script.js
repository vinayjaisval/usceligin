// CELIGIN Website JavaScript - Optimized Implementation

class CeliginWebsite {
    constructor() {
        this.searchData = [
            'skin care',
            'skin care set',
            'skin care for kids',
            'skin care organizer', 
            'skin care fridge',
            'skin care kit',
            'skin care tools',
            'skin care headband',
            'skin care coreano',
            'skin care bubble',
            'vitamin c serum',
            'vitamin c brightening',
            'retinol serum',
            'hyaluronic acid',
            'face cream',
            'moisturizer',
            'sunscreen',
            'cleansing oil',
            'toner',
            'face mask',
            'anti aging cream',
            'eye cream',
            'body lotion',
            'foundation',
            'concealer',
            'mascara',
            'lipstick'
        ];
        this.currentSearchIndex = -1;
        this.searchResults = [];
        this.init();
    }

    init() {
        this.initializeSearch();
        this.initializeTheme();
        this.initializePromoBar();
        this.initializeMobileMenu();
        this.initializeSwipers();
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
            this.hideSearchDropdown();
            return;
        }
        this.renderSuggestions(suggestions, query);
        this.showSearchDropdown();
    }

    generateSuggestions(query) {
        const lowercaseQuery = query.toLowerCase();
        return this.searchData
            .filter(suggestion => suggestion.toLowerCase().includes(lowercaseQuery))
            .slice(0, 8); // Limit to 8 suggestions
    }

    renderSuggestions(suggestions, query) {
        const searchSuggestionsList = document.getElementById('search-suggestions-list');
        const lowercaseQuery = query.toLowerCase();

        searchSuggestionsList.innerHTML = suggestions.map((suggestion, index) => {
            // Highlight matching text
            const highlightedText = suggestion.replace(
                new RegExp(`(${query})`, 'gi'),
                '<strong>$1</strong>'
            );

            return `
                <div class="search-suggestion-item" data-index="${index}" data-suggestion="${suggestion}">
                    <svg class="search-icon" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                        <circle cx="11" cy="11" r="8"></circle>
                        <path d="m21 21-4.35-4.35"></path>
                    </svg>
                    <span class="suggestion-text">${highlightedText}</span>
                </div>
            `;
        }).join('');

        // Add click handlers
        searchSuggestionsList.querySelectorAll('.search-suggestion-item').forEach((item, index) => {
            item.addEventListener('click', () => {
                this.selectSuggestion(index);
            });
        });
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
        const suggestion = this.searchResults[index];
        if (suggestion) {
            const searchInput = document.getElementById('search-input');
            searchInput.value = suggestion;
            this.hideSearchDropdown();
            
            // Perform search (placeholder for actual search functionality)
            this.performSearch(suggestion);
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

    // Basic Theme Toggle
    initializeTheme() {
        const themeToggle = document.querySelector('.theme-toggle');
        if (themeToggle) {
            themeToggle.addEventListener('click', () => {
                const currentTheme = document.documentElement.getAttribute('data-theme');
                const newTheme = currentTheme === 'dark' ? 'light' : 'dark';
                document.documentElement.setAttribute('data-theme', newTheme);
                localStorage.setItem('theme', newTheme);
            });
        }

        // Set initial theme
        const savedTheme = localStorage.getItem('theme') || 'light';
        document.documentElement.setAttribute('data-theme', savedTheme);
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
                grabCursor: true,
                
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
                grabCursor: true,
                
                // Accessibility
                a11y: {
                    enabled: true,
                }
            });
        } catch (error) {
        }
    }
}

// Initialize when DOM is ready

document.addEventListener('DOMContentLoaded', () => {
    window.celiginApp = new CeliginWebsite();
});