@php
$title = $title ?? 'Sàn thương mại điện tử trong y số 1 Việt Nam';
@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="google-site-verification" content="SF3DQyzJn3obwShXlf3gfh6NC1HX20ronORFCHD5y8g" />
    <title>{{$title}}</title>
    <link rel="icon" href="{{ asset('images/shop/favicon.jpg') }}" type="image/jpeg">
    @include('shop.frontend.block.head')
</head>

<body>
    <div id="site">
        <div id="container">
            @include('shop.frontend.block.menu.menu_yes_search')
            <div id="main-content-wp" class="home-page clearfix">
                @yield('content')
                <div class="lc-mask-search"></div>
            </div>
            <div id="footer-wp" class="pb-5">
                @include('shop.frontend.block.footer')
            </div>
        </div>
        <div id="box-search-fixed">
            @include('shop.frontend.block.box_responsive.box_search_responsive')
        </div>
        <div id="fixscreen-respon"></div>
        @include('shop.frontend.block.spinner_screen')
    </div>
</body>
@include('shop.frontend.block.script')

</html>