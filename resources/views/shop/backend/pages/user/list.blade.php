
@php
    use App\Helpers\Template;
    use App\Helpers\Hightlight;
    $arrTypeUser = config('myconfig.template.type_user');
    $temp=0;
@endphp
<div class="set-withscreen">
    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
        <thead>
            <tr class="row-heading">
                <th>#</th>
                <th>Họ tên, Mã affiliate</th>
                <th>Email, Số điện thoại</th>
                <th>Thuộc đối tượng</th>
                <th>Thao tác</th>
            </tr>
        </thead>
        <tbody>
            @if (count($items) > 0)
                @foreach ($items as $val)
                    @php
                        $temp++;
                        $email = Hightlight::show($val->email, $params['search'], 'email') ?? '';
                        $fullname = Hightlight::show($val->fullname, $params['search'], 'fullname') ?? '';
                        $phone = Hightlight::show($val->phone, $params['search'], 'phone') ?? '';
                        $userType=$arrTypeUser[$val->user_type_id]??'';
                    @endphp
                    <tr>
                        <th scope="row" style="width: 5%">{{$temp}}</th>
                        <td style="width: 25%">
                            {!! $fullname !!}
                            <p>Mã affiliate: <a href="{{route('user.detailListProductAffiliate', $val->user_id )}}">{{$val['codeRef']}}</a></p>
                        </td>
                        <td style="width: 30%">
                            <div>{!! $email !!}</div>
                            <div class="font-weight-bold">{!! $phone !!}</div>
                        </td>
                        <td style="width: 20%">{{$userType}}</td>
                        <td style="width: 25%">
                            <a href="{{route("$controllerName.edit",$val->user_id)}}" class="btn btn-success btn-sm rounded-0 text-white p-2 mr-2" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                            @if($val['user_type_id'] > 1 && $val['is_add_product']==1)
                            <a href="{{route('user.formAddProductShop',$val->user_id)}}" class="btn btn-primary btn-sm rounded-0 text-white p-2" type="button" data-toggle="tooltip" data-placement="top" title="Cập nhật thuốc hiển thị trong Shop">Cập nhật thuốc</a>
                            @elseif($val['user_type_id'] > 1)
                            <a href="{{route('user.formAddProductShop',$val->user_id)}}" class="btn btn-primary btn-sm rounded-0 text-white p-2" type="button" data-toggle="tooltip" data-placement="top" title="Thêm thuốc hiển thị trong Shop">Thêm thuốc</a>
                            @endif
                        </td>
                </tr>
                @endforeach
            @else
                @include("$moduleName.blocks.list_empty", ['colspan' => 6])
            @endif
        </tbody>
    </table>
</div>
