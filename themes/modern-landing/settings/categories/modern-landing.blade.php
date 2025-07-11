@extends('settings.layout')

@section('card')
<div class="card content-wrap auto-height">
    <h1 class="list-heading">{{ trans('Modern Landing Page Settings') }}</h1>
    
    <form action="{{ url('/settings/modern-landing') }}" method="post">
        @csrf
        
        {{-- Enable Modern Landing --}}
        <div class="setting-list">
            <div class="grid half gap-xl">
                <div>
                    <label class="setting-list-label">Enable Modern Landing Page</label>
                    <p class="small">Replace the default homepage with a modern landing page design.</p>
                </div>
                <div class="setting-list-value">
                    @include('form.toggle-switch', [
                        'name' => 'modern-landing-enabled',
                        'value' => old('modern-landing-enabled') ?? setting('modern-landing-enabled', false),
                        'label' => 'Enable modern landing page'
                    ])
                    <div class="text-small text-muted mt-xs">
                        Note: You'll also need to set "Application Homepage" to "Modern Landing" in the Customization settings.
                    </div>
                </div>
            </div>
        </div>

        {{-- Hero Section Settings --}}
        <div class="setting-list">
            <h3>Hero Section</h3>
            
            <div class="grid half gap-xl">
                <div>
                    <label class="setting-list-label">Hero Title</label>
                    <p class="small">Main heading displayed in the hero section.</p>
                </div>
                <div class="setting-list-value">
                    @include('form.text', [
                        'name' => 'modern-landing-hero-title',
                        'value' => old('modern-landing-hero-title') ?? setting('modern-landing-hero-title', 'Welcome to BookStack'),
                        'placeholder' => 'Welcome to BookStack'
                    ])
                </div>
            </div>
            
            <div class="grid half gap-xl">
                <div>
                    <label class="setting-list-label">Hero Subtitle</label>
                    <p class="small">Subtitle text displayed below the main heading.</p>
                </div>
                <div class="setting-list-value">
                    @include('form.textarea', [
                        'name' => 'modern-landing-hero-subtitle',
                        'value' => old('modern-landing-hero-subtitle') ?? setting('modern-landing-hero-subtitle', 'Your knowledge management platform'),
                        'placeholder' => 'Your knowledge management platform',
                        'rows' => 2
                    ])
                </div>
            </div>
        </div>

        {{-- Content Sections --}}
        <div class="setting-list">
            <h3>Content Sections</h3>
            
            <div class="grid half gap-xl">
                <div>
                    <label class="setting-list-label">Show Statistics</label>
                    <p class="small">Display statistics section with book, page, and user counts.</p>
                </div>
                <div class="setting-list-value">
                    @include('form.toggle-switch', [
                        'name' => 'modern-landing-show-stats',
                        'value' => old('modern-landing-show-stats') ?? setting('modern-landing-show-stats', true),
                        'label' => 'Show statistics section'
                    ])
                </div>
            </div>
            
            <div class="grid half gap-xl">
                <div>
                    <label class="setting-list-label">Show Recent Books</label>
                    <p class="small">Display a section with recently updated books.</p>
                </div>
                <div class="setting-list-value">
                    @include('form.toggle-switch', [
                        'name' => 'modern-landing-show-recent-books',
                        'value' => old('modern-landing-show-recent-books') ?? setting('modern-landing-show-recent-books', true),
                        'label' => 'Show recent books section'
                    ])
                </div>
            </div>
            
            <div class="grid half gap-xl">
                <div>
                    <label class="setting-list-label">Show Featured Section</label>
                    <p class="small">Display a section with featured books (requires book IDs below).</p>
                </div>
                <div class="setting-list-value">
                    @include('form.toggle-switch', [
                        'name' => 'modern-landing-show-featured',
                        'value' => old('modern-landing-show-featured') ?? setting('modern-landing-show-featured', true),
                        'label' => 'Show featured books section'
                    ])
                </div>
            </div>
        </div>

        {{-- Featured Books --}}
        <div class="setting-list">
            <div class="grid half gap-xl">
                <div>
                    <label class="setting-list-label">Featured Book IDs</label>
                    <p class="small">Comma-separated list of book IDs to feature. You can find book IDs in the URL when viewing a book (e.g., /books/123).</p>
                </div>
                <div class="setting-list-value">
                    @include('form.text', [
                        'name' => 'modern-landing-featured-books',
                        'value' => old('modern-landing-featured-books') ?? setting('modern-landing-featured-books', ''),
                        'placeholder' => '1,2,3'
                    ])
                    <div class="text-small text-muted mt-xs">
                        Example: 1,2,3 (will display books with IDs 1, 2, and 3)
                    </div>
                </div>
            </div>
        </div>

        {{-- Style Customization --}}
        <div class="setting-list">
            <h3>Style Customization</h3>
            <p class="text-muted">The modern landing page inherits your BookStack theme colors and respects dark mode settings. For advanced styling, you can add custom CSS through the main Customization settings.</p>
        </div>

        {{-- Save Button --}}
        <div class="form-group text-right">
            <button type="submit" class="button">
                @icon('check-circle') Save Settings
            </button>
        </div>
    </form>
    
    {{-- Preview and Instructions --}}
    <div class="card content-wrap mt-l">
        <h2>Setup Instructions</h2>
        <div class="text-muted">
            <p><strong>To activate the modern landing page:</strong></p>
            <ol>
                <li>Enable the "Modern Landing Page" option above and save settings</li>
                <li>Go to <strong>Settings > Customization</strong></li>
                <li>Set "Application Homepage" to <strong>Modern Landing</strong></li>
                <li>Save the customization settings</li>
                <li>Visit your homepage to see the new design</li>
            </ol>
            
            <p class="mt-m"><strong>Note:</strong> If "Modern Landing" doesn't appear in the homepage dropdown, make sure this theme is properly activated and the setting above is enabled.</p>
        </div>
    </div>
    
    {{-- Current Settings Preview --}}
    @if(setting('modern-landing-enabled'))
    <div class="card content-wrap mt-l">
        <h2>Current Settings Preview</h2>
        <div class="grid third gap-xl mt-m">
            <div class="card">
                <div class="card-title">Hero Section</div>
                <div class="card-content text-small">
                    <strong>Title:</strong> {{ setting('modern-landing-hero-title', 'Welcome to BookStack') }}<br>
                    <strong>Subtitle:</strong> {{ setting('modern-landing-hero-subtitle', 'Your knowledge management platform') }}
                </div>
            </div>
            
            <div class="card">
                <div class="card-title">Active Sections</div>
                <div class="card-content text-small">
                    @if(setting('modern-landing-show-stats', true))
                    ✅ Statistics<br>
                    @endif
                    @if(setting('modern-landing-show-recent-books', true))
                    ✅ Recent Books<br>
                    @endif
                    @if(setting('modern-landing-show-featured', true))
                    ✅ Featured Books<br>
                    @endif
                </div>
            </div>
            
            <div class="card">
                <div class="card-title">Featured Books</div>
                <div class="card-content text-small">
                    @if(setting('modern-landing-featured-books'))
                    Book IDs: {{ setting('modern-landing-featured-books') }}
                    @else
                    <em>No featured books set</em>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @endif
</div>
@endsection