
<div class="sc73-wrapper" id="adhd-screening-73">

    <style>
        #adhd-screening-73 {
            max-width: 900px;
            margin: 20px auto;
            color: #333;
            font-size: 14px;
            line-height: 1.6;
        }

        #adhd-screening-73 * {
            box-sizing: border-box;
        }

        #adhd-screening-73 .sc73-card {
            background: #fff;
            border: 1px solid #dce5ed;
            border-radius: 9px;
            overflow: hidden;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
        }

        #adhd-screening-73 .sc73-heading {
            padding: 14px 18px;
            background: #0F5885;
            color: #fff;
            font-size: 17px;
            font-weight: 600;
        }

        #adhd-screening-73.sc73-female .sc73-heading {
            background: #AD0054;
        }

        #adhd-screening-73 .sc73-body {
            padding: 18px;
        }

        #adhd-screening-73 .sc73-intro {
            margin: 0 0 16px;
            color: #555;
        }

        #adhd-screening-73 .sc73-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            color: #333;
        }

        #adhd-screening-73 .sc73-table td,
        #adhd-screening-73 .sc73-table th {
            padding: 11px 9px;
            border-bottom: 1px solid #e9edf1;
            vertical-align: middle;
            text-align: left;
        }

        #adhd-screening-73 .sc73-table th {
            background: #edf5fb;
            color: #244b66;
            font-weight: 600;
            text-align: center;
        }

        #adhd-screening-73.sc73-female .sc73-table th {
            background: #fff0f6;
            color: #8f365c;
        }

        #adhd-screening-73 .sc73-table tr:last-child td {
            border-bottom: none;
        }

        #adhd-screening-73 .sc73-label {
            font-weight: 600;
        }

        #adhd-screening-73 .sc73-required {
            color: #dc3545;
        }

        #adhd-screening-73 .sc73-radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 20px;
        }

        #adhd-screening-73 .sc73-radio-group label {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            font-weight: normal;
            margin: 0;
        }

        #adhd-screening-73 input[type="radio"] {
            width: 16px;
            height: 16px;
            margin: 0;
            accent-color: #0F5885;
            cursor: pointer;
        }

        #adhd-screening-73.sc73-female input[type="radio"] {
            accent-color: #AD0054;
        }

        #adhd-screening-73 .sc73-section-title {
            margin: 22px 0 10px;
            color: #0F5885;
            font-size: 16px;
            font-weight: 600;
        }

        #adhd-screening-73.sc73-female .sc73-section-title {
            color: #AD0054;
        }

        #adhd-screening-73 .sc73-question-scroll {
            width: 100%;
            overflow-x: auto;
            -webkit-overflow-scrolling: touch;
        }

        #adhd-screening-73 .sc73-question-table {
            table-layout: fixed;
            min-width: 650px;
        }

        #adhd-screening-73 .sc73-question-table th:first-child {
            width: 38px;
        }

        #adhd-screening-73 .sc73-question-table th:nth-child(2) {
            width: 40%;
            text-align: left;
        }

        #adhd-screening-73 .sc73-question-table td {
            text-align: center;
        }

        #adhd-screening-73 .sc73-question-table td:nth-child(2) {
            text-align: left;
        }

        #adhd-screening-73 .sc73-question-table td:first-child {
            color: #777;
        }

        #adhd-screening-73 .sc73-question-table tr:hover td {
            background: #f8fbfd;
        }

        #adhd-screening-73 .sc73-question-table input[type="radio"] {
            display: inline-block;
        }

        #adhd-screening-73 .sc73-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        #adhd-screening-73 .sc73-btn {
            display: inline-block;
            border: 0;
            border-radius: 5px;
            padding: 11px 24px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
        }

        #adhd-screening-73 .sc73-btn-primary {
            background: #0F5885;
            color: #fff;
        }

        #adhd-screening-73.sc73-female .sc73-btn-primary {
            background: #AD0054;
        }

        #adhd-screening-73 .sc73-btn-primary:hover {
            opacity: .88;
        }

        #adhd-screening-73 .sc73-btn-reset {
            background: #edf0f3;
            color: #444;
        }

        #adhd-screening-73 .sc73-btn-reset:hover {
            background: #dfe4e8;
        }

        #adhd-screening-73 .sc73-error {
            display: none;
            margin-top: 14px;
            padding: 10px 12px;
            background: #fff0f0;
            border: 1px solid #f1cccc;
            border-radius: 5px;
            color: #b42318;
        }

        #adhd-screening-73 .sc73-result {
            display: none;
        }

        #adhd-screening-73 .sc73-result-content {
            padding: 16px;
            border-radius: 7px;
            background: #f1f7fc;
            border-left: 4px solid #0F5885;
            line-height: 1.7;
        }

        #adhd-screening-73.sc73-female .sc73-result-content {
            background: #fff3f7;
            border-left-color: #AD0054;
        }

        #adhd-screening-73 .sc73-score {
            display: inline-block;
            margin-bottom: 14px;
            padding: 7px 15px;
            border-radius: 20px;
            background: #e1f1fb;
            color: #12649a;
            font-size: 15px;
            font-weight: 700;
        }

        #adhd-screening-73.sc73-female .sc73-score {
            background: #fce5ef;
            color: #a43b68;
        }

        #adhd-screening-73 .sc73-result-content p {
            margin: 8px 0;
        }

        #adhd-screening-73 .sc73-note {
            margin-top: 15px;
            padding: 12px 14px;
            border-left: 4px solid #e2a329;
            background: #fff8e8;
            color: #70520d;
            border-radius: 4px;
            font-size: 13px;
            line-height: 1.7;
        }

        @media(max-width: 650px) {
            #adhd-screening-73 .sc73-body {
                padding: 12px;
            }

            #adhd-screening-73 .sc73-heading {
                font-size: 16px;
                padding: 13px 14px;
            }

            #adhd-screening-73 .sc73-table td,
            #adhd-screening-73 .sc73-table th {
                padding: 9px 6px;
                font-size: 12px;
            }

            #adhd-screening-73 .sc73-radio-group {
                gap: 10px 14px;
            }

            #adhd-screening-73 .sc73-actions {
                flex-direction: column;
            }

            #adhd-screening-73 .sc73-btn {
                width: 100%;
            }
        }
    </style>

    <!-- PHẦN FORM -->
    <div class="sc73-card">

        <div class="sc73-heading">
            Trắc nghiệm sàng lọc ADHD dành cho người lớn
        </div>

        <div class="sc73-body">

            <p class="sc73-intro">
                Bài kiểm tra dưới đây giúp bạn tự đánh giá một số biểu hiện
                thường gặp liên quan đến rối loạn tăng động giảm chú ý (ADHD)
                ở người trưởng thành. Hãy lựa chọn câu trả lời phù hợp nhất
                với tình trạng của bản thân.
            </p>

            <form class="sc73-form" autocomplete="off">

                <!-- GIỚI TÍNH -->
                <table class="sc73-table">
                    <tbody>

                        <tr>
                            <td colspan="2" style="font-weight:600;background:#f5f8fa;">
                                Nhập thông tin của bạn
                            </td>
                        </tr>

                        <tr>
                            <td width="35%">
                                <span class="sc73-label">
                                    Giới tính
                                    <span class="sc73-required">*</span>
                                </span>
                            </td>

                            <td>
                                <div class="sc73-radio-group">
                                    <label>
                                        <input type="radio" name="sex_73" value="male">
                                        Nam
                                    </label>

                                    <label>
                                        <input type="radio" name="sex_73" value="female">
                                        Nữ
                                    </label>
                                </div>
                            </td>
                        </tr>

                    </tbody>
                </table>

                <!-- CÂU HỎI -->
                <div class="sc73-section-title">
                    Các câu hỏi đánh giá
                </div>

                <p>
                    Vui lòng chọn một đáp án cho mỗi câu hỏi.
                    Bạn cần hoàn thành cả 6 câu để xem kết quả.
                </p>

                <div class="sc73-question-scroll">

                    <table class="sc73-table sc73-question-table">

                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Câu hỏi</th>
                                <th>Không bao giờ</th>
                                <th>Hiếm khi</th>
                                <th>Thỉnh thoảng</th>
                                <th>Thường xuyên</th>
                                <th>Rất thường xuyên</th>
                            </tr>
                        </thead>

                        <tbody>

                            <tr>
                                <td>1.</td>
                                <td>
                                    Bạn có thường xuyên trì hoãn việc hoàn thành
                                    một dự án ngay cả khi các thách thức đã hoàn thành không?
                                </td>

                                <td><input type="radio" name="rd1_73" value="0" aria-label="Câu 1 - Không bao giờ"></td>
                                <td><input type="radio" name="rd1_73" value="0" aria-label="Câu 1 - Hiếm khi"></td>
                                <td><input type="radio" name="rd1_73" value="1" aria-label="Câu 1 - Thỉnh thoảng"></td>
                                <td><input type="radio" name="rd1_73" value="1" aria-label="Câu 1 - Thường xuyên"></td>
                                <td><input type="radio" name="rd1_73" value="1" aria-label="Câu 1 - Rất thường xuyên"></td>
                            </tr>

                            <tr>
                                <td>2.</td>
                                <td>
                                    Bạn có thường gặp khó khăn trong việc sắp xếp
                                    mọi thứ theo thứ tự khi một nhiệm vụ yêu cầu tổ chức không?
                                </td>

                                <td><input type="radio" name="rd2_73" value="0" aria-label="Câu 2 - Không bao giờ"></td>
                                <td><input type="radio" name="rd2_73" value="0" aria-label="Câu 2 - Hiếm khi"></td>
                                <td><input type="radio" name="rd2_73" value="1" aria-label="Câu 2 - Thỉnh thoảng"></td>
                                <td><input type="radio" name="rd2_73" value="1" aria-label="Câu 2 - Thường xuyên"></td>
                                <td><input type="radio" name="rd2_73" value="1" aria-label="Câu 2 - Rất thường xuyên"></td>
                            </tr>

                            <tr>
                                <td>3.</td>
                                <td>
                                    Bạn có thường quên các cuộc hẹn/nhiệm vụ không?
                                </td>

                                <td><input type="radio" name="rd3_73" value="0" aria-label="Câu 3 - Không bao giờ"></td>
                                <td><input type="radio" name="rd3_73" value="0" aria-label="Câu 3 - Hiếm khi"></td>
                                <td><input type="radio" name="rd3_73" value="1" aria-label="Câu 3 - Thỉnh thoảng"></td>
                                <td><input type="radio" name="rd3_73" value="1" aria-label="Câu 3 - Thường xuyên"></td>
                                <td><input type="radio" name="rd3_73" value="1" aria-label="Câu 3 - Rất thường xuyên"></td>
                            </tr>

                            <tr>
                                <td>4.</td>
                                <td>
                                    Bạn có thường lên kế hoạch cho một công việc
                                    đòi hỏi nhiều suy nghĩ không?
                                </td>

                                <td><input type="radio" name="rd4_73" value="0" aria-label="Câu 4 - Không bao giờ"></td>
                                <td><input type="radio" name="rd4_73" value="0" aria-label="Câu 4 - Hiếm khi"></td>
                                <td><input type="radio" name="rd4_73" value="0" aria-label="Câu 4 - Thỉnh thoảng"></td>
                                <td><input type="radio" name="rd4_73" value="1" aria-label="Câu 4 - Thường xuyên"></td>
                                <td><input type="radio" name="rd4_73" value="1" aria-label="Câu 4 - Rất thường xuyên"></td>
                            </tr>

                            <tr>
                                <td>5.</td>
                                <td>
                                    Bạn có thường xuyên vặn vẹo hay bồn chồn
                                    khi phải ngồi một chỗ trong thời gian dài không?
                                </td>

                                <td><input type="radio" name="rd5_73" value="0" aria-label="Câu 5 - Không bao giờ"></td>
                                <td><input type="radio" name="rd5_73" value="0" aria-label="Câu 5 - Hiếm khi"></td>
                                <td><input type="radio" name="rd5_73" value="0" aria-label="Câu 5 - Thỉnh thoảng"></td>
                                <td><input type="radio" name="rd5_73" value="1" aria-label="Câu 5 - Thường xuyên"></td>
                                <td><input type="radio" name="rd5_73" value="1" aria-label="Câu 5 - Rất thường xuyên"></td>
                            </tr>

                            <tr>
                                <td>6.</td>
                                <td>
                                    Bạn có thường xuyên cảm thấy hiếu động
                                    như có động cơ đẩy không?
                                </td>

                                <td><input type="radio" name="rd6_73" value="0" aria-label="Câu 6 - Không bao giờ"></td>
                                <td><input type="radio" name="rd6_73" value="0" aria-label="Câu 6 - Hiếm khi"></td>
                                <td><input type="radio" name="rd6_73" value="0" aria-label="Câu 6 - Thỉnh thoảng"></td>
                                <td><input type="radio" name="rd6_73" value="1" aria-label="Câu 6 - Thường xuyên"></td>
                                <td><input type="radio" name="rd6_73" value="1" aria-label="Câu 6 - Rất thường xuyên"></td>
                            </tr>

                        </tbody>

                    </table>

                </div>

                <!-- THÔNG BÁO LỖI -->
                <div class="sc73-error" role="alert"></div>

                <!-- NÚT CHỨC NĂNG -->
                <div class="sc73-actions">

                    <button type="submit" class="sc73-btn sc73-btn-primary">
                        Kiểm tra kết quả
                    </button>

                    <button type="reset" class="sc73-btn sc73-btn-reset">
                        Nhập lại
                    </button>

                </div>

            </form>

        </div>
    </div>

    <!-- PHẦN KẾT QUẢ -->
    <div class="sc73-card sc73-result">

        <div class="sc73-heading">
            Kết quả kiểm tra ADHD
        </div>

        <div class="sc73-body">

            <div class="sc73-score">
                Tổng điểm:
                <span class="sc73-total">0</span>/6
            </div>

            <div class="sc73-result-content"></div>

            <div class="sc73-note">
                <strong>Lưu ý:</strong>
                Đây chỉ là công cụ tự sàng lọc tham khảo, không phải công cụ
                chẩn đoán ADHD. Kết quả không thể xác định một người có mắc
                ADHD hay không. Nếu các biểu hiện kéo dài, ảnh hưởng đến
                công việc, học tập, sinh hoạt hoặc các mối quan hệ, bạn nên
                trao đổi với bác sĩ chuyên khoa Tâm thần hoặc chuyên gia
                y tế có chuyên môn để được đánh giá đầy đủ.
            </div>

        </div>
    </div>

    <script>
    (function () {
        'use strict';

        function initSC73() {

            var root = document.getElementById('adhd-screening-73');

            if (!root || root.getAttribute('data-sc73-init') === '1') {
                return;
            }

            root.setAttribute('data-sc73-init', '1');

            var form = root.querySelector('.sc73-form');
            var resultBox = root.querySelector('.sc73-result');
            var errorBox = root.querySelector('.sc73-error');
            var totalElement = root.querySelector('.sc73-total');
            var resultContent = root.querySelector('.sc73-result-content');

            if (!form || !resultBox || !errorBox) {
                return;
            }

            // HIỂN THỊ THÔNG BÁO LỖI.
            function showError(message, target) {

                errorBox.textContent = message;
                errorBox.style.display = 'block';

                if (target) {
                    target.focus();
                }
            }

            // ẨN THÔNG BÁO LỖI.
            function hideError() {

                errorBox.textContent = '';
                errorBox.style.display = 'none';
            }

            // ẨN KẾT QUẢ CŨ.
            function hideResult() {

                resultBox.style.display = 'none';
                totalElement.textContent = '0';
                resultContent.innerHTML = '';
            }

            // ĐỔI MÀU THEO GIỚI TÍNH.
            var genderInputs = form.querySelectorAll(
                'input[name="sex_73"]'
            );

            Array.prototype.forEach.call(genderInputs, function (input) {

                input.addEventListener('change', function () {

                    root.classList.remove('sc73-male', 'sc73-female');

                    if (this.value === 'female') {
                        root.classList.add('sc73-female');
                    } else {
                        root.classList.add('sc73-male');
                    }

                    hideError();
                    hideResult();
                });

            });

            // KHI THAY ĐỔI CÂU TRẢ LỜI.
            form.addEventListener('change', function (event) {

                if (
                    event.target &&
                    event.target.type === 'radio'
                ) {
                    hideError();
                    hideResult();
                }

            });

            // XỬ LÝ TÍNH ĐIỂM.
            form.addEventListener('submit', function (event) {

                event.preventDefault();

                hideError();

                // Kiểm tra giới tính.
                var sex = form.querySelector(
                    'input[name="sex_73"]:checked'
                );

                if (!sex) {

                    showError(
                        'Bạn chưa chọn giới tính!',
                        genderInputs[0]
                    );

                    return;
                }

                // Tính tổng điểm.
                var total = 0;
                var unanswered = [];

                for (var i = 1; i <= 6; i++) {

                    var answer = form.querySelector(
                        'input[name="rd' + i + '_73"]:checked'
                    );

                    if (!answer) {

                        unanswered.push(i);

                    } else {

                        total += parseInt(answer.value, 10);

                    }

                }

                // Kiểm tra câu hỏi chưa trả lời.
                if (unanswered.length > 0) {

                    showError(
                        'Bạn vui lòng trả lời đầy đủ 6 câu hỏi. ' +
                        'Các câu chưa trả lời: ' +
                        unanswered.join(', ') + '.'
                    );

                    return;
                }

                // PHÂN LOẠI KẾT QUẢ.
                var content = '';

                if (total < 4) {

                    content =
                        '<strong>Kết quả tham khảo: Tổng điểm dưới 4.</strong>' +
                        '<p>Các triệu chứng hiện tại không chỉ ra ADHD theo cách ' +
                        'tính điểm của bảng hỏi này.</p>' +
                        '<p>Tuy nhiên, kết quả này không loại trừ hoàn toàn khả năng ' +
                        'có vấn đề về chú ý hoặc hành vi. Nếu bạn vẫn gặp khó khăn ' +
                        'trong công việc, học tập hoặc sinh hoạt, hãy cân nhắc trao ' +
                        'đổi với chuyên gia y tế.</p>';

                } else {

                    content =
                        '<strong>Kết quả tham khảo: Tổng điểm từ 4 trở lên.</strong>' +
                        '<p>Trắc nghiệm sàng lọc cho thấy bạn có các triệu chứng ' +
                        'cần được đánh giá thêm về ADHD.</p>' +
                        '<p>Chúng tôi khuyên bạn nên tham khảo ý kiến của bác sĩ ' +
                        'chuyên khoa Tâm thần hoặc chuyên gia có chuyên môn để ' +
                        'được đánh giá toàn diện.</p>';

                }

                // HIỂN THỊ KẾT QUẢ.
                totalElement.textContent = total;
                resultContent.innerHTML = content;

                resultBox.style.display = 'block';

                // CUỘN ĐẾN KẾT QUẢ.
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

            // XỬ LÝ NÚT NHẬP LẠI.
            form.addEventListener('reset', function () {

                setTimeout(function () {

                    hideError();
                    hideResult();

                    root.classList.remove(
                        'sc73-male',
                        'sc73-female'
                    );

                }, 0);

            });

        }

        // KHỞI TẠO KHI DOM SẴN SÀNG.
        if (document.readyState === 'loading') {

            document.addEventListener('DOMContentLoaded', initSC73);

        } else {

            initSC73();

        }

    })();
    </script>

</div>
