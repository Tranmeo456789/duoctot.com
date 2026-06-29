<table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
    <thead>
        <tr class="row-heading">
            <th>STT</th>
            <th>Câu hỏi</th>
            <th>Câu trả lời</th>
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
            <th scope="row" style="width: 10%">{{$temp ?? ''}}</th>
            <td style="width: 70%" class='name'>{{$val->ques ?? ''}}</td>
            <td style="width: 70%" class='name'>{!!$val->ans ?? ''!!}</td>
            <td style="width: 20%">
                <a href="{{ route($controllerName.'.edit', ['productId' => $val->product_id,'id' => $val->id]) }}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                <a data-href="{{route($controllerName.'.delete',['productId' => $val->product_id,'id' => $val->id])}}" class="btn btn-sm btn-danger btn-delete text-white" data-id="{{$val->id}}" data-toggle="tooltip" data-placement="top" title="Xóa"  data-token="{{csrf_token()}}" >
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>