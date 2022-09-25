<!DOCTYPE html>
<html>
<head>
    @include("shop.backend.blocks.head")
    @stack('additionalResources')
</head>
<body class="sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        @include("shop.backend.blocks.top_nav")
        <aside class="main-sidebar elevation-4 my-sidebar">
            @include("shop.backend.blocks.sidebar")
        </aside>
        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper" id="content-wrapper">
            @yield('content')
        </div>
        @include('shop.backend.blocks.modal')
    </div>
    @include("$moduleName.blocks.script")
    @stack('additionalJS')
</body>
</html>
