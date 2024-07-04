
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
                <th>ID</th>
                <th>Họ tên</th>
                <th>Email</th></th>
                <th>Số điện thoại</th>
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
                        <td style="width: 15%">{{$val->user_id}}</td>
                        <td style="width: 20%">{!! $fullname !!}</td>
                        <td style="width: 15%">{!! $email !!}</td>
                        <td style="width: 15%">{!! $phone !!}</td>
                        <td style="width: 20%">{{$userType}}</td>
                        <td style="width: 10%">
                            <a href="{{route("$controllerName.edit",$val->user_id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                        </td>
                </tr>
                @endforeach
            @else
                @include("$moduleName.blocks.list_empty", ['colspan' => 6])
            @endif
        </tbody>
    </table>
</div>
