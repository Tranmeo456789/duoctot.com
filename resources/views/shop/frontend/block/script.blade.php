<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"></script>
<script src="{{ asset('/shop/frontend/js/main.js')}}?t=@php echo time() @endphp" type="text/javascript"></script>

<script src="{{ asset('/shop/frontend/js/jquery.validate.min.js')}}?t=@php echo time() @endphp" type="text/javascript"></script>
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
            if (isEmail(phone)){
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
            if (isEmail(phone)){
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
            $.ajax({
                type: "POST",
                url: "{{url('/dang-nhap')}}",
                data: $(form).serializeArray(),
                success: function(response) {}
            });
        }
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
                success: function(response) {
                }
            });
        }
    });
</script>

<script src="{{ asset('/shop/frontend/js/owl.carousel.js')}}?t=@php echo time() @endphp" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.min.js"></script>