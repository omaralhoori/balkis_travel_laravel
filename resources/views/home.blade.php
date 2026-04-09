@extends('layouts.app')

@section('title', __('Plan Your Luxury Trip') . ' - Balkis Premium Group')

@section('content')
@php
    $homePage = \App\Models\HomePage::getCurrent();
    $mainBgImage = $homePage->main_background_image_url;
    $availableDestinations = $homePage->destinations ?? [];
@endphp
<main class="pt-15">
    <!-- Hero Section -->
    <section class="relative h-[40vh] min-h-[300px] flex justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" alt="{{ __('Plan Your Luxury Trip') }}" src="{{ $mainBgImage }}"/>
            <div class="absolute inset-0 bg-gradient-to-b from-background-dark/40 via-background-dark/60 to-background-dark"></div>
        </div>
        <div class="relative z-10 text-center px-4 max-w-4xl mt-15">
            <h2 class="text-white text-4xl md:text-5xl font-bold mb-4 leading-tight font-heading">{{ $homePage->main_title }}</h2>
            <p class="text-slate-300 text-base md:text-lg font-light max-w-2xl mx-auto font-text">
                {{ $homePage->main_description }}
            </p>
        </div>
    </section>

    <!-- Main Selection Form Card -->
    <section class="max-w-6xl mx-auto px-4 -mt-36 md:-mt-48 relative z-20 pb-16">
        <div class="bg-white/95 backdrop-blur-md rounded-3xl p-6 md:p-8 shadow-2xl border border-white/20 relative">
            <div class="mb-8 text-center">
                <h3 class="text-2xl font-bold text-slate-800 mb-3 font-heading">{{ __('Customize Your Journey') }}</h3>
                <div class="w-16 h-1 bg-primary mx-auto rounded-full mb-8"></div>
                
                <!-- Step Indicator -->
                <div class="max-w-2xl mx-auto relative px-4">
                    <div class="flex justify-between relative mb-10" dir="ltr">
                        <!-- Progress Line Background -->
                        <div class="absolute top-1/2 left-0 right-0 h-1 bg-slate-100 -translate-y-1/2 rounded-full z-0"></div>
                        <!-- Progress Line Active -->
                        <div id="progress-bar" class="absolute top-1/2 left-0 h-1 bg-primary -translate-y-1/2 transition-all duration-500 ease-out rounded-full z-0" style="width: 0%"></div>
                        
                        <div class="step-item active flex flex-col items-center relative z-10 w-16" data-step="1">
                            <div class="step-dot w-10 h-10 rounded-full flex items-center justify-center font-bold text-base bg-primary text-white border-4 border-white shadow-md transition-all duration-500">1</div>
                            <span class="step-label absolute top-12 whitespace-nowrap text-xs font-semibold text-primary transition-all duration-300">{{ __('Destinations') }}</span>
                        </div>
                        <div class="step-item flex flex-col items-center relative z-10 w-16" data-step="2">
                            <div class="step-dot w-10 h-10 rounded-full flex items-center justify-center font-bold text-base bg-slate-100 text-slate-400 border-4 border-white transition-all duration-500">2</div>
                            <span class="step-label absolute top-12 whitespace-nowrap text-xs font-semibold text-slate-400 transition-all duration-300">{{ __('Travelers') }}</span>
                        </div>
                        <div class="step-item flex flex-col items-center relative z-10 w-16" data-step="3">
                            <div class="step-dot w-10 h-10 rounded-full flex items-center justify-center font-bold text-base bg-slate-100 text-slate-400 border-4 border-white transition-all duration-500">3</div>
                            <span class="step-label absolute top-12 whitespace-nowrap text-xs font-semibold text-slate-400 transition-all duration-300">{{ __('Services') }}</span>
                        </div>
                    </div>
                </div>
            </div>
            
            <form id="inquiry-form" class="relative">
                <!-- Step 1: Destinations & Dates -->
                <div class="form-step active" id="step-1" data-step="1">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Destination Selection -->
                        <div class="col-span-full">
                            <label class="block text-sm font-semibold text-slate-700 mb-3 font-text flex items-center gap-2">
                                <span class="material-symbols-outlined text-primary text-lg">map</span>
                                {{ __('Required Destinations (You can select multiple cities)') }}
                            </label>
                            <div id="destinations-container" class="flex flex-wrap gap-2 p-5 border-2 border-dashed border-slate-200 rounded-2xl bg-slate-50/50 min-h-[80px] transition-all hover:border-primary/30">
                                <div class="text-slate-400 text-sm italic py-2 px-1 w-full" id="empty-destinations-msg">
                                    {{ __('Click "Add City" to start building your route...') }}
                                </div>
                            </div>
                            <div class="mt-4 relative">
                                <button type="button" id="add-destination-btn" class="inline-flex items-center gap-2 px-5 py-2.5 bg-slate-800 text-white rounded-xl text-sm hover:bg-primary transition-all shadow-md active:scale-95 font-text">
                                    <span class="material-symbols-outlined text-sm">add_location</span>
                                    {{ __('Add City') }}
                                </button>
                                <!-- Dropdown for available destinations -->
                                <div id="destinations-dropdown" class="hidden absolute top-full ltr:left-0 rtl:right-0 mt-2 w-full max-w-sm bg-white border border-slate-100 rounded-2xl shadow-2xl z-50 max-h-72 overflow-y-auto p-2">
                                    @if(count($availableDestinations) > 0)
                                        @foreach($availableDestinations as $destination)
                                            <button type="button" class="destination-option w-full text-start px-4 py-3 hover:bg-primary/5 rounded-xl transition-colors font-text flex items-center justify-between group" data-destination="{{ $destination['name'] ?? '' }}">
                                                <div class="flex items-center gap-3">
                                                    <span class="material-symbols-outlined text-slate-400 group-hover:text-primary transition-colors">location_on</span>
                                                    <span class="text-slate-700 font-medium group-hover:text-primary">{{ $destination['name'] ?? '' }}</span>
                                                </div>
                                                <span class="material-symbols-outlined text-xs text-slate-300 opacity-0 group-hover:opacity-100 group-hover:text-primary transition-all">add</span>
                                            </button>
                                        @endforeach
                                    @else
                                        <div class="p-4 text-center text-slate-400 text-sm italic font-text">
                                            {{ __('No destinations available') }}
                                        </div>
                                    @endif
                                </div>
                            </div>
                            <!-- Hidden input to store selected destinations -->
                            <input type="hidden" id="selected-destinations" name="selected_destinations" value="[]">
                        </div>

                        <div class="col-span-full grid grid-cols-1 md:grid-cols-2 gap-4 mt-2">
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700 font-text">{{ __('Trip Start') }}</label>
                                <div class="relative group">
                                    <span class="absolute ltr:right-4 rtl:left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-400 group-focus-within:text-primary transition-colors z-10 pointer-events-none text-xl">calendar_today</span>
                                    <input id="arrival-date" name="arrival_date" class="date-input w-full ltr:pr-12 rtl:pl-12 ltr:pl-4 rtl:pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none text-slate-800 font-text shadow-sm transition-all text-start" type="date" min="{{ date('Y-m-d') }}" required/>
                                </div>
                            </div>
                            <div class="space-y-2">
                                <label class="block text-sm font-semibold text-slate-700 font-text">{{ __('Trip End') }}</label>
                                <div class="relative group">
                                    <span class="absolute ltr:right-4 rtl:left-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-slate-400 group-focus-within:text-primary transition-colors z-10 pointer-events-none text-xl">event</span>
                                    <input id="departure-date" name="departure_date" class="date-input w-full ltr:pr-12 rtl:pl-12 ltr:pl-4 rtl:pr-4 py-3 bg-slate-50 border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none text-slate-800 font-text shadow-sm transition-all text-start" type="date" min="{{ date('Y-m-d') }}" required/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 2: Travelers -->
                <div class="form-step hidden" id="step-2" data-step="2">
                    <div class="space-y-8">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-5 font-text text-center text-lg">{{ __('Who are you traveling with?') }}</label>
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-primary">
                                            <span class="material-symbols-outlined">person</span>
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-800 text-start">{{ __('Adults') }}</div>
                                            <div class="text-xs text-slate-400 text-start">18+ {{ __('years') }}</div>
                                        </div>
                                    </div>
                                    <input name="adults" id="adults" class="w-20 px-3 py-2 bg-white border border-slate-200 rounded-lg text-center font-bold text-slate-800 outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors shadow-sm" type="number" value="2" min="1" max="40" required/>
                                </div>
                                <div class="bg-slate-50 p-6 rounded-2xl border border-slate-100 flex items-center justify-between">
                                    <div class="flex items-center gap-4">
                                        <div class="w-12 h-12 bg-white rounded-xl shadow-sm flex items-center justify-center text-primary">
                                            <span class="material-symbols-outlined">child_care</span>
                                        </div>
                                        <div>
                                            <div class="font-bold text-slate-800 text-start">{{ __('Children') }}</div>
                                            <div class="text-xs text-slate-400 text-start">0-17 {{ __('years') }}</div>
                                        </div>
                                    </div>
                                    <input name="children" id="children" class="w-20 px-3 py-2 bg-white border border-slate-200 rounded-lg text-center font-bold text-slate-800 outline-none focus:border-primary focus:ring-1 focus:ring-primary transition-colors shadow-sm" type="number" value="0" min="0" max="20" required/>
                                </div>
                            </div>
                        </div>

                        <!-- Children Ages -->
                        <div id="children-ages-container" class="hidden space-y-4 pt-4 border-t border-slate-100">
                            <div class="flex items-center gap-3 text-slate-700 font-semibold mb-4">
                                <div class="w-8 h-8 bg-primary/10 rounded-lg flex items-center justify-center text-primary">
                                    <span class="material-symbols-outlined text-sm">cake</span>
                                </div>
                                {{ __('Please provide children ages') }}
                            </div>
                            <div id="children-ages-fields" class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-4">
                                <!-- Age input fields will be added dynamically -->
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Step 3: Services -->
                <div class="form-step hidden" id="step-3" data-step="3">
                    <div class="space-y-8">
                        <div>
                            <label class="block text-sm font-semibold text-slate-700 mb-4 font-text">{{ __('Custom Services') }}</label>
                            <div class="grid grid-cols-2 lg:grid-cols-4 gap-3">
                                @php
                                    $services = [
                                        ['id' => 'flight', 'icon' => 'flight_takeoff', 'label' => __('Flight Tickets'), 'checked' => true],
                                        ['id' => 'accommodation', 'icon' => 'hotel', 'label' => __('Accommodation'), 'checked' => true],
                                        ['id' => 'car_rental', 'icon' => 'directions_car', 'label' => __('Car Rental'), 'checked' => false],
                                        ['id' => 'tourist_trips', 'icon' => 'map', 'label' => __('Tourist Trips'), 'checked' => false],
                                    ];
                                @endphp

                                @foreach($services as $service)
                                <label class="relative block cursor-pointer group h-full">
                                    <input name="services[]" value="{{ $service['id'] }}" {{ $service['checked'] ? 'checked' : '' }} class="hidden peer" type="checkbox"/>
                                    <div class="p-4 rounded-xl border border-slate-200 bg-slate-50 peer-checked:border-primary peer-checked:bg-primary/5 transition-all duration-300 group-hover:border-primary/30 group-hover:bg-primary/5 text-center h-full flex flex-col items-center justify-center">
                                        <div class="w-10 h-10 bg-white rounded-lg shadow-sm flex items-center justify-center mx-auto mb-3 text-slate-400 peer-checked:group-[]:text-primary transition-colors">
                                            <span class="material-symbols-outlined text-2xl">{{ $service['icon'] }}</span>
                                        </div>
                                        <span class="text-sm font-bold text-slate-600 peer-checked:group-[]:text-primary">{{ $service['label'] }}</span>
                                        <div class="absolute top-2 ltr:right-2 rtl:left-2 opacity-0 peer-checked:opacity-100 transition-opacity">
                                            <div class="w-6 h-6 bg-primary rounded-full flex items-center justify-center text-white">
                                                <span class="material-symbols-outlined text-sm">check</span>
                                            </div>
                                        </div>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        <!-- Conditional Sections -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 pt-4 border-t border-slate-100">
                            <!-- Accommodation Type -->
                            <div id="accommodation-type-container" class="hidden p-6 rounded-2xl border border-slate-100 bg-slate-50/50 space-y-4 transition-all">
                                <label class="text-sm font-bold text-slate-800 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">bed</span>
                                    {{ __('Accommodation Style') }}
                                </label>
                                <div class="space-y-3">
                                    @foreach(['hotel' => __('Hotel'), 'apartment_hotel' => __('Apartment Hotel'), 'cottage' => __('Cottage')] as $val => $label)
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="radio" name="accommodation_type" value="{{ $val }}" {{ $loop->first ? 'checked' : '' }} class="accent-primary size-5 shadow-sm">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-primary transition-colors">{{ $label }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>

                            <!-- Trip Type -->
                            <div id="trip-type-container" class="hidden p-6 rounded-2xl border border-slate-100 bg-slate-50/50 space-y-4 transition-all">
                                <label class="text-sm font-bold text-slate-800 flex items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">groups</span>
                                    {{ __('Group Type') }}
                                </label>
                                <div class="space-y-3">
                                    @foreach(['VIP' => __('VIP (Private)'), 'Grouped' => __('Group')] as $val => $label)
                                    <label class="flex items-center gap-3 cursor-pointer group">
                                        <input type="radio" name="trip_type" value="{{ $val }}" {{ $loop->first ? 'checked' : '' }} class="accent-primary size-5 shadow-sm">
                                        <span class="text-sm font-medium text-slate-600 group-hover:text-primary transition-colors">{{ $label }}</span>
                                    </label>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Navigation Buttons -->
                <div class="mt-8 flex flex-col md:flex-row items-center justify-between gap-4 border-t border-slate-100 pt-6">
                    <button type="button" id="btn-prev" class="hidden w-full md:w-auto px-6 py-3 bg-slate-100 hover:bg-slate-200 text-slate-700 font-bold rounded-xl transition-all duration-300 flex items-center justify-center gap-2">
                        <span class="material-symbols-outlined rtl:rotate-180">arrow_back</span>
                        {{ __('Back') }}
                    </button>
                    
                    <button type="button" id="btn-next" class="w-full md:w-auto md:min-w-[200px] px-8 py-3 bg-gold-gradient hover:brightness-110 text-white font-extra-bold rounded-xl shadow-lg shadow-primary/20 transition-all duration-300 flex items-center justify-center gap-3 ltr:ml-auto rtl:mr-auto">
                        <span id="next-text">{{ __('Next Step') }}</span>
                        <span class="material-symbols-outlined rtl:rotate-180" id="next-icon">arrow_forward</span>
                    </button>
                </div>

                <div id="form-message" class="hidden mt-6 text-center p-3 rounded-lg text-sm font-text border"></div>
                
                <div class="mt-4 pt-2 text-center">
                    <p class="text-slate-400 text-xs font-text flex items-center justify-center gap-1">
                        <span class="material-symbols-outlined text-xs">support_agent</span>
                        {{ __('Once submitted, one of our consultants will contact you within 24 hours.') }}
                    </p>
                </div>
            </form>
        </div>
    </section>

    @if(isset($topPrograms) && $topPrograms->isNotEmpty())
    <!-- Featured Programs Section -->
    <section class="max-w-7xl mx-auto px-4 py-16 relative z-20 mt-8 ">
        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold text-slate-800 mb-4 font-heading">{{ __('Featured Programs') }}</h3>
            <div class="w-16 h-1 bg-primary mx-auto rounded-full mb-4"></div>
            <p class="text-slate-500 font-text">{{ __('Discover our most popular travel packages based on customer visits') }}</p>
        </div>

        <div class="relative group/slider">
            <button class="hidden md:flex absolute -left-6 top-1/2 -translate-y-1/2 z-10 bg-white text-primary shadow-xl rounded-full w-12 h-12 items-center justify-center opacity-0 group-hover/slider:opacity-100 transition-all hover:scale-110 disabled:opacity-0" onclick="scrollCarousel(this, -1)">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button class="hidden md:flex absolute -right-6 top-1/2 -translate-y-1/2 z-10 bg-white text-primary shadow-xl rounded-full w-12 h-12 items-center justify-center opacity-0 group-hover/slider:opacity-100 transition-all hover:scale-110 disabled:opacity-0" onclick="scrollCarousel(this, 1)">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>

            <div class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar gap-6 pb-6 -mx-4 px-4 sm:mx-0 sm:px-0">
                @foreach($topPrograms as $program)
                <div class="snap-start shrink-0 w-[85vw] sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] h-full pb-4">
                    <a href="{{ route('programs.show', ['locale' => app()->getLocale(), 'id' => $program->id]) }}" class="group block bg-white rounded-3xl shadow-sm hover:shadow-xl transition-all duration-300 overflow-hidden border border-slate-100 flex flex-col h-full hover:-translate-y-1">
                <div class="relative h-64 overflow-hidden shrink-0">
                    @if($program->image_url)
                        <img src="{{ $program->image_url }}" alt="{{ $program->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                    @else
                        <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                            <span class="material-symbols-outlined text-5xl text-slate-300">landscape</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/80 via-slate-900/20 to-transparent opacity-80 group-hover:opacity-100 transition-opacity"></div>
                    <div class="absolute bottom-5 left-5 right-5 flex justify-between items-end z-10">
                        <div>
                            @if($program->category)
                            <span class="px-3 py-1 bg-primary/90 text-white text-xs font-bold rounded-lg mb-2 inline-block backdrop-blur-sm shadow-sm">{{ $program->category }}</span>
                            @endif
                            <h4 class="text-white text-xl font-bold font-heading drop-shadow-md leading-tight">{{ $program->title }}</h4>
                        </div>
                    </div>
                </div>
                <div class="p-6 flex flex-col grow">
                    <div class="flex items-center gap-2 text-slate-500 text-sm mb-3">
                        <span class="material-symbols-outlined text-sm text-primary">location_on</span>
                        <span class="font-medium text-slate-600">{{ $program->location ?? __('Multiple Destinations') }}</span>
                    </div>
                    <p class="text-slate-500 text-sm line-clamp-2 mb-6 font-text leading-relaxed">{{ strip_tags($program->description) }}</p>
                    <div class="flex items-center justify-between pt-4 border-t border-slate-100 mt-auto">
                        <div class="flex items-center gap-1.5 text-slate-400 text-xs font-text bg-slate-50 px-2 py-1 rounded-md border border-slate-100">
                            <span class="material-symbols-outlined text-[14px]">visibility</span>
                            <span class="font-medium">{{ $program->views }} {{ __('Views') }}</span>
                        </div>
                        <span class="text-primary font-bold font-text flex items-center gap-1 text-sm group-hover:text-amber-600 transition-colors">
                            {{ __('Explore') }}
                            <span class="material-symbols-outlined rtl:rotate-180 text-sm transition-transform group-hover:translate-x-1 rtl:group-hover:-translate-x-1">arrow_forward</span>
                        </span>
                    </div>
                </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if(isset($touristTrips) && $touristTrips->isNotEmpty())
    <!-- Tourist Trips Section -->
    <section id="tourist-trips" class="max-w-7xl mx-auto px-4 py-16 relative z-20 bg-rose-50/40 rounded-3xl mt-16 border border-rose-100/50 shadow-sm">
        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold text-slate-800 mb-4 font-heading">{{ __('Tourist Trips') }}</h3>
            <div class="w-16 h-1 bg-primary mx-auto rounded-full mb-4"></div>
            <p class="text-slate-500 font-text">{{ __('Explore our carefully curated tourist trips') }}</p>
        </div>

        <div class="relative group/slider">
            <button class="hidden md:flex absolute -left-6 top-1/2 -translate-y-1/2 z-10 bg-white text-primary shadow-xl rounded-full w-12 h-12 items-center justify-center opacity-0 group-hover/slider:opacity-100 transition-all hover:scale-110 disabled:opacity-0" onclick="scrollCarousel(this, -1)">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button class="hidden md:flex absolute -right-6 top-1/2 -translate-y-1/2 z-10 bg-white text-primary shadow-xl rounded-full w-12 h-12 items-center justify-center opacity-0 group-hover/slider:opacity-100 transition-all hover:scale-110 disabled:opacity-0" onclick="scrollCarousel(this, 1)">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>

            <div class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar gap-6 pb-6 -mx-4 px-4 sm:mx-0 sm:px-0">
                @foreach($touristTrips as $trip)
                <div class="snap-start shrink-0 w-[85vw] lg:w-[calc(50%-12px)] h-full pb-4">
                    <div class="bg-white rounded-3xl shadow-sm border border-slate-100 overflow-hidden flex flex-col md:flex-row h-full group hover:shadow-xl transition-all duration-300">
                <div class="w-full md:w-2/5 h-64 md:h-auto relative overflow-hidden shrink-0">
                    @if($trip->image_url)
                        <img src="{{ $trip->image_url }}" alt="{{ $trip->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                    @else
                        <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                            <span class="material-symbols-outlined text-5xl text-slate-300">tour</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t md:bg-gradient-to-l from-slate-900/60 to-transparent"></div>
                    <div class="absolute bottom-4 left-4 right-4 md:bottom-auto md:top-4 md:right-4 md:left-auto flex items-center gap-2">
                        <span class="px-3 py-1 bg-white/90 backdrop-blur-sm text-primary text-xs font-bold rounded-lg shadow-sm">{{ __('Trip') }}</span>
                    </div>
                </div>
                
                <div class="p-6 md:p-8 flex flex-col grow">
                    <h4 class="text-2xl font-bold font-heading text-slate-800 mb-6 group-hover:text-primary transition-colors">{{ $trip->title }}</h4>
                    
                    <div class="space-y-6 flex-grow font-text">
                        <!-- What is included -->
                        @if($trip->includes)
                        <div>
                            <h5 class="flex items-center gap-2 font-bold text-slate-700 mb-2">
                                <span class="material-symbols-outlined text-primary text-lg flex-shrink-0">check_circle</span>
                                {{ __('What is included') }}
                            </h5>
                            <div class="text-sm text-slate-500 leading-relaxed ps-7 line-clamp-3 prose prose-slate prose-sm text-slate-500">{!! $trip->includes !!}</div>
                        </div>
                        @endif

                        <!-- What to bring / do -->
                        @if($trip->what_to_bring)
                        <div>
                            <h5 class="flex items-center gap-2 font-bold text-slate-700 mb-2">
                                <span class="material-symbols-outlined text-primary text-lg flex-shrink-0">backpack</span>
                                {{ __('What to bring / Remarks') }}
                            </h5>
                            <div class="text-sm text-slate-500 leading-relaxed ps-7 line-clamp-3 prose prose-slate prose-sm text-slate-500">{!! $trip->what_to_bring !!}</div>
                        </div>
                        @endif
                    </div>
                    
                    <div class="mt-8 pt-6 border-t border-slate-100 flex justify-end">
                        <a href="{{ route('whatsapp.redirect', ['locale' => app()->getLocale()]) }}?text={{ urlencode(__('Inquiry about ') . $trip->title) }}" target="_blank" rel="noopener noreferrer" class="inline-flex items-center gap-2 px-6 py-2.5 bg-slate-900 hover:bg-primary text-white text-sm font-bold rounded-xl transition-all duration-300">
                            {{ __('Book Now') }}
                            <span class="material-symbols-outlined text-sm rtl:rotate-180">arrow_forward</span>
                        </a>
                    </div>
                </div>
            </div>
            </div>
            @endforeach
            </div>
        </div>
    </section>
    @endif

    @if(isset($touristGuidePosts) && $touristGuidePosts->isNotEmpty())
    <!-- Tourist Guide Section -->
    <section id="tourist-guide" class="max-w-7xl mx-auto px-4 py-16 relative z-20 bg-amber-50/40 rounded-3xl mt-16 mb-16 border border-amber-100/50 shadow-sm">
        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold text-slate-800 mb-4 font-heading">{{ __('Tourist Guide') }}</h3>
            <div class="w-16 h-1 bg-primary mx-auto rounded-full mb-4"></div>
            <p class="text-slate-500 font-text">{{ __('Discover our latest articles and travel tips') }}</p>
        </div>

        <div class="relative group/slider">
            <button class="hidden md:flex absolute -left-6 top-1/2 -translate-y-1/2 z-10 bg-white text-primary shadow-xl rounded-full w-12 h-12 items-center justify-center opacity-0 group-hover/slider:opacity-100 transition-all hover:scale-110 disabled:opacity-0" onclick="scrollCarousel(this, -1)">
                <span class="material-symbols-outlined">chevron_left</span>
            </button>
            <button class="hidden md:flex absolute -right-6 top-1/2 -translate-y-1/2 z-10 bg-white text-primary shadow-xl rounded-full w-12 h-12 items-center justify-center opacity-0 group-hover/slider:opacity-100 transition-all hover:scale-110 disabled:opacity-0" onclick="scrollCarousel(this, 1)">
                <span class="material-symbols-outlined">chevron_right</span>
            </button>

            <div class="flex overflow-x-auto snap-x snap-mandatory hide-scrollbar gap-6 pb-6 -mx-4 px-4 sm:mx-0 sm:px-0">
                @foreach($touristGuidePosts as $post)
                <div class="snap-start shrink-0 w-[85vw] sm:w-[calc(50%-12px)] lg:w-[calc(33.333%-16px)] h-full pb-4">
                    <a href="{{ route('blog.show', ['locale' => app()->getLocale(), 'slug' => $post->slug]) }}" class="bg-white h-full rounded-2xl shadow-sm border border-slate-100 overflow-hidden flex flex-col group hover:shadow-xl transition-all duration-300 hover:-translate-y-1">
                <div class="w-full h-40 relative overflow-hidden shrink-0">
                    @if($post->featured_image_url)
                        <img src="{{ $post->featured_image_url }}" alt="{{ $post->title }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-700 ease-out">
                    @else
                        <div class="w-full h-full bg-slate-100 flex items-center justify-center">
                            <span class="material-symbols-outlined text-4xl text-slate-300">article</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 bg-gradient-to-t from-slate-900/60 to-transparent opacity-60"></div>
                </div>
                
                <div class="p-5 flex flex-col grow">
                    <div class="text-xs text-primary font-bold mb-2">{{ $post->published_at ? $post->published_at->format('M d, Y') : '' }}</div>
                    <h4 class="text-base font-bold font-heading text-slate-800 mb-3 group-hover:text-primary transition-colors line-clamp-2" title="{{ $post->title }}">{{ $post->title }}</h4>
                    <p class="text-xs text-slate-500 font-text line-clamp-3 mb-4 flex-grow">{{ Str::limit(strip_tags($post->excerpt ?: $post->content), 80) }}</p>
                    
                    <div class="mt-auto pt-4 border-t border-slate-100 flex items-center text-primary text-sm font-bold group-hover:text-amber-600 transition-colors">
                        {{ __('Read More') }}
                        <span class="material-symbols-outlined rtl:rotate-180 text-sm ml-1 rtl:mr-1 transition-transform group-hover:translate-x-1 rtl:group-hover:-translate-x-1">arrow_forward</span>
                    </div>
                </div>
                    </a>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    @if($homePage->about_us)
    <!-- About Us Section -->
    <section id="about-us" class="max-w-7xl mx-auto px-4 py-16 relative z-20 bg-slate-50/50 rounded-3xl mt-16 mb-16 border border-slate-100 shadow-sm">
        <div class="text-center mb-12">
            <h3 class="text-3xl font-bold text-slate-800 mb-4 font-heading">{{ __('About Us') }}</h3>
            <div class="w-16 h-1 bg-primary mx-auto rounded-full"></div>
        </div>
        <div class="max-w-4xl mx-auto prose prose-slate lg:prose-lg font-text text-slate-600 text-center">
            {!! $homePage->about_us !!}
        </div>
    </section>
    @endif
    @include('components.testimonials-section')

    @if(isset($paymentMethods) && $paymentMethods->isNotEmpty())
    <!-- Payment Methods Section -->
    <section class="max-w-7xl mx-auto px-4 py-8 relative z-20 mt-8 mb-8 border-t border-slate-100">
        <div class="flex flex-col items-center justify-center text-center mb-8">
            <h3 class="text-2xl font-bold text-slate-800 mb-2 font-heading">{{ __('Payment Methods') }}</h3>
            <p class="text-slate-500 font-text text-sm">{{ __('Secure, easy, and multiple payment options tailored for you') }}</p>
        </div>
        
        <div class="flex flex-wrap justify-center items-center gap-6">
            @foreach($paymentMethods->take(6) as $method)
                @if($method->icon)
                <div class="bg-white px-6 py-4 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center hover:shadow-md transition-shadow grayscale hover:grayscale-0 hover:scale-105 transition-all cursor-pointer" title="{{ $method->name }}">
                    <img src="{{ asset('storage/'.$method->icon) }}" alt="{{ $method->name }}" class="max-h-10 object-contain w-auto">
                </div>
                @else
                <div class="bg-white px-6 py-4 rounded-2xl shadow-sm border border-slate-100 flex items-center justify-center hover:shadow-md transition-shadow">
                    <span class="font-bold text-slate-600 truncate max-w-[120px]">{{ $method->name }}</span>
                </div>
                @endif
            @endforeach
        </div>
        
        <div class="flex justify-center mt-8">
            <a href="{{ route('payment_methods.index', app()->getLocale()) }}" class="inline-flex items-center gap-2 px-6 py-2.5 bg-slate-50 hover:bg-primary text-slate-600 hover:text-white text-sm font-bold rounded-xl transition-all duration-300 border border-slate-200 hover:border-primary">
                {{ __('Learn More') }}
                <span class="material-symbols-outlined text-sm rtl:rotate-180">arrow_forward</span>
            </a>
        </div>
    </section>
    @endif
</main>

@push('styles')
<style>
    .service-card:hover {
        border-color: var(--color-primary);
        background-color: rgba(198, 162, 100, 0.05);
    }
    .service-card.active {
        border-color: var(--color-primary);
        background-color: rgba(198, 162, 100, 0.1);
    }
    
    /* Date Input Styling */
    .date-input { position: relative; cursor: pointer; }
    .date-input::-webkit-calendar-picker-indicator { display: none; opacity: 0; position: absolute; right: 0; cursor: pointer; }
    .date-input::-webkit-inner-spin-button, .date-input::-webkit-clear-button { display: none; appearance: none; }
    .date-input[type="date"] { -moz-appearance: textfield; color: rgb(30, 41, 59); }
    .date-input[type="date"]::-moz-calendar-picker-indicator { display: none; }
    .date-input[type="date"]:invalid { color: rgb(148, 163, 184); }
    .date-input[type="date"]::-moz-placeholder { color: rgb(148, 163, 184); }
    .date-input-wrapper { position: relative; }
    .date-input-wrapper .material-symbols-outlined { pointer-events: none; z-index: 1; }

    /* Animations for Form Steps */
    .form-step { display: none; opacity: 0; }
    .form-step.active { display: block; animation: fadeInR 0.4s ease-out forwards; }
    .form-step.enter-left { display: block; animation: fadeInL 0.4s ease-out forwards; }
    
    @keyframes fadeInR { from { opacity: 0; transform: translateX(20px); } to { opacity: 1; transform: translateX(0); } }
    @keyframes fadeInL { from { opacity: 0; transform: translateX(-20px); } to { opacity: 1; transform: translateX(0); } }
    
    .hide-scrollbar::-webkit-scrollbar { display: none; }
    .hide-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    let currentStep = 1;
    const totalSteps = 3;
    const form = document.getElementById('inquiry-form');
    const btnNext = document.getElementById('btn-next');
    const btnPrev = document.getElementById('btn-prev');
    const nextText = document.getElementById('next-text');
    const nextIcon = document.getElementById('next-icon');
    const formSteps = document.querySelectorAll('.form-step');
    const stepItems = document.querySelectorAll('.step-item');
    const progressBar = document.getElementById('progress-bar');
    const formMessage = document.getElementById('form-message');

    // Destinations management
    let selectedDestinations = [];
    const destinationsContainer = document.getElementById('destinations-container');
    const addDestinationBtn = document.getElementById('add-destination-btn');
    const destinationsDropdown = document.getElementById('destinations-dropdown');
    const selectedDestinationsInput = document.getElementById('selected-destinations');

    // Date inputs
    const arrivalDateInput = document.getElementById('arrival-date');
    const departureDateInput = document.getElementById('departure-date');

    // Helper functions
    function updateProgress() {
        const percent = ((currentStep - 1) / (totalSteps - 1)) * 100;
        progressBar.style.width = percent + '%';

        stepItems.forEach(item => {
            const stepNum = parseInt(item.dataset.step);
            const dot = item.querySelector('.step-dot');
            const label = item.querySelector('.step-label');

            if (stepNum < currentStep) {
                // Completed
                dot.className = 'step-dot w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg bg-primary text-white border-4 border-white shadow-md transition-all duration-500';
                dot.innerHTML = '<span class="material-symbols-outlined">check</span>';
                label.className = 'step-label absolute top-14 whitespace-nowrap text-sm font-semibold text-primary transition-all duration-300';
            } else if (stepNum === currentStep) {
                // Current
                dot.className = 'step-dot w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg bg-primary text-white border-4 border-white shadow-md transition-all duration-500 ring-4 ring-primary/20 ring-offset-2';
                dot.innerHTML = stepNum;
                label.className = 'step-label absolute top-14 whitespace-nowrap text-sm font-bold text-primary transition-all duration-300';
            } else {
                // Future
                dot.className = 'step-dot w-12 h-12 rounded-full flex items-center justify-center font-bold text-lg bg-slate-100 text-slate-400 border-4 border-white transition-all duration-500';
                dot.innerHTML = stepNum;
                label.className = 'step-label absolute top-14 whitespace-nowrap text-sm font-semibold text-slate-400 transition-all duration-300';
            }
        });

        // Update buttons
        if (currentStep === 1) {
            btnPrev.classList.add('hidden');
        } else {
            btnPrev.classList.remove('hidden');
        }

        if (currentStep === totalSteps) {
            nextText.textContent = '{{ __("Submit Inquiry") }}';
            nextIcon.textContent = 'send';
            btnNext.classList.add('bg-primary', 'hover:brightness-110');
        } else {
            nextText.textContent = '{{ __("Next Step") }}';
            nextIcon.textContent = 'arrow_forward';
        }
    }

    function validateStep(step) {
        if (step === 1) {
            if (selectedDestinations.length === 0) {
                alert('{{ __("Please select at least one destination.") }}');
                return false;
            }
            if (!arrivalDateInput.value) {
                alert('{{ __("Please select your trip start date.") }}');
                return false;
            }
            if (!departureDateInput.value) {
                alert('{{ __("Please select your trip end date.") }}');
                return false;
            }
            if (departureDateInput.value < arrivalDateInput.value) {
                alert('{{ __("Departure date must be after arrival date.") }}');
                return false;
            }
        }
        
        if (step === 2) {
            const adults = document.getElementById('adults').value;
            const children = document.getElementById('children').value;
            if (parseInt(adults) === 0 && parseInt(children) === 0) {
                alert('{{ __("Please enter the number of travelers.") }}');
                return false;
            }
            
            // Check if all children ages are filled
            const count = parseInt(children) || 0;
            if (count > 0) {
                const ageInputs = document.querySelectorAll('input[name="child_ages[]"]');
                let allFilled = true;
                ageInputs.forEach(input => {
                    if (input.value === '') allFilled = false;
                });
                if (!allFilled) {
                    alert('{{ __("Please provide ages for all children.") }}');
                    return false;
                }
            }
        }
        
        return true;
    }

    function showStep(step, direction) {
        formSteps.forEach(fs => {
            fs.classList.remove('active', 'enter-left');
            fs.classList.add('hidden');
        });
        
        const targetStep = document.getElementById(`step-${step}`);
        targetStep.classList.remove('hidden');
        
        if (direction === 'next') {
            targetStep.classList.add('active');
        } else {
            targetStep.classList.add('enter-left');
        }
    }

    btnNext.addEventListener('click', function() {
        if (!validateStep(currentStep)) return;

        if (currentStep < totalSteps) {
            currentStep++;
            updateProgress();
            showStep(currentStep, 'next');
        } else {
            // Submit form
            submitForm();
        }
    });

    btnPrev.addEventListener('click', function() {
        if (currentStep > 1) {
            currentStep--;
            updateProgress();
            showStep(currentStep, 'prev');
        }
    });

    // Handle Destinations logic
    function updateSelectedDestinationsInput() {
        selectedDestinationsInput.value = JSON.stringify(selectedDestinations);
    }

    function updateDropdownOptions() {
        const options = document.querySelectorAll('.destination-option');
        options.forEach(option => {
            if (selectedDestinations.includes(option.dataset.destination)) {
                option.style.display = 'none';
            } else {
                option.style.display = 'flex';
            }
        });
    }

    function renderSelectedDestinations() {
        if (selectedDestinations.length === 0) {
            destinationsContainer.innerHTML = `<div class="text-slate-400 text-sm italic py-2 px-1 w-full" id="empty-destinations-msg">{{ __('Click "Add City" to start building your route...') }}</div>`;
        } else {
            destinationsContainer.innerHTML = '';
            selectedDestinations.forEach((destination, index) => {
                const btn = document.createElement('button');
                btn.type = 'button';
                btn.className = 'flex items-center gap-2 px-4 py-2 bg-primary/10 border border-primary text-primary rounded-xl text-sm font-text destination-tag transition-all hover:bg-primary hover:text-white group';
                btn.innerHTML = `
                    <span class="material-symbols-outlined text-sm pt-0.5">location_on</span>
                    <span class="font-bold">${destination}</span>
                    <span class="material-symbols-outlined text-xs bg-white text-primary rounded-full p-0.5 group-hover:bg-primary/20 group-hover:text-white transition-colors">close</span>
                `;
                btn.addEventListener('click', (e) => {
                    e.stopPropagation();
                    selectedDestinations.splice(index, 1);
                    renderSelectedDestinations();
                });
                destinationsContainer.appendChild(btn);
            });
        }
        updateSelectedDestinationsInput();
        updateDropdownOptions();
    }

    addDestinationBtn?.addEventListener('click', (e) => {
        e.stopPropagation();
        destinationsDropdown.classList.toggle('hidden');
    });

    document.addEventListener('click', (e) => {
        if (addDestinationBtn && destinationsDropdown && !addDestinationBtn.contains(e.target) && !destinationsDropdown.contains(e.target)) {
            destinationsDropdown.classList.add('hidden');
        }
    });

    document.querySelectorAll('.destination-option').forEach(option => {
        option.addEventListener('click', function() {
            const destName = this.dataset.destination;
            if (destName && !selectedDestinations.includes(destName)) {
                selectedDestinations.push(destName);
                renderSelectedDestinations();
                destinationsDropdown.classList.add('hidden');
            }
        });
    });
    updateDropdownOptions();

    // Date limits
    if (arrivalDateInput && departureDateInput) {
        arrivalDateInput.addEventListener('change', function() {
            if (this.value) {
                const arrivalDate = new Date(this.value);
                arrivalDate.setDate(arrivalDate.getDate() + 1);
                departureDateInput.min = arrivalDate.toISOString().split('T')[0];
                if (departureDateInput.value && departureDateInput.value < this.value) {
                    departureDateInput.value = '';
                }
            }
        });
        
        // Ensure date picker opens on click anywhere on the input
        arrivalDateInput.addEventListener('click', function(e) {
            this.showPicker?.();
        });
        
        departureDateInput.addEventListener('click', function(e) {
            this.showPicker?.();
        });
    }

    // Children Ages Logic
    const childrenInput = document.getElementById('children');
    const childrenAgesContainer = document.getElementById('children-ages-container');
    const childrenAgesFields = document.getElementById('children-ages-fields');

    if (childrenInput && childrenAgesContainer && childrenAgesFields) {
        childrenInput.addEventListener('input', function() {
            const count = parseInt(this.value) || 0;
            
            if (count > 0) {
                childrenAgesContainer.classList.remove('hidden');
            } else {
                childrenAgesContainer.classList.add('hidden');
            }

            const currentInputs = childrenAgesFields.querySelectorAll('input');
            const currentValues = Array.from(currentInputs).map(input => input.value);

            childrenAgesFields.innerHTML = '';
            
            for (let i = 0; i < count; i++) {
                const val = currentValues[i] || '';
                const fieldHTML = `
                    <div class="relative">
                        <label class="block text-xs font-semibold text-slate-500 mb-2 font-text">{{ __('Child') }} ${i + 1} {{ __('Age') }}</label>
                        <input name="child_ages[]" class="w-full px-4 py-2.5 bg-white border border-slate-200 rounded-xl focus:ring-2 focus:ring-primary/20 focus:border-primary outline-none text-slate-800 font-text text-sm shadow-sm transition-all text-center" type="number" min="0" max="17" placeholder="{{ __('Age') }}" value="${val}" required/>
                    </div>
                `;
                childrenAgesFields.insertAdjacentHTML('beforeend', fieldHTML);
            }
        });
        childrenInput.dispatchEvent(new Event('input'));
    }

    // Services UI Logic
    const accommodationCheckbox = document.querySelector('input[value="accommodation"]');
    const accommodationTypeContainer = document.getElementById('accommodation-type-container');

    if (accommodationCheckbox && accommodationTypeContainer) {
        accommodationCheckbox.addEventListener('change', function() {
            if (this.checked) accommodationTypeContainer.classList.remove('hidden');
            else accommodationTypeContainer.classList.add('hidden');
        });
        if (accommodationCheckbox.checked) accommodationTypeContainer.classList.remove('hidden');
    }

    const touristTripsCheckbox = document.querySelector('input[value="tourist_trips"]');
    const tripTypeContainer = document.getElementById('trip-type-container');

    if (touristTripsCheckbox && tripTypeContainer) {
        touristTripsCheckbox.addEventListener('change', function() {
            if (this.checked) tripTypeContainer.classList.remove('hidden');
            else tripTypeContainer.classList.add('hidden');
        });
        if (touristTripsCheckbox.checked) tripTypeContainer.classList.remove('hidden');
    }

    // Submission Logic
    async function submitForm() {
        btnNext.disabled = true;
        nextText.textContent = '{{ __("Sending...") }}';
        formMessage.classList.add('hidden');

        try {
            const formData = new FormData(form);
            const services = [];
            document.querySelectorAll('input[name="services[]"]:checked').forEach(c => services.push(c.value));
            formData.append('services', JSON.stringify(services));

            const response = await fetch('/{{ app()->getLocale() }}/inquiry', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                    'Accept': 'application/json',
                },
                body: formData,
            });

            if (!response.ok) {
                let errorMessage = '{{ __("An error occurred. Please try again.") }}';
                try {
                    const errorData = await response.json();
                    if (errorData.message) errorMessage = errorData.message;
                } catch (e) { } 
                throw new Error(errorMessage);
            }

            const data = await response.json();

            if (data.success) {
                formMessage.className = 'mt-8 text-center p-4 rounded-xl text-sm font-text border border-green-200 bg-green-50 text-green-700';
                formMessage.textContent = data.message || '{{ __("Inquiry submitted successfully!") }}';
                formMessage.classList.remove('hidden');

                setTimeout(() => {
                    if (data.whatsapp_url) {
                        window.location.href = data.whatsapp_url;
                    }
                    form.reset();
                    selectedDestinations = [];
                    renderSelectedDestinations();
                    currentStep = 1;
                    updateProgress();
                    showStep(currentStep, 'prev');
                    formMessage.classList.add('hidden');
                }, 1000);
            } else {
                throw new Error(data.message || '{{ __("An error occurred. Please try again.") }}');
            }
        } catch (error) {
            formMessage.className = 'mt-8 text-center p-4 rounded-xl text-sm font-text border border-red-200 bg-red-50 text-red-700';
            formMessage.textContent = error.message;
            formMessage.classList.remove('hidden');
        } finally {
            btnNext.disabled = false;
            nextText.textContent = '{{ __("Submit Inquiry") }}';
        }
    }
    
    // Initialize
    updateProgress();
});

function scrollCarousel(btn, direction) {
    const container = btn.parentElement.querySelector('.hide-scrollbar');
    if (!container) return;
    const scrollAmount = container.clientWidth * 0.8;
    container.scrollBy({ left: direction * scrollAmount, behavior: 'smooth' });
}
</script>
@endpush
@endsection

