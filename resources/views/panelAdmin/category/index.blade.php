@extends('panelAdmin.layouts.panel')

@section('title', 'مدیریت دسته‌بندی‌ها')

@section('content')
    <div class="container-fluid">

        {{-- هدر --}}
        <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-2">
            <div>
                <h1 class="h3 mb-0">
                    <i class="fas fa-folder-tree me-2"></i>
                    مدیریت دسته‌بندی‌ها
                </h1>
                <p class="text-muted mb-0 mt-1">شرکت شهاب بالن</p>
            </div>
            <a href="{{ route('admin.category.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-1"></i>
                افزودن دسته‌بندی
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

        {{-- آمار سریع --}}
        <div class="row g-3 mb-4">
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-primary bg-opacity-10 p-3">
                            <i class="fas fa-layer-group text-primary fa-lg"></i>
                        </div>
                        <div>
                            <div class="text-muted small">کل دسته‌بندی‌ها</div>
                            <div class="h5 mb-0">{{ number_format($stats['total']) }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-success bg-opacity-10 p-3">
                            <i class="fas fa-check-circle text-success fa-lg"></i>
                        </div>
                        <div>
                            <div class="text-muted small">فعال</div>
                            <div class="h5 mb-0">{{ number_format($stats['active']) }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-warning bg-opacity-10 p-3">
                            <i class="fas fa-star text-warning fa-lg"></i>
                        </div>
                        <div>
                            <div class="text-muted small">ویژه</div>
                            <div class="h5 mb-0">{{ number_format($stats['featured']) }}</div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body d-flex align-items-center gap-3">
                        <div class="rounded-circle bg-info bg-opacity-10 p-3">
                            <i class="fas fa-boxes text-info fa-lg"></i>
                        </div>
                        <div>
                            <div class="text-muted small">محصولات</div>
                            <div class="h5 mb-0">{{ number_format($stats['products']) }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- فیلتر --}}
        <div class="card mb-4">
            <div class="card-body">
                <form method="GET" action="{{ route('admin.category.index') }}" class="row g-3">
                    <div class="col-md-5">
                        <label class="form-label">جستجو</label>
                        <input type="text" name="search" class="form-control"
                               placeholder="نام یا کد..."
                               value="{{ request('search') }}">
                    </div>
                    <div class="col-md-3">
                        <label class="form-label">وضعیت</label>
                        <select name="status" class="form-select">
                            <option value="">همه</option>
                            <option value="active" @selected(request('status') === 'active')>فعال</option>
                            <option value="inactive" @selected(request('status') === 'inactive')>غیرفعال</option>
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label class="form-label">ویژه</label>
                        <select name="featured" class="form-select">
                            <option value="">همه</option>
                            <option value="1" @selected(request('featured') === '1')>فقط ویژه</option>
                        </select>
                    </div>
                    <div class="col-md-2 d-flex align-items-end gap-2">
                        <button class="btn btn-primary w-100">
                            <i class="fas fa-search"></i>
                        </button>
                        <a href="{{ route('admin.category.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times"></i>
                        </a>
                    </div>
                </form>
            </div>
        </div>

        {{-- جدول --}}
        <div class="card">
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table table-hover table-striped mb-0 align-middle">
                        <thead class="table-light">
                        <tr>
                            <th width="60">#</th>
                            <th width="80">تصویر</th>
                            <th>نام</th>
                            <th width="180">کد</th>
                            <th width="120">رنگ</th>
                            <th width="120">محصولات</th>
                            <th width="110">ترجمه‌ها</th>
                            <th width="90">ویژه</th>
                            <th width="100">وضعیت</th>
                            <th width="180">عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse($categories as $category)
                            <tr>
                                <td>{{ $categories->firstItem() + $loop->index }}</td>
                                <td>
                                    @if($category->image)
                                        <img src="{{ $category->image_url }}"
                                             class="img-thumbnail"
                                             alt="{{ $category->alt_text ?? $category->name }}"
                                             style="width: 60px; height: 60px; object-fit: cover;">
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <strong>{{ $category->name ?? '—' }}</strong>
                                    @if($category->icon)
                                        <i class="fas {{ $category->icon }} text-muted ms-1"></i>
                                    @endif
                                </td>
                                <td><code>{{ $category->code }}</code></td>
                                <td>
                                    @if($category->color_hex)
                                        <span class="d-inline-flex align-items-center gap-2">
                                            <span class="rounded-circle border"
                                                  style="width: 22px; height: 22px; background-color: {{ $category->color_hex }};"></span>
                                            <code class="small">{{ $category->color_hex }}</code>
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('admin.product.index', ['category' => $category->id]) }}"
                                       class="badge bg-info text-decoration-none">
                                        <i class="fas fa-box"></i>
                                        {{ $category->products_count ?? 0 }}
                                    </a>
                                </td>
                                <td>
                                    <span class="badge bg-primary">
                                        <i class="fas fa-language"></i>
                                        {{ $category->translations->count() }} / {{ count(\App\Models\Category::LOCALES) }}
                                    </span>
                                </td>
                                <td>
                                    @if($category->is_featured)
                                        <span class="badge bg-warning text-dark">
                                            <i class="fas fa-star"></i>
                                        </span>
                                    @else
                                        <span class="text-muted">—</span>
                                    @endif
                                </td>
                                <td>
                                    @if($category->status)
                                        <span class="badge bg-success">فعال</span>
                                    @else
                                        <span class="badge bg-secondary">غیرفعال</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group btn-group-sm">
                                        <a href="{{ route('admin.category.show', $category) }}"
                                           class="btn btn-info" title="مشاهده">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.category.edit', $category) }}"
                                           class="btn btn-warning" title="ویرایش">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.category.delete', $category) }}"
                                              method="POST" class="d-inline"
                                              onsubmit="return confirm('آیا از حذف این دسته‌بندی مطمئن هستید؟')">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" title="حذف">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10" class="text-center py-5 text-muted">
                                    <i class="fas fa-folder-open fa-3x mb-3 d-block"></i>
                                    هیچ دسته‌بندی یافت نشد.
                                    <br>
                                    <a href="{{ route('admin.category.create') }}"
                                       class="btn btn-sm btn-primary mt-3">
                                        افزودن اولین دسته‌بندی
                                    </a>
                                </td>
                            </tr>
                        @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            @if($categories->hasPages())
                <div class="card-footer">
                    {{ $categories->links() }}
                </div>
            @endif
        </div>
    </div>
@endsection
