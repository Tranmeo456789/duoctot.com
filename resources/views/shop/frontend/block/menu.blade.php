<div id="header-wp" class="position-relative">
    <div class="head_topon">
        <div class="wp-inner">
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center">
                    <div class="d-flex align-items-center"><span class="circle-ripple"></span></div>
                    <p>Kết nối khám chữa bệnh tại nhà với các bác sĩ online</p>
                    <a href="">Xem hướng dẫn</a>
                </div>
            </div>
        </div>
    </div>
    <div class="head_topon_reponsive">
        <div class="wp-inner">
            <div class="d-flex justify-content-center">
                <div class="d-flex justify-content-center">
                    <div><span class="circle-ripple"></span></div>
                    <a href="">Hướng dẫn</a>
                    <p>Kết nối khám chữa bệnh tại nhà</p>
                </div>
            </div>
        </div>
    </div>
    <div id="head-top" class="clearfix position-relative">
        <div class="wp-inner clearfix">
            <a href="{{route('home')}}" title="" id="payment-link" class="fl-left"><img style="width:213px" src="{{asset('images/shop/logo_topbar2.png')}}" alt=""></a>
            <div id="" class="fl-left" style="margin-left:300px; padding-top:5px">
                <a title="" id="payment-link" class="search-history-order">
                    <div class="clearfix">
                        <div class="fl-left mr-2 pt-2">
                            <img style="width:26px" src="{{asset('images/shop/history.png')}}" alt="" srcset="">
                        </div>
                        <div class="fl-left">
                            <p>Tra cứu</p>
                            <p>Lịch sử đơn hàng</p>
                        </div>
                    </div>
                </a>
            </div>
            <div id="" class="fl-left" style="margin-left:30px;padding-top:15px;">
                <a href="{{url('gio-hang')}}" title="" id="payment-link" class="">
                    <div class="clearfix">
                        <div class="fl-left mr-2">
                            <img style="width:32px" src="{{asset('images/shop/cart.png')}}" alt="" srcset="">
                        </div>
                        <div class="fl-left pt-2">
                            <p>Giỏ hàng</p>
                        </div>
                    </div>
                </a>
            </div>
            <div id="" class="fl-right" style="margin-left:10px;padding-top:15px;">
                <a title="" id="payment-link" class="">
                    <div class="btn-register">Đăng ký</div>
                </a>
            </div>
            <div id="" class="fl-right" style="padding-top:15px;">
                <a title="" id="payment-link" class="">
                    <div class="btn-login">Đăng nhập</div>
                </a>
            </div>
        </div>
        <div id="form-login-register">
            @include('shop.frontend.block.form_login_register')
        </div>
        <div id="search-order">
            <div class="header d-flex justify-content-between">
                <div class="tshorder">Tra cứu lịch sử đơn hàng</div>
                <button class="btn-closenk rimg-center"><img src="{{asset('images/shop/dn4.png')}}" alt=""></button>
            </div>
            <div class="d-flex justify-content-center">
                <div class="wp-content">
                    <form action="" class="wp-content-shorder">
                        <div class="content text-center">
                            <div class="mb-3 rimg-center"><img src="{{asset('images/shop/tclsdh.png')}}" alt="" style="display:block"></div>
                            <p class="nsdt">Nhập số điện thoại bạn dùng
                                để mua hàng tại T Doctor</p>
                            <div class="phone-mail position-relative">
                                <input type="text" placeholder="Nhập số điện thoại / Email">
                                <div class="img-person"><img src="{{asset('images/shop/dn1.png')}}" alt=""></div>
                            </div>
                        </div>
                        <div class="text-center"><input type="submit" name="btn-forget" value="Tiếp tục" id="btn-forget"></div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="head-top-respon">
        <div class="wp-inner presp">
            <div class="wp-iconmn">
                <div class="d-flex justify-content-between">
                    <div id="btnmenu-resp" class="rimg-center"><img src="{{asset('images/shop/nb3.png')}}" alt=""></div>
                    <div class="logotop"><a href="{{route('home')}}">
                            <div class="rimg-center"><img src="{{asset('images/shop/logo_topbar2.png')}}" alt=""></div>
                        </a></div>
                    <ul class="d-flex align-items-center">
                        <li class="hrcart"><a href="">
                                <div class="rimg-center"><img src="{{asset('images/shop/cart.png')}}"></div>
                            </a></li>
                        <li class="hruse"><a href="">
                                <div class="rimg-center"><img src="{{asset('images/shop/mr1.png')}}" alt=""></div>
                            </a></li>
                        <li class="hrflag">
                            <div class="rimg-center">
                                <img src="{{asset('images/shop/corp.png')}}" alt="" srcset="">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="ipsp">
                <input type="text" placeholder="Nhập tìm thuốc, TPCN, bệnh lý ...">
                <div class="rimg-center"></div><img src="{{asset('images/shop/icsp.png')}}" alt="">
            </div>
        </div>
    </div>
    <div id="head-body">
        @php
        $item_cat1s = [
        [ 'name' => 'Thực phẩm chức năng', 'id' => 1],
        [ 'name' => 'Dược mỹ phẩm', 'id' => 2],
        [ 'name' => 'Chăm sóc cá nhân', 'id' => 3],
        [ 'name' => 'Danh mục', 'id' => 4],
        [ 'name' => 'Thiết bị y tế', 'id' => 5],
        [ 'name' => 'Thú y', 'id' => 167],
        ];
        $item_sub_menu1s = [
        [ 'name' => 'Sinh lý - Nội tiết tố', 'id' => 6,'parent_id'=>1 ,'image'=>'sm1.png'],
        [ 'name' => 'Sức khỏe tim mạch', 'id' => 7,'parent_id'=>1,'image'=>'sm2.png'],
        [ 'name' => 'Hỗ trợ tiêu hóa', 'id' => 8,'parent_id'=>1,'image'=>'sm3.png'],
        [ 'name' => 'Thần kinh não', 'id' => 9,'parent_id'=>1,'image'=>'sm4.png'],
        [ 'name' => 'Hỗ trợ điều trị', 'id' => 10,'parent_id'=>1,'image'=>'sm5.png'],
        [ 'name' => 'Cải thiện tăng cường chức năng', 'id' => 11,'parent_id'=>6,'image'=>'sm1.png'],
        [ 'name' => 'Thảo dược và thực phẩm tự nhiên', 'id' => 12,'parent_id'=>7,'image'=>'sm1.png'],
        [ 'name' => 'Hỗ trợ làm đẹp', 'id' => 13,'parent_id'=>1,'image'=>'sm8.png'],
        [ 'name' => 'Vitamin và khoáng chất', 'id' => 14,'parent_id'=>1,'image'=>'sm9.png'],
        [ 'name' => 'Dinh dưỡng', 'id' => 15,'parent_id'=>1,'image'=>'sm10.png'],

        [ 'name' => 'Chăm sóc sức khỏe', 'id' => 16,'parent_id'=>2,'image'=>'dmp1.png'],
        [ 'name' => 'Các vấn đề về da', 'id' => 17,'parent_id'=>2,'image'=>'dmp2.png'],
        [ 'name' => 'Chăm sóc da mặt', 'id' => 18,'parent_id'=>2,'image'=>'dmp3.png'],
        [ 'name' => 'Chăm sóc tóc da đầu', 'id' => 19,'parent_id'=>2,'image'=>'dmp4.png'],
        [ 'name' => 'Chăm sóc tóc chuyên sâu', 'id' => 20,'parent_id'=>2,'image'=>'dmp5.png'],
        [ 'name' => 'Chăm sóc da vùng mặt', 'id' => 21,'parent_id'=>2,'image'=>'dmp6.png'],
        [ 'name' => 'Mỹ phẩm trang điểm', 'id' => 22,'parent_id'=>2,'image'=>'dmp7.png'],

        [ 'name' => 'Hỗ trợ tình dục', 'id' => 23,'parent_id'=>3,'image'=>'cscn1.png'],
        [ 'name' => 'Chăm sóc răng miệng', 'id' => 24,'parent_id'=>3,'image'=>'cscn2.png'],
        [ 'name' => 'Vệ sinh cá nhân', 'id' => 25,'parent_id'=>3,'image'=>'cscn3.png'],
        [ 'name' => 'Đồ dùng gia đình', 'id' => 26,'parent_id'=>3,'image'=>'cscn4.png'],
        [ 'name' => 'Tinh dầu các loại', 'id' => 27,'parent_id'=>3,'image'=>'cscn5.png'],
        [ 'name' => 'Thực phẩm đồ uống', 'id' => 28,'parent_id'=>3,'image'=>'cscn6.png'],
        [ 'name' => 'Thiết bị làm đẹp', 'id' => 29,'parent_id'=>3,'image'=>'cscn7.png'],
        [ 'name' => 'Dụng cụ cạo râu', 'id' => 30,'parent_id'=>3,'image'=>'cscn8.png'],
        [ 'name' => 'Hàng tổng hợp', 'id' => 31,'parent_id'=>3,'image'=>'cscn9.png'],

        [ 'name' => 'Bác sĩ', 'id' => 32,'parent_id'=>4,'image'=>'dm1.png'],
        [ 'name' => 'Cơ sở y tế', 'id' => 33,'parent_id'=>4,'image'=>'dm2.png'],
        [ 'name' => 'Nhà thuốc', 'id' => 34,'parent_id'=>4,'image'=>'dm3.png'],
        [ 'name' => 'Đối tác', 'id' => 35,'parent_id'=>4,'image'=>'dm4.png'],

        [ 'name' => 'Dụng cụ y tế', 'id' => 36,'parent_id'=>5,'image'=>'tbyt1.png'],
        [ 'name' => 'Khẩu trang', 'id' => 37,'parent_id'=>5,'image'=>'tbyt2.png'],
        [ 'name' => 'Dụng cụ theo dõi', 'id' => 38,'parent_id'=>5,'image'=>'tbyt3.png'],
        [ 'name' => 'Dụng cụ sơ cứu', 'id' => 39,'parent_id'=>5,'image'=>'tbyt4.png'],

        [ 'name' => 'Hỗn dịch kháng sinh tiêm', 'id' => 168,'parent_id'=>167,'image'=>'thy1.png'],
        [ 'name' => 'Dung dịch kháng sinh tiêm', 'id' => 169,'parent_id'=>167,'image'=>'thy2.png'],
        [ 'name' => 'Thuốc bột kháng sinh uống', 'id' => 170,'parent_id'=>167,'image'=>'thy3.png'],
        [ 'name' => 'Dung dịch kháng sinh uống', 'id' => 171,'parent_id'=>167,'image'=>'thy4.png'],
        [ 'name' => 'Thuốc chế phẩm bổ trợ hạ sốt,tiêu viêm', 'id' => 173,'parent_id'=>167,'image'=>'thy5.png'],
        [ 'name' => 'Thuốc ký sinh trùng dạng dung dịch tiêm bột', 'id' => 174,'parent_id'=>167,'image'=>'thy6.png'],
        [ 'name' => 'Nhóm men đạm sữa', 'id' => 175,'parent_id'=>167,'image'=>'thy7.png'],
        [ 'name' => 'Vitamin khoáng chất dạng cốm hòa tan', 'id' => 176,'parent_id'=>167,'image'=>'thy8.png'],
        [ 'name' => 'Nhóm thuốc điều tiết sinh sản hormones ', 'id' => 177,'parent_id'=>167,'image'=>'thy9.png'],
        [ 'name' => 'Thuốc sát trùng', 'id' => 178,'parent_id'=>167,'image'=>'thy10.png'],
        ];

        $item_submenu2s = [
        [ 'name' => 'Sinh lý nam', 'id' => 40,'parent_id'=>6,'image'=>'sl1.png'],
        [ 'name' => 'Sinh lý nữ', 'id' => 41,'parent_id'=>6,'image'=>'sl2.png'],
        [ 'name' => 'Hỗ trợ mãn kinh', 'id' => 42,'parent_id'=>6,'image'=>'sl3.png'],
        [ 'name' => 'Cân bằng nội tiết tố', 'id' => 43,'parent_id'=>6,'image'=>'sl4.png'],
        [ 'name' => 'Sức khỏe tình dục', 'id' => 44,'parent_id'=>6,'image'=>'sl5.png'],

        [ 'name' => 'Huyết áp', 'id' => 45,'parent_id'=>7,'image'=>'sktm1.png'],
        [ 'name' => 'Cholesterol', 'id' => 46,'parent_id'=>7,'image'=>'sktm2.png'],
        [ 'name' => 'Suy giãn tim mạch', 'id' => 47,'parent_id'=>7,'image'=>'sktm3.png'],

        [ 'name' => 'Dạ dày, tá tràng', 'id' => 48,'parent_id'=>8,'image'=>'htth1.png'],
        [ 'name' => 'Nhuận tràng', 'id' => 49,'parent_id'=>8,'image'=>'htth2.png'],
        [ 'name' => 'Khó tiêu', 'id' => 50,'parent_id'=>8,'image'=>'htth3.png'],
        [ 'name' => 'Táo bón', 'id' => 51,'parent_id'=>8,'image'=>'htth4.png'],
        [ 'name' => 'Đại tràng', 'id' => 52,'parent_id'=>8,'image'=>'htth5.png'],

        [ 'name' => 'Bổ não, cải thiện chí nhớ', 'id' => 53,'parent_id'=>9,'image'=>'tkn1.png'],
        [ 'name' => 'Kiểm soát căng thẳng', 'id' => 54,'parent_id'=>9,'image'=>'tkn2.png'],
        [ 'name' => 'Hỗ trợ giấc ngủ', 'id' => 55,'parent_id'=>9,'image'=>'tkn3.png'],

        [ 'name' => 'Trĩ', 'id' => 56,'parent_id'=>10,'image'=>'htdt1.png'],
        [ 'name' => 'Hô hấp xoang', 'id' => 57,'parent_id'=>10,'image'=>'htdt2.png'],
        [ 'name' => 'Cơ xương khớp', 'id' => 58,'parent_id'=>10,'image'=>'htdt3.png'],
        [ 'name' => 'Gout', 'id' => 59,'parent_id'=>10,'image'=>'htdt4.png'],
        [ 'name' => 'Tiểu đường', 'id' => 60,'parent_id'=>10,'image'=>'htdt5.png'],
        [ 'name' => 'Gan - mật', 'id' => 61,'parent_id'=>10,'image'=>'htdt6.png'],
        [ 'name' => 'Thận tiền liệt tuyến', 'id' => 62,'parent_id'=>10,'image'=>'htdt7.png'],
        [ 'name' => 'Xem tất cả', 'id' => 63,'parent_id'=>10,'image'=>'htdt8.png'],

        [ 'name' => 'Bảo vệ mắt', 'id' => 64,'parent_id'=>11,'image'=>'cttccn1.png'],
        [ 'name' => 'Tăng sức đề kháng', 'id' => 65,'parent_id'=>11,'image'=>'cttccn2.png'],
        [ 'name' => 'Hỗ trợ trao đổi chất', 'id' => 66,'parent_id'=>11,'image'=>'cttccn3.png'],

        [ 'name' => 'Nghệ & Curcumin', 'id' => 67,'parent_id'=>12,'image'=>'tdtp1.png'],
        [ 'name' => 'Nhân sâm', 'id' => 68,'parent_id'=>12,'image'=>'tdtp2.png'],
        [ 'name' => 'Đông trùng hạ thảo', 'id' => 69,'parent_id'=>12,'image'=>'tdtp3.png'],
        [ 'name' => 'Trinh nữ hoàng cung', 'id' => 70,'parent_id'=>12,'image'=>'tdtp4.png'],
        [ 'name' => 'Mật ong', 'id' => 71,'parent_id'=>12,'image'=>'tdtp5.png'],
        [ 'name' => 'Tỏi', 'id' => 72,'parent_id'=>12,'image'=>'tdtp6.png'],
        [ 'name' => 'Hà thủ ô', 'id' => 73,'parent_id'=>12,'image'=>'tdtp7.png'],
        [ 'name' => 'Xem tất cả', 'id' => 74,'parent_id'=>12,'image'=>'tdtp8.png'],

        [ 'name' => 'Da', 'id' => 75,'parent_id'=>13,'image'=>'htld1.png'],
        [ 'name' => 'Tóc', 'id' => 76,'parent_id'=>13,'image'=>'htld2.png'],
        [ 'name' => 'Kích cỡ ngực', 'id' => 77,'parent_id'=>13,'image'=>'htld3.png'],
        [ 'name' => 'Hỗ trợ giảm cân', 'id' => 78,'parent_id'=>13,'image'=>'htld4.png'],
        [ 'name' => 'Thực phẩm giảm cân', 'id' => 79,'parent_id'=>13,'image'=>'htld5.png'],

        [ 'name' => 'VitaminC', 'id' => 80,'parent_id'=>14,'image'=>'vtmkc1.png'],
        [ 'name' => 'VitaminA', 'id' => 81,'parent_id'=>14,'image'=>'vtmkc2.png'],
        [ 'name' => 'VitaminE', 'id' => 82,'parent_id'=>14,'image'=>'vtmkc3.png'],
        [ 'name' => 'Canxi', 'id' => 83,'parent_id'=>14,'image'=>'vtmkc4.png'],
        [ 'name' => 'Sắt', 'id' => 84,'parent_id'=>14,'image'=>'vtmkc5.png'],
        [ 'name' => 'Kẽm', 'id' => 85,'parent_id'=>14,'image'=>'vtmkc6.png'],
        [ 'name' => 'DHA', 'id' => 86,'parent_id'=>14,'image'=>'vtmkc7.png'],
        [ 'name' => 'Xem tất cả', 'id' => 87,'parent_id'=>14,'image'=>'vtmkc8.png'],

        [ 'name' => 'Sữa', 'id' => 88,'parent_id'=>15,'image'=>'sua1.png'],
        [ 'name' => 'Thực phẩm ăn kiêng', 'id' => 89,'parent_id'=>15,'image'=>'sua2.png'],

        [ 'name' => 'Chống nắng toàn thân', 'id' => 90,'parent_id'=>16,'image'=>'csct1.png'],
        [ 'name' => 'Dưỡng thể', 'id' => 91,'parent_id'=>16,'image'=>'csct2.png'],
        [ 'name' => 'Chăm sóc ngực', 'id' => 92,'parent_id'=>16,'image'=>'csct3.png'],
        [ 'name' => 'Sữa tắm xà bông', 'id' => 93,'parent_id'=>16,'image'=>'csct4.png'],
        [ 'name' => 'Khử mùi trị nám da', 'id' => 94,'parent_id'=>16,'image'=>'csct5.png'],
        [ 'name' => 'Dưỡng tay chân', 'id' => 95,'parent_id'=>16,'image'=>'csct6.png'],

        [ 'name' => 'Dưỡng trắng da', 'id' => 96,'parent_id'=>17,'image'=>'cvdvd1.png'],
        [ 'name' => 'Trị sẹo', 'id' => 97,'parent_id'=>17,'image'=>'cvdvd2.png'],
        [ 'name' => 'Mờ vết thâm', 'id' => 98,'parent_id'=>17,'image'=>'cvdvd3.png'],
        [ 'name' => 'Da khô - thiếu ẩm', 'id' => 99,'parent_id'=>17,'image'=>'cvdvd4.png'],
        [ 'name' => 'Nhạy cảm', 'id' => 100,'parent_id'=>17,'image'=>'cvdvd5.png'],

        [ 'name' => 'Kem chống nắng', 'id' => 101,'parent_id'=>18,'image'=>'csdm1.png'],
        [ 'name' => 'Sữa rửa mặt', 'id' => 102,'parent_id'=>18,'image'=>'csdm2.png'],
        [ 'name' => 'Toner (nước hoa hồng)', 'id' => 103,'parent_id'=>18,'image'=>'csdm3.png'],
        [ 'name' => 'Trị mụn', 'id' => 104,'parent_id'=>18,'image'=>'csdm4.png'],
        [ 'name' => 'Tẩy trang', 'id' => 105,'parent_id'=>18,'image'=>'csdm5.png'],
        [ 'name' => 'Tẩy tế bào chết', 'id' => 106,'parent_id'=>18,'image'=>'csdm6.png'],
        [ 'name' => 'Mặt nạ', 'id' => 107,'parent_id'=>18,'image'=>'csdm7.png'],
        [ 'name' => 'Xem tất cả', 'id' => 108,'parent_id'=>18,'image'=>'csdm8.png'],

        [ 'name' => 'Đặc trị cho tóc', 'id' => 109,'parent_id'=>19,'image'=>'cst1.png'],
        [ 'name' => 'Dầu gội dầu xả', 'id' => 110,'parent_id'=>19,'image'=>'cst2.png'],
        [ 'name' => 'Dưỡng tóc ủ tóc', 'id' => 111,'parent_id'=>19,'image'=>'cst3.png'],

        [ 'name' => 'Trị nấm', 'id' => 112,'parent_id'=>20,'image'=>'tm1.png'],

        [ 'name' => 'Dưỡng da mặt', 'id' => 113,'parent_id'=>21,'image'=>'csvm1.png'],
        [ 'name' => 'Trị thâm quầng bộng mắt', 'id' => 114,'parent_id'=>21,'image'=>'csvm2.png'],

        [ 'name' => 'Trang điểm mặt', 'id' => 115,'parent_id'=>22,'image'=>'mptd1.png'],
        [ 'name' => 'Dụng cụ trang điểm', 'id' => 116,'parent_id'=>22,'image'=>'mptd2.png'],

        [ 'name' => 'Bao cao su', 'id' => 117,'parent_id'=>23,'image'=>'httd1.png'],
        [ 'name' => 'Gai bôi trơn', 'id' => 118,'parent_id'=>23,'image'=>'httd2.png'],

        [ 'name' => 'Nước súc miệng', 'id' => 119,'parent_id'=>24,'image'=>'csrm1.png'],
        [ 'name' => 'Chỉ nha khoa', 'id' => 120,'parent_id'=>24,'image'=>'csrm2.png'],
        [ 'name' => 'Kem đánh răng', 'id' => 122,'parent_id'=>24,'image'=>'csrm3.png'],
        [ 'name' => 'Bàn chải đánh răng', 'id' => 123,'parent_id'=>24,'image'=>'csrm4.png'],
        [ 'name' => 'Ngừa sâu răng', 'id' => 124,'parent_id'=>24,'image'=>'csrm5.png'],

        [ 'name' => 'Nước rửa tay', 'id' => 125,'parent_id'=>25,'image'=>'vscn1.png'],
        [ 'name' => 'Dung dịch vệ sinh', 'id' => 126,'parent_id'=>25,'image'=>'vscn2.png'],
        [ 'name' => 'Băng vệ sinh', 'id' => 127,'parent_id'=>25,'image'=>'vscn3.png'],


        [ 'name' => 'Đồ dùng em bé', 'id' => 129,'parent_id'=>26,'image'=>'ddgd1.png'],
        [ 'name' => 'Đồ dùng cho mẹ', 'id' => 130,'parent_id'=>26,'image'=>'ddgd2.png'],
        [ 'name' => 'Chống muỗi', 'id' => 131,'parent_id'=>26,'image'=>'ddgd3.png'],

        [ 'name' => 'Dầu dừa', 'id' => 132,'parent_id'=>27,'image'=>'tdcl1.png'],
        [ 'name' => 'Tinh dầu các loại', 'id' => 133,'parent_id'=>27,'image'=>'tdcl2.png'],

        [ 'name' => 'Kẹo cứng', 'id' => 134,'parent_id'=>28,'image'=>'tpdu1.png'],
        [ 'name' => 'Kẹo cao su', 'id' => 135,'parent_id'=>28,'image'=>'tpdu2.png'],
        [ 'name' => 'Nước uống không ga', 'id' => 136,'parent_id'=>28,'image'=>'tpdu3.png'],
        [ 'name' => 'Sữa nước', 'id' => 137,'parent_id'=>28,'image'=>'tpdu4.png'],
        [ 'name' => 'Trà', 'id' => 138,'parent_id'=>28,'image'=>'tpdu5.png'],

        [ 'name' => 'Dụng cụ lấy lông', 'id' => 139,'parent_id'=>29,'image'=>'tbld1.png'],

        [ 'name' => 'Dao lưỡi cạo râu', 'id' => 140,'parent_id'=>30,'image'=>'dccr1.png'],

        [ 'name' => 'Bác sĩ đa khoa', 'id' => 141,'parent_id'=>32,'image'=>'bs1.png'],
        [ 'name' => 'Bác sĩ tim mạch', 'id' => 142,'parent_id'=>32,'image'=>'bs2.png'],
        [ 'name' => 'Chuyên khoa phổi', 'id' => 143,'parent_id'=>32,'image'=>'bs3.png'],
        [ 'name' => 'Chuyên khoa dược', 'id' => 144,'parent_id'=>32,'image'=>'bs4.png'],
        [ 'name' => 'Răng hàm mặt', 'id' => 145,'parent_id'=>32,'image'=>'bs5.png'],
        [ 'name' => 'Chyên khoa thâm mỹ', 'id' => 146,'parent_id'=>32,'image'=>'bs6.png'],

        [ 'name' => 'Dụng cụ vệ sinh mũi', 'id' => 147,'parent_id'=>36,'image'=>'dcyt1.png'],
        [ 'name' => 'Dụng cụ vệ sinh tai', 'id' => 148,'parent_id'=>36,'image'=>'dcyt2.png'],
        [ 'name' => 'Kim các loại', 'id' => 149,'parent_id'=>36,'image'=>'dcyt3.png'],
        [ 'name' => 'Đai lưng', 'id' => 150,'parent_id'=>36,'image'=>'dcyt4.png'],
        [ 'name' => 'Đai nẹp', 'id' => 151,'parent_id'=>36,'image'=>'dcyt5.png'],
        [ 'name' => 'Dụng cụ khác', 'id' => 152,'parent_id'=>36,'image'=>'dcyt6.png'],
        [ 'name' => 'Gang tay', 'id' => 153,'parent_id'=>36,'image'=>'dcyt7.png'],
        [ 'name' => 'Xem tất cả', 'id' => 154,'parent_id'=>36,'image'=>'dcyt8.png'],

        [ 'name' => 'Khẩu trang y tế', 'id' => 155,'parent_id'=>37,'image'=>'kt1.png'],
        [ 'name' => 'Khẩu trang vải', 'id' => 156,'parent_id'=>37,'image'=>'kt2.png'],
        [ 'name' => 'Chống bụi mịn', 'id' => 157,'parent_id'=>37,'image'=>'kt3.png'],
        [ 'name' => 'Chống virus', 'id' => 158,'parent_id'=>37,'image'=>'kt4.png'],

        [ 'name' => 'Nhiệt kế', 'id' => 159,'parent_id'=>38,'image'=>'dctd1.png'],
        [ 'name' => 'Máy đo huyết áp', 'id' => 160,'parent_id'=>38,'image'=>'dctd2.png'],
        [ 'name' => 'Máy que thử đường huyết', 'id' => 161,'parent_id'=>38,'image'=>'dctd3.png'],
        [ 'name' => 'Thử thai', 'id' => 162,'parent_id'=>38,'image'=>'dctd4.png'],

        [ 'name' => 'Băng y tế', 'id' => 163,'parent_id'=>39,'image'=>'dcsc1.png'],
        [ 'name' => 'Cồn và nước sát trùng', 'id' => 164,'parent_id'=>39,'image'=>'dcsc2.png'],
        [ 'name' => 'Tăm bông', 'id' => 165,'parent_id'=>39,'image'=>'dcsc3.png'],
        [ 'name' => 'Bông y tế', 'id' => 166,'parent_id'=>39,'image'=>'dcsc4.png'],
        ];


        @endphp
        <div class="wp-inner1" id="category-product-wp">
            <div class="d-flex justify-content-between">
                <div class="menu-top1">
                    <div class="position-relative ">
                        <ul id="main-menu" class="d-flex list-item">
                            @foreach ($item_cat1s as $item_cat1)
                            <li class="catc1">
                                <a href="{{route('fe.cat')}}">
                                    {{$item_cat1['name']}}
                                    <i class="fas fa-chevron-down arrow"></i>
                                </a>
                                <div class="content-submenu">
                                    <div class="px-0 position-relative right-fol" style="width:25%">
                                        <ul class="sub-menu1">
                                            @foreach ($item_sub_menu1s as $item_sub_menu1)
                                            @if ($item_sub_menu1['parent_id'] == (int)$item_cat1['id'] )
                                            <li>
                                                <div class="himg-menu">
                                                    <div class="d-flex">
                                                        <div class="d-flex align-items-center pl-2">
                                                            <div class="rdimg rimg-centerw"><img src="{{asset('images/shop/' .  $item_sub_menu1['image'] )}}" alt=""></div>
                                                        </div>
                                                        <a href="{{route('fe.cat3')}}" title="" class="titlec2">{{$item_sub_menu1['name']}}</a>
                                                    </div>
                                                    <div class="sub-menu2 content-submenu-right">
                                                        <div id="cat_detail">
                                                            <ul class="body_catdetail clearfix">
                                                                @foreach ($item_submenu2s as $item_submenu2)
                                                                @if ($item_submenu2['parent_id'] == $item_sub_menu1['id'] )
                                                                <li class=" mr-2 mb-2">
                                                                    <a href="{{route('fe.cat4')}}">
                                                                        <div class="item_cat4 d-flex">
                                                                            <div class="aimg rimg-centerx mr-1">
                                                                                <img src="{{asset('images/shop/' .  $item_submenu2['image'] )}}" alt="">
                                                                            </div>
                                                                            <div class="align-self-center"><span>{{$item_submenu2['name']}}</span></div>
                                                                        </div>
                                                                    </a>
                                                                </li>
                                                                @endif
                                                                @endforeach

                                                            </ul>
                                                            <div class="title-product-out d-flex justify-content-between my-3">
                                                                <div class="title_cathd">
                                                                    <h1>Sản phẩm nổi bật</h1>
                                                                    <img src="{{asset('images/shop/lua4.png')}}" alt="">
                                                                </div>
                                                                <a href="">Xem tất cả</a>
                                                            </div>
                                                            <div class="productimenu">
                                                                <ul class="">
                                                                    <div class="row">
                                                                        <div class="col-3 pl-3">
                                                                            <li>
                                                                                <div class="bimgm"><a href="{{route('fe.product.detail')}}"><img src="{{asset('images/shop/sri1.png')}}" alt=""></a></div>
                                                                                <div class="">
                                                                                    <a href="{{route('fe.product.detail')}}">Siro Bổ Phế Bối Mẫu Forte Mom And Baby...</a>
                                                                                    <h3 class="my-2">49.000đ/Chai</h3>
                                                                                </div>
                                                                            </li>
                                                                        </div>
                                                                        <div class="col-3 pl-3">
                                                                            <li>
                                                                                <div class="bimgm"><a href="{{route('fe.product.detail')}}"><img src="{{asset('images/shop/sri1.png')}}" alt=""></a></div>
                                                                                <div class="">
                                                                                    <a href="{{route('fe.product.detail')}}">Siro Bổ Phế Bối Mẫu Forte Mom And Baby...</a>
                                                                                    <h3 class="my-2">49.000đ/Chai</h3>
                                                                                </div>
                                                                            </li>
                                                                        </div>
                                                                        <div class="col-3 pl-3">
                                                                            <li>
                                                                                <div class="bimgm"><a href="{{route('fe.product.detail')}}"><img src="{{asset('images/shop/sri1.png')}}" alt=""></a></div>
                                                                                <div class="">
                                                                                    <a href="{{route('fe.product.detail')}}">Siro Bổ Phế Bối Mẫu Forte Mom And Baby...</a>
                                                                                    <h3 class="my-2">49.000đ/Chai</h3>
                                                                                </div>
                                                                            </li>
                                                                        </div>
                                                                        <div class="col-3 pl-3">
                                                                            <li>
                                                                                <div class="bimgm"><a href="{{route('fe.product.detail')}}"><img src="{{asset('images/shop/sri1.png')}}" alt=""></a></div>
                                                                                <div class="">
                                                                                    <a href="{{route('fe.product.detail')}}">Siro Bổ Phế Bối Mẫu Forte Mom And Baby...</a>
                                                                                    <h3 class="my-2">49.000đ/Chai</h3>
                                                                                </div>
                                                                            </li>
                                                                        </div>
                                                                    </div>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            @endforeach
                            <li class="catc1 position-relative">
                                <a href="{{route('fe.cat')}}">Đặt khám bác sĩ<i class="fas fa-chevron-down arrow"></i></a>
                                <div class="content-submenu" style="width:250%;left:0px;">
                                    <div class=" px-0">
                                        <ul class="sub-menu1">
                                            <li>
                                                <div class="himg-menu d-flex">
                                                    <div class="d-flex align-items-center pl-2">
                                                        <div class="rdimg rimg-centerw"><img src="{{asset('images/shop/dkbs1.png')}}" alt=""></div>
                                                    </div>
                                                    <a href="{{route('fe.cat3')}}" title="" class="titlec2">Hẹn bác sĩ đến nhà</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="himg-menu d-flex">
                                                    <div class="d-flex align-items-center pl-2">
                                                        <div class="rdimg rimg-centerw"><img src="{{asset('images/shop/dkbs2.png')}}" alt=""></div>
                                                    </div>
                                                    <a href="{{route('fe.cat3')}}" title="" class="titlec2">Gọi video với bác sĩ</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="himg-menu d-flex">
                                                    <div class="d-flex align-items-center pl-2">
                                                        <div class="rdimg rimg-centerw"><img src="{{asset('images/shop/dkbs3.png')}}" alt=""></div>
                                                    </div>
                                                    <a href="{{route('fe.cat3')}}" title="" class="titlec2">Chat miễn phí với bác sĩ</a>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="himg-menu d-flex">
                                                    <div class="d-flex align-items-center pl-2">
                                                        <div class="rdimg rimg-centerw"><img src="{{asset('images/shop/dkbs1.png')}}" alt=""></div>
                                                    </div>
                                                    <a href="{{route('fe.cat3')}}" title="" class="titlec2">Đặt hẹn tại phòng khám</a>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </li>
                            <li class="">
                                <a href="{{route('fe.cat')}}">Góc sức khỏe</a>
                            </li>
                            <li class="">
                                <a href="{{route('fe.cat')}}">Nhà thuốc</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="flag pt-2">
                    <div class="position-relative">
                        <img src="{{asset('images/shop/flag.png')}}" alt="" srcset="">
                        <div class="dropdown">
                            <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Tiếng Việt</button>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="#">Tiếng Anh</a>
                                <a class="dropdown-item" href="#">Tiếng Pháp</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="black-content"></div>
    <div class="black-screen"></div>
</div>