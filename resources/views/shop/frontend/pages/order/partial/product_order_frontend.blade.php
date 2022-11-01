@php
    use App\Helpers\MyFunction;
    $statusOrderValue = array_combine(array_keys(config("myconfig.template.column.status_order")),array_column(config("myconfig.template.column.status_order"),'name'));
    unset($statusOrderValue['all']);
@endphp
@if(count($order) > 0)
<div class="tab-content" id="pills-tabContent">
    <div class="table-list-order">
        <div class="header-list-order">
            <p class="wp-40">Mã đơn hàng</p>
            <p class="wp-20 text-center">Số lượng</p>
            <p class="wp-20">Tổng tiền</p>
            <p class="wp-20">Trạng thái</p>
        </div>
        @foreach($order as $item)
        <div class="content-list-order">
            <p class="wp-40 view-detail-order" data-id="{{$item['id']}}" data-href="{{route('fe.order.detail')}}"><a>{{$item['code_order']}}</a></p>
            <p class="wp-20 text-center" >{{$item['total_product']}}</p>
            <p class="wp-20">{{MyFunction::formatNumber($item['total'])}} đ</p>
            <p class="wp-20"> {!! $statusOrderValue[$item['status_order']]!!}</p>
        </div>
        @endforeach
    </div>
</div>
@else
<div class="text-center">
    <img src="{{asset('images/shop/empty-chitiet.png')}}" alt="">
    <p class="text-center">Không có đơn hàng nào</p>
</div>
@endif