<div class="title-cart">
    <h1>Có {{count(Session::get('cart'))}} sản phẩm trong giỏ hàng</h1>
</div>
<div class="info-product-cart">
    <div class="table-responsive">
        <div class="set-widthtable">
            <table class="table mb-0">
                <tbody>
                    @foreach( Session::get('cart') as $row )
                    <tr>
                        <td style="width:10%">
                            <a href="" style="display:block; text-align:center"><img src="{{asset($row['image'])}}" alt="" style="width: 100px;"></a>
                        </td>
                        <td style="width:60%" class="text-left">
                            <div class="title-product-cart">
                                <a href="" class="truncate2">{{$row['name']}}</a>
                            </div>
                            <span>Đơn vị bán:</span><span class="font-weight-bold">{{$row['unit']}}</span>
                            <p class="font-weight-bold">* Giảm ngay 15%</p>
                        </td>
                        <td style="width:30%" class="text-right">
                            <div class="input-number intable">
                                <span class="pm11">
                                    <span title="" class="minus1 minus2"><i class="fa fa-minus"></i></span>
                                    <input type="number" max="999" min="1" value="{{$row['qty']}}" data-id="{{$row['id']}}" data-rowId="{{$row['rowId']}}" name="qty[{{$row['rowId']}}]" class="num-order number-ajax num-order{{$row['rowId']}}">
                                    <span title="" class="plus1 plus2"><i class="fa fa-plus"></i></span>
                                </span>
                            </div>
                            <div class="price-new price-new{{$row['id']}}">{{number_format($row['price']*$row['qty'],0,',','.')}}<span>đ</span></div>
                            <div class="manipulation">
                                <a href="" class="buy-after"><img src="{{asset('images/shop/ct4.png')}}" alt="">Để mua sau</a>
                                <span> | </span>
                                <a href="{{route('fe.cart.delete',$row['rowId'])}}" class="delete-product"><img src="{{asset('images/shop/ct5.png')}}" alt="">Xóa</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>