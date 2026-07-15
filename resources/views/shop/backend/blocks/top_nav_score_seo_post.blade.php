@php
use App\Helpers\MyFunction;
@endphp
<!-- Navbar -->
<nav class="main-header navbar navbar-expand-md navbar-white">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#"
                role="button"><i class="fas fa-bars" style="color: #212529;"></i></a>
        </li>
        <li class="nav-item d-none d-md-block">
            <a class="nav-link text-uppercase"><strong>{{$pageTitle}}</strong></a>
        </li>
    </ul>
    <div data-analyze-url="{{ route('admin.article-seo-score.analyze') }}" data-csrf="{{ csrf_token() }}">
        <div class="d-flex align-items-center justify-content-between">
            <strong class="mr-2">Thang điểm SEO:</strong>
            <div>
                <span id="article-seo-score-circle" class="badge" style="font-size:16px;padding:6px 14px;border-radius:20px;">--/100</span>
            </div>
        </div>
    </div>
    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        @if (Session::has('user'))
        @php
        $user = Session::get('user');
        $fullName = $user->fullname;
        @endphp
        <li class="nav-item dropdown user-menu">
            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">
                <span class="d-none d-md-inline">{{$fullName}}</span>
            </a>
            <ul class="dropdown-menu dropdown-menu-right">
                <a class="dropdown-item" href="#">@lang('lang.account')</a>
                <a class="dropdown-item" href="{{route('user.logout')}}">@lang('lang.log_out')</a>
            </ul>
        </li>
        @endif
    </ul>
</nav>