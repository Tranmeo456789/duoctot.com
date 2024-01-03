@extends('shop.layouts.frontend')

@section('content')

<div class="wp-inner mt-3 mt-lg-4">
    <h5 class="mb-4">THÔNG TIN SHOP</h5>
    <div class="mb-4">
        <div class="row">
            <div class="cod-12 col-md-4">
                <img src="https://tdoctor.net/laravel-filemanager/fileUpload/nhathuoc/659416b90a18b.jpg" alt="">
            </div>
            <div class="cod-12 col-md-8">
                <h5 class="text-primary">{{$userInfo['fullname']??''}}</h5>
                <p>Số lượng sản phẩm: {{count($productDrugstore)}}</p>
            </div>
        </div>
    </div>
    <div id="selling-product" class="parent-btn-view-add">
        @include("$moduleName.pages.$controllerName.child_drugstore.list_product",['productDrugstore'=>$productDrugstore->take(10)])
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