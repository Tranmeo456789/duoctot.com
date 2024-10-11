@php
    use App\Helpers\Template;
    $xhtmlButtonFilter = '';
    $xhtmlAreaSeach = Template::showAreaSearch('catalog', $params['search']);
@endphp
@extends('shop.layouts.backend')

@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => true])
<section class="content">
    @include("$moduleName.blocks.notify")
    <div class="card card-outline card-primary mb800-0">
        <div class="card-body my-card-filter">
            <div class="row">
                <div class="col-12 col-md-7">{!! $xhtmlAreaSeach !!}</div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => 'Danh sách'])
                    <div class="card-body p-0">
                        @include("$moduleName.pages.$controllerName.list")
                    </div>
                    <div class="card-footer my-card-pagination clearfix">
                        @include("$moduleName.blocks.pagination",['paginator'=>$items])
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
