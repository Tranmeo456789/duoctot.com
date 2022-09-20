$(document).on('submit', 'form#main-form', function(event) {
    event.preventDefault();
    $('.has-error').removeClass('has-error');
    $('span.help-block').html('').removeClass("help-block-show");
    $('.is-invalid').removeClass("is-valid");
    var form = $(this);
    form.find("input[type='submit']").val("Đang lưu....");
    var data = new FormData($(this)[0]);

    var url = form.attr("action");

    $.ajax({
        type: form.attr('method'),
        url: url,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            $msg = '';
            if (data.fail) {
                form.find("input[type='submit']").val("Lưu");
                for (control in data.errors) {
                    $('[name=' + control + ']').addClass("is-invalid")
                    $('[name=' + control + ']').parents('div.form-group').addClass("has-error");
                    $('[name=' + control + ']').siblings('span.help-block').html(data.errors[control]).addClass("help-block-show");
                    $msg += "<br/>" + data.errors[control];
                }
                // $msg = $msg.substring(5);
                // toastr.error($msg);
            } else {
                // $.pjax({ url: data.redirect_url, container: pjaxContainer });
                window.location.replace(data.redirect_url);
                //   toastr.success(data.message);
            }
        },
        error: function(xhr, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
        }
    });
    return false;
});
$(document).on('click', "a.btn-delete", function(event) {
    event.preventDefault();
    $name = $(this).closest('tr')
        .children(".name")
        .text();
    $html = '<strong>' + $name + '</strong>';

    $("#modalDelete .modal-body > p > span").html($html);
    $('#modalDelete #delete_id').val($(this).data('id'));
    $('#modalDelete  #delete_token').val($(this).data('token'));
    $('#modalDelete #btn-confim-delete').data('href', $(this).data('href'));
    $("#modalDelete").modal('show');
});
$(document).on('click', '#btn-confim-delete', function(event) {
    event.preventDefault();
    url = $(this).data('href');
    ajaxDelete(url, $('#delete_token').val());
});

function ajaxDelete(url, token, content) {
    $.ajax({
        type: 'GET',
        data: { _method: 'GET', _token: token },
        url: url,
        success: function(data) {
            $('#modalDelete').modal('hide');
            $page = $('.page-item.active span').html();
            if (typeof $page !== "undefined") { //Ton tai so trang
                if ($('#tbList tbody').children('tr').length == 1) { //Con 1 phan tu trong trang
                    $page = $page - 1;
                }
                if ($page > 1) {
                    link = '?page=' + $page;
                    url = data.redirect_url + link;
                } else {
                    url = data.redirect_url;
                }
            } else {
                url = data.redirect_url;
            }
            window.location.replace(url);
            //toastr.success(data.message);
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });
}


$(document).ready(function() {
    $('#submit-all1').click(function() {
        var x = document.getElementsByClassName("name-img");
        var name_img = [];
        for (i = 0; i < x.length; i++) {
            name_img[i] = x[i].innerHTML;
        }
        var id_product = $('input[name="id_product"]').val();;
        var _token =
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        var _token = $('input[name="_token"]').val();
        event.preventDefault();
        $.ajax({
            url: "{{route('dropzone.upload')}}",
            method: 'POST',
            dataType: 'json',
            data: {
                name_img: name_img,
                _token: _token,
                id_product: id_product,
            },
            success: function(data) {
                $('#list-img').html(data.list_img);
                //console.log(data.img);
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
    $('.update-status').change(function() {
        status = $(this).find(":selected").val();
        var _token = $('input[name="_token"]').val();
        var id = $(this).attr('data-id');
        $.ajax({
            url: "{{route('order.update_status')}}",
            method: 'POST',
            dataType: 'json',
            data: {
                status: status,
                id: id,
                _token: _token,
            },
            success: function(data) {
                $('.noti-statusorrder').html(data.noti_success);
                console.log(data.pro);
            }
        });

    });
    $('.js-select2').select2();
    $('.nav-link.active .sub-menu').slideDown();

});