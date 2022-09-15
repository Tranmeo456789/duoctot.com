<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="#">
    <link rel="stylesheet" href="{{ asset('/shop/backend/css/reset.css')}}?t=@php echo time() @endphp">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/css/solid.min.css">
    <link rel="stylesheet" href="{{ asset('/shop/backend/css/style.css')}}?t=@php echo time() @endphp">
    <link rel="stylesheet" href="{{ asset('/shop/backend/css/product.css')}}?t=@php echo time() @endphp">
    <link rel="stylesheet" href="{{ asset('/shop/backend/css/order.css')}}?t=@php echo time() @endphp">
    <link rel="stylesheet" href="{{ asset('/shop/backend/css/modal.css')}}?t=@php echo time() @endphp">
    <link rel="stylesheet" href="{{ asset('/shop/backend/css/responsive.css')}}?t=@php echo time() @endphp">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.css">
    <link rel="stylesheet" href="{{ asset('/shop/backend/css/dropzone.css')}}?t=@php echo time() @endphp">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <title>@yield('title')</title>
</head>
@php
$module_active=session('module_active');
@endphp
<body>
    <div id="warpper" class="nav-fixed">
        <div id="wp-opacity"></div>
        <div id="page-body" class="d-flex">
            <div id="sidebar" style="background-color: #def3d4;">
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
                    <li class="nav-link {{$module_active=='sellerprofile'?'active':''}}">
                        <a href="{{route('seller.info')}}">
                            <div class="nav-link-icon d-inline-flex">
                                <i class="fas fa-chalkboard-teacher"></i>
                            </div>
                            Hồ sơ
                        </a>
                        <i class="arrow fas {{$module_active=='sellerprofile'?'fa-angle-down':'fa-angle-right'}}"></i>
                        <ul class="sub-menu">
                            <li><a href="{{route('seller.info')}}">Thông tin người bán</a></li>
                            <li><a href="{{route('seller.password')}}">Đổi mật khẩu</a></li>
                            <li><a href="{{route('seller.setting')}}">Thiết lập khác</a></li>
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
            </div>
            <div id="wp-content">
                <div class="container-fluid px-0 position-relative">
                    <div class="header-content fixed-titleuserres">
                        <div class="btnvis-sidebar"><i class="fas fa-arrow-circle-right"></i></div>
                        <h3 class="header-title">@yield('header_title')</h3>
                        <div class="header-content-left">
                            @if(Session::has('islogin'))
                            <div class="item-header-content">
                                <div class="btn-group">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-user-circle"></i>
                                        {{Session::get('name')}}
                                    </button>
                                    <div class="dropdown-menu dropdown-menu-right">
                                        <a class="dropdown-item" href="#">Tài khoản</a>
                                        <a class="dropdown-item" href="{{route('user.logoutbe')}}">Thoát</a>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="item-header-content">
                                <div class="btn-group">
                                    <button type="button" class="btn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        <i class="fas fa-user-circle"></i>
                                        Chưa đăng nhập
                                    </button>

                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="body-content">
                        @yield('body_content')
                    </div>
                </div>
            </div>
        </div>
        @include('shop.backend.blocks.modal')
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/gh/bbbootstrap/libraries@main/choices.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="{{asset('/shop/backend/js/app.js')}}?t=@php echo time() @endphp"></script>
    <script src="{{asset('/shop/backend/js/modal.js')}}?t=@php echo time() @endphp"></script>
    <script src="{{asset('/shop/backend/js/modal_product.js')}}?t=@php echo time() @endphp"></script>
    <script src="{{asset('/shop/backend/js/dropzone.js')}}?t=@php echo time() @endphp"></script>
    <script src="{{asset('/shop/backend/js/my-js.js')}}?t=@php echo time() @endphp"></script>
    <script src="https://cdn.tiny.cloud/1/cilgdefwwpjwph4t9r56jwn4kf0yp1sqhhl0l0sf7z400bng/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        tinymce.init({
            selector: '#mytextarea',
            height: 300,
            plugins: [
                'advlist autolink link image lists charmap print preview hr anchor pagebreak',
                'searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking',
                'table emoticons template paste help'
            ],
            toolbar: 'undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | ' +
                'bullist numlist outdent indent | link image | print preview media fullscreen | ' +
                'forecolor backcolor emoticons | help',
            menu: {
                favs: {
                    title: 'My Favorites',
                    items: 'code visualaid | searchreplace | emoticons'
                }
            },
            menubar: 'favs file edit view insert format tools table help',
            content_css: 'css/content.css'
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#submit-all1').click(function() {
                var x = document.getElementsByClassName("name-img");
                var name_img = [];
                for (i = 0; i < x.length; i++) {
                    name_img[i] = x[i].innerHTML;
                }
                var id_product = $('input[name="id_product"]').val();;
                var _token =
                    $.ajaxSetup({
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        }
                    });
                var _token = $('input[name="_token"]').val();
                event.preventDefault();
                $.ajax({
                    url: "{{route('dropzone.upload')}}",
                    method: 'POST',
                    dataType: 'json',
                    data: {
                        name_img: name_img,
                        _token: _token,
                        id_product: id_product,
                    },
                    success: function(data) {
                        $('#list-img').html(data.list_img);
                        //console.log(data.img);
                    }
                });
            });
            $('.choose1').change(function() {
                var action = $(this).attr('id');
                var maid = $(this).val();
                var _token = $('input[name="_token"]').val();
                var result = '';
                if (action == 'city') {
                    result = 'province';
                } else {
                    result = 'wards';
                }
                $.ajax({
                    url: "{{route('locationAjax')}}",
                    method: "POST",
                    dataType: 'html',
                    data: {
                        action: action,
                        maid: maid,
                        _token: _token
                    },
                    success: function(data) {
                        $('#' + result).html(data);
                    },
                });
            });
            $('.js-select2').select2();
            $('.nav-link.active .sub-menu').slideDown();
        });
    </script>
</body>

</html>