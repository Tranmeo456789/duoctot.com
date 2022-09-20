<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"
                role="button"><i class="fas fa-bars" style="color: #212529;"></i></a>
        </li>
        <li class="nav-item d-none d-md-block">
            <a class="nav-link text-uppercase"><strong>@yield('header_title')</strong></a>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @if (!Session::has('user'))
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                    <span class="d-none d-md-inline">Nguyễn Trường Giang</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <a class="dropdown-item" href="#">Tài khoản</a>
                    <a class="dropdown-item" href="{{route('user.logout')}}">Thoát</a>
                </ul>
            </li>
        @endif
    </ul>
</nav>