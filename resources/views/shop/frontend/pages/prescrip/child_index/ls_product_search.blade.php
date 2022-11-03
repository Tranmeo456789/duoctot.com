@if(isset($items))
<ul>
    @foreach($items as $item)
    <li class="item-search">
        <div class="product-item-search">
            <p class="text-left name-product">{{$item['name']}}</p>
            <div>
                <div class="btn"><span class="btn-add-item" data-id="{{$item['id']}}">Thêm</span></div>
            </div>
        </div>
    </li>
    @endforeach
</ul>
@else
<div class="mb-3 rimg-center"><img src="{{asset('images/shop/pescrip5.png')}}"></div>
@endif