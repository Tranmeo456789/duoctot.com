@php
    use App\Helpers\Template;
@endphp
    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
        <thead>
            <tr class="row-heading">
                <th>STT</th>
                <th>Thuốc</th>
                <th>Đơn vị</th>
                <th>Tổng đơn <br/>đặt hàng</th>
                <th>Tồn trong kho</th>
                <th>Trạng thái</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
    @php
    $temp=0;
    @endphp
    <tbody>
    @if (count($items) > 0)
        @foreach ($items as $val)
            @php
                $temp++;
                $image = Template::showImagePreviewFileManager($val['image'],$val['slug']??$val['name']);
                $statusProductValue = array_combine(array_keys(config("myconfig.template.column.status_product")),array_column(config("myconfig.template.column.status_product"),'name'));
                unset($statusProductValue['all']);
            @endphp
            <tr>
                <td style="width: 3%">{{$temp}}</td>
                <td style="width: 35%" class="img-in-table">
                    <div class="d-flex">
                        <div class="align-items-center"  style="width:15%">
                            {!! $image !!}
                        </div>
                        <div class="info-product ml-1">
                            <p class="text-primary font-weight-bold mb-1">{{$val->name}}</p>
                            <p mb-1>Mã: {{$val->code}}</p>
                        </div>
                    </div>
                </td>
                <td style="width: 5%">{{$val->unitProduct->name}}</td>
                <td style="width: 12%" class="text-center">0</td>
                <td style="width: 7%" class="text-right">{{$val->quantity_in_stock}}</td>
                <td style="width: 8%"><span class="badge {{$val->status_product=='da_duyet'?'badge-success':'badge-warning'}}">{!! $statusProductValue[$val['status_product']]!!}</span></td>
                <td style="width: 8%">
                    <a href="{{route("$controllerName.edit",$val->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                    <a data-href="{{route("$controllerName.delete",$val->id)}}" class="btn btn-sm btn-danger btn-delete text-white" data-id="{{$val->id}}" data-toggle="tooltip" data-placement="top" title="Xóa" data-token="{{csrf_token()}}">
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
        @endforeach
        @else
            @include("$moduleName.blocks.list_empty", ['colspan' => 6])
        @endif
    </tbody>
</table>