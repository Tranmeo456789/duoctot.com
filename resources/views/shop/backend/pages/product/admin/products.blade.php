@php
    use App\Helpers\Template;
@endphp
@extends('shop.layouts.backend')

@section('title',$pageTitle)
@section('content')

<section class="content">
    @include("$moduleName.blocks.notify")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => 'Danh sách'])
                    <div class="card-body p-0">
                        {!! Template::showTabFilterAdmin($controllerName, $itemStatusProductCount, $params['filter']['status_product'], $params,'status_product'); !!}

                        @include("$moduleName.pages.$controllerName.admin.list")
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