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
    <section class="relative h-[60vh] min-h-[450px] flex items-center justify-center overflow-hidden">
        <div class="absolute inset-0">
            <img class="w-full h-full object-cover" alt="{{ __('Plan Your Luxury Trip') }}" src="{{ $mainBgImage }}"/>
            <div class="absolute inset-0 bg-gradient-to-b from-background-dark/40 via-background-dark/60 to-background-dark"></div>
        </div>
        <div class="relative z-10 text-center px-4 max-w-4xl">
            <h2 class="text-white text-4xl md:text-6xl font-bold mb-6 leading-tight font-heading">{{ $homePage->main_title }}</h2>
            <p class="text-slate-300 text-lg md:text-xl font-light max-w-2xl mx-auto font-text">
                {{ $homePage->main_description }}
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
            
            <form id="inquiry-form" class="grid grid-cols-1 md:grid-cols-2 gap-8">
                <!-- Destination Selection -->
                <div class="col-span-full">
                    <label class="block text-sm font-medium text-slate-500  mb-3 font-text">{{ __('Required Destinations (You can select multiple cities)') }}</label>
                    <div id="destinations-container" class="flex flex-wrap gap-3 p-4 border border-slate-200  rounded-lg bg-slate-100 min-h-[60px]">
                        <!-- Selected destinations will be added here dynamically -->
                    </div>
                    <div class="mt-3 relative">
                        <button 
                            type="button"
                            id="add-destination-btn"
                            class="flex items-center gap-2 px-4 py-2 bg-slate-200 text-slate-600 rounded-lg text-sm hover:bg-primary/20 hover:text-primary transition-all font-text"
                        >
                            <span class="material-symbols-outlined text-sm">add</span>
                            {{ __('Add City') }}
                        </button>
                        <!-- Dropdown for available destinations -->
                        <div id="destinations-dropdown" class="hidden absolute top-full left-0 mt-2 w-full bg-white border border-slate-200 rounded-lg shadow-lg z-50 max-h-60 overflow-y-auto">
                            @if(count($availableDestinations) > 0)
                                @foreach($availableDestinations as $destination)
                                    <button 
                                        type="button"
                                        class="destination-option w-full text-right px-4 py-2 hover:bg-primary/10 hover:text-primary transition-colors font-text"
                                        data-destination="{{ $destination['name'] ?? '' }}"
                                    >
                                        <span class="material-symbols-outlined text-sm align-middle">location_on</span>
                                        {{ $destination['name'] ?? '' }}
                                    </button>
                                @endforeach
                            @else
                                <div class="px-4 py-2 text-slate-500 text-sm font-text">
                                    {{ __('No destinations available') }}
                                </div>
                            @endif
                        </div>
                    </div>
                    <!-- Hidden input to store selected destinations -->
                    <input type="hidden" id="selected-destinations" name="selected_destinations" value="">
                </div>

                <!-- Guest Count -->
                <div>
                    <label class="block text-sm font-medium text-slate-500  mb-3 font-text">{{ __('Number of Travelers') }}</label>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="relative">
                            <label class="block text-xs font-medium text-slate-400 mb-1 font-text">{{ __('Adults') }}</label>
                            <span class="absolute right-4 top-[calc(50%+12px)] -translate-y-1/2 material-symbols-outlined text-primary">person</span>
                            <input name="adults" id="adults" class="w-full pr-12 pl-4 py-4 bg-slate-50 border border-slate-200  rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none text-slate-800  font-text " placeholder="0" type="number" value="2" min="0" max="40" required/>
                        </div>
                        <div class="relative">
                            <label class="block text-xs font-medium text-slate-400 mb-1 font-text">{{ __('Children') }}</label>
                            <span class="absolute right-4 top-[calc(50%+12px)] -translate-y-1/2 material-symbols-outlined text-primary">child_care</span>
                            <input name="children" id="children" class="w-full pr-12 pl-4 py-4 bg-slate-50  border border-slate-200  rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none text-slate-800  font-text" placeholder="0" type="number" value="0" min="0" max="20" required/>
                        </div>
                    </div>
                </div>

                <!-- Dates -->
                <div>
                    <label class="block text-sm font-medium text-slate-500  mb-3 font-text">{{ __('Trip Dates') }}</label>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="date-input-wrapper relative">
                            <label class="block text-xs font-medium text-slate-400 mb-1 font-text">{{ __('From Date') }}</label>
                            <span class="absolute right-4 top-[calc(50%+12px)] -translate-y-1/2 material-symbols-outlined text-primary pointer-events-none z-10">calendar_today</span>
                            <input 
                                id="arrival-date"
                                name="arrival_date"
                                class="date-input w-full pr-12 pl-4 py-4 bg-slate-50 border border-slate-200 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none text-slate-800 font-text" 
                                type="date"
                                min="{{ date('Y-m-d') }}"
                                placeholder="{{ __('From Date') }}"
                                required
                            />
                        </div>
                        <div class="date-input-wrapper relative">
                            <label class="block text-xs font-medium text-slate-400 mb-1 font-text">{{ __('To Date') }}</label>
                            <span class="absolute right-4 top-[calc(50%+12px)] -translate-y-1/2 material-symbols-outlined text-primary pointer-events-none z-10">event</span>
                            <input 
                                id="departure-date"
                                name="departure_date"
                                class="date-input w-full pr-12 pl-4 py-4 bg-slate-50 border border-slate-200 rounded-lg focus:ring-1 focus:ring-primary focus:border-primary outline-none text-slate-800 font-text" 
                                type="date"
                                min="{{ date('Y-m-d') }}"
                                placeholder="{{ __('To Date') }}"
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
                            <input name="services[]" value="flight" checked="" class="hidden peer" type="checkbox"/>
                            <div class="peer-checked:bg-primary/20 w-full rounded-xl h-full absolute top-0 left-0"></div>
                            <div class="size-14 rounded-full bg-slate-100  flex items-center justify-center mb-4 group-hover:bg-primary/20 transition-colors peer-checked:bg-primary/20">
                                <span class="material-symbols-outlined text-3xl text-slate-400 group-hover:text-primary transition-colors peer-checked:text-primary">flight_takeoff</span>
                            </div>
                            <span class="text-sm font-bold text-slate-600   peer-checked:text-primary font-text">{{ __('Flight') }}</span>
                        </label>
                        <label class="relative service-card cursor-pointer group flex flex-col items-center justify-center p-6 border border-slate-200  rounded-xl transition-all duration-300">
                            <input name="services[]" value="accommodation" checked="" class="hidden peer" type="checkbox"/>
                            <div class="peer-checked:bg-primary/20 w-full rounded-xl h-full absolute top-0 left-0"></div>
                            <div class="size-14 rounded-full bg-slate-100  flex items-center justify-center mb-4 group-hover:bg-primary/20 transition-colors peer-checked:bg-primary/20">
                                <span class="material-symbols-outlined text-3xl text-slate-400 group-hover:text-primary transition-colors peer-checked:text-primary">hotel</span>
                            </div>
                            <span class="text-sm font-bold text-slate-600  peer-checked:text-primary font-text">{{ __('Accommodation') }}</span>
                        </label>
                        <label class="relative service-card cursor-pointer group flex flex-col items-center justify-center p-6 border border-slate-200  rounded-xl transition-all duration-300">
                            <input name="services[]" value="car_rental" class="hidden peer" type="checkbox"/>
                            <div class="peer-checked:bg-primary/20 w-full rounded-xl h-full absolute top-0 left-0"></div>
                            <div class="size-14 rounded-full bg-slate-100  flex items-center justify-center mb-4 group-hover:bg-primary/20 transition-colors peer-checked:bg-primary/20">
                                <span class="material-symbols-outlined text-3xl text-slate-400 group-hover:text-primary transition-colors peer-checked:text-primary">directions_car</span>
                            </div>
                            <span class="text-sm font-bold text-slate-600  peer-checked:text-primary font-text">{{ __('Car Rental') }}</span>
                        </label>
                        <label class="relative service-card cursor-pointer group flex flex-col items-center justify-center p-6 border border-slate-200  rounded-xl transition-all duration-300">
                            <input name="services[]" value="tourist_trips" class="hidden peer" type="checkbox"/>
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
                    <button type="submit" id="submit-inquiry-btn" class="w-full py-5 hover:brightness-110 bg-gold-gradient hover:shadow-lg hover:shadow-primary/20 transition-all rounded-lg text-white text-lg font-bold flex items-center justify-center gap-3 font-heading">
                        <span class="material-symbols-outlined">send</span>
                        <span id="submit-btn-text">{{ __('Submit Inquiry') }}</span>
                    </button>
                    <p class="text-center text-slate-400 text-xs mt-4 font-text">
                        {{ __('Once submitted, one of our consultants will contact you within 24 hours.') }}
                    </p>
                    <div id="form-message" class="hidden mt-4 text-center text-sm font-text"></div>
                </div>
            </form>
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
    // Date picker functionality
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
            this.showPicker?.();
        });
        
        departureDateInput.addEventListener('click', function(e) {
            this.showPicker?.();
        });
    }

    // Destinations management
    const destinationsContainer = document.getElementById('destinations-container');
    const addDestinationBtn = document.getElementById('add-destination-btn');
    const destinationsDropdown = document.getElementById('destinations-dropdown');
    const selectedDestinationsInput = document.getElementById('selected-destinations');
    let selectedDestinations = [];

    // Function to update hidden input
    function updateSelectedDestinationsInput() {
        selectedDestinationsInput.value = JSON.stringify(selectedDestinations);
    }

    // Function to update dropdown options (hide already selected)
    function updateDropdownOptions() {
        const options = document.querySelectorAll('.destination-option');
        options.forEach(option => {
            const destinationName = option.dataset.destination;
            if (selectedDestinations.includes(destinationName)) {
                option.style.display = 'none';
            } else {
                option.style.display = 'block';
            }
        });
    }

    // Function to render selected destinations
    function renderSelectedDestinations() {
        destinationsContainer.innerHTML = '';
        selectedDestinations.forEach((destination, index) => {
            const destinationTag = document.createElement('button');
            destinationTag.type = 'button';
            destinationTag.className = 'flex items-center gap-2 px-4 py-2 bg-primary/10 border border-primary text-primary rounded-lg text-sm font-text destination-tag';
            destinationTag.dataset.index = index;
            destinationTag.innerHTML = `
                <span class="material-symbols-outlined text-sm">location_on</span>
                ${destination}
                <span class="material-symbols-outlined text-xs destination-remove">close</span>
            `;
            
            // Add remove functionality
            const removeBtn = destinationTag.querySelector('.destination-remove');
            removeBtn.addEventListener('click', function(e) {
                e.stopPropagation();
                removeDestination(index);
            });
            
            destinationsContainer.appendChild(destinationTag);
        });
        updateSelectedDestinationsInput();
        updateDropdownOptions();
    }

    // Function to add destination
    function addDestination(destinationName) {
        if (destinationName && !selectedDestinations.includes(destinationName)) {
            selectedDestinations.push(destinationName);
            renderSelectedDestinations();
            destinationsDropdown.classList.add('hidden');
        }
    }

    // Function to remove destination
    function removeDestination(index) {
        selectedDestinations.splice(index, 1);
        renderSelectedDestinations();
    }

    // Toggle dropdown
    addDestinationBtn.addEventListener('click', function(e) {
        e.stopPropagation();
        destinationsDropdown.classList.toggle('hidden');
    });

    // Close dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!addDestinationBtn.contains(e.target) && !destinationsDropdown.contains(e.target)) {
            destinationsDropdown.classList.add('hidden');
        }
    });

    // Handle destination selection from dropdown
    const destinationOptions = document.querySelectorAll('.destination-option');
    destinationOptions.forEach(option => {
        option.addEventListener('click', function() {
            const destinationName = this.dataset.destination;
            addDestination(destinationName);
        });
    });

    // Initialize dropdown options on load
    updateDropdownOptions();

    // Form submission
    const inquiryForm = document.getElementById('inquiry-form');
    const submitBtn = document.getElementById('submit-inquiry-btn');
    const submitBtnText = document.getElementById('submit-btn-text');
    const formMessage = document.getElementById('form-message');

    if (inquiryForm) {
        inquiryForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            // Disable submit button
            submitBtn.disabled = true;
            submitBtnText.textContent = '{{ __("Sending...") }}';

            // Collect form data
            const formData = new FormData(inquiryForm);
            
            // Get selected services
            const services = [];
            document.querySelectorAll('input[name="services[]"]:checked').forEach(checkbox => {
                services.push(checkbox.value);
            });
            formData.append('services', JSON.stringify(services));

            try {
                const response = await fetch('{{ route("inquiry.submit", ["locale" => app()->getLocale()]) }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.getAttribute('content') || '',
                        'Accept': 'application/json',
                    },
                    body: formData,
                });

                const data = await response.json();

                if (data.success) {
                    formMessage.className = 'mt-4 text-center text-sm font-text text-green-600';
                    formMessage.textContent = data.message || '{{ __("Inquiry submitted successfully!") }}';
                    formMessage.classList.remove('hidden');

                    // Redirect to WhatsApp after 1 second
                    setTimeout(() => {
                        if (data.whatsapp_url) {
                            window.open(data.whatsapp_url, '_blank');
                        }
                        inquiryForm.reset();
                        selectedDestinations = [];
                        renderSelectedDestinations();
                        formMessage.classList.add('hidden');
                    }, 1000);
                } else {
                    formMessage.className = 'mt-4 text-center text-sm font-text text-red-600';
                    formMessage.textContent = data.message || '{{ __("An error occurred. Please try again.") }}';
                    formMessage.classList.remove('hidden');
                }
            } catch (error) {
                formMessage.className = 'mt-4 text-center text-sm font-text text-red-600';
                formMessage.textContent = '{{ __("An error occurred. Please try again.") }}';
                formMessage.classList.remove('hidden');
            } finally {
                submitBtn.disabled = false;
                submitBtnText.textContent = '{{ __("Submit Inquiry") }}';
            }
        });
    }
});
</script>
@endpush
@endsection

