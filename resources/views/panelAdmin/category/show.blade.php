@extends('panelAdmin.layouts.panel')

@section('title', 'مشاهده دسته‌بندی')

@section('content')
    <div class="container-fluid">

        {{-- هدر --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h1 class="h3 mb-0">
                    <i class="fas fa-eye me-2"></i>
                    {{ $category->name ?? 'دسته‌بندی' }}
                </h1>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('admin.category.index') }}">دسته‌بندی‌ها</a>
                        </li>
                        <li class="breadcrumb-item active">{{ $category->name ?? 'مشاهده' }}</li>
                    </ol>
                </nav>
            </div>
            <div class="d-flex gap-2 flex-wrap">
                <a href="{{ route('admin.category.edit', $category) }}" class="btn btn-warning">
                    <i class="fas fa-edit me-1"></i> ویرایش
                </a>
                <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right me-1"></i> بازگشت
                </a>
            </div>
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

        <div class="row g-3">

            {{-- تصویر --}}
            <div class="col-md-4">
                <div class="card h-100">
                    <div class="card-header">
                        <strong>
                            <i class="fas fa-image me-1"></i>
                            تصویر دسته
                        </strong>
                    </div>
                    <div class="card-body text-center d-flex flex-column justify-content-center">
                        @if($category->image)
                            <img src="{{ $category->image_url }}"
                                 alt="{{ $category->alt_text ?? $category->name }}"
                                 class="img-fluid rounded border">
                            @if($category->alt_text)
                                <small class="text-muted d-block mt-2">
                                    <i class="fas fa-tag me-1"></i>
                                    Alt: {{ $category->alt_text }}
                                </small>
                            @endif
                        @else
                            <div class="text-muted py-5">
                                <i class="fas fa-image fa-3x mb-3 d-block"></i>
                                <p class="mb-0">تصویری وجود ندارد.</p>
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            {{-- اطلاعات --}}
            <div class="col-md-8">
                <div class="card h-100">
                    <div class="card-header">
                        <strong>
                            <i class="fas fa-info-circle me-1"></i>
                            اطلاعات دسته‌بندی
                        </strong>
                    </div>
                    <div class="card-body">
                        <dl class="row mb-0">

                            {{-- کد --}}
                            <dt class="col-sm-4">کد:</dt>
                            <dd class="col-sm-8">
                                <code>{{ $category->code }}</code>
                            </dd>

                            {{-- آیکون --}}
                            <dt class="col-sm-4">آیکون:</dt>
                            <dd class="col-sm-8">
                                @if($category->icon)
                                    <i class="fas {{ $category->icon }} text-primary me-1"></i>
                                    <code>{{ $category->icon }}</code>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </dd>

                            {{-- رنگ --}}
                            <dt class="col-sm-4">رنگ:</dt>
                            <dd class="col-sm-8">
                                @if($category->color_hex)
                                    <span class="d-inline-flex align-items-center gap-2">
                                        <span class="rounded-circle border"
                                              style="width: 22px; height: 22px; background-color: {{ $category->color_hex }};"></span>
                                        <code>{{ $category->color_hex }}</code>
                                    </span>
                                @else
                                    <span class="text-muted">—</span>
                                @endif
                            </dd>

                            {{-- محصولات --}}
                            <dt class="col-sm-4">تعداد محصولات:</dt>
                            <dd class="col-sm-8">
                                <span class="badge bg-info">
                                    <i class="fas fa-box me-1"></i>
                                    {{ number_format($category->products_count ?? 0) }}
                                </span>
                            </dd>

                            {{-- ترتیب --}}
                            <dt class="col-sm-4">ترتیب نمایش:</dt>
                            <dd class="col-sm-8">{{ $category->sort_order }}</dd>

                            {{-- وضعیت --}}
                            <dt class="col-sm-4">وضعیت:</dt>
                            <dd class="col-sm-8">
                                @if($category->status)
                                    <span class="badge bg-success">فعال</span>
                                @else
                                    <span class="badge bg-secondary">غیرفعال</span>
                                @endif
                                @if($category->is_featured)
                                    <span class="badge bg-warning text-dark">
                                        <i class="fas fa-star"></i> ویژه
                                    </span>
                                @endif
                            </dd>

                            {{-- تاریخ‌ها --}}
                            <dt class="col-sm-4">تاریخ ایجاد:</dt>
                            <dd class="col-sm-8">
                                {{ $category->created_at->format('Y/m/d H:i') }}
                            </dd>

                            <dt class="col-sm-4">آخرین ویرایش:</dt>
                            <dd class="col-sm-8">
                                {{ $category->updated_at->format('Y/m/d H:i') }}
                            </dd>
                        </dl>
                    </div>
                </div>
            </div>

            {{-- ترجمه‌ها --}}
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center flex-wrap gap-2">
                        <strong>
                            <i class="fas fa-language me-1"></i>
                            ترجمه‌ها
                        </strong>
                        <span class="badge bg-primary">
                            {{ $category->translations->count() }} / {{ count(\App\Models\Category::LOCALES) }}
                        </span>
                    </div>
                    <div class="card-body">
                        <ul class="nav nav-tabs mb-3" role="tablist">
                            @foreach(\App\Models\Category::LOCALES as $code => $label)
                                @php
                                    $t = $category->translations->firstWhere('locale', $code);
                                    $isDefault = $code === \App\Models\Category::DEFAULT_LOCALE;
                                @endphp
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link @if($loop->first) active @endif"
                                            data-bs-toggle="tab"
                                            data-bs-target="#show-{{ $code }}"
                                            type="button"
                                            role="tab"
                                            aria-controls="show-{{ $code }}"
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
                                        @else
                                            <span class="badge bg-secondary ms-1" title="بدون ترجمه">
                                                <i class="fas fa-times"></i>
                                            </span>
                                        @endif
                                    </button>
                                </li>
                            @endforeach
                        </ul>

                        <div class="tab-content">
                            @foreach(\App\Models\Category::LOCALES as $code => $label)
                                @php $t = $category->translations->firstWhere('locale', $code); @endphp
                                <div class="tab-pane fade @if($loop->first) show active @endif"
                                     id="show-{{ $code }}"
                                     role="tabpanel">

                                    @if($t)
                                        <div class="row">
                                            <div class="col-md-8">
                                                <h4 class="mb-2">{{ $t->name }}</h4>
                                                <p class="text-muted mb-3">
                                                    <i class="fas fa-link me-1"></i>
                                                    <code>{{ $t->slug }}</code>
                                                </p>

                                                @if($t->short_description)
                                                    <div class="mb-3">
                                                        <strong>توضیح کوتاه:</strong>
                                                        <p class="mb-0">{{ $t->short_description }}</p>
                                                    </div>
                                                @endif

                                                @if($t->description)
                                                    <div class="mb-3">
                                                        <strong>توضیحات:</strong>
                                                        <div class="bg-light p-3 rounded mt-1"
                                                             style="white-space: pre-wrap;">{{ $t->description }}</div>
                                                    </div>
                                                @endif

                                                @if($t->alt_text)
                                                    <div class="mb-3">
                                                        <strong>متن جایگزین تصویر:</strong>
                                                        <p class="mb-0 text-muted">{{ $t->alt_text }}</p>
                                                    </div>
                                                @endif
                                            </div>

                                            <div class="col-md-4">
                                                <div class="card bg-light border-0">
                                                    <div class="card-body">
                                                        <h6 class="text-muted mb-3">
                                                            <i class="fas fa-search me-1"></i>
                                                            SEO
                                                        </h6>
                                                        <dl class="row mb-0 small">
                                                            <dt class="col-12 text-muted">عنوان متا:</dt>
                                                            <dd class="col-12">{{ $t->meta_title ?: '—' }}</dd>

                                                            <dt class="col-12 text-muted mt-2">کلمات کلیدی:</dt>
                                                            <dd class="col-12">{{ $t->meta_keywords ?: '—' }}</dd>

                                                            <dt class="col-12 text-muted mt-2">توضیحات متا:</dt>
                                                            <dd class="col-12 mb-0">{{ $t->meta_description ?: '—' }}</dd>
                                                        </dl>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @else
                                        <div class="text-center text-muted py-4">
                                            <i class="fas fa-language fa-3x mb-3 d-block"></i>
                                            <p class="mb-0">ترجمه‌ای برای این زبان ثبت نشده است.</p>
                                            <a href="{{ route('admin.category.edit', $category) }}"
                                               class="btn btn-sm btn-outline-primary mt-3">
                                                <i class="fas fa-plus me-1"></i>
                                                افزودن ترجمه
                                            </a>
                                        </div>
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- دکمه‌های پایین --}}
        <div class="card mt-3">
            <div class="card-body d-flex justify-content-between flex-wrap gap-2">
                <a href="{{ route('admin.category.index') }}" class="btn btn-secondary">
                    <i class="fas fa-arrow-right me-1"></i>
                    بازگشت به لیست
                </a>

                <div class="d-flex gap-2 flex-wrap">
                    <button type="button"
                            class="btn btn-outline-danger"
                            onclick="if(confirm('آیا از حذف این دسته‌بندی مطمئن هستید؟')) document.getElementById('delete-form').submit();">
                        <i class="fas fa-trash me-1"></i>
                        حذف
                    </button>

                    <a href="{{ route('admin.category.edit', $category) }}" class="btn btn-primary">
                        <i class="fas fa-edit me-1"></i>
                        ویرایش
                    </a>
                </div>
            </div>
        </div>

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
    </style>
@endpush
