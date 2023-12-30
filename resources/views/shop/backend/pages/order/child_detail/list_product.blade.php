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
                    <th class="text-center">SL</th>
                    <th class="text-center">Mã đại lý</th>
                    <th class="text-center">Thành tiền</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $index = 0;

                    $arrProduct = array_column($itemsProduct->toArray(),'id');
                @endphp
                @foreach($infoProduct as $val)
                    @php
                        $index++;
                        $image = Template::showImagePreviewFileManager($val['image'],$val['slug']??$val['name']);
                        $price = MyFunction::formatNumber($val['price']) . ' đ';
                        $total_money = MyFunction::formatNumber($val['total_money']) . ' đ';
                        $productId = (int)$val['product_id'];
                        $pos = array_search($productId, array_map('intval', $arrProduct));
                        $code = $pos !== false ? $itemsProduct[$pos]['code'] : '';
                        $unit = $pos !== false ? $itemsProduct[$pos]->unitProduct->name : '';
                    @endphp
                    <tr>
                        <td style="width: 3%">{{$index}}</td>
                        <td style="width: 35%" class="img-in-table">
                            <div class="d-flex">
                                <div class="align-items-center"  style="width:15%">
                                    {!! $image !!}
                                </div>
                                <div class="info-product ml-1">
                                    <p class="text-primary font-weight-bold">{{$val['name']}}</p>
                                    <p>Giá: {{$price}}/ <small>{{$unit}}</small></p>
                                </div>
                            </div>
                        </td>
                        <td style="width: 5%" class="text-center">{{$val['quantity']}}</span></td>
                        <td style="width: 19%" class="text-center">{{$val['codeRef']??''}}</span></td>
                        <td style="width: 8%" class="text-center"> {{$total_money}} </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>