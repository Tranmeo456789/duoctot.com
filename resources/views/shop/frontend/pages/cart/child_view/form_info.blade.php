@php
    use App\Helpers\Form as FormTemplate;
    use App\Helpers\MyFunction;
    $label = config('myconfig.template.label');
    $formLabelAttr    = config('myconfig.template.form_element.label');
    $formInputAttr = config('myconfig.template.form_element.input_frontend');
    $formInputWidth['widthInput'] = 'wp-input';
    $formInputIgnoreAttr    = array_merge_recursive(
                                    config('myconfig.template.form_element.input_frontend'),
                                    ['class' => 'ignore']
                                    );


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
    $inputUserSellHidden = Form::hidden('user_sell', $item['user_sell']);
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
        ],
        [
            'label' => '',
            'element' => Form::text('buyer[fullname]', $user->fullname??null,array_merge($formInputAttr,['placeholder'=>'Nhập Họ tên'])),
            'type' =>'input-border-radius-blue',
            'widthElement' => 'col-lg-5 col-md-12 mb1024-5',
            'styleFormGroup' => 'has-border'
        ],
        [
            'label' => '',
            'element' => Form::text('buyer[phone]', $user->phone??null,array_merge($formInputAttr,['placeholder'=>'Nhập Số điện thoại'])),
            'type' =>'input-border-radius-blue',
            'widthElement' => 'col-lg-5 col-md-12 mb1024-5',
            'styleFormGroup' => 'has-border'
        ]
    ];
    $formInputIgnoreAttr    = array_merge_recursive(
                                    config('myconfig.template.form_element.input'),
                                    ['class' => 'ignore']
                                    );
    $formInputIgnoreAttr = MyFunction::array_fill_muti_values($formInputIgnoreAttr);

    $formSelect2GetChildIgnoreAttr    = array_merge_recursive(
                                        $formSelect2GetChildAttr,
                                    ['class' => 'ignore']
                                    );
    $formSelect2GetChildIgnoreAttr = MyFunction::array_fill_muti_values($formSelect2GetChildIgnoreAttr);
    $elementInvoice = [
        [
            'label' => Form::label('', 'Công ty',$formLabelAttr),
            'element' => Form::radio('invoice[object]',1,false),
            'type' =>'inline-text-right',
            'widthElement' => 'col-6 col-md-5',
            'styleFormGroup' => 'mb-1',
        ],[
            'label' => Form::label('', 'Cá nhân',$formLabelAttr),
            'element' => Form::radio('invoice[object]',2,true),
            'type' =>'inline-text-right',
            'widthElement' => 'col-6 col-md-5',
            'styleFormGroup' => 'mb-1',
        ],
        [
            'label' => '',
            'element' => Form::text('invoice[name]', $user->fullname??null,array_merge($formInputIgnoreAttr,['placeholder'=>'Nhập Họ tên'])),
            'type' =>'input-border-radius-blue',
            'widthElement' => 'col-lg-5 col-md-12 mb1024-5',
            'styleFormGroup' => 'has-border'
        ],
       [
            'label' => '',
            'element' => Form::text('invoice[phone]', $user->phone??null??null,array_merge($formInputIgnoreAttr,['placeholder'=>'Nhập Số điện thoại'])),
            'type' =>'input-border-radius-blue',
            'widthElement' => 'col-lg-5 col-md-12 mb1024-5',
            'styleFormGroup' => 'has-border'
        ],
        [
            'label' => '',
            'element' => Form::text('invoice[tax_code]', null,array_merge($formInputIgnoreAttr,['placeholder'=>'Nhập Mã số thuế'])),
            'type' =>'input-border-radius-blue',
            'widthElement' => 'col-lg-5 col-md-12 mb1024-5',
            'styleFormGroup' => 'has-border'
        ],
        [
            'label' => '',
            'element' => Form::text('invoice[address]', null,array_merge($formInputIgnoreAttr,['placeholder'=>'Nhập Địa chỉ'])),
            'type' =>'input-border-radius-blue',
            'widthElement' => 'col-lg-5 col-md-12 mb1024-5',
            'styleFormGroup' => 'has-border'
        ]
    ];
    $elementChoosePharmacy = [
        [
            'label' => Form::label('delivery_method2', 'Giao hàng tận nơi',$formLabelAttr),
            'element' => Form::radio('delivery_method', '2',true, ['id' => 'delivery_method2']),
            'type' =>'inline-text-right',
            'widthElement' => 'col-6 col-md-5',
            'styleFormGroup' => 'mb-1',
        ],
        [
            'label' => Form::label('delivery_method1', 'Nhận tại nhà thuốc', $formLabelAttr),
            'element' => Form::radio('delivery_method', '1', false, ['id' => 'delivery_method1']),
            'type' =>'inline-text-right',
            'widthElement' => 'col-6 col-md-5',
            'styleFormGroup' => 'mb-1',
        ]
    ];

    $elementPharmacy = [
        [
        'label'   => '',
        'element' => Form::select('pharmacy[province_id]',[null=>"-- Chọn {$label['province_id']} --"] + $itemsProvince, null, array_merge($formSelect2GetChildAttr,['id' =>'pharmacy_province_id','style' =>'width:100%','data-href'=>$linkGetListDistrict,'data-target' => '#pharmacy_district_id'])),
        'type' =>'select',
        'widthElement' => 'col-lg-5 col-md-12 mb1024-5'
        ],
        [
            'label'   => '',
            'element' => Form::select('pharmacy[district_id]',[null=>"-- Chọn {$label['district_id']} --"] +  $itemsDistrict,  null, array_merge($formSelect2GetDataAttr,['id' =>'pharmacy_district_id','style' =>'width:100%','data-href'=>$linkGetListWareHouse,'data-target' =>'.receive_store','data-addtion' => 'pharmacy_province_id'])),
            'type' =>'select',
            'widthElement' => 'col-lg-5 col-md-12 mb1024-5'
        ]
    ];
   

    $elementHome = [
        [
            'label'   => '',
            'element' => Form::select('receive[province_id]',[null=>"-- Chọn {$label['province_id']} --"] + $itemsProvince, $user->province_id??null, array_merge($formSelect2GetChildAttr,['id' =>'province_id','style' =>'width:100%','data-href'=>$linkGetListDistrict,'data-target' => '#receive-district-id'])),
            'type' =>'select',
            'widthElement' => 'col-lg-5 col-md-12 mb1024-5'
        ],[
            'label'   => '',
            'element' => Form::select('receive[district_id]',[null=>"-- Chọn {$label['district_id']} --"] +  $itemsDistrict, $details['district_id']??null, array_merge($formSelect2GetChildAttr,['id' =>'receive-district-id','data-href'=>$linkGetListWard,'data-target' => '#receive-ward-id','style' =>'width:100%'])),
            'type' =>'select',
            'widthElement' => 'col-lg-5 col-md-12 mb1024-5'
        ],[
            'label'   => '',
            'element' => Form::select('receive[ward_id]',[null=>"-- Chọn {$label['ward_id']} --"] +  $itemsWard,  $details['ward_id']??null, array_merge($formSelect2Attr,['id' =>'receive-ward-id','style' =>'width:100%'])),
            'type' =>'select',
            'widthElement' => 'col-lg-5 col-md-12 my-1'
        ],[
            'label' => '',
            'element' => Form::text('receive[address]', $details['address']??null,array_merge($formInputAttr,['placeholder'=>'Địa chỉ'])),
            'type' =>'input-border-radius-blue',
            'widthElement' => 'col-lg-10 col-md-12 mb1024-5',
            'styleFormGroup' => 'has-border'
        ],[
            'label' => Form::label('payment1', 'Thanh toán khi nhận hàng',$formLabelAttr),
            'element' => Form::radio('payment', '1',true, ['id' => 'payment1']),
            'type' =>'inline-text-right',
            'widthElement' => 'col-6 col-md-5',
            'styleFormGroup' => 'mb-1',
        ],
        [
            'label' => Form::label('payment2', 'Thanh toán ngay(ck)', $formLabelAttr),
            'element' => Form::radio('payment', '2', false, ['id' => 'payment2']),
            'type' =>'inline-text-right',
            'widthElement' => 'col-6 col-md-5',
            'styleFormGroup' => 'mb-1',
        ]
    ];   
@endphp
{{ Form::open([
    'method'         => 'POST',
    'url'            => route('fe.order.completed'),
    'accept-charset' => 'UTF-8',
    'class'          => 'order-complete',
    'id'             => 'main-form'])  }}
    <div class="row">
        <div class="col-12 col-xl-9 mb-2 pd-xl-0">
            <div class="col-left-cart">
                @include("$moduleName.pages.$controllerName.child_view.list_cart")
                <!-- <div class="pay-cart">
                    <div class="titanh">
                        <h3>Áp dụng ưu đãi</h3>
                        <img src="{{asset('images/shop/ad1.png')}}" alt="">
                    </div>
                    @include("$moduleName.block.payment_vnpay")
                </div> -->
                <div class="info-customer-cart mt-2">
                    <div class="container-fluid">
                        <div class="row py-0">
                            {!! FormTemplate::show($elements,$formInputWidth)  !!}
                        </div>
                        <!-- <div class="row rowInovice py-0 d-none">
                            {!!FormTemplate::show($elementInvoice,$formInputWidth)   !!}
                        </div> -->
                        <div class="row py-0">
                            {!!FormTemplate::show($elementChoosePharmacy,$formInputWidth)   !!}
                        </div>
                        <div class="row rowPharmacy py-0 d-none">
                            {!!FormTemplate::show($elementPharmacy,$formInputWidth)   !!}
                            <div class="col-12 receive_store">
                                @include("$moduleName.pages.$controllerName.child_view.receive_store",['items'=>$itemsStore])
                            </div>
                        </div>
                        <div class="row rowHome py-0">
                            {!!FormTemplate::show($elementHome,$formInputWidth)   !!}
                            <div class="info-payment-ck col-12 d-none">
                                <div class="box-dhtc">
                                    <p>Vui lòng thanh toán số tiền: <b><span class="total_thanh_toan">{{MyFunction::formatNumber($item['total'])}}</span> đ</b> vào tài khoản ngân hàng</p>
                                    <p>Ngân hàng TMCP Á Châu</p>
                                    <p>Số tài khoản: 68686388</p>
                                    <p>Chủ tài khoản: Công ty cổ phần giải pháp TDoctor</p>
                                    <p>Liên hệ hotline/Zalo 0349444164 để xác nhận thanh toán và hỗ trợ</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-3 pd-xl-0">
            <div class="col-right-cart">
                @include("$moduleName.pages.$controllerName.child_view.header_info_order_cart")
                <div class="cmoder">
                    {{$inputUserSellHidden}}
                    {{$inputUserIDHidden}}
                    <button type="submit"  value="1" class="complete_order">HOÀN TẤT ĐẶT HÀNG</button>
                    <!-- <span class="order-noislogin">HOÀN TẤT ĐẶT HÀNG</span> -->
                    <p>Bằng cách đặt hàng, bạn đồng ý với
                        <span class="underline"> Điều khoản sử dụng </span>của TDoctor
                    </p>
                </div>
            </div>
        </div>
    </div>
{{ Form::close() }}