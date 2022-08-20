@extends('shop.layouts.frontend')

@section('content')
<div class="wp-inner mt-2">
    <div class="" id="breadcrumb-wp">
        @include("$moduleName.pages.$controllerName.child_index.breadcrumb_detail")
    </div>
    <div id="detail_product">
        <div class="row">
            <div class="col-md-5">
                <div class="thumb_nail">
                    <img src="{{asset('images/shop/thumb1.png')}}" alt="">
                </div>
                <div class="thumb_detail">
                    <ul class="d-flex justify-content-between">
                        <li><img src="{{asset('images/shop/thumb2.png')}}" alt=""></li>
                        <li><img src="{{asset('images/shop/thumb3.png')}}" alt=""></li>
                        <li><img src="{{asset('images/shop/thumb4.png')}}" alt=""></li>
                        <li><img src="{{asset('images/shop/thumb3.png')}}" alt=""></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-7">
                <div class="title_product">
                    <p class="trademark_product">Thương hiệu: <span class="text-info">Dolexphar</span></p>
                    <h1>Viên uống Sâm Nhung Bổ Thận NV Dolexphar giúp tráng dương, mạnh gân cốt (30 viên)</h1>
                    <div class="comment d-flex justify-content-between flex-wrap">
                        <span class="text-muted">(00011059)</span>
                        <div class="position-relative">
                            <span class="star-befor">
                                <img src="{{asset('images/shop/star.png')}}" alt="">
                                <img src="{{asset('images/shop/star.png')}}" alt="">
                                <img src="{{asset('images/shop/star.png')}}" alt="">
                                <img src="{{asset('images/shop/star.png')}}" alt="">
                                <img src="{{asset('images/shop/star.png')}}" alt="">
                            </span>
                            <span class="text-muted">
                                3 Đánh giá | 138 Bình luận
                            </span>
                        </div>
                    </div>
                </div>
                <div class="desc_product">
                    <div class="price_product mb-2"><span class="font-weight-bold">110.000đ</span>/Hộp</div>
                    <p><span class="font-weight-bold bcn">Danh mục: </span><span class="text-info">Sức khoẻ tình dục</span></p>
                    <p><span class="font-weight-bold">Dạng bào chế: </span> Viên nang</p>
                    <p><span class="font-weight-bold">Quy cách: </span>Hộp 30 viên</p>
                    <p><span class="font-weight-bold">Xuất xứ thương hiệu: </span>Việt Nam</p>
                    <p><span class="font-weight-bold">Nước sản xuất: </span>Viet nam</p>
                    <p><span class="font-weight-bold">Công dụng: </span>Sâm Nhung Bổ Thận NV giúp bổ thận, tráng dương, mạnh gân cốt, ăn ngủ tốt, tăng cường sinh lực, giúp giảm tình trạng mãn dục nam, yếu sinh lý, đau lưng, mỏi gối.</p>
                </div>
                <div class="payment position-relative">
                    <h2>Thanh toán VNPAY-QR</h2>
                    <p>Nhập mã VNPAYLC giảm ngay 3% tối đa 50,000đ khi thanh toán 100% qua VNPAY-QR <a href="">Xem chi tiết</a></p>
                    <div class="payment-img"><img src="{{asset('images/shop/vnpay.png')}}" alt=""></div>
                </div>
                <form action="">
                    <div class="input-number">
                        <span class="seclect-number">Chọn số lượng</span>
                        <span class="pm11">
                            <span title="" class="minus1"><i class="fa fa-minus"></i></span>
                            <input type="number" name="" min="0" value="1" class="num-order">
                            <span title="" class="plus1"><i class="fa fa-plus"></i></span>
                        </span>
                    </div>
                    <div class="btn-buy-search d-flex justify-content-between flex-wrap">
                        <input type="submit" value="Chọn mua" class="btn-select-buy btn btn-primary text-light mb-xs-2">
                        <a class="btn-search-house" href="">Tìm nhà thuốc</a>
                    </div>
                </form>
                <div class="commit-tdoctor text-center">
                    <p class="pnote-view">
                        <span class="position-relative text-orange">Sản phẩm đang được chú ý
                            <span class="pnote-view-img"><img src="{{asset('images/shop/star2.png')}}" alt=""></span>
                        </span>
                        <span>, có 7 người thêm vào giỏ hàng & 16 người đang xem</span>
                    </p>
                    <div class="commit-tdoctor-child">
                        <div class="title-commit-tdoctor text-center">
                            T doctor cam kết
                        </div>
                        <div class="content-commit-tdoctor">
                            <ul class="d-flex justify-content-between flex-wrap">
                                <li>
                                    <div class="text-center"><img src="{{asset('images/shop/cm1.png')}}" alt=""></div>
                                    <h3>Đổi trả trong 30 ngày</h3>
                                    <p>kể từ ngày mua hàng</p>
                                </li>
                                <li>
                                    <div class="text-center"><img src="{{asset('images/shop/cm1.png')}}" alt=""></div>
                                    <h3>Đổi trả trong 30 ngày</h3>
                                    <p>kể từ ngày mua hàng</p>
                                </li>
                                <li>
                                    <div class="text-center"><img src="{{asset('images/shop/cm1.png')}}" alt=""></div>
                                    <h3>Đổi trả trong 30 ngày</h3>
                                    <p>kể từ ngày mua hàng</p>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="mess_free bg-orange"><a href="">Nhận tư vấn miễn phí</a><img src="{{asset('images/shop/mess.png')}}" alt=""></div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="short-infohr mb-3"></div>
<div class="wp-inner">
    <div id="content-detail-product" class="row">
        <div class="col-3 cat-content px-0">
            <div class="main-content-product">
                <h1>Nội dung chính
                    <div class="roud-img"><img src="{{asset('images/shop/3ngang.png')}}" alt=""></div>
                </h1>
            </div>
            <ul class="list-content-product">
                <li>Mô tả sản phẩm</li>
                <li>Thành phần</li>
                <li>Công dụng</li>
                <li>Liều dùng</li>
                <li>Tác dụng phụ</li>
                <li>Lưu ý</li>
                <li>Bảo quản</li>
            </ul>
        </div>
        <div class="col-9 pl-3">
            <div class="title-content-detail-product d-flex justify-content-between flex-wrap">
                <h1>Mô tả sản phẩm Sâm Nhung Bổ Thận NV</h1>
                <div>
                    <span class="ktc">Kích thước chữ</span>
                    <span class="mdlh">
                        <a class="md" href="">Mặc định</a>
                        <a class="lh" href="">Lớn hơn</a>
                    </span>
                </div>
            </div>
            <div class="content-detail-product">
                <p class="py-2">Hỗ trợ bổ thận, tăng cường sinh lực phái mạnh</p>
                <p>Sâm Nhung Bổ Thận NV ra đời dựa trên sự kết hợp giữa tinh hoa y học cổ truyền và ứng dụng công nghệ sản xuất hiện đại. Sản phẩm có chứa rất nhiều thành phần quý, đặc biệt tốt cho những nam giới bị suy giảm chức năng thận.</p>
                <img src="{{asset('images/shop/dtp.png')}}" alt="">
                <p class="text-center">Viên uống Sâm Nhung Bổ Thận NV giúp tráng dương, mạnh gân cốt.</p>
                <p>Thận là cơ quan giữ vai trò rất quan trọng trong cơ thể con người. Khi thận bị suy yếu, chức năng của thận sẽ suy giảm và kéo theo hàng loạt các vấn đề như yếu sinh lý, xuất tinh sớm, đau lưng, mỏi gối… Bên cạnh việc duy trì lối sống khoa học, hợp lý, người bệnh có thể sử dụng thực phẩm chức năng Sâm Nhung Bổ Thận NV với sự có mặt của các vị thuốc quý như cẩu tích, đỗ trọng, thỏ ty tử, hà thủ ô đỏ, tục đoạn, thục địa… có khả năng loại trừ phong thấp, làm ấm thận, trợ dương, ích huyết và mạnh gân cốt.
                <p class="font-weight-bold">Tăng cường chức năng thận</p>
                <p>Vị thuốc cẩu tích và Đỗ trọng có trong Sâm Nhung Bổ Thận NV có tác dụng bổ can thận, giảm đau lưng, tiểu nhiều lần, thận hư yếu. Trong khi đó, thành phần thỏ ty tử lại giúp cố tinh, ích âm, ôn thận tráng dương. Tục đoạn và hà thủ ô giúp bồi bổ can thận, làm thông huyết mạch, nhuận tràng thông tiện. Với sự có mặt của những vị thuốc trên, Sâm Nhung Bổ Thận NV sẽ mang lại hiệu quả cao trong việc tăng cường chức năng thận, làm giảm các triệu chứng do suy giảm chức năng thận gây ra như tiểu đêm nhiều lần, đau lưng, mỏi gối,...</p>
                Tăng cường sinh lý, làm chậm mãn dục nam
                Cũng chính bởi khả năng tăng cường chức năng thận mà các vấn đề như yếu sinh lý, xuất tinh sớm ở nam giới... cũng có xu hướng thuyên giảm sau khi nam giới sử dụng Sâm Nhung Bổ Thận NV. Với sự kết hợp của 3 thành phần tiêu biểu như ba kích, dâm dương hoắc, nhục thung dung, sản phẩm sẽ giúp nam giới tăng cường sinh lý mạnh mẽ.
                Trong đó, b kích giúp làm ấm thận dương, rất thích hợp để hỗ trợ các bệnh như di tinh, liệt dương, xuất tinh sớm. Dâm dương hoắc có tác dụng thúc đẩy sự bài tiết của tinh dịch, tăng cường hoạt động của tinh hoàn, tăng ham muốn tình dục ở nam giới. Đặc biệt hơn, nhục thung dung có trong Sâm Nhung Bổ Thận NV có khả năng cải thiện chứng thận hư, liệt dương, di tinh, xuất tinh sớm, yếu sinh lý, thậm chí là vô sinh.
                Tăng cường sinh lực, giúp cơ thể khỏe mạnh
                Song song với khả năng bổ thận, tăng cường chức năng sinh lý nam giới, Sâm Nhung Bổ Thận NV còn giúp kiện tỳ, ích khí, bồi bổ thể trạng và nâng cao sức khỏe nhờ vào những vị thuốc như nhung hươu, nhân sâm.
                Nhung hươu là một trong số những tứ đại danh dược bổ dưỡng, được rất nhiều người lựa chọn để tăng cường sức khỏe và bồi bổ cơ thể. Bên cạnh đó, thành phần nhung hươu có trong Sâm Nhung Bổ Thận NV còn giúp tăng cường sức đề kháng, hỗ trợ hoạt động tiêu hóa, sinh tinh, trợ dương, mạnh gân xương và kéo dài tuổi thọ.
                Không chỉ vậy, hoạt chất nhân sâm có trong sản phẩm còn giúp bồi bổ sức khỏe, nâng cao thể lực cho cơ thể nhờ các chất như glycoside panaxin, germanium và các loại vitamin như vitamin B1, vitamin B2 và các loại axit béo như stearic, axit panmitic.
                An toàn, lành tính, hiệu quả lâu d
                Sâm Nhung Bổ Thận NV được chiết xuất từ 100% thảo dược tự nhiên, không chứa các thành phần tân dược, do đó có thể sử dụng trong thời gian dài mà không cần phải lo lắng về những tác dụng phụ như các loại thuốc Tây y. Sâm Nhung Bổ Thận NV đã được Bộ Y tế cấp phép lưu hành và được đông đảo khách hàng tin tưởng sử dụng.
                ----
                Sâm Nhung Bổ Thận NV được sản xuất bởi Công ty Cổ phần Dược phẩm Quốc tế Dolexphar. Đây là đơn vị hàng đầu trong lĩnh vực nghiên cứu công thức sản phẩm, sản xuất các loại thực phẩm bảo vệ sức khỏe và trang thiết bị y tế. Nhà máy đã được Cục An toàn thực phẩm - Bộ Y tế cấp giấy chứng nhận đạt tiêu chuẩn GMP. Với sứ mệnh cung cấp các sản phẩm chất lượng, hiệu quả với giá cả hợp lý, Dolexphar luôn luôn cải tiến sản phẩm không ngừng, đáp ứng tốt nhu cầu chăm sóc sức khỏe của cộng đồng, chinh phục khách hàng bằng chất lượng.</p>
                <h2>Thành phần của Sâm nhung Bổ thận</h2>
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
                <p>Nhung hươu: Tráng dương, bổ thận, bổ huyết, trị hư lạo, cường tráng gân cốt.
                    Nhân sâm: Sinh tân dịch, bổ ích huyết, giúp an thần và tăng trí nhớ.
                    Bạch truật, ba kích, cẩu tích, hà thủ ô, đỗ trọng, thỏ ty tử, nhục thung dung, xuyên khung, tục đoạn: Giúp ấm thận trợ dương, trừ phong thấp, mạnh gân cốt, ích huyết.
                    Cam thảo, bách hợp, câu kỷ tử, đương quy, đẳng sâm, liên nhục, hoài sơn: Giúp ích khí, bổ tỳ vị, sinh tân dịch, nhuận phế, giải khát, thanh nhiệt, giải độc cơ thể, an thần, dưỡng tâm, điều kinh, bổ huyết, tiêu sưng, thông huyết, lợi gan.
                    Trạch tả, thục địa, bạch linh: Dưỡng âm, nuôi can thận, bổ tinh tủy.
                </p>
                <div class="note-product">
                    <h2>Lưu ý của Sâm bổ thận</h2>
                    <p>
                        Không dùng quá liều khuyến cáo.
                        Không sử dụng cho người dưới 18 tuổi, người mẫn cảm với bất kỳ thành phần nào của sản phẩm.
                        Sản phẩm này không phải là thuốc và không có tác dụng thay thế thuốc chữa bệnh.
                        Đọc kỹ hướng dẫn sử dụng trước khi dùng.</p>
                </div>
                <p class="font-weight-bold">
                    Bảo quản
                </p>
                <p>
                    Bảo quản nơi khô ráo, thoáng mát, tránh ánh sáng trực tiếp.
                    Để xa tầm tay trẻ em.</p>
            </div>
        </div>
    </div>
</div>
<div class="mt-3 py-3 colorb-wp">
    <div class="wp-inner">
        <div id="product-relate">
            <div id="feature-product-wp">
                <div class="mb-3 headf position-relative pl-5">
                    <h1>Sản phẩm Liên Quan</h1>
                    <img src="{{asset('images/shop/lua1.png')}}" alt="" srcset="">
                </div>
                <div>
                    <ul class="list-item">
                        <li>
                            <div>
                                <div class="rdimg d-flex justify-content-center"><img src="{{asset('images/shop/covid2.png')}}" alt="" srcset=""></div>
                                <div class="pl-3">
                                    <a>Viên sủi opimax Imunity</a>
                                    <span class="text-info">115.000đ/tuýp</span>
                                    <div class="slbuy text-center mt-4"><a href="">Chọn mua</a></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div>
                                <div class="rdimg d-flex justify-content-center"><img src="{{asset('images/shop/covid2.png')}}" alt="" srcset=""></div>
                                <div class="pl-3">
                                    <a>Viên sủi opimax Imunity</a>
                                    <span class="text-info">115.000đ/tuýp</span>
                                    <div class="slbuy text-center mt-4"><a href="">Chọn mua</a></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div>
                                <div class="rdimg d-flex justify-content-center"><img src="{{asset('images/shop/covid2.png')}}" alt="" srcset=""></div>
                                <div class="pl-3">
                                    <a>Viên sủi opimax Imunity</a>
                                    <span class="text-info">115.000đ/tuýp</span>
                                    <div class="slbuy text-center mt-4"><a href="">Chọn mua</a></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div>
                                <div class="rdimg d-flex justify-content-center"><img src="{{asset('images/shop/covid2.png')}}" alt="" srcset=""></div>
                                <div class="pl-3">
                                    <a>Viên sủi opimax Imunity</a>
                                    <span class="text-info">115.000đ/tuýp</span>
                                    <div class="slbuy text-center mt-4"><a href="">Chọn mua</a></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div>
                                <div class="rdimg d-flex justify-content-center"><img src="{{asset('images/shop/covid2.png')}}" alt="" srcset=""></div>
                                <div class="pl-3">
                                    <a>Viên sủi opimax Imunity</a>
                                    <span class="text-info">115.000đ/tuýp</span>
                                    <div class="slbuy text-center mt-4"><a href="">Chọn mua</a></div>
                                </div>
                            </div>
                        </li>
                        <li>
                            <div>
                                <div class="rdimg d-flex justify-content-center"><img src="{{asset('images/shop/covid2.png')}}" alt="" srcset=""></div>
                                <div class="pl-3">
                                    <a>Viên sủi opimax Imunity</a>
                                    <span class="text-info">115.000đ/tuýp</span>
                                    <div class="slbuy text-center mt-4"><a href="">Chọn mua</a></div>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="question-often mt-3">
            <h1>
                Câu hỏi thường gặp
            </h1>
            <ul class="list-question">
                <li>
                    <h3 class="">Thực phẩm chức năng hỗ trợ sức khỏe tình dục nam giới có tác dụng gì?<img src="{{asset('images/shop/hoi.png')}}" alt="">
                        <i class="fas fa-angle-up"></i>
                    </h3>
                    <p>* Giúp kích hoạt cơ chế sản sinh Hormone sinh dục nam nội sinh một cách tự nhiên.</p>
                    <p>* Bổ thận tráng dương, tăng cường sinh lý, phục hồi khả năng sinh lý nam giới.</p>
                    <p>* Hỗ trợ điều trị rối loạn cương dương, xuất tinh sớm, di tinh, mộng tinh… làm chậm quá trình mãn dục nam.</p>
                    <p>* Giúp tăng cường lưu thông máu, tăng cường ham muốn, khắc phục tình trạng rối loạn cương dương ở nam giới.</p>
                </li>
                <li>
                    <h3 class="">Thực phẩm chức năng hỗ trợ sức khỏe tình dục nam giới có tác dụng gì?<img src="{{asset('images/shop/hoi.png')}}" alt="">
                        <i class="fas fa-angle-down"></i>
                    </h3>
                </li>
                <li>
                    <h3 class="">Thực phẩm chức năng hỗ trợ sức khỏe tình dục nam giới có tác dụng gì?<img src="{{asset('images/shop/hoi.png')}}" alt="">
                        <i class="fas fa-angle-down"></i>
                    </h3>
                </li>
            </ul>
        </div>
        <div class="question-often mt-3">
            <h1>
                Bình luận
            </h1>
            <div class="content-quest">
                <textarea name="" id="" placeholder="Nhập nội dung câu hỏi"></textarea>
                <a href="" class="btn btn-primary">Gửi bình luận</a>
            </div>
            <ul class="list-comment position-relative">
                <div class="btnselecthc">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mới nhất</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Cũ nhất</a>
                            <a class="dropdown-item" href="#">Hữu ích nhất</a>
                        </div>
                    </div>
                </div>
                <li>
                    <div class="commentq position-relative">
                        <span class="name">Trần Tùng </span><span class="text-muted">2 ngày trước</span>
                        <p>Mình mới dùng được một lọ theo chỉ dẫn uống ngày hai lần mỗi lần hai viên lúc đóinhưng được hai ba hôm mỗi lần uống thỉnh thoảng lại nổi mẩn ngứa ở hai eo lưng và sau gần sát nách</p>
                        <div class="roud-img"><img src="{{asset('images/shop/TT.png')}}" alt=""></div>
                    </div>
                    <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                    <div class="tplv">
                        <div class="commenta">
                            <span class="name">QuỳnhDT32</span><span class="cdntl">Quản trị viên</span><span class="text-muted">2 ngày trước</span>
                            <p>Chào Bạn Trịnh công bảo,Dạ sản phẩm hiện có hàng tại một số chi nhánh thuộc khu vực Thành Phố Huế gần khu vực thị xã Hương Trà ạ.Bạn vui lòng liên hệ tổng đài miễn phí 18006928 để được hỗ trợ tư vấn và đặt hàng.Thân mến!</p>
                            <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="commentq position-relative">
                        <span class="name">Võ Hùng </span><span class="text-muted">2 ngày trước</span>
                        <p>mình sử dụng hết thuốc sâm nhung bổ thận TW3 rồi qua sử dụng viên uống sâm nhung bổ thận NV này được ko ạ
                            mình sử dụng hết thuốc sâm nhung bổ thận TW3 rồi qua sử dụng viên uống sâm nhung bổ thận NV này được ko ạ
                        </p>
                        <div class="roud-img"><img src="{{asset('images/shop/VH.png')}}" alt=""></div>
                    </div>
                    <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                    <div class="tplv">
                        <div class="commenta">
                            <span class="name">QuỳnhDT32</span><span class="cdntl">Quản trị viên</span><span class="text-muted">2 ngày trước</span>
                            <p>Chào Bạn Trịnh công bảo,Dạ sản phẩm hiện có hàng tại một số chi nhánh thuộc khu vực Thành Phố Huế gần khu vực thị xã Hương Trà ạ.Bạn vui lòng liên hệ tổng đài miễn phí 18006928 để được hỗ trợ tư vấn và đặt hàng.Thân mến!</p>
                            <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                        </div>
                    </div>
                </li>
            </ul>
            <p class="text-center"><a href="" class="add-comment">Xem thêm bình luận <i class="fas fa-angle-down"></i></a></p>
        </div>
        <div class="question-often mt-3">
            <h1>Đánh Giá & Nhận Xét <span class="coutn-dn">3</span></h1>
            <div class="average-rating">
                <div class="d-flex justify-content-between flex-wrap">
                    <div class="average-rating-left text-center">
                        <p>Đánh giá trung bình</p>
                        <span class="sst">5/5</span>
                        <p>
                            <img src="{{asset('images/shop/Starred.png')}}" alt="">
                            <img src="{{asset('images/shop/Starred.png')}}" alt="">
                            <img src="{{asset('images/shop/Starred.png')}}" alt="">
                            <img src="{{asset('images/shop/Starred.png')}}" alt="">
                            <img src="{{asset('images/shop/Starred.png')}}" alt="">
                        </p>
                        <span class="text-muted">3 đánh giá</span>
                    </div>
                    <div class="average-rating-center align-self-center">
                        <ul>
                            <li>
                                <span class="td">
                                    <span class="tn"></span>
                                    <span class="str">5 <img src="{{asset('images/shop/Starred.png')}}" alt=""></span>
                                    <span class="ss">2</span>
                                </span>                                
                            </li>
                            <li>
                                <span class="td">
                                    <span class="tn"></span>
                                    <span class="str">4 <img src="{{asset('images/shop/Starred.png')}}" alt=""></span>
                                    <span class="ss">2</span>
                                </span>                                
                            </li>
                            <li>
                                <span class="td">
                                    <span class="tn"></span>
                                    <span class="str">3 <img src="{{asset('images/shop/Starred.png')}}" alt=""></span>
                                    <span class="ss">2</span>
                                </span>                                
                            </li>
                            <li>
                                <span class="td">
                                    <span class="tn"></span>
                                    <span class="str">2 <img src="{{asset('images/shop/Starred.png')}}" alt=""></span>
                                    <span class="ss">2</span>
                                </span>                                
                            </li>
                            <li>
                                <span class="td">
                                    <span class="tn"></span>
                                    <span class="str">1 <img src="{{asset('images/shop/Starred.png')}}" alt=""></span>
                                    <span class="ss">2</span>
                                </span>                                
                            </li>
                        </ul>
                    </div>
                    <div class="average-rating-right text-center d-flex align-self-center">
                        <div class="">
                            <p>Bạn đã dùng sản phẩm này</p>
                            <p class="text-center mt-3"><a href="">Gửi đánh giá</a></p>
                        </div>

                    </div>
                </div>
            </div>
            <ul class="list-comment position-relative">
                <div class="btnselecthc">
                    <div class="dropdown">
                        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mới nhất</button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="#">Cũ nhất</a>
                            <a class="dropdown-item" href="#">Hữu ích nhất</a>
                        </div>
                    </div>
                </div>
                <li>
                    <div class="commentq position-relative">
                        <span class="name">Trần Tùng </span><span class="text-muted">2 ngày trước</span>
                        <p>Mình mới dùng được một lọ theo chỉ dẫn uống ngày hai lần mỗi lần hai viên lúc đóinhưng được hai ba hôm mỗi lần uống thỉnh thoảng lại nổi mẩn ngứa ở hai eo lưng và sau gần sát nách</p>
                        <div class="roud-img"><img src="{{asset('images/shop/TT.png')}}" alt=""></div>
                    </div>
                    <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                    <div class="tplv">
                        <div class="commenta">
                            <span class="name">QuỳnhDT32</span><span class="cdntl">Quản trị viên</span><span class="text-muted">2 ngày trước</span>
                            <p>Chào Bạn Trịnh công bảo,Dạ sản phẩm hiện có hàng tại một số chi nhánh thuộc khu vực Thành Phố Huế gần khu vực thị xã Hương Trà ạ.Bạn vui lòng liên hệ tổng đài miễn phí 18006928 để được hỗ trợ tư vấn và đặt hàng.Thân mến!</p>
                            <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                        </div>
                    </div>
                </li>
                <li>
                    <div class="commentq position-relative">
                        <span class="name">Võ Hùng </span><span class="text-muted">2 ngày trước</span>
                        <p>mình sử dụng hết thuốc sâm nhung bổ thận TW3 rồi qua sử dụng viên uống sâm nhung bổ thận NV này được ko ạ
                            mình sử dụng hết thuốc sâm nhung bổ thận TW3 rồi qua sử dụng viên uống sâm nhung bổ thận NV này được ko ạ
                        </p>
                        <div class="roud-img"><img src="{{asset('images/shop/VH.png')}}" alt=""></div>
                    </div>
                    <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                    <div class="tplv">
                        <div class="commenta">
                            <span class="name">QuỳnhDT32</span><span class="cdntl">Quản trị viên</span><span class="text-muted">2 ngày trước</span>
                            <p>Chào Bạn Trịnh công bảo,Dạ sản phẩm hiện có hàng tại một số chi nhánh thuộc khu vực Thành Phố Huế gần khu vực thị xã Hương Trà ạ.Bạn vui lòng liên hệ tổng đài miễn phí 18006928 để được hỗ trợ tư vấn và đặt hàng.Thân mến!</p>
                            <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                        </div>
                    </div>
                </li>
            </ul>
            <p class="text-center"><a href="" class="add-comment">Xem thêm bình luận <i class="fas fa-angle-down"></i></a></p>
        </div>
    </div>
</div>
<div class="wp-inner mt-2">
    <div class="row">
        <div class="col-md-12">
            <div class="new-view mt-5">
                @include("$moduleName.pages.$controllerName.child_index.new_view")
            </div>
        </div>
    </div>
</div>
<div>
    <div class="info-tdoctor mt-5">
        @include("$moduleName.templates.info_tdoctor")
    </div>
    <div class="wp-inner mt-5">
        @include("$moduleName.templates.info_app")
    </div>
</div>

<div class="service-tdoctor mt-5">
    @include("$moduleName.templates.info_service")
</div>
<div class="local">
    @include("$moduleName.templates.local_drugstore")
</div>
<div class="wp-inner mt-5">
    <div class="feedback-customer">
        @include("$moduleName.templates.feedback_customer")
    </div>
</div>

@endsection