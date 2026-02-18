@extends('layouts.app')

@section('title', 'Balkis Premium Group - عن المجموعة')

@php
    $aboutPage = $aboutPage ?? \App\Models\AboutPage::getCurrent();
@endphp

@push('styles')
<style type="text/css">
    .timeline-line {
        background: linear-gradient(to bottom, transparent, #C6A264, transparent);
    }
    .hero-gradient {
        background: linear-gradient(to top, rgba(248, 247, 246, 0.9) 0%, rgba(248, 247, 246, 0.2) 100%);
    }
</style>
@endpush

@section('content')
@if($aboutPage->is_hero_visible ?? true)
<section class="relative h-screen flex items-center justify-center overflow-hidden ">
    <div class="absolute inset-0">
        <img alt="Corporate Building" class="w-full h-full object-cover" src="{{ $aboutPage->hero_background_image_url }}"/>
        <div class="absolute inset-0 featured-overlay"></div>
    </div>
    <div class="relative z-10 text-center px-6">
        <div class="inline-block h-px w-20 bg-primary mb-8"></div>
        <h1 class="text-4xl md:text-7xl font-black text-white mb-6 font-almarai tracking-tight">
            <span class="text-primary font-heading">{{ $aboutPage->hero_title_highlight }}</span> {{ str_replace($aboutPage->hero_title_highlight, '', $aboutPage->hero_title) }}
        </h1>
        @if($aboutPage->hero_description)
            <p class="text-gray-300 text-lg md:text-xl max-w-2xl mx-auto font-light leading-relaxed">
                {{ $aboutPage->hero_description }}
            </p>
        @endif
    </div>
    <div class="absolute bottom-10 left-1/2 -translate-x-1/2 animate-bounce">
        <span class="material-symbols-outlined text-primary text-3xl">expand_more</span>
    </div>
</section>
@endif

@if($aboutPage->is_vision_mission_visible ?? true)
<section class="py-24 px-6 relative">
    <div class="max-w-7xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-12">
        <div class=" p-12 rounded-3xl relative overflow-hidden group bg-white border border-primary/40">
            <div class="absolute -top-10 -left-10 w-40 h-40 rounded-full blur-3xl"></div>
            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-primary/20 text-primary mb-8 group-hover:bg-primary group-hover:text-zinc-dark transition-all duration-500">
                <span class="material-symbols-outlined text-3xl">{{ $aboutPage->vision_icon }}</span>
            </div>
            <h3 class="text-2xl font-bold text-secondary mb-6">{{ $aboutPage->vision_title }}</h3>
            @if($aboutPage->vision_description)
                <p class="text-gray-400 leading-relaxed text-lg">
                    {{ $aboutPage->vision_description }}
                </p>
            @endif
        </div>
        <div class=" p-12 rounded-3xl relative overflow-hidden group bg-white border border-primary/40">
            <div class="absolute -top-10 -left-10 w-40 h-40  rounded-full blur-3xl"></div>
            <div class="flex h-16 w-16 items-center justify-center rounded-2xl bg-primary/20 text-primary mb-8 group-hover:bg-primary group-hover:text-zinc-dark transition-all duration-500">
                <span class="material-symbols-outlined text-3xl">{{ $aboutPage->mission_icon }}</span>
            </div>
            <h3 class="text-2xl font-bold text-secondary mb-6 ">{{ $aboutPage->mission_title }}</h3>
            @if($aboutPage->mission_description)
                <p class="text-gray-400 leading-relaxed text-lg">
                    {{ $aboutPage->mission_description }}
                </p>
            @endif
        </div>
    </div>
</section>
@endif

@if(($aboutPage->is_timeline_visible ?? true) && $aboutPage->timeline_items && count($aboutPage->timeline_items) > 0)
<section class="py-24 bg-white/50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-20">
            @if($aboutPage->timeline_badge)
                <span class="text-primary text-sm font-bold tracking-[0.3em] uppercase mb-4 block">{{ $aboutPage->timeline_badge }}</span>
            @endif
            <h2 class="text-3xl md:text-5xl font-bold text-secondary ">{{ $aboutPage->timeline_title }}</h2>
        </div>
        <div class="relative">
            <div class="absolute left-1/2 -translate-x-1/2 h-full w-px timeline-line hidden md:block"></div>
            <div class="space-y-24">
                @foreach($aboutPage->timeline_items as $index => $item)
                    <div class="relative flex flex-col md:flex-row items-center justify-between">
                        @if(($item['position'] ?? 'left') === 'left')
                            <div class="w-full md:w-[45%] text-right mb-8 md:mb-0">
                                <h4 class="text-primary text-2xl font-black mb-2">{{ $item['year'] ?? '' }}</h4>
                                <h5 class="text-secondary text-xl font-bold mb-4 font-almarai">{{ $item['title'] ?? '' }}</h5>
                                @if(isset($item['description']))
                                    <p class="text-gray-400 leading-relaxed">{{ $item['description'] }}</p>
                                @endif
                            </div>
                            <div class="absolute left-1/2 -translate-x-1/2 w-4 h-4 rounded-full bg-primary shadow-[0_0_15px_rgba(212,175,53,0.8)] z-10 hidden md:block"></div>
                            <div class="w-full md:w-[45%]"></div>
                        @else
                            <div class="w-full md:w-[45%] order-2 md:order-1"></div>
                            <div class="absolute left-1/2 -translate-x-1/2 w-4 h-4 rounded-full bg-primary shadow-[0_0_15px_rgba(212,175,53,0.8)] z-10 hidden md:block"></div>
                            <div class="w-full md:w-[45%] text-left order-1 md:order-2 mb-8 md:mb-0">
                                <h4 class="text-primary text-2xl font-black mb-2">{{ $item['year'] ?? '' }}</h4>
                                <h5 class="text-secondary text-xl font-bold mb-4 font-almarai">{{ $item['title'] ?? '' }}</h5>
                                @if(isset($item['description']))
                                    <p class="text-gray-400 leading-relaxed">{{ $item['description'] }}</p>
                                @endif
                            </div>
                        @endif
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>
@endif

@if(($aboutPage->is_values_visible ?? true) && $aboutPage->core_values && count($aboutPage->core_values) > 0)
<section class="py-24 px-6">
    <div class="max-w-7xl mx-auto">
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-5xl font-bold text-secondary  mb-6 text-center">{{ $aboutPage->values_title }}</h2>
            <div class="h-1 w-20 bg-primary mx-auto"></div>
        </div>
        <div class="flex flex-wrap justify-center gap-8">
            @foreach($aboutPage->core_values as $value)
                <div class="bg-white max-w-xs p-10 border border-primary/40 rounded-2xl hover:border-primary/30 hover:bg-primary/10 transition-all duration-300 text-center">
                <span class="material-symbols-outlined text-primary !text-5xl mb-6">{{ $value['icon'] ?? '' }}</span>
                    <h5 class="text-secondary text-xl mb-4 ">{{ $value['title'] ?? '' }}</h5>
                    @if(isset($value['description']))
                        <p class="text-gray-400 text-sm leading-relaxed">{{ $value['description'] }}</p>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if(($aboutPage->is_team_visible ?? true) && $aboutPage->team_members && count($aboutPage->team_members) > 0)
<section class="py-24 bg-white/50">
    <div class="max-w-7xl mx-auto px-6">
        <div class="text-center mb-16">
            @if($aboutPage->team_badge)
                <span class="text-primary text-sm font-bold tracking-[0.3em] uppercase mb-4 block">{{ $aboutPage->team_badge }}</span>
            @endif
            <h2 class="text-3xl md:text-5xl font-bold text-secondary">{{ $aboutPage->team_title }}</h2>
        </div>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-10">
            @foreach($aboutPage->team_members as $member)
                <div class="group relative overflow-hidden rounded-2xl">
                    @php
                        $imageUrl = $aboutPage->getTeamMemberImageUrl($member);
                    @endphp
                    @if($imageUrl)
                        <img alt="{{ $member['name'] ?? '' }}" class="w-full h-[450px] object-cover transition-transform duration-700 group-hover:scale-105" src="{{ $imageUrl }}"/>
                    @else
                        <div class="w-full h-[450px] bg-zinc-dark flex items-center justify-center">
                            <span class="material-symbols-outlined text-6xl text-gray-600">person</span>
                        </div>
                    @endif
                    <div class="absolute inset-0 featured-overlay from-bg-main via-transparent to-transparent opacity-90"></div>
                    <div class="absolute bottom-0 right-0 p-8 w-full text-right">
                        <h4 class="text-white text-2xl font-bold font-almarai mb-1">{{ $member['name'] ?? '' }}</h4>
                        <p class="text-primary font-medium tracking-wide">{{ $member['position'] ?? '' }}</p>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endif

@if($aboutPage->is_commitment_visible ?? true)
<section class="max-w-4xl mx-auto px-6 text-center pt-24 mb-24">
    @if($aboutPage->commitment_badge)
        <span class="text-primary text-sm font-bold tracking-[0.4em] uppercase mb-6 block">{{ $aboutPage->commitment_badge }}</span>
    @endif
    <h2 class="text-4xl md:text-5xl font-black text-secondary mb-8 font-almarai leading-tight">{{ $aboutPage->commitment_title }} <span class="text-primary font-heading">{{ $aboutPage->commitment_title_highlight }}</span></h2>
    @if($aboutPage->commitment_description)
        <p class="text-gray-400 text-lg md:text-xl font-light leading-relaxed">
            {{ $aboutPage->commitment_description }}
        </p>
    @endif
</section>
@endif

@if($aboutPage->commitment_sections && count($aboutPage->commitment_sections) > 0)
<section class="max-w-7xl mx-auto px-6">
    <div class="flex flex-wrap justify-center gap-8">
        @foreach($aboutPage->commitment_sections as $section)
            <div class=" p-10 rounded-2xl max-w-md relative bg-white border border-primary/40 overflow-hidden group hover:border-primary/30 transition-all duration-500">
                <div class="absolute -top-10 -right-10 w-32 h-32 bg-primary/5 rounded-full blur-2xl"></div>
                <div class="flex items-center gap-5 mb-8">
                    <div class="flex h-14 w-14 items-center justify-center rounded-xl bg-primary/10 text-primary group-hover:bg-primary group-hover:text-zinc-dark transition-colors duration-500">
                        <span class="material-symbols-outlined text-3xl">{{ $section['icon'] ?? '' }}</span>
                    </div>
                    <h3 class="text-2xl font-bold text-secondary font-almarai">{{ $section['title'] ?? '' }}</h3>
                </div>
                @if(isset($section['items']) && is_array($section['items']))
                    <ul class="space-y-4">
                        @foreach($section['items'] as $item)
                            <li class="flex items-start gap-3 text-gray-400">
                                <span class="text-primary mt-1 material-symbols-outlined text-sm">circle</span>
                                <span>{{ $item['text'] ?? '' }}</span>
                            </li>
                        @endforeach
                    </ul>
                @endif
            </div>
        @endforeach
    </div>
</section>
@endif

@if($aboutPage->is_compliance_visible ?? true)
<section class="max-w-7xl mx-auto px-6 pb-6 mt-24">
    <div class="border-2 border-primary/40 bg-white rounded-3xl p-8 md:p-12 flex flex-col md:flex-row items-center gap-10">
        <div class="flex-shrink-0">
            <div class="h-24 w-24 rounded-full border border-primary/30 flex items-center justify-center bg-zinc-dark shadow-[0_0_30px_rgba(212,175,53,0.15)]">
                <span class="material-symbols-outlined text-5xl text-primary">policy</span>
            </div>
        </div>
        <div class="flex-grow text-center {{ app()->getLocale() == 'ar' ? 'md:text-right' : 'md:text-left' }}">
            <h4 class="text-secondary text-2xl font-bold font-almarai mb-4">{{ $aboutPage->compliance_title }}</h4>
            @if($aboutPage->compliance_description)
                <p class="text-gray-400 leading-relaxed text-lg font-light">
                    {{ $aboutPage->compliance_description }}
                </p>
            @endif
        </div>
        <div class="flex-shrink-0">
            <div class="px-6 py-3 bg-primary text-white font-bold rounded-lg text-sm uppercase">{{ __('Officially Approved') }}</div>
        </div>
    </div>
</section>
@endif

@if($aboutPage->is_contact_visible ?? true)
<section class="max-w-4xl mx-auto px-6 mt-32 pb-6 text-center">
    <div class="inline-block h-px w-16 bg-primary/50 mb-8"></div>
    @if($aboutPage->contact_question)
        <h5 class="text-secondary text-xl font-bold font-almarai mb-6">{{ $aboutPage->contact_question }}</h5>
    @endif
    @if($aboutPage->contact_description)
        <p class="text-gray-400 mb-10">{{ $aboutPage->contact_description }}</p>
    @endif
    <a class="inline-flex items-center gap-3 text-primary border border-primary/20 hover:border-primary px-8 py-4 rounded-full transition-all group" href="mailto:{{ $aboutPage->compliance_email }}">
        <span>{{ __('Contact Compliance Department') }}</span>
        <span class="material-symbols-outlined group-hover:translate-x-[-4px] transition-transform">mail</span>
    </a>
</section>
@endif
@endsection
