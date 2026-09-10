@php
    use App\Helpers\Form as FormTemplate;
    use Carbon\Carbon;
    $label            = config('myconfig.template.label');
    $formLabelAttr    = config('myconfig.template.form_element.label');
    $formInputAttr    = config('myconfig.template.form_element.input');
    $formEditorAttr = config('myconfig.template.form_element.editor');
    $star             = config('myconfig.template.star');
    $formInputWidth['widthInput']  =  'col-12';
    $inputHiddenID    = Form::hidden('id', $item['id']??null);
    $item['date_birth'] = !empty($item['date_birth'])
    ? Carbon::parse($item['date_birth'])->format('d/m/Y')
    : null;
    $elements = [
        [
            'label'   => HTML::decode(Form::label('code', 'Mã đơn thuốc' .  $star, $formLabelAttr)),
            'element' => Form::text('code', $item['code']??null, array_merge($formInputAttr,['placeholder'=>'Hệ thống tự tạo','readonly'=>true])),
            'widthElement' => 'col-6'
        ],[
            'label'   => HTML::decode(Form::label('fullname', 'Họ tên:' .  $star, $formLabelAttr)),
            'element' => Form::text('fullname', $item['fullname']??null, array_merge($formInputAttr,['placeholder'=>'Họ tên'])),
            'widthElement' => 'col-6'
        ],[
            'label'   => HTML::decode(Form::label('date_birth', $label['date_birth'].  $star, $formLabelAttr)),
            'element' => Form::text('date_birth', $item['date_birth'] ?? null, array_merge($formInputAttr, [
                'placeholder' => 'dd/mm/yyyy',
                'class' => 'form-control datepicker-vn',
                'autocomplete' => 'off',
            ])),
            'type'       => "date-picker",
            'widthElement' => 'col-6',
        ],[
            'label'   => HTML::decode(Form::label('weight', 'Cân nặng:', $formLabelAttr)),
            'element' => Form::text('weight', $item['weight']??null, array_merge($formInputAttr,['placeholder'=>'Cân nặng'])),
            'widthElement' => 'col-6'
        ]
    ];
    $elements[] = [
            'label' => Form::label('gender', 'Nam',$formLabelAttr),
            'element' => Form::radio('gender', 1,(isset($item['gender']) && $item['gender'] == 1) ? true : false),
            'type' =>'inline-text-right',
            'widthElement' => 'col-6',
            'styleFormGroup' => 'mb-1',
        ];
    $elements[] = [
            'label' => Form::label('gender', 'Nữ',$formLabelAttr),
            'element' => Form::radio('gender', 2,(!isset($item['gender']) || $item['gender'] == 2) ? true : false),
            'type' =>'inline-text-right',
            'widthElement' => 'col-6',
            'styleFormGroup' => 'mb-1',
        ];
    $elements = array_merge($elements,
        [
            [
                'label'   => HTML::decode(Form::label('number_bhyt', 'Mã số BHYT(nếu có):', $formLabelAttr)),
                'element' => Form::text('number_bhyt', $item['number_bhyt']??null, array_merge($formInputAttr,['placeholder'=>'Mã số BHYT(nếu có)'])),
                'widthElement' => 'col-6'
            ],[
                'label'   => HTML::decode(Form::label('cccd', 'CMT/CCCD (nếu có):', $formLabelAttr)),
                'element' => Form::text('cccd', $item['cccd']??null, array_merge($formInputAttr,['placeholder'=>'CMT/CCCD (nếu có)'])),
                'widthElement' => 'col-6'
            ],[
                'label'   => HTML::decode(Form::label('phone', 'Số điện thoại:' .  $star, $formLabelAttr)),
                'element' => Form::text('phone', $item['phone']??null, array_merge($formInputAttr,['placeholder'=>'Số điện thoại'])),
                'widthElement' => 'col-6'
            ],[
                'label'   => HTML::decode(Form::label('address', 'Địa chỉ liên hệ:' .  $star, $formLabelAttr)),
                'element' => Form::text('address', $item['address']??null, array_merge($formInputAttr,['placeholder'=>'Địa chỉ liên hệ'])),
                'widthElement' => 'col-6'
            ]
        ]
    );
    $elementsThuocDieuTri = [];
    if (isset($item['info_product']) && count($item['info_product']) > 0) {
        foreach ($item['info_product'] as $key => $thuoc) {
            $elementsThuocDieuTri[] = [
                'product_id' => Form::hidden('info_product[product_id][]', $thuoc['product_id'] ?? ''),
                'ma_thuoc' => Form::text('info_product[ma_thuoc][]', $thuoc['ma_thuoc'] ?? null, array_merge($formInputAttr, ['placeholder' => 'Mã thuốc'])),
                'ten_thuoc' => Form::text('info_product[ten_thuoc][]', $thuoc['ten_thuoc'] ?? null, array_merge($formInputAttr, ['placeholder' => 'Tên thuốc'])),
                'hoat_chat' => Form::text('info_product[hoat_chat][]', $thuoc['hoat_chat'] ?? null, array_merge($formInputAttr, ['placeholder' => 'Hoạt chất'])),
                'dvt' => Form::text('info_product[dvt][]', $thuoc['dvt'] ?? null, array_merge($formInputAttr, ['placeholder' => 'ĐVT'])),
                'sl' => Form::number('info_product[sl][]', $thuoc['sl'] ?? null, array_merge($formInputAttr, ['placeholder' => 'SL'])),
                'cach_dung' => Form::textarea('info_product[cach_dung][]', $thuoc['cach_dung'] ?? null, array_merge($formInputAttr, ['placeholder' => 'Cách dùng', 'rows' => 1])),
            ];
        }
    } else {
        $elementsThuocDieuTri[] = [
            'product_id' => Form::hidden('info_product[product_id][]', $thuoc['product_id'] ?? ''),
            'ma_thuoc' => Form::text('info_product[ma_thuoc][]', null, array_merge($formInputAttr, ['placeholder' => 'Mã thuốc'])),
            'ten_thuoc' => Form::text('info_product[ten_thuoc][]', null, array_merge($formInputAttr, ['placeholder' => 'Tên thuốc'])),
            'hoat_chat' => Form::text('info_product[hoat_chat][]', null, array_merge($formInputAttr, ['placeholder' => 'Hoạt chất'])),
            'dvt' => Form::text('info_product[dvt][]', null, array_merge($formInputAttr, ['placeholder' => 'ĐVT'])),
            'sl' => Form::number('info_product[sl][]', null, array_merge($formInputAttr, ['placeholder' => 'SL'])),
            'cach_dung' => Form::textarea('info_product[cach_dung][]', null, array_merge($formInputAttr, ['placeholder' => 'Cách dùng', 'rows' => 1])),
        ];
    }
    $elements1 = [
        [
            'label'   => Form::label('note', 'Thông tin bổ sung', $formLabelAttr),
            'element' => Form::textarea('note', $item['note']?? '', array_merge($formEditorAttr,['placeholder'=>$label['note'],"rows"=>"5"]))
        ],[
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
                            'url'            => route("$controllerName.save"),
                            'accept-charset' => 'UTF-8',
                            'class'          => 'form-horizontal form-label-left',
                            'id'             => 'main-form' ])  }}
                            <div class="row">
                                {!! FormTemplate::show($elements,$formInputWidth)  !!}
                            </div>
                            <label>Thuốc điều trị:</label>
                            <table class="table table-bordered" id="table-thuoc-dieu-tri">
                                <thead>
                                    <tr>
                                        <th style="width: 12%;">Mã thuốc <span class="text-danger">*</span></th>
                                        <th style="width: 25%;">Tên thuốc <span class="text-danger">*</span></th>
                                        <th style="width: 20%;">Hoạt chất <span class="text-danger">*</span></th>
                                        <th style="width: 8%;">ĐVT <span class="text-danger">*</span></th>
                                        <th style="width: 8%;">SL <span class="text-danger">*</span></th>
                                        <th style="width: 22%;">Cách dùng <span class="text-danger">*</span></th>
                                        <th style="width: 5%;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($elementsThuocDieuTri as $row)
                                    <tr class="row-thuoc-dieu-tri">
                                        {!! $row['product_id'] !!}
                                        <td>{!! $row['ma_thuoc'] !!}</td>
                                        <td>{!! $row['ten_thuoc'] !!}</td>
                                        <td>{!! $row['hoat_chat'] !!}</td>
                                        <td>{!! $row['dvt'] !!}</td>
                                        <td>{!! $row['sl'] !!}</td>
                                        <td>
                                            {!! $row['cach_dung'] !!}
                                        </td>
                                        <td class="text-center align-middle">
                                            <button type="button" class="btn btn-sm btn-danger btn-delete-row-thuoc"><i class="fa fa-trash"></i></button>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <button type="button" class="btn btn-success btn-sm" id="btn-add-row-thuoc">Thêm</button>
                            <button type="button" class="btn btn-danger btn-danh-sach-thuoc btn-sm" id="btn-danh-sach" data-href="{{ route('prescription.listThuocChung') }}">Danh sách</button>
                            <div class="row">
                                {!! FormTemplate::show($elements1,$formInputWidth)  !!}
                            </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="modal-danh-sach-thuoc" tabindex="-1" role="dialog">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Thông tin thuốc</h5>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <table class="table table-sm table-bordered" id="table-thuoc-tam-chon">
                            <thead>
                                <tr>
                                    <th>Mã thuốc</th>
                                    <th>Hoạt chất</th>
                                    <th>Tên thuốc</th>
                                    <th>ĐVT</th>
                                    <th>Số lượng</th>
                                    <th style="width:40px;"></th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                        <div class="mb-3">
                            <button type="button" class="btn btn-success btn-sm" id="btn-them-dong-trong">Thêm</button>
                            <button type="button" class="btn btn-danger btn-sm" id="btn-luu-thuoc-tam">Lưu</button>
                            <select class="form-control d-inline-block" style="width:220px;" id="select-danh-sach-thuoc">
                                <option value="chung">Danh sách thuốc chung</option>
                            </select>
                            <span class="float-right">
                                <!-- Hoạt chất: <input type="text" id="search-hoat-chat" class="form-control d-inline-block" style="width:200px;"> -->
                                Tên thuốc: <input type="text" id="search-ten-thuoc" class="form-control d-inline-block" style="width:200px;">
                                <button type="button" class="btn btn-success btn-sm" id="btn-search-thuoc-chung"><i class="fa fa-search"></i></button>
                            </span>
                        </div>
                        <div id="wrap-list-thuoc-chung">
                            @include('shop.backend.pages.prescription.child_form.modal_list_thuoc', ['items' => null])
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" id="btn-luu-modal-thuoc">Lưu</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Đóng</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection