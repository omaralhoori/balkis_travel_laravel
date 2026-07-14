/**
 * Welcome popup: shows after delay or scroll threshold, once per session.
 */
export function initWelcomePopup(root) {
    if (!root || root.dataset.initialized === 'true') {
        return;
    }

    root.dataset.initialized = 'true';

    const storageKey = 'balkis_welcome_popup_dismissed';
    if (sessionStorage.getItem(storageKey) === '1') {
        return;
    }

    const overlay = root.querySelector('[data-welcome-overlay]');
    const panel = root.querySelector('[data-welcome-panel]');
    const closeButtons = root.querySelectorAll('[data-welcome-dismiss]');

    if (!overlay || !panel) {
        return;
    }

    let shown = false;

    const dismiss = () => {
        sessionStorage.setItem(storageKey, '1');
        overlay.classList.add('opacity-0', 'pointer-events-none');
        panel.classList.add('scale-95', 'opacity-0');
        window.setTimeout(() => {
            root.remove();
        }, 300);
    };

    const show = () => {
        if (shown) {
            return;
        }

        shown = true;
        root.classList.remove('hidden');
        requestAnimationFrame(() => {
            overlay.classList.remove('opacity-0');
            panel.classList.remove('scale-95', 'opacity-0');
        });
    };

    closeButtons.forEach((button) => {
        button.addEventListener('click', dismiss);
    });

    overlay.addEventListener('click', (event) => {
        if (event.target === overlay) {
            dismiss();
        }
    });

    const delayMs = 3000 + Math.floor(Math.random() * 2001);
    const timerId = window.setTimeout(show, delayMs);

    const onScroll = () => {
        const scrollable = document.documentElement.scrollHeight - window.innerHeight;
        if (scrollable <= 0) {
            return;
        }

        const scrolledRatio = window.scrollY / scrollable;
        if (scrolledRatio >= 0.2) {
            window.clearTimeout(timerId);
            window.removeEventListener('scroll', onScroll, { passive: true });
            show();
        }
    };

    window.addEventListener('scroll', onScroll, { passive: true });

    document.addEventListener('keydown', (event) => {
        if (event.key === 'Escape' && !root.classList.contains('hidden')) {
            dismiss();
        }
    });
}

document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('[data-welcome-popup]').forEach((root) => initWelcomePopup(root));
});
