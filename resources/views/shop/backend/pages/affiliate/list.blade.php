<table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
    <thead>
        <tr class="row-heading">
            <th>STT</th>
            <th>Mã đại lý</th>
            <th>Thông tin đại lý</th>
            <th>Tác vụ</th>
        </tr>
    </thead>
    @php
        $index=0;
    @endphp
    <tbody>
        @if($items->count()>0)
            @foreach ($items as $val)
            @php
                $index++;
            @endphp
            <tr>
                <th scope="row" style="width: 10%">{{$index}}</th>
                <td style="width: 30%" class='name'>{{$val['code_ref']}}</td>
                <td style="width: 45%" class='text-justify'>
                    <div>Họ tên: {{$val['info_ref']['name']??null}}</div>
                    <div>Số ĐT: {{$val['info_ref']['phone']??null}}</div>
                </td>
                <td style="width: 25%">
                    <a href="{{route("$controllerName.detail",$val->id)}}" class="btn btn-info btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="xem chi tiết"><i class="fa fa-eye"></i></a>
                    <a href="{{route("$controllerName.edit",$val->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                    <a data-href="{{route("$controllerName.delete",$val->id)}}" class="btn btn-sm btn-danger btn-delete text-white" data-id="{{$val->id}}" data-toggle="tooltip" data-placement="top" title="Xóa"  data-token="{{csrf_token()}}" >
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        @else
            @include("$moduleName.blocks.list_empty", ['colspan' => 4])
        @endif
    </tbody>
</table>