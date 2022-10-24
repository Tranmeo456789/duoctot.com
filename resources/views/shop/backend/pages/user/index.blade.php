@extends('shop.layouts.backend')

@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => true])
<section class="content">
    @include("$moduleName.blocks.notify")
    <div class="card">
        <div class="card-header font-weight-bold">
            <div class="row">
                <div class="col-xl-6 col-lg-12">
                    <div class="form-search form-inline">
                        <form action="#" style="width:100%">
                            <input type="" id="input-search-after" style="width:100%" class="form-control form-search" placeholder="Nhập tên để tìm kiếm">
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
</section>
@endsection