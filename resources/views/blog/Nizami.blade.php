@extends('layouts.home')

@php
    $locale = app()->getLocale();
    $isRtl  = in_array($locale, ['fa', 'ar'], true);
@endphp

@section('title', __('nizami.meta.title'))

@section('meta')
    <meta name="description" content="{{ __('nizami.meta.description') }}">
    <meta name="keywords" content="{{ __('nizami.meta.keywords') }}">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ url($locale . '/nizami') }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="{{ __('nizami.header.title') }}">
    <meta property="og:description" content="{{ __('nizami.header.subtitle') }}">
    <meta property="og:url" content="{{ url($locale . '/nizami') }}">
    <meta property="og:locale" content="{{ $locale === 'fa' ? 'fa_IR' : ($locale === 'ar' ? 'ar_SA' : 'en_US') }}">
    <meta property="og:site_name" content="شهاب بالن">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ __('nizami.header.title') }}">
    <meta name="twitter:description" content="{{ __('nizami.header.subtitle') }}">
@endsection
@section('styles')
    <style>
        /* =========================================================
           VARIABLES
        ========================================================= */
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

            /* ارتفاع navbar + 10px — با navbar خود تنظیم کنید */
            --sticky-top: 90px;
        }

        * { box-sizing: border-box; }

        .article-page {
            direction: ltr;
            text-align: left;
            color: var(--text-dark);
            line-height: 2.1;
            background: var(--bg);
            font-family: 'Vazirmatn', 'IRANSans', Tahoma, sans-serif;
            /* ⚠ هیچ overflow روی این نباشد */
            overflow: visible;
        }

        .article-page[data-rtl="true"] .article-content {
            direction: rtl;
            text-align: right;
        }

        /* =========================================================
           READING PROGRESS
        ========================================================= */
        .reading-progress {
            position: fixed;
            top: 0;
            left: 0;
            height: 4px;
            width: 0%;
            background: linear-gradient(90deg, var(--gold-500), var(--cyan-400), var(--gold-500));
            background-size: 200% 100%;
            animation: progressShine 3s linear infinite;
            z-index: 9999;
            transition: width 0.15s ease-out;
            box-shadow: 0 0 12px rgba(212, 175, 55, 0.6);
        }

        @keyframes progressShine {
            0%   { background-position: 0% 50%; }
            100% { background-position: 200% 50%; }
        }

        /* =========================================================
           HERO HEADER
        ========================================================= */
        .article-header {
            position: relative;
            background: var(--navy-900);
            color: #fff;
            padding: 100px 20px;
            overflow: hidden;
            isolation: isolate;
            direction: ltr;
        }

        .article-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 65%;
            background-image: url('{{ asset('img/header/nezami2.jpeg') }}');
            background-size: cover;
            background-position: center;
            z-index: -2;
            mask-image: linear-gradient(to left, black 50%, transparent 100%);
            -webkit-mask-image: linear-gradient(to left, black 50%, transparent 100%);
        }

        .article-header::after {
            content: '';
            position: absolute;
            inset: 0;
            background: linear-gradient(90deg, var(--navy-900) 35%, rgba(10,31,68,0.7) 60%, transparent 100%);
            z-index: -1;
        }

        .article-header .container {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            width: 100%;
        }

        .header-text {
            max-width: 620px;
            width: 100%;
            text-align: left;
            margin-right: auto;
            margin-left: 0;
            direction: ltr;
        }

        .article-header[data-rtl="true"] .header-text {
            direction: rtl;
            text-align: right;
        }

        .article-header[data-rtl="true"] .article-meta {
            justify-content: flex-start;
        }

        .article-header .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, rgba(212,175,55,0.95), rgba(229,193,88,0.95));
            color: var(--navy-900);
            padding: 9px 22px;
            border-radius: 40px;
            font-size: 13px;
            font-weight: 800;
            box-shadow: 0 6px 24px rgba(212,175,55,0.45);
            animation: badgePulse 3s ease-in-out infinite;
            margin-bottom: 10px;
        }

        .article-header .badge::before { content: '✦'; font-size: 14px; }

        @keyframes badgePulse {
            0%, 100% { transform: scale(1); }
            50%      { transform: scale(1.04); }
        }

        .article-header h1 {
            font-size: clamp(28px, 3.5vw, 48px);
            font-weight: 900;
            line-height: 1.6;
            margin: 20px 0;
            background: linear-gradient(180deg, #ffffff 0%, #c8d6e5 60%, var(--gold-300) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }

        .article-header .subtitle {
            color: #C5D3E3;
            font-size: 16px;
            line-height: 2;
            margin-bottom: 30px;
        }

        .article-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-start;
        }

        .article-meta span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255,255,255,0.1);
            border: 1px solid rgba(255,255,255,0.2);
            color: #D5E1EE;
            padding: 9px 18px;
            border-radius: 40px;
            font-size: 13px;
            transition: all 0.3s ease;
        }

        .article-meta span i { color: var(--gold-400); }

        .article-meta span:hover {
            background: rgba(212,175,55,0.2);
            border-color: rgba(212,175,55,0.6);
            transform: translateY(-3px);
            color: #fff;
        }

        /* =========================================================
           MAIN LAYOUT — تصویر چپ ۳۰٪ و متن راست ۷۰٪
           ستون تصویر به ارتفاع ستون متن کشیده می‌شود تا sticky
           در تمام طول مقاله امکان حرکت و چسبیدن داشته باشد.
        ========================================================= */
        .article-layout {
            width: 100%;
            max-width: 1400px;
            margin: 0 auto;
            padding: 70px 20px 90px;
            display: grid;
            grid-template-columns: minmax(0, 3fr) minmax(0, 7fr);
            gap: 50px;
            align-items: stretch;
            overflow: visible;
        }

        /* ستون تصویر: حتماً هم‌ارتفاع ستون متن باشد */
        .article-side {
            grid-column: 1;
            grid-row: 1;
            align-self: stretch;
            min-width: 0;
            width: 100%;
            position: relative;
            overflow: visible;
        }

        /* خود تصویر در محدوده ستون بلند مقاله sticky می‌ماند */
        .article-sticky {
            position: -webkit-sticky;
            position: sticky;
            top: var(--sticky-top);
            width: 100%;
            z-index: 20;

        }

        .article-content {
            grid-column: 2;
            grid-row: 1;
            min-width: 0;
            position: relative;
            z-index: 1;
        }

        /* =========================================================
           IMAGE CARD
        ========================================================= */
        .article-image-card {
            position: relative;
            border-radius: var(--radius);
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            background: var(--navy-900);
            border: 1px solid var(--border);
        }

        .article-image-card img {
            display: block;
            width: 100%;
            height: auto;
            object-fit: cover;
            transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .article-image-card:hover img {
            transform: scale(1.05);
        }

        .article-image-caption {
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            padding: 20px 18px;
            background: linear-gradient(0deg, rgba(6,21,48,0.95) 0%, rgba(6,21,48,0.6) 60%, transparent 100%);
            color: #fff;
            z-index: 2;
            pointer-events: none;
        }

        .article-image-caption h4 {
            margin: 0 0 6px;
            font-size: 15px;
            font-weight: 800;
            color: var(--gold-300);
        }

        .article-image-caption p {
            margin: 0;
            font-size: 12.5px;
            line-height: 1.8;
            color: #C5D3E3;
        }

        .article-image-badge {
            position: absolute;
            top: 14px;
            right: 14px;
            background: rgba(212,175,55,0.95);
            color: var(--navy-900);
            padding: 6px 14px;
            border-radius: 30px;
            font-size: 11px;
            font-weight: 800;
            backdrop-filter: blur(8px);
            z-index: 2;
            pointer-events: none;
        }

        /* =========================================================
           CONTENT TYPOGRAPHY
        ========================================================= */
        .article-content h2 {
            display: flex;
            align-items: center;
            gap: 12px;
            color: var(--navy-800);
            font-size: 26px;
            font-weight: 900;
            margin: 64px 0 24px;
            line-height: 1.7;
        }

        .article-content h2::before {
            content: '';
            flex-shrink: 0;
            width: 8px;
            height: 36px;
            background: linear-gradient(180deg, var(--gold-500), var(--cyan-400));
            border-radius: 8px;
            box-shadow: 0 4px 14px rgba(212,175,55,0.4);
        }

        .article-content h3 {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--navy-700);
            font-size: 19px;
            font-weight: 800;
            margin: 36px 0 14px;
        }

        .article-content h3::before {
            content: '◆';
            color: var(--gold-500);
            font-size: 14px;
            transition: transform 0.3s ease;
        }

        .article-content h3:hover::before { transform: rotate(45deg) scale(1.2); }

        .article-content p {
            font-size: 15.5px;
            line-height: 2.35;
            color: var(--text-mid);
            margin-bottom: 20px;
            text-align: justify;
        }

        .article-page[data-rtl="true"] .article-content ul {
            padding-right: 0;
            padding-left: 0;
        }

        .article-page[data-rtl="true"] .article-content ul li {
            padding: 14px 52px 14px 18px;
        }

        .article-page[data-rtl="true"] .article-content ul li::before {
            right: 18px;
            left: auto;
        }

        .article-content ul {
            padding-left: 0;
            list-style: none;
            margin-bottom: 28px;
        }

        .article-content ul li {
            position: relative;
            padding: 14px 18px 14px 52px;
            margin-bottom: 12px;
            color: var(--text-mid);
            line-height: 2;
            font-size: 15px;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius-sm);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            box-shadow: var(--shadow-sm);
        }

        .article-content ul li::before {
            content: '◆';
            position: absolute;
            left: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gold-500);
            font-size: 12px;
            transition: all 0.35s ease;
        }

        .article-content ul li:hover {
            transform: translateX(6px);
            border-color: var(--gold-400);
            box-shadow: var(--shadow-md);
        }

        .article-page[data-rtl="true"] .article-content ul li:hover {
            transform: translateX(-6px);
        }

        .article-content ul li strong { color: var(--navy-700); font-weight: 800; }

        /* =========================================================
           QUICK ANSWER
        ========================================================= */
        .quick-answer {
            background: linear-gradient(135deg, #EEF4FF 0%, #F7FAFF 100%);
            border: 1px solid #C9D9F0;
            border-left: 6px solid var(--navy-700);
            border-radius: var(--radius);
            padding: 32px 34px;
            margin: 0 0 44px;
            box-shadow: var(--shadow-md);
        }

        .article-page[data-rtl="true"] .quick-answer {
            border-left: 1px solid #C9D9F0;
            border-right: 6px solid var(--navy-700);
        }

        .quick-answer h2 { border: none; margin: 0 0 14px; font-size: 21px; }
        .quick-answer h2::before { content: '💡'; font-size: 24px; }
        .quick-answer p { margin: 0; font-size: 15px; color: var(--navy-800); line-height: 2.2; font-weight: 500; }

        /* =========================================================
           TOC
        ========================================================= */
        .toc-box {
            position: relative;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 30px 34px;
            margin: 0 0 44px;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .toc-box::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--gold-500), var(--cyan-400), var(--gold-500));
            background-size: 200% 100%;
            animation: progressShine 4s linear infinite;
        }

        .toc-box h2 { font-size: 20px; margin: 0 0 20px; }
        .toc-box h2::before { content: '📑'; font-size: 22px; }

        .toc-box ul {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 10px 20px;
            margin: 0;
            padding: 0;
            list-style: none;
        }

        .toc-box a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: var(--navy-700);
            text-decoration: none;
            font-size: 14.5px;
            font-weight: 600;
            padding: 12px 16px;
            border-radius: var(--radius-sm);
            background: var(--surface-2);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
            border: 1px solid transparent;
        }

        .toc-box a::before {
            content: '←';
            color: var(--gold-500);
            font-weight: 800;
            transition: transform 0.35s ease;
            flex-shrink: 0;
        }

        .article-page[data-rtl="true"] .toc-box a::before { content: '→'; }

        .toc-box a:hover {
            background: var(--navy-700);
            color: #fff;
            border-color: var(--navy-700);
            transform: translateX(6px);
            box-shadow: 0 8px 20px rgba(10,31,68,0.25);
        }

        .article-page[data-rtl="true"] .toc-box a:hover {
            transform: translateX(-6px);
        }

        /* =========================================================
           TABLE
        ========================================================= */
        .article-table-wrapper {
            margin: 34px 0;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            background: var(--surface);
            overflow: hidden;
        }

        .article-table { width: 100%; border-collapse: collapse; }

        .article-table th,
        .article-table td {
            padding: 18px 20px;
            text-align: left;
            font-size: 14.5px;
            border-bottom: 1px solid var(--border);
        }

        .article-page[data-rtl="true"] .article-table th,
        .article-page[data-rtl="true"] .article-table td {
            text-align: right;
        }

        .article-table th {
            background: linear-gradient(135deg, var(--navy-800), var(--navy-600));
            color: #fff;
            font-weight: 800;
            font-size: 14px;
            border: none;
        }

        .article-table tbody tr:nth-child(even) { background: #FAFCFF; }
        .article-table tbody tr:hover { background: linear-gradient(90deg, #EEF4FF 0%, #FFF9E8 100%); }
        .article-table tbody tr:last-child td { border-bottom: none; }
        .article-table td:first-child { font-weight: 800; color: var(--navy-800); }

        /* =========================================================
           CTA
        ========================================================= */
        .article-cta {
            background: linear-gradient(135deg, var(--navy-900) 0%, var(--navy-800) 50%, var(--navy-700) 100%);
            padding: 52px 38px;
            border-radius: var(--radius);
            text-align: center;
            color: #fff;
            margin: 76px 0;
            box-shadow: var(--shadow-lg);
        }

        .article-cta h2 {
            justify-content: center;
            color: #fff;
            border: none;
            padding: 0;
            margin: 0 0 16px;
            font-size: 25px;
        }

        .article-cta h2::before { display: none; }

        .article-cta p {
            color: #C5D3E3;
            text-align: center;
            font-size: 15px;
            line-height: 2;
            max-width: 640px;
            margin: 0 auto 26px;
        }

        .article-cta a {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background: linear-gradient(135deg, var(--gold-500), var(--gold-400));
            color: var(--navy-900);
            text-decoration: none;
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 900;
            font-size: 15px;
            box-shadow: 0 10px 30px rgba(212,175,55,0.5);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .article-cta a:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 18px 40px rgba(212,175,55,0.65);
        }

        /* =========================================================
           FAQ
        ========================================================= */
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
            padding: 20px 26px;
            font-size: 17px;
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
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            line-height: 1;
        }

        .faq-item[open] summary::before {
            content: '−';
            background: linear-gradient(135deg, var(--navy-700), var(--navy-600));
            color: #fff;
            transform: rotate(180deg);
        }

        .faq-item .faq-body {
            padding: 0 26px 22px 76px;
            color: var(--text-mid);
            font-size: 14.5px;
            line-height: 2.2;
        }

        .article-page[data-rtl="true"] .faq-item .faq-body {
            padding: 0 76px 22px 26px;
        }

        /* =========================================================
           TAGS
        ========================================================= */
        .article-tags {
            border-top: 1px dashed var(--border);
            padding-top: 32px;
            margin-top: 54px;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            gap: 8px;
        }

        .article-tags strong {
            color: var(--navy-800);
            font-size: 14px;
            margin-right: 6px;
        }

        .article-page[data-rtl="true"] .article-tags strong {
            margin-right: 0;
            margin-left: 6px;
        }

        .article-tags span {
            display: inline-block;
            background: var(--surface-2);
            color: var(--navy-700);
            padding: 7px 18px;
            border-radius: 30px;
            font-size: 12.5px;
            font-weight: 600;
            border: 1px solid var(--border);
            transition: all 0.3s ease;
        }

        .article-tags span:hover {
            background: var(--navy-700);
            color: #fff;
            border-color: var(--navy-700);
            transform: translateY(-3px);
        }

        /* =========================================================
           REVEAL
        ========================================================= */
        .reveal {
            opacity: 0;
            transform: translateY(34px);
            transition: opacity 0.75s ease, transform 0.75s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* =========================================================
           RESPONSIVE — در موبایل sticky غیرفعال
        ========================================================= */
        @media (max-width: 1100px) {
            .article-layout {
                grid-template-columns: minmax(0, 1fr);
                gap: 30px;
                padding: 50px 20px 70px;
                align-items: start;
            }

            .article-side {
                grid-column: 1;
                grid-row: 1;
                align-self: start;
                width: 100%;
            }

            .article-sticky {
                position: static;
                top: auto;
            }

            .article-content {
                grid-column: 1;
                grid-row: 2;
            }

            .article-header::before {
                width: 100%;
                mask-image: none;
                -webkit-mask-image: none;
                opacity: 0.35;
            }

            .header-text {
                text-align: center;
                margin: 0 auto;
            }

            .article-meta { justify-content: center; }
        }

        @media (max-width: 768px) {
            .article-header { padding: 80px 16px; }
            .article-layout { padding: 40px 16px 60px; }
            .article-content h2 { font-size: 20px; }
            .article-content h2::before { height: 28px; width: 6px; }
            .article-content h3 { font-size: 17px; }
            .article-content p { font-size: 14.5px; }
            .quick-answer, .toc-box { padding: 24px 20px; }
            .toc-box ul { grid-template-columns: 1fr; }

            .article-table,
            .article-table thead,
            .article-table tbody,
            .article-table th,
            .article-table td,
            .article-table tr { display: block; }

            .article-table thead tr {
                position: absolute;
                top: -9999px;
                left: -9999px;
            }

            .article-table tr {
                border: 1px solid var(--border);
                border-radius: var(--radius-sm);
                margin-bottom: 16px;
                background: var(--surface) !important;
                box-shadow: var(--shadow-sm);
                overflow: hidden;
            }

            .article-table td {
                border: none;
                border-bottom: 1px solid var(--border);
                position: relative;
                padding-left: 45% !important;
                min-height: 50px;
                display: flex;
                align-items: center;
            }

            .article-page[data-rtl="true"] .article-table td {
                padding-left: 20px !important;
                padding-right: 45% !important;
            }

            .article-table td:last-child { border-bottom: none; }

            .article-table td::before {
                position: absolute;
                top: 0;
                left: 0;
                width: 40%;
                padding: 18px 20px;
                white-space: nowrap;
                font-weight: 800;
                color: var(--navy-700);
                content: attr(data-label);
                height: 100%;
                display: flex;
                align-items: center;
                background: var(--surface-2);
                border-right: 1px solid var(--border);
            }

            .article-page[data-rtl="true"] .article-table td::before {
                left: auto;
                right: 0;
                border-right: none;
                border-left: 1px solid var(--border);
            }

            .article-cta { padding: 36px 22px; margin: 56px 0; }
            .article-cta h2 { font-size: 20px; }
            .faq-item summary { padding: 16px 18px; font-size: 15.5px; }
            .faq-item .faq-body { padding: 0 18px 18px; }
        }

        @media (max-width: 480px) {
            .article-header h1 { font-size: 22px; }
            .article-header .subtitle { font-size: 14px; }
            .article-content h2 { font-size: 18.5px; }
            .article-content h3 { font-size: 16px; }
            .article-meta span { font-size: 11px; padding: 6px 12px; }
        }
        main {
            width: 100%;
            min-height: 300px;
            overflow: visible;   /* ← تغییر از hidden به visible */
        }

    </style>


@endsection

@section('content')




    <div class="reading-progress" id="readingProgress"></div>

    <div class="article-page" data-rtl="{{ $isRtl ? 'true' : 'false' }}">

        <header class="article-header" data-rtl="{{ $isRtl ? 'true' : 'false' }}">
            <div class="container">
                <div class="header-text">
                    <span class="badge">{{ __('nizami.header.badge') }}</span>
                    <h1>{{ __('nizami.header.title') }}</h1>
                    <p class="subtitle">{{ __('nizami.header.subtitle') }}</p>
                    <div class="article-meta">
                        <span><i class="far fa-calendar-alt"></i> {{ __('nizami.header.updated') }}</span>
                        <span><i class="far fa-clock"></i> {{ __('nizami.header.read_time') }}</span>
                        <span><i class="far fa-folder"></i> {{ __('nizami.header.category') }}</span>
                    </div>
                </div>
            </div>
        </header>

        <div class="article-layout">

            {{-- ستون تصویر: .article-side > .article-sticky > .article-image-card --}}
            <aside class="article-side" aria-label="{{ __('nizami.header.category') }}">
                <div class="article-sticky" >
                    <div class="article-image-card">
                        <span class="article-image-badge">{{ __('nizami.header.badge') }}</span>
                        <img
                            src="{{ asset('img/header/nezami2.jpeg') }}"
                            alt="{{ __('nizami.header.title') }}"
                            loading="lazy"
                            decoding="async"
                            width="800"
                            height="1000"

                        >
                        <div class="article-image-caption">
                            <h4>{{ __('nizami.header.category') }}</h4>
                            <p>{{ __('nizami.header.subtitle') }}</p>
                        </div>
                    </div>
                </div>
            </aside>

            {{-- متن مقاله --}}
            <article class="article-content" itemscope itemtype="https://schema.org/Article">
                <meta itemprop="headline" content="{{ __('nizami.header.title') }}">
                <meta itemprop="inLanguage" content="{{ $locale === 'fa' ? 'fa-IR' : ($locale === 'ar' ? 'ar-SA' : 'en-US') }}">

                <section class="quick-answer reveal">
                    <h2>{{ __('nizami.quick.title') }}</h2>
                    <p>{{ __('nizami.quick.body') }}</p>
                </section>

                <nav class="toc-box reveal" aria-label="{{ __('nizami.toc.title') }}">
                    <h2>{{ __('nizami.toc.title') }}</h2>
                    <ul>
                        <li><a href="#introduction">{{ __('nizami.toc.introduction') }}</a></li>
                        <li><a href="#types">{{ __('nizami.toc.types') }}</a></li>
                        <li><a href="#advantages">{{ __('nizami.toc.advantages') }}</a></li>
                        <li><a href="#selection">{{ __('nizami.toc.selection') }}</a></li>
                        <li><a href="#comparison">{{ __('nizami.toc.comparison') }}</a></li>
                        <li><a href="#conclusion">{{ __('nizami.toc.conclusion') }}</a></li>
                        <li><a href="#faq">{{ __('nizami.toc.faq') }}</a></li>
                    </ul>
                </nav>

                <section id="introduction" class="reveal">
                    <h2>{{ __('nizami.intro.title') }}</h2>
                    <p>{{ __('nizami.intro.p1') }}</p>
                    <p>{{ __('nizami.intro.p2') }}</p>
                </section>

                <section id="types" class="reveal">
                    <h2>{{ __('nizami.types.title') }}</h2>
                    <p>{{ __('nizami.types.intro') }}</p>

                    <h3>{{ __('nizami.types.h1') }}</h3>
                    <p>{{ __('nizami.types.p1_1') }}</p>
                    <p>{{ __('nizami.types.p1_2') }}</p>

                    <h3>{{ __('nizami.types.h2') }}</h3>
                    <p>{{ __('nizami.types.p2_1') }}</p>
                    <p>{{ __('nizami.types.p2_2') }}</p>

                    <h3>{{ __('nizami.types.h3') }}</h3>
                    <p>{{ __('nizami.types.p3_1') }}</p>
                    <p>{{ __('nizami.types.p3_2') }}</p>

                    <h3>{{ __('nizami.types.h4') }}</h3>
                    <p>{{ __('nizami.types.p4_1') }}</p>
                </section>

                <section id="advantages" class="reveal">
                    <h2>{{ __('nizami.advantages.title') }}</h2>
                    <p>{{ __('nizami.advantages.intro') }}</p>
                    <ul>
                        <li><strong>{{ __('nizami.advantages.li1_title') }}</strong> {{ __('nizami.advantages.li1_text') }}</li>
                        <li><strong>{{ __('nizami.advantages.li2_title') }}</strong> {{ __('nizami.advantages.li2_text') }}</li>
                        <li><strong>{{ __('nizami.advantages.li3_title') }}</strong> {{ __('nizami.advantages.li3_text') }}</li>
                        <li><strong>{{ __('nizami.advantages.li4_title') }}</strong> {{ __('nizami.advantages.li4_text') }}</li>
                        <li><strong>{{ __('nizami.advantages.li5_title') }}</strong> {{ __('nizami.advantages.li5_text') }}</li>
                    </ul>
                </section>

                <section id="selection" class="reveal">
                    <h2>{{ __('nizami.selection.title') }}</h2>
                    <p>{{ __('nizami.selection.intro') }}</p>

                    <h3>{{ __('nizami.selection.criteria_title') }}</h3>
                    <ul>
                        <li>{{ __('nizami.selection.c1') }}</li>
                        <li>{{ __('nizami.selection.c2') }}</li>
                        <li>{{ __('nizami.selection.c3') }}</li>
                        <li>{{ __('nizami.selection.c4') }}</li>
                        <li>{{ __('nizami.selection.c5') }}</li>
                        <li>{{ __('nizami.selection.c6') }}</li>
                        <li>{{ __('nizami.selection.c7') }}</li>
                        <li>{{ __('nizami.selection.c8') }}</li>
                    </ul>
                    <p>{{ __('nizami.selection.outro') }}</p>
                </section>

                <section id="comparison" class="reveal">
                    <h2>{{ __('nizami.comparison.title') }}</h2>
                    <p>{{ __('nizami.comparison.intro') }}</p>

                    <div class="article-table-wrapper">
                        <table class="article-table">
                            <thead>
                            <tr>
                                <th>{{ __('nizami.comparison.th_type') }}</th>
                                <th>{{ __('nizami.comparison.th_use') }}</th>
                                <th>{{ __('nizami.comparison.th_feature') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td data-label="{{ __('nizami.comparison.th_type') }}">{{ __('nizami.comparison.r1c1') }}</td>
                                <td data-label="{{ __('nizami.comparison.th_use') }}">{{ __('nizami.comparison.r1c2') }}</td>
                                <td data-label="{{ __('nizami.comparison.th_feature') }}">{{ __('nizami.comparison.r1c3') }}</td>
                            </tr>
                            <tr>
                                <td data-label="{{ __('nizami.comparison.th_type') }}">{{ __('nizami.comparison.r2c1') }}</td>
                                <td data-label="{{ __('nizami.comparison.th_use') }}">{{ __('nizami.comparison.r2c2') }}</td>
                                <td data-label="{{ __('nizami.comparison.th_feature') }}">{{ __('nizami.comparison.r2c3') }}</td>
                            </tr>
                            <tr>
                                <td data-label="{{ __('nizami.comparison.th_type') }}">{{ __('nizami.comparison.r3c1') }}</td>
                                <td data-label="{{ __('nizami.comparison.th_use') }}">{{ __('nizami.comparison.r3c2') }}</td>
                                <td data-label="{{ __('nizami.comparison.th_feature') }}">{{ __('nizami.comparison.r3c3') }}</td>
                            </tr>
                            <tr>
                                <td data-label="{{ __('nizami.comparison.th_type') }}">{{ __('nizami.comparison.r4c1') }}</td>
                                <td data-label="{{ __('nizami.comparison.th_use') }}">{{ __('nizami.comparison.r4c2') }}</td>
                                <td data-label="{{ __('nizami.comparison.th_feature') }}">{{ __('nizami.comparison.r4c3') }}</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section id="conclusion" class="reveal">
                    <h2>{{ __('nizami.conclusion.title') }}</h2>
                    <p>{{ __('nizami.conclusion.p1') }}</p>
                    <p>{{ __('nizami.conclusion.p2') }}</p>
                </section>

                <section class="article-cta reveal">
                    <h2>{{ __('nizami.cta.title') }}</h2>
                    <p>{{ __('nizami.cta.body') }}</p>
                    <a href="tel:09191919885">{{ __('nizami.cta.button') }}</a>
                </section>

                <section id="faq" class="reveal">
                    <h2>{{ __('nizami.faq.title') }}</h2>

                    <details class="faq-item" open>
                        <summary>{{ __('nizami.faq.q1') }}</summary>
                        <div class="faq-body">{{ __('nizami.faq.a1') }}</div>
                    </details>
                    <details class="faq-item">
                        <summary>{{ __('nizami.faq.q2') }}</summary>
                        <div class="faq-body">{{ __('nizami.faq.a2') }}</div>
                    </details>
                    <details class="faq-item">
                        <summary>{{ __('nizami.faq.q3') }}</summary>
                        <div class="faq-body">{{ __('nizami.faq.a3') }}</div>
                    </details>
                    <details class="faq-item">
                        <summary>{{ __('nizami.faq.q4') }}</summary>
                        <div class="faq-body">{{ __('nizami.faq.a4') }}</div>
                    </details>
                    <details class="faq-item">
                        <summary>{{ __('nizami.faq.q5') }}</summary>
                        <div class="faq-body">{{ __('nizami.faq.a5') }}</div>
                    </details>
                </section>

                <div class="article-tags reveal">
                    <strong>{{ __('nizami.tags.label') }}</strong>
                    <span>{{ __('nizami.tags.t1') }}</span>
                    <span>{{ __('nizami.tags.t2') }}</span>
                    <span>{{ __('nizami.tags.t3') }}</span>
                    <span>{{ __('nizami.tags.t4') }}</span>
                    <span>{{ __('nizami.tags.t5') }}</span>
                    <span>{{ __('nizami.tags.t6') }}</span>
                    <span>{{ __('nizami.tags.t7') }}</span>
                    <span>{{ __('nizami.tags.t8') }}</span>
                </div>
            </article>
        </div>
    </div>

    @php
        $articleUrl = url($locale . '/nizami');
        $faqs = [
            ['question' => __('nizami.faq.q1'), 'answer' => __('nizami.faq.a1')],
            ['question' => __('nizami.faq.q2'), 'answer' => __('nizami.faq.a2')],
            ['question' => __('nizami.faq.q3'), 'answer' => __('nizami.faq.a3')],
            ['question' => __('nizami.faq.q4'), 'answer' => __('nizami.faq.a4')],
            ['question' => __('nizami.faq.q5'), 'answer' => __('nizami.faq.a5')],
        ];
    @endphp

    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'Article',
            'headline' => __('nizami.header.title'),
            'description' => __('nizami.meta.description'),
            'inLanguage' => $locale === 'fa' ? 'fa-IR' : ($locale === 'ar' ? 'ar-SA' : 'en-US'),
            'mainEntityOfPage' => $articleUrl,
            'author' => ['@type' => 'Organization', 'name' => 'Shahbab Balloon'],
            'publisher' => ['@type' => 'Organization', 'name' => 'Shahbab Balloon'],
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>

    <script type="application/ld+json">
        {!! json_encode([
            '@context' => 'https://schema.org',
            '@type' => 'FAQPage',
            'mainEntity' => array_map(function ($faq) {
                return [
                    '@type' => 'Question',
                    'name' => $faq['question'],
                    'acceptedAnswer' => ['@type' => 'Answer', 'text' => $faq['answer']],
                ];
            }, $faqs),
        ], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!}
    </script>

    <script>
        (function () {
            'use strict';

            var progress = document.getElementById('readingProgress');
            var articleEl = document.querySelector('.article-content');

            function updateProgress() {
                if (!progress || !articleEl) return;
                var rect = articleEl.getBoundingClientRect();
                var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                var articleTop = rect.top + scrollTop;
                var articleHeight = rect.height;
                var viewportHeight = window.innerHeight;
                var scrolled = scrollTop - articleTop + viewportHeight * 0.2;
                var percent = (scrolled / articleHeight) * 100;
                progress.style.width = Math.max(0, Math.min(100, percent)) + '%';
            }

            var revealEls = document.querySelectorAll('.reveal');
            if ('IntersectionObserver' in window && revealEls.length) {
                var observer = new IntersectionObserver(function (entries) {
                    entries.forEach(function (entry) {
                        if (entry.isIntersecting) {
                            entry.target.classList.add('visible');
                            observer.unobserve(entry.target);
                        }
                    });
                }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
                revealEls.forEach(function (el) { observer.observe(el); });
            } else {
                revealEls.forEach(function (el) { el.classList.add('visible'); });
            }

            document.querySelectorAll('.toc-box a[href^="#"]').forEach(function (link) {
                link.addEventListener('click', function (e) {
                    var target = document.querySelector(this.getAttribute('href'));
                    if (target) {
                        e.preventDefault();
                        var y = target.getBoundingClientRect().top + window.pageYOffset - 20;
                        window.scrollTo({ top: y, behavior: 'smooth' });
                        history.replaceState(null, '', this.getAttribute('href'));
                    }
                });
            });

            var ticking = false;
            window.addEventListener('scroll', function () {
                if (!ticking) {
                    window.requestAnimationFrame(function () {
                        updateProgress();
                        ticking = false;
                    });
                    ticking = true;
                }
            }, { passive: true });

            updateProgress();
        })();
    </script>
@endsection
