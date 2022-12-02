@extends('shop.layouts.frontend')
@section('content')
<div class="wp-inner mt-2">
    <div class="" id="breadcrumb-wp">
        @include("$moduleName.pages.$controllerName.child_detail.breadcrumb")
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
                @if((Session::has('user') && Session::get('user')['user_type_id'] != 9) || Session::get('user')==null)
                @include("$moduleName.block.payment_vnpay")
                <div>
                    {!! csrf_field() !!}
                    <div class="form-group mb-3 d-flex" >
                        <label class="col-form-label" style="font-size:16px;">Chọn số lượng</label>
                        <div class="input-group" style="width:125px;margin-left:10px">
                            <div class="input-group-prepend">
                              <span class="input-group-text minus"><i class="fa fa-minus"></i></span>
                            </div>
                            <input type="number"  max="999" min="1"  name="qty_product" value="1" class="form-control number-product text-center">
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
                @endif
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
        <div id="product-relate">
            @include("$moduleName.pages.$controllerName.child_detail.product_relate")
        </div>
        <div class="comment-product">
            @include("$moduleName.pages.$controllerName.child_detail.comment_product")
        </div>
        
    </div>
</div>
<div class="wp-inner mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="new-view">
            @include("$moduleName.templates.new_view")
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