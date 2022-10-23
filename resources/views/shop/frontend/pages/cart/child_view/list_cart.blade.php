@php
    use App\Helpers\MyFunction;
@endphp

<div class="info-product-cart">
    <div class="table-responsive">
        <table class="table mb-0">
            <tbody>
                <tr class="title-cart">
                    <td colspan="3" class="text-center" style="border:0px">
                        <h1>Có <span class='total_product'>{{$item['total_product']}}</span> sản phẩm trong giỏ hàng</h1>
                    </td>
                </tr>
                @foreach($item['product'] as $val )
                <tr class="item-product" data-id="{{$val['product_id']}}">
                    <td style="width:10%">
                        <a href="" style="display:block; text-align:center"><img src="{{asset($val['image'])}}" alt="" style="width: 100px;"></a>
                    </td>
                    <td style="width:60%" class="text-left">
                        <div class="">
                            <a href="" class="title-product d-block">{{$val['name']}}</a>
                            <span>Đơn giá: <span class="price">{{MyFunction::formatNumber($val['price'])}}</span> đ</span>
                        </div>
                    </td>
                    <td style="width:30%;padding-right:10px;" class="text-right">
                        <div class="form-group mb-1 d-flex" >
                            <div class="input-group input-group-number-product" >
                                <div class="input-group-prepend">
                                  <span class="input-group-text minus"><i class="fa fa-minus"></i></span>
                                </div>
                                <input type="number"  max="999" min="1"  value="{{$val['quantity']}}"
                                    name="quantity" class="form-control number-product"
                                    data-href="{{route('fe.cart.change_quatity',['user_sell' => $item['user_sell'],'id' => $val['product_id'],'value'=>'value_new'])}}">
                                <div class="input-group-append">
                                    <span class="input-group-text plus"><i class="fa fa-plus"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group d-block">
                            <div class="total_money"><span class="money">{{MyFunction::formatNumber($val['total_money'])}}</span><span> đ</span></div>
                        </div>
                        <div class="manipulation d-block">
                            <a href="" class="buy-after"><img src="{{asset('images/shop/ct4.png')}}" alt="">&nbsp;Để mua sau</a>
                            <span> | </span>
                            <a href="{{route('fe.cart.delete',['user_sell'=>$item['user_sell'],'id'=>$val['product_id']])}}" class="delete-product">
                                <img src="{{asset('images/shop/ct5.png')}}" alt="">&nbsp;Xóa
                            </a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>
</div>