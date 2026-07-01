@php
use Illuminate\Support\Str;
use App\Helpers\MyFunction;
@endphp
@extends('shop.layouts.frontend')
@section('headadd')
<style>
    .avatar { width: 200px; height: 200px; border-radius: 50%; object-fit: cover; }
    .expert-degree { font-size: 15px; font-weight: 500; color: #374151; margin: 0; }
    .expert-name   { font-size: 26px; font-weight: 700; color: #111827; margin: 4px 0 0; }
    .expert-role   { font-size: 14px; font-weight: 500; color: #374151; margin: 4px 0 0; }
    .bio-box       { font-size: 1rem; background: #f3f6f9; border-radius: 12px; padding: 16px 20px; color: #374151; line-height: 1.65; box-shadow: 6px 6px 0 0 rgba(114,138,161,0.3); margin-top: 16px; }
    .section-title { gap: 8px; margin-bottom: 14px; }
    .section-title h2 { font-size: 1.5rem; font-weight: 600; color: #111827; margin: 0; }
    .rich-content p  { margin-top: .5rem; margin-bottom: .5rem; font-size: 1rem; line-height: 1.5rem; }
    .rich-content strong { color: #111827; font-weight: 700; display: block; margin-top: 12px; margin-bottom: 2px; }
    .rich-content strong:first-child { margin-top: 0; }
</style>
@endsection
@section('content')
<div class="wp-inner mt-3 mt-lg-4">
    <div class="expert-introduction">
        <div class="row g-4">
            <!-- CỘT TRÁI -->
            <div class="col-12 col-md-4 d-flex flex-column align-items-center pb-4">
                <img class="avatar"
                    src="{{$imageSrcApprover}}"
                    alt="{{$approver['fullname']??''}}">
                <div class="text-center mt-3">
                    <p class="expert-degree">{{$approver['education_level']??''}}</p>
                    <p class="expert-name">{{$approver['fullname']??''}}</p>
                    <p class="expert-role">{{$approver['user_type']??''}}</p>
                </div>
                <div class="bio-box w-100">
                    {{$approver['meta_description']??''}}
                </div>
            </div>
            <!-- CỘT PHẢI -->
            <div class="col-12 col-md-8">
                <div class="section-title">
                    <h2>* Kinh nghiệm</h2>
                </div>
                <div class="rich-content">
                    {!! $approver['experience'] ??'' !!}
                </div>
            </div>
        </div>
    </div>
    @include("$moduleName.templates.box_title_product",['title' => 'Bài viết cùng chuyên gia','img'=>'mat.png'])
    <div class="mb-2">
        <div class="row">
            @if(!empty($listItemRelate))
            @foreach($listItemRelate as $val)
            <div class="col-xl-6 col-lg-12 newsh py-2">
                <div class="news-content-left">
                    <ul class="list-unstyled">
                        <li class="d-flex">
                            <a href="{{route('fe.post.detail',$val['slug'])}}" class="wp-thumb-item d-block">
                                <img src="{{asset('public'.$val['image'])}}" alt="">
                            </a>
                            <div class="nctright pl-2">
                                <div class="news-known d-flex mb-1">
                                    <p class="text-primary">{{$val->catPost->name??''}}</p>
                                </div>
                                <a class="title-new-left mb-1" href="{{route('fe.post.detail',$val['slug'])}}">
                                    <p class="truncate2 pb-0">{{$val['title']??''}}</p>
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
            @endif
        </div>
    </div>
</div>
<div class="local">
    @include("$moduleName.templates.local_drugstore")
</div>
<div class="wp-inner mt-3 mt-lg-4">
    <div class="feedback-customer">
        @include("$moduleName.templates.feedback_customer")
    </div>
</div>
<div class="lc-mask-search"></div>
@endsection