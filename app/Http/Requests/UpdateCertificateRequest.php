<?php

namespace App\Http\Requests;

use App\Models\Certificate;
use Illuminate\Foundation\Http\FormRequest;

class UpdateCertificateRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $certificate = $this->route('certificate');
        $id = $certificate instanceof Certificate ? $certificate->id : $certificate;

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

        foreach ($this->input('translations', []) as $i => $tr) {
            if (!empty($tr['slug']) && !empty($tr['locale'])) {
                $rules["translations.{$i}.slug"] = 'string|max:255|unique:certificate_translations,slug,' .
                    $this->existingTranslationId($id, $tr['locale']) .
                    ',id,locale,' . $tr['locale'];
            }
        }

        return $rules;
    }

    private function existingTranslationId(int $certificateId, string $locale): ?int
    {
        return \App\Models\CertificatTranslation::where('certificate_id', $certificateId)
            ->where('locale', $locale)
            ->value('id');
    }

    public function messages(): array
    {
        return (new StoreCertificateRequest())->messages();
    }
}
