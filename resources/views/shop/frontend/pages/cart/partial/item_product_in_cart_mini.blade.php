@php
    use App\Helpers\MyFunction;
@endphp
<li data-id="{{$item['product_id']}}" class="item-product">
    <div class="d-flex">
        <div class="col-2 thumb-img-product px-0">
            <img src="{{asset($item['image'])}}">
        </div>
        <div class="col-10 cart-info pl-1 pr-0">
            <a href="" class="name mb-1 d-block">{{$item['name']}}</a>
            <div class="d-block">
                <div class="input-group mb-0">
                    <div class="input-group-prepend price-product">
                      <span class="input-group-text"><span class="price>">{{MyFunction::formatNumber($item['price'])}}</span> đ</span>
                    </div>
                    <input type="text" value="{{$item['quantity']}}" maxlength="3"
                        name="quantity" class="form-control form-control-sm number-product"
                        data-href="{{route('fe.cart.change_quatity',['user_sell' => $user_sell,'id' => $item['product_id'],'value'=>'value_new'])}}">
                    <div class="input-group-append total-money">
                      <span class="input-group-text money">{{ MyFunction::formatNumber($item['price']*$item['quantity'])}} đ</span>
                      <span class="input-group-text px-0" >
                        <span>|</span>
                        <span class="delele-item-in-cart" data-href="{{route('fe.cart.delete',['user_sell'=>$user_sell,'id'=>$item['product_id']])}}">Xóa</span>
                      </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</li>