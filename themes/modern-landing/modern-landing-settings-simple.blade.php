<!DOCTYPE html>
<html>
<head>
    <title>Modern Landing Settings</title>
    <link rel="stylesheet" href="http://localhost:8080/dist/styles.css">
</head>
<body>
    <div class="container">
        <h1>Modern Landing Page Settings (Test)</h1>
        <p>Hero Background: {{ $settings['hero_bg_color'] ?? '#f8fafc' }}</p>
        <p>Version: {{ $version ?? 'unknown' }}</p>
        <p>Cards count: {{ count($settings['cards'] ?? []) }}</p>
        
        <form method="POST" action="/settings/modern-landing-test-settings">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <label>Hero Title:</label>
            <input type="text" name="modern-landing-hero-title" value="{{ $settings['hero_title'] ?? '' }}">
            <button type="submit">Save</button>
        </form>
    </div>
</body>
</html>