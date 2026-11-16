
<div class="shortcode-84">
    <style>
        .shortcode-84 {
            width: 100%;
            margin: 20px auto;
            color: #222;
            font-size: 15px;
            line-height: 1.5;
            box-sizing: border-box;
        }

        .shortcode-84 *,
        .shortcode-84 *:before,
        .shortcode-84 *:after {
            box-sizing: border-box;
        }

        .shortcode-84 .calculator-table-form {
            margin: 0 auto 20px;
            color: #000;
            width: 100%;
            line-height: 1.5;
        }

        .shortcode-84 .calculator-table-form table {
            width: 100%;
            color: #000;
            border-collapse: collapse;
            margin: 0;
        }

        .shortcode-84 .calculator-table-form td {
            border-bottom: 1px solid #fff;
            padding: 10px 8px;
            vertical-align: middle;
            text-align: left;
        }

        .shortcode-84 .calculator-table-form td:first-child {
            border-left: none;
        }

        .shortcode-84 .calculator-table-form.blue table {
            background: #E6F4FE;
            border: 1px solid #0F5885;
        }

        .shortcode-84 .calculator-table-form.blue td:first-child {
            background: #CFEAFC;
        }

        .shortcode-84 .calculator-table-form tr.table-head td {
            color: #fff;
            font-weight: 700;
            background: #0F5885;
        }

        .shortcode-84 .calculator-table-form input[type="radio"] {
            margin: 0 5px 0 0;
            accent-color: #0F5885;
            cursor: pointer;
        }

        .shortcode-84 .calculator-table-form label {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin-right: 12px;
            cursor: pointer;
        }

        .shortcode-84 .calculator-table-form .flat-btn {
            border: 0;
            border-radius: 5px;
            background: #0F5885;
            color: #fff !important;
            font-size: 14px;
            font-weight: 600;
            padding: 11px 25px;
            display: inline-block;
            cursor: pointer;
            transition: background .2s ease;
        }

        .shortcode-84 .calculator-table-form .flat-btn:hover {
            background: #0779A3;
        }

        .shortcode-84 .required {
            color: #B30000;
            text-align: left;
            padding: 15px;
            font-size: 13px;
        }

        .shortcode-84 .result-text {
            margin: 0 5px;
            padding: 15px 5px;
            line-height: 1.8;
        }

        .shortcode-84 .result-box {
            padding-top: 20px;
            display: none;
        }

        .shortcode-84 select {
            max-width: 100%;
            min-width: 120px;
            height: 38px;
            padding: 5px 10px;
            border: 1px solid #bbb;
            border-radius: 4px;
            background: #fff;
            color: #333;
        }

        .shortcode-84 .question-table {
            table-layout: fixed;
        }

        .shortcode-84 .question-table td {
            text-align: center;
        }

        .shortcode-84 .question-table td:first-child {
            text-align: left;
        }

        .shortcode-84 .question-table tr:not(.table-head) td:first-child {
            background: #CFEAFC;
        }

        .shortcode-84 .question-table input[type="radio"] {
            width: 17px;
            height: 17px;
        }

        .shortcode-84 .question-table label {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin: 0;
        }

        .shortcode-84 .question-table label.active {
            color: #0F5885;
            font-weight: 700;
        }

        .shortcode-84 .ess-error {
            display: none;
            margin: 12px 0;
            padding: 10px 12px;
            border: 1px solid #f5b7b7;
            border-radius: 5px;
            background: #fff1f1;
            color: #b30000;
            font-size: 14px;
        }

        .shortcode-84 .ess-result-total {
            color: #0F5885;
            font-size: 21px;
            font-weight: 700;
            margin-bottom: 12px;
        }

        .shortcode-84 .ess-result-content {
            line-height: 1.8;
            font-size: 15px;
        }

        .shortcode-84 .ess-result-note {
            margin-top: 15px;
            padding: 12px;
            border-left: 4px solid #0F5885;
            background: #fff;
            color: #555;
            font-size: 13px;
        }

        .shortcode-84 .ess-result-actions {
            margin-top: 15px;
            text-align: center;
        }

        @media (max-width: 767px) {
            .shortcode-84 .calculator-table-form {
                width: 100%;
            }

            .shortcode-84 .question-table-wrapper {
                width: 100%;
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .shortcode-84 .question-table {
                min-width: 650px;
            }

            .shortcode-84 .question-table td {
                padding: 9px 6px;
                font-size: 13px;
            }

            .shortcode-84 .calculator-table-form td {
                padding: 9px 6px;
            }

            .shortcode-84 .calculator-table-form .flat-btn {
                width: 100%;
                max-width: 250px;
            }
        }
    </style>

    @php
        $questions84 = array(
            'Ngồi ở một nơi tương đối yên tĩnh và đọc sách',
            'Xem tivi',
            'Ngồi yên ở một nơi công cộng (Ví dụ: lớp học hoặc cuộc họp)',
            'Là một hành khách ở trên ô tô hoặc xe buýt trong một giờ mà không có gián đoạn',
            'Nằm xuống nghỉ ngơi trong ngày',
            'Ngồi và nói chuyện với ai đó',
            'Ngồi yên tĩnh sau bữa trưa không có đồ uống có cồn',
            'Trong ô tô, khi dừng lại ít phút vì tình trạng giao thông'
        );
    @endphp

    <div class="content">
        <div class="calculator-table-form blue" id="ess_gendercolor_84">
            <form class="ess-form-84" action="javascript:void(0);" novalidate>

                <table cellpadding="5" width="100%">
                    <tbody>
                        <tr class="table-head">
                            <td colspan="2">Thang đo độ buồn ngủ</td>
                        </tr>

                        <tr>
                            <td width="50%">
                                <strong>Giới tính</strong>
                                <span class="required">*</span>
                            </td>
                            <td>
                                <label>
                                    <input type="radio" name="sex_84" value="male">
                                    Nam
                                </label>

                                <label>
                                    <input type="radio" name="sex_84" value="female">
                                    Nữ
                                </label>
                            </td>
                        </tr>

                        <tr>
                            <td width="50%">
                                <strong>Chọn tuổi của bạn</strong>
                                <span class="required">*</span>
                            </td>
                            <td>
                                <select name="age_84" class="age-84">
                                    <option value="">Chọn tuổi</option>

                                    @for($i = 10; $i <= 80; $i++)
                                        <option value="{{ $i }}">
                                            {{ $i }}
                                        </option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="question-table-wrapper">
                    <table cellpadding="5" cellspacing="0" class="question-table">
                        <tbody>
                            <tr class="table-head">
                                <td width="40%" align="center">
                                    <strong>Tình trạng</strong>
                                </td>

                                <td width="15%" align="center">
                                    <strong>Không có cơ hội ngủ gật</strong>
                                </td>

                                <td width="15%" align="center">
                                    <strong>Cơ hội ngủ gật nhẹ</strong>
                                </td>

                                <td width="15%" align="center">
                                    <strong>Cơ hội ngủ gật vừa</strong>
                                </td>

                                <td width="15%" align="center">
                                    <strong>Cơ hội ngủ gật cao</strong>
                                </td>
                            </tr>

                            @foreach($questions84 as $index => $question)
                                <tr>
                                    <td height="50">
                                        {{ $index + 1 }}. {{ $question }}
                                        <span style="color:red;">*</span>
                                    </td>

                                    @for($score = 0; $score <= 3; $score++)
                                        <td align="center">
                                            <label>
                                                <input
                                                    type="radio"
                                                    name="rd{{ $index + 1 }}_84"
                                                    value="{{ $score }}">
                                            </label>
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach

                            <tr>
                                <td colspan="5" align="center">
                                    <input
                                        type="button"
                                        value="Nộp kết quả"
                                        class="flat-btn ess-submit-84">
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="required">
                    * Tất cả các câu hỏi là bắt buộc
                </div>

                <div class="ess-error" role="alert"></div>
            </form>
        </div>

        <!-- KẾT QUẢ -->
        <div class="calculator-table-form blue result-box ess-result-84">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                    <tr class="table-head">
                        <td style="text-align:center;">
                            Thang đo mức độ buồn ngủ Epworth
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <div class="result-text">
                                <div class="ess-result-total"></div>
                                <div class="ess-total-84"></div>

                                <br>

                                <strong class="ess-content-84"></strong>

                                <div class="ess-result-note">
                                    Đây là công cụ sàng lọc tham khảo, không
                                    thay thế chẩn đoán của bác sĩ. Nếu bạn
                                    thường xuyên buồn ngủ ban ngày, ngủ gật
                                    khi lái xe hoặc ảnh hưởng đến công việc,
                                    hãy trao đổi với bác sĩ để được đánh giá.
                                </div>

                                <div class="ess-result-actions">
                                    <button
                                        type="button"
                                        class="flat-btn ess-restart-84">
                                        Làm lại
                                    </button>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
    (function () {
        'use strict';

        function initEss84() {
            var calculators = document.querySelectorAll('.shortcode-84');

            for (var c = 0; c < calculators.length; c++) {
                var wrapper = calculators[c];

                if (wrapper.getAttribute('data-initialized') === '1') {
                    continue;
                }

                wrapper.setAttribute('data-initialized', '1');

                (function (root) {
                    var form = root.querySelector('.ess-form-84');
                    var resultBox = root.querySelector('.ess-result-84');
                    var errorBox = root.querySelector('.ess-error');

                    if (!form || !resultBox) {
                        return;
                    }

                    /*
                     * Cuộn đến vị trí phần tử
                     */
                    function scrollToElement(element) {
                        if (!element) {
                            return;
                        }

                        var rect = element.getBoundingClientRect();
                        var scrollTop = window.pageYOffset ||
                            document.documentElement.scrollTop;

                        window.scrollTo({
                            top: Math.max(0, scrollTop + rect.top - 90),
                            behavior: 'smooth'
                        });
                    }

                    /*
                     * Hiển thị lỗi
                     */
                    function showError(message) {
                        errorBox.textContent = message;
                        errorBox.style.display = 'block';
                        scrollToElement(errorBox);
                    }

                    /*
                     * Ẩn lỗi
                     */
                    function hideError() {
                        errorBox.textContent = '';
                        errorBox.style.display = 'none';
                    }

                    /*
                     * Cập nhật màu đáp án được chọn
                     */
                    function updateSelectedLabels() {
                        var labels = root.querySelectorAll(
                            '.question-table label'
                        );

                        for (var i = 0; i < labels.length; i++) {
                            labels[i].classList.remove('active');
                        }

                        var checkedInputs = root.querySelectorAll(
                            '.question-table input[type="radio"]:checked'
                        );

                        for (var j = 0; j < checkedInputs.length; j++) {
                            var label = checkedInputs[j].closest('label');

                            if (label) {
                                label.classList.add('active');
                            }
                        }
                    }

                    /*
                     * Phân loại kết quả theo code gốc
                     */
                    function getResultContent(total) {
                        if (total <= 10) {
                            return 'Mức độ buồn ngủ bình thường ở người lớn khỏe mạnh.';
                        }

                        if (total <= 14) {
                            return 'Mức độ buồn ngủ nhẹ. Điểm 11 trở lên thể hiện tình trạng buồn ngủ quá mức vào ban ngày, có thể là dấu hiệu của rối loạn giấc ngủ hoặc tình trạng bệnh lý. Nếu bạn đạt 11 điểm trở lên, bác sĩ có thể giới thiệu bạn đến gặp chuyên gia về giấc ngủ.';
                        }

                        if (total <= 17) {
                            return 'Buồn ngủ vừa phải. Điểm 11 trở lên thể hiện tình trạng buồn ngủ quá mức vào ban ngày, có thể là dấu hiệu của rối loạn giấc ngủ hoặc tình trạng bệnh lý. Nếu bạn đạt 11 điểm trở lên, bác sĩ có thể giới thiệu bạn đến gặp chuyên gia về giấc ngủ.';
                        }

                        return 'Buồn ngủ nghiêm trọng. Điểm 11 trở lên thể hiện tình trạng buồn ngủ quá mức vào ban ngày, có thể là dấu hiệu của rối loạn giấc ngủ hoặc tình trạng bệnh lý. Nếu bạn đạt 11 điểm trở lên, bác sĩ có thể giới thiệu bạn đến gặp chuyên gia về giấc ngủ.';
                    }

                    /*
                     * Kiểm tra và tính điểm
                     */
                    function calculateResult() {
                        hideError();

                        var sex = form.querySelector(
                            'input[name="sex_84"]:checked'
                        );

                        var age = form.querySelector(
                            'select[name="age_84"]'
                        ).value;

                        if (!sex) {
                            showError('Bạn chưa chọn giới tính!');
                            return;
                        }

                        if (!age) {
                            showError('Vui lòng chọn tuổi của bạn!');
                            return;
                        }

                        var total = 0;
                        var unanswered = [];

                        for (var i = 1; i <= 8; i++) {
                            var answer = form.querySelector(
                                'input[name="rd' + i + '_84"]:checked'
                            );

                            if (!answer) {
                                unanswered.push(i);
                                continue;
                            }

                            var point = parseInt(answer.value, 10);

                            if (isNaN(point) || point < 0 || point > 3) {
                                unanswered.push(i);
                                continue;
                            }

                            total += point;
                        }

                        if (unanswered.length > 0) {
                            showError(
                                'Bạn còn ' + unanswered.length +
                                ' câu chưa trả lời. Vui lòng hoàn thành đủ 8 câu hỏi!'
                            );
                            return;
                        }

                        /*
                         * Hiển thị kết quả
                         */
                        root.querySelector('.ess-result-total').textContent =
                            'Tổng điểm: ' + total + ' / 24';

                        root.querySelector('.ess-total-84').textContent =
                            'Giới tính: ' +
                            (sex.value === 'male' ? 'Nam' : 'Nữ') +
                            ' | Tuổi: ' + age;

                        root.querySelector('.ess-content-84').textContent =
                            getResultContent(total);

                        form.style.display = 'none';
                        resultBox.style.display = 'block';

                        scrollToElement(resultBox);
                    }

                    /*
                     * Thay đổi đáp án
                     */
                    form.addEventListener('change', function (event) {
                        if (event.target &&
                            event.target.type === 'radio') {
                            updateSelectedLabels();
                            hideError();
                        }

                        if (event.target &&
                            event.target.name === 'age_84') {
                            hideError();
                        }
                    });

                    /*
                     * Nút nộp kết quả
                     */
                    var submitButton = root.querySelector('.ess-submit-84');

                    submitButton.addEventListener('click', function () {
                        calculateResult();
                    });

                    /*
                     * Nút làm lại
                     */
                    var restartButton = root.querySelector('.ess-restart-84');

                    restartButton.addEventListener('click', function () {
                        form.reset();

                        form.style.display = 'block';
                        resultBox.style.display = 'none';

                        updateSelectedLabels();
                        hideError();

                        scrollToElement(root);
                    });

                    /*
                     * Khởi tạo
                     */
                    updateSelectedLabels();
                })(wrapper);
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initEss84);
        } else {
            initEss84();
        }
    })();
    </script>
</div>
