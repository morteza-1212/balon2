@extends('panelAdmin.layouts.panel')

@section('title', 'ویرایش مدرک')

@section('content')
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">ویرایش مدرک #{{ $certificate->id }}</h2>
        </div>

        @include('panelAdmin.panelCertificate._form', [
            'action' => route('admin.certificate.update', $certificate),
            'method' => 'PUT',
            'certificate' => $certificate,
        ])
    </div>
@endsection
