@php
    use App\Helpers\MyFunction;
    use App\Model\Shop\AffiliateModel;
@endphp
<table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
    <thead>
        <tr class="row-heading">
            <th>STT</th>
            <th>Thông tin đại lý</th>
            <th>Số tiền chuyển</th>
            <th>Tác vụ</th>
        </tr>
    </thead>
    @php
    $temp=0;
    @endphp
    <tbody>
    @if($items->count()>0)
        @foreach ($items as $val)
        @php
        $temp++;
        @endphp
        <tr>
            <th scope="row" style="width: 10%">{{$temp}}</th>
            <td style="width: 50%">
                <div>
                    <p>Mã đại lý: {{$val['code_ref']??''}}</p>
                    <p>Họ tên: {{$val['userRef']['fullname']??''}}</p>
                </div>
            </td>
            <td style="width: 20%">
                {{MyFunction::formatNumber($val['money']??0)}} đ
            </td>
            <td style="width: 20%">
                <a href="{{route("$controllerName.edit",['id'=>$val->id,'codeRef'=>$val['code_ref']])}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
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