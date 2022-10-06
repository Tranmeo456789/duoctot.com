<script src="{{ asset('shop/template/js/jquery.min.js') }}"></script>
<script src="{{ asset('shop/template/js/nprogress.js') }}"></script>
<script src="{{ asset('shop/template/js/toastr.min.js') }}"></script>
<script src="{{ asset('shop/template/js/bootstrap-datepicker.min.js') }}"></script>
<script src="{{ asset('shop/template/js/bootstrap-datepicker.vi.min.js') }}"></script>
<script src="{{ asset('shop/template/js/summernote-bs4.min.js') }}"></script>
<script src="{{ asset('shop/template/js/select2.full.min.js') }}"></script>
<script src="{{ asset('shop/template/js/jquery.uploadPreviewer.js') }}"></script>
<script src="{{ asset('shop/template/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('shop/backend/js/moment.min.js') }}"></script>
<script src="{{ asset('shop/backend/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<script src="{{ asset('shop/template/js/adminlte.min.js') }}"></script>
<script src="{{asset('vendor/laravel-filemanager/js/lfm.js')}}"> </script>
<script src="{{ asset('shop/backend/js/my-js.js') }}?ts={{time()}}"></script>
<script>
    $(document).ready(function() {
        $('.update-status').change(function() {
            status1 = $(this).find(":selected").val();
            var _token = $('input[name="_token"]').val();
            var id = $(this).attr('data-id');
            $.ajax({
                url: "{{route('order.update_status')}}",
                method: 'GET',
                dataType: 'json',
                data: {
                    status: status1,
                    id: id,
                    _token: _token,
                },
                success: function(data) {
                    $('.noti-statusorrder').html(data.noti_success);
                   // console.log(data.pro);
                }
            });

        });
        $('.choose1').change(function() {
        var action = $(this).attr('id');
        var maid = $(this).val();
        var _token = $('input[name="_token"]').val();
        var result = '';
        if (action == 'city') {
            result = 'province';
        } else {
            result = 'wards';
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