<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProductTranlation extends Model
{
    use HasFactory;

    /**
     * نام جدول — به دلیل املای خاص در migration (product_tranlations)
     * صریح تعریف شده است. اگر migration را به product_translations
     * تغییر دادید، این خط را حذف کنید.
     */
    protected $table = 'product_tranlations';

    /**
     * فیلدهای قابل پر کردن — دقیقاً مطابق ستون‌های Migration
     */
    protected $fillable = [
        'product_id',
        'locale',
        'name',
        'slug',
        'short_description',
        'description',
        'specifications',
        'features',
        'packaging',
        'shipping_info',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'alt_text',
    ];

    /**
     * تبدیل نوع فیلدها
     */
    protected function casts(): array
    {
        return [
            'product_id' => 'integer',
        ];
    }

    /* ============================================================
     |  Relationships
     ============================================================ */

    /**
     * محصول مربوطه
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /* ============================================================
     |  Scopes
     ============================================================ */

    /**
     * فیلتر بر اساس زبان
     */
    public function scopeLocale($query, string $locale)
    {
        return $query->where('locale', $locale);
    }

    /**
     * فیلتر بر اساس slug
     */
    public function scopeBySlug($query, string $slug)
    {
        return $query->where('slug', $slug);
    }
}
