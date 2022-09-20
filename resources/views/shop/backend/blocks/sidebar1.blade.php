<div id="logo-admin" class="position-relative">
    <a href="{{route('dashboard')}}">
        <img src="{{ asset('/shop/images/logo.png')}}" alt="" srcset="" class="img-fluid">
    </a>
    <div class="hide-sidebar" id="hide-sidebar"><i class="fas fa-times"></i></div>
</div>
<ul id="sidebar-menu">
    <li class="nav-link {{$module_active=='dashboard'?'active':''}}">
        <a href="{{route('dashboard')}}">
            <div class="nav-link-icon d-inline-flex">
                <i class="fas fa-building"></i>
            </div>
            Thống kê bán hàng
        </a>
    </li>
    <li class="nav-link {{$module_active=='profile'?'active':''}}">
        <a href="#" class="nav-link">
            <i class="fas fa-chalkboard-teacher"></i>
            <p>
                Hồ sơ
                <i class="fas fa-angle-left right"></i>
                <i class="arrow fas {{$module_active=='profile'?'fa-angle-down':'fa-angle-right'}}"></i>
            </p>
        </a>

        <ul class="sub-menu">
            <li><a href="{{route('profile.info')}}">Thông tin người bán</a></li>
            <li><a href="{{route('profile.password')}}">Đổi mật khẩu</a></li>
            <li><a href="{{route('profile.setting')}}">Thiết lập khác</a></li>
        </ul>
    </li>
    <li class="nav-link {{$module_active=='catproduct'?'active':''}}">
        <a href="{{route('cat_product')}}">
            <div class="nav-link-icon d-inline-flex">
                <i class="fas fa-wallet"></i>
            </div>
            Danh mục thuốc
        </a>
    </li>
    <li class="nav-link {{$module_active=='product'?'active':''}}">
        <a href="{{route('product')}}">
            <div class="nav-link-icon d-inline-flex">
                <i class="fas fa-dumpster-fire"></i>
            </div>
            Quản lý thuốc
        </a>
        <i class="arrow fas {{$module_active=='product'?'fa-angle-down':'fa-angle-right'}}"></i>
        <ul class="sub-menu">
            <li><a href="{{route('product')}}">Danh sách thuốc</a></li>
            <li><a href="{{route('unit')}}">Đơn vị tính</a></li>
            <li><a href="{{route('trademark')}}">Thương hiệu thuốc</a></li>
        </ul>
    </li>
    <li class="nav-link {{$module_active=='producer'?'active':''}}">
        <a href="{{route('producer')}}">
            <div class="nav-link-icon d-inline-flex">
                <i class="fas fa-box-tissue"></i>
            </div>
            Quản lý nhà sản xuất
        </a>
    </li>
    <li class="nav-link {{$module_active=='order'?'active':''}}">
        <a href="{{route('order.list')}}">
            <div class="nav-link-icon d-inline-flex">
                <i class="fas fa-gifts"></i>
            </div>
            Quản lý đơn hàng
        </a>
        <i class="arrow fas {{$module_active=='order'?'fa-angle-down':'fa-angle-right'}}"></i>
        <ul class="sub-menu">
            <li><a href="{{route('order.list')}}">Danh sách đơn hàng</a></li>
            <li><a href="{{route('invoice.list')}}">Danh sách hóa đơn</a></li>
        </ul>
    </li>
    <li class="nav-link {{$module_active=='consignment'?'active':''}}">
        <a href="{{route('consignment.list')}}">
            <div class="nav-link-icon d-inline-flex">
                <i class="fas fa-file-alt"></i>
            </div>
            Phiếu gửi hàng
        </a>
    </li>
    <li class="nav-link {{$module_active=='warehouse'?'active':''}}">
        <a href="{{route('qlwarehouse')}}">
            <div class="nav-link-icon d-inline-flex">
                <i class="fas fa-store"></i>
            </div>
            Quản lý kho
        </a>
        <i class="arrow fas {{$module_active=='warehouse'?'fa-angle-down':'fa-angle-right'}}"></i>
        <ul class="sub-menu">
            <li><a href="{{route('warehouse')}}">Danh sách kho hàng</a></li>
        </ul>
    </li>
    <li class="nav-link">
        <a href="">
            <div class="nav-link-icon d-inline-flex">
                <i class="fas fa-bullhorn"></i>
            </div>
            Khuyến mãi
        </a>
    </li>
    <li class="nav-link {{$module_active=='customer'?'active':''}}">
        <a href="{{route('customer')}}">
            <div class="nav-link-icon d-inline-flex">
                <i class="fas fa-person-booth"></i>
            </div>
            Quản lý khách hàng
        </a>

    </li>
    <li class="nav-link">
        <a href="">
            <div class="nav-link-icon d-inline-flex">
                <i class="fas fa-id-card-alt"></i>
            </div>
            Quản lý gian hàng
        </a>
    </li>
    <li class="nav-link">
        <a href="">
            <div class="nav-link-icon d-inline-flex">
                <i class="fas fa-user-md"></i>
            </div>
            Hỗ trợ
        </a>
    </li>
</ul>