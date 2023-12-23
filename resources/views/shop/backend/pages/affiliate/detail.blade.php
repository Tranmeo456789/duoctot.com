@php
    use App\Model\Shop\ProductModel;
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
                    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
                        <thead>
                            <tr class="row-heading">
                                <th>STT</th>
                                <th>Thông tin sản phẩm</th>
                            </tr>
                        </thead>
                        @php
                        $index=0;
                        $codeRef=$item['code_ref'];
                        @endphp
                        <tbody>
                            @foreach ($infoProduct as $val)
                            @php
                            $index++;
                            $product = ProductModel::select('slug','name')->find($val['product_id']);
                            $linkAffiliate=route('fe.product.detail', ['slug' => $product['slug'], 'codeRef' => $codeRef]);
                            @endphp
                            <tr>
                                <th scope="row" style="width: 10%">{{$index}}</th>
                                <td style="width: 90%" class='name'>
                                    <div>Tên sản phẩm: <span class="text-success">{{$product['name']}}</span></div>
                                    <div>Chiết khấu: <span class="text-danger">{{$val['discount']}}%</span></div>
                                    <div>Link affiliate: <span class="text-primary">{{$linkAffiliate}}</span></div>
                                </td>
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