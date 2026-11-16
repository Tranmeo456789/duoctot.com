
<div class="sc115-wrapper">
    <style>
        .sc115-wrapper {
            max-width: 900px;
            margin: 20px auto;
            color: #333;
            font-size: 14px;
            line-height: 1.6;
        }

        .sc115-wrapper * {
            box-sizing: border-box;
        }

        .sc115-wrapper .sc115-card {
            background: #fff;
            border: 1px solid #dce5ed;
            border-radius: 9px;
            overflow: hidden;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
        }

        .sc115-wrapper .sc115-heading {
            padding: 14px 18px;
            background: #1677b8;
            color: #fff;
            font-size: 17px;
            font-weight: 600;
        }

        .sc115-wrapper.sc115-female .sc115-heading {
            background: #d65d91;
        }

        .sc115-wrapper .sc115-body {
            padding: 18px;
        }

        .sc115-wrapper .sc115-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
        }

        .sc115-wrapper .sc115-table td,
        .sc115-wrapper .sc115-table th {
            padding: 11px 9px;
            border-bottom: 1px solid #e9edf1;
            vertical-align: middle;
            text-align: left;
        }

        .sc115-wrapper .sc115-table th {
            background: #edf5fb;
            color: #244b66;
            font-weight: 600;
            text-align: center;
        }

        .sc115-wrapper.sc115-female .sc115-table th {
            background: #fff0f6;
            color: #8f365c;
        }

        .sc115-wrapper .sc115-required {
            color: #dc3545;
        }

        .sc115-wrapper .sc115-select {
            width: 100%;
            height: 42px;
            padding: 7px 10px;
            border: 1px solid #ccd5df;
            border-radius: 5px;
            background: #fff;
            color: #333;
            font-size: 14px;
        }

        .sc115-wrapper .sc115-radio-group {
            display: flex;
            flex-wrap: wrap;
            gap: 10px 18px;
        }

        .sc115-wrapper .sc115-radio-group label {
            display: inline-flex;
            align-items: center;
            gap: 5px;
            cursor: pointer;
            font-weight: normal;
            margin: 0;
        }

        .sc115-wrapper input[type="radio"] {
            accent-color: #1677b8;
            width: 16px;
            height: 16px;
            margin: 0;
            cursor: pointer;
        }

        .sc115-wrapper.sc115-female input[type="radio"] {
            accent-color: #d65d91;
        }

        .sc115-wrapper .sc115-section-title {
            margin: 20px 0 12px;
            color: #1677b8;
            font-size: 15px;
            font-weight: 600;
        }

        .sc115-wrapper.sc115-female .sc115-section-title {
            color: #d65d91;
        }

        .sc115-wrapper .sc115-question-table {
            table-layout: fixed;
        }

        .sc115-wrapper .sc115-question-table th:first-child {
            width: 35px;
        }

        .sc115-wrapper .sc115-question-table th:nth-child(2) {
            width: 42%;
            text-align: left;
        }

        .sc115-wrapper .sc115-question-table td {
            text-align: center;
        }

        .sc115-wrapper .sc115-question-table td:nth-child(2) {
            text-align: left;
        }

        .sc115-wrapper .sc115-question-table td:first-child {
            color: #777;
        }

        .sc115-wrapper .sc115-question-table tr:hover td {
            background: #f8fbfd;
        }

        .sc115-wrapper .sc115-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
            margin-top: 20px;
        }

        .sc115-wrapper .sc115-btn {
            display: inline-block;
            border: 0;
            border-radius: 5px;
            padding: 11px 24px;
            font-size: 14px;
            font-weight: 600;
            cursor: pointer;
            transition: .2s;
        }

        .sc115-wrapper .sc115-btn-primary {
            background: #1677b8;
            color: #fff;
        }

        .sc115-wrapper.sc115-female .sc115-btn-primary {
            background: #d65d91;
        }

        .sc115-wrapper .sc115-btn-primary:hover {
            opacity: .88;
        }

        .sc115-wrapper .sc115-btn-reset {
            background: #edf0f3;
            color: #444;
        }

        .sc115-wrapper .sc115-result {
            display: none;
        }

        .sc115-wrapper .sc115-result-content {
            padding: 15px;
            border-radius: 7px;
            background: #f1f7fc;
            border-left: 4px solid #1677b8;
        }

        .sc115-wrapper.sc115-female .sc115-result-content {
            background: #fff3f7;
            border-left-color: #d65d91;
        }

        .sc115-wrapper .sc115-score {
            display: inline-block;
            margin-bottom: 12px;
            padding: 6px 14px;
            border-radius: 20px;
            background: #e1f1fb;
            color: #12649a;
            font-weight: 700;
        }

        .sc115-wrapper.sc115-female .sc115-score {
            background: #fce5ef;
            color: #a43b68;
        }

        .sc115-wrapper .sc115-note {
            margin-top: 15px;
            padding: 12px 14px;
            border-left: 4px solid #e2a329;
            background: #fff8e8;
            color: #70520d;
            border-radius: 4px;
            font-size: 13px;
        }

        .sc115-wrapper .sc115-error {
            display: none;
            margin-top: 12px;
            padding: 10px 12px;
            background: #fff0f0;
            border: 1px solid #f1cccc;
            border-radius: 5px;
            color: #b42318;
        }

        @media(max-width: 650px) {
            .sc115-wrapper .sc115-body {
                padding: 12px;
            }

            .sc115-wrapper .sc115-question-scroll {
                overflow-x: auto;
                -webkit-overflow-scrolling: touch;
            }

            .sc115-wrapper .sc115-question-table {
                table-layout: auto;
                min-width: 580px;
            }

            .sc115-wrapper .sc115-table td,
            .sc115-wrapper .sc115-table th {
                padding: 9px 6px;
                font-size: 12px;
            }

            .sc115-wrapper .sc115-btn {
                flex: 1;
            }
        }
    </style>

    <div class="sc115-card">
        <div class="sc115-heading">
            Bài kiểm tra sàng lọc biểu hiện tăng động giảm chú ý ở trẻ
        </div>

        <div class="sc115-body">
            <p>
                Công cụ dưới đây giúp phụ huynh tham khảo các biểu hiện
                hành vi thường gặp ở trẻ và ghi nhận mức độ xuất hiện
                của những biểu hiện đó.
            </p>

            <form class="sc115-form" autocomplete="off">
                <table class="sc115-table">
                    <tbody>
                        <tr>
                            <td colspan="2" style="font-weight:600;background:#f5f8fa;">
                                Nhập các thông tin sau
                            </td>
                        </tr>

                        <tr>
                            <td width="42%">
                                Chủng tộc của trẻ
                                <span class="sc115-required">*</span>
                            </td>
                            <td>
                                <select class="sc115-select sc115-ethnicity">
                                    <option value="">Chọn</option>
                                    <option value="Người Châu Á">Người Châu Á</option>
                                    <option value="Người châu Phi">Người châu Phi</option>
                                    <option value="Người da trắng">Người da trắng</option>
                                    <option value="Người Tây Ban Nha">Người Tây Ban Nha</option>
                                    <option value="Các nhóm dân cư khác">Các nhóm dân cư khác</option>
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Tuổi hiện tại
                                <span class="sc115-required">*</span>
                            </td>
                            <td>
                                <select class="sc115-select sc115-age">
                                    <option value="">Chọn tuổi</option>
                                    @for ($i = 6; $i <= 18; $i++)
                                        <option value="{{ $i }}">{{ $i }} tuổi</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                Giới tính của trẻ
                                <span class="sc115-required">*</span>
                            </td>
                            <td>
                                <div class="sc115-radio-group">
                                    <label>
                                        <input type="radio" name="sc115_sex" value="male">
                                        Nam
                                    </label>
                                    <label>
                                        <input type="radio" name="sc115_sex" value="female">
                                        Nữ
                                    </label>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>Mối quan hệ của bạn với trẻ</td>
                            <td>
                                <div class="sc115-radio-group">
                                    <label>
                                        <input type="radio" name="sc115_rel" value="Mother" checked>
                                        Mẹ
                                    </label>
                                    <label>
                                        <input type="radio" name="sc115_rel" value="Father">
                                        Bố
                                    </label>
                                    <label>
                                        <input type="radio" name="sc115_rel" value="Brother">
                                        Anh
                                    </label>
                                    <label>
                                        <input type="radio" name="sc115_rel" value="Sister">
                                        Chị
                                    </label>
                                    <label>
                                        <input type="radio" name="sc115_rel" value="Others">
                                        Khác
                                    </label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <div class="sc115-section-title">
                    Đánh giá các biểu hiện của trẻ
                </div>

                <p>
                    Với mỗi biểu hiện dưới đây, hãy chọn mức độ phù hợp
                    với hành vi của trẻ.
                </p>

                <div class="sc115-question-scroll">
                    <table class="sc115-table sc115-question-table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nhóm hành vi</th>
                                <th>Không bao giờ</th>
                                <th>Thỉnh thoảng</th>
                                <th>Khá thường xuyên</th>
                                <th>Rất thường xuyên</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php
                                $sc115Questions = array(
                                    'Không ngồi yên, cử động liên tục quá mức',
                                    'Dễ bị kích thích, bốc đồng',
                                    'Quấy rầy các trẻ khác',
                                    'Không thể hoàn thành được công việc (khả năng tập trung chú ý ngắn)',
                                    'Hay cựa quậy',
                                    'Lơ là, thiếu chú ý, hay lãng trí',
                                    'Thường phải ra lệnh ngay lập tức nếu không sẽ gây thất vọng',
                                    'Hay khóc',
                                    'Thay đổi tâm trạng rất nhanh',
                                    'Tính khí dễ bùng nổ, bột phát (hành vi không đoán trước được)'
                                );
                            @endphp

                            @foreach ($sc115Questions as $index => $question)
                                <tr>
                                    <td>{{ $index + 1 }}.</td>
                                    <td>{{ $question }}</td>

                                    @for ($score = 0; $score <= 3; $score++)
                                        <td>
                                            <input
                                                type="radio"
                                                name="sc115_q{{ $index + 1 }}"
                                                value="{{ $score }}"
                                                aria-label="{{ $question }} - điểm {{ $score }}"
                                            >
                                        </td>
                                    @endfor
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="sc115-error" role="alert"></div>

                <div class="sc115-actions">
                    <button type="submit" class="sc115-btn sc115-btn-primary">
                        Kiểm tra kết quả
                    </button>

                    <button type="reset" class="sc115-btn sc115-btn-reset">
                        Nhập lại
                    </button>
                </div>
            </form>
        </div>
    </div>

    <div class="sc115-card sc115-result">
        <div class="sc115-heading">Kết quả kiểm tra</div>

        <div class="sc115-body">
            <div class="sc115-score">
                Tổng điểm: <span class="sc115-total">0</span>/30
            </div>

            <div class="sc115-result-content"></div>

            <div class="sc115-note">
                <strong>Lưu ý:</strong>
                Đây chỉ là công cụ tham khảo và sàng lọc ban đầu,
                không phải công cụ chẩn đoán rối loạn tăng động giảm chú ý
                (ADHD). Kết quả không thể xác định trẻ có mắc ADHD hay
                đưa ra tỷ lệ xác suất mắc bệnh. Nếu trẻ có những biểu hiện
                kéo dài, ảnh hưởng đến việc học tập, sinh hoạt hoặc các
                mối quan hệ, phụ huynh nên đưa trẻ đến bác sĩ chuyên khoa
                nhi hoặc chuyên gia sức khỏe tâm thần trẻ em để được đánh giá.
            </div>
        </div>
    </div>

    <script>
    (function () {
        'use strict';

        function initSC115() {
            var wrappers = document.querySelectorAll('.sc115-wrapper');

            Array.prototype.forEach.call(wrappers, function (wrapper) {

                if (wrapper.getAttribute('data-sc115-init') === '1') {
                    return;
                }

                wrapper.setAttribute('data-sc115-init', '1');

                var form = wrapper.querySelector('.sc115-form');
                var result = wrapper.querySelector('.sc115-result');
                var error = wrapper.querySelector('.sc115-error');
                var totalElement = wrapper.querySelector('.sc115-total');
                var resultContent = wrapper.querySelector('.sc115-result-content');

                if (!form || !result || !error) {
                    return;
                }

                // Đổi màu giao diện theo giới tính.
                var sexInputs = form.querySelectorAll('input[name="sc115_sex"]');

                Array.prototype.forEach.call(sexInputs, function (input) {
                    input.addEventListener('change', function () {
                        wrapper.classList.remove('sc115-male', 'sc115-female');

                        if (this.value === 'female') {
                            wrapper.classList.add('sc115-female');
                        } else {
                            wrapper.classList.add('sc115-male');
                        }
                    });
                });

                // Hàm hiển thị lỗi.
                function showError(message, target) {
                    error.textContent = message;
                    error.style.display = 'block';

                    if (target) {
                        target.focus();
                    }
                }

                // Xử lý kiểm tra kết quả.
                form.addEventListener('submit', function (event) {
                    event.preventDefault();

                    error.style.display = 'none';
                    error.textContent = '';

                    var ethnicity = form.querySelector('.sc115-ethnicity').value;
                    var age = form.querySelector('.sc115-age').value;
                    var sex = form.querySelector('input[name="sc115_sex"]:checked');

                    if (!ethnicity) {
                        showError(
                            'Bạn chưa chọn chủng tộc của trẻ!',
                            form.querySelector('.sc115-ethnicity')
                        );
                        return;
                    }

                    if (!age) {
                        showError(
                            'Bạn chưa chọn tuổi của trẻ!',
                            form.querySelector('.sc115-age')
                        );
                        return;
                    }

                    if (!sex) {
                        showError('Bạn chưa chọn giới tính của trẻ!');
                        return;
                    }

                    var total = 0;
                    var unanswered = [];

                    for (var i = 1; i <= 10; i++) {
                        var answer = form.querySelector(
                            'input[name="sc115_q' + i + '"]:checked'
                        );

                        if (!answer) {
                            unanswered.push(i);
                        } else {
                            total += parseInt(answer.value, 10);
                        }
                    }

                    if (unanswered.length > 0) {
                        showError(
                            'Bạn vui lòng trả lời đầy đủ 10 câu hỏi. Chưa trả lời câu: ' +
                            unanswered.join(', ') + '.'
                        );
                        return;
                    }

                    var content = '';

                    if (total < 12) {
                        content =
                            '<strong>Kết quả tham khảo: Tổng điểm dưới 12.</strong>' +
                            '<p>Với cách tính điểm của công cụ này, trẻ chưa đạt ' +
                            'ngưỡng điểm tham khảo 12 điểm. Tuy nhiên, điều này ' +
                            'không loại trừ hoàn toàn khả năng trẻ có vấn đề về ' +
                            'chú ý hoặc hành vi.</p>' +
                            '<p>Nếu phụ huynh vẫn nhận thấy những biểu hiện bất ' +
                            'thường, nên tiếp tục quan sát trẻ trong các môi trường ' +
                            'khác nhau và tham khảo ý kiến chuyên gia.</p>';
                    } else {
                        content =
                            '<strong>Kết quả tham khảo: Tổng điểm từ 12 trở lên.</strong>' +
                            '<p>Trẻ đạt ngưỡng điểm tham khảo của bảng câu hỏi này. ' +
                            'Một số biểu hiện về tăng động, bốc đồng hoặc giảm chú ý ' +
                            'có thể cần được đánh giá kỹ hơn.</p>' +
                            '<p>Phụ huynh nên trao đổi với giáo viên và đưa trẻ đến ' +
                            'bác sĩ chuyên khoa để được đánh giá toàn diện trước khi ' +
                            'đưa ra bất kỳ kết luận nào.</p>';
                    }

                    totalElement.textContent = total;
                    resultContent.innerHTML = content;

                    // Hiển thị kết quả.
                    result.style.display = 'block';

                    // Cuộn đến kết quả.
                    setTimeout(function () {
                        var rect = result.getBoundingClientRect();
                        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

                        window.scrollTo({
                            top: scrollTop + rect.top - 100,
                            behavior: 'smooth'
                        });
                    }, 100);
                });

                // Xử lý nút nhập lại.
                form.addEventListener('reset', function () {
                    setTimeout(function () {
                        error.style.display = 'none';
                        error.textContent = '';

                        result.style.display = 'none';

                        totalElement.textContent = '0';
                        resultContent.innerHTML = '';

                        wrapper.classList.remove('sc115-male', 'sc115-female');
                    }, 0);
                });

            });
        }

        // Khởi tạo khi DOM đã sẵn sàng.
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initSC115);
        } else {
            initSC115();
        }

    })();
    </script>
</div>
