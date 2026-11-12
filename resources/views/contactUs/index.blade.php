@extends('layouts.home')

@php
    $locale = app()->getLocale();
    $isRtl  = in_array($locale, ['fa', 'ar'], true);
@endphp

@section('title', __('contact.title'))

@section('meta')
    <meta name="description" content="{{ __('contact.hero_description') }}">
    <meta name="robots" content="index, follow">
    <link rel="canonical" href="{{ url($locale . '/contact') }}">
    <link rel="alternate" hreflang="fa" href="{{ url('fa/contact') }}">
    <link rel="alternate" hreflang="ar" href="{{ url('ar/contact') }}">
    <link rel="alternate" hreflang="en" href="{{ url('en/contact') }}">
    <link rel="alternate" hreflang="x-default" href="{{ url('fa/contact') }}">
@endsection

@section('styles')
    <link rel="stylesheet"
          href="{{ asset('css/contact/contact.css') }}?v=3"
          media="print"
          onload="this.media='all'">
@endsection

@section('content')

    <div class="contact-page" dir="{{ $isRtl ? 'rtl' : 'ltr' }}">

        {{-- ============ HERO ============ --}}
        <section class="contact-hero">
            <div class="container">
                <div class="contact-hero-content">
                <span class="section-label">
                    <i class="bi bi-chat-dots-fill"></i>
                    {{ __('contact.label') }}
                </span>
                    <h1>{{ __('contact.hero_title') }}</h1>
                    <p>{{ __('contact.hero_description') }}</p>
                </div>
            </div>
        </section>

        {{-- ============ CONTACT INFO CARDS ============ --}}
        <section class="contact-information-section">
            <div class="container">

                <div class="section-heading">
                    <span class="section-label">{{ __('contact.info_label') }}</span>
                    <h2>{{ __('contact.info_title') }}</h2>
                    <p>{{ __('contact.info_description') }}</p>
                </div>

                <div class="contact-info-grid">

                    {{-- Address --}}
                    <a href="https://maps.google.com/?q=Hashtgerd+Industrial+Zone+Tehran"
                       target="_blank" rel="noopener"
                       class="info-card info-card--address">
                        <div class="info-card-icon">
                            <i class="bi bi-geo-alt-fill"></i>
                        </div>
                        <div class="info-card-body">
                            <span class="info-card-label">{{ __('contact.address_label') }}</span>
                            <h3>{{ __('contact.address_title') }}</h3>
                            <p>{{ __('contact.address_value') }}</p>
                        </div>
                        <span class="info-card-arrow">→</span>
                    </a>

                    {{-- Phone --}}
                    <a href="tel:+989191919885" class="info-card info-card--phone">
                        <div class="info-card-icon">
                            <i class="bi bi-telephone-fill"></i>
                        </div>
                        <div class="info-card-body">
                            <span class="info-card-label">{{ __('contact.phone_label') }}</span>
                            <h3>{{ __('contact.phone_title') }}</h3>
                            <p class="info-card-phone" dir="ltr">{{ __('contact.phone_value') }}</p>
                        </div>
                        <span class="info-card-arrow">→</span>
                    </a>

                    {{-- Working Hours --}}
                    <div class="info-card info-card--hours">
                        <div class="info-card-icon">
                            <i class="bi bi-clock-fill"></i>
                        </div>
                        <div class="info-card-body">
                            <span class="info-card-label">{{ __('contact.working_hours_label') }}</span>
                            <h3>{{ __('contact.working_hours_title') }}</h3>
                            <p>{{ __('contact.working_hours_value') }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        {{-- ============ CONTACT FORM ============ --}}
        <section class="contact-form-section">
            <div class="container">

                <div class="section-heading">
                    <span class="section-label">{{ __('contact.form_label') }}</span>
                    <h2>{{ __('contact.form_title') }}</h2>
                    <p>{{ __('contact.form_description') }}</p>
                </div>

                <div class="contact-form-wrapper">

                    @if(session('success'))
                        <div class="alert alert-success" role="alert">
                            <i class="bi bi-check-circle-fill"></i>
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger" role="alert">
                            <strong>{{ __('contact.validation.errors_title') }}</strong>
                            <ul>
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form action="{{ route('contact.store', ['locale' => $locale]) }}"
                          method="POST"
                          class="contact-form"
                          novalidate>
                        @csrf

                        <div class="form-row">
                            {{-- Name --}}
                            <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                <label for="name">{{ __('contact.name') }} <span>*</span></label>
                                <input type="text" id="name" name="name"
                                       value="{{ old('name') }}"
                                       placeholder="{{ __('contact.name_placeholder') }}">
                                @error('name')
                                <small class="form-error">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Email --}}
                            <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                <label for="email">{{ __('contact.email') }} <span>*</span></label>
                                <input type="email" id="email" name="email"
                                       value="{{ old('email') }}"
                                       placeholder="{{ __('contact.email_placeholder') }}">
                                @error('email')
                                <small class="form-error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        <div class="form-row">
                            {{-- Phone --}}
                            <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                <label for="phone">{{ __('contact.phone') }}</label>
                                <input type="text" id="phone" name="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="{{ __('contact.phone_placeholder') }}">
                                @error('phone')
                                <small class="form-error">{{ $message }}</small>
                                @enderror
                            </div>

                            {{-- Subject --}}
                            <div class="form-group {{ $errors->has('title') ? 'has-error' : '' }}">
                                <label for="subject">{{ __('contact.subject') }} <span>*</span></label>
                                <input type="text" id="subject" name="title"
                                       value="{{ old('title') }}"
                                       placeholder="{{ __('contact.subject_placeholder') }}">
                                @error('title')
                                <small class="form-error">{{ $message }}</small>
                                @enderror
                            </div>
                        </div>

                        {{-- Message --}}
                        <div class="form-group {{ $errors->has('description') ? 'has-error' : '' }}">
                            <label for="message">{{ __('contact.message') }} <span>*</span></label>
                            <textarea id="message" name="description" rows="6"
                                      placeholder="{{ __('contact.message_placeholder') }}">{{ old('description') }}</textarea>
                            @error('description')
                            <small class="form-error">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-submit">
                            <button type="submit" class="btn btn-primary" id="contact-submit-btn">
                                {{ __('contact.submit') }}
                                <i class="bi bi-send-fill"></i>
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </section>

        {{-- ============ CTA ============ --}}
        <section class="contact-cta">
            <div class="container">
                <div class="contact-cta-content">
                    <span class="section-label">{{ __('contact.cta_label') }}</span>
                    <h2>{{ __('contact.cta_title') }}</h2>
                    <p>{{ __('contact.cta_description') }}</p>

                    <a href="tel:+989191919885" class="btn btn-outline">
                        <i class="bi bi-telephone-fill"></i>
                        {{ __('contact.call_us') }}
                    </a>
                </div>
            </div>
        </section>

    </div>

@endsection
