@php
$title = 'Danh sách ';
$title = $title . $pageTitle;
@endphp
@extends('shop.layouts.backend')

@section('title', 'Danh sách ' . $title)

@section('header_title', $title)

@section('body_content')
<div class="card">
    @include("$moduleName.blocks.notify")
    @include("$moduleName.blocks.title",['pageTitle' => $title,
    'pageIndex' => true])
    <div class="card-header font-weight-bold">
            <div class="row">
                <div class="col-xl-6 col-lg-12">
                    <div class="form-search form-inline">
                        <form action="#" style="width:100%">
                            <input type="" id="input-search-after" style="width:100%" class="form-control form-search" placeholder="Nhập tên khách để tìm kiếm">
                            <button class="search-product"><i class="fas fa-search"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    <div class="set-withscreen">    
        <div class="card-body list-productwp">
            @include("$moduleName.pages.$controllerName.list")
            {{$items->links()}}
        </div>
    </div>
</div>
@endsection