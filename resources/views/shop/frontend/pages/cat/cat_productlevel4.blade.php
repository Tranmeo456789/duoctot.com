@extends('shop.layouts.frontend')

@section('content')
<div class="wp-inner mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="" id="breadcrumb-wp">
                @include("$moduleName.pages.$controllerName.child_index.breadcrumb4")
            </div>
        </div>
        <div class="col-xl-3 trademark">
            @include("$moduleName.pages.$controllerName.child_index.listbox_select")
        </div>
        <div class="col-12 col-xl-9">
            <div class="cat-product-out">
                <div class="title-product-out d-flex justify-content-between mb-3 flex-wrap">
                    <div class="title_cathd">
                        <h1>{{$catc2['name']}}</h1>
                        <img src="{{asset('images/shop/banc1.png')}}" alt="">
                    </div>
                    <div class="fitter-wp d-flex">
                        <div class="selectpp align-self-center">
                            <p>Lọc theo</p>
                            <ul class="d-flex">
                                <li><a href="" class="active-btn">Bán chạy</a></li>
                                <li><a href="">Mới nhất</a></li>
                                <li><a href="">Giá thấp</a></li>
                                <li><a href="">Giá cao</a></li>
                            </ul>
                        </div>
                        <div class="seclect_ol d-flex">
                            <a class="ol1 activebtn"><img src="{{asset('images/shop/v4.png')}}" alt=""></a>
                            <a class="ol2"><img src="{{asset('images/shop/3ngang.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="fitler-respon mb-2">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Hàng mới</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Bán chạy</a>
                            <a class="dropdown-item" href="#">Giá thấp</a>
                            <a class="dropdown-item" href="#">Giá cao</a>
                        </div>
                    </div>
                </div>
                <div class="body-nb">
                    <ul>   
                    @if(!empty($product))         
                        <li class="d-flex">
                            <div class="rimg-center"><img src="{{asset('public/shop/uploads/images/product/'.$img[0])}}" alt=""></div>
                            <div class="rightcnb">
                                <a href="" class="truncate2">{{$product['name']}}</a>
                                <h3 class="my-2">{{ number_format( $product['price'], 0, "" ,"." )}}đ/{{$product['unit']}}</h3>
                                <a class="noteheth">{{$catc2['name']}}</a>
                                <p>Dạng bào chế: {{$product['dosage_forms']}}</p>
                                <p>Thành phần: Tô điệp</p>
                            </div>
                        </li> 
                        @endif                   
                    </ul>
                    <div class="view-addpr text-center"><a href="">Xem thêm 500 sản phẩm <i class="fas fa-angle-down"></i></a></div>
                </div>
                <div id="body-nbox">
                    <ul class="clearfix">
                    @if(!empty($product))
                        <li class="text-center">
                            <a href="{{route('fe.product.detail',$product->id)}}">
                                <img src="{{asset('public/shop/uploads/images/product/'.$img[0])}}" alt="">
                                <div class="">
                                    <a href="{{route('fe.product.detail',$product->id)}}" class="truncate2">{{$product['name']}}</a>
                                    <h3 class="my-2">{{ number_format( $product['price'], 0, "" ,"." )}}đ/{{$product['unit']}}</h3>
                                    <a class="">{{$catc2['name']}}</a>
                                    <p>Dạng bào chế: {{$product['dosage_forms']}}</p>
                                    <p>Thành phần: Tông điệp</p>
                                </div>
                            </a>
                        </li>
                        @endif 
                    </ul>
                    <div class="view-addpr text-center mt-2"><a href="">Xem thêm 500 sản phẩm <i class="fas fa-angle-down"></i></a></div>
                </div>
            </div>
        </div>
    </div>
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