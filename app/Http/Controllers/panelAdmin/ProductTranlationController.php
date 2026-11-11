<?php

namespace App\Http\Controllers\panelAdmin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductTranlation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProductTranlationController extends Controller
{
    /* ============================================================
     |  Index
     ============================================================ */
    public function index(Product $product): View
    {
        $product->load(['translations', 'category.translations']);

        return view(
            'panelAdmin.product.productTranslation.index',
            compact('product')
        );
    }

    /* ============================================================
     |  Create
     ============================================================ */
    public function create(Product $product): View
    {
        $existingLocales = $product
            ->translations()
            ->pluck('locale')
            ->toArray();

        $locales = Product::LOCALES;

        return view(
            'panelAdmin.product.productTranslation.create',
            compact('product', 'existingLocales', 'locales')
        );
    }

    /* ============================================================
     |  Store
     ============================================================ */
    public function store(Request $request, Product $product): RedirectResponse
    {
        $validated = $request->validate(
            $this->rules($product),
            $this->messages()
        );

        // اگر slug خالی بود، خودکار ساخته می‌شود
        if (empty($validated['slug'])) {
            $validated['slug'] = Product::generateUniqueSlug(
                $validated['name'],
                $validated['locale']
            );
        }

        $product->translations()->create($validated);

        return redirect()
            ->route('admin.product.translation.index', $product)
            ->with('success', 'ترجمه محصول با موفقیت ایجاد شد.');
    }

    /* ============================================================
     |  Edit
     ============================================================ */
    public function edit(Product $product, ProductTranlation $translation): View
    {
        abort_unless($translation->product_id === $product->id, 404);

        $locales = Product::LOCALES;

        return view(
            'panelAdmin.product.productTranslation.edit',
            compact('product', 'translation', 'locales')
        );
    }

    /* ============================================================
     |  Update
     ============================================================ */
    public function update(
        Request $request,
        Product $product,
        ProductTranlation $translation
    ): RedirectResponse {
        abort_unless($translation->product_id === $product->id, 404);

        $validated = $request->validate(
            $this->rules($product, $translation),
            $this->messages()
        );

        if (empty($validated['slug'])) {
            $validated['slug'] = Product::generateUniqueSlug(
                $validated['name'],
                $validated['locale'],
                $translation->id
            );
        }

        $translation->update($validated);

        return redirect()
            ->route('admin.product.translation.index', $product)
            ->with('success', 'ترجمه با موفقیت بروزرسانی شد.');
    }

    /* ============================================================
     |  Destroy
     ============================================================ */
    public function destroy(Product $product, ProductTranlation $translation): RedirectResponse
    {
        abort_unless($translation->product_id === $product->id, 404);

        $translation->delete();

        return redirect()
            ->route('admin.product.translation.index', $product)
            ->with('success', 'ترجمه با موفقیت حذف شد.');
    }

    /* ============================================================
     |  Validation Rules
     ============================================================ */
    protected function rules(
        Product $product,
        ?ProductTranlation $translation = null
    ): array {
        $translationId = $translation?->id;

        return [

            // زبان
            'locale' => [
                'required',
                Rule::in(array_keys(Product::LOCALES)),

                // هر محصول فقط یک ترجمه برای هر زبان
                Rule::unique('product_tranlations', 'locale')
                    ->where(fn ($q) => $q->where('product_id', $product->id))
                    ->ignore($translationId),
            ],

            // نام
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            // Slug
            'slug' => [
                'nullable',
                'string',
                'max:255',

                // slug در هر زبان یکتا باشد
                Rule::unique('product_tranlations', 'slug')
                    ->where(fn ($q) => $q->where('locale', request('locale')))
                    ->ignore($translationId),
            ],

            // محتوای اصلی
            'short_description' => ['nullable', 'string'],
            'description'       => ['nullable', 'string'],
            'specifications'    => ['nullable', 'string'],
            'features'          => ['nullable', 'string'],
            'packaging'         => ['nullable', 'string'],
            'shipping_info'     => ['nullable', 'string'],

            // SEO
            'meta_title'       => ['nullable', 'string', 'max:255'],
            'meta_description' => ['nullable', 'string', 'max:500'],
            'meta_keywords'    => ['nullable', 'string', 'max:500'],

            // متن جایگزین تصویر
            'alt_text' => ['nullable', 'string', 'max:255'],
        ];
    }

    /* ============================================================
     |  Validation Messages
     ============================================================ */
    protected function messages(): array
    {
        return [
            'locale.required' => 'انتخاب زبان الزامی است.',
            'locale.in'       => 'زبان انتخاب‌شده معتبر نیست.',
            'locale.unique'   => 'برای این محصول، ترجمه این زبان قبلاً ثبت شده است.',

            'name.required' => 'نام محصول الزامی است.',
            'name.max'      => 'نام محصول نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'slug.max'    => 'Slug نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'slug.unique' => 'این Slug قبلاً برای این زبان استفاده شده است.',

            'meta_title.max'       => 'عنوان متا نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'meta_description.max' => 'توضیحات متا نمی‌تواند بیشتر از ۵۰۰ کاراکتر باشد.',
            'meta_keywords.max'    => 'کلمات کلیدی نمی‌تواند بیشتر از ۵۰۰ کاراکتر باشد.',

            'alt_text.max' => 'متن جایگزین تصویر نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
        ];
    }
}
