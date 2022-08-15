@extends('shop.layouts.frontend')

@section('content')
    <div style="">
        <img src="{{asset('images/shop/header1920.png')}}" alt="" class="img-fluid">
    </div>
    <div class="wp-inner">
        <div id="form-search" class="d-flex justify-content-center">
            <div class="form-search-inner">
                <h1>Tra Cứu Thuốc, TPCN, Bệnh lý...</h1>
                <div style="postion:relative">
                    <input type="search" placeholder="Nhập từ khóa...">
                    <button>
                        <img src="{{asset('images/shop/icon-search.png')}}" alt="">
                    </button>
                </div>              
                <h2>Tra cứu hàng đầu</h5>
                <ul class="d-flex">
                    <li>
                        <a>đau đầu</a>
                    </li>
                    <li>
                        <a>mỏi vai gáy</a>
                    </li>
                    <li>
                        <a>hoạt huyết dưỡng não</a>
                    </li>
                    <li>
                        <a>thuốc ho</a>
                    </li>
                    <li>
                        <a>thuốc cảm cúm</a>
                    </li>
                </ul>
            </div>        
        </div>
        <div id="service-doctor">
            <ul class="d-flex justify-content-between">
                <li>
                    <a href="">
                        <img src="{{asset('images/shop/doctor1.png')}}" alt="" srcset="">
                        <p>Hẹn bác sĩ đến nhà</p>
                    </a>             
                </li>
                <li>
                    <a href="">
                        <img src="{{asset('images/shop/doctor2.png')}}" alt="" srcset="">
                        <p>Gọi video với bác sĩ</p>
                    </a>             
                </li>
                <li>
                    <a href="">
                        <img src="{{asset('images/shop/doctor3.png')}}" alt="" srcset="">
                        <p>Chat miễn phí với bác sĩ</p>
                    </a>             
                </li>
                <li>
                    <a href="">
                        <img src="{{asset('images/shop/doctor4.png')}}" alt="" srcset="">
                        <p>Đặt hẹn tại phòng khám</p>
                    </a>             
                </li>
                <li>
                    <a href="">
                        <img src="{{asset('images/shop/doctor5.png')}}" alt="" srcset="">
                        <p>Nhà thuốc trực tuyến</p>
                    </a>             
                </li>
                <li>
                    <a href="">
                        <img src="{{asset('images/shop/doctor6.png')}}" alt="" srcset="">
                        <p>Theo dõi sức khỏe</p>
                    </a>             
                </li>
            </ul>
        </div>
        <div id="buy-medicine" class="mt-5">
            <h1 class="text-center">Mua thuốc dễ dàng tại TDoctor</h1>
            <ul class="d-flex justify-content-between">
                <li>
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/buy1.png')}}" alt="" srcset=""></div>                  
                        <h2>CHỤP TOA THUỐC</h1>
                        <span>đơn giản & nhanh chóng</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/buy2.png')}}" alt="" srcset=""></div>                  
                        <h2>NHẬP THÔNG TIN LIÊN LẠC</h1>
                        <span>để được tư vấn</span>
                    </a>
                </li>
                <li>
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/buy3.png')}}" alt="" srcset=""></div>                  
                        <h2>NHẬN BÁO GIÁ TỪ DƯỢC SỸ</h1>
                        <span>kèm theo báo giá miễn phí</span>
                    </a>
                </li>
            </ul>
            <div class="text-center mt-5">
                <button>MUA THUỐC NGAY</button>
                <span>Hoặc mua qua hostline 0393167234</span>
            </div>
            <div class="mt-5">
                <img src="{{asset('images/shop/baner.png')}}" alt="">
            </div>
        </div>
        <div id="featured-category" class="mt-5">
            <h1 class="text-center mb-5">Danh mục thuốc nổi bật</h1>
            <ul class="clearfix">
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/cat1.png')}}" alt="" srcset=""></div>
                        <p>Sinh lý - Nội tiết tố</p>
                        <h2>36 SẢN PHẨM</h2>
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/cat2.png')}}" alt="" srcset=""></div>
                        <p>Sức khỏe tim mạch</p>
                        <h2>36 SẢN PHẨM</h2>
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/cat3.png')}}" alt="" srcset=""></div>
                        <p>Hỗ trợ miễn dịch - Tăng sức đề kháng</p>
                        <h2>36 SẢN PHẨM</h2>
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/cat4.png')}}" alt="" srcset=""></div>
                        <p>Men vi sinh</p>
                        <h2>8 SẢN PHẨM</h2>
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/cat5.png')}}" alt="" srcset=""></div>
                        <p>Hỗ trợ tình dục</p>
                        <h2>36 SẢN PHẨM</h2>
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/cat6.png')}}" alt="" srcset=""></div>
                        <p>Chăm sóc cơ thể</p>
                        <h2>36 SẢN PHẨM</h2>
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/cat7.png')}}" alt="" srcset=""></div>
                        <p>Chăm sóc da mặt</p>
                        <h2>125 SẢN PHẨM</h2>
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/cat8.png')}}" alt="" srcset=""></div>
                        <p>Chăm sóc răng miệng</p>
                        <h2>36 SẢN PHẨM</h2>
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/cat9.png')}}" alt="" srcset=""></div>
                        <p>Vệ sinh cá nhân</p>
                        <h2>36 SẢN PHẨM</h2>
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/cat10.png')}}" alt="" srcset=""></div>
                        <p>Dụng cụ sơ cứu</p>
                        <h2>54 SẢN PHẨM</h2>
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/cat11.png')}}" alt="" srcset=""></div>
                        <p>Dụng cụ y tế</p>
                        <h2>36 SẢN PHẨM</h2>
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/cat12.png')}}" alt="" srcset=""></div>
                        <p>Khẩu trang</p>
                        <h2>36 SẢN PHẨM</h2>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div id="product-covid" class="mt-5 py-4">
        <div class="wp-inner">
            <h1 class="d-flex mb-5">
                <img src="{{asset('images/shop/covid1.png')}}" alt="" srcset="">
                <p>Sản phẩm hậu Covid</p>
            </h1>
            <ul class="clearfix">
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/covid2.png')}}" alt="" srcset=""></div>
                        <div class="pl-3">
                            <p>Viên sủi opimax Imunity</p>
                            <span class="text-info">115.000đ/tuýp</span>
                        </div>                   
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/covid3.png')}}" alt="" srcset=""></div>
                        <div class="pl-3">
                            <p>Viên sủi opimax Imunity</p>
                            <span class="text-info">115.000đ/tuýp</span>
                        </div>                   
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/covid4.png')}}" alt="" srcset=""></div>
                        <div class="pl-3">
                            <p>Viên sủi opimax Imunity</p>
                            <span class="text-info">115.000đ/tuýp</span>
                        </div>                   
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/covid5.png')}}" alt="" srcset=""></div>
                        <div class="pl-3">
                            <p>Viên sủi opimax Imunity</p>
                            <span class="text-info">115.000đ/tuýp</span>
                        </div>                   
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/covid6.png')}}" alt="" srcset=""></div>
                        <div class="pl-3">
                            <p>Viên sủi opimax Imunity</p>
                            <span class="text-info">115.000đ/tuýp</span>
                        </div>                   
                    </a>
                </li>
                <li>
                    <a href="">
                    <div class="d-flex justify-content-center"><img src="{{asset('images/shop/covid7.png')}}" alt="" srcset=""></div>
                        <div class="pl-3">
                            <p>Viên sủi opimax Imunity</p>
                            <span class="text-info">115.000đ/tuýp</span>
                        </div>                   
                    </a>
                </li>
            </ul>
        </div>      
    </div>
    <div class="wp-inner mt-5">
        <div id="selling-product">
            <h1 class="d-flex mb-5">
                <div class="icon-product-round"><img src="{{asset('images/shop/selling1.png')}}" alt="" srcset=""></div>               
                <p>Sản phẩm bán chạy nhất</p>
            </h1>
            <ul class="clearfix">
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling2.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling3.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling4.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling2.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling3.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling4.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling2.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling3.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling4.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling3.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
            </ul>
        </div>
        <div id="selling-product" class="mt-5">
            <h1 class="d-flex mb-5">
                <div class="icon-product-round2"><img src="{{asset('images/shop/selling10.png')}}" alt="" srcset=""></div>               
                <p>Sản phẩm theo đối tượng</p>
                <div class="d-flex slect-customer">
                    <span>Lọc theo</span>
                    <div class="d-flex">
                        <div class="slect-item-customer active-slect">
                            <a href="">Trẻ em</a>
                        </div>
                        <div class="slect-item-customer">
                            <a href="">Người cao tuổi</a>
                        </div>
                        <div class="slect-item-customer">
                            <a href="">Phụ nữ cho con bú</a>
                        </div>
                    </div>
                </div>
            </h1>
            <ul class="clearfix">
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling2.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling3.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Hộp</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling4.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling2.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling3.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling4.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling2.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling3.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling4.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
                <li class="position-relative">
                    <a href="">
                        <div class="d-flex justify-content-center"><img src="{{asset('images/shop/selling3.png')}}" alt="" srcset=""></div>
                        <div class="pl-3 mt-3">
                            <p>Siro bổ phế bối mẫu Forte Mom and Baby Tất thành</p>
                            <span class="text-info">115.000đ/Chai</span>
                        </div>                   
                    </a>
                    <div class="unit-top">Chai</div>
                </li>
            </ul>
        </div>
    </div>
    <div id="qadoctor" class="mt-3 pb-5">
        <div class="wp-inner">
            <h1 class="mb-3">Hỏi đáp bác sĩ</h1>
            <div class="row ml-0">
                <div class="position-relative mesqa col-md-6">
                    <div class="row">
                        <div class="col-md-6 px-0">
                            <div class="qcustomer">
                                <p class="q-content">Chào bác sĩ. Tôi năm nay 22 tuổi. Chuyện là gia đình tôi có nuôi một bé mèo và bé mèo này bị bọ chét. Khi tôi lại ghế sofa nằm chỗ con mèo nằm thì một chặp, tôi đứng lên làm việc thì có cảm giác có gì đó xẹt qua tai, nên tôi lo lắng không biết có phải bọ chét nó chui vô tai hay không?Vì cứ lo lắng nên tai</p>
                                <div class="a-doctor d-flex mt-2">
                                    <div class="img-person">
                                        <img src="{{asset('images/shop/person.png')}}" alt="" srcset="">
                                    </div>
                                    <div>
                                        <p>Đã trả lời bởi</p>
                                        <p class="name-doctor mb-2">Bác sĩ Lê Ngọc Vũ</p>
                                        <span class="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            4.8
                                        </span>
                                    </div>                     
                                </div>
                            </div>
                            <div class="qcustomer">
                                <p class="q-content">
                                    <img src="{{asset('images/shop/qa1.png')}}" alt="">   
                                    <span>Hỏi: Tiêm vắc xin Covid về cảm thấy mệt mỏi, đổ mồ hôi, cần làm gì?</span>
                                </p>                  
                                <div class="a-doctor d-flex mt-2">
                                    <div class="img-person">
                                        <img src="{{asset('images/shop/person.png')}}" alt="" srcset="">
                                    </div>
                                    <div>
                                        <p>Đã trả lời bởi</p>
                                        <p class="name-doctor mb-2">Bác sĩ Lê Ngọc Vũ</p>
                                        <span class="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            4.8
                                        </span>
                                    </div>                     
                                </div>
                            </div>     

                        </div>
                        <div class="col-md-6 pr-0">
                            <div class="qcustomer">
                                <p class="q-content">
                                    <img src="{{asset('images/shop/qa1.png')}}" alt="">   
                                    <span>Hỏi: Tiêm vắc xin Covid về cảm thấy mệt mỏi, đổ mồ hôi, cần làm gì?</span>
                                </p>                  
                                <div class="a-doctor d-flex mt-2">
                                    <div class="img-person">
                                        <img src="{{asset('images/shop/person.png')}}" alt="" srcset="">
                                    </div>
                                    <div>
                                        <p>Đã trả lời bởi</p>
                                        <p class="name-doctor mb-2">Bác sĩ Lê Ngọc Vũ</p>
                                        <span class="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            4.8
                                        </span>
                                    </div>                     
                                </div>
                            </div> 
                            <div class="qcustomer">
                                <p class="q-content">Chào bác sĩ. Tôi năm nay 22 tuổi. Chuyện là gia đình tôi có nuôi một bé mèo và bé mèo này bị bọ chét. Khi tôi lại ghế sofa nằm chỗ con mèo nằm thì một chặp, tôi đứng lên làm việc thì có cảm giác có gì đó xẹt qua tai, nên tôi lo lắng không biết có phải bọ chét nó chui vô tai hay không?Vì cứ lo lắng nên tai</p>
                                <div class="a-doctor d-flex mt-2">
                                    <div class="img-person">
                                        <img src="{{asset('images/shop/person.png')}}" alt="" srcset="">
                                    </div>
                                    <div>
                                        <p>Đã trả lời bởi</p>
                                        <p class="name-doctor mb-2">Bác sĩ Lê Ngọc Vũ</p>
                                        <span class="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            <img src="{{asset('images/shop/star.png')}}" alt="">
                                            4.8
                                        </span>
                                    </div>                     
                                </div>
                            </div>                  
                        </div>
                    </div>                   
                    <div class="bg-blur"></div>
                    <div class="d-flex justify-content-start chatq">
                        <a href="" class="setq">
                            <img src="{{asset('images/shop/mess.png')}}" alt="">                         
                            <span>Đặt câu hỏi miễn phí</span> 
                        </a>
                        <a href="" class="listq">Xem tất cả câu hỏi</a>
                    </div>
                </div>
                
                <div class="col-md-6 medical-faculty">
                    <h6>Hơn <span class="lage-font">1000 bác sỹ</span> đang sẵn sàng giúp đỡ bạn</h6>                 
                    <ul class="list-medical-faculty mt-2 clearfix">
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa1.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Nội khoa</p>
                                </a>
                            </li>  
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa2.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Sản phụ khoa</p>
                                </a>
                            </li>
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa3.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Nam khoa</p>
                                </a>
                            </li>  
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa4.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Ngoại khoa</p>
                                </a>
                            </li>  
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa5.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Nội khoa</p>
                                </a>
                            </li> 
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa6.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Tim mạch</p>
                                </a>
                            </li> 
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa7.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Hô hấp</p>
                                </a>
                            </li> 
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa8.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Tiêu hóa</p>
                                </a>
                            </li> 
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa9.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Răng hàm mặt</p>
                                </a>
                            </li> 
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa10.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Tai mũi họng</p>
                                </a>
                            </li> 
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa11.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Mắt</p>
                                </a>
                            </li> 
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa12.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Ung bướu</p>
                                </a>
                            </li> 
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa13.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Da liễu</p>
                                </a>
                            </li> 
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa14.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Dị ứng</p>
                                </a>
                            </li> 
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa15.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Nội tiết</p>
                                </a>
                            </li> 
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa16.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Tiết liệu</p>
                                </a>
                            </li> 
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa17.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Dinh dưỡng</p>
                                </a>
                            </li> 
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa18.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Tâm lý thần kinh</p>
                                </a>
                            </li>
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa19.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Cơ xương khớp</p>
                                </a>
                            </li>  
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa20.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Phục hồi chức năg</p>
                                </a>
                            </li> 
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa21.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Truyền nhiễm</p>
                                </a>
                            </li> 
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa22.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Y học cổ truyền</p>
                                </a>
                            </li> 
                            <li class="position-relative">
                                <a href="">           
                                    <img src="{{asset('images/shop/chuyenkhoa23.png')}}" alt=""> 
                                    <p class="title-medical-faculty">Phẫu thuật thẩm mỹ</p>
                                </a>
                            </li> 
                    </ul>             
                </div>
            </div>
        </div>
    </div>  
    <div class="wp-inner">
        <img src="{{asset('images/shop/baner.png')}}" alt="">
        <div class="newsh mt-5">
            <div class="title-news d-flex">
                <img src="{{asset('images/shop/news1.png')}}" alt="">
                <h1>Tin tức và góc sức khỏe</h1>
            </div>          
            <div class="row ">
                <div class="col-md-6 news-content-right px-0">
                    <img src="{{asset('images/shop/news2.png')}}" alt="">
                    <div class="px-3 py-3">
                        <a>Lupus ban đỏ và thai nghén: Bệnh Lupus Ảnh Hưởng Như Thế Nào Đến Quá Trình Mang Thai?</a>
                        <div class="text-mute d-flex mt-3">
                            <img src="{{asset('images/shop/oclock.png')}}" alt="">
                            <div class="ml-2">1 tuần trước</div>  
                        </div>
                    </div>
                    
                </div>
                <div class="col-md-6 news-content-left">
                    <ul>
                        <li class="d-flex">
                            <img src="{{asset('images/shop/news3.png')}}" alt="">
                            <div class="px-3">
                                <a class="title-new-left">Tiêm Rãnh Cười Có Hại Không? Có Những Phương Pháp Xóa Rãnh Cười</a>
                                <div class="text-mute d-flex">
                                    <img src="{{asset('images/shop/oclock.png')}}" alt="">
                                    <div class="ml-2">1 tuần trước</div>  
                                </div>
                                <div class="news-known d-flex mt-2">
                                    <a href="">Phòng và chữa bệnh</a>
                                    <a href="">Kiến thức y khoa</a>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex">
                            <img src="{{asset('images/shop/news4.png')}}" alt="">
                            <div class="px-3">
                                <a class="title-new-left">Siêu âm đầu dò bị chảy máu có đáng ngại không?</a>
                                <div class="text-mute d-flex">
                                    <img src="{{asset('images/shop/oclock.png')}}" alt="">
                                    <div class="ml-2">1 tuần trước</div>  
                                </div>
                                <div class="news-known d-flex mt-2">
                                    <a href="">Phòng và chữa bệnh</a>
                                    <a href="">Kiến thức y khoa</a>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex">
                            <img src="{{asset('images/shop/news5.png')}}" alt="">
                            <div class="px-3">
                                <a class="title-new-left">Tổng quan về phương pháp tiêm rãnh cười</a>
                                <div class="text-mute d-flex">
                                    <img src="{{asset('images/shop/oclock.png')}}" alt="">
                                    <div class="ml-2">1 tuần trước</div>  
                                </div>
                                <div class="news-known d-flex mt-2">
                                    <a href="">Phòng và chữa bệnh</a>
                                    <a href="">Kiến thức y khoa</a>
                                </div>
                            </div>
                        </li>
                        <li class="d-flex">
                            <img src="{{asset('images/shop/news6.png')}}" alt="">
                            <div class="px-3">
                                <a class="title-new-left">FPL Long Châu thu cũ đổi mới mmieenx phí 10.000 máy đo đường huyết</a>
                                <div class="text-mute d-flex">
                                    <img src="{{asset('images/shop/oclock.png')}}" alt="">
                                    <div class="ml-2">1 tuần trước</div>  
                                </div>
                                <div class="news-known d-flex mt-2">
                                    <a href="">Tin tức sức khỏe</a>
                                    <a href="">Sự kiện</a>
                                </div>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div> 
    <div class="info-tdoctor mt-5">      
        <div class="wp-inner">
            <div class="list-info-tdoctor">
                <ul class="d-flex justify-content-between">
                    <li>
                        <p>200</p><span>Phòng khám</span>
                    </li>
                    <li>
                        <p>1273</p><span>Bác sỹ</span>
                    </li>
                    <li>
                        <p>101</p><span>Nhà thuốc</span>
                    </li>
                    <li>
                        <p>13875</p><span>Bệnh nhân</span>
                    </li>
                    <li>
                        <p>4206</p><span>Câu hỏi</span>
                    </li>
                    <li>
                        <p>3956</p><span>Câu trả lời</span>
                    </li>
                </ul>
            </div>
            
        </div>
        <div class="opacty-back">

        </div>
    </div> 
    <div class="wp-inner mt-5" style="">
        <div class="info-app">
            <h1 class="mb-3">Giới thiệu app Tdoctor</h1>
            <ul class="d-flex justify-content-between">
                <li class="position-relative">
                    <div>
                        <img src="{{asset('images/shop/info-app1.png')}}" alt="">
                        <div class="item-info-app">
                            <h3>Kiểm tra nhịp tim</h3>
                        </div> 
                    </div>                                            
                </li>
                <li class="position-relative">
                    <div>
                        <img src="{{asset('images/shop/info-app2.png')}}" alt="">
                        <div class="item-info-app">
                            <h3>Huyết áp</h3>
                        </div> 
                    </div>                                            
                </li>
                <li class="position-relative">
                    <div>
                        <img src="{{asset('images/shop/info-app3.png')}}" alt="">
                        <div class="item-info-app">
                            <h3>Đường huyết</h3>
                        </div> 
                    </div>                                            
                </li>
                <li class="position-relative">
                    <div>
                        <img src="{{asset('images/shop/info-app4.png')}}" alt="">
                        <div class="item-info-app">
                            <h3>Nhu cầu nước</h3>
                        </div> 
                    </div>                                            
                </li>
            </ul>
        </div>
    </div>
    <div class="service-tdoctor mt-5">
        <div class="wp-inner">
            <ul class="d-flex">
                <li class="d-flex">
                    <img src="{{asset('images/shop/dichvu1.png')}}" alt="">
                    <div class="title-service">
                        <h1>THUỐC CHÍNH HÃNG</h1>
                        <p>Đa dạng và chuyên sâu</p>
                    </div>
                </li>
                <li class="d-flex">
                    <img src="{{asset('images/shop/dichvu2.png')}}" alt="">
                    <div class="title-service">
                        <h1>ĐỔI TRẢ TRONG 30 NGÀY</h1>
                        <p>kể từ ngày mua hàng</p>
                    </div>
                </li>
                <li class="d-flex">
                    <img src="{{asset('images/shop/dichvu3.png')}}" alt="">
                    <div class="title-service">
                        <h1>CAM KẾT 100%</h1>
                        <p>chất lượng sản phẩm</p>
                    </div>
                </li>
                <li class="d-flex">
                    <img src="{{asset('images/shop/dichvu4.png')}}" alt="">
                    <div class="title-service">
                        <h1>MIỄN PHÍ VẬN CHUYỂN</h1>
                        <p>theo chính sách giao hàng</p>
                    </div>
                </li>
            </ul>
        </div>
        
    </div>
    <div class="local">
        <div class="wp-inner d-flex justify-content-between" style="">
            <div class="d-flex">
                <img src="{{asset('images/shop/local.png')}}" alt="">
                <p>xem các nhà thuốc trên toàn quốc</p>
            </div>
            <div class="list-drugstore">
                <a href="">Xem danh sách nhà thuốc</a>
            </div>
        </div>
    </div>
    <div class="wp-inner mt-5" style="">
        <div class="feedback-customer">
            <div class="row">
                <div class="col-md-6">
                    <h1 class="mb-4">Phản hồi từ bệnh nhân</h1>
                    <ul>
                        <li class="d-flex mb-3">
                            <img src="{{asset('images/shop/phanhoi1.png')}}" alt="">
                            <div class="ml-3">
                                <h2>Duy Nguyễn Nhất</h2>
                                <span>
                                    <img src="{{asset('images/shop/star.png')}}" alt="">
                                    <img src="{{asset('images/shop/star.png')}}" alt="">
                                    <img src="{{asset('images/shop/star.png')}}" alt="">
                                    <img src="{{asset('images/shop/star.png')}}" alt="">
                                    <img src="{{asset('images/shop/star.png')}}" alt="">
                                </span>
                                <p>Rất tuyệt vời, đặc biệt trong mùa dịch đi lại khó khăn. Chúc doctor ngày càng phát triển và mở rộng phạm vi ra nhiều tỉnh hơn, nhất là vùng Đồng bằng sông Cửu Long</p>
                            </div>
                        </li>
                        <li class="d-flex mb-3">
                            <img src="{{asset('images/shop/phanhoi2.png')}}" alt="">
                            <div class="ml-3">
                                <h2>Quốc Bình Vũ</h2>
                                <span>
                                    <img src="{{asset('images/shop/star.png')}}" alt="">
                                    <img src="{{asset('images/shop/star.png')}}" alt="">
                                    <img src="{{asset('images/shop/star.png')}}" alt="">
                                    <img src="{{asset('images/shop/star.png')}}" alt="">
                                    <img src="{{asset('images/shop/star.png')}}" alt="">
                                </span>
                                <p>Rất tuyệt vời, đặc biệt trong mùa dịch đi lại khó khăn. Chúc doctor ngày càng phát triển và mở rộng phạm vi ra nhiều tỉnh hơn, nhất là vùng Đồng bằng sông Cửu Long</p>
                            </div>
                        </li>
                        <li class="d-flex">
                            <img src="{{asset('images/shop/phanhoi3.png')}}" alt="">
                            <div class="ml-3">
                                <h2>Nguyễn Ngọc Minh</h2>
                                <span>
                                    <img src="{{asset('images/shop/star.png')}}" alt="">
                                    <img src="{{asset('images/shop/star.png')}}" alt="">
                                    <img src="{{asset('images/shop/star.png')}}" alt="">
                                    <img src="{{asset('images/shop/star.png')}}" alt="">
                                    <img src="{{asset('images/shop/star.png')}}" alt="">
                                </span>
                                <p>Rất tuyệt vời, đặc biệt trong mùa dịch đi lại khó khăn. Chúc doctor ngày càng phát triển và mở rộng phạm vi ra nhiều tỉnh hơn, nhất là vùng Đồng bằng sông Cửu Long</p>
                            </div>
                        </li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <div class="mb-2"><img src="{{asset('images/shop/phanhoi4.png')}}" alt=""></div>
                    <div><img src="{{asset('images/shop/phanhoi5.png')}}" alt=""></div>                   
                </div>
                <div class="col-md-3 dlapp pb-0">
                    <h1>Tải Ứng Dụng T Doctor</h1>
                    <p>Mua thuốc trực tuyến, giao hàng tận nơi dễ dàng & nhanh chóng</p>
                    <div class="mb-2 mt-3"><img src="{{asset('images/shop/app1.png')}}" alt=""></div>
                    <div class="mb-4"><img src="{{asset('images/shop/app2.png')}}" alt=""></div>
                    <div><img src="{{asset('images/shop/app3.png')}}" alt=""></div>
                </div>
            </div>
        </div>  
    </div>   

@endsection

