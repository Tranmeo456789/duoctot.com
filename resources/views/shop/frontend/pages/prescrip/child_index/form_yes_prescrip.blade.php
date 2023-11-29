@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\Template as Template;
    use App\Helpers\MyFunction;
    $controllerName='prescrip';
    $elements = [
        [
            'label'   => '',
            'element' => Form::file('albumImage[]', array_merge($formInputAttr,['multiple'=>'multiple','accept'=>'image/*'])),
            'fileAttach'   => (!empty($item['id'])) ? Template::showImageAttachPreview('prescrip', $item['albumImage'],$item['albumImageHash'], $item['id'],['btn' => 'delete']) : null ,
            'type'    => "fileAttachPreview",
            'widthInput' => 'col-11',
        ]
    ];
@endphp

<div class="tcy">
    <p>Để dược sĩ có đầy đủ thông tin tư vấn & xác nhận đơn hàng của quý khách.</p>
    <strong>Vui lòng nhập theo tên thuốc hoặc gửi ảnh chụp đơn thuốc:</strong>
</div>
<div class="tcy-upload">
    <div class="row">
        <div class="col-md-5 py1024-15 mb1024-5">
            <div>
                <div class="text-center seth-img-100">
                    <img src="{{asset('images/shop/prescrip1.png')}}" alt="">
                </div>
            </div>
            <div class="tcy-upload-content text-center f-w-600">
                <p>Nhập theo tên thuốc</p>
                <a class="btn btn-primary btn-sm border-r-1000 addy-product">Thêm thuốc</a>
            </div>
        </div>
        <div class="col-md-7 py1024-15">
            <div>
                <div class="text-center seth-img-100">
                    <img src="{{asset('images/shop/prescrip2.png')}}" alt="">
                </div>
            </div>
            <div class="tcy-upload-content text-center f-w-600">
                <p>Gửi ảnh chụp đơn thuốc</p>
                {!! FormTemplate::show($elements,$formInputWidth)  !!}
            </div>
        </div>
    </div>
</div>
