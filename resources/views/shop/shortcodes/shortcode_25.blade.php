<div id="watson-calculator-25">
    <style>
        #watson-calculator-25 .calculator-table-form { max-width: 100%; margin: 0 auto; }
        #watson-calculator-25 table { width: 100%; border-collapse: collapse; }
        #watson-calculator-25 td { padding: 10px; border: 1px solid #ddd; }
        #watson-calculator-25 .table-head { background: #1677b8; color: #fff; font-weight: bold; }
        #watson-calculator-25 input[type="text"] { max-width: 150px; width: 100%; padding: 7px; border: 1px solid #ccc; border-radius: 3px; }
        #watson-calculator-25 input[type="radio"] { margin-right: 5px; }
        #watson-calculator-25 .mandatory-star, #watson-calculator-25 .required { color: red; }
        #watson-calculator-25 .flat-btn { padding: 9px 20px; border: 0; background: #1677b8; color: #fff; cursor: pointer; border-radius: 3px; }
        #watson-calculator-25 .flat-btn:hover { background: #105d91; }
        #watson-calculator-25 .report-content { padding-top: 10px; display: none; }
        #watson-calculator-25 .red { color: #d00; font-weight: bold; }
    </style>
    <div class="calculator-table-form blue">
        <form class="watson-form-25">
            <table cellpadding="0" cellspacing="0" class="tv12black">
                <tbody>
                    <tr class="table-head">
                        <td colspan="2">Nhập chi tiết của bạn</td>
                    </tr>
                    <tr>
                        <td>Giới tính <span class="mandatory-star">*</span></td>
                        <td>
                            <label><input type="radio" name="opt_mw" value="m" checked> Đàn ông</label>
                            <label><input type="radio" name="opt_mw" value="w"> Phụ nữ</label>
                        </td>
                    </tr>
                    <tr>
                        <td>Tuổi <span class="mandatory-star">*</span></td>
                        <td>
                            <input type="text" name="age" maxlength="2" placeholder="18-99" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Chiều cao <span class="mandatory-star">*</span></td>
                        <td>
                            <input type="text" name="height" maxlength="3" placeholder="170" required> cm
                        </td>
                    </tr>
                    <tr>
                        <td>Trọng lượng <span class="mandatory-star">*</span></td>
                        <td>
                            <input type="text" name="weight" maxlength="3" placeholder="70" required> kg
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span class="required">* Yêu cầu</span>
                            <button type="submit" class="flat-btn">Tính toán</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <div class="report-content">
        <div class="calculator-table-form blue">
            <table cellpadding="0" cellspacing="0" class="tv12black">
                <tbody>
                    <tr class="table-head">
                        <td>Kết quả</td>
                    </tr>
                    <tr>
                        <td>
                            Theo công thức Watson, tổng lượng nước trong cơ thể của bạn là:
                            <span class="red watson-result"></span> lít
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            var calculator = $('#watson-calculator-25');
            calculator.find('.watson-form-25').on('submit', function (event) {
                event.preventDefault();
                var age = parseInt(calculator.find('[name="age"]').val(), 10);
                var height = parseFloat(calculator.find('[name="height"]').val());
                var weight = parseFloat(calculator.find('[name="weight"]').val());
                var gender = calculator.find('[name="opt_mw"]:checked').val();
                if (isNaN(age) || isNaN(height) || isNaN(weight) ||
                    age < 18 || age > 99 ||
                    height <= 0 || height > 250 ||
                    weight <= 0 || weight > 500) {
                    alert('Vui lòng nhập thông tin hợp lệ. Tuổi từ 18 đến 99, chiều cao và cân nặng phải lớn hơn 0.');
                    return;
                }
                var result;
                if (gender === 'm') {
                    result = 2.447 - (0.09156 * age) + (0.1074 * height) + (0.3362 * weight);
                } else {
                    result = -2.097 + (0.1069 * height) + (0.2466 * weight);
                }
                calculator.find('.watson-result').text(result.toFixed(2));
                calculator.find('.report-content').show();
            });
        });
    </script>
</div>