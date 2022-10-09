@php
use App\Helpers\Form as FormTemplate;
use App\Helpers\MyFunction;
$label = config('myconfig.template.label');
$formLabelAttr = config('myconfig.template.form_element.label');
$formInputAttr = config('myconfig.template.form_element.input');
$formInputRadioAttr = config('myconfig.template.form_element.input_radio');

$formSelect2Attr = config('myconfig.template.form_element.select2');
$formSelect2GetChildAttr = array_merge_recursive(
config('myconfig.template.form_element.select2'),
config('myconfig.template.form_element.get_child')
);
$formSelect2GetChildAttr = MyFunction::array_fill_muti_values($formSelect2GetChildAttr);
$details = isset($item) ? $item->details->pluck('value','user_field')->toArray() : [];
$linkGetListDistrict = route('district.getListByParentID',['parentID' => 'value_new']);
$linkGetListWard = route('ward.getListByParentID',['parentID' => 'value_new']);

$formInputWidth['widthInput'] = 'col-12 p-0';
$inputHiddenTask = Form::hidden('task', 'register');
$arrTypeGender = config('myconfig.template.type_gender');
$elements = [
[
'label' => Form::label('', 'Anh', ['class'=>'form-check-label']),
'element' => Form::radio('gender', '1',true ,array_merge($formInputRadioAttr)),
'type' =>'input-radio-cart',
'widthElement' => 'col-6',
'styleFormGroup' => '',
],
[
'label' => Form::label('', 'Chị', ['class'=>'form-check-label']),
'element' => Form::radio('gender', '2',false ,array_merge($formInputRadioAttr)),
'type' =>'input-radio-cart',
'widthElement' => 'col-6',
'styleFormGroup' => '',
],
[
'label' => '',
'element' => Form::text('name', $item->fullname??null,['id'=>'name','class'=>'name form-control','placeholder'=>'Nhập Họ tên']),
'type' => 'input-cart',
'widthElement' => 'col-xl-5 col-lg-12',
'styleFormGroup' => '',
],
[
'label' => '',
'element' => Form::text('phone', $item->phone??null,['id'=>'phonecart1','class'=>'form-control phonecart1 phone','placeholder'=>'Nhập số điện thoại']),
'type' => 'input-cart',
'widthElement' => 'col-xl-5 col-lg-12',
'styleFormGroup' => '',
],
[
'label' => '',
'element' => Form::text('email', $item->email??null,['class'=>'form-control mailcart1 email','placeholder'=>'Nhập số điện thoại']),
'type' => 'input-cart',
'widthElement' => 'col-xl-5 col-lg-12',
'styleFormGroup' => '',
],
];
$element_htnh = [
[
'label' => Form::label('', 'Nhận tại nhà thuốc', ['class'=>'form-check-label']),
'element' => Form::radio('local-re', 'Nhận tại nhà thuốc',false ,['id'=>'re1','class'=>'form-check-input local-re']),
'type' =>'input-radio-cart',
'widthElement' => 'col-5',
'styleFormGroup' => '',
],
[
'label' => Form::label('', 'Giao hàng tận nơi', ['class'=>'form-check-label']),
'element' => Form::radio('local-re', 'Giao hàng tận nơi',true ,['id'=>'re2','class'=>'form-check-input local-re']),
'type' =>'input-radio-cart',
'widthElement' => 'col-5',
'styleFormGroup' => '',
],

];
$element_homes = [
[
'label' => '',
'element' => Form::text('name2', $item->fullname??null,['id'=>'name2','class'=>'name2 form-control','placeholder'=>'Nhập Họ tên']),
'type' => 'input-cart',
'widthElement' => 'col-xl-5 col-lg-12',
'styleFormGroup' => '',
],
[
'label' => '',
'element' => Form::text('phone2', $item->phone??null,['id'=>'phone2','class'=>'form-control phone2 phonecart3','placeholder'=>'Nhập số điện thoại']),
'type' => 'input-cart',
'widthElement' => 'col-xl-5 col-lg-12',
'styleFormGroup' => '',
],
[
'label' => '',
'element' => Form::select('city2',$itemsProvince, $details['province_id']??($item['province_id']??null), array_merge($formSelect2GetChildAttr,['id' =>'details[province_id]','style' =>'width:100%','data-href'=>$linkGetListDistrict,'data-target' => '#district_id'])),
'widthElement' => 'col-xl-5 col-lg-12 marb-form'
],
[
'label' => '',
'element' => Form::select('district2',[null=>"-- Chọn {$label['district_id']} --"] + $itemsDistrict, $details['district_id']??($item['district_id']??null), array_merge($formSelect2GetChildAttr,['id' =>'district_id','data-href'=>$linkGetListWard,'data-target' => '#ward_id','style' =>'width:100%'])),
'widthElement' => 'col-xl-5 col-lg-12 marb-form form-position-relative'
],
[
'label' => '',
'element' => Form::select('wards2',[null=>"-- Chọn {$label['ward_id']} --"] + $itemsWard, $details['ward_id']??($item['ward_id']??null), array_merge($formSelect2Attr,['id' =>'ward_id','style' =>'width:100%'])),
'widthElement' => 'col-xl-10 col-lg-12 marb-form form-position-relative'
],
[
'label' => '',
'element' => Form::text('addressdetail2', $details['address']??null,['id'=>'addressdetail2','class'=>'form-control addressdetail2','placeholder'=>'Nhập địa chỉ *']),
'type' => 'input-cart',
'widthElement' => 'col-xl-10 col-lg-12',
'styleFormGroup' => '',
]

];
@endphp
{{ Form::open([
        'method'         => 'POST',
        'url'            => route('fe.order.completed'),
        'accept-charset' => 'UTF-8',
        'class'          => '',
        'id'             => 'order-complete'])  }}
<div class="row ">
    <div class="col-xl-9 col-lg-12 mb-1 pd800-0">
        <div class="wp-left-cart border-radius-800">
            @include("$moduleName.pages.$controllerName.child_product.list_cart")
            <div class="pay-cart">
                <div class="position-relative titanh">
                    <h3>Áp dụng ưu đãi</h3>
                    <img src="{{asset('images/shop/ad1.png')}}" alt="">
                </div>
                @include("$moduleName.block.payment_vnpay")
            </div>
            <div class="info-customer-cart p-2">
                <div class="row mx-0">
                    {!! FormTemplate::show($elements,$formInputWidth) !!}
                    @include("$moduleName.pages.$controllerName.child_product.req_export")
                    {!! FormTemplate::show($element_htnh,$formInputWidth) !!}
                    <div class="de-home mt-3">
                        <div class="col-12">
                            <div class="row">
                                <!-- @php
                                    $formInputWidth['widthInput'] = 'col-12';
                                @endphp
                                {!! FormTemplate::show($element_homes,$formInputWidth) !!} -->
                                @include("$moduleName.pages.$controllerName.child_product.receive_home")                                  
                            </div>
                        </div>
                    </div>
                    <div class="de-store mt-3">
                        @include("$moduleName.pages.$controllerName.child_product.receive_store")
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-3 col-lg-12 pd800-0">
        <div class="info-order border-radius-800">
            @include("$moduleName.pages.$controllerName.child_product.header_info_order_cart")
            <div class="cmoder">
                @if(Session::has('user'))
                {{$inputHiddenTask}}
                <button value="1" class="complete_order">HOÀN TẤT ĐẶT HÀNG</button>
                @else
                <span class="order-noislogin">HOÀN TẤT ĐẶT HÀNG</span>
                @endif
                <p>Bằng cách đặt hàng, bạn đồng ý với
                    <span class="underline"> Điều khoản sử dụng </span>của T Doctor
                </p>
            </div>
        </div>
    </div>
</div>
{{ Form::close() }}