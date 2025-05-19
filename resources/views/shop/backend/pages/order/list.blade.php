@php
    use App\Helpers\Template;
    use App\Helpers\MyFunction;
    use App\Helpers\Hightlight;
    use App\Model\Shop\ProductModel;
    $formInputChangeValueAttr    = array_merge_recursive(
                                    config('myconfig.template.form_element.input'),
                                    ['class' => 'sources select_change_attr']
                                    );
    $formInputChangeValueAttr = MyFunction::array_fill_muti_values($formInputChangeValueAttr);
    $statusOrderValue = array_combine(array_keys(config("myconfig.template.column.status_order")),array_column(config("myconfig.template.column.status_order"),'name'));
    unset($statusOrderValue['all']);
    $statusControlOrderValue = array_combine(array_keys(config("myconfig.template.column.status_control")),array_column(config("myconfig.template.column.status_control"),'name'));
 @endphp
    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
        <thead>
            <tr class="row-heading">
                <th>STT</th></th>
                <th>Mã đơn hàng</th>
                <th>Doanh thu</th>
                <th>Danh sách sản phẩm</th>
                <th>Ngày đặt hàng</th>
                <th>Trạng thái đơn hàng</th>
                <th>Trạng thái đối soát</th>
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
                $linkStatusOrder = route('order.changeStatusOrder',['id'=>$val['id'],'value' => 'value_new']);
                $buyer=json_decode($val['buyer'],true)??'';
                $fullname = isset($buyer['fullname']) ? Hightlight::show($buyer['fullname'], $params['search'], 'fullname') : '';
                $phone = isset($buyer['phone']) ? Hightlight::show($buyer['phone'], $params['search'], 'buyer') : '';
                //Form::select('status_order',$statusOrderValue, $val['status_order']??null, array_merge($formInputChangeValueAttr,['style' =>'width:100%','data-href'=>$linkStatusOrder]))
            @endphp
            <tr>
                <td style="width: 3%">{{$index}}</td>
                <td style="width: 15%">
                    <a href="{{route('order.detail',$val['id'])}}">{{$val['code_order']}}</a>
                    <p class="mb-0">{!! $fullname !!}</p>
                    <p>{!! $phone !!}</p>
                </td>
                <td style="width: 12%;text-align:right">{{MyFunction::formatNumber($val['total'])}}</td>
                <td style="width: 20%" class="text-justify">
                    @php $indexProduct = 0; @endphp

                    @if(!empty($val['info_product']) && is_array($val['info_product']))
                        @foreach($val['info_product'] as $product)
                            @php
                                $indexProduct++;
                                $productId = (int)($product['product_id'] ?? 0);
                                $productcurrent = ProductModel::find($productId);
                                $slug = $productcurrent['slug'] ?? '';
                            @endphp
                            @if($productcurrent)
                                <span>{{ $indexProduct }}.</span>
                                <span class="text-primary font-weight-bold">
                                    <a href="{{ route('fe.product.detail', $slug) }}" rel="noopener noreferrer">
                                        {{ $productcurrent['name'] }}
                                    </a>
                                </span><br>
                            @endif
                        @endforeach
                    @else
                        <span class="text-muted">Không có sản phẩm</span>
                    @endif
                </td>
                <td style="width: 10%" class="text-right">{{$ngayDatHang}}</td>
                <td style="width:10%">
                    {!! $statusOrderValue[$val['status_order']]!!}
                </td>
                <td style="width:15%" class="text-danger">
                   <span>{!! $statusControlOrderValue[$val['status_control']] ?? 'Chưa thanh toán' !!}</span>
                </td>
                <td class='text-center'>
                    <a href="{{route('order.detail',$val['id'])}}" class="btn btn-info btn-sm rounded-0 text-white " type="button" data-toggle="tooltip" data-placement="top" title="Xem chi tiết đơn hàng"><i class="fas fa-eye rounded-circle"></i></a>
                </td>
            </tr>
        @endforeach
        @else
            @include("$moduleName.blocks.list_empty", ['colspan' => 8])
        @endif
    </tbody>
</table>