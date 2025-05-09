@php
    $title = $item['name'] ?? $item['title'] ?? $title ?? 'Sàn thương mại điện tử trong y dược số 1 Việt Nam';
    $imageItem = $item['image'] ?? 'images/shop/favicon.png';
    $description = $item['description'] ?? $item['meta_description'] ?? 'Tdoctor là một giải pháp cho các nhà thuốc, các doanh nghiệp, công ty dược phẩm tăng doanh thu một cách nhanh chóng.';
    $metaKeywords = $item['meta_keywords']?? 'Shop trực tuyến, mua hàng online, tư vấn dược phẩm, giao hàng tận nhà, giảm đau, vitamin bổ sung';
@endphp
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="{{$description}}">
    <meta property="og:title" content="{{ $title }}">
    <meta property="og:image" content="{{ asset($imageItem) }}">
    <meta property="og:description" content="{{$description}}">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image" />
    <meta name="twitter:title" content="{{ $title }}" />
    <meta name="twitter:description" content="{{$description}}" />
    <meta name="twitter:image" content="{{ asset($imageItem) }}" />
    <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "WebSite",
            "url": "https://tdoctor.net",
            "potentialAction": {
            "@type": "SearchAction",
            "target": {
                "@type": "EntryPoint",
                "urlTemplate": "https://tdoctor.net/tim-kiem?s={search_term_string}"
            },
            "query-input": "required name=search_term_string"
            }
        }
    </script>
    <script id="logo-organization-script" type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Organization",
            "url": "https://tdoctor.net",
            "logo": "https://tdoctor.net/images/shop/favicon.png"
        }
    </script>
    <meta name="keywords" content="{{ $metaKeywords }}">
    <meta name="google-site-verification" content="SF3DQyzJn3obwShXlf3gfh6NC1HX20ronORFCHD5y8g" />
    <title>{{$title}}</title>
    <link rel="icon" href="{{ asset('images/shop/favicon.png') }}" type="image/png">
    @include('shop.frontend.block.head')
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
