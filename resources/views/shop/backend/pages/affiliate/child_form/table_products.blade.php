@php
use App\Helpers\Template;
use App\Helpers\Hightlight;
@endphp
<table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
    <thead>
        <tr class="row-heading">
            <th>STT</th>
            <th>Thuốc</th>
            <th>
                Thao tác
                <div>
                    Check all 
                </div>
                <div><input id="checkAll" type="checkbox" {{count($item['info_product']) == count($itemsProduct) ? 'checked' : ''}}></div>
            </th>
        </tr>
    </thead>
    @php
    $temp=0;
    @endphp
    <tbody>
        @if (count($itemsProduct) > 0)
        @foreach ($itemsProduct as $key=>$val)
        @php
        $temp++;
        @endphp
        <tr>
            <td style="width: 10%">{{$temp}}</td>
            <td style="width: 70%" class="img-in-table">
                <div class="info-product ml-1 d-flex">
                    <p class="text-primary font-weight-bold mb-1">{{$val}}</p>
                </div>
            </td>
            <td style="width: 20%" class="text-center">
                <div>
                    <input class="" name="info_product[]" value="{{ $key }}" type="checkbox" {{ in_array($key, $item['info_product'] ?? [] ) ? 'checked' : '' }}>
                </div>
            </td>
        </tr>
        @endforeach
        @else
        @include("$moduleName.blocks.list_empty", ['colspan' => 6])
        @endif
    </tbody>
</table>