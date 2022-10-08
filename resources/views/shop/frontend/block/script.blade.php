<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script> -->
<script src="{{ asset('/shop/frontend/js/jquery-3.1.1.js')}}"></script>
<script src="{{ asset('/shop/frontend/js/jquery.validate.min.js')}}" type="text/javascript"></script>
<script src="{{ asset('/shop/frontend/js/additional-methods.min.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>

<script src="{{ asset('/shop/frontend/js/lightslider.js')}}?t=@php echo time() @endphp" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script src="{{ asset('/shop/frontend/js/main.js')}}?t=@php echo time() @endphp" type="text/javascript"></script>
<script>
    $(document).ready(function() {
        $('.sub-menu1>li').hover(
            function() {
                $('.sub-menu1>li').removeClass('active-menucat2');
                $(this).addClass('active-menucat2');
                var id_cat2 = $(this).attr('data-id');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('ajaxcat3')}}",
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        id_cat2: id_cat2,
                        _token: _token,
                    },
                    success: function(data) {
                        $('ul.body_catdetail').html(data['list_cat']);
                        $('.list-productmn').html(data['list_product']);
                        //console.log(data['id_cat2']);
                    },
                });

            },
            function() {
                //$(this).removeClass('active-menucat2');
            }
        );
        $('.cat1name').hover(
            function() {
                var id_cat1 = $(this).attr('data-id');
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url: "{{route('ajaxcat1')}}",
                    method: 'GET',
                    dataType: 'json',
                    data: {
                        id_cat1: id_cat1,
                        _token: _token
                    },
                    success: function(data) {
                        //console.log(data.test);
                        $('ul.body_catdetail').html(data['list_cat']);
                        $('.list-productmn').html(data['list_product']);
                        $('.sub-menu1>li').removeClass('active-menucat2');
                        $('.sub-menu1>li:first-child').addClass('active-menucat2');
                    },
                });

            },
            function() {
                //$('.content-submenu').css("display", "none");
                //$('.black-content').css("display", "none");
                $('.sub-menu1>li:first-child .sub-menu2').css("display", "none");
            },
        );

        function reloadpage() {
            location.reload();
        }

        function visible_cart() {
            $('#dropdown').css("opacity", 1);
            $('#dropdown').css("visibility", "visible");
        }
        var height_screen = $(window).height();
        function visible_cart_respon() {
            $('.dropdown_cart').css("opacity", 1);
            $('.dropdown_cart').css("visibility", "visible");
            $('.black-res-screen').css("display", "block");
            $('.fix1screen').css("display", "block");
            $('.fix1screen').css("height", height_screen);
            $('#site').addClass('fix-1vh');
        }

        function hidden_cart() {
            $('#dropdown').css("opacity", 0);
            $('#dropdown').css("visibility", "hidden");
        }
        $('.btn-select-buy').click(function() {
            $('body,html').stop().animate({
                scrollTop: 0
            }, 800);
            var with_screen = $(window).width();
            //alert(with_screen);
            if (with_screen < 1200) {
                setTimeout(visible_cart_respon, 100);
            } else {
                // $('#dropdown').css("opacity", 1);
                // $('#dropdown').css("visibility", "visible");
                setTimeout(visible_cart, 1000);
                setInterval(reloadpage, 3000);
            }
            var _token = $('input[name="_token"]').val();
            var number_perp = $('input[name="number_perp"]').val();
            var id_product = $('.seclect-number').attr('data-id');
            $.ajax({
                url: "{{route('fe.cart.addproduct')}}",
                method: 'POST',
                cache: false,
                dataType: 'json',
                data: {
                    id_product: id_product,
                    number_perp: number_perp,
                    _token: _token,
                },
                success: function(data) {
                    $('.number_cartmenu').html(data['number_product']);
                    $('#cart-load').html(data['list_product']);
                    $('.dropdown_cart').html(data['list_product_res']);
                    $('.notisucess1').html(data['noti_success']);
                    //console.log(data['rowId']);
                },
            });
        });
        $('.number-ajax').change(function() {
            var qty = $(this).val();
            var id = $(this).attr("data-id");
            var rowId = $(this).attr("data-rowId");
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('fe.cart.changenp')}}",
                method: "POST",
                dataType: 'json',
                data: {
                    qty: qty,
                    id: id,
                    rowId: rowId,
                    _token: _token
                },
                success: function(data) {
                    $(".price-new" + id).text(data['sub_total']);
                    $(".numberperp" + rowId).val(data['number_product']);
                    $(".num-order" + rowId).val(data['number_product']);
                    $(".totalt").text(data['total']);
                    $(".totaltg").text(data['totalkm']);
                },
            });
        });
        $('.minus2').on('click', function() {
            var qty = $(this).next('.number-ajax').val();
            var id = $(this).next('.number-ajax').attr("data-id");
            var rowId = $(this).next('.number-ajax').attr("data-rowId");
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('fe.cart.changenp')}}",
                method: "POST",
                dataType: 'json',
                data: {
                    qty: qty,
                    id: id,
                    rowId: rowId,
                    _token: _token
                },
                success: function(data) {
                    $(".price-new" + id).text(data['sub_total']);
                    $(".numberperp" + rowId).val(data['number_product']);
                    $(".num-order" + rowId).val(data['number_product']);
                    $(".totalt").text(data['total']);
                    $(".totaltg").text(data['totalkm']);
                },
            });
        });
        $('.plus2').on('click', function() {
            var qty = $(this).prev('.number-ajax').val();
            var id = $(this).prev('.number-ajax').attr("data-id");
            var rowId = $(this).prev('.number-ajax').attr("data-rowId");
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{route('fe.cart.changenp')}}",
                method: "POST",
                dataType: 'json',
                data: {
                    qty: qty,
                    id: id,
                    rowId: rowId,
                    _token: _token
                },
                success: function(data) {
                    $(".price-new" + id).text(data['sub_total']);
                    $(".numberperp" + rowId).val(data['number_product']);
                    $(".num-order" + rowId).val(data['number_product']);
                    $(".totalt").text(data['total']);
                    $(".totaltg").text(data['totalkm']);
                },
            });
        });

    });
</script>

<script>
    jQuery.validator.addMethod("checkPhoneNumber2",
        function() {
            var flag = false;
            var phone = $('#inputphel').val().trim();
            phone = phone.replace('(+84)', '0');
            phone = phone.replace('+84', '0');
            phone = phone.replace('0084', '0');
            phone = phone.replace(/ /g, '');

            function isEmail(email) {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(email);
            }
            if (isEmail(phone)) {
                flag = true;
            }
            if (phone != '') {
                var firstNumber = phone.substring(0, 2);
                if ((firstNumber == '09' || firstNumber == '08') && phone.length == 10) {
                    if (phone.match(/^\d{10}/)) {
                        flag = true;
                    }
                } else if (firstNumber == '01' && phone.length == 11) {
                    if (phone.match(/^\d{11}/)) {
                        flag = true;
                    }
                }
            }
            return flag;
        }
    );
    jQuery.validator.addMethod("checkPhoneNumber1",
        function() {
            var flag = false;
            var phone = $('#inputphel1').val().trim();
            phone = phone.replace('(+84)', '0');
            phone = phone.replace('+84', '0');
            phone = phone.replace('0084', '0');
            phone = phone.replace(/ /g, '');

            function isEmail(email) {
                var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                return regex.test(email);
            }
            if (isEmail(phone)) {
                $('#isnumber').val('0');
                flag = true;
            }
            if (phone != '') {
                var firstNumber = phone.substring(0, 2);
                if ((firstNumber == '09' || firstNumber == '08') && phone.length == 10) {
                    if (phone.match(/^\d{10}/)) {
                        flag = true;
                        $('#isnumber').val('1');

                    }
                } else if (firstNumber == '01' && phone.length == 11) {
                    if (phone.match(/^\d{11}/)) {
                        flag = true;
                        $('#isnumber').val('1');
                    }
                }
            }
            return flag;
        }
    );
</script>

<script>
    $(document).ready(function() {
        $("#order-complete").validate({
            rules: {
                name: {
                    required: true,
                },
                phone: {
                    required: true,
                    checkPhone: true,
                },
                email: {
                    checkmail1: true,
                },
                namecompany: {
                    checknamecompany: true,
                },
                taxcode: {
                    checktaxcode: true,
                },
                addresscompany: {
                    checkaddresscompany: true,
                },
                name1: {
                    checkname1: true,
                },
                phone1: {
                    checkphone1: true,
                    checkPhone: true,
                },
                address1: {
                    checkaddress1: true,
                },
                name2: {
                    checkname2: true
                },
                phone2: {
                    checkphone2: true,
                    checkPhone2: true,
                },
                city2: {
                    checkcity2: true
                },
                district2: {
                    checkdistrict2: true
                },
                wards2: {
                    checkwards2: true
                },
                addressdetail2: {
                    checkaddressdetail2: true
                },
                city3: {
                    checkcity3: true
                },
                district3: {
                    checkdistrict3: true
                },
                dcshop: {
                    checkdcshop: true
                }
            },
            messages: {
                name: {
                    required: "Thông tin bắt buộc",
                },
                phone: {
                    required: "Thông tin bắt buộc",
                    checkPhone: "Số điện thoại không đúng định dạng",
                },
                email: {
                    checkmail1: "Email không hợp lệ",
                },
                namecompany: {
                    checknamecompany: "Thông tin bắt buộc",
                },
                taxcode: {
                    checktaxcode: "Thông tin bắt buộc",
                },
                addresscompany: {
                    checkaddresscompany: "Thông tin bắt buộc",
                },
                name1: {
                    checkname1: "Thông tin bắt buộc",
                },
                phone1: {
                    checkphone1: "Thông tin bắt buộc",
                    checkPhone: "Số điện thoại không đúng định dạng",
                },
                address1: {
                    checkaddress1: "Thông tin bắt buộc"
                },
                name2: {
                    checkname2: "Thông tin bắt buộc"
                },
                phone2: {
                    checkphone2: "Thông tin bắt buộc",
                    checkPhone2: "Số điện thoại không đúng định dạng",
                },
                city2: {
                    checkcity2: "Thông tin bắt buộc"
                },
                district2: {
                    checkdistrict2: "Thông tin bắt buộc"
                },
                wards2: {
                    checkwards2: "Thông tin bắt buộc"
                },
                addressdetail2: {
                    checkaddressdetail2: "Vui lòng nhập địa chỉ"
                },
                city3: {
                    checkcity3: "Thông tin bắt buộc"
                },
                district3: {
                    checkdistrict3: "Thông tin bắt buộc"
                },
                dcshop: {
                    checkdcshop: "Bạn chưa chọn cửa hàng"
                }
            },

            //submitHandler: function(form) {
            // var  _token = $('input[name="_token"]').val();
            // var gender = $('input[type="radio"][name="gender"]:checked').val();
            // var name = $('.name').val();
            // var phone = $('.phone').val();
            // var email = $('.email').val();
            // var req_export = $('input[type="checkbox"][name="req_export"]:checked').val();
            // if(req_export == undefined){
            //     var req_export='';
            // }
            // var local_re = $('input[type="radio"][name="local-re"]:checked').val();
            // var name2 = $('.name2').val();
            // var phone2 = $('.phone2').val();city2
            // var city2 = $('.city2').find(":selected").val();
            // var district2 = $('.district2').find(":selected").val();
            // var wards2 = $('.wards2').find(":selected").val();
            // var addressdetail2 = $('.addressdetail2').val();
            //alert(addressdetail2);
            // $.ajax({
            //     url: "{{route('fe.order.completed')}}",
            //     method: "POST",
            //     dataType: 'json',
            //     data: $(form).serializeArray(),
            //     success: function(data) {
            //         console.log(data['test']);
            //     }
            // });
            //}
        });
    });
</script>
<script>
    $(document).ready(function() {
        $("#content-slider").lightSlider({
            loop: true,
            keyPress: true
        });
        $('#image-gallery').lightSlider({
            gallery: true,
            item: 1,
            thumbItem: 9,
            slideMargin: 0,
            speed: 500,
            auto: true,
            loop: true,
            onSliderLoad: function() {
                $('#image-gallery').removeClass('cS-hidden');
            }
        });
        $('.choose').change(function() {
            var action = $(this).attr('id');
            var maid = $(this).val();
            var _token = $('input[name="_token"]').val();
            var district2 = $('#select2-district2-container').attr('title');
            var wards2= $('#select2-wards2-container').attr('title');
             if(district2 === "--Chọn quận huyện--"){
                 $("#district2-error").css("display", "none");
             }
            if(wards2 != "--Chọn xã phường--"){
                $("#wards2-error").css("display", "none");
            }
            var result = '';
            if (action == 'city') {
                result = 'district2';
            } else {
                result = 'wards2';
            }
            if (action == 'city2') {
                result = 'district3';
            } 
            $.ajax({
                url: "{{route('locationAjax')}}",
                method: "POST",
                dataType: 'html',
                data: {
                    action: action,
                    maid: maid,
                    _token: _token
                },
                success: function(data) {
                    $('#' + result).html(data);
                },
            });
        });
    });
</script>

<script src="{{ asset('/shop/frontend/js/owl.carousel.js')}}?t=@php echo time() @endphp" type="text/javascript"></script>


<script src="{{ asset('/shop/frontend/js/my-js.js')}}?t=@php echo time() @endphp" type="text/javascript"></script>