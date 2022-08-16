<h1 class="text-center mb-5">Danh mục thuốc nổi bật</h1>
<ul class="clearfix">
    @php
        $items = [
            [ 'name' => 'Sinh lý - Nội tiết tố','qty'  => '36','image' => 'cat1.png'],
            [ 'name' => 'Sức khỏe tim mạch',    'qty' => '36','image' => 'cat2.png'],
            [ 'name' => 'Hỗ trợ miễn dịch - Tăng sức đề kháng','qty'  => '36','image' => 'cat3.png'],
            [ 'name' => 'Men vi sinh','qty'  => '36','image' => 'cat4.png'],
            [ 'name' => 'Hỗ trợ tình dục','qty'  => '36','image' => 'cat5.png'],
            [ 'name' => 'Chăm sóc cơ thể','qty'  => '36','image' => 'cat6.png'],
            [ 'name' => 'Chăm sóc da mặt','qty'  => '36','image' => 'cat7.png'],
            [ 'name' => 'Chăm sóc răng miệng','qty'  => '36','image' => 'cat8.png'],
            [ 'name' => 'Vệ sinh cá nhân','qty'  => '36','image' => 'cat9.png'],
            [ 'name' => 'Dụng cụ sơ cứu','qty'  => '36','image' => 'cat10.png'],
            [ 'name' => 'Dụng cụ y tế','qty'  => '36','image' => 'cat11.png'],
            [ 'name' => 'Khẩu trang','qty'  => '36','image' => 'cat11.png']
        ];
    @endphp
    @foreach ($items as $item)
        <li>
            <a href="">
                <div class="d-flex justify-content-center">
                    <img src="{{asset('images/shop/' . $item['image'])}}" alt="" srcset="">
                </div>
                <p>{{$item['name']}}</p>
                <h2>{{$item['qty']}} SẢN PHẨM</h2>
            </a>
        </li>
    @endforeach
</ul>