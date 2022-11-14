<!DOCTYPE html>
<html>

<head>
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
    </div>
</body>
@include('shop.frontend.block.script')

</html>