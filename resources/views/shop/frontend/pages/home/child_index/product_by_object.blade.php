@php
$object_product=[
    ['name'=>'Trẻ em','slug'=>'tre_em'],
    ['name'=>'Người cao tuổi','slug'=>'nguoi_cao_tuoi'],
    ['name'=>'Phụ nữ cho con bú','slug'=>'phu_nu_cho_con_bu'],
]
@endphp
<h1 class="d-flex justify-content-between mb-2 mb-lg-5 flex-wrap ">
    @include("$moduleName.templates.box_title_product",['title'=>'Sản phẩm theo đối tượng'])
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
@include("$moduleName.templates.list_product",['items'=>$product_selling])
