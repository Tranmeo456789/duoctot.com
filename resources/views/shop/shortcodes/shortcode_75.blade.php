
<div class="sc75-wrapper" id="alcohol-screening-75">

    <style>
        #alcohol-screening-75 {
            max-width: 900px;
            margin: 20px auto;
            color: #333;
            font-size: 14px;
            line-height: 1.6;
        }

        #alcohol-screening-75 * {
            box-sizing: border-box;
        }

        #alcohol-screening-75 .calculator-table-form {
            margin: 0 auto 20px;
            color: #000;
            width: 100%;
            line-height: 1.5;
        }

        #alcohol-screening-75 .calculator-table-form table {
            width: 100%;
            color: #000;
            border-collapse: collapse;
            border-spacing: 0;
        }

        #alcohol-screening-75 .calculator-table-form td {
            border-left: 1px solid #fff;
            border-right: 0;
            border-bottom: 1px solid #fff;
            padding: 10px 8px;
            vertical-align: top;
            text-align: left;
        }

        #alcohol-screening-75 .calculator-table-form td:first-child {
            border-left: none;
        }

        #alcohol-screening-75 .calculator-table-form tr:last-child td {
            border-bottom: none;
        }

        #alcohol-screening-75 .calculator-table-form.blue table {
            background: #E6F4FE;
            border: 1px solid #0F5885;
        }

        #alcohol-screening-75 .calculator-table-form.pink table {
            background: #FBE4FD;
            border: 1px solid #AD0054;
        }

        #alcohol-screening-75 .calculator-table-form.blue td:first-child {
            background: #CFEAFC;
        }

        #alcohol-screening-75 .calculator-table-form.pink td:first-child {
            background: #FFD6EB;
        }

        #alcohol-screening-75 .calculator-table-form tr.table-head td {
            color: #fff;
            font-weight: bold;
        }

        #alcohol-screening-75 .calculator-table-form.blue tr.table-head td {
            background: #0F5885;
        }

        #alcohol-screening-75 .calculator-table-form.pink tr.table-head td {
            background: #AD0054;
        }

        #alcohol-screening-75 .calculator-table-form input[type="radio"] {
            margin-right: 5px;
            accent-color: #1677b8;
            cursor: pointer;
        }

        #alcohol-screening-75 .calculator-table-form.pink input[type="radio"] {
            accent-color: #AD0054;
        }

        #alcohol-screening-75 .calculator-table-form label {
            display: inline-flex;
            align-items: center;
            gap: 4px;
            margin: 3px 12px 3px 0;
            cursor: pointer;
            font-weight: normal;
        }

        #alcohol-screening-75 .calculator-table-form .flat-btn {
            border: 0;
            color: #fff;
            margin-left: 5px;
            cursor: pointer;
            font-size: 14px;
            font-weight: 600;
            padding: 10px 22px;
            display: inline-block;
            background: #0F5885;
            border-radius: 5px;
            transition: .2s;
        }

        #alcohol-screening-75 .calculator-table-form.pink .flat-btn {
            background: #AD0054;
        }

        #alcohol-screening-75 .calculator-table-form.blue .flat-btn:hover {
            background: #0779A3;
        }

        #alcohol-screening-75 .calculator-table-form.pink .flat-btn:hover {
            background: #D62060;
        }

        #alcohol-screening-75 .required {
            color: #B30000;
            text-align: left;
            float: left;
            padding-top: 10px;
        }

        #alcohol-screening-75 .mandatory-star {
            color: #f00;
        }

        #alcohol-screening-75 .result-box {
            padding-top: 10px;
            display: none;
        }

        #alcohol-screening-75 .result-box table {
            width: 100%;
        }

        #alcohol-screening-75 .result-score {
            color: #f00;
            font-size: 22px;
            font-weight: bold;
        }

        #alcohol-screening-75 .question-title {
            font-weight: bold;
            display: inline-block;
            margin-bottom: 5px;
        }

        #alcohol-screening-75 select {
            width: 100%;
            max-width: 200px;
            height: 40px;
            padding: 6px 10px;
            border: 1px solid #cbd5df;
            border-radius: 5px;
            background: #fff;
            color: #333;
            font-size: 14px;
        }

        #alcohol-screening-75 .sc75-intro {
            margin-bottom: 15px;
            color: #555;
        }

        #alcohol-screening-75 .sc75-result-content {
            padding: 12px;
            line-height: 1.7;
        }

        #alcohol-screening-75 .sc75-note {
            margin-top: 15px;
            padding: 12px 14px;
            background: #fff8e8;
            border-left: 4px solid #e2a329;
            border-radius: 4px;
            color: #70520d;
            font-size: 13px;
        }

        #alcohol-screening-75 .sc75-error {
            display: none;
            margin: 12px 0;
            padding: 10px 12px;
            background: #fff0f0;
            border: 1px solid #f1cccc;
            border-radius: 5px;
            color: #b42318;
        }

        #alcohol-screening-75 .sc75-actions {
            text-align: center;
            padding: 12px 5px !important;
        }

        @media(max-width: 767px) {
            #alcohol-screening-75 .calculator-table-form {
                width: 100%;
            }

            #alcohol-screening-75 .calculator-table-form table {
                font-size: 13px;
            }

            #alcohol-screening-75 .calculator-table-form td {
                padding: 9px 7px;
            }

            #alcohol-screening-75 .calculator-table-form label {
                margin: 4px 8px 4px 0;
            }

            #alcohol-screening-75 .calculator-table-form .flat-btn {
                width: 100%;
                margin: 10px 0 0;
            }

            #alcohol-screening-75 .required {
                float: none;
                display: block;
                padding-top: 0;
            }

            #alcohol-screening-75 .sc75-actions {
                text-align: left;
            }
        }
    </style>

    <div class="sc75-intro">
        Công cụ giúp bạn tự đánh giá mức độ sử dụng bia/rượu thông qua
        các câu hỏi về thói quen uống rượu và những ảnh hưởng liên quan.
        Vui lòng chọn câu trả lời phù hợp nhất với tình trạng của mình.
    </div>

    <div class="calculator-table-form blue" id="gendercolor_75">

        <form id="alcohol_form_75" autocomplete="off">

            <!-- THÔNG TIN CÁ NHÂN -->
            <table cellpadding="5" width="100%">
                <tbody>

                    <tr class="table-head">
                        <td colspan="2">Thông tin cá nhân</td>
                    </tr>

                    <tr>
                        <td width="40%">
                            <strong>Giới tính</strong>
                            <span class="mandatory-star">*</span>
                        </td>

                        <td>
                            <label>
                                <input type="radio" name="sex_75" value="male">
                                Nam
                            </label>

                            <label>
                                <input type="radio" name="sex_75" value="female">
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
                            <select name="age_75" id="age_75">
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
            <table id="ques_75" cellpadding="5" cellspacing="0" width="100%">
                <tbody>

                    <tr class="table-head">
                        <td>
                            Các câu hỏi đánh giá thói quen sử dụng bia/rượu
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b class="question-title">
                                1. Bạn có thường xuyên uống bia/rượu không?
                                <span class="mandatory-star">*</span>
                            </b>
                            <br>

                            <label><input type="radio" name="q1_75" value="0"> Không bao giờ</label><br>
                            <label><input type="radio" name="q1_75" value="1"> Hàng tháng hoặc ít hơn</label><br>
                            <label><input type="radio" name="q1_75" value="2"> 2 đến 4 lần một tháng</label><br>
                            <label><input type="radio" name="q1_75" value="3"> 2 đến 3 lần một tuần</label><br>
                            <label><input type="radio" name="q1_75" value="4"> 4 lần trở lên một tuần</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b class="question-title">
                                2. Thông thường bạn uống bao nhiêu ly mỗi lần bạn ăn nhậu?
                                <span class="mandatory-star">*</span>
                            </b>
                            <br>

                            <label><input type="radio" name="q2_75" value="0"> 1 hoặc 2</label><br>
                            <label><input type="radio" name="q2_75" value="1"> 3 hoặc 4</label><br>
                            <label><input type="radio" name="q2_75" value="2"> 5 hoặc 6</label><br>
                            <label><input type="radio" name="q2_75" value="3"> 7 hoặc 9</label><br>
                            <label><input type="radio" name="q2_75" value="4"> 10 trở lên</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b class="question-title">
                                3. Bạn có thường uống từ 5 ly trở lên mỗi lần nhậu hay không?
                                <span class="mandatory-star">*</span>
                            </b>
                            <br>

                            <label><input type="radio" name="q3_75" value="0"> Không bao giờ</label><br>
                            <label><input type="radio" name="q3_75" value="1"> Ít hơn hàng tháng</label><br>
                            <label><input type="radio" name="q3_75" value="2"> Hàng tháng</label><br>
                            <label><input type="radio" name="q3_75" value="3"> Hàng tuần</label><br>
                            <label><input type="radio" name="q3_75" value="4"> Hàng ngày hoặc gần như hàng ngày</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b class="question-title">
                                4. Trong năm qua, bạn có thường xuyên phát hiện mình không thể ngưng uống rượu/bia khi đã bắt đầu uống hay không?
                                <span class="mandatory-star">*</span>
                            </b>
                            <br>

                            <label><input type="radio" name="q4_75" value="0"> Không bao giờ</label><br>
                            <label><input type="radio" name="q4_75" value="1"> Ít hơn hàng tháng</label><br>
                            <label><input type="radio" name="q4_75" value="2"> Hàng tháng</label><br>
                            <label><input type="radio" name="q4_75" value="3"> Hàng tuần</label><br>
                            <label><input type="radio" name="q4_75" value="4"> Hàng ngày hoặc gần như hàng ngày</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b class="question-title">
                                5. Trong năm qua, bạn có thường xuyên không làm được những điều bình thường (chạy xe, lên cầu thang,...) sau khi đã uống rượu/bia hay không?
                                <span class="mandatory-star">*</span>
                            </b>
                            <br>

                            <label><input type="radio" name="q5_75" value="0"> Không bao giờ</label><br>
                            <label><input type="radio" name="q5_75" value="1"> Ít hơn hàng tháng</label><br>
                            <label><input type="radio" name="q5_75" value="2"> Hàng tháng</label><br>
                            <label><input type="radio" name="q5_75" value="3"> Hàng tuần</label><br>
                            <label><input type="radio" name="q5_75" value="4"> Hàng ngày hoặc gần như hàng ngày</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b class="question-title">
                                6. Trong năm qua, bạn có thường xuyên uống rượu vào buổi sáng để bắt đầu sau một đêm sử dụng nhiều rượu không?
                                <span class="mandatory-star">*</span>
                            </b>
                            <br>

                            <label><input type="radio" name="q6_75" value="0"> Không bao giờ</label><br>
                            <label><input type="radio" name="q6_75" value="1"> Ít hơn hàng tháng</label><br>
                            <label><input type="radio" name="q6_75" value="2"> 2 hay 4 lần hàng tháng</label><br>
                            <label><input type="radio" name="q6_75" value="3"> 2 hay 3 lần hàng tuần</label><br>
                            <label><input type="radio" name="q6_75" value="4"> Trên 4 lần mỗi tuần</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b class="question-title">
                                7. Trong năm qua, bạn có thường xuyên cảm thấy tội lỗi hoặc hối tiếc sau khi uống rượu không?
                                <span class="mandatory-star">*</span>
                            </b>
                            <br>

                            <label><input type="radio" name="q7_75" value="0"> 1 hoặc 2 lần</label><br>
                            <label><input type="radio" name="q7_75" value="1"> 3 hoặc 4 lần</label><br>
                            <label><input type="radio" name="q7_75" value="2"> 5 hoặc 6 lần</label><br>
                            <label><input type="radio" name="q7_75" value="3"> 7 hoặc 9 lần</label><br>
                            <label><input type="radio" name="q7_75" value="4"> Trên 10 lần</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b class="question-title">
                                8. Trong năm qua, bạn có thường xuyên quên những gì đã xảy ra vào đêm hôm trước do rượu không?
                                <span class="mandatory-star">*</span>
                            </b>
                            <br>

                            <label><input type="radio" name="q8_75" value="0"> Không bao giờ</label><br>
                            <label><input type="radio" name="q8_75" value="1"> Ít hơn hàng tháng</label><br>
                            <label><input type="radio" name="q8_75" value="2"> Hàng tháng</label><br>
                            <label><input type="radio" name="q8_75" value="3"> Hàng tuần</label><br>
                            <label><input type="radio" name="q8_75" value="4"> Hàng ngày hoặc gần như hàng ngày</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b class="question-title">
                                9. Bạn hoặc người khác có bị thương bởi hậu quả của uống rượu không?
                                <span class="mandatory-star">*</span>
                            </b>
                            <br>

                            <label><input type="radio" name="q9_75" value="0"> Không</label><br>
                            <label><input type="radio" name="q9_75" value="2"> Có, nhưng không phải trong năm trước</label><br>
                            <label><input type="radio" name="q9_75" value="4"> Có, trong năm ngoái</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <b class="question-title">
                                10. Đã có ai trong gia đình, bạn bè hoặc nhân viên y tế lo lắng về việc uống rượu/bia quá đà của bạn và đề nghị bạn giảm tiêu thụ rượu/bia không?
                                <span class="mandatory-star">*</span>
                            </b>
                            <br>

                            <label><input type="radio" name="q10_75" value="0"> Không</label><br>
                            <label><input type="radio" name="q10_75" value="2"> Có, nhưng không phải trong năm trước</label><br>
                            <label><input type="radio" name="q10_75" value="4"> Có, trong năm ngoái</label>
                        </td>
                    </tr>

                    <tr>
                        <td class="sc75-actions">
                            <span class="required">(* Yêu cầu trả lời đầy đủ)</span>

                            <button type="button" class="flat-btn" id="submit_btn_75">
                                Kiểm tra kết quả
                            </button>

                            <button type="reset" class="flat-btn">
                                Nhập lại
                            </button>
                        </td>
                    </tr>

                </tbody>
            </table>

            <div class="sc75-error" id="error_75" role="alert"></div>

        </form>
    </div>

    <!-- KẾT QUẢ -->
    <div class="calculator-table-form blue result-box" id="form_kq2_75">

        <table>
            <tbody>

                <tr class="table-head">
                    <td colspan="2" align="center">
                        Kết quả tự sàng lọc sử dụng rượu/bia
                    </td>
                </tr>

                <tr>
                    <td width="60%">
                        <strong>Tổng điểm của bạn</strong>
                    </td>

                    <td width="40%" align="center">
                        <span class="result-score" id="total_75">0</span>
                        <span>/40 điểm</span>
                    </td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="sc75-result-content" id="content_75"></div>
                    </td>
                </tr>

            </tbody>
        </table>

        <div class="sc75-note">
            <strong>Lưu ý:</strong>
            Đây là công cụ tự sàng lọc mang tính tham khảo, không phải
            phương pháp chẩn đoán nghiện rượu hoặc rối loạn sử dụng rượu.
            Kết quả không thay thế việc thăm khám và đánh giá của bác sĩ.
            Nếu bạn nhận thấy việc uống rượu bia ảnh hưởng đến sức khỏe,
            công việc hoặc các mối quan hệ, hãy trao đổi với nhân viên y tế
            để được tư vấn phù hợp.
        </div>

    </div>

    <script>
    (function () {
        'use strict';

        function initAlcohol75() {

            var root = document.getElementById('alcohol-screening-75');

            if (!root || root.getAttribute('data-sc75-init') === '1') {
                return;
            }

            root.setAttribute('data-sc75-init', '1');

            var form = root.querySelector('#alcohol_form_75');
            var genderBox = root.querySelector('#gendercolor_75');
            var resultBox = root.querySelector('#form_kq2_75');
            var submitButton = root.querySelector('#submit_btn_75');
            var ageSelect = root.querySelector('#age_75');
            var totalElement = root.querySelector('#total_75');
            var contentElement = root.querySelector('#content_75');
            var errorElement = root.querySelector('#error_75');

            if (!form || !submitButton || !resultBox) {
                return;
            }

            // Ẩn thông báo lỗi.
            function hideError() {
                errorElement.style.display = 'none';
                errorElement.textContent = '';
            }

            // Hiển thị thông báo lỗi.
            function showError(message, target) {
                errorElement.textContent = message;
                errorElement.style.display = 'block';

                if (target) {
                    target.focus();
                }
            }

            // Ẩn kết quả cũ khi người dùng thay đổi thông tin.
            function hideResult() {
                resultBox.style.display = 'none';
                totalElement.textContent = '0';
                contentElement.textContent = '';
            }

            // Đổi màu theo giới tính.
            var genderInputs = root.querySelectorAll(
                'input[name="sex_75"]'
            );

            Array.prototype.forEach.call(genderInputs, function (input) {

                input.addEventListener('change', function () {

                    var colorClass = this.value === 'female'
                        ? 'pink'
                        : 'blue';

                    genderBox.classList.remove('blue', 'pink');
                    genderBox.classList.add(colorClass);

                    resultBox.classList.remove('blue', 'pink');
                    resultBox.classList.add(colorClass);

                    hideError();
                    hideResult();
                });

            });

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
            submitButton.addEventListener('click', function (event) {

                event.preventDefault();

                hideError();

                // 1. Kiểm tra giới tính.
                var sex = form.querySelector(
                    'input[name="sex_75"]:checked'
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

                // 3. Kiểm tra và tính điểm.
                var total = 0;
                var unanswered = [];

                for (var i = 1; i <= 10; i++) {

                    var answer = form.querySelector(
                        'input[name="q' + i + '_75"]:checked'
                    );

                    if (!answer) {
                        unanswered.push(i);
                    } else {
                        total += parseInt(answer.value, 10);
                    }

                }

                // 4. Báo các câu chưa trả lời.
                if (unanswered.length > 0) {

                    showError(
                        'Bạn chưa trả lời đầy đủ 10 câu hỏi. ' +
                        'Các câu chưa trả lời: ' +
                        unanswered.join(', ') + '.'
                    );

                    return;
                }

                // 5. Phân loại kết quả theo điểm.
                var result = '';

                if (total <= 7) {

                    result =
                        'Rủi ro thấp. Có thể bạn không gặp vấn đề với rượu. ' +
                        'Hãy uống có chừng mực hoặc không uống.';

                } else if (total <= 15) {

                    result =
                        'Rủi ro trung bình. Đôi khi bạn có thể uống quá nhiều. ' +
                        'Điều này có thể khiến bạn hoặc những người khác gặp rủi ro. ' +
                        'Cố gắng cắt giảm rượu hoặc ngừng uống rượu hoàn toàn.';

                } else if (total <= 19) {

                    result =
                        'Rủi ro cao. Việc uống rượu có thể gây hại cho bạn. ' +
                        'Điều quan trọng là bạn phải cắt giảm lượng rượu hoặc ' +
                        'ngừng uống rượu hoàn toàn. Hãy hỏi bác sĩ để được tư vấn ' +
                        'về cách tốt nhất để cắt giảm.';

                } else {

                    result =
                        'Có thể bạn đang gặp vấn đề nghiêm trọng liên quan đến ' +
                        'việc sử dụng rượu. Việc sử dụng rượu có thể gây hại cho bạn. ' +
                        'Hãy trao đổi với bác sĩ hoặc chuyên gia y tế để được đánh giá ' +
                        'và hỗ trợ.';

                }

                // 6. Hiển thị kết quả.
                totalElement.textContent = total;
                contentElement.textContent = result;

                resultBox.style.display = 'block';

                // 7. Cuộn đến kết quả.
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

                }, 0);

            });

        }

        // Khởi tạo khi DOM sẵn sàng.
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initAlcohol75);
        } else {
            initAlcohol75();
        }

    })();
    </script>

</div>
