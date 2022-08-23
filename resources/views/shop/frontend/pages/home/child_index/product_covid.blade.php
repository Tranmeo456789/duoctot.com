<div id="feature-product-wp" class="product_sellhome">
    <div class="mb-3 headf position-relative">
        <h1>Sản phẩm hậu covid</h1>
        <img src="{{asset('images/shop/lua1.png')}}" alt="" srcset="">
    </div>
    <div class="">
        <ul class="list-item">
            @php
                $items = [
                    [ 'name' => 'Viên sủi opimax Imunity','price'  => '115.000đ','unit'=>'tuýp','image' => 'covid2.png'],
                    [ 'name' => 'Viên sủi opimax Imunity','price'  => '115.000đ','unit'=>'tuýp','image' => 'covid3.png'],
                    [ 'name' => 'Viên sủi opimax Imunity','price'  => '115.000đ','unit'=>'tuýp','image' => 'covid4.png'],
                    [ 'name' => 'Viên sủi opimax Imunity','price'  => '115.000đ','unit'=>'tuýp','image' => 'covid5.png'],
                    [ 'name' => 'Viên sủi opimax Imunity','price'  => '115.000đ','unit'=>'tuýp','image' => 'covid6.png'],
                    [ 'name' => 'Viên sủi opimax Imunity','price'  => '115.000đ','unit'=>'tuýp','image' => 'covid7.png'],
                    [ 'name' => 'Viên sủi opimax Imunity','price'  => '115.000đ','unit'=>'tuýp','image' => 'covid6.png'],
                    [ 'name' => 'Viên sủi opimax Imunity','price'  => '115.000đ','unit'=>'tuýp','image' => 'covid7.png']
                ];
            @endphp
            @foreach ($items as $item)
                <li>
                    @include("$moduleName.pages.$controllerName.partial.product",['item'=>$item])
                </li>
            @endforeach
        </ul>
    </div>
</div>