
@php
    use App\Helpers\Template;
    use App\Helpers\Hightlight;
    use App\Model\Shop\OrderModel;
    $arrTypeUser = config('myconfig.template.type_user');
    $temp=0;
@endphp
<div class="set-withscreen">
    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
        <thead>
            <tr class="row-heading">
                <th rowspan="2">#</th>
                <th rowspan="2">Họ tên</th>
                <th colspan="4">SL đơn hàng của người bán</th>
                <th rowspan="2">Thuộc đối tượng</th>
            </tr>
            <tr class="row-heading">
                <th>Đang xử lý</th>
                <th>Thành công</th>
                <th>Đã hủy</th>
                <th>Tất cả</th>
            </tr>
        </thead>
        <tbody>
            @if (count($items) > 0)
                @foreach ($items as $val)
                    @php
                        $temp++;
                        $params['user_sell']=$val['user_id'];
                        $params['status_order']='all';
                        $countItemsAll = (new OrderModel)->countItems($params, ['task'  => 'admin-count-items-of-user-sell']);
                        $params['status_order']='dangXuLy';
                        $countItemsDangXuly=(new OrderModel)->countItems($params, ['task'  => 'admin-count-items-of-user-sell']);
                        $params['status_order']='daXacNhan';
                        $countItemsDaXacNhan=(new OrderModel)->countItems($params, ['task'  => 'admin-count-items-of-user-sell']);
                        $params['status_order']='dangGiaoHang';
                        $countItemsDangGiaoHang=(new OrderModel)->countItems($params, ['task'  => 'admin-count-items-of-user-sell']);
                        $params['status_order']='daGiaoHang';
                        $countItemsDaGiaoHang=(new OrderModel)->countItems($params, ['task'  => 'admin-count-items-of-user-sell']);
                        $params['status_order']='daHuy';
                        $countItemsDaHuy=(new OrderModel)->countItems($params, ['task'  => 'admin-count-items-of-user-sell']);
                        $params['status_order']='hoanTat';
                        $countItemshoanTat=(new OrderModel)->countItems($params, ['task'  => 'admin-count-items-of-user-sell']);
                    @endphp
                    <tr>
                        <th scope="row" style="width: 5%">{{$temp}}</th>
                        <td style="width: 30%">{{$val->fullname}}</td>
                        <td style="width: 10%" class="text-center text-primary">{{($countItemsDangXuly[0]['count']??0)+($countItemsDaXacNhan[0]['count']??0)+($countItemsDangGiaoHang[0]['count']??0)+($countItemsDaGiaoHang[0]['count']??0)}}</td>
                        <td style="width: 10%" class="text-center text-success">{{$countItemshoanTat[0]['count']??0}}</td>
                        <td style="width: 10%" class="text-center text-danger">{{$countItemsDaHuy[0]['count']??0}}</td>
                        <td style="width: 10%" class="text-center font-weight-bold">{{$countItemsAll[0]['count']??0}}</td>
                        <td style="width: 25%">{{$arrTypeUser[$val->user_type_id]}}</td>
                        
                </tr>
                @endforeach
            @else
                @include("$moduleName.blocks.list_empty", ['colspan' => 5])
            @endif
        </tbody>
    </table>
</div>
