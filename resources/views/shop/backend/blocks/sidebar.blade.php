<!-- sidebar: style can be found in sidebar.less -->
<!-- Brand Logo -->
<a href="{{ route('dashboard') }}" class="brand-link">
    <img src="{{asset('shop/images/logo.png')}}" alt="Tdoctor" class="brand-image img-fluid">
</a>
<div class="sidebar" >
    <!-- Sidebar Menu -->
    <nav>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="far fa-list-alt nav-icon"></i>
                    <p>Thống kê bán hàng</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-chalkboard-teacher"></i>
                    <p>
                        Hồ sơ
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('profile.info')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thông tin tài khoản</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('profile.password')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Đổi mật khẩu</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('profile.setting')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thiết lập khác</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{ route('catProduct') }}" class="nav-link">
                    <i class="nav-icon fas fa-wallet"></i>
                    <p>Danh mục thuốc</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-dumpster-fire"></i>
                    <p>
                        Quản lý thuốc
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('product')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách thuốc</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('unit')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Đơn vị tính</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('trademark')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Thương hiệu thuốc</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('producer')}}" class="nav-link">
                    <i class="nav-icon fas fa-box-tissue"></i>
                    <p>Quản lý Nhà sản xuất</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-gifts"></i>
                    <p>
                        Quản lý đơn hàng
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('order.list')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách đơn hàng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('invoice.list')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách hóa đơn</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('consignment.list')}}" class="nav-link">
                    <i class="nav-icon fas fa-file-alt"></i>
                    <p>Phiếu gửi hàng</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-store"></i>
                    <p>
                        Kho hàng
                        <i class="right fas fa-angle-left"></i>
                    </p>
                </a>
                <ul class="nav nav-treeview">
                <li class="nav-item">
                        <a href="{{route('qlwarehouse')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Quản lý kho hàng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('warehouse')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách kho hàng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('warehouse.import')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Phiếu nhập kho</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('warehouse')}}" class="nav-link">
                    <i class="nav-icon fas fa-bullhorn"></i>
                    <p>Khuyến mãi</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('customer')}}" class="nav-link">
                    <i class="nav-icon fas fa-person-booth"></i>
                    <p>Quản lý khách hàng</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-id-card-alt"></i>
                    <p>Quản lý gian hàng</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link">
                    <i class="nav-icon fas fa-user-md"></i>
                    <p>  Hỗ trợ</p>
                </a>
            </li>
        </ul>
    </nav>
</div>
<!-- /.sidebar -->
