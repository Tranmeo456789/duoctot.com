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
                                <li data-thumb="{{asset($item['image'])}}" class="text-center">
                                    <img src="{{asset($item['image'])}}" />
                                </li>
                                <li data-thumb="{{asset($item['image'])}}" class="text-center">
                                    <img src="{{asset($item['image'])}}" />
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="title_product">
                    <p class="trademark_product">Thương hiệu: <span class="text-info">{{$item->trademarkProduct->name}}</span></p>
                    <h1>{{$item['name']}}</h1>
                    <div class="comment d-flex justify-content-between flex-wrap">
                        <span class="text-muted">({{$item->code??''}})</span>
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
                    <div class="price_product mb-2"><span class="font-weight-bold">{{ number_format( $item['price'], 0, "" ,"." )}}đ /</span> {{$item->unitProduct->name}}</div>
                    <p><span class="font-weight-bold bcn">Danh mục: </span><span class="text-info">{{$item->catProduct->name}}</span></p>
                    <p><span class="font-weight-bold">Dạng bào chế: </span>{{$item['dosage_forms']}}</p>
                    <p><span class="font-weight-bold">Quy cách: </span>{{$item['specification']}}</p>
                    <p><span class="font-weight-bold">Xuất xứ thương hiệu: </span>{{$item->countryProduct->name}}</p>
                    <p><span class="font-weight-bold">Nước sản xuất: </span>{{$item->countryProduct->name}}</p>
                    <p><span class="font-weight-bold">Công dụng: </span>{{$item['benefit']}}</p>
                </div>
                @include("$moduleName.block.payment_vnpay")
                <div>
                    {!! csrf_field() !!}
                    {{-- <div class="input-number">
                        <span class="seclect-number" data-id="{{$item['id']}}">Chọn số lượng</span>
                        <span class="pm11">
                            <span title="" class="minus1"><i class="fa fa-minus"></i></span>
                            <input type="number" name="qty_product" min="1" value="1" class="num-order">
                            <span title="" class="plus1"><i class="fa fa-plus"></i></span>
                        </span>
                    </div> --}}
                    <div class="form-group mb-3 d-flex" >
                        <label class="col-form-label" style="font-size:16px;">Chọn số lượng</label>
                        <div class="input-group" style="width:125px;margin-left:10px">
                            <div class="input-group-prepend">

                              <span class="input-group-text minus"><i class="fa fa-minus"></i></span>
                            </div>
                            <input type="number"  max="999" min="1"  name="qty_product" value="1"
                                 class="form-control number-product">
                            <div class="input-group-append">
                                <span class="input-group-text plus"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="btn-buy-search d-flex justify-content-between flex-wrap">
                        <span name="btn_selectbuy" class="btn-select-buy btn btn-primary text-light mb-xs-2" data-href="{{route('fe.cart.addproduct')}}">Chọn mua</span>
                        <a class="btn-search-house" href="">Tìm nhà thuốc</a>
                        <input type="hidden" id="product_id" value="{{$item['id']}}">
                        <input type="hidden" id="user_sell" value="{{$item->userProduct->user_id}}">
                    </div>
                </div>
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
                            Tdoctor cam kết
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
        <div class="col-12 col-lg-3 px-0">
                <div class="cat-content">
                    <div class="main-content-product">
                        <h1>Nội dung chính
                            <div class="roud-img"><img src="{{asset('images/shop/3ngang.png')}}" alt=""></div>
                        </h1>
                    </div>
                    <ul class="list-content-product">
                        <li><a href="#desc-product">Mô tả sản phẩm</a></li>
                        <li><a href="#element-product">Thành phần</a></li>
                        <li><a href="#func-product">Công dụng</a></li>
                        <li><a href="#alternate-product">Cách dùng</a></li>
                        <li><a href="#ide-effects">Tác dụng phụ</a></li>
                        <li><a href="#note-product">Lưu ý</a></li>
                        <li><a href="#preserve-product">Bảo quản</a></li>
                    </ul>
                </div>
        </div>
        <div class="col-12 col-lg-9">
            <div class="title-content-detail-product d-flex justify-content-between flex-wrap">
                <h1 id="desc-product">Mô tả sản phẩm</h1>
                <div class="d-flex justify-content-center flex-wrap">
                    <span class="ktc">Kích thước chữ</span>
                    <span class="mdlh">
                        <a class="md" href="">Mặc định</a>
                        <a class="lh" href="">Lớn hơn</a>
                    </span>
                </div>
            </div>
            <div class="content-detail-product">
                {!!$item->general_info!!}
                <h2 id="element-product">Thành phần</h2>
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
                <h2 id="func-product" class="mt-2">Công dụng</h2>
                <p>{{$item->benefit}}</p>
                <h2 id="alternate-product" class="mt-2">Cách dùng</h2>
                <p>{{$item->dosage}}</p>
                <h2 id="ide-effects">Tác dụng phụ</h2>
                <p>Chưa có tác dụng không mong muốn</p>
                <div id="note-product" class="note-product mt-2">
                    <h2>Lưu ý</h2>
                    <p>{{$item->note}}</p>
                </div>
                <h2 id="preserve-product">Bảo quản</h2>
                <p>{{$item->preserve}}</p>
            </div>
        </div>
    </div>
</div>
<div class="mt-3 py-3 colorb-wp">
    <div class="wp-inner">
        <div id="product-relate">
            <div id="feature-product-wp">
                <div class="mb-3 headf pl-5 d-flex">
                    <div><img src="{{asset('images/shop/lua1.png')}}" alt="" srcset=""></div>
                    <h1>Sản phẩm Liên Quan</h1>
                </div>
                <div>
                    <ul class="list-item">
                        <li>
                            <a href="">
                                <div>
                                    <div class="rdimg d-flex justify-content-center"><img src="{{asset('images/shop/covid2.png')}}" alt="" srcset=""></div>
                                    <div class="text-center">
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