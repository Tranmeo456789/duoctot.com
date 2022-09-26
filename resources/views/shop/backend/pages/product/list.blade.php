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
                <th>Tồn trong kho <br/> của tôi</th>
                <th>Trạng thái</th>
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
            $arr_images=explode(",",$val->image);
            $image = Template::showImagePreviewFileManager($val['image'],$val['slug']??$val['name']);
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
            <td style="width: 5%">{{$val->unit}}</td>
            <td style="width: 5%" class="text-right">0</td>
            <td style="width: 7%" class="text-right">{{$val->inventory}}</td>
            <td style="width: 8%"><span class="badge badge-success">Chờ kiểm duyệt</span></td>
            <td style="width: 8%">
                <a href="{{route("$controllerName.edit",$val->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                <a data-href="{{route("$controllerName.delete",$val->id)}}" class="btn btn-sm btn-danger btn-delete text-white" data-id="{{$val->id}}" data-toggle="tooltip" data-placement="top" title="Xóa" data-token="{{csrf_token()}}">
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>