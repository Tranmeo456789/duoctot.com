
<div class="sc118-wrapper">
    <style>
        .sc118-wrapper {
            max-width: 900px;
            margin: 20px auto;
            color: #333;
            font-size: 14px;
            line-height: 1.6;
        }

        .sc118-wrapper * {
            box-sizing: border-box;
        }

        .sc118-wrapper .sc118-card {
            margin-bottom: 18px;
            overflow: hidden;
            border: 1px solid #e0e7ed;
            border-radius: 9px;
            background: #fff;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
        }

        .sc118-wrapper .sc118-heading {
            padding: 14px 18px;
            background: #1677b8;
            color: #fff;
            font-size: 17px;
            font-weight: 600;
        }

        .sc118-wrapper.sc118-female .sc118-heading {
            background: #d65d91;
        }

        .sc118-wrapper .sc118-body {
            padding: 18px;
        }

        .sc118-wrapper .sc118-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .sc118-wrapper .sc118-table td,
        .sc118-wrapper .sc118-table th {
            padding: 11px 10px;
            border-bottom: 1px solid #e9edf1;
            vertical-align: middle;
            text-align: left;
        }

        .sc118-wrapper .sc118-table th {
            background: #edf5fb;
            font-weight: 600;
            color: #244b66;
        }

        .sc118-wrapper.sc118-female .sc118-table th {
            background: #fff0f6;
            color: #8f365c;
        }

        .sc118-wrapper .sc118-label {
            font-weight: 600;
        }

        .sc118-wrapper .sc118-required {
            color: #dc3545;
        }

        .sc118-wrapper .sc118-input,
        .sc118-wrapper .sc118-select {
            width: 100%;
            max-width: 350px;
            height: 43px;
            padding: 8px 11px;
            border: 1px solid #ccd5df;
            border-radius: 6px;
            background: #fff;
            color: #333;
            font-size: 14px;
            outline: none;
        }

        .sc118-wrapper .sc118-input:focus,
        .sc118-wrapper .sc118-select:focus {
            border-color: #1677b8;
            box-shadow: 0 0 0 2px rgba(22,119,184,.12);
        }

        .sc118-wrapper .sc118-radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .sc118-wrapper .sc118-radio-group label {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            font-weight: normal;
        }

        .sc118-wrapper input[type="radio"] {
            width: 16px;
            height: 16px;
            accent-color: #1677b8;
        }

        .sc118-wrapper.sc118-female input[type="radio"] {
            accent-color: #d65d91;
        }

        .sc118-wrapper .sc118-birthday {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
        }

        .sc118-wrapper .sc118-birthday select {
            width: auto;
            min-width: 85px;
            max-width: 110px;
        }

        .sc118-wrapper .sc118-btn {
            display: inline-block;
            padding: 11px 24px;
            border: 0;
            border-radius: 6px;
            background: #1677b8;
            color: #fff;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
        }

        .sc118-wrapper.sc118-female .sc118-btn {
            background: #d65d91;
        }

        .sc118-wrapper .sc118-btn:hover {
            opacity: .88;
        }

        .sc118-wrapper .sc118-btn-reset {
            background: #edf0f3;
            color: #444;
        }

        .sc118-wrapper .sc118-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 18px;
        }

        .sc118-wrapper .sc118-error {
            display: none;
            margin-top: 12px;
            padding: 10px 12px;
            border: 1px solid #f1cccc;
            border-radius: 5px;
            background: #fff0f0;
            color: #b42318;
        }

        .sc118-wrapper .sc118-result {
            display: none;
        }

        .sc118-wrapper .sc118-result-info {
            padding: 12px 15px;
            margin-bottom: 15px;
            border-radius: 6px;
            background: #f1f7fc;
        }

        .sc118-wrapper.sc118-female .sc118-result-info {
            background: #fff3f7;
        }

        .sc118-wrapper .sc118-result-info p {
            margin: 5px 0;
        }

        .sc118-wrapper .sc118-milestone-table td:first-child {
            width: 36%;
            font-weight: 600;
            color: #1677b8;
        }

        .sc118-wrapper.sc118-female .sc118-milestone-table td:first-child {
            color: #d65d91;
        }

        .sc118-wrapper .sc118-milestone-table td {
            padding: 12px 10px;
        }

        .sc118-wrapper .sc118-milestone-age {
            display: block;
            margin-bottom: 4px;
            font-weight: 600;
        }

        .sc118-wrapper .sc118-milestone-date {
            display: block;
            color: #777;
            font-size: 12px;
            font-weight: normal;
        }

        .sc118-wrapper .sc118-note {
            margin-top: 15px;
            padding: 12px 14px;
            border-left: 4px solid #e5a000;
            border-radius: 4px;
            background: #fff8e6;
            color: #72530b;
            font-size: 13px;
        }

        @media(max-width: 600px) {
            .sc118-wrapper .sc118-body {
                padding: 12px;
            }

            .sc118-wrapper .sc118-table td,
            .sc118-wrapper .sc118-table th {
                padding: 9px 7px;
            }

            .sc118-wrapper .sc118-input,
            .sc118-wrapper .sc118-select {
                max-width: 100%;
            }

            .sc118-wrapper .sc118-milestone-table td:first-child {
                width: 42%;
            }

            .sc118-wrapper .sc118-btn {
                flex: 1;
            }
        }
    </style>

    <div class="sc118-card">
        <div class="sc118-heading">
            Những cột mốc phát triển của trẻ
        </div>

        <div class="sc118-body">
            <p>
                Nhập thông tin của bé để xem các cột mốc phát triển
                tham khảo theo từng giai đoạn từ 1 đến 16 tháng tuổi.
            </p>

            <form class="sc118-form" autocomplete="off">
                <table class="sc118-table">
                    <tbody>
                        <tr>
                            <td colspan="2" style="font-weight:600;background:#f5f8fa;">
                                Thông tin của bé
                            </td>
                        </tr>

                        <tr>
                            <td class="sc118-label">
                                Tên của bé
                                <span class="sc118-required">*</span>
                            </td>
                            <td>
                                <input
                                    type="text"
                                    class="sc118-input sc118-babyname"
                                    maxlength="50"
                                    placeholder="Nhập tên của bé"
                                >
                            </td>
                        </tr>

                        <tr>
                            <td class="sc118-label">
                                Giới tính
                                <span class="sc118-required">*</span>
                            </td>
                            <td>
                                <div class="sc118-radio-group">
                                    <label>
                                        <input type="radio" name="sc118_gender" value="male" checked>
                                        Nam
                                    </label>

                                    <label>
                                        <input type="radio" name="sc118_gender" value="female">
                                        Nữ
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td class="sc118-label">
                                Ngày sinh
                                <span class="sc118-required">*</span>
                            </td>
                            <td>
                                <div class="sc118-birthday">
                                    <select class="sc118-select sc118-day">
                                        <option value="">Ngày</option>
                                        @for ($i = 1; $i <= 31; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>

                                    <select class="sc118-select sc118-month">
                                        <option value="">Tháng</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>

                                    <select class="sc118-select sc118-year">
                                        <option value="">Năm</option>
                                        @for ($i = date('Y'); $i >= date('Y') - 10; $i--)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="sc118-error"></div>

                <div class="sc118-actions">
                    <button type="button" class="sc118-btn sc118-submit">
                        Xác nhận
                    </button>

                    <button type="reset" class="sc118-btn sc118-btn-reset">
                        Nhập lại
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="sc118-card sc118-result">
        <div class="sc118-heading">
            Kết quả các cột mốc phát triển
        </div>

        <div class="sc118-body">
            <div class="sc118-result-info">
                <p>
                    <strong>Tên của bé:</strong>
                    <span class="sc118-result-name"></span>
                </p>

                <p>
                    <strong>Giới tính:</strong>
                    <span class="sc118-result-sex"></span>
                </p>

                <p>
                    <strong>Ngày sinh:</strong>
                    <span class="sc118-result-birthday"></span>
                </p>
            </div>

            <div style="overflow-x:auto;">
                <table class="sc118-table sc118-milestone-table">
                    <thead>
                        <tr>
                            <th>Giai đoạn</th>
                            <th>Các mốc phát triển</th>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="sc118-date-0"></td>
                            <td>Quay đầu về phía có tiếng động</td>
                        </tr>

                        <tr>
                            <td class="sc118-date-1"></td>
                            <td>Mỉm cười với mọi người</td>
                        </tr>

                        <tr>
                            <td class="sc118-date-2"></td>
                            <td>
                                - Trẻ biết phát âm ậm ẹ<br>
                                - Đưa được cổ lên<br>
                                - Nhận ra mẹ mình
                            </td>
                        </tr>

                        <tr>
                            <td class="sc118-date-3"></td>
                            <td>Biết nắm chặt đồ vật khi đặt vào tay</td>
                        </tr>

                        <tr>
                            <td class="sc118-date-4"></td>
                            <td>
                                - Biết với tới một đồ vật<br>
                                - Cầm được đồ bằng hai tay<br>
                                - Ngồi được nếu có người đỡ
                            </td>
                        </tr>

                        <tr>
                            <td class="sc118-date-5"></td>
                            <td>
                                - Biết cười khi thấy mình trong gương<br>
                                - Nói bập bẹ từng âm
                            </td>
                        </tr>

                        <tr>
                            <td class="sc118-date-6"></td>
                            <td>Biết chộp và nắm đồ vật</td>
                        </tr>

                        <tr>
                            <td class="sc118-date-7"></td>
                            <td>Biết tự ngồi</td>
                        </tr>

                        <tr>
                            <td class="sc118-date-8"></td>
                            <td>
                                - Biết đứng nếu có người đỡ<br>
                                - Nói bập bẹ hai tiếng một<br>
                                - Biết vẫy tay<br>
                                - Biết cầm đồ vật giữa ngón trỏ và ngón cái
                            </td>
                        </tr>

                        <tr>
                            <td class="sc118-date-9"></td>
                            <td>Đi chập chững khi có người đỡ</td>
                        </tr>

                        <tr>
                            <td class="sc118-date-10"></td>
                            <td>Biết bò</td>
                        </tr>

                        <tr>
                            <td class="sc118-date-11"></td>
                            <td>
                                - Tự đứng được<br>
                                - Nói bập bẹ hai từ một<br>
                                - Chơi trò chơi đơn giản với bóng
                            </td>
                        </tr>

                        <tr>
                            <td class="sc118-date-12"></td>
                            <td>
                                - Biết chạy<br>
                                - Nói lắp bắp 10 từ
                            </td>
                        </tr>

                        <tr>
                            <td class="sc118-date-13"></td>
                            <td>
                                - Biết leo bậc cầu thang<br>
                                - Biết nói những câu đơn giản
                            </td>
                        </tr>

                        <tr>
                            <td class="sc118-date-14"></td>
                            <td>
                                - Biết đi xe đạp 3 bánh<br>
                                - Biết kể chuyện<br>
                                - Biết phân biệt giới tính
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div class="sc118-note">
                <strong>Chú ý:</strong>
                Sự phát triển của trẻ có thể khác nhau giữa từng bé.
                Trẻ sinh non hoặc trẻ có vấn đề sức khỏe có thể đạt các
                mốc phát triển muộn hơn. Nếu có lo lắng về sự phát triển
                của trẻ, phụ huynh nên trao đổi với bác sĩ nhi khoa để
                được đánh giá phù hợp.
            </div>
        </div>
    </div>

    <script>
        jQuery(function ($) {
            $('.sc118-wrapper').each(function () {
                var $wrapper = $(this);

                if ($wrapper.data('sc118-initialized')) {
                    return;
                }

                $wrapper.data('sc118-initialized', true);

                var $form = $wrapper.find('.sc118-form');
                var $result = $wrapper.find('.sc118-result');
                var $error = $wrapper.find('.sc118-error');

                // Đổi màu giao diện theo giới tính.
                $form.find('input[name="sc118_gender"]').on('change', function () {
                    $wrapper.removeClass('sc118-female');

                    if ($(this).val() === 'female') {
                        $wrapper.addClass('sc118-female');
                    }
                });

                // Định dạng ngày tháng.
                function formatDate(date) {
                    var day = ('0' + date.getDate()).slice(-2);
                    var month = ('0' + (date.getMonth() + 1)).slice(-2);
                    var year = date.getFullYear();

                    return day + '/' + month + '/' + year;
                }

                // Cộng tháng, xử lý trường hợp ngày cuối tháng.
                function addMonths(date, months) {
                    var result = new Date(
                        date.getFullYear(),
                        date.getMonth(),
                        1
                    );

                    result.setMonth(result.getMonth() + months);

                    var lastDay = new Date(
                        result.getFullYear(),
                        result.getMonth() + 1,
                        0
                    ).getDate();

                    result.setDate(Math.min(date.getDate(), lastDay));

                    return result;
                }

                // Xác nhận thông tin.
                $wrapper.find('.sc118-submit').on('click', function () {
                    var babyname = $.trim(
                        $wrapper.find('.sc118-babyname').val()
                    );

                    var sex = $form.find(
                        'input[name="sc118_gender"]:checked'
                    ).val();

                    var day = parseInt($wrapper.find('.sc118-day').val(), 10);
                    var month = parseInt($wrapper.find('.sc118-month').val(), 10);
                    var year = parseInt($wrapper.find('.sc118-year').val(), 10);

                    $error.hide().text('');

                    if (!babyname) {
                        $error.text('Bạn chưa nhập tên của bé!').show();
                        $wrapper.find('.sc118-babyname').focus();
                        return;
                    }

                    // Hỗ trợ chữ cái tiếng Việt, dấu cách, dấu nháy và gạch nối.
                    var namePattern = /^[a-zA-ZÀ-ỹ\s'-]+$/;

                    if (!namePattern.test(babyname)) {
                        $error.text(
                            'Tên bé chỉ được chứa chữ cái, dấu cách và dấu gạch nối!'
                        ).show();

                        $wrapper.find('.sc118-babyname').focus();
                        return;
                    }

                    if (!sex) {
                        $error.text('Bạn chưa chọn giới tính!').show();
                        return;
                    }

                    if (!day) {
                        $error.text('Vui lòng chọn ngày sinh!').show();
                        return;
                    }

                    if (!month) {
                        $error.text('Vui lòng chọn tháng sinh!').show();
                        return;
                    }

                    if (!year) {
                        $error.text('Vui lòng chọn năm sinh!').show();
                        return;
                    }

                    var birthday = new Date(year, month - 1, day);
                    var today = new Date();

                    today.setHours(0, 0, 0, 0);

                    // Kiểm tra ngày hợp lệ.
                    if (
                        birthday.getFullYear() !== year ||
                        birthday.getMonth() !== month - 1 ||
                        birthday.getDate() !== day
                    ) {
                        $error.text('Ngày sinh không hợp lệ!').show();
                        return;
                    }

                    if (birthday > today) {
                        $error.text('Ngày sinh không được lớn hơn ngày hiện tại!').show();
                        return;
                    }

                    // Hiển thị thông tin bé.
                    $wrapper.find('.sc118-result-name').text(babyname);

                    $wrapper.find('.sc118-result-sex').text(
                        sex === 'male' ? 'Nam' : 'Nữ'
                    );

                    $wrapper.find('.sc118-result-birthday').text(
                        'Ngày ' + day + ' / Tháng ' + month + ' / Năm ' + year
                    );

                    // Hiển thị 15 cột mốc phát triển.
                    for (var i = 0; i < 15; i++) {
                        var startDate = addMonths(birthday, i + 1);
                        var endDate = addMonths(birthday, i + 2);

                        var ageText = (i + 1) + '–' + (i + 2) + ' tháng tuổi';

                        var dateText =
                            formatDate(startDate) + ' – ' + formatDate(endDate);

                        var html =
                            '<span class="sc118-milestone-age">' +
                            ageText +
                            '</span>' +
                            '<span class="sc118-milestone-date">' +
                            dateText +
                            '</span>';

                        $wrapper.find('.sc118-date-' + i).html(html);
                    }

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
                        $wrapper.removeClass('sc118-female');
                    }, 0);
                });
            });
        });
    </script>
</div>
