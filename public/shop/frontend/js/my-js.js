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
$(document).on('click', ".cat-content .list-content-product li a", function(event) {
    $('.cat-content .list-content-product li a').removeClass("active-ndsp");
    $(this).addClass("active-ndsp");
});
// $(document).on('click', ".btn-select-buy", function (event) {
//     alert('ok');
// });
$(document).on('click', ".close-cart", function(event) {
    $('.dropdown_cart').css("opacity", 0);
    $('.dropdown_cart').css("visibility", "hidden");
    $('.black-res-screen').css("display", "none");
    $('.fix1screen').css("display", "none");
    $('#site').removeClass("fix-1vh");
    location.reload();
});
$(document).on('change', "select.get_child", function(event) {
    event.preventDefault();
    url = $(this).data('href');

    target = $(this).data('target');
    $selectValue = $(this).val();

    if (($selectValue == '') && (url != '') && (url.indexOf('value_new') !== -1)) {
        options = $(target).find('option')[0].outerHTML;
        $(target).html(options);
        $(target).trigger("change");
    } else {
        url = url.replace('value_new', $selectValue);
        let addtion = $(this).data('addtion');
        if (addtion !== undefined) {
            addtion = addtion.split('|');
            addtion.forEach(function(elem, index) {
                elemValue = $('#' + elem).val();
                if (elemValue != '') {
                    if (url.indexOf('?') === -1) {
                        url += "?filter_" + elem + "=" + elemValue;
                    } else {
                        url += "&filter_" + elem + "=" + elemValue;
                    }
                }
            });
        }
        $.get({
            url: url,
            cache: false,
            dataType: 'json',
            success: function(data) {
                options = '';
                if ($(target + " option").length > 0) {
                    options = $(target).find('option')[0].outerHTML;
                }
                $.each(data, function(id, item) {
                    options += "<option value= '" + id + "'>" + item + "</option>";
                });

                $(target).html(options);
                if ($(target).hasClass('get_data')) $(target).trigger("change");
                if ($(target).hasClass('get_child')) $(target).trigger("change");
            },
            error: function(xhr, textStatus, errorThrown) {
                alert("Error: " + errorThrown);
            }
        });
    }
});
$(document).on('change', "select.get_data", function(event) {
    event.preventDefault();
    let selectValue = $(this).val();
    target = $(this).data('target');
    let url = $(this).data('href');

    url = url.replace('value_new', selectValue);

    let addtion = $(this).data('addtion');
    if (addtion !== undefined) {
        addtion = addtion.split('|');
        addtion.forEach(function(elem) {
            elemValue = $('#' + elem).val();
            url += "&filter_" + elem + "=" + elemValue;
        });
    }

    $.get({
        url: url,
        cache: false,
        dataType: 'html',
        success: function(data) {
            console.log(data);
            $(target).html(data);
        },
        error: function(xhr, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
        }
    });


});
$(document).on('change', "input.number-product", function(event) {
    $value = $(this).val();
    url = $(this).data('href');
    url = url.replace('value_new', $value);
    $parent = $(this).parents('.item-product');
    $.post({
        url: url,
        cache: false,
        dataType: 'json',
        success: function(data) {
            product_id = $parent.data('id');
            $($parent).find('.price').html(data.product[product_id]['price'].toLocaleString("vi-VN"));
            $($parent).find('.money').html(data.product[product_id]['total_money'].toLocaleString("vi-VN"));
            $($parent).parents('table').find('.total_product').html(data.total_product);
        },
        error: function(xhr, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
        }
    });
});
$(document).on('change', "input[name='delivery_method']", function(event) {
    event.preventDefault();
    $value = $(this).val();
    if ($value == 1) {
        $(".rowPharmacy").removeClass('d-none');
        $(".rowHome").addClass('d-none');
    } else {
        $(".rowPharmacy").addClass('d-none');
        $(".rowHome").removeClass('d-none');
    }
});
$(document).on('change', "#export_tax", function(event) {
    event.preventDefault();
    $value = $(this).val();
    if ($value == 1) {
        $(".rowInovice").removeClass('d-none');
        valueObject = $("input[name='invoice[object]']:checked").val();
        if (valueObject == 1) { //Công ty
            $("input[name='invoice[name]']").attr('placeholder', 'Nhập tên công ty');
            $("input[name='invoice[phone]']").parents('.col-4').addClass('d-none');
            $("input[name='invoice[tax_code]']").parents('.col-4').removeClass('d-none');
        } else {
            $("input[name='invoice[name]']").attr('placeholder', 'Nhập Họ tên');
            $("input[name='invoice[tax_code]']").parents('.col-4').addClass('d-none');
            $("input[name='invoice[phone]']").parents('.col-4').removeClass('d-none');
        }
    } else {
        $(".rowInovice").addClass('d-none');
    }
});
$(document).on('change', "input[name='invoice[object]']", function(event) {
    event.preventDefault();
    $value = $(this).val();
    if ($value == 1) { //Công ty
        $("input[name='invoice[name]']").attr('placeholder', 'Nhập tên công ty');
        $("input[name='invoice[phone]']").parents('.col-4').addClass('d-none');
        $("input[name='invoice[tax_code]']").parents('.col-4').removeClass('d-none');
    } else {
        $("input[name='invoice[name]']").attr('placeholder', 'Nhập Họ tên');
        $("input[name='invoice[tax_code]']").parents('.col-4').addClass('d-none');
        $("input[name='invoice[phone]']").parents('.col-4').removeClass('d-none');
    }

});
// $('.minus2').on('click', function() {
//     var qty = $(this).next('.number-ajax').val();
//     var id = $(this).next('.number-ajax').attr("data-id");
//     var rowId = $(this).next('.number-ajax').attr("data-rowId");
//     var _token = $('input[name="_token"]').val();
//     $.ajax({
//         url: "{{route('fe.cart.changenp')}}",
//         method: "POST",
//         dataType: 'json',
//         data: {
//             qty: qty,
//             id: id,
//             rowId: rowId,
//             _token: _token
//         },
//         success: function(data) {
//             $(".price-new" + id).text(data['sub_total']);
//             $(".numberperp" + rowId).val(data['number_product']);
//             $(".num-order" + rowId).val(data['number_product']);
//             $(".totalt").text(data['total']);
//             $(".totaltg").text(data['totalkm']);
//         },
//     });
// });
// $('.plus2').on('click', function() {
//     var qty = $(this).prev('.number-ajax').val();
//     var id = $(this).prev('.number-ajax').attr("data-id");
//     var rowId = $(this).prev('.number-ajax').attr("data-rowId");
//     var _token = $('input[name="_token"]').val();
//     $.ajax({
//         url: "{{route('fe.cart.changenp')}}",
//         method: "POST",
//         dataType: 'json',
//         data: {
//             qty: qty,
//             id: id,
//             rowId: rowId,
//             _token: _token
//         },
//         success: function(data) {
//             $(".price-new" + id).text(data['sub_total']);
//             $(".numberperp" + rowId).val(data['number_product']);
//             $(".num-order" + rowId).val(data['number_product']);
//             $(".totalt").text(data['total']);
//             $(".totaltg").text(data['totalkm']);
//         },
//     });
// });