@php
use Illuminate\Support\Str;
use App\Helpers\MyFunction;

$timePost = MyFunction::formatDateLongTime($item['created_at']);
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
            <li>
                <a href="" title="">{{$item->catPost->name}}</a>
            </li>
        </ul>
    </div>
    <h5 class="text-primary">{{$item->catPost->name}}</h5>
    <h3>{{$item['title']}}</h3>
    <p>{{$timePost}}</p>
    <div class="content-post">
        {!! $item['content'] !!}
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