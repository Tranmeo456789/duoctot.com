@php
use Illuminate\Support\Str;
use App\Helpers\MyFunction;

$contact=$item['contact']??'0393167234';
$contact=MyFunction::formatPhoneNumber($contact);
@endphp
@extends('shop.layouts.frontend')
@section('content')
<div class="wp-inner mt-2">
    @if(Session::has('user'))
    <div class="" id="breadcrumb-wp">
        @include("$moduleName.pages.$controllerName.child_detail.breadcrumb")
    </div>
    @endif
    <div id="detail_product">
        <div class="row">
            <div class="col-md-5">
                <div class="demo">
                    <div class="item">
    <div class="clearfix" style="max-width:474px;">
        <ul id="image-gallery" class="gallery list-unstyled lightSlider lsGrab lSSlide">
            @foreach($albumImageCurrent as $val)
                <li data-thumb="{{ asset('laravel-filemanager/fileUpload/product/'.$val) }}" class="text-center">
                    <img src="{{ asset('laravel-filemanager/fileUpload/product/'.$val) }}" class="zoom" />
                </li>
            @endforeach
            <li data-thumb="{{ asset($item['image']) }}" class="text-center">
                <img src="{{ asset($item['image']) }}" class="zoom" />
            </li>
        </ul>
        <!-- Thêm Zoom Lens -->
        <div class="zoom-lens"></div>
    </div>
</div>
                </div>
            </div>
            <div class="col-md-7">
                @if ((Session::has('user') && Session::get('user')['is_admin'] == 1))
                <a href="{{route('product.edit',$item->id)}}" class="btn btn-sm btn-secondary">chỉnh sửa</a>
                @endif
                <div class="title_product">
                    @if(isset($item->trademarkProduct) && !empty($item->trademarkProduct->name))
                    <p class="trademark_product">Thương hiệu: <span class="text-info">{{ $item->trademarkProduct->name }}</span></p>
                    @endif
                    <h1 class="mb-0">{{$item['name']}}</h1>
                    <div class="comment d-flex justify-content-between flex-wrap mb-3">
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
                                3 Đánh giá
                            </span>
                        </div>
                    </div>
                    <div style="font-size: 22px" class="mb-2">Liên hệ mua lẻ <span class="font-weight-bold"><a href="tel:0393167234" style="font-size: 30px; color:red">0393.167.234</a></span></div>
                    <div style="font-size: 22px">Liên hệ mua sỉ
                        <a class="image-contact" href='tel:0393167234' rel="nofollow" title="Gọi điện" previewlistener="true">
                            <img src="{{asset('images/shop/icon-call-green.jpg')}}" alt="Gọi điện Tdoctor" style="width: 45px;">
                        </a>
                    </div>
                </div>
                @php
                $item['show_price'] = 1;
                @endphp
                <div class="desc_product mb-3">
                    @if($item['show_price'] == 1)
                    <div id="show-price-buy-product" class="price_product mb-4 text-primary font-weight-bold">{{ number_format( $item['price'], 0, "" ,"." )}}đ </div>
                    @else
                    <div class="mb-2">
                        <a href='https://zalo.me/0393167234' target='_blank'>
                            <button class="btn text-white rounded-pill font-weight-bold view-price"><i class="fas fa-eye"></i> <span>Xem giá</span></button>
                        </a>
                        <span class="contact-buy">Liên hệ Hotline/ Zalo <a href="tel:0393167234"><span class="phone">0393.167.234</span></a></span>
                    </div>
                    @endif
                    @include("$moduleName.pages.$controllerName.child_detail.select_unit")
                    <p><span class="font-weight-bold bcn">Danh mục: </span><span class="text-info">{{$item->catProduct->name??'...'}}</span></p>
                    <p><span class="font-weight-bold">Dạng bào chế: </span>{{$item['dosage_forms']??'...'}}</p>
                    <p><span class="font-weight-bold">Quy cách: </span>{{$item['specification']??'...'}}</p>
                    <p><span class="font-weight-bold">Xuất xứ thương hiệu: </span>{{ $item->brandOriginIdProduct->name ?? '...' }}</p>
                    <p><span class="font-weight-bold">Nhà sản xuất: </span>{{$item->producerProduct->name ?? '...'}}</p>
                    @if($item['id'] > 1900 && $item['id'] < 1911)
                    <p><span class="font-weight-bold">Thuốc cần kê toa: </span>Không</p>
                    @endif
                    <p><span class="font-weight-bold">Nước sản xuất: </span>{{$item->countryProduct->name ?? '...'}}</p>
                    <p><span class="font-weight-bold">Công dụng: </span>{!!$item->benefit!!}</p>
                    <p><span class="font-weight-bold">Hạn sử dụng: </span>{{$item['expiration_date']??'...'}}</p>
                </div>
                @php
                $slugUserInfo = $userInfo['slug'] ?? 'unknow';
                $fullNameUserInfo=$userInfo['fullname'] ?? 'unknow';
                @endphp
                <div class="mb-3 d-flex justify-content-between">
                    <div class="float-right btn btn-sm btn-outline-secondary py-1 px-2 btn-buy-search">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                Xem Shop
                            </button>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('fe.product.drugstore', ['slug' => $slugUserInfo]) }}" style="white-space: normal;width: 90vw; display: block;">{{$fullNameUserInfo}}</a>
                                @foreach($listUserHasProduct as $val)
                                @php
                                    $slugUserHasProduct = $val['slug'] ?? 'unknow';
                                    $fullNameUserHasProduct = $val['fullname'] ?? 'unknow';                    
                                @endphp
                                <a class="dropdown-item" href="{{ route('fe.product.drugstore', ['slug' => $slugUserHasProduct]) }}" style="white-space: normal;width: 90vw; display: block;">{{$fullNameUserHasProduct}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="wp-link-affiliate position-relative">
                        <div id="copy-notification" style="display:none;position:absolute;background-color:#28a745;color:white;padding:3px;border-radius:5px;z-index:1000;font-size:14px;">Đã copy!</div>
                        @if(Session::has('user'))
                        <div class="value-link d-none">{{route('fe.product.detail',['slug'=> $item['slug'], 'codeRef'=>$codeRefLogin])}}</div>
                        @else
                        <div class="value-link d-none">{{route('fe.product.detail',$item['slug'])}}</div>
                        @endif
                        <span class="text-primary share-link btn-copy-link">Share <i class="fas fa-share"></i></span>
                    </div>
                </div>
                <div>
                    {!! csrf_field() !!}
                    <div class="form-group mb-3 d-flex">
                        <label class="col-form-label" style="font-size:16px;">Chọn số lượng</label>
                        <div class="input-group" style="width:125px;margin-left:10px;flex-wrap: nowrap">
                            <div class="input-group-prepend">
                                <span class="input-group-text minus"><i class="fa fa-minus"></i></span>
                            </div>
                            <input type="number" max="999" min="1" name="qty_product" value="1" class="form-control number-product text-center">
                            <div class="input-group-append">
                                <span class="input-group-text plus"><i class="fa fa-plus"></i></span>
                            </div>
                        </div>
                    </div>
                    <div class="btn-buy-search d-flex justify-content-between flex-wrap">
                        <span name="btn_selectbuy" class="btn-select-buy btn btn-primary text-light mb-xs-2" data-href="{{route('fe.cart.addproduct')}}">Chọn mua</span>
                        <a class="btn-search-house align-self-center" href="{{route('fe.product.listDrugstore')}}">Tìm nhà thuốc</a>
                        <input type="hidden" id="product_id" value="{{$item['id']??''}}">
                        <input type="hidden" id="unit_id" value="{{$item['unit_id']??''}}">
                        <input type="hidden" id="code_ref" value="{{$codeRef??''}}">
                        <input type="hidden" id="user_sell" value="{{$item->userProduct->user_id}}">
                    </div>
                </div>
                <div class="mt-3 text-center">
                    <span class="contact-buy">Liên hệ Hotline <a href="tel:0393167234"><span class="phone">{{$contact}}</span></a></span>
                </div>
                <div class="commit-tdoctor text-center">
                    @include("$moduleName.pages.$controllerName.child_detail.commit_tdoctor")
                </div>
            </div>
        </div>
    </div>
</div>
<div class="short-infohr mb-3"></div>
<div class="wp-inner">
    <div id="content-detail-product" class="row">
        @include("$moduleName.pages.$controllerName.child_detail.content_product")
    </div>
</div>
<div class="mt-3 py-3 colorb-wp">
    <div class="wp-inner">
        <div class="comment-product mb-3">
            @include("$moduleName.pages.$controllerName.child_detail.comment_rating_product")
        </div>
        <div id="product-relate">
            @include("$moduleName.pages.$controllerName.child_detail.product_relate",['items'=>$listProductRelate])
        </div>
    </div>
</div>
<div class="wp-inner mt-2">
    <div class="row">
        <div class="col-md-12">
            <div>
                @include("$moduleName.templates.list_product_new_view")
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
<div class="mt-3 mt-lg-4">
    <div class="feedback-customer">
        @include("$moduleName.templates.feedback_customer")
    </div>
</div>

@endsection