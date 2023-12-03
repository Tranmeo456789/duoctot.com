@php
$objectProducts=[
    ['name'=>'Trẻ em','slug'=>'tre_em'],
    ['name'=>'Người cao tuổi','slug'=>'nguoi_cao_tuoi'],
    ['name'=>'Phụ nữ cho con bú','slug'=>'phu_nu_cho_con_bu'],
]
@endphp
<h1 class="mb-2 mb-lg-3">
    @include("$moduleName.templates.box_title_product",['title'=>'Sản phẩm theo đối tượng','img'=>'objects.png'])
    @include("$moduleName.templates.select_filter_product",['items'=>$objectProducts])
</h1>
@include("$moduleName.templates.list_product",['items'=>$product_selling])
