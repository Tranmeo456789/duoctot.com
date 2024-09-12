@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\MyFunction;

    $label            = config('myconfig.template.label');
    $formLabelAttr    = config('myconfig.template.form_element.label');
    $formInputAttr    = config('myconfig.template.form_element.input');
    $formSelect2Attr  = config('myconfig.template.form_element.select2');
    $formSelect2GetChildAttr  = array_merge_recursive(
                                config('myconfig.template.form_element.select2'),
                                config('myconfig.template.form_element.get_child')
                            );
    $formSelect2GetChildAttr = MyFunction::array_fill_muti_values($formSelect2GetChildAttr);
    $linkGetListDistrict = route('district.getListByParentID',['parentID' => 'value_new']);

    $formInputWidth['widthInput']  =  'wp-input col-12';
    $elements = [
        [
            'label'   => '',
            'element' => Form::text('fullname', null, array_merge($formInputAttr,['placeholder'=>'Tìm kiếm...'])),
            'image' => asset('public/images/shop/icon_search.jpg'),
            'widthElement' => 'col-lg-4 col-12',
            'styleFormGroup' => '',
        ],[
            'label'   => '',
            'element' => Form::select('province_id',[null=>"-- Chọn Tỉnh/Thành --"] + $itemsProvinces, null, array_merge($formSelect2GetChildAttr,['id' =>'province_id','style' =>'width:100%','data-href'=>$linkGetListDistrict,'data-target' => '#district_id'])),
            'widthElement' => 'col-lg-3 col-12',
            'widthInput'=>'col-12 input-group',
            'styleFormGroup' => '',
        ],[
            'label'   => '',
            'element' => Form::select('district_id',[null=>"-- Chọn Quận/Huyện --"] +  $itemsDistricts,  null, array_merge($formSelect2Attr,['id' =>'district_id','style' =>'width:100%'])),
            'widthElement' => 'col-lg-3 col-12',
            'widthInput'=>'col-12 input-group',
            'styleFormGroup' => '',
        ]
    ];
@endphp
{{ Form::open([
    'method'         => 'GET',
    'url'            => route('fe.product.listDrugstore'),
    'accept-charset' => 'UTF-8',
    'class'          => 'form-in-modal',
    'id'             => '' ])  }}
    <div>
        <div class="row">
            {!! FormTemplate::show($elements,$formInputWidth)  !!}
            <div class="col-lg-2 col-12">
                <button class="btn btn-primary my-0">Lọc kết quả</button>
            </div>
        </div>
    </div>

{{ Form::close() }}

