@php
    use App\Helpers\Template as Template;

@endphp
<table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
    <thead>
        <tr class="row-heading">
            <th>STT</th>
            <th>Tên danh mục</th>
            <th>Hình ảnh</th>
            <th>Sắp xếp</th>
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
            $id    = $val['id'];
            $name  = Template::showNestedSetName($val['name'], $val['depth']);
            $image = Template::showImagePreviewFileManager($val['image'], $val['slug']);
            $move  = Template::showNestedSetUpDown($controllerName,$id,$val);
        @endphp
        <tr>
            <td style="width:5%">{{$temp}}</td>
            <td style="width:45%" class='name'>{!! $name !!}</td>
            <td style="width:20%" class="img-in-table">
                {!! $image !!}
            </td>
            <td style="width:75px">
                {!! $move !!}
            </td>
            <td style="width:20%">
                <a href="{{route("$controllerName.edit",$val->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                <a data-href="{{route("$controllerName.delete",$val->id)}}" class="btn btn-sm btn-danger btn-delete text-white" data-id="{{$val->id}}" data-toggle="tooltip" data-placement="top" title="Xóa"  data-token="{{csrf_token()}}" >
                    <i class="fa fa-trash"></i>
                </a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>