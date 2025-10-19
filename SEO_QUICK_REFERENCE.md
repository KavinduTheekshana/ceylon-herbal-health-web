# SEO Meta Tags - Quick Reference Cheatsheet

## 🚀 Quick Copy-Paste Templates

### Basic Page Template
```blade
@extends('layouts.frontend')

@section('title', 'Page Title - Ceylon Herbal Health')
@section('meta_description', 'A compelling description of this page in 150-160 characters.')
@section('meta_keywords', 'keyword1, keyword2, keyword3, keyword4, keyword5')

@section('content')
    <!-- Your content here -->
@endsection
```

### Dynamic Content Page (Blog, Service, etc.)
```blade
@extends('layouts.frontend')

@section('title', $item->title . ' - Ceylon Herbal Health')
@section('meta_description', Str::limit(strip_tags($item->description), 155))
@section('meta_keywords', $item->tags ?? 'Ayurveda, Natural Healing, Ceylon Herbal Health')

@section('og_type', 'article')
@section('og_title', $item->title)
@section('og_description', Str::limit(strip_tags($item->description), 200))
@section('og_image', asset('storage/' . $item->image))

@section('canonical', url()->current())

@section('content')
    <!-- Your content here -->
@endsection
```

---

## 📄 Common Page Types

### Homepage
```blade
@section('title', 'Ceylon Herbal Health - Authentic Sri Lankan Ayurveda & Wellness in London')
@section('meta_description', 'Experience authentic Sri Lankan Ayurveda healing and wellness treatments. Book your consultation today.')
@section('meta_keywords', 'Ayurveda London, Sri Lankan Ayurveda, Natural Healing, Wellness Treatment')
```

### Services/Products Listing
```blade
@section('title', 'Our Services - Ceylon Herbal Health')
@section('meta_description', 'Explore our range of Ayurvedic treatments and wellness services.')
@section('meta_keywords', 'Ayurvedic Services, Herbal Treatments, Wellness Services')
```

### Individual Service/Product
```blade
@section('title', '{{ $service->title }} - Ceylon Herbal Health')
@section('meta_description', '{{ $service->short_description }}')
@section('og_image', asset('storage/' . $service->image))
```

### About Page
```blade
@section('title', 'About Us - Ceylon Herbal Health')
@section('meta_description', 'Learn about our mission to bring authentic Ayurveda to London.')
@section('meta_keywords', 'About Ceylon Herbal Health, Ayurveda Practitioners, Our Team')
```

### Contact Page
```blade
@section('title', 'Contact Us - Ceylon Herbal Health')
@section('meta_description', 'Get in touch with our team. Visit our clinic, call, or send a message.')
@section('meta_keywords', 'Contact, Get in Touch, Book Appointment, Location')
```

### Blog Post
```blade
@section('title', '{{ $post->title }} - Blog')
@section('meta_description', '{{ Str::limit(strip_tags($post->content), 155) }}')
@section('og_type', 'article')
```

### Booking/Appointment
```blade
@section('title', 'Book Appointment - Ceylon Herbal Health')
@section('meta_description', 'Book your personalized Ayurvedic consultation online.')
@section('meta_keywords', 'Book Appointment, Online Booking, Schedule Consultation')
```

---

## 🎯 Recommended Keywords by Page Type

### Homepage Keywords
```
Ayurveda UK, Ceylon Ayurveda, Herbal Medicine, Natural Healing,
Wellness Treatment, Holistic Health, Ayurveda United Kingdom
```

### Services Keywords
```
Ayurvedic Services, Herbal Treatments, Wellness Services, Traditional Healing,
Panchakarma, Abhyanga, Shirodhara, Ayurvedic Massage
```

### About Keywords
```
About Ceylon Herbal Health, Ayurveda Practitioners, Sri Lankan Healing,
Traditional Medicine Experts, Our Team, Wellness Philosophy
```

### Contact Keywords
```
Contact Ceylon Herbal Health, Ayurveda Clinic UK, Book Appointment,
Wellness Center Contact, Get in Touch, Location
```

### Blog Keywords
```
Ayurveda Blog, Natural Health Tips, Wellness Blog, Herbal Medicine Information,
Health Articles, Ayurvedic Lifestyle
```

---

## ✅ Character Limits Checklist

| Element | Min | Optimal | Max |
|---------|-----|---------|-----|
| Title | 30 | 50-60 | 70 |
| Meta Description | 120 | 150-160 | 320 |
| Meta Keywords | 5 words | 7-10 words | 15 words |
| OG Description | 100 | 150-200 | 300 |
| OG Image | - | 1200x630px | - |

---

## 🔧 Available Sections

All available sections you can use in your views:

```blade
@section('title', 'Your Title')
@section('meta_description', 'Your Description')
@section('meta_keywords', 'keywords, here')

@section('og_type', 'website')
@section('og_title', 'OG Title')
@section('og_description', 'OG Description')
@section('og_image', asset('path/to/image.jpg'))

@section('twitter_title', 'Twitter Title')
@section('twitter_description', 'Twitter Description')
@section('twitter_image', asset('path/to/image.jpg'))

@section('canonical', url()->current())
```

---

## 💡 Pro Tips

### 1. Title Format
```
Primary Keyword - Secondary Keyword | Brand Name
Example: Ayurvedic Massage - Natural Healing | Ceylon Herbal Health
```

### 2. Description Formula
```
Hook + Benefit + Call to Action
Example: "Experience authentic Ayurvedic healing. Improve your wellness naturally. Book your consultation today."
```

### 3. Keyword Selection
- Use Google Keyword Planner
- Check competitor pages
- Include location (London)
- Mix short and long-tail keywords
- Consider search intent

### 4. Dynamic Content
```blade
// Safe way to handle missing data
@section('title', $item->seo_title ?? $item->title . ' - Ceylon Herbal Health')
@section('meta_description', $item->seo_description ?? Str::limit(strip_tags($item->description), 155))
```

---

## 🎨 Brand Keywords

Always include these in relevant pages:
- Ceylon Herbal Health
- Ceylon Ayurveda
- United Kingdom / UK
- Authentic Ayurveda
- Natural Healing

---

## 📱 Social Media Image Sizes

### Open Graph (Facebook, LinkedIn)
- Recommended: 1200 x 630px
- Minimum: 600 x 315px
- Aspect ratio: 1.91:1

### Twitter Card
- Recommended: 1200 x 628px
- Minimum: 300 x 157px
- Aspect ratio: 2:1

---

## ⚡ Quick Commands

### Test Your Meta Tags
```bash
# View page source
curl https://your-domain.com | grep "meta"

# Check specific page
curl https://your-domain.com/about | grep "description"
```

### Validate
- Facebook: https://developers.facebook.com/tools/debug/
- Twitter: https://cards-dev.twitter.com/validator
- LinkedIn: https://www.linkedin.com/post-inspector/

---

## 🚫 Common Mistakes to Avoid

1. ❌ Using the same title on multiple pages
2. ❌ Meta descriptions over 160 characters
3. ❌ Keyword stuffing
4. ❌ Missing Open Graph images
5. ❌ Not setting canonical URLs
6. ❌ Using generic descriptions like "Welcome to our website"
7. ❌ Forgetting to include brand name in title
8. ❌ Not updating meta tags when content changes

---

## ✨ Example: Complete Blog Post

```blade
@extends('layouts.frontend')

{{-- Basic SEO --}}
@section('title', '5 Benefits of Ayurvedic Massage - Ceylon Herbal Health Blog')
@section('meta_description', 'Discover the incredible health benefits of Ayurvedic massage therapy. Learn how traditional massage techniques can improve your wellness naturally.')
@section('meta_keywords', 'Ayurvedic Massage, Massage Benefits, Natural Therapy, Abhyanga, Wellness, Health Benefits')

{{-- Open Graph --}}
@section('og_type', 'article')
@section('og_title', '5 Benefits of Ayurvedic Massage You Need to Know')
@section('og_description', 'Explore the ancient healing power of Ayurvedic massage and its modern health benefits.')
@section('og_image', asset('storage/blog/ayurvedic-massage-benefits.jpg'))

{{-- Twitter Card --}}
@section('twitter_title', '5 Amazing Benefits of Ayurvedic Massage')
@section('twitter_description', 'Traditional Ayurvedic massage offers incredible health benefits. Learn more.')
@section('twitter_image', asset('storage/blog/ayurvedic-massage-benefits.jpg'))

{{-- Canonical --}}
@section('canonical', route('blog.show', 'ayurvedic-massage-benefits'))

@section('content')
    <!-- Your blog post content -->
@endsection
```

---

**Quick Access**:
- Full Guide: `SEO_META_TAGS_GUIDE.md`
- Implementation Summary: `SEO_IMPLEMENTATION_SUMMARY.md`
