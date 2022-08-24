//slider
$(document).ready(function () {
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
    //box  or list product
    $('.ol1').click(function () {
        $('#body-nbox').css("display", "block");
        $('.body-nb').css("display", "none");
        $(this).addClass("activebtn");
        $('.ol2').removeClass("activebtn");
    });
    $('.ol2').click(function () {
        $('#body-nbox').css("display", "none");
        $('.body-nb').css("display", "block");
        $(this).addClass("activebtn");
        $('.ol1').removeClass("activebtn");
    });
    //sub menu
    $('.sub-menu1>li').hover(
        function () {
            $('.sub-menu1>li').removeClass('active-menucat2');
            $(this).addClass('active-menucat2');
        },
        function () {
            $(this).addClass('active-menucat2');
        }
    );
    $('.catc1').hover(
        function () {
            $('.black-content').css("display", "block");
            $('.sub-menu1>li:first-child').addClass('active-menucat2');
            $('.sub-menu1>li:first-child .sub-menu2').css("display", "block");
        },
        function () {
            $('.black-content').css("display", "none");
            $('.sub-menu1>li:first-child .sub-menu2').css("display", "none");
        },
    );
    //dong form
    $('.btn-closenk').click(function () {
        $('.form-login').css("display", "none");
        $('.black-screen').css("display", "none");
        $('#container').removeClass("fixed-hbd");
        
    });
    //hien form dang ky,dang nhap,quen mat khau
    $('.btn-login').click(function () {
        $('.form-login').css("display", "block");
        $('.black-screen').css("display", "block");
        $('.wp-content-login').css("display", "block");
        $('.wp-content-register').css("display", "none");
        $('.wp-content-forgetpw').css("display", "none");
        $('.titlek').removeClass("active-formkn");
        $('.titlen').addClass("active-formkn");
        $('#container').addClass("fixed-hbd");
        $('body,html').stop().animate({ scrollTop: 0 }, 0);
    });
    $('.btn-register').click(function () {
        $('.form-login').css("display", "block");
        $('.black-screen').css("display", "block");
        $('.wp-content-login').css("display", "none");
        $('.wp-content-register').css("display", "block");
        $('.wp-content-forgetpw').css("display", "none");
        $('.titlen').removeClass("active-formkn");
        $('.titlek').addClass("active-formkn");
        $('#container').addClass("fixed-hbd");
    });
    $('.qpassword').click(function () {
        $('.form-login').css("display", "block");
        $('.black-screen').css("display", "block");
        $('.wp-content-forgetpw').css("display", "block");
        $('.wp-content-login').css("display", "none");
        $('.wp-content-register').css("display", "none");
        $('#container').addClass("fixed-hbd");
    });
    
    $('.password .imgm').click(function () {
        $(this).toggleClass('open');
        if ($(this).hasClass('open')) {
            $('.password input').attr('type', 'text');
        }
        else {
            $('.password input').attr('type', 'password');
        }
    });
//hien tra cuu order
$('#search-order .btn-closenk').click(function () {
    $('#search-order').css("display", "none");
    $('.black-screen').css("display", "none");
    $('.titlek').removeClass("fixed-hbd");
});
$('.search-history-order').click(function () {
    $('#search-order').css("display", "block");
    $('.black-screen').css("display", "block");
    $('#container').addClass("fixed-hbd");
});


    // tang giam so luong san pham
    $('.plus1, .minus1').on('click', function (e) {
        const isNegative = $(e.target).closest('.minus1').is('.minus1');
        const input = $(e.target).closest('.input-number').find('input');
        if (input.is('input')) {
            input[0][isNegative ? 'stepDown' : 'stepUp']()
        }
    })
});

