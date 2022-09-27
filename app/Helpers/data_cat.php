<?php


function list_cat2($slugcat1, $slugcat2, $item_submenu2)
{
    return '<li>
    <a href="' . route("fe.cat3", [$slugcat1, $slugcat2, $item_submenu2['slug']]) . '">
        <div class="item_cat4 d-flex">
            <div class="aimg rimg-centerx mr-1">
                <img src="' . asset($item_submenu2['image']) . '">
            </div>
            <div class="align-self-center"><span>' . $item_submenu2['name'] . '</span></div>
        </div>
    </a>
    </li>';
}
function list_productheader()
{
    return '<div class="title-product-out d-flex justify-content-between my-3">
            <div class="title_cathd">
                <h1>Sản phẩm nổi bật</h1>
                <img src="' . asset('images/shop/lua4.png') . '">
            </div>
            <a href="">Xem tất cả</a>
            </div>
            <div class="productimenu">
            <ul>
                <div class="row">';
}
function list_productcontent($product){
    return '<div class="col-3 pl-3">
                <li>
                    <div class="bimgm"><a href="' . route("fe.product.detail", $product->id) . '"><img src="' . asset($product->image) . '" alt=""></a></div>
                    <div class="">
                        <a href="' . route("fe.product.detail", $product->id) . '" class="truncate2">' . $product->name . '</a>
                        <h3 class="my-2">' . number_format($product['price'], 0, "", ".") . 'đ/' . $product->unitProduct->name . '</h3>
                    </div>
                </li>
            </div>';
}
function list_productfooter(){
    return '</div></ul></div>';
}
