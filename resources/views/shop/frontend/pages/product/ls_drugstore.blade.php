@extends('shop.layouts.frontend')

@section('content')
<div class="wp-inner mt-3 mt-lg-4">
    <div class="" id="breadcrumb-wp">
        <ul class="list-item clearfix">
            <li>
                <a href="{{route('home')}}" title="">Trang chủ</a>
            </li>
            <li>
                <span>Danh sách Nhà thuốc</span>
            </li>
        </ul>
    </div>
    <div class="mb-3">
        @include("$moduleName.pages.$controllerName.child_ls_drugstore.form_filter")
    </div>
    <div class="mb-3">
        @include("$moduleName.pages.$controllerName.child_ls_drugstore.table_list_drugstore",['items'=>$items])
    </div>
</div>
<div class="service-tdoctor mt-3 mt-lg-4">
    @include("$moduleName.templates.info_service")
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