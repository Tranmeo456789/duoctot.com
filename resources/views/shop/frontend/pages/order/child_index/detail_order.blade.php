@php
use App\Helpers\Template as Template;
use App\Helpers\MyFunction;
use App\Model\Shop\UnitModel;
$status_order=[
['name'=>'Đang xử lý','slug'=>'dangXuLy'],
['name'=>'Đã xác nhận','slug'=>'daXacNhan'],
['name'=>'Đang giao hàng','slug'=>'dangGiaoHang'],
['name'=>'Đã giao hàng','slug'=>'daGiaoHang'],
['name'=>'Hoàn tất','slug'=>'hoanTat'],
];
@endphp
<div class="header d-flex justify-content-between">
    <div class="tshorder">Chi tiết đơn hàng</div>
    <button class="btn-closenk rimg-center"><img src="{{asset('images/shop/dn4.png')}}" alt=""></button>
</div>
@if(isset($order_detail))
@php
$info_buyer=json_decode($order_detail['buyer'], true);
$ngayDatHang = MyFunction::formatDateFrontend($order_detail['created_at']);
@endphp
<div class="wp-content">
    <div class="top-tab-order">
        <h4 class="mb-0">Đơn hàng <span class="text-info">{{$order_detail['code_order']}}</span></h4>
        <p>Đặt hàng ngày {{$ngayDatHang}}</p>
    </div>
    <div class="tab-header">
        <p>Trạng thái đơn hàng</p>
    </div>
    <div class="wp-status-order">
        <ul class="ls-status-order">
            @foreach($status_order as $item)
            <li>
                <div class="d-flex">
                    <div class="stepper-circle">
                        <div class="{{$item['slug']==$order_detail['status_order']?'stepper-circle-icon':''}}"></div>
                    </div>
                    <div class="stepper-label ml-2">{{$item['name']}}</div>
                </div>
            </li>
            @endforeach
        </ul>
    </div>
    <div class="tab-header">
        <p>Thông tin giao hàng</p>
    </div>
    <div class="item-info">
        <table class="table pd-order mb-0" id="tbList">
            <tbody>
                <tr class="bb_order">
                    <td style="width: 30%">Số đơn hàng</td>
                    <td style="width: 70%" class='name text-info'>{{$order_detail['code_order']}}</td>
                </tr>
                <tr class="bb_order">
                    <td style="width: 30%">Họ và tên</td>
                    <td style="width: 70%" class='name'>{{$info_buyer['fullname']}}</td>
                </tr>
                <tr class="bb_order pb-1">
                    <td style="width: 30%">Số điện thoại người đặt</td>
                    <td style="width: 70%" class='name'>{{$info_buyer['phone']}}</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="tab-header">
        <p>Thông tin nhận hàng & thanh toán</p>
    </div>
    <div class="item-info">
        <table class="table pd-order mb-0" id="tbList">
            <tbody>
                <tr class="bb_order">
                    <td style="width: 30%">Họ và tên người nhận</td>
                    <td style="width: 70%">{{$info_buyer['fullname']}}</td>
                </tr>
                <tr class="bb_order">
                    <td style="width: 30%">Số điện thoại người nhận</td>
                    <td style="width: 70%" class='name'>{{$info_buyer['phone']}}</td>
                </tr>
                <tr class="bb_order pb-1">
                    <td style="width: 30%">Nhận hàng tại</td>
                    <td style="width: 70%" class='name'>{{$address}}</td>
                </tr>
                <tr class="bb_order pb-1">
                    <td style="width: 30%">Phương thức thanh toán</td>
                    <td style="width: 70%" class='name'>Chưa thanh toán</td>
                </tr>
                <tr class="bb_order pb-1">
                    <td style="width: 30%">Thời gian dự kiến</td>
                    <td style="width: 70%" class='name'>.....</td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="item-info px-0">
        <table class="table pd-order mb-0" id="tbList">
            <thead>
                <tr>
                    <th scope="col" colspan="2">Thông tin đơn hàng</th>
                    <th scope="col">Đơn vị</th>
                    <th scope="col">Số lượng</th>
                    <th scope="col">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 0;
                @endphp
                @foreach($order_detail['info_product'] as $val)
                @php
                    $index++;
                    $image = Template::showImagePreviewFileManager($val['image'],$val['slug']??$val['name']);
                    $price = MyFunction::formatNumber($val['price']) . ' đ';
                    $total_money = MyFunction::formatNumber($val['total_money']) . ' đ';
                    $unit=(new UnitModel())->getItem(['id'=>$val['unit_id']],['task' => 'get-item'])->name;
                @endphp
                <tr class="bb_order">
                    <td style="width: 10%" class='name'>
                        {!! $image !!}
                    </td>
                    <td style="width: 40%">
                        <div class="d-flex">
                            <p class="namep-order truncate2">{{$val['name']}}</p>
                        </div>
                    </td>
                    <td style="width: 14%" class='name'>{{$unit}}</td>
                    <td style="width: 10%">{{$val['quantity']}}</td>
                    <td style="width: 20%">{{$total_money}}</td>
                </tr>
                @endforeach
                <tr class="bb_order">
                    <td colspan="3" style="width: 16%" class="text-right">Tổng tiền</td>
                    <td style="width: 16%" class='text-right'>{{MyFunction::formatNumber($order_detail['total'])}} đ</td>
                </tr>
                <tr class="bb_order">
                    <td colspan="3" style="width: 16%" class="text-right font-weight-bold">Cần thanh toán</td>
                    <td style="width: 16%" class='text-right font-weight-bold'>{{MyFunction::formatNumber($order_detail['total'])}} đ</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endif