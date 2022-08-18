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

});
//box  or list product
$(document).ready(function() {
    $('.ol1').click(function() {
        $('#body-nbox').css("display","block"); 
        $('.body-nb').css("display","none"); 
    });
    $('.ol2').click(function() {
        $('#body-nbox').css("display","none"); 
        $('.body-nb').css("display","block"); 
    });
});