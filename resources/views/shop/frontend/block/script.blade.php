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


    });
</script>


<script>
    $(document).ready(function() {    
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