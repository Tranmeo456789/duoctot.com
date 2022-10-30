
@php
    use App\Helpers\Template;
    use App\Helpers\Hightlight;
    use App\Model\Shop\ProductModel;
    $arrTypeUser = config('myconfig.template.type_user');
    $temp=0;
@endphp
    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
        <thead>
            <tr class="row-heading">
                <th>#</th>
                <th>Họ tên</th>
                <th>Số lượng thuốc</th>
                <th>Thuộc đối tượng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @if (count($items) > 0)
                @foreach ($items as $val)
                    @php
                        $temp++;
                        $params['user_id']=$val['user_id'];
                        $countItems = (new ProductModel)->countItems($params, ['task'  => 'admin-count-items-group-by-user-id']);
                    @endphp
                    <tr>
                        <th scope="row" style="width: 5%">{{$temp}}</th>
                        <td style="width: 30%">{{$val->fullname}}</td>
                        <td style="width: 20%" class="text-center">{{$countItems[0]['count']??0}}</td>
                        <td style="width: 25%">{{$arrTypeUser[$val->user_type_id]}}</td>
                        <td style="width: 20%"></td>
                </tr>
                @endforeach
            @else
                @include("$moduleName.blocks.list_empty", ['colspan' => 5])
            @endif
        </tbody>
</table>