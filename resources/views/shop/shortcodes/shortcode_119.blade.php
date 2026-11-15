
<div id="shortcode-119" class="sc119">
    <style>
        #shortcode-119 {
            width: 100%;
            font-size: 14px;
            color: #222;
        }

        #shortcode-119 * {
            box-sizing: border-box;
        }

        #shortcode-119 .sc119-form {
            background: #ebf3f4;
            border: 1px solid #eee;
            border-bottom: 3px solid #187681;
            box-shadow: 0 0 20px rgba(0,0,0,.08);
            padding: 12px;
            border-radius: 4px;
        }

        #shortcode-119 .sc119-form table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }

        #shortcode-119 .sc119-form td {
            border: 1px solid #fff;
            padding: 10px;
            vertical-align: middle;
        }

        #shortcode-119 .sc119-heading {
            background: #187681;
            color: #fff;
            font-weight: 600;
            text-align: left;
        }

        #shortcode-119 input[type="text"],
        #shortcode-119 select {
            min-height: 36px;
            max-width: 100%;
            padding: 5px 8px;
            border: 1px solid #ccc;
            background: #fff;
            border-radius: 3px;
            outline: none;
        }

        #shortcode-119 input[type="text"] {
            width: 100%;
        }

        #shortcode-119 input[type="text"]:focus,
        #shortcode-119 select:focus {
            border-color: #187681;
        }

        #shortcode-119 .sc119-date-select {
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        #shortcode-119 .sc119-date-select select {
            min-width: 75px;
        }

        #shortcode-119 .sc119-required {
            color: #c00;
        }

        #shortcode-119 .sc119-btn {
            display: inline-block;
            border: 0;
            border-radius: 4px;
            background: #187681;
            color: #fff !important;
            padding: 11px 22px;
            margin: 8px 0;
            font-size: 14px;
            line-height: 1.3;
            cursor: pointer;
            text-decoration: none !important;
        }

        #shortcode-119 .sc119-btn:hover {
            background: #125d65;
            color: #fff !important;
        }

        #shortcode-119 .sc119-result {
            display: none;
            margin-top: 20px;
            padding: 15px;
            background: #ebf3f4;
            border-radius: 4px;
            border-top: 3px solid #187681;
        }

        #shortcode-119 .sc119-result h3 {
            text-align: center;
            margin: 0 0 15px;
        }

        #shortcode-119 .sc119-info {
            margin: 8px 0;
            overflow-wrap: anywhere;
        }

        #shortcode-119 .sc119-table-wrap {
            width: 100%;
            overflow-x: auto;
            margin-top: 15px;
            -webkit-overflow-scrolling: touch;
        }

        #shortcode-119 .sc119-vaccine-table {
            width: 100%;
            min-width: 560px;
            border-collapse: collapse;
            background: #fff;
            margin: 0;
        }

        #shortcode-119 .sc119-vaccine-table th,
        #shortcode-119 .sc119-vaccine-table td {
            border: 1px solid #187681;
            padding: 9px;
            text-align: left;
            vertical-align: top;
        }

        #shortcode-119 .sc119-vaccine-table th {
            background: #187681;
            color: #fff;
        }

        #shortcode-119 .sc119-note {
            font-size: 13px;
            font-style: italic;
            margin-top: 15px;
            line-height: 1.6;
        }

        #shortcode-119 .sc119-error {
            display: none;
            color: #c00;
            margin: 10px 0;
        }

        @media (max-width: 600px) {
            #shortcode-119 .sc119-form {
                padding: 8px;
            }

            #shortcode-119 .sc119-form td {
                padding: 8px 6px;
            }

            #shortcode-119 .sc119-form td:first-child {
                width: 32%;
            }

            #shortcode-119 .sc119-date-select select {
                flex: 1;
                min-width: 65px;
            }

            #shortcode-119 .sc119-result {
                padding: 10px;
            }
        }
    </style>

    <div class="sc119-form">
        <form class="sc119-input-form" autocomplete="off">
            <table>
                <tbody>
                    <tr class="sc119-heading">
                        <td colspan="2">Lịch tiêm chủng</td>
                    </tr>

                    <tr>
                        <td>Tên của bé <span class="sc119-required">*</span></td>
                        <td>
                            <input
                                type="text"
                                class="sc119-babyname"
                                maxlength="50"
                                placeholder="Nhập tên của bé"
                            >
                        </td>
                    </tr>

                    <tr>
                        <td>Giới tính <span class="sc119-required">*</span></td>
                        <td>
                            <label>
                                <input type="radio" name="sc119_gender" value="male" checked>
                                Nam
                            </label>
                            &nbsp;&nbsp;
                            <label>
                                <input type="radio" name="sc119_gender" value="female">
                                Nữ
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <td>Ngày sinh <span class="sc119-required">*</span></td>
                        <td>
                            <div class="sc119-date-select">
                                <select class="sc119-day">
                                    <option value="">Ngày</option>
                                </select>

                                <select class="sc119-month">
                                    <option value="">Tháng</option>
                                    @for ($i = 1; $i <= 12; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>

                                <select class="sc119-year">
                                    <option value="">Năm</option>
                                    @for ($i = date('Y'); $i >= date('Y') - 10; $i--)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <span class="sc119-required">* Yêu cầu nhập đầy đủ thông tin</span>
                            <br>
                            <button type="submit" class="sc119-btn">Xác nhận</button>
                        </td>
                    </tr>
                </tbody>
            </table>

            <div class="sc119-error"></div>
        </form>
    </div>

    <div class="sc119-result">
        <h3>Kết quả</h3>

        <div class="sc119-info">
            <strong>Tên em bé:</strong>
            <strong class="sc119-result-name"></strong>
        </div>

        <div class="sc119-info">
            <strong>Giới tính:</strong>
            <strong class="sc119-result-gender"></strong>
        </div>

        <div class="sc119-info">
            <strong>Ngày sinh:</strong>
            <strong class="sc119-result-birthday"></strong>
        </div>

        <div class="sc119-table-wrap">
            <table class="sc119-vaccine-table">
                <thead>
                    <tr>
                        <th>Thời gian</th>
                        <th>Loại vắc xin</th>
                        <th>Hạn ngày tiêm dự kiến</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Sơ sinh</td>
                        <td>
                            Tiêm vắc xin Viêm gan B mũi 0<br>
                            Lao (BCG)
                        </td>
                        <td class="sc119-newborn-date">24 giờ sau sinh</td>
                    </tr>

                    <tr>
                        <td>2 tháng</td>
                        <td>
                            Tiêm vắc xin Bạch hầu - Ho gà - Uốn ván - Viêm gan B - Hib mũi 1<br>
                            Uống vắc xin bại liệt lần 1
                        </td>
                        <td class="sc119-due-2"></td>
                    </tr>

                    <tr>
                        <td>3 tháng</td>
                        <td>
                            Tiêm vắc xin Bạch hầu - Ho gà - Uốn ván - Viêm gan B - Hib mũi 2<br>
                            Uống vắc xin bại liệt lần 2
                        </td>
                        <td class="sc119-due-3"></td>
                    </tr>

                    <tr>
                        <td>4 tháng</td>
                        <td>
                            Tiêm vắc xin Bạch hầu - Ho gà - Uốn ván - Viêm gan B - Hib mũi 3<br>
                            Uống vắc xin bại liệt lần 3
                        </td>
                        <td class="sc119-due-4"></td>
                    </tr>

                    <tr>
                        <td>5 tháng</td>
                        <td>Tiêm vắc xin bại liệt đa giá (IPV)</td>
                        <td class="sc119-due-5"></td>
                    </tr>

                    <tr>
                        <td>9 tháng</td>
                        <td>Tiêm vắc xin sởi mũi 1</td>
                        <td class="sc119-due-9"></td>
                    </tr>

                    <tr>
                        <td>18 tháng</td>
                        <td>
                            Tiêm vắc xin bạch hầu - ho gà - uốn ván mũi 4<br>
                            Tiêm vắc xin sởi - rubella
                        </td>
                        <td class="sc119-due-18"></td>
                    </tr>

                    <tr>
                        <td>Từ 12 tháng tuổi</td>
                        <td>
                            Tiêm vắc xin viêm não Nhật Bản mũi 1<br>
                            Tiêm vắc xin viêm não Nhật Bản mũi 2 (1–2 tuần sau mũi 1)<br>
                            Tiêm vắc xin viêm não Nhật Bản mũi 3 (1 năm sau mũi 2)
                        </td>
                        <td>Từ khi trẻ đủ 12 tháng tuổi</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <div class="sc119-note">
            <strong>Lưu ý:</strong>
            Lịch tiêm chủng trên là thông tin tham khảo được giữ theo nội dung lịch gốc.
            Thời điểm tiêm thực tế có thể thay đổi tùy tình trạng sức khỏe, tiền sử tiêm chủng
            và hướng dẫn của cơ sở tiêm chủng. Phụ huynh nên đưa trẻ đến cơ sở y tế để được
            tư vấn lịch tiêm phù hợp.
        </div>
    </div>

    <script>
        (function ($) {
            'use strict';

            var $root = $('#shortcode-119');

            if (!$root.length) {
                return;
            }

            var $day = $root.find('.sc119-day');
            var $month = $root.find('.sc119-month');
            var $year = $root.find('.sc119-year');
            var $form = $root.find('.sc119-input-form');
            var $error = $root.find('.sc119-error');

            // Tạo danh sách ngày một lần, tránh option bị lặp.
            for (var d = 1; d <= 31; d++) {
                $day.append(
                    $('<option>', {
                        value: d,
                        text: d
                    })
                );
            }

            // Tính ngày hợp lệ theo tháng và năm đã chọn.
            function updateDays() {
                var month = parseInt($month.val(), 10);
                var year = parseInt($year.val(), 10);
                var currentDay = $day.val();

                if (!month || !year) {
                    return;
                }

                var maxDay = new Date(year, month, 0).getDate();

                $day.empty().append(
                    $('<option>', {
                        value: '',
                        text: 'Ngày'
                    })
                );

                for (var i = 1; i <= maxDay; i++) {
                    $day.append(
                        $('<option>', {
                            value: i,
                            text: i
                        })
                    );
                }

                if (currentDay && parseInt(currentDay, 10) <= maxDay) {
                    $day.val(currentDay);
                }
            }

            $month.on('change', updateDays);
            $year.on('change', updateDays);

            // Cộng tháng và xử lý ngày cuối tháng.
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

            function formatDate(date) {
                var day = ('0' + date.getDate()).slice(-2);
                var month = ('0' + (date.getMonth() + 1)).slice(-2);
                var year = date.getFullYear();

                return day + '/' + month + '/' + year;
            }

            function showError(message) {
                $error.text(message).show();
                $root.find('.sc119-result').hide();
            }

            $form.on('submit', function (e) {
                e.preventDefault();

                $error.hide().text('');

                var babyname = $.trim($root.find('.sc119-babyname').val());
                var sex = $root.find('input[name="sc119_gender"]:checked').val();

                var day = parseInt($day.val(), 10);
                var month = parseInt($month.val(), 10);
                var year = parseInt($year.val(), 10);

                if (!babyname) {
                    showError('Bạn chưa nhập tên của bé!');
                    return;
                }

                if (babyname.length > 50) {
                    showError('Tên bé không được vượt quá 50 ký tự!');
                    return;
                }

                // Cho phép chữ tiếng Việt, dấu cách, dấu gạch nối và dấu nháy.
                if (!/^[\p{L}\p{M}\s'-]+$/u.test(babyname)) {
                    showError('Tên bé chỉ được chứa chữ cái và khoảng trắng!');
                    return;
                }

                if (sex !== 'male' && sex !== 'female') {
                    showError('Bạn chưa chọn giới tính!');
                    return;
                }

                if (!day || !month || !year) {
                    showError('Vui lòng chọn đầy đủ ngày, tháng và năm sinh!');
                    return;
                }

                var birthDate = new Date(year, month - 1, day);

                if (
                    birthDate.getFullYear() !== year ||
                    birthDate.getMonth() !== month - 1 ||
                    birthDate.getDate() !== day
                ) {
                    showError('Ngày sinh không hợp lệ!');
                    return;
                }

                var today = new Date();
                today.setHours(23, 59, 59, 999);

                if (birthDate > today) {
                    showError('Ngày sinh không được lớn hơn ngày hiện tại!');
                    return;
                }

                // Hiển thị thông tin bé.
                $root.find('.sc119-result-name').text(babyname);
                $root.find('.sc119-result-gender').text(
                    sex === 'male' ? 'Nam' : 'Nữ'
                );
                $root.find('.sc119-result-birthday').text(
                    'Ngày ' + day + ', tháng ' + month + ', năm ' + year
                );

                // Tính ngày dự kiến theo ngày sinh cộng số tháng.
                var vaccineMonths = [2, 3, 4, 5, 9, 18];

                $.each(vaccineMonths, function (index, months) {
                    var dueDate = addMonths(birthDate, months);

                    $root.find('.sc119-due-' + months).text(
                        formatDate(dueDate)
                    );
                });

                var newbornDate = new Date(birthDate.getTime());
                newbornDate.setDate(newbornDate.getDate() + 1);

                $root.find('.sc119-newborn-date').text(
                    'Trong 24 giờ sau sinh (khoảng ' +
                    formatDate(newbornDate) + ')'
                );

                // Đổi màu theo giới tính như giao diện gốc.
                if (sex === 'female') {
                    $root.find('.sc119-form').css({
                        background: '#fff0f5',
                        borderBottomColor: '#d66b91'
                    });
                    $root.find('.sc119-result').css({
                        background: '#fff0f5',
                        borderTopColor: '#d66b91'
                    });
                } else {
                    $root.find('.sc119-form').css({
                        background: '#ebf3f4',
                        borderBottomColor: '#187681'
                    });
                    $root.find('.sc119-result').css({
                        background: '#ebf3f4',
                        borderTopColor: '#187681'
                    });
                }

                $root.find('.sc119-result').stop(true, true).slideDown(200);
            });

        })(jQuery);
    </script>
</div>
