<table class="table table-striped" id="tbList">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Mã khách hàng</th>
            <th scope="col">Tên khách hàng</th>
            <th scope="col">Số điện thoại</th>
            <th scope="col">Nhóm khách hàng</th>
            <th scope="col">Thao tác</th>
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
            <th scope="row" style="width: 5%">{{$temp}}</th>
            <td style="width: 15%">{{$val->code_customer}}</td>
            <td style="width: 20%">{{$val->name}}</td>
            <td style="width: 20%">{{$val->phone}}</td>
            <td style="width: 20%">{{$val->customer_group}}</td>
            <td style="width: 20%">
                <a href="{{route("$controllerName.edit",$val->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                <a data-href="{{route("$controllerName.delete",$val->id)}}" class="btn btn-sm btn-danger btn-delete text-white" data-id="{{$val->id}}" data-toggle="tooltip" data-placement="top" title="Xóa" data-token="{{csrf_token()}}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>