<?php

namespace App\Http\Controllers\panelAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCategoryTranslationRequest;
use App\Http\Requests\UpdateCategoryTranslationRequest;
use App\Models\Category;
use App\Models\CategoryTranslation;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class CategoryTranslationController extends Controller
{
    /* ============================================================
     |  Index
     ============================================================ */
    public function index(Request $request): View
    {
        $translations = CategoryTranslation::query()
            ->with('category.translations')
            ->when($request->filled('locale'), function ($q) use ($request) {
                $q->where('locale', $request->string('locale'));
            })
            ->when($request->filled('category'), function ($q) use ($request) {
                $q->where('category_id', $request->integer('category'));
            })
            ->when($request->filled('search'), function ($q) use ($request) {
                $term = $request->string('search');
                $q->where(function ($sub) use ($term) {
                    $sub->where('name', 'like', "%{$term}%")
                        ->orWhere('slug', 'like', "%{$term}%");
                });
            })
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $categories = Category::with('translations')->ordered()->get();

        return view(
            'panelAdmin.category.categoryTranslation.index',
            compact('translations', 'categories')
        );
    }

    /* ============================================================
     |  Create
     ============================================================ */
    public function create(Request $request): View
    {
        $categories = Category::with('translations')->ordered()->get();

        // اگر category_id از طریق query string پاس داده شده باشد
        $selectedCategoryId = $request->integer('category');

        return view(
            'panelAdmin.category.categoryTranslation.create',
            compact('categories', 'selectedCategoryId')
        );
    }

    /* ============================================================
     |  Store
     ============================================================ */
    public function store(StoreCategoryTranslationRequest $request): RedirectResponse
    {
        $validated = $request->validate(
            $this->validationRules(),
            $this->validationMessages()
        );

        CategoryTranslation::create($validated);

        return redirect()
            ->route('admin.category.translation.index')
            ->with('success', 'ترجمه دسته‌بندی با موفقیت ایجاد شد.');
    }

    /* ============================================================
     |  Show
     ============================================================ */
    public function show(CategoryTranslation $categoryTranslation): View
    {
        $categoryTranslation->load('category.translations');

        return view(
            'panelAdmin.category.categoryTranslation.show',
            compact('categoryTranslation')
        );
    }

    /* ============================================================
     |  Edit
     ============================================================ */
    public function edit(CategoryTranslation $categoryTranslation): View
    {
        $categoryTranslation->load('category.translations');

        $categories = Category::with('translations')->ordered()->get();

        return view(
            'panelAdmin.category.categoryTranslation.edit',
            compact('categoryTranslation', 'categories')
        );
    }

    /* ============================================================
     |  Update
     ============================================================ */
    public function update(
        UpdateCategoryTranslationRequest $request,
        CategoryTranslation $categoryTranslation
    ): RedirectResponse {

        $validated = $request->validate(
            $this->validationRules($categoryTranslation),
            $this->validationMessages()
        );

        $categoryTranslation->update($validated);

        return redirect()
            ->route('admin.category.translation.index')
            ->with('success', 'ترجمه دسته‌بندی با موفقیت بروزرسانی شد.');
    }

    /* ============================================================
     |  Destroy
     ============================================================ */
    public function destroy(
        CategoryTranslation $categoryTranslation
    ): RedirectResponse {

        $categoryTranslation->delete();

        return redirect()
            ->route('admin.category.translation.index')
            ->with('success', 'ترجمه دسته‌بندی با موفقیت حذف شد.');
    }

    /* ============================================================
     |  Validation Rules
     ============================================================ */
    protected function validationRules(
        ?CategoryTranslation $translation = null
    ): array {

        $translationId = $translation?->id;

        return [

            /* ---------- دسته‌بندی ---------- */
            'category_id' => [
                'required',
                'integer',
                'exists:categories,id',
            ],

            /* ---------- زبان ---------- */
            'locale' => [
                'required',
                'string',
                Rule::in(array_keys(Category::LOCALES)),

                // هر دسته فقط یک ترجمه برای هر زبان
                Rule::unique('category_translations', 'locale')
                    ->where(fn ($q) => $q->where('category_id', request('category_id')))
                    ->ignore($translationId),
            ],

            /* ---------- نام ---------- */
            'name' => [
                'required',
                'string',
                'min:2',
                'max:255',
            ],

            /* ---------- Slug ---------- */
            'slug' => [
                'required',
                'string',
                'max:255',
                'regex:/^[\p{L}\p{N}]+(?:-[\p{L}\p{N}]+)*$/u',

                // slug در هر زبان یکتا باشد
                Rule::unique('category_translations', 'slug')
                    ->where(fn ($q) => $q->where('locale', request('locale')))
                    ->ignore($translationId),
            ],

            /* ---------- توضیح کوتاه ---------- */
            'short_description' => [
                'nullable',
                'string',
                'max:500',
            ],

            /* ---------- توضیحات کامل ---------- */
            'description' => [
                'nullable',
                'string',
            ],

            /* ---------- SEO ---------- */
            'meta_title' => [
                'nullable',
                'string',
                'max:255',
            ],

            'meta_description' => [
                'nullable',
                'string',
                'max:500',
            ],

            'meta_keywords' => [
                'nullable',
                'string',
                'max:500',
            ],

            /* ---------- متن جایگزین تصویر ---------- */
            'alt_text' => [
                'nullable',
                'string',
                'max:255',
            ],
        ];
    }

    /* ============================================================
     |  Validation Messages
     ============================================================ */
    protected function validationMessages(): array
    {
        return [

            'category_id.required' => 'انتخاب دسته‌بندی الزامی است.',
            'category_id.integer'  => 'شناسه دسته‌بندی نامعتبر است.',
            'category_id.exists'   => 'دسته‌بندی انتخاب‌شده وجود ندارد.',

            'locale.required' => 'انتخاب زبان الزامی است.',
            'locale.in'       => 'زبان انتخاب‌شده معتبر نیست.',
            'locale.unique'   => 'برای این دسته‌بندی، ترجمه این زبان قبلاً ثبت شده است.',

            'name.required' => 'نام دسته‌بندی الزامی است.',
            'name.min'      => 'نام دسته‌بندی باید حداقل ۲ کاراکتر باشد.',
            'name.max'      => 'نام دسته‌بندی نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',

            'slug.required' => 'Slug الزامی است.',
            'slug.max'      => 'Slug نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'slug.regex'    => 'Slug باید فقط شامل حروف، اعداد و خط تیره باشد.',
            'slug.unique'   => 'این Slug قبلاً برای این زبان استفاده شده است.',

            'short_description.max' => 'توضیح کوتاه نمی‌تواند بیشتر از ۵۰۰ کاراکتر باشد.',

            'meta_title.max'       => 'عنوان سئو نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
            'meta_description.max' => 'توضیحات سئو نمی‌تواند بیشتر از ۵۰۰ کاراکتر باشد.',
            'meta_keywords.max'    => 'کلمات کلیدی نمی‌تواند بیشتر از ۵۰۰ کاراکتر باشد.',

            'alt_text.max' => 'متن جایگزین تصویر نمی‌تواند بیشتر از ۲۵۵ کاراکتر باشد.',
        ];
    }
}
