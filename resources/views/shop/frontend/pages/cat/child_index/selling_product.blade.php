<h1 class="d-flex mb-5">
    <div class="icon-product-round"><img src="{{asset('images/shop/selling1.png')}}" alt="" srcset=""></div>
    <p>Sản phẩm bán chạy nhất</p>
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