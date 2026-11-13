
<div class="zung81-calculator">
    <style>
        .zung81-calculator { width: 100%; margin: 20px auto; color: #222; font-size: 15px; line-height: 1.5; }
        .zung81-calculator * { box-sizing: border-box; }
        .zung81-calculator .zung81-panel { width: 100%; margin-bottom: 20px; border: 1px solid #0F5885; background: #E6F4FE; }
        .zung81-calculator .zung81-title { padding: 12px 15px; background: #0F5885; color: #fff; font-size: 17px; font-weight: 600; }
        .zung81-calculator .zung81-info { padding: 15px; }
        .zung81-calculator .zung81-info-row { display: flex; align-items: center; flex-wrap: wrap; gap: 12px; margin-bottom: 12px; }
        .zung81-calculator .zung81-info-row:last-child { margin-bottom: 0; }
        .zung81-calculator .zung81-info-label { width: 180px; font-weight: 600; }
        .zung81-calculator select { min-width: 120px; max-width: 100%; height: 38px; padding: 5px 10px; border: 1px solid #bbb; background: #fff; }
        .zung81-calculator .zung81-question { padding: 14px 15px; border-top: 1px solid #fff; }
        .zung81-calculator .zung81-question-title { margin-bottom: 12px; font-weight: 600; }
        .zung81-calculator .zung81-options { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 8px; }
        .zung81-calculator .zung81-option { display: flex; align-items: center; justify-content: center; gap: 7px; min-height: 45px; padding: 8px; border: 1px solid #c5ddeb; background: #fff; cursor: pointer; text-align: center; }
        .zung81-calculator .zung81-option input { margin: 0; }
        .zung81-calculator .zung81-scale { display: flex; justify-content: space-between; gap: 10px; padding: 12px 15px; color: #444; font-size: 13px; }
        .zung81-calculator .zung81-actions { padding: 15px; text-align: center; }
        .zung81-calculator .zung81-button { display: inline-block; padding: 10px 25px; border: 0; background: #0F5885; color: #fff; font-size: 15px; font-weight: 600; cursor: pointer; }
        .zung81-calculator .zung81-button:hover { background: #0779A3; }
        .zung81-calculator .zung81-result { display: none; margin-top: 20px; border: 1px solid #0F5885; background: #E6F4FE; }
        .zung81-calculator .zung81-result-content { padding: 20px; text-align: center; }
        .zung81-calculator .zung81-total { margin-bottom: 10px; color: #0F5885; font-size: 22px; font-weight: 700; }
        .zung81-calculator .zung81-conclusion { font-size: 18px; font-weight: 600; }
        .zung81-calculator .zung81-note { margin-top: 15px; color: #555; font-size: 13px; }
        .zung81-calculator .zung81-required { color: #c00; }
        .zung81-calculator .zung81-warning { margin: 15px; padding: 12px; border-left: 4px solid #c77b00; background: #fff5df; color: #664600; font-size: 14px; }
        @media (max-width: 600px) {
            .zung81-calculator .zung81-info-label { width: 100%; }
            .zung81-calculator .zung81-options { grid-template-columns: repeat(2, minmax(0, 1fr)); }
            .zung81-calculator .zung81-title { font-size: 16px; }
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
        <div class="zung81-title">Công cụ tự đánh giá trầm cảm theo thang điểm Zung</div>

        <form class="zung81-form">
            <div class="zung81-info">
                <div class="zung81-info-row">
                    <div class="zung81-info-label">Giới tính <span class="zung81-required">*</span></div>
                    <label><input type="radio" name="sex" value="male"> Nam</label>
                    <label><input type="radio" name="sex" value="female"> Nữ</label>
                </div>

                <div class="zung81-info-row">
                    <div class="zung81-info-label">Chọn tuổi của bạn <span class="zung81-required">*</span></div>
                    <select name="age">
                        <option value="">Chọn tuổi</option>
                        @for ($age = 10; $age <= 80; $age++)
                            <option value="{{ $age }}">{{ $age }}</option>
                        @endfor
                    </select>
                </div>
            </div>

            <div class="zung81-title">Tình trạng của bạn trong thời gian gần đây</div>

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
                                <input type="radio" name="rd{{ $number }}" value="{{ $point }}">
                                <span>{{ $point }}</span>
                            </label>
                        @endfor
                    </div>
                </div>
            @endforeach

            <div class="zung81-warning">
                Câu 19 đề cập đến suy nghĩ về cái chết. Nếu bạn đang có ý định tự làm hại bản thân,
                cảm thấy không an toàn hoặc có nguy cơ thực hiện hành động đó, hãy tìm người đáng tin cậy
                ở bên và đến cơ sở y tế hoặc cấp cứu ngay. Không chờ kết quả bài đánh giá.
            </div>

            <div class="zung81-actions">
                <button type="button" class="zung81-button zung81-submit">Nộp kết quả</button>
            </div>
        </form>
    </div>

    <div class="zung81-result">
        <div class="zung81-title">Kết quả đánh giá theo thang điểm Zung</div>
        <div class="zung81-result-content">
            <div class="zung81-total"></div>
            <div class="zung81-conclusion"></div>
            <div class="zung81-note">
                Kết quả chỉ mang tính tham khảo, không thay thế chẩn đoán của bác sĩ.
                Nếu bạn có biểu hiện buồn chán kéo dài hoặc ảnh hưởng đến sinh hoạt,
                hãy trao đổi với bác sĩ hoặc chuyên gia sức khỏe tâm thần.
            </div>
        </div>
    </div>

    <script>
        jQuery(function ($) {
            $('.zung81-calculator').each(function () {
                var $calculator = $(this);
                var $form = $calculator.find('.zung81-form');

                // Các câu diễn đạt tích cực cần đảo điểm.
                var reverseQuestions = [2, 6, 11, 12, 14, 16, 17, 18, 20];

                $calculator.find('.zung81-submit').on('click', function () {
                    var sex = $form.find('input[name="sex"]:checked').val();
                    var age = $form.find('select[name="age"]').val();

                    if (sex !== 'male' && sex !== 'female') {
                        alert('Bạn chưa chọn giới tính!');
                        return;
                    }

                    if (!age) {
                        alert('Vui lòng chọn tuổi của bạn!');
                        return;
                    }

                    var total = 0;
                    var unanswered = [];

                    for (var i = 1; i <= 20; i++) {
                        var answer = $form.find('input[name="rd' + i + '"]:checked').val();

                        if (typeof answer === 'undefined') {
                            unanswered.push(i);
                            continue;
                        }

                        var point = parseInt(answer, 10);

                        if ($.inArray(i, reverseQuestions) !== -1) {
                            point = 5 - point;
                        }

                        total += point;
                    }

                    if (unanswered.length > 0) {
                        alert('Bạn còn ' + unanswered.length + ' câu chưa trả lời. Vui lòng hoàn thành đủ 20 câu hỏi!');
                        return;
                    }

                    var conclusion = '';

                    if (total <= 40) {
                        conclusion = 'Không trầm cảm theo ngưỡng phân loại của công cụ này';
                    } else if (total >= 41 && total <= 50) {
                        conclusion = 'Trầm cảm mức độ nhẹ';
                    } else if (total >= 51 && total <= 60) {
                        conclusion = 'Trầm cảm ở mức độ vừa';
                    } else if (total >= 61 && total <= 70) {
                        conclusion = 'Trầm cảm mức độ nặng';
                    } else if (total >= 71 && total <= 80) {
                        conclusion = 'Trầm cảm mức độ rất nặng';
                    }

                    $calculator.find('.zung81-total').text('Tổng điểm: ' + total + ' / 80');
                    $calculator.find('.zung81-conclusion').text(conclusion);
                    $calculator.find('.zung81-result').stop(true, true).slideDown();

                    $('html, body').animate({
                        scrollTop: $calculator.find('.zung81-result').offset().top - 100
                    }, 400);
                });
            });
        });
    </script>
</div>
