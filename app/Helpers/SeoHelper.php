<?php

namespace App\Helpers;

use App\Models\SeoSetting;
use Illuminate\Support\Facades\Route;

class SeoHelper
{
    /**
     * Get SEO settings for current page or by key
     */
    public static function get(?string $key = null): array
    {
        // If no key provided, try to determine from route
        if (!$key) {
            $key = self::getKeyFromRoute();
        }

        // Get settings from database
        $settings = SeoSetting::getByKey($key);

        // If not found, use default settings
        if (!$settings) {
            $settings = SeoSetting::getDefault();
        }

        // If still not found, return empty defaults
        if (!$settings) {
            return self::getEmptyDefaults();
        }

        return $settings->toSeoArray();
    }

    /**
     * Determine SEO key from current route
     */
    protected static function getKeyFromRoute(): string
    {
        $routeName = Route::currentRouteName();

        // Map route names to SEO keys
        $routeMap = [
            'home' => 'home',
            'services.index' => 'services',
            'services.show' => 'service',
            'about' => 'about',
            'contact' => 'contact',
            'appointments.create' => 'appointment',
            'booking' => 'appointment',
            'blog.index' => 'blog',
            'blog.show' => 'blog-post',
        ];

        return $routeMap[$routeName] ?? 'default';
    }

    /**
     * Get empty defaults
     */
    protected static function getEmptyDefaults(): array
    {
        return [
            'title' => 'Ceylon Herbal Health - Authentic Ceylon Ayurveda & Wellness in the UK',
            'meta_description' => 'Experience authentic Ceylon Ayurveda healing and wellness treatments at Ceylon Herbal Health. Book your personalized consultation with our qualified practitioners in the United Kingdom.',
            'meta_keywords' => 'Ayurveda UK, Ceylon Ayurveda, Herbal Medicine, Natural Healing, Wellness Treatment, Ayurvedic Consultation, Traditional Medicine, Holistic Health, Ayurveda United Kingdom',
            'og_title' => 'Ceylon Herbal Health - Authentic Ceylon Ayurveda',
            'og_description' => 'Experience authentic Ceylon Ayurveda healing and wellness treatments at Ceylon Herbal Health.',
            'og_image' => asset('images/og-image.jpg'),
            'og_type' => 'website',
            'twitter_title' => 'Ceylon Herbal Health - Authentic Ceylon Ayurveda',
            'twitter_description' => 'Experience authentic Ceylon Ayurveda healing and wellness treatments.',
            'twitter_image' => asset('images/og-image.jpg'),
            'canonical_url' => url()->current(),
            'robots' => 'index, follow',
        ];
    }

    /**
     * Get favicon URL
     */
    public static function getFavicon(): string
    {
        $default = SeoSetting::getDefault();

        if ($default && $default->favicon) {
            return asset('storage/' . $default->favicon);
        }

        return asset('frontend/images/favicon.svg');
    }

    /**
     * Get apple touch icon URL
     */
    public static function getAppleTouchIcon(): string
    {
        $default = SeoSetting::getDefault();

        if ($default && $default->apple_touch_icon) {
            return asset('storage/' . $default->apple_touch_icon);
        }

        return asset('images/apple-touch-icon.png');
    }
}
