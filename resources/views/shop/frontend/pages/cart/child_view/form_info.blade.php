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
    $linkGetListWareHouse = route('fe.warehouse.getList',['user_id'=>$item['user_sell'],'filter_district_id' => 'value_new']);
    $formInputWidth['widthInput'] = 'col-12';
    $inputHiddenTask = Form::hidden('task', 'register');
    $arrTypeGender = config('myconfig.template.type_gender');
    $elements = [
        [
            'label' => Form::label('gender', 'Anh',$formLabelAttr),
            'element' => Form::radio('gender', '1',true),
            'type' =>'inline-text-right',
            'widthElement' => 'col-1',
            'styleFormGroup' => 'mb-1',
        ],[
            'label' => Form::label('gender', ' Chị',$formLabelAttr),
            'element' => Form::radio('gender', '2',false),
            'type' =>'inline-text-right',
            'widthElement' => 'col-1',
            'styleFormGroup' => 'mb-1',
        ],[
            'label' => '',
            'element' => '',
            'widthElement' => 'col-10',
        ],[
            'label' => '',
            'element' => Form::text('fullname', $user->fullname??null,array_merge($formInputAttr,['placeholder'=>'Nhập Họ tên'])),
            'widthElement' => 'col-4',
        ],[
            'label' => '',
            'element' => Form::text('phone', $user->phone??null,array_merge($formInputAttr,['placeholder'=>'Nhập Số điện thoại'])),
            'widthElement' => 'col-4',
        ],[
            'label' => '',
            'element' => '',
            'widthElement' => 'col-4',
        ],[
            'label' => '',
            'element' => Form::text('email', $user->email??null,array_merge($formInputAttr,['placeholder'=>'Nhập Email'])),
            'widthElement' => 'col-4',
        ],[
            'label' => '',
            'element' => '',
            'widthElement' => 'col-8',
        ],[
            'label' => HTML::decode(Form::label('export_tax', '&nbsp;Yêu cầu xuất hóa đơn',$formLabelAttr)),
            'element' => Form::checkbox('export_tax',1,false,['id' => 'export_tax']),
            'type' =>'inline-text-right',
            'widthElement' => 'col-12',
            'styleFormGroup' => 'mb-1',
        ]
    ];
    $elementInvoice = [
        [
            'label' => Form::label('', 'Công ty',$formLabelAttr),
            'element' => Form::radio('invoice[object]',1,false),
            'type' =>'inline-text-right',
            'widthElement' => 'col-2',
            'styleFormGroup' => 'mb-1',
        ],[
            'label' => Form::label('', 'Cá nhân',$formLabelAttr),
            'element' => Form::radio('invoice[object]',2,true),
            'type' =>'inline-text-right',
            'widthElement' => 'col-2',
            'styleFormGroup' => 'mb-1',
        ],[
            'label' => '',
            'element' => '',
            'type' =>'inline-text-right',
            'widthElement' => 'col-8',
            'styleFormGroup' => 'mb-1',
        ],[
            'label' => '',
            'element' => Form::text('invoice[name]', null,array_merge($formInputAttr,['placeholder'=>'Nhập Họ tên'])),
            'widthElement' => 'col-4',
        ],[
            'label' => '',
            'element' => Form::text('invoice[phone]', null,array_merge($formInputAttr,['placeholder'=>'Nhập Số điện thoại'])),
            'widthElement' => 'col-4',
        ],[
            'label' => '',
            'element' => Form::text('invoice[tax_code]', null,array_merge($formInputAttr,['placeholder'=>'Nhập Mã số thuế'])),
            'widthElement' => 'col-4',
        ],[
            'label' => '',
            'element' =>'',
            'widthElement' => 'col-4',
        ],[
            'label' => '',
            'element' => Form::text('invoice[address]', null,array_merge($formInputAttr,['placeholder'=>'Nhập Địa chỉ'])),
            'widthElement' => 'col-4',
        ]
    ];
    $elementChoosePharmacy = [
        [
            'label' => Form::label('', 'Nhận tại nhà thuốc',$formLabelAttr),
            'element' => Form::radio('delivery_method', '1',true),
            'type' =>'inline-text-right',
            'widthElement' => 'col-4',
            'styleFormGroup' => 'mb-1',
        ],[
            'label' => Form::label('', 'Giao hàng tận nơi',$formLabelAttr),
            'element' => Form::radio('delivery_method', '2',false),
            'type' =>'inline-text-right',
            'widthElement' => 'col-4',
            'styleFormGroup' => 'mb-1',
        ],[
            'label' => '',
            'element' => '',
            'type' =>'inline-text-right',
            'widthElement' => 'col-4',
            'styleFormGroup' => 'mb-1',
        ],
    ];
    $elementPharmacy = [
        [
            'label'   => '',
            'element' => Form::select('pharmacy_province_id',[null=>"-- Chọn {$label['province_id']} --"] + $itemsProvince, null, array_merge($formSelect2GetChildAttr,['id' =>'pharmacy_province_id','style' =>'width:100%','data-href'=>$linkGetListDistrict,'data-target' => '#pharmacy_district_id'])),
            'widthElement' => 'col-4',
        ],[
            'label'   => '',
            'element' => Form::select('pharmacy_district_id',[null=>"-- Chọn {$label['district_id']} --"] +  $itemsDistrict,  null, array_merge($formSelect2GetDataAttr,['id' =>'pharmacy_district_id','style' =>'width:100%','data-href'=>$linkGetListWareHouse,'data-target' =>'.receive_store','data-addtion' => 'pharmacy_province_id'])),
            'widthElement' => 'col-4'
        ]
    ];
    $elementHome = [
        [
            'label' => '',
            'element' => Form::text('fullname', $user->fullname??null,array_merge($formInputAttr,['placeholder'=>'Nhập Họ tên'])),
            'widthElement' => 'col-4'
        ],[
            'label' => '',
            'element' => Form::text('phone', $user->phone??null,array_merge($formInputAttr,['placeholder'=>'Nhập Số điện thoại'])),
            'widthElement' => 'col-4'
        ],[
            'label'   => '',
            'element' => '',
            'widthElement' => 'col-4'
        ],[
            'label'   => '',
            'element' => Form::select('province_id',$itemsProvince, null, array_merge($formSelect2GetChildAttr,['id' =>'province_id','style' =>'width:100%','data-href'=>$linkGetListDistrict,'data-target' => '#district_id'])),
            'widthElement' => 'col-4'
        ],[
            'label'   => '',
            'element' => Form::select('district_id',[null=>"-- Chọn {$label['district_id']} --"] +  $itemsDistrict,  null, array_merge($formSelect2GetChildAttr,['id' =>'district_id','data-href'=>$linkGetListDistrict,'data-target' => '#ward_id','style' =>'width:100%'])),
            'widthElement' => 'col-4'
        ],[
            'label'   => '',
            'element' => '',
            'widthElement' => 'col-4'
        ],[
            'label'   => '',
            'element' => Form::select('ward_id',[null=>"-- Chọn {$label['ward_id']} --"] +  $itemsWard,  null, array_merge($formSelect2GetChildAttr,['id' =>'ward_id','style' =>'width:100%'])),
            'widthElement' => 'col-8'
        ],[
            'label'   => '',
            'element' => '',
            'widthElement' => 'col-4'
        ],[
            'label' => '',
            'element' => Form::text('address', $user->phone??null,array_merge($formInputAttr,['placeholder'=>'Địa chỉ'])),
            'widthElement' => 'col-8',
        ],
    ];
@endphp
{{ Form::open([
    'method'         => 'POST',
    'url'            => route('fe.order.completed'),
    'accept-charset' => 'UTF-8',
    'class'          => '',
    'id'             => 'order-complete'])  }}
    <div class="row">
        <div class="col-xl-9 col-lg-12 col-12">
            <div class="col-left-cart">
                @include("$moduleName.pages.$controllerName.child_view.list_cart")
                <div class="pay-cart">
                    <div class="titanh">
                        <h3>Áp dụng ưu đãi</h3>
                        <img src="{{asset('images/shop/ad1.png')}}" alt="">
                    </div>
                    @include("$moduleName.block.payment_vnpay")
                </div>
                <div class="info-customer-cart">
                    <div class="row px-3 py-0">
                        {!! FormTemplate::show($elements,$formInputWidth)  !!}
                    </div>
                    <div class="row rowInovice px-3 py-0 d-none">
                        {!!FormTemplate::show($elementInvoice,$formInputWidth)   !!}
                    </div>
                    <div class="row px-3 py-0">
                        {!!FormTemplate::show($elementChoosePharmacy,$formInputWidth)   !!}
                    </div>
                    <div class="row rowPharmacy px-3 py-0">
                        {!!FormTemplate::show($elementPharmacy,$formInputWidth)   !!}
                        <div class="col-12 receive_store">

                        </div>
                    </div>
                    <div class="row rowHome px-3 py-0 d-none">
                        {!!FormTemplate::show($elementHome,$formInputWidth)   !!}
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-3 col-12">
            <div class="col-right-cart">
                @include("$moduleName.pages.$controllerName.child_view.header_info_order_cart")
                <div class="cmoder">
                    @if(Session::has('user'))
                    {{$inputHiddenTask}}
                    <button value="1" class="complete_order">HOÀN TẤT ĐẶT HÀNG</button>
                    @else
                    <span class="order-noislogin">HOÀN TẤT ĐẶT HÀNG</span>
                    @endif
                    <p>Bằng cách đặt hàng, bạn đồng ý với
                        <span class="underline"> Điều khoản sử dụng </span>của TDoctor
                    </p>
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}