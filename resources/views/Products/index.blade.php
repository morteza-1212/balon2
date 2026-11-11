@extends('layouts.home')

@section('title', 'محصولات بالن | بالن‌های نظامی، پژوهشی و تبلیغاتی شهاب بالن')

@section('meta_description', 'مشاهده و بررسی انواع بالن‌های تولیدی شرکت شهاب بالن شامل بالن‌های نظامی، پژوهشی و تبلیغاتی. با فیلتر دسته‌بندی، محصول مناسب پروژه خود را بیابید.')

@section('meta_keywords', 'محصولات شهاب بالن، بالن نظامی، بالن پژوهشی، بالن تبلیغاتی، خرید بالن، تولید بالن، بالن شهاب')

@section('styles')
    <style>
        /* ---------- Design Tokens ---------- */
        :root {
            --site-primary: #0A1F44;
            --site-primary-dark: #061530;
            --site-primary-light: #14305F;
            --site-primary-soft: #E6EBF3;
            --site-gold: #c69d55;
            --site-gold-dark: #a9813e;
            --site-gold-soft: #f6f0e5;
            --site-text: #68777e;
            --site-heading: #0A1F44;
            --site-border: #edf0f2;
            --site-bg-alt: #f7f8f9;
        }

        /* ---------- Base ---------- */
        .products-hero,
        .products-filter-section,
        .products-grid-section,
        .products-cta {
            direction: rtl;
            text-align: right;
        }

        /* ---------- Hero ---------- */
        .products-hero {
            background:
                /*linear-gradient(110deg, rgba(10, 31, 68, .96), rgba(20, 48, 95, .88)),*/
                url('{{ asset("img/imageheader/productsheader.jpeg") }}') center/cover no-repeat;
            padding: 110px 0 90px;
            color: #fff;
            position: relative;
            overflow: hidden;
        }

        .products-hero::after {
            content: '';
            position: absolute;
            bottom: -1px;
            right: 0;
            left: 0;
            height: 60px;
            background: linear-gradient(to top, var(--site-bg-alt), transparent);
            pointer-events: none;
        }

        .products-hero-content {
            max-width: 780px;
            position: relative;
            z-index: 2;
        }

        .hero-label {
            display: inline-block;
            color: var(--site-gold);
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 15px;
        }

        .products-hero h1 {
            font-size: 46px;
            font-weight: 800;
            margin-bottom: 22px;
            line-height: 1.4;
        }

        .products-hero p {
            font-size: 17px;
            line-height: 2;
            color: #e2e8eb;
            margin-bottom: 0;
        }

        .hero-stats {
            display: flex;
            gap: 40px;
            margin-top: 40px;
            flex-wrap: wrap;
        }

        .hero-stat {
            display: flex;
            flex-direction: column;
        }

        .hero-stat strong {
            font-size: 32px;
            font-weight: 800;
            color: var(--site-gold);
            line-height: 1.2;
        }

        .hero-stat span {
            font-size: 13px;
            color: #c9d2d8;
            margin-top: 6px;
        }

        /* ---------- Filter Section ---------- */
        .products-filter-section {
            background: var(--site-bg-alt);
            padding: 40px 0 0;
        }

        .filter-bar {
            background: #fff;
            border-radius: 14px;
            padding: 22px;
            box-shadow: 0 10px 40px rgba(10, 31, 68, .08);
            display: flex;
            align-items: center;
            gap: 18px;
            flex-wrap: wrap;
            margin-bottom: 40px;
        }

        .filter-label {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            font-weight: 700;
            color: var(--site-primary);
            font-size: 15px;
            padding-left: 18px;
            border-left: 1px solid var(--site-border);
            flex-shrink: 0;
        }

        .filter-label i {
            color: var(--site-gold);
        }

        .filter-buttons {
            display: flex;
            gap: 10px;
            flex-wrap: wrap;
            flex: 1;
        }

        .filter-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 20px;
            background: var(--site-bg-alt);
            border: 1px solid transparent;
            border-radius: 50px;
            color: var(--site-primary);
            font-weight: 600;
            font-size: 14px;
            cursor: pointer;
            transition: all .25s ease;
            font-family: inherit;
        }

        .filter-btn:hover {
            background: var(--site-primary-soft);
            border-color: var(--site-primary-soft);
        }

        .filter-btn.active {
            background: var(--site-primary);
            color: #fff;
            border-color: var(--site-primary);
            box-shadow: 0 6px 20px rgba(10, 31, 68, .25);
        }

        .filter-btn.active i {
            color: var(--site-gold);
        }

        .filter-btn i {
            font-size: 14px;
            color: var(--site-gold-dark);
        }

        .filter-search {
            position: relative;
            margin-right: auto;
            flex-shrink: 0;
        }

        .filter-search input {
            padding: 10px 42px 10px 18px;
            border: 1px solid var(--site-border);
            border-radius: 50px;
            background: var(--site-bg-alt);
            font-size: 14px;
            font-family: inherit;
            color: var(--site-primary);
            width: 240px;
            transition: border-color .25s ease, background .25s ease;
        }

        .filter-search input:focus {
            outline: none;
            border-color: var(--site-gold);
            background: #fff;
        }

        .filter-search i {
            position: absolute;
            right: 16px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--site-text);
            font-size: 14px;
            pointer-events: none;
        }

        /* ---------- Grid Section ---------- */
        .products-grid-section {
            background: var(--site-bg-alt);
            padding: 10px 0 80px;
        }

        .products-count {
            color: var(--site-text);
            font-size: 14px;
            margin-bottom: 22px;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .products-count strong {
            color: var(--site-primary);
        }

        .products-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 28px;
        }

        .product-card {
            background: #fff;
            border-radius: 14px;
            overflow: hidden;
            border: 1px solid var(--site-border);
            transition: transform .35s ease, box-shadow .35s ease;
            display: flex;
            flex-direction: column;
            opacity: 1;
        }

        .product-card.is-hidden {
            display: none;
        }

        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 18px 45px rgba(10, 31, 68, .14);
        }

        .product-image {
            position: relative;
            height: 220px;
            background: var(--site-primary-soft);
            overflow: hidden;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform .5s ease;
        }

        .product-card:hover .product-image img {
            transform: scale(1.06);
        }

        .product-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            padding: 6px 14px;
            border-radius: 50px;
            font-size: 12px;
            font-weight: 700;
            color: #fff;
            backdrop-filter: blur(4px);
            z-index: 2;
        }

        .product-badge.military {
            background: rgba(10, 31, 68, .92);
        }

        .product-badge.research {
            background: rgba(20, 48, 95, .92);
        }

        .product-badge.promotional {
            background: rgba(198, 157, 85, .95);
        }

        .product-body {
            padding: 24px 22px 26px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .product-category {
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 1px;
            color: var(--site-gold-dark);
            margin-bottom: 8px;
        }

        .product-title {
            font-size: 19px;
            font-weight: 800;
            color: var(--site-heading);
            margin-bottom: 12px;
            line-height: 1.5;
        }

        .product-desc {
            color: var(--site-text);
            font-size: 14px;
            line-height: 1.9;
            margin-bottom: 18px;
            flex: 1;
        }

        .product-meta {
            display: flex;
            gap: 14px;
            flex-wrap: wrap;
            margin-bottom: 18px;
            padding-top: 16px;
            border-top: 1px solid var(--site-border);
        }

        .product-meta span {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            font-size: 12.5px;
            color: var(--site-text);
        }

        .product-meta i {
            color: var(--site-gold);
            font-size: 12px;
        }

        .product-actions {
            display: flex;
            gap: 10px;
        }

        .btn-product {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
            padding: 11px 16px;
            border-radius: 8px;
            font-size: 13.5px;
            font-weight: 700;
            text-decoration: none;
            transition: all .25s ease;
            cursor: pointer;
            font-family: inherit;
            border: 1px solid transparent;
        }

        .btn-product-primary {
            background: var(--site-primary);
            color: #fff;
        }

        .btn-product-primary:hover {
            background: var(--site-primary-light);
            color: #fff;
        }

        .btn-product-outline {
            background: transparent;
            color: var(--site-primary);
            border-color: var(--site-primary-soft);
        }

        .btn-product-outline:hover {
            background: var(--site-primary-soft);
            color: var(--site-primary);
        }

        /* ---------- Empty State ---------- */
        .products-empty {
            display: none;
            text-align: center;
            padding: 70px 20px;
            background: #fff;
            border-radius: 14px;
            border: 1px dashed var(--site-border);
        }

        .products-empty.is-visible {
            display: block;
        }

        .products-empty i {
            font-size: 48px;
            color: var(--site-gold);
            margin-bottom: 18px;
        }

        .products-empty h3 {
            color: var(--site-heading);
            font-weight: 800;
            margin-bottom: 12px;
        }

        .products-empty p {
            color: var(--site-text);
            margin-bottom: 0;
        }

        /* ---------- CTA ---------- */
        .products-cta {
            padding: 80px 0;
            background: linear-gradient(110deg, var(--site-primary-dark), var(--site-primary-light));
            color: #fff;
        }

        .products-cta span {
            color: var(--site-gold);
            font-weight: 700;
            letter-spacing: 2px;
            display: inline-block;
            margin-bottom: 12px;
        }

        .products-cta h2 {
            font-size: 34px;
            font-weight: 800;
            margin: 0 0 18px;
            line-height: 1.4;
        }

        .products-cta p {
            color: #d0d9dd;
            line-height: 2;
            margin-bottom: 28px;
            max-width: 640px;
            margin-left: auto;
            margin-right: auto;
        }

        .btn-cta {
            display: inline-flex;
            align-items: center;
            gap: 12px;
            padding: 14px 28px;
            background: var(--site-gold);
            color: #fff;
            border-radius: 8px;
            text-decoration: none;
            font-weight: 700;
            transition: all .3s ease;
        }

        .btn-cta:hover {
            background: #fff;
            color: var(--site-primary);
        }

        /* ---------- Focus ---------- */
        .filter-btn:focus-visible,
        .btn-product:focus-visible,
        .btn-cta:focus-visible,
        .filter-search input:focus-visible {
            outline: 3px solid var(--site-gold);
            outline-offset: 3px;
        }

        /* ---------- Responsive ---------- */
        @media (max-width: 1199.98px) {
            .products-grid {
                grid-template-columns: repeat(3, 1fr);
                gap: 22px;
            }

            .filter-search input {
                width: 200px;
            }
        }

        @media (max-width: 991.98px) {
            .products-hero h1 {
                font-size: 38px;
            }

            .products-grid {
                grid-template-columns: repeat(2, 1fr);
            }

            .filter-search {
                margin-right: 0;
                width: 100%;
            }

            .filter-search input {
                width: 100%;
            }
        }

        @media (max-width: 767.98px) {
            .products-hero {
                padding: 80px 0 70px;
            }

            .products-hero h1 {
                font-size: 30px;
            }

            .products-hero p {
                font-size: 15px;
            }

            .hero-stats {
                gap: 25px;
            }

            .hero-stat strong {
                font-size: 26px;
            }

            .filter-bar {
                padding: 16px;
                gap: 12px;
            }

            .filter-label {
                border-left: none;
                padding-left: 0;
                width: 100%;
                padding-bottom: 10px;
                border-bottom: 1px solid var(--site-border);
            }

            .filter-btn {
                padding: 8px 16px;
                font-size: 13px;
            }

            .products-cta h2 {
                font-size: 26px;
            }
        }

        @media (max-width: 575.98px) {
            .products-hero h1 {
                font-size: 26px;
            }

            .products-grid {
                grid-template-columns: 1fr;
            }

            .product-image {
                height: 200px;
            }

            .filter-btn span {
                display: inline;
            }
        }

        /* ---------- Motion Preference ---------- */
        @media (prefers-reduced-motion: reduce) {
            .product-card,
            .product-image img,
            .filter-btn,
            .btn-product,
            .btn-cta {
                transition: none;
            }

            .product-card:hover {
                transform: none;
            }

            .product-card:hover .product-image img {
                transform: none;
            }
        }
    </style>
@endsection

@section('content')

    {{-- Hero Section --}}
    <section class="products-hero" aria-labelledby="hero-title">
        <div class="container">
            <div class="products-hero-content">
                <span class="hero-label">SHAHAB BALLOON PRODUCTS</span>

                <h1 id="hero-title" style="color: #00bcd4">محصولات شهاب بالن</h1>

                <p>
                    مجموعه‌ای تخصصی از بالن‌های نظامی، پژوهشی و تبلیغاتی؛
                    طراحی و تولیدشده با تکیه بر دانش فنی و استانداردهای کیفیت.
                </p>

                <div class="hero-stats">
                    <div class="hero-stat">
                        <strong>۳</strong>
                        <span>دسته‌بندی تخصصی</span>
                    </div>
                    <div class="hero-stat">
                        <strong>+۱۵</strong>
                        <span>محصول متنوع</span>
                    </div>
                    <div class="hero-stat">
                        <strong>۱۰۰٪</strong>
                        <span>کنترل کیفیت</span>
                    </div>
                </div>
            </div>
        </div>
    </section>


    {{-- Filter Section --}}
    <section class="products-filter-section" aria-labelledby="filter-title">
        <div class="container">
            <div class="filter-bar" role="region" aria-label="فیلتر محصولات">

                <span class="filter-label" id="filter-title">
                    <i class="fas fa-filter" aria-hidden="true"></i>
                    فیلتر دسته‌بندی:
                </span>

                <div class="filter-buttons" role="group" aria-label="انتخاب دسته‌بندی محصول">
                    <button type="button"
                            class="filter-btn active"
                            data-filter="all"
                            aria-pressed="true">
                        <i class="fas fa-th-large" aria-hidden="true"></i>
                        <span>همه محصولات</span>
                    </button>

                    <button type="button"
                            class="filter-btn"
                            data-filter="military"
                            aria-pressed="false">
                        <i class="fas fa-shield-alt" aria-hidden="true"></i>
                        <span>بالن‌های نظامی</span>
                    </button>

                    <button type="button"
                            class="filter-btn"
                            data-filter="research"
                            aria-pressed="false">
                        <i class="fas fa-microscope" aria-hidden="true"></i>
                        <span>بالن‌های پژوهشی</span>
                    </button>

                    <button type="button"
                            class="filter-btn"
                            data-filter="promotional"
                            aria-pressed="false">
                        <i class="fas fa-bullhorn" aria-hidden="true"></i>
                        <span>بالن‌های تبلیغاتی</span>
                    </button>
                </div>

                <div class="filter-search">
                    <label for="productSearch" class="visually-hidden">جستجوی محصول</label>
                    <i class="fas fa-search" aria-hidden="true"></i>
                    <input type="search"
                           id="productSearch"
                           placeholder="جستجوی محصول..."
                           autocomplete="off">
                </div>

            </div>
        </div>
    </section>


    {{-- Products Grid Section --}}
    <section class="products-grid-section" aria-labelledby="products-title">
        <div class="container">

            <h2 id="products-title" class="visually-hidden">لیست محصولات</h2>

            <div class="products-count">
                نمایش
                <strong id="visibleCount">۹</strong>
                محصول از
                <strong>۹</strong>
                محصول
            </div>

            <div class="products-grid" id="productsGrid">

                {{-- ---------- MILITARY ---------- --}}
                <article class="product-card"
                         data-category="military"
                         data-title="بالن شناسایی تاکتیکی">
                    <div class="product-image">
                        <span class="product-badge military">نظامی</span>
                        <img src="{{ asset('assets/img/products/military-1.jpg') }}"
                             alt="بالن شناسایی تاکتیکی نظامی"
                             loading="lazy">
                    </div>
                    <div class="product-body">
                        <span class="product-category">MILITARY BALLOON</span>
                        <h3 class="product-title">بالن شناسایی تاکتیکی</h3>
                        <p class="product-desc">
                            بالن سبک برای پایش و شناسایی میدانی با قابلیت
                            حمل تجهیزات نظارتی سبک و پرواز پایدار.
                        </p>
                        <div class="product-meta">
                            <span><i class="fas fa-ruler-vertical"></i> ارتفاع: ۵ متر</span>
                            <span><i class="fas fa-weight-hanging"></i> ظرفیت: ۱۰ کیلوگرم</span>
                        </div>
                        <div class="product-actions">
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-primary">
                                درخواست سفارش
                                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-outline">
                                مشاوره
                            </a>
                        </div>
                    </div>
                </article>

                <article class="product-card"
                         data-category="military"
                         data-title="بالن مراقبت مرزی">
                    <div class="product-image">
                        <span class="product-badge military">نظامی</span>
                        <img src="{{ asset('assets/img/products/military-2.jpg') }}"
                             alt="بالن مراقبت مرزی نظامی"
                             loading="lazy">
                    </div>
                    <div class="product-body">
                        <span class="product-category">MILITARY BALLOON</span>
                        <h3 class="product-title">بالن مراقبت مرزی</h3>
                        <p class="product-desc">
                            بالن با ارتفاع پرواز بالا برای پایش طولانی‌مدت
                            مرزها و مناطق حساس با تجهیزات تصویربرداری.
                        </p>
                        <div class="product-meta">
                            <span><i class="fas fa-ruler-vertical"></i> ارتفاع: ۸ متر</span>
                            <span><i class="fas fa-weight-hanging"></i> ظرفیت: ۱۵ کیلوگرم</span>
                        </div>
                        <div class="product-actions">
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-primary">
                                درخواست سفارش
                                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-outline">
                                مشاوره
                            </a>
                        </div>
                    </div>
                </article>

                <article class="product-card"
                         data-category="military"
                         data-title="بالن ارتباطات میدانی">
                    <div class="product-image">
                        <span class="product-badge military">نظامی</span>
                        <img src="{{ asset('assets/img/products/military-3.jpg') }}"
                             alt="بالن ارتباطات میدانی نظامی"
                             loading="lazy">
                    </div>
                    <div class="product-body">
                        <span class="product-category">MILITARY BALLOON</span>
                        <h3 class="product-title">بالن ارتباطات میدانی</h3>
                        <p class="product-desc">
                            بالن حامل تجهیزات مخابراتی برای ایجاد ارتباط
                            پایدار در مناطق دورافتاده و عملیات میدانی.
                        </p>
                        <div class="product-meta">
                            <span><i class="fas fa-ruler-vertical"></i> ارتفاع: ۶ متر</span>
                            <span><i class="fas fa-weight-hanging"></i> ظرفیت: ۱۲ کیلوگرم</span>
                        </div>
                        <div class="product-actions">
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-primary">
                                درخواست سفارش
                                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-outline">
                                مشاوره
                            </a>
                        </div>
                    </div>
                </article>

                {{-- ---------- RESEARCH ---------- --}}
                <article class="product-card"
                         data-category="research"
                         data-title="بالن تحقیقات جوی">
                    <div class="product-image">
                        <span class="product-badge research">پژوهشی</span>
                        <img src="{{ asset('assets/img/products/research-1.jpg') }}"
                             alt="بالن تحقیقات جوی پژوهشی"
                             loading="lazy">
                    </div>
                    <div class="product-body">
                        <span class="product-category">RESEARCH BALLOON</span>
                        <h3 class="product-title">بالن تحقیقات جوی</h3>
                        <p class="product-desc">
                            بالن برای نمونه‌برداری و اندازه‌گیری پارامترهای
                            جوی در ارتفاع‌های مختلف با تجهیزات علمی.
                        </p>
                        <div class="product-meta">
                            <span><i class="fas fa-ruler-vertical"></i> ارتفاع: ۱۰ متر</span>
                            <span><i class="fas fa-flask"></i> تجهیزات علمی</span>
                        </div>
                        <div class="product-actions">
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-primary">
                                درخواست سفارش
                                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-outline">
                                مشاوره
                            </a>
                        </div>
                    </div>
                </article>

                <article class="product-card"
                         data-category="research"
                         data-title="بالن آزمایشگاهی">
                    <div class="product-image">
                        <span class="product-badge research">پژوهشی</span>
                        <img src="{{ asset('assets/img/products/research-2.jpg') }}"
                             alt="بالن آزمایشگاهی پژوهشی"
                             loading="lazy">
                    </div>
                    <div class="product-body">
                        <span class="product-category">RESEARCH BALLOON</span>
                        <h3 class="product-title">بالن آزمایشگاهی</h3>
                        <p class="product-desc">
                            بالن مناسب برای آزمایش‌های کنترل‌شده در
                            محیط‌های بسته و مطالعه رفتار سیالات.
                        </p>
                        <div class="product-meta">
                            <span><i class="fas fa-ruler-vertical"></i> ارتفاع: ۴ متر</span>
                            <span><i class="fas fa-flask"></i> محیط آزمایشگاهی</span>
                        </div>
                        <div class="product-actions">
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-primary">
                                درخواست سفارش
                                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-outline">
                                مشاوره
                            </a>
                        </div>
                    </div>
                </article>

                <article class="product-card"
                         data-category="research"
                         data-title="بالن پروژه‌های علمی">
                    <div class="product-image">
                        <span class="product-badge research">پژوهشی</span>
                        <img src="{{ asset('assets/img/products/research-3.jpg') }}"
                             alt="بالن پروژه‌های علمی پژوهشی"
                             loading="lazy">
                    </div>
                    <div class="product-body">
                        <span class="product-category">RESEARCH BALLOON</span>
                        <h3 class="product-title">بالن پروژه‌های علمی</h3>
                        <p class="product-desc">
                            بالن سفارشی برای پروژه‌های دانشگاهی و
                            تحقیقاتی با قابلیت شخصی‌سازی ابعاد و تجهیزات.
                        </p>
                        <div class="product-meta">
                            <span><i class="fas fa-ruler-vertical"></i> ابعاد: سفارشی</span>
                            <span><i class="fas fa-cog"></i> شخصی‌سازی</span>
                        </div>
                        <div class="product-actions">
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-primary">
                                درخواست سفارش
                                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-outline">
                                مشاوره
                            </a>
                        </div>
                    </div>
                </article>

                {{-- ---------- PROMOTIONAL ---------- --}}
                <article class="product-card"
                         data-category="promotional"
                         data-title="بالن تبلیغاتی نمایشگاهی">
                    <div class="product-image">
                        <span class="product-badge promotional">تبلیغاتی</span>
                        <img src="{{ asset('assets/img/products/promo-1.jpg') }}"
                             alt="بالن تبلیغاتی نمایشگاهی"
                             loading="lazy">
                    </div>
                    <div class="product-body">
                        <span class="product-category">PROMOTIONAL BALLOON</span>
                        <h3 class="product-title">بالن تبلیغاتی نمایشگاهی</h3>
                        <p class="product-desc">
                            بالن با قابلیت چاپ لوگو و طرح برند برای
                            نمایشگاه‌ها و رویدادهای تجاری.
                        </p>
                        <div class="product-meta">
                            <span><i class="fas fa-palette"></i> چاپ اختصاصی</span>
                            <span><i class="fas fa-ruler-vertical"></i> ارتفاع: ۳ متر</span>
                        </div>
                        <div class="product-actions">
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-primary">
                                درخواست سفارش
                                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-outline">
                                مشاوره
                            </a>
                        </div>
                    </div>
                </article>

                <article class="product-card"
                         data-category="promotional"
                         data-title="بالن معرفی برند">
                    <div class="product-image">
                        <span class="product-badge promotional">تبلیغاتی</span>
                        <img src="{{ asset('assets/img/products/promo-2.jpg') }}"
                             alt="بالن معرفی برند تبلیغاتی"
                             loading="lazy">
                    </div>
                    <div class="product-body">
                        <span class="product-category">PROMOTIONAL BALLOON</span>
                        <h3 class="product-title">بالن معرفی برند</h3>
                        <p class="product-desc">
                            بالن بزرگ با طراحی اختصاصی برای معرفی برند
                            در فضاهای باز و رویدادهای تبلیغاتی.
                        </p>
                        <div class="product-meta">
                            <span><i class="fas fa-palette"></i> طراحی اختصاصی</span>
                            <span><i class="fas fa-ruler-vertical"></i> ارتفاع: ۵ متر</span>
                        </div>
                        <div class="product-actions">
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-primary">
                                درخواست سفارش
                                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-outline">
                                مشاوره
                            </a>
                        </div>
                    </div>
                </article>

                <article class="product-card"
                         data-category="promotional"
                         data-title="بالن رویدادهای ویژه">
                    <div class="product-image">
                        <span class="product-badge promotional">تبلیغاتی</span>
                        <img src="{{ asset('assets/img/products/promo-3.jpg') }}"
                             alt="بالن رویدادهای ویژه تبلیغاتی"
                             loading="lazy">
                    </div>
                    <div class="product-body">
                        <span class="product-category">PROMOTIONAL BALLOON</span>
                        <h3 class="product-title">بالن رویدادهای ویژه</h3>
                        <p class="product-desc">
                            بالن مناسب جشنواره‌ها، افتتاحیه‌ها و
                            رویدادهای ویژه با قابلیت شخصی‌سازی کامل.
                        </p>
                        <div class="product-meta">
                            <span><i class="fas fa-star"></i> طراحی ویژه</span>
                            <span><i class="fas fa-ruler-vertical"></i> ابعاد: سفارشی</span>
                        </div>
                        <div class="product-actions">
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-primary">
                                درخواست سفارش
                                <i class="fas fa-arrow-left" aria-hidden="true"></i>
                            </a>
                            <a href="{{ url('/fa/contact') }}" class="btn-product btn-product-outline">
                                مشاوره
                            </a>
                        </div>
                    </div>
                </article>

            </div>

            {{-- Empty State --}}
            <div class="products-empty" id="productsEmpty" role="status" aria-live="polite">
                <i class="fas fa-search" aria-hidden="true"></i>
                <h3>محصولی یافت نشد</h3>
                <p>لطفاً فیلتر یا عبارت جستجو را تغییر دهید.</p>
            </div>

        </div>
    </section>


    {{-- CTA --}}
    <section class="products-cta" aria-labelledby="cta-title">
        <div class="container text-center">
            <span>NEED A CUSTOM PRODUCT?</span>

            <h2 id="cta-title">محصول سفارشی نیاز دارید؟</h2>

            <p>
                اگر محصولی متناسب با نیاز پروژه خود پیدا نکردید،
                کارشناسان شهاب بالن آماده بررسی درخواست سفارشی شما هستند.
            </p>

            <a href="tel:09191919885" class="btn-cta">
                ارتباط با کارشناسان
                <i class="fas fa-phone-alt" aria-hidden="true"></i>
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
                    "@type": "CollectionPage",
                    "@id": "{{ url('/fa/products#webpage') }}",
                    "url": "{{ url('/fa/products') }}",
                    "name": "محصولات بالن | بالن‌های نظامی، پژوهشی و تبلیغاتی شهاب بالن",
                    "description": "مشاهده و بررسی انواع بالن‌های تولیدی شرکت شهاب بالن شامل بالن‌های نظامی، پژوهشی و تبلیغاتی.",
                    "inLanguage": "fa-IR",
                    "isPartOf": { "@id": "{{ url('/#website') }}" },
                    "about": { "@id": "{{ url('/#organization') }}" }
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
                            "name": "محصولات",
                            "item": "{{ url('/fa/products') }}"
                        }
                    ]
                },
                {
                    "@type": "ItemList",
                    "name": "دسته‌بندی محصولات شهاب بالن",
                    "itemListElement": [
                        {
                            "@type": "ListItem",
                            "position": 1,
                            "name": "بالن‌های نظامی",
                            "url": "{{ url('/fa/products#military') }}"
                        },
                        {
                            "@type": "ListItem",
                            "position": 2,
                            "name": "بالن‌های پژوهشی",
                            "url": "{{ url('/fa/products#research') }}"
                        },
                        {
                            "@type": "ListItem",
                            "position": 3,
                            "name": "بالن‌های تبلیغاتی",
                            "url": "{{ url('/fa/products#promotional') }}"
                        }
                    ]
                }
            ]
        }
            </script>
        @endverbatim
    @endpush

    {{-- JavaScript برای فیلتر تعاملی --}}
    @push('scripts')
        <script>
            (function () {
                'use strict';

                const filterButtons = document.querySelectorAll('.filter-btn');
                const productCards  = document.querySelectorAll('.product-card');
                const searchInput   = document.getElementById('productSearch');
                const visibleCount  = document.getElementById('visibleCount');
                const emptyState    = document.getElementById('productsEmpty');

                let activeFilter = 'all';
                let searchTerm   = '';

                function normalize(str) {
                    return (str || '')
                        .toLowerCase()
                        .replace(/[يى]/g, 'ی')
                        .replace(/[ك]/g, 'ک')
                        .replace(/[\u064B-\u065F\u0670]/g, '')
                        .trim();
                }

                function applyFilters() {
                    let shown = 0;
                    const term = normalize(searchTerm);

                    productCards.forEach(card => {
                        const category = card.dataset.category;
                        const title    = normalize(card.dataset.title);
                        const content  = normalize(card.textContent);

                        const matchCategory = (activeFilter === 'all' || category === activeFilter);
                        const matchSearch   = (!term || title.includes(term) || content.includes(term));

                        if (matchCategory && matchSearch) {
                            card.classList.remove('is-hidden');
                            shown++;
                        } else {
                            card.classList.add('is-hidden');
                        }
                    });

                    if (visibleCount) {
                        visibleCount.textContent = shown.toLocaleString('fa-IR');
                    }

                    if (emptyState) {
                        emptyState.classList.toggle('is-visible', shown === 0);
                    }
                }

                filterButtons.forEach(btn => {
                    btn.addEventListener('click', () => {
                        filterButtons.forEach(b => {
                            b.classList.remove('active');
                            b.setAttribute('aria-pressed', 'false');
                        });

                        btn.classList.add('active');
                        btn.setAttribute('aria-pressed', 'true');

                        activeFilter = btn.dataset.filter;
                        applyFilters();
                    });
                });

                if (searchInput) {
                    let debounceTimer;
                    searchInput.addEventListener('input', (e) => {
                        clearTimeout(debounceTimer);
                        debounceTimer = setTimeout(() => {
                            searchTerm = e.target.value;
                            applyFilters();
                        }, 180);
                    });
                }

                // مقدار اولیه
                applyFilters();
            })();
        </script>
    @endpush

@endsection
