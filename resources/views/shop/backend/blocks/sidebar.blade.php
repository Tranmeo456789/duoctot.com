<!-- sidebar: style can be found in sidebar.less -->
<!-- Brand Logo -->
@if(!Session::has('web_view')) 
<a href="{{route('home')}}" class="brand-link">
    <img src="{{asset('shop/images/logo.png')}}" alt="Tdoctor" class="brand-image img-fluid">
</a>
@endif
<div class="sidebar">
    <!-- Sidebar Menu -->
    <nav>
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            @if (((Session::has('user') && Session::get('user')['user_type_id'] > 1)) || ((Session::has('user') && Session::get('user')['is_admin'] == 1)) )
            <li class="nav-item">
                <a href="{{ route('dashboard') }}" class="nav-link">
                    <i class="far fa-list-alt nav-icon"></i>
                    <p>Thống kê</p>
                </a>
            </li>
            @endif
           
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
                        <a href="{{ route('profile.infoBank') }}" class="nav-link">
                            <i class="fas fa-money-check-alt nav-icon"></i>
                            <p>TK ngân hàng</p>
                        </a>
                    </li>
                </ul>
            </li>
            @if (Session::has('user') && Session::get('user')['is_admin'] != 1)
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-external-link-square-alt"></i>
                        <p>Affiliate<i class="right fas fa-angle-left"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <!-- <li class="nav-item">
                            <a href="{{ route('affiliate.dashboardRef') }}" class="nav-link">
                                <i class="fas fa-columns nav-icon"></i>
                                <p>Tổng quan</p>
                            </a>
                        </li> -->
                        <li class="nav-item">
                            <a href="{{ route('affiliate.userImportCodeAffiliate') }}" class="nav-link">
                                <i class="far fa-list-alt nav-icon"></i>
                                <p>User nhập mã affiliate</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('affiliate.refAffiliate') }}" class="nav-link">
                                <i class="far fa-list-alt nav-icon"></i>
                                <p>Danh sách SP affiliate</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if ((Session::has('user') && Session::get('user')['is_admin'] == 1) || (Session::has('user') && Session::get('user')['is_admin'] == 2) )         
            <li class="nav-item">
                <a href="{{ route('catProduct') }}" class="nav-link">
                    <i class="nav-icon fas fa-wallet"></i>
                    <p>Danh mục thuốc</p>
                </a>
            </li>
            <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-wallet"></i>
                        <p>
                            Tin tức
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('catalog')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh mục bài viết</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{route('post')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách bài viết</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if (Session::has('user'))
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-first-order"></i>
                        <p>
                            Quản lý đơn hàng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('order')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Danh sách đơn hàng</p>
                            </a>
                        </li>
                        <!-- <li class="nav-item">
                            <a href="{{route('prescrip')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Thuốc theo toa</p>
                            </a>
                        </li> -->
                    </ul>
                </li>
            @endif
            @if ((Session::has('user') && Session::get('user')['user_type_id'] > 1 && Session::get('user')['user_type_id'] <= 10)) 
                <li class="nav-item has-treeview">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fab fa-product-hunt"></i>
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
                        <i class="nav-icon fas fa-record-vinyl"></i>
                        <p>Quản lý Nhà sản xuất</p>
                    </a>
                </li>
                <li class="nav-item d-none">
                    <a href="{{route('consignment.list')}}" class="nav-link">
                        <i class="nav-icon fas fa-file-alt"></i>
                        <p>Phiếu gửi hàng</p>
                    </a>
                </li>
                <li class="nav-item has-treeview">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-weight"></i>
                        <p>
                            Kho hàng
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{route('warehouse.info')}}" class="nav-link">
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
                            <a href="{{route('importCoupon')}}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Phiếu nhập kho</p>
                            </a>
                        </li>
                    </ul>
                </li>
            @endif
            @if ((Session::has('user') && Session::get('user')['is_admin'] == 1) || (Session::has('user') && Session::get('user')['is_admin'] == 2))
            <li class="nav-item">
                <a href="{{route('admin.product.list')}}" class="nav-link">
                    <i class="nav-icon fab fa-product-hunt"></i>
                    <p>Quản lý Thuốc <i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('admin.product.list')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách thuốc</p>
                        </a>
                    </li>
                    @if ((Session::has('user') && Session::get('user')['is_admin'] == 1))
                    <li class="nav-item">
                        <a href="{{route('admin.product')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Quản lý chung</p>
                        </a>
                    </li>
                    @endif
                </ul>
            </li>
            @endif
            @if ((Session::has('user') && Session::get('user')['is_admin'] == 1))
            <li class="nav-item">
                <a href="{{route('order')}}" class="nav-link">
                    <i class="nav-icon fab fa-first-order"></i>
                    <p>Quản lý đơn hàng<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('order')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Danh sách đơn hàng</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('admin.order')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Quản lý chung</p>
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.revenue')}}" class="nav-link">
                    <i class="nav-icon fas fa-search-dollar"></i>
                    <p>Quản lý doanh thu</p>
                </a>
            </li>
            <div class="nav-item">
                <a href="{{route('admin.warehouse')}}" class="nav-link">
                    <i class="nav-icon fas fa-weight"></i>
                    <p>Kho hàng</p>
                </a>
            </div>
            <li class="nav-item">
                <a href="{{route('user')}}" class="nav-link">
                    <i class="nav-icon fas fa-users"></i>
                    <p>Quản lý Người dùng</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('admin.customer')}}" class="nav-link">
                <i class="nav-icon fas fa-user-friends"></i>
                    <p>Quản lý khách hàng</p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('editor')}}" class="nav-link">
                    <i class="nav-icon fas fa-user-edit"></i>
                    <p>Quản lý Editor</p>
                </a>
            </li>
            <!-- <li class="nav-item">
                <a href="" class="nav-link">
                    <i class="nav-icon fas fa-external-link-square-alt"></i>
                    <p>Affiliate<i class="right fas fa-angle-left"></i></p>
                </a>
                <ul class="nav nav-treeview">
                    <li class="nav-item">
                        <a href="{{route('affiliate')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>Quản lý chung</p>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a href="{{route('couponPayment')}}" class="nav-link">
                            <i class="far fa-circle nav-icon"></i>
                            <p>DS phiếu thanh toán</p>
                        </a>
                    </li>
                </ul>
            </li> -->
            @endif
            <!-- <li class="nav-item">
                <a href="{{route('user.logout')}}" class="nav-link">
                    <i class="nav-icon fas fa-sign-out-alt"></i>
                    <p>Đăng xuất</p>
                </a>
            </li> -->
        </ul>
    </nav>
</div>
<!-- /.sidebar -->