<!-- <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script> -->
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="{{ asset('/shop/frontend/js/jquery.validate.min.js')}}?t=@php echo time() @endphp" type="text/javascript"></script>
<script src="{{ asset('/shop/frontend/js/main.js')}}?t=@php echo time() @endphp" type="text/javascript"></script>
<script src="{{ asset('/shop/frontend/js/lightslider.js')}}?t=@php echo time() @endphp" type="text/javascript"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
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
                    method: 'POST',
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
                $(this).removeClass('active-menucat2');
            }
        );
        $('.catc1').hover(
            function() {
                $('.black-content').css("display", "block");
                $('.sub-menu1>li:first-child').addClass('active-menucat2');
                $('.sub-menu1>li:first-child .sub-menu2').css("display", "block");
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
                        $('ul.body_catdetail').html(data['list_cat']);
                        $('.list-productmn').html(data['list_product']);
                    },
                });
            },
            function() {
                $('.black-content').css("display", "none");
                $('.sub-menu1>li:first-child .sub-menu2').css("display", "none");
            },
        );
        $('.btn-select-buy').click(function() {
            $('body,html').stop().animate({
                scrollTop: 0
            }, 800);

            function hidden_reloal() {
                $('#dropdown').css("opacity", 1);
                $('#dropdown').css("visibility", "visible");
            }
            setTimeout(hidden_reloal, 1000);

             function reloadpage() {
                 location.reload();
             }
             setInterval(reloadpage, 3000);

            var _token = $('input[name="_token"]').val();
            var number_perp = $('input[name="number_perp"]').val();
            var id_product = $('.seclect-number').attr('data-id');
            $.ajax({
                url: "{{route('fe.cart.addproduct')}}",
                method: 'POST',
                dataType: 'json',
                data: {
                    id_product: id_product,
                    number_perp: number_perp,
                    _token: _token,
                },
                success: function(data) {
                    $('.number_cartmenu').html(data['number_product']);
                    $('#cart-load').html(data['list_product']);
                    $('.notisucess1').html(data['noti_success']);
                    console.log(data['rowId']);
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
    jQuery.validator.addMethod("checkPhoneNumber",
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
    $(document).ready(function() {
        $("#user_login").validate({
            rules: {
                email: {
                    required: true,
                    checkPhoneNumber: true,
                },
                password: {
                    required: true,
                    minlength: 6
                },
            },
            messages: {
                email: {
                    required: "Nhập số điện thoại hoặc email",
                    checkPhoneNumber: "Số điện thoại hoặc email không đúng định dạng",
                },
                password: {
                    required: "Bạn cần nhập mật khẩu",
                    minlength: "Mật khẩu tối thiểu 6 ký tự"
                },
            },
            submitHandler: function(form) {

                var emaip = $('#inputphel').val();
                var password = $('#password').val();
                var _token = $('input[name="_token"]').val();
                //event.preventDefault();
                $.ajax({
                    url: "{{url('/dang-nhap')}}",
                    method: "POST",
                    dataType: 'json',
                    data: {
                        emaip: emaip,
                        password: password,
                        _token: _token,
                    },
                    success: function(data) {
                        if(data['islogin']==1){
                            location.reload();
                        }else{   
                            alert('Thông tin đăng nhập không đúng !');
                        }
                       
                    },
                });
            }
        });
    });
</script>
<script>
    $("#user_register").validate({
        rules: {
            name: "required",
            email: {
                required: true,
                checkPhoneNumber1: true,

            },
            password: {
                required: true,
                minlength: 6
            },
        },
        messages: {
            name: "Bạn chưa nhập tên đăng nhập",
            email: {
                required: "Nhập số điện thoại hoặc email",
                checkPhoneNumber1: "Số điện thoại hoặc email không đúng định dạng",
                remote: "Số điện thoại hoặc mail đã tồn tại"
            },
            password: {
                required: "Bạn cần nhập mật khẩu",
                minlength: "Mật khẩu tối thiểu 6 ký tự"
            },

        },
        submitHandler: function(form) {
            alert('Đăng ký tài khoản thành công');
            $.ajax({
                type: "POST",
                url: "{{url('/dang-ky')}}",
                data: $(form).serializeArray(),
                success: function(response) {}
            });
        }
    });
    // jQuery(document).ready(function($) {
    //     $('.deleteperp').on('click', function(e) {
    //         e.preventDefault();
    //         alert('Xử lý sự kiện click!');
    //     });
    // });
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

    });
</script>

<script src="{{ asset('/shop/frontend/js/owl.carousel.js')}}?t=@php echo time() @endphp" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>