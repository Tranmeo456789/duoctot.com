//slider
$(document).ready(function() {

    var feature_productcovid = $('#feature-product-wp.product_sellhome .list-item');
    feature_productcovid.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 6, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });
    var feature_productcovid = $('#product-relate #feature-product-wp .list-item');
    feature_productcovid.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 5, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });
    var feature_product = $('#feature-product-wp .list-item');
    feature_product.owlCarousel({
        autoPlay: true,
        navigation: true,
        navigationText: false,
        paginationNumbers: false,
        pagination: false,
        stopOnHover: true,
        items: 4, //10 items above 1000px browser width
        itemsDesktop: [1000, 4], //5 items between 1000px and 901px
        itemsDesktopSmall: [800, 3], // betweem 900px and 601px
        itemsTablet: [600, 2], //2 items between 600 and 0
        itemsMobile: [375, 1] // itemsMobile disabled - inherit from itemsTablet option
    });
    var slider = $('#slider-wp .section-detail');
    slider.owlCarousel({
        autoPlay: 4500,
        navigation: false,
        navigationText: false,
        paginationNumbers: false,
        pagination: true,
        items: 1, //10 items above 1000px browser width
        itemsDesktop: [1000, 1], //5 items between 1000px and 901px
        itemsDesktopSmall: [900, 1], // betweem 900px and 601px
        itemsTablet: [600, 1], //2 items between 600 and 0
        itemsMobile: true // itemsMobile disabled - inherit from itemsTablet option
    });
    $('.js-select2').select2();
    //box  or list product
    $('.ol1').click(function() {
        $('#body-nbox').css("display", "block");
        $('.body-nb').css("display", "none");
        $(this).addClass("activebtn");
        $('.ol2').removeClass("activebtn");
    });
    $('.ol2').click(function() {
        $('#body-nbox').css("display", "none");
        $('.body-nb').css("display", "block");
        $(this).addClass("activebtn");
        $('.ol1').removeClass("activebtn");
    });

    //dong form
    $('.btn-closenk').click(function() {
        $('.form-login').css("display", "none");
        $('.form-search-product').css("display", "none");
        $('.black-screen').css("display", "none");
        $('#container').removeClass("fixed-hbd");
        $('#fixscreen-respon').css("display", "none");
    });

    $('.addy-product').click(function() {
        $('.form-search-product').css("display", "block");
        $('.black-screen').css("display", "block");
        $('#container').addClass("fixed-hbd");
    });
    //hien form dang ky,dang nhap,quen mat khau
    $('.btn-login').click(function() {
        $('.form-login').css("display", "block");
        $('.black-screen').css("display", "block");
        $('.wp-content-login').css("display", "block");
        $('.wp-content-register').css("display", "none");
        $('.wp-content-forgetpw').css("display", "none");
        $('.titlek').removeClass("active-formkn");
        $('.titlen').addClass("active-formkn");
        $('#container').addClass("fixed-hbd");
        // $('body,html').stop().animate({ scrollTop: 0 }, 0);
    });

    $('.btn-login-res').click(function() {
        $('#head-body-respon').removeClass("slider");
        $('.form-login').css("display", "block");
        $('.titlek').removeClass("active-formkn");
        $('.titlen').addClass("active-formkn");
        $('#container').addClass("fixed-hbd");
        $('.wp-content-login').css("display", "block");
        $('.wp-content-register').css("display", "none");
        $('.wp-content-forgetpw').css("display", "none");
        $('.titlek').removeClass("active-formkn");
        $('.black-screen').css("display", "block");
        $('#container').addClass("fixed-hbd");
        $('#fixscreen-respon').css("display", "none");
    });
    $('.btn-register').click(function() {
        $('.form-login').css("display", "block");
        $('.black-screen').css("display", "block");
        $('.wp-content-login').css("display", "none");
        $('.wp-content-register').css("display", "block");
        $('.wp-content-forgetpw').css("display", "none");
        $('.titlen').removeClass("active-formkn");
        $('.titlek').addClass("active-formkn");
        $('#container').addClass("fixed-hbd");
    });
    $('.btn-register-res').click(function() {
        $('#head-body-respon').removeClass("slider");
        $('.form-login').css("display", "block");
        $('.wp-content-login').css("display", "none");
        $('.wp-content-register').css("display", "block");
        $('.wp-content-forgetpw').css("display", "none");
        $('.titlen').removeClass("active-formkn");
        $('.titlek').addClass("active-formkn");
        $('.black-screen').css("display", "block");
        $('#container').addClass("fixed-hbd");
        $('#fixscreen-respon').css("display", "none");
    });
    $('.qpassword').click(function() {
        $('.form-login').css("display", "block");
        $('.black-screen').css("display", "block");
        $('.wp-content-forgetpw').css("display", "block");
        $('.wp-content-login').css("display", "none");
        $('.wp-content-register').css("display", "none");
        $('#container').addClass("fixed-hbd");
    });

    $('.password .imgm').click(function() {
        $(this).toggleClass('open');
        if ($(this).hasClass('open')) {
            $('.password input').attr('type', 'text');
        } else {
            $('.password input').attr('type', 'password');
        }
    });
    //hien tra cuu order
    // $('#search-order .btn-closenk').click(function() {
    //     $('#search-order').css("display", "none");
    //     $('.black-screen').css("display", "none");
    //     $('.titlek').removeClass("fixed-hbd");
    // });
    // $('.search-history-order').click(function() {
    //     $('#search-order').css("display", "block");
    //     $('.black-screen').css("display", "block");
    //     $('#container').addClass("fixed-hbd");
    // });
    // $('.container-menures').click(function () {
    //     $('#search-order').css("display", "block");
    //      $('.black-screen').css("display", "block");
    //      $('#container').addClass("fixed-hbd");
    // });

    // validate form
    $('#check-rules').click(function() {
        if ($(this).prop("checked") == true) {
            $('#dang-ky #btn-register').prop("disabled", false);
            $('#dang-ky #btn-register').css("background", "#05AFE3");
        } else if ($(this).prop("checked") == false) {
            $('#dang-ky #btn-register').prop("disabled", true);
            $('#dang-ky #btn-register').css("background", "#96d4e7");
        }

    });


    // tang giam so luong san pham
    $('.plus1, .minus1').on('click', function(e) {
        const isNegative = $(e.target).closest('.minus1').is('.minus1');
        const input = $(e.target).closest('.input-number').find('input');
        if (input.is('input')) {
            input[0][isNegative ? 'stepDown' : 'stepUp']()
        }
    })

    $('.order-noislogin').on('click', function() {
        alert('Vui lòng đăng nhập để mua hàng !')
    });
    //xoay arrow 180deg
    $('.iconmnrhv').click(function() {
        $(this).parents('.parentsmenu').children('.submenu1res').toggleClass('display-vis');
        $(this).toggleClass('arrow-rotate');
    });
    $('#btnmenu-resp').click(function() {
        //$('#container').addClass("fixed-hbd");
        $('#fixscreen-respon').css("display", "block");
        $('#head-body-respon').addClass("slider");

    });
    // $('.closem').click(function () {
    //      //$('#fixscreen-respon').css("display", "none");
    //     // $('#container').removeClass("fixed-hbd");
    //     $('#head-body-respon').removeClass("slider");
    // });
    $(window).resize(function(event) {
        $('#head-body-respon').removeClass("slider");
        $('#fixscreen-respon').css("display", "none");
    });

    //xo danh muc cap 1
    $('.vissubmenu').click(function() {
        $(this).parents('.catparentc').children('.submenua1').toggleClass('display-vis');
        $(this).toggleClass('arrow-rotate');
    });

    const head_body_respon = document.getElementById('head-body-respon');
    const fixscreen_respon = document.getElementById('fixscreen-respon');
    const closem = document.getElementById('closem');
    closem.addEventListener('click', () => {
        $('#head-body-respon').removeClass("slider");
        $('#fixscreen-respon').css("display", "none");
    });
    fixscreen_respon.addEventListener('click', (e) => {
        if (!head_body_respon.contains(e.target)) {
            closem.click();
            $('.form-login').css("display", "none");
        }
    });
    // $('.content-submenu').hover(
    //     function () {
    //         $('.black-content').css("display", "block");
    //         //$('.content-submenu').css("display", "block");
    //     },
    //     function () {
    //         $('.black-content').css("display", "none");
    //         //$('.content-submenu').css("display", "none");
    //     }
    // );
    $('.catc1').hover(
        function() {
            $('.black-content').css("display", "block");
        },
        function() {
            $('.black-content').css("display", "none");
        }
    );
    $('.icon_cart').hover(
        function() {
            $('#dropdown').addClass('opacity1_cartmini');
        },
        function() {
            $('#dropdown').removeClass('opacity1_cartmini');
        },
    );
    $('#reqexport').on('click', function() {
        if ($(this).prop("checked") == true) {
            $('.hidden_noreqes').css("display", "block");
        } else if ($(this).prop("checked") == false) {
            $('.hidden_noreqes').css("display", "none");
        }
        var dcshop = $('input[type="radio"][name="dcshop"]:checked').val();
    });
    $('.identity').on('click', function() {
        identity = $('input[type="radio"][name="identity"]:checked').val();
        if (identity == 'Công ty') {
            $('.company').css("display", "block");
            $('.person').css("display", "none");

        } else {
            $('.company').css("display", "none");
            $('.person').css("display", "block");

        }
    });
    $('.local-re').on('click', function() {
        local_re = $('input[type="radio"][name="local-re"]:checked').val();
        if (local_re == 'Giao hàng tận nơi') {
            $('.de-home').css("display", "block");
            $('.de-store').css("display", "none");
        } else {
            $('.de-home').css("display", "none");
            $('.de-store').css("display", "block");
        }
    });
});
jQuery.validator.addMethod("checkPhone",
    function() {
        var flag = false;
        var phone = $('.phonecart1').val().trim();
        phone = phone.replace('(+84)', '0');
        phone = phone.replace('+84', '0');
        phone = phone.replace('0084', '0');
        phone = phone.replace(/ /g, '');

        if (phone != '') {
            var firstNumber = phone.substring(0, 2);
            if ((firstNumber == '09' || firstNumber == '08' || firstNumber == '03' || firstNumber == '07') && phone.length == 10) {
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
jQuery.validator.addMethod("checkPhone1",
    function() {
        var flag = false;
        var phone = $('.phonecart2').val().trim();
        phone = phone.replace('(+84)', '0');
        phone = phone.replace('+84', '0');
        phone = phone.replace('0084', '0');
        phone = phone.replace(/ /g, '');

        if (phone != '') {
            var firstNumber = phone.substring(0, 2);
            if ((firstNumber == '09' || firstNumber == '08' || firstNumber == '03' || firstNumber == '07') && phone.length == 10) {
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
jQuery.validator.addMethod("checkPhone2",
    function() {
        var flag = false;
        var phone = $('.phonecart3').val().trim();
        phone = phone.replace('(+84)', '0');
        phone = phone.replace('+84', '0');
        phone = phone.replace('0084', '0');
        phone = phone.replace(/ /g, '');

        if (phone != '') {
            var firstNumber = phone.substring(0, 2);
            if ((firstNumber == '09' || firstNumber == '08' || firstNumber == '03' || firstNumber == '07') && phone.length == 10) {
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

jQuery.validator.addMethod("checknamecompany",
    function() {
        var flag = true;
        var namecompany = $('#namecompany').val().trim();
        local_re = $('input[type="radio"][name="identity"]:checked').val();
        if (document.getElementById('reqexport').checked && local_re == 'Công ty') {
            if (namecompany.length > 0) {
                flag = true;
            } else {
                flag = false;
            }
        } else {
            flag = true;
        }

        return flag;
    }
);
// jQuery.validator.addMethod("checktaxcode",
//     function() {
//         var flag = true;
//         var taxcode = $('#taxcode').val().trim();
//         local_re = $('input[type="radio"][name="identity"]:checked').val();
//         if (document.getElementById('reqexport').checked && local_re == 'Công ty') {
//             if (taxcode.length > 0) {
//                 flag = true;
//             } else {
//                 flag = false;
//             }
//         } else {
//             flag = true;
//         }
//         return flag;
//     }
// );
// jQuery.validator.addMethod("checkaddresscompany",
//     function() {
//         var flag = true;
//         var addresscompany = $('#addresscompany').val().trim();
//         local_re = $('input[type="radio"][name="identity"]:checked').val();
//         if (document.getElementById('reqexport').checked && local_re == 'Công ty') {
//             if (addresscompany.length > 0) {
//                 flag = true;
//             } else {
//                 flag = false;
//             }
//         } else {
//             flag = true;
//         }

//         return flag;
//     }
// );
jQuery.validator.addMethod("checkname1",
    function() {
        var flag = true;
        var name1 = $('#name1').val().trim();
        local_re = $('input[type="radio"][name="identity"]:checked').val();
        if (document.getElementById('reqexport').checked && local_re == 'Cá nhân') {
            if (name1.length > 0) {
                flag = true;
            } else {
                flag = false;
            }
        } else {
            flag = true;
        }
        return flag;
    }
);
jQuery.validator.addMethod("checkphone1",
    function() {
        var flag = true;
        var phone1 = $('#phone1').val().trim();
        local_re = $('input[type="radio"][name="identity"]:checked').val();
        if (document.getElementById('reqexport').checked && local_re == 'Cá nhân') {
            if (phone1.length > 0) {
                flag = true;
            } else {
                flag = false;
            }
        } else {
            flag = true;
        }
        return flag;
    }
);
jQuery.validator.addMethod("checkaddress1",
    function() {
        var flag = true;
        var address1 = $('#address1').val().trim();
        local_re = $('input[type="radio"][name="identity"]:checked').val();
        if (document.getElementById('reqexport').checked && local_re == 'Cá nhân') {
            if (address1.length > 0) {
                flag = true;
            } else {
                flag = false;
            }
        } else {
            flag = true;
        }
        return flag;
    }
);
jQuery.validator.addMethod("checkname2",
    function() {
        var flag = true;
        var name2 = $('#name2').val().trim();
        local_re = $('input[type="radio"][name="local-re"]:checked').val();
        if (local_re == 'Giao hàng tận nơi') {
            if (name2.length > 0) {
                flag = true;
            } else {
                flag = false;
            }
        } else {
            flag = true;
        }
        return flag;
    }
);
jQuery.validator.addMethod("checkphone2",
    function() {
        var flag = true;
        var phone2 = $('#phone2').val().trim();
        local_re = $('input[type="radio"][name="local-re"]:checked').val();
        if (local_re == 'Giao hàng tận nơi') {
            if (phone2.length > 0) {
                flag = true;
            } else {
                flag = false;
            }
        } else {
            flag = true;
        }
        return flag;
    }
);
jQuery.validator.addMethod("checkcity2",
    function() {
        var flag = true;
        var city2 = $('#city').find(":selected").val();
        local_re = $('input[type="radio"][name="local-re"]:checked').val();
        if (local_re == 'Giao hàng tận nơi') {
            if (city2.length > 0) {
                flag = true;
            } else {
                flag = false;
            }
        } else {
            flag = true;
        }
        return flag;
    }
);
jQuery.validator.addMethod("checkdistrict2",
    function() {
        var flag = true;
        var district2 = $('#district2').find(":selected").val();
        local_re = $('input[type="radio"][name="local-re"]:checked').val();
        if (local_re == 'Giao hàng tận nơi') {
            if (district2.length > 0) {
                flag = true;
            } else {
                flag = false;
            }
        } else {
            flag = true;
        }
        return flag;
    }
);
jQuery.validator.addMethod("checkwards2",
    function() {
        var flag = true;
        var wards2 = $('#wards2').find(":selected").val();
        local_re = $('input[type="radio"][name="local-re"]:checked').val();
        if (local_re == 'Giao hàng tận nơi') {
            if (wards2.length > 0) {
                flag = true;
            } else {
                flag = false;
            }
        } else {
            flag = true;
        }
        return flag;
    }
);
jQuery.validator.addMethod("checkaddressdetail2",
    function() {
        var flag = true;
        var addressdetail2 = $('#addressdetail2').val().trim();
        local_re = $('input[type="radio"][name="local-re"]:checked').val();
        if (local_re == 'Giao hàng tận nơi') {
            if (addressdetail2.length > 0) {
                flag = true;
            } else {
                flag = false;
            }
        } else {
            flag = true;
        }
        return flag;
    }
);
jQuery.validator.addMethod("checkcity3",
    function() {
        var flag = true;
        var city3 = $('#city3').val().trim();
        local_re = $('input[type="radio"][name="local-re"]:checked').val();
        if (local_re == 'Nhận tại nhà thuốc') {
            if (city3.length > 0) {
                flag = true;
            } else {
                flag = false;
            }
        } else {
            flag = true;
        }
        return flag;
    }
);
jQuery.validator.addMethod("checkdistrict3",
    function() {
        var flag = true;
        var district3 = $('#district3').val().trim();
        local_re = $('input[type="radio"][name="local-re"]:checked').val();
        if (local_re == 'Nhận tại nhà thuốc') {
            if (district3.length > 0) {
                flag = true;
            } else {
                flag = false;
            }
        } else {
            flag = true;
        }
        return flag;
    }
);
jQuery.validator.addMethod("checkdcshop",
    function() {
        var flag = true;
        var dcshop = '';
        var dcshop = $('input[type="radio"][name="dcshop"]:checked').val();
        local_re = $('input[type="radio"][name="local-re"]:checked').val();
        if (local_re == 'Nhận tại nhà thuốc') {
            if (dcshop != undefined) {
                flag = true;
            } else {
                flag = false;
            }
        } else {
            flag = true;
        }
        return flag;
    }
);

jQuery.validator.addMethod("checknumbershop",
    function() {
        var flag = true;
        var count_store = $('.count-store').val().trim();
        local_re = $('input[type="radio"][name="local-re"]:checked').val();
        if (local_re == 'Nhận tại nhà thuốc') {
            if (count_store > 0) {
                flag = true;
            } else {
                flag = false;
            }
        } else {
            flag = true;
        }
        return flag;
    }
);