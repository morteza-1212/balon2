@extends('panelAdmin.layouts.panel')

@section('title', 'ویرایش دسته‌بندی')

@section('content')
    <div class="container-fluid">

        {{-- هدر --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h1 class="h3 mb-0">
                    <i class="fas fa-edit me-2"></i>
                    ویرایش دسته‌بندی
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.category.index') }}">دسته‌بندی‌ها</a>
                        </li>
                        <li class="breadcrumb-item active">ویرایش</li>
                    </ol>
                </nav>
            </div>
            <a href="{{ route('admin.category.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-right me-1"></i>
                بازگشت به لیست
            </a>
        </div>

        {{-- پیام‌ها --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show">
                <i class="fas fa-check-circle me-1"></i>
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif
        @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show">
                <i class="fas fa-exclamation-circle me-1"></i>
                {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- خطاها --}}
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show">
                <h6 class="alert-heading">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    خطاهای زیر را برطرف کنید:
                </h6>
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        @php
            $locales       = \App\Models\Category::LOCALES;
            $defaultLocale = \App\Models\Category::DEFAULT_LOCALE;
        @endphp

        <form action="{{ route('admin.category.update', $category) }}"
              method="POST"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="row g-3">

                {{-- تب‌های زبان --}}
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <ul class="nav nav-tabs card-header-tabs" role="tablist">
                                @foreach($locales as $code => $label)
                                    @php
                                        $t = $category->translations->firstWhere('locale', $code);
                                        $isDefault = $code === $defaultLocale;
                                    @endphp
                                    <li class="nav-item" role="presentation">
                                        <button class="nav-link @if($loop->first) active @endif"
                                                data-bs-toggle="tab"
                                                data-bs-target="#lang-{{ $code }}"
                                                type="button"
                                                role="tab"
                                                aria-controls="lang-{{ $code }}"
                                                aria-selected="{{ $loop->first ? 'true' : 'false' }}">
                                            <i class="fas fa-globe me-1"></i>
                                            {{ $label }}
                                            @if($isDefault)
                                                <span class="badge bg-danger ms-1">پیش‌فرض</span>
                                            @endif
                                            @if($t)
                                                <span class="badge bg-success ms-1" title="ترجمه موجود">
                                                    <i class="fas fa-check"></i>
                                                </span>
                                            @endif
                                        </button>
                                    </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="card-body">
                            <div class="tab-content">
                                @foreach($locales as $code => $label)
                                    @php
                                        $t = $category->translations->firstWhere('locale', $code);
                                        $isDefault = $code === $defaultLocale;
                                    @endphp

                                    <div class="tab-pane fade @if($loop->first) show active @endif"
                                         id="lang-{{ $code }}"
                                         role="tabpanel">

                                        {{-- نام --}}
                                        <div class="mb-3">
                                            <label class="form-label">
                                                نام دسته
                                                @if($isDefault) <span class="text-danger">*</span> @endif
                                                <small class="text-muted">({{ $label }})</small>
                                            </label>
                                            <input type="text"
                                                   name="translations[{{ $code }}][name]"
                                                   class="form-control @error("translations.{$code}.name") is-invalid @enderror"
                                                   value="{{ old("translations.{$code}.name", $t?->name) }}"
                                                   @if($isDefault) required @endif>
                                            @error("translations.{$code}.name")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- Slug --}}
                                        <div class="mb-3">
                                            <label class="form-label">
                                                نامک (Slug)
                                                <small class="text-muted">({{ $label }})</small>
                                            </label>
                                            <input type="text"
                                                   name="translations[{{ $code }}][slug]"
                                                   class="form-control @error("translations.{$code}.slug") is-invalid @enderror"
                                                   value="{{ old("translations.{$code}.slug", $t?->slug) }}"
                                                   placeholder="در صورت خالی بودن، خودکار ساخته می‌شود">
                                            @error("translations.{$code}.slug")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- توضیح کوتاه --}}
                                        <div class="mb-3">
                                            <label class="form-label">
                                                توضیح کوتاه
                                                <small class="text-muted">({{ $label }})</small>
                                            </label>
                                            <input type="text"
                                                   name="translations[{{ $code }}][short_description]"
                                                   class="form-control @error("translations.{$code}.short_description") is-invalid @enderror"
                                                   value="{{ old("translations.{$code}.short_description", $t?->short_description) }}">
                                            @error("translations.{$code}.short_description")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- توضیحات کامل --}}
                                        <div class="mb-3">
                                            <label class="form-label">
                                                توضیحات کامل
                                                <small class="text-muted">({{ $label }})</small>
                                            </label>
                                            <textarea name="translations[{{ $code }}][description]"
                                                      class="form-control @error("translations.{$code}.description") is-invalid @enderror"
                                                      rows="4">{{ old("translations.{$code}.description", $t?->description) }}</textarea>
                                            @error("translations.{$code}.description")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- متن جایگزین تصویر --}}
                                        <div class="mb-3">
                                            <label class="form-label">
                                                متن جایگزین تصویر (Alt)
                                                <small class="text-muted">({{ $label }})</small>
                                            </label>
                                            <input type="text"
                                                   name="translations[{{ $code }}][alt_text]"
                                                   class="form-control @error("translations.{$code}.alt_text") is-invalid @enderror"
                                                   value="{{ old("translations.{$code}.alt_text", $t?->alt_text) }}"
                                                   placeholder="متن جایگزین برای تصویر دسته (SEO)">
                                            @error("translations.{$code}.alt_text")
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>

                                        {{-- SEO --}}
                                        <hr class="my-4">
                                        <h6 class="text-muted mb-3">
                                            <i class="fas fa-search me-1"></i>
                                            تنظیمات SEO ({{ $label }})
                                        </h6>

                                        <div class="row">
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">عنوان متا</label>
                                                <input type="text"
                                                       name="translations[{{ $code }}][meta_title]"
                                                       class="form-control @error("translations.{$code}.meta_title") is-invalid @enderror"
                                                       value="{{ old("translations.{$code}.meta_title", $t?->meta_title) }}">
                                                @error("translations.{$code}.meta_title")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">کلمات کلیدی متا</label>
                                                <input type="text"
                                                       name="translations[{{ $code }}][meta_keywords]"
                                                       class="form-control @error("translations.{$code}.meta_keywords") is-invalid @enderror"
                                                       value="{{ old("translations.{$code}.meta_keywords", $t?->meta_keywords) }}">
                                                @error("translations.{$code}.meta_keywords")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <label class="form-label">توضیحات متا</label>
                                                <input type="text"
                                                       name="translations[{{ $code }}][meta_description]"
                                                       class="form-control @error("translations.{$code}.meta_description") is-invalid @enderror"
                                                       value="{{ old("translations.{$code}.meta_description", $t?->meta_description) }}">
                                                @error("translations.{$code}.meta_description")
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                {{-- اطلاعات پایه --}}
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-info-circle me-1"></i>
                                اطلاعات پایه
                            </h5>
                        </div>
                        <div class="card-body">

                            {{-- کد --}}
                            <div class="mb-3">
                                <label class="form-label">کد دسته‌بندی</label>
                                <input type="text"
                                       class="form-control bg-light"
                                       value="{{ $category->code }}"
                                       readonly>
                                <small class="text-muted">
                                    <i class="fas fa-lock me-1"></i>
                                    این کد خودکار ساخته شده و قابل ویرایش نیست.
                                </small>
                            </div>

                            {{-- آیکون --}}
                            <div class="mb-3">
                                <label class="form-label">آیکون (کلاس Font Awesome)</label>
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i id="icon-preview" class="fas {{ old('icon', $category->icon) ?: 'fa-folder' }}"></i>
                                    </span>
                                    <input type="text"
                                           name="icon"
                                           id="icon"
                                           class="form-control @error('icon') is-invalid @enderror"
                                           placeholder="مثال: fa-folder"
                                           value="{{ old('icon', $category->icon) }}"
                                           oninput="document.getElementById('icon-preview').className = 'fas ' + (this.value || 'fa-folder')">
                                    @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="text-muted">
                                    مثال: <code>fa-shield-alt</code>، <code>fa-microscope</code>، <code>fa-bullhorn</code>
                                </small>
                            </div>

                            {{-- رنگ --}}
                            <div class="mb-3">
                                <label class="form-label">رنگ دسته (HEX)</label>
                                <div class="input-group">
                                    <input type="color"
                                           id="color-picker"
                                           class="form-control form-control-color"
                                           value="{{ old('color_hex', $category->color_hex ?? '#0A1F44') }}"
                                           onchange="document.getElementById('color_hex').value = this.value">
                                    <input type="text"
                                           name="color_hex"
                                           id="color_hex"
                                           class="form-control @error('color_hex') is-invalid @enderror"
                                           placeholder="#0A1F44"
                                           value="{{ old('color_hex', $category->color_hex ?? '#0A1F44') }}"
                                           pattern="^#[0-9A-Fa-f]{6}$"
                                           onchange="document.getElementById('color-picker').value = this.value">
                                    @error('color_hex')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <small class="text-muted">
                                    رنگ بج دسته در صفحه محصولات (فرمت: <code>#RRGGBB</code>)
                                </small>
                            </div>

                            {{-- ترتیب --}}
                            <div class="mb-3">
                                <label class="form-label">ترتیب نمایش</label>
                                <input type="number"
                                       name="sort_order"
                                       class="form-control @error('sort_order') is-invalid @enderror"
                                       min="0"
                                       value="{{ old('sort_order', $category->sort_order) }}">
                                @error('sort_order')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- وضعیت و ویژه --}}
                            <div class="d-flex gap-4">
                                <div class="form-check form-switch">
                                    <input type="hidden" name="status" value="0">
                                    <input type="checkbox"
                                           name="status"
                                           value="1"
                                           class="form-check-input"
                                           id="status"
                                        @checked(old('status', $category->status))>
                                    <label class="form-check-label" for="status">فعال</label>
                                </div>
                                <div class="form-check form-switch">
                                    <input type="hidden" name="is_featured" value="0">
                                    <input type="checkbox"
                                           name="is_featured"
                                           value="1"
                                           class="form-check-input"
                                           id="is_featured"
                                        @checked(old('is_featured', $category->is_featured))>
                                    <label class="form-check-label" for="is_featured">ویژه</label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- تصویر --}}
                <div class="col-md-6">
                    <div class="card h-100">
                        <div class="card-header d-flex justify-content-between align-items-center">
                            <h5 class="card-title mb-0">
                                <i class="fas fa-image me-1"></i>
                                تصویر دسته
                            </h5>
                            @if($category->image)
                                <span class="badge bg-success">
                                    <i class="fas fa-check"></i>
                                    تصویر موجود
                                </span>
                            @endif
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">تغییر تصویر</label>
                                <input type="file"
                                       name="image"
                                       id="image"
                                       accept="image/jpeg,image/png,image/webp,image/svg+xml"
                                       class="form-control @error('image') is-invalid @enderror"
                                       onchange="previewImage(this)">
                                @error('image')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <small class="text-muted">
                                    JPG, PNG, WEBP, SVG — حداکثر ۲ مگابایت
                                    @if($category->image)
                                        <br>
                                        <i class="fas fa-info-circle me-1"></i>
                                        در صورت عدم انتخاب، تصویر فعلی حفظ می‌شود.
                                    @endif
                                </small>
                            </div>
                            <div class="text-center">
                                @if($category->image)
                                    <img id="image-preview"
                                         src="{{ $category->image_url }}"
                                         alt="{{ $category->alt_text ?? $category->name }}"
                                         class="img-thumbnail"
                                         style="max-height: 200px;">
                                    <div id="no-image-placeholder"
                                         class="text-muted py-4 border rounded d-none">
                                        <i class="fas fa-image fa-3x mb-2"></i>
                                        <p class="mb-0">پیش‌نمایش تصویر</p>
                                    </div>
                                @else
                                    <img id="image-preview"
                                         src=""
                                         alt="پیش‌نمایش تصویر دسته"
                                         class="img-thumbnail d-none"
                                         style="max-height: 200px;">
                                    <div id="no-image-placeholder"
                                         class="text-muted py-4 border rounded">
                                        <i class="fas fa-image fa-3x mb-2"></i>
                                        <p class="mb-0">پیش‌نمایش تصویر</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- دکمه‌ها --}}
            <div class="card mt-3">
                <div class="card-body d-flex justify-content-between flex-wrap gap-2">
                    <div class="d-flex gap-2 flex-wrap">
                        <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-right me-1"></i>
                            بازگشت
                        </a>
                        <a href="{{ route('admin.category.show', $category) }}" class="btn btn-outline-secondary">
                            <i class="fas fa-eye me-1"></i>
                            مشاهده
                        </a>
                    </div>

                    <div class="d-flex gap-2 flex-wrap">
                        <button type="button"
                                class="btn btn-outline-danger"
                                onclick="if(confirm('آیا از حذف این دسته‌بندی مطمئن هستید؟')) document.getElementById('delete-form').submit();">
                            <i class="fas fa-trash me-1"></i>
                            حذف
                        </button>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>
                            به‌روزرسانی
                        </button>
                    </div>
                </div>
            </div>
        </form>

        {{-- فرم حذف --}}
        <form id="delete-form"
              action="{{ route('admin.category.delete', $category) }}"
              method="POST"
              class="d-none">
            @csrf
            @method('DELETE')
        </form>
    </div>
@endsection

@push('styles')
    <style>
        .nav-tabs .nav-link { color: #495057; }
        .nav-tabs .nav-link.active { font-weight: bold; }
        .form-control-color { max-width: 60px; padding: 4px; }
        #icon-preview { min-width: 18px; text-align: center; }
    </style>
@endpush

@push('scripts')
    <script>
        function previewImage(input) {
            const preview     = document.getElementById('image-preview');
            const placeholder = document.getElementById('no-image-placeholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();
                reader.onload = function (e) {
                    preview.src = e.target.result;
                    preview.classList.remove('d-none');
                    if (placeholder) placeholder.classList.add('d-none');
                };
                reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
@endpush
