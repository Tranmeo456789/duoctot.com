@php
$title = '';
$title = $title . $pageTitle;
@endphp
@extends('shop.layouts.backend')

@section('title', 'Danh sách ' . $title)

@section('header_title', $title)

@section('body_content')
<div class="card">
    @include("$moduleName.blocks.notify")
    @include("$moduleName.blocks.title",['pageTitle' => 'Danh sách '.$title,
    'pageIndex' => true])
    <div class="set-withscreen">
        <div class="card-body list-productwp">
            <div class="analytic status-product">
                <a class="text-primary active-status">Tất cả<span class="text-muted">(10)</span></a>
                <a class="text-primary">Đang bán<span class="text-muted">(5)</span></a>
                <a class="text-primary">Ngừng bán<span class="text-muted">(20)</span></a>
                <a class="text-primary">Tạm hết hàng<span class="text-muted">(20)</span></a>
                <a class="text-primary">Gần hết hàng<span class="text-muted">(20)</span></a>
                <a class="text-primary">Chờ kiểm duyệt<span class="text-muted">(20)</span></a>
                <a class="text-primary">Từ chối<span class="text-muted">(20)</span></a>
            </div>
            @include("$moduleName.pages.$controllerName.list")
            {{$items->links()}}
        </div>
    </div>
</div>
@endsection