<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CertificatTranslation extends Model
{
    /**
     * نام جدول صریحاً تعیین شود تا وابسته به نام کلاس نباشد
     */
    protected $table = 'certificate_translations';

    protected $fillable = [
        'certificate_id',
        'locale',
        'title',
        'description',
        'image_alt',
        'slug',
        'meta_title',
        'meta_description',
        'meta_keywords',
    ];

    public function certificate()
    {
        return $this->belongsTo(Certificate::class);
    }

    public function scopeLocale($query, string $locale)
    {
        return $query->where('locale', $locale);
    }
}
