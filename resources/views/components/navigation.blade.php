<header class="fixed top-0 w-full z-50 border-b border-primary/10 bg-bg-main/90 backdrop-blur-md" id="main-header">
    <div class="max-w-7xl mx-auto flex items-center justify-between px-6 py-4">
        <div class="flex items-center gap-3">
            <img src="{{ asset('image/BALKIS TRAVEL TEXT HORIZONTAL.png') }}" alt="Balkis Premium Group" class="h-10">
            <!-- <h2 class="text-gray-900 text-xl font-extrabold tracking-widest font-heading">BALKIS <span class="text-primary font-light">PREMIUM</span></h2> -->
        </div>
        <nav class="hidden md:flex gap-8">
            <a class="text-gray-600 hover:text-primary transition-colors text-sm font-medium {{ request()->routeIs('home') ? 'text-primary border-b border-primary' : '' }}" href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('Home') }}</a>
            <a class="text-gray-600 hover:text-primary transition-colors text-sm font-medium {{ request()->routeIs('programs.*') ? 'text-primary border-b border-primary' : '' }}" href="{{ route('programs.index', ['locale' => app()->getLocale()]) }}">{{ __('Programs') }}</a>
            <a class="text-gray-600 hover:text-primary transition-colors text-sm font-medium {{ request()->routeIs('blog.*') ? 'text-primary border-b border-primary' : '' }}" href="{{ route('blog.index', ['locale' => app()->getLocale()]) }}">{{ __('Blog') }}</a>
            <a class="text-gray-600 hover:text-primary transition-colors text-sm font-medium {{ request()->routeIs('about') ? 'text-primary border-b border-primary' : '' }}" href="{{ route('about', ['locale' => app()->getLocale()]) }}">{{ __('About') }}</a>
        </nav>
        <div class="flex items-center gap-2 md:gap-4">
            <div class="hidden md:block">
                <x-language-switcher />
            </div>
            <a href="{{ route('whatsapp.redirect', ['locale' => app()->getLocale()]) }}" target="_blank" rel="noopener noreferrer" class="bg-gold-gradient hover:brightness-110 rounded-sm text-white px-3 md:px-5 py-2 text-xs font-bold uppercase tracking-wider hover:text-white transition-colors whitespace-nowrap">{{ __('Contact Us') }}</a>
            <button type="button" id="mobile-menu-btn" class="md:hidden text-gray-900 p-2 hover:text-primary transition-colors" aria-label="Toggle menu">
                <span class="material-symbols-outlined text-2xl" id="menu-icon">menu</span>
            </button>
        </div>
    </div>
    
    <!-- Mobile Menu -->
    <div id="mobile-menu" class="hidden md:hidden fixed top-0 left-0 w-full h-screen bg-bg-main z-50 overflow-y-auto" style="display: none;">
        <div class="flex flex-col h-full">
            <!-- Mobile Menu Header -->
            <div class="flex items-center justify-between px-6 py-4 border-b border-primary/10">
                <img src="{{ asset('image/BALKIS GROUP TEXT HORIZONTAL.png') }}" alt="Balkis Premium Group" class="h-10">
                <button type="button" id="mobile-menu-close" class="text-gray-900 p-2 hover:text-primary transition-colors" aria-label="Close menu">
                    <span class="material-symbols-outlined text-2xl">close</span>
                </button>
            </div>
            
            <!-- Mobile Menu Content -->
            <nav class="flex flex-col px-6 py-8 gap-6 grow">
                <a class="text-gray-600 hover:text-primary transition-colors text-lg font-medium py-2 {{ request()->routeIs('home') ? 'text-primary border-s-4 border-primary ps-4' : '' }}" href="{{ route('home', ['locale' => app()->getLocale()]) }}">{{ __('Home') }}</a>
                <a class="text-gray-600 hover:text-primary transition-colors text-lg font-medium py-2 {{ request()->routeIs('programs.*') ? 'text-primary border-s-4 border-primary ps-4' : '' }}" href="{{ route('programs.index', ['locale' => app()->getLocale()]) }}">{{ __('Programs') }}</a>
                <a class="text-gray-600 hover:text-primary transition-colors text-lg font-medium py-2 {{ request()->routeIs('blog.*') ? 'text-primary border-s-4 border-primary ps-4' : '' }}" href="{{ route('blog.index', ['locale' => app()->getLocale()]) }}">{{ __('Blog') }}</a>
                <a class="text-gray-600 hover:text-primary transition-colors text-lg font-medium py-2 {{ request()->routeIs('about') ? 'text-primary border-s-4 border-primary ps-4' : '' }}" href="{{ route('about', ['locale' => app()->getLocale()]) }}">{{ __('About') }}</a>
                
                <div class="pt-6 border-t border-primary/10 mt-4">
                    <div class="mb-6">
                        <x-language-switcher />
                    </div>
                </div>
            </nav>
        </div>
    </div>
</header>

<script>
(function() {
    const menuBtn = document.getElementById('mobile-menu-btn');
    const menuCloseBtn = document.getElementById('mobile-menu-close');
    const mobileMenu = document.getElementById('mobile-menu');
    const menuIcon = document.getElementById('menu-icon');
    
    if (!menuBtn || !mobileMenu) return;
    
    function openMenu() {
        mobileMenu.style.display = 'block';
        document.body.style.overflow = 'hidden';
        menuIcon.textContent = 'close';
    }
    
    function closeMenu() {
        mobileMenu.style.display = 'none';
        document.body.style.overflow = '';
        menuIcon.textContent = 'menu';
    }
    
    menuBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        if (mobileMenu.style.display === 'none' || !mobileMenu.style.display) {
            openMenu();
        } else {
            closeMenu();
        }
    });
    
    if (menuCloseBtn) {
        menuCloseBtn.addEventListener('click', function(e) {
            e.stopPropagation();
            closeMenu();
        });
    }
    
    // Close menu when clicking on a link
    const menuLinks = mobileMenu.querySelectorAll('a');
    menuLinks.forEach(link => {
        link.addEventListener('click', function() {
            closeMenu();
        });
    });
    
    // Close menu when clicking outside
    document.addEventListener('click', function(e) {
        const header = document.getElementById('main-header');
        if (header && !header.contains(e.target) && mobileMenu.style.display === 'block') {
            closeMenu();
        }
    });
    
    // Close menu on escape key
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && mobileMenu.style.display === 'block') {
            closeMenu();
        }
    });
})();
</script>
