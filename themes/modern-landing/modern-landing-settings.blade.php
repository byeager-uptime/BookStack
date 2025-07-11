@extends('layouts.simple')

@section('body')
<div class="container medium">
    <!-- Self-contained Top Navigation Bar -->
    <nav class="active-link-list py-m flex-container-row justify-center wrap">
        <a href="{{ url('/settings') }}" class="active">
            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19.14,12.94c0.04-0.3,0.06-0.61,0.06-0.94c0-0.32-0.02-0.64-0.07-0.94l2.03-1.58c0.18-0.14,0.23-0.41,0.12-0.61 l-1.92-3.32c-0.12-0.22-0.37-0.29-0.59-0.22l-2.39,0.96c-0.5-0.38-1.03-0.7-1.62-0.94L14.4,2.81c-0.04-0.24-0.24-0.41-0.48-0.41 h-3.84c-0.24,0-0.43,0.17-0.47,0.41L9.25,5.35C8.66,5.59,8.12,5.92,7.63,6.29L5.24,5.33c-0.22-0.08-0.47,0-0.59,0.22L2.74,8.87 C2.62,9.08,2.66,9.34,2.86,9.48l2.03,1.58C4.84,11.36,4.8,11.69,4.8,12s0.02,0.64,0.07,0.94l-2.03,1.58 c-0.18,0.14-0.23,0.41-0.12,0.61l1.92,3.32c0.12,0.22,0.37,0.29,0.59,0.22l2.39-0.96c0.5,0.38,1.03,0.7,1.62,0.94l0.36,2.54 c0.05,0.24,0.24,0.41,0.48,0.41h3.84c0.24,0,0.44-0.17,0.47-0.41l0.36-2.54c0.59-0.24,1.13-0.56,1.62-0.94l2.39,0.96 c0.22,0.08,0.47,0,0.59-0.22l1.92-3.32c0.12-0.22,0.07-0.47-0.12-0.61L19.14,12.94z M12,15.6c-1.98,0-3.6-1.62-3.6-3.6 s1.62-3.6,3.6-3.6s3.6,1.62,3.6,3.6S13.98,15.6,12,15.6z"/></svg>
            Settings
        </a>
        <a href="{{ url('/settings/maintenance') }}">
            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M22.7 19l-9.1-9.1c.9-2.3.4-5-1.5-6.9-2-2-5-2.4-7.4-1.3L9 6 6 9 1.6 4.7C.4 7.1.9 10.1 2.9 12.1c1.9 1.9 4.6 2.4 6.9 1.5l9.1 9.1c.4.4 1 .4 1.4 0l2.3-2.3c.5-.4.5-1.1.1-1.4z"/></svg>
            Maintenance
        </a>
        <a href="{{ url('/settings/audit') }}">
            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
            Audit Log
        </a>
        <a href="{{ url('/settings/users') }}">
            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M16 4c0-1.11.89-2 2-2s2 .89 2 2-.89 2-2 2-2-.89-2-2zM4 18v-4h3v-3c0-1.1.9-2 2-2h2c.85 0 1.59.55 1.87 1.3L14.1 8l-1.4-2.6c-.5-.94-1.47-1.4-2.5-1.4H8C6.9 4 6 4.9 6 6v3H4c-1.1 0-2 .9-2 2v5c0 1.1.9 2 2 2h2c1.1 0 2-.9 2-2v-1h1.5l6.5 6.5 1.41-1.41L9.5 14.5 11 13H9V9h.5l1.5 3v4c0 1.1.9 2 2 2s2-.9 2-2v-4.5l1.5-3H18c1.1 0 2-.9 2-2s-.9-2-2-2h-2.5L14.1 8z"/></svg>
            Users
        </a>
        <a href="{{ url('/settings/roles') }}">
            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
            Roles
        </a>
        <a href="{{ url('/settings/webhooks') }}">
            <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M10 15l-3.5 3.5c-1.38 1.38-3.63 1.38-5.01 0s-1.38-3.63 0-5.01L5 10.04c1.38-1.38 3.63-1.38 5.01 0 .19.19.35.39.48.61l1.44-1.44c-.38-.72-.9-1.35-1.54-1.9-2.75-2.3-6.88-1.94-9.24.42s-2.72 6.49-.42 9.24c2.3 2.75 6.43 2.3 8.78-.05L12 14.5l-2-2v2.5zm4.5-9.5L18 9l2-2.5c1.38-1.38 3.63-1.38 5.01 0s1.38 3.63 0 5.01L21.5 15c-1.38 1.38-3.63 1.38-5.01 0-.19-.19-.35-.39-.48-.61l-1.44 1.44c.38.72.9 1.35 1.54 1.9 2.75 2.3 6.88 1.94 9.24-.42s2.72-6.49.42-9.24c-2.3-2.75-6.43-2.3-8.78.05z"/></svg>
            Webhooks
        </a>
    </nav>
    
    <!-- Two-column layout with sidebar -->
    <div class="grid gap-xxl right-focus">
        <!-- Left sidebar -->
        <div>
            <h5>Categories</h5>
            <nav class="active-link-list in-sidebar">
                <a href="{{ url('/settings/features') }}" class="{{ ($category ?? '') === 'features' ? 'active' : '' }}">
                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"/></svg>
                    Features & Security
                </a>
                <a href="{{ url('/settings/customization') }}" class="{{ ($category ?? '') === 'customization' ? 'active' : '' }}">
                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 2C6.49 2 2 6.49 2 12s4.49 10 10 10c1.38 0 2.5-1.12 2.5-2.5 0-.61-.23-1.21-.64-1.67-.08-.09-.13-.21-.13-.33 0-.28.22-.5.5-.5H16c2.21 0 4-1.79 4-4 0-4.42-3.58-8-8-8z"/></svg>
                    Customization
                </a>
                <a href="{{ url('/settings/registration') }}" class="{{ ($category ?? '') === 'registration' ? 'active' : '' }}">
                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M18 8h-1V6c0-2.76-2.24-5-5-5S7 3.24 7 6v2H6c-1.1 0-2 .9-2 2v10c0 1.1.9 2 2 2h12c1.1 0 2-.9 2-2V10c0-1.1-.9-2-2-2zm-6 9c-1.1 0-2-.9-2-2s.9-2 2-2 2 .9 2 2-.9 2-2 2zm3.1-9H8.9V6c0-1.71 1.39-3.1 3.1-3.1 1.71 0 3.1 1.39 3.1 3.1v2z"/></svg>
                    Registration
                </a>
                <a href="{{ url('/settings/sorting') }}" class="{{ ($category ?? '') === 'sorting' ? 'active' : '' }}">
                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M3 18h6v-2H3v2zM3 6v2h18V6H3zm0 7h12v-2H3v2z"/></svg>
                    Sorting
                </a>
                <a href="{{ url('/settings/modern-landing') }}" class="active">
                    <svg class="svg-icon" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm-5 14H7v-2h7v2zm3-4H7v-2h10v2zm0-4H7V7h10v2z"/></svg>
                    Modern Landing
                </a>
            </nav>
            
            <h5 class="mt-xl">System Version</h5>
            <div class="py-xs">
                <a target="_blank" rel="noopener noreferrer" href="https://github.com/BookStackApp/BookStack/releases">
                    BookStack {{ $version ?? 'unknown' }}
                </a>
                <br>
                <a target="_blank" href="{{ url('/licenses') }}" class="text-muted">License Details</a>
            </div>
        </div>
        
        <!-- Right content area -->
        <div>
            <div class="card content-wrap auto-height">
    <h1 class="list-heading">Modern Landing Page Settings</h1>
    <p class="text-muted">Configure the modern landing page appearance and content.</p>
    
    <form method="POST" action="{{ url('/settings/modern-landing') }}">
        {{ csrf_field() }}
            
            <!-- Hero Section Settings -->
            <div class="setting-list">
                <h3>Hero Section</h3>
                
                <div class="grid half gap-xl">
                    <div>
                        <label class="setting-list-label">Hero Title</label>
                        <input type="text" 
                               name="modern-landing-hero-title" 
                               value="{{ $settings['hero_title'] }}" 
                               class="text-input">
                    </div>
                    
                    <div>
                        <label class="setting-list-label">Hero Subtitle</label>
                        <input type="text" 
                               name="modern-landing-hero-subtitle" 
                               value="{{ $settings['hero_subtitle'] }}" 
                               class="text-input">
                    </div>
                </div>
                
                <!-- Background Settings -->
                <div class="mt-m">
                    <label class="setting-list-label">Background Type</label>
                    <select name="modern-landing-hero-bg-type" class="text-input" id="bg-type-select">
                        <option value="color" {{ $settings['hero_bg_type'] === 'color' ? 'selected' : '' }}>Solid Color</option>
                        <option value="gradient" {{ $settings['hero_bg_type'] === 'gradient' ? 'selected' : '' }}>Gradient</option>
                    </select>
                </div>
                
                <!-- Solid Color Option -->
                <div id="solid-color-options" class="mt-m" style="{{ $settings['hero_bg_type'] !== 'color' ? 'display: none;' : '' }}">
                    <label class="setting-list-label">Background Color</label>
                    <div class="grid quarter gap-m">
                        <input type="color" 
                               name="modern-landing-hero-bg-color" 
                               value="{{ $settings['hero_bg_color'] }}" 
                               class="text-input">
                        <input type="text" 
                               name="modern-landing-hero-bg-color" 
                               value="{{ $settings['hero_bg_color'] }}" 
                               class="text-input"
                               placeholder="#f8fafc">
                    </div>
                </div>
                
                <!-- Gradient Options -->
                <div id="gradient-options" class="mt-m" style="{{ $settings['hero_bg_type'] !== 'gradient' ? 'display: none;' : '' }}">
                    <label class="setting-list-label">Gradient Colors</label>
                    <div class="grid half gap-m">
                        <div>
                            <label class="text-small text-muted">Start Color</label>
                            <div class="grid quarter gap-s">
                                <input type="color" 
                                       name="modern-landing-hero-bg-gradient-start" 
                                       value="{{ $settings['hero_bg_gradient_start'] }}" 
                                       class="text-input">
                                <input type="text" 
                                       name="modern-landing-hero-bg-gradient-start" 
                                       value="{{ $settings['hero_bg_gradient_start'] }}" 
                                       class="text-input">
                            </div>
                        </div>
                        <div>
                            <label class="text-small text-muted">End Color</label>
                            <div class="grid quarter gap-s">
                                <input type="color" 
                                       name="modern-landing-hero-bg-gradient-end" 
                                       value="{{ $settings['hero_bg_gradient_end'] }}" 
                                       class="text-input">
                                <input type="text" 
                                       name="modern-landing-hero-bg-gradient-end" 
                                       value="{{ $settings['hero_bg_gradient_end'] }}" 
                                       class="text-input">
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-s">
                        <label class="setting-list-label">Gradient Direction</label>
                        <select name="modern-landing-hero-bg-gradient-direction" class="text-input">
                            <option value="to-right" {{ $settings['hero_bg_gradient_direction'] === 'to-right' ? 'selected' : '' }}>Left to Right</option>
                            <option value="to-left" {{ $settings['hero_bg_gradient_direction'] === 'to-left' ? 'selected' : '' }}>Right to Left</option>
                            <option value="to-bottom" {{ $settings['hero_bg_gradient_direction'] === 'to-bottom' ? 'selected' : '' }}>Top to Bottom</option>
                            <option value="to-top" {{ $settings['hero_bg_gradient_direction'] === 'to-top' ? 'selected' : '' }}>Bottom to Top</option>
                            <option value="to-bottom-right" {{ $settings['hero_bg_gradient_direction'] === 'to-bottom-right' ? 'selected' : '' }}>Top-Left to Bottom-Right</option>
                            <option value="to-bottom-left" {{ $settings['hero_bg_gradient_direction'] === 'to-bottom-left' ? 'selected' : '' }}>Top-Right to Bottom-Left</option>
                        </select>
                    </div>
                </div>
            </div>
            
            <!-- Cards Section -->
            <div class="setting-list mt-xl">
                <h3>Category Cards</h3>
                <p class="text-muted text-small mb-m">Configure the category cards displayed on the landing page.</p>
                
                <div id="cards-container">
                    @if(empty($settings['cards']))
                        <!-- Default cards if none configured -->
                        <div class="card-editor mb-m" data-card-index="0">
                            <div class="grid half gap-m">
                                <div>
                                    <label class="setting-list-label">Card Title</label>
                                    <input type="text" name="cards[0][title]" value="Getting Started" class="text-input">
                                </div>
                                <div>
                                    <label class="setting-list-label">Card Description</label>
                                    <input type="text" name="cards[0][description]" value="New to BookStack? Start here for setup guides and basic usage." class="text-input">
                                </div>
                            </div>
                            <div class="grid third gap-m mt-s">
                                <div>
                                    <label class="setting-list-label">Background Color</label>
                                    <input type="color" name="cards[0][bg_color]" value="#ffffff" class="text-input">
                                </div>
                                <div>
                                    <label class="setting-list-label">Text Color</label>
                                    <input type="color" name="cards[0][text_color]" value="#2d3748" class="text-input">
                                </div>
                                <div>
                                    <label class="setting-list-label">Border Radius (px)</label>
                                    <input type="number" name="cards[0][border_radius]" value="8" class="text-input" min="0" max="50">
                                </div>
                            </div>
                            <div class="grid half gap-m mt-s">
                                <div>
                                    <label class="setting-list-label">Link Type</label>
                                    <select name="cards[0][link_type]" class="text-input card-link-type">
                                        <option value="internal">Internal Page/Book/Shelf</option>
                                        <option value="external">External URL</option>
                                    </select>
                                </div>
                                <div class="card-link-config">
                                    <label class="setting-list-label">Search for Content</label>
                                    <div class="content-search-wrapper" style="position: relative;">
                                        <input type="text" name="cards[0][link_search]" placeholder="Search for books, pages, shelves..." class="text-input content-search">
                                        <div class="search-results" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1px solid #e5e7eb; border-radius: 4px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); z-index: 1000; max-height: 200px; overflow-y: auto;"></div>
                                    </div>
                                    <input type="hidden" name="cards[0][link_internal]" value="">
                                    <input type="text" name="cards[0][link_external]" placeholder="https://example.com" class="text-input" style="display: none;">
                                </div>
                            </div>
                            <button type="button" class="text-button text-neg mt-s remove-card">Remove Card</button>
                        </div>
                    @else
                        @foreach($settings['cards'] as $index => $card)
                            <div class="card-editor mb-m" data-card-index="{{ $index }}">
                                <div class="grid half gap-m">
                                    <div>
                                        <label class="setting-list-label">Card Title</label>
                                        <input type="text" name="cards[{{ $index }}][title]" value="{{ $card['title'] ?? '' }}" class="text-input">
                                    </div>
                                    <div>
                                        <label class="setting-list-label">Card Description</label>
                                        <input type="text" name="cards[{{ $index }}][description]" value="{{ $card['description'] ?? '' }}" class="text-input">
                                    </div>
                                </div>
                                <div class="grid third gap-m mt-s">
                                    <div>
                                        <label class="setting-list-label">Background Color</label>
                                        <input type="color" name="cards[{{ $index }}][bg_color]" value="{{ $card['bg_color'] ?? '#ffffff' }}" class="text-input">
                                    </div>
                                    <div>
                                        <label class="setting-list-label">Text Color</label>
                                        <input type="color" name="cards[{{ $index }}][text_color]" value="{{ $card['text_color'] ?? '#2d3748' }}" class="text-input">
                                    </div>
                                    <div>
                                        <label class="setting-list-label">Border Radius (px)</label>
                                        <input type="number" name="cards[{{ $index }}][border_radius]" value="{{ $card['border_radius'] ?? 8 }}" class="text-input" min="0" max="50">
                                    </div>
                                </div>
                                <div class="grid half gap-m mt-s">
                                    <div>
                                        <label class="setting-list-label">Link Type</label>
                                        <select name="cards[{{ $index }}][link_type]" class="text-input card-link-type">
                                            <option value="internal" {{ ($card['link_type'] ?? 'internal') === 'internal' ? 'selected' : '' }}>Internal Page/Book/Shelf</option>
                                            <option value="external" {{ ($card['link_type'] ?? 'internal') === 'external' ? 'selected' : '' }}>External URL</option>
                                        </select>
                                    </div>
                                    <div class="card-link-config">
                                        <label class="setting-list-label">Link Configuration</label>
                                        <input type="text" name="cards[{{ $index }}][link_search]" placeholder="Search for content..." class="text-input content-search" style="{{ ($card['link_type'] ?? 'internal') === 'internal' ? '' : 'display: none;' }}">
                                        <input type="hidden" name="cards[{{ $index }}][link_internal]" value="{{ $card['link_internal'] ?? '' }}">
                                        <input type="text" name="cards[{{ $index }}][link_external]" value="{{ $card['link_external'] ?? '' }}" placeholder="https://example.com" class="text-input" style="{{ ($card['link_type'] ?? 'internal') === 'external' ? '' : 'display: none;' }}">
                                    </div>
                                </div>
                                <button type="button" class="text-button text-neg mt-s remove-card">Remove Card</button>
                            </div>
                        @endforeach
                    @endif
                </div>
                
                <button type="button" id="add-card" class="button outline">Add New Card</button>
            </div>
        
        <div class="form-group text-right mt-xl">
            <button type="submit" class="button">Save Settings</button>
        </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Background type toggle
    const bgTypeSelect = document.getElementById('bg-type-select');
    const solidOptions = document.getElementById('solid-color-options');
    const gradientOptions = document.getElementById('gradient-options');
    
    bgTypeSelect.addEventListener('change', function() {
        if (this.value === 'color') {
            solidOptions.style.display = 'block';
            gradientOptions.style.display = 'none';
        } else {
            solidOptions.style.display = 'none';
            gradientOptions.style.display = 'block';
        }
    });
    
    // Cards management
    let cardCount = document.querySelectorAll('.card-editor').length;
    
    // Add new card
    document.getElementById('add-card').addEventListener('click', function() {
        const container = document.getElementById('cards-container');
        const cardHtml = `
            <div class="card-editor mb-m" data-card-index="${cardCount}">
                <div class="grid half gap-m">
                    <div>
                        <label class="setting-list-label">Card Title</label>
                        <input type="text" name="cards[${cardCount}][title]" value="" class="text-input">
                    </div>
                    <div>
                        <label class="setting-list-label">Card Description</label>
                        <input type="text" name="cards[${cardCount}][description]" value="" class="text-input">
                    </div>
                </div>
                <div class="grid third gap-m mt-s">
                    <div>
                        <label class="setting-list-label">Background Color</label>
                        <input type="color" name="cards[${cardCount}][bg_color]" value="#ffffff" class="text-input">
                    </div>
                    <div>
                        <label class="setting-list-label">Text Color</label>
                        <input type="color" name="cards[${cardCount}][text_color]" value="#2d3748" class="text-input">
                    </div>
                    <div>
                        <label class="setting-list-label">Border Radius (px)</label>
                        <input type="number" name="cards[${cardCount}][border_radius]" value="8" class="text-input" min="0" max="50">
                    </div>
                </div>
                <div class="grid half gap-m mt-s">
                    <div>
                        <label class="setting-list-label">Link Type</label>
                        <select name="cards[${cardCount}][link_type]" class="text-input card-link-type">
                            <option value="internal">Internal Page/Book/Shelf</option>
                            <option value="external">External URL</option>
                        </select>
                    </div>
                    <div class="card-link-config">
                        <label class="setting-list-label">Search for Content</label>
                        <div class="content-search-wrapper" style="position: relative;">
                            <input type="text" name="cards[${cardCount}][link_search]" placeholder="Search for books, pages, shelves..." class="text-input content-search">
                            <div class="search-results" style="display: none; position: absolute; top: 100%; left: 0; right: 0; background: white; border: 1px solid #e5e7eb; border-radius: 4px; box-shadow: 0 4px 6px rgba(0,0,0,0.1); z-index: 1000; max-height: 200px; overflow-y: auto;"></div>
                        </div>
                        <input type="hidden" name="cards[${cardCount}][link_internal]" value="">
                        <input type="text" name="cards[${cardCount}][link_external]" placeholder="https://example.com" class="text-input" style="display: none;">
                    </div>
                </div>
                <button type="button" class="text-button text-neg mt-s remove-card">Remove Card</button>
            </div>
        `;
        container.insertAdjacentHTML('beforeend', cardHtml);
        cardCount++;
        attachCardEventListeners();
        attachSearchListeners();
    });
    
    // Remove card
    function attachCardEventListeners() {
        document.querySelectorAll('.remove-card').forEach(button => {
            button.addEventListener('click', function() {
                this.closest('.card-editor').remove();
            });
        });
        
        // Link type toggle
        document.querySelectorAll('.card-link-type').forEach(select => {
            select.addEventListener('change', function() {
                const config = this.closest('.card-editor').querySelector('.card-link-config');
                const searchInput = config.querySelector('.content-search');
                const externalInput = config.querySelector('input[name*="[link_external]"]');
                
                if (this.value === 'internal') {
                    searchInput.style.display = 'block';
                    externalInput.style.display = 'none';
                } else {
                    searchInput.style.display = 'none';
                    externalInput.style.display = 'block';
                }
            });
        });
    }
    
    attachCardEventListeners();
    
    // Content search functionality
    let searchTimeouts = {};
    
    function attachSearchListeners() {
        document.querySelectorAll('.content-search').forEach(searchInput => {
            const wrapper = searchInput.closest('.content-search-wrapper');
            const resultsDiv = wrapper.querySelector('.search-results');
            const hiddenInput = wrapper.parentElement.querySelector('input[type="hidden"]');
            
            searchInput.addEventListener('input', function() {
                const query = this.value.trim();
                const timeoutKey = this.name;
                
                // Clear previous timeout
                if (searchTimeouts[timeoutKey]) {
                    clearTimeout(searchTimeouts[timeoutKey]);
                }
                
                if (query.length < 2) {
                    resultsDiv.style.display = 'none';
                    return;
                }
                
                // Debounce search
                searchTimeouts[timeoutKey] = setTimeout(() => {
                    fetch(`/api/modern-landing/search-content?q=${encodeURIComponent(query)}`)
                        .then(response => response.json())
                        .then(results => {
                            resultsDiv.innerHTML = '';
                            
                            if (results.length > 0) {
                                results.forEach(result => {
                                    const resultItem = document.createElement('div');
                                    resultItem.style.cssText = 'padding: 8px 12px; cursor: pointer; border-bottom: 1px solid #f3f4f6;';
                                    resultItem.innerHTML = `
                                        <div style="font-weight: 500;">${result.display}</div>
                                        <div style="font-size: 0.875rem; color: #6b7280;">${result.description}</div>
                                    `;
                                    
                                    resultItem.addEventListener('click', () => {
                                        searchInput.value = result.name;
                                        hiddenInput.value = result.url;
                                        resultsDiv.style.display = 'none';
                                    });
                                    
                                    resultItem.addEventListener('mouseenter', () => {
                                        resultItem.style.backgroundColor = '#f9fafb';
                                    });
                                    
                                    resultItem.addEventListener('mouseleave', () => {
                                        resultItem.style.backgroundColor = 'white';
                                    });
                                    
                                    resultsDiv.appendChild(resultItem);
                                });
                                
                                resultsDiv.style.display = 'block';
                            } else {
                                resultsDiv.innerHTML = '<div style="padding: 8px 12px; color: #6b7280;">No results found</div>';
                                resultsDiv.style.display = 'block';
                            }
                        })
                        .catch(error => {
                            console.error('Search error:', error);
                            resultsDiv.style.display = 'none';
                        });
                }, 300);
            });
            
            // Hide results when clicking outside
            document.addEventListener('click', function(e) {
                if (!wrapper.contains(e.target)) {
                    resultsDiv.style.display = 'none';
                }
            });
        });
    }
    
    attachSearchListeners();
});
</script>
@endsection