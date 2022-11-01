@php
    use App\Helpers\Template;
    use App\Helpers\MyFunction;
@endphp
<div class="set-withscreen">
    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
        <thead>
            <tr class="row-heading">
                <th>STT</th>
                <th>Thuốc</th>
                <th>Đơn vị</th>
                <th>Giá bán</th>
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
                    <td style="width: 10%" class="text-center">{{MyFunction::formatNumber($val->price) . ' đ'}}</td>            
                    <td style="width: 10%" class="text-center"><span class="badge {{$val->status_product=='da_duyet'?'badge-success':'badge-warning'}} ">{!! $statusProductValue[$val['status_product']]!!}</span></td>
                    <td style="width: 15%" class="text-center">
                    @if($val->status_product=='cho_kiem_duyet')
                        <a href="{{route('admin.product.change.status',[$val->id,'da_duyet'])}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top">Phê duyệt</a>
                        <a href="{{route('admin.product.change.status',[$val->id,'tu_choi'])}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top">Từ chối</a>
                    @elseif($val->status_product=='da_duyet')
                        <a href="{{route('admin.product.change.status',[$val->id,'cho_kiem_duyet'])}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top">Hủy duyệt</a>
                    @else
                        <a href="{{route('admin.product.change.status',[$val->id,'cho_kiem_duyet'])}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top">Hoàn tác</a>
                    @endif  
                    </td>
                </tr>
            @endforeach
            @else
                @include("$moduleName.blocks.list_empty", ['colspan' => 6])
            @endif
        </tbody>
    </table>
</div>