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
jQuery.validator.addMethod("isProductSelect",
    function() {
        var flag = false;
        numProductSelect=$('.ls-product-select-prescrip li').length;
        if(numProductSelect > 0){
            flag = true;
        }
        return flag;
    }
);
$.validator.methods.checkEmail = function (value, element, param) {
    return (value.trim() == '') || (isEmail(value.trim()));
};
$.validator.methods.checkPhone = function (value, element, param) {
    return isPhoneNumberVN(value.trim());
};
$.validator.methods.checkPhoneOrEmail = function (value, element, param) {
    return isEmail(value.trim()) || isPhoneNumberVN(value.trim());
};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    //  Cat hover
    $('.cat1name').hover(
        function() {
            var idCatLevel1 = $(this).attr('data-id');
            var _token = $('input[name="_token"]').val();
            var url=$(this).attr('data-href');
            $.ajax({
                url: url,
                cache: false,
                method: "GET",
                dataType: 'html',
                data: {
                    idCatLevel1: idCatLevel1,
                    _token: _token,
                },
                success: function(data) {
                    $('.list_cat_level3_products').html(data);
                    $('.sub-menu1>li').removeClass('active-menucat2');
                    $('.sub-menu1>li:first-child').addClass('active-menucat2');
                },
            }); 
        },
    );
    $('.sub-menu1>li').hover(
        function() {
            $('.sub-menu1>li').removeClass('active-menucat2');
            $(this).addClass('active-menucat2');
            var idCatLevel2 = $(this).attr('data-id');
            var _token = $('input[name="_token"]').val();
            var url=$(this).attr('data-href');
            $.ajax({
                url: url,
                cache: false,
                method: "GET",
                dataType: 'html',
                data: {
                    idCatLevel2: idCatLevel2,
                    _token: _token,
                },
                success: function(data) {
                    $('.list_cat_level3_products').html(data);
                
                },
            }); 
        },
    );
//end Cat
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
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");
            element.closest(".input-group").addClass('has-error');
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.next("label"));
            } else {
                error.insertAfter(element.closest(".input-group"));
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
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
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");
            element.closest(".input-group").addClass('has-error');
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.next("label"));
            } else {
                error.insertAfter(element.closest(".input-group"));
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
            $(element).closest(".input-group").removeClass('has-error');
        }
    });
    $(".order-complete").validate({
        ignore: ".ignore",
        rules: {
            "buyer[fullname]": {
                required: true,
            },
            "buyer[phone]": {
                required: true,
                checkPhone: true,
            },
            "buyer[email]": {
                checkEmail: true,
            },
            
            "invoice[name]": {
                required: true,
            },
            "invoice[phone]": {
                required: true,
                checkPhone: true,
            },
            "invoice[tax_code]": {
                required: true,
            },
            "invoice[address]": {
                required: true
            },
            warehouse_id: {
                required: true
            },
            "receive[fullname]": {
                required: true
            },
            "receive[phone]": {
                required: true,
                checkPhone: true
            },
            "receive[province_id]": {
                required: true
            },
            "receive[district_id]": {
                required: true
            },
            "receive[ward_id]": {
                required: true
            },
            "receive[address]": {
                required: true
            },
        },
        messages: {
            "buyer[fullname]": {
                required: "Thông tin bắt buộc",
            },
            "buyer[phone]": {
                required: "Thông tin bắt buộc",
                checkPhone: "Số điện thoại không đúng định dạng",
            },
            "buyer[email]": {
                checkEmail: "Email không đúng định dạng",
            },
            "invoice[name]": {
                required: "Thông tin bắt buộc",
            },
            "invoice[phone]": {
                required: "Thông tin bắt buộc",
                checkPhone: "Số điện thoại không đúng định dạng",
            },
            "invoice[tax_code]": {
                required: "Thông tin bắt buộc"
            },
            "invoice[address]": {
                required: "Thông tin bắt buộc"
            },
            warehouse_id: {
                required: "Thông tin bắt buộc"
            },
            "receive[fullname]": {
                required: "Thông tin bắt buộc"
            },
            "receive[phone]": {
                required: "Thông tin bắt buộc",
                checkPhone: "Số điện thoại không đúng định dạng",
            },
            "receive[province_id]": {
                required: "Thông tin bắt buộc"
            },
            "receive[district_id]": {
                required: "Thông tin bắt buộc"
            },
            "receive[ward_id]": {
                required: "Thông tin bắt buộc"
            },
            "receive[address]": {
                required: "Thông tin bắt buộc"
            }
        },
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");
            element.closest(".wp-input").addClass('has-error');                  
            error.insertAfter(element.closest(".wp-input"));          
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
            $(element).closest(".wp-input").removeClass('has-error');
        }
    });
    $(".form-main-prescrip").validate({
        ignore: ".ignore",
        rules: {
            "buyer[fullname]":{
                required: true,
            },
            "buyer[phone]": {
                required: true,
                checkPhone: true,
            },
            number_product:{
                isProductSelect: true,
            },
            province_id:{
                required: true,
            },
            district_id:{
                required: true,
            },
            ward_id:{
                required: true,
            },
            address:{
                required: true,
            },    
        },
        messages: {
            "buyer[fullname]": "Thông tin bắt buộc",
            "buyer[phone]": {
                required: "Thông tin bắt buộc", 
                checkPhone: "Số điện thoại không đúng định dạng",             
            },
            number_product:{
                isProductSelect: "Vui lòng chọn thêm thuốc"
            },
            province_id:{
                required:"Thông tin bắt buộc",
            },
            district_id:{
                required: "Thông tin bắt buộc",
            },
            ward_id:{
                required: "Thông tin bắt buộc",
            },
            address:{
                required: "Thông tin bắt buộc",
            },                             
        },
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");
            element.closest(".wp-input").addClass('has-error');                  
            error.insertAfter(element.closest(".wp-input"));          
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
            $(element).closest(".wp-input").removeClass('has-error');
        }
    });
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
$(document).on('submit', "#main-form", function (event) {
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
        success: function (response) {
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
        error: function (xhr, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
        }
    });
});
$(document).on('click', ".changeTypePassword", function (event) {
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
$(document).on('click', ".cat-content .list-content-product li a", function (event) {
    $('.cat-content .list-content-product li a').removeClass("active-ndsp");
    $(this).addClass("active-ndsp");
});
function visible_cart_respon() {
    $('.dropdown_cart').css("opacity", 1);
    $('.dropdown_cart').css("visibility", "visible");
    $('.black-res-screen').css("display", "block");
    $('.fix1screen').css("display", "block");
    $('.fix1screen').css("height", '100vh');
    $('#site').addClass('fix-1vh');
}
$(document).on('click', '.btn-select-buy', function (event) {
    $('body,html').stop().animate({
        scrollTop: 0
    }, 800);

    var _token = $('input[name="_token"]').val();
    var quantity = $('input[name="qty_product"]').val();
    var product_id = $('#product_id').val();
    var user_sell = $('#user_sell').val();
    url = $(this).data('href');
    $.ajax({
        url: url,
        method: 'POST',
        cache: false,
        dataType: 'html',
        data: {
            product_id: product_id,
            quantity: quantity,
            user_sell: user_sell,
            _token: _token,
        },
        success: function (data) {
            $(".dropdown-cart-info").html(data);
            $(".wp-cart-res").html(data);
            $(".dropdown-cart").css({ 'opacity': 1, 'visibility': 'visible' });
            if ($(window).width() < 1200) {
                visible_cart_respon();
            }
            setTimeout(function () {
                $(".dropdown-cart-info .dropdown-cart").removeAttr('style');
            }, 3000);
        },
    });
});
$(document).on('click', ".close-cart", function (event) {
    $('.dropdown_cart').css("opacity", 0);
    $('.dropdown_cart').css("visibility", "hidden");
    $('.black-res-screen').css("display", "none");
    $('.fix1screen').css("display", "none");
    $('#site').removeClass("fix-1vh");
});
$(document).on('change', "select.get_child", function (event) {
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
            addtion.forEach(function (elem, index) {
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
            success: function (data) {
                options = '';
                if ($(target + " option").length > 0) {
                    options = $(target).find('option')[0].outerHTML;
                }
                $.each(data, function (id, item) {
                    options += "<option value= '" + id + "'>" + item + "</option>";
                });

                $(target).html(options);
                if ($(target).hasClass('get_data')) $(target).trigger("change");
                if ($(target).hasClass('get_child')) $(target).trigger("change");
            },
            error: function (xhr, textStatus, errorThrown) {
                alert("Error: " + errorThrown);
            }
        });
    }
});
$(document).on('change', "select.get_data", function (event) {
    event.preventDefault();
    let selectValue = $(this).val();
    target = $(this).data('target');
    let url = $(this).data('href');

    url = url.replace('value_new', selectValue);

    let addtion = $(this).data('addtion');
    if (addtion !== undefined) {
        addtion = addtion.split('|');
        addtion.forEach(function (elem) {
            elemValue = $('#' + elem).val();
            url += "&filter_" + elem + "=" + elemValue;
        });
    }

    $.get({
        url: url,
        cache: false,
        dataType: 'html',
        success: function (data) {
            $(target).html(data);
        },
        error: function (xhr, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
        }
    });


});
$(document).on('change', "input.number-product", function (event) {
    $value = $(this).val();
    url = $(this).data('href');
    if (url) {
        url = url.replace('value_new', $value);
        $current = $(this);

        $.post({
            url: url,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            cache: false,
            dataType: 'json',
            success: function (data) {
                $parent = $($current).parents('.item-product');
                product_id = $parent.data('id');
                $($parent).find('.price').html(data.product[product_id]['price'].toLocaleString("vi-VN"));
                $($parent).find('.money').html(data.product[product_id]['total_money'].toLocaleString("vi-VN"));

                if (($parent.parents('.dropdown-cart').length > 0) && ($(".info-product-cart").length > 0)) { //Thay đổi trên menu
                    if ($(".info-product-cart").find(".item-product[data-id=" + product_id + "]").length > 0) {
                         $(".info-product-cart").find('.total_product').html(data.total_product);
                         product = $(".info-product-cart").find(".item-product[data-id=" + product_id + "]");
                         $(product).find('.price').html(data.product[product_id]['price'].toLocaleString("vi-VN"));
                         $(product).find('.number-product').val($value);
                         $(product).find('.money').html(data.product[product_id]['total_money'].toLocaleString("vi-VN"));
                    }
                } else {
                    $($parent).parents('table').find('.total_product').html(data.total_product);
                }

                //Cập nhật cho menu giỏ hàng
                $seller = $(".dropdown-cart").find(".user-seller-" + data.user_sell);
                $product = $seller.find('.item-product-' + product_id);
                $old_qty = parseInt($product.find('.number-product').val());
                $product.find('.number-product').val($value);
                $product.find('.money').html(data.product[product_id]['total_money'].toLocaleString("vi-VN"));
                $new_qty = parseInt($value);
                $total_product = parseInt($(".number_cartmenu").html());
                $(".number_cartmenu").html($total_product - $old_qty + $new_qty);
                //tổng thanh toán
                 if (($("input[name=user_sell]").length > 0) && ($("input[name=user_sell]").val() == data.user_sell)) {
                     $(".col-right-cart").find(".total").html(data.total.toLocaleString("vi-VN"));
                     $(".col-right-cart").find(".total_thanh_toan").html(data.total.toLocaleString("vi-VN"));
                 }
            },
            error: function (xhr, textStatus, errorThrown) {
                alert("Error: " + errorThrown);
            }
        })
    };
});
$(document).on('change', "input[name='delivery_method']", function (event) {
    event.preventDefault();
    $value = $(this).val();
    if ($value == 1) {
        $(".rowPharmacy").removeClass('d-none');
        $(".rowHome").addClass('d-none');
        $("input[name='receive[fullname]']").addClass('ignore');
        $("input[name='receive[phone]']").addClass('ignore');
        $("input[name='receive[address]']").addClass('ignore');
        $("select[name='receive[ward_id]']").addClass('ignore');
        $("select[name='receive[district_id]']").addClass('ignore');
    } else {
        $(".rowPharmacy").addClass('d-none');
        $(".rowHome").removeClass('d-none');
        $("input[name='receive[fullname]']").removeClass('ignore');
        $("input[name='receive[phone]']").removeClass('ignore');
        $("input[name='receive[address]']").removeClass('ignore');
        $("select[name='receive[ward_id]']").removeClass('ignore');
        $("select[name='receive[district_id]']").removeClass('ignore');
    }
});
$(document).on('change', "#export_tax", function (event) {
    event.preventDefault();
    $value = $(this).val();
    if ($(this).is(":checked")) {
        $(".rowInovice").removeClass('d-none');
        valueObject = $("input[name='invoice[object]']:checked").val();
        if (valueObject == 1) { //Công ty
            $("input[name='invoice[name]']").attr('placeholder', 'Nhập tên công ty');
            $("input[name='invoice[phone]']").parents('.col-4').addClass('d-none');
            $("input[name='invoice[tax_code]']").removeClass('.ignore');
            $("input[name='invoice[phone]']").addClass('.ignore');
            $("input[name='invoice[tax_code]']").parents('.col-4').removeClass('d-none');
        } else {
            $("input[name='invoice[tax_code]']").addClass('.ignore');
            $("input[name='invoice[phone]']").removeClass('.ignore');
            $("input[name='invoice[name]']").attr('placeholder', 'Nhập Họ tên');
            $("input[name='invoice[tax_code]']").parents('.col-4').addClass('d-none');
            $("input[name='invoice[phone]']").parents('.col-4').removeClass('d-none');
        }
        $("input[name='invoice[name]']").removeClass('.ignore');
        $("input[name='invoice[address]']").removeClass('.ignore');
    } else {
        $("input[name='invoice[name]']").addClass('.ignore');
        $("input[name='invoice[phone]']").addClass('.ignore');
        $("input[name='invoice[tax_code]']").addClass('.ignore');
        $("input[name='invoice[address]']").addClass('.ignore');
        $(".rowInovice").addClass('d-none');
    }
});
$(document).on('change', "input[name='invoice[object]']", function (event) {
    event.preventDefault();
    $value = $(this).val();
    if ($value == 1) { //Công ty
        $("input[name='invoice[name]']").attr('placeholder', 'Nhập tên công ty');
        $("input[name='invoice[phone]']").parents('.col-4').addClass('d-none');
        $("input[name='invoice[tax_code]']").parents('.col-4').removeClass('d-none');
        $("input[name='invoice[tax_code]']").removeClass('.ignore');
        $("input[name='invoice[phone]']").addClass('.ignore');
    } else {
        $("input[name='invoice[name]']").attr('placeholder', 'Nhập Họ tên');
        $("input[name='invoice[tax_code]']").parents('.col-4').addClass('d-none');
        $("input[name='invoice[phone]']").parents('.col-4').removeClass('d-none');
        $("input[name='invoice[tax_code]']").addClass('.ignore');
        $("input[name='invoice[phone]']").removeClass('.ignore');
    }

});
$(document).on('click', ".slect-item-customer", function (event) {
    $('.slect-item-customer').removeClass("active-slect");
    $(this).addClass("active-slect");
    var object_product = $(this).attr("data-object");
    var url = $(this).attr("data-href");
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: url,
        cache: false,
        method: "GET",
        dataType: 'html',
        data: {
            object_product: object_product,
            _token: _token
        },
        success: function (data) {
            $('.list-product-object').html(data);
        },
    });
});
$(document).on('click', ".select-status-order", function (event) {
    var status = $(this).attr("data-status");
    var url = $(this).attr("data-href");
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: url,
        cache: false,
        method: "GET",
        dataType: 'html',
        data: {
            status: status,
            _token: _token
        },
        success: function(data) {
            //console.log(data);
            $('.table-order-frontend').html(data);
        },
    }); 
});
$(document).on('click', ".view-detail-order", function (event) {
    $('.wp-detail-order').css("display", "block");
    $('.black-screen').css("display", "block");
    $('#container').addClass("fixed-hbd");
    var id = $(this).attr("data-id");
    var url = $(this).attr("data-href");
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: url,
        cache: false,
        method: "GET",
        dataType: 'html',
        data: {
            id: id,
            _token: _token,
        },
        success: function(data) {
            //console.log(data['test']['fullname']);
            $('.wp-detail-order').html(data);
        },
    }); 
});
$(document).on('click', ".btn-closenk", function (event) {
    $('.wp-detail-order').css("display", "none");
    $('.black-screen').css("display", "none");
    $('.titlek').removeClass("fixed-hbd");
   
});
$(document).on('click', "#btn-searchorder", function (event) {
    if($('.ls-product-select li').length > 0){
        listProduct=$('.ls-product-select').html();
        $('.ls-product-select-prescrip').html(listProduct);
        $('.ls-product-select-prescrip').css("display", "block");
        $('.form-search-product').css("display", "none");
        $('.black-screen').css("display", "none");
        $('#container').removeClass("fixed-hbd");
        $('#fixscreen-respon').css("display", "none");
        $('.title-list-select').text("Tên thuốc đã nhập:");
        user_sell=$('#name-store').val();
        $('input[name="user_sell"]').val(user_sell);
    }
});
$(document).on('click', '.plus', function () {
    qty = parseInt($(this).parents('.input-group').find('.number-product').val()) + 1;
    $(this).parents('.input-group').find('.number-product').val(qty);
    $(this).parents('.input-group').find('.number-product').change();
});
$(document).on('click', '.minus', function () {
    qty = parseInt($(this).parents('.input-group').find('.number-product').val()) - 1;
    $(this).parents('.input-group').find('.number-product').val(qty);
    $(this).parents('.input-group').find('.number-product').change();
});
$(document).on('click', '.delele-item-in-cart', function () {

    url = $(this).data('href');
    $.get({
        url: url,
        cache: false,
        dataType: 'json',
        success: function (data) {
            window.location.reload();
        },
        error: function (xhr, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
        }
    });
});
$(document).on('keyup', ".search-product-keyup", function (event) {
    var keyword = $(this).val();
    if(keyword=='' || keyword[0]==' '){
        $('.ls-product-search').html("<div class='mb-3 rimg-center'><img src='images/shop/pescrip5.png'></div>");
    }else{
        var url = $(this).attr("data-href");
        var _token = $('input[name="_token"]').val();
        var user_sell = $('#name-store').val();
        $.ajax({
            url: url,
            cache: false,
            method: "GET",
            dataType: 'html',
            data: {
                keyword: keyword,
                user_sell: user_sell,
                _token: _token
             },
            success: function(data) {
                $('.ls-product-search').html(data);
            },
            }); 
    }      
});
$(document).on('click', ".btn-add-item", function (event) {
    $('.ls-product-select').css("display", "block");
    var id = $(this).attr("data-id");
    rowCurrent = $(this).closest('.item-search');
    rowCurrent.remove();
    temp=$('.ls-product-select li').length+1;     
    nameProduct=rowCurrent.find('.name-product').text();
    $('.title-list-select').text("Tên thuốc đã nhập: ");
    itemSelect="<li class='item-select'><div class='d-flex'><div class='wp-10 text-center number_select'>"+temp+"</div><div class='wp-70 text-left'>"+nameProduct+"</div><div class='wp-20  text-center'><div class='btn'><input type='hidden'  name='info_product["+id+"]' value='"+nameProduct+"'><span class='btn-remove'>Xóa</span></div></div></div></li>";
    $('.ls-product-select').append(itemSelect); 
});
$('.addy-product').click(function() {
    const position = $("#form-search-product").offset().top;
    $("HTML, BODY").animate({ scrollTop: position }, 200);
    $('.form-search-product').css("display", "block");
    $('.black-screen').css("display", "block");
    $('#container').addClass("fixed-hbd");
});
$(document).on('click', ".ls-product-select .btn-remove", function (event) {
    if($('.ls-product-select li').length ==1){
        $('.title-list-select').text("");
        $('.ls-product-select').css("display", "none");
    }
    numLast=$('.ls-product-select li').length;
    rowCurrent = $(this).closest('.item-select');
    rowCurrent.remove();
    indexCurent=rowCurrent.find('.number_select').text();
    listItemSelect=document.querySelectorAll('.ls-product-select li.item-select');
    for(let i=0; i< listItemSelect.length; i++) { 
        listItemSelect[i].querySelector('.number_select').innerText=i+1;    
    }
});
$(document).on('click', ".ls-product-select-prescrip .btn-remove", function (event) {
    if($('.ls-product-select-prescrip li').length ==1){
        $('.title-list-select').text("");
        $('.ls-product-select-prescrip').css("display", "none");
    }
    numLast=$('.ls-product-select-prescrip li').length;
    rowCurrent = $(this).closest('.item-select');
    rowCurrent.remove();
    indexCurent=rowCurrent.find('.number_select').text();
    listItemSelect=document.querySelectorAll('.ls-product-select-prescrip li.item-select');
    
    for(let i=0; i< listItemSelect.length; i++) { 
        listItemSelect[i].querySelector('.number_select').innerText=i+1;    
    }
});
$(document).on('click', "#pills-no-prescrip", function (event) {
    $('.form-buy .title-list-select').text("");
    $('.ls-product-select-prescrip').html(' ');
    $('.ls-product-select-prescrip').css("display", "none");
    $('.number_product').addClass("ignore");
    $('input[name="is_prescrip"]').val('');
});
$(document).on('click', "#pills-yes-prescrip", function (event) {
    numLast=$('.ls-product-select-prescrip li').length;
    $('.number_product').removeClass("ignore");
});
$(document).on('change', "#name-store", function (event) {
    $('.wp-content-shorder .title-list-select').text("");
    $('.ls-product-select').html(' ');
    $('.ls-product-select').css("display", "none");
});
$(document).on('keyup', ".input-search-info", function (event) {
    var keyword = $(this).val();
    if(keyword=='' || keyword[0]==' '){
        $('.btn-search-home').attr("disabled","disabled");
    }else{
        $('.btn-search-home').removeAttr("disabled");
    }      
});
$(document).on('click', ".wp-input-search input", function (event) {
    $('.lc-mask-search').css("opacity", 1);
    $('.lc-mask-search').css("visibility", "visible"); 
    $('.ls-history').css("display", "block");
    const position = $("#form-search").offset().top;
    $("HTML, BODY").animate({ scrollTop: position }, 500);
});
$(document).on('click', ".ipsp", function (event) {
    $('#box-search-fixed').css("display", "block");
});
$(document).on('click', ".icon-back-search", function (event) {
    $('#box-search-fixed').css("display", "none");
    $('.lc-mask-search').css("opacity", 0);
    $('.lc-mask-search').css("visibility", "hidden");
});
$(document).on('click', ".lc-mask-search", function (event) {
    $('.lc-mask-search').css("opacity", 0);
    $('.lc-mask-search').css("visibility", "hidden"); 
    $('.ls-history').css("display", "none");
});
$(document).on('click', ".delete-history-keyword", function (event) {
    var url = $(this).attr("data-href");
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: url,
        cache: false,
        method: "GET",
        dataType: 'html',
        data: {
            _token: _token
        },
        success: function(data) {
            $('.data-history').html(data);
        },
    }); 
});
