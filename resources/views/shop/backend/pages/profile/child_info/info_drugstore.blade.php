@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\MyFunction;
    use App\Helpers\Template as Template;

    $label            = config('myconfig.template.label');
    $formLabelAttr    = array_merge_recursive(
                            config('myconfig.template.form_element.label'),
                            ['class' => 'col-12']
                        );
    $formLabelAttr = MyFunction::array_fill_muti_values($formLabelAttr);

    $formInputAttr    = config('myconfig.template.form_element.input');
    $formSelect2Attr  = config('myconfig.template.form_element.select2');
    $formSelect2GetChildAttr  = array_merge_recursive(
                                config('myconfig.template.form_element.select2'),
                                config('myconfig.template.form_element.get_child')
                            );
    $formSelect2GetChildAttr = MyFunction::array_fill_muti_values($formSelect2GetChildAttr);
    $star             = config('myconfig.template.star');
    $formInputWidth['widthInput']  =  'col-12';
    $inputHiddenID    = Form::hidden('user_id', $item['user_id']??null);
    $inputHiddenTask    = Form::hidden('task', 'update-item');

    $linkGetListDistrict = route('district.getListByParentID',['parentID' => 'value_new']);
    $linkGetListWard = route('ward.getListByParentID',['parentID' => 'value_new']);
    $elementsAdd=[];
    if(!empty($codeRef)){
        $elementsAdd=[
            [
                'label'   => HTML::decode(Form::label('affiliate', 'Mã Affiliate', $formLabelAttr)),
                'element' => '<div class="input-group">
                                ' . Form::text('code_ref', $codeRef ?? null, array_merge($formInputAttr, ['placeholder' => 'Mã Affiliate', 'readonly' => 'readonly', 'id' => 'code_ref'])) . '
                                <button type="button" class="btn btn-outline-secondary btn-sm" id="copyBtn" title="Copied!">Copy</button>
                            </div>',
                'widthElement' => 'col-12 col-md-4',
            ],
        ];
    }
    $elements = [
        [
            'label'   => HTML::decode(Form::label('fullname', 'Họ tên' .  $star, $formLabelAttr)),
            'element' => Form::text('fullname', $item['fullname']??null, array_merge($formInputAttr,['placeholder'=>'Họ tên'])),
            'widthElement' => 'col-12 col-md-8'
        ],[
            'label'   => HTML::decode(Form::label('phone', $label['phone'], $formLabelAttr)),
            'element' => Form::text('phone', $item['phone']??null, array_merge($formInputAttr,['placeholder'=>$label['phone']])),
            'widthElement' => 'col-12 col-md-6'
        ],[
            'label'   => HTML::decode(Form::label('email', $label['email'], $formLabelAttr)),
            'element' => Form::text('email', $item['email']??null, array_merge($formInputAttr,['placeholder'=>$label['email']])),
            'widthElement' => 'col-12 col-md-6'
        ],[
            'label'   => HTML::decode(Form::label('details[province_id]', $label['province_id'] , $formLabelAttr)),
            'element' => Form::select('details[province_id]',$itemsProvince, $details['province_id']??($item['province_id']??null), array_merge($formSelect2GetChildAttr,['id' =>'details[province_id]','style' =>'width:100%','data-href'=>$linkGetListDistrict,'data-target' => '#district_id'])),
            'widthElement' => 'col-12 col-md-4'
        ],[
            'label'   => HTML::decode(Form::label('details[district_id]', $label['district_id'], $formLabelAttr)),
            'element' => Form::select('details[district_id]',[null=>"-- Chọn {$label['district_id']} --"] +  $itemsDistrict,  $details['district_id']??($item['district_id']??null), array_merge($formSelect2GetChildAttr,['id' =>'district_id','data-href'=>$linkGetListWard,'data-target' => '#ward_id','style' =>'width:100%'])),
            'widthElement' => 'col-12 col-md-4'
        ],[
            'label'   => HTML::decode(Form::label('details[ward_id]', $label['ward_id'], $formLabelAttr)),
            'element' => Form::select('details[ward_id]',[null=>"-- Chọn {$label['ward_id']} --"] +  $itemsWard,  $details['ward_id']??($item['ward_id']??null), array_merge($formSelect2Attr,['id' =>'ward_id','style' =>'width:100%'])),
            'widthElement' => 'col-12 col-md-4'
        ],[
            'label'   => HTML::decode(Form::label('address', $label['address'], $formLabelAttr)),
            'element' => Form::text('details[address]', $details['address']??null, array_merge($formInputAttr,['placeholder'=>$label['address']])),
            'widthElement' => 'col-12'
        ],[
            'label'   => HTML::decode(Form::label('sell_area', $label['sell_area'] , $formLabelAttr)),
            'element' => Form::select('details[sell_area]',[0 =>"-- Cả nước --"] + $itemsProvince, $details['sell_area']??0, array_merge($formSelect2Attr,['style' =>'width:100%','multiple' => 'multiple'])),
            'widthElement' => 'col-12'
        ],[
            'label'   => HTML::decode(Form::label('tax_code', $label['tax_code'], $formLabelAttr)),
            'element' => Form::text('details[tax_code]', $details['tax_code']??null, array_merge($formInputAttr,['placeholder'=>$label['tax_code']])),
            'widthElement' => 'col-12 col-md-6'
        ],[
            'label'   => HTML::decode(Form::label('person_represent', $label['person_represent'], $formLabelAttr)),
            'element' => Form::text('details[person_represent]', $details['person_represent']??null, array_merge($formInputAttr,['placeholder'=>$label['person_represent']])),
            'widthElement' => 'col-12 col-md-6'
        ],[
            'label'   => Form::label('','Ảnh đại diện', ['class' => 'col-1 col-form-label']),
            'element' => Form::label('','Chọn ảnh', ['class' => 'btn btn-primary label-select-image']),
            'widthInput' => '',
        ],[
            'label'   => '',
            'element' => Template::showImageAndInputSingle('image', $item['image']?? ($item['details']['image']??null)),
            'widthInput' => 'col-11',
        ],[
                'label'   => Form::label('map', 'Bản đồ', $formLabelAttr),
                'element' => Form::textarea('details[map]', $item['details']['map']?? '', array_merge($formInputAttr,['placeholder'=>'Bản đồ',"rows"=>"5"]))
        ],[
            'element' => $inputHiddenID . $inputHiddenTask .Form::submit('Cập nhật', ['class'=>'btn btn-primary']),
            'type'    => "btn-submit-center"
        ]
    ];
    $elements = array_merge($elementsAdd, $elements);
    $title = 'Cập nhật thông tin';
@endphp

{{ Form::open([
    'method'         => 'POST',
    'url'            => route("$controllerName.save"),
    'accept-charset' => 'UTF-8',
    'class'          => 'form-horizontal form-label-left',
    'id'             => 'main-form' ])  }}
    <div class="row">
        {!! FormTemplate::show($elements,$formInputWidth)  !!}
    </div>
{{ Form::close() }}
