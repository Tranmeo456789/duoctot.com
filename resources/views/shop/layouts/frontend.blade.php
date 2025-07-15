@php
    $title = $item['name'] ?? $item['title'] ?? $title ?? 'DƯỢC TỐT là Nền tảng kết nối y dược nhà thuốc, phòng khám , bệnh nhân với công ty dược và thực phẩm chức năng uy tín nhất Việt nam';
    $imageItem = $item['image'] ?? 'images/shop/logo-favicon.png';
    $description = $item['description'] ?? $item['meta_description'] ?? 'DƯỢC TỐT là Nền tảng kết nối y dược nhà thuốc, phòng khám , bệnh nhân với công ty dược và thực phẩm chức năng uy tín nhất Việt nam.';
    $metaKeywords = $item['meta_keywords']?? 'Shop trực tuyến, mua hàng online, tư vấn dược phẩm, giao hàng tận nhà, giảm đau, vitamin bổ sung';
@endphp
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="description" content="{{ $description }}">
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="google-site-verification" content="SF3DQyzJn3obwShXlf3gfh6NC1HX20ronORFCHD5y8g" />
    <!-- Favicon đầy đủ -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-96x96.png') }}">
    <link rel="icon" type="image/png" sizes="192x192" href="{{ asset('web-app-manifest-192x192.png') }}">
    <link rel="icon" type="image/png" sizes="512x512" href="{{ asset('web-app-manifest-512x512.png') }}">
    <link rel="icon" type="image/svg+xml" href="{{ asset('favicon.svg') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <meta name="theme-color" content="#ffffff">
    <!-- Open Graph -->
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:description" content="{{ $description }}">
    <meta property="og:image" content="{{ asset($imageItem) }}">
    <meta property="og:image:width" content="300">
    <meta property="og:image:height" content="300">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $title }}" />
    <meta name="twitter:description" content="{{ $description }}" />
    <meta name="twitter:image" content="{{ asset($imageItem) }}">
    <meta name="twitter:url" content="{{ url()->current() }}">
    <!-- Geo -->
    <meta name="geo.region" content="VN-HN">
    <meta name="geo.placename" content="Hà Nội">
    <meta name="geo.position" content="21.024359;105.841175">
    <meta name="ICBM" content="21.024359, 105.841175"> 
    <title>{{ $title }}</title>
    <!-- JSON-LD: Search Schema -->
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "url": "https://duoctot.com",
            "potentialAction": {
                "@type": "SearchAction",
                "target": {
                    "@type": "EntryPoint",
                    "urlTemplate": "https://duoctot.com/tim-kiem?s={search_term_string}"
                },
                "query-input": "required name=search_term_string"
            }
        }
    </script>
    <!-- JSON-LD: Logo Schema -->
    <script id="logo-organization-script" type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "url": "https://duoctot.com",
            "logo": "https://duoctot.com/images/shop/logo-favicon.png"
        }
    </script>
    @include('shop.frontend.block.head')
    @yield('headadd')
</head>
<body>
    <div id="site">
        <div id="container">
            @include('shop.frontend.block.menu.menu_no_search')
            <div id="main-content-wp" class="home-page clearfix">
                @yield('content')
            </div>
            <div id="footer-wp" class="pb-5">
                @include('shop.frontend.block.footer')
            </div>
        </div>
        <div id="box-search-fixed">
            @include('shop.frontend.block.box_responsive.box_search_responsive')
        </div>
        <div id="fixscreen-respon"></div>
        <div class="black-screen"></div>
        @include('shop.frontend.block.spinner_screen')
        @include("$moduleName.block.social_media")
    </div>
    @include('shop.frontend.block.script')
    @yield('scriptadd')
</body>
@if(isset($formRegister) && $formRegister==1)
    <style>
        .form-login {display: block;}
        .black-screen{display: block}
    </style>
@endif
</html>
