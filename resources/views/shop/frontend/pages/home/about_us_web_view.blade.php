@extends('shop.layouts.frontend_webview')

@section('content')
<div class="wp-inner mt-3 mt-lg-4">
    <div class="mb-3 text-center">
        <img src="{{asset('public/shop/frontend/images/aboutUs/ve-chung-toi-anh-2.jpg')}}" alt="">
    </div>
    <div class="abu-cnt">
        <div class="top-new">
            <p style="font-size: 16px;">Chúng tôi là sàn thương mại điện tử trong y dược số 1 Việt nam với những bác sĩ nhiều kinh nghiệm, chúng tôi phục vụ người bệnh mọi lúc mọi nơi. <a style="font-size: 16px; color: #2b96cc;" href="https://tdoctor.net/">tdoctor.net</a> là công ty công nghệ với mong muốn sẽ xây dựng được một hệ thống chăm sóc sức khỏe toàn diện thông qua ứng dụng trên điện thoại và web. Ứng dụng tdoctor trên smartphone / tablet phiên bản Android và IOS cung cấp dịch vụ chăm sóc sức khỏe chủ động đầu tiên tại Việt Nam. Dựa trên nền tảng công nghệ thông tin, ứng dụng tdoctor giúp kết nối người dùng và Bác Sĩ dễ dàng ở mọi lúc, mọi nơi. Người dùng có thể sử dụng ứng dụng để được tư vấn sức khỏe, tra cứu SP & phòng khám, cùng các dịch vụ sức khỏe khác.</p>
            <br />
            <div class="mb-3 text-center">
                <img src="{{asset('public/shop/frontend/images/aboutUs/ve-chung-toi-3.jpg')}}" alt="">
            </div>
            <div class="mb-3 text-center">
                <img src="{{asset('public/shop/frontend/images/aboutUs/ve-chung-toi-4.jpg')}}" alt="">
            </div>
            <h2>ĐỘI NGŨ SÁNG LẬP VÀ NGƯỜI LÃNH ĐẠO</h2>
            <br />
            <br />
            <div class="media" id="leader">
                <h2>1. ĐỖ KHẮC THẠNH </h2>
                <img src="{{asset('public/shop/frontend/images/aboutUs/HinhAnhThanhDo.jpg')}}" alt="Sunil Shroff">
                <p>
                    <b class="cl-b">Chức danh:</b> <b>GIÁM ĐỐC </b>
                    <br><br>
                    <b class="cl-b">Chuyên môn:</b> <b>Thạc sĩ Kinh tế phát triển tại trường Erasmus University Rotterdam - Hà Lan</b>
                    <br><br>
                    <b class="cl-b">Kinh nghiệm:</b>
                    <span style="text-align: justify;font-size: 18px;">Hơn 20 năm kinh nghiệm về phát triển các hệ thống công nghệ chuyển đổi số trong y tế và giáo dục và thương mại điện tử trong và ngoài nước</span>
                </p>
            </div>
            <br />
            <br />
            <div class="media" id="leader">

                <h2>2. TIẾN SĨ: NGUYỄN THỊ THU HÀ</h2>
                <img src="{{asset('public/shop/frontend/images/aboutUs/NguyenThiThuHa.jpg')}}" alt="Nguyễn Thị Thu Hà">
                <p>
                    <b class="cl-b">Chức danh:</b> <b>PHÓ CHỦ TỊCH HĐQT KIÊM CHỦ TỊCH HỘI ĐỒNG QUẢN LÝ </b>
                    <br><br>
                    <b class="cl-b">Chuyên môn:</b> <b>Nghiên cứu Kinh tế Quốc tế Kinh nghiệp tư vấn đầu tư Quốc tế </b>
                    <br><br>
                    <b class="cl-b">Kinh nghiệm:</b> <b>Tiến sĩ Kinh tế Quốc tế</b>
                </p>
            </div>
            <br />
            <br />
            <div class="media" id="leader">
                <h2>3. BÁC SĨ CKII LÊ XUÂN CẢNH</h2>
                <img style="max-width: 400px;margin-right: 30px;border-radius: 10px;" src="{{ asset('public/shop/frontend/images/aboutUs/BSCKII_LeXuanCanh.jpg') }}" alt="BS CKII Lê Xuân Cảnh" />
                <p>
                    <b class="cl-b">Chức danh:</b> <b>CHỦ TỊCH HỘI ĐỒNG TƯ VẤN CHUYÊN MÔN</b>
                    <br><br>
                    <b class="cl-b">Chuyên môn:</b> <b>
                        Chủ tịch Hội đồng Tư vấn chuyên môn Ban Chăm sóc sức khỏe Trung ương
                    </b>
                    <br><br>
                    <b class="cl-b">Kinh nghiệm:</b> <b>Nhiều năm kinh nghiệm trong ngành Y tế</b>
                </p>
            </div>
            <br />
            <br />
            <div class="media" id="leader">
                <h2>4. LEE SANG MOK</h2>
                <img style="width: 150px;margin-right: 70px;" src="{{ asset('public/shop/frontend/images/aboutUs/LeeSangMok.jpg') }}" alt="Lee Sang Mok" />
                <p>
                    <b class="cl-b">Chức danh:</b> <b>PHÓ GIÁM ĐỐC</b>
                    <br><br>
                    <b class="cl-b">Chuyên môn:</b> <b>
                        Bác sĩ nha khoa - Quản trị Kinh doanh
                    </b>
                    <br><br>
                </p style="text-align: justify;font-size: 18px">Sinh ra trong 1 gia đình có bố là chủ tịch 1 tập đoàn kinh doanh về thương mại và vận tải với hơn 10 chi nhánh tại Trung Quốc, Và Hàn , Mr Lee được đào tạo bài bản về chuyên ngành bác sĩ và quản trị kinh doanh tại Mỹ, Đến Việt Nam đầu tư từ năm 2016, nhận thấy cơ hội tại Việt Nam rất nhiều , Ông quyết định đầu tư lâu dài tại đây</p>
                </p>
                </p>
            </div>
            <br />
            <br />
            <div class="media" id="leader">
                <h2>5. BÁC SĨ TRƯƠNG THANH SƠN</h2>
                <img src="{{asset('public/shop/frontend/images/aboutUs/bs-thanhson.jpg')}}" alt="Sunil Shroff">
                <p>
                    <b class="cl-b">Chức danh:</b> <b>Bác sĩ chuyên khoa 2 ngoại tiêu hóa gan mật </b>
                    <br><br>
                    <b class="cl-b">Chuyên môn:</b> <b>
                        Founder Trung Sơn pharma
                    </b>
                    <br><br>
                    <br><br>
                    <b class="cl-b">Kinh nghiệm: </b> <b> 25 năm Bệnh viện đa khoa TW Cần Thơ</b>
                </p>
            </div>
            <!-- <div class="media" id="leader">
                <h2>6. KHUẤT NGUYÊN NGỌC</h2>
                <img src="{{asset('public/shop/frontend/images/aboutUs/KhuatNguyenNgoc.jpg')}}" alt="Sunil Shroff">
                <p>
                    <b class="cl-b">Chức danh:</b> <b>TRƯỞNG NHÓM KINH DOANH </b>
                    <br><br>
                    <b class="cl-b">Chuyên môn:</b> <b>
                        Quản lý lao động
                    </b>
                    <br><br>
                    <b class="cl-b">Trường đào tạo:</b> <b> ĐẠI HỌC LAO ĐỘNG XÃ HỘI</b>
                <p style="text-align: justify;font-size: 18px">Mr Ngọc có 14 năm kinh nghiệm trong mảng phân phối dược, và dịch vụ chăm sóc y tế tại các cơ quan lớn như Bệnh Viện Đại Học Quốc Gia, Bệnh Viện Đại Học Y Hà Nội, Dược Thanh Hóa...</p>
                </p>
            </div> -->
            <div class="media" id="leader">
                <h2>66. MR TAL RUSHINEK </h2>
                <img src="{{asset('public/shop/frontend/images/aboutUs/mrTalRushinek.jpg')}}" alt="Sunil Shroff">
                <p>
                    <b class="cl-b">Chức danh:</b> <b>GIÁM ĐỐC SẢN PHẨM </b>
                    <br><br>
                    <b class="cl-b">Chuyên môn:</b> <b>
                        Quản lý kinh doanh
                    </b>
                    <br><br>
                    <b class="cl-b">Trường đào tạo:</b> <b> Đại Học Reichman University- Israel</b>
                <p style="text-align: justify;font-size: 18px;">Sinh ra trong 1 gia đình có nhiều người là lãnh lạo đạo cấp cao của các tập đoàn IT lớn tại Isarel và Mỹ, Mr Tal Rushinek, hỗ trợ Tdoctor ứng dụng các công nghệ Bigdata với đội ngũ chuyên gia người Do Thái tại Isarel và Mỹ</p>
                </p>
            </div>
            <div class="media" id="leader">
                <h2>7. MÃ THÀNH DANH</h2>
                <img style="height:200px" src="{{asset('public/shop/frontend/images/aboutUs/MaThanhDanh.jpg')}}" alt="Sunil Shroff">
                <p>
                    <b class="cl-b">Chức danh:</b> <b>GIÁM ĐỐC CHIẾN LƯỢC </b>
                    <br><br>
                    <b class="cl-b">Chuyên môn:</b> <b>
                        Tư vấn chiến lược
                    </b>
                    <br><br>
                    <b class="cl-b">Kinh nghiệm: </b><span style="text-align: justify;font-size: 18px;line-height:24px">Mã Thanh Danh hiện là Phó Tổng Giám đốc tập đoàn KIDO, chủ tịch HĐQT Công ty Tư vấn quốc tế CIB, đồng thời là Mentor của 2 chương trình Blue Venture Việt Nam và Shark Tank Việt Nam. Ông có hơn 15 năm kinh nghiệm trong quản lý chiến lược kinh doanh, tư vấn quản lý thương hiệu, Mua bán và Sáp nhập (M&A). Ngoài ra, ông Danh còn là Chuyên gia tư vấn và trực tiếp thực hiện Chuyển đổi số (Digital Transformation) cho nhiều doanh nghiệp quy mô SME và Tập đoàn. Hiện tại, ông là một trong những diễn giả uy tín nhất về start-up tại Việt Nam</span>
                </p>
            </div>
            <div class="media" id="leader">
                <h2>8. NGUYỄN THẾ SƠN</h2>
                <img src="{{asset('public/shop/frontend/images/aboutUs/NguyenTheSon.png')}}" alt="Sunil Shroff">
                <p>
                    <b class="cl-b">Chức danh:</b> <b>GIÁM ĐỐC MẢNG DƯỢC VÀ THỰC PHẨM CHỨC NĂNG </b>
                    <br><br>
                    <b class="cl-b">Chuyên môn:</b> <b>
                        Dược sĩ chuyên khoa 1
                    </b>
                    <br><br>
                    <b class="cl-b">Trường đào tạo:</b> <b>Đại học Y dược Thành phố Hồ Chí Minh</b>
                    <br><br>
                    <b class="cl-b">Kinh nghiệm: </b><span style="text-align: justify;font-size: 18px;"><br />Từng làm Thủ kho, dược sỹ lâm sàng - thông tin SP, phụ trách mua sắm vật tư y tế, trang thiết bị y tế, Trưởng phòng IT, Trưởng khoa dược. <br />Đã tham gia công tác tại 4 bệnh viện công lập trực thuộc Sở y tế TP. HCM<br />Đã qua vị trí trưởng khoa dược, quản lý điều hành khoa dược tại Bệnh viện đa khoa Sài Gòn, Bệnh viện An Bình</span>
                </p>
            </div>
            <div class="media" id="leader">
                <h2>9. Tony Hà</h2>
                <img src="{{asset('public/shop/frontend/images/aboutUs/tonyha.jpg')}}" alt="Sunil Shroff">
                <p>
                    <b class="cl-b">Chức danh:</b> <b>GIÁM ĐỐC CHIẾN LƯỢC</b>
                    <br><br>
                    <b class="cl-b">Trường đào tạo:</b> <b>Macquarie University ở Sydney, Úc</b>
                    <br><br>
                    <b class="cl-b">Kinh nghiệm: </b><span style="text-align: justify;font-size: 18px;">Hơn 10 năm kinh nghiệm lãnh đạo các startup và tập đoàn tại Việt Nam. Các vị trí trước đây của anh bao gồm: Giám đốc Đối tác tại ACCESSTRADE, Giám đốc Kinh doanh tại Haravan, và Trưởng phòng Đối tác tại VinFast.</span>
                </p>
            </div>
            <!-- <div class="media" id="leader">
                <h2>10. NGUYỄN XUÂN HOÀNG</h2>
                <img src="{{asset('public/shop/frontend/images/aboutUs/NguyenXuanHoang.jpg')}}" alt="">
                <p>
                    <b class="cl-b">Chức danh:</b> <b>TRƯỞNG PHÒNG KINH DOANH </b>
                    <br><br>
                    <b class="cl-b">Chuyên môn:</b> <b>
                        Maketing
                    </b>
                    <br><br>
                    <b class="cl-b">Trường đào tạo:</b> <b>Đại học Khoa học tự nhiên Hồ Chí Minh</b>
                    <br><br>
                    <b class="cl-b">Kinh nghiệm: </b><span style="text-align: justify;font-size: 18px;">Quản lý bán hàng công ty TNHH Daesang Việt Nam</span>
                </p>
            </div> -->
            <div class="media" id="leader">
                <h2>10. LƯU THU QUANG</h2>
                <img src="{{asset('public/shop/frontend/images/aboutUs/luuthuquang.jpg')}}" alt="Sunil Shroff">
                <p>
                    <b class="cl-b">Chức danh:</b> <b>CỐ VẤN CHIẾN LƯỢC </b>
                    <br><br>
                    <b class="cl-b">Chuyên môn:</b> <b>
                        TIẾN SĨ TÀI CHÍNH, GIẢNG VIÊN ĐẠI HỌC NGÂN HÀNG HCM
                    </b>
                    <br><br>
                    <b class="cl-b">Trường đào tạo:</b> <b> Feng Chia University</b>
                </p>
            </div>
            <br />
            <br />
            <div class="media" id="leader">
                <h2>11. LƯƠNG MỘNG ÁI NHI</h2>
                <img src="{{asset('public/shop/frontend/images/aboutUs/luongmongainhi.jpg')}}" alt="Sunil Shroff">
                <p>
                    <b class="cl-b">Chức danh:</b> <b>CỐ VẤN CHIẾN LƯỢC </b>
                    <br><br>
                    <b class="cl-b">Chuyên môn:</b> <b>
                        Biomedical Engineering - Kỹ thuật sinh học
                    </b>
                    <br><br>
                    <b class="cl-b">Trường đào tạo:</b> <b> National University of Singapore</b>
                </p>
            </div>
            <div style="clear: both;"></div>
            <br />
            <br />
            <h4 class="h4-abu">1. Mục tiêu</h4>
            <p class="p-abu">Ước muốn của chúng tôi là đem công nghệ để phục vụ người bệnh. Tình trạng quá tải bệnh viện hiện nay thật vất vả cho người dân việt nam. Chúng tôi muốn cải thiện điều này</p>
            <div class="div-abu" style="text-align:center">
                <img style="width: 60%;" src="{{asset('public/shop/frontend/images/aboutUs/1.jpg')}}">
            </div>
            <p>Bây giờ người bệnh có thể tương tác với bác sĩ trực tiếp mọi lúc mọi nơi</p>
            <br>
            <h4 class="h4-abu">2. Văn hóa tại <span class="link-p">www.tdoctor.net</span></h4>
            <p class="p-abu">Chúng tôi là mô hình công bằng với hệ thống tổ chức phẳng, chúng tôi tôn trọng chuyên môn của các bác sĩ giỏi, nhiều kinh nghiệm và tâm huyết với nghề. Chúng tôi luôn tôn trọng người dùng là bệnh nhân. Với chúng tôi bệnh nhân chính là đối tượng được phục vụ, là trung tâm của hệ thống</p>
            <div class="div-abu" style="text-align:center">
                <img style="width: 60%;" src="{{asset('public/shop/frontend/images/aboutUs/2.jpg')}}">
            </div>
        </div>
    </div>
</div>
<br><br>
@endsection