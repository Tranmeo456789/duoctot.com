<style>
.contact-menu {
    position: fixed;
    bottom: 50px;
    left: 2px;
    z-index: 100;
    display: block;
    opacity: 1;
    transition: opacity 0.3s ease-in-out;
    background-color: white;
    border: 1px solid #ddd;
    border-radius: 40px;
    padding: 10px 5px 20px 5px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
}
.contact-menu li {
    text-align: center;
}
.contact-menu a {
    text-decoration: none;
    color: #0d6799;
    display: block;
    font-size: 10px;
    font-weight: bold;
}
.contact-menu img {
    width: 30px;
    margin: 0 auto;
}

@media (max-width: 768px) {
    .contact-menu {
        top: auto !important;
        bottom: 0 !important;
        right: 0;
        left: 0;
        transform: none;
        width: 100%;
        border-radius: 0;
        padding: 0;
        display: flex;
        justify-content: center;
        box-shadow: 0 -4px 8px rgba(0, 0, 0, 0.1);
    }
    .contact-menu ul {
        display: flex;
        flex-direction: row;
        justify-content: space-between;
        width: 100%;
    }
    .contact-menu ul li a{
        font-size: 12px;
    }
}
</style>
<contact-menu class="contact-menu">
    <ul>
        <li id="icon-fixed__facebook">
            <a class="image-contact" href="{{route('home')}}">
                <img src="{{asset('images/shop/trangchu.jpg')}}" alt="trang chủ">
            </a>
            <a href="{{route('home')}}" class="text-primary font-weight-bold">Trang chủ</a>
        </li>
        <li id="icon-fixed__facebook">
            <a class="image-contact" href="{{route('fe.home.pageKhuyenMai')}}">
                <img src="{{asset('images/shop/khuyenmai.jpg')}}" alt="khuyến mãi">
            </a>
            <a href="{{route('fe.home.pageKhuyenMai')}}" class="text-primary font-weight-bold">Khuyến mãi</a>
        </li>
        <li id="icon-fixed__facebook">
            <a class="image-contact" href="{{route('fe.home.pageDiemTichLuy')}}">
                <img src="{{asset('images/shop/tichluy.jpg')}}" alt="Điểm tích lũy">
            </a>
            <a href="{{route('fe.home.pageDiemTichLuy')}}" class="text-primary font-weight-bold">Điểm tích lũy</a>
        </li>
        <li id="icon-fixed__facebook">
            <a class="image-contact" href="{{route('fe.home.pageRiengChoBan')}}">
                <img src="{{asset('images/shop/riengchoban.jpg')}}" alt="riêng cho bạn">
            </a>
            <a href="{{route('fe.home.pageRiengChoBan')}}" class="text-primary font-weight-bold">Riêng cho bạn</a>
        </li>
        <li id="icon-fixed__facebook">
            <a class="image-contact" href="{{route('fe.home.pageDanhSachDonMua')}}">
                <img src="{{asset('images/shop/donmua.jpg')}}" alt="Đơn hàng">
            </a>
            <a href="{{route('fe.home.pageDanhSachDonMua')}}" class="text-primary font-weight-bold">Đơn hàng</a>
        </li>
    </ul>
</contact-menu>