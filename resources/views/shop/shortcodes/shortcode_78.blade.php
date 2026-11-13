
<div id="depression-calculator-78" class="depression-calculator-78">
    <style>
        #depression-calculator-78 { max-width: 850px; margin: 20px auto; color: #333; font-size: 15px; }
        #depression-calculator-78 .ncalc-heading { font-size: 23px; font-weight: 600; margin: 0 0 20px; }
        #depression-calculator-78 .setup-panel { display: flex; list-style: none; padding: 0; margin: 0 0 25px; border-bottom: 2px solid #ddd; }
        #depression-calculator-78 .setup-panel li { flex: 1; text-align: center; padding-bottom: 12px; }
        #depression-calculator-78 .setup-panel li a { display: inline-flex; align-items: center; justify-content: center; width: 34px; height: 34px; border-radius: 50%; background: #ddd; color: #555; text-decoration: none; cursor: pointer; }
        #depression-calculator-78 .setup-panel li.active a, #depression-calculator-78 .setup-panel li.completed a { background: #1688c9; color: #fff; }
        #depression-calculator-78 .setup-panel li.disabled a { cursor: not-allowed; opacity: .5; }
        #depression-calculator-78 .ncalc-title h3 { font-size: 19px; font-weight: 600; margin: 15px 0; }
        #depression-calculator-78 .ncalc-error { display: none; color: #d93025; margin: 10px 0; }
        #depression-calculator-78 .ncalc-wrapper { display: flex; flex-wrap: wrap; gap: 10px; margin: 15px 0; }
        #depression-calculator-78 .ncalc-col { flex: 1 1 150px; }
        #depression-calculator-78 .ncalc-label { display: flex; align-items: center; gap: 8px; padding: 13px; border: 1px solid #ddd; border-radius: 6px; cursor: pointer; height: 100%; box-sizing: border-box; }
        #depression-calculator-78 .ncalc-label.active { border-color: #1688c9; background: #eef8ff; }
        #depression-calculator-78 .ncalc-label input { margin: 0; }
        #depression-calculator-78 .ncalc-row { padding: 15px 0; border-bottom: 1px solid #eee; }
        #depression-calculator-78 .ncalc-row h4 { font-size: 16px; margin: 0 0 10px; font-weight: 500; line-height: 1.5; }
        #depression-calculator-78 .ncalc-paginator { display: flex; justify-content: space-between; align-items: center; list-style: none; padding: 15px 0; margin: 0; }
        #depression-calculator-78 .ncalc-paginator a { color: #1688c9; cursor: pointer; text-decoration: none; }
        #depression-calculator-78 .ncalc-btn { border: 0; background: #1688c9; color: #fff; padding: 10px 25px; border-radius: 5px; cursor: pointer; }
        #depression-calculator-78 .ncalc-btn:hover { background: #0875b5; }
        #depression-calculator-78 .ncalc-step { display: none; }
        #depression-calculator-78 .ncalc-result { padding: 20px; background: #f5f9fc; border-radius: 8px; line-height: 1.7; }
        #depression-calculator-78 .result-label { font-weight: 600; }
        #depression-calculator-78 .result-score { color: #d93025; font-weight: 700; font-size: 20px; }
        #depression-calculator-78 .result-description { margin-top: 15px; }
        #depression-calculator-78 .result-warning { margin-top: 15px; padding: 12px; background: #fff4e5; border-left: 4px solid #e6a23c; }
        @media (max-width: 600px) {
            #depression-calculator-78 .ncalc-heading { font-size: 20px; }
            #depression-calculator-78 .ncalc-title h3 { font-size: 17px; }
            #depression-calculator-78 .ncalc-col { flex-basis: 100%; }
        }
    </style>

    <h2 class="ncalc-heading">Công cụ sàng lọc trầm cảm</h2>

    <form class="depression-form-78" action="javascript:void(0);">
        <ul class="setup-panel">
            <li class="active"><a href="#depression-step-1-78">1</a></li>
            <li class="disabled"><a href="#depression-step-2-78">2</a></li>
            <li class="disabled"><a href="#depression-step-3-78">3</a></li>
        </ul>

        <div class="ncalc-step" id="depression-step-1-78">
            <div class="ncalc-title"><h3>Bạn là nam hay nữ?</h3></div>
            <div class="ncalc-error">Vui lòng chọn giới tính</div>
            <div class="ncalc-wrapper">
                <div class="ncalc-col">
                    <label class="ncalc-label"><input type="radio" name="sex_78" value="male"> Nam</label>
                </div>
                <div class="ncalc-col">
                    <label class="ncalc-label"><input type="radio" name="sex_78" value="female"> Nữ</label>
                </div>
            </div>
            <nav>
                <ul class="ncalc-paginator">
                    <li></li>
                    <li><a class="next-step">Tiếp theo &gt;</a></li>
                </ul>
            </nav>
        </div>

        <div class="ncalc-step" id="depression-step-2-78">
            <div class="ncalc-title"><h3>Hãy cho biết độ tuổi của bạn?</h3></div>
            <div class="ncalc-error">Vui lòng chọn tuổi của bạn</div>
            <div class="ncalc-wrapper">
                <div class="ncalc-col">
                    <label class="ncalc-label"><input type="radio" name="age_78" value="0"> Dưới 35 tuổi</label>
                </div>
                <div class="ncalc-col">
                    <label class="ncalc-label"><input type="radio" name="age_78" value="20"> 35 - 49 tuổi</label>
                </div>
                <div class="ncalc-col">
                    <label class="ncalc-label"><input type="radio" name="age_78" value="30"> Từ 50 tuổi trở lên</label>
                </div>
            </div>
            <nav>
                <ul class="ncalc-paginator">
                    <li><a class="previous-step">&lt; Quay lại</a></li>
                    <li><a class="next-step">Tiếp theo &gt;</a></li>
                </ul>
            </nav>
        </div>

        <div class="ncalc-step" id="depression-step-3-78">
            <div class="ncalc-title"><h3>Trả lời các câu hỏi dưới đây</h3></div>
            <div class="ncalc-error">Vui lòng trả lời đầy đủ 15 câu hỏi</div>

            <div class="ncalc-questions">
                <div class="ncalc-row">
                    <h4>1. Tôi luôn cảm thấy buồn và bất hạnh</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd1_78" value="2"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd1_78" value="1"> Không rõ ràng</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd1_78" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>2. Tôi cảm thấy mệt mỏi, có ít năng lượng và khó có thể tập trung</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd2_78" value="2"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd2_78" value="1"> Không rõ ràng</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd2_78" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>3. Tôi mất hứng thú với mọi thứ trong cuộc sống mà trước đây là rất quan trọng với tôi</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd3_78" value="2"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd3_78" value="1"> Không rõ ràng</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd3_78" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>4. Tôi mất cảm giác vui sướng trong cuộc sống</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd4_78" value="2"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd4_78" value="1"> Không rõ ràng</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd4_78" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>5. Tôi cảm thấy mình là người tội lỗi và đáng bị trừng phạt.</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd5_78" value="2"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd5_78" value="1"> Không rõ ràng</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd5_78" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>6. Tôi thường cảm thấy bồn chồn bất an kèm theo giảm hoạt động</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd6_78" value="2"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd6_78" value="1"> Không rõ ràng</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd6_78" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>7. Tôi cảm thấy khó khăn khi ra quyết định và làm mọi việc rất chậm chạp.</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd7_78" value="2"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd7_78" value="1"> Không rõ ràng</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd7_78" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>8. Tôi cảm thấy mệt mỏi và luôn cần nỗ lực nhiều để làm những thứ đơn giản.</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd8_78" value="2"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd8_78" value="1"> Không rõ ràng</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd8_78" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>9. Tôi thấy cân nặng và khẩu vị của mình thay đổi.</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd9_78" value="2"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd9_78" value="1"> Không rõ ràng</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd9_78" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>10. Tôi mất hứng thú với tình dục và sinh hoạt tình dục khó khăn</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd10_78" value="2"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd10_78" value="1"> Không rõ ràng</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd10_78" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>11. Tôi cảm thấy không có sự sống - thà chết đi còn hơn</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd11_78" value="2"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd11_78" value="1"> Không rõ ràng</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd11_78" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>12. Tôi cảm thấy tương lai mình tuyệt vọng và cảm thấy bị cầm tù.</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd12_78" value="2"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd12_78" value="1"> Không rõ ràng</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd12_78" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>13. Giấc ngủ của tôi bị rối loạn, ngủ quá nhiều hoặc quá ít.</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd13_78" value="2"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd13_78" value="1"> Không rõ ràng</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd13_78" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>14. Tôi luôn thấy chán nản ngay cả khi có điều tốt đẹp xảy đến với mình</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd14_78" value="2"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd14_78" value="1"> Không rõ ràng</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd14_78" value="0"> Không đồng ý</label></div>
                    </div>
                </div>

                <div class="ncalc-row">
                    <h4>15. Tôi thường có suy nghĩ về cái chết hoặc tự sát</h4>
                    <div class="ncalc-wrapper">
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd15_78" value="2"> Đồng ý</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd15_78" value="1"> Không rõ ràng</label></div>
                        <div class="ncalc-col"><label class="ncalc-label"><input type="radio" name="rd15_78" value="0"> Không đồng ý</label></div>
                    </div>
                </div>
            </div>

            <nav>
                <ul class="ncalc-paginator">
                    <li><a class="previous-step">&lt; Quay lại</a></li>
                    <li><button type="button" class="ncalc-btn submit-depression">Kiểm tra</button></li>
                </ul>
            </nav>
        </div>
    </form>

    <div class="depression-result" style="display:none;">
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
            <div class="result-warning">
                Đây chỉ là công cụ sàng lọc tham khảo, không thay thế chẩn đoán hoặc tư vấn của bác sĩ.
            </div>
            <button type="button" class="ncalc-btn restart-depression" style="margin-top:15px;">Làm lại</button>
        </div>
    </div>

    <script>
        jQuery(function ($) {
            var $root = $('#depression-calculator-78');
            if (!$root.length) return;

            var $steps = $root.find('.ncalc-step');
            var $navItems = $root.find('.setup-panel li');
            var currentStep = 0;

            function scrollToCalculator() {
                $('html, body').animate({ scrollTop: $root.offset().top - 80 }, 400);
            }

            function showStep(index) {
                if (index < 0 || index >= $steps.length) return;

                currentStep = index;
                $steps.hide().eq(index).show();
                $navItems.removeClass('active');
                $navItems.eq(index).addClass('active');
            }

            function updateLabels() {
                $root.find('.ncalc-label').removeClass('active');
                $root.find('input[type="radio"]:checked').each(function () {
                    $(this).closest('.ncalc-label').addClass('active');
                });
            }

            $root.on('change', 'input[type="radio"]', function () {
                updateLabels();
                $(this).closest('.ncalc-step').find('.ncalc-error').hide();
            });

            $navItems.find('a').on('click', function (e) {
                e.preventDefault();
                var index = $navItems.index($(this).closest('li'));

                if (index <= currentStep && !$navItems.eq(index).hasClass('disabled')) {
                    showStep(index);
                }
            });

            $root.on('click', '.next-step', function (e) {
                e.preventDefault();

                var $step = $steps.eq(currentStep);
                if (!$step.find('input[type="radio"]:checked').length) {
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

            $root.on('click', '.submit-depression', function () {
                var total = 0;
                var unanswered = 0;

                for (var i = 1; i <= 15; i++) {
                    var $answer = $root.find('input[name="rd' + i + '_78"]:checked');

                    if (!$answer.length) {
                        unanswered++;
                    } else {
                        total += parseInt($answer.val(), 10);
                    }
                }

                if (unanswered > 0) {
                    $steps.eq(2).find('.ncalc-error').text(
                        'Còn ' + unanswered + ' câu hỏi chưa được trả lời. Vui lòng trả lời tất cả câu hỏi.'
                    ).show();
                    return;
                }

                var sex = $root.find('input[name="sex_78"]:checked').val();
                var age = $root.find('input[name="age_78"]:checked').val();

                var sexText = sex === 'female' ? 'Nữ' : 'Nam';
                var ageText = '';

                if (age === '0') {
                    ageText = 'Dưới 35 tuổi';
                } else if (age === '20') {
                    ageText = '35 - 49 tuổi';
                } else {
                    ageText = 'Từ 50 tuổi trở lên';
                }

                var description = '';

                if (total <= 5) {
                    description = 'Không có dấu hiệu chán nản theo cách tính điểm của bảng hỏi này. Tuy nhiên, nếu có bất kỳ vấn đề gì lo lắng về sức khỏe của mình, hãy hỏi ý kiến thầy thuốc.';
                } else if (total <= 10) {
                    description = 'Có dấu hiệu chán nản mức độ nhẹ theo bảng hỏi này. Bạn có thể thực hiện lại khảo sát sau vài ngày. Nếu lo lắng, nên hỏi ý kiến bác sĩ đa khoa hoặc bác sĩ tâm lý.';
                } else if (total <= 15) {
                    description = 'Có dấu hiệu chán nản đáng kể theo bảng hỏi này. Bạn nên trao đổi với bác sĩ đa khoa hoặc bác sĩ tâm lý để được đánh giá thêm.';
                } else if (total <= 20) {
                    description = 'Có dấu hiệu chán nản ở mức độ nhẹ tới trung bình theo bảng hỏi này. Bạn nên đi khám bác sĩ đa khoa hoặc bác sĩ tâm lý.';
                } else if (total <= 25) {
                    description = 'Có dấu hiệu chán nản mức độ trung bình theo bảng hỏi này. Bạn nên đi khám bác sĩ đa khoa hoặc bác sĩ tâm lý.';
                } else {
                    description = 'Có nhiều dấu hiệu chán nản theo bảng hỏi này. Bạn nên sớm gặp bác sĩ để được đánh giá và tư vấn.';
                }

                $root.find('.result-sex').text(sexText);
                $root.find('.result-age').text(ageText);
                $root.find('.result-score').text(total + ' điểm');
                $root.find('.result-description').text(description);

                $root.find('.depression-form-78').hide();
                $root.find('.depression-result').show();

                scrollToCalculator();
            });

            $root.on('click', '.restart-depression', function () {
                $root.find('.depression-form-78')[0].reset();
                $root.find('.depression-result').hide();
                $root.find('.depression-form-78').show();
                $root.find('.ncalc-error').hide();
                $root.find('.ncalc-label').removeClass('active');
                $navItems.removeClass('completed disabled');
                $navItems.slice(1).addClass('disabled');
                showStep(0);
                scrollToCalculator();
            });

            showStep(0);
        });
    </script>
</div>
