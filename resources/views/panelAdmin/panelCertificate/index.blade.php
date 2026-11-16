@extends('panelAdmin.layouts.panel')

@section('title', 'مدیریت مجوزها و گواهینامه‌ها')

@section('content')
    <div class="admin-card">

        <div class="admin-card-header d-flex flex-wrap justify-content-between align-items-center gap-3">
            <h2 class="admin-card-title mb-0">مجوزها و گواهینامه‌ها</h2>
            <a href="{{ route('admin.certificate.create') }}" class="btn btn-primary">
                + افزودن مدرک جدید
            </a>
        </div>

        {{-- فیلترها --}}
        <form method="GET" class="row g-3 my-3">
            <div class="col-md-4">
                <input type="text" name="search" value="{{ $filters['search'] ?? '' }}"
                       class="form-control" placeholder="جستجو در عنوان، شماره یا صادرکننده...">
            </div>
            <div class="col-md-3">
                <select name="category" class="form-select">
                    <option value="">همه دسته‌ها</option>
                    @foreach($categories as $key => $label)
                        <option value="{{ $key }}" @selected(($filters['category'] ?? '') === $key)>
                            {{ $label }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">همه وضعیت‌ها</option>
                    <option value="1" @selected(($filters['status'] ?? '') === '1')>فعال</option>
                    <option value="0" @selected(($filters['status'] ?? '') === '0')>غیرفعال</option>
                </select>
            </div>
            <div class="col-md-2">
                <button class="btn btn-secondary w-100">اعمال فیلتر</button>
            </div>
        </form>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="table-responsive">
            <table class="table table-hover align-middle">
                <thead>
                <tr>
                    <th>#</th>
                    <th>تصویر</th>
                    <th>عنوان (فارسی)</th>
                    <th>دسته</th>
                    <th>شماره مدرک</th>
                    <th>صادرکننده</th>
                    <th>انقضا</th>
                    <th>ترتیب</th>
                    <th>وضعیت</th>
                    <th>عملیات</th>
                </tr>
                </thead>
                <tbody>
                @forelse($certificates as $cert)
                    @php $fa = $cert->translate('fa') ?? $cert->getTranslation('fa'); @endphp
                    <tr>
                        <td>{{ $cert->id }}</td>
                        <td>
                            @if($cert->image)
                                <img src="{{ asset('storage/' . $cert->image) }}"
                                     alt="{{ $fa?->image_alt ?? 'certificate' }}"
                                     loading="lazy"
                                     style="width:60px;height:60px;object-fit:contain;border-radius:6px;background:#f5f5f5;">
                            @else
                                <span class="text-muted">—</span>
                            @endif
                        </td>
                        <td>{{ $fa?->title ?? '—' }}</td>
                        <td>
                            <span class="badge bg-info">{{ $cert->category_label }}</span>
                        </td>
                        <td>{{ $cert->certificate_number ?? '—' }}</td>
                        <td>{{ $cert->issuer ?? '—' }}</td>
                        <td>
                            @if($cert->expires_at)
                                <span class="{{ $cert->is_expired ? 'text-danger' : '' }}">
                                {{ $cert->expires_at->format('Y/m/d') }}
                            </span>
                            @else
                                —
                            @endif
                        </td>
                        <td>{{ $cert->sort_order }}</td>
                        <td>
                            @if($cert->is_active)
                                <span class="badge bg-success">فعال</span>
                            @else
                                <span class="badge bg-secondary">غیرفعال</span>
                            @endif
                            @if($cert->is_featured)
                                <span class="badge bg-warning text-dark">ویژه</span>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex gap-2">
                                <a href="{{ route('admin.certificate.edit', $cert) }}"
                                   class="btn btn-sm btn-primary">ویرایش</a>
                                <form action="{{ route('admin.certificate.destroy', $cert) }}"
                                      method="POST"
                                      onsubmit="return confirm('این مدرک حذف شود؟')">
                                    @csrf @method('DELETE')
                                    <button class="btn btn-sm btn-danger">حذف</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="10" class="text-center text-muted py-4">مدرکی یافت نشد.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="mt-3">
            {{ $certificates->links() }}
        </div>
    </div>
@endsection
