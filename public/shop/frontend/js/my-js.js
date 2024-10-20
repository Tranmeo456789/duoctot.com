(function($) {
    defaults = {
        formDataKey: "files",
        buttonText: "Add Files",
        buttonClass: "file-preview-button",
        shadowClass: "file-preview-shadow",
        tableCss: "file-preview-table",
        tableRowClass: "file-preview-row",
        placeholderClass: "file-preview-placeholder",
        loadingCss: "file-preview-loading",
        tableTemplate: function() {
            return "<table class='table table-striped file-preview-table' id='file-preview-table'>" +
                "<tbody></tbody>" +
                "</table>";
        },
        rowTemplate: function(options) {
            return "<tr class='" + config.tableRowClass + "'>" +
                "<td>" + "<img src='" + options.src + "' class='" + options.placeholderCssClass + "' />" + "</td>" +
                "<td class='filename'>" + options.name + "</td>" +
                "<td class='filesize'>" + options.size + "</td>" +
                "<td class='remove-file'><button class='btn btn-danger'>&times;</button></td>" +
                "</tr>";
        },
        loadingTemplate: function() {
            return "<div id='file-preview-loading-container'>" +
                "<div id='" + config.loadingCss + "' class='loader-inner ball-clip-rotate-pulse no-show'>" +
                "<div></div>" +
                "<div></div>" +
                "</div>" +
                "</div>";
        }
    }

    if (typeof Humanize == 'undefined' || typeof Humanize.filesize != 'function') {
        $.getScript("https://cdnjs.cloudflare.com/ajax/libs/humanize-plus/1.5.0/humanize.min.js")
    }

    var getFileSize = function(filesize) {
        return Humanize.fileSize(filesize);
    };
    var getFileTypeCssClass = function(filetype) {
        var fileTypeCssClass;
        fileTypeCssClass = (function() {
            switch (true) {
                case /video/.test(filetype):
                    return 'video';
                case /audio/.test(filetype):
                    return 'audio';
                case /pdf/.test(filetype):
                    return 'pdf';
                case /csv|excel/.test(filetype):
                    return 'spreadsheet';
                case /powerpoint/.test(filetype):
                    return 'powerpoint';
                case /msword|text/.test(filetype):
                    return 'document';
                case /zip/.test(filetype):
                    return 'zip';
                case /rar/.test(filetype):
                    return 'rar';
                default:
                    return 'default-filetype';
            }
        })();
        return defaults.placeholderClass + " " + fileTypeCssClass;
    };

    $.fn.uploadPreviewer = function(options, callback) {
        var that = this;

        if (!options) {
            options = {};
        }
        config = $.extend({}, defaults, options);
        var buttonText,
            previewRowTemplate,
            previewTable,
            previewTableBody,
            previewTableIdentifier,
            currentFileList = [];

        if (window.File && window.FileReader && window.FileList && window.Blob) {

            this.wrap("<span class='btn btn-primary " + config.shadowClass + "'></span>");
            buttonText = this.parent("." + config.shadowClass);
            buttonText.prepend("<span><i class='fa fa-arrow-alt-circle-up'></i>" + config.buttonText + "</span>");
            buttonText.wrap("<span class='" + config.buttonClass + "'></span>");

            previewTableIdentifier = options.preview_table;
            if (!previewTableIdentifier) {
                $("span." + config.buttonClass).after(config.tableTemplate());
                previewTableIdentifier = "table." + config.tableCss;
            }

            previewTable = $(previewTableIdentifier);
            previewTable.addClass(config.tableCss);
            previewTableBody = previewTable.find("tbody");

            previewRowTemplate = options.preview_row_template || config.rowTemplate;

            previewTable.after(config.loadingTemplate());

            previewTable.on("click", ".remove-file", function() {
                var parentRow = $(this).parent("tr");
                var filename = parentRow.find(".filename").text();
                for (var i = 0; i < currentFileList.length; i++) {
                    if (currentFileList[i].name == filename) {
                        currentFileList.splice(i, 1);
                        break;
                    }
                }
                parentRow.remove();
                $.event.trigger({ type: 'file-preview:changed', files: currentFileList });
            });

            this.on('change', function(e) {
                var loadingSpinner = $("#" + config.loadingCss);
                loadingSpinner.show();

                var reader;
                var filesCount = e.currentTarget.files.length;
                $.each(e.currentTarget.files, function(index, file) {
                    currentFileList.push(file);

                    reader = new FileReader();
                    reader.onload = function(fileReaderEvent) {
                        var filesize, filetype, imagePreviewRow, placeholderCssClass, source;
                        if (previewTableBody) {
                            filetype = file.type;
                            if (/image/.test(filetype)) {
                                source = fileReaderEvent.target.result;
                                placeholderCssClass = config.placeholderClass + " image";
                            } else {
                                source = "";
                                placeholderCssClass = getFileTypeCssClass(filetype);
                            }
                            filesize = getFileSize(file.size);
                            imagePreviewRow = previewRowTemplate({
                                src: source,
                                name: file.name,
                                placeholderCssClass: placeholderCssClass,
                                size: filesize
                            });

                            previewTableBody.append(imagePreviewRow);

                            if (index == filesCount - 1) {
                                loadingSpinner.hide();
                            }
                        }
                        if (callback) {
                            callback(fileReaderEvent);
                        }
                    };
                    reader.readAsDataURL(file);
                });

                $.event.trigger({ type: 'file-preview:changed', files: currentFileList });
            });

            this.fileList = function() {
                return currentFileList;
            }

            this.clearFileList = function() {
                $('.remove-file').click();
            }

            this.url = function(url) {
                if (url != undefined) {
                    config.url = url;
                } else {
                    return config.url;
                }
            }

            this._onComplete = function(eventData) {
                eventData['type'] = 'file-preview:submit:complete'
                $.event.trigger(eventData);
            }

            this.submit = function(successCallback, errorCallback) {
                if (config.url == undefined) throw ('Please set the URL to which I shall post the files');

                if (currentFileList.length > 0) {
                    var filesFormData = new FormData();
                    currentFileList.forEach(function(file) {
                        filesFormData.append(options.formDataKey + "[]", file);
                    });

                    $.ajax({
                        type: "POST",
                        url: config.url,
                        data: filesFormData,
                        contentType: false,
                        processData: false,
                        xhr: function() {
                            var xhr = new window.XMLHttpRequest();
                            xhr.upload.addEventListener("progress", function(evt) {
                                if (evt.lengthComputable &&
                                    options != null &&
                                    options.uploadProgress != null &&
                                    typeof options.uploadProgress == "function") {
                                    options.uploadProgress(evt.loaded / evt.total);
                                }
                            }, false);
                            return xhr;
                        },
                        success: function(data, status, jqXHR) {
                            if (typeof successCallback == "function") {
                                successCallback(data, status, jqXHR);
                            }
                            that._onComplete({ data: data, status: status, jqXHR: jqXHR });
                        },
                        error: function(jqXHR, status, error) {
                            if (typeof errorCallback == "function") {
                                errorCallback(jqXHR, status, error);
                            }
                            that._onComplete({ error: error, status: status, jqXHR: jqXHR });
                        }
                    });
                } else {
                    console.log("There are no selected files, please select at least one file before submitting.");
                    that._onComplete({ status: 'no-files' });
                }
            }

            return this;

        } else {
            throw "The File APIs are not fully supported in this browser.";
        }
    };
})(jQuery);
$(document).ready(function() {
    $('.js-select2').select2();
    $('.ol1').click(function() {
        $(this).addClass("activebtn");
        $('.ol2').removeClass("activebtn");
        $('#body-nbox').removeClass("product-horizontal");
    });
    $('.ol2').click(function() {
        $(this).addClass("activebtn");
        $('#body-nbox').addClass("product-horizontal");
        $('.ol1').removeClass("activebtn");
    });
    $('.btn-closenk').click(function() {
        $('.form-login').css("display", "none");
        $('.form-search-product').css("display", "none");
        $('.black-screen').css("display", "none");
        $('#container').removeClass("fixed-hbd");
        $('#fixscreen-respon').css("display", "none");
    });
    $('.btn-login').click(function() {
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
    $('#check-rules').click(function() {
        if ($(this).prop("checked") == true) {
            $('#dang-ky #btn-register').prop("disabled", false);
        } else if ($(this).prop("checked") == false) {
            $('#dang-ky #btn-register').prop("disabled", true);
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
        $('#fixscreen-respon').css("display", "block");
        $('#head-body-respon').addClass("slider");

    });
    
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

    $('.catc1').hover(
        function() {
            var $this = $(this);
            $this.data('timeout', setTimeout(function() {
                $('.black-content').css("display", "block");
                $('.lc-mask-search').css({
                    "opacity": 0,
                    "visibility": "hidden"
                });
                $('.ls-history').css("display", "none");
                $this.find('.content-submenu').css("display", "block");
            }, 100));
        },
        function() {
            var $this = $(this);
            clearTimeout($this.data('timeout'));
            $('.black-content').css("display", "none");
            $this.find('.content-submenu').css("display", "none");
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
function isEmail(value) {
    var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    return regex.test(value);
}

function isPhoneNumberVN(value) {
    var flag = false;
    var phone = value.trim(); // ID của trường Số điện thoại
    phone = phone.replace('(+84)', '0');
    phone = phone.replace('+84', '0');
    phone = phone.replace('0084', '0');
    phone = phone.replace(/ /g, '');
    if (phone != '') {
        var firstNumber = phone.substring(0, 2);
        if ((firstNumber == '09' || firstNumber == '08' || firstNumber == '07' || firstNumber == '05' || firstNumber == '03') && phone.length == 10) {
            if (phone.match(/^\d{10}/)) {
                flag = true;
            }
        } else if (firstNumber == '02' && phone.length == 11) {
            if (phone.match(/^\d{11}/)) {
                flag = true;
            }
        }
    }
    return flag;
}
jQuery.validator.addMethod("isProductSelect",
    function() {
        var flag = false;
        numProductSelect=$('.ls-product-select-prescrip li').length;
        if(numProductSelect > 0){
            flag = true;
        }
        return flag;
    }
);
$.validator.methods.checkEmail = function (value, element, param) {
    return (value.trim() == '') || (isEmail(value.trim()));
};
$.validator.methods.checkPhone = function (value, element, param) {
    return isPhoneNumberVN(value.trim());
};
$.validator.methods.checkPhoneOrEmail = function (value, element, param) {
    return isEmail(value.trim()) || isPhoneNumberVN(value.trim());
};

$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});
$(document).ready(function () {
    if ($("input[name='albumImage[]']").length) {
        myUploadImage = $("input[name='albumImage[]']").uploadPreviewer({
            buttonText: "Thêm ảnh",
        });
    }
    if (($(".file-preview-table").length > 0) &&
        ($(".file-preview-table").find('td').length == 0)) {
        $(".file-preview-table").css({
            "margin-top": "0px",
            "margin-bottom": "0px"
        });
    }
    //  Cat hover
    $('.cat1name').hover(
        function() {
            var idCatLevel1 = $(this).attr('data-id');
            var _token = $('input[name="_token"]').val();
            var url=$(this).attr('data-href');
            $.ajax({
                url: url,
                cache: false,
                method: "GET",
                dataType: 'html',
                data: {
                    idCatLevel1: idCatLevel1,
                    _token: _token,
                },
                success: function(data) {
                    $('.list_cat_level3_products').html(data);
                    $('.sub-menu1>li').removeClass('active-menucat2');
                    $('.sub-menu1>li:first-child').addClass('active-menucat2');
                },
            }); 
        },
        function(){
            
        }
    );
    $('.sub-menu1>li').hover(
        function() {
            $('.sub-menu1>li').removeClass('active-menucat2');
            $(this).addClass('active-menucat2');
            var idCatLevel2 = $(this).attr('data-id');
            var _token = $('input[name="_token"]').val();
            var url=$(this).attr('data-href');
            $.ajax({
                url: url,
                cache: false,
                method: "GET",
                dataType: 'html',
                data: {
                    idCatLevel2: idCatLevel2,
                    _token: _token,
                },
                success: function(data) {
                    $('.list_cat_level3_products').html(data);
                
                },
            }); 
        },
        function(){
            
        }
    );
//end Cat
    $(".select2").select2();
    function startRotateEffect() {
        $(".rotate-effect").css("visibility", "visible").addClass("animate__animated animate__rotateIn");
        $(".overlay").show();
    }
    
    function stopRotateEffect() {
        $(".rotate-effect").removeClass("animate__animated animate__rotateIn").css("visibility", "hidden");
        $(".overlay").hide();
    }
    $(".user-register").validate({
        rules: {
            fullname: "required",
            email: {
                required: true,
                checkPhoneOrEmail: true,
            },
            password: {
                required: true,
                minlength: 6
            },
        },
        messages: {
            fullname: "Bạn chưa nhập Họ tên",
            email: {
                required: "Nhập số điện thoại hoặc email",
                checkPhoneOrEmail: "Số điện thoại / Email không đúng định dạng"
            },
            password: {
                required: "Bạn cần nhập mật khẩu",
                minlength: "Mật khẩu tối thiểu 6 ký tự"
            },
        },
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");
            element.closest(".input-group").addClass('has-error');
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.next("label"));
            } else {
                error.insertAfter(element.closest(".input-group"));
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
            $(element).closest(".input-group").removeClass('has-error');
        },
        submitHandler: function (form) {
            startRotateEffect();
            $.ajax({
                url: form.action,
                method: form.method,
                data: $(form).serialize(),
                success: function (response) {
                    if (response.success) {
                        $(".loading-text").text("Đang đăng ký...");
                        alert('Đăng ký thành công!');
                       // window.location.href = response.redirect_url;
                        location.reload();
                    } else {
                        stopRotateEffect();
                        alert('Kiểm tra lại thông tin đã tồn tại, vui lòng thử lại');
                    }
                }
            });
        }
    });
    $(".user-login").validate({
        rules: {
            email: {
                required: true,
                checkPhoneOrEmail: true,
            },
            password: {
                required: true,
                minlength: 6
            },
        },
        messages: {
            email: {
                required: "Nhập số điện thoại hoặc email",
                checkPhoneOrEmail: "Số điện thoại / Email không đúng định dạng"
            },
            password: {
                required: "Bạn cần nhập mật khẩu",
                minlength: "Mật khẩu tối thiểu 6 ký tự"
            },
        },
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".input-group").addClass('has-error');
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.next("label"));
            } else {
                error.insertAfter(element.closest(".input-group"));
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
            $(element).closest(".input-group").removeClass('has-error');
        },
        submitHandler: function (form) {
            startRotateEffect();  
            $.ajax({
                url: form.action,
                method: form.method,
                data: $(form).serialize(),
                success: function (response) {        
                    if (response.success) {
                         $(".loading-text").text("Đang đăng nhập...");
                        //window.location.href = response.redirect_url;
                        location.reload();
                    } else {
                        if (response.errors && response.errors.authentication) {
                            stopRotateEffect();
                            alert(response.errors.authentication);
                        } else {
                            // Xử lý lỗi khác nếu cần
                        }
                    }
                },
                error: function (error) {
                    stopRotateEffect(); 
                }
            });
        }
    });
    $(".order-complete").validate({
        ignore: ".ignore",
        rules: {
            "buyer[fullname]": {
                required: true,
            },
            "buyer[phone]": {
                required: true,
                checkPhone: true,
            },
            "receive[fullname]": {
                required: true
            },
            "receive[phone]": {
                required: true,
                checkPhone: true
            },
            "receive[province_id]": {
               // required: true
            },
            "receive[district_id]": {
                //required: true
            },
            "receive[ward_id]": {
               // required: true
            },
            "receive[address]": {
                required: true
            },
        },
        messages: {
            "buyer[fullname]": {
                required: "Thông tin bắt buộc",
            },
            "buyer[phone]": {
                required: "Thông tin bắt buộc",
                checkPhone: "Số điện thoại không đúng định dạng",
            },
            "buyer[email]": {
                checkEmail: "Email không đúng định dạng",
            },
            "invoice[name]": {
                required: "Thông tin bắt buộc",
            },
            "invoice[phone]": {
                required: "Thông tin bắt buộc",
                checkPhone: "Số điện thoại không đúng định dạng",
            },
            "invoice[tax_code]": {
                required: "Thông tin bắt buộc"
            },
            "invoice[address]": {
                required: "Thông tin bắt buộc"
            },
            warehouse_id: {
                required: "Thông tin bắt buộc"
            },
            "receive[fullname]": {
                required: "Thông tin bắt buộc"
            },
            "receive[phone]": {
                required: "Thông tin bắt buộc",
                checkPhone: "Số điện thoại không đúng định dạng",
            },
            "receive[province_id]": {
                required: "Thông tin bắt buộc"
            },
            "receive[district_id]": {
                required: "Thông tin bắt buộc"
            },
            "receive[ward_id]": {
                required: "Thông tin bắt buộc"
            },
            "receive[address]": {
                required: "Thông tin bắt buộc"
            }
        },
        errorPlacement: function (error, element) {
            error.addClass("invalid-feedback");
            element.closest(".wp-input").addClass('has-error');                  
            error.insertAfter(element.closest(".wp-input"));          
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
            $(element).closest(".wp-input").removeClass('has-error');
        },
        submitHandler: function (form) {
            $(".loading-text").text("Đang đặt hàng...");
            startRotateEffect();
            $.ajax({
                url: form.action,
                method: form.method,
                data: $(form).serialize(),
                success: function (response) {
                    if (response.fail === false) {
                        window.location.href = response.redirect_url;
                    } else {
                        stopRotateEffect();
                        alert('Kiểm tra lại thông tin, vui lòng thử lại');
                    }
                },
                error: function (error) {
                    stopRotateEffect(); // Xử lý lỗi AJAX nếu cần
                }
            });
        }
    });
    $(".form-main-prescrip").validate({
        ignore: ".ignore",
        rules: {
            "buyer[fullname]":{
                required: true,
            },
            "buyer[phone]": {
                required: true,
                checkPhone: true,
            },
            number_product:{
                isProductSelect: true,
            },
            province_id:{
                required: true,
            },
            district_id:{
                required: true,
            },
            ward_id:{
                required: true,
            },
            address:{
                required: true,
            },    
        },
        messages: {
            "buyer[fullname]": "Thông tin bắt buộc",
            "buyer[phone]": {
                required: "Thông tin bắt buộc", 
                checkPhone: "Số điện thoại không đúng định dạng",             
            },
            number_product:{
                isProductSelect: "Vui lòng chọn thêm thuốc"
            },
            province_id:{
                required:"Thông tin bắt buộc",
            },
            district_id:{
                required: "Thông tin bắt buộc",
            },
            ward_id:{
                required: "Thông tin bắt buộc",
            },
            address:{
                required: "Thông tin bắt buộc",
            },                             
        },
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");
            element.closest(".wp-input").addClass('has-error');                  
            error.insertAfter(element.closest(".wp-input"));          
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
            $(element).closest(".wp-input").removeClass('has-error');
        }
    });
    $(".form-search-phone-order").validate({
        ignore: ".ignore",
        rules: {
            phone: {
                required: true,
                checkPhone: true,
            }
        },
        messages: {
            phone: {
                required: "Nhập số điện thoại",
                checkPhone: "Số điện thoại không đúng định dạng"
            }
        },
        errorPlacement: function (error, element) {
            // Add the `invalid-feedback` class to the error element
            error.addClass("invalid-feedback");
            element.closest(".input-group").addClass('has-error');
            if (element.prop("type") === "checkbox") {
                error.insertAfter(element.next("label"));
            } else {
                error.insertAfter(element.closest(".input-group"));
            }
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass("is-invalid").removeClass("is-valid");
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).addClass("is-valid").removeClass("is-invalid");
            $(element).closest(".input-group").removeClass('has-error');
        }
    });
    $("#content-slider").lightSlider({
        loop: true,
        keyPress: true
    });
    $('#image-gallery').lightSlider({
        gallery: true,
        item: 1,
        thumbItem: 4,
        slideMargin: 0,
        speed: 500,
        auto: false,
        loop: true,
        onSliderLoad: function() {
            $('#image-gallery').removeClass('cS-hidden');
        }
    });
    $('#image-gallery').on('click', function() {
        slider.pause();
    });
    $('.banner_doitac').lightSlider({
        item: 1,
        slideMargin: 0,
        speed: 500,
        auto: true,
        loop: true,
        pager: false,
        onSliderLoad: function() {
            $('.banner_doitac').removeClass('cS-hidden');
        }
    });
    $('#feature-product-wp .list-item').lightSlider({
        item: 5, // Giá trị tối đa cho màn hình lớn
        slideMargin: 5,
        speed: 500,
        auto: false,
        loop: true,
        pager: false,
        responsive: [
            {
                breakpoint: 1000,
                settings: {
                    item: 5,
                }
            },
            {
                breakpoint: 800,
                settings: {
                    item: 4,
                }
            },
            {
                breakpoint: 600,
                settings: {
                    item: 2,
                }
            },
            {
                breakpoint: 375,
                settings: {
                    item: 2,
                }
            }
        ]
    });
    
});
$(document).on('submit', "#main-form", function (event) {
    event.preventDefault();
    url = $(this).attr("action");
    method = $(this).attr('method');
    data = new FormData($(this)[0]);
    $.ajax({
        type: method,
        url: url,
        data: data,
        cache: false,
        contentType: false,
        processData: false,
        success: function (response) {
            if (response.success == false) {
                if (response.error != null) {
                    for (control in response.errors) {
                        eleError = "<label id='" + control + "-error' class='error invalid-feedback' for='" + control + "' style='display:inline-block'>" + response.errors[control] + "</label>";
                        $('[name=' + control + ']').closest(".form-group").find("label[for='" + control + "']").remove();
                        $('[name=' + control + ']').closest(".input-group").addClass('has-error').after(eleError);
                        $('[name=' + control + ']').addClass("is-invalid").removeClass('is-valid');
                    }
                } else {
                    alert(response.message);
                }
            } else {
                alert(response.message);
                window.location.replace(response.redirect_url);
            }
        },
        error: function (xhr, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
        }
    });
});
$(document).on('click', ".changeTypePassword", function (event) {
    parent = $(this).parents('.form-group');
    parent.toggleClass('open');
    if (parent.hasClass('open')) {
        parent.find("input[name='password']").attr('type', 'text');
        $(this).html("<i class='fa fa-eye-slash'></i>");
    } else {
        parent.find("input[name='password']").attr('type', 'password');
        $(this).html("<i class='fa fa-eye'></i>");
    }
});
$(document).on('click', ".cat-content .list-content-product li a", function (event) {
    $('.cat-content .list-content-product li a').removeClass("active-ndsp");
    $(this).addClass("active-ndsp");
});
function visible_cart_respon() {
    $('.dropdown_cart').css("opacity", 1);
    $('.dropdown_cart').css("visibility", "visible");
    $('.black-res-screen').css("display", "block");
    $('.fix1screen').css("display", "block");
}
$(document).on('click', '.btn-select-buy', function (event) {
    if ($(window).width() > 1200) {
        $('body,html').stop().animate({
            scrollTop: 0
        }, 800);
    }
    var _token = $('input[name="_token"]').val();
    var quantity = $('input[name="qty_product"]').val();
    var total_product = $('.hrcart .number_cartmenu').text();
    total_product = Number(total_product) + Number(quantity);
    $('.hrcart .number_cartmenu').text(total_product);
    var product_id = $('#product_id').val();
    var user_sell = $('#user_sell').val();
    var codeRef = $('#code_ref').val();
    url = $(this).data('href');
    $.ajax({
        url: url,
        method: 'POST',
        cache: false,
        dataType: 'html',
        data: {
            product_id: product_id,
            quantity: quantity,
            user_sell: user_sell,
            codeRef: codeRef,
            _token: _token,
        },
        success: function (data) {
            $(".dropdown-cart-info").html(data);
            $(".wp-cart-res").html(data);
            $(".dropdown-cart").css({ 'opacity': 1, 'visibility': 'visible' });
            if ($(window).width() < 1200) {
                visible_cart_respon();
            }
            setTimeout(function () {
                $(".dropdown-cart-info .dropdown-cart").removeAttr('style');
            }, 3000);
        },
    });
});
$(document).on('click', ".close-cart", function (event) {
    $('.dropdown_cart').css("opacity", 0);
    $('.dropdown_cart').css("visibility", "hidden");
    $('.black-res-screen').css("display", "none");
    $('.fix1screen').css("display", "none");
});
$(document).on('change', "select.get_child", function (event) {
    event.preventDefault();
    url = $(this).data('href');

    target = $(this).data('target');
    $selectValue = $(this).val();

    if (($selectValue == '') && (url != '') && (url.indexOf('value_new') !== -1)) {
        options = $(target).find('option')[0].outerHTML;
        $(target).html(options);
        $(target).trigger("change");
    } else {
        url = url.replace('value_new', $selectValue);
        let addtion = $(this).data('addtion');
        if (addtion !== undefined) {
            addtion = addtion.split('|');
            addtion.forEach(function (elem, index) {
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
            success: function (data) {
                options = '';
                if ($(target + " option").length > 0) {
                    options = $(target).find('option')[0].outerHTML;
                }
                $.each(data, function (id, item) {
                    options += "<option value= '" + id + "'>" + item + "</option>";
                });

                $(target).html(options);
                if ($(target).hasClass('get_data')) $(target).trigger("change");
                if ($(target).hasClass('get_child')) $(target).trigger("change");
            },
            error: function (xhr, textStatus, errorThrown) {
                alert("Error: " + errorThrown);
            }
        });
    }
});
$(document).on('change', "select.get_data", function (event) {
    event.preventDefault();
    let selectValue = $(this).val();
    target = $(this).data('target');
    let url = $(this).data('href');

    url = url.replace('value_new', selectValue);

    let addtion = $(this).data('addtion');
    if (addtion !== undefined) {
        addtion = addtion.split('|');
        addtion.forEach(function (elem) {
            elemValue = $('#' + elem).val();
            url += "&filter_" + elem + "=" + elemValue;
        });
    }

    $.get({
        url: url,
        cache: false,
        dataType: 'html',
        success: function (data) {
            $(target).html(data);
        },
        error: function (xhr, textStatus, errorThrown) {
            alert("Error: " + errorThrown);
        }
    });


});
$(document).on('change', "input.number-product", function (event) {
    $value = $(this).val();
    var moneyShip= $('input[name="money_ship"]').val();
    var moneyShip = parseInt(moneyShip, 10);
    url = $(this).data('href');
    if (url) {
        url = url.replace('value_new', $value);
        $current = $(this);
        
        $.post({
            url: url,
            headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
            cache: false,
            dataType: 'json',
            success: function (data) {
                $parent = $($current).parents('.item-product');
                product_id = $parent.data('id');
                $($parent).find('.price').html(data.product[product_id]['price'].toLocaleString("vi-VN"));
                $($parent).find('.money').html(data.product[product_id]['total_money'].toLocaleString("vi-VN"));

                if (($parent.parents('.dropdown-cart').length > 0) && ($(".info-product-cart").length > 0)) { //Thay đổi trên menu
                    if ($(".info-product-cart").find(".item-product[data-id=" + product_id + "]").length > 0) {
                         $(".info-product-cart").find('.total_product').html(data.total_product);
                         product = $(".info-product-cart").find(".item-product[data-id=" + product_id + "]");
                         $(product).find('.price').html(data.product[product_id]['price'].toLocaleString("vi-VN"));
                         $(product).find('.number-product').val($value);
                         $(product).find('.money').html(data.product[product_id]['total_money'].toLocaleString("vi-VN"));
                    }
                } else {
                    $(".info-product-cart").find('.total_product').html(data.total_product);
                }

                //Cập nhật cho menu giỏ hàng
                $seller = $(".dropdown-cart").find(".user-seller-" + data.user_sell);
                $product = $seller.find('.item-product-' + product_id);
                $old_qty = parseInt($product.find('.number-product').val());
                $product.find('.number-product').val($value);
                $product.find('.money').html(data.product[product_id]['total_money'].toLocaleString("vi-VN"));
                $new_qty = parseInt($value);
                $total_product = parseInt($(".number_cartmenu").html());
                $(".number_cartmenu").html($total_product - $old_qty + $new_qty);
                //tổng thanh toán
                 if (($("input[name=user_sell]").length > 0) && ($("input[name=user_sell]").val() == data.user_sell)) {
                     $(".col-right-cart").find(".total").html(data.total.toLocaleString("vi-VN"));
                     $(".col-right-cart").find(".total_thanh_toan").html((data.total+moneyShip).toLocaleString("vi-VN"));
                     $(".info-payment-ck").find(".total_thanh_toan").html((data.total+moneyShip).toLocaleString("vi-VN"));
                 }
            },
            error: function (xhr, textStatus, errorThrown) {
                alert("Error: " + errorThrown);
            }
        })
    };
});
$(document).on('change', "input[name='delivery_method']", function (event) {
    event.preventDefault();
    $value = $(this).val();
    if ($value == 1) {
        $(".rowPharmacy").removeClass('d-none');
        $(".rowHome").addClass('d-none');
        $("input[name='receive[address]']").addClass('ignore');
        $("select[name='receive[province_id]']").addClass('ignore');
        $("select[name='receive[ward_id]']").addClass('ignore');
        $("select[name='receive[district_id]']").addClass('ignore');
    } else {
        $(".rowPharmacy").addClass('d-none');
        $(".rowHome").removeClass('d-none');
        $("input[name='receive[address]']").removeClass('ignore');
        $("select[name='receive[province_id]']").removeClass('ignore');
        $("select[name='receive[ward_id]']").removeClass('ignore');
        $("select[name='receive[district_id]']").removeClass('ignore');
    }
});
$(document).on('change', "input[name='payment']", function (event) {
    event.preventDefault();
    $value = $(this).val();
    if ($value == 1) {
        $(".info-payment-ck").addClass('d-none');
    } else {
        $(".info-payment-ck").removeClass('d-none');
    }
});
$(document).on('change', "#export_tax", function (event) {
    event.preventDefault();
    $value = $(this).val();
    if ($(this).is(":checked")) {
        $(".rowInovice").removeClass('d-none');
        valueObject = $("input[name='invoice[object]']:checked").val();
        if (valueObject == 1) { //Công ty
            $("input[name='invoice[name]']").attr('placeholder', 'Nhập tên công ty');
            $("input[name='invoice[phone]']").parents('.col-4').addClass('d-none');
            $("input[name='invoice[tax_code]']").removeClass('.ignore');
            $("input[name='invoice[phone]']").addClass('.ignore');
            $("input[name='invoice[tax_code]']").parents('.col-4').removeClass('d-none');
        } else {
            $("input[name='invoice[tax_code]']").addClass('.ignore');
            $("input[name='invoice[phone]']").removeClass('.ignore');
            $("input[name='invoice[name]']").attr('placeholder', 'Nhập Họ tên');
            $("input[name='invoice[tax_code]']").parents('.col-4').addClass('d-none');
            $("input[name='invoice[phone]']").parents('.col-4').removeClass('d-none');
        }
        $("input[name='invoice[name]']").removeClass('.ignore');
        $("input[name='invoice[address]']").removeClass('.ignore');
    } else {
        $("input[name='invoice[name]']").addClass('.ignore');
        $("input[name='invoice[phone]']").addClass('.ignore');
        $("input[name='invoice[tax_code]']").addClass('.ignore');
        $("input[name='invoice[address]']").addClass('.ignore');
        $(".rowInovice").addClass('d-none');
    }
});
$(document).on('change', "input[name='invoice[object]']", function (event) {
    event.preventDefault();
    $value = $(this).val();
    if ($value == 1) { //Công ty
        $("input[name='invoice[name]']").attr('placeholder', 'Nhập tên công ty');
        $("input[name='invoice[phone]']").parents('.col-4').addClass('d-none');
        $("input[name='invoice[tax_code]']").parents('.col-4').removeClass('d-none');
        $("input[name='invoice[tax_code]']").removeClass('.ignore');
        $("input[name='invoice[phone]']").addClass('.ignore');
    } else {
        $("input[name='invoice[name]']").attr('placeholder', 'Nhập Họ tên');
        $("input[name='invoice[tax_code]']").parents('.col-4').addClass('d-none');
        $("input[name='invoice[phone]']").parents('.col-4').removeClass('d-none');
        $("input[name='invoice[tax_code]']").addClass('.ignore');
        $("input[name='invoice[phone]']").removeClass('.ignore');
    }

});
$(document).on('click', ".view-btn-add-product", function (event) {
    var offset = parseInt($(this).attr("data-offset"));
    var url = $(this).attr("data-href");
    var _token = $('input[name="_token"]').val();
    var type = $(this).attr("data-type");
    var object = $(this).attr("data-object");
    var orderBy = $(this).attr("data-orderby");
    var idCat = $(this).attr("data-idcat");
    var currentElement = $(this); 
    var currentCount = parseInt($(this).find(".visibility-number-product").text().trim());
    if (currentCount - 20 < 1) {
        $(".view-btn-add-product").hide();
    }
    var trademarkCheckboxes = $(this).closest(".box-filter-advanced").find('input[name="list_trademark[]"]:checked');
    var listTrademarkId = [];
    trademarkCheckboxes.each(function() {
        listTrademarkId.push($(this).val());
    });
    var countryCheckboxes = $(this).closest(".box-filter-advanced").find('input[name="list_country[]"]:checked');
    var listCountryId = [];
    countryCheckboxes.each(function() {
        listCountryId.push($(this).val());
    });
    $.ajax({
        url: url,
        cache: false,
        method: "GET",
        dataType: 'html',
        data: {
            offset: offset,
            type: type,
            object: object,
            orderBy: orderBy,
            idCat: idCat,
            listTrademarkId:listTrademarkId,
            listCountryId: listCountryId,
            _token: _token,
        },
        success: function(data) {
            currentElement.find(".visibility-number-product").text(function(index, text) {
                return Math.max(parseInt(text) - 20, 0);
            });
            offset += 20;
            currentElement.attr("data-offset", offset);
            var listProductContainer = currentElement.closest('.parent-btn-view-add').find('ul.ls_product-view-add');
            listProductContainer.append(data);
        },
    }); 
});
$(document).on('click', ".btnFilterProductInHome", function (event) {
    $('.slect-item-customer').removeClass("active-slect");
    $(this).addClass("active-slect");
    var object_product = $(this).attr("data-object") || null;
    var type = $(this).attr("data-type") || null;
    var productByObject = $(this).closest("#product-by-object");
    productByObject.find(".view-btn-add-product").attr("data-object", object_product);
    productByObject.find(".view-btn-add-product").attr("data-offset", 10);
    var url = $(this).attr("data-href");
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: url,
        cache: false,
        method: "GET",
        dataType: 'html',
        data: {
            object_product: object_product,
            _token: _token
        },
        success: function (data) {
            $('#product-by-object').html(data);
        },
    });
});
$(document).on('click', ".btnFilterProductInCat", function (event) {
    $('.slect-item-customer').removeClass("active-slect");
    $(this).addClass("active-slect");
    var productCat = $(this).closest("#wp-product-cat");
    productCat.find(".view-btn-add-product").attr("data-orderby", orderby_product);
    productCat.find(".view-btn-add-product").attr("data-offset", 20);
    var productByObject = $(this).closest("#wp-product-cat");
    $(".btnFilterProductInCat").attr("data-orderby", orderby_product);
    var orderby_product = $(this).attr("data-orderby") || null;
    var type = $(this).attr("data-type") || null;
    var idCat = $(this).attr("data-idcat") || null;
    var url = $(this).attr("data-href");
    var _token = $('input[name="_token"]').val();
    var trademarkCheckboxes = $(this).closest(".box-filter-advanced").find('input[name="list_trademark[]"]:checked');
    var listTrademarkId = [];
    trademarkCheckboxes.each(function() {
        listTrademarkId.push($(this).val());
    });
    var countryCheckboxes = $(this).closest(".box-filter-advanced").find('input[name="list_country[]"]:checked');
    var listCountryId = [];
    countryCheckboxes.each(function() {
        listCountryId.push($(this).val());
    });
    $('#modalFilter').modal('hide');
    $.ajax({
        url: url,
        cache: false,
        method: "GET",
        dataType: 'html',
        data: {
            orderby_product: orderby_product,
            type: type,
            idCat: idCat,
            listTrademarkId: listTrademarkId,
            listCountryId: listCountryId,
            _token: _token
        },
        success: function (data) {
            $('#body-nbox').html(data);
        },
    });
});
$(document).on('click', ".select-status-order", function (event) {
    var status = $(this).attr("data-status");
    var url = $(this).attr("data-href");
    var phone = $(this).attr("data-phone");
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: url,
        cache: false,
        method: "GET",
        dataType: 'html',
        data: {
            status: status,
            phone: phone,
            _token: _token
        },
        success: function(data) {
            $('.table-order-frontend').html(data);
        },
    }); 
});
$(document).on('click', ".view-detail-order", function (event) {
    $('.wp-detail-order').css("display", "block");
    $('.black-screen').css("display", "block");
    //$('#container').addClass("fixed-hbd");
    var id = $(this).attr("data-id");
    var url = $(this).attr("data-href");
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: url,
        cache: false,
        method: "GET",
        dataType: 'html',
        data: {
            id: id,
            _token: _token,
        },
        success: function(data) {
            $('.wp-detail-order').html(data);
        },
    }); 
});
$(document).on('click', ".btn-closenk", function (event) {
    $('.wp-detail-order').css("display", "none");
    $('.black-screen').css("display", "none");
    $('.titlek').removeClass("fixed-hbd");
   
});
$(document).on('click', "#btn-searchorder", function (event) {
    if($('.ls-product-select li').length > 0){
        listProduct=$('.ls-product-select').html();
        $('.ls-product-select-prescrip').html(listProduct);
        $('.ls-product-select-prescrip').css("display", "block");
        $('.form-search-product').css("display", "none");
        $('.black-screen').css("display", "none");
        $('#container').removeClass("fixed-hbd");
        $('#fixscreen-respon').css("display", "none");
        $('.title-list-select').text("Tên thuốc đã nhập:");
        user_sell=$('#name-store').val();
        $('input[name="user_sell"]').val(user_sell);
    }
});
$(document).on('click', '.plus', function () {
    qty = parseInt($(this).parents('.input-group').find('.number-product').val()) + 1;
    $(this).parents('.input-group').find('.number-product').val(qty);
    $(this).parents('.input-group').find('.number-product').change();
});
$(document).on('click', '.minus', function () {
    var numberProduct = parseInt($(this).parents('.input-group').find('.number-product').val());
    if(numberProduct <= 1) {
        qty=1;
    }else{
        qty = parseInt($(this).parents('.input-group').find('.number-product').val()) - 1;
        $(this).parents('.input-group').find('.number-product').val(qty);
        $(this).parents('.input-group').find('.number-product').change();
    }
});
$(document).on('input', '.number-product', function () {
    var inputValue = $(this).val();
    if (isNaN(inputValue)) {
        $(this).val(1);
    } else {
        if (inputValue < 1) {
            $(this).val(1);
        } else if (inputValue > 999) {
            $(this).val(999);
        }
    }
});
$(document).on('click', '.delele-item-in-cart', function () {

    url = $(this).data('href');
    $.get({
        url: url,
        cache: false,
        dataType: 'html',
        success: function (data) {
            window.location.reload();
        },
        // error: function (xhr, textStatus, errorThrown) {
        //     alert("Error: " + errorThrown);
        // }
    });
});
$(document).on('keyup', ".search-product-keyup", function (event) {
    var keyword = $(this).val();
    if(keyword=='' || keyword[0]==' '){
        $('.ls-product-search').html("<div class='mb-3 rimg-center'><img src='images/shop/pescrip5.png'></div>");
    }else{
        var url = $(this).attr("data-href");
        var _token = $('input[name="_token"]').val();
        var user_sell = $('#name-store').val();
        $.ajax({
            url: url,
            cache: false,
            method: "GET",
            dataType: 'html',
            data: {
                keyword: keyword,
                user_sell: user_sell,
                _token: _token
             },
            success: function(data) {
                $('.ls-product-search').html(data);
            },
            }); 
    }      
});
$(document).on('click', ".btn-add-item", function (event) {
    $('.ls-product-select').css("display", "block");
    var id = $(this).attr("data-id");
    rowCurrent = $(this).closest('.item-search');
    rowCurrent.remove();
    temp=$('.ls-product-select li').length+1;     
    nameProduct=rowCurrent.find('.name-product').text();
    $('.title-list-select').text("Tên thuốc đã nhập: ");
    itemSelect="<li class='item-select'><div class='d-flex'><div class='wp-10 text-center number_select'>"+temp+"</div><div class='wp-70 text-left'>"+nameProduct+"</div><div class='wp-20  text-center'><div class='btn'><input type='hidden'  name='info_product["+id+"]' value='"+nameProduct+"'><span class='btn-remove'>Xóa</span></div></div></div></li>";
    $('.ls-product-select').append(itemSelect); 
});
$('.addy-product').click(function() {
    const position = $("#form-search-product").offset().top;
    $("HTML, BODY").animate({ scrollTop: position }, 200);
    $('.form-search-product').css("display", "block");
    $('.black-screen').css("display", "block");
    $('#container').addClass("fixed-hbd");
});
$(document).on('click', ".ls-product-select .btn-remove", function (event) {
    if($('.ls-product-select li').length ==1){
        $('.title-list-select').text("");
        $('.ls-product-select').css("display", "none");
    }
    numLast=$('.ls-product-select li').length;
    rowCurrent = $(this).closest('.item-select');
    rowCurrent.remove();
    indexCurent=rowCurrent.find('.number_select').text();
    listItemSelect=document.querySelectorAll('.ls-product-select li.item-select');
    for(let i=0; i< listItemSelect.length; i++) { 
        listItemSelect[i].querySelector('.number_select').innerText=i+1;    
    }
});
$(document).on('click', ".ls-product-select-prescrip .btn-remove", function (event) {
    if($('.ls-product-select-prescrip li').length ==1){
        $('.title-list-select').text("");
        $('.ls-product-select-prescrip').css("display", "none");
    }
    numLast=$('.ls-product-select-prescrip li').length;
    rowCurrent = $(this).closest('.item-select');
    rowCurrent.remove();
    indexCurent=rowCurrent.find('.number_select').text();
    listItemSelect=document.querySelectorAll('.ls-product-select-prescrip li.item-select');
    
    for(let i=0; i< listItemSelect.length; i++) { 
        listItemSelect[i].querySelector('.number_select').innerText=i+1;    
    }
});
$(document).on('click', "#pills-no-prescrip", function (event) {
    $('.form-buy .title-list-select').text("");
    $('.ls-product-select-prescrip').html(' ');
    $('.ls-product-select-prescrip').css("display", "none");
    $('.number_product').addClass("ignore");
    $('input[name="is_prescrip"]').val('');
});
$(document).on('click', "#pills-yes-prescrip", function (event) {
    numLast=$('.ls-product-select-prescrip li').length;
    $('.number_product').removeClass("ignore");
});
$(document).on('change', "#name-store", function (event) {
    $('.wp-content-shorder .title-list-select').text("");
    $('.ls-product-select').html(' ');
    $('.ls-product-select').css("display", "none");
});
var typingTimer;
var ajaxRequest;
$(document).on('input', ".fc-search-js input", function(event) {
    var doneTypingInterval = 1000;
    var keywordInput = $(this);
    var keyword = keywordInput.val().trim();
    if (keyword.length > 0 && keyword[0] === ' ') {
        keyword = keyword.substring(1);
    }
    if (keyword == '') {
        clearTimeout(typingTimer);
        $('.fa-spinner').hide();
        var searchListProduct = keywordInput.closest('.wp-search-list-product');
        searchListProduct.find('.list-product-short').html("<div class='px-4 py-2'><p>Bạn có thể tìm kiếm theo tên hoặc công dụng thuốc</p></div>");
        searchListProduct.find('.clear-keyword').hide();
        $('.wp-input-search-simple>input').val('');
        return;
    }
    if (keyword.length > 0) {
        $('.wp-input-search-simple>input').val(keyword);
    }
    clearTimeout(typingTimer);
    clearTimeout(ajaxRequest);
    $('.fa-spinner').show();
    var searchListProduct = keywordInput.closest('.wp-search-list-product');
    searchListProduct.find('.clear-keyword').hide();
    typingTimer = setTimeout(function() {
        var url = keywordInput.attr("data-href");
        var _token = $('input[name="_token"]').val();
        ajaxRequest = setTimeout(function() {
            $.ajax({
                url: url,
                cache: false,
                method: "GET",
                dataType: 'html',
                data: {
                    keyword: keyword,
                    _token: _token
                },
                success: function(data) {
                    searchListProduct.find('.wp-list-product-short').html(data);
                    $('.fa-spinner').hide();
                    searchListProduct.find('.clear-keyword').show();
                },
                error: function() {
                    $('.fa-spinner').hide();
                    searchListProduct.find('.clear-keyword').show();
                }
            });
        }, doneTypingInterval);
    }, 250);
});
$(document).on('click', '.clear-keyword', function () {
    var searchListProduct = $(this).closest('.wp-search-list-product');
    searchListProduct.find(".wp-input-search input").val('').focus();
    $(this).hide();
});



$(document).on('click', ".form-search-scroll", function (event) {
    const position = $("#form-search").offset().top;
    $("HTML, BODY").animate({ scrollTop: position }, 500);
});

$(document).on('click', ".form-search-show-list", function (event) {
    $('.lc-mask-search').css("opacity", 1);
    $('.lc-mask-search').css("visibility", "visible"); 
    $('.ls-history').css("display", "block");
});
$(document).on('click', ".search-header-mobi .wp-input-search-simple", function (event) {
    $('#box-search-fixed').css("display", "block");
    var input = $('#box-search-fixed .input-search-info')[0];
    input.focus();
    if (typeof input.setSelectionRange === 'function') {
        input.setSelectionRange(input.value.length, input.value.length);
    } else if (typeof input.createTextRange === 'function') {
        var range = input.createTextRange();
        range.collapse(false);
        range.select();
    }
});
$(document).on('click', ".icon-back-search", function (event) {
    $('#box-search-fixed').css("display", "none");
    $('.lc-mask-search').css("opacity", 0);
    $('.lc-mask-search').css("visibility", "hidden");
});
$(document).on('click', ".lc-mask-search", function (event) {
    $('.lc-mask-search').css("opacity", 0);
    $('.lc-mask-search').css("visibility", "hidden"); 
    $('.ls-history').css("display", "none");
});
$(document).on('click', ".delete-history-keyword", function (event) {
    var url = $(this).attr("data-href");
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: url,
        cache: false,
        method: "GET",
        dataType: 'html',
        data: {
            _token: _token
        },
        success: function(data) {
            $('.data-history').html(data);
        },
    }); 
});
$(document).on('click', ".wp-search .wp-input-search-simple>input", function (event) {
    $(".black-screen").css("display", "block");
    $(".wp-list-product-short").css("display", "block");
    $(".wp-search-menu form").css("z-index", 504);
    const position = $("#wp-search").offset().top;
    $("HTML, BODY").animate({ scrollTop: position },0);
});
$(document).on('click', ".black-screen", function (event) {
    $(".black-screen").css("display", "none");
    $(".wp-list-product-short").css("display", "none");
    $(".wp-search-menu form").css("z-index", 502);
});
$(document).on('keyup', ".wp-search .wp-input-search-simple>input", function (event) {
    var keyword = $(this).val();
    if(keyword=='' || keyword[0]==' '){
        $('.btn-search').attr("disabled","disabled");
        $('.list-product-short').html("<div class='px-4 py-2'><p class='mb-3'>Bạn có thể tìm kiếm theo tên hoặc công dụng thuốc</p><img loading='lazy' decoding='async' alt='Tdoctor' src='../../images/shop/skeleton-product.png'></div>");
    }else{
        $('.btn-search').removeAttr("disabled");
        var url = $(this).attr("data-href");
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: url,
            cache: false,
            method: "GET",
            dataType: 'html',
            data: {
                keyword: keyword,
                _token: _token
             },
            success: function(data) {
                $('.wp-list-product-short').html(data);
            },
        });    
    }
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
$(document).on('keyup', 'input[name="buyer[phone]"]', function(event) {
    var inputValue = $(this).val();
    var spanElement = $('.phone-customer');
    spanElement.text(inputValue);
});
$(document).on('click', '.mdlh .md', function(event) {
    $('.md').removeClass('active');
    $(this).addClass('active');
    $('.content-detail-product').toggleClass('fs-big');
});
$(document).on('click', '.no-login', function(event) {
    alert('Vui lòng đăng nhập để gửi bình luận!');
});
$(document).on('click', '.submit-comment', function(event) {
    $('#replyModal').modal('hide');
    $('.modal-backdrop').remove();
    $('#ratingModal').modal('hide');
    var content = $(this).closest('.content-quest').find('textarea[name="content"]').val();
    var rating = $(this).attr("data-rating") !== undefined ? $(this).attr("data-rating") : null;
    var trimmedContent = content.trim();
    if (!rating) {
        var trimmedContent = content.trim();
        if (trimmedContent.length === 0) {
            alert('Vui lòng nhập nội dung bình luận!');
            return;
        }
    }
    var url = $(this).attr("data-url");
    var productId = $(this).attr("data-product");
    var shopId = $(this).attr("data-shop");
    var userId = $(this).attr("data-user");
    var parentid = $(this).attr("data-parentid");
    var _token = $('input[name="_token"]').val();
    $.ajax({
        url: url,
        cache: false,
        method: "GET",
        dataType: 'html',
        data: {
            _token: _token,
            userId: userId,
            productId: productId,
            shopId: shopId,
            content: content,
            parentid: parentid,
            rating: rating
        },
        success: function(data) {
            if (rating && rating !== null) {
                $('.content-rating-product').html(data);
            } else {
                $('.content-comment-product').html(data);
            }
        },
    });
});
var tooltipTimeout;

$('.mess_free').tooltip({
    trigger: 'manual',  
    delay: { show: 500, hide: 0 }
});

$('.mess_free').on({
    'mouseenter': function () {
        clearTimeout(tooltipTimeout);
        $(this).tooltip('show');
    },
    'mouseleave': function () {
        tooltipTimeout = setTimeout(function () {
            $('.mess_free').tooltip('hide');
        }, 10000);
    },
    'click': function () {
        clearTimeout(tooltipTimeout);
        $('.mess_free').tooltip('show');
    }
});
$(document).on('click', '.repply-comment', function(event){
    var commenterName = $(this).data('commenter-name');
    var commentId = $(this).data('comment-id');
    $('#replyModal').modal('show').on('shown.bs.modal', function () {
        $('#replyModalLabel').text('Trả lời cho ' + commenterName);
        $('#replyModal .submit-comment').attr("data-parentid", commentId);
        var input = $('#replyModal textarea[name="content"]')[0];
        input.focus();
    });
});
$(document).on('click', '#starRating .star-big', function(event){
    var rating = $(this).data('rating');
    $(this).closest('.rating').find('.star').each(function(index) {
        if (index < rating) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });
    var modalBody = $(this).closest('.modal-body');
    modalBody.find('.submit-comment').attr("data-rating", rating);
});

$(document).on('mouseover', '#starRating .star-big', function(event){
    var rating = $(this).data('rating');
    $(this).closest('.rating').find('.star').each(function(index) {
        if (index < rating) {
            $(this).addClass('active');
        } else {
            $(this).removeClass('active');
        }
    });
    var modalBody = $(this).closest('.modal-body');
    modalBody.find('.submit-comment').attr("data-rating", rating);
});
$('.list-check-items').each(function() {
    var $checkAll = $(this).find('.check-all');
    var $subCheckboxes = $(this).find('.sub-checkbox');
    $checkAll.change(function() {
        $subCheckboxes.prop('checked', false);
    });
    $subCheckboxes.change(function() {
        if (!$(this).prop('checked')) {
            $checkAll.prop('checked', false);
        } else {
            var allChecked = true;
            $subCheckboxes.each(function() {
                if (!$(this).prop('checked')) {
                    allChecked = false;
                    return false;
                }
            });
            $checkAll.prop('checked', allChecked);
        }
    });
});

