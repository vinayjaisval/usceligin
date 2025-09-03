// CELIGIN Application Configuration
// Enterprise-level configuration management for CELIGIN website

const CeliginConfig = {
    // Application Information
    app: {
        name: 'CELIGIN',
        version: '1.0.0',
        description: 'Premium Cosmetics & Skincare Website',
        author: 'CELIGIN Team',
        buildDate: new Date().toISOString()
    },

    // Asset Paths
    paths: {
        css: './assets/css/',
        js: './assets/js/',
        images: './assets/images/',
        fonts: './assets/fonts/'
    },

    // Theme Configuration
    theme: {
        default: 'light',
        storageKey: 'celigin-theme',
        transitionDuration: '0.3s'
    },

    // SwiperJS Configuration
    swiper: {
        hero: {
            effect: 'fade',
            autoplay: {
                delay: 5000,
                disableOnInteraction: false
            },
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            pagination: {
                el: '.swiper-pagination',
                clickable: true
            },
            loop: true,
            accessibility: {
                enabled: true
            }
        },
        products: {
            slidesPerView: 'auto',
            spaceBetween: 20,
            navigation: {
                nextEl: '.swiper-button-next',
                prevEl: '.swiper-button-prev'
            },
            breakpoints: {
                640: { slidesPerView: 2 },
                768: { slidesPerView: 3 },
                1024: { slidesPerView: 4 }
            },
            lazy: {
                loadPrevNext: true
            }
        }
    },

    // API Configuration (for future use)
    api: {
        baseUrl: 'https://api.celigin.com',
        timeout: 10000,
        retries: 3
    },

    // Feature Flags
    features: {
        darkMode: true,
        swiperCarousels: true,
        lazyLoading: true,
        analytics: false,
        serviceWorker: false
    },

    // Accessibility Settings
    accessibility: {
        reducedMotion: true,
        screenReader: true,
        keyboardNavigation: true,
        focusManagement: true
    },

    // Performance Settings
    performance: {
        imageOptimization: true,
        lazyLoading: true,
        prefetchResources: false
    },

    // SEO Configuration
    seo: {
        siteName: 'CELIGIN',
        title: 'CELIGIN - Premium Cosmetics & Skincare',
        description: 'Discover premium cosmetics and skincare products at CELIGIN. Science-backed beauty solutions for all skin types.',
        keywords: ['cosmetics', 'skincare', 'beauty', 'premium', 'natural'],
        author: 'CELIGIN Team',
        robots: 'index, follow'
    }
};

// Export for use in modules (if using ES6 modules in future)
if (typeof module !== 'undefined' && module.exports) {
    module.exports = CeliginConfig;
}

// Make available globally
window.CeliginConfig = CeliginConfig;