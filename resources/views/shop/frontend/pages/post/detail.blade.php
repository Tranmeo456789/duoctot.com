@php
use Illuminate\Support\Str;
use App\Helpers\MyFunction;
$timePost = MyFunction::formatDateLongTime($item['created_at']);
@endphp
@extends('shop.layouts.frontend')
@section('content')
<style>
    .content-post p {
        line-height: 26px;
        margin-bottom: 12px;
    }
    .content-post div {
        margin-bottom: 16px;
        line-height: 24px;
    }
    .content-post h3 {
        margin-top: 8px;
        margin-bottom: 10px;
    }
    .content-post h3 b,
    .content-post h3 span,
    .content-post h3 p {
        font-size: 1.75rem !important;
    }
    .content-post h2 {
        font-weight: 600;
        color: #05afe3;
        margin-bottom: 15px;
    }
    .content-post h2 b,
    .content-post h2 span,
    .content-post h2 p{
        font-weight: 600!important;
        font-size: 2rem!important;
    }
    .avatar-wrap {
        flex-shrink: 0;
    }
    .avatar-wrap img {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        object-fit: cover;
    }
    .expert-title {
        font-size: .875rem;
        color: #6b7280;
        font-weight: 600;
    }
    .expert-name {
        font-size: 14px;
        font-weight: 700;
        color: #111827;
        text-align: center;
    }
    .verified-badge {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        margin-top: 6px;
    }
    .verified-badge svg {
        color: #16a34a;
    }
    .verified-text {
        font-size: 13px;
        color: #16a34a;
        font-weight: 500;
    }
    .card-content {
        font-size: .875rem;
        line-height: 1.6;
        margin-bottom: 10px;
        color: black;
    }
    .read-more {
        display: inline-flex;
        align-items: center;
        gap: 2px;
        font-size: .875rem;
        color: #2563eb;
        text-decoration: none;
    }
    .container-toc-list-post{
        position: sticky;
        align-self: flex-start;
    }
    .cat-content ol{
        padding-left: 10px;
    }
</style>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const content = document.querySelector("#toc-content-post");
        const toc = document.querySelector(".toc-list-post");
        if (!content || !toc) return;
        const headings = content.querySelectorAll("h2, h3, h4");
        let html = "";
        let h2Open = false;
        let h3Open = false;
        headings.forEach((h, index) => {
            // remove id cũ nếu có
            h.removeAttribute("id");
            // tạo slug
            let slug = h.textContent
                .trim()
                .toLowerCase()
                .normalize("NFD")
                .replace(/[\u0300-\u036f]/g, "")
                .replace(/[^a-z0-9\s]/gi, '')
                .replace(/\s+/g, '-');
            let id = slug + "-" + index;
            h.id = id;
            // H2
            if (h.tagName === "H2") {
                if (h3Open) {
                    html += "</ol></li>";
                    h3Open = false;
                }
                if (h2Open) {
                    html += "</li>";
                }
                html += `
                    <li>
                        <a href="#${id}">${h.textContent}</a>
                `;
                h2Open = true;
            }
            // H3
            if (h.tagName === "H3") {
                if (!h3Open) {
                    html += "<ol>";
                    h3Open = true;
                }
                html += `
                    <li>
                        <a href="#${id}">${h.textContent}</a>
                    </li>
                `;
            }
            // H4 (con của H3)
            if (h.tagName === "H4") {
                html += `
                    <li style="margin-left:15px">
                        <a href="#${id}">${h.textContent}</a>
                    </li>
                `;
            }
        });
        if (h3Open) html += "</ol>";
        if (h2Open) html += "</li>";
        toc.innerHTML = html;
    });
</script>
<div class="wp-inner mt-2">
    <div id="breadcrumb-wp">
        <ul class="list-item clearfix">
            <li>
                <a href="{{route('home')}}">Trang chủ</a>
            </li>
            <li>
                <a href="{{route('fe.post')}}">Tin tức</a>
            </li>
            <li>
                <a href="{{route('fe.post.listPostOfCat',$item->catPost->name_url)}}">{{$item->catPost->name}}</a>
            </li>
        </ul>
    </div>
</div>
<div class="wp-inner mt-3">
    <div class="d-md-none">
        @if ((Session::has('user') && in_array(Session::get('user')['is_admin'], [1, 2])))
            <a href="{{route('post.edit',$item->id)}}" class="btn btn-sm btn-secondary">chỉnh sửa</a>
            <span>@include("$moduleName.block.seo-score-dot",['score' => $item->score_seo])</span>
        @endif
        <div class="title-name mb-3" style="color:#05afe3;font-weight:700;font-size: 2.5rem;line-height: 1.2;">{{$item['title']}}</div>
        <p class="mb-3">{{$timePost}}</p>
        <div style="text-align:center" class="mb-3">
            <img src="{{$imageThumb??''}}" alt="{{$item['alt_image']??'duoctot'}}" title="{{$item['title_image']??'duoctot'}}" style="max-height: 400px">
        </div>
        @if(!empty($approver))
        @php
        if (!empty($approver) && isset($approver['details']['image']) && $approver['details']['image'] != '') {
        $imageSrcApprover = route('home') . '/public' . $approver['details']['image'];
        } else {
        $imageSrcApprover = route('home') . '/public/fileUpload/nhathuoc/6875c9e1945c0.jpg';
        }
        @endphp
        <div class="card-header mb-4">
            <div class="d-flex">
                <div class="avatar-wrap mr-4">
                    <a href="{{route('fe.product.detailDoiNguChuyenMon',$approver->slug)}}">
                        <img src="{{$imageSrcApprover}}" alt="{{$approver['fullname']??'duoctot'}}">
                    </a>
                </div>
                <div class="expert-info">
                    <div class="expert-title">Dược sĩ Đại học</div>
                    <div><a href="{{route('fe.product.detailDoiNguChuyenMon',$approver->slug)}}" class="expert-name">{{$approver['fullname']??'duoctot'}}</a></div>
                    <div class="verified-badge">
                        <svg width="20" height="20" class="mr-1 text-success-8" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="7.5" cy="7.5" r="4.5" fill="white"></circle>
                            <path d="M8.00065 1.3335C11.6825 1.3335 14.6673 4.31826 14.6673 8.00016C14.6673 11.6821 11.6825 14.6668 8.00065 14.6668C4.31875 14.6668 1.33398 11.6821 1.33398 8.00016C1.33398 4.31826 4.31875 1.3335 8.00065 1.3335ZM10.1471 5.97994L7.16732 8.95972L5.8542 7.64661C5.65894 7.45135 5.34236 7.45135 5.1471 7.64661C4.95184 7.84187 4.95184 8.15845 5.1471 8.35372L6.81376 10.0204C7.00903 10.2156 7.32561 10.2156 7.52087 10.0204L10.8542 6.68705C11.0495 6.49179 11.0495 6.17521 10.8542 5.97994C10.6589 5.78468 10.3424 5.78468 10.1471 5.97994Z" fill="currentColor"></path>
                        </svg>
                        <span class="verified-text">Đã kiểm duyệt nội dung</span>
                    </div>
                </div>
            </div>
            <p class="card-content">
                {{$approver['meta_description']??'Có kinh nghiệm làm việc nhiều năm.'}}
            </p>
            <a href="{{route('fe.product.detailDoiNguChuyenMon',$approver->slug)}}" class="read-more">Xem thêm thông tin</a>
        </div>
        @endif
    </div>
    <div class="row">
        <div class="col-12 col-lg-2 px-0">
            <div class="cat-content container-toc-list-post">
                <p class="font-weight-bold pt-3 pl-3" style="font-size: 19px;">TÓM TẮT NỘI DUNG</p>
                <ul class="list-content-product toc-list-post"></ul>
            </div>
        </div>
        <div class="col-12 col-lg-8">
            <div class="d-none d-md-block">
                @if ((Session::has('user') && in_array(Session::get('user')['is_admin'], [1, 2])))
                    <a href="{{route('post.edit',$item->id)}}" class="btn btn-sm btn-secondary">chỉnh sửa</a>
                    <span>@include("$moduleName.block.seo-score-dot",['score' => $item->score_seo])</span>
                @endif
                <h1 class="title-name" style="color:#05afe3;font-weight:700">{{$item['title']}}</h1>
                <p class="mb-3">{{$timePost}}</p>
                <div style="text-align:center" class="mb-3">
                    <img src="{{$imageThumb??''}}" alt="{{$item['alt_image']??'duoctot'}}" title="{{$item['title_image']??'duoctot'}}" style="max-height: 400px">
                </div>
            </div>
            <div class="content-post pb-4" id="toc-content-post">
                {!! $item['content'] !!}
            </div>
        </div>
        <div class="col-12 col-lg-2">
            @if(!empty($approver))
                @php
                if (!empty($approver) && isset($approver['details']['image']) && $approver['details']['image'] != '') {
                $imageSrcApprover = route('home') . '/public' . $approver['details']['image'];
                } else {
                $imageSrcApprover = route('home') . '/public/fileUpload/nhathuoc/6875c9e1945c0.jpg';
                }
                @endphp
                <div class="card-header mb-4 px-1 d-none d-md-block" style="position: sticky !important;top: 0;">
                    <div class="">
                        <div class="avatar-wrap text-center mb-2">
                            <a href="{{route('fe.product.detailDoiNguChuyenMon',$approver->slug)}}">
                                <img src="{{$imageSrcApprover}}" alt="{{$approver['fullname']??'duoctot'}}">
                            </a>
                        </div>
                        <div class="expert-info">
                            <div class="expert-title text-center">Dược sĩ Đại học</div>
                            <div class="text-center">
                                <a href="{{route('fe.product.detailDoiNguChuyenMon',$approver->slug)}}" class="expert-name">{{$approver['fullname']??'duoctot'}}</a>
                            </div>
                            <div class="verified-badge">
                                <svg width="20" height="20" class="mr-1 text-success-8" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <circle cx="7.5" cy="7.5" r="4.5" fill="white"></circle>
                                    <path d="M8.00065 1.3335C11.6825 1.3335 14.6673 4.31826 14.6673 8.00016C14.6673 11.6821 11.6825 14.6668 8.00065 14.6668C4.31875 14.6668 1.33398 11.6821 1.33398 8.00016C1.33398 4.31826 4.31875 1.3335 8.00065 1.3335ZM10.1471 5.97994L7.16732 8.95972L5.8542 7.64661C5.65894 7.45135 5.34236 7.45135 5.1471 7.64661C4.95184 7.84187 4.95184 8.15845 5.1471 8.35372L6.81376 10.0204C7.00903 10.2156 7.32561 10.2156 7.52087 10.0204L10.8542 6.68705C11.0495 6.49179 11.0495 6.17521 10.8542 5.97994C10.6589 5.78468 10.3424 5.78468 10.1471 5.97994Z" fill="currentColor"></path>
                                </svg>
                                <span class="verified-text">Đã kiểm duyệt nội dung</span>
                            </div>
                        </div>
                    </div>
                    <p class="card-content">
                        {{$approver['meta_description']??'Có kinh nghiệm làm việc nhiều năm.'}}
                    </p>
                    <a href="{{route('fe.product.detailDoiNguChuyenMon',$approver->slug)}}" class="read-more">Xem thêm thông tin</a>
                </div>
            @endif
        </div>
    </div>
    @if(!empty($listItemRelate))
    @include("$moduleName.templates.box_title_product",['title' => 'Tin liên quan','img'=>'mat.png'])
    <div class="mb-2">
        <div class="row">
            @foreach($listItemRelate as $val)
            <div class="col-xl-6 col-lg-12 newsh py-2">
                <div class="news-content-left">
                    <ul class="list-unstyled">
                        <li class="d-flex">
                            <a href="{{route('fe.post.detail',$val['slug'])}}" class="wp-thumb-item d-block">
                                <img src="{{asset('public'.$val['image'])}}" alt="">
                            </a>
                            <div class="nctright pl-2">
                                <div class="news-known d-flex mb-1">
                                    <p class="text-primary">{{$val->catPost->name??''}}</p>
                                </div>
                                <a class="title-new-left mb-1" href="{{route('fe.post.detail',$val['slug'])}}">
                                    <p class="truncate2 pb-0">{{$val['title']}}</p>
                                </a>
                                <div class="icon-oclock d-flex align-items-center">
                                    <img src="{{asset('images/shop/oclock.png')}}" alt="">
                                    <div class="ml-2">{{MyFunction::formatDateFrontend($val['created_at'])}}</div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            @endforeach
        </div>
    </div>
    @endif
</div>
<div class="local">
    @include("$moduleName.templates.local_drugstore")
</div>
<div class="mt-3 mt-lg-4">
    <div class="feedback-customer">
        @include("$moduleName.templates.feedback_customer")
    </div>
</div>
@endsection