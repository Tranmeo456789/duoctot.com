<?php
function notisuccess()
{
    return '<p class="text-success notisucesscmn"><i class="fas fa-check"></i>Thêm thành công sản phẩm vào giỏ hàng</p>';
}
function list_cartloadhed($number_product)
{
    return ' <div class="position-relative iconcartmenu">
    <a href="' . route("fe.product.cart") . '" id="payment-link" class="">
        <div class="clearfix icon_cart">
            <div class="fl-left mr-2">
                <img style="width:32px" src="' . asset('images/shop/cart.png') . '">
            </div>
            <div class="fl-left pt-2">
                <p>Giỏ hàng</p>
            </div>
        </div>
    </a>
    <span class="number_cartmenu">' . $number_product . '</span>
    <div id="dropdown">
        <div class="position-relative">
            <span class="arrow-up"><i class="fas fa-sort-up"></i></span>
            <p class="text-success notisucess1"></p>
            <form action="" method="POST">
            <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
                <ul class="list-cart-mini">';
}
function list_product($product)
{
    return '<li>
    <div class="d-flex">
        <div title="" class="thumbperp">
            <div class="rimg-center img-60">
                <img src="' . asset($product['image']) . '">
            </div>
        </div>
        <div class="cart-info">
            <a href="" title="" class="nameprmn mb-1 truncate2">' . $product['name'] . '</a>
            <div class="clearfix">
                <div class="fl-left">
                    <input type="text" maxlength="3" value="' . $product['qty'] . '" data-id="' . $product['id'] . '" data-rowId="' . $product['rowId'] . '" name="qty[' . $product['rowId'] . ']" class="numberperp numberperp' . $product['rowId'] . ' number-ajax">
                </div>
                <div class="fl-right">
                    <strong class="mb-0 priceperp">' . number_format($product['price'] * $product['qty'], 0, ',', '.') . 'đ</strong><span> | </span><span class="deleteperp">Xóa</span>
                </div>
            </div>
        </div>
    </div>
</li>';
}
function list_cartloadfoter()
{
    return '</ul>
        </form>
        <div class="text-center"><a href="' . route("fe.product.cart") . '" class="viewcartmini">Xem giỏ hàng</a></div>
        </div>
    </div>
    </div>';
}
function list_cart_resheader(){
    return '<div class="position-relative">
    <span class="arrow-up"><i class="fas fa-sort-up"></i></span>
    <p class="text-success notisucess1"></p>
    <div class="close-cart"><img src="'.asset("images/shop/dn4.png").'" alt=""></div>
    <form action="" method="POST">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <ul class="list-cart-mini">';
}
function list_cart_resfooter()
{
    return '</ul>
    </form>
    <div class="text-center"><a href="' . route("fe.product.cart") . '" class="viewcartmini">Xem giỏ hàng</a></div>
    <div class="cbh2"><a href="'.route('home').'">Tiếp tục mua hàng</a></div>
</div>';
}
