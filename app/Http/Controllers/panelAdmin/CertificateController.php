<?php

namespace App\Http\Controllers\panelAdmin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreCertificateRequest;
use App\Http\Requests\UpdateCertificateRequest;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CertificateController extends Controller
{
    /* ==========================================================
       لیست
       ========================================================== */
    public function index(Request $request)
    {
        $filters = $request->only(['search', 'category', 'status']);

        $certificates = Certificate::with('translations')
            ->filter($filters)
            ->ordered()
            ->paginate(20)
            ->withQueryString();

        $categories = Certificate::CATEGORIES;

        return view('panelAdmin.panelCertificate.index', compact('certificates', 'filters', 'categories'));
    }

    /* ==========================================================
       فرم ایجاد
       ========================================================== */
    public function create()
    {
        $categories = Certificate::CATEGORIES;
        $locales    = Certificate::LOCALES;

        return view('panelAdmin.panelCertificate.create', compact('categories', 'locales'));
    }

    /* ==========================================================
       ذخیره
       ========================================================== */
    public function store(StoreCertificateRequest $request)
    {
        $data = $request->validated();

        DB::transaction(function () use ($request, $data) {
            $translations = $data['translations'];
            unset($data['translations']);

            // فایل‌ها
            if ($request->hasFile('image')) {
                $data['image'] = $request->file('image')->store('certificates', 'public');
            }
            if ($request->hasFile('file')) {
                $data['file'] = $request->file('file')->store('certificates/files', 'public');
            }

            // مقادیر boolean
            $data['is_active']   = $request->boolean('is_active', true);
            $data['is_featured'] = $request->boolean('is_featured', false);

            $certificate = Certificate::create($data);

            foreach ($translations as $tr) {
                $tr['slug'] = $this->generateUniqueSlug(
                    $tr['slug'] ?? $tr['title'],
                    $tr['locale'],
                    $certificate->id
                );

                $certificate->translations()->create($tr);
            }
        });

        return redirect()
            ->route('admin.certificate.index')
            ->with('success', 'مدرک با موفقیت ثبت شد.');
    }

    /* ==========================================================
       فرم ویرایش
       ========================================================== */
    public function edit(Certificate $certificate)
    {
        $certificate->load('translations');

        $categories = Certificate::CATEGORIES;
        $locales    = Certificate::LOCALES;

        return view('panelAdmin.panelCertificate.edit', compact('certificate', 'categories', 'locales'));
    }

    /* ==========================================================
       به‌روزرسانی
       ========================================================== */
    public function update(UpdateCertificateRequest $request, Certificate $certificate)
    {
        $data = $request->validated();

        DB::transaction(function () use ($request, $certificate, $data) {
            $translations = $data['translations'];
            unset($data['translations']);

            // جایگزینی تصویر
            if ($request->hasFile('image')) {
                if ($certificate->image) {
                    Storage::disk('public')->delete($certificate->image);
                }
                $data['image'] = $request->file('image')->store('certificates', 'public');
            }

            // جایگزینی فایل
            if ($request->hasFile('file')) {
                if ($certificate->file) {
                    Storage::disk('public')->delete($certificate->file);
                }
                $data['file'] = $request->file('file')->store('certificates/files', 'public');
            }

            $data['is_active']   = $request->boolean('is_active', true);
            $data['is_featured'] = $request->boolean('is_featured', false);

            $certificate->update($data);

            foreach ($translations as $tr) {
                $tr['slug'] = $this->generateUniqueSlug(
                    $tr['slug'] ?? $tr['title'],
                    $tr['locale'],
                    $certificate->id
                );

                $certificate->translations()->updateOrCreate(
                    ['locale' => $tr['locale']],
                    $tr
                );
            }
        });

        return redirect()
            ->route('admin.certificate.index')
            ->with('success', 'مدرک با موفقیت به‌روزرسانی شد.');
    }

    /* ==========================================================
       حذف
       ========================================================== */
    public function destroy(Certificate $certificate)
    {
        $certificate->delete(); // soft delete

        return back()->with('success', 'مدرک به سبد حذف منتقل شد.');
    }

    /* ==========================================================
       حذف کامل (force delete) - اختیاری
       ========================================================== */
    public function forceDestroy(int $id)
    {
        $certificate = Certificate::withTrashed()->findOrFail($id);

        if ($certificate->image) {
            Storage::disk('public')->delete($certificate->image);
        }
        if ($certificate->file) {
            Storage::disk('public')->delete($certificate->file);
        }

        $certificate->forceDelete();

        return back()->with('success', 'مدرک به‌طور کامل حذف شد.');
    }

    /* ==========================================================
       بازیابی از سبد حذف - اختیاری
       ========================================================== */
    public function restore(int $id)
    {
        Certificate::withTrashed()->findOrFail($id)->restore();

        return back()->with('success', 'مدرک بازیابی شد.');
    }

    /* ==========================================================
       تولید slug یکتا
       ========================================================== */
    private function generateUniqueSlug(?string $value, string $locale, int $certificateId): string
    {
        // اگر مقدار خالی یا null بود، slug پیش‌فرض بساز
        $value = trim((string) $value);

        if ($value === '') {
            $base = 'certificate-' . $certificateId . '-' . $locale;
        } else {
            $base = Str::slug($value) ?: 'certificate-' . $certificateId . '-' . $locale;
        }

        $slug = $base;
        $i    = 1;

        while (
        \App\Models\CertificatTranslation::where('locale', $locale)
            ->where('slug', $slug)
            ->where('certificate_id', '!=', $certificateId)
            ->exists()
        ) {
            $slug = "{$base}-{$i}";
            $i++;
        }

        return $slug;
    }
}
