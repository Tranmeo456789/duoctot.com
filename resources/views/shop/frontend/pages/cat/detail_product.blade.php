@extends('shop.layouts.frontend')

@section('content')
<div class="wp-inner mt-2">
    <div class="" id="breadcrumb-wp">
        @include("$moduleName.pages.$controllerName.child_index.breadcrumb_detail")
    </div>
    <div id="detail_product">
        <div class="row">
            <div class="col-md-5">
                <div class="demo">
                    <div class="item">
                        <div class="clearfix" style="max-width:474px;">
                            <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                
                                <li data-thumb="{{asset($productcs['image'])}}">
                                    <img src="{{asset($productcs['image'])}}"/>
                                </li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="title_product">
                    <p class="trademark_product">Thương hiệu: <span class="text-info">{{$productcs->trademarkProduct->name}}</span></p>
                    <h1>{{$productcs['name']}}</h1>
                    <div class="comment d-flex justify-content-between flex-wrap">
                        @if(isset($productcs->userProduct))
                        <span class="text-muted">({{$productcs->userProduct->user_id}})</span>
                        @else
                        <span class="text-muted">00000000000</span>
                        @endif
                        <div class="position-relative">
                            <span class="">
                                <img src="{{asset('images/shop/star.png')}}" alt="">
                                <img src="{{asset('images/shop/star.png')}}" alt="">
                                <img src="{{asset('images/shop/star.png')}}" alt="">
                                <img src="{{asset('images/shop/star.png')}}" alt="">
                                <img src="{{asset('images/shop/star.png')}}" alt="">
                            </span>
                            <span class="text-muted">
                                3 Đánh giá | 138 Bình luận
                            </span>
                        </div>
                    </div>
                </div>
                <div class="desc_product">
                    <div class="price_product mb-2"><span class="font-weight-bold">{{ number_format( $productcs['price'], 0, "" ,"." )}}đ /</span> {{$productcs->unitProduct->name}}</div>
                    <p><span class="font-weight-bold bcn">Danh mục: </span><span class="text-info">{{$productcs->catProduct->name}}</span></p>
                    <p><span class="font-weight-bold">Dạng bào chế: </span>{{$productcs['dosage_forms']}}</p>
                    <p><span class="font-weight-bold">Quy cách: </span>{{$productcs['specification']}}</p>
                    <p><span class="font-weight-bold">Xuất xứ thương hiệu: </span>{{$productcs->countryProduct->name}}</p>
                    <p><span class="font-weight-bold">Nước sản xuất: </span>{{$productcs->countryProduct->name}}</p>
                    <p><span class="font-weight-bold">Công dụng: </span>{{$productcs['benefit']}}</p>
                </div>
                <div class="payment position-relative">
                    <h2>Thanh toán VNPAY-QR</h2>
                    <p>Nhập mã VNPAYLC giảm ngay 3% tối đa 50,000đ khi thanh toán 100% qua VNPAY-QR <a href="">Xem chi tiết</a></p>
                    <div class="payment-img"><img src="{{asset('images/shop/vnpay.png')}}" alt=""></div>
                </div>
                <form action="" method="POST">
                    {!! csrf_field() !!}
                    <div class="input-number">
                        <span class="seclect-number" data-id="{{$productcs['id']}}">Chọn số lượng</span>
                        <span class="pm11">
                            <span title="" class="minus1"><i class="fa fa-minus"></i></span>          
                            <input type="number" name="number_perp" min="1" value="1" class="num-order">
                            <span title="" class="plus1"><i class="fa fa-plus"></i></span>
                        </span>
                    </div>
                    <div class="btn-buy-search d-flex justify-content-between flex-wrap">
                        <span name="btn_selectbuy"  class="btn-select-buy btn btn-primary text-light mb-xs-2">Chọn mua</span>
                        <a class="btn-search-house" href="">Tìm nhà thuốc</a>
                    </div>
                </form>
                <div class="commit-tdoctor text-center">
                    <div class="pnote-view d-flex">
                        <div>
                            <div class="roud25y-img"><img src="{{asset('images/shop/star2.png')}}" alt=""></div>
                        </div>
                        <div>
                            <span class="position-relative text-orange">Sản phẩm đang được chú ý</span>
                            <span>, có 7 người thêm vào giỏ hàng & 16 người đang xem</span>
                        </div>
                    </div>
                    <div class="commit-tdoctor-child">
                        <div class="title-commit-tdoctor text-center">
                            T doctor cam kết
                        </div>
                        <div class="content-commit-tdoctor">
                            <ul class="d-flex justify-content-between flex-wrap">
                                <li class="d-flex justify-content-center">
                                    <div>
                                        <div class="text-center"><img src="{{asset('images/shop/cm1.png')}}" alt=""></div>
                                        <h3>Đổi trả trong 30 ngày</h3>
                                        <p>kể từ ngày mua hàng</p>
                                    </div>
                                </li>
                                <li class="d-flex justify-content-center">
                                    <div>
                                        <div class="text-center"><img src="{{asset('images/shop/cm2.png')}}" alt=""></div>
                                        <h3>Đổi trả trong 30 ngày</h3>
                                        <p>kể từ ngày mua hàng</p>
                                    </div>
                                </li>
                                <div>
                                    <li class="d-flex justify-content-center">
                                        <div>
                                            <div class="text-center"><img src="{{asset('images/shop/cm3.png')}}" alt=""></div>
                                            <h3>Đổi trả trong 30 ngày</h3>
                                            <p>kể từ ngày mua hàng</p>
                                        </div>
                                    </li>
                                </div>
                            </ul>
                        </div>
                        <div class="content-commit-tdoctorrespon">
                            <ul class="">
                                <li class="pl-3 mb-2 pt-2">
                                    <div class="d-flex">
                                        <div class="roud1-img1 mr-1"><i class="fas fa-exchange-alt"></i></div>
                                        <div class=" align-items-start">
                                            <h3>Đổi trả trong 30 ngày</h3>
                                            <p>kể từ ngày mua hàng</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="pl-3 mb-2">
                                    <div class="d-flex">
                                        <div class="roud1-img1 mr-1"><i class="fas fa-thumbs-up"></i></div>
                                        <div class=" align-items-start">
                                            <h3>Miễn phí 100%</h3>
                                            <p>đổi thuốc</p>
                                        </div>
                                    </div>
                                </li>
                                <li class="pl-3">
                                    <div class="d-flex">
                                        <div class="roud1-img1 mr-1"><i class="fas fa-truck"></i></div>
                                        <div class=" align-items-start">
                                            <h3>Miễn phí vận chuyển</h3>
                                            <p>theo chính sách giao hàng</p>
                                        </div>
                                    </div>
                                </li>

                            </ul>
                        </div>
                    </div>
                    <div class="mess_free bg-orange"><a href="">Nhận tư vấn miễn phí</a><img src="{{asset('images/shop/mess.png')}}" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="short-infohr mb-3"></div>
<div class="wp-inner">
    <div id="content-detail-product" class="row">
        <div class="col-12 col-lg-3 cat-content px-0">
            <div class="main-content-product">
                <h1>Nội dung chính
                    <div class="roud-img"><img src="{{asset('images/shop/3ngang.png')}}" alt=""></div>
                </h1>
            </div>
            <ul class="list-content-product">
                <li>Mô tả sản phẩm</li>
                <li>Thành phần</li>
                <li>Công dụng</li>
                <li>Liều dùng</li>
                <li>Tác dụng phụ</li>
                <li>Lưu ý</li>
                <li>Bảo quản</li>
            </ul>
        </div>
        <div class="col-12 col-lg-9">
            <div class="title-content-detail-product d-flex justify-content-between flex-wrap">
                <h1>Mô tả sản phẩm Sâm Nhung Bổ Thận NV</h1>
                <div class="d-flex justify-content-center flex-wrap">
                    <span class="ktc">Kích thước chữ</span>
                    <span class="mdlh">
                        <a class="md" href="">Mặc định</a>
                        <a class="lh" href="">Lớn hơn</a>
                    </span>
                </div>
            </div>
            <div class="content-detail-product">
                {!!$productcs->general_info!!}
                <h2>Thành phần của Sâm nhung Bổ thận</h2>
                <table>
                    <thead>
                        <th class="pl-2 py-2">Thành phần</th>
                        <th class="text-right pr-2 py-2">Hàm lượng</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="pl-2 py-2">Nhung hươu</td>
                            <td class="text-right pr-2 py-2">2,4mg</td>
                        </tr>
                        <tr>
                            <td class="pl-2 py-2">Cao ban long</td>
                            <td class="text-right pr-2 py-2">2,4mg</td>
                        </tr>
                        <tr>
                            <td class="pl-2 py-2">Đỗ chi</td>
                            <td class="text-right pr-2 py-2">2,4mg</td>
                        </tr>
                        <tr>
                            <td class="pl-2 py-2">Hà thủ ô đỏ</td>
                            <td class="text-right pr-2 py-2">2,4mg</td>
                        </tr>
                    </tbody>
                </table>
                <h2 class="mt-2" style="font-size: 18px; font-weight: bold;">Công dụng</h2>
                <p>{{$productcs->benefit}}</p>
                <h2 class="mt-2" style="font-size: 18px; font-weight: bold;">Cách dùng</h2>
                <p>{{$productcs->dosage}}</p>
                <div class="note-product mt-2">
                    <h2 style="font-size: 18px; font-weight: bold;">Lưu ý</h2>
                    <p>{{$productcs->note}}</p>
                </div>
                <p class="font-weight-bold">
                    Bảo quản
                </p>
                <p>{{$productcs->preserve}}</p>
            </div>
        </div>
    </div>
</div>
<div class="mt-3 py-3 colorb-wp">
    <div class="wp-inner">
        <div id="product-relate">
            <div id="feature-product-wp">
                <div class="mb-3 headf position-relative pl-5">
                    <h1>Sản phẩm Liên Quan</h1>
                    <img src="{{asset('images/shop/lua1.png')}}" alt="" srcset="">
                </div>
                <div>
                    <ul class="list-item">
                        <li>
                            <a href="">
                                <div>
                                    <div class="rdimg d-flex justify-content-center"><img src="{{asset('images/shop/covid2.png')}}" alt="" srcset=""></div>
                                    <div class="pl-3">
                                        <a>Viên sủi opimax Imunity</a>
                                        <span class="text-info">115.000đ/tuýp</span>
                                        <div class="slbuy text-center mt-4"><a href="">Chọn mua</a></div>
                                    </div>
                                </div>
                            </a>
                        </li>

                    </ul>
                </div>
            </div>
        </div>
        <div class="question-often mt-3">
            <h1>
                Câu hỏi thường gặp
            </h1>
            <ul class="list-question">
                <li>
                    <h3 class="">Thực phẩm chức năng hỗ trợ sức khỏe tình dục nam giới có tác dụng gì?<img src="{{asset('images/shop/hoi.png')}}" alt="">
                        <i class="fas fa-angle-up"></i>
                    </h3>
                    <p>* Giúp kích hoạt cơ chế sản sinh Hormone sinh dục nam nội sinh một cách tự nhiên.</p>
                    <p>* Bổ thận tráng dương, tăng cường sinh lý, phục hồi khả năng sinh lý nam giới.</p>
                    <p>* Hỗ trợ điều trị rối loạn cương dương, xuất tinh sớm, di tinh, mộng tinh… làm chậm quá trình mãn dục nam.</p>
                    <p>* Giúp tăng cường lưu thông máu, tăng cường ham muốn, khắc phục tình trạng rối loạn cương dương ở nam giới.</p>
                </li>
                <li>
                    <h3 class="">Thực phẩm chức năng hỗ trợ sức khỏe tình dục nam giới có tác dụng gì?<img src="{{asset('images/shop/hoi.png')}}" alt="">
                        <i class="fas fa-angle-down"></i>
                    </h3>
                </li>
                <li>
                    <h3 class="">Thực phẩm chức năng hỗ trợ sức khỏe tình dục nam giới có tác dụng gì?<img src="{{asset('images/shop/hoi.png')}}" alt="">
                        <i class="fas fa-angle-down"></i>
                    </h3>
                </li>
            </ul>
        </div>
        <div class="question-often mt-3">
            <h1>
                Bình luận
            </h1>
            <div class="content-quest">
                <textarea name="" id="" placeholder="Nhập nội dung câu hỏi"></textarea>
                <a href="" class="btn btn-primary">Gửi bình luận</a>
            </div>
            <ul class="list-comment position-relative">
                <div class="btnselecthc">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mới nhất</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Cũ nhất</a>
                            <a class="dropdown-item" href="#">Hữu ích nhất</a>
                        </div>
                    </div>
                </div>
                <li>
                    <div class="commentq position-relative">
                        <span class="name">Trần Tùng </span><span class="text-muted">2 ngày trước</span>
                        <p>Mình mới dùng được một lọ theo chỉ dẫn uống ngày hai lần mỗi lần hai viên lúc đóinhưng được hai ba hôm mỗi lần uống thỉnh thoảng lại nổi mẩn ngứa ở hai eo lưng và sau gần sát nách</p>
                        <div class="roud-img"><img src="{{asset('images/shop/TT.png')}}" alt=""></div>
                    </div>
                    <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                    <div class="tplv">
                        <div class="commenta">
                            <span class="name">QuỳnhDT32</span><span class="cdntl">Quản trị viên</span><span class="text-muted">2 ngày trước</span>
                            <p>Chào Bạn Trịnh công bảo,Dạ sản phẩm hiện có hàng tại một số chi nhánh thuộc khu vực Thành Phố Huế gần khu vực thị xã Hương Trà ạ.Bạn vui lòng liên hệ tổng đài miễn phí 18006928 để được hỗ trợ tư vấn và đặt hàng.Thân mến!</p>
                            <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="commentq position-relative">
                        <span class="name">Võ Hùng </span><span class="text-muted">2 ngày trước</span>
                        <p>mình sử dụng hết thuốc sâm nhung bổ thận TW3 rồi qua sử dụng viên uống sâm nhung bổ thận NV này được ko ạ
                            mình sử dụng hết thuốc sâm nhung bổ thận TW3 rồi qua sử dụng viên uống sâm nhung bổ thận NV này được ko ạ
                        </p>
                        <div class="roud-img"><img src="{{asset('images/shop/VH.png')}}" alt=""></div>
                    </div>
                    <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                    <div class="tplv">
                        <div class="commenta">
                            <span class="name">QuỳnhDT32</span><span class="cdntl">Quản trị viên</span><span class="text-muted">2 ngày trước</span>
                            <p>Chào Bạn Trịnh công bảo,Dạ sản phẩm hiện có hàng tại một số chi nhánh thuộc khu vực Thành Phố Huế gần khu vực thị xã Hương Trà ạ.Bạn vui lòng liên hệ tổng đài miễn phí 18006928 để được hỗ trợ tư vấn và đặt hàng.Thân mến!</p>
                            <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                        </div>
                    </div>
                </li>
            </ul>
            <p class="text-center"><a href="" class="add-comment">Xem thêm bình luận <i class="fas fa-angle-down"></i></a></p>
        </div>
        <div class="question-often mt-3">
            <h1>Đánh Giá & Nhận Xét <span class="coutn-dn">3</span></h1>
            <div class="average-rating">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="average-rating-left text-center">
                        <p>Đánh giá trung bình</p>
                        <span class="sst">5/5</span>
                        <p>
                            <img src="{{asset('images/shop/Starred.png')}}" alt="">
                            <img src="{{asset('images/shop/Starred.png')}}" alt="">
                            <img src="{{asset('images/shop/Starred.png')}}" alt="">
                            <img src="{{asset('images/shop/Starred.png')}}" alt="">
                            <img src="{{asset('images/shop/Starred.png')}}" alt="">
                        </p>
                        <span class="text-muted">3 đánh giá</span>
                    </div>
                    <div class="average-rating-center align-self-center">
                        <ul>
                            <li>
                                <span class="td">
                                    <span class="tn"></span>
                                    <span class="str">5 <img src="{{asset('images/shop/Starred.png')}}" alt=""></span>
                                    <span class="ss">2</span>
                                </span>
                            </li>
                            <li>
                                <span class="td">
                                    <span class="tn"></span>
                                    <span class="str">4 <img src="{{asset('images/shop/Starred.png')}}" alt=""></span>
                                    <span class="ss">2</span>
                                </span>
                            </li>
                            <li>
                                <span class="td">
                                    <span class="tn"></span>
                                    <span class="str">3 <img src="{{asset('images/shop/Starred.png')}}" alt=""></span>
                                    <span class="ss">2</span>
                                </span>
                            </li>
                            <li>
                                <span class="td">
                                    <span class="tn"></span>
                                    <span class="str">2 <img src="{{asset('images/shop/Starred.png')}}" alt=""></span>
                                    <span class="ss">2</span>
                                </span>
                            </li>
                            <li>
                                <span class="td">
                                    <span class="tn"></span>
                                    <span class="str">1 <img src="{{asset('images/shop/Starred.png')}}" alt=""></span>
                                    <span class="ss">2</span>
                                </span>
                            </li>
                        </ul>
                    </div>
                    <div class="average-rating-right text-center d-flex align-self-center">
                        <div class="">
                            <p>Bạn đã dùng sản phẩm này</p>
                            <p class="text-center mt-3"><a href="">Gửi đánh giá</a></p>
                        </div>

                    </div>
                </div>
            </div>
            <ul class="list-comment position-relative">
                <div class="btnselecthc">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mới nhất</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Cũ nhất</a>
                            <a class="dropdown-item" href="#">Hữu ích nhất</a>
                        </div>
                    </div>
                </div>
                <li>
                    <div class="commentq position-relative">
                        <span class="name">Trần Tùng </span><span class="text-muted">2 ngày trước</span>
                        <p>Mình mới dùng được một lọ theo chỉ dẫn uống ngày hai lần mỗi lần hai viên lúc đóinhưng được hai ba hôm mỗi lần uống thỉnh thoảng lại nổi mẩn ngứa ở hai eo lưng và sau gần sát nách</p>
                        <div class="roud-img"><img src="{{asset('images/shop/TT.png')}}" alt=""></div>
                    </div>
                    <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                    <div class="tplv">
                        <div class="commenta">
                            <span class="name">QuỳnhDT32</span><span class="cdntl">Quản trị viên</span><span class="text-muted">2 ngày trước</span>
                            <p>Chào Bạn Trịnh công bảo,Dạ sản phẩm hiện có hàng tại một số chi nhánh thuộc khu vực Thành Phố Huế gần khu vực thị xã Hương Trà ạ.Bạn vui lòng liên hệ tổng đài miễn phí 18006928 để được hỗ trợ tư vấn và đặt hàng.Thân mến!</p>
                            <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="commentq position-relative">
                        <span class="name">Võ Hùng </span><span class="text-muted">2 ngày trước</span>
                        <p>mình sử dụng hết thuốc sâm nhung bổ thận TW3 rồi qua sử dụng viên uống sâm nhung bổ thận NV này được ko ạ
                            mình sử dụng hết thuốc sâm nhung bổ thận TW3 rồi qua sử dụng viên uống sâm nhung bổ thận NV này được ko ạ
                        </p>
                        <div class="roud-img"><img src="{{asset('images/shop/VH.png')}}" alt=""></div>
                    </div>
                    <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                    <div class="tplv">
                        <div class="commenta">
                            <span class="name">QuỳnhDT32</span><span class="cdntl">Quản trị viên</span><span class="text-muted">2 ngày trước</span>
                            <p>Chào Bạn Trịnh công bảo,Dạ sản phẩm hiện có hàng tại một số chi nhánh thuộc khu vực Thành Phố Huế gần khu vực thị xã Hương Trà ạ.Bạn vui lòng liên hệ tổng đài miễn phí 18006928 để được hỗ trợ tư vấn và đặt hàng.Thân mến!</p>
                            <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                        </div>
                    </div>
                </li>
            </ul>
            <p class="text-center"><a href="" class="add-comment">Xem thêm bình luận <i class="fas fa-angle-down"></i></a></p>
        </div>
    </div>
</div>
<div class="wp-inner mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="new-view mt-5">
                @include("$moduleName.pages.$controllerName.child_index.new_view")
            </div>
        </div>
    </div>
</div>

<div class="service-tdoctor mt-5">
    @include("$moduleName.templates.info_service")
</div>
<div class="local">
    @include("$moduleName.templates.local_drugstore")
</div>
<div class="wp-inner mt-5">
    <div class="feedback-customer">
        @include("$moduleName.templates.feedback_customer")
    </div>
</div>

@endsection