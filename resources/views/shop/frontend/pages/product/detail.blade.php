@php
use Illuminate\Support\Str;
use App\Helpers\MyFunction;

$contact=$item['contact']??'0345488247';
$contact=MyFunction::formatPhoneNumber($contact);
@endphp
@extends('shop.layouts.frontend')
@section('headadd')
<style>
    .content-detail-product p {
        margin-bottom: 16px;
        line-height: 24px;
    }
    .content-detail-product div {
        margin-bottom: 16px;
        line-height: 24px;
    }
    .content-detail-product h3 {
        margin-top: 8px;
        margin-bottom: 16px;
        line-height: 24px;
    }
    .content-detail-product h3 b,
    .content-detail-product h3 span,
    .content-detail-product h3 p {
        font-size: 1.75rem !important;
    }
    .submenua1.display-vis {
        font-size: 18px;
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
        font-size: 1.275rem;
        font-weight: 700;
        color: #111827;
        text-decoration: none;
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
        font-size: 1rem;
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
    .table-des-product td, .table-des-product td p, .table-des-product td span{
        font-size: 14px!important;
    }
    .product-tab-name{
        margin-bottom: 10px;
        font-size: 30px;
        font-weight: normal !important;
        background-color: transparent;
        color: #05afe3;
    }
    .product-tab-name a{
        color: #05afe3;
    }
    .container-toc-list-product{
        position: sticky;
        align-self: flex-start;
    }
    @media (max-width: 767px) {
    .product-tab-name {
        font-size: 18px;
    }
}
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/tiny-slider.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/tiny-slider/2.9.4/min/tiny-slider.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        let e = tns({
            container: ".sliderProductMain",
            items: 1,
            slideBy: "page",
            speed: 1e3,
            nav: !1,
            controls: !1,
            autoplay: !1,
            mouseDrag: !0,
            loop: !0,
            onInit: function() {
                document.querySelector(".sliderProductMain").classList.remove("cS-hidden")
            }
        });
        tns({
            container: ".sliderProductThumb",
            items: 4,
            gutter: 10,
            slideBy: 1,
            nav: !1,
            controls: !1,
            autoplay: !1,
            mouseDrag: !0,
            loop: !1
        });
        let t = document.querySelectorAll(".sliderProductThumb > div");

        function o(e) {
            t.forEach((t, o) => {
                t.classList.toggle("active", o === e)
            })
        }
        t.forEach((t, n) => {
            t.addEventListener("click", function() {
                e.goTo(n), o(n)
            })
        }), e.events.on("indexChanged", function(e) {
            let t = e.displayIndex - 1;
            o(t)
        }), o(0)
    });
</script>
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@type": "Product",
        "name": {
            !!json_encode($title ?? '', JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!
        },
        "image": {
            !!json_encode(asset('public'.$imageItem ?? ''), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!
        },
        "description": {
            !!json_encode(strip_tags($description ?? ''), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!
        },
        "url": {
            !!json_encode(url() - > current(), JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES) !!
        },
        "sku": {
            !!json_encode($productCode ?? 'SKU-DEFAULT') !!
        },
        "brand": {
            "@type": "Brand",
            "name": "DuocTot"
        },
        "offers": {
            "@type": "Offer",
            "url": {
                !!json_encode(url() - > current()) !!
            },
            "priceCurrency": "VND",
            "price": {
                {
                    (int)($price ?? 0)
                }
            },
            "priceValidUntil": "{{ date('Y-12-31') }}",
            "availability": "https://schema.org/InStock",
            "itemCondition": "https://schema.org/NewCondition",
            "shippingDetails": {
                "@type": "OfferShippingDetails",
                "shippingRate": {
                    "@type": "MonetaryAmount",
                    "value": 0,
                    "currency": "VND"
                },
                "shippingDestination": {
                    "@type": "DefinedRegion",
                    "addressCountry": "VN"
                },
                "deliveryTime": {
                    "@type": "ShippingDeliveryTime",
                    "handlingTime": {
                        "@type": "QuantitativeValue",
                        "minValue": 0,
                        "maxValue": 1,
                        "unitCode": "d"
                    },
                    "transitTime": {
                        "@type": "QuantitativeValue",
                        "minValue": 1,
                        "maxValue": 3,
                        "unitCode": "d"
                    }
                }
            },
            "hasMerchantReturnPolicy": {
                "@type": "MerchantReturnPolicy",
                "applicableCountry": "VN",
                "returnPolicyCategory": "https://schema.org/MerchantReturnFiniteReturnWindow",
                "merchantReturnDays": 7,
                "returnMethod": "https://schema.org/ReturnByMail",
                "returnFees": "https://schema.org/FreeReturn"
            }
        }
    } {
        "@context": "https://schema.org",
        "@type": "BreadcrumbList",
        "itemListElement": [{
                "@type": "ListItem",
                "position": 1,
                "name": "Trang chủ",
                "item": "{{ route('home') }}"
            }
            @if($itemCatParentLevel2['parent_id'] < 1),
            {
                "@type": "ListItem",
                "position": 2,
                "name": "{{ $itemCatParentLevel1['name'] ?? '' }}",
                "item": "{{ route('fe.cat', $itemCatParentLevel1['slug'] ?? '') }}"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $itemCatCurent['name'] ?? '' }}",
                "item": "{{ route('fe.cat2', [$itemCatParentLevel1['slug'] ?? '', $itemCatCurent['slug'] ?? '']) }}"
            }
            @else,
            {
                "@type": "ListItem",
                "position": 2,
                "name": "{{ $itemCatParentLevel2['name'] ?? '' }}",
                "item": "{{ route('fe.cat', $itemCatParentLevel2['slug'] ?? '') }}"
            },
            {
                "@type": "ListItem",
                "position": 3,
                "name": "{{ $itemCatParentLevel1['name'] ?? '' }}",
                "item": "{{ route('fe.cat2', [$itemCatParentLevel2['slug'] ?? '', $itemCatParentLevel1['slug'] ?? '']) }}"
            },
            {
                "@type": "ListItem",
                "position": 4,
                "name": "{{ $itemCatCurent['name'] ?? '' }}",
                "item": "{{ route('fe.cat3', [$itemCatParentLevel2['slug'] ?? '', $itemCatParentLevel1['slug'] ?? '', $itemCatCurent['slug'] ?? '']) }}"
            }
            @endif
        ]
    }
</script>
<script>
document.addEventListener("DOMContentLoaded", function () {

    const content = document.querySelector("#toc-content-product");
    const toc = document.querySelector(".toc-list-product");

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
@endsection
@section('content')
<div class="wp-inner mt-2 mb-3">
    <div id="detail_product">
        <div class="row">
            <div class="col-md-5">
                <div class="demo">
                    <div class="item">
                        <div class="product-gallery clearfix" style="max-width:474px;">
                            <!-- Slider chính -->
                            <div class="sliderProductMain tns-slider cS-hidden gallery">
                                <div class="text-center">
                                    <img src="{{ asset('public'.$item['image']) }}" class="img-fluid image-zoom-popup" alt="{{$item['alt_image'] ?? ''}}" title="{{$item['title_image'] ?? ''}}" width="295" height="295" />
                                </div>
                                @foreach($albumImageCurrent as $val)
                                <div class="text-center">
                                    <img src="{{ asset('public/fileUpload/product/'.$val) }}" class="zoom img-fluid image-zoom-popup" alt="{{$item['name'] ?? ''}}" width="295" height="295" />
                                </div>
                                @endforeach
                            </div>
                            <!-- Thumbnail slider -->
                            <div class="sliderProductThumb mt-2">
                                <div>
                                    <img src="{{ asset('public'.$item['image']) }}" class="img-thumbnail" width="60" height="60" />
                                </div>
                                @foreach($albumImageCurrent as $val)
                                <div>
                                    <img src="{{ asset('public/fileUpload/product/'.$val) }}" class="img-thumbnail" width="60" height="60" />
                                </div>
                                @endforeach
                            </div>
                            <!-- Zoom lens nếu có -->
                            <!-- <div class="zoom-lens"></div> -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                @if ((Session::has('user') && in_array(Session::get('user')['is_admin'], [1, 2])))
                <a href="{{route('product.edit',$item->id)}}" class="btn btn-sm btn-secondary">chỉnh sửa</a>
                @endif
                <h1 class="mb-2">{{$item['name']}}</h1>
                <div class="d-inline-flex align-items-center">
                    <span style="color: #ffc107; font-size: 1.75rem;">★★★★★</span>
                    <span class="lead font-weight-bold pl-2">5</span>
                </div>
                <div class="desc_product mb-3">
                    @if($item['show_price'] == 1)
                    <div id="show-price-buy-product" class="price_product mb-4 text-primary font-weight-bold">{{ number_format( $item['price'], 0, "" ,"." )}}đ </div>
                    @endif
                    @include("$moduleName.pages.$controllerName.child_detail.select_unit")
                    <div class="mb-3 text-center rounded py-3" style="background: #05afe3;">
                        <span class="contact-buy font-weight-bold"><span class="text-light pb-3">Liên hệ Hotline </span><a href="tel:0345488247"><span class="phone">{{$contact}}</span></a></span>
                    </div>
                    <div class="btn-buy-search d-flex justify-content-between flex-wrap mb-3">
                        {!! csrf_field() !!}
                        <div class="d-flex">
                            <label class="col-form-label d-none d-md-block" style="font-size:16px;">Chọn số lượng</label>
                            <div class="input-group" style="width:125px;margin-left:10px;flex-wrap: nowrap">
                                <div class="input-group-prepend">
                                    <span class="input-group-text minus"><i class="fa fa-minus"></i></span>
                                </div>
                                <input type="number" max="999" min="1" name="qty_product" value="1" class="form-control number-product text-center" style="height: calc(1.5em + .75rem + 10px);">
                                <div class="input-group-append">
                                    <span class="input-group-text plus"><i class="fa fa-plus"></i></span>
                                </div>
                            </div>
                        </div>
                        <span name="btn_selectbuy" class="btn-select-buy btn btn-primary text-light m-0" data-href="{{route('fe.cart.addproduct')}}">Chọn mua</span>
                        <input type="hidden" id="product_id" value="{{$item['id']??''}}">
                        <input type="hidden" id="unit_id" value="{{$item['unit_id']??''}}">
                        <input type="hidden" id="code_ref" value="{{$codeRef??''}}">
                        <input type="hidden" id="user_sell" value="{{$item->userProduct->user_id}}">
                    </div>
                </div>
                @php
                $slugUserInfo = $userInfo['slug'] ?? 'unknow';
                $fullNameUserInfo=$userInfo['fullname'] ?? 'unknow';
                @endphp
                <table class="table table-bordered table-striped table-des-product mb-3">
                    <tbody>
                        @if(!empty($item['brand_manufacturer']))
                        <tr>
                            <td style="width: 40%;">Thương hiệu, NSX</td>
                            <td style="width: 60%;">
                                {{$item['brand_manufacturer']}}
                            </td>
                        </tr>
                        @endif
                        @if(!empty($item['number_registered']))
                        <tr>
                            <td>Số đăng ký</td>
                            <td>{{$item['number_registered']??'...'}}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>Nước sản xuất</td>
                            <td>{{$item->countryProduct->name ?? 'Đang cập nhật'}}</td>
                        </tr>
                        @if(!empty($item['dosage_forms']))
                        <tr>
                            <td>Dạng bào chế</td>
                            <td>{{$item['dosage_forms']??'...'}}</td>
                        </tr>
                        @endif
                        @if(!empty($item['specification']))
                        <tr>
                            <td>Quy cách đóng gói</td>
                            <td>{{$item['specification']??'...'}}</td>
                        </tr>
                        @endif
                        @if(!empty($item->elements_mini))
                        <tr>
                            <td>Hoạt chất</td>
                            <td>{!!$item->elements_mini!!}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>Xuất xứ</td>
                            <td>{{$item->brandOriginIdProduct->name ?? 'Đang cập nhật'}}</td>
                        </tr>
                        @if(!empty($item['code']))
                        <tr>
                            <td>Mã sản phẩm</td>
                            <td>{{$item['code'] ?? '...'}}</td>
                        </tr>
                        @endif
                        <tr>
                            <td>Chuyên mục</td>
                            <td>{{$item->catProduct->name??'Đang cập nhật'}}</td>
                        </tr>
                        @if(!empty($item['expiration_date']))
                        <tr>
                            <td>Hạn sử dụng</td>
                            <td>{{$item['expiration_date'] ?? '...'}}</td>
                        </tr>
                        @endif
                    </tbody>
                </table>
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
                <div class="mb-3 d-flex justify-content-between">
                    <div class="float-right btn btn-sm btn-outline-secondary py-1 px-2 btn-buy-search">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown">
                                Xem Shop
                            </button>
                            <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="{{ route('fe.product.drugstore', ['slug' => $slugUserInfo]) }}" style="white-space: normal;width: 90vw; display: block;">{{$fullNameUserInfo}}</a>
                                @foreach($listUserHasProduct as $val)
                                @if(!empty($userInfo['user_id']) && $val['user_id'] != $userInfo['user_id'])
                                @php
                                $slugUserHasProduct = $val['slug'] ?? 'unknow';
                                $fullNameUserHasProduct = $val['fullname'] ?? 'unknow';
                                @endphp
                                <a
                                    class="dropdown-item"
                                    href="{{ route('fe.product.drugstore', ['slug' => $slugUserHasProduct]) }}"
                                    style="white-space: normal; width: 90vw; display: block;">
                                    {{ $fullNameUserHasProduct }}
                                </a>
                                @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="wp-link-affiliate position-relative">
                        <div id="copy-notification" style="display:none;position:absolute;background-color:#28a745;color:white;padding:3px;border-radius:5px;z-index:1000;font-size:14px;">Đã copy!</div>
                        @if(Session::has('user'))
                        <div class="value-link d-none">{{route('fe.product.detail',['slug'=> $item['slug'], 'codeRef'=>$codeRefLogin])}}</div>
                        @else
                        <div class="value-link d-none">{{route('fe.product.detail',$item['slug'])}}</div>
                        @endif
                        <span class="text-primary share-link btn-copy-link">Share <i class="fas fa-share"></i></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="wp-inner">
    <div id="content-detail-product" class="row mb-4">
        @include("$moduleName.pages.$controllerName.child_detail.content_product")
    </div>
</div>
<div class="mt-3 py-3 colorb-wp">
    <div class="wp-inner">
        <div class="comment-product mb-3">
            @include("$moduleName.pages.$controllerName.child_detail.comment_rating_product")
        </div>
        <div id="product-relate">
            @include("$moduleName.pages.$controllerName.child_detail.product_relate",['items'=>$listProductRelate])
        </div>
    </div>
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