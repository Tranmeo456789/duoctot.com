
<div class="zung81-calculator">
    <style>
        .zung81-calculator {
            width: 100%;
            max-width: 850px;
            margin: 20px auto;
            color: #222;
            font-size: 15px;
            line-height: 1.6;
            box-sizing: border-box;
        }

        .zung81-calculator *,
        .zung81-calculator *:before,
        .zung81-calculator *:after {
            box-sizing: border-box;
        }

        .zung81-calculator .zung81-panel {
            width: 100%;
            margin-bottom: 20px;
            border: 1px solid #0F5885;
            background: #E6F4FE;
        }

        .zung81-calculator .zung81-title {
            padding: 12px 15px;
            background: #0F5885;
            color: #fff;
            font-size: 17px;
            font-weight: 700;
        }

        .zung81-calculator .zung81-info {
            padding: 15px;
        }

        .zung81-calculator .zung81-info-row {
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
            margin-bottom: 12px;
        }

        .zung81-calculator .zung81-info-row:last-child {
            margin-bottom: 0;
        }

        .zung81-calculator .zung81-info-label {
            width: 180px;
            font-weight: 600;
        }

        .zung81-calculator select {
            min-width: 120px;
            max-width: 100%;
            height: 40px;
            padding: 5px 10px;
            border: 1px solid #bbb;
            border-radius: 4px;
            background: #fff;
            color: #333;
        }

        .zung81-calculator .zung81-info-row label {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            cursor: pointer;
        }

        .zung81-calculator input[type="radio"] {
            accent-color: #0F5885;
        }

        .zung81-calculator .zung81-question {
            padding: 14px 15px;
            border-top: 1px solid #fff;
        }

        .zung81-calculator .zung81-question-title {
            margin-bottom: 12px;
            font-weight: 600;
            line-height: 1.5;
        }

        .zung81-calculator .zung81-options {
            display: grid;
            grid-template-columns: repeat(4, minmax(0, 1fr));
            gap: 8px;
        }

        .zung81-calculator .zung81-option {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            min-height: 45px;
            padding: 8px;
            border: 1px solid #c5ddeb;
            border-radius: 5px;
            background: #fff;
            cursor: pointer;
            text-align: center;
            transition: all .2s ease;
        }

        .zung81-calculator .zung81-option:hover {
            border-color: #0F5885;
            background: #f4faff;
        }

        .zung81-calculator .zung81-option.active {
            border-color: #0F5885;
            background: #d7edfc;
            color: #0F5885;
            font-weight: 600;
        }

        .zung81-calculator .zung81-option input {
            margin: 0;
            flex-shrink: 0;
        }

        .zung81-calculator .zung81-scale {
            display: flex;
            justify-content: space-between;
            gap: 10px;
            padding: 12px 15px;
            color: #444;
            font-size: 13px;
        }

        .zung81-calculator .zung81-actions {
            padding: 15px;
            text-align: center;
        }

        .zung81-calculator .zung81-button {
            display: inline-block;
            padding: 11px 25px;
            border: 0;
            border-radius: 5px;
            background: #0F5885;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s ease;
        }

        .zung81-calculator .zung81-button:hover {
            background: #0779A3;
            color: #fff;
        }

        .zung81-calculator .zung81-result {
            display: none;
            margin-top: 20px;
            border: 1px solid #0F5885;
            background: #E6F4FE;
        }

        .zung81-calculator .zung81-result-content {
            padding: 20px;
            text-align: center;
        }

        .zung81-calculator .zung81-total {
            margin-bottom: 10px;
            color: #0F5885;
            font-size: 24px;
            font-weight: 700;
        }

        .zung81-calculator .zung81-conclusion {
            font-size: 18px;
            font-weight: 700;
        }

        .zung81-calculator .zung81-note {
            margin-top: 15px;
            color: #555;
            font-size: 13px;
            line-height: 1.7;
        }

        .zung81-calculator .zung81-required {
            color: #c00;
        }

        .zung81-calculator .zung81-error {
            display: none;
            margin: 12px 15px;
            padding: 10px 12px;
            border: 1px solid #f5b7b7;
            border-radius: 5px;
            background: #fff1f1;
            color: #c00;
            font-size: 14px;
        }

        .zung81-calculator .zung81-warning {
            margin: 15px;
            padding: 12px;
            border-left: 4px solid #c77b00;
            background: #fff5df;
            color: #664600;
            font-size: 14px;
        }

        .zung81-calculator .zung81-suicide-warning {
            display: none;
            margin-top: 18px;
            padding: 15px;
            border: 1px solid #ffccc7;
            border-left: 4px solid #d93025;
            border-radius: 5px;
            background: #fff1f0;
            color: #8b1e18;
            text-align: left;
            line-height: 1.7;
        }

        .zung81-calculator .zung81-suicide-warning strong {
            display: block;
            margin-bottom: 6px;
            font-size: 16px;
        }

        .zung81-calculator .zung81-result-info {
            margin: 15px 0;
            padding: 12px;
            border-radius: 5px;
            background: #fff;
            text-align: left;
        }

        .zung81-calculator .zung81-result-info p {
            margin: 5px 0;
        }

        @media (max-width: 600px) {
            .zung81-calculator {
                font-size: 14px;
            }

            .zung81-calculator .zung81-info-label {
                width: 100%;
            }

            .zung81-calculator .zung81-options {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .zung81-calculator .zung81-title {
                font-size: 16px;
            }

            .zung81-calculator .zung81-scale {
                flex-direction: column;
                gap: 5px;
            }

            .zung81-calculator .zung81-result-content {
                padding: 15px;
            }

            .zung81-calculator .zung81-total {
                font-size: 22px;
            }

            .zung81-calculator .zung81-conclusion {
                font-size: 16px;
            }

            .zung81-calculator .zung81-button {
                width: 100%;
            }
        }
    </style>

    @php
        $zung81Questions = array(
            1 => 'Tôi cảm thấy buồn chán.',
            2 => 'Buổi sáng là thời gian tôi cảm thấy tốt nhất.',
            3 => 'Tôi đã khóc hoặc cảm thấy muốn khóc.',
            4 => 'Tôi khó ngủ vào ban đêm.',
            5 => 'Tôi ăn nhiều hơn trước.',
            6 => 'Tôi vẫn thích quan hệ tình dục.',
            7 => 'Tôi nhận ra mình đang sút cân.',
            8 => 'Tôi bị táo bón.',
            9 => 'Tim tôi đập nhanh hơn bình thường.',
            10 => 'Tôi cảm thấy mệt mỏi không có lý do.',
            11 => 'Đầu óc tôi vẫn minh mẫn như trước.',
            12 => 'Tôi thấy thật dễ dàng làm những việc tôi đã từng làm.',
            13 => 'Tôi bồn chồn và không thể tiếp tục.',
            14 => 'Tôi cảm thấy hy vọng vào tương lai.',
            15 => 'Tôi cáu kỉnh hơn bình thường.',
            16 => 'Tôi thấy thật dễ dàng đưa ra quyết định.',
            17 => 'Tôi cảm thấy mình có ích và cần thiết.',
            18 => 'Cuộc sống của tôi khá viên mãn.',
            19 => 'Tôi cảm thấy rằng những người khác sẽ tốt hơn nếu tôi chết.',
            20 => 'Tôi vẫn thích những điều tôi đã từng làm.'
        );
    @endphp

    <div class="zung81-panel">
        <div class="zung81-title">
            Công cụ tự đánh giá trầm cảm theo thang điểm Zung
        </div>

        <form class="zung81-form" action="javascript:void(0);" novalidate>

            <div class="zung81-info">
                <div class="zung81-info-row">
                    <div class="zung81-info-label">
                        Giới tính <span class="zung81-required">*</span>
                    </div>

                    <label>
                        <input type="radio" name="sex" value="male">
                        Nam
                    </label>

                    <label>
                        <input type="radio" name="sex" value="female">
                        Nữ
                    </label>
                </div>

                <div class="zung81-info-row">
                    <div class="zung81-info-label">
                        Chọn tuổi của bạn <span class="zung81-required">*</span>
                    </div>

                    <select name="age">
                        <option value="">Chọn tuổi</option>
                        @for ($age = 10; $age <= 80; $age++)
                            <option value="{{ $age }}">{{ $age }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="zung81-title">
                Tình trạng của bạn trong thời gian gần đây
            </div>

            <div class="zung81-scale">
                <span>1 - Rất ít lần (dưới 25%)</span>
                <span>4 - Hầu hết thời gian (75–100%)</span>
            </div>

            @foreach ($zung81Questions as $number => $question)
                <div class="zung81-question">
                    <div class="zung81-question-title">
                        {{ $number }}. {{ $question }}
                        <span class="zung81-required">*</span>
                    </div>

                    <div class="zung81-options">
                        @for ($point = 1; $point <= 4; $point++)
                            <label class="zung81-option">
                                <input
                                    type="radio"
                                    name="rd{{ $number }}"
                                    value="{{ $point }}">
                                <span>{{ $point }}</span>
                            </label>
                        @endfor
                    </div>
                </div>
            @endforeach

            <div class="zung81-warning">
                Câu 19 đề cập đến suy nghĩ về cái chết. Nếu bạn đang có ý định
                tự làm hại bản thân, cảm thấy không an toàn hoặc có nguy cơ
                thực hiện hành động đó, hãy tìm người đáng tin cậy ở bên và
                đến cơ sở y tế hoặc cấp cứu ngay. Không chờ kết quả bài đánh giá.
            </div>

            <div class="zung81-error"></div>

            <div class="zung81-actions">
                <button type="button" class="zung81-button zung81-submit">
                    Nộp kết quả
                </button>
            </div>
        </form>
    </div>

    <!-- KẾT QUẢ -->
    <div class="zung81-result" aria-live="polite">
        <div class="zung81-title">
            Kết quả đánh giá theo thang điểm Zung
        </div>

        <div class="zung81-result-content">
            <div class="zung81-result-info">
                <p>
                    <strong>Giới tính:</strong>
                    <span class="zung81-result-sex"></span>
                </p>

                <p>
                    <strong>Độ tuổi:</strong>
                    <span class="zung81-result-age"></span>
                </p>
            </div>

            <div class="zung81-total"></div>
            <div class="zung81-conclusion"></div>

            <div class="zung81-suicide-warning">
                <strong>Lưu ý quan trọng về an toàn</strong>

                Bạn đã chọn mức độ xuất hiện suy nghĩ liên quan đến việc
                người khác sẽ tốt hơn nếu bạn chết. Không nên chỉ dựa vào
                tổng điểm để đánh giá tình trạng này.

                <p>
                    Bạn nên trao đổi trực tiếp với bác sĩ hoặc chuyên gia
                    sức khỏe tâm thần càng sớm càng tốt. Nếu hiện tại bạn
                    có ý định tự sát, có kế hoạch thực hiện hoặc cảm thấy
                    không thể giữ an toàn cho bản thân, hãy đến khoa cấp
                    cứu gần nhất hoặc gọi cấp cứu 115. Nếu có thể, hãy ở
                    cạnh người thân đáng tin cậy và tránh ở một mình.
                </p>
            </div>

            <div class="zung81-note">
                Kết quả chỉ mang tính tham khảo, không thay thế chẩn đoán
                của bác sĩ. Nếu bạn có biểu hiện buồn chán kéo dài hoặc
                ảnh hưởng đến sinh hoạt, hãy trao đổi với bác sĩ hoặc
                chuyên gia sức khỏe tâm thần.
            </div>

            <div class="zung81-actions">
                <button type="button" class="zung81-button zung81-restart">
                    Làm lại
                </button>
            </div>
        </div>
    </div>

    <script>
    (function () {
        'use strict';

        function initZung81Calculator() {
            var calculators = document.querySelectorAll('.zung81-calculator');

            for (var c = 0; c < calculators.length; c++) {
                var calculator = calculators[c];

                if (calculator.getAttribute('data-initialized') === '1') {
                    continue;
                }

                calculator.setAttribute('data-initialized', '1');

                (function (root) {
                    var form = root.querySelector('.zung81-form');
                    var resultBox = root.querySelector('.zung81-result');
                    var errorBox = root.querySelector('.zung81-error');

                    if (!form || !resultBox) {
                        return;
                    }

                    /*
                     * Các câu diễn đạt tích cực cần đảo điểm.
                     * Giữ nguyên danh sách từ code gốc.
                     */
                    var reverseQuestions = [2, 6, 11, 12, 14, 16, 17, 18, 20];

                    /*
                     * Cuộn đến công cụ
                     */
                    function scrollToElement(element) {
                        if (!element) {
                            return;
                        }

                        var rect = element.getBoundingClientRect();
                        var scrollTop = window.pageYOffset ||
                            document.documentElement.scrollTop;

                        window.scrollTo({
                            top: Math.max(0, scrollTop + rect.top - 80),
                            behavior: 'smooth'
                        });
                    }

                    /*
                     * Cập nhật giao diện đáp án
                     */
                    function updateSelectedLabels() {
                        var labels = root.querySelectorAll('.zung81-option');

                        for (var i = 0; i < labels.length; i++) {
                            labels[i].classList.remove('active');
                        }

                        var checkedInputs = root.querySelectorAll(
                            '.zung81-option input[type="radio"]:checked'
                        );

                        for (var j = 0; j < checkedInputs.length; j++) {
                            var label = checkedInputs[j].closest('.zung81-option');

                            if (label) {
                                label.classList.add('active');
                            }
                        }
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
                     * Lấy nội dung phân loại theo tổng điểm.
                     * Giữ nguyên ngưỡng của code gốc.
                     */
                    function getConclusion(total) {
                        if (total <= 40) {
                            return 'Không trầm cảm theo ngưỡng phân loại của công cụ này';
                        }

                        if (total <= 50) {
                            return 'Trầm cảm mức độ nhẹ';
                        }

                        if (total <= 60) {
                            return 'Trầm cảm ở mức độ vừa';
                        }

                        if (total <= 70) {
                            return 'Trầm cảm mức độ nặng';
                        }

                        return 'Trầm cảm mức độ rất nặng';
                    }

                    /*
                     * Tính điểm
                     */
                    function calculateResult() {
                        hideError();

                        var sexInput = form.querySelector(
                            'input[name="sex"]:checked'
                        );

                        var age = form.querySelector(
                            'select[name="age"]'
                        ).value;

                        if (!sexInput) {
                            showError('Bạn chưa chọn giới tính!');
                            return;
                        }

                        if (!age) {
                            showError('Vui lòng chọn tuổi của bạn!');
                            return;
                        }

                        var total = 0;
                        var unanswered = [];
                        var question19Value = null;

                        for (var i = 1; i <= 20; i++) {
                            var answer = form.querySelector(
                                'input[name="rd' + i + '"]:checked'
                            );

                            if (!answer) {
                                unanswered.push(i);
                                continue;
                            }

                            var point = parseInt(answer.value, 10);

                            if (isNaN(point) || point < 1 || point > 4) {
                                unanswered.push(i);
                                continue;
                            }

                            /*
                             * Đảo điểm các câu tích cực:
                             * Điểm sau đảo = 5 - điểm ban đầu.
                             */
                            if (reverseQuestions.indexOf(i) !== -1) {
                                point = 5 - point;
                            }

                            total += point;

                            /*
                             * Ghi nhận câu 19 để cảnh báo riêng.
                             * Câu 19 thuộc nhóm đảo điểm trong code gốc.
                             */
                            if (i === 19) {
                                question19Value = parseInt(answer.value, 10);
                            }
                        }

                        if (unanswered.length > 0) {
                            showError(
                                'Bạn còn ' + unanswered.length +
                                ' câu chưa trả lời. Vui lòng hoàn thành đủ 20 câu hỏi!'
                            );
                            return;
                        }

                        var sexText = sexInput.value === 'male' ? 'Nam' : 'Nữ';

                        root.querySelector('.zung81-result-sex').textContent =
                            sexText;

                        root.querySelector('.zung81-result-age').textContent =
                            age + ' tuổi';

                        root.querySelector('.zung81-total').textContent =
                            'Tổng điểm: ' + total + ' / 80';

                        root.querySelector('.zung81-conclusion').textContent =
                            getConclusion(total);

                        /*
                         * Câu 19 là câu đảo điểm.
                         * Giá trị 1 tương ứng điểm sau đảo là 4.
                         * Vì vậy, mọi lựa chọn ở câu này đều được giữ lại
                         * để hiển thị cảnh báo riêng, không dựa vào tổng điểm.
                         *
                         * Cảnh báo này nhằm nhắc người dùng chú ý,
                         * không phải kết luận nguy cơ tự sát.
                         */
                        var suicideWarning = root.querySelector(
                            '.zung81-suicide-warning'
                        );

                        if (question19Value !== null && question19Value > 0) {
                            suicideWarning.style.display = 'block';
                        } else {
                            suicideWarning.style.display = 'none';
                        }

                        form.style.display = 'none';
                        resultBox.style.display = 'block';

                        scrollToElement(resultBox);
                    }

                    /*
                     * Khi thay đổi đáp án:
                     * - Cập nhật màu lựa chọn.
                     * - Xóa thông báo lỗi cũ.
                     */
                    form.addEventListener('change', function (event) {
                        if (event.target && event.target.type === 'radio') {
                            updateSelectedLabels();
                            hideError();
                        }

                        if (event.target && event.target.name === 'age') {
                            hideError();
                        }
                    });

                    /*
                     * Nút nộp kết quả
                     */
                    var submitButton = root.querySelector('.zung81-submit');

                    submitButton.addEventListener('click', function () {
                        calculateResult();
                    });

                    /*
                     * Nút làm lại
                     */
                    var restartButton = root.querySelector('.zung81-restart');

                    restartButton.addEventListener('click', function () {
                        form.reset();

                        form.style.display = 'block';
                        resultBox.style.display = 'none';

                        var suicideWarning = root.querySelector(
                            '.zung81-suicide-warning'
                        );

                        suicideWarning.style.display = 'none';

                        updateSelectedLabels();
                        hideError();

                        scrollToElement(root);
                    });

                    /*
                     * Khởi tạo
                     */
                    updateSelectedLabels();
                })(calculator);
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initZung81Calculator);
        } else {
            initZung81Calculator();
        }
    })();
    </script>
</div>
