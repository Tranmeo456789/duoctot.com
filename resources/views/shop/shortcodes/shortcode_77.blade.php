
<div id="anxiety-calculator-77" class="anxiety-calculator-77">
    <style>
        #anxiety-calculator-77 { max-width: 850px; margin: 20px auto; color: #333; font-size: 15px; }
        #anxiety-calculator-77 .ncalc-heading { font-size: 23px; font-weight: 600; margin: 0 0 20px; }
        #anxiety-calculator-77 .setup-panel { display: flex; list-style: none; padding: 0; margin: 0 0 25px; border-bottom: 2px solid #ddd; }
        #anxiety-calculator-77 .setup-panel li { flex: 1; text-align: center; position: relative; padding-bottom: 12px; }
        #anxiety-calculator-77 .setup-panel li a { display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; border-radius: 50%; background: #ddd; color: #555; text-decoration: none; cursor: pointer; }
        #anxiety-calculator-77 .setup-panel li.active a, #anxiety-calculator-77 .setup-panel li.completed a { background: #1688c9; color: #fff; }
        #anxiety-calculator-77 .setup-panel li.disabled a { cursor: not-allowed; opacity: .5; }
        #anxiety-calculator-77 .ncalc-title h3 { font-size: 19px; font-weight: 600; margin: 15px 0; }
        #anxiety-calculator-77 .ncalc-error { display: none; color: #d93025; margin: 10px 0; }
        #anxiety-calculator-77 .ncalc-wrapper { display: flex; flex-wrap: wrap; gap: 12px; margin: 15px 0; }
        #anxiety-calculator-77 .ncalc-col { flex: 1 1 180px; }
        #anxiety-calculator-77 .ncalc-label { display: flex; align-items: center; gap: 10px; padding: 14px; border: 1px solid #ddd; border-radius: 6px; cursor: pointer; height: 100%; box-sizing: border-box; }
        #anxiety-calculator-77 .ncalc-label.active { border-color: #1688c9; background: #eef8ff; }
        #anxiety-calculator-77 .ncalc-label input { margin: 0; }
        #anxiety-calculator-77 .ncalc-row { padding: 15px 0; border-bottom: 1px solid #eee; }
        #anxiety-calculator-77 .ncalc-row h4 { font-size: 16px; margin: 0 0 10px; font-weight: 500; }
        #anxiety-calculator-77 .ncalc-paginator { display: flex; justify-content: space-between; align-items: center; list-style: none; padding: 15px 0; margin: 0; }
        #anxiety-calculator-77 .ncalc-paginator a { color: #1688c9; cursor: pointer; text-decoration: none; }
        #anxiety-calculator-77 .ncalc-btn { border: 0; background: #1688c9; color: #fff; padding: 10px 25px; border-radius: 5px; cursor: pointer; }
        #anxiety-calculator-77 .ncalc-btn:hover { background: #0875b5; }
        #anxiety-calculator-77 .ncalc-result { padding: 20px; background: #f5f9fc; border-radius: 8px; }
        #anxiety-calculator-77 .ncalc-result h3 { margin-top: 0; }
        #anxiety-calculator-77 .ncalc-result-score { color: #d93025; font-weight: 700; }
        #anxiety-calculator-77 .ncalc-result-text { line-height: 1.7; }
        #anxiety-calculator-77 .ncalc-step { display: none; }
        @media (max-width: 600px) {
            #anxiety-calculator-77 .ncalc-heading { font-size: 20px; }
            #anxiety-calculator-77 .ncalc-title h3 { font-size: 17px; }
            #anxiety-calculator-77 .ncalc-wrapper { gap: 8px; }
            #anxiety-calculator-77 .ncalc-col { flex-basis: 100%; }
        }
    </style>

    <h2 class="ncalc-heading">Công cụ đo lường chứng lo âu</h2>

    <form class="anxiety-form-77" action="javascript:void(0);">
        <ul class="setup-panel">
            <li class="active"><a href="#anxiety-step-1-77">1</a></li>
            <li class="disabled"><a href="#anxiety-step-2-77">2</a></li>
            <li class="disabled"><a href="#anxiety-step-3-77">3</a></li>
        </ul>

        <div class="ncalc-step" id="anxiety-step-1-77">
            <div class="ncalc-title">
                <h3>Bạn là nam hay nữ?</h3>
            </div>
            <div class="ncalc-error">Vui lòng chọn giới tính của bạn</div>
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
                    <li><a class="next-step">Tiếp theo &gt;</a></li>
                </ul>
            </nav>
        </div>

        <div class="ncalc-step" id="anxiety-step-2-77">
            <div class="ncalc-title">
                <h3>Hãy cho biết độ tuổi của bạn?</h3>
            </div>
            <div class="ncalc-error">Vui lòng chọn tuổi của bạn</div>
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
                    <li><a class="previous-step">&lt; Quay lại</a></li>
                    <li><a class="next-step">Tiếp theo &gt;</a></li>
                </ul>
            </nav>
        </div>

        <div class="ncalc-step" id="anxiety-step-3-77">
            <div class="ncalc-title">
                <h3>Trả lời các câu hỏi dưới đây</h3>
            </div>
            <div class="ncalc-error">Hãy trả lời đầy đủ các câu hỏi được đánh dấu</div>

            <div class="ncalc-questions">
                <div class="ncalc-row">
                    <h4>1. Tôi hay lo âu quá mức về nhiều thứ</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd1_77" value="1"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd1_77" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>2. Tôi không thể kiểm soát được suy nghĩ của mình và khó thoát khỏi sự lo âu</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd2_77" value="1"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd2_77" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>3. Tôi hay lo âu khi thậm chí khi không có nguyên nhân gì</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd3_77" value="1"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd3_77" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>4. Tôi có cảm giác mình thở ngắn, hồi hộp trống ngực hoặc lắc lư khi nghỉ ngơi</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd4_77" value="1"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd4_77" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>5. Tôi có vấn đề khi vào giấc ngủ hoặc trong lúc ngủ.</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd5_77" value="1"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd5_77" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>6. Tôi khó tập trung vào một công việc cụ thể</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd6_77" value="1"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd6_77" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>7. Tôi thường xuyên có cảm giác cáu bẳn.</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd7_77" value="1"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd7_77" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>8. Tôi cảm thấy bồn chồn và khó có thể ngồi yên mà không chơi đùa với thứ gì đó</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd8_77" value="1"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd8_77" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>9. Tôi thường thấy cơ mình bị căng</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd9_77" value="1"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd9_77" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>10. Tình trạng lo âu quá mức này ảnh hưởng đến công việc của tôi.</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd10_77" value="1"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd10_77" value="0"> Không đồng ý</label></div>
                    </div>
                </div>
            </div>

            <nav>
                <ul class="ncalc-paginator">
                    <li><a class="previous-step">&lt; Quay lại</a></li>
                    <li><button type="button" class="ncalc-btn submit-anxiety">Kiểm tra</button></li>
                </ul>
            </nav>
        </div>
    </form>

    <div class="ncalc-result" style="display:none;">
        <h3>Kiểm tra sàng lọc lo âu - Kết quả</h3>
        <p>Tổng điểm của bạn là <span class="ncalc-result-score"></span></p>
        <div class="ncalc-result-text"></div>
        <button type="button" class="ncalc-btn restart-anxiety" style="margin-top:15px;">Làm lại</button>
    </div>

    <script>
        jQuery(function ($) {
            var $root = $('#anxiety-calculator-77');
            if (!$root.length) return;

            var $steps = $root.find('.ncalc-step');
            var $navItems = $root.find('.setup-panel li');
            var currentStep = 0;

            function scrollToCalculator() {
                $('html, body').animate({
                    scrollTop: $root.offset().top - 80
                }, 400);
            }

            function showStep(index) {
                if (index < 0 || index >= $steps.length) return;

                currentStep = index;
                $steps.hide().eq(index).show();

                $navItems.removeClass('active');
                $navItems.eq(index).addClass('active');

                $navItems.each(function (i) {
                    if (i > index) {
                        $(this).addClass('disabled');
                    }
                });
            }

            function markSelectedLabels() {
                $root.find('.ncalc-label').removeClass('active');
                $root.find('input:checked').each(function () {
                    $(this).closest('.ncalc-label').addClass('active');
                });
            }

            $root.on('change', 'input[type="radio"]', function () {
                markSelectedLabels();
                $(this).closest('.ncalc-step').find('.ncalc-error').hide();
            });

            $navItems.find('a').on('click', function (e) {
                e.preventDefault();

                var index = $navItems.index($(this).closest('li'));

                if (index <= currentStep && !$(this).closest('li').hasClass('disabled')) {
                    showStep(index);
                }
            });

            $root.on('click', '.next-step', function (e) {
                e.preventDefault();

                var $step = $steps.eq(currentStep);
                var checked = $step.find('input[type="radio"]:checked').length;

                if (!checked) {
                    $step.find('.ncalc-error').first().show();
                    return;
                }

                $navItems.eq(currentStep).addClass('completed');
                $navItems.eq(currentStep + 1).removeClass('disabled');
                showStep(currentStep + 1);
                scrollToCalculator();
            });

            $root.on('click', '.previous-step', function (e) {
                e.preventDefault();
                showStep(currentStep - 1);
                scrollToCalculator();
            });

            $root.on('click', '.submit-anxiety', function () {
                var total = 0;
                var unanswered = 0;

                for (var i = 1; i <= 10; i++) {
                    var answer = $root.find('input[name="rd' + i + '_77"]:checked');

                    if (!answer.length) {
                        unanswered++;
                    } else {
                        total += parseInt(answer.val(), 10);
                    }
                }

                if (unanswered > 0) {
                    $steps.eq(2).find('.ncalc-error').text(
                        'Còn ' + unanswered + ' câu hỏi chưa được trả lời. Vui lòng hoàn thành tất cả câu hỏi.'
                    ).show();
                    return;
                }

                var resultText = '';

                if (total === 0) {
                    resultText = 'Bạn không có dấu hiệu lo âu theo các câu trả lời trong bảng hỏi này. Hãy duy trì lối sống lành mạnh. Nếu có bất kỳ vấn đề gì lo lắng về sức khỏe của mình, hãy hỏi ý kiến thầy thuốc.';
                } else if (total >= 1 && total <= 4) {
                    resultText = 'Bạn có một số dấu hiệu lo âu ở mức độ nhẹ theo cách tính điểm của bảng hỏi này. Nếu tình trạng vẫn tiếp diễn hoặc ảnh hưởng đến cuộc sống, hãy trao đổi với bác sĩ đa khoa hoặc bác sĩ chuyên khoa tâm thần.';
                } else {
                    resultText = 'Bạn có nhiều dấu hiệu lo âu theo bảng hỏi này. Hãy gặp bác sĩ đa khoa hoặc bác sĩ chuyên khoa tâm thần để được tư vấn và đánh giá thêm.';
                }

                $root.find('.ncalc-result-score').text(total);
                $root.find('.ncalc-result-text').text(resultText);
                $root.find('.anxiety-form-77').hide();
                $root.find('.ncalc-result').show();

                scrollToCalculator();
            });

            $root.on('click', '.restart-anxiety', function () {
                $root.find('.anxiety-form-77')[0].reset();
                $root.find('.ncalc-result').hide();
                $root.find('.anxiety-form-77').show();
                $root.find('.ncalc-error').hide();
                $root.find('.ncalc-label').removeClass('active');
                $navItems.removeClass('completed').addClass('disabled');
                $navItems.eq(0).removeClass('disabled');
                showStep(0);
                scrollToCalculator();
            });

            showStep(0);
        });
    </script>
</div>
