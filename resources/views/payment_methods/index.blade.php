@extends('layouts.app')

@push('title')
    <title>{{ __('Payment Methods') }} | {{ config('app.name', 'Balkis Travel') }}</title>
@endpush

@section('content')
<div class="bg-slate-50 min-h-screen pt-32 pb-16">
    <div class="max-w-7xl mx-auto px-4">
        <!-- Header -->
        <div class="text-center mb-16 relative z-10">
            <div class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-primary/10 text-primary font-bold text-sm mb-4">
                <span class="material-symbols-outlined text-[20px]">credit_card</span>
                {{ __('Secure Checkout') }}
            </div>
            
            <h1 class="text-4xl md:text-5xl font-bold text-slate-800 mb-6 font-heading">
                {{ __('Payment Methods') }}
            </h1>
            
            <p class="text-slate-600 text-lg md:text-xl max-w-3xl mx-auto font-text leading-relaxed">
                {{ __('We offer a variety of secure and convenient payment methods to fit your needs, making your booking process smooth and reliable.') }}
            </p>
        </div>

        <!-- Payment Methods List -->
        @if($paymentMethods->isEmpty())
            <div class="text-center py-16 bg-white rounded-3xl shadow-sm border border-slate-100">
                <span class="material-symbols-outlined text-6xl text-slate-300 mb-4 block">credit_card_off</span>
                <p class="text-slate-500 font-text text-lg">{{ __('No payment methods have been added yet.') }}</p>
            </div>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
                @foreach($paymentMethods as $method)
                    <div class="bg-white rounded-3xl p-8 shadow-sm border border-slate-100 hover:shadow-xl hover:-translate-y-1 transition-all duration-300 group overflow-hidden relative">
                        <!-- Decorative bg -->
                        <div class="absolute -top-12 -right-12 w-32 h-32 bg-primary/5 rounded-full blur-3xl group-hover:bg-primary/20 transition-colors duration-500 pointer-events-none"></div>
                        
                        <div class="relative z-10">
                            @if($method->icon)
                                <div class="h-16 flex items-center justify-start mb-6">
                                    <img src="{{ asset('storage/'.$method->icon) }}" alt="{{ $method->name }}" class="max-h-full max-w-[150px] object-contain drop-shadow-sm">
                                </div>
                            @else
                                <div class="w-16 h-16 rounded-2xl bg-slate-50 border border-slate-100 flex items-center justify-center mb-6">
                                    <span class="material-symbols-outlined text-3xl text-slate-400">payments</span>
                                </div>
                            @endif

                            <h3 class="text-xl font-bold text-slate-800 mb-3 font-heading group-hover:text-primary transition-colors">
                                {{ $method->name }}
                            </h3>

                            @if($method->description)
                                <p class="text-slate-600 font-text leading-relaxed text-sm">
                                    {{ $method->description }}
                                </p>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
        
        <!-- Trust badge or CTA section -->
        <div class="mt-20 bg-gradient-to-br from-primary to-primary-dark rounded-3xl p-8 md:p-12 shadow-lg text-white text-center relative overflow-hidden">
            <div class="absolute top-0 right-0 w-64 h-64 bg-white/10 rounded-full blur-3xl -translate-y-1/2 translate-x-1/3"></div>
            <div class="absolute bottom-0 left-0 w-64 h-64 bg-black/10 rounded-full blur-3xl translate-y-1/3 -translate-x-1/2"></div>
            
            <div class="relative z-10">
                <span class="material-symbols-outlined text-5xl mb-4 text-white/80">verified_user</span>
                <h4 class="text-2xl md:text-3xl font-bold mb-4 font-heading">{{ __('100% Secure Payments') }}</h4>
                <p class="opacity-90 max-w-2xl mx-auto font-text mb-8">
                    {{ __('Your payment security is our top priority. We use industry-standard encryption to protect your personal and financial data.') }}
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
