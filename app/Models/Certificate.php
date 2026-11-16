<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Certificate extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category',
        'image',
        'file',
        'certificate_number',
        'issuer',
        'issued_at',
        'expires_at',
        'sort_order',
        'is_active',
        'is_featured',
        'views',
        'published_at',
    ];

    protected $casts = [
        'is_active'    => 'boolean',
        'is_featured'  => 'boolean',
        'issued_at'    => 'date',
        'expires_at'   => 'date',
        'published_at' => 'datetime',
        'views'        => 'integer',
        'sort_order'   => 'integer',
    ];

    /* ==========================================================
       ثابت‌ها
       ========================================================== */
    public const CATEGORIES = [
        'license'      => 'مجوز فعالیت',
        'standard'     => 'گواهینامه استاندارد',
        'technical'    => 'تأییدیه فنی',
        'registration' => 'مدارک ثبتی',
        'quality'      => 'کنترل کیفیت',
        'other'        => 'سایر مستندات',
    ];

    public const LOCALES = [
        'fa' => 'فارسی',
        'ar' => 'العربیة',
        'en' => 'English',
    ];

    /* ==========================================================
       روابط
       ========================================================== */
    public function translations()
    {
        return $this->hasMany(CertificatTranslation::class);
    }

    public function translation()
    {
        return $this->hasOne(CertificatTranslation::class)
            ->where('locale', app()->getLocale());
    }

    /* ==========================================================
       اکسسورهای ترجمه
       ========================================================== */
    public function getTranslation(?string $locale = null): ?CertificatTranslation
    {
        $locale = $locale ?? app()->getLocale();

        return $this->translations->firstWhere('locale', $locale)
            ?? $this->translations->firstWhere('locale', 'fa')
            ?? $this->translations->first();
    }

    public function translate(string $locale): ?CertificatTranslation
    {
        return $this->translations->firstWhere('locale', $locale);
    }

    public function getTitleAttribute(): ?string
    {
        return $this->getTranslation()?->title;
    }

    public function getDescriptionAttribute(): ?string
    {
        return $this->getTranslation()?->description;
    }

    public function getImageAltAttribute(): ?string
    {
        return $this->getTranslation()?->image_alt;
    }

    public function getSlugAttribute(): ?string
    {
        return $this->getTranslation()?->slug;
    }

    /* ==========================================================
       اکسسورهای فایل و وضعیت
       ========================================================== */
    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset('storage/' . $this->image) : null;
    }

    public function getFileUrlAttribute(): ?string
    {
        return $this->file ? asset('storage/' . $this->file) : null;
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? 'نامشخص';
    }

    public function getIsExpiredAttribute(): bool
    {
        return $this->expires_at && $this->expires_at->isPast();
    }

    /* ==========================================================
       اسکوپ‌ها
       ========================================================== */
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
        return $query->orderBy('sort_order')->orderByDesc('id');
    }

    public function scopePublished($query)
    {
        return $query->where(function ($q) {
            $q->whereNull('published_at')
                ->orWhere('published_at', '<=', now());
        });
    }

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? null, function ($q, $search) {
            $q->whereHas('translations', function ($t) use ($search) {
                $t->where('title', 'like', "%{$search}%")
                    ->orWhere('description', 'like', "%{$search}%");
            })->orWhere('certificate_number', 'like', "%{$search}%")
                ->orWhere('issuer', 'like', "%{$search}%");
        });

        $query->when($filters['category'] ?? null, function ($q, $category) {
            $q->where('category', $category);
        });

        $query->when(isset($filters['status']) && $filters['status'] !== '', function ($q) use ($filters) {
            $q->where('is_active', (bool) $filters['status']);
        });
    }
}
