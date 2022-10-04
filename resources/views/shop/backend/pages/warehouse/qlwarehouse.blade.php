@extends('shop.layouts.backend')

@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => true])
<section class="content">
    @include("$moduleName.blocks.notify")
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => 'Quản lý kho hàng'])
                    <div class="set-withscreen ">
                        <div class="list-productwp">
                            <div class="card-body table-warehouse  p-0">
                                @if(count($warehouses)>0)
                                <table class="table table-striped table-checkall table-bordered ">
                                    <thead>
                                        <tr>
                                            <th scope="col" rowspan="2" class="text-center">Thuốc</th>
                                            @foreach($warehouses as $warehouse)
                                            <th scope="col" colspan="2" class="text-center">{{$warehouse['name']}}</th>
                                            @endforeach
                                        </tr>
                                        <tr>
                                            @foreach($warehouses as $warehouse)
                                            <th scope="col" class="text-center">SL TỒN KHO</th>
                                            <th scope="col" class="text-center">NHẬP HÀNG</th>
                                            @endforeach
                                        </tr>
                                    </thead>
                                    <tbody>

                                        @foreach($products as $product)
                                        <tr class="">
                                            <td>
                                                <div class="d-flex">
                                                    <div class="align-self-center"><img style="width:60px" src="{{asset($product['image'])}}" alt=""></div>
                                                    <div class="info-product ml-3">
                                                        <p class="text-success font-weight-bold">{{$product['name']}}</p>
                                                        <p>ID: {{$product['id']}}</p>
                                                        <p>Mã: {{$product['code']}}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            @foreach($warehouses as $k => $warehouse)
                                            <td style="width: 130px" class="text-center">
                                                <span class="number-productwar{{$warehouse['id']}}{{$product['id']}}">{{json_decode($warehouses[$k]['product_id'],true)[$product['id']]}}</span>
                                            </td>
                                            <td style="width: 130px" class="text-center text-danger">
                                                <form action="" method="POST">
                                                    {!! csrf_field() !!}
                                                    <input class="number-addwarehouse number-addwarehouse{{$warehouse['id']}}{{$product['id']}}" type="number" min="1" value="">
                                                    <span class="btnadd-productwarehouse" warehouse_id="{{$warehouse['id']}}" product_id="{{$product['id']}}" id="btnadd-productwarehouse" name="btnadd_productwarehouse">Nhập thêm</span>
                                                </form>
                                            </td>
                                            @endforeach
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                                @else
                                <h3 class="pl-2">Danh sách kho hàng trống</h3>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection