@php
    $homePage = $homePage ?? \App\Models\HomePage::getCurrent();
    $mapImage = $homePage->map_image_url ?? 'https://lh3.googleusercontent.com/aida-public/AB6AXuCtmesQwp5513ujXYuNsFkHQ7Sd0wZrfusjFZFe4_i1bRHu7X6BQeawIsj17ege0neKmTs61Ig8lC113HYUqTDEy6xXKzw0Y56sM9X-6j2Plsemu-LAFB-rZv1_amXWAzvLcpYTDA7DWfkS7fZI5gOwk1jrMWZ_XvOt0OSrULviwyqz15-SmWPrTz8XyVR7bCtk1HEcjvGXTPGt4y-wymUXrJl5ULYu4Fv22w4zIv74-wW5tCKP8FbysYZvoKqqxRe8C_sbeQ17z9RM';
    $mapLocationTitle = $homePage->map_location_title ?? 'المقر الرئيسي';
    $mapAddressLine1 = $homePage->map_address_line1 ?? 'شيشلي، إسطنبول، تركيا';
    $mapAddressLine2 = $homePage->map_address_line2 ?? 'برج ترامب، الطابق 25';
    $mapUrl = $homePage->map_url ?? null;
@endphp

<!-- Contact Section -->
<section class="relative py-24 px-4 md:px-10 lg:px-20 section-border">
    <div class="max-w-7xl mx-auto">
        <div class="grid lg:grid-cols-2 gap-12 lg:gap-20 items-stretch">
            <!-- Contact Form Column -->
            <div class="flex flex-col gap-8 order-2 lg:order-1">
                <div class="flex flex-col gap-4">
                    <h2 class="text-3xl md:text-4xl font-bold text-secondary">{{ __('Contact Us') }}</h2>
                    <p class="text-secondary text-lg leading-relaxed">
                        {{ __('Our team is ready to answer all your questions related to investment and business opportunities in Turkey.') }}
                    </p>
                </div>
                @if(session('success'))
                    <div class="bg-green-500/10 border border-green-500/20 text-green-400 px-6 py-4 rounded-lg flex items-center gap-3">
                        <span class="material-symbols-outlined">check_circle</span>
                        <span>{{ session('success') }}</span>
                    </div>
                @endif

                @if($errors->any())
                    <div class="bg-red-500/10 border border-red-500/20 text-red-400 px-6 py-4 rounded-lg flex flex-col gap-2">
                        <div class="flex items-center gap-3">
                            <span class="material-symbols-outlined">error</span>
                            <span>{{ __('An error occurred while sending the message:') }}</span>
                        </div>
                        <ul class="list-disc list-inside mr-4">
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form class="flex flex-col gap-6 mt-4" action="{{ route('contact.submit', ['locale' => app()->getLocale()]) }}" method="POST">
                    @csrf
                    <div class="grid md:grid-cols-2 gap-6">
                        <label class="flex flex-col gap-2">
                            <span class="text-secondary text-sm font-medium">{{ __('Full Name') }}</span>
                            <input class="w-full h-14 bg-white border border-[#3e3828] rounded-lg px-4 text-secondary placeholder-secondary/30 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="محمد عبدالله" type="text" name="name" required/>
                        </label>
                        <label class="flex flex-col gap-2">
                            <span class="text-secondary text-sm font-medium">{{ __('Phone Number') }}</span>
                            <input class="w-full h-14 bg-white border border-[#3e3828] rounded-lg px-4 text-secondary placeholder-secondary/30 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="+90 555 000 0000" type="tel" name="phone" required/>
                        </label>
                    </div>
                    <label class="flex flex-col gap-2">
                            <span class="text-secondary text-sm font-medium">{{ __('Email') }}</span>
                        <input class="w-full h-14 bg-white border border-[#3e3828] rounded-lg px-4 text-secondary placeholder-secondary/30 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors" placeholder="name@company.com" type="email" name="email" required/>
                    </label>
                    <label class="flex flex-col gap-2">
                        <span class="text-secondary text-sm font-medium">{{ __('Message') }}</span>
                        <textarea class="w-full h-32 bg-white border border-[#3e3828] rounded-lg p-4 text-secondary placeholder-secondary/30 focus:outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors resize-none" placeholder="{{ __('Write your message here...') }}" name="message" required></textarea>
                    </label>
                    <button class="mt-2 h-14 bg-gold-gradient hover:bg-[#b8952a]  text-zinc-dark font-bold rounded-lg transition-colors flex items-center justify-center gap-2" type="submit">
                        <span>{{ __('Send Message') }}</span>
                        <span class="material-symbols-outlined rtl:rotate-180 ">arrow_right_alt</span>
                    </button>
                </form>
            </div>
            <!-- Map/Info Column -->
            <div class="flex flex-col gap-8 order-1 lg:order-2 h-full min-h-[400px]">
                <!-- Map Container -->
                <div class="relative w-full h-full min-h-[300px] lg:min-h-[400px] rounded-2xl overflow-hidden border border-[#3e3828] group">
                    @if($mapUrl)
                        <a href="{{ $mapUrl }}" target="_blank" rel="noopener noreferrer" class="block w-full h-full">
                    @endif
                    <!-- Dark Map Image -->
                    <div class="w-full h-full bg-cover bg-center grayscale contrast-125 brightness-[0.4]" data-alt="Dark stylized map" style="background-image: url('{{ $mapImage }}');">
                    </div>
                    @if($mapUrl)
                        </a>
                    @endif
                    <!-- Location Pin Overlay -->
                    <div class="absolute inset-0 flex items-center justify-center pointer-events-none">
                        <div class="relative">
                            <div class="absolute w-12 h-12 bg-primary/30 rounded-full animate-ping"></div>
                            <div class="relative w-12 h-12 bg-primary text-zinc-dark rounded-full flex items-center justify-center shadow-lg shadow-black/50">
                                <span class="material-symbols-outlined text-2xl">location_on</span>
                            </div>
                        </div>
                    </div>
                    <!-- Floating Info Card -->
                    <div class="absolute bottom-6 left-6 right-6 bg-bg-main/90 backdrop-blur-md p-5 rounded-xl border border-white/10 shadow-xl">
                        <div class="flex items-start gap-4">
                            <div class="w-10 h-10 rounded-full bg-primary/10 flex items-center justify-center shrink-0">
                                <span class="material-symbols-outlined text-primary">apartment</span>
                            </div>
                            <div>
                                <h5 class="text-secondary font-bold text-base mb-1">{{ $mapLocationTitle }}</h5>
                                <p class="text-gray-400 text-sm leading-snug">
                                    {{ $mapAddressLine1 }}@if($mapAddressLine2)<br/>{{ $mapAddressLine2 }}@endif
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

