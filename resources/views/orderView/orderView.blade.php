@extends('layouts.home')

@section('title', 'فرآیند سفارش بالن | مراحل طراحی و تولید بالن شهاب بالن')

@section('meta_description', 'با فرآیند سفارش بالن در شرکت شهاب بالن آشنا شوید. از ثبت درخواست و بررسی نیازمندی‌ها تا طراحی، تولید، کنترل کیفیت و تحویل بالن‌های تبلیغاتی، پژوهشی و نظامی.')

@section('meta_keywords', 'شهاب بالون,شهاب بالن,فرآیند سفارش بالن، سفارش تولید بالن، تولید بالن تبلیغاتی، تولید بالن پژوهشی، شرکت شهاب بالن، مراحل ساخت بالن')

@section('styles')
    <style>
        /* ---------- Design Tokens ---------- */
        :root {
            --site-primary: #0A1F44;          /* سرمه‌ای نظامی/پژوهشی */
            --site-primary-dark: #061530;      /* تیره‌تر برای گرادیان و hover */
            --site-primary-light: #14305F;     /* روشن‌تر برای کارت‌ها و تاکید */
            --site-primary-soft: #E6EBF3;      /* پس‌زمینه‌های نرم */
            --site-gold: #c69d55;              /* رنگ مکمل طلایی */
            --site-gold-dark: #a9813e;
            --site-gold-soft: #f6f0e5;
            --site-text: #68777e;
            --site-heading: #0A1F44;
            --site-border: #edf0f2;
            --site-bg-alt: #f7f8f9;
        }

        /* ---------- Base ---------- */
        .order-hero,
        .order-intro,
        .order-steps-section,
        .order-products,
        .order-information,
        .order-faq,
        .order-cta {
            direction: rtl;
            text-align: right;

        }

        .section-heading.text-center,
        .order-cta.text-center {
            text-align: center;
        }

        .order-cta .btn-light-custom {
            margin-top: 5px;
        }

        /* ---------- Hero ---------- */
        .order-hero {
            background:
                /*linear-gradient(110deg, rgba(10, 31, 68, .96), rgba(20, 48, 95, .88)),*/
                url('{{ asset("img/imageheader/orderView.jpeg") }}') center/cover no-repeat;
            padding: 125px 0;
            color: #fff;
        }

        .order-hero-content {
            max-width: 750px;
        }

        .hero-label,
        .section-heading span,
        .section-label,
        .step-label {
            display: inline-block;
            color: var(--site-gold);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 15px;
        }

        .order-hero h1 {
            font-size: 46px;
            font-weight: 800;
            margin-bottom: 25px;
            line-height: 1.4;
        }

        .order-hero p {
            font-size: 18px;
            line-height: 2;
            color: #e2e8eb;
        }

        .hero-buttons {
            display: flex;
            gap: 15px;
            flex-wrap: wrap;
            margin-top: 30px;
        }

        /* ---------- Buttons ---------- */
        .btn-primary-custom,
        .btn-outline-custom,
        .btn-light-custom {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 14px 25px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 700;
            transition: all .3s ease;
            border: 1px solid transparent;
        }

        .btn-primary-custom {
            background: var(--site-gold);
            color: #fff;
        }

        .btn-primary-custom:hover,
        .btn-primary-custom:focus {
            background: var(--site-gold-dark);
            color: #fff;
        }

        .btn-outline-custom {
            border-color: #fff;
            color: #fff;
        }

        .btn-outline-custom:hover,
        .btn-outline-custom:focus {
            background: #fff;
            color: var(--site-primary);
        }

        .btn-light-custom {
            background: var(--site-gold);
            color: #fff;
        }

        .btn-light-custom:hover,
        .btn-light-custom:focus {
            background: #fff;
            color: var(--site-primary);
        }

        /* ---------- Section Heading ---------- */
        .section-heading {
            max-width: 800px;
            margin: 0 auto 45px;
        }

        .section-heading h2 {
            font-size: 32px;
            font-weight: 800;
            color: var(--site-heading);
            margin-bottom: 18px;
            line-height: 1.5;
        }

        .section-heading p {
            color: var(--site-text);
            line-height: 2;
            margin-bottom: 0;
        }

        /* ---------- Intro & Product Cards ---------- */
        .intro-card,
        .product-order-card {
            height: 100%;
            padding: 35px 25px;
            background: #fff;
            border: 1px solid var(--site-border);
            border-radius: 10px;
            text-align: center;
            transition: transform .3s ease, box-shadow .3s ease;
        }

        .intro-card:hover,
        .product-order-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 35px rgba(10, 31, 68, .12);
        }

        .intro-icon,
        .product-order-icon {
            width: 75px;
            height: 75px;
            background: var(--site-gold-soft);
            color: var(--site-gold-dark);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 27px;
            margin: 0 auto 22px;
        }

        .intro-card h3,
        .product-order-card h3 {
            font-size: 20px;
            font-weight: 800;
            margin-bottom: 15px;
            color: var(--site-heading);
        }

        .intro-card p,
        .product-order-card p {
            color: var(--site-text);
            line-height: 2;
            margin-bottom: 0;
        }

        /* ---------- Timeline ---------- */
        .order-steps-section {
            background: var(--site-bg-alt);
        }

        .timeline {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
            list-style: none;
            padding: 0;
        }

        .timeline::before {
            content: '';
            position: absolute;
            right: 29px;
            top: 20px;
            bottom: 20px;
            width: 2px;
            background: #d7c29e;
        }

        .timeline-item {
            position: relative;
            padding-right: 100px;
            margin-bottom: 40px;
        }

        .timeline-item:last-child {
            margin-bottom: 0;
        }

        .timeline-number {
            position: absolute;
            right: 0;
            top: 0;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: var(--site-primary);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            font-size: 19px;
            z-index: 2;
            border: 5px solid var(--site-bg-alt);
        }

        .timeline-content {
            background: #fff;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 5px 25px rgba(10, 31, 68, .06);
            border-right: 3px solid var(--site-gold);
        }

        .timeline-content h3 {
            font-size: 22px;
            font-weight: 800;
            color: var(--site-primary);
            margin-bottom: 15px;
            line-height: 1.5;
        }

        .timeline-content p,
        .timeline-content li {
            color: var(--site-text);
            line-height: 2;
        }

        .timeline-content p {
            margin-bottom: 12px;
        }

        .timeline-content ul {
            padding-right: 20px;
            margin-bottom: 0;
        }

        .timeline-content li::marker {
            color: var(--site-gold);
        }

        /* ---------- Information ---------- */
        .order-information {
            background: #fff;
        }

        .order-information h2 {
            font-size: 32px;
            font-weight: 800;
            line-height: 1.7;
            color: var(--site-heading);
            margin-bottom: 18px;
        }

        .order-information p {
            color: var(--site-text);
            line-height: 2;
            margin-bottom: 0;
        }

        .information-list {
            margin-top: 25px;
            padding: 0;
            list-style: none;
        }

        .information-list li {
            padding: 10px 0;
            color: var(--site-primary);
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .information-list i {
            color: var(--site-gold-dark);
            margin-left: 10px;
            flex-shrink: 0;
        }

        .information-box {
            padding: 50px 35px;
            border-radius: 12px;
            background: linear-gradient(135deg, var(--site-primary), var(--site-primary-light));
            color: #fff;
            text-align: center;
            box-shadow: 0 15px 40px rgba(10, 31, 68, .25);
        }

        .information-box > i {
            font-size: 45px;
            color: var(--site-gold);
            margin-bottom: 20px;
        }

        .information-box h3 {
            font-weight: 800;
            margin-bottom: 20px;
            color: #fff;
        }

        .information-box p {
            color: #d0d9dd;
            margin-bottom: 25px;
            line-height: 2;
        }

        /* ---------- FAQ ---------- */
        .order-faq {
            background: var(--site-bg-alt);
        }

        .accordion-item {
            border: 1px solid var(--site-border) !important;
            margin-bottom: 12px;
            border-radius: 7px !important;
            overflow: hidden;
        }

        .accordion-button {
            font-weight: 700;
            color: var(--site-primary);
            padding: 20px;
            text-align: right;
            width: 100%;
            background: #fff;
            border: 0;
            font-size: 1rem;
            line-height: 1.6;
        }

        .accordion-button:not(.collapsed) {
            background: var(--site-primary);
            color: #fff;
            box-shadow: none;
        }

        .accordion-button::after {
            margin-right: auto;
            margin-left: 0;
            flex-shrink: 0;
        }

        .accordion-button:not(.collapsed)::after {
            filter: brightness(0) invert(1);
        }

        .accordion-body {
            color: var(--site-text);
            line-height: 2;
            padding: 22px;
            background: #fff;
        }

        /* ---------- CTA ---------- */
        .order-cta {
            padding: 85px 0;
            background: linear-gradient(110deg, var(--site-primary-dark), var(--site-primary-light));
            color: #fff;
        }

        .order-cta span {
            color: var(--site-gold);
            font-weight: 700;
            letter-spacing: 2px;
            display: inline-block;
            margin-bottom: 10px;
        }

        .order-cta h2 {
            font-size: 36px;
            font-weight: 800;
            margin: 20px 0;
            line-height: 1.4;
        }

        .order-cta p {
            color: #d0d9dd;
            line-height: 2;
            margin-bottom: 30px;
            max-width: 650px;
            margin-left: auto;
            margin-right: auto;
        }

        /* ---------- Focus Visible (Accessibility) ---------- */
        .btn-primary-custom:focus-visible,
        .btn-outline-custom:focus-visible,
        .btn-light-custom:focus-visible,
        .accordion-button:focus-visible {
            outline: 3px solid var(--site-gold);
            outline-offset: 3px;
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 991.98px) {
            .order-hero h1 {
                font-size: 38px;
            }

            .information-box {
                margin-top: 10px;
            }
        }

        @media (max-width: 767.98px) {
            .order-hero {
                padding: 85px 0;
            }

            .order-hero h1 {
                font-size: 32px;
            }

            .order-hero p {
                font-size: 15px;
            }

            .section-heading h2,
            .order-information h2 {
                font-size: 25px;
            }

            .timeline-item {
                padding-right: 75px;
            }

            .timeline-number {
                width: 50px;
                height: 50px;
                font-size: 16px;
            }

            .timeline::before {
                right: 24px;
            }

            .timeline-content {
                padding: 22px 18px;
            }

            .timeline-content h3 {
                font-size: 18px;
            }

            .order-cta h2 {
                font-size: 27px;
            }

            .hero-buttons {
                flex-direction: column;
                align-items: stretch;
            }

            .hero-buttons .btn-primary-custom,
            .hero-buttons .btn-outline-custom {
                justify-content: center;
            }

            .information-box {
                padding: 35px 22px;
            }

            .accordion-button {
                padding: 16px;
                font-size: .95rem;
            }
        }

        @media (max-width: 575.98px) {
            .order-hero h1 {
                font-size: 27px;
            }

            .timeline-item {
                padding-right: 65px;
            }

            .timeline-number {
                width: 44px;
                height: 44px;
                font-size: 14px;
                border-width: 4px;
            }

            .timeline::before {
                right: 21px;
            }

            .timeline-content h3 {
                font-size: 17px;
            }

            .timeline-content ul {
                padding-right: 16px;
            }
        }

        /* ---------- Motion Preference ---------- */
        @media (prefers-reduced-motion: reduce) {
            .intro-card,
            .product-order-card,
            .btn-primary-custom,
            .btn-outline-custom,
            .btn-light-custom {
                transition: none;
            }

            .intro-card:hover,
            .product-order-card:hover {
                transform: none;
            }
        }
    </style>
@endsection

@section('content')

    {{-- Hero Section --}}
    <section class="order-hero" aria-labelledby="hero-title">
        <div class="container">
            <div class="order-hero-content" style="color: white">
                <span class="hero-label">SHAHAB BALLOON</span>

                <h1 id="hero-title" style="color: #00bcd4">فرآیند سفارش و تولید بالن</h1>

                <p>
                    از ثبت درخواست اولیه تا طراحی، تولید، کنترل کیفیت و تحویل؛
                    شهاب بالن در تمام مراحل سفارش، همراه شماست.
                </p>

                <div class="hero-buttons">
                    <a href="{{ url('/fa/contact') }}" class="btn-primary-custom">
                        ثبت درخواست سفارش
                        <i class="fas fa-arrow-left" aria-hidden="true"></i>
                    </a>

                    <a href="#order-steps" class="btn-outline-custom">
                        مشاهده مراحل سفارش
                    </a>
                </div>
            </div>
        </div>
    </section>


    {{-- Introduction --}}
    <section class="order-intro py-5" aria-labelledby="intro-title">
        <div class="container">
            <div class="section-heading text-center">
                <span>ORDER PROCESS</span>

                <h2 id="intro-title">چگونه سفارش خود را ثبت کنیم؟</h2>

                <p>
                    شرکت شهاب بالن با تکیه بر دانش فنی، تجربه تولید و
                    شناخت نیازهای تخصصی مشتریان، فرآیند سفارش را به صورت
                    مرحله‌ای و شفاف مدیریت می‌کند.
                </p>
            </div>

            <div class="row g-4 mt-4">

                <div class="col-lg-4 col-md-6">
                    <article class="intro-card">
                        <div class="intro-icon" aria-hidden="true">
                            <i class="fas fa-clipboard-list"></i>
                        </div>
                        <h3>بررسی نیاز مشتری</h3>
                        <p>
                            دریافت اطلاعات اولیه و بررسی نوع محصول،
                            کاربرد و نیازهای سفارش.
                        </p>
                    </article>
                </div>

                <div class="col-lg-4 col-md-6">
                    <article class="intro-card">
                        <div class="intro-icon" aria-hidden="true">
                            <i class="fas fa-drafting-compass"></i>
                        </div>
                        <h3>طراحی و برنامه‌ریزی</h3>
                        <p>
                            بررسی مشخصات فنی، انتخاب مواد اولیه و
                            برنامه‌ریزی مراحل تولید.
                        </p>
                    </article>
                </div>

                <div class="col-lg-4 col-md-6">
                    <article class="intro-card">
                        <div class="intro-icon" aria-hidden="true">
                            <i class="fas fa-industry"></i>
                        </div>
                        <h3>تولید و تحویل</h3>
                        <p>
                            اجرای فرآیند تولید، کنترل کیفیت و
                            هماهنگی برای تحویل سفارش.
                        </p>
                    </article>
                </div>

            </div>
        </div>
    </section>


    {{-- Order Steps --}}
    <section class="order-steps-section py-5" id="order-steps" aria-labelledby="steps-title">
        <div class="container">

            <div class="section-heading text-center">
                <span>HOW TO ORDER</span>
                <h2 id="steps-title">مراحل ثبت و اجرای سفارش</h2>
                <p>
                    فرآیند سفارش در شهاب بالن بر اساس نیاز پروژه و
                    مشخصات محصول، در مراحل زیر انجام می‌شود.
                </p>
            </div>

            <ol class="timeline" role="list">

                {{-- Step 1 --}}
                <li class="timeline-item">
                    <div class="timeline-number" aria-hidden="true">01</div>

                    <div class="timeline-content">
                        <span class="step-label">STEP 01</span>
                        <h3>ثبت درخواست و مشاوره اولیه</h3>

                        <p>
                            در نخستین مرحله، مشتری درخواست خود را از طریق
                            راه‌های ارتباطی شرکت ثبت می‌کند. اطلاعات اولیه
                            شامل نوع بالن، کاربرد موردنظر، تعداد تقریبی و
                            نیازهای پروژه بررسی می‌شود.
                        </p>

                        <ul>
                            <li>دریافت درخواست اولیه مشتری</li>
                            <li>بررسی نوع محصول موردنیاز</li>
                            <li>دریافت اطلاعات عمومی پروژه</li>
                            <li>تعیین مسیر بررسی و پیگیری سفارش</li>
                        </ul>
                    </div>
                </li>

                {{-- Step 2 --}}
                <li class="timeline-item">
                    <div class="timeline-number" aria-hidden="true">02</div>

                    <div class="timeline-content">
                        <span class="step-label">STEP 02</span>
                        <h3>بررسی نیازمندی‌ها و مشخصات سفارش</h3>

                        <p>
                            پس از دریافت درخواست، نیازمندی‌های پروژه
                            بررسی می‌شود تا نوع محصول، شرایط تولید،
                            الزامات فنی و محدوده خدمات مشخص شود.
                        </p>

                        <ul>
                            <li>بررسی کاربرد محصول</li>
                            <li>تعیین مشخصات عمومی و فنی</li>
                            <li>بررسی تعداد و شرایط سفارش</li>
                            <li>بررسی الزامات قانونی و استانداردهای مرتبط</li>
                        </ul>
                    </div>
                </li>

                {{-- Step 3 --}}
                <li class="timeline-item">
                    <div class="timeline-number" aria-hidden="true">03</div>

                    <div class="timeline-content">
                        <span class="step-label">STEP 03</span>
                        <h3>ارائه پیشنهاد فنی و تجاری</h3>

                        <p>
                            بر اساس اطلاعات تأییدشده، پیشنهاد فنی و تجاری
                            متناسب با پروژه تهیه می‌شود. در این مرحله،
                            محدوده خدمات، شرایط تولید، زمان‌بندی و
                            شرایط همکاری مشخص خواهد شد.
                        </p>

                        <ul>
                            <li>ارائه مشخصات محصول پیشنهادی</li>
                            <li>اعلام برآورد هزینه سفارش</li>
                            <li>تعیین زمان‌بندی پیشنهادی</li>
                            <li>بررسی شرایط پرداخت و تحویل</li>
                        </ul>
                    </div>
                </li>

                {{-- Step 4 --}}
                <li class="timeline-item">
                    <div class="timeline-number" aria-hidden="true">04</div>

                    <div class="timeline-content">
                        <span class="step-label">STEP 04</span>
                        <h3>تأیید سفارش و عقد قرارداد</h3>

                        <p>
                            پس از توافق طرفین بر مشخصات فنی و شرایط تجاری،
                            سفارش نهایی تأیید شده و جزئیات همکاری در قالب
                            اسناد و توافقات مربوطه ثبت می‌شود.
                        </p>

                        <ul>
                            <li>تأیید مشخصات نهایی سفارش</li>
                            <li>توافق بر شرایط مالی و تجاری</li>
                            <li>تعیین تعهدات طرفین</li>
                            <li>ثبت برنامه اجرایی سفارش</li>
                        </ul>
                    </div>
                </li>

                {{-- Step 5 --}}
                <li class="timeline-item">
                    <div class="timeline-number" aria-hidden="true">05</div>

                    <div class="timeline-content">
                        <span class="step-label">STEP 05</span>
                        <h3>طراحی، تأمین و برنامه‌ریزی تولید</h3>

                        <p>
                            پس از تأیید سفارش، برنامه اجرایی تولید
                            بر اساس مشخصات فنی، امکانات تولیدی و
                            مواد اولیه موردنیاز تنظیم می‌شود.
                        </p>

                        <ul>
                            <li>برنامه‌ریزی تولید</li>
                            <li>آماده‌سازی مواد اولیه</li>
                            <li>بررسی الزامات فنی و اجرایی</li>
                            <li>تعیین برنامه کنترل کیفیت</li>
                        </ul>
                    </div>
                </li>

                {{-- Step 6 --}}
                <li class="timeline-item">
                    <div class="timeline-number" aria-hidden="true">06</div>

                    <div class="timeline-content">
                        <span class="step-label">STEP 06</span>
                        <h3>تولید و کنترل کیفیت</h3>

                        <p>
                            محصول مطابق مشخصات تأییدشده تولید می‌شود.
                            در مراحل مرتبط، کنترل‌های کیفی برای بررسی
                            انطباق محصول با الزامات تعیین‌شده انجام می‌گیرد.
                        </p>

                        <ul>
                            <li>اجرای برنامه تولید</li>
                            <li>بررسی کیفیت مواد و محصول</li>
                            <li>ارزیابی انطباق با مشخصات سفارش</li>
                            <li>ثبت نتایج کنترل کیفیت</li>
                        </ul>
                    </div>
                </li>

                {{-- Step 7 --}}
                <li class="timeline-item">
                    <div class="timeline-number" aria-hidden="true">07</div>

                    <div class="timeline-content">
                        <span class="step-label">STEP 07</span>
                        <h3>بسته‌بندی و تحویل سفارش</h3>

                        <p>
                            پس از تکمیل مراحل تولید و کنترل کیفیت،
                            محصول مطابق توافق انجام‌شده بسته‌بندی شده
                            و برای تحویل به مشتری آماده می‌شود.
                        </p>

                        <ul>
                            <li>آماده‌سازی محصول برای تحویل</li>
                            <li>بسته‌بندی متناسب با نوع محصول</li>
                            <li>هماهنگی شرایط ارسال یا تحویل</li>
                            <li>ارائه مستندات توافق‌شده</li>
                        </ul>
                    </div>
                </li>

            </ol>
        </div>
    </section>


    {{-- Product Categories --}}
    <section class="order-products py-5" aria-labelledby="products-title">
        <div class="container">

            <div class="section-heading text-center">
                <span>OUR PRODUCTS</span>
                <h2 id="products-title">سفارش انواع بالن در شهاب بالن</h2>

                <p>
                    شهاب بالن در حوزه طراحی و تولید انواع بالن با
                    کاربردهای متفاوت فعالیت می‌کند.
                </p>
            </div>

            <div class="row g-4 mt-3">

                <div class="col-lg-4 col-md-6">
                    <article class="product-order-card">
                        <div class="product-order-icon" aria-hidden="true">
                            <i class="fas fa-shield-alt"></i>
                        </div>

                        <h3>بالن‌های نظامی</h3>

                        <p>
                            بررسی و تولید محصولات مرتبط با پروژه‌های
                            تخصصی نظامی مطابق الزامات قانونی و مشخصات
                            فنی تأییدشده.
                        </p>
                    </article>
                </div>

                <div class="col-lg-4 col-md-6">
                    <article class="product-order-card">
                        <div class="product-order-icon" aria-hidden="true">
                            <i class="fas fa-microscope"></i>
                        </div>

                        <h3>بالن‌های پژوهشی</h3>

                        <p>
                            تولید بالن برای کاربردهای تحقیقاتی،
                            آزمایشگاهی و پروژه‌های علمی بر اساس
                            نیازهای تعریف‌شده.
                        </p>
                    </article>
                </div>

                <div class="col-lg-4 col-md-6">
                    <article class="product-order-card">
                        <div class="product-order-icon" aria-hidden="true">
                            <i class="fas fa-bullhorn"></i>
                        </div>

                        <h3>بالن‌های تبلیغاتی</h3>

                        <p>
                            سفارش بالن‌های تبلیغاتی برای معرفی برند،
                            نمایشگاه‌ها، رویدادها و فعالیت‌های
                            بازاریابی.
                        </p>
                    </article>
                </div>

            </div>
        </div>
    </section>


    {{-- Required Information --}}
    <section class="order-information py-5" aria-labelledby="info-title">
        <div class="container">
            <div class="row align-items-center g-5">

                <div class="col-lg-6">
                    <span class="section-label">ORDER INFORMATION</span>

                    <h2 id="info-title">برای ثبت سفارش چه اطلاعاتی لازم است؟</h2>

                    <p>
                        برای بررسی دقیق درخواست و ارائه پیشنهاد مناسب،
                        بهتر است اطلاعات اولیه پروژه در زمان ثبت سفارش
                        در اختیار کارشناسان شرکت قرار گیرد.
                    </p>

                    <ul class="information-list" role="list">

                        <li>
                            <i class="fas fa-check-circle" aria-hidden="true"></i>
                            نوع و کاربرد بالن
                        </li>

                        <li>
                            <i class="fas fa-check-circle" aria-hidden="true"></i>
                            تعداد موردنیاز
                        </li>

                        <li>
                            <i class="fas fa-check-circle" aria-hidden="true"></i>
                            مشخصات فنی و ابعاد موردنظر
                        </li>

                        <li>
                            <i class="fas fa-check-circle" aria-hidden="true"></i>
                            زمان‌بندی مورد انتظار
                        </li>

                        <li>
                            <i class="fas fa-check-circle" aria-hidden="true"></i>
                            محل و شرایط تحویل
                        </li>

                        <li>
                            <i class="fas fa-check-circle" aria-hidden="true"></i>
                            اطلاعات تماس و مشخصات سازمان سفارش‌دهنده
                        </li>

                    </ul>
                </div>

                <div class="col-lg-6">
                    <div class="information-box">

                        <i class="fas fa-file-alt" aria-hidden="true"></i>

                        <h3>درخواست خود را ارسال کنید</h3>

                        <p>
                            اطلاعات اولیه پروژه خود را ارسال کنید تا
                            درخواست شما بررسی و برای ادامه فرآیند
                            سفارش با شما هماهنگی شود.
                        </p>

                        <a href="tel:09191919885" class="btn-primary-custom">
                            ارتباط با کارشناسان
                            <i class="fas fa-arrow-left" aria-hidden="true"></i>
                        </a>

                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- FAQ --}}
    <section class="order-faq py-5" id="faq" aria-labelledby="faq-title">
        <div class="container">

            <div class="section-heading text-center">
                <span>FAQ</span>
                <h2 id="faq-title">سؤالات متداول درباره فرآیند سفارش بالن</h2>
                <p>
                    پاسخ به پرسش‌های رایج مشتریان درباره ثبت درخواست،
                    تولید و تحویل محصولات شهاب بالن.
                </p>
            </div>

            <div class="accordion mt-4" id="orderAccordion">

                <div class="accordion-item">
                    <h3 class="accordion-header">
                        <button class="accordion-button" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq1"
                                aria-expanded="true"
                                aria-controls="faq1">
                            چگونه می‌توانم سفارش تولید بالن ثبت کنم؟
                        </button>
                    </h3>

                    <div id="faq1" class="accordion-collapse collapse show"
                         data-bs-parent="#orderAccordion">
                        <div class="accordion-body">
                            برای ثبت سفارش می‌توانید از طریق صفحه تماس با ما
                            درخواست خود را ارسال کنید. پس از دریافت اطلاعات
                            اولیه، درخواست بررسی و مراحل بعدی به شما اعلام می‌شود.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq2"
                                aria-expanded="false"
                                aria-controls="faq2">
                            مدت زمان تولید و تحویل بالن چقدر است؟
                        </button>
                    </h3>

                    <div id="faq2" class="accordion-collapse collapse"
                         data-bs-parent="#orderAccordion">
                        <div class="accordion-body">
                            زمان تولید به نوع محصول، مشخصات فنی، تعداد سفارش،
                            مواد اولیه و شرایط اجرایی بستگی دارد. زمان‌بندی
                            پس از بررسی درخواست و تأیید مشخصات اعلام می‌شود.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq3"
                                aria-expanded="false"
                                aria-controls="faq3">
                            آیا امکان سفارش بالن تبلیغاتی وجود دارد؟
                        </button>
                    </h3>

                    <div id="faq3" class="accordion-collapse collapse"
                         data-bs-parent="#orderAccordion">
                        <div class="accordion-body">
                            بله، درخواست تولید بالن تبلیغاتی برای نمایشگاه‌ها،
                            رویدادها و معرفی برند قابل بررسی است. مشخصات و
                            امکان‌پذیری تولید بر اساس نیاز مشتری ارزیابی می‌شود.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq4"
                                aria-expanded="false"
                                aria-controls="faq4">
                            آیا قبل از تولید، مشخصات فنی سفارش بررسی می‌شود؟
                        </button>
                    </h3>

                    <div id="faq4" class="accordion-collapse collapse"
                         data-bs-parent="#orderAccordion">
                        <div class="accordion-body">
                            بله، مشخصات فنی و الزامات سفارش پیش از آغاز تولید
                            بررسی شده و مبنای برنامه‌ریزی و اجرای سفارش قرار
                            می‌گیرد.
                        </div>
                    </div>
                </div>

                <div class="accordion-item">
                    <h3 class="accordion-header">
                        <button class="accordion-button collapsed" type="button"
                                data-bs-toggle="collapse"
                                data-bs-target="#faq5"
                                aria-expanded="false"
                                aria-controls="faq5">
                            آیا امکان ثبت سفارش برای مشتریان سازمانی وجود دارد؟
                        </button>
                    </h3>

                    <div id="faq5" class="accordion-collapse collapse"
                         data-bs-parent="#orderAccordion">
                        <div class="accordion-body">
                            بله، درخواست سازمان‌ها، شرکت‌ها و مجموعه‌های
                            پژوهشی بر اساس نوع محصول، مشخصات پروژه و شرایط
                            همکاری قابل بررسی است.
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>


    {{-- CTA --}}
    <section class="order-cta" aria-labelledby="cta-title">
        <div class="container text-center">

            <span>START YOUR ORDER</span>

            <h2 id="cta-title">برای شروع همکاری آماده‌اید؟</h2>

            <p>
                درخواست خود را ثبت کنید تا فرآیند بررسی و پیگیری سفارش
                در شرکت شهاب بالن آغاز شود.
            </p>

            <a href="tel:09191919885" class="btn-light-custom">
                ثبت درخواست و تماس با ما
                <i class="fas fa-arrow-left" aria-hidden="true"></i>
            </a>

        </div>
    </section>


    {{-- SEO Structured Data --}}
    @push('schema')
        @verbatim
            <script type="application/ld+json">
                {
                    "@context": "https://schema.org",
                    "@graph": [
                        {
                            "@type": "Organization",
                            "@id": "{{ url('/#organization') }}",
                            "name": "شهاب بالن",
                            "alternateName": "Shahab Balloon",
                            "url": "{{ url('/') }}",
                            "description": "شرکت شهاب بالن فعال در زمینه طراحی و تولید بالن‌های نظامی، پژوهشی و تبلیغاتی."
                        },
                        {
                            "@type": "WebPage",
                            "@id": "{{ url('/fa/order-process#webpage') }}",
                            "url": "{{ url('/fa/order-process') }}",
                            "name": "فرآیند سفارش بالن | مراحل طراحی و تولید بالن شهاب بالن",
                            "description": "با فرآیند سفارش بالن در شرکت شهاب بالن آشنا شوید. از ثبت درخواست و بررسی نیازمندی‌ها تا طراحی، تولید، کنترل کیفیت و تحویل بالن‌های تبلیغاتی، پژوهشی و نظامی.",
                            "inLanguage": "fa-IR",
                            "isPartOf": {
                                "@id": "{{ url('/#website') }}"
                            },
                            "about": {
                                "@id": "{{ url('/#organization') }}"
                            }
                        },
                        {
                            "@type": "Service",
                            "name": "فرآیند سفارش و تولید بالن",
                            "serviceType": "طراحی و تولید بالن",
                            "provider": {
                                "@id": "{{ url('/#organization') }}"
                            },
                            "description": "بررسی درخواست، ارائه پیشنهاد فنی و تجاری، برنامه‌ریزی تولید، کنترل کیفیت و تحویل محصولات بالن.",
                            "areaServed": {
                                "@type": "Country",
                                "name": "Iran"
                            }
                        },
                        {
                            "@type": "BreadcrumbList",
                            "itemListElement": [
                                {
                                    "@type": "ListItem",
                                    "position": 1,
                                    "name": "صفحه اصلی",
                                    "item": "{{ url('/fa') }}"
                                },
                                {
                                    "@type": "ListItem",
                                    "position": 2,
                                    "name": "فرآیند سفارش",
                                    "item": "{{ url('/fa/order-process') }}"
                                }
                            ]
                        },
                        {
                            "@type": "FAQPage",
                            "mainEntity": [
                                {
                                    "@type": "Question",
                                    "name": "چگونه می‌توانم سفارش تولید بالن ثبت کنم؟",
                                    "acceptedAnswer": {
                                        "@type": "Answer",
                                        "text": "از طریق صفحه تماس با ما درخواست خود را ارسال کنید تا اطلاعات اولیه بررسی و مراحل بعدی اعلام شود."
                                    }
                                },
                                {
                                    "@type": "Question",
                                    "name": "مدت زمان تولید و تحویل بالن چقدر است؟",
                                    "acceptedAnswer": {
                                        "@type": "Answer",
                                        "text": "زمان تولید به نوع محصول، مشخصات فنی، تعداد سفارش و شرایط اجرایی بستگی دارد."
                                    }
                                },
                                {
                                    "@type": "Question",
                                    "name": "آیا امکان سفارش بالن تبلیغاتی وجود دارد؟",
                                    "acceptedAnswer": {
                                        "@type": "Answer",
                                        "text": "درخواست تولید بالن تبلیغاتی برای نمایشگاه‌ها، رویدادها و معرفی برند قابل بررسی است."
                                    }
                                },
                                {
                                    "@type": "Question",
                                    "name": "آیا امکان ثبت سفارش برای مشتریان سازمانی وجود دارد؟",
                                    "acceptedAnswer": {
                                        "@type": "Answer",
                                        "text": "درخواست سازمان‌ها، شرکت‌ها و مجموعه‌های پژوهشی بر اساس مشخصات پروژه قابل بررسی است."
                                    }
                                }
                            ]
                        }
                    ]
                }
            </script>
        @endverbatim
    @endpush

@endsection
