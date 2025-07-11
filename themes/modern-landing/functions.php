<?php

use BookStack\Facades\Theme;
use BookStack\Theming\ThemeEvents;

/**
 * Modern Landing Theme - Simplified Working Version
 */

// Theme configuration
define('MODERN_LANDING_VERSION', '1.0.0');

/**
 * Test that theme is loading properly
 */
Theme::listen(ThemeEvents::APP_BOOT, function () {
    // Log that theme is loaded
    \Log::info('Modern Landing Theme loaded successfully');
});

/**
 * Homepage override and settings routes
 */
Theme::listen(ThemeEvents::WEB_MIDDLEWARE_BEFORE, function ($request) {
    
    // Content search API for settings page
    if ($request->getPathInfo() === '/api/modern-landing/search-content' && $request->isMethod('GET')) {
        // Check if user has settings permission
        if (!user()->can('settings-manage')) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }
        
        $query = $request->get('q', '');
        if (strlen($query) < 2) {
            return response()->json([]);
        }
        
        $entityQueries = app(\BookStack\Entities\Queries\EntityQueries::class);
        $results = [];
        
        // Search books
        $books = $entityQueries->books->visibleForList()
            ->where('name', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();
        
        foreach ($books as $book) {
            $results[] = [
                'type' => 'book',
                'id' => $book->id,
                'name' => $book->name,
                'url' => $book->getUrl(),
                'description' => $book->description ?? '',
                'display' => "📚 {$book->name}"
            ];
        }
        
        // Search pages
        $pages = $entityQueries->pages->visibleForList()
            ->where('name', 'LIKE', "%{$query}%")
            ->limit(10)
            ->get();
            
        foreach ($pages as $page) {
            $results[] = [
                'type' => 'page',
                'id' => $page->id,
                'name' => $page->name,
                'url' => $page->getUrl(),
                'description' => $page->book->name ?? '',
                'display' => "📄 {$page->name} (in {$page->book->name})"
            ];
        }
        
        // Search shelves if available
        if (class_exists(\BookStack\Entities\Models\Bookshelf::class)) {
            $shelves = \BookStack\Entities\Models\Bookshelf::visible()
                ->where('name', 'LIKE', "%{$query}%")
                ->limit(5)
                ->get();
                
            foreach ($shelves as $shelf) {
                $results[] = [
                    'type' => 'shelf',
                    'id' => $shelf->id,
                    'name' => $shelf->name,
                    'url' => $shelf->getUrl(),
                    'description' => $shelf->description ?? '',
                    'display' => "📚 {$shelf->name} (Shelf)"
                ];
            }
        }
        
        return response()->json(array_slice($results, 0, 15));
    }
    
    // Modern Landing Settings Page
    if ($request->getPathInfo() === '/settings/modern-landing') {
        // Check if user has settings permission
        if (!user()->can('settings-manage')) {
            abort(403);
        }
    }
    
    // TEST VERSION - Modern Landing Settings Page (bypasses auth for testing)
    if ($request->getPathInfo() === '/settings/modern-landing-test-settings') {
        
        // Handle POST requests (save settings)
        if ($request->isMethod('POST')) {
            $settings = $request->only([
                'modern-landing-hero-title',
                'modern-landing-hero-subtitle', 
                'modern-landing-hero-bg-type',
                'modern-landing-hero-bg-color',
                'modern-landing-hero-bg-gradient-start',
                'modern-landing-hero-bg-gradient-end',
                'modern-landing-hero-bg-gradient-direction',
                'modern-landing-cards'
            ]);
            
            foreach ($settings as $key => $value) {
                setting([$key => $value]);
            }
            
            return redirect('/settings/modern-landing-test-settings')->with('success', 'Modern Landing settings saved successfully');
        }
        
        // Get current settings
        $currentSettings = [
            'hero_title' => setting('modern-landing-hero-title', 'Welcome to Your Knowledge Hub'),
            'hero_subtitle' => setting('modern-landing-hero-subtitle', 'Organize, share, and discover information with BookStack'),
            'hero_bg_type' => setting('modern-landing-hero-bg-type', 'color'),
            'hero_bg_color' => setting('modern-landing-hero-bg-color', '#f8fafc'),
            'hero_bg_gradient_start' => setting('modern-landing-hero-bg-gradient-start', '#f8fafc'),
            'hero_bg_gradient_end' => setting('modern-landing-hero-bg-gradient-end', '#e2e8f0'),
            'hero_bg_gradient_direction' => setting('modern-landing-hero-bg-gradient-direction', 'to-right'),
            'cards' => json_decode(setting('modern-landing-cards', '[]'), true),
        ];
        
        // Test with full settings view
        return response(view('modern-landing-settings', [
            'settings' => $currentSettings,
            'category' => 'features',
            'version' => \BookStack\App\AppVersion::get()
        ]));
    }
    // Test route for the modern landing page
    if ($request->getPathInfo() === '/modern-landing-test') {
        $isSignedIn = auth()->check();
        
        // Get some basic data for the page
        $booksQuery = app(\BookStack\Entities\Queries\EntityQueries::class)->books;
        $recentBooks = $booksQuery->visibleForList()->orderBy('updated_at', 'desc')->limit(6)->get();
        
        // Get stats
        $stats = [
            'books' => $booksQuery->visibleForList()->count(),
            'pages' => app(\BookStack\Entities\Queries\EntityQueries::class)->pages->visibleForList()->count(),
            'users' => auth()->check() ? \BookStack\Users\Models\User::count() : null,
        ];
        
        return response(view('modern-landing', [
            'recentBooks' => $recentBooks,
            'featuredBooks' => collect(), // Empty for now
            'stats' => $stats,
            'isSignedIn' => $isSignedIn,
            'heroTitle' => 'Welcome to Your Knowledge Hub',
            'heroSubtitle' => 'Organize, share, and discover information with BookStack',
            'showStats' => true,
            'showRecentBooks' => true,
            'showFeatured' => false,
        ]));
    }
    
    // Homepage override when modern-landing is selected
    if (($request->getPathInfo() === '/' || $request->getPathInfo() === '/home')) {
        $homepageType = setting('app-homepage-type', 'default');
        
        if ($homepageType === 'modern-landing') {
            $isSignedIn = auth()->check();
            
            // Get books data
            $booksQuery = app(\BookStack\Entities\Queries\EntityQueries::class)->books;
            $recentBooks = $booksQuery->visibleForList()->orderBy('updated_at', 'desc')->limit(6)->get();
            
            // Get featured books if specified
            $featuredBookIds = setting('modern-landing-featured-books', '');
            $featuredBooks = collect();
            if ($featuredBookIds) {
                $ids = array_map('trim', explode(',', $featuredBookIds));
                $ids = array_filter($ids, 'is_numeric');
                if (!empty($ids)) {
                    $featuredBooks = $booksQuery->visibleForList()->whereIn('id', $ids)->limit(3)->get();
                }
            }
            
            // Get stats
            $stats = [
                'books' => $booksQuery->visibleForList()->count(),
                'pages' => app(\BookStack\Entities\Queries\EntityQueries::class)->pages->visibleForList()->count(),
                'users' => auth()->check() ? \BookStack\Users\Models\User::count() : null,
            ];
            
            return response(view('modern-landing', [
                'recentBooks' => $recentBooks,
                'featuredBooks' => $featuredBooks,
                'stats' => $stats,
                'isSignedIn' => $isSignedIn,
                'heroTitle' => setting('modern-landing-hero-title', 'Welcome to Your Knowledge Hub'),
                'heroSubtitle' => setting('modern-landing-hero-subtitle', 'Organize, share, and discover information with BookStack'),
                'showStats' => setting('modern-landing-show-stats', true),
                'showRecentBooks' => setting('modern-landing-show-recent-books', true),
                'showFeatured' => setting('modern-landing-show-featured', false),
            ]));
        }
    }
});

/**
 * Add modern-landing option to homepage type dropdown and features page link via JavaScript injection
 */
Theme::listen(ThemeEvents::WEB_MIDDLEWARE_AFTER, function ($request, $response) {
    // Add Modern Landing link to Features & Security page
    if ($request->getPathInfo() === '/settings/features' && $response->getStatusCode() === 200) {
        $content = $response->getContent();
        
        // Find a unique identifier to inject after and insert our Modern Landing section
        $modernLandingSection = '
        <div class="grid half gap-xl">
            <div>
                <label class="setting-list-label">Modern Landing Page</label>
                <p class="small">Configure the modern landing page appearance, hero background, and category cards.</p>
            </div>
            <div>
                <a href="' . url('/settings/modern-landing') . '" class="button outline">Configure Modern Landing</a>
            </div>
        </div>
        ';
        
        // Look for the Higher Security Image Uploads section and insert before it
        if (strpos($content, 'Higher Security Image Uploads') !== false) {
            $content = str_replace(
                '<h2>Higher Security Image Uploads</h2>',
                $modernLandingSection . '<h2>Higher Security Image Uploads</h2>',
                $content
            );
        } else {
            // Fallback: look for Disable Comments and insert after it
            $content = str_replace(
                '</div>
        </div>

    </div>
</form>',
                '</div>
        </div>
        ' . $modernLandingSection . '
    </div>
</form>',
                $content
            );
        }
        
        $response->setContent($content);
    }
    
    // Only modify the customization settings page
    if ($request->getPathInfo() === '/settings/customization' && $response->getStatusCode() === 200) {
        $content = $response->getContent();
        $currentHomepageType = setting('app-homepage-type', 'default');
        
        // Add JavaScript to inject the modern-landing option
        $script = '<script>
document.addEventListener("DOMContentLoaded", function() {
    const homepageSelect = document.getElementById("setting-app-homepage-type");
    if (homepageSelect) {
        const modernOption = document.createElement("option");
        modernOption.value = "modern-landing";
        modernOption.textContent = "Modern Landing";
        ' . ($currentHomepageType === 'modern-landing' ? 'modernOption.selected = true;' : '') . '
        homepageSelect.appendChild(modernOption);
    }
});
</script>';
        
        // Insert the script before the closing body tag
        $content = str_replace('</body>', $script . '</body>', $content);
        $response->setContent($content);
    }
    
    return $response;
});