@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\MyFunction;
    $label = config('myconfig.template.label');
    $formLabelAttr    = config('myconfig.template.form_element.label');
    $formInputAttr = config('myconfig.template.form_element.input');
    $formSelect2Attr = config('myconfig.template.form_element.select2');
    $formSelect2GetChildAttr = array_merge_recursive(
                                    config('myconfig.template.form_element.select2'),
                                    config('myconfig.template.form_element.get_child')
                                    );
    $formSelect2GetChildAttr = MyFunction::array_fill_muti_values($formSelect2GetChildAttr);
    $formSelect2GetDataAttr = array_merge_recursive(
                                    config('myconfig.template.form_element.select2'),
                                    config('myconfig.template.form_element.get_data')
                                    );
    $formSelect2GetDataAttr = MyFunction::array_fill_muti_values($formSelect2GetDataAttr);
    $linkGetListDistrict = route('district.getListByParentID',['parentID' => 'value_new']);
    $linkGetListWard = route('ward.getListByParentID',['parentID' => 'value_new']);
    
    $formInputWidth['widthInput'] = 'col-12';
    
    $inputUserIDHidden = Form::hidden('user_id', \Session::get('user')['user_id']??'');
    $arrTypeGender = config('myconfig.template.type_gender');

    $elements = [
        [
            'label' => Form::label('buyer[gender]', 'Anh',$formLabelAttr),
            'element' => Form::radio('buyer[gender]', 1,(!isset($user->gender) || ($user->gender==1) || ($user->gender != 2)) ? true: false),
            'type' =>'inline-text-right',
            'widthElement' => 'col-6 col-md-5',
            'styleFormGroup' => 'mb-1',
        ],[
            'label' => Form::label('buyer[gender]', ' Chị',$formLabelAttr),
            'element' => Form::radio('buyer[gender]', 2,(isset($user->gender) && ($user->gender==1)) ? true: false),
            'type' =>'inline-text-right',
            'widthElement' => 'col-6 col-md-5',
            'styleFormGroup' => 'mb-1',
        ],[
            'label' => '',
            'element' => Form::text('buyer[fullname]', $user->fullname??null,array_merge(['class'=>'input-prescrip','placeholder'=>'Nhập họ tên'])),
            'type' =>'input-border-radius-blue',
            'widthElement' => 'col-lg-6 col-md-12 mb1024-5',
            'styleFormGroup' => 'has-border'
        ],[
            'label' => '',
            'element' => Form::text('buyer[phone]', $user->phone??null,array_merge(['class'=>'input-prescrip','placeholder'=>'Nhập số điện thoại'])),
            'type' =>'input-border-radius-blue',
            'widthElement' => 'col-lg-6 col-md-12',
            'styleFormGroup' => 'has-border',
        ],
    ];
    
    $formInputIgnoreAttr    = array_merge_recursive(
                                    config('myconfig.template.form_element.input'),
                                    ['class' => '']
                                    );
    $formInputIgnoreAttr = MyFunction::array_fill_muti_values($formInputIgnoreAttr);
    $formSelect2GetChildIgnoreAttr    = array_merge_recursive(
                                        $formSelect2GetChildAttr,
                                    ['class' => '']
                                    );
    $formSelect2GetChildIgnoreAttr = MyFunction::array_fill_muti_values($formSelect2GetChildIgnoreAttr);
    $inputHiddenTask    = Form::hidden('task', 'save_data');
    $formInputWidth['widthInput'] = 'wp-input';
    $elementLocals = [
        [
            'label'   => '',
            'element' => Form::select('province_id',[null=>"-- Chọn {$label['province_id']} --"] + $itemsProvince, null, array_merge($formSelect2GetChildIgnoreAttr,['id' =>'province_id','style' =>'width:100%','data-href'=>$linkGetListDistrict,'data-target' => '#district_id'])),
            'type' =>'select',
            'widthElement' => 'col-lg-6 col-md-12 mb1024-5'
        ],[
            'label'   => '',
            'element' => Form::select('district_id',[null=>"-- Chọn {$label['district_id']} --"], $details['district_id']??null, array_merge($formSelect2GetChildIgnoreAttr,['id' =>'district_id','data-href'=>$linkGetListWard,'data-target' => '#ward_id','style' =>'width:100%'])),
            'type' =>'select',
            'widthElement' => 'col-lg-6 col-md-12 mb1024-5'
        ],[
            'label'   => '',
            'element' => Form::select('ward_id',[null=>"-- Chọn {$label['ward_id']} --"],  $details['ward_id']??null, array_merge($formSelect2Attr,['id' =>'ward_id','style' =>'width:100%'])),
            'type' =>'select',
            'widthElement' => 'col-12 my-1'
        ],[
            'label' => '',
            'element' => Form::text('address', $details['address']??null,array_merge(['class'=>'input-prescrip','placeholder'=>'Nhập địa chỉ'])),
            'type' =>'input-border-radius-blue',
            'widthElement' => 'col-12',
            'styleFormGroup' => 'has-border'
        ],
    ];
@endphp
{{ Form::open([
    'method'         => 'POST',
    'url'            => route('fe.prescrip.save'),
    'accept-charset' => 'UTF-8',
    'class'          => 'form-main-prescrip',
    'enctype'        => 'multipart/form-data',
    'id'             => ''])  }}
    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-yes-prescrip">
            @include("$moduleName.pages.$controllerName.child_index.form_yes_prescrip")
            <div class="wp-input has-error">
                <input type="hidden" class="number_product" name="number_product" value="">
            </div>
            <input type="hidden" class="" name="user_sell" value="">
            <input type="hidden" class="" name="is_prescrip" value="1">
        </div>
        <div class="tab-pane fade" id="pills-profile" role="tabpanel" aria-labelledby="pills-no-prescrip">
            @include("$moduleName.pages.$controllerName.child_index.form_no_prescrip")
        </div>
    </div>
    <div>
        <div class="tshorder">
            <p class="title-list-select font-weight-bold"></p>
        </div>
        <ul class="ls-product-select-prescrip"></ul>
    </div>
    <div class="form-info-buy">
        <div class="row">
            {!! FormTemplate::show($elements,$formInputWidth)  !!}
            <div class="col-12">
                <h6 class="mt-2 font-weight-bold">Địa chỉ nhận hàng</h6>
            </div>
            {!! FormTemplate::show($elementLocals,$formInputWidth)  !!}
            {{$inputHiddenTask }}
            <div class="text-center mt-2 col-12"><button type="submit" class="btn-form-submit" value="1">GỬI CHO DƯỢC SĨ</button></div>
        </div>
    </div>
    
{{ Form::close() }}