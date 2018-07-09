<!DOCTYPE html>
<html lang="{{ locale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@if(!empty($metaTitle)){{ $metaTitle }} -@endif @lang('layout.title')</title>
    <meta name="description" content="{{ $metaDescription }}">

    <meta property="og:title" content="@if(!empty($metaTitle)){{ $metaTitle }} -@endif @lang('layout.title')">
    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:image" content="{{ asset('/assets/open/images/og-image.jpg') }}">
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:type" content="website" />

    <link rel="stylesheet" href="{{ mix('/assets/open/css/app.css') }}">
    <script src="{{ mix('/assets/open/js/app.js') }}"></script>

    @include('open._layouts._partials.favicons')

    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
          new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
        j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
        'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
      })(window,document,'script','dataLayer','GTM-ID');</script>
    <!-- End Google Tag Manager -->
</head>
<body @if(!empty($bodyClass)) class="{{ $bodyClass }}" @endif>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-ID"
                  height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

    <header class="Header" id="js-header">

        <nav class="Header__main-navigation">
            <ul>
                @foreach($mainNavigation as $slug => $label)
                    <li><a href="#section-{{ $slug }}" class="js-smooth-scrolling">{{ $label }}</a></li>
                @endforeach
            </ul>
        </nav>
        <div class="Header__switch-language">
            <nav class="c-dropdown js-dropdown" tabindex="1">
                <em class="c-dropdown__current">{{ config('app.locale') }}</em>
                <ul class="c-dropdown__slide">
                    @foreach(config('app.locales') as $locale)
                        @if(config('app.locale') != $locale)
                            <li><a href="/{{ $locale }}">{{ $locale }}</a></li>
                        @endif
                    @endforeach
                </ul>
            </nav>
        </div>
        <a href="javascript:void(0);" class="Header__responsive-navigation-toggle js-openResponsiveHeader">
            <i class="fa fa-bars"></i>
        </a>
    </header>

    <div class="Document">
    {!! $slot !!}
    </div>

    <footer class="Footer">
        <div class="container">
            <p class="Footer__credits">
                Copyright © {{date('Y')}} @lang('layout.footer.credits', ['legal' => '', 'privacy' => '','cookies' => ''])
            </p>
        </div>
    </footer>

    @include('open._layouts._partials.cookieBar')
    @include('open._layouts._partials.videoModal')
    @include('open._layouts._partials.footerScripts')
</body>
</html>