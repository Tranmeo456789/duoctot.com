<div class="wp-inner">
    <h1 class="d-flex mb-5">
        <img src="{{asset('images/shop/covid1.png')}}" alt="" srcset="">
        <p>Sản phẩm hậu Covid</p>
    </h1>
    <ul class="clearfix">
        @php
            $items = [
                [ 'name' => 'Viên sủi opimax Imunity','price'  => '115.000đ','unit'=>'tuýp','image' => 'covid2.png'],
                [ 'name' => 'Viên sủi opimax Imunity','price'  => '115.000đ','unit'=>'tuýp','image' => 'covid3.png'],
                [ 'name' => 'Viên sủi opimax Imunity','price'  => '115.000đ','unit'=>'tuýp','image' => 'covid4.png'],
                [ 'name' => 'Viên sủi opimax Imunity','price'  => '115.000đ','unit'=>'tuýp','image' => 'covid5.png'],
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