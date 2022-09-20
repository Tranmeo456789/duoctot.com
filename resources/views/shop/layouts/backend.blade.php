<!DOCTYPE html>
<html>
<head>
    @include("$moduleName.blocks.head")
    @stack('additionalResources')
</head>
<body class="sidebar-mini layout-fixed layout-navbar-fixed">
    <div class="wrapper">
        @include("$moduleName.blocks.top_nav")
        <aside class="main-sidebar elevation-4 my-sidebar">
            @include("$moduleName.blocks.sidebar")
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
