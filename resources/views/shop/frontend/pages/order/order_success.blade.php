@php
    use App\Helpers\Template as Template;
    use App\Helpers\MyFunction;
    use App\Model\Shop\UnitModel;
@endphp
@extends('shop.layouts.frontend')

@section('content')
<div class="cbr py-4">
    <div class="">
        <div class="wp-order-success">
            <div class="text-center box-dhtc">
                <span class="icon-order-success">
                    <i class="fas fa-check"></i>
                </span>
                <h2 class="title-dhtc">Đặt hàng thành công</h2>
                <p>Quý khách có thể theo dõi tình trạng đơn hàng bằng cách</p>
                <p><span class="font-weight-bold">"Tra cứu đơn hàng"</span> ngay bên dưới</p>
            </div>
            @if($order['payment']==2)
            <div class="text-center box-dhtc">
                <p>Vui lòng thanh toán số tiền(nếu chưa): <b>{{ MyFunction::formatNumber($order['total']) . ' đ'}}</b> vào tài khoản ngân hàng</p>
                <p>Ngân hàng TMCP Á Châu</p>
                <p>Số tài khoản: 68686388</p>
                <p>Chủ tài khoản: Công ty cổ phần giải pháp TDoctor</p>
                <p>Nội dung ck: {{$buyer['phone']}}</p>
                <p>Nếu quý khách đã thanh toán</p>
                <p>Liên hệ hotline/Zalo 0349444164 để xác nhận thanh toán và hỗ trợ</p>
            </div>
            @endif
            <div class="title-info-order">
                <h1 class=" pd-order">Thông tin giao hàng</h1>
            </div>
            <div class="item-info">
                <table class="table pd-order mb-0" id="tbList">
                    <tbody>
                        <tr class="bb_order">
                            <td style="width: 30%">Số đơn hàng <span class="text-info">{{$order['code_order']}}</span></td>
                            <td style="width: 70%" class='name'><a href=""><span class="search-ttdh">Tra cứu đơn hàng</span></a></td>
                        </tr>
                        <tr class="bb_order">
                            <td style="width: 30%">Họ và tên người đặt</td>
                            <td style="width: 70%" class='name'>{{$buyer['fullname']}}</td>
                        </tr>
                        <tr class="bb_order pb-1">
                            <td style="width: 30%">Số điện thoại người đặt</td>
                            <td style="width: 70%" class='name'>{{$buyer['phone']}}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="title-info-order">
                <h1 class=" pd-order">Thông tin nhận hàng & thanh toán</h1>
            </div>
            <div class="item-info">
                <table class="table pd-order mb-0" id="tbList">
                    <tbody>
                        <tr class="bb_order">
                            <td style="width: 30%">Họ và tên người nhận</td>
                            <td style="width: 70%" class='name'>{{$buyer['fullname']}}</td>
                        </tr>
                        <tr class="bb_order">
                            <td style="width: 30%">Số điện thoại người nhận</td>
                            <td style="width: 70%" class='name'>{{$buyer['phone']}}</td>
                        </tr>
                        <tr class="bb_order">
                            <td style="width: 30%">Nhận hàng tại</td>
                            <td style="width: 70%" class='name'>{{$address}}</td>
                        </tr>
                        <tr class="bb_order">
                            <td style="width: 30%">Phương thức thanh toán</td>
                            <td style="width: 70%" class='name'>{{$order['payment']==2 ? 'Thanh toán ngay(ck)' : 'Thanh toán tại nhà'}}</td>
                        </tr>
                        <tr class="bb_order">
                            <td style="width: 30%">Thời gian dự kiến</td>
                            <td style="width: 70%" class='name'>Có hàng trước ...</td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="item-info">
                <div class="set-screen-375">
                <table class="table pd-order mb-0" id="tbList">
                    <thead>
                        <tr>
                            <th scope="col" colspan="2">Thông tin đơn hàng</th>
                            <th scope="col" class="text-center">Số lượng</th>
                            <th scope="col" class="text-center">Thành tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($info_product as $k => $val)
                        @php
                        $unit=(new UnitModel())->getItem(['id'=>$val['unit_id']],['task' => 'get-item'])->name;
                        $image = Template::showImagePreviewFileManager($val['image'],$val['slug']??$val['name']);
                        $price = MyFunction::formatNumber($val['price']) . ' đ';
                        $total_money = MyFunction::formatNumber($val['total_money']) . ' đ';
                        @endphp
                        <tr class="bb_order">
                            <td style="width:12%" class='name'>
                            {!! $image !!}
                            </td>
                            <td style="width: 47%">
                                <div class="">
                                    <p class="namep-order truncate2 text-info">{{$val['name']}}</p>
                                    <p class="unit-order">Đơn vị: <span>{{$unit}}</span></p>
                                </div>
                            </td>
                            <td style="width: 16%" class="text-center">{{$val['quantity']}}</td>
                            <td style="width: 25%" class='text-center'>{{$total_money}}</td>
                        </tr>
                        @endforeach
                        <tr class="bb_order">
                            <td colspan="2" style="width: 16%" class="text-right">Tổng tiền</td>
                            <td colspan="2" style="width: 16%" class='text-left'>{{MyFunction::formatNumber($order['total'])}} đ</td>
                        </tr>
                        <tr class="bb_order">
                            <td colspan="2" style="width: 16%" class="text-right font-weight-bold">Cần thanh toán</td>
                            <td colspan="2" style="width: 16%" class='text-left font-weight-bold'>{{MyFunction::formatNumber($order['total'])}} đ</td>
                        </tr>
                    </tbody>
                </table>
                </div>

            </div>
            <div class="text-center mt-2">
                <a href="{{route('home')}}" class="exit-home-order">VỀ TRANG CHỦ</a>
            </div>
        </div>
    </div>
</div>


@endsection