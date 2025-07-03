@php
    use App\Helpers\Template;
    use App\Helpers\Hightlight;
    use App\Helpers\MyFunction;
@endphp
    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
        <thead>
            <tr class="row-heading">
                <th>STT</th>
                <th>Tin tức</th>
                <th>Danh mục</th>
                <th>Thời gian</th>
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
                $image = Template::showImagePreviewFileManager($val['image'],$val['slug']??$val['title']);
                $title = Hightlight::show($val->title, $params['search'], 'key_search');
                $nameCatPost = Hightlight::show($val->catPost->name??'', $params['search'], 'key_search');
                $timePost = MyFunction::formatDateFrontend($val['created_at']);
            @endphp
            <tr>
                <td style="width: 5%">{{$temp}}</td>
                <td style="width: 55%" class="img-in-table">
                    <div class="d-flex">
                        <div class="align-items-center"  style="width:15%">
                            {!! $image !!}
                        </div>
                        <div class="info-product ml-1">
                            <p class="text-primary font-weight-bold mb-1"><a href="{{route('fe.post.detail',$val['slug'])}}">{!! $title !!}</a></p>
                        </div>
                    </div>
                </td>
                <td style="width: 15%">{!! $nameCatPost !!}</td>
                <td style="width: 10%">{{$timePost}}</td>
                <td style="width: 15%">
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