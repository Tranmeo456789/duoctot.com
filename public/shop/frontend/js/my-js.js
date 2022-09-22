function isEmail(value) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(value);
}

function isPhoneNumberVN(value) {
    var flag = false;
    var phone = value.trim(); // ID của trường Số điện thoại
    phone = phone.replace('(+84)', '0');
    phone = phone.replace('+84', '0');
    phone = phone.replace('0084', '0');
    phone = phone.replace(/ /g, '');
    if (phone != '') {
        var firstNumber = phone.substring(0, 2);
        if ((firstNumber == '09' || firstNumber == '08' || firstNumber == '07' || firstNumber == '05' || firstNumber == '03') && phone.length == 10) {
            if (phone.match(/^\d{10}/)) {
                flag = true;
            }
        } else if (firstNumber == '02' && phone.length == 11) {
            if (phone.match(/^\d{11}/)) {
                flag = true;
            }
        }
    }
    return flag;
}
$.validator.methods.checkPhoneOrEmail = function(value, element, param) {
    return isEmail(value.trim()) || isPhoneNumberVN(value.trim());
};
$(document).ready(function() {
    $(".select2").select2();
    $(".user-register").validate({
        rules: {
            fullname: "required",
            email: {
                required: true,
                checkPhoneOrEmail: true,
            },
            password: {
                required: true,
                minlength: 6
            },
        },
        messages: {
            fullname: "Bạn chưa nhập Họ tên",
            email: {
                required: "Nhập số điện thoại hoặc email",
                checkPhoneOrEmail: "Số điện thoại / Email không đúng định dạng"
            },
            password: {
                required: "Bạn cần nhập mật khẩu",
                minlength: "Mật khẩu tối thiểu 6 ký tự"
            },
        },
        errorPlacement: function(error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");
            element.closest(".input-group").addClass('has-error');
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.next("label"));
            } else {
                error.insertAfter(element.closest(".input-group"));
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
            $(element).closest(".input-group").removeClass('has-error');
        }
    });
    $(".user-login").validate({
        rules: {
            email: {
                required: true,
                checkPhoneOrEmail: true,
            },
            password: {
                required: true,
                minlength: 6
            },
        },
        messages: {
            email: {
                required: "Nhập số điện thoại hoặc email",
                checkPhoneOrEmail: "Số điện thoại / Email không đúng định dạng"
            },
            password: {
                required: "Bạn cần nhập mật khẩu",
                minlength: "Mật khẩu tối thiểu 6 ký tự"
            },
        },
        errorPlacement: function(error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");
            element.closest(".input-group").addClass('has-error');
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.next("label"));
            } else {
                error.insertAfter(element.closest(".input-group"));
            }
        },
        highlight: function(element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
            $(element).closest(".input-group").removeClass('has-error');
        }
    });
});
$(document).on('submit', "#main-form", function(event) {
    event.preventDefault();
    url = $(this).attr("action");
    method = $(this).attr('method');
    data = new FormData($(this)[0]);
    $.ajax({
        type: method,
        url: url,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
            if (response.success == false) {
                if (response.error != null) {
                    for (control in response.errors) {
                        eleError = "<label id='" + control + "-error' class='error invalid-feedback' for='" + control + "' style='display:inline-block'>" + response.errors[control] + "</label>";
                        $('[name=' + control + ']').closest(".form-group").find("label[for='" + control + "']").remove();
                        $('[name=' + control + ']').closest(".input-group").addClass('has-error').after(eleError);
                        $('[name=' + control + ']').addClass("is-invalid").removeClass('is-valid');
                    }
                } else {
                    alert(response.message);
                }
            } else {
                alert(response.message);
                window.location.replace(response.redirect_url);
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
        }
    });
});
$(document).on('click', ".changeTypePassword", function(event) {
    parent = $(this).parents('.form-group');
    parent.toggleClass('open');
    if (parent.hasClass('open')) {
        parent.find("input[name='password']").attr('type', 'text');
        $(this).html("<i class='fa fa-eye-slash'></i>");
    } else {
        parent.find("input[name='password']").attr('type', 'password');
        $(this).html("<i class='fa fa-eye'></i>");
    }
});