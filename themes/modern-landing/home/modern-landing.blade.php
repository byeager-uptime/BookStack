@extends('layouts.simple')

@section('head')
<link rel="stylesheet" href="/theme/modern-landing/css/modern-landing.css">
@endsection

@section('body')

<div class="modern-landing">
    {{-- Hero Section --}}
    <section class="hero-section">
        <div class="hero-content">
            <div class="hero-text">
                <h1 class="hero-title">{{ $heroTitle }}</h1>
                <p class="hero-subtitle">{{ $heroSubtitle }}</p>
                
                @if(!$isSignedIn)
                <div class="hero-actions">
                    <a href="{{ url('/register') }}" class="btn btn-primary btn-lg">Get Started</a>
                    <a href="{{ url('/login') }}" class="btn btn-outline btn-lg">Sign In</a>
                </div>
                @else
                <div class="hero-actions">
                    <a href="{{ url('/books') }}" class="btn btn-primary btn-lg">Browse Books</a>
                    @if(user()->can('book-create-all'))
                    <a href="{{ url('/create-book') }}" class="btn btn-outline btn-lg">Create Book</a>
                    @endif
                </div>
                @endif
            </div>
            
            <div class="hero-visual">
                <div class="hero-cards">
                    <div class="floating-card card-1">
                        <div class="card-icon">📚</div>
                        <div class="card-title">Knowledge Base</div>
                    </div>
                    <div class="floating-card card-2">
                        <div class="card-icon">📝</div>
                        <div class="card-title">Documentation</div>
                    </div>
                    <div class="floating-card card-3">
                        <div class="card-icon">🔍</div>
                        <div class="card-title">Search & Discover</div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Stats Section --}}
    @if($showStats)
    <section class="stats-section">
        <div class="container">
            <div class="stats-grid">
                <div class="stat-card">
                    <div class="stat-number">{{ number_format($stats['books']) }}</div>
                    <div class="stat-label">{{ trans_choice('entities.books', $stats['books']) }}</div>
                </div>
                <div class="stat-card">
                    <div class="stat-number">{{ number_format($stats['pages']) }}</div>
                    <div class="stat-label">{{ trans_choice('entities.pages', $stats['pages']) }}</div>
                </div>
                @if($stats['users'])
                <div class="stat-card">
                    <div class="stat-number">{{ number_format($stats['users']) }}</div>
                    <div class="stat-label">{{ trans_choice('common.users', $stats['users']) }}</div>
                </div>
                @endif
            </div>
        </div>
    </section>
    @endif

    {{-- Featured Books Section --}}
    @if($showFeatured && $featuredBooks->count() > 0)
    <section class="featured-section">
        <div class="container">
            <h2 class="section-title">Featured Collections</h2>
            <div class="featured-grid">
                @foreach($featuredBooks as $book)
                <div class="featured-card">
                    @if($book->cover)
                    <div class="featured-image">
                        <img src="{{ $book->getBookCover() }}" alt="{{ $book->name }}">
                    </div>
                    @else
                    <div class="featured-placeholder">
                        @icon('book')
                    </div>
                    @endif
                    
                    <div class="featured-content">
                        <h3 class="featured-title">
                            <a href="{{ $book->getUrl() }}">{{ $book->name }}</a>
                        </h3>
                        @if($book->description)
                        <p class="featured-description">{{ Str::limit($book->description, 120) }}</p>
                        @endif
                        <div class="featured-meta">
                            <span class="pages-count">{{ $book->pages->count() }} {{ trans_choice('entities.pages', $book->pages->count()) }}</span>
                            <span class="updated-date">{{ $book->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Recent Books Section --}}
    @if($showRecentBooks && $recentBooks->count() > 0)
    <section class="recent-section">
        <div class="container">
            <div class="section-header">
                <h2 class="section-title">
                    @if($isSignedIn)
                    Recent Activity
                    @else
                    Explore Our Library
                    @endif
                </h2>
                <a href="{{ url('/books') }}" class="section-link">View All Books →</a>
            </div>
            
            <div class="books-grid">
                @foreach($recentBooks as $book)
                <div class="book-card">
                    <div class="book-cover">
                        @if($book->cover)
                        <img src="{{ $book->getBookCover() }}" alt="{{ $book->name }}">
                        @else
                        <div class="book-placeholder">
                            @icon('book')
                        </div>
                        @endif
                    </div>
                    
                    <div class="book-info">
                        <h4 class="book-title">
                            <a href="{{ $book->getUrl() }}">{{ $book->name }}</a>
                        </h4>
                        @if($book->description)
                        <p class="book-description">{{ Str::limit(strip_tags($book->description), 80) }}</p>
                        @endif
                        <div class="book-meta">
                            <span class="book-pages">{{ $book->pages->count() }} pages</span>
                            <span class="book-updated">Updated {{ $book->updated_at->diffForHumans() }}</span>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    @endif

    {{-- Features Section --}}
    <section class="features-section">
        <div class="container">
            <h2 class="section-title">Why Choose BookStack?</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📖</div>
                    <h3 class="feature-title">Organize Knowledge</h3>
                    <p class="feature-description">Structure your content with books, chapters, and pages for easy navigation and organization.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">🔍</div>
                    <h3 class="feature-title">Powerful Search</h3>
                    <p class="feature-description">Find exactly what you need with full-text search across all your documentation.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">👥</div>
                    <h3 class="feature-title">Collaborate</h3>
                    <p class="feature-description">Work together with role-based permissions and real-time collaborative editing.</p>
                </div>
                
                <div class="feature-card">
                    <div class="feature-icon">🎨</div>
                    <h3 class="feature-title">Rich Content</h3>
                    <p class="feature-description">Create beautiful documentation with our WYSIWYG editor and markdown support.</p>
                </div>
            </div>
        </div>
    </section>

    {{-- Call to Action --}}
    @if(!$isSignedIn)
    <section class="cta-section">
        <div class="container">
            <div class="cta-content">
                <h2 class="cta-title">Ready to Get Started?</h2>
                <p class="cta-subtitle">Join thousands of teams already using BookStack to organize their knowledge.</p>
                <div class="cta-actions">
                    <a href="{{ url('/register') }}" class="btn btn-primary btn-lg">Create Account</a>
                    <a href="{{ url('/login') }}" class="btn btn-outline btn-lg">Sign In</a>
                </div>
            </div>
        </div>
    </section>
    @endif
</div>

@endsection

@section('body-class', 'modern-landing-page')

@section('scripts')
<script src="/theme/modern-landing/js/modern-landing.js"></script>
@endsection