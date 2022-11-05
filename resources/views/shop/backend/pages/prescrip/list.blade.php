@php
    use App\Helpers\Template;
    use App\Helpers\MyFunction;

    $formInputChangeValueAttr    = array_merge_recursive(
                                    config('myconfig.template.form_element.input'),
                                    ['class' => 'sources select_change_attr']
                                    );
    $formInputChangeValueAttr = MyFunction::array_fill_muti_values($formInputChangeValueAttr);
@endphp
    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
        <thead>
            <tr class="row-heading">
                <th>STT</th>
                <th>Khách hàng</th>
                <th>SL sản phẩm</th>
                <th>Ngày đặt hàng</th>
                <th>Tác vụ</th>
            </tr>
        </thead>
    @php
    $index=0;
    @endphp
    <tbody>
        @if (count($items) > 0)
        @foreach ($items as $val)
            @php
                $index++;
                $ngayDatHang = MyFunction::formatDateFrontend($val['created_at']);
                $buyer=json_decode($val['buyer'], true);
            @endphp
            <tr>
                <td style="width: 5%">{{$index}}</td>
                <td style="width: 30%">{{$buyer['fullname']}}</td>
                <td style="width: 20%" class="text-center">{{count($val['info_product'])}}</td>
                <td style="width: 25%" class="text-center">{{$ngayDatHang}}</td>
                <td class='text-center' style="width: 20%">
                    <a href="{{route('prescrip.detail',$val['id'])}}" class="btn btn-info btn-sm rounded-0 text-white " type="button" data-toggle="tooltip" data-placement="top" title="Xem chi tiết đơn hàng"><i class="fas fa-eye rounded-circle"></i></a>
                </td>
            </tr>
            @endforeach
        @else
            @include("$moduleName.blocks.list_empty", ['colspan' => 5])
        @endif
    </tbody>
</table>