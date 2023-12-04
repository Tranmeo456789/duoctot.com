@extends('shop.layouts.frontend_search_in_menu')
@section('content')
<div>
    <div class="wp-inner">
        @if(count($itemSearch) > 0)
       <div class="title-header-search">Tìm thấy <span class="font-weight-bold">{{count($itemSearch)}}</span> kết quả với từ khóa "<span class="font-weight-bold">{{$keyword}}</span>"</div>
       @else
       <div class="title-header-search">Không tìm thấy kết quả với từ khóa "<span class="font-weight-bold">{{$keyword}}</span>"</div>
       <div class="lc-searchpost-inner py-2">
            <p class="font-weight-bold">Hãy thử lại bằng cách:</p>
            <ul class="list-group">
                <li>* Kiểm tra lỗi chính tả của từ khoá đã nhập</li>
                <li>* Thử lại bằng từ khoá khác</li>
                <li>* Thử lại bằng những từ khoá tổng quát hơn</li>
                <li>* Thử lại bằng những từ khoá ngắn gọn hơn</li>
            </ul>
       </div>
       @endif
    </div>
</div>
<div class="cbr py-2">
    <div class="wp-inner">
        <div class="search-result">
            @include("$moduleName.templates.list_product",['items'=>$itemSearch])
        </div>
        <div class="mt-2">
            @include("$moduleName.templates.list_product_new_view")
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