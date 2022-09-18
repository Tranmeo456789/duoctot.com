<h1 class="text-center mb-5">Danh mục thuốc nổi bật</h1>
<<<<<<< HEAD
<ul class="clearfix">
    @foreach ($_SESSION['cat_product'] as $item_sub_menu1)
    @if($item_sub_menu1['level'] == 1)
=======
<ul class="clearfix list-unstyled">
>>>>>>> deb9e10477f7db5319e77776f2952788233e7b5d
    @php
        foreach($_SESSION['cat_product'] as $cat1){
            if($item_sub_menu1['parent_id']==$cat1['id'])
            $item_cat1=$cat1;
        }
        
    @endphp
    <li>
        <a href="{{route('fe.cat2',[$item_cat1->slug,$item_sub_menu1->slug])}}">
            <div class="d-flex justify-content-center">
                <div class="image-60"><img src="{{asset('public/shop/uploads/images/product/'.$item_sub_menu1['image'])}}"></div>
            </div>
            <p>{{$item_sub_menu1['name']}}</p>
            <h2>12 SẢN PHẨM</h2>
        </a>
    </li>
    @endif
    @endforeach
</ul>