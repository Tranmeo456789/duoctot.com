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
                <a href="{{route('home')}}">Trang Chủ</a>
            </li>
            <li>
                <span>Phản hồi từ Bệnh Nhân Dược Sỹ và Bác Sỹ</span>
            </li>
        </ul>
    </div>
    <div class="wp-list-img-feedback-page">
        @foreach($catItems as $catItem)
        <hr>
        <h5>{{$catItem['name']}}</h5>
        <div class="row mb-3">
            @foreach($catItem['customerFeedBack'] as $customerFeedBack)
            <div class="col-xl-3 col-6 pb-2">
                <div class="wp-thumb-item"><img class="lazy image-zoom-popup" src="{{ asset('images/shop/' . $customerFeedBack['image']) }}" alt="phan hoi" class="rounded" style="width: 100%"></div>
            </div>
            @endforeach
        </div>
        @endforeach
        <hr>
        <h5>Tiêu Hoá</h5>
        <div class="row mb-3">
            <div class="col-xl-3 col-6 pb-2">
                <div class="wp-thumb-item"><img class="lazy image-zoom-popup" src="{{asset('images/shop/1.jpg')}}" alt="phan hoi" class="rounded" style="width: 100%"></div>
            </div>
            <div class="col-xl-3 col-6 pb-2">
                <div class="wp-thumb-item"><img class="lazy image-zoom-popup" src="{{asset('images/shop/2.jpg')}}" alt="phan hoi" class="rounded" style="width: 100%"></div>
            </div>
        </div>
        <hr>
        <h5>Nội Thần Kinh</h5>
        <div class="row mb-3">
            <div class="col-xl-3 col-6 pb-2">
                <div class="wp-thumb-item"><img class="lazy image-zoom-popup" src="{{asset('images/shop/1.jpg')}}" alt="phan hoi" class="rounded" style="width: 100%"></div>
            </div>
            <div class="col-xl-3 col-6 pb-2">
                <div class="wp-thumb-item"><img class="lazy image-zoom-popup" src="{{asset('images/shop/2.jpg')}}" alt="phan hoi" class="rounded" style="width: 100%"></div>
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