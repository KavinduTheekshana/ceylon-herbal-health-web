<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class SeoSetting extends Model
{
    protected $fillable = [
        'key',
        'page_name',
        'title',
        'meta_description',
        'meta_keywords',
        'og_title',
        'og_description',
        'og_image',
        'og_type',
        'twitter_title',
        'twitter_description',
        'twitter_image',
        'canonical_url',
        'robots',
        'favicon',
        'apple_touch_icon',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Boot the model.
     */
    protected static function booted()
    {
        // Clear cache when SEO settings are updated
        static::saved(function () {
            Cache::forget('seo_settings');
        });

        static::deleted(function () {
            Cache::forget('seo_settings');
        });
    }

    /**
     * Get SEO settings by key with caching
     */
    public static function getByKey(string $key): ?self
    {
        $settings = Cache::remember('seo_settings', 3600, function () {
            return self::where('is_active', true)->get()->keyBy('key');
        });

        return $settings->get($key);
    }

    /**
     * Get default SEO settings
     */
    public static function getDefault(): ?self
    {
        return self::getByKey('default');
    }

    /**
     * Get SEO data as array for easy use in views
     */
    public function toSeoArray(): array
    {
        return [
            'title' => $this->title,
            'meta_description' => $this->meta_description,
            'meta_keywords' => $this->meta_keywords,
            'og_title' => $this->og_title ?? $this->title,
            'og_description' => $this->og_description ?? $this->meta_description,
            'og_image' => $this->og_image,
            'og_type' => $this->og_type,
            'twitter_title' => $this->twitter_title ?? $this->title,
            'twitter_description' => $this->twitter_description ?? $this->meta_description,
            'twitter_image' => $this->twitter_image ?? $this->og_image,
            'canonical_url' => $this->canonical_url,
            'robots' => $this->robots,
        ];
    }
}
