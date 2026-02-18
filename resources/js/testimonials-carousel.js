// Testimonials Carousel
document.addEventListener('DOMContentLoaded', function() {
    const carousel = document.querySelector('.testimonials-carousel');
    const cards = document.querySelectorAll('.testimonial-card');
    const prevButton = document.querySelector('.testimonials-prev');
    const nextButton = document.querySelector('.testimonials-next');
    const dotsContainer = document.querySelector('.testimonials-dots');

    if (!carousel || cards.length === 0) return;

    let currentIndex = 0;
    let autoPlayInterval = null;
    const autoPlayDelay = 5000; // 5 seconds

    // Function to get card width dynamically
    function getCardWidth() {
        if (cards.length === 0) return 0;
        const card = cards[0];
        const cardStyle = window.getComputedStyle(card);
        const cardWidth = card.offsetWidth;
        const gap = parseInt(window.getComputedStyle(carousel).gap) || 24;
        return cardWidth + gap;
    }

    // Create dots indicator
    if (dotsContainer) {
        cards.forEach((_, index) => {
            const dot = document.createElement('button');
            dot.classList.add('testimonial-dot');
            if (index === 0) dot.classList.add('active');
            dot.setAttribute('aria-label', `Go to testimonial ${index + 1}`);
            dot.addEventListener('click', () => goToSlide(index));
            dotsContainer.appendChild(dot);
        });
    }

    function updateCarousel(shouldScroll = false) {
        const cardWidth = getCardWidth();
        if (cardWidth === 0) return;

        // In RTL, scrollLeft is negative, so we need to scroll to negative position
        const scrollPosition = currentIndex * cardWidth;
        
        // Scroll to the card position only if explicitly requested (user interaction)
        // Don't scroll on initial load to prevent page jumping
        if (shouldScroll) {
            const targetCard = cards[currentIndex];
            if (targetCard) {
                targetCard.scrollIntoView({
                    behavior: 'smooth',
                    block: 'nearest',
                    inline: 'center',
                });
            }
        }

        // Update dots
        const dots = document.querySelectorAll('.testimonial-dot');
        dots.forEach((dot, index) => {
            if (index === currentIndex) {
                dot.classList.add('active');
            } else {
                dot.classList.remove('active');
            }
        });

        // Update button states (disabled removed for looping)
        if (prevButton) {
            prevButton.disabled = false;
        }
        if (nextButton) {
            nextButton.disabled = false;
        }
    }

    function goToSlide(index) {
        if (index < 0 || index >= cards.length) return;
        currentIndex = index;
        updateCarousel(true); // Allow scrolling for user interaction
        resetAutoPlay();
    }

    function nextSlide() {
        if (currentIndex < cards.length - 1) {
            currentIndex++;
        } else {
            currentIndex = 0; // Loop back to start
        }
        updateCarousel(true); // Allow scrolling for user interaction
        resetAutoPlay();
    }

    function prevSlide() {
        if (currentIndex > 0) {
            currentIndex--;
        } else {
            currentIndex = cards.length - 1; // Loop to end
        }
        updateCarousel(true); // Allow scrolling for user interaction
        resetAutoPlay();
    }

    function startAutoPlay() {
        // Auto-play disabled - only manual navigation
        // autoPlayInterval = setInterval(nextSlide, autoPlayDelay);
    }

    function stopAutoPlay() {
        if (autoPlayInterval) {
            clearInterval(autoPlayInterval);
            autoPlayInterval = null;
        }
    }

    function resetAutoPlay() {
        stopAutoPlay();
        // Auto-play disabled - only manual navigation
        // startAutoPlay();
    }

    // Button event listeners
    if (nextButton) {
        nextButton.addEventListener('click', nextSlide);
    }
    if (prevButton) {
        prevButton.addEventListener('click', prevSlide);
    }

    // Auto-play disabled - no need for hover pause
    // carousel.addEventListener('mouseenter', stopAutoPlay);
    // carousel.addEventListener('mouseleave', startAutoPlay);

    // Touch/swipe support
    let touchStartX = 0;
    let touchEndX = 0;

    carousel.addEventListener('touchstart', (e) => {
        touchStartX = e.changedTouches[0].screenX;
        // Auto-play disabled
        // stopAutoPlay();
    });

    carousel.addEventListener('touchend', (e) => {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
        // Auto-play disabled
        // startAutoPlay();
    });

    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                // Swipe left - next
                nextSlide();
            } else {
                // Swipe right - previous
                prevSlide();
            }
        }
    }

    // Initialize without scrolling to prevent page jump on load
    updateCarousel(false);
    // Auto-play disabled - only manual navigation
    // startAutoPlay();

    // Handle window resize
    let resizeTimer;
    window.addEventListener('resize', () => {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(() => {
            updateCarousel(false); // Don't scroll on resize
        }, 250);
    });
});

