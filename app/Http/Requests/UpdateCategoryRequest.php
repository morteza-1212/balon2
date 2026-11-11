<?php

namespace App\Http\Requests;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCategoryRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $category   = $this->route('category');
        $categoryId = $category?->id;

        $rules = [
            'icon'        => ['nullable', 'string', 'max:50'],
            'color_hex'   => ['nullable', 'string', 'regex:/^#[0-9A-Fa-f]{6}$/'],
            'sort_order'  => ['nullable', 'integer', 'min:0'],
            'status'      => ['nullable', 'boolean'],
            'is_featured' => ['nullable', 'boolean'],
            'image'       => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp,svg', 'max:2048'],
        ];

        foreach (array_keys(Category::LOCALES) as $locale) {
            $required = $locale === Category::DEFAULT_LOCALE ? 'required' : 'nullable';

            $rules["translations.{$locale}.name"] = [$required, 'string', 'max:255'];

            // نادیده گرفتن ترجمه‌های همین دسته
            $rules["translations.{$locale}.slug"] = [
                'nullable', 'string', 'max:255',
                Rule::unique('category_translations', 'slug')
                    ->where(function ($q) use ($locale, $categoryId) {
                        $q->where('locale', $locale);
                        if ($categoryId) {
                            $q->where('category_id', '!=', $categoryId);
                        }
                    }),
            ];

            $rules["translations.{$locale}.short_description"] = ['nullable', 'string', 'max:500'];
            $rules["translations.{$locale}.description"]       = ['nullable', 'string', 'max:5000'];
            $rules["translations.{$locale}.alt_text"]          = ['nullable', 'string', 'max:255'];
            $rules["translations.{$locale}.meta_title"]        = ['nullable', 'string', 'max:255'];
            $rules["translations.{$locale}.meta_description"]  = ['nullable', 'string', 'max:500'];
            $rules["translations.{$locale}.meta_keywords"]     = ['nullable', 'string', 'max:255'];
        }

        return $rules;
    }

    public function attributes(): array
    {
        return (new StoreCategoryRequest())->attributes();
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            // برای update، مقدار پیش‌فرض false است تا اگر چک‌باکس تیک نخورد، غیرفعال شود
            'status'      => $this->boolean('status', false),
            'is_featured' => $this->boolean('is_featured', false),
            'sort_order'  => $this->input('sort_order', 0),
        ]);
    }
}
