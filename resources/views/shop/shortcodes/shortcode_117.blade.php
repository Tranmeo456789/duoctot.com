
<div class="sc117-wrapper">
    <style>
        .sc117-wrapper {
            max-width: 800px;
            margin: 20px auto;
            color: #333;
            font-size: 15px;
            line-height: 1.6;
        }

        .sc117-wrapper * {
            box-sizing: border-box;
        }

        .sc117-wrapper .sc117-card {
            border: 1px solid #e0e7ed;
            border-radius: 10px;
            background: #fff;
            overflow: hidden;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
        }

        .sc117-wrapper .sc117-heading {
            padding: 14px 18px;
            background: #1677b8;
            color: #fff;
            font-size: 17px;
            font-weight: 600;
        }

        .sc117-wrapper.sc117-female .sc117-heading {
            background: #d65d91;
        }

        .sc117-wrapper .sc117-body {
            padding: 20px;
        }

        .sc117-wrapper .sc117-table {
            width: 100%;
            border-collapse: collapse;
        }

        .sc117-wrapper .sc117-table td {
            padding: 12px 10px;
            border-bottom: 1px solid #edf0f3;
            vertical-align: middle;
        }

        .sc117-wrapper .sc117-table tr:last-child td {
            border-bottom: 0;
        }

        .sc117-wrapper .sc117-label {
            font-weight: 600;
        }

        .sc117-wrapper .sc117-required {
            color: #dc3545;
        }

        .sc117-wrapper .sc117-input {
            width: 100%;
            max-width: 220px;
            height: 43px;
            padding: 8px 12px;
            border: 1px solid #ccd5df;
            border-radius: 6px;
            font-size: 15px;
            outline: none;
        }

        .sc117-wrapper .sc117-input:focus {
            border-color: #1677b8;
            box-shadow: 0 0 0 2px rgba(22,119,184,.12);
        }

        .sc117-wrapper .sc117-radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 18px;
        }

        .sc117-wrapper .sc117-radio-group label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
            font-weight: normal;
        }

        .sc117-wrapper input[type="radio"] {
            width: 16px;
            height: 16px;
            accent-color: #1677b8;
        }

        .sc117-wrapper.sc117-female input[type="radio"] {
            accent-color: #d65d91;
        }

        .sc117-wrapper .sc117-btn {
            display: inline-block;
            padding: 11px 25px;
            border: 0;
            border-radius: 6px;
            background: #1677b8;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
        }

        .sc117-wrapper.sc117-female .sc117-btn {
            background: #d65d91;
        }

        .sc117-wrapper .sc117-btn:hover {
            opacity: .88;
        }

        .sc117-wrapper .sc117-reset {
            background: #edf0f3;
            color: #444;
        }

        .sc117-wrapper .sc117-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .sc117-wrapper .sc117-result {
            display: none;
        }

        .sc117-wrapper .sc117-result-table td:first-child {
            width: 45%;
            font-weight: 600;
        }

        .sc117-wrapper .sc117-range {
            padding: 18px;
            text-align: center;
            border-radius: 8px;
            background: #edf6fc;
            margin-top: 12px;
        }

        .sc117-wrapper.sc117-female .sc117-range {
            background: #fff0f6;
        }

        .sc117-wrapper .sc117-range-number {
            display: block;
            color: #1677b8;
            font-size: 25px;
            font-weight: 700;
            margin: 7px 0;
        }

        .sc117-wrapper.sc117-female .sc117-range-number {
            color: #d65d91;
        }

        .sc117-wrapper .sc117-range-separator {
            display: block;
            color: #777;
            margin: 5px 0;
        }

        .sc117-wrapper .sc117-note {
            margin-top: 15px;
            padding: 12px 14px;
            border-left: 4px solid #e5a000;
            border-radius: 4px;
            background: #fff8e6;
            color: #72530b;
            font-size: 13px;
        }

        .sc117-wrapper .sc117-error {
            display: none;
            margin-top: 12px;
            padding: 10px 12px;
            border-radius: 5px;
            background: #fff0f0;
            border: 1px solid #f1cccc;
            color: #b42318;
        }

        @media(max-width: 600px) {
            .sc117-wrapper .sc117-body {
                padding: 13px;
            }

            .sc117-wrapper .sc117-table td {
                padding: 10px 6px;
            }

            .sc117-wrapper .sc117-input {
                max-width: 100%;
            }

            .sc117-wrapper .sc117-result-table td:first-child {
                width: 42%;
            }

            .sc117-wrapper .sc117-btn {
                flex: 1;
            }
        }
    </style>

    <div class="sc117-card">
        <div class="sc117-heading">
            Công cụ dự đoán chiều cao tiềm năng của trẻ
        </div>

        <div class="sc117-body">
            <p>
                Nhập chiều cao của bố và mẹ, sau đó chọn giới tính
                để tham khảo chiều cao tiềm năng của trẻ khi trưởng thành.
            </p>

            <form class="sc117-form" autocomplete="off">
                <table class="sc117-table">
                    <tbody>
                        <tr>
                            <td class="sc117-label">
                                Giới tính
                                <span class="sc117-required">*</span>
                            </td>
                            <td>
                                <div class="sc117-radio-group">
                                    <label>
                                        <input type="radio" name="sc117_gender" value="male" checked>
                                        Nam
                                    </label>

                                    <label>
                                        <input type="radio" name="sc117_gender" value="female">
                                        Nữ
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="sc117-label">
                                Chiều cao của bố
                                <span class="sc117-required">*</span>
                            </td>
                            <td>
                                <input
                                    type="number"
                                    class="sc117-input sc117-father"
                                    placeholder="Ví dụ: 170"
                                    min="100"
                                    max="230"
                                    step="0.1"
                                    inputmode="decimal"
                                >
                                &nbsp;cm
                            </td>
                        </tr>

                        <tr>
                            <td class="sc117-label">
                                Chiều cao của mẹ
                                <span class="sc117-required">*</span>
                            </td>
                            <td>
                                <input
                                    type="number"
                                    class="sc117-input sc117-mother"
                                    placeholder="Ví dụ: 160"
                                    min="100"
                                    max="230"
                                    step="0.1"
                                    inputmode="decimal"
                                >
                                &nbsp;cm
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="sc117-error"></div>

                <div class="sc117-actions">
                    <button type="button" class="sc117-btn sc117-submit">
                        Tính chiều cao
                    </button>

                    <button type="reset" class="sc117-btn sc117-reset">
                        Nhập lại
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="sc117-card sc117-result">
        <div class="sc117-heading">Kết quả dự đoán</div>

        <div class="sc117-body">
            <table class="sc117-table sc117-result-table">
                <tbody>
                    <tr>
                        <td>Giới tính</td>
                        <td class="sc117-result-sex"></td>
                    </tr>

                    <tr>
                        <td>Chiều cao của bố</td>
                        <td class="sc117-result-father"></td>
                    </tr>

                    <tr>
                        <td>Chiều cao của mẹ</td>
                        <td class="sc117-result-mother"></td>
                    </tr>
                </tbody>
            </table>

            <div class="sc117-range">
                <strong>Phạm vi chiều cao tiềm năng tham khảo</strong>

                <span class="sc117-range-number sc117-result-from"></span>

                <span class="sc117-range-separator">đến</span>

                <span class="sc117-range-number sc117-result-to"></span>

                <strong>cm</strong>
            </div>

            <div class="sc117-note">
                <strong>Lưu ý:</strong>
                Đây là kết quả ước tính dựa trên chiều cao của bố mẹ,
                không phải chiều cao chắc chắn trẻ sẽ đạt được.
                Chiều cao thực tế còn phụ thuộc vào di truyền, dinh dưỡng,
                giấc ngủ, hoạt động thể chất, tình trạng sức khỏe và nhiều
                yếu tố khác. Công cụ không thay thế việc theo dõi tăng trưởng
                hoặc tư vấn của bác sĩ.
            </div>
        </div>
    </div>

    <script>
        jQuery(function ($) {
            $('.sc117-wrapper').each(function () {
                var $wrapper = $(this);

                if ($wrapper.data('sc117-initialized')) {
                    return;
                }

                $wrapper.data('sc117-initialized', true);

                var $form = $wrapper.find('.sc117-form');
                var $result = $wrapper.find('.sc117-result');
                var $error = $wrapper.find('.sc117-error');

                // Đổi màu theo giới tính.
                $form.find('input[name="sc117_gender"]').on('change', function () {
                    $wrapper.removeClass('sc117-female');

                    if ($(this).val() === 'female') {
                        $wrapper.addClass('sc117-female');
                    }
                });

                // Tính chiều cao.
                $wrapper.find('.sc117-submit').on('click', function () {
                    var fatherValue = $.trim($wrapper.find('.sc117-father').val());
                    var motherValue = $.trim($wrapper.find('.sc117-mother').val());
                    var sex = $form.find('input[name="sc117_gender"]:checked').val();

                    $error.hide().text('');

                    if (fatherValue === '') {
                        $error.text('Bạn chưa nhập chiều cao của bố!').show();
                        $wrapper.find('.sc117-father').focus();
                        return;
                    }

                    if (motherValue === '') {
                        $error.text('Bạn chưa nhập chiều cao của mẹ!').show();
                        $wrapper.find('.sc117-mother').focus();
                        return;
                    }

                    var father = Number(fatherValue);
                    var mother = Number(motherValue);

                    if (!isFinite(father) || father < 100 || father > 230) {
                        $error.text('Chiều cao của bố phải nằm trong khoảng 100–230 cm.').show();
                        $wrapper.find('.sc117-father').focus();
                        return;
                    }

                    if (!isFinite(mother) || mother < 100 || mother > 230) {
                        $error.text('Chiều cao của mẹ phải nằm trong khoảng 100–230 cm.').show();
                        $wrapper.find('.sc117-mother').focus();
                        return;
                    }

                    if (sex !== 'male' && sex !== 'female') {
                        $error.text('Bạn chưa chọn giới tính!').show();
                        return;
                    }

                    // Công thức từ code gốc.
                    var average = (father + mother) / 2;
                    var targetHeight;

                    if (sex === 'male') {
                        targetHeight = average + 6.5;
                    } else {
                        targetHeight = average - 6.5;
                    }

                    var lowerHeight = targetHeight - 10.16;
                    var upperHeight = targetHeight + 10.16;

                    // Làm tròn đến 1 chữ số thập phân.
                    function formatHeight(value) {
                        return (Math.round(value * 10) / 10).toFixed(1);
                    }

                    $wrapper.find('.sc117-result-sex').text(
                        sex === 'male' ? 'Nam' : 'Nữ'
                    );

                    $wrapper.find('.sc117-result-father').text(
                        formatHeight(father) + ' cm'
                    );

                    $wrapper.find('.sc117-result-mother').text(
                        formatHeight(mother) + ' cm'
                    );

                    $wrapper.find('.sc117-result-from').text(
                        formatHeight(lowerHeight) + ' cm'
                    );

                    $wrapper.find('.sc117-result-to').text(
                        formatHeight(upperHeight) + ' cm'
                    );

                    $result.stop(true, true).slideDown(200);

                    $('html, body').animate({
                        scrollTop: $result.offset().top - 100
                    }, 300);
                });

                // Nhập lại.
                $form.on('reset', function () {
                    setTimeout(function () {
                        $error.hide().text('');
                        $result.hide();
                        $wrapper.removeClass('sc117-female');
                    }, 0);
                });
            });
        });
    </script>
</div>
