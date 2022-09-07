<table class="table table-striped" id="tbList">
    <thead>
        <tr>
            <th scope="col">STT</th>
            <th scope="col">Tên danh mục</th>
            <th scope="col">Hình ảnh</th>
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
            <td style="width: 50%" class='name'>{{$val->name}}</td>
            <th scope="row" style="width: 20%">
                <div><img src="{{asset('public/shop/uploads/images/product/'.$val->image)}}" alt="" style="width:30px;"></div>
            </th>
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