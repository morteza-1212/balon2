@extends('layouts.home')

@section('title', 'بالن‌های پژوهشی و هواشناسی؛ انواع، کاربردها و ویژگی‌ها | شهاب بالن')

@section('meta')
    <meta name="description" content="آشنایی با انواع بالن‌های پژوهشی و هواشناسی شامل بالن‌های سوند، استراتوسفری، بالن‌های مهارشده و آزمایش تجهیزات. بررسی کاربردها، ویژگی‌های فنی و مزایای بالن‌های تحقیقاتی.">
    <meta name="keywords" content="بالن پژوهشی، بالن هواشناسی، بالن سوند، رادیوسوند، بالن استراتوسفری، بالن علمی، پژوهش جوی، بالن تحقیقاتی، اندازه‌گیری ارتفاع بالا، بالن لاستیکی هواشناسی">
    <meta name="robots" content="index, follow, max-image-preview:large">
    <link rel="canonical" href="{{ url('/blog/research-weather-balloons-guide') }}">
    <meta property="og:type" content="article">
    <meta property="og:title" content="بالن‌های پژوهشی و هواشناسی؛ انواع، کاربردها و ویژگی‌ها">
    <meta property="og:description" content="معرفی انواع بالن‌های پژوهشی و هواشناسی و بررسی کاربردهای علمی، اندازه‌گیری شرایط جوی و تحقیقات ارتفاع بالا.">
    <meta property="og:url" content="{{ url('/blog/research-weather-balloons-guide') }}">
    <meta property="og:locale" content="fa_IR">
    <meta property="og:site_name" content="شهاب بالن">
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="بالن‌های پژوهشی و هواشناسی">
    <meta name="twitter:description" content="بررسی انواع بالن‌های هواشناسی، بالن سوند و بالن‌های استراتوسفری و کاربردهای علمی آن‌ها.">
    <meta property="article:section" content="مقالات تخصصی">
    <meta property="article:published_time" content="2026-11-07">
    <meta property="article:modified_time" content="2026-11-07">
    <meta property="article:tag" content="بالن پژوهشی">
    <meta property="article:tag" content="بالن هواشناسی">
    <meta property="article:tag" content="رادیوسوند">
@endsection

@section('content')

    <style>
        :root {
            --navy-900: #061530;
            --navy-800: #0A1F44;
            --navy-700: #14315F;
            --navy-600: #1E427A;
            --navy-500: #2A5595;
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
            --text-light: #8895A7;
            --border: #DDE4EE;
            --shadow-sm: 0 2px 8px rgba(10, 31, 68, 0.06);
            --shadow-md: 0 8px 24px rgba(10, 31, 68, 0.10);
            --shadow-lg: 0 20px 50px rgba(10, 31, 68, 0.18);
            --radius: 18px;
            --radius-sm: 12px;
        }

        * { box-sizing: border-box; }

        .article-page {
            direction: rtl;
            text-align: right;
            color: var(--text-dark);
            line-height: 2.1;
            background: var(--bg);
            overflow-x: hidden;
            font-family: 'Vazirmatn', 'IRANSans', Tahoma, sans-serif;
        }

        /* ============ Progress Bar ============ */
        .reading-progress {
            position: fixed;
            top: 0;
            right: 0;
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

        /* ============ HERO HEADER WITH IMAGE ============ */
        .article-header {
            position: relative;
            background: var(--navy-900);
            color: #fff;
            padding: 100px 20px 100px;
            overflow: hidden;
            isolation: isolate;
        }

        /* Background Image (Right Side) */
        .article-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 60%;
            background-image: url('{{ asset('img/header/headerweather.jpeg') }}'); /* مسیر تصویر خود را اینجا تنظیم کنید */
            background-size: cover;
            background-position: center;
            z-index: -2;
            /* Mask for smooth fade to the left */
            mask-image: linear-gradient(to left, black 40%, transparent 100%);
            -webkit-mask-image: linear-gradient(to left, black 40%, transparent 100%);
        }

        /* Gradient Overlay (Left Side) */
        .article-header::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: linear-gradient(90deg, var(--navy-900) 40%, rgba(10, 31, 68, 0.6) 65%, transparent 100%);
            z-index: -1;
        }

        .article-header .container {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
        }

        .header-text {
            max-width: 600px;
            text-align: left;
        }

        .article-header .badge {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: linear-gradient(135deg, rgba(212, 175, 55, 0.95), rgba(229, 193, 88, 0.95));
            color: var(--navy-900);
            padding: 9px 22px;
            border-radius: 40px;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: 0.3px;
            box-shadow: 0 6px 24px rgba(212, 175, 55, 0.45);
            animation: badgePulse 3s ease-in-out infinite;
            backdrop-filter: blur(8px);
            margin-bottom: 10px;
        }

        .article-header .badge::before { content: '✦'; font-size: 14px; }

        @keyframes badgePulse {
            0%, 100% { transform: scale(1); box-shadow: 0 6px 24px rgba(212, 175, 55, 0.45); }
            50%      { transform: scale(1.04); box-shadow: 0 8px 32px rgba(212, 175, 55, 0.65); }
        }

        .article-header h1 {
            font-size: clamp(28px, 3.5vw, 48px);
            font-weight: 900;
            line-height: 1.6;
            margin: 20px 0;
            text-shadow: 0 4px 30px rgba(0, 0, 0, 0.4);
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
            text-shadow: 0 2px 10px rgba(0,0,0,0.5);
        }

        .article-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .article-meta span {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            background: rgba(255, 255, 255, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            color: #D5E1EE;
            padding: 9px 18px;
            border-radius: 40px;
            font-size: 13px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            transition: all 0.3s ease;
        }

        .article-meta span i { color: var(--gold-400); }

        .article-meta span:hover {
            background: rgba(212, 175, 55, 0.2);
            border-color: rgba(212, 175, 55, 0.6);
            transform: translateY(-3px);
            color: #fff;
        }

        /* ============ MAIN LAYOUT ============ */
        .article-container {
            max-width: 1180px;
            margin: 0 auto;
            padding: 70px 20px 90px;
            position: relative;
        }

        .article-content {
            max-width: 900px;
            margin: 0 auto;
            position: relative;
        }

        /* ============ SECTION HEADINGS (Fixed Icons) ============ */
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
            box-shadow: 0 4px 14px rgba(212, 175, 55, 0.4);
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
            flex-shrink: 0;
            color: var(--gold-500);
            font-size: 14px;
            transition: transform 0.3s ease;
        }

        .article-content h3:hover::before {
            transform: rotate(45deg) scale(1.2);
        }

        .article-content p {
            font-size: 15.5px;
            line-height: 2.35;
            color: var(--text-mid);
            margin-bottom: 20px;
            text-align: justify;
        }

        .article-content ul {
            padding-right: 0;
            list-style: none;
            margin-bottom: 28px;
        }

        .article-content ul li {
            position: relative;
            padding: 14px 52px 14px 18px;
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
            right: 18px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--gold-500);
            font-size: 12px;
            transition: all 0.35s ease;
        }

        .article-content ul li:hover {
            transform: translateX(-6px);
            border-color: var(--gold-400);
            box-shadow: var(--shadow-md);
            background: linear-gradient(135deg, #fff 0%, #fdf9ee 100%);
        }

        .article-content ul li:hover::before {
            color: var(--cyan-400);
            transform: translateY(-50%) rotate(45deg) scale(1.3);
        }

        .article-content ul li strong {
            color: var(--navy-700);
            font-weight: 800;
        }

        /* ============ QUICK ANSWER ============ */
        .quick-answer {
            position: relative;
            background: linear-gradient(135deg, #EEF4FF 0%, #F7FAFF 100%);
            border: 1px solid #C9D9F0;
            border-right: 6px solid var(--navy-700);
            border-radius: var(--radius);
            padding: 32px 34px;
            margin: 44px 0;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .quick-answer h2 {
            display: flex;
            align-items: center;
            gap: 12px;
            border: none;
            margin: 0 0 14px;
            font-size: 21px;
            color: var(--navy-800);
        }

        .quick-answer h2::before {
            content: '💡';
            font-size: 24px;
            filter: drop-shadow(0 2px 6px rgba(212, 175, 55, 0.5));
        }

        .quick-answer p {
            margin: 0;
            font-size: 15px;
            color: var(--navy-800);
            line-height: 2.2;
            font-weight: 500;
            position: relative;
            z-index: 1;
        }

        /* ============ TOC BOX (Fixed Icons) ============ */
        .toc-box {
            position: relative;
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            padding: 30px 34px;
            margin: 44px 0;
            box-shadow: var(--shadow-md);
            overflow: hidden;
        }

        .toc-box::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 4px;
            background: linear-gradient(90deg, var(--gold-500), var(--cyan-400), var(--gold-500));
            background-size: 200% 100%;
            animation: progressShine 4s linear infinite;
        }

        .toc-box h2 {
            display: flex;
            align-items: center;
            gap: 10px;
            font-size: 20px;
            margin: 0 0 20px;
            color: var(--navy-800);
        }

        .toc-box h2::before {
            content: '📑';
            font-size: 22px;
        }

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

        .toc-box a:hover {
            background: var(--navy-700);
            color: #fff;
            border-color: var(--navy-700);
            transform: translateX(-6px);
            box-shadow: 0 8px 20px rgba(10, 31, 68, 0.25);
        }

        .toc-box a:hover::before {
            transform: translateX(-5px);
            color: var(--gold-400);
        }

        /* ============ TABLE (Fully Responsive) ============ */
        .article-table-wrapper {
            margin: 34px 0;
            border-radius: var(--radius);
            box-shadow: var(--shadow-lg);
            border: 1px solid var(--border);
            background: var(--surface);
            overflow: hidden;
        }

        .article-table {
            width: 100%;
            border-collapse: collapse;
        }

        .article-table th,
        .article-table td {
            padding: 18px 20px;
            text-align: right;
            font-size: 14.5px;
            border-bottom: 1px solid var(--border);
        }

        .article-table th {
            background: linear-gradient(135deg, var(--navy-800), var(--navy-600));
            color: #fff;
            font-weight: 800;
            font-size: 14px;
            border: none;
            position: relative;
        }

        .article-table th::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--gold-500), var(--cyan-400));
        }

        .article-table tbody tr {
            transition: all 0.3s ease;
        }

        .article-table tbody tr:nth-child(even) { background: #FAFCFF; }
        .article-table tbody tr:hover {
            background: linear-gradient(90deg, #EEF4FF 0%, #FFF9E8 100%);
        }
        .article-table tbody tr:last-child td { border-bottom: none; }
        .article-table td:first-child {
            font-weight: 800;
            color: var(--navy-800);
        }

        /* ============ CTA ============ */
        .article-cta {
            position: relative;
            background: linear-gradient(135deg, var(--navy-900) 0%, var(--navy-800) 50%, var(--navy-700) 100%);
            padding: 52px 38px;
            border-radius: var(--radius);
            text-align: center;
            color: #fff;
            margin: 76px 0;
            overflow: hidden;
            box-shadow: var(--shadow-lg);
            isolation: isolate;
        }

        .article-cta::before {
            content: '';
            position: absolute;
            top: -60%; right: -10%;
            width: 320px; height: 320px;
            background: radial-gradient(circle, rgba(212, 175, 55, 0.3), transparent 70%);
            border-radius: 50%;
            animation: floatParticle 9s ease-in-out infinite;
            z-index: -1;
        }

        .article-cta h2 {
            position: relative;
            color: #fff;
            border: none;
            padding: 0;
            margin: 0 0 16px;
            font-size: 25px;
            font-weight: 900;
            line-height: 1.7;
            z-index: 2;
            justify-content: center;
        }

        .article-cta h2::before { display: none; }

        .article-cta p {
            position: relative;
            color: #C5D3E3;
            text-align: center;
            font-size: 15px;
            line-height: 2;
            max-width: 640px;
            margin: 0 auto 26px;
            z-index: 2;
        }

        .article-cta a {
            position: relative;
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
            z-index: 2;
            box-shadow: 0 10px 30px rgba(212, 175, 55, 0.5);
            transition: all 0.35s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .article-cta a::after {
            content: '←';
            transition: transform 0.35s ease;
            font-weight: 900;
        }

        .article-cta a:hover {
            transform: translateY(-5px) scale(1.02);
            box-shadow: 0 18px 40px rgba(212, 175, 55, 0.65);
        }

        .article-cta a:hover::after { transform: translateX(-7px); }

        /* ============ FAQ ============ */
        .faq-item {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: var(--radius);
            margin-bottom: 14px;
            overflow: hidden;
            box-shadow: var(--shadow-sm);
            transition: all 0.35s ease;
        }

        .faq-item:hover {
            border-color: var(--gold-400);
            box-shadow: var(--shadow-md);
            transform: translateY(-2px);
        }

        .faq-item[open] {
            border-color: var(--navy-700);
        }

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
            transition: all 0.3s ease;
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

        .faq-item summary:hover { background: #F9FBFE; }

        .faq-item .faq-body {
            padding: 0 26px 22px 76px;
            color: var(--text-mid);
            font-size: 14.5px;
            line-height: 2.2;
            animation: slideDown 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        @keyframes slideDown {
            from { opacity: 0; transform: translateY(-10px); }
            to   { opacity: 1; transform: translateY(0); }
        }

        /* ============ TAGS ============ */
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

        /* ============ Back to top ============ */
        .back-to-top {
            position: fixed;
            bottom: 32px;
            left: 32px;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, var(--navy-700), var(--navy-800));
            color: #fff;
            border: none;
            border-radius: 50%;
            cursor: pointer;
            box-shadow: var(--shadow-lg);
            opacity: 0;
            visibility: hidden;
            transform: translateY(20px) scale(0.8);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            z-index: 100;
            font-size: 22px;
            font-weight: 900;
        }

        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
            transform: translateY(0) scale(1);
        }

        .back-to-top:hover {
            background: linear-gradient(135deg, var(--gold-500), var(--gold-400));
            color: var(--navy-900);
            transform: translateY(-5px) scale(1.08);
        }

        /* ============ Reveal animation ============ */
        .reveal {
            opacity: 0;
            transform: translateY(34px);
            transition: opacity 0.75s ease, transform 0.75s cubic-bezier(0.4, 0, 0.2, 1);
        }

        .reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ============ RESPONSIVE ============ */
        @media (max-width: 992px) {
            .article-header::before {
                width: 100%;
                mask-image: none;
                -webkit-mask-image: none;
                opacity: 0.4; /* Fade image on tablet */
            }
            .article-header::after {
                background: linear-gradient(180deg, rgba(10, 31, 68, 0.9) 0%, rgba(10, 31, 68, 0.7) 100%);
            }
            .header-text { max-width: 100%; text-align: center; }
            .article-meta { justify-content: center; }

            .article-content h2 { font-size: 23px; }
        }

        /* Mobile & Tablet Table Responsive */
        @media (max-width: 768px) {
            .article-header { padding: 80px 16px; }
            .article-container { padding: 44px 16px 64px; }

            .article-content h2 { font-size: 20px; gap: 10px; margin-top: 46px; }
            .article-content h2::before { height: 28px; width: 6px; }
            .article-content h3 { font-size: 17px; gap: 8px; }
            .article-content p { font-size: 14.5px; line-height: 2.25; }
            .article-content ul li { padding: 12px 44px 12px 14px; font-size: 14px; }

            .quick-answer, .toc-box { padding: 24px 20px; }
            .toc-box ul { grid-template-columns: 1fr; }

            /* Table Responsive */
            .article-table, .article-table thead, .article-table tbody, .article-table th, .article-table td, .article-table tr {
                display: block;
            }
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
                padding-right: 45% !important;
                text-align: right;
                min-height: 50px;
                display: flex;
                align-items: center;
            }
            .article-table td:last-child { border-bottom: none; }
            .article-table td::before {
                position: absolute;
                top: 0;
                right: 0;
                width: 40%;
                padding: 18px 20px;
                padding-left: 10px;
                white-space: nowrap;
                font-weight: 800;
                color: var(--navy-700);
                content: attr(data-label);
                height: 100%;
                display: flex;
                align-items: center;
                background: var(--surface-2);
                border-left: 1px solid var(--border);
            }

            .article-cta { padding: 36px 22px; margin: 56px 0; }
            .article-cta h2 { font-size: 20px; }

            .faq-item summary { padding: 16px 18px; font-size: 15.5px; }
            .faq-item .faq-body { padding: 0 18px 18px 18px; }

            .back-to-top { bottom: 20px; left: 20px; width: 44px; height: 44px; font-size: 19px; }
        }

        @media (max-width: 480px) {
            .article-header h1 { font-size: 22px; }
            .article-header .subtitle { font-size: 14px; }
            .article-content h2 { font-size: 18.5px; }
            .article-content h3 { font-size: 16px; }
            .article-meta span { font-size: 11px; padding: 6px 12px; }
            .article-table td { padding-right: 40% !important; font-size: 13px; }
            .article-table td::before { font-size: 12px; padding: 14px 12px; width: 35%; }
        }
        /* ============ HERO HEADER WITH IMAGE ============ */
        .article-header {
            position: relative;
            background: var(--navy-900);
            color: #fff;
            padding: 100px 20px 100px;
            overflow: hidden;
            isolation: isolate;
        }

        /* Background Image (Right Side) */
        .article-header::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            width: 65%; /* کمی بیشتر شد تا تصویر بهتر دیده شود */
            background-image: url('{{ asset('img/header/headerweather.jpeg') }}');
            background-size: cover;
            background-position: center;
            z-index: -2;
            /* Mask for smooth fade to the left */
            mask-image: linear-gradient(to left, black 50%, transparent 100%);
            -webkit-mask-image: linear-gradient(to left, black 50%, transparent 100%);
        }

        /* Gradient Overlay (Left Side) */
        .article-header::after {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            bottom: 0;
            left: 0;
            background: linear-gradient(90deg, var(--navy-900) 35%, rgba(10, 31, 68, 0.7) 60%, transparent 100%);
            z-index: -1;
        }

        .article-header .container {
            position: relative;
            z-index: 2;
            max-width: 1200px;
            margin: 0 auto;
            display: flex;
            align-items: center;
            /* اطمینان از اینکه کانتینر کل عرض را پر می‌کند */
            width: 100%;
        }

        .header-text {
            max-width: 600px;
            width: 100%;
            text-align: left; /* چپ‌چین کردن متن */
            margin-right: auto; /* هل دادن بلوک به سمت چپ */
            margin-left: 0;
        }

        /* تنظیم چینش متادیتا در دسکتاپ */
        .article-meta {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            justify-content: flex-start; /* المان‌ها از سمت چپ شروع شوند */
        }

        /* ... سایر استایل‌های بج، تیتر و متادیتا بدون تغییر باقی می‌مانند ... */
        @media (max-width: 992px) {
            .article-header::before {
                width: 100%;
                mask-image: none;
                -webkit-mask-image: none;
                opacity: 0.3;
            }
            .article-header::after {
                background: linear-gradient(180deg, rgba(10, 31, 68, 0.9) 0%, rgba(10, 31, 68, 0.7) 100%);
            }
            .header-text {
                max-width: 100%;
                text-align: center;
                margin: 0 auto; /* وسط‌چین کردن بلوک در موبایل */
            }
            .article-meta {
                justify-content: center; /* وسط‌چین کردن متادیتا در موبایل */
            }
            .article-content h2 { font-size: 23px; }
        }
    </style>

    <!-- Reading progress -->
    <div class="reading-progress" id="readingProgress"></div>

    <div class="article-page">

        <!-- ============ HERO ============ -->
        <header class="article-header">
            <div class="container">
                <div class="header-text" >
                    <span class="badge">مقالات تخصصی</span>
                    <h1>بالن‌های پژوهشی و هواشناسی؛ انواع، کاربردها و ویژگی‌های علمی</h1>
                    <p class="subtitle">
                        آشنایی با انواع بالن‌های هواشناسی، بالن‌های سوند،
                        بالن‌های استراتوسفری و تجهیزات پژوهشی برای
                        جمع‌آوری داده‌های جوی و مطالعات علمی.
                    </p>
                    <div class="article-meta">
                        <span><i class="far fa-calendar-alt"></i> آخرین به‌روزرسانی: ۱۶ آبان ۱۴۰۵</span>
                        <span><i class="far fa-clock"></i> زمان مطالعه: ۸ دقیقه</span>
                        <span><i class="far fa-folder"></i> مقالات پژوهشی</span>
                    </div>
                </div>
            </div>
        </header>

        <!-- ============ MAIN ============ -->
        <main class="article-container">
            <article class="article-content" itemscope itemtype="https://schema.org/Article">
                <meta itemprop="headline" content="بالن‌های پژوهشی و هواشناسی؛ انواع، کاربردها و ویژگی‌ها">
                <meta itemprop="datePublished" content="2026-11-07">
                <meta itemprop="dateModified" content="2026-11-07">
                <meta itemprop="inLanguage" content="fa-IR">
                <meta itemprop="author" content="تیم تخصصی شهاب بالن">
                <meta itemprop="publisher" content="شهاب بالن">

                <section class="quick-answer reveal">
                    <h2>بالن پژوهشی چیست و چه کاربردی دارد؟</h2>
                    <p>
                        بالن پژوهشی وسیله‌ای سبک و کاربردی برای حمل تجهیزات اندازه‌گیری و جمع‌آوری داده
                        در لایه‌های مختلف جو است. این بالن‌ها می‌توانند برای اندازه‌گیری دما، فشار،
                        رطوبت و پارامترهای جوی مورد استفاده قرار گیرند. چهار گروه رایج آن‌ها شامل
                        بالن‌های هواشناسی سوند، بالن‌های استراتوسفری، بالن‌های پژوهشی مهارشده و
                        بالن‌های آزمایش تجهیزات هستند.
                    </p>
                </section>

                <nav class="toc-box reveal" aria-label="فهرست مطالب">
                    <h2>فهرست مطالب</h2>
                    <ul>
                        <li><a href="#introduction">مقدمه</a></li>
                        <li><a href="#types">انواع بالن‌های پژوهشی</a></li>
                        <li><a href="#applications">کاربردهای بالن‌های پژوهشی</a></li>
                        <li><a href="#features">ویژگی‌های یک بالن پژوهشی مناسب</a></li>
                        <li><a href="#comparison">مقایسه انواع بالن‌های پژوهشی</a></li>
                        <li><a href="#conclusion">جمع‌بندی</a></li>
                        <li><a href="#faq">سؤالات متداول</a></li>
                    </ul>
                </nav>

                <section id="introduction" class="reveal">
                    <h2>مقدمه</h2>
                    <p>
                        بخش قابل توجهی از اطلاعات ارزشمند درباره جو زمین تنها با اندازه‌گیری در
                        ارتفاعات مختلف قابل دستیابی است. بالن‌های پژوهشی این امکان را فراهم می‌کنند
                        که تجهیزات علمی و حسگرهای اندازه‌گیری به لایه‌های مختلف جو منتقل شوند.
                    </p>
                    <p>
                        در مقایسه با برخی روش‌های اندازه‌گیری هوایی و فضایی، بالن‌ها در بسیاری از
                        پروژه‌های تحقیقاتی هزینه اجرایی کمتری دارند و امکان انجام آزمایش‌های علمی
                        و جمع‌آوری داده‌های محیطی را فراهم می‌کنند.
                    </p>
                </section>

                <section id="types" class="reveal">
                    <h2>بالن‌های پژوهشی چند نوع دارند؟</h2>
                    <p>
                        بالن‌های پژوهشی بر اساس نوع ساختار، ارتفاع پرواز، تجهیزات قابل حمل و
                        هدف تحقیقاتی به گروه‌های مختلفی تقسیم می‌شوند.
                    </p>

                    <h3>۱. بالن‌های هواشناسی (رادیوسوند)</h3>
                    <p>
                        بالن‌های هواشناسی معمولاً از مواد انعطاف‌پذیر مانند لاتکس یا مواد
                        الاستومری مخصوص ساخته می‌شوند. این بالن‌ها یک محموله اندازه‌گیری
                        به نام رادیوسوند را حمل می‌کنند.
                    </p>
                    <p>
                        رادیوسوند می‌تواند پارامترهایی مانند دما، فشار و رطوبت را اندازه‌گیری کند
                        و اطلاعات موقعیت، سرعت و جهت حرکت خود را نیز به ایستگاه زمینی ارسال کند.
                    </p>

                    <h3>۲. بالن‌های استراتوسفری و ارتفاع بالا</h3>
                    <p>
                        این بالن‌ها برای حمل محموله‌های علمی در ارتفاعات زیاد طراحی می‌شوند.
                        در ساخت آن‌ها معمولاً از فیلم‌های پلیمری سبک و مقاوم استفاده می‌شود.
                    </p>
                    <p>
                        بالن‌های استراتوسفری در پروژه‌های تحقیقاتی مرتبط با فیزیک جو، مطالعات
                        پرتوهای کیهانی، بررسی شرایط لایه‌های بالایی جو و آزمایش تجهیزات علمی
                        کاربرد دارند.
                    </p>

                    <h3>۳. بالن‌های پژوهشی مهارشده</h3>
                    <p>
                        بالن‌های مهارشده با استفاده از کابل یا سازه نگهدارنده به نقطه‌ای روی زمین
                        متصل می‌شوند. این ساختار امکان نگهداری بالن در محدوده مشخص و انجام
                        برخی اندازه‌گیری‌های محیطی را فراهم می‌کند.
                    </p>

                    <h3>۴. بالن‌های آزمایش تجهیزات</h3>
                    <p>
                        این بالن‌ها برای بررسی عملکرد حسگرها، دوربین‌ها و تجهیزات الکترونیکی
                        در شرایط محیطی خاص طراحی می‌شوند.
                    </p>
                </section>

                <section id="applications" class="reveal">
                    <h2>بالن‌های پژوهشی چه کاربردهایی دارند؟</h2>
                    <p>
                        بالن‌های پژوهشی در حوزه‌های مختلف علمی و تحقیقاتی مورد استفاده قرار
                        می‌گیرند. مهم‌ترین کاربردهای آن‌ها عبارت‌اند از:
                    </p>
                    <ul>
                        <li>
                            <strong>هواشناسی و پیش‌بینی وضعیت هوا:</strong>
                            اندازه‌گیری دما، فشار، رطوبت و پارامترهای جوی در ارتفاعات مختلف.
                        </li>
                        <li>
                            <strong>مطالعات اقلیمی:</strong>
                            جمع‌آوری داده برای بررسی تغییرات دما، رطوبت و ویژگی‌های جو.
                        </li>
                        <li>
                            <strong>پژوهش‌های دانشگاهی:</strong>
                            اجرای پروژه‌های تحقیقاتی و آزمایش‌های علمی در دانشگاه‌ها.
                        </li>
                        <li>
                            <strong>تحقیقات فیزیک جو:</strong>
                            بررسی ویژگی‌های فیزیکی و شرایط محیطی لایه‌های مختلف جو.
                        </li>
                        <li>
                            <strong>آزمایش تجهیزات:</strong>
                            ارزیابی و بررسی عملکرد حسگرها، دوربین‌ها و ابزارهای اندازه‌گیری.
                        </li>
                    </ul>
                </section>

                <section id="features" class="reveal">
                    <h2>یک بالن پژوهشی مناسب باید چه ویژگی‌هایی داشته باشد؟</h2>
                    <p>
                        انتخاب بالن پژوهشی باید بر اساس نوع آزمایش، وزن محموله، شرایط محیطی
                        و مشخصات مأموریت انجام شود. مهم‌ترین ویژگی‌های قابل بررسی عبارت‌اند از:
                    </p>

                    <h3>۱. ظرفیت حمل محموله</h3>
                    <p>
                        ظرفیت حمل باید با وزن تجهیزات اندازه‌گیری، حسگرها، سامانه‌های
                        ثبت اطلاعات و متعلقات موردنیاز تناسب داشته باشد.
                    </p>

                    <h3>۲. کیفیت و استحکام مواد اولیه</h3>
                    <p>
                        جنس بدنه باید متناسب با ارتفاع، دما، فشار و شرایط محیطی مورد انتظار
                        انتخاب شود. انعطاف‌پذیری، استحکام و کیفیت ساخت در عملکرد محصول
                        تأثیرگذار هستند.
                    </p>

                    <h3>۳. امکان بازیابی محموله</h3>
                    <p>
                        در پروژه‌هایی که بازیابی تجهیزات اهمیت دارد، باید سامانه‌های ردیابی،
                        ثبت موقعیت و تمهیدات فرود و بازیابی متناسب با الزامات پروژه در نظر گرفته شوند.
                    </p>
                </section>

                <section id="comparison" class="reveal">
                    <h2>مقایسه انواع بالن‌های پژوهشی</h2>
                    <p>
                        در جدول زیر، ویژگی‌ها و کاربردهای عمومی انواع بالن‌های پژوهشی
                        با یکدیگر مقایسه شده‌اند.
                    </p>

                    <div class="article-table-wrapper">
                        <table class="article-table">
                            <thead>
                            <tr>
                                <th>نوع بالن</th>
                                <th>کاربرد اصلی</th>
                                <th>نوع ساختار</th>
                                <th>ویژگی شاخص</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td data-label="نوع بالن">بالن هواشناسی</td>
                                <td data-label="کاربرد اصلی">اندازه‌گیری شرایط جوی</td>
                                <td data-label="نوع ساختار">معمولاً آزاد</td>
                                <td data-label="ویژگی شاخص">حمل رادیوسوند</td>
                            </tr>
                            <tr>
                                <td data-label="نوع بالن">بالن استراتوسفری</td>
                                <td data-label="کاربرد اصلی">تحقیقات ارتفاع بالا</td>
                                <td data-label="نوع ساختار">آزاد و تخصصی</td>
                                <td data-label="ویژگی شاخص">حمل محموله علمی</td>
                            </tr>
                            <tr>
                                <td data-label="نوع بالن">بالن پژوهشی مهارشده</td>
                                <td data-label="کاربرد اصلی">پایش و آزمایش محیطی</td>
                                <td data-label="نوع ساختار">متصل به زمین</td>
                                <td data-label="ویژگی شاخص">ماندگاری در محدوده مشخص</td>
                            </tr>
                            <tr>
                                <td data-label="نوع بالن">بالن آزمایش تجهیزات</td>
                                <td data-label="کاربرد اصلی">ارزیابی ابزارهای علمی</td>
                                <td data-label="نوع ساختار">متناسب با پروژه</td>
                                <td data-label="ویژگی شاخص">آزمایش عملکرد محموله</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </section>

                <section id="conclusion" class="reveal">
                    <h2>جمع‌بندی</h2>
                    <p>
                        بالن‌های پژوهشی ابزارهایی کاربردی برای جمع‌آوری داده از جو و انجام
                        آزمایش‌های علمی در ارتفاعات مختلف هستند. این تجهیزات در مطالعات
                        هواشناسی، تحقیقات اقلیمی، پروژه‌های دانشگاهی و ارزیابی ابزارهای
                        اندازه‌گیری نقش مهمی دارند.
                    </p>
                </section>

                <section class="article-cta reveal">
                    <h2>برای طراحی و تولید بالن‌های پژوهشی با ما در ارتباط باشید</h2>
                    <p>
                        مجموعه شهاب بالن آماده بررسی نیازهای پروژه‌های علمی و پژوهشی و ارائه
                        مشاوره درباره طراحی و تولید محصولات بادی و بالن‌های سفارشی
                        متناسب با مشخصات پروژه است.
                    </p>
                    <a href="tel:09191919885">درخواست مشاوره فنی</a>
                </section>

                <section id="faq" class="reveal">
                    <h2>سؤالات متداول درباره بالن‌های پژوهشی</h2>

                    <details class="faq-item" open>
                        <summary>بالن هواشناسی تا چه ارتفاعی بالا می‌رود؟</summary>
                        <div class="faq-body">
                            ارتفاع پرواز به نوع بالن، اندازه، میزان گاز پرکننده، وزن محموله و
                            شرایط جوی بستگی دارد. بالن‌های هواشناسی متداول می‌توانند به
                            ارتفاعات بالای جو برسند و بالن‌های استراتوسفری برای ارتفاعات
                            بسیار بیشتر طراحی می‌شوند.
                        </div>
                    </details>

                    <details class="faq-item">
                        <summary>بالن سوند چه پارامترهایی را اندازه‌گیری می‌کند؟</summary>
                        <div class="faq-body">
                            رادیوسوند معمولاً دما، فشار و رطوبت را در طول صعود اندازه‌گیری
                            می‌کند و می‌تواند اطلاعات موقعیت، سرعت و جهت حرکت را نیز ثبت و
                            ارسال کند.
                        </div>
                    </details>

                    <details class="faq-item">
                        <summary>آیا بالن پژوهشی قابل بازیابی است؟</summary>
                        <div class="faq-body">
                            امکان بازیابی به نوع بالن، طراحی مأموریت و تجهیزات بازیابی
                            بستگی دارد. در پروژه‌های مناسب می‌توان از سامانه‌های ردیابی
                            و تمهیدات فرود برای بازیابی محموله استفاده کرد.
                        </div>
                    </details>
                </section>

                <div class="article-tags reveal">
                    <strong>برچسب‌ها:</strong>
                    <span>بالن پژوهشی</span>
                    <span>بالن هواشناسی</span>
                    <span>بالن سوند</span>
                    <span>رادیوسوند</span>
                    <span>بالن استراتوسفری</span>
                    <span>بالن علمی</span>
                    <span>تحقیقات جوی</span>
                    <span>بالن تحقیقاتی</span>
                    <span>پژوهش دانشگاهی</span>
                </div>
            </article>
        </main>
    </div>

    <button class="back-to-top" id="backToTop" aria-label="بازگشت به بالا">↑</button>

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

            var backBtn = document.getElementById('backToTop');
            function toggleBackBtn() {
                if (!backBtn) return;
                backBtn.classList.toggle('visible', window.pageYOffset > 500);
            }
            if (backBtn) {
                backBtn.addEventListener('click', function () {
                    window.scrollTo({ top: 0, behavior: 'smooth' });
                });
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
                        toggleBackBtn();
                        ticking = false;
                    });
                    ticking = true;
                }
            }, { passive: true });

            updateProgress();
            toggleBackBtn();
        })();
    </script>

@endsection
