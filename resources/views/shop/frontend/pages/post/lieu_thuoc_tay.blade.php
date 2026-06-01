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
                <span>Cắt Liều Thuốc Tây</span>
            </li>
        </ul>
    </div>
    @foreach($catItems as $catItem)
    <hr>
    <h5><a href="{{route('fe.post.listPostOfCat',$catItem['name_url'])}}">{{$catItem['name']}}</a></h5>
    <div class="row mb-3">
        @foreach($catItem['post'] as $post)
        <div class="col-xl-3 col-6 pb-2">
            <a href="{{route('fe.post.detail',$post['slug'])}}" class="d-block">
                <div class="wp-thumb-item"><img loading="lazy" src="{{asset($post['image'])}}" alt="{{$post['title']}}" class="rounded" style="width: 100%"></div>
                <p class="truncate2 pb-0 text-dark font-weight-bold">{{$post['title']}}</p>
            </a>
        </div>
        @endforeach
    </div>
    @endforeach
    <div class="local">
        @include("$moduleName.templates.local_drugstore")
    </div>
    <div class="mt-3 mt-lg-4">
        <div class="feedback-customer">
            @include("$moduleName.templates.feedback_customer")
        </div>
    </div>
    @endsection