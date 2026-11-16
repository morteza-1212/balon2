<?php

namespace App\Http\Requests;

use App\Models\Certificate;
use Illuminate\Foundation\Http\FormRequest;

class StoreCertificateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // یا gate/سیاست دسترسی
    }

    public function rules(): array
    {
        $rules = [
            'category'           => 'required|in:' . implode(',', array_keys(Certificate::CATEGORIES)),
            'image'              => 'nullable|image|mimes:webp,jpg,jpeg,png|max:4096',
            'file'               => 'nullable|mimes:pdf|max:8192',
            'certificate_number' => 'nullable|string|max:255',
            'issuer'             => 'nullable|string|max:255',
            'issued_at'          => 'nullable|date',
            'expires_at'         => 'nullable|date|after_or_equal:issued_at',
            'sort_order'         => 'nullable|integer|min:0',
            'is_active'          => 'boolean',
            'is_featured'        => 'boolean',
            'published_at'       => 'nullable|date',

            'translations'                    => 'required|array|min:1',
            'translations.*.locale'           => 'nullable|in:' . implode(',', array_keys(Certificate::LOCALES)),
            'translations.*.title'            => 'nullable|string|max:255',
            'translations.*.description'      => 'nullable|string',
            'translations.*.image_alt'        => 'nullable|string|max:255',
            'translations.*.slug'             => 'nullable|string|max:255',
            'translations.*.meta_title'       => 'nullable|string|max:255',
            'translations.*.meta_description' => 'nullable|string|max:500',
            'translations.*.meta_keywords'    => 'nullable|string|max:255',
        ];

        // یکتایی slug در هر زبان
        foreach ($this->input('translations', []) as $i => $tr) {
            if (!empty($tr['slug'])) {
                $rules["translations.{$i}.slug"] = 'string|max:255|unique:certificate_translations,slug,NULL,id,locale,' . ($tr['locale'] ?? '');
            }
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'category.required'         => 'دسته‌بندی مدرک الزامی است.',
            'category.in'               => 'دسته‌بندی انتخاب‌شده معتبر نیست.',
            'image.image'               => 'فایل تصویر باید از نوع تصویر باشد.',
            'image.mimes'               => 'فرمت تصویر باید webp، jpg، jpeg یا png باشد.',
            'image.max'                 => 'حجم تصویر نباید بیش از ۴ مگابایت باشد.',
            'file.mimes'                => 'فایل مدرک باید PDF باشد.',
            'file.max'                  => 'حجم فایل نباید بیش از ۸ مگابایت باشد.',
            'expires_at.after_or_equal' => 'تاریخ انقضا نمی‌تواند قبل از تاریخ صدور باشد.',
            'translations.required'     => 'حداقل یک ترجمه الزامی است.',
            'translations.*.locale.required' => 'زبان ترجمه الزامی است.',
            'translations.*.locale.in'  => 'زبان انتخاب‌شده معتبر نیست.',
            'translations.*.title.required' => 'عنوان در هر زبان الزامی است.',
        ];
    }

    public function attributes(): array
    {
        return [
            'translations.*.title'       => 'عنوان',
            'translations.*.description' => 'توضیحات',
            'translations.*.slug'        => 'نامک (slug)',
            'issued_at'                  => 'تاریخ صدور',
            'expires_at'                 => 'تاریخ انقضا',
        ];
    }
}
