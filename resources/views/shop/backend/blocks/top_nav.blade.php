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
        @if (Auth::check())
            @php
                $user = Auth::user();
                // asset("fileUpload/user/" . $user->avatar)  ;
                $fullName = $user->fullName;
            @endphp
            <li class="nav-item dropdown user-menu">
                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <!-- <img src="{{$avatar}}" class="user-image img-circle elevation-2" alt="User Image"> -->
                <span class="d-none d-md-inline">{{ $fullName }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                    <!-- Menu Footer-->
                    <li class="user-footer">
                        <a href="{{route('user/user-info',['id'=>$user->id])}}" class="btn btn-primary btn-flat">Thông tin cá nhân</a>
                        <a href="{{route('auth/adminLogout')}}" class="btn btn-danger btn-flat float-right">Đăng xuất</a>
                    </li>
                </ul>
            </li>
        @endif
    </ul>
</nav>