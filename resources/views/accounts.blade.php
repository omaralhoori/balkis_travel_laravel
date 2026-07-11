@php
    $currentLocale = app()->getLocale();
    $dir = $currentLocale === 'ar' ? 'rtl' : 'ltr';
    $homePage = \App\Models\HomePage::getCurrent();

    $brandName = $homePage->getTranslation('footer_brand_name', $currentLocale) ?: ($homePage->footer_brand_name ?: __('Balkis Premium Group'));
    $brandDescription = $homePage->getTranslation('footer_brand_description', $currentLocale) ?: ($homePage->footer_brand_description ?: __('We offer you a carefully selected collection of the best investment and tourism opportunities.'));

    $labels = [
        'ar' => [
            'manager' => 'مدير الشركة (حكمت بكر)',
            'manager_desc' => 'تواصل مباشرة مع مدير الشركة عبر واتساب',
            'sales_1' => 'الحجوزات والمبيعات',
            'sales_1_desc' => 'تواصل مع مسؤول المبيعات الأول عبر واتساب',
            'sales_2' => 'للاستشارات السياحية',
            'sales_2_desc' => 'تواصل مع مسؤول المبيعات الثاني عبر واتساب',
            'instagram' => 'انستقرام',
            'instagram_desc' => 'تابعنا على انستقرام لمشاهدة أحدث الرحلات والتغطيات',
            'facebook' => 'فيسبوك',
            'facebook_desc' => 'تابع صفحتنا الرسمية على فيسبوك',
            'tiktok' => 'تيك توك',
            'tiktok_desc' => 'شاهد مقاطع فيديو حصرية من رحلاتنا',
            'telegram' => 'قناة تليجرام',
            'telegram_desc' => 'انضم إلى قناتنا على تليجرام لآخر العروض والأخبار',
            'whatsapp_channel' => 'قناة واتساب',
            'whatsapp_channel_desc' => 'اشترك في قناتنا على واتساب لمتابعة التحديثات',
            'book_now' => 'خطط لرحلتك بسعر مميز الآن',
            'book_now_desc' => 'ابدأ حجز رحلتك مباشرة من موقعنا',
            'email' => 'البريد الإلكتروني',
            'back_to_site' => 'العودة للموقع الرئيسي',
            'verified' => 'حساب موثق',
            'copyright' => 'جميع الحقوق محفوظة.',
        ],
        'en' => [
            'manager' => 'Company Manager (Hikmat Bakr)',
            'manager_desc' => 'Contact the company manager directly via WhatsApp',
            'sales_1' => 'First Sales Manager',
            'sales_1_desc' => 'Contact our first sales manager via WhatsApp',
            'sales_2' => 'Second Sales Manager',
            'sales_2_desc' => 'Contact our second sales manager via WhatsApp',
            'instagram' => 'Instagram',
            'instagram_desc' => 'Follow us on Instagram for the latest trips and coverage',
            'facebook' => 'Facebook',
            'facebook_desc' => 'Follow our official Facebook page',
            'tiktok' => 'TikTok',
            'tiktok_desc' => 'Watch exclusive videos from our trips',
            'telegram' => 'Telegram Channel',
            'telegram_desc' => 'Join our Telegram channel for latest offers and news',
            'whatsapp_channel' => 'WhatsApp Channel',
            'whatsapp_channel_desc' => 'Subscribe to our WhatsApp channel for updates',
            'book_now' => 'Book Now',
            'book_now_desc' => 'Start booking your trip directly from our website',
            'email' => 'Email',
            'back_to_site' => 'Back to Main Website',
            'verified' => 'Verified Account',
            'copyright' => 'All rights reserved.',
        ],
        'tr' => [
            'manager' => 'Şirket Müdürü (Hikmat Bakr)',
            'manager_desc' => 'Şirket müdürüyle doğrudan WhatsApp üzerinden iletişime geçin',
            'sales_1' => 'Birinci Satış Sorumlusu',
            'sales_1_desc' => 'Birinci satış sorumlumuzla WhatsApp üzerinden iletişime geçin',
            'sales_2' => 'İkinci Satış Sorumlusu',
            'sales_2_desc' => 'İkinci satış sorumlumuzla WhatsApp üzerinden iletişime geçin',
            'instagram' => 'Instagram',
            'instagram_desc' => 'En son turlar ve paylaşımlar için bizi Instagram\'da takip edin',
            'facebook' => 'Facebook',
            'facebook_desc' => 'Resmi Facebook sayfamızı takip edin',
            'tiktok' => 'TikTok',
            'tiktok_desc' => 'Gezilerimizden özel videoları izleyin',
            'telegram' => 'Telegram Kanalı',
            'telegram_desc' => 'Son teklifler ve haberler için Telegram kanalımıza katılın',
            'whatsapp_channel' => 'WhatsApp Kanalı',
            'whatsapp_channel_desc' => 'Güncellemeler için WhatsApp kanalımıza abone olun',
            'book_now' => 'Şimdi Rezervasyon Yap',
            'book_now_desc' => 'Rezervasyonunuzu doğrudan web sitemizden başlatın',
            'email' => 'E-posta',
            'back_to_site' => 'Ana Web Sitesine Dön',
            'verified' => 'Onaylanmış Hesap',
            'copyright' => 'Tüm hakları saklıdır.',
        ],
        'fr' => [
            'manager' => 'Directeur de l\'entreprise (Hikmat Bakr)',
            'manager_desc' => 'Contactez le directeur de l\'entreprise directement via WhatsApp',
            'sales_1' => 'Premier responsable des ventes',
            'sales_1_desc' => 'Contactez notre premier responsable des ventes via WhatsApp',
            'sales_2' => 'Deuxième responsable des ventes',
            'sales_2_desc' => 'Contactez notre deuxième responsable des ventes via WhatsApp',
            'instagram' => 'Instagram',
            'instagram_desc' => 'Suivez-nous sur Instagram pour nos derniers voyages',
            'facebook' => 'Facebook',
            'facebook_desc' => 'Suivez notre page Facebook officielle',
            'tiktok' => 'TikTok',
            'tiktok_desc' => 'Regardez des vidéos exclusives de nos voyages',
            'telegram' => 'Chaîne Telegram',
            'telegram_desc' => 'Rejoignez notre chaîne Telegram pour les dernières offres',
            'whatsapp_channel' => 'Chaîne WhatsApp',
            'whatsapp_channel_desc' => 'Abonnez-vous à notre chaîne WhatsApp pour les mises à jour',
            'book_now' => 'Réserver Maintenant',
            'book_now_desc' => 'Commencez votre réservation directement sur notre site',
            'email' => 'E-mail',
            'back_to_site' => 'Retour au Site Principal',
            'verified' => 'Compte Vérifié',
            'copyright' => 'Tous droits réservés.',
        ],
    ];

    $langLabels = $labels[$currentLocale] ?? $labels['ar'];

    $websiteUrl = route('home', ['locale' => $currentLocale]);
    $bookingUrl = $websiteUrl.'#inquiry-form';
    $emailAddress = $homePage->footer_email && $homePage->footer_email !== '#' ? $homePage->footer_email : 'info@balkispg.com';

    $accountLinks = [
        ['id' => 'manager', 'url' => 'https://wa.me/905060050350', 'label' => $langLabels['manager'], 'desc' => $langLabels['manager_desc'], 'icon' => 'whatsapp', 'icon_bg' => 'bg-green-500/10', 'icon_text' => 'text-green-400', 'external' => true, 'visible' => true],
        ['id' => 'sales-2', 'url' => 'https://wa.me/905540057755', 'label' => $langLabels['sales_2'], 'desc' => $langLabels['sales_2_desc'], 'icon' => 'whatsapp', 'icon_bg' => 'bg-green-500/10', 'icon_text' => 'text-green-400', 'external' => true, 'visible' => true],
        ['id' => 'sales-1', 'url' => 'https://wa.me/905540058855', 'label' => $langLabels['sales_1'], 'desc' => $langLabels['sales_1_desc'], 'icon' => 'whatsapp', 'icon_bg' => 'bg-green-500/10', 'icon_text' => 'text-green-400', 'external' => true, 'visible' => true],
        ['id' => 'book-now', 'url' => $bookingUrl, 'label' => $langLabels['book_now'], 'desc' => $langLabels['book_now_desc'], 'icon' => 'calendar', 'icon_bg' => 'bg-primary/10', 'icon_text' => 'text-primary', 'external' => false, 'visible' => true],
        ['id' => 'instagram', 'url' => 'https://www.instagram.com/travel.balkispg?igsh=djkyZ3M1djdvbjNw', 'label' => $langLabels['instagram'], 'desc' => $langLabels['instagram_desc'], 'icon' => 'instagram', 'icon_bg' => 'bg-pink-500/10', 'icon_text' => 'text-pink-400', 'external' => true, 'visible' => true],
        ['id' => 'facebook', 'url' => 'https://www.facebook.com/balkispg.travel/', 'label' => $langLabels['facebook'], 'desc' => $langLabels['facebook_desc'], 'icon' => 'facebook', 'icon_bg' => 'bg-blue-600/10', 'icon_text' => 'text-blue-400', 'external' => true, 'visible' => true],
        ['id' => 'tiktok', 'url' => 'https://www.tiktok.com/@travel.balkispg?_r=1&_t=ZS-96jsNOwSZzr', 'label' => $langLabels['tiktok'], 'desc' => $langLabels['tiktok_desc'], 'icon' => 'tiktok', 'icon_bg' => 'bg-slate-500/10', 'icon_text' => 'text-gray-100', 'external' => true, 'visible' => true],
        ['id' => 'snapchat', 'url' => '#', 'label' => 'Snapchat', 'desc' => '', 'icon' => 'snapchat', 'icon_bg' => 'bg-yellow-500/10', 'icon_text' => 'text-yellow-300', 'external' => true, 'visible' => false],
        ['id' => 'telegram', 'url' => 'https://t.me/travel_balkispg', 'label' => $langLabels['telegram'], 'desc' => $langLabels['telegram_desc'], 'icon' => 'telegram', 'icon_bg' => 'bg-sky-500/10', 'icon_text' => 'text-sky-400', 'external' => true, 'visible' => true],
        ['id' => 'whatsapp-channel', 'url' => 'https://whatsapp.com/channel/0029Vb7rthiKrWQuFD0Sfg31', 'label' => $langLabels['whatsapp_channel'], 'desc' => $langLabels['whatsapp_channel_desc'], 'icon' => 'whatsapp', 'icon_bg' => 'bg-green-500/10', 'icon_text' => 'text-green-400', 'external' => true, 'visible' => true],
        ['id' => 'pinterest', 'url' => '#', 'label' => 'Pinterest', 'desc' => '', 'icon' => 'pinterest', 'icon_bg' => 'bg-red-500/10', 'icon_text' => 'text-red-400', 'external' => true, 'visible' => false],
        ['id' => 'linkedin', 'url' => '#', 'label' => 'LinkedIn', 'desc' => '', 'icon' => 'linkedin', 'icon_bg' => 'bg-blue-700/10', 'icon_text' => 'text-blue-300', 'external' => true, 'visible' => false],
       
        ['id' => 'email', 'url' => 'mailto:'.$emailAddress, 'label' => $langLabels['email'], 'desc' => $emailAddress, 'icon' => 'email', 'icon_bg' => 'bg-blue-500/10', 'icon_text' => 'text-blue-400', 'external' => false, 'visible' => true],
    ];

    $visibleLinks = array_filter($accountLinks, fn (array $link): bool => $link['visible']);
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
    <x-tiktok-pixel />
     <!-- Meta Pixel Code -->
<script>
!function(f,b,e,v,n,t,s)
{if(f.fbq)return;n=f.fbq=function(){n.callMethod?
n.callMethod.apply(n,arguments):n.queue.push(arguments)};
if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
n.queue=[];t=b.createElement(e);t.async=!0;
t.src=v;s=b.getElementsByTagName(e)[0];
s.parentNode.insertBefore(t,s)}(window, document,'script',
'https://connect.facebook.net/en_US/fbevents.js');
fbq('init', '1907666043233108');
fbq('track', 'PageView');
</script>
<noscript><img height="1" width="1" style="display:none"
src="https://www.facebook.com/tr?id=1907666043233108&ev=PageView&noscript=1"
/></noscript>
<!-- End Meta Pixel Code -->
    <x-google-ads-tag />
    <title>{{ $brandName }} - {{ __('حسابات التواصل الاجتماعي') }}</title>

    <meta name="description" content="{{ $brandDescription }}">
    <meta property="og:title" content="{{ $brandName }} - {{ __('روابط التواصل') }}">
    <meta property="og:description" content="{{ $brandDescription }}">
    <meta property="og:image" content="{{ asset('image/BALKIS TRAVEL TEXT HORIZONTAL.png') }}">
    <meta property="og:type" content="website">

    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet"/>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background-color: #0d1117;
            background-image: url('{{ asset('image/accounts_bacground.png') }}');
            background-size: cover;
            background-position: center top;
            background-repeat: no-repeat;
            background-attachment: fixed;
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

    <div class="w-full max-w-md flex items-center justify-between mb-8 z-10 px-2">
        <a href="{{ $websiteUrl }}" class="flex items-center gap-2 text-xs font-semibold text-gray-400 hover:text-primary transition-colors py-2 px-3 rounded-full bg-white/5 border border-white/10 hover:border-primary/30">
            <span class="material-symbols-outlined text-sm">{{ $dir === 'rtl' ? 'arrow_forward' : 'arrow_back' }}</span>
            <span>{{ $langLabels['back_to_site'] }}</span>
        </a>

        <div>
            <x-language-switcher />
        </div>
    </div>

    <main class="w-full max-w-md z-10 flex-grow flex flex-col items-center">
        <div class="flex flex-col items-center text-center mb-8 px-4">
            <div class="relative w-28 h-28 mb-5 rounded-full p-1 avatar-ring">
                <div class="w-full h-full bg-[#161b26] rounded-full overflow-hidden flex items-center justify-center p-3">
                    <img src="{{ asset('image/balkis_travel.ico') }}" alt="{{ $brandName }}" class="w-full h-full object-contain">
                </div>
                <div class="absolute bottom-1 end-1 bg-gradient-to-tr from-[#765C39] to-[#C4A571] text-white rounded-full p-1 shadow-md border-2 border-[#161b26] flex items-center justify-center" title="{{ $langLabels['verified'] }}">
                    <span class="material-symbols-outlined text-xs font-bold">check</span>
                </div>
            </div>

            <h1 class="text-2xl font-bold font-heading text-white tracking-wide mb-2 flex items-center gap-1.5 justify-center">
                {{ $brandName }}
            </h1>

            <p class="text-sm text-gray-400 font-text max-w-sm leading-relaxed">
                {{ $brandDescription }}
            </p>
        </div>

        <div class="w-full space-y-4 px-2 mb-12">
            @foreach($visibleLinks as $link)
            <a href="{{ $link['url'] }}"
               id="link-{{ $link['id'] }}"
               @if($link['external']) target="_blank" rel="noopener noreferrer" @endif
               class="glass-btn w-full rounded-2xl py-4 px-5 flex items-center justify-between group">
                <div class="flex items-center gap-4 min-w-0">
                    <div class="w-10 h-10 rounded-xl {{ $link['icon_bg'] }} flex items-center justify-center {{ $link['icon_text'] }} group-hover:bg-white/10 group-hover:text-white transition-all duration-300 shrink-0">
                        @switch($link['icon'])
                            @case('whatsapp')
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M.057 24l1.687-6.163c-1.041-1.804-1.588-3.849-1.587-5.946C.06 5.348 5.397.01 12.008.01c3.202.001 6.212 1.246 8.477 3.513 2.266 2.268 3.507 5.28 3.505 8.484-.004 6.657-5.34 11.997-11.953 11.997-2.005-.001-3.973-.5-5.729-1.446L0 24zm6.59-4.846c1.6.95 3.188 1.449 4.625 1.451 5.436 0 9.86-4.37 9.864-9.799.002-2.63-1.023-5.101-2.885-6.966C16.312 1.975 13.893 1.05 11.997 1.05c-5.444 0-9.87 4.374-9.874 9.802-.002 1.968.528 3.888 1.533 5.568L2.63 21.26l4.017-1.106zM17.487 14.39c-.3-.15-1.774-.875-2.029-.968-.256-.093-.442-.14-.628.14-.186.28-.72.968-.883 1.156-.163.187-.326.21-.628.06-2.583-1.293-4.22-2.483-5.251-4.267-.272-.471.2-.437.773-1.439.083-.166.04-.31-.02-.46-.06-.15-.56-1.35-.767-1.85-.203-.49-.41-.42-.56-.427-.145-.007-.31-.008-.476-.008-.166 0-.437.062-.665.31-.228.25-.87.85-.87 2.07 0 1.22.885 2.4 1.009 2.56.124.16 1.74 2.657 4.214 3.725.588.254 1.047.406 1.406.52.593.189 1.13.162 1.556.098.475-.07 1.474-.603 1.68-.186.204-.417.204-.774.102-.924-.102-.15-.406-.3-.707-.15z"/>
                                </svg>
                                @break
                            @case('instagram')
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                                </svg>
                                @break
                            @case('facebook')
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                                </svg>
                                @break
                            @case('tiktok')
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                                </svg>
                                @break
                            @case('telegram')
                                <svg class="w-5 h-5 fill-current" viewBox="0 0 24 24">
                                    <path d="M11.944 0A12 12 0 0 0 0 12a12 12 0 0 0 12 12 12 12 0 0 0 12-12A12 12 0 0 0 12 0a12 12 0 0 0-.056 0zm4.962 7.224c.1-.002.321.023.465.14a.506.506 0 0 1 .171.325c.016.093.036.306.02.472-.18 1.898-.962 6.502-1.36 8.627-.168.9-.499 1.201-.82 1.23-.696.065-1.225-.46-1.9-.902-1.056-.693-1.653-1.124-2.678-1.8-1.185-.78-.417-1.21.258-1.91.177-.184 3.247-2.977 3.307-3.23.007-.032.014-.15-.056-.212s-.174-.041-.249-.024c-.106.024-1.793 1.14-5.061 3.345-.48.33-.913.49-1.302.48-.428-.008-1.252-.241-1.865-.44-.752-.245-1.349-.374-1.297-.789.027-.216.325-.437.893-.663 3.498-1.524 5.83-2.529 6.998-3.014 3.332-1.386 4.025-1.627 4.476-1.635z"/>
                                </svg>
                                @break
                            @case('calendar')
                                <span class="material-symbols-outlined text-xl">calendar_month</span>
                                @break
                            @case('email')
                                <svg class="w-5 h-5 fill-none stroke-current" stroke-width="2" viewBox="0 0 24 24">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/>
                                    <path d="m22 6-10 7L2 6"/>
                                </svg>
                                @break
                        @endswitch
                    </div>
                    <div class="text-start min-w-0">
                        <div class="text-sm font-bold text-white group-hover:text-white transition-colors">{{ $link['label'] }}</div>
                        @if($link['desc'])
                            <div class="text-xs text-gray-400 group-hover:text-gray-100 transition-colors mt-0.5 line-clamp-2">{{ $link['desc'] }}</div>
                        @endif
                    </div>
                </div>
                <span class="material-symbols-outlined text-gray-500 group-hover:text-white group-hover:translate-x-1 rtl:group-hover:-translate-x-1 transition-transform text-lg shrink-0">chevron_right</span>
            </a>
            @endforeach
        </div>
    </main>

    <footer class="w-full text-center z-10 py-4">
        <p class="text-xs text-gray-500 font-text">
            &copy; {{ date('Y') }} {{ $brandName }}. {{ $langLabels['copyright'] }}
        </p>
    </footer>
</body>
</html>
