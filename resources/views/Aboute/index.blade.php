@extends('layouts.home')

@php
    $locale = app()->getLocale();
    $isRtl  = in_array($locale, ['fa', 'ar'], true);
@endphp

@section('title', __('about.meta.title'))

@section('meta')
    <meta name="description" content="{{ __('about.meta.description') }}">
    <meta name="keywords" content="{{ __('about.meta.keywords') }}">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ url($locale . '/about') }}">
    <link rel="alternate" hreflang="fa" href="{{ url('fa/about') }}">
    <link rel="alternate" hreflang="ar" href="{{ url('ar/about') }}">
    <link rel="alternate" hreflang="en" href="{{ url('en/about') }}">
    <link rel="alternate" hreflang="x-default" href="{{ url('fa/about') }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="{{ __('about.hero.title') }}">
    <meta property="og:description" content="{{ __('about.hero.subtitle') }}">
    <meta property="og:url" content="{{ url($locale . '/about') }}">
    <meta property="og:locale" content="{{ $locale === 'fa' ? 'fa_IR' : ($locale === 'ar' ? 'ar_SA' : 'en_US') }}">
    <meta property="og:image" content="{{ asset('img/og-image-about.jpg') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ __('about.hero.title') }}">
    <meta name="twitter:description" content="{{ __('about.hero.subtitle') }}">
    <meta name="twitter:image" content="{{ asset('img/og-image-about.jpg') }}">
@endsection

@section('styles')
    <style>
        :root {
            --navy-900: #061530;
            --navy-800: #0A1F44;
            --navy-700: #14315F;
            --navy-600: #1E427A;
            --gold-500: #D4AF37;
            --gold-400: #E5C158;
            --gold-300: #F0D98C;
            --cyan-400: #4FC3F7;
            --bg: #F7F9FC;
            --surface: #FFFFFF;
            --surface-2: #EEF2F8;
            --text-dark: #0F1A2E;
            --text-mid: #4A5568;
            --border: #DDE4EE;
            --shadow-sm: 0 2px 8px rgba(10, 31, 68, 0.06);
            --shadow-md: 0 8px 24px rgba(10, 31, 68, 0.10);
            --shadow-lg: 0 20px 50px rgba(10, 31, 68, 0.18);
            --radius: 18px;
            --radius-sm: 12px;
        }

        * { box-sizing: border-box; }

        .about-page {
            color: var(--navy-600);
            line-height: 2.1;
            background: var(--bg);
            overflow-x: hidden;
            font-family: 'Vazirmatn', 'IRANSans', Tahoma, sans-serif;
        }

        .about-page[dir="rtl"] { direction: rtl; text-align: right; }
        .about-page[dir="ltr"] { direction: ltr; text-align: left; }

        .about-hero {
            position: relative;
            padding: 120px 20px 100px;
            background: var(--navy-800);
            color: #fff;
            text-align: center;
            overflow: hidden;
            isolation: isolate;
        }

        .about-hero::before {
            content: '';
            position: absolute;
            inset: 0;
            background-image: url('{{ asset('img/AbouteUs/aboute-banner.jpeg') }}');
            background-size: cover;
            background-position: center;
            opacity: 0.25;
            z-index: -2;
        }

        .about-hero .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, var(--gold-500), var(--gold-400));
            color: var(--navy-900);
            padding: 9px 22px;
            border-radius: 40px;
            font-size: 13px;
            font-weight: 800;
            box-shadow: 0 6px 24px rgba(212, 175, 55, 0.4);
            animation: badgePulse 3s ease-in-out infinite;
            margin-bottom: 20px;
        }

        @keyframes badgePulse {
            0%, 100% { transform: scale(1); }
            50%      { transform: scale(1.05); }
        }

        .about-hero h1 {
            font-size: clamp(28px, 4.5vw, 48px);
            font-weight: 900;
            line-height: 1.6;
            margin: 0 auto 20px;
            max-width: 900px;
            background: linear-gradient(180deg, #ffffff 0%, #c8d6e5 60%, var(--gold-300) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .about-hero p {
            max-width: 800px;
            margin: 0 auto;
            font-size: 16px;
            color: #C5D3E3;
            line-height: 2;
        }

        .about-section {
            padding: 80px 20px;
            position: relative;
        }

        .about-section.bg-light { background: var(--surface-2); }

        .container-custom {
            max-width: 1180px;
            margin: 0 auto;
        }

        .about-badge {
            display: inline-block;
            color: var(--gold-500);
            font-weight: 800;
            font-size: 14px;
            margin-bottom: 12px;
            position: relative;
        }

        .about-page[dir="rtl"] .about-badge { padding-right: 20px; }
        .about-page[dir="ltr"] .about-badge { padding-left: 20px; }

        .about-badge::before {
            content: '◆';
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            font-size: 10px;
        }

        .about-page[dir="rtl"] .about-badge::before { right: 0; }
        .about-page[dir="ltr"] .about-badge::before { left: 0; }

        .about-section-title {
            color: var(--navy-800);
            font-size: clamp(22px, 3vw, 32px);
            font-weight: 900;
            margin-bottom: 24px;
            line-height: 1.6;
        }

        .about-section p {
            color: var(--text-mid);
            font-size: 15.5px;
            line-height: 2.2;
            margin-bottom: 16px;
            text-align: justify;
        }

        .about-page[dir="ltr"] .about-section p { text-align: left; }

        .about-image {
            width: 100%;
            height: 100%;
            min-height: 350px;
            object-fit: cover;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            transition: transform 0.5s ease;
        }

        .about-image:hover { transform: scale(1.02); }

        .about-card {
            height: 100%;
            padding: 32px 24px;
            background: var(--surface);
            border-radius: var(--radius);
            box-shadow: var(--shadow-sm);
            border: 1px solid var(--border);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            overflow: hidden;
            display: flex;
            flex-direction: column;
        }

        .about-card::before {
            content: '';
            position: absolute;
            top: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--gold-500), var(--cyan-400));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .about-page[dir="rtl"] .about-card::before { right: 0; }
        .about-page[dir="ltr"] .about-card::before { left: 0; }

        .about-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: transparent;
        }

        .about-card:hover::before { opacity: 1; }

        .about-card i {
            font-size: 36px;
            color: var(--gold-500);
            margin-bottom: 20px;
            transition: transform 0.4s ease;
        }

        .about-card:hover i {
            transform: scale(1.1) rotate(-5deg);
            color: var(--cyan-400);
        }

        .about-card h3 {
            font-size: 19px;
            font-weight: 800;
            color: var(--navy-800);
            margin-bottom: 12px;
        }

        .about-card p {
            font-size: 14.5px;
            line-height: 2;
            margin-bottom: 0;
            color: var(--text-mid);
        }

        .text-center .about-card {
            text-align: center;
            align-items: center;
        }

        .about-highlight {
            background: linear-gradient(135deg, var(--navy-900) 0%, var(--navy-700) 100%);
            color: #fff;
            padding: 80px 20px;
            position: relative;
            overflow: hidden;
        }

        .about-highlight::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 600px;
            height: 600px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.15), transparent 70%);
            border-radius: 50%;
        }

        .about-highlight .about-badge { color: var(--gold-400); }

        .about-highlight h2 {
            color: #fff;
            font-size: clamp(24px, 3vw, 32px);
            font-weight: 900;
            margin-bottom: 20px;
        }

        .about-highlight p {
            color: #C5D3E3;
            font-size: 15.5px;
            line-height: 2.2;
            text-align: justify;
        }

        .about-page[dir="ltr"] .about-highlight p { text-align: left; }

        .about-list {
            padding: 0;
            list-style: none;
            margin-top: 24px;
        }

        .about-list li {
            position: relative;
            margin-bottom: 14px;
            color: #E2EAF2;
            font-size: 15px;
            line-height: 2;
            transition: transform 0.3s ease;
        }

        .about-page[dir="rtl"] .about-list li { padding-right: 34px; }
        .about-page[dir="ltr"] .about-list li { padding-left: 34px; }

        .about-list li::before {
            content: '\f00c';
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            position: absolute;
            top: 4px;
            color: var(--gold-400);
            font-size: 13px;
        }

        .about-page[dir="rtl"] .about-list li::before { right: 0; }
        .about-page[dir="ltr"] .about-list li::before { left: 0; }

        .about-page[dir="rtl"] .about-list li:hover { transform: translateX(-6px); }
        .about-page[dir="ltr"] .about-list li:hover { transform: translateX(6px); }

        .about-timeline {
            position: relative;
        }

        .about-page[dir="rtl"] .about-timeline { border-right: 2px solid var(--border); padding-right: 30px; }
        .about-page[dir="ltr"] .about-timeline { border-left: 2px solid var(--border); padding-left: 30px; }

        .timeline-item {
            position: relative;
            margin-bottom: 34px;
            padding: 20px 24px;
            background: var(--surface);
            border-radius: var(--radius-sm);
            border: 1px solid var(--border);
            box-shadow: var(--shadow-sm);
            transition: all 0.4s ease;
        }

        .about-page[dir="rtl"] .timeline-item:hover { transform: translateX(-6px); }
        .about-page[dir="ltr"] .timeline-item:hover { transform: translateX(6px); }

        .timeline-item:hover {
            box-shadow: var(--shadow-md);
            border-color: var(--gold-400);
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            top: 28px;
            width: 16px;
            height: 16px;
            background: var(--gold-500);
            border-radius: 50%;
            border: 3px solid var(--bg);
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.15);
            transition: all 0.3s ease;
        }

        .about-page[dir="rtl"] .timeline-item::before { right: -40px; }
        .about-page[dir="ltr"] .timeline-item::before { left: -40px; }

        .timeline-item:hover::before {
            background: var(--cyan-400);
            box-shadow: 0 0 0 6px rgba(79, 195, 247, 0.2);
        }

        .timeline-item h3 {
            color: var(--navy-800);
            font-size: 18px;
            font-weight: 800;
            margin-bottom: 8px;
        }

        .timeline-item p {
            margin: 0;
            font-size: 14.5px;
            line-height: 2;
        }

        .faq-item {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            margin-bottom: 14px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.35s ease;
        }

        .faq-item:hover { border-color: var(--gold-400); box-shadow: var(--shadow-md); }
        .faq-item[open] { border-color: var(--navy-700); }

        .faq-item summary {
            list-style: none;
            cursor: pointer;
            padding: 20px 24px;
            font-size: 16px;
            font-weight: 800;
            color: var(--navy-800);
            display: flex;
            align-items: center;
            gap: 16px;
        }

        .faq-item summary::-webkit-details-marker { display: none; }

        .faq-item summary::before {
            content: '+';
            flex-shrink: 0;
            width: 34px; height: 34px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--gold-500), var(--gold-400));
            color: var(--navy-900);
            border-radius: 50%;
            font-size: 22px;
            font-weight: 900;
            transition: all 0.4s ease;
        }

        .faq-item[open] summary::before {
            content: '−';
            background: linear-gradient(135deg, var(--navy-700), var(--navy-600));
            color: #fff;
            transform: rotate(180deg);
        }

        .faq-item .faq-body {
            padding: 0 24px 22px 76px;
            color: var(--text-mid);
            font-size: 14.5px;
            line-height: 2.2;
        }

        .about-page[dir="ltr"] .faq-item .faq-body { padding: 0 76px 22px 24px; }

        .about-cta {
            background: linear-gradient(135deg, var(--navy-800) 0%, var(--navy-600) 100%);
            padding: 64px 32px;
            border-radius: var(--radius);
            text-align: center;
            color: #fff;
            position: relative;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
        }

        .about-cta::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -20%;
            width: 400px;
            height: 400px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.2), transparent 70%);
            border-radius: 50%;
        }

        .about-cta h2 {
            color: #fff;
            font-size: clamp(22px, 3vw, 30px);
            font-weight: 900;
            margin-bottom: 16px;
            position: relative;
        }

        .about-cta p {
            color: #C5D3E3;
            max-width: 650px;
            margin: 0 auto 28px;
            font-size: 15.5px;
            text-align: center;
            position: relative;
        }

        .about-cta .btn {
            background: linear-gradient(135deg, var(--gold-500), var(--gold-400));
            color: var(--navy-900);
            border: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 900;
            font-size: 15px;
            display: inline-flex;
            align-items: center;
            gap: 10px;
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.4);
            transition: all 0.35s ease;
            position: relative;
            z-index: 2;
            text-decoration: none;
        }

        .about-cta .btn:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 16px 40px rgba(212, 175, 55, 0.55);
            color: var(--navy-900);
        }

        .alert-warning {
            background: #FFF9E8;
            border: 1px solid var(--gold-400);
            color: var(--navy-800);
            border-radius: var(--radius-sm);
            padding: 18px 22px;
            font-size: 14px;
            line-height: 1.9;
            margin-top: 32px;
        }

        @media (max-width: 992px) {
            .about-hero { padding: 90px 20px 70px; }
            .about-section { padding: 60px 20px; }
            .about-highlight { padding: 60px 20px; }
            .about-timeline { border: none !important; padding: 0 !important; margin-top: 20px; }
            .timeline-item::before { display: none; }
            .about-page[dir="rtl"] .timeline-item { border-right: 4px solid var(--gold-500); }
            .about-page[dir="ltr"] .timeline-item { border-left: 4px solid var(--gold-500); }
        }

        @media (max-width: 768px) {
            .about-hero { padding: 70px 16px 60px; }
            .about-section { padding: 50px 16px; }
            .about-hero h1 { font-size: 24px; }
            .about-hero p { font-size: 14.5px; }
            .about-section-title { font-size: 22px; }
            .about-section p { font-size: 14.5px; }
            .about-card { padding: 24px 18px; }
            .about-card i { font-size: 30px; }
            .about-card h3 { font-size: 17px; }
            .faq-item summary { padding: 16px 18px; font-size: 14.5px; }
            .faq-item .faq-body { padding: 0 18px 18px; font-size: 14px; }
            .about-cta { padding: 44px 20px; }
            .about-cta .btn { padding: 13px 32px; font-size: 14px; }
            .about-image { min-height: 250px; }
        }
    </style>
@endsection

@section('content')

    <div class="about-page" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">

        {{-- HERO --}}
        <section class="about-hero">
            <div class="container-custom">
                <span class="badge">{{ __('about.hero.badge') }}</span>
                <h1>{{ __('about.hero.title') }}</h1>
                <p>{{ __('about.hero.subtitle') }}</p>
            </div>
        </section>

        {{-- INTRO --}}
        <section class="about-section">
            <div class="container-custom">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <span class="about-badge">{{ __('about.intro.badge') }}</span>
                        <h2 class="about-section-title">{{ __('about.intro.title') }}</h2>
                        <p>{{ __('about.intro.p1') }}</p>
                        <p>{{ __('about.intro.p2') }}</p>
                        <p>{{ __('about.intro.p3') }}</p>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ asset('img/AbouteUs/ABOUTE.jpeg') }}"
                             class="about-image"
                             loading="lazy"
                             alt="{{ __('about.intro.image_alt') }}">
                    </div>
                </div>
            </div>
        </section>

        {{-- FIELDS --}}
        <section class="about-section bg-light">
            <div class="container-custom">
                <div class="text-center mb-5">
                    <span class="about-badge">{{ __('about.fields.badge') }}</span>
                    <h2 class="about-section-title">{{ __('about.fields.title') }}</h2>
                    <p>{{ __('about.fields.subtitle') }}</p>
                </div>

                <div class="row g-4 justify-content-center">
                    <div class="col-md-6 col-lg-4">
                        <div class="about-card">
                            <i class="fas fa-shield-alt"></i>
                            <h3>{{ __('about.fields.military_title') }}</h3>
                            <p>{{ __('about.fields.military_text') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="about-card">
                            <i class="fas fa-bullhorn"></i>
                            <h3>{{ __('about.fields.promo_title') }}</h3>
                            <p>{{ __('about.fields.promo_text') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="about-card">
                            <i class="fas fa-flask"></i>
                            <h3>{{ __('about.fields.research_title') }}</h3>
                            <p>{{ __('about.fields.research_text') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- HISTORY --}}
        <section class="about-section">
            <div class="container-custom">
                <div class="row g-5">
                    <div class="col-lg-5">
                        <span class="about-badge">{{ __('about.history.badge') }}</span>
                        <h2 class="about-section-title">{{ __('about.history.title') }}</h2>
                        <p>{{ __('about.history.p1') }}</p>
                        <p>{{ __('about.history.p2') }}</p>
                    </div>
                    <div class="col-lg-7">
                        <div class="about-timeline">
                            <div class="timeline-item">
                                <h3>{{ __('about.history.t1_title') }}</h3>
                                <p>{{ __('about.history.t1_text') }}</p>
                            </div>
                            <div class="timeline-item">
                                <h3>{{ __('about.history.t2_title') }}</h3>
                                <p>{{ __('about.history.t2_text') }}</p>
                            </div>
                            <div class="timeline-item">
                                <h3>{{ __('about.history.t3_title') }}</h3>
                                <p>{{ __('about.history.t3_text') }}</p>
                            </div>
                            <div class="timeline-item">
                                <h3>{{ __('about.history.t4_title') }}</h3>
                                <p>{{ __('about.history.t4_text') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- TEAM --}}
        <section class="about-highlight">
            <div class="container-custom">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <span class="about-badge">{{ __('about.team.badge') }}</span>
                        <h2>{{ __('about.team.title') }}</h2>
                        <p>{{ __('about.team.p1') }}</p>
                        <p>{{ __('about.team.p2') }}</p>
                    </div>
                    <div class="col-lg-6">
                        <ul class="about-list">
                            <li>{{ __('about.team.li1') }}</li>
                            <li>{{ __('about.team.li2') }}</li>
                            <li>{{ __('about.team.li3') }}</li>
                            <li>{{ __('about.team.li4') }}</li>
                            <li>{{ __('about.team.li5') }}</li>
                            <li>{{ __('about.team.li6') }}</li>
                        </ul>
                        <div class="mt-4">
                            <p style="font-size: 14px; opacity: 0.8;">{{ __('about.team.note') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- CERTS --}}
        <section class="about-section">
            <div class="container-custom">
                <div class="text-center mb-5">
                    <span class="about-badge">{{ __('about.certs.badge') }}</span>
                    <h2 class="about-section-title">{{ __('about.certs.title') }}</h2>
                    <p>{{ __('about.certs.subtitle') }}</p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="about-card text-center">
                            <i class="fas fa-certificate"></i>
                            <h3>{{ __('about.certs.c1_title') }}</h3>
                            <p>{{ __('about.certs.c1_text') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="about-card text-center">
                            <i class="fas fa-file-contract"></i>
                            <h3>{{ __('about.certs.c2_title') }}</h3>
                            <p>{{ __('about.certs.c2_text') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="about-card text-center">
                            <i class="fas fa-award"></i>
                            <h3>{{ __('about.certs.c3_title') }}</h3>
                            <p>{{ __('about.certs.c3_text') }}</p>
                        </div>
                    </div>
                </div>

                <div class="alert-warning">
                    {{ __('about.certs.note') }}
                </div>
            </div>
        </section>

        {{-- VALUES --}}
        <section class="about-section bg-light">
            <div class="container-custom">
                <div class="text-center mb-5">
                    <span class="about-badge">{{ __('about.values.badge') }}</span>
                    <h2 class="about-section-title">{{ __('about.values.title') }}</h2>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="about-card text-center">
                            <i class="fas fa-check-circle"></i>
                            <h3>{{ __('about.values.v1_title') }}</h3>
                            <p>{{ __('about.values.v1_text') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="about-card text-center">
                            <i class="fas fa-lightbulb"></i>
                            <h3>{{ __('about.values.v2_title') }}</h3>
                            <p>{{ __('about.values.v2_text') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="about-card text-center">
                            <i class="fas fa-handshake"></i>
                            <h3>{{ __('about.values.v3_title') }}</h3>
                            <p>{{ __('about.values.v3_text') }}</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="about-card text-center">
                            <i class="fas fa-headset"></i>
                            <h3>{{ __('about.values.v4_title') }}</h3>
                            <p>{{ __('about.values.v4_text') }}</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="about-section" id="faq">
            <div class="container-custom">
                <div class="text-center mb-5">
                    <span class="about-badge">{{ __('about.faq.badge') }}</span>
                    <h2 class="about-section-title">{{ __('about.faq.title') }}</h2>
                </div>

                <details class="faq-item" open>
                    <summary>{{ __('about.faq.q1') }}</summary>
                    <div class="faq-body">{{ __('about.faq.a1') }}</div>
                </details>
                <details class="faq-item">
                    <summary>{{ __('about.faq.q2') }}</summary>
                    <div class="faq-body">{{ __('about.faq.a2') }}</div>
                </details>
                <details class="faq-item">
                    <summary>{{ __('about.faq.q3') }}</summary>
                    <div class="faq-body">{{ __('about.faq.a3') }}</div>
                </details>
                <details class="faq-item">
                    <summary>{{ __('about.faq.q4') }}</summary>
                    <div class="faq-body">{{ __('about.faq.a4') }}</div>
                </details>
                <details class="faq-item">
                    <summary>{{ __('about.faq.q5') }}</summary>
                    <div class="faq-body">{{ __('about.faq.a5') }}</div>
                </details>
            </div>
        </section>

        {{-- CTA --}}
        <section class="about-section">
            <div class="container-custom">
                <div class="about-cta">
                    <h2>{{ __('about.cta.title') }}</h2>
                    <p>{{ __('about.cta.body') }}</p>
                    <a href="tel:{{ __('about.cta.phone') }}" class="btn">
                        {{ __('about.cta.button') }}
                        <i class="fas fa-arrow-{{ $isRtl ? 'left' : 'right' }}"></i>
                    </a>
                </div>
            </div>
        </section>

    </div>

    @php
        $aboutUrl = url($locale . '/about');
        $siteUrl = url('/');

        $schema = [
            "@context" => "https://schema.org",
            "@graph" => [
                [
                    "@type" => "AboutPage",
                    "@id" => $aboutUrl . "#aboutpage",
                    "url" => $aboutUrl,
                    "name" => __('about.hero.title'),
                    "description" => __('about.meta.description'),
                    "inLanguage" => $locale === 'fa' ? 'fa-IR' : ($locale === 'ar' ? 'ar-SA' : 'en-US'),
                    "mainEntity" => ["@id" => $siteUrl . "#organization"]
                ],
                [
                    "@type" => "Organization",
                    "@id" => $siteUrl . "#organization",
                    "name" => $locale === 'fa' ? 'شرکت شهاب بالن' : ($locale === 'ar' ? 'شركة شهاب بالون' : 'Shahbab Balloon Company'),
                    "alternateName" => "Shahab Balloon",
                    "url" => $siteUrl,
                    "logo" => asset('img/logo.png'),
                    "description" => __('about.meta.description'),
                    "address" => [
                        "@type" => "PostalAddress",
                        "streetAddress" => "شهرک صنعتی هشتگرد",
                        "addressLocality" => "هشتگرد",
                        "addressRegion" => "تهران",
                        "postalCode" => "3361633111",
                        "addressCountry" => "IR"
                    ],
                    "contactPoint" => [
                        "@type" => "ContactPoint",
                        "telephone" => "+982188776655",
                        "contactType" => "customer service",
                        "areaServed" => "IR",
                        "availableLanguage" => ["Persian", "English", "Arabic"]
                    ],
                    "sameAs" => [
                        "https://instagram.com/shahab_balloon",
                        "https://t.me/shahab_balloon",
                        "https://linkedin.com/company/shahab-balloon"
                    ]
                ],
                [
                    "@type" => "BreadcrumbList",
                    "@id" => $aboutUrl . "#breadcrumb",
                    "itemListElement" => [
                        [
                            "@type" => "ListItem",
                            "position" => 1,
                            "name" => $locale === 'fa' ? 'صفحه اصلی' : ($locale === 'ar' ? 'الرئيسية' : 'Home'),
                            "item" => $siteUrl
                        ],
                        [
                            "@type" => "ListItem",
                            "position" => 2,
                            "name" => $locale === 'fa' ? 'درباره ما' : ($locale === 'ar' ? 'من نحن' : 'About Us'),
                            "item" => $aboutUrl
                        ]
                    ]
                ],
                [
                    "@type" => "FAQPage",
                    "@id" => $aboutUrl . "#faq",
                    "mainEntity" => [
                        [
                            "@type" => "Question",
                            "name" => __('about.faq.q1'),
                            "acceptedAnswer" => ["@type" => "Answer", "text" => __('about.faq.a1')]
                        ],
                        [
                            "@type" => "Question",
                            "name" => __('about.faq.q2'),
                            "acceptedAnswer" => ["@type" => "Answer", "text" => __('about.faq.a2')]
                        ],
                        [
                            "@type" => "Question",
                            "name" => __('about.faq.q3'),
                            "acceptedAnswer" => ["@type" => "Answer", "text" => __('about.faq.a3')]
                        ],
                        [
                            "@type" => "Question",
                            "name" => __('about.faq.q4'),
                            "acceptedAnswer" => ["@type" => "Answer", "text" => __('about.faq.a4')]
                        ],
                        [
                            "@type" => "Question",
                            "name" => __('about.faq.q5'),
                            "acceptedAnswer" => ["@type" => "Answer", "text" => __('about.faq.a5')]
                        ]
                    ]
                ]
            ]
        ];
    @endphp

    <script type="application/ld+json">
        {!! json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) !!}
    </script>

@endsection
