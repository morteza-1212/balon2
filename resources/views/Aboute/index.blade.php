@extends('layouts.home')

@section('title', 'درباره شهاب بالن | تولیدکننده بالن‌های نظامی، تبلیغاتی و پژوهشی')

@section('meta')
    <meta name="description" content="با شرکت شهاب بالن آشنا شوید؛ تولیدکننده و عرضه‌کننده بالن‌های نظامی، تبلیغاتی و پژوهشی. آشنایی با تاریخچه، توانمندی‌ها، تیم، فرایند تولید و استانداردهای شرکت.">
    <meta name="keywords" content="درباره شهاب بالن, شرکت تولید بالن, تولید بالن نظامی, بالن تبلیغاتی, بالن پژوهشی, بالن هواشناسی, تولید بالن تخصصی, تولیدکننده بالن">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ url('/about') }}">

    <meta property="og:type" content="website">
    <meta property="og:title" content="درباره شرکت شهاب بالن">
    <meta property="og:description" content="معرفی شرکت شهاب بالن، حوزه‌های فعالیت (نظامی، تبلیغاتی، پژوهشی)، توانمندی‌های تولیدی و خدمات تخصصی.">
    <meta property="og:url" content="{{ url('/about') }}">
    <meta property="og:locale" content="{{ app()->getLocale() == 'fa' ? 'fa_IR' : (app()->getLocale() == 'ar' ? 'ar_SA' : 'en_US') }}">
    <meta property="og:image" content="{{ asset('img/og-image-about.jpg') }}">

    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="درباره شهاب بالن">
    <meta name="twitter:description" content="آشنایی با شرکت شهاب بالن و توانمندی‌های تولیدی در سه حوزه نظامی، تبلیغاتی و پژوهشی.">
    <meta name="twitter:image" content="{{ asset('img/og-image-about.jpg') }}">
@endsection

@section('content')

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
            --cyan-300: #80D8FA;
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
            direction: rtl;
            text-align: right;
            color: var(--navy-600);
            line-height: 2.1;
            background: var(--bg);
            overflow-x: hidden;
            font-family: 'Vazirmatn', 'IRANSans', Tahoma, sans-serif;
        }

        /* ============ HERO SECTION ============ */
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

        .about-hero::after {
            content: '';
            position: absolute;
            inset: 0;
            /*background: linear-gradient(135deg, rgba(10, 31, 68, 0.9) 0%, rgba(6, 21, 48, 0.95) 100%);*/
            z-index: -1;
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
            letter-spacing: 0.3px;
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
            text-shadow: 0 4px 30px rgba(0, 0, 0, 0.3);
        }

        .about-hero p {
            max-width: 800px;
            margin: 0 auto;
            font-size: 16px;
            color: #C5D3E3;
            line-height: 2;
        }

        /* ============ GENERAL SECTIONS ============ */
        .about-section {
            padding: 80px 20px;
            position: relative;
        }

        .about-section.bg-light {
            background: var(--surface-2);
        }

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
            padding-right: 20px;
        }

        .about-badge::before {
            content: '◆';
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
            font-size: 10px;
        }

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

        .about-image {
            width: 100%;
            height: 100%;
            min-height: 350px;
            object-fit: cover;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            transition: transform 0.5s ease;
        }

        .about-image:hover {
            transform: scale(1.02);
        }

        /* ============ CARDS ============ */
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
            right: 0;
            width: 4px;
            height: 100%;
            background: linear-gradient(180deg, var(--gold-500), var(--cyan-400));
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .about-card:hover {
            transform: translateY(-8px);
            box-shadow: var(--shadow-lg);
            border-color: transparent;
        }

        .about-card:hover::before {
            opacity: 1;
        }

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

        /* ============ HIGHLIGHT SECTION ============ */
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

        .about-highlight .about-badge {
            color: var(--gold-400);
        }

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

        .about-list {
            padding: 0;
            list-style: none;
            margin-top: 24px;
        }

        .about-list li {
            position: relative;
            margin-bottom: 14px;
            padding-right: 34px;
            color: #E2EAF2;
            font-size: 15px;
            line-height: 2;
            transition: transform 0.3s ease;
        }

        .about-list li::before {
            content: '\f00c';
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            position: absolute;
            right: 0;
            top: 4px;
            color: var(--gold-400);
            font-size: 13px;
        }

        .about-list li:hover {
            transform: translateX(-6px);
            color: #fff;
        }

        /* ============ TIMELINE ============ */
        .about-timeline {
            border-right: 2px solid var(--border);
            padding-right: 30px;
            position: relative;
        }

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

        .timeline-item:hover {
            transform: translateX(-6px);
            box-shadow: var(--shadow-md);
            border-color: var(--gold-400);
        }

        .timeline-item::before {
            content: '';
            position: absolute;
            right: -40px;
            top: 28px;
            width: 16px;
            height: 16px;
            background: var(--gold-500);
            border-radius: 50%;
            border: 3px solid var(--bg);
            box-shadow: 0 0 0 4px rgba(212, 175, 55, 0.15);
            transition: all 0.3s ease;
        }

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

        /* ============ FAQ ACCORDION ============ */
        .accordion-item {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius) !important;
            margin-bottom: 14px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
        }

        .accordion-button {
            font-weight: 800;
            font-size: 16px;
            color: var(--navy-800);
            background: var(--surface);
            padding: 20px 24px;
            text-align: right;
            border: none;
            box-shadow: none !important;
        }

        .accordion-button:not(.collapsed) {
            color: var(--navy-800);
            background: var(--surface-2);
        }

        .accordion-button::after {
            background-image: none;
            content: '\f067';
            font-family: "Font Awesome 5 Free";
            font-weight: 900;
            color: var(--gold-500);
            transition: transform 0.3s ease;
        }

        .accordion-button:not(.collapsed)::after {
            transform: rotate(45deg);
            color: var(--cyan-400);
        }

        .accordion-body {
            padding: 0 24px 22px;
            color: var(--text-mid);
            font-size: 14.5px;
            line-height: 2.2;
        }

        /* ============ CTA ============ */
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
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
            z-index: 2;
        }

        .about-cta .btn:hover {
            transform: translateY(-4px) scale(1.02);
            box-shadow: 0 16px 40px rgba(212, 175, 55, 0.55);
            color: var(--navy-900);
        }

        /* ============ ALERT ============ */
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

        .alert-warning strong {
            color: var(--navy-900);
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 992px) {
            .about-hero { padding: 90px 20px 70px; }
            .about-section { padding: 60px 20px; }
            .about-highlight { padding: 60px 20px; }
            .about-timeline { border: none; padding-right: 0; margin-top: 20px; }
            .timeline-item::before { display: none; }
            .timeline-item { border-right: 4px solid var(--gold-500); }
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
            .accordion-button { padding: 16px 18px; font-size: 14.5px; }
            .accordion-body { padding: 0 18px 18px; font-size: 14px; }
            .about-cta { padding: 44px 20px; }
            .about-cta .btn { padding: 13px 32px; font-size: 14px; }
            .about-image { min-height: 250px; }
        }
    </style>

    <div class="about-page">

        {{-- Hero --}}
        <section class="about-hero">
            <div class="container-custom">
                <span class="badge">معرفی شرکت</span>
                <h1>درباره شرکت شهاب بالن</h1>
                <p>
                    شهاب بالن با تمرکز بر طراحی، تولید و عرضه انواع بالن‌های تخصصی در سه حوزه
                    <strong>نظامی</strong>، <strong>تبلیغاتی</strong> و <strong>پژوهشی</strong>،
                    در مسیر ارائه راهکارهای متناسب با نیاز صنایع، سازمان‌ها، مجموعه‌های
                    پژوهشی و کسب‌وکارها فعالیت می‌کند.
                </p>
            </div>
        </section>

        {{-- معرفی شرکت --}}
        <section class="about-section">
            <div class="container-custom">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <span class="about-badge">ما که هستیم؟</span>
                        <h2 class="about-section-title">معرفی شرکت شهاب بالن</h2>
                        <p>
                            شرکت شهاب بالن در حوزه طراحی، ساخت و تأمین محصولات
                            مبتنی بر فناوری بالن فعالیت می‌کند. تمرکز اصلی این مجموعه
                            بر سه حوزه تخصصی <strong>بالن‌های نظامی</strong>،
                            <strong>بالن‌های تبلیغاتی</strong> و <strong>بالن‌های پژوهشی</strong> است.
                        </p>
                        <p>
                            این شرکت با شناخت دقیق نیاز مشتری، انتخاب مواد اولیه مناسب،
                            طراحی کاربردی و کنترل کیفیت محصولات، راهکارهای اختصاصی
                            را برای هر یک از این سه حوزه ارائه می‌دهد.
                        </p>
                        <p>
                            هدف شهاب بالن، ارائه محصولاتی متناسب با نیاز پروژه،
                            شرایط محیطی، الزامات فنی و انتظارات مشتریان است.
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <img src="{{ asset('img/AbouteUs/ABOUTE.jpeg') }}"
                             class="about-image"
                             loading="lazy"
                             alt="معرفی شرکت شهاب بالن و فعالیت‌های تولیدی در سه حوزه نظامی، تبلیغاتی و پژوهشی">
                    </div>
                </div>
            </div>
        </section>

        {{-- حوزه های فعالیت --}}
        <section class="about-section bg-light">
            <div class="container-custom">
                <div class="text-center mb-5">
                    <span class="about-badge">زمینه‌های تخصصی</span>
                    <h2 class="about-section-title">حوزه‌های فعالیت شرکت</h2>
                    <p>فعالیت‌های شرکت شهاب بالن در سه حوزه اصلی تعریف شده است.</p>
                </div>

                <div class="row g-4 justify-content-center">
                    {{-- نظامی --}}
                    <div class="col-md-6 col-lg-4">
                        <div class="about-card">
                            <i class="fas fa-shield-alt"></i>
                            <h3>بالن‌های نظامی</h3>
                            <p>
                                طراحی و تولید بالون‌های شناسایی، نظارتی و آموزشی
                                با استانداردهای دفاعی و فناوری روز دنیا، متناسب با
                                نیاز سازمان‌های نظامی و پدافند غیرعامل.
                            </p>
                        </div>
                    </div>
                    {{-- تبلیغاتی --}}
                    <div class="col-md-6 col-lg-4">
                        <div class="about-card">
                            <i class="fas fa-bullhorn"></i>
                            <h3>بالن‌های تبلیغاتی</h3>
                            <p>
                                طراحی و تولید انواع بالن‌های تبلیغاتی، سازه‌های
                                بادی، بالن‌های نمایشگاهی و محصولات سفارشی
                                برای معرفی برندها و اجرای کمپین‌های تبلیغاتی.
                            </p>
                        </div>
                    </div>
                    {{-- پژوهشی --}}
                    <div class="col-md-6 col-lg-4">
                        <div class="about-card">
                            <i class="fas fa-flask"></i>
                            <h3>بالن‌های پژوهشی</h3>
                            <p>
                                تأمین و تولید محصولات مرتبط با پروژه‌های تحقیقاتی،
                                مطالعات جوی، هواشناسی، آزمایش‌های علمی و
                                کاربردهای دانشگاهی متناسب با مشخصات فنی پروژه.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- تاریخچه --}}
        <section class="about-section">
            <div class="container-custom">
                <div class="row g-5">
                    <div class="col-lg-5">
                        <span class="about-badge">مسیر فعالیت</span>
                        <h2 class="about-section-title">تاریخچه و مسیر توسعه</h2>
                        <p>
                            مسیر توسعه شهاب بالن بر پایه شناخت نیاز بازار در سه حوزه
                            نظامی، تبلیغاتی و پژوهشی، ارتقای توان فنی، توسعه محصولات
                            و بهبود مستمر فرایندهای طراحی و تولید شکل می‌گیرد.
                        </p>
                        <p>
                            این مجموعه تلاش می‌کند با توجه به تغییر نیازهای مشتریان
                            و پیشرفت فناوری، راهکارهای مناسب‌تری برای پروژه‌های
                            مختلف در هر یک از این حوزه‌ها ارائه کند.
                        </p>
                    </div>
                    <div class="col-lg-7">
                        <div class="about-timeline">
                            <div class="timeline-item">
                                <h3>آغاز فعالیت</h3>
                                <p>شروع فعالیت مجموعه در حوزه محصولات و راهکارهای مرتبط با بالن در سه حوزه اصلی.</p>
                            </div>
                            <div class="timeline-item">
                                <h3>توسعه محصولات</h3>
                                <p>گسترش زمینه‌های طراحی و تولید در حوزه‌های نظامی، تبلیغاتی و پژوهشی و پاسخ‌گویی به سفارش‌های متنوع مشتریان.</p>
                            </div>
                            <div class="timeline-item">
                                <h3>توسعه توانمندی‌های فنی</h3>
                                <p>تمرکز بر بهبود فرایندهای تولید، کنترل کیفیت و توسعه محصولات سفارشی در سه حوزه تخصصی.</p>
                            </div>
                            <div class="timeline-item">
                                <h3>افق آینده</h3>
                                <p>توسعه همکاری‌های داخلی و بین‌المللی و ارتقای مستمر کیفیت محصولات و خدمات در حوزه‌های نظامی، تبلیغاتی و پژوهشی.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- تیم و ظرفیت تولید --}}
        <section class="about-highlight">
            <div class="container-custom">
                <div class="row align-items-center g-5">
                    <div class="col-lg-6">
                        <span class="about-badge">توانمندی سازمانی</span>
                        <h2>تیم تخصصی و ظرفیت تولید</h2>
                        <p>
                            کیفیت محصول تنها به تجهیزات وابسته نیست؛
                            دانش فنی، تجربه نیروی انسانی، انتخاب مواد اولیه،
                            نظارت بر مراحل تولید و کنترل کیفیت نیز نقش مهمی
                            در نتیجه نهایی دارند.
                        </p>
                        <p>
                            شهاب بالن با رویکرد توسعه توانمندی‌های تخصصی در سه حوزه
                            نظامی، تبلیغاتی و پژوهشی، تلاش می‌کند محصولات خود را
                            متناسب با مشخصات فنی و شرایط موردنیاز هر پروژه ارائه کند.
                        </p>
                    </div>
                    <div class="col-lg-6">
                        <ul class="about-list">
                            <li>بررسی نیاز و مشخصات فنی سفارش</li>
                            <li>طراحی و انتخاب مواد اولیه متناسب با کاربرد</li>
                            <li>برنامه‌ریزی و اجرای مراحل تولید</li>
                            <li>بررسی کیفیت و انطباق محصول با سفارش</li>
                            <li>بسته‌بندی و آماده‌سازی برای تحویل</li>
                            <li>پشتیبانی و پیگیری سفارش‌ها</li>
                        </ul>
                        <div class="mt-4">
                            <p style="font-size: 14px; opacity: 0.8;">
                                ظرفیت تولید، تعداد اعضای تیم و مشخصات تجهیزات
                                باید بر اساس اطلاعات رسمی و قابل تأیید شرکت
                                در این بخش تکمیل شوند.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- مجوزها و گواهی ها --}}
        <section class="about-section">
            <div class="container-custom">
                <div class="text-center mb-5">
                    <span class="about-badge">اعتبار و استانداردها</span>
                    <h2 class="about-section-title">مجوزها و گواهی‌نامه‌ها</h2>
                    <p>
                        شفافیت در ارائه مستندات قانونی، مجوزهای فعالیت
                        و گواهی‌های معتبر، بخشی از مسیر ایجاد اعتماد
                        در همکاری‌های تجاری و صنعتی است.
                    </p>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-4">
                        <div class="about-card text-center">
                            <i class="fas fa-certificate"></i>
                            <h3>گواهی‌نامه‌های کیفیت</h3>
                            <p>معرفی استانداردها و گواهی‌نامه‌هایی که شرکت واقعاً دریافت کرده و اعتبار آن‌ها قابل بررسی است.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="about-card text-center">
                            <i class="fas fa-file-contract"></i>
                            <h3>مجوزهای قانونی</h3>
                            <p>ارائه اطلاعات مجوزهای ثبت، فعالیت و سایر مجوزهای رسمی مرتبط با حوزه فعالیت شرکت.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-4">
                        <div class="about-card text-center">
                            <i class="fas fa-award"></i>
                            <h3>سوابق و تأییدیه‌ها</h3>
                            <p>معرفی تأییدیه‌ها، گواهی‌های فنی و مستندات مرتبط با محصولات و پروژه‌های انجام‌شده.</p>
                        </div>
                    </div>
                </div>

                <div class="alert alert-warning mt-4">
                    <strong>توجه:</strong> تصاویر و نام مجوزها و گواهی‌نامه‌ها را فقط پس از دریافت
                    و تأیید مستندات رسمی شرکت در این قسمت قرار دهید.
                </div>
            </div>
        </section>

        {{-- ارزش ها --}}
        <section class="about-section bg-light">
            <div class="container-custom">
                <div class="text-center mb-5">
                    <span class="about-badge">اصول کاری ما</span>
                    <h2 class="about-section-title">ارزش‌ها و تعهدات شرکت</h2>
                </div>

                <div class="row g-4">
                    <div class="col-md-6 col-lg-3">
                        <div class="about-card text-center">
                            <i class="fas fa-check-circle"></i>
                            <h3>کیفیت</h3>
                            <p>توجه به کیفیت مواد اولیه، تولید و محصول نهایی.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="about-card text-center">
                            <i class="fas fa-lightbulb"></i>
                            <h3>نوآوری</h3>
                            <p>توسعه راهکارهای متناسب با نیازهای جدید مشتریان.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="about-card text-center">
                            <i class="fas fa-handshake"></i>
                            <h3>اعتماد</h3>
                            <p>شفافیت در ارتباطات و تعهد به توافق‌های کاری.</p>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-3">
                        <div class="about-card text-center">
                            <i class="fas fa-headset"></i>
                            <h3>پشتیبانی</h3>
                            <p>پاسخ‌گویی و همراهی در مراحل سفارش و تحویل.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- FAQ --}}
        <section class="about-section" id="faq">
            <div class="container-custom">
                <div class="text-center mb-5">
                    <span class="about-badge">پرسش و پاسخ</span>
                    <h2 class="about-section-title">سؤالات متداول درباره شهاب بالن</h2>
                </div>

                <div class="accordion" id="aboutFaq">
                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                شرکت شهاب بالن در چه زمینه‌هایی فعالیت می‌کند؟
                            </button>
                        </h3>
                        <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#aboutFaq">
                            <div class="accordion-body">
                                شهاب بالن در سه حوزه اصلی <strong>بالن‌های نظامی</strong>،
                                <strong>بالن‌های تبلیغاتی</strong> و <strong>بالن‌های پژوهشی</strong>
                                (شامل هواشناسی و کاربردهای علمی) فعالیت می‌کند.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                آیا امکان سفارش محصولات سفارشی در هر سه حوزه وجود دارد؟
                            </button>
                        </h3>
                        <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#aboutFaq">
                            <div class="accordion-body">
                                امکان بررسی و طراحی سفارش‌های سفارشی بر اساس نوع کاربرد (نظامی، تبلیغاتی، پژوهشی)، ابعاد، مشخصات فنی و شرایط پروژه وجود دارد. جزئیات هر سفارش پس از بررسی نیاز مشتری مشخص می‌شود.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                چگونه می‌توان درباره ظرفیت تولید شرکت اطلاعات گرفت؟
                            </button>
                        </h3>
                        <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#aboutFaq">
                            <div class="accordion-body">
                                ظرفیت تولید به نوع محصول (نظامی، تبلیغاتی، پژوهشی)، ابعاد، مواد اولیه و مشخصات سفارش بستگی دارد. برای دریافت اطلاعات دقیق می‌توان با واحد فروش و کارشناسان شرکت ارتباط برقرار کرد.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq4">
                                آیا شرکت دارای مجوز و گواهی‌نامه است؟
                            </button>
                        </h3>
                        <div id="faq4" class="accordion-collapse collapse" data-bs-parent="#aboutFaq">
                            <div class="accordion-body">
                                اطلاعات مجوزها و گواهی‌نامه‌های شرکت باید بر اساس مستندات رسمی و معتبر ارائه شود. برای بررسی هر مدرک می‌توانید با شرکت تماس بگیرید.
                            </div>
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h3 class="accordion-header">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq5">
                                چگونه می‌توان درخواست همکاری یا استعلام قیمت ثبت کرد؟
                            </button>
                        </h3>
                        <div id="faq5" class="accordion-collapse collapse" data-bs-parent="#aboutFaq">
                            <div class="accordion-body">
                                مشتریان و سازمان‌ها می‌توانند از طریق صفحه تماس با ما، اطلاعات محصول موردنظر (در حوزه نظامی، تبلیغاتی یا پژوهشی)، تعداد، کاربرد و مشخصات سفارش خود را ارسال کنند.
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- CTA --}}
        <section class="about-section">
            <div class="container-custom">
                <div class="about-cta">
                    <h2>آماده همکاری با شما هستیم</h2>
                    <p>
                        برای دریافت اطلاعات محصولات در حوزه‌های نظامی، تبلیغاتی و پژوهشی،
                        ثبت سفارش یا بررسی فرصت‌های همکاری با کارشناسان شهاب بالن ارتباط بگیرید.
                    </p>
                    <a href="tel:09191919885" class="btn">
                        تماس با ما
                        <i class="fas fa-arrow-left"></i>
                    </a>
                </div>
            </div>
        </section>

    </div>

    {{-- ============================================================
         STRUCTURED DATA (Schema.org)
    ============================================================ --}}
    @php
        $aboutUrl = url('/about');
        $siteUrl = url('/');

        $schema = [
            "@context" => "https://schema.org",
            "@graph" => [
                // 1. AboutPage
                [
                    "@type" => "AboutPage",
                    "@id" => $aboutUrl . "#aboutpage",
                    "url" => $aboutUrl,
                    "name" => "درباره شرکت شهاب بالن",
                    "description" => "معرفی شرکت شهاب بالن و حوزه‌های فعالیت آن در زمینه طراحی، تولید و عرضه بالن‌های نظامی، تبلیغاتی و پژوهشی.",
                    "inLanguage" => "fa-IR",
                    "mainEntity" => [
                        "@id" => $siteUrl . "#organization"
                    ]
                ],
                // 2. Organization
                [
                    "@type" => "Organization",
                    "@id" => $siteUrl . "#organization",
                    "name" => "شرکت شهاب بالن",
                    "alternateName" => "Shahab Balloon",
                    "url" => $siteUrl,
                    "logo" => asset('img/logo.png'),
                    "description" => "فعالیت در زمینه طراحی، تولید و عرضه محصولات مرتبط با بالن‌های نظامی، تبلیغاتی و پژوهشی.",
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
                // 3. BreadcrumbList
                [
                    "@type" => "BreadcrumbList",
                    "@id" => $aboutUrl . "#breadcrumb",
                    "itemListElement" => [
                        [
                            "@type" => "ListItem",
                            "position" => 1,
                            "name" => "صفحه اصلی",
                            "item" => $siteUrl
                        ],
                        [
                            "@type" => "ListItem",
                            "position" => 2,
                            "name" => "درباره ما",
                            "item" => $aboutUrl
                        ]
                    ]
                ],
                // 4. FAQPage
                [
                    "@type" => "FAQPage",
                    "@id" => $aboutUrl . "#faq",
                    "mainEntity" => [
                        [
                            "@type" => "Question",
                            "name" => "شرکت شهاب بالن در چه زمینه‌هایی فعالیت می‌کند؟",
                            "acceptedAnswer" => [
                                "@type" => "Answer",
                                "text" => "شهاب بالن در سه حوزه اصلی بالن‌های نظامی، بالن‌های تبلیغاتی و بالن‌های پژوهشی (شامل هواشناسی و کاربردهای علمی) فعالیت می‌کند."
                            ]
                        ],
                        [
                            "@type" => "Question",
                            "name" => "آیا امکان سفارش محصولات سفارشی در هر سه حوزه وجود دارد؟",
                            "acceptedAnswer" => [
                                "@type" => "Answer",
                                "text" => "امکان بررسی و طراحی سفارش‌های سفارشی بر اساس نوع کاربرد (نظامی، تبلیغاتی، پژوهشی)، ابعاد، مشخصات فنی و شرایط پروژه وجود دارد."
                            ]
                        ],
                        [
                            "@type" => "Question",
                            "name" => "چگونه می‌توان درباره ظرفیت تولید شرکت اطلاعات گرفت؟",
                            "acceptedAnswer" => [
                                "@type" => "Answer",
                                "text" => "ظرفیت تولید به نوع محصول (نظامی، تبلیغاتی، پژوهشی)، ابعاد، مواد اولیه و مشخصات سفارش بستگی دارد و برای دریافت اطلاعات دقیق باید با شرکت تماس گرفت."
                            ]
                        ],
                        [
                            "@type" => "Question",
                            "name" => "آیا شرکت دارای مجوز و گواهی‌نامه است؟",
                            "acceptedAnswer" => [
                                "@type" => "Answer",
                                "text" => "اطلاعات مجوزها و گواهی‌نامه‌های شرکت باید بر اساس مستندات رسمی و معتبر ارائه شود."
                            ]
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
