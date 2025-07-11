@extends('layouts.simple')

@push('head')
<link rel="stylesheet" href="/theme/modern-landing/css/modern-landing.css">
@php
    $heroBgType = setting('modern-landing-hero-bg-type', 'color');
    $heroBgColor = setting('modern-landing-hero-bg-color', '#f8fafc');
    $heroBgGradientStart = setting('modern-landing-hero-bg-gradient-start', '#f8fafc');
    $heroBgGradientEnd = setting('modern-landing-hero-bg-gradient-end', '#e2e8f0');
    $heroBgGradientDirection = setting('modern-landing-hero-bg-gradient-direction', 'to-right');
    $cards = json_decode(setting('modern-landing-cards', '[]'), true);
    
    if ($heroBgType === 'gradient') {
        $heroBackground = "linear-gradient({$heroBgGradientDirection}, {$heroBgGradientStart}, {$heroBgGradientEnd})";
    } else {
        $heroBackground = $heroBgColor;
    }
@endphp
<style>
.buffer-hero-section {
    background: {{ $heroBackground }} !important;
}
.dark-mode .buffer-hero-section {
    background: {{ $heroBackground }} !important;
}
</style>
@endpush

@section('body')

{{-- Buffer-Inspired Hero Section with Prominent Search --}}
<div class="buffer-hero-section py-xxxl">
    <div class="container small">
        <div class="hero-content text-center px-m">
            <h1 class="hero-title mb-m">{{ $heroTitle }}</h1>
            <p class="hero-subtitle text-muted mb-xl">{{ $heroSubtitle }}</p>
            
            
            {{-- Native Search Bar in Hero --}}
            <div class="hero-search-container mb-xl">
                <form component="global-search" action="{{ url('/search') }}" method="GET" class="search-box" role="search" tabindex="0">
                    <button id="hero-search-button"
                            refs="global-search@button"
                            type="submit" 
                            aria-label="Search" 
                            tabindex="-1">
                        @icon('search')
                    </button>
                    <input id="hero-search-input"
                           refs="global-search@input"
                           type="text"
                           name="term"
                           data-shortcut="global_search"
                           autocomplete="off"
                           aria-label="Search" 
                           placeholder="Search documentation, guides, and pages..."
                           value="">
                    <div refs="global-search@suggestions" class="global-search-suggestions card">
                        <div refs="global-search@loading" class="text-center px-m global-search-loading">
                            <div class="loading-container">
                                <div></div>
                                <div></div>
                                <div></div>
                            </div>
                        </div>
                        <div refs="global-search@suggestion-results" class="px-m"></div>
                        <button class="text-button card-footer-link" type="submit">View All</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

{{-- Customizable Category Grid --}}
<div class="buffer-categories-section py-xl">
    <div class="container">
        <div class="categories-grid">
            @if(!empty($cards) && count($cards) > 0)
                @foreach($cards as $card)
                    @php
                        $cardStyle = "
                            background-color: " . ($card['bg_color'] ?? '#ffffff') . " !important;
                            color: " . ($card['text_color'] ?? '#2d3748') . " !important;
                            border-radius: " . ($card['border_radius'] ?? 8) . "px !important;
                        ";
                        
                        // Determine link URL
                        $linkUrl = '#';
                        if (($card['link_type'] ?? 'internal') === 'external') {
                            $linkUrl = $card['link_external'] ?? '#';
                        } else {
                            $linkUrl = $card['link_internal'] ?? url('/search');
                        }
                    @endphp
                    
                    <a href="{{ $linkUrl }}" class="category-card" style="{{ $cardStyle }}">
                        <div class="category-icon">
                            @icon('book')
                        </div>
                        <h3 class="category-title" style="color: {{ $card['text_color'] ?? '#2d3748' }} !important;">
                            {{ $card['title'] ?? 'Untitled Card' }}
                        </h3>
                        <p class="category-description" style="color: {{ $card['text_color'] ?? '#4a5568' }} !important;">
                            {{ $card['description'] ?? 'No description provided.' }}
                        </p>
                        <span class="category-count" style="color: {{ $card['text_color'] ?? '#718096' }} !important;">
                            @if(($card['link_type'] ?? 'internal') === 'external')
                                External Link
                            @else
                                {{ $card['link_text'] ?? 'View Content' }}
                            @endif
                        </span>
                    </a>
                @endforeach
            @else
                {{-- Default cards if none configured --}}
                <a href="{{ url('/books') }}" class="category-card">
                    <div class="category-icon">
                        @icon('star')
                    </div>
                    <h3 class="category-title">Getting Started</h3>
                    <p class="category-description">New to BookStack? Start here for setup guides and basic usage.</p>
                    <span class="category-count">{{ $stats['books'] ?? 0 }} {{ $stats['books'] == 1 ? 'book' : 'books' }}</span>
                </a>
                
                <a href="{{ url('/books') }}" class="category-card">
                    <div class="category-icon">
                        @icon('book')
                    </div>
                    <h3 class="category-title">Recent Documentation</h3>
                    <p class="category-description">Recently updated books and documentation.</p>
                    <span class="category-count">{{ $recentBooks->count() }} recent {{ $recentBooks->count() == 1 ? 'book' : 'books' }}</span>
                </a>
                
                <a href="{{ url('/search') }}" class="category-card">
                    <div class="category-icon">
                        @icon('search')
                    </div>
                    <h3 class="category-title">Search & Discovery</h3>
                    <p class="category-description">Find specific information across all documentation.</p>
                    <span class="category-count">{{ $stats['pages'] ?? 0 }} {{ $stats['pages'] == 1 ? 'page' : 'pages' }} available</span>
                </a>
            @endif
        </div>
    </div>
</div>


@endsection

@push('body-class', 'buffer-landing-page')

@section('scripts')
<script src="/theme/modern-landing/js/modern-landing.js"></script>
@endsection