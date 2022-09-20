var triggeredByChild = false;
var imgBefore = '';
var avatarDefault = 'http://localhost/thanhtra/fileUpload/congchuc/images/user-default.jpg';
$(document).ready(function() {
    var myUploadInput;
    var tableFixHeader;
    toastr.options = {
        "closeButton": true,
        "debug": false,
        "newestOnTop": false,
        "progressBar": false,
        "positionClass": "toast-top-right",
        "preventDuplicates": false,
        "onclick": null,
        "showDuration": "1",
        "hideDuration": "1",
        "timeOut": "5000",
        "extendedTimeOut": "1000",
        "showEasing": "swing",
        "hideEasing": "linear",
        "showMethod": "fadeIn",
        "hideMethod": "fadeOut"
    }
    if (window.location.pathname.indexOf('thanhphanhoso') !== -1) {
        $("#modalForm .modal-dialog").addClass("modal-lg");
    }
    if (window.location.pathname.indexOf('user') !== -1) {
        $("#modalForm .modal-dialog").addClass("modal-lg");
    }
    if (window.location.pathname.indexOf('doc') !== -1) {
        $("#modalForm .modal-dialog").addClass("modal-lg");
    }
    if (window.location.pathname.indexOf('congchuc') !== -1) {
        $("#modalForm .modal-dialog").addClass("modal-lg");
    }
    if (window.location.pathname.indexOf('quatrinhdaotao') !== -1) {
        $("#modalForm .modal-dialog").addClass("modal-lg");
    }
    if (window.location.pathname.indexOf('thethanhtra') !== -1) {
        $("#modalForm .modal-dialog").addClass("modal-lg modal-thethanhtra");
    }
    if (window.location.pathname.indexOf('report') !== -1) {
        $("#modalForm .modal-dialog").addClass("modal-lg");
    }
    if (window.location.pathname.indexOf('reportunit') !== -1) {
        $("#modalForm .modal-dialog").addClass("modal-lg");
    }
    $(".select2").select2({ allowClear: true });

    $("#playlist li").on("click", function() {
        $("#videoarea").attr({
            "src": $(this).attr("movieurl"),
            "poster": "",
            "autoplay": "autoplay"
        });

        $("#playlist li.selected").removeClass('selected');
        $(this).addClass('selected');
    })

    if ($("#playlist li.selected").length) {
        $("#videoarea").attr({
            "src": $("#playlist li.selected").attr("movieurl"),
            "poster": $("#playlist li.selected").attr("moviesposter")
        });
    } else {
        $("#videoarea").attr({
            "src": $("#playlist li").eq(0).attr("movieurl"),
            "poster": $("#playlist li").eq(0).attr("moviesposter")
        });
    }


});
$(window).resize(function() {
    if (window.innerWidth <= 800) {
        $("body").addClass('sidebar-collapse');
    }
});
$(document).on('click', "a.select-field", function(event) {
    let $inputSearchField = $("input[name  = search_field]");
    event.preventDefault();
    let field = $(this).data('field');
    let fieldName = $(this).html();
    $("button.btn-active-field").html(fieldName + ' <span class="caret"></span>');
    $inputSearchField.val(field);
});
$(document).on('click', "button#btn-search", function(event) {
    let search_field = $("input[name  = search_field]").val();
    let search_value = $("input[name  = search_value]").val();
    if (search_value.replace(/\s/g, "") == "") {
        alert("Nhập vào giá trị cần tìm !!");

    } else {
        event.preventDefault();
        if (window.location.pathname.indexOf('/follow') !== -1) {
            url = flagUrl + "/follow" + "?search_field=" + search_field + "&search_value=" + search_value;
        } else {
            url = flagUrl + "?search_field=" + search_field + "&search_value=" + search_value;
        }

        ajaxLoad(url);
    }
});
$(document).on('click', "button#btn-clear-search", function(event) {
    event.preventDefault();
    if (window.location.pathname.indexOf('/follow') !== -1) {
        url = flagUrl + "/follow" + "?search_field=&search_value=";
    } else {
        url = flagUrl + "?search_field=&search_value=";
    }
    ajaxLoad(url);
});
$(document).on('click', "a.btn-filter", function(event) {
    event.preventDefault();
    $('.loading').show();
    url = $(this).data('href');
    ajaxLoad(url);
});
$(document).on('click', "a[name='btn-thongke']", function(event) {
    event.preventDefault();
    let tuNgay = $("input[name  = tuNgay]").val();
    let denNgay = $("input[name  = denNgay]").val();
    $('.loading').show();
    if (window.location.pathname.indexOf('/follow') !== -1) {
        url = flagUrl + "/follow" + "?filter_tuNgay=" + tuNgay + "&filter_denNgay=" + denNgay;
    } else {
        url = flagUrl + "?filter_tuNgay=" + tuNgay + "&filter_denNgay=" + denNgay;
    }
    console.log(url);
    ajaxLoad(url);
});
$(document).on('click', "a[name='change-status']", function(event) {
    event.preventDefault();
    $('.loading').show();
    url = $(this).data('href');
    $.ajax({
        type: "GET",
        url: url,
        contentType: false,
        success: function(data) {
            $page = $('.page-item.active span').html();
            if ($page != '1') {
                link = '?page=' + $page;
                ajaxLoad(data.redirect_url + link);
            } else {
                ajaxLoad(data.redirect_url);
            }
            $('.loading').hide();
            toastr.success(data.message);
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });
});
$(document).on('change', "select[name='selectDanhMucHoSo']", function(event) {
    event.preventDefault();
    $valueSearch = $("select[name='selectDanhMucHoSo']").val();
    $search_field = 'all';
    $search_value = ''
    url = flagUrl + "?filter_DMHSID=" + $valueSearch + "&search_field=" + $search_field + "&search_value=" + $search_value;
    ajaxLoad(url);
});
$(document).on('select2:unselecting', "select[name = 'selectDanhMucHoSo']", function(event) {
    var opts = $(this).data('select2').options;
    opts.set('disabled', true);
    setTimeout(function() {
        opts.set('disabled', false);
    }, 1);
    $valueSearch = 'all'
    $search_field = 'all';
    $search_value = ''
    url = flagUrl + "?filter_DMHSID=" + $valueSearch + "&search_field=" + $search_field + "&search_value=" + $search_value;
    ajaxLoad(url);
});
$(document).on('change', "select[name='selectToChucThanhTra']", function(event) {
    event.preventDefault();
    $valueSearch = $(this).val();
    $search_field = 'all';
    $search_value = ''
    url = flagUrl + "?filter_toChucThanhTraID=" + $valueSearch + "&search_field=" + $search_field + "&search_value=" + $search_value;
    ajaxLoad(url);
});
$(document).on('select2:unselecting', "select[name = 'selectToChucThanhTra']", function(event) {
    var opts = $(this).data('select2').options;
    opts.set('disabled', true);
    setTimeout(function() {
        opts.set('disabled', false);
    }, 1);
    $valueSearch = 'all'
    $search_field = 'all';
    $search_value = ''
    url = flagUrl + "?filter_toChucThanhTraID=" + $valueSearch + "&search_field=" + $search_field + "&search_value=" + $search_value;
    ajaxLoad(url);
});
$(document).on('change', "select[name='selectToChucThanhTraDS']", function(event) {
    event.preventDefault();
    $valueSearch = $(this).val();
    $search_field = 'all';
    $search_value = ''
    url = flagUrl + '/show-list' + "?filter_toChucThanhTraID=" + $valueSearch + "&search_field=" + $search_field + "&search_value=" + $search_value;
    ajaxLoad(url);
});
$(document).on('select2:unselecting', "select[name = 'selectToChucThanhTraDS']", function(event) {
    var opts = $(this).data('select2').options;
    opts.set('disabled', true);
    setTimeout(function() {
        opts.set('disabled', false);
    }, 1);
    $valueSearch = 'all'
    $search_field = 'all';
    $search_value = ''
    url = flagUrl + '/show-list' + "?filter_toChucThanhTraID=" + $valueSearch + "&search_field=" + $search_field + "&search_value=" + $search_value;
    ajaxLoad(url);
});
$(document).on('input', "input[name='search_value']", function(event) {
    setTimeout(function() {
        if ($("input[name = 'search_value']").val() == '') {
            $("button#btn-clear-search").click();
        }
    }, 0);
});

$(document).on('keypress', "input[name='search_value']", function(event) {
    var keycode = (event.keyCode ? event.keyCode : event.which);
    if (keycode == '13') {
        $("button#btn-search").click();
    }
});
$(document).on('change', "select[name='selectParent']", function(event) {
    event.preventDefault();
    $valueSearch = $("select[name='selectParent']").val();
    url = flagUrl + "?filter_parentID=" + $valueSearch;
    ajaxLoad(url);
});
$(document).on('change', "select[name='selectChangeRole']", function(event) {
    event.preventDefault();
    $value_new = $(this).val();
    $id = $(this).parents('tr').data('id');
    url = flagUrl + "/change-role-" + $value_new + "/" + $id;
    $.ajax({
        type: "GET",
        url: url,
        contentType: false,
        success: function(data) {
            $page = $('.page-item.active span').html();
            if ($page != '1') {
                link = '?page=' + $page;
                ajaxLoad(data.redirect_url + link);
            } else {
                ajaxLoad(data.redirect_url);
            }
            $('.loading').hide();
            toastr.success(data.message);
        },
        error: function(xhr, status, error) {
            alert(xhr.responseText);
        }
    });
    //ajaxLoad(url);
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
$(document).on('ifChecked', '.dataTables_scrollHeadInner .checkAll', function(event) {
    colIndex = $(this).parents('th').index() + 1;
    checkItem = $("#tbFixHeader tbody td:nth-child(" + colIndex + ") input[type='checkbox']");
    checkItem.iCheck('check');
    triggeredByChild = false;
});
$(document).on('ifUnchecked', '.dataTables_scrollHeadInner .checkAll', function(event) {
    if (!triggeredByChild) {
        colIndex = $(this).parents('th').index() + 1;
        checkItem = $("#tbFixHeader tbody td:nth-child(" + colIndex + ") input[type='checkbox']");
        checkItem.iCheck('uncheck');
    }
    triggeredByChild = false;
});
$(document).on('ifUnchecked', '.checkItem', function(event) {
    triggeredByChild = true;
    colIndex = $(this).parents('td').index() + 1;
    checkAll = $(".dataTables_scrollHeadInner thead th:nth-child(" + colIndex + ") .checkAll");
    checkAll.iCheck('uncheck');
});

$(document).on('ifChecked', '.checkItem', function(event) {
    colIndex = $(this).parents('td').index() + 1;
    checkAll = $(".dataTables_scrollHeadInner thead th:nth-child(" + colIndex + ") .checkAll");
    checkItem = $("#tbFixHeader td:nth-child(" + colIndex + ") .checkItem");
    if (checkItem.filter(':checked').length == checkItem.length) {
        checkAll.iCheck('check');
    }
});
$(document).on('change', "input[name='image']", function(event) {
    var file = $(this)[0].files[0];
    var reader = new FileReader();
    reader.readAsDataURL(file);
    reader.onload = function(e) {
        var img = $('#avatarImg');
        img.attr('src', this.result);
    }
})
$(document).on('change', "select[name='toChucThanhTraID']", function(event) {
    toChucThanhTraID = $(this).val();
    getListPhongNghiepVu(toChucThanhTraID);
});

function getListPhongNghiepVu(toChucThanhTraID) {
    var selector = $("select[name='phongNghiepVuID']");
    url = selector.data('href');
    $.get({
        url: url,
        data: { 'toChucThanhTraID': toChucThanhTraID },
        success: function(data) {
            $(selector).empty();
            data = jQuery.parseJSON(JSON.stringify(data.items));
            opt = "<option value=''></option>";
            $.each(data, function(i, val) {
                opt += '<option value="' + i + '">' + val + '</option>';
            });
            $(selector).append(opt);
        }
    });
};
// $(document).on('blur', "input[name='ngayCap']", function (event) {
// 	var date = $(this).val();
// 	console.log(date);
// 	date = date.split('/');
// 	year = parseInt(date[2]);
// 	year = year + 5;
// 	console.log(date);
// 	var ngayHetHan = new Date(parseInt(date[2]) + 5, date[1] - 1, date[0]);
// 	$("input[name='ngayHetHan']").datepicker('setDate', ngayHetHan);
// });
$(document).on('change', "input[name='ngayCap']", function(event) {
    var date = $(this).val();
    date = date.split('/');
    year = parseInt(date[2]);
    year = year + 5;
    console.log(date);
    var ngayHetHan = new Date(parseInt(date[2]) + 5, date[1] - 1, date[0]);
    $("input[name='ngayHetHan']").datepicker('setDate', ngayHetHan);
});
$(document).on('change', "select[name='toChucID']", function(event) {
    var selector = $("select[name='phongBanID']");
    url = selector.data('href');
    toChucID = $(this).val();
    $.get({
        url: url,
        data: { 'toChucID': toChucID },
        success: function(data) {
            console.log(data);
            $(selector).empty();
            data = jQuery.parseJSON(JSON.stringify(data.items));
            opt = "<option value=''></option>";
            $.each(data, function(i, val) {
                opt += '<option value="' + i + '">' + val + '</option>';
            });
            $(selector).append(opt);
        }
    });
});