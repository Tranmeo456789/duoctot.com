@php
    use App\Helpers\Template;
    use App\Helpers\MyFunction;
    use App\Helpers\Hightlight;
@endphp
<div class="set-withscreen">
    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
        <thead>
            <tr class="row-heading">
                <th>STT</th>
                <th>Thuốc</th>
                <th>Giá bán</th>
                <th>Người sửa gần nhất</br>BS, DS phê duyệt</th>
                <th>Trạng thái</br>Admin duyệt</th>
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
                    $image = Template::showImagePreviewFileManager('/public'.$val['image'],$val['slug']??$val['name']);
                    $statusProductValue = array_combine(array_keys(config("myconfig.template.column.status_product")),array_column(config("myconfig.template.column.status_product"),'name'));
                    unset($statusProductValue['all']);
                    $name = Hightlight::show($val->name, $params['search'], 'name');
                    $personEdit = $val->userEditProduct['fullname'] ?? '';
                    $personApprover = $val->userApproverProduct['fullname'] ?? '';
                    $adminApproves = $val->adminApproves['fullname'] ?? '';
                @endphp
                <tr>
                    <td style="width: 3%">{{$temp}}</td>
                    <td style="width: 33%" class="img-in-table">
                        <div class="d-flex">
                            <div class="align-items-center"  style="width:15%">
                                {!! $image !!}
                            </div>
                            <div class="info-product ml-1">
                                <p class="text-primary font-weight-bold mb-1"><a href="{{route('fe.product.detail',$val->slug)}}">{!! $name !!}</a></p>
                                <p mb-1><span>Đơn vị: {{$val->unitProduct->name}}</span></p>
                            </div>
                        </div>
                    </td>
                    <td style="width: 10%" class="text-center">{{MyFunction::formatNumber($val->price) . ' đ'}}</td>
                    <td style="width: 15%" >
                        <div>{{$personEdit}}</div>
                        <div class="text-success">{{$personApprover}}</div>
                    </td>            
                    <td style="width: 14%" class="text-center">
                        <span class="badge {{$val->status_product=='da_duyet'?'badge-success':'badge-warning'}} ">{!! $statusProductValue[$val['status_product']]!!}</span>
                        <div>{{$adminApproves}}</div>
                    </td>
                    <td style="width: 15%" class="text-center">
                        <a href="{{route('admin.product.change.status',[$val->id,'da_duyet'])}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top">Phê duyệt</a>
                        <a href="{{route('admin.product.change.status',[$val->id,'tu_choi'])}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top">Từ chối</a>
                        <a href="{{route('admin.product.change.status',[$val->id,'cho_kiem_duyet'])}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top">Chờ phê duyệt</a>
                        <a href="{{route('admin.product.change.status',[$val->id,'sp_an'])}}" class="btn btn-secondary btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top">Ẩn SP</a>
                        <a href="{{route('product.edit',$val->id)}}" class="btn btn-primary btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top">Chỉnh sửa</a>
                        <a href="{{route('question',$val->id)}}" class="btn btn-primary btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top">Câu hỏi</a>
                    </td>
                </tr>
            @endforeach
            @else
                @include("$moduleName.blocks.list_empty", ['colspan' => 6])
            @endif
        </tbody>
    </table>
</div>