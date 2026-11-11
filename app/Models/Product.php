<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'code',
        'sku',
        'image',
        'gallery',
        'is_active',
        'is_featured',
        'sort_order',
        'stock_status',

        // مشخصات فیزیکی مشترک
        'height_m',
        'diameter_m',
        'volume_m3',
        'weight_kg',
        'payload_kg',
        'material',
        'gas_type',
        'max_altitude_m',
        'flight_duration_h',

        // اختصاصی نظامی
        'security_level',
        'radar_range_km',
        'camera_payload_type',
        'deployment_type',
        'encryption_capability',
        'military_standard',
        'operating_temp_min',
        'operating_temp_max',
        'wind_resistance_kmh',

        // اختصاصی پژوهشی
        'research_field',
        'sensor_type',
        'data_logger',
        'data_transmission',
        'lab_standard',
        'calibration_certificate',
        'sampling_capability',
        'custom_dimensions',

        // اختصاصی تبلیغاتی
        'printing_method',
        'print_resolution_dpi',
        'print_colors',
        'print_area_m2',
        'branding_led',
        'indoor_outdoor',
        'inflatable_days',
        'reusable',
        'setup_time_min',
        'custom_logo',

        // قیمت
        'price_from',
        'price_currency',
    ];

    protected $casts = [
        'category_id'             => 'integer',
        'gallery'                 => 'array',
        'is_active'               => 'boolean',
        'is_featured'             => 'boolean',
        'sort_order'              => 'integer',

        'height_m'                => 'decimal:2',
        'diameter_m'              => 'decimal:2',
        'volume_m3'               => 'decimal:2',
        'weight_kg'               => 'decimal:2',
        'payload_kg'              => 'decimal:2',
        'max_altitude_m'          => 'integer',
        'flight_duration_h'       => 'decimal:2',

        'radar_range_km'          => 'decimal:2',
        'encryption_capability'   => 'boolean',
        'operating_temp_min'      => 'integer',
        'operating_temp_max'      => 'integer',
        'wind_resistance_kmh'     => 'integer',

        'data_logger'             => 'boolean',
        'calibration_certificate' => 'boolean',
        'sampling_capability'     => 'boolean',
        'custom_dimensions'       => 'boolean',

        'print_resolution_dpi'    => 'integer',
        'print_colors'            => 'integer',
        'print_area_m2'           => 'decimal:2',
        'branding_led'            => 'boolean',
        'inflatable_days'         => 'integer',
        'reusable'                => 'boolean',
        'setup_time_min'          => 'integer',
        'custom_logo'             => 'boolean',

        'price_from'              => 'decimal:2',
    ];

    /* ============================================================
     |  Constants
     ============================================================ */

    public const LOCALES = [
        'fa' => 'فارسی',
        'ar' => 'العربية',
        'en' => 'English',
    ];

    public const DEFAULT_LOCALE = 'fa';

    public const STOCK_STATUSES = [
        'in_stock'     => ['fa' => 'موجود',   'ar' => 'متوفر',     'en' => 'In Stock'],
        'out_of_stock' => ['fa' => 'ناموجود', 'ar' => 'غير متوفر', 'en' => 'Out of Stock'],
        'on_request'   => ['fa' => 'استعلام', 'ar' => 'حسب الطلب', 'en' => 'On Request'],
    ];

    public const SECURITY_LEVELS = [
        'public'       => ['fa' => 'عمومی',    'ar' => 'عام',      'en' => 'Public'],
        'confidential' => ['fa' => 'محرمانه',  'ar' => 'سري',      'en' => 'Confidential'],
        'secret'       => ['fa' => 'سری',      'ar' => 'سري للغاية','en' => 'Secret'],
    ];

    public const DEPLOYMENT_TYPES = [
        'mobile'   => ['fa' => 'متحرک',  'ar' => 'متحرك',  'en' => 'Mobile'],
        'fixed'    => ['fa' => 'ثابت',   'ar' => 'ثابت',   'en' => 'Fixed'],
        'portable' => ['fa' => 'قابل حمل','ar' => 'محمول', 'en' => 'Portable'],
    ];

    public const DATA_TRANSMISSIONS = [
        'radio'     => ['fa' => 'رادیویی', 'ar' => 'راديو',    'en' => 'Radio'],
        'gsm'       => ['fa' => 'GSM',     'ar' => 'GSM',      'en' => 'GSM'],
        'satellite' => ['fa' => 'ماهواره', 'ar' => 'الأقمار الصناعية', 'en' => 'Satellite'],
        'none'      => ['fa' => 'بدون انتقال','ar' => 'بدون نقل', 'en' => 'None'],
    ];

    public const PRINTING_METHODS = [
        'digital'     => ['fa' => 'دیجیتال',  'ar' => 'رقمي',    'en' => 'Digital'],
        'screen'      => ['fa' => 'اسکرین',   'ar' => 'شاشة',    'en' => 'Screen'],
        'sublimation' => ['fa' => 'تصعیدی',   'ar' => 'تصعيدي',  'en' => 'Sublimation'],
    ];

    public const INDOOR_OUTDOOR = [
        'indoor'  => ['fa' => 'داخلی',       'ar' => 'داخلي',       'en' => 'Indoor'],
        'outdoor' => ['fa' => 'بیرونی',      'ar' => 'خارجي',       'en' => 'Outdoor'],
        'both'    => ['fa' => 'داخلی و بیرونی','ar' => 'داخلي وخارجي','en' => 'Both'],
    ];

    /* ============================================================
     |  Relationships
     ============================================================ */

    public function translations(): HasMany
    {
        return $this->hasMany(ProductTranslation::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    /* ============================================================
     |  Boot (تولید خودکار code)
     ============================================================ */

    protected static function booted(): void
    {
        static::creating(function (Product $product) {
            if (empty($product->code)) {
                $product->code = static::generateUniqueCode();
            }
        });
    }

    /* ============================================================
     |  Helpers
     ============================================================ */

    /**
     * تولید کد خودکار
     * فرمت: PRD-YYYYMMDD-XXXX
     */
    public static function generateUniqueCode(): string
    {
        $prefix = 'PRD-' . now()->format('Ymd') . '-';

        $lastCode = static::query()
            ->where('code', 'like', $prefix . '%')
            ->orderByDesc('id')
            ->value('code');

        $nextNumber = $lastCode
            ? ((int) substr($lastCode, -4)) + 1
            : 1;

        $code = $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);

        while (static::where('code', $code)->exists()) {
            $nextNumber++;
            $code = $prefix . str_pad($nextNumber, 4, '0', STR_PAD_LEFT);
        }

        return $code;
    }

    /**
     * تولید slug یکتا در یک زبان
     */
    public static function generateUniqueSlug(string $name, string $locale, ?int $ignoreProductId = null): string
    {
        $base = trim($name);
        $base = preg_replace('/\s+/u', '-', $base);
        $base = preg_replace('/[^\p{L}\p{N}\-]+/u', '', $base);
        $base = mb_strtolower($base, 'UTF-8');

        if ($locale === 'en') {
            $base = Str::slug($base);
        }

        $base = $base ?: 'product';
        $slug = $base;
        $count = 1;

        while (
        ProductTranslation::where('locale', $locale)
            ->where('slug', $slug)
            ->when($ignoreProductId, fn ($q) => $q->where('product_id', '!=', $ignoreProductId))
            ->exists()
        ) {
            $slug = $base . '-' . $count++;
        }

        return $slug;
    }

    /**
     * ترجمه زبان جاری با fallback
     */
    public function translation(?string $locale = null): ?ProductTranslation
    {
        $locale = $locale ?? app()->getLocale();

        if ($this->relationLoaded('translations')) {
            return $this->translations->firstWhere('locale', $locale)
                ?? $this->translations->firstWhere('locale', self::DEFAULT_LOCALE);
        }

        return $this->translations()
            ->where('locale', $locale)
            ->first()
            ?? $this->translations()
                ->where('locale', self::DEFAULT_LOCALE)
                ->first();
    }

    /* ============================================================
     |  Accessors
     ============================================================ */

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getGalleryUrlsAttribute(): array
    {
        if (empty($this->gallery)) {
            return [];
        }

        return array_map(
            fn ($path) => asset('storage/' . $path),
            $this->gallery
        );
    }

    public function getNameAttribute(): ?string
    {
        return $this->translation()?->name;
    }

    public function getSlugAttribute(): ?string
    {
        return $this->translation()?->slug;
    }

    public function getShortDescriptionAttribute(): ?string
    {
        return $this->translation()?->short_description;
    }

    public function getDescriptionAttribute(): ?string
    {
        return $this->translation()?->description;
    }

    public function getAltTextAttribute(): ?string
    {
        return $this->translation()?->alt_text;
    }

    /* ============================================================
     |  Label Accessors (enum → متن چندزبانه)
     ============================================================ */

    public function getStockStatusLabelAttribute(): string
    {
        return $this->labelFor(self::STOCK_STATUSES, $this->stock_status);
    }

    public function getSecurityLevelLabelAttribute(): ?string
    {
        return $this->labelFor(self::SECURITY_LEVELS, $this->security_level);
    }

    public function getDeploymentTypeLabelAttribute(): ?string
    {
        return $this->labelFor(self::DEPLOYMENT_TYPES, $this->deployment_type);
    }

    public function getDataTransmissionLabelAttribute(): ?string
    {
        return $this->labelFor(self::DATA_TRANSMISSIONS, $this->data_transmission);
    }

    public function getPrintingMethodLabelAttribute(): ?string
    {
        return $this->labelFor(self::PRINTING_METHODS, $this->printing_method);
    }

    public function getIndoorOutdoorLabelAttribute(): ?string
    {
        return $this->labelFor(self::INDOOR_OUTDOOR, $this->indoor_outdoor);
    }

    /**
     * helper مشترک برای خواندن برچسب enum با fallback زبان
     */
    protected function labelFor(array $map, ?string $key): ?string
    {
        if (! $key || ! isset($map[$key])) {
            return $key;
        }

        $locale = app()->getLocale();

        return $map[$key][$locale]
            ?? $map[$key][self::DEFAULT_LOCALE]
            ?? $key;
    }

    /* ============================================================
     |  Helpers — نوع محصول
     ============================================================ */

    public function isMilitary(): bool
    {
        return $this->category?->code === Category::CODE_MILITARY;
    }

    public function isResearch(): bool
    {
        return $this->category?->code === Category::CODE_RESEARCH;
    }

    public function isPromotional(): bool
    {
        return $this->category?->code === Category::CODE_PROMOTIONAL;
    }

    public function isInStock(): bool
    {
        return $this->stock_status === 'in_stock';
    }

    /* ============================================================
     |  Scopes
     ============================================================ */

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order')->orderByDesc('created_at');
    }

    public function scopeInStock($query)
    {
        return $query->where('stock_status', 'in_stock');
    }

    public function scopeOnRequest($query)
    {
        return $query->where('stock_status', 'on_request');
    }

    public function scopeOfCategory($query, int $categoryId)
    {
        return $query->where('category_id', $categoryId);
    }

    public function scopeOfCategoryCode($query, string $code)
    {
        return $query->whereHas('category', fn ($q) => $q->where('code', $code));
    }

    public function scopeMilitary($query)
    {
        return $query->ofCategoryCode(Category::CODE_MILITARY);
    }

    public function scopeResearch($query)
    {
        return $query->ofCategoryCode(Category::CODE_RESEARCH);
    }

    public function scopePromotional($query)
    {
        return $query->ofCategoryCode(Category::CODE_PROMOTIONAL);
    }

    public function scopeSearch($query, string $term)
    {
        return $query->where(function ($q) use ($term) {
            $q->where('code', 'like', "%{$term}%")
                ->orWhere('sku', 'like', "%{$term}%")
                ->orWhereHas('translations', function ($sub) use ($term) {
                    $sub->where('name', 'like', "%{$term}%")
                        ->orWhere('short_description', 'like', "%{$term}%")
                        ->orWhere('description', 'like', "%{$term}%");
                });
        });
    }
}
