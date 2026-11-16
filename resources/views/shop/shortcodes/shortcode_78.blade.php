
<div id="depression-calculator-78" class="depression-calculator-78">
    <?php
        $depressionQuestions = array(
            1  => 'Tôi luôn cảm thấy buồn và bất hạnh',
            2  => 'Tôi cảm thấy mệt mỏi, có ít năng lượng và khó có thể tập trung',
            3  => 'Tôi mất hứng thú với mọi thứ trong cuộc sống mà trước đây là rất quan trọng với tôi',
            4  => 'Tôi mất cảm giác vui sướng trong cuộc sống',
            5  => 'Tôi cảm thấy mình là người tội lỗi và đáng bị trừng phạt.',
            6  => 'Tôi thường cảm thấy bồn chồn bất an kèm theo giảm hoạt động',
            7  => 'Tôi cảm thấy khó khăn khi ra quyết định và làm mọi việc rất chậm chạp.',
            8  => 'Tôi cảm thấy mệt mỏi và luôn cần nỗ lực nhiều để làm những thứ đơn giản.',
            9  => 'Tôi thấy cân nặng và khẩu vị của mình thay đổi.',
            10 => 'Tôi mất hứng thú với tình dục và sinh hoạt tình dục khó khăn',
            11 => 'Tôi cảm thấy không có sự sống - thà chết đi còn hơn',
            12 => 'Tôi cảm thấy tương lai mình tuyệt vọng và cảm thấy bị cầm tù.',
            13 => 'Giấc ngủ của tôi bị rối loạn, ngủ quá nhiều hoặc quá ít.',
            14 => 'Tôi luôn thấy chán nản ngay cả khi có điều tốt đẹp xảy đến với mình',
            15 => 'Tôi thường có suy nghĩ về cái chết hoặc tự sát'
        );
    ?>

    <style>
        #depression-calculator-78 {
            max-width: 850px;
            margin: 20px auto;
            color: #333;
            font-size: 15px;
            line-height: 1.6;
            box-sizing: border-box;
        }

        #depression-calculator-78 *,
        #depression-calculator-78 *:before,
        #depression-calculator-78 *:after {
            box-sizing: border-box;
        }

        #depression-calculator-78 .ncalc-heading {
            font-size: 23px;
            font-weight: 700;
            margin: 0 0 20px;
            color: #222;
        }

        /* Thanh tiến trình */
        #depression-calculator-78 .setup-panel {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0 0 25px;
            border-bottom: 2px solid #e5e7eb;
        }

        #depression-calculator-78 .setup-panel li {
            flex: 1;
            text-align: center;
            padding-bottom: 12px;
            position: relative;
        }

        #depression-calculator-78 .setup-panel li:after {
            content: "";
            position: absolute;
            bottom: -2px;
            left: 50%;
            width: 0;
            height: 3px;
            background: #1688c9;
            transition: width .2s ease;
        }

        #depression-calculator-78 .setup-panel li.active:after,
        #depression-calculator-78 .setup-panel li.completed:after {
            width: 100%;
        }

        #depression-calculator-78 .setup-panel li a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e5e7eb;
            color: #555;
            text-decoration: none;
            cursor: pointer;
            font-weight: 600;
            position: relative;
            z-index: 1;
        }

        #depression-calculator-78 .setup-panel li.active a,
        #depression-calculator-78 .setup-panel li.completed a {
            background: #1688c9;
            color: #fff;
        }

        #depression-calculator-78 .setup-panel li.disabled a {
            cursor: not-allowed;
            opacity: .5;
        }

        #depression-calculator-78 .ncalc-title h3 {
            font-size: 19px;
            font-weight: 700;
            margin: 15px 0;
            color: #222;
        }

        #depression-calculator-78 .ncalc-error {
            display: none;
            color: #d93025;
            background: #fff5f5;
            border: 1px solid #ffd6d6;
            padding: 10px 12px;
            border-radius: 5px;
            margin: 10px 0;
            font-size: 14px;
        }

        #depression-calculator-78 .ncalc-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin: 15px 0;
        }

        #depression-calculator-78 .ncalc-col {
            flex: 1 1 150px;
            min-width: 0;
        }

        #depression-calculator-78 .ncalc-label {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 13px;
            border: 1px solid #ddd;
            border-radius: 7px;
            cursor: pointer;
            min-height: 48px;
            height: 100%;
            background: #fff;
            transition: all .2s ease;
        }

        #depression-calculator-78 .ncalc-label:hover {
            border-color: #1688c9;
            background: #f7fbff;
        }

        #depression-calculator-78 .ncalc-label.active {
            border-color: #1688c9;
            background: #eef8ff;
            color: #0875b5;
        }

        #depression-calculator-78 .ncalc-label input {
            margin: 0;
            flex-shrink: 0;
            width: 17px;
            height: 17px;
            accent-color: #1688c9;
        }

        #depression-calculator-78 .ncalc-row {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        #depression-calculator-78 .ncalc-row:last-child {
            border-bottom: 0;
        }

        #depression-calculator-78 .ncalc-row h4 {
            font-size: 16px;
            margin: 0 0 10px;
            font-weight: 600;
            line-height: 1.5;
            color: #333;
        }

        #depression-calculator-78 .ncalc-paginator {
            display: flex;
            justify-content: space-between;
            align-items: center;
            list-style: none;
            padding: 15px 0;
            margin: 0;
            gap: 10px;
        }

        #depression-calculator-78 .ncalc-paginator li {
            margin: 0;
            padding: 0;
        }

        #depression-calculator-78 .ncalc-paginator a {
            color: #1688c9;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
        }

        #depression-calculator-78 .ncalc-paginator a:hover {
            color: #0875b5;
            text-decoration: underline;
        }

        #depression-calculator-78 .ncalc-btn {
            display: inline-block;
            border: 0;
            background: #1688c9;
            color: #fff;
            padding: 11px 25px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 15px;
            font-weight: 600;
            line-height: 1.4;
            transition: background .2s ease;
        }

        #depression-calculator-78 .ncalc-btn:hover {
            background: #0875b5;
            color: #fff;
        }

        #depression-calculator-78 .ncalc-step {
            display: none;
        }

        /* Kết quả */
        #depression-calculator-78 .depression-result {
            display: none;
        }

        #depression-calculator-78 .ncalc-result {
            padding: 22px;
            background: #f5f9fc;
            border: 1px solid #e2edf5;
            border-radius: 8px;
            line-height: 1.7;
        }

        #depression-calculator-78 .result-label {
            font-weight: 700;
        }

        #depression-calculator-78 .result-score {
            color: #d93025;
            font-weight: 700;
            font-size: 20px;
        }

        #depression-calculator-78 .result-description {
            margin-top: 15px;
        }

        #depression-calculator-78 .result-warning {
            margin-top: 15px;
            padding: 12px;
            background: #fff4e5;
            border-left: 4px solid #e6a23c;
            border-radius: 4px;
            font-size: 14px;
        }

        #depression-calculator-78 .result-suicide-warning {
            display: none;
            margin-top: 18px;
            padding: 15px;
            background: #fff1f0;
            border: 1px solid #ffccc7;
            border-left: 4px solid #d93025;
            border-radius: 5px;
            color: #8b1e18;
            line-height: 1.7;
        }

        #depression-calculator-78 .result-suicide-warning strong {
            display: block;
            margin-bottom: 6px;
            font-size: 16px;
        }

        #depression-calculator-78 .ncalc-result .ncalc-row {
            padding: 10px 0;
        }

        @media (max-width: 600px) {
            #depression-calculator-78 {
                margin: 15px auto;
                font-size: 14px;
            }

            #depression-calculator-78 .ncalc-heading {
                font-size: 20px;
            }

            #depression-calculator-78 .ncalc-title h3 {
                font-size: 17px;
            }

            #depression-calculator-78 .ncalc-col {
                flex-basis: 100%;
            }

            #depression-calculator-78 .ncalc-label {
                padding: 12px;
            }

            #depression-calculator-78 .ncalc-row h4 {
                font-size: 15px;
            }

            #depression-calculator-78 .ncalc-result {
                padding: 16px;
            }

            #depression-calculator-78 .ncalc-btn {
                padding: 10px 18px;
                font-size: 14px;
            }
        }
    </style>

    <h2 class="ncalc-heading">Công cụ sàng lọc trầm cảm</h2>

    <form class="depression-form-78" action="javascript:void(0);" novalidate>

        <!-- Thanh tiến trình -->
        <ul class="setup-panel">
            <li class="active">
                <a href="#depression-step-1-78">1</a>
            </li>
            <li class="disabled">
                <a href="#depression-step-2-78">2</a>
            </li>
            <li class="disabled">
                <a href="#depression-step-3-78">3</a>
            </li>
        </ul>

        <!-- BƯỚC 1: GIỚI TÍNH -->
        <div class="ncalc-step" id="depression-step-1-78">
            <div class="ncalc-title">
                <h3>Bạn là nam hay nữ?</h3>
            </div>

            <div class="ncalc-error">
                Vui lòng chọn giới tính.
            </div>

            <div class="ncalc-wrapper">
                <div class="ncalc-col">
                    <label class="ncalc-label">
                        <input type="radio" name="sex_78" value="male">
                        <span>Nam</span>
                    </label>
                </div>

                <div class="ncalc-col">
                    <label class="ncalc-label">
                        <input type="radio" name="sex_78" value="female">
                        <span>Nữ</span>
                    </label>
                </div>
            </div>

            <nav>
                <ul class="ncalc-paginator">
                    <li></li>
                    <li>
                        <a href="#" class="next-step">Tiếp theo &gt;</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- BƯỚC 2: ĐỘ TUỔI -->
        <div class="ncalc-step" id="depression-step-2-78">
            <div class="ncalc-title">
                <h3>Hãy cho biết độ tuổi của bạn?</h3>
            </div>

            <div class="ncalc-error">
                Vui lòng chọn tuổi của bạn.
            </div>

            <div class="ncalc-wrapper">
                <div class="ncalc-col">
                    <label class="ncalc-label">
                        <input type="radio" name="age_78" value="0">
                        <span>Dưới 35 tuổi</span>
                    </label>
                </div>

                <div class="ncalc-col">
                    <label class="ncalc-label">
                        <input type="radio" name="age_78" value="20">
                        <span>35 - 49 tuổi</span>
                    </label>
                </div>

                <div class="ncalc-col">
                    <label class="ncalc-label">
                        <input type="radio" name="age_78" value="30">
                        <span>Từ 50 tuổi trở lên</span>
                    </label>
                </div>
            </div>

            <nav>
                <ul class="ncalc-paginator">
                    <li>
                        <a href="#" class="previous-step">&lt; Quay lại</a>
                    </li>
                    <li>
                        <a href="#" class="next-step">Tiếp theo &gt;</a>
                    </li>
                </ul>
            </nav>
        </div>

        <!-- BƯỚC 3: CÂU HỎI -->
        <div class="ncalc-step" id="depression-step-3-78">
            <div class="ncalc-title">
                <h3>Trả lời các câu hỏi dưới đây</h3>
            </div>

            <div class="ncalc-error">
                Vui lòng trả lời đầy đủ 15 câu hỏi.
            </div>

            <div class="ncalc-questions">
                <?php foreach ($depressionQuestions as $questionNumber => $questionText): ?>
                    <div class="ncalc-row">
                        <h4><?php echo $questionNumber . '. ' . e($questionText); ?></h4>

                        <div class="ncalc-wrapper">
                            <div class="ncalc-col">
                                <label class="ncalc-label">
                                    <input
                                        type="radio"
                                        name="rd<?php echo $questionNumber; ?>_78"
                                        value="2">
                                    <span>Đồng ý</span>
                                </label>
                            </div>

                            <div class="ncalc-col">
                                <label class="ncalc-label">
                                    <input
                                        type="radio"
                                        name="rd<?php echo $questionNumber; ?>_78"
                                        value="1">
                                    <span>Không rõ ràng</span>
                                </label>
                            </div>

                            <div class="ncalc-col">
                                <label class="ncalc-label">
                                    <input
                                        type="radio"
                                        name="rd<?php echo $questionNumber; ?>_78"
                                        value="0">
                                    <span>Không đồng ý</span>
                                </label>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <nav>
                <ul class="ncalc-paginator">
                    <li>
                        <a href="#" class="previous-step">&lt; Quay lại</a>
                    </li>
                    <li>
                        <button type="button" class="ncalc-btn submit-depression">
                            Kiểm tra
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </form>

    <!-- KẾT QUẢ -->
    <div class="depression-result" aria-live="polite">
        <h2 class="ncalc-heading">Kết quả sàng lọc trầm cảm</h2>

        <div class="ncalc-result">
            <div class="ncalc-row">
                <span class="result-label">Giới tính:</span>
                <span class="result-sex"></span>
            </div>

            <div class="ncalc-row">
                <span class="result-label">Độ tuổi:</span>
                <span class="result-age"></span>
            </div>

            <div class="ncalc-row">
                <span class="result-label">Tổng điểm:</span>
                <span class="result-score"></span>
            </div>

            <div class="result-description"></div>

            <!-- Cảnh báo riêng cho câu hỏi liên quan đến tự sát -->
            <div class="result-suicide-warning">
                <strong>Lưu ý quan trọng về an toàn</strong>
                Bạn đã chọn câu trả lời cho thấy có thể đang xuất hiện suy nghĩ
                liên quan đến cái chết hoặc tự sát. Không nên chỉ dựa vào tổng
                điểm của bảng hỏi để đánh giá tình trạng này.

                <p>
                    Bạn nên trao đổi trực tiếp với bác sĩ hoặc chuyên gia sức khỏe
                    tâm thần càng sớm càng tốt. Nếu hiện tại bạn có ý định tự sát,
                    có kế hoạch thực hiện hoặc cảm thấy không thể giữ an toàn cho
                    bản thân, hãy đến khoa cấp cứu gần nhất hoặc gọi cấp cứu 115.
                    Nếu có thể, hãy ở cạnh người thân đáng tin cậy và tránh ở một mình.
                </p>
            </div>

            <div class="result-warning">
                <strong>Lưu ý:</strong>
                Đây chỉ là công cụ sàng lọc tham khảo, không thay thế cho chẩn đoán
                hoặc tư vấn của bác sĩ. Nếu các triệu chứng kéo dài hoặc ảnh hưởng
                đến cuộc sống, bạn nên tìm sự hỗ trợ chuyên môn.
            </div>

            <button type="button" class="ncalc-btn restart-depression" style="margin-top:15px;">
                Làm lại
            </button>
        </div>
    </div>

    <script>
    (function () {
        'use strict';

        function initDepressionCalculator78() {
            var root = document.getElementById('depression-calculator-78');

            if (!root || root.getAttribute('data-initialized') === '1') {
                return;
            }

            root.setAttribute('data-initialized', '1');

            var form = root.querySelector('.depression-form-78');
            var steps = root.querySelectorAll('.ncalc-step');
            var navItems = root.querySelectorAll('.setup-panel li');
            var resultBox = root.querySelector('.depression-result');

            var currentStep = 0;
            var totalSteps = steps.length;

            if (!form || totalSteps !== 3) {
                return;
            }

            /* Cuộn đến đầu công cụ */
            function scrollToCalculator() {
                var rect = root.getBoundingClientRect();
                var scrollTop = window.pageYOffset ||
                    document.documentElement.scrollTop;

                var target = scrollTop + rect.top - 80;

                window.scrollTo({
                    top: target < 0 ? 0 : target,
                    behavior: 'smooth'
                });
            }

            /* Lấy câu trả lời đã chọn trong một bước */
            function getCheckedRadio(stepIndex) {
                return steps[stepIndex].querySelector(
                    'input[type="radio"]:checked'
                );
            }

            /* Hiển thị thông báo lỗi */
            function showError(stepIndex, message) {
                var error = steps[stepIndex].querySelector('.ncalc-error');

                if (!error) {
                    return;
                }

                if (message) {
                    error.textContent = message;
                }

                error.style.display = 'block';
            }

            /* Ẩn thông báo lỗi */
            function hideError(stepIndex) {
                var error = steps[stepIndex].querySelector('.ncalc-error');

                if (error) {
                    error.style.display = 'none';
                }
            }

            /* Cập nhật trạng thái thanh tiến trình */
            function updateNavigation() {
                for (var i = 0; i < navItems.length; i++) {
                    navItems[i].classList.remove('active');
                    navItems[i].classList.remove('completed');

                    if (i < currentStep) {
                        navItems[i].classList.add('completed');
                        navItems[i].classList.remove('disabled');
                    } else if (i === currentStep) {
                        navItems[i].classList.add('active');
                        navItems[i].classList.remove('disabled');
                    } else {
                        navItems[i].classList.add('disabled');
                    }
                }
            }

            /* Hiển thị bước */
            function showStep(index) {
                if (index < 0 || index >= totalSteps) {
                    return;
                }

                currentStep = index;

                for (var i = 0; i < steps.length; i++) {
                    steps[i].style.display = (i === index) ? 'block' : 'none';
                }

                updateNavigation();
            }

            /* Kiểm tra dữ liệu bước hiện tại */
            function validateStep(stepIndex) {
                var checked = getCheckedRadio(stepIndex);

                if (!checked) {
                    showError(stepIndex);
                    return false;
                }

                hideError(stepIndex);
                return true;
            }

            /* Cập nhật màu nhãn đã chọn */
            function updateLabels() {
                var labels = root.querySelectorAll('.ncalc-label');

                for (var i = 0; i < labels.length; i++) {
                    labels[i].classList.remove('active');
                }

                var checkedInputs = root.querySelectorAll(
                    'input[type="radio"]:checked'
                );

                for (var j = 0; j < checkedInputs.length; j++) {
                    var label = checkedInputs[j].closest('.ncalc-label');

                    if (label) {
                        label.classList.add('active');
                    }
                }
            }

            /* Lấy nội dung độ tuổi */
            function getAgeText(age) {
                if (age === '0') {
                    return 'Dưới 35 tuổi';
                }

                if (age === '20') {
                    return '35 - 49 tuổi';
                }

                if (age === '30') {
                    return 'Từ 50 tuổi trở lên';
                }

                return '';
            }

            /* Phân loại kết quả theo thang điểm gốc */
            function getDepressionDescription(total) {
                if (total <= 5) {
                    return 'Không có dấu hiệu chán nản theo cách tính điểm của bảng hỏi này. Tuy nhiên, nếu có bất kỳ vấn đề gì lo lắng về sức khỏe của mình, hãy hỏi ý kiến thầy thuốc.';
                }

                if (total <= 10) {
                    return 'Có dấu hiệu chán nản mức độ nhẹ theo bảng hỏi này. Bạn có thể thực hiện lại khảo sát sau vài ngày. Nếu lo lắng, nên hỏi ý kiến bác sĩ đa khoa hoặc bác sĩ tâm lý.';
                }

                if (total <= 15) {
                    return 'Có dấu hiệu chán nản đáng kể theo bảng hỏi này. Bạn nên trao đổi với bác sĩ đa khoa hoặc bác sĩ tâm lý để được đánh giá thêm.';
                }

                if (total <= 20) {
                    return 'Có dấu hiệu chán nản ở mức độ nhẹ tới trung bình theo bảng hỏi này. Bạn nên đi khám bác sĩ đa khoa hoặc bác sĩ tâm lý.';
                }

                if (total <= 25) {
                    return 'Có dấu hiệu chán nản mức độ trung bình theo bảng hỏi này. Bạn nên đi khám bác sĩ đa khoa hoặc bác sĩ tâm lý.';
                }

                return 'Có nhiều dấu hiệu chán nản theo bảng hỏi này. Bạn nên sớm gặp bác sĩ để được đánh giá và tư vấn.';
            }

            /* Tính điểm và hiển thị kết quả */
            function calculateDepression() {
                var total = 0;
                var unanswered = 0;
                var answer11 = null;
                var answer15 = null;

                for (var i = 1; i <= 15; i++) {
                    var answer = form.querySelector(
                        'input[name="rd' + i + '_78"]:checked'
                    );

                    if (!answer) {
                        unanswered++;
                        continue;
                    }

                    var value = parseInt(answer.value, 10);

                    if (isNaN(value)) {
                        unanswered++;
                        continue;
                    }

                    total += value;

                    if (i === 11) {
                        answer11 = value;
                    }

                    if (i === 15) {
                        answer15 = value;
                    }
                }

                if (unanswered > 0) {
                    showError(
                        2,
                        'Còn ' + unanswered +
                        ' câu hỏi chưa được trả lời. Vui lòng hoàn thành tất cả 15 câu hỏi.'
                    );

                    return;
                }

                var sexInput = form.querySelector(
                    'input[name="sex_78"]:checked'
                );

                var ageInput = form.querySelector(
                    'input[name="age_78"]:checked'
                );

                if (!sexInput || !ageInput) {
                    return;
                }

                hideError(2);

                var sexText = sexInput.value === 'female' ? 'Nữ' : 'Nam';
                var ageText = getAgeText(ageInput.value);

                var description = getDepressionDescription(total);

                root.querySelector('.result-sex').textContent = sexText;
                root.querySelector('.result-age').textContent = ageText;
                root.querySelector('.result-score').textContent =
                    total + ' / 30 điểm';

                root.querySelector('.result-description').textContent =
                    description;

                /*
                 * Nếu câu 11 hoặc câu 15 có điểm lớn hơn 0,
                 * hiển thị cảnh báo riêng.
                 * Không phụ thuộc vào tổng điểm.
                 */
                var suicideWarning = root.querySelector(
                    '.result-suicide-warning'
                );

                if (answer11 > 0 || answer15 > 0) {
                    suicideWarning.style.display = 'block';
                } else {
                    suicideWarning.style.display = 'none';
                }

                form.style.display = 'none';
                resultBox.style.display = 'block';

                scrollToCalculator();
            }

            /* Sự kiện chọn đáp án */
            root.addEventListener('change', function (event) {
                var target = event.target;

                if (!target || target.type !== 'radio') {
                    return;
                }

                updateLabels();

                var step = target.closest('.ncalc-step');

                if (step) {
                    var stepIndex = Array.prototype.indexOf.call(
                        steps,
                        step
                    );

                    if (stepIndex >= 0) {
                        hideError(stepIndex);
                    }
                }
            });

            /* Sự kiện click */
            root.addEventListener('click', function (event) {
                var target = event.target;

                /* Tiếp theo */
                var nextButton = target.closest('.next-step');

                if (nextButton && root.contains(nextButton)) {
                    event.preventDefault();

                    if (!validateStep(currentStep)) {
                        return;
                    }

                    if (currentStep < totalSteps - 1) {
                        showStep(currentStep + 1);
                        scrollToCalculator();
                    }

                    return;
                }

                /* Quay lại */
                var previousButton = target.closest('.previous-step');

                if (previousButton && root.contains(previousButton)) {
                    event.preventDefault();

                    if (currentStep > 0) {
                        showStep(currentStep - 1);
                        scrollToCalculator();
                    }

                    return;
                }

                /* Click số bước */
                var navLink = target.closest('.setup-panel a');

                if (navLink && root.contains(navLink)) {
                    event.preventDefault();

                    var navItem = navLink.parentNode;
                    var index = Array.prototype.indexOf.call(
                        navItems,
                        navItem
                    );

                    if (index < 0 || index > currentStep) {
                        return;
                    }

                    showStep(index);
                    scrollToCalculator();
                    return;
                }

                /* Kiểm tra */
                var submitButton = target.closest('.submit-depression');

                if (submitButton && root.contains(submitButton)) {
                    event.preventDefault();

                    calculateDepression();
                    return;
                }

                /* Làm lại */
                var restartButton = target.closest('.restart-depression');

                if (restartButton && root.contains(restartButton)) {
                    event.preventDefault();

                    form.reset();

                    form.style.display = 'block';
                    resultBox.style.display = 'none';

                    var errors = root.querySelectorAll('.ncalc-error');

                    for (var i = 0; i < errors.length; i++) {
                        errors[i].style.display = 'none';
                    }

                    var suicideWarning = root.querySelector(
                        '.result-suicide-warning'
                    );

                    suicideWarning.style.display = 'none';

                    root.querySelector('.result-sex').textContent = '';
                    root.querySelector('.result-age').textContent = '';
                    root.querySelector('.result-score').textContent = '';
                    root.querySelector('.result-description').textContent = '';

                    updateLabels();
                    showStep(0);
                    scrollToCalculator();
                }
            });

            /* Khởi tạo */
            showStep(0);
            updateLabels();
        }

        if (document.readyState === 'loading') {
            document.addEventListener(
                'DOMContentLoaded',
                initDepressionCalculator78
            );
        } else {
            initDepressionCalculator78();
        }
    })();
    </script>
</div>
