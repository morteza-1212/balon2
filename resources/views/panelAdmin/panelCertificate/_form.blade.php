@php
    $isEdit = $certificate !== null;
    $oldTranslations = old('translations', $isEdit
        ? $certificate->translations->map(fn($t) => [
            'locale'           => $t->locale,
            'title'            => $t->title,
            'description'      => $t->description,
            'image_alt'        => $t->image_alt,
            'slug'             => $t->slug,
            'meta_title'       => $t->meta_title,
            'meta_description' => $t->meta_description,
            'meta_keywords'    => $t->meta_keywords,
        ])->toArray()
        : []);
@endphp

<form action="{{ $action }}" method="POST" enctype="multipart/form-data">
    @csrf
    @if($method === 'PUT') @method('PUT') @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <strong>خطاها:</strong>
            <ul class="mb-0">
                @foreach($errors->all() as $err)
                    <li>{{ $err }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    {{-- ================= اطلاعات اصلی ================= --}}
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">دسته‌بندی <span class="text-danger">*</span></label>
            <select name="category" class="form-select @error('category') is-invalid @enderror" required>
                <option value="">انتخاب کنید...</option>
                @foreach($categories as $key => $label)
                    <option value="{{ $key }}"
                        @selected(old('category', $certificate?->category) === $key)>
                        {{ $label }}
                    </option>
                @endforeach
            </select>
            @error('category') <div class="invalid-feedback">{{ $message }}</div> @enderror
        </div>

        <div class="col-md-3">
            <label class="form-label">شماره مدرک</label>
            <input type="text" name="certificate_number"
                   value="{{ old('certificate_number', $certificate?->certificate_number) }}"
                   class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">صادرکننده</label>
            <input type="text" name="issuer"
                   value="{{ old('issuer', $certificate?->issuer) }}"
                   class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">تاریخ صدور</label>
            <input type="date" name="issued_at"
                   value="{{ old('issued_at', $certificate?->issued_at?->format('Y-m-d')) }}"
                   class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">تاریخ انقضا</label>
            <input type="date" name="expires_at"
                   value="{{ old('expires_at', $certificate?->expires_at?->format('Y-m-d')) }}"
                   class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">ترتیب نمایش</label>
            <input type="number" name="sort_order" min="0"
                   value="{{ old('sort_order', $certificate?->sort_order ?? 0) }}"
                   class="form-control">
        </div>

        <div class="col-md-3">
            <label class="form-label">تاریخ انتشار</label>
            <input type="datetime-local" name="published_at"
                   value="{{ old('published_at', $certificate?->published_at?->format('Y-m-d\TH:i')) }}"
                   class="form-control">
        </div>

        <div class="col-md-6">
            <label class="form-label">تصویر مدرک</label>
            <input type="file" name="image" accept="image/webp,image/jpeg,image/png"
                   class="form-control">
            @if($certificate?->image_url)
                <div class="mt-2">
                    <img src="{{ $certificate->image_url }}" alt=""
                         style="max-height:80px;border-radius:6px;">
                </div>
            @endif
        </div>

        <div class="col-md-6">
            <label class="form-label">فایل PDF (اختیاری)</label>
            <input type="file" name="file" accept="application/pdf"
                   class="form-control">
            @if($certificate?->file_url)
                <a href="{{ $certificate->file_url }}" target="_blank" class="d-inline-block mt-2">
                    مشاهده فایل فعلی
                </a>
            @endif
        </div>

        <div class="col-md-3">
            <div class="form-check form-switch mt-4">
                <input type="checkbox" name="is_active" value="1" id="is_active"
                       class="form-check-input"
                    @checked(old('is_active', $certificate?->is_active ?? true))>
                <label class="form-check-label" for="is_active">فعال</label>
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-check form-switch mt-4">
                <input type="checkbox" name="is_featured" value="1" id="is_featured"
                       class="form-check-input"
                    @checked(old('is_featured', $certificate?->is_featured ?? false))>
                <label class="form-check-label" for="is_featured">ویژه</label>
            </div>
        </div>
    </div>

    <hr class="my-4">

    {{-- ================= ترجمه‌ها ================= --}}
    <h4 class="mb-3">ترجمه‌ها</h4>

    <ul class="nav nav-tabs" id="localeTabs" role="tablist">
        @foreach($locales as $code => $label)
            @php
                $trData = collect($oldTranslations)->firstWhere('locale', $code) ?? [];
            @endphp
            <li class="nav-item" role="presentation">
                <button class="nav-link @if($loop->first) active @endif"
                        id="tab-{{ $code }}"
                        data-bs-toggle="tab"
                        data-bs-target="#pane-{{ $code }}"
                        type="button" role="tab">
                    {{ $label }}
                    @if(!empty($trData['title']))
                        <span class="badge bg-success ms-1">✓</span>
                    @endif
                </button>
            </li>
        @endforeach
    </ul>

    <div class="tab-content border border-top-0 p-3">
        @foreach($locales as $code => $label)
            @php
                $trData = collect($oldTranslations)->firstWhere('locale', $code) ?? [];
                $idx = $loop->index;
            @endphp

            <div class="tab-pane fade @if($loop->first) show active @endif"
                 id="pane-{{ $code }}" role="tabpanel">

                <input type="hidden" name="translations[{{ $idx }}][locale]" value="{{ $code }}">

                <div class="row g-3">
                    <div class="col-md-8">
                        <label class="form-label">عنوان ({{ $label }}) <span class="text-danger">*</span></label>
                        <input type="text"
                               name="translations[{{ $idx }}][title]"
                               value="{{ $trData['title'] ?? '' }}"
                               class="form-control @error("translations.{$idx}.title") is-invalid @enderror">
                        @error("translations.{$idx}.title")
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">نامک (slug)</label>
                        <input type="text"
                               name="translations[{{ $idx }}][slug]"
                               value="{{ $trData['slug'] ?? '' }}"
                               class="form-control @error("translations.{$idx}.slug") is-invalid @enderror"
                               placeholder="خودکار تولید می‌شود">
                        @error("translations.{$idx}.slug")
                        <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="col-12">
                        <label class="form-label">توضیحات</label>
                        <textarea name="translations[{{ $idx }}][description]"
                                  rows="3"
                                  class="form-control">{{ $trData['description'] ?? '' }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">متن alt تصویر</label>
                        <input type="text"
                               name="translations[{{ $idx }}][image_alt]"
                               value="{{ $trData['image_alt'] ?? '' }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">عنوان متا (SEO)</label>
                        <input type="text"
                               name="translations[{{ $idx }}][meta_title]"
                               value="{{ $trData['meta_title'] ?? '' }}"
                               class="form-control">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">توضیحات متا</label>
                        <textarea name="translations[{{ $idx }}][meta_description]"
                                  rows="2"
                                  class="form-control">{{ $trData['meta_description'] ?? '' }}</textarea>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">کلمات کلیدی متا</label>
                        <input type="text"
                               name="translations[{{ $idx }}][meta_keywords]"
                               value="{{ $trData['meta_keywords'] ?? '' }}"
                               class="form-control">
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-end gap-2 mt-4">
        <a href="{{ route('admin.certificate.index') }}" class="btn btn-secondary">انصراف</a>
        <button type="submit" class="btn btn-primary">
            {{ $isEdit ? 'ذخیره تغییرات' : 'ثبت مدرک' }}
        </button>
    </div>
</form>
