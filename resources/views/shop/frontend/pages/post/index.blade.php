@php
use Illuminate\Support\Str;
use App\Helpers\MyFunction;

@endphp
@extends('shop.layouts.frontend')
@section('content')
<div class="wp-inner mt-2">
    <div class="" id="breadcrumb-wp">
        <ul class="list-item clearfix">
            <li>
                <a href="" title="">Trang chủ</a>
            </li>
            <li>
                <a href="" title="">Tin tức</a>
            </li>
        </ul>
    </div>
    <div class="row">
        @foreach($items as $val)
        <div class="col-xl-6 col-lg-12 newsh">
            <div class="news-content-left">
                <ul class="list-unstyled">
                    <li class="d-flex">
                        <a href="{{route('fe.post.detail',$val['slug'])}}" class="wp-thumb-item d-block">
                            <img src="{{asset($val['image'])}}" alt="">
                        </a>
                        <div class="nctright pl-2">
                            <div class="news-known d-flex mb-1">
                                <a href="">{{$val->catPost->name??''}}</a>
                            </div>
                            <a class="title-new-left mb-1" href="{{route('fe.post.detail',$val['slug'])}}">
                                <p class="truncate2 pb-0">{{$val['title']}}</p>
                            </a>
                            <div class="icon-oclock d-flex align-items-center">
                                <img src="{{asset('images/shop/oclock.png')}}" alt="">
                                <div class="ml-2">{{MyFunction::formatDateFrontend($val['created_at'])}}</div>
                            </div>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
        @endforeach
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