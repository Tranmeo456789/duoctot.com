@php
use Illuminate\Support\Str;
use App\Helpers\MyFunction;

@endphp
@extends('shop.layouts.frontend_webview')
@section('content')
<div class="wp-inner mt-2">
    <div class="" id="breadcrumb-wp">
        <ul class="list-item clearfix">
            <li>
                <a href="{{route('home')}}">Trang chủ</a>
            </li>
            <li>
                <span>Tin tức</span>
            </li>
        </ul>
    </div>
    <div class="row">
        <div class="col-xl-3 col-lg-12">
            <div class="row">
                <div class="pb-3 col-xl-12 col-6">
                    <a href="{{route('fe.post.detail',$itemNews[2]['slug'])}}" class="d-block">
                        <div class="wp-thumb-item"><img src="{{asset($itemNews[2]['image'])}}" alt="{{$itemNews[2]['title']}}" class="rounded"></div>
                        <p class="truncate2 pb-0 text-dark font-weight-bold">{{$itemNews[2]['title']}}</p>
                    </a>
                </div>
                <div class="col-xl-12 col-6">
                    <a href="{{route('fe.post.detail',$itemNews[1]['slug'])}}" class="d-block">
                        <div class="wp-thumb-item"><img src="{{asset($itemNews[1]['image'])}}" alt="{{$itemNews[1]['title']}}" class="rounded"></div>
                        <p class="truncate2 pb-0 text-dark font-weight-bold">{{$itemNews[1]['title']}}</p>
                    </a>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12">
            <a href="{{route('fe.post.detail',$itemNews[0]['slug'])}}" class="d-block">
                <div class="wp-thumb-item"><img src="{{asset($itemNews[0]['image'])}}" alt="{{$itemNews[0]['title']}}" class="rounded"></div>
                <p class="truncate2 pb-0 text-dark font-weight-bold pb-3">{{$itemNews[0]['title']}}</p>
            </a>
        </div>
        <div class="col-xl-3 col-lg-12">
            <div class="row">
                <div class="pb-3 col-xl-12 col-6">
                    <a href="{{route('fe.post.detail',$itemNews[3]['slug'])}}" class="d-block">
                        <div class="wp-thumb-item"><img src="{{asset($itemNews[3]['image'])}}" alt="{{$itemNews[3]['title']}}" class="rounded"></div>
                        <p class="truncate2 pb-0 text-dark font-weight-bold">{{$itemNews[3]['title']}}</p>
                    </a>
                </div>
                <div class="col-xl-12 col-6">
                    <a href="{{route('fe.post.detail',$itemNews[4]['slug'])}}" class="d-block">
                        <div class="wp-thumb-item"><img src="{{asset($itemNews[4]['image'])}}" alt="{{$itemNews[4]['title']}}" class="rounded"></div>
                        <p class="truncate2 pb-0 text-dark font-weight-bold">{{$itemNews[4]['title']}}</p>
                    </a>
                </div>
            </div>
        </div>
    </div>
    @foreach($catItems as $catItem)
    <hr>
    <h5><a href="{{route('fe.post.listPostOfCat',$catItem['name_url'])}}">{{$catItem['name']}}</a></h5>
    <div class="row mb-3">
        @foreach($catItem['post'] as $post)
        <div class="col-xl-3 col-6 pb-2">
            <a href="{{route('fe.post.detail',$post['slug'])}}" class="d-block">
                <div class="wp-thumb-item"><img src="{{asset($post['image'])}}" alt="{{$post['title']}}" class="rounded"></div>
                <p class="truncate2 pb-0 text-dark font-weight-bold">{{$post['title']}}</p>
            </a>
        </div>
        @endforeach
    </div>
    @endforeach
    @endsection