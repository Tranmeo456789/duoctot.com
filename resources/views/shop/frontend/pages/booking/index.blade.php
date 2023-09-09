@php
     use App\Helpers\Format;
@endphp
@extends('shop.layouts.frontend')
@section('content')
    <!-- begin main -->
    <style type="text/css">

        .search-form {
            background: url(https:/tdoctor.vn/public/v2/img/hero-area.jpeg) no-repeat;
            background-size: cover;
            color: #fff;
            overflow: hidden;
            position: relative;
        }
        .select2 {
            width: 87% !important;
        }

         .form-group .select2-container--default .select2-selection--single .select2-selection__rendered {
            line-height: 28px;
            font-size: 1rem;
        }
         .form-group .select2-container--default .select2-selection--single .select2-selection__arrow {
            height: 26px;
        }
        .search-form .overlay {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(54, 59, 77, 0.70);
        }
        .search-form .search-form-inner{
            margin: 0;
            border: 0;
            padding: 10px;
            width: 100%;
            float: left;
            position: relative;
            background: rgba(128, 128, 128, .5);
            border-radius: 50px;
        }
        .select2-container--default.select2-container--open.select2-container--below .select2-selection--single, .select2-container--default.select2-container--open.select2-container--below .select2-selection--multiple {
            border-bottom-left-radius: 0;
            border-bottom-right-radius: 50px;
        }
        .result-search .select2-container--default .select2-selection--single {
            border: 1px solid #ced4da;
            border-left:none;
        }
        .select2-container .select2-selection{
            padding: 8px 16px;
            border: none;
            border-radius: 50px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            height:40px;
        }
        .select2-container--default  .select2-selection--single .select2-selection__arrow{
            top: 10px;
            right: 13px;
        }
        .datepicker-days th.prev,.datepicker-days th.next{
            margin-top:0px;
        }
        .card-info.card-outline {
            border-top: 3px solid #17a2b8
        }
        .product-filter {
            margin-bottom: 10px;
            background: #fafafa;
            display: inline-block;
            width: 100%;
            padding: 10px 15px;
            line-height: 20px;
        }
        .product-filter .short-name {
            display: inline-block;
            color: #999;
        }
        .product-filter .short-name span {
            float: left;
            margin-right: 5px;
        }
        .product-filter .Show-item {
            float: right;
            line-height: 26px;
        }
        .product-filter .Show-item span {
            color: #999;
            display: inline-block;
            margin-right: 5px;
        }
        .product-filter .Show-item .woocommerce-ordering {
            float: right;
        }
        .product-filter .Show-item .woocommerce-ordering label {
            margin: 0;
        }
        .product-filter .button, .product-filter select {
            font-size: 14px;
            font-weight: 400;
            color: #333;
        }
        .product-filter .nav-tabs {
            float: right;
            margin-right: 10px;
            border: none;
        }
        .product-filter .nav-tabs .nav-link {
            font-size: 22px;
            border: none;
            padding: 2px 10px;
            border-radius: 4px;
            color: #999;
            background: transparent;
        }

        .featured-box {
            width: 100%;
            background: #fff;
            box-shadow: 0px 2px 18px 0px rgba(198, 198, 198, 0.3);
            /*margin-bottom: 15px;*/
            margin-top: 15px;
        }

        .featured-box figure {
        margin: 0;
        width: 100%;
        float: left;
        position: relative;
        }

        .featured-box figure .fee{
        top: 10px;
        left: 10px;
        z-index: 2;
        color: #fff;
        font-size: 17px;
        font-weight: 500;
        text-align: center;
        position: absolute;
        background: #00BCD4;
        padding: 10px;
        display: inline-block;
        }

        .featured-box figure i {
        top: 10px;
        right: 10px;
        z-index: 2;
        color: #fff;
        font-size: 17px;
        font-weight: 500;
        text-align: center;
        position: absolute;
        background: #00BCD4;
        padding: 10px;
        display: inline-block;
        border-radius: 50%;
        }

        .featured-box .feature-content {
        display: inline-block;
        padding: 0px 20px 10px;
        }

        .featured-box .feature-content .product {
        width: 100%;
        float: left;
        font-size: 13px;
        line-height: 18px;
        list-style: none;
        padding: 15px 0 10px;
        }

        .featured-box .feature-content .product a {
        color: #333;
        }

        .featured-box .feature-content .product a i {
        margin-right: 5px;
        }

        .featured-box .feature-content h4 {
        font-size: 16px;
        line-height: 20px;
        text-transform: uppercase;
        }

        .featured-box .feature-content h4 a {
        color: #333;
        }

        .featured-box .feature-content h4 a:hover {
        color: #00BCD4;
        }

        .featured-box .feature-content span {
        margin-bottom: 10px;
        display: block;
        font-size: 13px;
        color: #999;
        }

        .featured-box .feature-content ul.address {
        /*  margin-bottom: 10px;
        */  display: inline-block;
        width: 100%;
        }

        .featured-box .feature-content ul.address li {
        float: left;
        width: 50%;
        line-height: 30px;
        color: #999;
        }

        .featured-box .feature-content ul.address li i {
        margin-right: 5px;
        }

        .featured-box .feature-content ul.address li a {
        color: #999;
        }

        .featured-box .feature-content ul.address li a:hover {
        color: #00BCD4;
        }

        .featured-box .feature-content .listing-bottom {
            border-top: 1px solid #eee;
            display: inline-block;
            width: 100%;
        }

        .featured-box .feature-content .listing-bottom .price {
            font-size: 18px;
            color: #00BCD4;
            margin: 0;
            line-height: 30px;
            padding:0px;
        }

        .featured-box .feature-content .listing-bottom .btn-verified {
        color: #999;
        line-height: 18px;
        font-size: 13px;
        border: 1px solid #eee;
        padding: 4px 10px;
        border-radius: 50px;
        -webkit-transition: all 0.2s linear;
        -moz-transition: all 0.2s linear;
        -o-transition: all 0.2s linear;
        transition: all 0.2s linear;
        }

        .featured-box .feature-content .listing-bottom .btn-verified i {
        margin-right: 3px;
        color: #00BCD4;
        -webkit-transition: all 0.2s linear;
        -moz-transition: all 0.2s linear;
        -o-transition: all 0.2s linear;
        transition: all 0.2s linear;
        }

        .featured-box .feature-content .listing-bottom .btn-verified:hover {
        background: #00BCD4;
        border-color: #00BCD4;
        color: #fff;
        }

        .featured-box .feature-content .listing-bottom .btn-verified:hover i {
        color: #fff;
        }

#list-view .featured-box {
  display: inline-block;
}

#list-view .featured-box figure {
  float: left;
  width: 39%;
}

.featured-box figure img{
  max-height: 250px
}

#list-view .featured-box .feature-content {
  float: left;
  text-align: left;
  padding: 0px 15px 10px 30px;
  width: 49.667%;
}

#list-view .list-box figure {
  float: left;
  width: 38%;
}

#list-view .list-box figure img {
  height: 218px;
  width: 100%;
}

#list-view .list-box .feature-content {
  float: left;
  text-align: left;
  padding: 0px 0px 0px 0px;
  width: 58%;
  margin-left: 20px;
}
.product-filter .nav-tabs .nav-item.show .nav-link,
.product-filter .nav-tabs .nav-link.active {
  border: none;
  color: #fff;
  color: #00BCD4;
}
        .ntg-pagination {
            margin-top:20px;
        }
        .ntg-pagination a {
            margin-right: 0px;
        }
        .ntg-pagination>li>a, .ntg-pagination>li>span {
            font-size: 16px;
            padding: 8px !important;
        }
        .ntg-pagination span,.ntg-pagination a {
           width: 40px;
           text-align: center;
        }
    </style>
    <main>
        <div class="search-form">
           @include('shop.frontend.pages.booking.child_index.search')
        </div>
        <div class="result-search">
            <div class="wp-inner">
                <div class="row mt-3">
                    <div class="col-md-3 col-sm-4 col-12">
                        <div class="col-left">
                            @include('shop.frontend.pages.booking.child_index.col_left');
                        </div>
                    </div>
                    <div class="col-md-9 col-sm-8 col-12">
                        <div class="right-left">
                            <div class="row" style="background-color: #fafafa;">
                                <div class="product-filter">
                                    <div class="short-name">
                                        <span>Hiển thị 1 - 20 trên 20</span>
                                    </div>
                                    <div class="Show-item">
                                      <span>Hiển thị</span>
                                      <form class="woocommerce-ordering" method="post">
                                        <label>
                                          <select name="order" class="orderby" id="nrppsel">
                                            <option value="20" selected="">20</option>
                                            <option value="40">40</option>
                                            <option value="60">60</option>
                                            <option value="120">120</option>
                                          </select>
                                        </label>
                                      </form>
                                    </div>
                                    <ul class="nav nav-tabs">
                                      <li class="nav-item">
                                        <a class="nav-link grid-view" data-toggle="tab"><i class="fas fa-th-large"></i></a>
                                      </li>
                                      <li class="nav-item">
                                        <a class="nav-link list-view active show" data-toggle="tab"><i class="fas fa-list"></i></i></a>
                                      </li>
                                    </ul>
                                  </div>

                                <div class="adds-wrapper">
                                    <div class="tab-content">
                                      <div id="list-view" class="tab-pane fade active show">
                                            <div class="row">
                                                @foreach($items as $key => $val)
                                                    @php
                                                        $cateName = '';
                                                        $folderUpload = '';
                                                        switch ($params['cate']) {
                                                            case 'doctor':
                                                                $linkDetail ="https://tdoctor.vn/danh-sach-bac-si-chi-tiet/" .$val->id;
                                                                $folderUpload = 'doctor';
                                                                $catName = 'Bác sĩ';
                                                                break;
                                                            case 'clinic':
                                                                $linkDetail = "https://tdoctor.vn/phongkham-chitiet/" . $val->id;
                                                                $catName = 'Phòng khám';
                                                                $folderUpload = 'health_facilities';
                                                                break;
                                                            case 'drugstore':
                                                                $linkDetail = "http://tdoctor.vn/nha-thuoc/" . $val->drugstore_url;
                                                                $catName = 'Nhà thuốc';
                                                                $folderUpload = 'health_facilities';
                                                                break;
                                                            default:
                                                                $linkDetail = '';
                                                                break;
                                                        }
                                                    @endphp
                                                    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 product_item">
                                                        <div class="featured-box">
                                                            <figure>
                                                                <i class="far fa-heart"></i>
                                                                <a href="{{$linkDetail}}">
                                                                    <img class="img-fluid" src="https:/tdoctor.vn/public/images/{{$folderUpload}}/{{$val->profile_image}}" alt="">
                                                                </a>
                                                            </figure>
                                                            <div class="feature-content">
                                                                <div class="product">
                                                                    <a href="#">
                                                                        <i class="far fa-folder"></i>
                                                                        {{$catName }}
                                                                    </a>
                                                                </div>
                                                                <h4>
                                                                    <a href="{{$linkDetail }}">{{$val->name}}</a>
                                                                </h4>
                                                                <span>
                                                                    <i class="fas fa-map-marker-alt"></i>&nbsp;{{$val->address}}
                                                                </span>
                                                                <ul class="address">
                                                                    <li>
                                                                        <a href="#">
                                                                            <i class="far fa-clock"></i>Cập nhật: &nbsp; {{Format::formatDateFrontend($val->created_at)}}
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{$linkDetail }}">
                                                                            <i class="fa fa-user"></i>0 bác sĩ
                                                                        </a>
                                                                    </li>
                                                                    <li>
                                                                        <a href="{{$linkDetail }}">
                                                                            <i class="fas fa-box"></i>
                                                                            0 đánh giá
                                                                        </a>
                                                                    </li>
                                                                </ul>
                                                                <div class="listing-bottom pt-1">
                                                                    <h3 class="price float-left">Giá: {{$val->price ?? ''}}</h3>
                                                                    <a data-toggle="modal" data-target="#sendrequest257"
                                                                        href="#" class="btn-verified float-right">Nhận yêu cầu
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                            @include("shop.frontend.pagination.pagination_frontend",['paginator'=>$items])
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


        </div>
    </main>
    <!-- end main -->
@endsection
