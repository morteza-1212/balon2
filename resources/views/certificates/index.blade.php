@extends('layouts.home')

@section('title', __('certificates.page_title') . ' | ' . config('app.name'))
@section('meta_description', __('certificates.meta_description'))
@section('meta_keywords', __('certificates.meta_keywords'))

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/certificate/certificate.css') }}">
@endsection

@section('content')

    <main class="certificates-page">

        {{-- HERO --}}
        <section class="cert-hero"
                 @if(isset($heroImage)) style="--cert-hero-image: url('{{ $heroImage }}');" @endif>
            <div class="container">
                <div class="cert-hero-content">
                    <nav class="cert-breadcrumb">
                        <a href="{{ url('/') }}">{{ __('certificates.breadcrumb_home') }}</a>
                        <span class="cert-breadcrumb-sep">/</span>
                        <span aria-current="page">{{ __('certificates.breadcrumb_current') }}</span>
                    </nav>
                    <span class="cert-hero-label">{{ __('certificates.hero_label') }}</span>
                    <h1>{{ __('certificates.hero_title') }}</h1>
                    <p>{{ __('certificates.hero_description') }}</p>
                </div>
            </div>
        </section>

        {{-- INTRO --}}
        <section class="cert-intro">
            <div class="container">
                <header class="cert-section-title">
                    <span>{{ __('certificates.intro_label') }}</span>
                    <h2>{{ __('certificates.intro_title') }}</h2>
                </header>
                <p class="cert-intro-text">{{ __('certificates.intro_description') }}</p>
            </div>
        </section>

        {{-- CATEGORIES --}}
        <section class="cert-categories">
            <div class="container">
                <div class="row g-4">
                    <div class="col-md-4">
                        <article class="cert-category">
                            <div class="cert-category-icon"><i class="fas fa-file-contract"></i></div>
                            <h3>{{ __('certificates.category_license') }}</h3>
                            <p>{{ __('certificates.category_license_desc') }}</p>
                        </article>
                    </div>
                    <div class="col-md-4">
                        <article class="cert-category">
                            <div class="cert-category-icon"><i class="fas fa-certificate"></i></div>
                            <h3>{{ __('certificates.category_standard') }}</h3>
                            <p>{{ __('certificates.category_standard_desc') }}</p>
                        </article>
                    </div>
                    <div class="col-md-4">
                        <article class="cert-category">
                            <div class="cert-category-icon"><i class="fas fa-shield-alt"></i></div>
                            <h3>{{ __('certificates.category_technical') }}</h3>
                            <p>{{ __('certificates.category_technical_desc') }}</p>
                        </article>
                    </div>
                </div>
            </div>
        </section>

        {{-- GALLERY --}}
        <section class="cert-gallery-section" id="certificates">
            <div class="container">
                <header class="cert-gallery-heading">
                    <div class="cert-section-title">
                        <span>{{ __('certificates.gallery_label') }}</span>
                        <h2>{{ __('certificates.gallery_title') }}</h2>
                    </div>
                    <p>{{ __('certificates.gallery_hint') }}</p>
                </header>

                @if($certificates->isEmpty())
                    <div class="text-center py-5">
                        <p class="text-muted">{{ __('certificates.empty') }}</p>
                    </div>
                @else
                    <div class="row g-4">
                        @foreach($certificates as $cert)
                            @php
                                $tr = $cert->translate($locale) ?? $cert->translate('fa');
                                if (!$tr || empty(trim((string) $tr->title))) continue;
                                $imageUrl = $cert->image_url;
                                $categoryLabel = $categories[$cert->category] ?? __('certificates.unknown');
                            @endphp
                            <div class="col-lg-4 col-md-6">
                                <article class="cert-card">
                                    @if($imageUrl)
                                        <button type="button"
                                                class="cert-image"
                                                data-image-src="{{ $imageUrl }}"
                                                data-image-alt="{{ $tr->image_alt ?? $tr->title }}"
                                                data-image-title="{{ $tr->title }}"
                                                aria-label="{{ __('certificates.view_certificate') }}: {{ $tr->title }}">
                                            <img src="{{ $imageUrl }}" alt="{{ $tr->image_alt ?? $tr->title }}" loading="lazy">
                                            <span class="cert-image-overlay">
                                                <span class="cert-image-overlay-btn">
                                                    <i class="fas fa-search-plus"></i>
                                                    {{ __('certificates.view_certificate') }}
                                                </span>
                                            </span>
                                        </button>
                                    @else
                                        <div class="cert-image cert-image--empty"><i class="fas fa-file-alt"></i></div>
                                    @endif
                                    <div class="cert-card-body">
                                        <span class="cert-card-category">{{ $categoryLabel }}</span>
                                        <h3>{{ $tr->title }}</h3>
                                        @if(!empty($tr->description))<p>{{ $tr->description }}</p>@endif
                                        <div class="cert-card-meta">
                                            @if($cert->certificate_number)
                                                <small><i class="fas fa-hashtag"></i> {{ $cert->certificate_number }}</small>
                                            @endif
                                            @if($cert->issuer)
                                                <small><i class="fas fa-building"></i> {{ $cert->issuer }}</small>
                                            @endif
                                            @if($cert->issued_at)
                                                <small><i class="fas fa-calendar-alt"></i> {{ $cert->issued_at->format('Y/m/d') }}</small>
                                            @endif
                                            @if($cert->expires_at)
                                                <small class="{{ $cert->is_expired ? 'text-danger' : '' }}">
                                                    <i class="fas fa-calendar-times"></i> {{ $cert->expires_at->format('Y/m/d') }}
                                                    @if($cert->is_expired)({{ __('certificates.expired') }})@endif
                                                </small>
                                            @endif
                                            @if($cert->file_url)
                                                <a href="{{ $cert->file_url }}" target="_blank" rel="noopener" class="cert-card-pdf">
                                                    <i class="fas fa-file-pdf"></i> {{ __('certificates.download_pdf') }}
                                                </a>
                                            @endif
                                        </div>
                                    </div>
                                </article>
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>
        </section>

        {{-- TRUST --}}
        <section class="cert-trust">
            <div class="container">
                <div class="cert-trust-box" >
                    <h2 style="color: white">{{ __('certificates.trust_title') }}</h2>
                    <p>{{ __('certificates.trust_description') }}</p>
                </div>
            </div>
        </section>

        {{-- CTA --}}
        <section class="cert-cta">
            <div class="container">
                <div class="cert-cta-box">
                    <div class="cert-cta-text">
                        <h3>{{ __('certificates.cta_title') }}</h3>
                        <p>{{ __('certificates.cta_description') }}</p>
                    </div>
                    <a href="tel:+982188776655" class="cert-cta-btn">
                        {{ __('certificates.cta_button') }} <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </section>

        {{-- MODAL --}}
        <div class="cert-modal" id="certModal" hidden>
            <button class="cert-modal-close" type="button" aria-label="{{ __('certificates.modal_close') }}">
                <i class="fas fa-times"></i>
            </button>
            <div class="cert-modal-figure" role="dialog" aria-modal="true">
                <img id="certModalImage" src="" alt="">
                <p class="cert-modal-caption" id="certModalCaption"></p>
            </div>
        </div>

    </main>

    {{-- ⬇️ اسکریپت مستقیم، داخل @section('content') --}}
    <script>
        (function () {
            'use strict';

            function initCertModal() {
                var modal        = document.getElementById('certModal');
                var modalImage   = document.getElementById('certModalImage');
                var modalCaption = document.getElementById('certModalCaption');
                var closeBtn     = modal ? modal.querySelector('.cert-modal-close') : null;

                console.log('[CertModal] init:', { modal: !!modal, modalImage: !!modalImage });

                if (!modal || !modalImage) {
                    console.error('[CertModal] عناصر مودال پیدا نشدند');
                    return;
                }

                function openModal(src, alt, title) {
                    console.log('[CertModal] open:', src);
                    if (!src) return;
                    modalImage.src = src;
                    modalImage.alt = alt || '';
                    if (modalCaption) {
                        modalCaption.textContent = title || '';
                        modalCaption.style.display = title ? 'block' : 'none';
                    }
                    modal.hidden = false;
                    modal.classList.add('active');
                    document.body.style.overflow = 'hidden';
                }

                function closeModal() {
                    modal.classList.remove('active');
                    modal.hidden = true;
                    modalImage.src = '';
                    document.body.style.overflow = '';
                }

                var buttons = document.querySelectorAll('.cert-image[data-image-src]');
                console.log('[CertModal] buttons found:', buttons.length);

                buttons.forEach(function (btn) {
                    btn.addEventListener('click', function (e) {
                        e.preventDefault();
                        openModal(
                            btn.getAttribute('data-image-src'),
                            btn.getAttribute('data-image-alt'),
                            btn.getAttribute('data-image-title')
                        );
                    });
                });

                modal.addEventListener('click', function (e) {
                    if (e.target === modal) closeModal();
                });

                if (closeBtn) closeBtn.addEventListener('click', closeModal);

                document.addEventListener('keydown', function (e) {
                    if (e.key === 'Escape' && modal.classList.contains('active')) {
                        closeModal();
                    }
                });

                window.openCertModal = openModal;
                window.closeCertModal = closeModal;
            }

            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initCertModal);
            } else {
                initCertModal();
            }
        })();
    </script>

@endsection
