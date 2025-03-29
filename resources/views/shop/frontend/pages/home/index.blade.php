@extends('shop.layouts.frontend')

@section('content')
<div class="container-slider mt-0 mt-lg-2 pl-0 pl-lg-2">
    <div class="row">
        <div class="col-12 col-lg-8">
            <div class="d-none d-md-block">
                <ul class="banner_doitac list-unstyled cS-hidden">
                    <li class="text-center">
                        <a href="https://tdoctor.net/cong-ty-tnhh-nohtus-vietnam.html">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner11.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="https://tdoctor.net/cong-ty-duoc-pham-dongsung-bio-pharm.html">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner17.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="https://tdoctor.net/cong-ty-tnhh-nohtus-vietnam.html">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner18.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="https://tdoctor.net/cong-ty-tnhh-duoc-pham-pegasus.html">
                            <img src="https://tdoctor.net/laravel-filemanager/fileUpload/nhathuoc/1741247469_ab.webp" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'abbvie'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner20.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="https://tdoctor.net/trungson-healthcare.html">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner21.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'astrazeneca'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner22.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'merck'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner23.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'roche'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner24.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'pfizer'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner25.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'nordisk'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner26.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'sanofi'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner27.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'amgen'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner28.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'novartis'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner29.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'Bristol'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner30.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'GSK'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner31.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'Lilly'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner32.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'mekophar'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner33.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                </ul>
            </div>
            <div class="d-block d-md-none">
                <ul class="banner_doitac list-unstyled cS-hidden">
                    <li class="text-center">
                        <a href="https://tdoctor.net/cong-ty-tnhh-nohtus-vietnam.html">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner16_mobi.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="https://tdoctor.net/cong-ty-duoc-pham-dongsung-bio-pharm.html">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner17.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="https://tdoctor.net/cong-ty-tnhh-nohtus-vietnam.html">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner18.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="https://tdoctor.net/cong-ty-tnhh-duoc-pham-pegasus.html">
                            <img src="https://tdoctor.net/laravel-filemanager/fileUpload/nhathuoc/1741247469_ab.webp" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'abbvie'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner20.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="https://tdoctor.net/trungson-healthcare.html">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner21.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'astrazeneca'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner22.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'merck'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner23.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'roche'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner24.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'pfizer'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner25.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'nordisk'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner26.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'sanofi'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner27.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'amgen'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner28.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'novartis'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner29.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'Bristol'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner30.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'GSK'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner31.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'Lilly'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner32.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                    <li class="text-center">
                        <a href="{{route('fe.search.viewHome', ['keyword' => 'mekophar'])}}">
                            <img src="{{asset('laravel-filemanager/fileUpload/banner/banner33.webp')}}" alt="tdoctor" class="img-fluid">
                        </a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="d-none d-lg-block col-lg-4">
            <div>
                <a href="https://tdoctor.net/danh-muc/cham-soc-ca-nhan/duoc-my-pham-trang-diem"><img src="{{asset('images/shop/banner-right-home1.webp')}}" alt="tdotor" class="img-fluid"></a>
            </div>
        </div>
    </div>
</div>
<div class="wp-inner">
    <h1 class="d-none">Sàn thương mại điện tử trong y dược số 1 Việt Nam</h1>
    <div id="hisd" class="position-relative">
        <div class="d-flex justify-content-center">
            <div id="form-search" class="d-flex justify-content-center">
                @include("$moduleName.pages.$controllerName.child_index.search")
            </div>
        </div>
    </div>
</div>
<div class="wp-inner mt-3 mt-lg-4">
    @include("$moduleName.templates.box_title_product",['title' => 'Sản phẩm nổi bật','classBackground'=>'bg-danger'])
    @include("$moduleName.templates.list_product",['items'=>$itemsProduct['best']])
</div>
<div class="wp-inner mt-3 mt-lg-4">
    <div id="selling-product" class="parent-btn-view-add">
        @include("$moduleName.pages.$controllerName.child_index.best_selling_product")
        @include("$moduleName.block.btn_view_add",['countProduct'=>$couterSumProduct])
    </div>
</div>
<div class="wp-inner mt-3 mt-lg-4">
    <div id="product-by-object" class="parent-btn-view-add">
        @include("$moduleName.pages.$controllerName.child_index.product_by_object")
    </div>
</div>
<div class="wp-inner">
    @include("$moduleName.pages.$controllerName.child_index.news")
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