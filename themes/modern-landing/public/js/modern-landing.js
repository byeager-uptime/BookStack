/**
 * Modern Landing Page JavaScript
 * Handles interactive features and animations
 */

document.addEventListener('DOMContentLoaded', function() {
    // Initialize animations and interactions
    initScrollAnimations();
    initCardHovers();
    initStatsCountUp();
    
    // Ensure search component is initialized
    initHeroSearch();
});

/**
 * Initialize scroll-based animations
 */
function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe elements for animation
    const animateElements = document.querySelectorAll('.stat-card, .feature-card, .book-card, .featured-card');
    animateElements.forEach(el => {
        el.style.opacity = '0';
        el.style.transform = 'translateY(20px)';
        el.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        observer.observe(el);
    });

    // Add CSS for animation
    const style = document.createElement('style');
    style.textContent = `
        .animate-in {
            opacity: 1 !important;
            transform: translateY(0) !important;
        }
    `;
    document.head.appendChild(style);
}

/**
 * Add hover effects to cards
 */
function initCardHovers() {
    const cards = document.querySelectorAll('.book-card, .featured-card, .feature-card');
    
    cards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-4px)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0)';
        });
    });
}

/**
 * Animate stats numbers counting up
 */
function initStatsCountUp() {
    const statNumbers = document.querySelectorAll('.stat-number');
    
    const countUp = (element, target) => {
        const duration = 2000; // 2 seconds
        const start = 0;
        const increment = target / (duration / 16); // 60fps
        let current = start;
        
        const timer = setInterval(() => {
            current += increment;
            if (current >= target) {
                current = target;
                clearInterval(timer);
            }
            element.textContent = Math.floor(current).toLocaleString();
        }, 16);
    };
    
    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const target = parseInt(entry.target.textContent.replace(/,/g, ''));
                countUp(entry.target, target);
                observer.unobserve(entry.target);
            }
        });
    }, { threshold: 0.5 });
    
    statNumbers.forEach(stat => {
        observer.observe(stat);
    });
}

/**
 * Smooth scrolling for anchor links
 */
function initSmoothScrolling() {
    const links = document.querySelectorAll('a[href^="#"]');
    
    links.forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                target.scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        });
    });
}

/**
 * Add floating animation variance to hero cards
 */
function enhanceFloatingAnimation() {
    const floatingCards = document.querySelectorAll('.floating-card');
    
    floatingCards.forEach((card, index) => {
        // Add slight random variance to animation timing
        const delay = Math.random() * 2;
        const duration = 6 + Math.random() * 2;
        
        card.style.animationDelay = `${delay}s`;
        card.style.animationDuration = `${duration}s`;
        
        // Add subtle rotation on hover
        card.addEventListener('mouseenter', function() {
            this.style.transform = 'translateY(-10px) rotate(2deg)';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.transform = 'translateY(0) rotate(0deg)';
        });
    });
}

// Initialize enhanced animations after DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    enhanceFloatingAnimation();
    initSmoothScrolling();
});

/**
 * Theme-aware animations
 */
function initThemeAwareAnimations() {
    const isDarkMode = document.documentElement.classList.contains('dark');
    
    // Adjust animation timing for dark mode
    if (isDarkMode) {
        const floatingCards = document.querySelectorAll('.floating-card');
        floatingCards.forEach(card => {
            card.style.animationDuration = '8s'; // Slower in dark mode
        });
    }
}

// Check for theme changes
const observer = new MutationObserver(function(mutations) {
    mutations.forEach(function(mutation) {
        if (mutation.attributeName === 'class') {
            initThemeAwareAnimations();
        }
    });
});

observer.observe(document.documentElement, {
    attributes: true,
    attributeFilter: ['class']
});

// Initialize theme-aware features
initThemeAwareAnimations();

/**
 * Initialize hero search functionality
 */
function initHeroSearch() {
    // Wait for BookStack components to be fully loaded
    setTimeout(() => {
        const heroSearchForm = document.querySelector('.hero-search-container .search-box');
        if (!heroSearchForm) return;
        
        // Find the global search component instance
        const headerSearch = document.querySelector('#header .search-box');
        if (headerSearch && window.$components) {
            // Try to get the component instance
            const searchComponent = window.$components.firstOnElement(headerSearch, 'global-search');
            if (searchComponent) {
                // Initialize our hero search with the same component
                window.$components.init(heroSearchForm);
            }
        }
        
        // Ensure proper CSS classes
        const searchInput = heroSearchForm.querySelector('input[refs="global-search@input"]');
        if (searchInput) {
            searchInput.addEventListener('focus', () => {
                heroSearchForm.classList.add('search-active');
            });
            
            searchInput.addEventListener('blur', () => {
                setTimeout(() => {
                    if (!heroSearchForm.querySelector('.global-search-suggestions:hover')) {
                        heroSearchForm.classList.remove('search-active');
                    }
                }, 200);
            });
        }
    }, 500);
}