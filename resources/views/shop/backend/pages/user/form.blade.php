@extends('shop.layouts.backend')
@section('title',$pageTitle)
@section('content')
@php
    $slug = $item['slug'] ?? 'shop-trong';   
@endphp
<section class="content">
    <div class="container-fluid">
        @if ($item->user_type_id > 0)
        <h5 class="my-3">Link shop:<a href="{{ route('fe.product.drugstore', ['slug' => $slug]) }}" target="_blank">{{ route('fe.product.drugstore', ['slug' => $slug]) }}</a></h5>
        @endif
        <div class="card card-primary">
            @include("$moduleName.blocks.x_title", ['title' => 'Cập nhật thông tin'])
            <div class="card-body">
                @if ($item->user_type_id > 0)
                @include("$moduleName.pages.$controllerName.child_form.info_drugstore")
                @else
                @include("$moduleName.pages.$controllerName.child_form.info_default")
                @endif
            </div>
        </div>
        @include ("$moduleName.pages.product.child_form.modal_img")
    </div>
</section>
@endsection