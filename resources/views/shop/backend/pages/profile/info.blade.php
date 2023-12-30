@extends('shop.layouts.backend')
@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => false,'hidePageIndex'=>true])
<section class="content">
    <div class="container-fluid">
        <div class="card card-primary">
            @include("$moduleName.blocks.x_title", ['title' => 'Cập nhật thông tin'])
            <div class="card-body">
                @if ($item->user_type_id == 4)
                @include("$moduleName.pages.$controllerName.child_info.info_drugstore")
                @else
                @include("$moduleName.pages.$controllerName.child_info.info_default")
                @endif
            </div>
        </div>
        @include ("$moduleName.pages.product.child_form.modal_img")
    </div>
</section>
@endsection