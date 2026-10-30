
<div class="bai-calculator" id="bai-{{ uniqid() }}">
    <style>
        .bai-calculator {
            margin: 20px 0;
            font-family: Arial, sans-serif;
        }
        .bai-calculator .calculator-table-form table {
            width: 100%;
            border-collapse: collapse;
            background: #ebf3f4;
            border: 1px solid #eee;
            border-bottom: 2px solid #187681;
            box-shadow: 0 0 20px rgba(0,0,0,.1);
        }
        .bai-calculator .calculator-table-form td {
            border: 1px solid #fff;
            padding: 10px;
            color: #000;
        }
        .bai-calculator .table-head {
            background: #187681;
            color: #fff !important;
            font-weight: bold;
        }
        .bai-calculator .table-head td {
            color: #fff;
        }
        .bai-calculator input[type="number"] {
            width: 150px;
            max-width: 100%;
            min-height: 32px;
            padding: 5px;
            background: #fff;
            border: 1px solid #ccc;
            border-radius: 0;
            box-sizing: border-box;
        }
        .bai-calculator .mandatory-star,
        .bai-calculator .required {
            color: #c00;
        }
        .bai-calculator .flat-btn {
            cursor: pointer;
            margin: 5px;
            padding: 10px 25px;
            background: #187681;
            border: 0;
            border-radius: 3px;
            color: #fff !important;
            font-size: 15px;
        }
        .bai-calculator .flat-btn:hover {
            background: #125b63;
            color: #fff;
        }
        .bai-calculator .bai-result {
            display: none;
            margin-top: 12px;
        }
        .bai-calculator .bai-result table {
            width: 100%;
            border: 2px solid #187681;
            background: #ebf3f4;
            border-collapse: collapse;
        }
        .bai-calculator .bai-result td {
            padding: 12px;
            border: 1px solid #fff;
            color: #000;
        }
        .bai-calculator .bai-result .bai-number {
            color: red;
            font-weight: bold;
            font-size: 18px;
        }
        .bai-calculator .bai-error {
            display: none;
            color: #c00;
            padding: 10px 0;
        }
        .bai-calculator .bai-note {
            font-size: 12px;
            font-style: italic;
            padding: 10px;
        }
        @media(max-width: 480px) {
            .bai-calculator .calculator-table-form td {
                padding: 8px;
            }
            .bai-calculator input[type="number"] {
                width: 110px;
            }
        }
    </style>
    <div class="calculator-table-form blue">
        <form class="bai-form">
            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr class="table-head">
                        <td colspan="2">Nhập chi tiết</td>
                    </tr>
                    <tr>
                        <td>
                            Chiều cao
                            <span class="mandatory-star">*</span>
                        </td>
                        <td>
                            <input
                                type="number"
                                name="height"
                                min="50"
                                max="250"
                                step="0.1"
                                placeholder="170"
                                required
                            > cm
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Chu vi hông
                            <span class="mandatory-star">*</span>
                        </td>
                        <td>
                            <input
                                type="number"
                                name="hip"
                                min="30"
                                max="250"
                                step="0.1"
                                placeholder="100"
                                required
                            > cm
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center">
                            <span class="required">* bắt buộc</span>
                            <button type="submit" class="flat-btn">
                                Tính toán
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="bai-error" role="alert"></div>
        </form>
    </div>
    <div class="bai-result">
        <div class="calculator-table-form blue">
            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr class="table-head">
                        <td>Kết quả</td>
                    </tr>
                    <tr>
                        <td>
                            Chỉ số mỡ cơ thể BAI ước tính của bạn là:
                            <span class="bai-number"></span>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <b>Giải thích:</b>
                            <span class="bai-description"></span>
                        </td>
                    </tr>
                    <tr>
                        <td class="bai-note">
                            BAI là chỉ số ước tính, không phải phép đo trực tiếp
                            lượng mỡ cơ thể và không thay thế đánh giá y tế.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
    (function () {
        var root = document.currentScript.parentNode;
        var form = root.querySelector('.bai-form');
        var resultBox = root.querySelector('.bai-result');
        var errorBox = root.querySelector('.bai-error');
        form.addEventListener('submit', function (event) {
            event.preventDefault();
            var height = parseFloat(form.elements.height.value);
            var hip = parseFloat(form.elements.hip.value);
            errorBox.style.display = 'none';
            errorBox.textContent = '';
            resultBox.style.display = 'none';
            if (
                !isFinite(height) ||
                !isFinite(hip) ||
                height < 50 ||
                height > 250 ||
                hip < 30 ||
                hip > 250
            ) {
                errorBox.textContent =
                    'Vui lòng nhập chiều cao và chu vi hông hợp lệ.';
                errorBox.style.display = 'block';
                return;
            }
            // Đổi chiều cao từ cm sang mét
            var heightMeter = height / 100;
            // Công thức BAI chuẩn
            var bai = hip / Math.pow(heightMeter, 1.5) - 18;
            root.querySelector('.bai-number').textContent =
                bai.toFixed(2) + '%';
            root.querySelector('.bai-description').textContent =
                'BAI được tính dựa trên chu vi hông và chiều cao của bạn. ' +
                'Kết quả cần được xem xét cùng các chỉ số sức khỏe khác.';
            resultBox.style.display = 'block';
        });
    })();
    </script>
</div>