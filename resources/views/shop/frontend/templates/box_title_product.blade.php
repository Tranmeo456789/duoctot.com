@php
    $img = 'selling1.png';
    $classBackground =  'icon-product-round';
    if (isset($featured) && $featured){
        $img = 'lua1.png';
        $classBackground =  'icon-product-featured';
    }
@endphp
<div class="d-flex mb-3 wp-title">
    <div class="d-flex align-items-center">
        <div class="{{$classBackground}}">
            <img src="{{asset('images/shop/' .  $img )}}" alt="">
        </div>
    </div>
    <h4 class="mb-0">{{$title}}</h4>
</div>