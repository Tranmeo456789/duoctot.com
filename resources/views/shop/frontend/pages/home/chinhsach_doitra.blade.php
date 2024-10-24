@extends('shop.layouts.frontend')

@section('content')
<div class="mt-3 wp-inner">
    <div class="row">
        <div class="d-none d-lg-block col-lg-2 border-right">
            <a href="#main-content">
                <h5 class="text-dark">Nội dung chính</h5>
            </a>
            <a href="#chinhsach-doitra">
                <h6>-Chính sách đổi trả</h6>
            </a>
        </div>
        <div class="col-12 col-lg-10 content-policy">
            <h3>Chính sách đổi trả</h3>
            <h4 class="font-weight-bold mt-2">1.Quy định đổi trả</h4>
            <div class="pl-1 mt-2">
                <h5 class="font-weight-bold">a,Nhóm sản phẩm 1</h5>
                <div class="pl-1">
                    <p>Thực phẩm chức năng</p>
                    <p>Dược mỹ phẩm</p>
                    <p>Trang thiết bị y tế ngoài máy (dụng cụ y tế, kit test,...) và các sản phẩm khác</p>
                </div>
                <h5 class="mt-2 font-weight-bold">Chính sách đổi trả</h5>
                <div class="pl-1">
                    <p class="font-weight-bold">*Lỗi nhà sản xuất:</p>
                    <div class="pl-1">
                        <p>Miễn phí đổi hoặc trả hàng</p>
                        <p>Điều kiện áp dụng: Thời gian đổi trả không quá 30 ngày kể từ ngày mua. Sản phẩm có lỗi nhà sản xuất (biến đổi màu, màu không đồng nhất, sản phẩm dạng viên có bột vụn, sản phẩm dạng kem bị vữa hay vón cục, sản phẩm lỏng dạng hỗn dịch bị phân lớp,...)</p>
                    </div>
                    <p class="font-weight-bold mt-1">*Không có lỗi nhà sản xuất và chưa sử dụng:</p>
                    <div class="pl-1">
                        <p>Miễn phí đổi hoặc trả hàng. Thu 30% giá trị sản phẩm trên hóa đơn nếu mất vỏ hộp (đối với sản phẩm có vỏ hộp)</p>
                        <p>Điều kiện áp dụng: Thời gian đổi trả không quá 30 ngày kể từ ngày mua. Sản phẩm còn nguyên, bao gồm: Chưa xé tem niêm phong hoặc chưa xé vỏ bọc ngoài hộp và Chưa xé lớp giấy/thiếc bên trong hộp, chưa mở Garanti nắp hộp (đối với sản phẩm không có tem niêm phong hoặc không có vỏ bọc ngoài hộp)</p>
                        <p>Sản phẩm loại trừ, không áp dụng: Nhóm loại trừ gồm:
                            - Hàng tiêm chích, hàng lạnh
                            - Hàng đặt lẻ theo yêu cầu của khách hàng, hàng dự án
                            - Hàng cắt liều
                            - Sản phẩm đóng gói không có Garanti/tem niêm phong
                            - Sản phẩm dạng nước (bình xịt,…), dạng kem/gel (tuýp bôi,...)
                            - Sản phẩm được khuyến mại
                            - Những sản phẩm không áp dụng đổi trả đã được thông báo trên website hoặc tại cửa hàng</p>
                    </div>
                    <p class="font-weight-bold">*Không có lỗi nhà sản xuất và đã mở hộp/đã sử dụng:</p>
                    <div class="pl-1">
                        <p>Phí đổi trả 30% (kể cả còn hay mất vỏ hộp)</p>
                        <p>Điều kiện áp dụng: Thời gian đổi trả không quá 30 ngày kể từ ngày mua. Sản phẩm có lỗi nhà sản xuất (biến đổi màu, màu không đồng nhất, sản phẩm dạng viên có bột vụn, sản phẩm dạng kem bị vữa hay vón cục, sản phẩm lỏng dạng hỗn dịch bị phân lớp,...)</p>
                    </div>
                </div>
            </div>
            <div class="pl-1 mt-2">
                <h5 class="font-weight-bold">b,Nhóm sản phẩm 2</h5>
                <div class="pl-1">
                    <p>Máy đo SPO2, Máy đo huyết áp, Máy đo đường huyết, Máy xông khí dung, Máy tạo oxy, Máy trợ thính</p>
                </div>
                <h5 class="mt-2 font-weight-bold">Chính sách đổi trả</h5>
                <div class="pl-1">
                    <p class="font-weight-bold">*Lỗi nhà sản xuất:</p>
                    <div class="pl-1">
                        <p>Miễn phí đổi hoặc trả hàng, Thu 30% giá trị sản phẩm trên hóa đơn nếu mất vỏ hộp</p>
                        <p>Điều kiện áp dụng: Thời gian đổi trả không quá 1 năm kể từ ngày mua. Sản phẩm còn đầy đủ phụ kiện, linh kiện máy. Sản phẩm có lỗi nhà sản xuất</p>
                    </div>
                    <p class="font-weight-bold mt-1">*Không có lỗi nhà sản xuất (theo nhu cầu khách hàng):</p>
                    <div class="pl-1">
                        <p>Miễn phí đổi trả hàng nếu sản phẩm chưa sử dụng. Thu 30% giá trị sản phẩm trên hóa đơn nếu sản phẩm đã qua sử dụng hoặc mất vỏ hộp</p>
                        <p>Điều kiện áp dụng: Thời gian đổi trả không quá 30 ngày kể từ ngày mua. Sản phẩm còn đầy đủ phụ kiện, linh kiện máy</p>
                    </div>
                </div>
            </div>
            <h5 class="font-weight-bold mt-2">Lưu ý:</h5>
            <p>Các trường hợp đổi/trả dành cho khách hàng có thông tin số điện thoại trên bill để phục vụ tra cứu.</p>
            <p>Quý khách hàng vui lòng hoàn trả các sản phẩm tặng kèm (nếu có) khi phát sinh đổi/trả hàng hóa, hoặc Long Châu thu lại số tiền tương đương mức giá của sản phẩm tặng kèm đã được công bố.</p>
            <!-- <p>Ngoại trừ thuốc đặc trị ung thư, Long Châu áp dụng đổi/trả một phần và toàn bộ sản phẩm (Ví dụ: Khách hàng mua 1 hộp 3 vỉ thuốc, Long Châu chấp nhận đổi trả 1 vỉ hoặc cả hộp thuốc...), số tiền hoàn lại được tính dựa theo số lượng thực tế trả hàng và các loại phí theo chính sách (nếu có).</p>
            <p>Đối với thuốc đặc trị ung thư:
                - Bán nguyên hộp: chỉ áp dụng đổi trả nguyên hộp
                - Bán lẻ: áp dụng đổi trả lẻ
            </p> -->
            <h4 class="font-weight-bold mt-2">2. Phương thức đổi trả hàng và cách thức nhận lại tiền</h4>
            <p>Khách hàng mang sản phẩm đã mua (bao gồm vỏ hộp, giấy hướng dẫn sử dụng kèm theo) tới cơ sở TDOCTOR gần nhất để được thực hiện đổi trả và hoàn tiền.</p>
            <p>Để nhận tiền hoàn, khách hàng có 2 lựa chọn:</p>
            <p>Hoàn tiền tại quầy: Cửa hàng chi tiền mặt tại quầy cho khách hàng.</p>
            <p>Sau khi tiếp nhận yêu cầu hoàn tiền qua chuyển khoản của khách, TDOCTOR sẽ gọi để xác nhận.</p>
        </div>
    </div>
</div>
@endsection