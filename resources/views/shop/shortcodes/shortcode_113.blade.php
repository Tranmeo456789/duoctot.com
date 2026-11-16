
<div class="sc113-wrapper">
    <style>
        .sc113-wrapper {
            width: 100%;
            max-width: 850px;
            margin: 20px auto;
            color: #333;
            font-size: 15px;
            line-height: 1.6;
        }

        .sc113-wrapper *,
        .sc113-wrapper *:before,
        .sc113-wrapper *:after {
            box-sizing: border-box;
        }

        .sc113-wrapper .sc113-card {
            background: #fff;
            border: 1px solid #e1e8ef;
            border-radius: 10px;
            overflow: hidden;
            margin-bottom: 18px;
            box-shadow: 0 2px 8px rgba(0,0,0,.04);
        }

        .sc113-wrapper .sc113-heading {
            padding: 14px 18px;
            background: #1677b8;
            color: #fff;
            font-size: 17px;
            font-weight: 600;
        }

        .sc113-wrapper .sc113-body {
            padding: 20px;
        }

        .sc113-wrapper .sc113-label {
            display: block;
            margin-bottom: 9px;
            font-weight: 600;
        }

        .sc113-wrapper .sc113-select {
            display: block;
            width: 100%;
            height: 46px;
            padding: 8px 12px;
            border: 1px solid #ccd5df;
            border-radius: 6px;
            background: #fff;
            color: #333;
            font-size: 15px;
            outline: none;
        }

        .sc113-wrapper .sc113-select:focus {
            border-color: #1677b8;
            box-shadow: 0 0 0 2px rgba(22,119,184,.12);
        }

        .sc113-wrapper .sc113-required {
            color: #dc3545;
        }

        .sc113-wrapper .sc113-button {
            display: inline-block;
            margin-top: 16px;
            padding: 11px 25px;
            border: 0;
            border-radius: 6px;
            background: #1677b8;
            color: #fff;
            font-size: 15px;
            font-weight: 600;
            cursor: pointer;
            transition: background .2s;
        }

        .sc113-wrapper .sc113-button:hover {
            background: #105f94;
        }

        .sc113-wrapper .sc113-button:disabled {
            opacity: .6;
            cursor: not-allowed;
        }

        .sc113-wrapper .sc113-result {
            display: none;
        }

        .sc113-wrapper .sc113-result-row {
            display: flex;
            border-bottom: 1px solid #edf0f3;
            padding: 12px 0;
        }

        .sc113-wrapper .sc113-result-row:last-child {
            border-bottom: 0;
        }

        .sc113-wrapper .sc113-result-label {
            width: 40%;
            padding-right: 15px;
            font-weight: 600;
        }

        .sc113-wrapper .sc113-result-value {
            flex: 1;
            min-width: 0;
        }

        .sc113-wrapper .sc113-vitamin {
            display: inline-block;
            margin: 2px 4px 2px 0;
            padding: 4px 10px;
            border-radius: 20px;
            background: #e8f4fc;
            color: #12649a;
            font-weight: 600;
        }

        .sc113-wrapper .sc113-note {
            margin-top: 15px;
            padding: 12px 14px;
            border-left: 4px solid #e5a000;
            border-radius: 4px;
            background: #fff8e6;
            color: #72530b;
            font-size: 13px;
        }

        .sc113-wrapper .sc113-error {
            display: none;
            margin-top: 12px;
            padding: 10px 12px;
            border: 1px solid #f1caca;
            border-radius: 6px;
            background: #fff0f0;
            color: #a00000;
        }

        .sc113-wrapper .sc113-empty {
            padding: 12px;
            border-radius: 6px;
            background: #fff4e5;
            color: #875600;
        }

        @media (max-width: 600px) {
            .sc113-wrapper .sc113-body {
                padding: 15px;
            }

            .sc113-wrapper .sc113-heading {
                font-size: 16px;
            }

            .sc113-wrapper .sc113-result-row {
                display: block;
            }

            .sc113-wrapper .sc113-result-label {
                width: 100%;
                padding: 0 0 5px;
            }

            .sc113-wrapper .sc113-button {
                width: 100%;
            }
        }
    </style>

    <div class="sc113-card">
        <div class="sc113-heading">
            Tra cứu tình trạng sức khỏe và vitamin
        </div>

        <div class="sc113-body">
            <p>
                Chọn tình trạng sức khỏe bên dưới để xem thông tin về
                các vitamin có thể liên quan đến tình trạng đó.
            </p>

            <label class="sc113-label">
                Bệnh tật / Tình trạng sức khỏe
                <span class="sc113-required">*</span>
            </label>

            <select class="sc113-select sc113-disease">
                <option value="">-- Chọn tình trạng sức khỏe --</option>
                <option value="Thiếu máu hồng cầu to">Thiếu máu hồng cầu to</option>
                <option value="Thiếu máu hồng cầu nhỏ">Thiếu máu hồng cầu nhỏ</option>
                <option value="Thiếu máu ác tính">Thiếu máu ác tính</option>
                <option value="BeriBeri">BeriBeri</option>
                <option value="Chảy máu răng lợi">Chảy máu răng lợi</option>
                <option value="Suy tim">Suy tim</option>
                <option value="Táo bón">Táo bón</option>
                <option value="Co giật">Co giật</option>
                <option value="Trầm cảm">Trầm cảm</option>
                <option value="Tóc khô">Tóc khô</option>
                <option value="Khô mắt">Khô mắt</option>
                <option value="Phù nề">Phù nề</option>
                <option value="Viêm lưỡi">Viêm lưỡi</option>
                <option value="Thiếu máu tan máu">Thiếu máu tan máu</option>
                <option value="Tăng huyết áp">Tăng huyết áp</option>
                <option value="Mất ngủ">Mất ngủ</option>
                <option value="Cáu gắt">Cáu gắt</option>
                <option value="Vấn đề về thận">Vấn đề về thận</option>
                <option value="Yếu cơ">Yếu cơ</option>
                <option value="Buồn nôn">Buồn nôn</option>
                <option value="Viêm dây thần kinh">Viêm dây thần kinh</option>
                <option value="Suy giảm thần kinh">Suy giảm thần kinh</option>
                <option value="Quáng gà">Quáng gà</option>
                <option value="Chảy máu cam">Chảy máu cam</option>
                <option value="Loãng xương">Loãng xương</option>
                <option value="Pellagra">Pellagra</option>
                <option value="Chứng sợ ám ảnh">Chứng sợ ám ảnh</option>
                <option value="Tăng trưởng kém">Tăng trưởng kém</option>
                <option value="Thời gian chảy máu kéo dài">Thời gian chảy máu kéo dài</option>
                <option value="Thoái hóa võng mạc">Thoái hóa võng mạc</option>
                <option value="Viêm khớp dạng thấp">Viêm khớp dạng thấp</option>
                <option value="Bệnh còi xương">Bệnh còi xương</option>
                <option value="Viêm da tiết bã">Viêm da tiết bã</option>
                <option value="Tăng trưởng xương kém">Tăng trưởng xương kém</option>
            </select>

            <button type="button" class="sc113-button sc113-submit">
                Kiểm tra
            </button>

            <div class="sc113-error" role="alert" aria-live="polite"></div>
        </div>
    </div>

    <div class="sc113-card sc113-result" aria-live="polite">
        <div class="sc113-heading">Kết quả tra cứu</div>

        <div class="sc113-body">
            <div class="sc113-result-row">
                <div class="sc113-result-label">
                    Bệnh tật / Tình trạng sức khỏe
                </div>
                <div class="sc113-result-value sc113-result-name"></div>
            </div>

            <div class="sc113-result-row">
                <div class="sc113-result-label">
                    Vitamin được đề cập
                </div>
                <div class="sc113-result-value sc113-result-vitamin"></div>
            </div>

            <div class="sc113-result-row">
                <div class="sc113-result-label">
                    Thông tin tham khảo
                </div>
                <div class="sc113-result-value sc113-result-content"></div>
            </div>

            <div class="sc113-note">
                <strong>Lưu ý y khoa:</strong>
                Đây là thông tin tham khảo về mối liên hệ dinh dưỡng,
                không có nghĩa là thiếu vitamin chắc chắn gây ra tình trạng
                được chọn. Nhiều bệnh lý có nguyên nhân khác nhau và cần
                được thăm khám, xét nghiệm để xác định. Không tự ý dùng
                vitamin liều cao hoặc thay thế thuốc điều trị.
            </div>
        </div>
    </div>

    <script>
    (function() {
        'use strict';

        function initSC113(wrapper) {
            if (!wrapper || wrapper.getAttribute('data-initialized') === '1') {
                return;
            }

            wrapper.setAttribute('data-initialized', '1');

            var select = wrapper.querySelector('.sc113-disease');
            var button = wrapper.querySelector('.sc113-submit');
            var result = wrapper.querySelector('.sc113-result');
            var error = wrapper.querySelector('.sc113-error');

            var resultName = wrapper.querySelector('.sc113-result-name');
            var resultVitamin = wrapper.querySelector('.sc113-result-vitamin');
            var resultContent = wrapper.querySelector('.sc113-result-content');

            var vitaminData = {
                'Thiếu máu hồng cầu to': ['Vitamin B9', 'Vitamin B12'],
                'Thiếu máu hồng cầu nhỏ': ['Vitamin B6'],
                'Thiếu máu ác tính': ['Vitamin B12'],
                'BeriBeri': ['Vitamin B1'],
                'Chảy máu răng lợi': ['Vitamin C'],
                'Suy tim': ['Vitamin B1'],
                'Táo bón': ['Vitamin B12'],
                'Co giật': ['Vitamin B6'],
                'Trầm cảm': ['Vitamin D'],
                'Tóc khô': ['Vitamin C'],
                'Khô mắt': ['Vitamin A'],
                'Phù nề': ['Vitamin B1'],
                'Viêm lưỡi': ['Vitamin B2'],
                'Thiếu máu tan máu': ['Vitamin E'],
                'Tăng huyết áp': ['Vitamin D'],
                'Mất ngủ': ['Vitamin B7'],
                'Cáu gắt': ['Vitamin B6'],
                'Vấn đề về thận': ['Vitamin E'],
                'Yếu cơ': ['Vitamin E'],
                'Buồn nôn': ['Vitamin B7'],
                'Viêm dây thần kinh': ['Vitamin B1'],
                'Suy giảm thần kinh': ['Vitamin B12'],
                'Quáng gà': ['Vitamin A'],
                'Chảy máu cam': ['Vitamin C'],
                'Loãng xương': ['Vitamin D'],
                'Pellagra': ['Vitamin B3'],
                'Chứng sợ ám ảnh': ['Vitamin B2'],
                'Tăng trưởng kém': ['Vitamin B2', 'Vitamin B9'],
                'Thời gian chảy máu kéo dài': ['Vitamin K'],
                'Thoái hóa võng mạc': ['Vitamin E'],
                'Viêm khớp dạng thấp': ['Vitamin D'],
                'Bệnh còi xương': ['Vitamin D'],
                'Viêm da tiết bã': ['Vitamin C'],
                'Tăng trưởng xương kém': ['Vitamin A']
            };

            function showError(message) {
                error.textContent = message;
                error.style.display = 'block';
                result.style.display = 'none';
            }

            function clearError() {
                error.textContent = '';
                error.style.display = 'none';
            }

            function clearResult() {
                clearError();
                result.style.display = 'none';
            }

            function renderResult() {
                clearError();

                var disease = select.value;

                if (!disease) {
                    showError('Vui lòng chọn bệnh tật hoặc tình trạng sức khỏe.');
                    select.focus();
                    return;
                }

                var vitamins = vitaminData[disease];

                if (!vitamins || !vitamins.length) {
                    showError('Không tìm thấy dữ liệu cho tình trạng đã chọn.');
                    return;
                }

                resultName.textContent = disease;

                // Tạo danh sách vitamin an toàn, không đưa dữ liệu vào HTML trực tiếp.
                resultVitamin.textContent = '';

                for (var i = 0; i < vitamins.length; i++) {
                    var tag = document.createElement('span');
                    tag.className = 'sc113-vitamin';
                    tag.textContent = vitamins[i];
                    resultVitamin.appendChild(tag);
                }

                var content = 'Danh mục tham khảo ban đầu có đề cập đến ' +
                    vitamins.join(' và ') +
                    ' trong mối liên hệ với tình trạng này. Tuy nhiên, ' +
                    'chỉ dựa vào triệu chứng hoặc tên bệnh không thể kết luận ' +
                    'cơ thể đang thiếu các vitamin trên.';

                resultContent.textContent = content;

                result.style.display = 'block';

                // Cuộn đến kết quả.
                setTimeout(function() {
                    var position = result.getBoundingClientRect().top +
                        window.pageYOffset - 100;

                    if (typeof window.scrollTo === 'function') {
                        try {
                            window.scrollTo({
                                top: position,
                                behavior: 'smooth'
                            });
                        } catch (e) {
                            window.scrollTo(0, position);
                        }
                    }
                }, 100);
            }

            button.addEventListener('click', function(event) {
                event.preventDefault();
                renderResult();
            });

            select.addEventListener('change', function() {
                clearResult();
            });

            // Hỗ trợ người dùng nhấn Enter khi đang chọn tình trạng.
            select.addEventListener('keydown', function(event) {
                if (event.key === 'Enter' || event.keyCode === 13) {
                    event.preventDefault();
                    renderResult();
                }
            });
        }

        function startSC113() {
            var wrappers = document.querySelectorAll('.sc113-wrapper');

            for (var i = 0; i < wrappers.length; i++) {
                initSC113(wrappers[i]);
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', startSC113);
        } else {
            startSC113();
        }
    })();
    </script>
</div>
