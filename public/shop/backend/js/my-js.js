$(document).on('submit', 'form#main-form', function(event) {
    event.preventDefault();
    $('.has-error').removeClass('has-error');
    $('span.help-block').html('').removeClass("help-block-show");
    $('.is-invalid').removeClass("is-valid");
    var form = $(this);
    form.find("input[type='submit']").val("Đang lưu....");
    var data = new FormData($(this)[0]);
    if (data.has('albumImage]')) {
        data.delete('albumImage[]');
        for (var i = 0; i < myUploadImage.fileList().length; i++) {
            var file = myUploadImage.fileList()[i];
            // Add the file to the request.
            data.append('albumImage[]', file, file.name);
        }
    }
    var url = form.attr("action");

    $.ajax({
        type: form.attr('method'),
        url: url,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function(response) {
            $msg = '';
            if (response.fail == true) {
                if (response.errors != null) {
                    // for (control in response.errors) {
                    //     eleError = "<label id='" + control + "-error' class='error invalid-feedback' for='" + control + "' style='display:inline-block'>" + response.errors[control] + "</label>";
                    //     $('[name=' + control + ']').closest(".form-group").find("label[for='" + control + "']").remove();
                    //     $('[name=' + control + ']').closest(".input-group").addClass('has-error').after(eleError);
                    //     $('[name=' + control + ']').addClass("is-invalid").removeClass('is-valid');
                    // }
                    form.find("input[type='submit']").val("Lưu");
                    for (control in response.errors) {
                        $('[name=' + control + ']').addClass("is-invalid")
                        $('[name=' + control + ']').parents('div.form-group').addClass("has-error");
                        $('[name=' + control + ']').siblings('span.help-block').html(response.errors[control]).addClass("help-block-show");
                        //  $msg += "<br/>" + data.errors[control];
                    }
                    var firstError = $('.has-error').first();
                    if (firstError.length > 0) {
                        $('html, body').animate({
                            scrollTop: firstError.offset().top - 50
                        }, 500);
                    }
                } else {
                    alert(response.message);
                }
            } else {
                alert(response.message);
                window.location.replace(response.redirect_url);
            }

            // if (data.fail) {
            //     form.find("input[type='submit']").val("Lưu");
            //     for (control in data.errors) {
            //         $('[name=' + control + ']').addClass("is-invalid")
            //         $('[name=' + control + ']').parents('div.form-group').addClass("has-error");
            //         $('[name=' + control + ']').siblings('span.help-block').html(data.errors[control]).addClass("help-block-show");
            //         $msg += "<br/>" + data.errors[control];
            //     }
            //     $msg = $msg.substring(5);
            //     alert($msg);
            // } else {
            //     // $.pjax({ url: data.redirect_url, container: pjaxContainer });
            //     alert(data.message);
            //     location.href = data.redirect_url;
            //     // window.location.replace(data.redirect_url);
            // }
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
$(document).on('change', "select[name^='list_products[product_id]']", function(event) {
    event.preventDefault();
    url = $(this).data('href');
    $selectValue = $(this).val();
    $rowCurrent = $(this).closest('.row-detail');
    if (($selectValue != '') && ($selectValue != 'null')) {
        url = url.replace('value_new', $selectValue);
        $.get({
            url: url,
            cache: false,
            dataType: 'json',
            success: function(data) {
                option = "<option value= '" + data.unit_product.id + "'>" + data.unit_product.name + "</option>";
                $($rowCurrent).find("select[name='list_products[unit_id][]']").html('').html(option);
                $($rowCurrent).find("input[name='list_products[price_import][]']").val(data.price.toLocaleString("vi-VN"));
                $($rowCurrent).find("input[name^='list_products[quantity]']").val(1);
                updateDetailImportCoupon($rowCurrent);
            },
            error: function(xhr, textStatus, errorThrown) {
                alert("Error: " + errorThrown);
            }
        });
    }
});
$(document).on('blur', "input[name^='list_products[price_import]']", function(event) {
    $rowCurrent = $(this).closest('.row-detail');

    updateDetailImportCoupon($rowCurrent);
});
$(document).on('blur', "input[name^='list_products[quantity]']", function(event) {
    $rowCurrent = $(this).closest('.row-detail');
    updateDetailImportCoupon($rowCurrent);
});

function updateDetailImportCoupon($rowCurrent) {
    $quantity = $($rowCurrent).find("input[name^='list_products[quantity]']").val();
    $price_import = $($rowCurrent).find("input[name='list_products[price_import][]']").val();
    $total_money_old = $($rowCurrent).find("input[name='list_products[total_money][]']").val();
    $total = $("input[name='total']").val();
    $quantity = ($quantity != '') ? parseInt($quantity.replaceAll('.', '')) : 0;
    $price_import = ($price_import != '') ? parseInt($price_import.replaceAll('.', '')) : 0;
    $total = ($total != '') ? parseInt($total.replaceAll('.', '')) : 0;
    $total_money_old = ($total_money_old != '') ? parseInt($total_money_old.replaceAll('.', '')) : 0;

    $total_money = $quantity * $price_import;
    $total = $total - $total_money_old + $total_money;
    $($rowCurrent).find("input[name='list_products[total_money][]']").val($total_money.toLocaleString("vi-VN"));
    $("input[name='total']").val($total.toLocaleString("vi-VN"))
}

$(".number").on('keyup', function(evt) {
    if ($(this).val() != '') {
        if (evt.which != 110) { //not a fullstop
            var n;

            if ($(this).attr('id') != 'giamGia') {
                n = parseFloat($(this).val().replaceAll('.', '')
                    .replace(/\,/g, ''), 10);
            } else {
                if (evt.which != 188) {
                    n = parseFloat($(this).val().replaceAll(',', '.'));
                }
            }
            $(this).val(n.toLocaleString("vi-VN"));
        }
    }
});
$(document).on('change', "select.get_child", function(event) {
    event.preventDefault();
    url = $(this).data('href');
    target = $(this).data('target');
    $selectValue = $(this).val();
    if (($selectValue == '') && (url.indexOf('value_new') !== -1)) {
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
                // if ($(target).hasClass('get_data')) $(target).trigger("change");
                if ($(target).hasClass('get_child')) $(target).trigger("change");
            },
            error: function(xhr, textStatus, errorThrown) {
                alert("Error: " + errorThrown);
            }
        });
    }
});
$(document).on('click', ".changeTypePassword", function(event) {
    parent = $(this).parents('.form-group');
    parent.toggleClass('open');
    if (parent.hasClass('open')) {
        parent.find("input[name='password']").attr('type', 'text');
        parent.find("input[name='password_old']").attr('type', 'text');
        parent.find("input[name='password_confirmation']").attr('type', 'text');
        $(this).html("<i class='fa fa-eye-slash'></i>");
    } else {
        parent.find("input[name='password']").attr('type', 'password');
        parent.find("input[name='password_old']").attr('type', 'password');
        parent.find("input[name='password_confirmation']").attr('type', 'password');
        $(this).html("<i class='fa fa-eye'></i>");
    }
});
$(document).on('click', "a.btn-filter", function(event) {
    event.preventDefault();
    $('.loading').show();
    url = $(this).data('href');
    window.location.replace(url);
});
$(document).on('click', ".btn-add-row", function(event) {
    event.preventDefault();
    rowCurrent = $(this).closest('.row-detail');
    rowNew = rowCurrent.clone();
    $(rowNew).find("input").val(0);
    rowNew.insertAfter(rowCurrent);
    rowNew.find('.select2').parent().find('span.select2-container').remove();
    $(rowNew).find('.select2').removeAttr('tabindex');
    $('.select2').select2();
    $(rowNew).find('.select2').val('null').trigger("change");
});
$(document).on('click', '.btn-delete-row', function() {
    if ($('.row-detail').length <= 1) {
        return false;
    }
    $(this).closest('.row-detail').remove();
});
$(document).on('click', "#btnDeleteFile", function(event) {
    if ($("input[name='file-del']").length) {
        if ($("input[name='file-del']").val() != '') {
            $val = $("input[name='file-del']").val() + '|' + $(this).attr('data-href');
            $("input[name='file-del']").attr('value', $val);
        } else {
            $("input[name='file-del']").attr('value', $(this).attr('data-href'));
        }
    }
    $(this).closest("li").fadeOut(500);
    event.preventDefault();
});
$(document).on('change', '.select_change_attr', function() {
    let selectValue = $(this).val();
    let url = $(this).data('href');
    console.log(url.replace('value_new', selectValue));
    window.location.href = url.replace('value_new', selectValue);
});

$(document).ready(function() {
    $(".select2").select2();
    $('#btn-image').filemanager('image');
    if ($("input[name='albumImage[]']").length) {
        myUploadImage = $("input[name='albumImage[]']").uploadPreviewer({
            buttonText: " Tải album ảnh",
        });
    }
    if (($(".file-preview-table").length > 0) &&
        ($(".file-preview-table").find('td').length == 0)) {
        $(".file-preview-table").css({
            "margin-top": "0px",
            "margin-bottom": "0px"
        });
    }
    
    $('#image-file').change(function(event) {
        var file = event.target.files[0]; 
        if (file) {
            // Tạo một FileReader để đọc ảnh
            var reader = new FileReader();
            reader.onload = function(e) {
                // Hiển thị ảnh mới trên thẻ img
                $('#image-thumb').attr('src', e.target.result);
            };
            reader.readAsDataURL(file); // Đọc file dưới dạng URL
        }
    });
    $('.datemask').datepicker({
        format: 'dd/mm/yyyy',
        autoclose: true,
        language: 'vi'
    });

    var lfm = function(options, cb) {
        var route_prefix = (options && options.prefix) ? options.prefix : '/laravel-filemanager';
        window.open(route_prefix + '?type=' + options.type || 'file', 'FileManager', 'width=900,height=600');
        window.SetUrl = cb;
    };

    // Define LFM summernote button
    var LFMButton = function(context) {
        var ui = $.summernote.ui;
        var button = ui.button({
            contents: '<i class="note-icon-picture"></i> ',
            tooltip: 'Insert image',
            click: function() {
                lfm({ type: 'image', prefix: '/laravel-filemanager' }, function(url, path) {
                    context.invoke('insertImage', url);
                });
            }
        });
        return button.render();
    };

    // Initialize summernote with LFM button in the popover button group
    // Please note that you can add this button to any other button group you'd like
    function sendFile(file) {
        var formData = new FormData();
        formData.append('file', file);
    
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            url: '/backend/upload-image', // Endpoint để tải ảnh lên server
            type: 'POST',
            data: formData,
            contentType: false,
            processData: false,
            success: function(response) {
                const fullUrl = response.url;
                console.log('URL ảnh:', fullUrl);
                $('.editor').summernote('insertImage', fullUrl);
            },
            error: function(xhr, status, error) {
                console.error('Lỗi khi tải ảnh lên:', error);
            }
        });
    }
    $('.editor').summernote({
        tabsize: 2,
        height: 100,

        callbacks: {
            onPaste: function(e) {
                var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');

                e.preventDefault();

                // Firefox fix
                setTimeout(function() {
                    document.execCommand('insertText', false, bufferText);
                }, 10);
            },
            onImageUpload: function(files) {
                sendFile(files[0]); // Gọi hàm sendFile khi người dùng tải ảnh lên
            }
        }
    })

    $("#choices-multiple-remove-button").select2();
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
    $('.js-select2').select2();
    $('.nav-link.active .sub-menu').slideDown();

});
$(document).on('click', "button#btn-search", function(event) {
    let $inputSearchField = $("input[name  = search_field]");
    let $inputSearchValue = $("input[name  = search_value]");
    let pathname = window.location.pathname;
    let params = ['filter_status'];
    let searchParams = new URLSearchParams(window.location.search); // ?filter_status=active

    let link = "";
    $.each(params, function(key, param) { // filter_status
        if (searchParams.has(param)) {
            link += param + "=" + searchParams.get(param) + "&" // filter_status=active
        }
    });
    let search_field = $inputSearchField.val();
    let search_value = $inputSearchValue.val();
    if (search_value.replace(/\s/g, "") == "") {
        alert("Nhập vào giá trị cần tìm !!");
    } else {
        event.preventDefault();
        url = pathname + "?" + link + 'search_field=' + search_field + '&search_value=' + search_value;
        window.location.replace(url);
    }
});
$(document).on('click', "button#btn-filter-day", function(event) {
    let $inputDayStart = $("input[name  = day_start]");
    let $inputDayEnd = $("input[name  = day_end]");
    let pathname = window.location.pathname;
    let params = ['filter_status'];
    let searchParams = new URLSearchParams(window.location.search); // ?filter_status=active

    let link = "";
    $.each(params, function(key, param) { // filter_status
        if (searchParams.has(param)) {
            link += param + "=" + searchParams.get(param) + "&" // filter_status=active
        }
    });
    let day_start = $inputDayStart.val();
    let day_end = $inputDayEnd.val();
    if (day_start.replace(/\s/g, "") == "" || day_end.replace(/\s/g, "")== "") {
        alert("Chọn giá trị ngày tháng !!");
    } else {
        event.preventDefault();
        url = pathname + "?" + link + 'day_start=' + day_start + '&day_end=' + day_end;
        window.location.replace(url);
    }
});
$(document).on('click', "button#btn-clear-search", function(event) {
    var pathname = window.location.pathname;
    let searchParams = new URLSearchParams(window.location.search);
    params = ['filter_status'];
    let link = "";
    $.each(params, function(key, param) {
        if (searchParams.has(param)) {
            link += param + "=" + searchParams.get(param) + "&"
        }
    });
    link += "deleteValueSearch=1&";
    if (link == '') {
        url = pathname
    } else {
        url = pathname + "?" + link.slice(0, -1);
    }
    window.location.replace(url);
});
$(document).on('click', ".filter-in-time", function(event) {
    day_start = $("input[name='date_start']").val();
    day_end = $("input[name='date_end']").val();
    var _token = $('input[name="_token"]').val();
    let url = $(this).data('href');
    var controller_name=$(this).data('controller');
    if(day_start != '' && day_end != ''){
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'html',
            data: {
                day_start: day_start,
                _token: _token,
                day_end: day_end,
                controller_name:controller_name,
            },
            success: function(data) {
                $('.list-user-admin').html(data);
                //console.log(data['test']);
            }
        });
    }
    
});
$(document).on('click', ".filter-revenue-in-time", function(event) {
    day_start = $("input[name='date_start']").val();
    day_end = $("input[name='date_end']").val();
    var _token = $('input[name="_token"]').val();
    let url = $(this).data('href');
    if(day_start != '' && day_end != ''){
        $.ajax({
            url: url,
            method: 'GET',
            dataType: 'json',
            data: {
                day_start: day_start,
                _token: _token,
                day_end: day_end,
            },
            success: function(data) {
                $('.total-revenue').html(new Intl.NumberFormat('vi-VN', { style: 'currency', currency: 'VND' }).format(data['total_revenue']));
                //console.log(data['test']);
            }
        });
    }
    
});
$(document).on('keypress', "input[name='search_value']", function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("button#btn-search").click();
    }
});
function showModal() {
    $('#imageModal').modal('show');
    $('body').addClass('modal-open-overlay');
}
function hideModal() {
    $('#imageModal').modal('hide');
    $('body').removeClass('modal-open-overlay');
}
$('.label-select-image').click(function() {
    showModal();
});
$('#imageModal .close').click(function() {
    hideModal();
});
$('#imageModal').click(function(event) {
    if ($(event.target).hasClass('modal')) {
        hideModal();
    }
});
$(document).on('input', "#imageUrlThumb", function(event) {
    $('.btn-insert-url-thumb').prop('disabled', $(this).val().trim() === '');
});
$(document).on('mouseup', "#btn-image", function(event) {
    hideModal();
});
$(document).on('click', '.btn-insert-url-thumb', function(event) {
    var imageUrl = $('#imageUrlThumb').val().trim();
    if (imageUrl !== '') {
        $('#image').val(imageUrl);
        $('#image-thumb').attr('src', imageUrl);
        $('#image-thumb').show();
        $('.help-block').hide();
        $('#imageModal').modal('hide');
    } else {
        $('#image-thumb').hide();
        $('.help-block').text('Vui lòng nhập đường dẫn hình ảnh.').show();
    }
});
$(document).on('click', '.btn-copy', function(event) {
    var affiliateLink = $(this).siblings("input").val();
    var tempTextArea = $("<textarea>");
    $("body").append(tempTextArea);
    tempTextArea.val(affiliateLink).select();
    document.execCommand("copy");
    tempTextArea.remove();
    var $message = $('<span class="copy-message">Copied!</span>');
    $(this).after($message);  
    $message.fadeIn(300);  
    setTimeout(function() {
        $message.fadeOut(300, function() {
            $message.remove();  
        });
    }, 2000);
});
$(document).on('click', '.show-link', function(event) {
    var valueLink = $(this).siblings(".value-link");
    valueLink.toggle();
    var icon = $(this).find("i");
    icon.toggleClass("fas fa-eye-slash");
    var buttonText = valueLink.is(":visible") ? '<i class="fas fa-eye-slash"></i>' : '<i class="fas fa-eye"></i>';
    $(this).html(buttonText);
});
$(document).on('click', '.wp-link-affiliate .btn-copy-link', function(event) {
    var copyText = $(this).siblings('.value-link');
    var tempInput = $("<input>");
    $("body").append(tempInput);
    tempInput.val(copyText.text()).select();
    document.execCommand("copy");
    tempInput.remove();
    $(this).tooltip({
        title: "Đã copy!",
        trigger: "manual"
    }).tooltip('show');
    setTimeout(function() {
        $('.wp-link-affiliate .btn-copy-link').tooltip('hide');
    }, 2000);
});
$(document).on('click', '#checkAll', function(event) {
    var checkAllStatus = $(this).prop('checked');
    $('input[name="info_product[]"]').prop('checked', checkAllStatus);
});
$(document).on('click', '.checlAllInCat', function(event) {
    var checkAllStatus = $(this).prop('checked');
    $(this).closest('.card').find('input[name="info_product[]"]').prop('checked', checkAllStatus);
});
$(document).on('click', 'input[name="info_product[]"]', function(event) {
    if ($('input[name="info_product[]"]:checked').length === $('input[name="info_product[]"]').length) {
        $('#checkAll').prop('checked', true);
    } else {
        $('#checkAll').prop('checked', false);
    }
});
document.getElementById('copyBtn').addEventListener('click', function() {
    var copyText = document.getElementById('code_ref');
    copyText.select();
    copyText.setSelectionRange(0, 99999);
    document.execCommand('copy');
    var tooltip = new bootstrap.Tooltip(document.getElementById('copyBtn'), {
        title: 'Copied!',
        placement: 'top', 
        trigger: 'manual' 
    });
    tooltip.show();
    setTimeout(function() {
        tooltip.hide();
    }, 2000);
});
