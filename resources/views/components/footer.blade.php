@php
    $homePage = $homePage ?? \App\Models\HomePage::getCurrent();
    $brandName = $homePage->footer_brand_name ?? 'بلقيس القابضة';
    $brandDescription = $homePage->footer_brand_description ?? 'شركة رائدة في مجال الاستثمار العقاري وإدارة الثروات في تركيا، نقدم حلولاً متكاملة للمستثمرين الباحثين عن الفخامة والعائد المجزي.';
    $linkedinUrl = $homePage->footer_linkedin_url ?? '#';
    $twitterUrl = $homePage->footer_twitter_url ?? '#';
    $instagramUrl = $homePage->footer_instagram_url ?? '#';
    $facebookUrl = $homePage->footer_facebook_url ?? '#';
    $youtubeUrl = $homePage->footer_youtube_url ?? '#';
    $snapchatUrl = $homePage->footer_snapchat_url ?? '#';
    $tiktokUrl = $homePage->footer_tiktok_url ?? '#';
    $aboutUrl = $homePage->footer_about_url ?? '#';
    $projectsUrl = $homePage->footer_projects_url ?? '#';
    $servicesUrl = $homePage->footer_services_url ?? '#';
    $blogUrl = $homePage->footer_blog_url ?? '#';
    $tourismUrl = $homePage->footer_tourism_url ?? '#';
    $realestateUrl = $homePage->footer_realestate_url ?? '#';
    $investmentUrl = $homePage->footer_investment_url ?? '#';
    $phone = $homePage->footer_phone ?? '+90 212 555 0123';
    $email = $homePage->footer_email ?? 'info@balkispg.com';
    $workingHours = $homePage->footer_working_hours ?? 'الاثنين - الجمعة: 9:00 - 18:00';
    $copyrightText = $homePage->footer_copyright_text ?? 'بلقيس القابضة. جميع الحقوق محفوظة.';
    $privacyUrl = $homePage->footer_privacy_policy_url ?? '#';
    $termsUrl = $homePage->footer_terms_url ?? '#';
@endphp

<footer class="bg-primary border-t border-primary/20 pt-16 pb-8 px-4 md:px-10 lg:px-20 text-slate-200 relative">
    <div class="bg-pattern relative z-10" style="background-image: url('/image/pattern1.png');"></div>
    <div class="max-w-7xl mx-auto relative z-20">
        <div class="flex flex-col md:flex-row justify-between items-start gap-12 mb-16">
            <!-- Brand Column -->
            <div class="flex flex-col gap-6 max-w-sm">
                <div class="flex items-center gap-3">
                    <span class="text-2xl font-bold font-heading tracking-tight">{{ $brandName }}</span>
                </div>
                @if($brandDescription)
                    <p class="text-sm leading-relaxed">
                        {{ $brandDescription }}
                    </p>
                @endif
                <div class="flex gap-4 flex-wrap">
                    @if($linkedinUrl && $linkedinUrl !== '#')
                        <a class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary hover:text-white flex items-center justify-center transition-all duration-300 text-white" href="{{ $linkedinUrl }}" target="_blank" rel="noopener noreferrer" title="LinkedIn">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z"/>
                            </svg>
                        </a>
                    @endif
                    @if($twitterUrl && $twitterUrl !== '#')
                        <a class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary hover:text-white flex items-center justify-center transition-all duration-300 text-white" href="{{ $twitterUrl }}" target="_blank" rel="noopener noreferrer" title="Twitter">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M18.244 2.25h3.308l-7.227 8.26 8.502 11.24H16.17l-5.214-6.817L4.99 21.75H1.68l7.73-8.835L1.254 2.25H8.08l4.713 6.231zm-1.161 17.52h1.833L7.084 4.126H5.117z"/>
                            </svg>
                        </a>
                    @endif
                    @if($instagramUrl && $instagramUrl !== '#')
                        <a class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary hover:text-white flex items-center justify-center transition-all duration-300 text-white" href="{{ $instagramUrl }}" target="_blank" rel="noopener noreferrer" title="Instagram">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
                            </svg>
                        </a>
                    @endif
                    @if($facebookUrl && $facebookUrl !== '#')
                        <a class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary hover:text-white flex items-center justify-center transition-all duration-300 text-white" href="{{ $facebookUrl }}" target="_blank" rel="noopener noreferrer" title="Facebook">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
                            </svg>
                        </a>
                    @endif
                    @if($youtubeUrl && $youtubeUrl !== '#')
                        <a class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary hover:text-white flex items-center justify-center transition-all duration-300 text-white" href="{{ $youtubeUrl }}" target="_blank" rel="noopener noreferrer" title="YouTube">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M23.498 6.186a3.016 3.016 0 0 0-2.122-2.136C19.505 3.545 12 3.545 12 3.545s-7.505 0-9.377.505A3.017 3.017 0 0 0 .502 6.186C0 8.07 0 12 0 12s0 3.93.502 5.814a3.016 3.016 0 0 0 2.122 2.136c1.871.505 9.376.505 9.376.505s7.505 0 9.377-.505a3.015 3.015 0 0 0 2.122-2.136C24 15.93 24 12 24 12s0-3.93-.502-5.814zM9.545 15.568V8.432L15.818 12l-6.273 3.568z"/>
                            </svg>
                        </a>
                    @endif
                    @if($snapchatUrl && $snapchatUrl !== '#')
                        <a class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary hover:text-white flex items-center justify-center transition-all duration-300 text-white" href="{{ $snapchatUrl }}" target="_blank" rel="noopener noreferrer" title="Snapchat">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 504 504" xmlns="http://www.w3.org/2000/svg">
                                <path d="M377.6,0H126C56.8,0,0,56.8,0,126.4V378c0,69.2,56.8,126,126,126h251.6c69.6,0,126.4-56.8,126.4-126.4V126.4C504,56.8,447.2,0,377.6,0z M402.8,334.8c-1.2,2.4-4,4.8-8.8,7.2c-6.4,3.2-16.4,5.6-29.6,7.6c-1.2,0.4-2.4,1.2-3.2,2.4c-0.8,1.2-1.2,4-2,7.6l-0.4,2c-0.4,1.6-0.8,3.6-1.2,5.2c-0.8,2-2,3.2-4.4,3.2c-1.2,0-3.2,0-6.4-0.8c-4.4-0.8-10-2-17.2-2c-4.4,0-8.4,0.4-12.4,1.2c-8.4,1.6-16,6.4-24,12c-10.8,7.6-22.8,16.4-41.2,16.4c-0.8,0-1.6,0-2,0c-0.4,0-0.4,0-0.8,0s-0.8,0-0.8,0c-18.4,0-30.4-8.8-41.6-16.4c-7.6-5.2-14.8-10.4-23.6-12c-4-0.8-8.4-1.2-12.4-1.2c-7.2,0-12.8,1.2-16.8,2h-0.4c-2,0.4-4.4,0.8-6.4,0.8c-2.4,0-4-0.8-4.8-3.2c-1.6-2.8-2.4-4.8-2.8-6.8l-0.4-1.2c-0.8-3.2-1.2-6-2.4-7.6c-0.4-1.2-1.6-2-2.8-2c-13.2-2-23.2-4.8-30-7.6c-4.4-2-7.6-4.4-8.8-6.8c-0.4-0.8-0.4-1.6-0.4-2c0-0.4,0-0.4,0-0.8c1.6-1.6,2.4-2.4,3.6-2.8c10.4-1.6,20-5.6,28.4-11.2c7.2-4.4,14-10.4,20-17.6c10.4-12,15.6-23.6,16.4-25.6v-0.4c2.8-5.2,3.2-10,1.6-13.6c-3.2-7.2-12.8-10.4-19.6-12.4L144,248c-1.2-0.4-2.4-0.8-3.2-1.2c-4.8-2-8.4-4-10.4-6c-3.2-2.8-3.6-5.6-3.2-7.2c0.4-2,2-4.4,4.8-6c3.6-2,8.4-2.8,11.2-1.2c9.2,4.4,16.8,5.6,22.4,2.8c1.6-0.8,2.4-2.4,2.4-4c0-2.4-0.4-4.8-0.4-7.2v-0.4c-1.2-20.8-2.8-46.8,3.6-61.6c4.8-10.4,10.8-19.2,18.4-26.4c6.4-6,13.6-10.8,22-14.4c14.4-6.4,27.6-7.2,34.4-7.2h6c6.8,0,20,0.8,34.4,7.2c8.4,3.6,15.6,8.4,22,14.4c7.6,7.2,14,16,18.4,26.4c6.8,14.8,4.8,40.8,3.6,61.2v1.2c0,1.6-0.4,2.8-0.4,4.4v2c0,1.6,0.8,3.2,2.4,4c1.6,0.8,3.6,1.2,5.6,1.2c0,0,0.4,0,0.8,0c4.4-0.4,9.2-1.6,14.4-4c2-0.8,4-0.8,4.8-0.8c2,0,3.6,0.4,5.6,1.2c4.4,1.6,7.6,4.8,7.6,8c0,1.2-0.4,3.2-2.8,5.6c-2.4,2.4-6,4.4-11.2,6.8c-0.8,0.4-2,0.8-2.8,0.8l-1.2,0.4c-6.4,2-16.4,5.2-19.6,12.4c-1.6,3.6-1.2,8.4,1.6,14c0,0.4,0,0.4,0.4,0.8c3.6,8,23.6,47.2,64.8,54c1.6,0.4,2.8,1.6,2.8,3.6C403.2,333.6,402.8,334.4,402.8,334.8z"/>
                            </svg>
                        </a>
                    @endif
                    @if($tiktokUrl && $tiktokUrl !== '#')
                        <a class="w-10 h-10 rounded-full bg-white/10 hover:bg-primary hover:text-white flex items-center justify-center transition-all duration-300 text-white" href="{{ $tiktokUrl }}" target="_blank" rel="noopener noreferrer" title="TikTok">
                            <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
                            </svg>
                        </a>
                    @endif
                </div>
            </div>
            <!-- Links Columns -->
                <div class="flex flex-wrap gap-12 md:gap-24">
                <div class="flex flex-col gap-4">
                    <h4 class="text-slate-200 font-bold text-lg">{{ __('Quick Links') }}</h4>
                    <ul class="flex flex-col gap-3">
                        @if($aboutUrl && $aboutUrl !== '#')
                            <li><a class="text-slate-200 hover:brightness-110 transition-colors text-sm" href="{{ $aboutUrl }}">{{ __('About Company') }}</a></li>
                        @endif
                        @if($projectsUrl && $projectsUrl !== '#')
                            <li><a class="text-slate-200 hover:brightness-110 transition-colors text-sm" href="{{ $projectsUrl }}">{{ __('Our Projects') }}</a></li>
                        @endif
                        @if($servicesUrl && $servicesUrl !== '#')
                            <li><a class="text-slate-200 hover:brightness-110 transition-colors text-sm" href="{{ $servicesUrl }}">{{ __('Our Services') }}</a></li>
                        @endif
                        @if($blogUrl && $blogUrl !== '#')
                            <li><a class="text-slate-200 hover:brightness-110 transition-colors text-sm" href="{{ $blogUrl }}">{{ __('Blog') }}</a></li>
                        @endif
                        @if($tourismUrl && $tourismUrl !== '#')
                            <li><a class="text-slate-200 hover:brightness-110 transition-colors text-sm" href="{{ $tourismUrl }}">{{ __('Balkis Tourism') }}</a></li>
                        @endif
                        @if($realestateUrl && $realestateUrl !== '#')
                            <li><a class="text-slate-200 hover:brightness-110 transition-colors text-sm" href="{{ $realestateUrl }}">{{ __('Balkis Real Estate') }}</a></li>
                        @endif
                        @if($investmentUrl && $investmentUrl !== '#')
                            <li><a class="text-slate-200 hover:brightness-110 transition-colors text-sm" href="{{ $investmentUrl }}">{{ __('Balkis Investment') }}</a></li>
                        @endif
                    </ul>
                </div>
                <div class="flex flex-col gap-4">
                    <h4 class="text-slate-200 font-bold text-lg">{{ __('Contact Info') }}</h4>
                    <ul class="flex flex-col gap-4">
                        @if($phone)
                            <li class="flex items-center gap-3 text-slate-200 text-sm">
                                <span class="material-symbols-outlined text-white text-lg">call</span>
                                <span dir="ltr">{{ $phone }}</span>
                            </li>
                        @endif
                        @if($email)
                            <li class="flex items-center gap-3 text-slate-200 text-sm">
                                <span class="material-symbols-outlined text-white text-lg">mail</span>
                                <span>{{ $email }}</span>
                            </li>
                        @endif
                        @if($workingHours)
                            <li class="flex items-center gap-3 text-slate-200 text-sm">
                                <span class="material-symbols-outlined text-white text-lg">schedule</span>
                                <span>{{ $workingHours }}</span>
                            </li>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
        <!-- Bottom Bar -->
        <div class="pt-8 border-t border-gray-300 flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-slate-200">
            <p>© {{ date('Y') }} {{ $copyrightText }}</p>
            <div class="flex gap-6">
                @if($privacyUrl && $privacyUrl !== '#')
                    <a class="hover:text-primary transition-colors" href="{{ $privacyUrl }}">{{ __('Privacy Policy') }}</a>
                @endif
                @if($termsUrl && $termsUrl !== '#')
                    <a class="hover:text-primary transition-colors" href="{{ $termsUrl }}">{{ __('Terms of Use') }}</a>
                @endif
            </div>
        </div>
    </div>
</footer>

