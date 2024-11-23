@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\MyFunction;
    use App\Model\Shop\ProductModel;
    use App\Helpers\Template;
    use App\Helpers\Hightlight;

    $arrTypeUser = config('myconfig.template.type_user');
    $temp=0;
    $label            = config('myconfig.template.label');
    $formLabelAttr    = MyFunction::array_fill_muti_values(array_merge_recursive(
                            config('myconfig.template.form_element.label'),
                            ['class' => 'col-12 ']));
    $formInputAttr    = config('myconfig.template.form_element.input');
    $formNumberAttr    = config('myconfig.template.form_element.input_number');
    $formSelect2Attr  = config('myconfig.template.form_element.select2');
    $star             = config('myconfig.template.star');
    $inputHiddenID    = Form::hidden('id', $item['id']??null);
    $date = isset($item['date']) ? MyFunction::formatDateFrontend($item['date']) : (new DateTime())->format('d/m/Y');
    $linkGetProduct = route('product.getItem',['id' => 'value_new']);
    $formInputWidth['widthInput']  =  'col-12';
    $userRef=$item->userRef??'';
    $fullname=$userRef['fullname']??'';
    $phone= $userRef['phone']??'';
    $userAffiliate=$userInfo['fullname'].'-'.$userInfo['phone'].'-'.$userInfo['email']??'';
    $elementsBtn  = [
            [
            'element' => $inputHiddenID .Form::submit('Lưu', ['class'=>'btn btn-primary']),
            'type'    => "btn-submit-center"
        ]
    ];
    $title = (!isset($item['id']) || $item['id'] == '')  ?'Thêm mới':'Sửa thông tin';
@endphp
@extends('shop.layouts.backend')
@section('title',$pageTitle)
@section('content')
@include ("$moduleName.blocks.page_header", ['pageIndex' => false])
<section class="content">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-primary">
                    @include("$moduleName.blocks.x_title", ['title' => $title])
                    <div class="card-body">
                        {{ Form::open([
                            'method'         => 'POST',
                            'url'            => route("user.saveAddProductShop"),
                            'accept-charset' => 'UTF-8',
                            'class'          => 'form-horizontal form-label-left',
                            'id'             => 'main-form' ])  }}
                            <div class="font-weight-bold my-2">Thông tin Shop thêm sản phẩm hiển thị:</div>
                            <input type="hidden" name="user_id" value="{{$userInfo['user_id']??null}}">
                            <div>{{$userAffiliate}}</div>
                            <div class="font-weight-bold my-2">Danh sách sản phẩm cho đại lý:</div>
                            <div>
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
                                                <div><input id="checkAll" type="checkbox" {{ isset($infoProduct) && count($infoProduct) == count($itemsProduct) ? 'checked' : '' }} ></div>
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
                                                    <input class="" name="info_product[]" value="{{ $key }}" type="checkbox" {{ in_array($key, $infoProduct ?? [] ) ? 'checked' : '' }}>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                        @else
                                        @include("$moduleName.blocks.list_empty", ['colspan' => 3])
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                {!! FormTemplate::show($elementsBtn,$formInputWidth)  !!}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection