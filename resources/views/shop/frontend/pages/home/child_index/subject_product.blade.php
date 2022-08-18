<h1 class="d-flex mb-5 flex-sm-wrap">
    <div class="title_cathd mb-sm-2">
        <h1>Sản phẩm theo đối tượng</h1>
        <img src="{{asset('images/shop/tp3.png')}}" alt="">
    </div>
    <div class="d-flex slect-customer">
        <span>Lọc theo</span>
        <div class="d-flex">
            <div class="slect-item-customer active-slect">
                <a href="">Trẻ em</a>
            </div>
            <div class="slect-item-customer">
                <a href="">Người cao tuổi</a>
            </div>
            <div class="slect-item-customer">
                <a href="">Phụ nữ cho con bú</a>
            </div>
        </div>
    </div>
</h1>
<ul class="clearfix">
    @php
        $items = [
            [ 'name' => 'Siro bổ phế bối mẫu Forte Mom and Baby Tất thành','price'  => '115.000đ','unit'=>'chai','image' => 'selling2.png'],
            [ 'name' => 'Siro bổ phế bối mẫu Forte Mom and Baby Tất thành','price'  => '115.000đ','unit'=>'chai','image' => 'selling3.png'],
            [ 'name' => 'Siro bổ phế bối mẫu Forte Mom and Baby Tất thành','price'  => '115.000đ','unit'=>'chai','image' => 'selling4.png'],
            [ 'name' => 'Siro bổ phế bối mẫu Forte Mom and Baby Tất thành','price'  => '115.000đ','unit'=>'chai','image' => 'selling2.png'],
            [ 'name' => 'Siro bổ phế bối mẫu Forte Mom and Baby Tất thành','price'  => '115.000đ','unit'=>'chai','image' => 'selling3.png'],
            [ 'name' => 'Siro bổ phế bối mẫu Forte Mom and Baby Tất thành','price'  => '115.000đ','unit'=>'chai','image' => 'selling4.png'],
            [ 'name' => 'Siro bổ phế bối mẫu Forte Mom and Baby Tất thành','price'  => '115.000đ','unit'=>'chai','image' => 'selling2.png'],
            [ 'name' => 'Siro bổ phế bối mẫu Forte Mom and Baby Tất thành','price'  => '115.000đ','unit'=>'chai','image' => 'selling3.png'],
            [ 'name' => 'Siro bổ phế bối mẫu Forte Mom and Baby Tất thành','price'  => '115.000đ','unit'=>'chai','image' => 'selling4.png'],
            [ 'name' => 'Siro bổ phế bối mẫu Forte Mom and Baby Tất thành','price'  => '115.000đ','unit'=>'chai','image' => 'selling2.png']
        ];
    @endphp
    @foreach ($items as $item)
        <li class="position-relative">
            @include("$moduleName.pages.$controllerName.partial.product_unit_top",['item'=>$item])
        </li>
    @endforeach
</ul>