
<div class="shortcode-84">
    <style>
        .shortcode-84 .calculator-table-form {
            margin: 0 auto 20px;
            color: #000;
            width: 90%;
            line-height: 130%;
        }

        .shortcode-84 .calculator-table-form table {
            width: 100%;
            color: #000;
            border-collapse: collapse;
        }

        .shortcode-84 .calculator-table-form td {
            border-bottom: 1px solid #fff;
            padding: 10px 5px;
            vertical-align: top;
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
            font-weight: bold;
            background: #0F5885;
        }

        .shortcode-84 .calculator-table-form input[type="radio"] {
            margin-right: 5px;
        }

        .shortcode-84 .calculator-table-form .flat-btn {
            border: 0;
            background: #0F5885;
            color: #fff !important;
            font-size: 13px;
            font-weight: 600;
            padding: 8px 15px;
            display: inline-block;
            cursor: pointer;
        }

        .shortcode-84 .calculator-table-form .flat-btn:hover {
            background: #0779A3;
        }

        .shortcode-84 .required {
            color: #B30000;
            text-align: left;
            padding-top: 15px;
        }

        .shortcode-84 .result-text {
            margin: 0 5px;
            padding: 15px 5px;
        }

        .shortcode-84 .result-box {
            padding-top: 20px;
            display: none;
        }

        .shortcode-84 select {
            max-width: 100%;
            min-width: 100px;
        }

        @media (max-width: 767px) {
            .shortcode-84 .calculator-table-form {
                width: 100%;
                overflow-x: auto;
            }

            .shortcode-84 .question-table {
                min-width: 600px;
            }

            .shortcode-84 .question-table td {
                padding: 8px 4px;
            }
        }
    </style>

    <div class="content">
        <div class="calculator-table-form blue" id="ess_gendercolor_84">
            <form class="ess-form-84" method="post">
                <table cellpadding="5" width="100%">
                    <tbody>
                        <tr class="table-head">
                            <td colspan="2">Thang đo độ buồn ngủ</td>
                        </tr>

                        <tr>
                            <td width="50%"><strong>Giới tính</strong></td>
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
                            <td width="50%"><strong>Chọn tuổi của bạn</strong></td>
                            <td>
                                <select name="age_84" class="age-84">
                                    <option value="-1">Chọn</option>
                                    @for($i = 10; $i <= 80; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table cellpadding="5" cellspacing="0" class="question-table">
                    <tbody>
                        <tr>
                            <td width="40%" align="center"><strong>Tình trạng</strong></td>
                            <td width="15%" align="center"><strong>Không có cơ hội ngủ gật</strong></td>
                            <td width="15%" align="center"><strong>Cơ hội ngủ gật nhẹ</strong></td>
                            <td width="15%" align="center"><strong>Cơ hội ngủ gật vừa</strong></td>
                            <td width="15%" align="center"><strong>Cơ hội ngủ gật cao</strong></td>
                        </tr>

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

                        @foreach($questions84 as $index => $question)
                            <tr>
                                <td height="50">
                                    {{ $index + 1 }}. {{ $question }}
                                    <span style="color:red;">*</span>
                                </td>

                                @for($score = 0; $score <= 3; $score++)
                                    <td align="center">
                                        <input
                                            type="radio"
                                            name="rd{{ $index + 1 }}_84"
                                            value="{{ $score }}"
                                        >
                                    </td>
                                @endfor
                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="5" align="center">
                                <input
                                    type="button"
                                    value="Nộp"
                                    class="flat-btn ess-submit-84"
                                >
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="required">* Tất cả các câu hỏi là bắt buộc</div>
            </form>
        </div>

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
                                <strong class="ess-total-84"></strong>
                                <br><br>
                                <strong class="ess-content-84"></strong>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        jQuery(function($) {
            $('.shortcode-84').each(function() {
                var $wrapper = $(this);

                $wrapper.find('.ess-submit-84').on('click', function() {
                    var sex = $wrapper.find('input[name="sex_84"]:checked').val();
                    var age = $wrapper.find('.age-84').val();

                    if (sex !== 'male' && sex !== 'female') {
                        alert('Bạn chưa chọn giới tính');
                        return false;
                    }

                    if (age === '-1') {
                        alert('Vui lòng chọn tuổi của bạn!');
                        return false;
                    }

                    var total = 0;

                    for (var i = 1; i <= 8; i++) {
                        var answer = $wrapper.find(
                            'input[name="rd' + i + '_84"]:checked'
                        ).val();

                        if (typeof answer === 'undefined') {
                            alert('Bạn chưa trả lời đầy đủ 8 câu hỏi!');
                            return false;
                        }

                        total += parseInt(answer, 10);
                    }

                    var content = '';

                    if (total >= 0 && total <= 10) {
                        content = 'Mức độ buồn ngủ bình thường ở người lớn khỏe mạnh.';
                    } else if (total >= 11 && total <= 14) {
                        content = 'Mức độ buồn ngủ nhẹ. Điểm 11 trở lên thể hiện tình trạng buồn ngủ quá mức vào ban ngày, có thể là dấu hiệu của rối loạn giấc ngủ hoặc tình trạng bệnh lý. Nếu bạn đạt 11 điểm trở lên, bác sĩ có thể giới thiệu bạn đến gặp chuyên gia về giấc ngủ.';
                    } else if (total >= 15 && total <= 17) {
                        content = 'Buồn ngủ vừa phải. Điểm 11 trở lên thể hiện tình trạng buồn ngủ quá mức vào ban ngày, có thể là dấu hiệu của rối loạn giấc ngủ hoặc tình trạng bệnh lý. Nếu bạn đạt 11 điểm trở lên, bác sĩ có thể giới thiệu bạn đến gặp chuyên gia về giấc ngủ.';
                    } else if (total >= 18 && total <= 24) {
                        content = 'Buồn ngủ nghiêm trọng. Điểm 11 trở lên thể hiện tình trạng buồn ngủ quá mức vào ban ngày, có thể là dấu hiệu của rối loạn giấc ngủ hoặc tình trạng bệnh lý. Nếu bạn đạt 11 điểm trở lên, bác sĩ có thể giới thiệu bạn đến gặp chuyên gia về giấc ngủ.';
                    }

                    $wrapper.find('.ess-total-84').text('Tổng điểm: ' + total);
                    $wrapper.find('.ess-content-84').text(content);
                    $wrapper.find('.ess-result-84').show();

                    $('html, body').animate({
                        scrollTop: $wrapper.find('.ess-result-84').offset().top - 100
                    }, 400);
                });
            });
        });
    </script>
</div>
