@extends('layouts.app')

@section('title', 'صفحة مثال - Balkis Premium Group')

@section('content')
    <div class="container mx-auto px-6 lg:px-20 py-20">
        <h1 class="text-4xl font-bold text-white mb-8">صفحة مثال</h1>
        <p class="text-gray-300 text-lg">هذه صفحة مثال توضح كيفية استخدام Layout والمكونات في صفحات أخرى.</p>
    </div>
@endsection

{{-- يمكنك إزالة هذا القسم إذا لم ترد إظهار شريط الإحصائيات --}}
@section('showStatsBar')
    @include('components.stats-bar')
@endsection
