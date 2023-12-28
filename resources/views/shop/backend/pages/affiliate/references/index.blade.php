@php
use App\Model\Shop\ProductModel;
use App\Model\Shop\AffiliateProductModel;

use App\Helpers\MyFunction;

@endphp
@extends('shop.layouts.backend')

@section('title','Chi tiết sản phẩm đại lý')
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => false])
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <table class="mb-0 table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
                        <tbody>
                            <tr>
                                <td colspan="2" style="width: 60%" class='text-center'>
                                    <span class="font-weight-bold">Tổng</span>
                                </td>
                                <td scope="row" style="width: 10%" class="text-center">{{$sumLinkCount}}</td>
                                <td scope="row" style="width: 10%" class="text-center">{{$sumQuantity}}</td>
                                <td scope="row" style="width: 20%" class="text-center">{{MyFunction::formatNumber($sumMoney)}} đ</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
                        <thead>
                            <tr class="row-heading">
                                <th>STT</th>
                                <th>Thông tin sản phẩm</th>
                                <th>SLTT(link)</th>
                                <th>SL bán</th>
                                <th>Thu nhập</th>
                            </tr>
                        </thead>
                        @php
                        $index=0;
                        $codeRef=$item['code_ref'];
                        $sumQuantity=0;
                        $sumMoney=0;
                        @endphp
                        <tbody>
                            @foreach ($infoProduct as $val)
                                @php
                                $index++;
                                $product = ProductModel::select('slug','name','price','discount_ref')->find($val['product_id']);
                                $linkAffiliate=route('fe.product.detail', ['slug' => $product['slug'], 'codeRef' => $codeRef]);
                                $quantity = (new \App\Model\Shop\AffiliateModel)->sumQuantityAProductRefAffiliate($codeRef, $val['product_id']);
                                $totalMoney = (new \App\Model\Shop\AffiliateModel)->sumMoneyAProductRefAffiliate($codeRef, $val['product_id']);
                                @endphp
                            <tr>
                                <td scope="row" style="width: 5%">{{$index}}</td>
                                <td style="width: 55%" class='name'>
                                    <div><span class="text-success">{{$product['name']}}</span></div>
                                    <div>Giá: <span class="text-danger">{{MyFunction::formatNumber($product['price'])}} đ</span></div>
                                    <div>Chiết khấu: <span class="text-danger">{{$product['discount_ref']}}%</span></div>
                                    <div class="wp-link-affiliate">Link affiliate:
                                        <span class="btn btn-sm btn-primary show-link"><i class="fas fa-eye"></i></span>
                                        <a href="{{$linkAffiliate}}" class="text-primary value-link" target="_blank">{{$linkAffiliate}}</a>
                                        <span class="btn btn-sm btn-danger d-inline-block ml-2 btn-copy-link">
                                            <i class="far fa-copy"></i>
                                        </span>
                                    </div>
                                </td>
                                <td scope="row" style="width: 10%" class="text-center">{{$val['sum_click']}}</td>
                                <td scope="row" style="width: 10%" class="text-center">{{$quantity}}</td>
                                <td scope="row" style="width: 20%" class="text-center">{{MyFunction::formatNumber($totalMoney)}} đ</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection