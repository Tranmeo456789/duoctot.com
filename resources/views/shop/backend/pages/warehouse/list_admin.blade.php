
@php
    use App\Helpers\Template;
    use App\Helpers\MyFunction;
    use App\Helpers\Hightlight;
    use App\Model\Shop\WarehouseModel;
    use App\Model\Shop\ProductModel;
    $arrTypeUser = config('myconfig.template.type_user');
    $temp=0;
@endphp
<div class="set-withscreen">
    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
        <thead>
            <tr class="row-heading">
                <th>#</th>
                <th>Họ tên</th>
                <th>SL kho hàng</th>
                <th>SL tồn kho</th>
                <th>Giá trị tồn kho</th>
                <th>Thuộc đối tượng</th>
            </tr>
        </thead>
        <tbody>
            @if (count($items) > 0)
                @foreach ($items as $val)
                    @php
                        $temp++;
                        $params['user_id']=$val['user_id'];
                        $countItemWareHouse = (new WarehouseModel)->countItems($params, ['task'  => 'admin-count-items-group-by-user-id']);
                        $sumNumber=(new ProductModel())->sumNumberItems($params, ['task' => 'sum-quantity-product-in-warehouse-of-user-id']);
                        $sumMoney=(new ProductModel())->sumNumberItems($params, ['task' => 'sum-money-product-in-warehouse-of-user-id']);
                    @endphp
                    <tr>
                        <th scope="row" style="width: 5%">{{$temp}}</th>
                        <td style="width: 20%">{{$val->fullname}}</td>
                        <td style="width: 15%" class="text-center">{{$countItemWareHouse[0]['count']??0}}</td>
                        <td style="width: 20%" class="text-center">{{$sumNumber}}</td>
                        <td style="width: 20%" class="text-center">{{MyFunction::formatNumber($sumMoney) . ' đ'}}</td>
                        <td style="width: 20%">{{$arrTypeUser[$val->user_type_id]}}</td>
                </tr>
                @endforeach
            @else
                @include("$moduleName.blocks.list_empty", ['colspan' => 6])
            @endif
        </tbody>
    </table>
</div>