@extends('shop.layouts.frontend')

@section('content')
<div class="wp-inner mt-3 mt-lg-4">
    <div class="" id="breadcrumb-wp">
        <ul class="list-item clearfix">
            <li>
                <a href="{{route('home')}}" title="">Trang chủ</a>
            </li>
            <li>
                <span>Danh sách Trình dược viên</span>
            </li>
        </ul>
    </div>
    <div class="mb-3">
        @include("$moduleName.pages.$controllerName.child_ls_trinhduocvien.form_filter")
    </div>
    <div class="mb-3">
        @include("$moduleName.pages.$controllerName.child_ls_trinhduocvien.table_list_trinhduocvien",['items'=>$items])
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