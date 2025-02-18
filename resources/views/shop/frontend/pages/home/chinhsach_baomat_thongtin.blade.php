@extends('shop.layouts.frontend')

@section('content')
<div class="wp-inner mt-3 mt-lg-4">
    <div class="abu-cnt">
        <div class="" id="breadcrumb-wp">
            <ul class="list-item clearfix">
                <li>
                    <a href="{{route('home')}}" title="">Trang chủ</a>
                </li>
                <li>
                    <span>Chính sách bảo mật</span>
                </li>
            </ul>
        </div>
        <hr>
        <div class="info-secu">
            <h2 style="text-align: center;">CHÍNH SÁCH BẢO MẬT</h2>
            <h5> <strong>Mục đích và phạm vi thu thập</strong></h5>
            <div class="pl-2 mb-3">
                <p>● Việc thu thập dữ liệu chủ yếu trên website tdoctor.net bao gồm: họ tên, email, điện thoại. Đây là các thông tin cần thiết cần thành viên cung cấp bắt buộc để tdoctor.net liên hệ xác nhận khi khách hàng sử dụng dịch vụ trên website nhằm đảm bảo quyền lợi cho các khách hàng.</p>
                <p>● Các khách hàng sẽ tự chịu trách nhiệm về bảo mật và lưu giữ mọi hoạt động sử dụng dịch vụ dưới tên và email của mình. Ngoài ra khách hàng có trách nhiệm thông báo kịp thời cho tdoctor.net về những hành vi sử dụng trái phép, lạm dụng, vi phạm bảo mật, lưu giữ tên và mật khẩu của bên thứ ba để có biện pháp giải quyết phù hợp.</p>
            </div>
            <h5><strong>Phạm vi sử dụng thông tin</strong></h5>
            <h6>-Các thông tin cá nhân được khách hàng cung cấp có thể dùng vào các mục đích sau:</h6>
            <div class="pl-2 mb-3">
                <p>● Cung cấp các dịch vụ đến khách hàng;</p>
                <p>● Gửi các thông báo về các hoạt động trao đổi thông tin giữa khách hàng và ….;</p>
                <p>● Ngăn ngừa các hoạt động phá lộ thông tin cá nhân hoặc các hoạt động giả mạo khách hàng;</p>
                <p>● Liên lạc và giải quyết với khách hàng trong những trường hợp đặc biệt. Không sử dụng thông tin cá nhân của khách hàng ngoài mục đích xác nhận và liên hệ có liên quan đến giao dịch tại tdoctor.net.</p>
                <p>● Trong trường hợp có yêu cầu của pháp luật: tdoctor.net có trách nhiệm hợp tác cung cấp thông tin cá nhân của khách hàng khi có yêu cầu từ cơ quan tư pháp bao gồm: Viện kiểm sát, tòa án, cơ quan công an điều tra liên quan đến hành vi vi phạm pháp luật nào đó của khách hàng. Ngoài ra, không ai có quyền xâm phạm vào thông tin cá nhân của khách hàng.</p>
            </div>
            <h5><strong>Thời gian lưu giữ thông tin</strong></h5>
            <div class="pl-2 mb-3">
                <p>● Dữ liệu cá nhân của khách hàng sẽ được lưu trữ cho đến khi có yêu cầu hủy bỏ hoặc tự thành viên đăng nhập và thực hiện hủy bỏ. Còn lại trong mọi trường hợp thông tin cá nhân của khách hàng sẽ được bảo mật.</p>
            </div>
            <h5><strong>Những người hoặc tổ chức có thể được tiếp cận với thông tin đó</strong></h5>
            <h6>-Khách hàng đồng ý rằng: trong trường hợp cần thiết, các cơ quan/tổ chức/cá nhân sau có quyền được tiếp cận và thu thập các thông tin của mình, bao gồm:</h6>
            <div class="pl-2 mb-3">
                <p>● Ban Quản Trị tdoctor.net.</p>
                <p>● Cơ quan nhà nước có thẩm quyền (trong trường hợp có yêu cầu của pháp luật).</p>
                <p>● Bên khiếu nại chứng minh được hành vi vi phạm của khách hàng (nếu có).</p>
            </div>
            <h4><strong>Địa chỉ của đơn vị thu thập và quản lý thông tin cá nhân</strong></h4>
            <div class="pl-2 mb-3">
                <h6>● CÔNG TY CỔ PHẦN TDOCTOR PHARMA</h6>
                <p>● MST 0318669836, cấp ngày 16/09/2024, cấp bởi Sở Kế Hoạch Và Đầu Tư TP HCM - Phòng Đăng Ký Kinh Doanh.</p>
                <p>● Địa chỉ: </p>
                <div class="pl-2">
                    <p>Trụ sở CÔNG TY CỔ PHẦN TDOCTOR PHARMA: Số 03, Đường Huỳnh Khương Ninh, Phường Đa Kao, Quận 1, Thành phố Hồ Chí Minh, Việt Nam</p>
                    <p>Văn phòng đại diện: Tầng 3, Tòa 35 Hùng Vương, P. Điện Biên, Q. Ba Đình, Hà Nội</p>
                    <p>Chi nhánh Cần Thơ: Số 209, Đường 30/4, Phường Xuân Khánh, Quận Ninh Kiều, Thành phố Cần Thơ</p>
                </div>
                <p>● Điện thoại: 0393.167.234</p>
                <p>● Email: tdoctorvn@gmail.com</p>
            </div>
            <h5><strong>Phương tiện và công cụ để người dùng tiếp cận và chỉnh sửa dữ liệu cá nhân của mình</strong></h5>
            <div class="pl-2 mb-3">
                <p>● Khách hàng có quyền tự kiểm tra, cập nhật, điều chỉnh hoặc hủy bỏ thông tin cá nhân của mình hoặc yêu cầu tdoctor.net thực hiện việc này.</p>
                <p>● Khách hàng có quyền gửi khiếu nại về việc lộ thông tin cá nhân cho bên thứ 3 đến ban quản trị của tdoctor.net. Khi tiếp nhận những phản hồi này, tdoctor.net sẽ xác nhận lại thông tin, phải có trách nhiệm trả lời lý do và hướng dẫn khách hàng khôi phục và bảo mật lại thông tin.</p>
                <p>● Email: tdoctorvn@gmail.com</p>
            </div>
            <h5><strong>Cam kết bảo mật thông tin cá nhân khách hàng</strong></h5>
            <div class="pl-2 mb-3">
                <p>● Thông tin cá nhân của khách hàng trên tdoctor.net được cam kết bảo mật tuyệt đối theo chính sách bảo vệ thông tin cá nhân của khách hàng. Việc thu nhập và sử dụng thông tin của mỗi khách hàng chỉ được thực hiện khi có sự đồng ý của khách hàng đó trừ những trường hợp pháp luật quy định khác.</p>
                <p>● Không sử dụng, không chuyển giao, cung cấp hay tiết lộ cho bên thứ 3 nào về thông tin cá nhân của khách hàng khi không có sự cho phép đồng ý từ thành viên.</p>
                <p>● Trong trường hợp máy chủ lưu lưu trữ thông tin bị hacker tấn công dẫn đến mất mát dữ liệu cá nhân của khách hàng, tdoctor.net sẽ có trách nhiệm thông báo vụ việc cho cơ quan chức năng điều tra xử lý kịp thời và thông báo cho thành viên được biết.</p>
                <p>● Bảo mật tuyệt đối mọi thông tin giao dịch trực tuyến của khách hàng bao gồm thông tin hóa đơn kế toán chứng từ số hóa tại khu vực dữ liệu trung tâm an toàn cấp 1 của tdoctor.net.</p>
                <p>● Ban quản lý tdoctor.net yêu cầu các cá nhân khi đăng ký/ mua hàng phải cung cấp đầy đủ thông tin cá nhân có liên quan như: Họ và tên, email, số điện thoại và chịu trách nhiệm về tính pháp lý của những thông tin trên. Ban quản lý tdoctor.net không chịu trách nhiệm cũng như không giải quyết mọi khiếu nại có liên quan đến quyền lợi của khách hàng đó nếu xét thấy tất cả thông tin cá nhân của khách hàng đó cung cấp khi đăng ký ban đầu là không chính xác.</p>
            </div>
            <h5><strong>Cơ chế tiếp nhận và giải quyết khiếu nại liên quan đến việc thông tin cá nhân khách hàng</strong></h5>
            <div class="pl-2 mb-3">
                <p>● Thông tin cá nhân của khách hàng được cam kết bảo mật tuyệt đối theo chính sách bảo vệ thông tin cá nhân. Việc thu thập và sử dụng thông tin của mỗi khách hàng chỉ được thực hiện khi có sự đồng ý của khách hàng đó trừ những trường hợp pháp luật có quy định khác.</p>
                <p>● Không sử dụng, không chuyển giao, cung cấp hay tiết lộ cho bên thứ 3 nào về thông tin cá nhân của thành viên khi không có sự cho phép đồng ý từ khách hàng.</p>
                <p>● Trong trường hợp máy chủ lưu trữ thông tin bị hacker tấn công dẫn đến mất mát dữ liệu cá nhân của khách hàng, chúng tôi sẽ có trách nhiệm thông báo vụ việc cho cơ quan chức năng điều tra xử lý kịp thời và thông báo cho khách hàng được biết.</p>
                <p>● Ban quản lý yêu cầu các cá nhân khi đăng ký/mua hàng phải cung cấp đầy đủ thông tin cá nhân có liên quan như: Họ và tên, email, điện thoại, và chịu trách nhiệm về tính pháp lý của những thông tin trên. Ban quản lý tdoctor.net không chịu trách nhiệm cũng như không giải quyết mọi khiếu nại có liên quan đến quyền lợi của khách hàng đó nếu xét thấy tất cả thông tin cá nhân của thành viên đó cung cấp khi đăng ký ban đầu là không chính xác.</p>
                <p>● Khách hàng có quyền gửi khiếu nại về việc lộ thông tin cá nhân cho bên thứ 3 đến ban quản trị của tdoctor.net đến địa chỉ công ty:</p>
                <div class="pl-1">
                    <p class="font-weight-bold"> CÔNG TY CỔ PHẦN TDOCTOR PHARMA</p>
                    <p>● MST 0318669836, cấp ngày 16/09/2024, cấp bởi Sở Kế Hoạch Và Đầu Tư TP HCM - Phòng Đăng Ký Kinh Doanh.</p>
                    <p>● Địa chỉ: </p>
                    <div class="pl-1">
                        <p>Trụ sở CÔNG TY CỔ PHẦN TDOCTOR PHARMA: Số 03, Đường Huỳnh Khương Ninh, Phường Đa Kao, Quận 1, Thành phố Hồ Chí Minh, Việt Nam.</p>
                        <p>Văn phòng đại diện: Tầng 3, Tòa 35 Hùng Vương, P. Điện Biên, Q. Ba Đình, Hà Nội</p>
                        <p>Chi nhánh Cần Thơ: Số 209, Đường 30/4, Phường Xuân Khánh, Quận Ninh Kiều, Thành phố Cần Thơ</p>
                    </div>
                    <p>● Điện thoại: 0393167234</p>
                    <p>● Email: tdoctorvn@gmail.com</p>
                    <p>Công ty có trách nhiệm thực hiện các biện pháp kỹ thuật, nghiệp vụ để xác minh các nội dung được phản ánh.</p>
                </div>
            </div>
        </div>
    </div>
</div>
<br><br>
@endsection