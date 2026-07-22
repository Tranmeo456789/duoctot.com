@php
use Illuminate\Support\Str;
use App\Helpers\MyFunction;
@endphp
@extends('shop.layouts.frontend')
@section('headadd')
<style>
.avatar { width: 200px; height: 200px; border-radius: 50%; object-fit: cover; }
.expert-degree { font-size: 15px; font-weight: 500; color: #374151; margin: 0; }
.expert-name { font-size: 26px; font-weight: 700; color: #111827; margin: 4px 0 0; }
.expert-role { font-size: 14px; font-weight: 500; color: #374151; margin: 4px 0 0; }
.bio-box { font-size: 1rem; background: #f3f6f9; border-radius: 12px; padding: 16px 20px; color: #374151; line-height: 1.65; box-shadow: 6px 6px 0 0 rgba(114, 138, 161, 0.3); margin-top: 16px; }
.section-title { gap: 8px; margin-bottom: 14px; }
.section-title h2 { font-size: 1.5rem; font-weight: 600; color: #111827; margin: 0; }
.rich-content p { margin-top: .5rem; margin-bottom: .5rem; font-size: 1.25rem; line-height: 1.5rem; }
.rich-content strong { color: #111827; font-weight: 700; display: block; margin-top: 12px; margin-bottom: 2px; }
.rich-content strong:first-child { margin-top: 0; }
/* css moi */
.panel-card { background: #fff; border-radius: 12px; border: 1px solid #EEF1F4; box-shadow: 0 1px 3px rgba(16, 24, 40, .04); }
.health-tabs { display: flex; border-bottom: 1px solid #EEF1F4; padding: 0; }
.health-tabs .nav-item { flex: 1; text-align: center; }
.health-tabs .nav-link { display: block; border: none; color: #6B7280; font-weight: 600; font-size: 15px; padding: 18px 0; position: relative; text-align: center; }
.health-tabs .nav-link.active { color: #0075FF; background: transparent; }
.health-tabs .nav-link.active::after { content: ""; position: absolute; left: 20px; right: 20px; bottom: -1px; height: 3px; background: #0075FF; border-radius: 3px 3px 0 0; }
.health-tabs .nav-link:hover { color: #0075FF; }
.article-list { padding: 8px 20px 12px; }
.article-item { display: flex; gap: 18px; padding: 18px 0; border-bottom: 1px solid #EEF1F4; text-decoration: none; color: inherit; }
.article-item:last-child { border-bottom: none; }
.article-item:hover .article-title { color: #0075FF; }
.article-item:hover { text-decoration: none; color: inherit; }
.article-thumb { flex: 0 0 200px; width: 200px; height: 130px; border-radius: 10px; object-fit: cover; background-size: cover; background-position: center; }
.article-body { flex: 1; min-width: 0; }
.article-tag { display: inline-block; background: #F1F4F8; color: #6B7280; font-size: 12px; font-weight: 600; padding: 3px 10px; border-radius: 6px; margin-bottom: 8px; }
.article-title { font-size: 17px; font-weight: 700; color: #1A2233; margin-bottom: 6px; line-height: 1.4; }
.article-desc { font-size: 14px; color: #6B7280; line-height: 1.5; display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; }
.expert-panel { padding: 8px; }
.expert-panel-title { font-size: 18px; font-weight: 700;}
.avatar-wrap {flex-shrink: 0;}
.avatar-wrap img {width: 48px;height: 48px;border-radius: 50%;object-fit: cover;}
@media (max-width: 767px) {
  .article-thumb { flex-basis: 120px; width: 120px; height: 90px; }
  .article-title { font-size: 15px; }
  .article-desc { display: none; }
}
</style>
@endsection
@section('content')
<div class="wp-inner mt-3 mt-lg-4">
    <div class="expert-introduction mb-4">
        <div class="row g-4">
            <!-- CỘT TRÁI -->
            <div class="col-12 col-md-4 d-flex flex-column align-items-center pb-4">
                <img class="avatar"
                    src="{{$imageSrcApprover}}"
                    alt="{{$approver['fullname']??''}}">
                <div class="text-center mt-3">
                    <p class="expert-degree">{{$approver['education_level']??''}}</p>
                    <p class="expert-name">{{$approver['fullname']??''}}</p>
                    <p class="expert-role">{{$approver['user_type']??''}}</p>
                </div>
                <div class="bio-box w-100">
                    {{$approver['meta_description']??''}}
                </div>
            </div>
            <!-- CỘT PHẢI -->
            <div class="col-12 col-md-8">
                <div class="section-title">
                    <h2>* Kinh nghiệm</h2>
                </div>
                <div class="rich-content">
                    {!! $approver['experience'] ??'' !!}
                </div>
            </div>
        </div>
    </div>
    @include("$moduleName.templates.box_title_product", [
        'title' => 'Bài viết của ' . ($approver['fullname'] ?? ''),
        'img' => 'mat.png'
    ])
    <div class="container-fluid">
        <div class="row">
            <!-- ===== LEFT: Tabs + Article list ===== -->
            <div class="col-lg-9 mb-4 mb-lg-0">
                <div class="panel-card">
                    <ul class="nav nav-tabs health-tabs" id="healthTab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="thuoc-tab" data-toggle="tab" href="#thuoc" role="tab">Thuốc</a>
                        </li>    
                        <li class="nav-item">
                            <a class="nav-link" id="goc-tab" data-toggle="tab" href="#goc-suc-khoe" role="tab">Góc sức khỏe</a>
                        </li>
                        <!-- <li class="nav-item">
                        <a class="nav-link" id="benh-tab" data-toggle="tab" href="#benh" role="tab">Bệnh</a>
                        </li> -->
                    </ul>
                    <div class="tab-content" id="healthTabContent">
                        <!-- Tab: Góc sức khỏe -->
                        <div class="tab-pane fade" id="goc-suc-khoe" role="tabpanel">
                            <div class="article-list" id="itemListContainer">
                                @include("$moduleName.pages.product.child_detail_expert.item-relate-list")
                            </div>
                            <div id="itemPaginationContainer" class="mt-3">
                                @include("$moduleName.pages.product.child_detail_expert.item-relate-pagination")
                            </div>
                        </div>
                        <!-- Tab: Bệnh -->
                        <!-- <div class="tab-pane fade" id="benh" role="tabpanel">
                        <div class="article-list">
                            <a href="#" class="article-item">
                            <div class="article-thumb" style="background-image:url('/path/to/anh3.jpg')"></div>
                            <div class="article-body">
                                <span class="article-tag">Bệnh hô hấp</span>
                                <div class="article-title">Viêm phế quản: Nguyên nhân, triệu chứng và cách điều trị</div>
                                <div class="article-desc">Viêm phế quản là bệnh lý phổ biến ở đường hô hấp dưới, đặc biệt vào thời điểm giao mùa...</div>
                            </div>
                            </a>
                        </div>
                        </div> -->
                        <!-- Tab: Thuốc -->
                        <div class="tab-pane fade show active" id="thuoc" role="tabpanel">
                            <div class="article-list" id="productListContainer">
                                @include("$moduleName.pages.product.child_detail_expert.product-relate-list")
                            </div>
                            <div id="productPaginationContainer" class="mt-3">
                                @include("$moduleName.pages.product.child_detail_expert.product-relate-pagination")
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ===== RIGHT: Chuyên gia nổi bật ===== -->
            <div class="col-lg-3">
                <div class="panel-card expert-panel">
                    <div class="expert-panel-title mb-3 pt-2 pl-3">Dược sĩ nổi bật</div>
                    @foreach($listApprover as $val)
                    <div class="mb-4">
                        <div class="d-flex">
                            <div class="avatar-wrap mr-2">
                                <a href="{{$val['linkDetailExpert']??''}}">
                                    <img src="{{$val['imgThumb']??''}}" alt="{{$val['fullname']??'duoctot'}}" width="48" height="48">
                                </a>
                            </div>
                            <div class="expert-info">
                                <div class="expert-title">{{$val['education_level']??''}}</div>
                                <div><a href="{{route('fe.product.detailDoiNguChuyenMon',$val->slug)}}" class="font-weight-bold text-dark"->{{$val['fullname']??'duoctot'}}</a></div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <script>
        (function() {
            var tabLinks = document.querySelectorAll('.health-tabs [data-toggle="tab"]');
            tabLinks.forEach(function(link) {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    var targetSelector = this.getAttribute('href');
                    var targetPane = document.querySelector(targetSelector);
                    if (!targetPane) return;
                    tabLinks.forEach(function(l) {
                        l.classList.remove('active');
                    });
                    document.querySelectorAll('.tab-pane').forEach(function(p) {
                        p.classList.remove('show', 'active');
                    });
                    this.classList.add('active');
                    targetPane.classList.add('show', 'active');
                });
            });
        })();
        (function(){
            var slug = "{{ $approver->slug }}";
            var ajaxUrlBase = "{{ url('/doi-ngu-chuyen-mon-ajax') }}/" + slug + "/products-ajax";
            var listContainer = document.getElementById('productListContainer');
            var paginationContainer = document.getElementById('productPaginationContainer');
            function loadPage(page){
                fetch(ajaxUrlBase + "?page=" + page, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(function(res){ return res.json(); })
                .then(function(data){
                    listContainer.innerHTML = data.html;
                    paginationContainer.innerHTML = data.pagination;
                    bindPaginationClick();
                    listContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
                })
                .catch(function(err){ console.error('Lỗi tải trang sản phẩm:', err); });
            }
            function bindPaginationClick(){
                var links = paginationContainer.querySelectorAll('.page-link');
                links.forEach(function(link){
                    link.addEventListener('click', function(e){
                        e.preventDefault();
                        var page = this.getAttribute('data-page');
                        if(!page || this.parentElement.classList.contains('disabled')) return;
                        loadPage(page);
                    });
                });
            }
            bindPaginationClick();
        })();
        (function(){
            var slug = "{{ $approver->slug }}";
            var itemAjaxUrlBase = "{{ url('/doi-ngu-chuyen-mon-ajax') }}/" + slug + "/items-ajax";
            var itemListContainer = document.getElementById('itemListContainer');
            var itemPaginationContainer = document.getElementById('itemPaginationContainer');
            function loadItemPage(page){
                fetch(itemAjaxUrlBase + "?page=" + page, {
                    headers: { 'X-Requested-With': 'XMLHttpRequest' }
                })
                .then(function(res){ return res.json(); })
                .then(function(data){
                    itemListContainer.innerHTML = data.html;
                    itemPaginationContainer.innerHTML = data.pagination;
                    bindItemPaginationClick();
                    itemListContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
                })
                .catch(function(err){ console.error('Lỗi tải trang bài viết:', err); });
            }
            function bindItemPaginationClick(){
                var links = itemPaginationContainer.querySelectorAll('.page-link');
                links.forEach(function(link){
                    link.addEventListener('click', function(e){
                        e.preventDefault();
                        var page = this.getAttribute('data-page');
                        if(!page || this.parentElement.classList.contains('disabled')) return;
                        loadItemPage(page);
                    });
                });
            }
            bindItemPaginationClick();
        })();
    </script>
</div>
<div class="local mt-3">
    @include("$moduleName.templates.local_drugstore")
</div>
<div class="wp-inner mt-3 mt-lg-4">
    <div class="feedback-customer">
        @include("$moduleName.templates.feedback_customer")
    </div>
</div>
<div class="lc-mask-search"></div>
@endsection