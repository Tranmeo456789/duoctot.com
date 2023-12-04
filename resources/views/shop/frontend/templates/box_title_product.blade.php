@php
    $imgDefault = 'selling1.png';
    $class =  'icon-product-round';
    if (isset($img)){
        $imgDefault=$img;
    }
    if(isset($classBackground)){
        $class =  'icon-product-round '.$classBackground;
    }
@endphp
<div class="d-flex mb-2 mb-lg-3 wp-title">
    <div class="d-flex align-items-center">
        <div class="{{$class}}">
            <img src="{{asset('images/shop/' .  $imgDefault )}}" alt="">
        </div>
    </div>
    <h4 class="mb-0 ml-2">{{$title}}</h4>
</div>