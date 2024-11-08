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
                <a href="{{route('home')}}">Trang chủ</a>
            </li>
            <li>
                <a href="{{route('fe.post')}}">Tin tức</a>
            </li>
            <li>
                <span>{{$itemCat['name']}}</span>
            </li>
        </ul>
    </div>
    <div class="row">
        @foreach($items as $post)
        <div class="col-xl-3 col-6 pb-2">
            <a href="{{route('fe.post.detail',$post['slug'])}}" class="d-block">
                <div class="wp-thumb-item"><img src="{{asset($post['image'])}}" alt="{{$post['title']}}" class="rounded"></div>
                <p class="truncate2 pb-0 text-dark font-weight-bold">{{$post['title']}}</p>
            </a>
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