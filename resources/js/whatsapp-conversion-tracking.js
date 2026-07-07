function isWhatsAppLink(href) {
    if (! href || href === '#') {
        return false;
    }

    return href.includes('wa.me') || href.includes('whatsapp');
}

function navigateToWhatsApp(url, openInNewTab) {
    if (openInNewTab) {
        window.open(url, '_blank', 'noopener,noreferrer');

        return;
    }

    window.location.href = url;
}

function trackTikTokWhatsAppClick() {
    if (typeof ttq === 'undefined') {
        return;
    }

    ttq.track('Contact', {
        content_name: 'WhatsApp Button',
        content_category: 'Lead Generation',
    });
}

export function trackWhatsAppConversion(callback, options = {}) {
    const { url = null, openInNewTab = false } = options;

    trackTikTokWhatsAppClick();

    const navigate = () => {
        if (typeof callback === 'function') {
            callback();

            return;
        }

        if (url) {
            navigateToWhatsApp(url, openInNewTab);
        }
    };

    if (! window.googleAdsConversionSendTo || typeof gtag !== 'function') {
        navigate();

        return;
    }

    let navigated = false;

    const safeNavigate = () => {
        if (navigated) {
            return;
        }

        navigated = true;
        navigate();
    };

    gtag('event', 'conversion', {
        send_to: window.googleAdsConversionSendTo,
        event_callback: safeNavigate,
    });

    setTimeout(safeNavigate, 500);
}

function initWhatsAppConversionTracking() {
    document.addEventListener('click', (event) => {
        const link = event.target.closest('a');

        if (! link || ! isWhatsAppLink(link.getAttribute('href'))) {
            return;
        }

        event.preventDefault();

        const targetUrl = link.href;
        const openInNewTab = link.target === '_blank'
            || event.ctrlKey
            || event.metaKey
            || event.shiftKey;

        trackWhatsAppConversion(null, {
            url: targetUrl,
            openInNewTab,
        });
    });
}

window.trackWhatsAppConversion = trackWhatsAppConversion;

if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initWhatsAppConversionTracking);
} else {
    initWhatsAppConversionTracking();
}
