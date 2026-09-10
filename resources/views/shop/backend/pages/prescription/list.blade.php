<table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
    <thead>
        <tr class="row-heading">
            <th>STT</th>
            <th>Mã đơn thuốc</th>
            <th>Thông tin đơn thuốc</th>
            <th>Tác vụ</th>
        </tr>
    </thead>
    @php
    $temp=0;
    @endphp
    <tbody>
        @foreach ($items as $val)
        @php
        $temp++;
        @endphp
        <tr>
            <th scope="row" style="width: 10%">{{$temp}}</th>
            <td style="width: 20%" class='name'>{{$val->code??''}}</td>
            <td style="width: 50%" class='name'>Thông tin đơn thuốc</td>
            <td style="width: 20%">
                <a href="{{route("$controllerName.edit",$val->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                <a data-href="{{route("$controllerName.delete",$val->id)}}" class="btn btn-sm btn-danger btn-delete text-white" data-id="{{$val->id}}" data-toggle="tooltip" data-placement="top" title="Xóa"  data-token="{{csrf_token()}}" >
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>