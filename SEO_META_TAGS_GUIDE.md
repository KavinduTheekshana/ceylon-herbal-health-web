# SEO Meta Tags Implementation Guide

## Overview
The frontend layout now supports dynamic SEO meta tags including titles, descriptions, keywords, Open Graph tags, and Twitter Card tags.

## Available Meta Tag Sections

### 1. Basic SEO Tags
```blade
@section('title', 'Your Page Title')
@section('meta_description', 'Your page description here')
@section('meta_keywords', 'keyword1, keyword2, keyword3')
```

### 2. Open Graph Tags (Facebook, LinkedIn, etc.)
```blade
@section('og_type', 'article')  // or 'website', 'product', etc.
@section('og_title', 'Your OG Title')
@section('og_description', 'Your OG Description')
@section('og_image', asset('path/to/image.jpg'))
```

### 3. Twitter Card Tags
```blade
@section('twitter_title', 'Your Twitter Title')
@section('twitter_description', 'Your Twitter Description')
@section('twitter_image', asset('path/to/twitter-image.jpg'))
```

### 4. Canonical URL
```blade
@section('canonical', 'https://ceylonherbalhealth.co.uk/specific-page')
```

## Default Values

If you don't specify these sections, the following defaults will be used:

- **Title**: "Ceylon Herbal Health - Authentic Sri Lankan Ayurveda & Wellness in London"
- **Description**: "Experience authentic Sri Lankan Ayurveda healing and wellness treatments at Ceylon Herbal Health. Book your personalized consultation with our qualified practitioners in London."
- **Keywords**: "Ayurveda London, Sri Lankan Ayurveda, Herbal Medicine, Natural Healing, Wellness Treatment, Ayurvedic Consultation, Traditional Medicine, Holistic Health, Ceylon Ayurveda"

## Page-Specific Examples

### Homepage (Already Implemented)
See: `resources/views/frontend/home/index.blade.php`

### Services Listing Page
```blade
@extends('layouts.frontend')

@section('title', 'Our Ayurvedic Services - Ceylon Herbal Health')
@section('meta_description', 'Explore our range of authentic Sri Lankan Ayurvedic treatments including herbal therapies, wellness consultations, and traditional healing services in London.')
@section('meta_keywords', 'Ayurvedic Services, Herbal Treatments, Wellness Services London, Ayurveda Therapies, Traditional Healing')

@section('content')
    <!-- Your content here -->
@endsection
```

### Individual Service Page
```blade
@extends('layouts.frontend')

@section('title', '{{ $service->title }} - Ceylon Herbal Health')
@section('meta_description', '{{ $service->short_description ?? $service->description }}')
@section('meta_keywords', '{{ $service->title }}, Ayurvedic Treatment, Natural Healing, Ceylon Herbal Health')

@section('og_type', 'article')
@section('og_title', '{{ $service->title }} - Authentic Ayurvedic Treatment')
@section('og_description', '{{ $service->short_description }}')
@section('og_image', asset('storage/' . $service->image))

@section('content')
    <!-- Your service content here -->
@endsection
```

### Appointment Booking Page
```blade
@extends('layouts.frontend')

@section('title', 'Book Appointment - Ceylon Herbal Health')
@section('meta_description', 'Book your personalized Ayurvedic consultation online. Choose from our qualified therapists and available time slots. Experience authentic Sri Lankan healing.')
@section('meta_keywords', 'Book Ayurveda Appointment, Ayurvedic Consultation London, Herbal Medicine Appointment, Wellness Booking')

@section('content')
    <!-- Your booking content here -->
@endsection
```

### Blog Post Page
```blade
@extends('layouts.frontend')

@section('title', '{{ $post->title }} - Ceylon Herbal Health Blog')
@section('meta_description', '{{ Str::limit(strip_tags($post->content), 155) }}')
@section('meta_keywords', '{{ $post->tags }}, Ayurveda, Natural Health, Wellness Blog')

@section('og_type', 'article')
@section('og_title', '{{ $post->title }}')
@section('og_description', '{{ Str::limit(strip_tags($post->content), 200) }}')
@section('og_image', asset('storage/' . $post->featured_image))

@section('canonical', route('blog.show', $post->slug))

@section('content')
    <!-- Your blog post content here -->
@endsection
```

### About Page
```blade
@extends('layouts.frontend')

@section('title', 'About Us - Ceylon Herbal Health | Authentic Sri Lankan Ayurveda')
@section('meta_description', 'Learn about Ceylon Herbal Health and our mission to bring authentic Sri Lankan Ayurveda to London. Meet our qualified practitioners and discover our healing philosophy.')
@section('meta_keywords', 'About Ceylon Herbal Health, Ayurveda Practitioners London, Sri Lankan Healing, Traditional Medicine Experts')

@section('content')
    <!-- Your about content here -->
@endsection
```

### Contact Page
```blade
@extends('layouts.frontend')

@section('title', 'Contact Us - Ceylon Herbal Health')
@section('meta_description', 'Get in touch with Ceylon Herbal Health. Visit our London clinic, call us for appointments, or send us a message. We are here to help you on your wellness journey.')
@section('meta_keywords', 'Contact Ayurveda Clinic, Ceylon Herbal Health Location, Book Ayurveda Appointment, Wellness Center Contact')

@section('content')
    <!-- Your contact content here -->
@endsection
```

## Best Practices

### Title Tags
- Keep between 50-60 characters
- Include primary keyword
- Make it unique for each page
- Include brand name (Ceylon Herbal Health)

### Meta Descriptions
- Keep between 150-160 characters
- Include primary and secondary keywords naturally
- Write compelling copy that encourages clicks
- Make it unique for each page

### Keywords
- 5-10 relevant keywords per page
- Include long-tail keywords
- Don't keyword stuff
- Separate with commas

### Open Graph Images
- Minimum size: 1200 x 630 pixels
- Recommended format: JPG or PNG
- Keep file size under 1MB
- Use high-quality, relevant images

## SEO Checklist for Each New Page

- [ ] Unique page title
- [ ] Unique meta description
- [ ] Relevant keywords
- [ ] Canonical URL set (if needed)
- [ ] Open Graph tags for social sharing
- [ ] Twitter Card tags
- [ ] Image alt tags in content
- [ ] Proper heading structure (H1, H2, H3)
- [ ] Internal links to related content
- [ ] Schema markup (if applicable)

## Dynamic Content Example (Controller)

If you need to set meta tags from your controller:

```php
public function show($slug)
{
    $service = Service::where('slug', $slug)->firstOrFail();

    return view('frontend.services.show', [
        'service' => $service,
        'metaTitle' => $service->title . ' - Ceylon Herbal Health',
        'metaDescription' => $service->short_description,
        'metaKeywords' => implode(', ', [$service->title, 'Ayurveda', 'Natural Healing'])
    ]);
}
```

Then in your view:
```blade
@section('title', $metaTitle)
@section('meta_description', $metaDescription)
@section('meta_keywords', $metaKeywords)
```

## Testing Your Meta Tags

1. **Google Search Console**: Submit your sitemap
2. **Facebook Debugger**: https://developers.facebook.com/tools/debug/
3. **Twitter Card Validator**: https://cards-dev.twitter.com/validator
4. **LinkedIn Post Inspector**: https://www.linkedin.com/post-inspector/
5. **View Page Source**: Right-click → View Page Source to verify tags

## Common Keywords for Ceylon Herbal Health

### Primary Keywords
- Ayurveda London
- Sri Lankan Ayurveda
- Herbal Medicine London
- Natural Healing
- Ayurvedic Treatment

### Secondary Keywords
- Traditional Medicine
- Holistic Health
- Wellness Center London
- Ayurvedic Consultation
- Herbal Therapy
- Natural Remedies
- Alternative Medicine
- Ceylon Ayurveda

### Long-tail Keywords
- Authentic Sri Lankan Ayurveda in London
- Traditional Ayurvedic treatments UK
- Natural herbal medicine consultations
- Holistic wellness center London
- Book Ayurvedic appointment online
