@php
use App\Helpers\MyFunction;

@endphp
<div class="title-order d-flex justify-content-center">
    <img src="{{asset('images/shop/ode1.png')}}" alt="">
    <h2 class="">THÔNG TIN ĐƠN HÀNG </h2>
</div>
<table>
    <tbody>
        <tr>
            <td class="pl-2 py-2">Tổng tiền</td>
            <td class="text-right pr-2 py-2"><span class="total">{{MyFunction::formatNumber($item['total'])}}</span> đ</td>
        </tr>
        <tr>
            <td class="pl-2 py-2">Khuyến mãi giảm</td>
            <td class="text-right pr-2 py-2">0 đ</td>
        </tr>
        <tr>
            <td class="pl-2 py-2">Phí giao dự kiến</td>
            <td class="text-right pr-2 py-2"><input type="hidden" name="money_ship" value="20000"> 20.000 đ</td>
        </tr>
        <tr>
            <td class="pl-2 py-2 font-weight-bold">Cần thanh toán</td>
            <td class="text-right text-info pr-2 py-2"><span class="total_thanh_toan">{{MyFunction::formatNumber($item['total']+20000)}}</span> đ</td>
        </tr>
    </tbody>
</table>
<!-- <div class="discount-code">
    <h4 class="text-info d-flex justify-content-center py-2">
        <div class="d-flex justify-content-center align-items-center"><img src="{{asset('images/shop/ode2.png')}}" alt=""></div>
        <a class="">Sử dụng mã giảm giá</a>
    </h4>
    <small class="text-danger d-flex justify-content-center">
        <img src="{{asset('images/shop/gd1.png')}}" alt="">
        <span>Vui lòng nhập đầy đủ tên và số điện thoại mua hàng để áp dụng mã giảm giá</span>
    </small>
</div> -->