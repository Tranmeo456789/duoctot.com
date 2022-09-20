$(document).ready(function() {
    
    $('.nav-link.active .sub-menu').slideDown();
    // $("p").slideUp();
    $('#sidebar-menu .arrow').click(function() {
        $(this).parents('li').children('.sub-menu').slideToggle();
        $(this).toggleClass('fa-angle-right fa-angle-down');
    });

    //active status product
    $('.status-product a').click(function(){
        $('.status-product a').removeClass('active-status');
        $(this).addClass('active-status');
    });
    // button hien an sidebar
    $(".btnvis-sidebar").click(function () {
        $('#sidebar').addClass("slider");
        $('#wp-opacity').css("display", "block");
    });
    
    const wp_opacity=document.getElementById('wp-opacity');
    const sidebar=document.getElementById('sidebar');
    const hide_sidebar=document.getElementById('hide-sidebar');
    hide_sidebar.addEventListener('click',()=>{
        $('#sidebar').removeClass("slider");
        $('#wp-opacity').css("display", "none");
    });
    wp_opacity.addEventListener('click',(e)=>{
        if(!sidebar.contains(e.target)){
            hide_sidebar.click();
        }
    });
    $(window).scroll(function(event) {
        $('#sidebar').removeClass("slider");
        $('#wp-opacity').css("display", "none");
    });
    $(window).resize(function(event) {
        $('#sidebar').removeClass("slider");
        $('#wp-opacity').css("display", "none");
    });
    // choose multiple select
    var multipleCancelButton = new Choices('#choices-multiple-remove-button', {
        removeItemButton: true,
        maxItemCount:5,
        searchResultLimit:5,
        renderChoiceLimit:5
      }); 
    
    
    Dropzone.options.dropzoneForm = {
        autoProcessQueue : false,
        acceptedFiles : ".png,.jpg,.gif,.bmp,.jpeg",
    }; 
    
});






