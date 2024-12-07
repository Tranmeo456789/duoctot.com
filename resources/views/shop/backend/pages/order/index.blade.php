@php
    use App\Helpers\Template;
    $xhtmlButtonFilter = '';
    $xhtmlAreaSeach = Template::showAreaSearch('order', $params['search']);
@endphp
@extends('shop.layouts.backend')

@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => false,'hidePageIndex' =>true])
<section class="content">
    @include("$moduleName.blocks.notify")
    <div class="card card-outline card-primary mb800-0">
        <div class="card-body my-card-filter">
            <div class="row">
                <div class="col-12 col-md-7">{!! $xhtmlAreaSeach !!}</div>
            </div>
        </div>
    </div>
    @if ((Session::has('user') && Session::get('user')['is_admin'] == 1))
        @include("$moduleName.pages.$controllerName.child_index.filter_day")
    @endif
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => 'Danh sách'])
                    <div class="card-body p-0">
                        <div class="set-withscreen">
                            {!! Template::showTabFilter($controllerName, $itemStatusOrderCount, $params['filter']['status_order'], $params,'status_order'); !!}
                            @include("$moduleName.pages.$controllerName.list")
                        </div>
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