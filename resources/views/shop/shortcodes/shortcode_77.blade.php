
<div id="anxiety-calculator-77" class="anxiety-calculator-77">
    <style>
        #anxiety-calculator-77 {
            max-width: 850px;
            margin: 20px auto;
            color: #333;
            font-size: 15px;
            line-height: 1.6;
            box-sizing: border-box;
        }

        #anxiety-calculator-77 *,
        #anxiety-calculator-77 *:before,
        #anxiety-calculator-77 *:after {
            box-sizing: border-box;
        }

        #anxiety-calculator-77 .ncalc-heading {
            font-size: 23px;
            font-weight: 700;
            margin: 0 0 22px;
            color: #222;
        }

        /* Thanh tiến trình */
        #anxiety-calculator-77 .setup-panel {
            display: flex;
            list-style: none;
            padding: 0;
            margin: 0 0 25px;
            border-bottom: 2px solid #e5e7eb;
        }

        #anxiety-calculator-77 .setup-panel li {
            flex: 1;
            text-align: center;
            position: relative;
            padding-bottom: 12px;
        }

        #anxiety-calculator-77 .setup-panel li:after {
            content: "";
            position: absolute;
            left: 50%;
            bottom: -2px;
            width: 0;
            height: 3px;
            background: #1688c9;
            transition: width .25s ease;
        }

        #anxiety-calculator-77 .setup-panel li.completed:after,
        #anxiety-calculator-77 .setup-panel li.active:after {
            width: 100%;
        }

        #anxiety-calculator-77 .setup-panel li a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            border-radius: 50%;
            background: #e5e7eb;
            color: #555;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            position: relative;
            z-index: 1;
            transition: all .2s ease;
        }

        #anxiety-calculator-77 .setup-panel li.active a,
        #anxiety-calculator-77 .setup-panel li.completed a {
            background: #1688c9;
            color: #fff;
        }

        #anxiety-calculator-77 .setup-panel li.disabled a {
            cursor: not-allowed;
            opacity: .55;
        }

        #anxiety-calculator-77 .ncalc-title h3 {
            font-size: 19px;
            font-weight: 700;
            margin: 15px 0;
            color: #222;
        }

        #anxiety-calculator-77 .ncalc-error {
            display: none;
            color: #d93025;
            background: #fff5f5;
            border: 1px solid #ffd6d6;
            padding: 10px 12px;
            border-radius: 5px;
            margin: 10px 0;
            font-size: 14px;
        }

        #anxiety-calculator-77 .ncalc-wrapper {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            margin: 15px 0;
        }

        #anxiety-calculator-77 .ncalc-col {
            flex: 1 1 180px;
            min-width: 0;
        }

        #anxiety-calculator-77 .ncalc-label {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 14px;
            border: 1px solid #dfe3e8;
            border-radius: 7px;
            cursor: pointer;
            min-height: 52px;
            height: 100%;
            background: #fff;
            transition: all .2s ease;
        }

        #anxiety-calculator-77 .ncalc-label:hover {
            border-color: #1688c9;
            background: #f7fbff;
        }

        #anxiety-calculator-77 .ncalc-label.active {
            border-color: #1688c9;
            background: #eef8ff;
            color: #0875b5;
        }

        #anxiety-calculator-77 .ncalc-label input {
            margin: 0;
            flex-shrink: 0;
            width: 17px;
            height: 17px;
            accent-color: #1688c9;
        }

        #anxiety-calculator-77 .ncalc-row {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        #anxiety-calculator-77 .ncalc-row:last-child {
            border-bottom: 0;
        }

        #anxiety-calculator-77 .ncalc-row h4 {
            font-size: 16px;
            line-height: 1.5;
            margin: 0 0 10px;
            font-weight: 600;
            color: #333;
        }

        #anxiety-calculator-77 .ncalc-row .ncalc-wrapper {
            margin: 10px 0 0;
        }

        #anxiety-calculator-77 .ncalc-paginator {
            display: flex;
            justify-content: space-between;
            align-items: center;
            list-style: none;
            padding: 15px 0;
            margin: 0;
            gap: 10px;
        }

        #anxiety-calculator-77 .ncalc-paginator li {
            margin: 0;
            padding: 0;
        }

        #anxiety-calculator-77 .ncalc-paginator a {
            color: #1688c9;
            cursor: pointer;
            text-decoration: none;
            font-weight: 600;
        }

        #anxiety-calculator-77 .ncalc-paginator a:hover {
            color: #075f99;
            text-decoration: underline;
        }

        #anxiety-calculator-77 .ncalc-btn {
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

        #anxiety-calculator-77 .ncalc-btn:hover {
            background: #0875b5;
            color: #fff;
        }

        #anxiety-calculator-77 .ncalc-result {
            display: none;
            padding: 22px;
            background: #f5f9fc;
            border: 1px solid #e2edf5;
            border-radius: 8px;
            margin-top: 20px;
        }

        #anxiety-calculator-77 .ncalc-result h3 {
            margin: 0 0 15px;
            font-size: 20px;
            color: #222;
        }

        #anxiety-calculator-77 .ncalc-result-score {
            color: #d93025;
            font-weight: 700;
            font-size: 20px;
        }

        #anxiety-calculator-77 .ncalc-result-text {
            line-height: 1.8;
            margin-top: 12px;
        }

        #anxiety-calculator-77 .ncalc-result-note {
            margin-top: 15px;
            padding: 12px;
            background: #fff;
            border-left: 3px solid #1688c9;
            font-size: 13px;
            color: #555;
        }

        #anxiety-calculator-77 .ncalc-step {
            display: none;
        }

        @media (max-width: 600px) {
            #anxiety-calculator-77 {
                margin: 15px auto;
                font-size: 14px;
            }

            #anxiety-calculator-77 .ncalc-heading {
                font-size: 20px;
                margin-bottom: 18px;
            }

            #anxiety-calculator-77 .ncalc-title h3 {
                font-size: 17px;
            }

            #anxiety-calculator-77 .ncalc-wrapper {
                gap: 8px;
            }

            #anxiety-calculator-77 .ncalc-col {
                flex-basis: 100%;
            }

            #anxiety-calculator-77 .ncalc-label {
                padding: 12px;
                min-height: 48px;
            }

            #anxiety-calculator-77 .ncalc-row {
                padding: 13px 0;
            }

            #anxiety-calculator-77 .ncalc-row h4 {
                font-size: 15px;
            }

            #anxiety-calculator-77 .ncalc-result {
                padding: 16px;
            }

            #anxiety-calculator-77 .ncalc-result h3 {
                font-size: 18px;
            }

            #anxiety-calculator-77 .ncalc-btn {
                padding: 10px 18px;
                font-size: 14px;
            }
        }
    </style>

    <h2 class="ncalc-heading">Công cụ đo lường chứng lo âu</h2>

    <form class="anxiety-form-77" action="javascript:void(0);" novalidate>
        <ul class="setup-panel">
            <li class="active">
                <a href="#anxiety-step-1-77">1</a>
            </li>
            <li class="disabled">
                <a href="#anxiety-step-2-77">2</a>
            </li>
            <li class="disabled">
                <a href="#anxiety-step-3-77">3</a>
            </li>
        </ul>

        <!-- BƯỚC 1: GIỚI TÍNH -->
        <div class="ncalc-step" id="anxiety-step-1-77">
            <div class="ncalc-title">
                <h3>Bạn là nam hay nữ?</h3>
            </div>

            <div class="ncalc-error">
                Vui lòng chọn giới tính của bạn.
            </div>

            <div class="ncalc-wrapper">
                <div class="ncalc-col">
                    <label class="ncalc-label">
                        <input type="radio" name="sex_77" value="male">
                        <span>Nam</span>
                    </label>
                </div>

                <div class="ncalc-col">
                    <label class="ncalc-label">
                        <input type="radio" name="sex_77" value="female">
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
        <div class="ncalc-step" id="anxiety-step-2-77">
            <div class="ncalc-title">
                <h3>Hãy cho biết độ tuổi của bạn?</h3>
            </div>

            <div class="ncalc-error">
                Vui lòng chọn tuổi của bạn.
            </div>

            <div class="ncalc-wrapper">
                <div class="ncalc-col">
                    <label class="ncalc-label">
                        <input type="radio" name="age_77" value="0">
                        <span>Dưới 35 tuổi</span>
                    </label>
                </div>

                <div class="ncalc-col">
                    <label class="ncalc-label">
                        <input type="radio" name="age_77" value="20">
                        <span>35-49 tuổi</span>
                    </label>
                </div>

                <div class="ncalc-col">
                    <label class="ncalc-label">
                        <input type="radio" name="age_77" value="30">
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
        <div class="ncalc-step" id="anxiety-step-3-77">
            <div class="ncalc-title">
                <h3>Trả lời các câu hỏi dưới đây</h3>
            </div>

            <div class="ncalc-error">
                Hãy trả lời đầy đủ các câu hỏi được đánh dấu.
            </div>

            <div class="ncalc-questions">

                <div class="ncalc-row">
                    <h4>1. Tôi hay lo âu quá mức về nhiều thứ</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd1_77" value="1">
                                <span>Đồng ý</span>
                            </label>
                        </div>
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd1_77" value="0">
                                <span>Không đồng ý</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>2. Tôi không thể kiểm soát được suy nghĩ của mình và khó thoát khỏi sự lo âu</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd2_77" value="1">
                                <span>Đồng ý</span>
                            </label>
                        </div>
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd2_77" value="0">
                                <span>Không đồng ý</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>3. Tôi hay lo âu khi thậm chí khi không có nguyên nhân gì</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd3_77" value="1">
                                <span>Đồng ý</span>
                            </label>
                        </div>
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd3_77" value="0">
                                <span>Không đồng ý</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>4. Tôi có cảm giác mình thở ngắn, hồi hộp trống ngực hoặc lắc lư khi nghỉ ngơi</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd4_77" value="1">
                                <span>Đồng ý</span>
                            </label>
                        </div>
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd4_77" value="0">
                                <span>Không đồng ý</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>5. Tôi có vấn đề khi vào giấc ngủ hoặc trong lúc ngủ.</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd5_77" value="1">
                                <span>Đồng ý</span>
                            </label>
                        </div>
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd5_77" value="0">
                                <span>Không đồng ý</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>6. Tôi khó tập trung vào một công việc cụ thể</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd6_77" value="1">
                                <span>Đồng ý</span>
                            </label>
                        </div>
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd6_77" value="0">
                                <span>Không đồng ý</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>7. Tôi thường xuyên có cảm giác cáu bẳn.</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd7_77" value="1">
                                <span>Đồng ý</span>
                            </label>
                        </div>
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd7_77" value="0">
                                <span>Không đồng ý</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>8. Tôi cảm thấy bồn chồn và khó có thể ngồi yên mà không chơi đùa với thứ gì đó</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd8_77" value="1">
                                <span>Đồng ý</span>
                            </label>
                        </div>
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd8_77" value="0">
                                <span>Không đồng ý</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>9. Tôi thường thấy cơ mình bị căng</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd9_77" value="1">
                                <span>Đồng ý</span>
                            </label>
                        </div>
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd9_77" value="0">
                                <span>Không đồng ý</span>
                            </label>
                        </div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>10. Tình trạng lo âu quá mức này ảnh hưởng đến công việc của tôi.</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd10_77" value="1">
                                <span>Đồng ý</span>
                            </label>
                        </div>
                        <div class="ncalc-col">
                            <label class="ncalc-label">
                                <input type="radio" name="rd10_77" value="0">
                                <span>Không đồng ý</span>
                            </label>
                        </div>
                    </div>
                </div>

            </div>

            <nav>
                <ul class="ncalc-paginator">
                    <li>
                        <a href="#" class="previous-step">&lt; Quay lại</a>
                    </li>
                    <li>
                        <button type="button" class="ncalc-btn submit-anxiety">
                            Kiểm tra
                        </button>
                    </li>
                </ul>
            </nav>
        </div>
    </form>

    <!-- KẾT QUẢ -->
    <div class="ncalc-result" aria-live="polite">
        <h3>Kiểm tra sàng lọc lo âu - Kết quả</h3>

        <p>
            Tổng điểm của bạn là
            <span class="ncalc-result-score"></span>/10
        </p>

        <div class="ncalc-result-text"></div>

        <div class="ncalc-result-note">
            <strong>Lưu ý:</strong>
            Đây là công cụ sàng lọc tham khảo, không thay thế cho chẩn đoán
            hoặc đánh giá chuyên môn. Nếu lo âu kéo dài, ảnh hưởng đến sinh
            hoạt hoặc công việc, bạn nên trao đổi với nhân viên y tế.
        </div>

        <button type="button" class="ncalc-btn restart-anxiety" style="margin-top:15px;">
            Làm lại
        </button>
    </div>

    <script>
    (function () {
        'use strict';

        function initAnxietyCalculator77() {
            var root = document.getElementById('anxiety-calculator-77');

            if (!root || root.getAttribute('data-initialized') === '1') {
                return;
            }

            root.setAttribute('data-initialized', '1');

            var form = root.querySelector('.anxiety-form-77');
            var steps = root.querySelectorAll('.ncalc-step');
            var navItems = root.querySelectorAll('.setup-panel li');
            var resultBox = root.querySelector('.ncalc-result');
            var resultScore = root.querySelector('.ncalc-result-score');
            var resultText = root.querySelector('.ncalc-result-text');

            var currentStep = 0;
            var totalSteps = steps.length;

            if (!form || totalSteps !== 3) {
                return;
            }

            /* Cuộn đến đầu công cụ */
            function scrollToCalculator() {
                var rect = root.getBoundingClientRect();
                var scrollTop = window.pageYOffset || document.documentElement.scrollTop;
                var target = scrollTop + rect.top - 80;

                window.scrollTo({
                    top: target < 0 ? 0 : target,
                    behavior: 'smooth'
                });
            }

            /* Lấy radio được chọn trong một bước */
            function getCheckedRadio(stepIndex) {
                var checked = steps[stepIndex].querySelector(
                    'input[type="radio"]:checked'
                );

                return checked;
            }

            /* Ẩn thông báo lỗi */
            function hideError(stepIndex) {
                var error = steps[stepIndex].querySelector('.ncalc-error');

                if (error) {
                    error.style.display = 'none';
                }
            }

            /* Hiển thị lỗi */
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

            /* Cập nhật thanh tiến trình */
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

            /* Chuyển bước */
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

            /* Kiểm tra dữ liệu trước khi chuyển bước */
            function validateStep(stepIndex) {
                var checked = getCheckedRadio(stepIndex);

                if (!checked) {
                    showError(stepIndex);
                    return false;
                }

                hideError(stepIndex);
                return true;
            }

            /* Cập nhật giao diện lựa chọn */
            function updateSelectedLabels() {
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

            /* Kiểm tra và tính điểm */
            function calculateAnxiety() {
                var total = 0;
                var unanswered = 0;

                for (var i = 1; i <= 10; i++) {
                    var answer = form.querySelector(
                        'input[name="rd' + i + '_77"]:checked'
                    );

                    if (!answer) {
                        unanswered++;
                    } else {
                        total += parseInt(answer.value, 10) || 0;
                    }
                }

                if (unanswered > 0) {
                    showError(
                        2,
                        'Còn ' + unanswered +
                        ' câu hỏi chưa được trả lời. Vui lòng hoàn thành tất cả câu hỏi.'
                    );

                    return;
                }

                hideError(2);

                var message = '';

                if (total === 0) {
                    message = 'Bạn không có dấu hiệu lo âu theo các câu trả lời trong bảng hỏi này. Hãy duy trì lối sống lành mạnh. Nếu có bất kỳ vấn đề gì lo lắng về sức khỏe của mình, hãy hỏi ý kiến thầy thuốc.';
                } else if (total >= 1 && total <= 4) {
                    message = 'Bạn có một số dấu hiệu lo âu ở mức độ nhẹ theo cách tính điểm của bảng hỏi này. Nếu tình trạng vẫn tiếp diễn hoặc ảnh hưởng đến cuộc sống, hãy trao đổi với bác sĩ đa khoa hoặc bác sĩ chuyên khoa tâm thần.';
                } else {
                    message = 'Bạn có nhiều dấu hiệu lo âu theo bảng hỏi này. Hãy gặp bác sĩ đa khoa hoặc bác sĩ chuyên khoa tâm thần để được tư vấn và đánh giá thêm.';
                }

                resultScore.textContent = total;
                resultText.textContent = message;

                form.style.display = 'none';
                resultBox.style.display = 'block';

                scrollToCalculator();
            }

            /* Sự kiện chọn câu trả lời */
            root.addEventListener('change', function (event) {
                var target = event.target;

                if (!target || target.type !== 'radio') {
                    return;
                }

                updateSelectedLabels();

                var step = target.closest('.ncalc-step');

                if (step) {
                    var stepIndex = Array.prototype.indexOf.call(steps, step);

                    if (stepIndex >= 0) {
                        hideError(stepIndex);
                    }
                }
            });

            /* Sự kiện chuyển bước */
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

                /* Click số trên thanh tiến trình */
                var navLink = target.closest('.setup-panel a');

                if (navLink && root.contains(navLink)) {
                    event.preventDefault();

                    var navItem = navLink.parentNode;
                    var index = Array.prototype.indexOf.call(navItems, navItem);

                    if (index < 0 || index > currentStep) {
                        return;
                    }

                    showStep(index);
                    scrollToCalculator();
                    return;
                }

                /* Kiểm tra kết quả */
                var submitButton = target.closest('.submit-anxiety');

                if (submitButton && root.contains(submitButton)) {
                    event.preventDefault();

                    calculateAnxiety();
                    return;
                }

                /* Làm lại */
                var restartButton = target.closest('.restart-anxiety');

                if (restartButton && root.contains(restartButton)) {
                    event.preventDefault();

                    form.reset();

                    form.style.display = 'block';
                    resultBox.style.display = 'none';

                    resultScore.textContent = '';
                    resultText.textContent = '';

                    var errors = root.querySelectorAll('.ncalc-error');

                    for (var i = 0; i < errors.length; i++) {
                        errors[i].style.display = 'none';
                    }

                    updateSelectedLabels();
                    showStep(0);
                    scrollToCalculator();
                }
            });

            /* Khởi tạo */
            showStep(0);
            updateSelectedLabels();
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initAnxietyCalculator77);
        } else {
            initAnxietyCalculator77();
        }
    })();
    </script>
</div>
