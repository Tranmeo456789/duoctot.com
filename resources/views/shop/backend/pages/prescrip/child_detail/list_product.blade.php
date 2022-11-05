@php
    use App\Helpers\Template as Template;
    use App\Helpers\MyFunction;
@endphp
<div class="card card-info">
    @include("$moduleName.blocks.x_title", ['title' => 'Sản phẩm đã đặt'])
    <div class="card-body p-0">
        <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
            <thead>
                <tr >
                    <th class="text-center">STT</th>
                    <th class="text-center">Tên sản phẩm</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 0;
                @endphp
                @foreach($item as $val)
                    @php
                        $index++;
                    @endphp
                    <tr>
                        <td style="width: 10%" class="text-center">{{$index}}</td>
                        <td style="width: 90%">{{$val}}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>