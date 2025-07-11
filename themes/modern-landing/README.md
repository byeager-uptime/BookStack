# Modern Landing Theme for BookStack

A beautiful, modern landing page theme for BookStack that provides a professional, customizable homepage for both authenticated users and guests.

## Features

- **Modern Design**: Clean, contemporary layout with animations and responsive design
- **Hero Section**: Customizable title and subtitle with call-to-action buttons
- **Statistics Display**: Show book, page, and user counts
- **Featured Books**: Highlight specific books with custom selection
- **Recent Activity**: Display recently updated books
- **Features Showcase**: Built-in features section highlighting BookStack capabilities
- **Dark Mode Support**: Fully compatible with BookStack's dark mode
- **Responsive**: Mobile-first design that works on all devices
- **Easy Configuration**: Admin interface for all customization options

## Installation

1. Copy the `modern-landing` folder to your BookStack `themes/` directory
2. The theme will be automatically detected by BookStack

## Activation

1. **Enable the Theme**:
   - Go to **Settings > Modern Landing Page Settings**
   - Enable "Modern Landing Page" and save settings

2. **Set as Homepage**:
   - Go to **Settings > Customization**
   - Set "Application Homepage" to "Modern Landing"
   - Save settings

3. **Visit Homepage**: Your homepage will now display the modern landing page

## Configuration

### Hero Section
- **Hero Title**: Main heading displayed prominently
- **Hero Subtitle**: Supporting text below the title

### Content Sections
- **Statistics**: Toggle display of book/page/user counts
- **Recent Books**: Show recently updated books
- **Featured Books**: Display hand-picked books (requires book IDs)

### Featured Books Setup
1. Find the ID of books you want to feature:
   - Go to any book page
   - Look at the URL: `/books/123` (the number is the book ID)
2. Enter comma-separated book IDs in the settings
3. Example: `1,2,3` will feature books with IDs 1, 2, and 3

## Customization

### Admin Interface
All customization options are available through:
- **Settings > Modern Landing Page Settings** - Theme-specific options
- **Settings > Customization** - General BookStack settings

### Advanced Styling
For advanced customization, you can add custom CSS through:
- **Settings > Customization > Custom HTML Head Content**

Example custom CSS:
```css
.modern-landing .hero-title {
    color: #your-custom-color;
}
```

## Theme Structure

```
themes/modern-landing/
├── functions.php                 # Theme logic and hooks
├── views/
│   ├── home/
│   │   └── modern-landing.blade.php    # Main landing page template
│   └── settings/
│       └── categories/
│           ├── customization.blade.php      # Override with Modern Landing option
│           └── modern-landing.blade.php     # Theme settings page
└── public/
    ├── css/
    │   └── modern-landing.css           # Theme styles
    └── js/
        └── modern-landing.js            # Theme JavaScript
```

## Compatibility

- **BookStack Version**: Compatible with recent BookStack versions
- **PHP**: Follows BookStack's PHP requirements
- **Browsers**: Modern browsers with CSS Grid support
- **Mobile**: Responsive design for all screen sizes

## User Experience

### For Guests (Non-logged-in Users)
- Hero section with registration/login buttons
- Statistics display (if enabled)
- Featured books showcase
- Recent books discovery
- Features overview
- Call-to-action section

### For Authenticated Users
- Hero section with quick actions (Browse Books, Create Book)
- Personalized recent activity
- Same customizable sections as guests
- Respects user permissions

## Troubleshooting

### Theme Not Appearing
- Ensure the theme folder is in `themes/modern-landing/`
- Check that "Modern Landing Page" is enabled in settings
- Verify BookStack can read the theme files

### Modern Landing Option Not in Homepage Dropdown
- Make sure the theme is enabled in Modern Landing settings
- Clear any BookStack caches
- Check that the theme's customization.blade.php file is present

### Styling Issues
- Ensure your BookStack version is compatible
- Check browser console for any JavaScript errors
- Verify custom CSS isn't conflicting with theme styles

## Support

This theme integrates seamlessly with BookStack's theming system and follows all best practices for theme development. It doesn't modify core BookStack files and can be safely enabled/disabled without affecting your installation.

## Version

Version 1.0.0 - Initial release