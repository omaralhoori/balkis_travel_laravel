@php
    $currentLocale = app()->getLocale();
    $dir = $currentLocale === 'ar' ? 'rtl' : 'ltr';
    $homePage = \App\Models\HomePage::getCurrent();

    // Get localized brand name and description
    $brandName = $homePage->getTranslation('footer_brand_name', $currentLocale) ?: ($homePage->footer_brand_name ?: __('Balkis Premium Group'));
    $brandDescription = $homePage->getTranslation('footer_brand_description', $currentLocale) ?: ($homePage->footer_brand_description ?: __('We offer you a carefully selected collection of the best investment and tourism opportunities.'));

    // Localized button labels and UI texts
    $labels = [
        'ar' => [
            'website' => 'الموقع الرسمي',
            'website_desc' => 'تصفح برامجنا الاستثمارية والسياحية المميزة',
            'whatsapp' => 'تواصل معنا عبر واتساب',
            'whatsapp_desc' => 'تحدث مباشرة مع مستشارنا السياحي والاستثماري',
            'instagram' => 'تابعنا على انستغرام',
            'instagram_desc' => 'شاهد أحدث التغطيات والرحلات اليومية الفاخرة',
            'tiktok' => 'تابعنا على تيك توك',
            'tiktok_desc' => 'مقاطع فيديو حصرية من قلب الطبيعة في تركيا',
            'snapchat' => 'تابعنا على سناب شات',
            'snapchat_desc' => 'يومياتنا ولقطات مباشرة لرحلاتنا وبرامجنا',
            'email' => 'البريد الإلكتروني',
            'email_desc' => 'راسلنا مباشرة لأي استفسارات أو شراكات عمل',
            'back_to_site' => 'العودة للموقع الرئيسي',
            'verified' => 'حساب موثق',
            'copyright' => 'جميع الحقوق محفوظة.',
        ],
        'en' => [
            'website' => 'Official Website',
            'website_desc' => 'Browse our premium investment and tourism programs',
            'whatsapp' => 'Contact via WhatsApp',
            'whatsapp_desc' => 'Chat directly with our tourism & investment advisor',
            'instagram' => 'Follow us on Instagram',
            'instagram_desc' => 'See our latest premium tours and daily coverages',
            'tiktok' => 'Follow us on TikTok',
            'tiktok_desc' => 'Exclusive video snippets from Turkey\'s stunning nature',
            'snapchat' => 'Add us on Snapchat',
            'snapchat_desc' => 'Live stories and behind-the-scenes of our trips',
            'email' => 'Send us an Email',
            'email_desc' => 'Email us directly for inquiries or business proposals',
            'back_to_site' => 'Back to Main Website',
            'verified' => 'Verified Account',
            'copyright' => 'All rights reserved.',
        ],
        'tr' => [
            'website' => 'Resmi Web Sitesi',
            'website_desc' => 'Seçkin yatırım ve turizm programlarımıza göz atın',
            'whatsapp' => 'WhatsApp ile İletişim',
            'whatsapp_desc' => 'Turizm ve yatırım danışmanımızla doğrudan sohbet edin',
            'instagram' => 'Instagram\'da Takip Edin',
            'instagram_desc' => 'En son premium turlarımızı ve günlük paylaşımlarımızı görün',
            'tiktok' => 'TikTok\'ta İzleyin',
            'tiktok_desc' => 'Türkiye\'nin muhteşem doğasından özel video kesitleri',
            'snapchat' => 'Snapchat\'te Ekleyin',
            'snapchat_desc' => 'Gezilerimizin canlı hikayeleri ve kamera arkası',
            'email' => 'E-posta Gönderin',
            'email_desc' => 'Sorularınız veya iş teklifleriniz için doğrudan e-posta gönderin',
            'back_to_site' => 'Ana Web Sitesine Dön',
            'verified' => 'Onaylanmış Hesap',
            'copyright' => 'Tüm hakları saklıdır.',
        ],
        'fr' => [
            'website' => 'Site Officiel',
            'website_desc' => 'Découvrez nos programmes de voyage et d\'investissement',
            'whatsapp' => 'Contactez-nous sur WhatsApp',
            'whatsapp_desc' => 'Discutez en direct avec notre conseiller de voyage',
            'instagram' => 'Suivez-nous sur Instagram',
            'instagram_desc' => 'Voir nos derniers circuits premium et reportages quotidiens',
            'tiktok' => 'Regardez-nous sur TikTok',
            'tiktok_desc' => 'Vidéos exclusives de la nature magnifique de la Turquie',
            'snapchat' => 'Ajoutez-nous sur Snapchat',
            'snapchat_desc' => 'Histoires en direct et coulisses de nos voyages',
            'email' => 'Envoyez-nous un Email',
            'email_desc' => 'Écrivez-nous directement pour toute demande ou partenariat',
            'back_to_site' => 'Retour au Site Principal',
            'verified' => 'Compte Vérifié',
            'copyright' => 'Tous droits réservés.',
        ],
    ];

    $langLabels = $labels[$currentLocale] ?? $labels['ar'];

    // Social Links configuration with database fallback
    $websiteUrl = route('home', ['locale' => $currentLocale]);
    $whatsappUrl = route('whatsapp.redirect', ['locale' => $currentLocale]);
    $instagramUrl = $homePage->footer_instagram_url && $homePage->footer_instagram_url !== '#' ? $homePage->footer_instagram_url : 'https://instagram.com/balkis_travel';
    $tiktokUrl = $homePage->footer_tiktok_url && $homePage->footer_tiktok_url !== '#' ? $homePage->footer_tiktok_url : 'https://tiktok.com/@balkis_travel';
    $snapchatUrl = $homePage->footer_snapchat_url && $homePage->footer_snapchat_url !== '#' ? $homePage->footer_snapchat_url : 'https://snapchat.com/add/balkis_travel';
    $emailAddress = $homePage->footer_email && $homePage->footer_email !== '#' ? $homePage->footer_email : 'info@balkispg.com';
    $emailUrl = 'mailto:' . $emailAddress;
@endphp

<!DOCTYPE html>
<html dir="{{ $dir }}" lang="{{ $currentLocale }}">
<head>
    <meta charset="utf-8"/>
    <meta content="width=device-width, initial-scale=1.0" name="viewport"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ asset('image/balkis_travel.ico') }}" sizes="any">
    <link rel="icon" href="{{ asset('image/balkis_travel.ico') }}" type="image/x-icon">
    <link rel="shortcut icon" href="{{ asset('image/balkis_travel.ico') }}" type="image/x-icon">
    <link rel="apple-touch-icon" href="{{ asset('image/balkis_travel.ico') }}">
    
    <title>{{ $brandName }} - {{ __('حسابات التواصل الاجتماعي') }}</title>
    
    <meta name="description" content="{{ $brandDescription }}">
    <meta property="og:title" content="{{ $brandName }} - {{ __('روابط التواصل') }}">
    <meta property="og:description" content="{{ $brandDescription }}">
    <meta property="og:image" content="{{ asset('image/BALKIS TRAVEL TEXT HORIZONTAL.png') }}">
    <meta property="og:type" content="website">
    
    <!-- Fonts & Icons -->
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>
    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <style>
        body {
            background: radial-gradient(circle at center, #1a202c 0%, #0d1117 100%);
            min-height: 100vh;
            color: #f3f4f6;
            overflow-x: hidden;
        }
        .luxury-glow {
            box-shadow: 0 0 50px -10px rgba(198, 162, 100, 0.15);
        }
        .glass-btn {
            background: linear-gradient(135deg, rgba(255, 255, 255, 0.03) 0%, rgba(255, 255, 255, 0.07) 100%);
            border: 1px solid rgba(198, 162, 100, 0.15);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .glass-btn:hover {
            background: linear-gradient(135deg, #765C39 0%, #C4A571 100%);
            border-color: #C6A264;
            box-shadow: 0 10px 20px -5px rgba(198, 162, 100, 0.3);
            transform: translateY(-3px);
        }
        .avatar-ring {
            background: linear-gradient(135deg, #765C39 0%, #C4A571 100%);
            animation: pulse-ring 3s infinite;
        }
        @keyframes pulse-ring {
            0%, 100% {
                box-shadow: 0 0 0 3px rgba(198, 162, 100, 0.3);
            }
            50% {
                box-shadow: 0 0 0 8px rgba(198, 162, 100, 0.6);
            }
        }
    </style>
</head>
<body class="flex flex-col items-center justify-between py-12 px-4 relative select-none">
    <!-- Ambient backgrounds -->
    <div class="absolute inset-0 opacity-[0.03] bg-repeat pointer-events-none" style="background-image: url('{{ asset('image/pattern1.png') }}'); background-size: 300px;"></div>
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 w-[600px] h-[600px] bg-primary/10 rounded-full blur-[140px] pointer-events-none"></div>

    <!-- Header bar -->
    <div class="w-full max-w-md flex items-center justify-between mb-8 z-10 px-2">
        <!-- Back Button -->
        <a href="{{ $websiteUrl }}" class="flex items-center gap-2 text-xs font-semibold text-gray-400 hover:text-primary transition-colors py-2 px-3 rounded-full bg-white/5 border border-white/10 hover:border-primary/30">
            <span class="material-symbols-outlined text-sm">{{ $dir === 'rtl' ? 'arrow_forward' : 'arrow_back' }}</span>
            <span>{{ $langLabels['back_to_site'] }}</span>
        </a>
        
        <!-- Localized Switcher -->
        <div>
            <x-language-switcher />
        </div>
    </div>

    <!-- Main Card -->
    <main class="w-full max-w-md z-10 flex-grow flex flex-col items-center">
        <!-- Profile info -->
        <div class="flex flex-col items-center text-center mb-8 px-4">
            <!-- Avatar with ring animation -->
            <div class="relative w-28 h-28 mb-5 rounded-full p-1 avatar-ring">
                <div class="w-full h-full bg-[#161b26] rounded-full overflow-hidden flex items-center justify-center p-3">
                    <img src="{{ asset('image/balkis_travel.ico') }}" alt="{{ $brandName }}" class="w-full h-full object-contain">
                </div>
                <!-- Verified checkmark -->
                <div class="absolute bottom-1 end-1 bg-gradient-to-tr from-[#765C39] to-[#C4A571] text-white rounded-full p-1 shadow-md border-2 border-[#161b26] flex items-center justify-center" title="{{ $langLabels['verified'] }}">
                    <span class="material-symbols-outlined text-xs font-bold">check</span>
                </div>
            </div>

            <!-- Brand title -->
            <h1 class="text-2xl font-bold font-heading text-white tracking-wide mb-2 flex items-center gap-1.5 justify-center">
                {{ $brandName }}
            </h1>

            <!-- Brand bio/description -->
            <p class="text-sm text-gray-400 font-text max-w-sm leading-relaxed">
                {{ $brandDescription }}
            </p>
        </div>

        <!-- Links Container -->
        <div class="w-full space-y-4 px-2 mb-12">
            <!-- Website Link -->
            <a href="{{ $websiteUrl }}" id="link-website" class="glass-btn w-full rounded-2xl py-4 px-5 flex items-center justify-between group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-white/5 flex items-center justify-center text-primary group-hover:bg-white/10 group-hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5 fill-none stroke-current" stroke-width="2" viewBox="0 0 24 24">
                            <circle cx="12" cy="12" r="10"/>
                            <path d="M12 2a14.5 14.5 0 0 0 0 20 14.5 14.5 0 0 0 0-20M2 12h20"/>
                        </svg>
                    </div>
                    <div class="text-start">
                        <div class="text-sm font-bold text-white group-hover:text-white transition-colors">{{ $langLabels['website'] }}</div>
                        <div class="text-xs text-gray-400 group-hover:text-gray-100 transition-colors mt-0.5">{{ $langLabels['website_desc'] }}</div>
                    </div>
                </div>
                <span class="material-symbols-outlined text-gray-500 group-hover:text-white group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform text-lg">chevron_right</span>
            </a>

            <!-- WhatsApp Link -->
            <a href="{{ $whatsappUrl }}" id="link-whatsapp" target="_blank" rel="noopener noreferrer" class="glass-btn w-full rounded-2xl py-4 px-5 flex items-center justify-between group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-green-500/10 flex items-center justify-center text-green-400 group-hover:bg-white/10 group-hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.5-5.729-1.446L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.625 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.966C16.312 1.975 13.893 1.05 11.997 1.05c-5.444 0-9.87 4.374-9.874 9.802-.002 1.968.528 3.888 1.533 5.568L2.63 21.26l4.017-1.106zM17.487 14.39c-.3-.15-1.774-.875-2.029-.968-.256-.093-.442-.14-.628.14-.186.28-.72.968-.883 1.156-.163.187-.326.21-.628.06-2.583-1.293-4.22-2.483-5.251-4.267-.272-.471.2-.437.773-1.439.083-.166.04-.31-.02-.46-.06-.15-.56-1.35-.767-1.85-.203-.49-.41-.42-.56-.427-.145-.007-.31-.008-.476-.008-.166 0-.437.062-.665.31-.228.25-.87.85-.87 2.07 0 1.22.885 2.4 1.009 2.56.124.16 1.74 2.657 4.214 3.725.588.254 1.047.406 1.406.52.593.189 1.13.162 1.556.098.475-.07 1.474-.603 1.68-.186.204-.417.204-.774.102-.924-.102-.15-.406-.3-.707-.15z"/>
                        </svg>
                    </div>
                    <div class="text-start">
                        <div class="text-sm font-bold text-white group-hover:text-white transition-colors">{{ $langLabels['whatsapp'] }}</div>
                        <div class="text-xs text-gray-400 group-hover:text-gray-100 transition-colors mt-0.5">{{ $langLabels['whatsapp_desc'] }}</div>
                    </div>
                </div>
                <span class="material-symbols-outlined text-gray-500 group-hover:text-white group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform text-lg">chevron_right</span>
            </a>

            <!-- Instagram Link -->
            <a href="{{ $instagramUrl }}" id="link-instagram" target="_blank" rel="noopener noreferrer" class="glass-btn w-full rounded-2xl py-4 px-5 flex items-center justify-between group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-pink-500/10 flex items-center justify-center text-pink-400 group-hover:bg-white/10 group-hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                        </svg>
                    </div>
                    <div class="text-start">
                        <div class="text-sm font-bold text-white group-hover:text-white transition-colors">{{ $langLabels['instagram'] }}</div>
                        <div class="text-xs text-gray-400 group-hover:text-gray-100 transition-colors mt-0.5">{{ $langLabels['instagram_desc'] }}</div>
                    </div>
                </div>
                <span class="material-symbols-outlined text-gray-500 group-hover:text-white group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform text-lg">chevron_right</span>
            </a>

            <!-- TikTok Link -->
            <a href="{{ $tiktokUrl }}" id="link-tiktok" target="_blank" rel="noopener noreferrer" class="glass-btn w-full rounded-2xl py-4 px-5 flex items-center justify-between group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-slate-500/10 flex items-center justify-center text-gray-100 group-hover:bg-white/10 group-hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                        </svg>
                    </div>
                    <div class="text-start">
                        <div class="text-sm font-bold text-white group-hover:text-white transition-colors">{{ $langLabels['tiktok'] }}</div>
                        <div class="text-xs text-gray-400 group-hover:text-gray-100 transition-colors mt-0.5">{{ $langLabels['tiktok_desc'] }}</div>
                    </div>
                </div>
                <span class="material-symbols-outlined text-gray-500 group-hover:text-white group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform text-lg">chevron_right</span>
            </a>

            <!-- Snapchat Link -->
            <a href="{{ $snapchatUrl }}" id="link-snapchat" target="_blank" rel="noopener noreferrer" class="glass-btn w-full rounded-2xl py-4 px-5 flex items-center justify-between group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-yellow-500/10 flex items-center justify-center text-yellow-300 group-hover:bg-white/10 group-hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                            <path d="M12 .75c-3.13 0-5.74 2.05-6.52 4.9C3.65 6.13 2.5 7.6 2.5 9.35c0 1.25.6 2.38 1.55 3.05-.2.43-.3 1-.3 1.6 0 2.3 1.65 4.18 4.18 4.43.47.05.95.07 1.43.07.48 0 .96-.02 1.43-.07 2.53-.25 4.18-2.13 4.18-4.43 0-.6-.1-1.17-.3-1.6.95-.67 1.55-1.8 1.55-3.05 0-1.75-1.15-3.22-2.98-3.7C17.74 2.8 15.13.75 12 .75zm6.65 13.9c-.38.11-.77.16-1.15.15h-.07c-.42-.01-.84.14-1.16.42-.64.55-1.34.82-2.27.82s-1.63-.27-2.27-.82c-.32-.28-.74-.43-1.16-.42h-.07c-.38.01-.77-.04-1.15-.15-.76-.23-1.21-.86-1.33-1.49l-.08-.38c-.08-.41-.2-.8-.47-1.12-.4-.48-.96-.82-1.68-.82-.57 0-1 .2-1.28.59-.26.37-.29.81-.22 1.25l.08.38c.11.53-.11 1.07-.55 1.34-.63.39-1.41.6-2.35.6-.94 0-1.72-.21-2.35-.6a1.36 1.36 0 0 1-.55-1.34l.08-.38c.07-.44.04-.88-.22-1.25-.28-.39-.71-.59-1.28-.59-.72 0-1.28.34-1.68.82-.27.32-.39.71-.47 1.12l-.08.38C2.56 16 2.11 16.63 1.35 16.86c-.38.11-.77.16-1.15.15h-.07c-.12 0-.2.08-.2.2v.32c0 .54.42 1.05 1.23 1.54C2.39 19.8 4.12 20.2 6.3 20.2c1.47 0 2.85-.18 4.1-.55.38-.11.77-.17 1.17-.17.39 0 .78.06 1.17.17 1.25.37 2.63.55 4.1.55 2.18 0 3.91-.4 5.14-1.13.81-.49 1.23-1 1.23-1.54v-.32c0-.12-.08-.2-.2-.2h-.07c-.38.01-.77-.04-1.15-.15z"/>
                        </svg>
                    </div>
                    <div class="text-start">
                        <div class="text-sm font-bold text-white group-hover:text-white transition-colors">{{ $langLabels['snapchat'] }}</div>
                        <div class="text-xs text-gray-400 group-hover:text-gray-100 transition-colors mt-0.5">{{ $langLabels['snapchat_desc'] }}</div>
                    </div>
                </div>
                <span class="material-symbols-outlined text-gray-500 group-hover:text-white group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform text-lg">chevron_right</span>
            </a>

            <!-- Email Link -->
            <a href="{{ $emailUrl }}" id="link-email" class="glass-btn w-full rounded-2xl py-4 px-5 flex items-center justify-between group">
                <div class="flex items-center gap-4">
                    <div class="w-10 h-10 rounded-xl bg-blue-500/10 flex items-center justify-center text-blue-400 group-hover:bg-white/10 group-hover:text-white transition-all duration-300">
                        <svg class="w-5 h-5 fill-none stroke-current" stroke-width="2" viewBox="0 0 24 24">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                            <path d="m22 6-10 7L2 6"/>
                        </svg>
                    </div>
                    <div class="text-start">
                        <div class="text-sm font-bold text-white group-hover:text-white transition-colors">{{ $langLabels['email'] }}</div>
                        <div class="text-xs text-gray-400 group-hover:text-gray-100 transition-colors mt-0.5">{{ $emailAddress }}</div>
                    </div>
                </div>
                <span class="material-symbols-outlined text-gray-500 group-hover:text-white group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform text-lg">chevron_right</span>
            </a>
        </div>
    </main>

    <!-- Footer Copyright -->
    <footer class="w-full text-center z-10 py-4">
        <p class="text-xs text-gray-500 font-text">
            &copy; {{ date('Y') }} {{ $brandName }}. {{ $langLabels['copyright'] }}
        </p>
    </footer>
</body>
</html>

