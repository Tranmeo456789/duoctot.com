@php
use App\Helpers\MyFunction;
use App\Model\Shop\UnitModel;
@endphp

<div class="info-product-cart">
    <div class="title-cart">
        <div class="text-center">
            <div class="number-product">Có <span class='total_product'>{{$item['total_product']}}</span> sản phẩm trong giỏ hàng</div>
        </div>
    </div>
    @foreach($item['product'] as $val )
    @php
        $unitItem = UnitModel::find($val['unit_id']) ?? [];
    @endphp
    <div class="item-product" data-id="{{$val['product_id']}}">
        <div class="container-fluid py-2">
            <div class="row">
                <div class="col-3 col-md-2 pr-0">
                    <a href="" style="display:block; text-align:center"><img src="{{asset($val['image'])}}" alt="" style="width: 100px;"></a>
                </div>
                <div class="col-9 col-md-10">
                    <div class="row">
                        <div class="col-12 col-md-7 mb-1">
                            <a href="" class="title-product d-block truncate3">{{$val['name']}}</a>
                            <span>Đơn giá: <span class="price">{{MyFunction::formatNumber($val['price'])}}</span> đ / {{$unitItem['name'] ?? ''}}</span>
                        </div>
                        <div class="col-12 col-md-5">
                            <div class="row">
                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-6 col-md-12">
                                            <div class="form-group mb-1">
                                                <div class="input-group input-group-number-product">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text minus"><i class="fa fa-minus"></i></span>
                                                    </div>
                                                    <input type="number" max="999" min="1" value="{{$val['quantity']}}" name="quantity" class="number-product" data-href="{{route('fe.cart.change_quatity',['user_sell' => $item['user_sell'],'id' => $val['product_id'],'value'=>'value_new'])}}">
                                                    <div class="input-group-append">
                                                        <span class="input-group-text plus"><i class="fa fa-plus"></i></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-6 col-md-12">
                                            <div class="form-group d-block">
                                                <div class="total_money font-weight-bold"><span class="money">{{MyFunction::formatNumber($val['total_money'])}}</span><span> đ</span></div>
                                            </div>
                                            
                                        </div>
                                        <div class="col-12">
                                        <div class="manipulation d-block">
                                                <a href="" class="buy-after"><img src="{{asset('images/shop/ct4.png')}}" alt="">&nbsp;Để mua sau</a>
                                                <span> | </span>
                                                <a href="{{route('fe.cart.delete',['user_sell'=>$item['user_sell'],'id'=>$val['product_id']])}}" class="delete-product">
                                                    <img src="{{asset('images/shop/ct5.png')}}" alt="">&nbsp;Xóa
                                                </a>
                                            </div>
                                        </div>
                                        
                                    </div>                                  
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>