@extends('layouts.app')

@section('title', __('Plan Your Luxury Trip') . ' - Balkis Premium Group')

@section('content')

<main class="pt-20">
    <!-- Hero Section -->
    <section class="relative h-[60vh] min-h-[450px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" alt="{{ __('Plan Your Luxury Trip') }}" src="https://lh3.googleusercontent.com/aida-public/AB6AXuBz7zQeslWol7BwQtaU6kgqnM8edplkZ40Jjr3uSXEoaiz1gq9UTqLwPrCY0h_wO5-8mB8-uTkgtzMrVgYb9dYFKC38po42p7juOSSdi5hAD3Vcf0C10YcDULxCtmUw6pPDN4pCYAKXSPr9teZhLWYuVWtW9jjiSNhocYEOuGxnVNHdIyt8Ao_OkDqNA3M0Agym1JremIueO2oARML2QaSJGqD6BRpEaxDf1SMA13_WhOUKaAenqppOvCDoYcttebx-15RFDjH5yoQU"/>
            <div class="absolute inset-0 bg-gradient-to-b from-background-dark/40 via-background-dark/60 to-background-dark"></div>
        </div>
        <div class="relative z-10 text-center px-4 max-w-4xl">
            <h2 class="text-white text-4xl md:text-6xl font-bold mb-6 leading-tight font-heading">{{ __('Plan Your Luxury Trip') }}</h2>
            <p class="text-slate-300 text-lg md:text-xl font-light max-w-2xl mx-auto font-text">
                {{ __('We design exceptional travel experiences that exceed your expectations, where luxury meets authenticity in the heart of Turkey.') }}
            </p>
        </div>
    </section>

    <!-- Main Selection Form Card -->
    <section class="max-w-5xl mx-auto px-6 -mt-32 relative z-20 pb-20">
        <div class="bg-white rounded-xl shadow-2xl border border-white/5 p-8 md:p-12">
            <div class="mb-10 text-center">
                <h3 class="text-2xl font-bold text-secondary mb-2 font-heading">{{ __('Customize Tourism Services') }}</h3>
                <div class="w-20 h-1 bg-primary mx-auto rounded-full"></div>
            </div>
            
            <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Destination Selection -->
                <div class="col-span-full">
                    <label class="block text-sm font-medium text-slate-500  mb-3 font-text">{{ __('Required Destinations (You can select multiple cities)') }}</label>
                    <div class="flex flex-wrap gap-3 p-4 border border-slate-200  rounded-lg bg-slate-100 ">
                        <button class="flex items-center gap-2 px-4 py-2 bg-primary/10 border border-primary text-primary rounded-lg text-sm font-text">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            {{ __('Istanbul') }}
                            <span class="material-symbols-outlined text-xs">close</span>
                        </button>
                        <button class="flex items-center gap-2 px-4 py-2 bg-primary/10 border border-primary text-primary rounded-lg text-sm font-text">
                            <span class="material-symbols-outlined text-sm">location_on</span>
                            {{ __('Trabzon') }}
                            <span class="material-symbols-outlined text-xs">close</span>
                        </button>
                        <button class="flex items-center gap-2 px-4 py-2 bg-slate-200  text-slate-600  rounded-lg text-sm hover:bg-primary/20 hover:text-primary transition-all font-text">
                            <span class="material-symbols-outlined text-sm">add</span>
                            {{ __('Add City') }}
                        </button>
                    </div>
                </div>

                <!-- Guest Count -->
                <div>
                    <label class="block text-sm font-medium text-slate-500  mb-3 font-text">{{ __('Number of Travelers') }}</label>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="relative">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-primary">person</span>
                            <input class="w-full pr-12 pl-4 py-4 bg-slate-50 border border-slate-200  rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none text-slate-800  font-text " placeholder="0" type="number" value="2" min="0" max="40"/>
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[10px] text-slate-400 font-text mx-6">{{ __('Adults') }}</span>
                        </div>
                        <div class="relative">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-primary">child_care</span>
                            <input class="w-full pr-12 pl-4 py-4 bg-slate-50  border border-slate-200  rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none text-slate-800  font-text" placeholder="0" type="number" min="0" max="20"/>
                            <span class="absolute left-4 top-1/2 -translate-y-1/2 text-[10px] text-slate-400 font-text mx-6">{{ __('Children') }}</span>
                        </div>
                    </div>
                </div>

                <!-- Dates -->
                <div>
                    <label class="block text-sm font-medium text-slate-500  mb-3 font-text">{{ __('Trip Dates') }}</label>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="date-input-wrapper relative">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-primary pointer-events-none z-10">calendar_today</span>
                            <input 
                                id="arrival-date"
                                name="arrival_date"
                                class="date-input w-full pr-12 pl-4 py-4 bg-slate-50 border border-slate-200 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none text-slate-800 font-text" 
                                type="date"
                                min="{{ date('Y-m-d') }}"
                                required
                            />
                        </div>
                        <div class="date-input-wrapper relative">
                            <span class="absolute right-4 top-1/2 -translate-y-1/2 material-symbols-outlined text-primary pointer-events-none z-10">event</span>
                            <input 
                                id="departure-date"
                                name="departure_date"
                                class="date-input w-full pr-12 pl-4 py-4 bg-slate-50 border border-slate-200 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none text-slate-800 font-text" 
                                type="date"
                                min="{{ date('Y-m-d') }}"
                                required
                            />
                        </div>
                    </div>
                </div>

                <!-- Service Selection Grid -->
                <div class="col-span-full mt-6">
                    <label class="block text-sm font-medium text-slate-500  mb-4 font-text">{{ __('Select Required Services') }}</label>
                    <div class="grid grid-cols-2 md:grid-cols-4 gap-4">
                        <label class="relative service-card cursor-pointer group flex flex-col items-center justify-center p-6 border border-slate-200 rounded-xl transition-all duration-300">
                            <input checked="" class="hidden peer" type="checkbox"/>
                            <div class="peer-checked:bg-primary/20 w-full rounded-xl h-full absolute top-0 left-0"></div>
                            <div class="size-14 rounded-full bg-slate-100  flex items-center justify-center mb-4 group-hover:bg-primary/20 transition-colors peer-checked:bg-primary/20">
                                <span class="material-symbols-outlined text-3xl text-slate-400 group-hover:text-primary transition-colors peer-checked:text-primary">flight_takeoff</span>
                            </div>
                            <span class="text-sm font-bold text-slate-600   peer-checked:text-primary font-text">{{ __('Flight') }}</span>
                        </label>
                        <label class="relative service-card cursor-pointer group flex flex-col items-center justify-center p-6 border border-slate-200  rounded-xl transition-all duration-300">
                            <input checked="" class="hidden peer" type="checkbox"/>
                            <div class="peer-checked:bg-primary/20 w-full rounded-xl h-full absolute top-0 left-0"></div>
                            <div class="size-14 rounded-full bg-slate-100  flex items-center justify-center mb-4 group-hover:bg-primary/20 transition-colors peer-checked:bg-primary/20">
                                <span class="material-symbols-outlined text-3xl text-slate-400 group-hover:text-primary transition-colors peer-checked:text-primary">hotel</span>
                            </div>
                            <span class="text-sm font-bold text-slate-600  peer-checked:text-primary font-text">{{ __('Accommodation') }}</span>
                        </label>
                        <label class="relative service-card cursor-pointer group flex flex-col items-center justify-center p-6 border border-slate-200  rounded-xl transition-all duration-300">
                            <input class="hidden peer" type="checkbox"/>
                            <div class="peer-checked:bg-primary/20 w-full rounded-xl h-full absolute top-0 left-0"></div>
                            <div class="size-14 rounded-full bg-slate-100  flex items-center justify-center mb-4 group-hover:bg-primary/20 transition-colors peer-checked:bg-primary/20">
                                <span class="material-symbols-outlined text-3xl text-slate-400 group-hover:text-primary transition-colors peer-checked:text-primary">directions_car</span>
                            </div>
                            <span class="text-sm font-bold text-slate-600  peer-checked:text-primary font-text">{{ __('Car Rental') }}</span>
                        </label>
                        <label class="relative service-card cursor-pointer group flex flex-col items-center justify-center p-6 border border-slate-200  rounded-xl transition-all duration-300">
                            <input class="hidden peer" type="checkbox"/>
                            <div class="peer-checked:bg-primary/20 w-full rounded-xl h-full absolute top-0 left-0"></div>
                            <div class="size-14 rounded-full bg-slate-100  flex items-center justify-center mb-4 group-hover:bg-primary/20 transition-colors peer-checked:bg-primary/20">
                                <span class="material-symbols-outlined text-3xl text-slate-400 group-hover:text-primary transition-colors peer-checked:text-primary">map</span>
                            </div>
                            <span class="text-sm font-bold text-slate-600  peer-checked:text-primary font-text">{{ __('Tourist Trips') }}</span>
                        </label>
                    </div>
                </div>

                <!-- CTA Button -->
                <div class="col-span-full mt-10">
                    <button class="w-full py-5 hover:brightness-110 bg-gold-gradient hover:shadow-lg hover:shadow-primary/20 transition-all rounded-lg text-white text-lg font-bold flex items-center justify-center gap-3 font-heading">
                        <span class="material-symbols-outlined">send</span>
                        {{ __('Submit Inquiry') }}
                    </button>
                    <p class="text-center text-slate-400 text-xs mt-4 font-text">
                        {{ __('Once submitted, one of our consultants will contact you within 24 hours.') }}
                    </p>
                </div>
            </div>
        </div>
    </section>
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
    .date-input {
        position: relative;
        cursor: pointer;
    }
    
    /* Hide the default calendar picker icon */
    .date-input::-webkit-calendar-picker-indicator {
        display: none;
        opacity: 0;
        width: 0;
        height: 0;
        position: absolute;
        right: 0;
        cursor: pointer;
    }
    
    /* Hide spinner buttons */
    .date-input::-webkit-inner-spin-button,
    .date-input::-webkit-clear-button {
        display: none;
        -webkit-appearance: none;
        appearance: none;
    }
    
    /* Firefox - Hide calendar icon */
    .date-input[type="date"] {
        -moz-appearance: textfield;
    }
    
    .date-input[type="date"]::-moz-calendar-picker-indicator {
        display: none;
    }
    
    /* Ensure the input text is visible */
    .date-input[type="date"] {
        color: rgb(30, 41, 59);
    }
    
    .date-input[type="date"]:invalid {
        color: rgb(148, 163, 184);
    }
    
    /* Firefox placeholder */
    .date-input[type="date"]::-moz-placeholder {
        color: rgb(148, 163, 184);
    }
    
    /* Ensure the icon doesn't block clicks */
    .date-input-wrapper {
        position: relative;
    }
    
    .date-input-wrapper .material-symbols-outlined {
        pointer-events: none;
        z-index: 1;
    }
</style>
@endpush
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const arrivalDateInput = document.getElementById('arrival-date');
    const departureDateInput = document.getElementById('departure-date');
    
    // Set minimum date for departure to be after arrival
    if (arrivalDateInput && departureDateInput) {
        arrivalDateInput.addEventListener('change', function() {
            if (this.value) {
                const arrivalDate = new Date(this.value);
                arrivalDate.setDate(arrivalDate.getDate() + 1);
                const minDepartureDate = arrivalDate.toISOString().split('T')[0];
                departureDateInput.min = minDepartureDate;
                
                // If departure date is before arrival date, clear it
                if (departureDateInput.value && departureDateInput.value < this.value) {
                    departureDateInput.value = '';
                }
            }
        });
        
        departureDateInput.addEventListener('change', function() {
            if (this.value && arrivalDateInput.value && this.value < arrivalDateInput.value) {
                alert('{{ __("Departure date must be after arrival date") }}');
                this.value = '';
            }
        });
        
        // Ensure date picker opens on click anywhere on the input
        arrivalDateInput.addEventListener('click', function(e) {
            // Allow the default behavior to open the date picker
            this.showPicker?.();
        });
        
        departureDateInput.addEventListener('click', function(e) {
            // Allow the default behavior to open the date picker
            this.showPicker?.();
        });
    }
});
</script>
@endpush
@endsection

