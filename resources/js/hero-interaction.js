// Hero Section Interactive Cards
document.addEventListener('DOMContentLoaded', function() {
    // Use services from database if available, otherwise use fallback
    const services = window.homePageServices || {};

    // Get DOM elements
    const heroSection = document.querySelector('.hero-section');
    if (!heroSection) return;

    const backgroundDiv = heroSection.querySelector('.hero-background');
    const titleSpan = heroSection.querySelector('.hero-title-main');
    const subtitleSpan = heroSection.querySelector('.hero-subtitle');
    const descriptionP = heroSection.querySelector('.hero-description');
    const badgeSpan = heroSection.querySelector('.hero-badge-text');
    const badgeIcon = heroSection.querySelector('.hero-badge-icon');
    const statsContainer = heroSection.querySelector('.hero-stats');
    const ctaButton = heroSection.querySelector('.service-cta-button');
    const ctaButtonText = heroSection.querySelector('.service-cta-text');
    const cards = heroSection.querySelectorAll('.service-card');

    let currentService = 'tourism';
    let isTransitioning = false;

    // Function to update hero content
    function updateHeroContent(serviceId) {
        if (isTransitioning || serviceId === currentService) return;
        
        const service = services[serviceId];
        if (!service) return;

        isTransitioning = true;
        currentService = serviceId;

        // Fade out content
        const contentWrapper = heroSection.querySelector('.hero-content-wrapper');
        if (contentWrapper) {
            contentWrapper.style.opacity = '0';
            contentWrapper.style.transform = 'translateY(20px)';
        }

        // Update background with fade effect
        if (backgroundDiv && service.backgroundImage) {
            backgroundDiv.style.opacity = '0';
            
            setTimeout(() => {
                backgroundDiv.style.backgroundImage = `linear-gradient(rgba(32, 29, 18, 0.7), rgba(32, 29, 18, 0.8)), url('${service.backgroundImage}')`;
                backgroundDiv.style.opacity = '1';
            }, 300);
        }

        // Update content after fade out
        setTimeout(() => {
            if (titleSpan) titleSpan.textContent = service.title;
            if (subtitleSpan) subtitleSpan.textContent = service.subtitle;
            if (descriptionP) descriptionP.textContent = service.description;
            if (badgeSpan) badgeSpan.textContent = service.badge;
            if (badgeIcon) badgeIcon.textContent = service.badgeIcon;

            // Update stats
            if (statsContainer && service.stats && Array.isArray(service.stats)) {
                const statElements = statsContainer.querySelectorAll('.stat-item');
                service.stats.forEach((stat, index) => {
                    if (statElements[index]) {
                        const valueEl = statElements[index].querySelector('.stat-value');
                        const labelEl = statElements[index].querySelector('.stat-label');
                        if (valueEl) valueEl.textContent = stat.value || '';
                        if (labelEl) labelEl.textContent = stat.label || '';
                    }
                });
            }

            // Update CTA button
            if (ctaButton && service.ctaButtonText) {
                if (ctaButtonText) {
                    ctaButtonText.textContent = service.ctaButtonText;
                }
                ctaButton.setAttribute('href', service.ctaButtonUrl || '#');
                ctaButton.style.display = 'flex';
            } else if (ctaButton && !service.ctaButtonText) {
                ctaButton.style.display = 'none';
            }

            // Fade in new content
            if (contentWrapper) {
                contentWrapper.style.opacity = '1';
                contentWrapper.style.transform = 'translateY(0)';
            }

            isTransitioning = false;
        }, 300);
    }

    // Update card states
    function updateCardStates(activeId) {
        cards.forEach(card => {
            const cardId = card.dataset.serviceId;
            if (cardId === activeId) {
                card.classList.add('active');
                card.classList.remove('inactive');
                // Update height for active card
                if (window.innerWidth >= 1024) {
                    card.style.height = '180px';
                }
            } else {
                card.classList.remove('active');
                card.classList.add('inactive');
                // Update height for inactive card
                if (window.innerWidth >= 1024) {
                    card.style.height = '160px';
                }
            }
        });
    }

    // Add click handlers to cards
    cards.forEach(card => {
        card.addEventListener('click', function(e) {
            const serviceId = this.dataset.serviceId;
            const href = this.getAttribute('href');
            
            // If there's a real URL (not '#' or empty), allow navigation
            if (href && href !== '#' && href !== '') {
                // Still update hero content for visual feedback
                if (serviceId && !isTransitioning) {
                    updateHeroContent(serviceId);
                    updateCardStates(serviceId);
                }
                // Allow default navigation to proceed
                return true;
            }
            
            // If no real URL, prevent navigation and just update hero content
            e.preventDefault();
            if (serviceId && !isTransitioning) {
                updateHeroContent(serviceId);
                updateCardStates(serviceId);
            }
        });
    });

    // Initialize - set first service as active
    if (cards.length > 0) {
        const firstCard = cards[0];
        const firstServiceId = firstCard.dataset.serviceId;
        if (firstServiceId) {
            updateCardStates(firstServiceId);
        }
    }
});
