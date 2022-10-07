@php
    use App\Helpers\Template;
@endphp
<table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
    <thead>
        <tr class="row-heading">
            <th>STT</th>
            <th>Thuốc</th>
            <th>Số lượng tồn</th>
            @foreach($itemsWarehouses as $warehouse)
            <th>{{$warehouse}}</th>
            @endforeach
        </tr>
    </thead>
    @php
        $temp=0;
    @endphp
    <tbody>
        @if (count($itemsProduct) > 0)
            @foreach ($itemsProduct as $val)
                @php
                    $temp++;
                    $image = Template::showImagePreviewFileManager($val['image'],$val['slug']??$val['name']);
                    $detail = $val->productWarehouse->pluck('quantity', 'warehouse_id')->toArray();
                @endphp
                <tr>
                    <td style="width:20px !important">{{$temp}}</td>
                    <td style="width: 60%" class='name img-in-table'>
                        <div class="d-flex">
                            <div class="align-items-center"  style="width:15%">
                                {!! $image !!}
                            </div>
                            <div class="info-product ml-1">
                                <p class="text-success font-weight-bold mb-1">{{$val->name}}</p>
                                <p mb-1>Mã: {{$val->code}}</p>
                            </div>
                        </div>
                    </td>
                    <td style="width: 10%" class="text-right">{{$val->quantity_in_stock}}</td>
                    @foreach($itemsWarehouses as $keyWarehouse => $valWarehouse)
                    <td class="text-right">{{ $detail[$keyWarehouse]??0 }}</td>
                    @endforeach
                </tr>
            @endforeach
        @else
            @include("$moduleName.blocks.list_empty", ['colspan' => 6])
        @endif
    </tbody>
</table>