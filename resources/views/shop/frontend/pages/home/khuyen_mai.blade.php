@extends('shop.layouts.frontend')

@section('content')
<style>
    .element-1500>ul {
        width: 3000px;
    }

    .element-1500>ul li {
        cursor: pointer;
        user-select: none;
    }

    .element-1500 {
        width: 100vw;
        overflow-x: scroll;
    }

    .item-ncc-km {
        cursor: pointer;
        padding-bottom: 5px;
        transition: border-bottom 0.2s ease;
    }

    .item-ncc-km.active {
        border-bottom: 3px solid #007BFF;
    }
</style>

<div class="wp-inner mt-3">
    <div class="element-1500">
        <ul class="d-flex">
            @foreach($productcers as $index => $val)
            @php
            $imgThumb = isset($val['details']['image']) && $val['details']['image'] != ''
            ? route('home') . $val['details']['image']
            : route('home') . '/laravel-filemanager/fileUpload/nhathuoc/nhathuocmau10.jpg';

            $slug = $val['slug'];
            $urlAjax = $urlAjax??route('fe.home.ajaxShowProductNccInKhuyenmai');
            @endphp
            <li class="position-relative pr-1 item-ncc-km {{ $index == 0 ? 'active' : '' }}" data-slug="{{$slug}}" data-href="{{$urlAjax}}">
                <div class="wp-img-thumb-product mb-2 text-center">
                    <img loading="lazy" src="{{ $imgThumb }}" alt="{{ $val['fullname'] }}" width="100" decoding="async" style="width: 100px;">
                </div>
                <div class="pl-1">
                    <div class="text-center wp-name-product">
                        <p class="truncate3 no-click" style="font-size: 14px;line-height: 16px;">{{ $val['fullname'] }}</p>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div id="product-ncc-km">
        @include("$moduleName.pages.$controllerName.child_khuyen_mai.ls_product_ncc",['lsProductKm'=>$lsProductKm])
    </div>
    
</div>
@endsection