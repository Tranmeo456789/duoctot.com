<table class="table table-striped" id="tbList">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên kho hàng</th>
            <th scope="col">Vị trí kho hàng</th>
            <th scope="col">Tác vụ</th>
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
            <td style="width: 40%" class='name'>{{$val->name}}</td>
            <td style="width: 30%">{{$val->local}}</td>
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