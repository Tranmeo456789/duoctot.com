<div class="col-12 col-lg-3 px-0">
    <div class="cat-content">
        <div class="main-content-product">
            <h1>Nội dung chính
                <div class="roud-img"><img src="{{asset('images/shop/3ngang.png')}}" alt=""></div>
            </h1>
        </div>
        <ul class="list-content-product">
            <li><a href="#desc-product">Mô tả sản phẩm</a></li>
            <li><a href="#element-product">Thành phần</a></li>
            <li><a href="#func-product">Công dụng</a></li>
            <li><a href="#alternate-product">Cách dùng</a></li>
            <li><a href="#ide-effects">Tác dụng phụ</a></li>
            <li><a href="#note-product">Lưu ý</a></li>
            <li><a href="#preserve-product">Bảo quản</a></li>
        </ul>
    </div>
</div>
<div class="col-12 col-lg-9">
    <div class="title-content-detail-product d-flex justify-content-between flex-wrap">
        <h1 id="desc-product">Mô tả sản phẩm</h1>
        <div class="d-flex justify-content-center flex-wrap">
            <span class="ktc">Kích thước chữ</span>
            <span class="mdlh">
                <a class="md" href="">Mặc định</a>
                <a class="lh" href="">Lớn hơn</a>
            </span>
        </div>
    </div>
    <div class="content-detail-product">
        {!!$item->general_info!!}
        <h2 id="element-product">Thành phần</h2>
        <table>
            <thead>
                <th class="pl-2 py-2">Thành phần</th>
                <th class="text-right pr-2 py-2">Hàm lượng</th>
            </thead>
            <tbody>
                <tr>
                    <td class="pl-2 py-2">Nhung hươu</td>
                    <td class="text-right pr-2 py-2">2,4mg</td>
                </tr>
                <tr>
                    <td class="pl-2 py-2">Cao ban long</td>
                    <td class="text-right pr-2 py-2">2,4mg</td>
                </tr>
                <tr>
                    <td class="pl-2 py-2">Đỗ chi</td>
                    <td class="text-right pr-2 py-2">2,4mg</td>
                </tr>
                <tr>
                    <td class="pl-2 py-2">Hà thủ ô đỏ</td>
                    <td class="text-right pr-2 py-2">2,4mg</td>
                </tr>
            </tbody>
        </table>
        <h2 id="func-product" class="mt-2">Công dụng</h2>
        <p>{{$item->benefit}}</p>
        <h2 id="alternate-product" class="mt-2">Cách dùng</h2>
        <p>{{$item->dosage}}</p>
        <h2 id="ide-effects">Tác dụng phụ</h2>
        <p>Chưa có tác dụng không mong muốn</p>
        <div id="note-product" class="note-product mt-2">
            <h2>Lưu ý</h2>
            <p>{{$item->note}}</p>
        </div>
        <h2 id="preserve-product">Bảo quản</h2>
        <p>{{$item->preserve}}</p>
    </div>
</div>