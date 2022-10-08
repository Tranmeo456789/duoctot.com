<div class="title-order d-flex justify-content-center">
    <img src="{{asset('images/shop/ode1.png')}}" alt="">
    <h2 class="">THÔNG TIN ĐƠN HÀNG </h2>
</div>
<table>
    @php
    $total=0;
    @endphp
    @foreach( Session::get('cart') as $row )
    @php
    $total+=$row['price']*$row['qty'];
    @endphp
    @endforeach
    <tbody>
        <tr>
            <td class="pl-2 py-2">Tổng tiền</td>
            <td class="text-right pr-2 py-2"><span class="totalt">{{number_format($total,0,',','.')}}</span>đ</td>
        </tr>
        <tr>
            <td class="pl-2 py-2">Khuyến mãi giảm</td>
            <td class="text-right pr-2 py-2">10.000đ</td>
        </tr>
        <tr>
            <td class="pl-2 py-2">Phí giao dự kiến</td>
            <td class="text-right pr-2 py-2">0đ</td>
        </tr>
        <tr>
            <td class="pl-2 py-2 font-weight-bold">Cần thanh toán</td>
            <td class="text-right text-info pr-2 py-2"><span class="totaltg">{{number_format($total-10000,0,',','.')}}</span>đ</td>
        </tr>
    </tbody>
</table>
<div class="discount-code">
    <h4 class="text-info d-flex justify-content-center py-2">
        <img src="{{asset('images/shop/ode2.png')}}" alt="">
        <a href="" class="">Sử dụng mã giảm giá</a>
    </h4>
    <!-- <small class="text-danger d-flex justify-content-center">
                                    <img src="{{asset('images/shop/gd1.png')}}" alt="">
                                    <span>Vui lòng nhập đầy đủ tên và số điện thoại mua hàng để áp dụng mã giảm giá</span>
                                </small> -->
</div>