<h1 class="text-center mb-5">Danh mục thuốc nổi bật</h1>

<ul class="clearfix list-unstyled">
    @foreach ($_SESSION['cat_product'] as $item_sub_menu1)
    @if($item_sub_menu1['level'] == 2)
    @php
        foreach($_SESSION['cat_product'] as $cat1){
            if($item_sub_menu1['parent_id']==$cat1['id'])
            $item_cat1=$cat1;
        }

    @endphp
    <li>
        <a href="{{route('fe.cat2',[$item_cat1->slug,$item_sub_menu1->slug])}}">
            <div class="d-flex justify-content-center">
                <div class="image-60"><img src="{{asset($item_sub_menu1['image'])}}"></div>
            </div>
            <p class="truncate2">{{$item_sub_menu1['name']}}</p>
            <h2>{{count(product_of_cat($item_sub_menu1['id']))}} SẢN PHẨM</h2>
        </a>
    </li>
    @endif
    @endforeach
</ul>