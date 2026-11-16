
<div class="sc76-wrapper" id="eating-disorder-76">

    <style>
        #eating-disorder-76 {
            max-width: 900px;
            margin: 20px auto;
            color: #333;
            font-size: 14px;
            line-height: 1.6;
        }

        #eating-disorder-76 * {
            box-sizing: border-box;
        }

        #eating-disorder-76 .calculator-table-form {
            margin: 0 auto 20px;
            color: #000;
            width: 100%;
            line-height: 1.6;
        }

        #eating-disorder-76 .calculator-table-form table {
            width: 100%;
            color: #000;
            border-collapse: collapse;
            border-spacing: 0;
        }

        #eating-disorder-76 .calculator-table-form td {
            border-left: 1px solid #fff;
            border-right: 0;
            border-bottom: 1px solid #fff;
            padding: 11px 9px;
            vertical-align: middle;
            text-align: left;
        }

        #eating-disorder-76 .calculator-table-form td:first-child {
            border-left: none;
        }

        #eating-disorder-76 .calculator-table-form tr:last-child td {
            border-bottom: none;
        }

        #eating-disorder-76 .calculator-table-form.blue table {
            background: #E6F4FE;
            border: 1px solid #0F5885;
        }

        #eating-disorder-76 .calculator-table-form.pink table {
            background: #FBE4FD;
            border: 1px solid #AD0054;
        }

        #eating-disorder-76 .calculator-table-form.blue td:first-child {
            background: #CFEAFC;
        }

        #eating-disorder-76 .calculator-table-form.pink td:first-child {
            background: #FFD6EB;
        }

        #eating-disorder-76 .calculator-table-form tr.table-head td {
            color: #fff;
            font-weight: bold;
        }

        #eating-disorder-76 .calculator-table-form.blue tr.table-head td {
            background: #0F5885;
        }

        #eating-disorder-76 .calculator-table-form.pink tr.table-head td {
            background: #AD0054;
        }

        #eating-disorder-76 .calculator-table-form input[type="radio"] {
            width: 16px;
            height: 16px;
            margin: 0;
            accent-color: #0F5885;
            cursor: pointer;
        }

        #eating-disorder-76.sc76-female .calculator-table-form input[type="radio"] {
            accent-color: #AD0054;
        }

        #eating-disorder-76 .calculator-table-form label {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            margin: 4px 12px 4px 0;
            cursor: pointer;
            font-weight: normal;
        }

        #eating-disorder-76 .calculator-table-form .flat-btn {
            border: 0;
            color: #fff;
            margin: 0 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            padding: 10px 22px;
            display: inline-block;
            background: #0F5885;
            border-radius: 5px;
            transition: .2s;
        }

        #eating-disorder-76 .calculator-table-form.pink .flat-btn {
            background: #AD0054;
        }

        #eating-disorder-76 .calculator-table-form.blue .flat-btn:hover {
            background: #0779A3;
        }

        #eating-disorder-76 .calculator-table-form.pink .flat-btn:hover {
            background: #D62060;
        }

        #eating-disorder-76 .required {
            color: #B30000;
            display: block;
            margin-bottom: 8px;
        }

        #eating-disorder-76 .mandatory-star {
            color: #f00;
        }

        #eating-disorder-76 select {
            width: 100%;
            max-width: 200px;
            height: 40px;
            padding: 6px 10px;
            border: 1px solid #ccd5df;
            border-radius: 5px;
            background: #fff;
            color: #333;
            font-size: 14px;
        }

        #eating-disorder-76 .question-table td {
            padding: 13px 10px;
        }

        #eating-disorder-76 .question-table td:first-child {
            background: transparent;
        }

        #eating-disorder-76 .question-table tr:first-child td {
            background: #0F5885;
            color: #fff;
            font-weight: 600;
            text-align: center;
        }

        #eating-disorder-76.sc76-female .question-table tr:first-child td {
            background: #AD0054;
        }

        #eating-disorder-76 .question-table td:nth-child(2),
        #eating-disorder-76 .question-table td:nth-child(3) {
            text-align: center;
            vertical-align: middle;
        }

        #eating-disorder-76 .question-table tr:hover td {
            background-color: rgba(255,255,255,.4);
        }

        #eating-disorder-76 .sc76-intro {
            margin-bottom: 15px;
            color: #555;
        }

        #eating-disorder-76 .sc76-error {
            display: none;
            margin: 12px 0;
            padding: 10px 12px;
            background: #fff0f0;
            border: 1px solid #f1cccc;
            border-radius: 5px;
            color: #b42318;
        }

        #eating-disorder-76 .result-box {
            padding-top: 10px;
            display: none;
        }

        #eating-disorder-76 .sc76-result-content {
            padding: 18px;
            line-height: 1.8;
            text-align: center;
        }

        #eating-disorder-76 .sc76-result-content strong {
            font-size: 16px;
        }

        #eating-disorder-76 .sc76-result-score {
            display: inline-block;
            padding: 6px 15px;
            margin-bottom: 12px;
            border-radius: 20px;
            background: #e1f1fb;
            color: #12649a;
            font-size: 15px;
            font-weight: 700;
        }

        #eating-disorder-76.sc76-female .sc76-result-score {
            background: #fce5ef;
            color: #a43b68;
        }

        #eating-disorder-76 .sc76-note {
            margin-top: 15px;
            padding: 12px 14px;
            border-left: 4px solid #e2a329;
            background: #fff8e8;
            color: #70520d;
            border-radius: 4px;
            font-size: 13px;
            line-height: 1.7;
        }

        #eating-disorder-76 .sc76-actions {
            text-align: center;
            padding: 14px 8px !important;
        }

        @media(max-width: 767px) {
            #eating-disorder-76 .calculator-table-form {
                width: 100%;
            }

            #eating-disorder-76 .calculator-table-form table {
                font-size: 13px;
            }

            #eating-disorder-76 .calculator-table-form td {
                padding: 10px 7px;
            }

            #eating-disorder-76 .question-table td:first-child {
                width: auto;
            }

            #eating-disorder-76 .question-table td:nth-child(2),
            #eating-disorder-76 .question-table td:nth-child(3) {
                width: 55px;
            }

            #eating-disorder-76 .calculator-table-form .flat-btn {
                width: 100%;
                margin: 5px 0;
            }

            #eating-disorder-76 .sc76-actions {
                text-align: left;
            }
        }
    </style>

    <div class="sc76-intro">
        Bài kiểm tra dưới đây giúp bạn tự đánh giá một số biểu hiện có thể
        liên quan đến rối loạn ăn uống, bao gồm chứng biếng ăn và chứng
        ăn uống vô độ. Hãy trả lời trung thực theo tình trạng của bản thân.
    </div>

    <!-- FORM KIỂM TRA -->
    <div class="calculator-table-form blue" id="gendercolor_76">

        <form id="eating_form_76" autocomplete="off">

            <!-- THÔNG TIN CÁ NHÂN -->
            <table cellpadding="5" width="100%">
                <tbody>

                    <tr class="table-head">
                        <td colspan="2">
                            Thông tin cá nhân
                        </td>
                    </tr>

                    <tr>
                        <td width="40%">
                            <strong>Giới tính</strong>
                            <span class="mandatory-star">*</span>
                        </td>

                        <td>
                            <label>
                                <input type="radio" name="sex_76" value="male">
                                Nam
                            </label>

                            <label>
                                <input type="radio" name="sex_76" value="female">
                                Nữ
                            </label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <strong>Chọn tuổi của bạn</strong>
                            <span class="mandatory-star">*</span>
                        </td>

                        <td>
                            <select name="age_76" id="age_76">
                                <option value="-1">Chọn tuổi</option>

                                @for($age = 10; $age <= 80; $age++)
                                    <option value="{{ $age }}">
                                        {{ $age }} tuổi
                                    </option>
                                @endfor
                            </select>
                        </td>
                    </tr>

                </tbody>
            </table>

            <!-- CÂU HỎI -->
            <table
                cellspacing="0"
                cellpadding="5"
                border="0"
                width="100%"
                class="question-table"
            >
                <tbody>

                    <tr>
                        <td width="70%">
                            Trả lời tất cả các câu hỏi
                        </td>

                        <td width="15%">
                            Có
                        </td>

                        <td width="15%">
                            Không
                        </td>
                    </tr>

                    <tr>
                        <td height="50">
                            1. Bạn có cảm thấy khó chịu, bứt rứt khi ăn quá nhiều hay không?
                            <span class="mandatory-star">*</span>
                        </td>

                        <td>
                            <input
                                name="rd1_76"
                                type="radio"
                                value="1"
                                aria-label="Câu 1 - Có"
                            >
                        </td>

                        <td>
                            <input
                                name="rd1_76"
                                type="radio"
                                value="0"
                                aria-label="Câu 1 - Không"
                            >
                        </td>
                    </tr>

                    <tr>
                        <td height="50">
                            2. Bạn có lo lắng rằng mình mất kiểm soát ăn uống hay không?
                            <span class="mandatory-star">*</span>
                        </td>

                        <td>
                            <input
                                name="rd2_76"
                                type="radio"
                                value="1"
                                aria-label="Câu 2 - Có"
                            >
                        </td>

                        <td>
                            <input
                                name="rd2_76"
                                type="radio"
                                value="0"
                                aria-label="Câu 2 - Không"
                            >
                        </td>
                    </tr>

                    <tr>
                        <td height="50">
                            3. Trong vòng 3 tháng gần đây, bạn có tụt 5kg cân nặng của mình hay không?
                            <span class="mandatory-star">*</span>
                        </td>

                        <td>
                            <input
                                name="rd3_76"
                                type="radio"
                                value="1"
                                aria-label="Câu 3 - Có"
                            >
                        </td>

                        <td>
                            <input
                                name="rd3_76"
                                type="radio"
                                value="0"
                                aria-label="Câu 3 - Không"
                            >
                        </td>
                    </tr>

                    <tr>
                        <td height="50">
                            4. Bạn có tin rằng bản thân mình béo nhưng người xung quanh lại nói bạn quá gầy hay không?
                            <span class="mandatory-star">*</span>
                        </td>

                        <td>
                            <input
                                name="rd4_76"
                                type="radio"
                                value="1"
                                aria-label="Câu 4 - Có"
                            >
                        </td>

                        <td>
                            <input
                                name="rd4_76"
                                type="radio"
                                value="0"
                                aria-label="Câu 4 - Không"
                            >
                        </td>
                    </tr>

                    <tr>
                        <td height="50">
                            5. Bạn có cho rằng thức ăn thống trị cuộc sống của bạn hay không?
                            <span class="mandatory-star">*</span>
                        </td>

                        <td>
                            <input
                                name="rd5_76"
                                type="radio"
                                value="1"
                                aria-label="Câu 5 - Có"
                            >
                        </td>

                        <td>
                            <input
                                name="rd5_76"
                                type="radio"
                                value="0"
                                aria-label="Câu 5 - Không"
                            >
                        </td>
                    </tr>

                    <tr>
                        <td colspan="3" class="sc76-actions">

                            <span class="required">
                                (* Yêu cầu trả lời đầy đủ)
                            </span>

                            <button
                                type="submit"
                                class="flat-btn"
                                id="submit_btn_76"
                            >
                                Kiểm tra kết quả
                            </button>

                            <button
                                type="reset"
                                class="flat-btn"
                            >
                                Nhập lại
                            </button>

                        </td>
                    </tr>

                </tbody>
            </table>

            <div class="sc76-error" role="alert"></div>

        </form>
    </div>

    <!-- PHẦN KẾT QUẢ -->
    <div class="calculator-table-form blue result-box" id="form_kq2_76">

        <table cellpadding="0" cellspacing="0" width="100%">

            <tbody>

                <tr class="table-head">
                    <td colspan="2" style="text-align:center;">
                        Kết quả - Kiểm tra chứng biếng ăn và chứng háu ăn
                    </td>
                </tr>

                <tr>
                    <td colspan="2">

                        <div class="sc76-result-content">

                            Cảm ơn bạn đã hoàn thành bài kiểm tra.

                            <br><br>

                            <div class="sc76-result-score">
                                Tổng điểm:
                                <span class="sc76-total">0</span>/5
                            </div>

                            <br>

                            <strong class="sc76-result-text"></strong>

                        </div>

                    </td>
                </tr>

            </tbody>

        </table>

        <div class="sc76-note">
            <strong>Lưu ý:</strong>
            Đây là công cụ tự sàng lọc tham khảo, không phải phương pháp
            chẩn đoán rối loạn ăn uống. Kết quả không thể xác định chắc chắn
            bạn có mắc chứng biếng ăn hoặc ăn uống vô độ hay không.
            Nếu bạn có những thay đổi bất thường về cân nặng, hành vi ăn uống
            hoặc cảm xúc liên quan đến thức ăn, hãy trao đổi với bác sĩ
            chuyên khoa Tâm thần hoặc chuyên gia Dinh dưỡng để được đánh giá.
        </div>

    </div>

    <script>
    (function () {
        'use strict';

        function initEating76() {

            var root = document.getElementById('eating-disorder-76');

            if (!root || root.getAttribute('data-sc76-init') === '1') {
                return;
            }

            root.setAttribute('data-sc76-init', '1');

            var form = root.querySelector('#eating_form_76');
            var genderBox = root.querySelector('#gendercolor_76');
            var resultBox = root.querySelector('#form_kq2_76');
            var ageSelect = root.querySelector('#age_76');
            var errorBox = root.querySelector('.sc76-error');

            var totalElement = root.querySelector('.sc76-total');
            var resultText = root.querySelector('.sc76-result-text');

            if (
                !form ||
                !genderBox ||
                !resultBox ||
                !ageSelect ||
                !errorBox
            ) {
                return;
            }

            // Hiển thị thông báo lỗi.
            function showError(message, target) {

                errorBox.textContent = message;
                errorBox.style.display = 'block';

                if (target) {
                    target.focus();
                }
            }

            // Ẩn thông báo lỗi.
            function hideError() {

                errorBox.textContent = '';
                errorBox.style.display = 'none';
            }

            // Ẩn kết quả cũ.
            function hideResult() {

                resultBox.style.display = 'none';

                totalElement.textContent = '0';
                resultText.textContent = '';
            }

            // Đổi màu giao diện theo giới tính.
            var genderInputs = form.querySelectorAll(
                'input[name="sex_76"]'
            );

            Array.prototype.forEach.call(
                genderInputs,
                function (input) {

                    input.addEventListener('change', function () {

                        var colorClass = this.value === 'female'
                            ? 'pink'
                            : 'blue';

                        genderBox.classList.remove('blue', 'pink');
                        genderBox.classList.add(colorClass);

                        resultBox.classList.remove('blue', 'pink');
                        resultBox.classList.add(colorClass);

                        root.classList.remove(
                            'sc76-male',
                            'sc76-female'
                        );

                        root.classList.add(
                            this.value === 'female'
                                ? 'sc76-female'
                                : 'sc76-male'
                        );

                        hideError();
                        hideResult();

                    });

                }
            );

            // Khi người dùng thay đổi câu trả lời.
            form.addEventListener('change', function (event) {

                var target = event.target;

                if (
                    target &&
                    (
                        target.type === 'radio' ||
                        target.tagName === 'SELECT'
                    )
                ) {
                    hideError();
                    hideResult();
                }

            });

            // Xử lý nút kiểm tra.
            form.addEventListener('submit', function (event) {

                event.preventDefault();

                hideError();

                // 1. Kiểm tra giới tính.
                var sex = form.querySelector(
                    'input[name="sex_76"]:checked'
                );

                if (!sex) {

                    showError(
                        'Bạn chưa chọn giới tính!',
                        genderInputs[0]
                    );

                    return;
                }

                // 2. Kiểm tra tuổi.
                var age = ageSelect.value;

                if (!age || age === '-1') {

                    showError(
                        'Vui lòng chọn tuổi của bạn!',
                        ageSelect
                    );

                    return;
                }

                // 3. Kiểm tra và tính tổng điểm.
                var total = 0;
                var unanswered = [];

                for (var i = 1; i <= 5; i++) {

                    var answer = form.querySelector(
                        'input[name="rd' + i + '_76"]:checked'
                    );

                    if (!answer) {

                        unanswered.push(i);

                    } else {

                        total += parseInt(answer.value, 10);

                    }

                }

                // 4. Kiểm tra câu hỏi chưa trả lời.
                if (unanswered.length > 0) {

                    showError(
                        'Bạn chưa trả lời đầy đủ 5 câu hỏi. ' +
                        'Các câu chưa trả lời: ' +
                        unanswered.join(', ') + '.'
                    );

                    return;
                }

                // 5. Phân loại kết quả.
                var result = '';

                if (total <= 1) {

                    result =
                        'Bạn không có xu hướng mắc chứng biếng ăn hay chứng ' +
                        'háu ăn theo kết quả bảng hỏi này. Tuy nhiên, nếu bạn ' +
                        'nghi ngờ mình gặp phải rối loạn ăn uống, hãy đến gặp ' +
                        'bác sĩ chuyên khoa Tâm thần, Dinh dưỡng hoặc Tiêu hóa ' +
                        'để được đánh giá.';

                } else {

                    result =
                        'Bạn có khả năng có các dấu hiệu liên quan đến chứng ' +
                        'biếng ăn hoặc chứng háu ăn. Bạn nên đến gặp bác sĩ ' +
                        'chuyên khoa Tâm thần hoặc Tiêu hóa để được đánh giá ' +
                        'và tư vấn.';

                }

                // 6. Hiển thị kết quả.
                totalElement.textContent = total;
                resultText.textContent = result;

                resultBox.style.display = 'block';

                // 7. Cuộn đến phần kết quả.
                setTimeout(function () {

                    var rect = resultBox.getBoundingClientRect();

                    var scrollTop = window.pageYOffset ||
                        document.documentElement.scrollTop;

                    window.scrollTo({
                        top: scrollTop + rect.top - 100,
                        behavior: 'smooth'
                    });

                }, 100);

            });

            // 8. Xử lý nút nhập lại.
            form.addEventListener('reset', function () {

                setTimeout(function () {

                    hideError();
                    hideResult();

                    genderBox.classList.remove('pink');
                    genderBox.classList.add('blue');

                    resultBox.classList.remove('pink');
                    resultBox.classList.add('blue');

                    root.classList.remove(
                        'sc76-male',
                        'sc76-female'
                    );

                }, 0);

            });

        }

        // Khởi tạo khi DOM sẵn sàng.
        if (document.readyState === 'loading') {

            document.addEventListener(
                'DOMContentLoaded',
                initEating76
            );

        } else {

            initEating76();

        }

    })();
    </script>

</div>
