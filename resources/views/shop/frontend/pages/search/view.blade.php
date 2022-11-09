@extends('shop.layouts.frontend')
@section('content')
<div>
    <div class="wp-inner">
       <div class="title-header-search">Tìm thấy <span class="font-weight-bold">{{count($itemSearch)}}</span> kết quả với từ khóa "<span class="font-weight-bold">{{$keyword}}</span>"</div>
    </div>
</div>
<div class="cbr py-2">
    <div class="wp-inner">
        <div id="selling-product" class="search-result">
            @include("$moduleName.pages.$controllerName.child_view.list_product_search")
        </div>
        <div class="new-view">
            @include("$moduleName.templates.new_view")
        </div>  
    </div>
</div>
<div class="service-tdoctor mt-5">
    @include("$moduleName.templates.info_service")
</div>
<div class="local">
    @include("$moduleName.templates.local_drugstore")
</div>
<div class="wp-inner mt-5">
    <div class="feedback-customer">
        @include("$moduleName.templates.feedback_customer")
    </div>
</div>
@endsection