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