@php
use Illuminate\Support\Str;

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
                            <ul id="image-gallery" class="gallery list-unstyled cS-hidden">
                                <li data-thumb="{{asset($item['image'])}}" class="text-center">
                                    <img src='data:image/webp;base64,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' 
                                        data-src="{{asset($item['image'])}}" class="lazy" />
                                </li>
                                <li data-thumb="{{asset($item['image'])}}" class="text-center">
                                    <img src='data:image/webp;base64,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' 
                                        data-src="{{asset($item['image'])}}" class="lazy" />
                                </li>
                                <!-- @if(!empty($albumImageCurrent))
                                    @foreach($albumImageCurrent as $val)
                                        <li data-thumb="{{asset('public/fileUpload/product/'.$val)}}" class="text-center">
                                            <img src="{{asset('public/fileUpload/product/'.$val)}}" />
                                        </li>
                                    @endforeach
                                @else
                                    <li data-thumb="{{asset($item['image'])}}" class="text-center">
                                        <img src="{{asset($item['image'])}}" />
                                    </li>
                                @endif -->
                            </ul>
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
                                3 Đánh giá
                            </span>
                        </div>
                    </div>
                </div>
                @php
                    $item['show_price'] = 1;
                @endphp
                <div class="desc_product mb-3">
                    @if($item['show_price'] == 1)
                        <div class="price_product mb-2 text-primary"><span class="font-weight-bold">{{ number_format( $item['price'], 0, "" ,"." )}}đ /</span> {{$item->unitProduct->name}}</div>
                    @else
                        <div class="mb-2">
                            <a href='https://zalo.me/0349444164' target='_blank'>
                                <button class="btn text-white rounded-pill font-weight-bold view-price"><i class="fas fa-eye"></i> <span>Xem giá</span></button>
                            </a>
                            <span class="contact-buy">Liên hệ Hotline <span class="phone">0349.444.164</span></span>
                        </div>
                    @endif
                    <p><span class="font-weight-bold bcn">Danh mục: </span><span class="text-info">{{$item->catProduct->name??'...'}}</span></p>
                    <p><span class="font-weight-bold">Dạng bào chế: </span>{{$item['dosage_forms']??'...'}}</p>
                    <p><span class="font-weight-bold">Quy cách: </span>{{$item['specification']??'...'}}</p>
                    <!-- <p><span class="font-weight-bold">Xuất xứ thương hiệu: </span>{{ $item->brandOriginIdProduct->name ?? '...' }}</p> -->
                    <p><span class="font-weight-bold">Nhà sản xuất: </span>{{$item->producerProduct->name ?? '...'}}</p>
                    @if($item['id'] > 1900 && $item['id'] < 1911)
                    <p><span class="font-weight-bold">Thuốc cần kê toa: </span>Không</p>
                    @endif
                    <!-- <p><span class="font-weight-bold">Nước sản xuất: </span>{{$item->countryProduct->name ?? '...'}}</p> -->
                    <p><span class="font-weight-bold">Công dụng: </span>{!!$item->benefit!!}</p>
                    <p><span class="font-weight-bold">Hạn sử dụng: </span>{{$item['expiration_date']??'...'}}</p>
                </div>
                    @php
                        $slugName = Str::slug($userInfo['fullname']);                                     
                    @endphp
                <div class="mb-3 d-flex justify-content-between">
                    <a href="{{ route('fe.product.drugstore', ['slug' => $slugName,'shopId'=> $userInfo['user_id']]) }}" class="btn btn-sm btn-outline-secondary py-1 px-2 btn-buy-search">Xem shop</a>
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
                    <div class="form-group mb-3 d-flex" >
                        <label class="col-form-label" style="font-size:16px;">Chọn số lượng</label>
                        <div class="input-group" style="width:125px;margin-left:10px;flex-wrap: nowrap">
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
                        <a class="btn-search-house align-self-center" href="{{route('fe.product.listDrugstore')}}">Tìm nhà thuốc</a>    
                        <input type="hidden" id="product_id" value="{{$item['id']}}">
                        <input type="hidden" id="code_ref" value="{{$codeRef??''}}">
                        <input type="hidden" id="user_sell" value="{{$item->userProduct->user_id}}">
                    </div>
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
        <div id="product-relate">
            @include("$moduleName.pages.$controllerName.child_detail.product_relate",['items'=>$listProductRelate])
        </div>
        <div class="comment-product">
            @include("$moduleName.pages.$controllerName.child_detail.comment_rating_product")
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