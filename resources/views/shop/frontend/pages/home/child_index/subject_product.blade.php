@php
$object_product=[
    ['name'=>'Trẻ em','slug'=>'tre_em'],
    ['name'=>'Người cao tuổi','slug'=>'nguoi_cao_tuoi'],
    ['name'=>'Phụ nữ cho con bú','slug'=>'phu_nu_cho_con_bu'],
]
@endphp
<h1 class="d-flex justify-content-between mb-5 flex-wrap ">
    <div class="title_cathd mb-sm-2">
        <div class="d-flex align-items-center">
            <div class="d-flex"><img src="{{asset('images/shop/tp3.png')}}" alt=""></div>
            <h1>Sản phẩm theo đối tượng</h1>
        </div>
    </div>
    <div>
        <div class="d-flex justify-content-between flex-wrap  slect-customer">
            <span>Lọc theo</span>
            <div class="d-flex justify-content-between flex-wrap">
                @foreach($object_product as $k=>$item)
                <div class="slect-item-customer {{$k==0?'active-slect':''}}" data-object ="{{$item['slug']}}" data-href="{{route('fe.home.ajaxfilter')}}">
                    <a>{{$item['name']}}</a>
                </div>
                @endforeach
            </div>
        </div>
    </div>
</h1>
<ul class="clearfix list-unstyled list-product-object">
    @include("$moduleName.pages.$controllerName.partial.product_object")
</ul>