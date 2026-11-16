@extends('panelAdmin.layouts.panel')

@section('title', 'افزودن مدرک جدید')

@section('content')
    <div class="admin-card">
        <div class="admin-card-header">
            <h2 class="admin-card-title">افزودن مدرک جدید</h2>
        </div>

        @include('panelAdmin.panelCertificate._form', [
            'action' => route('admin.certificate.store'),
            'method' => 'POST',
            'certificate' => null,
        ])
    </div>
@endsection
