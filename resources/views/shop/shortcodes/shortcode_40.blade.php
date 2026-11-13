<div id="whr-calculator-40">
    <style>
        #whr-calculator-40 table { border-collapse: collapse; width: 100%; }
        #whr-calculator-40 table td, #whr-calculator-40 table th { border: 1px solid #ddd; padding: 8px; }
        #whr-calculator-40 table tr td:first-child { width: 1px; text-align: right; white-space: nowrap; }
        #whr-calculator-40 table th { background-color: #187681; color: #fff; }
        #whr-calculator-40 table td { background-color: #ebf3f4; }
        #whr-calculator-40 input[type="radio"] { margin-left: 20px; margin-right: 5px; }
        #whr-calculator-40 input[type="number"] { max-width: 100px; margin-right: 15px; }
        #whr-calculator-40 .mandatory-star { color: #ff0000; }
        #whr-calculator-40 .result-container { display: none; margin-top: 12px; }
        #whr-calculator-40 .text-success { color: #198754; font-weight: bold; }
        #whr-calculator-40 .text-warning { color: #d69e00; font-weight: bold; }
        #whr-calculator-40 .text-danger { color: #dc3545; font-weight: bold; }
    </style>
    <div class="wpt_test fill_form">
        <div class="content">
            <div class="calculator-table-form blue">
                <form class="whr-form-40">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="2">Nhập các chỉ số</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><label>Giới tính <span class="mandatory-star">*</span></label></td>
                                <td>
                                    <input type="radio" id="whr-sex-male-40" value="0" name="sex" required>
                                    <label for="whr-sex-male-40">Nam</label>
                                    <input type="radio" id="whr-sex-female-40" value="1" name="sex">
                                    <label for="whr-sex-female-40">Nữ</label>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="whr-height-40">Chiều cao <span class="mandatory-star">*</span></label></td>
                                <td>
                                    <input type="number" max="250" min="120" id="whr-height-40" name="height" class="form-control form-control-sm" required> cm
                                </td>
                            </tr>
                            <tr>
                                <td><label for="whr-weight-40">Cân nặng <span class="mandatory-star">*</span></label></td>
                                <td>
                                    <input type="number" max="200" min="30" id="whr-weight-40" name="weight" class="form-control form-control-sm" required> kg
                                </td>
                            </tr>
                            <tr>
                                <td><label for="whr-waist-40">Vòng eo <span class="mandatory-star">*</span></label></td>
                                <td>
                                    <input type="number" max="200" min="30" id="whr-waist-40" name="waist" class="form-control form-control-sm" required> cm
                                </td>
                            </tr>
                            <tr>
                                <td><label for="whr-hips-40">Vòng hông <span class="mandatory-star">*</span></label></td>
                                <td>
                                    <input type="number" max="200" min="30" id="whr-hips-40" name="hips" class="form-control form-control-sm" required> cm
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary btn-sm">Tính toán (WHR)</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
                <i>* Công cụ tính này không dùng cho vận động viên thể hình vì có nhiều mô cơ, làm cho kết quả chẩn đoán nhầm là thừa cân, mặc dù họ có rất ít mỡ.</i>
            </div>
        </div>
    </div>
    <div class="result-container">
        <p><b>Tỷ số WHR: </b><span class="whr-value"></span></p>
        <p><b>Nguy cơ sức khỏe: </b><span class="whr-result"></span></p>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            var calculator = $('#whr-calculator-40');
            calculator.find('.whr-form-40').on('submit', function (event) {
                event.preventDefault();
                var gender = calculator.find('[name="sex"]:checked').val();
                var height = parseFloat(calculator.find('[name="height"]').val());
                var weight = parseFloat(calculator.find('[name="weight"]').val());
                var waist = parseFloat(calculator.find('[name="waist"]').val());
                var hips = parseFloat(calculator.find('[name="hips"]').val());
                if (gender === undefined || isNaN(height) || isNaN(weight) || isNaN(waist) || isNaN(hips) ||
                    height < 120 || height > 250 || weight < 30 || weight > 200 ||
                    waist < 30 || waist > 200 || hips < 30 || hips > 200) {
                    alert('Vui lòng nhập đầy đủ các chỉ số hợp lệ.');
                    return;
                }
                if (hips <= 0) {
                    alert('Vòng hông phải lớn hơn 0.');
                    return;
                }
                var whr = waist / hips;
                var result = '';
                if (gender === '0') {
                    if (whr < 0.96) {
                        result = '<span class="text-success">THẤP</span>';
                    } else if (whr <= 1) {
                        result = '<span class="text-warning">TRUNG BÌNH</span>';
                    } else {
                        result = '<span class="text-danger">CAO</span>';
                    }
                } else {
                    if (whr < 0.81) {
                        result = '<span class="text-success">THẤP</span>';
                    } else if (whr <= 0.85) {
                        result = '<span class="text-warning">TRUNG BÌNH</span>';
                    } else {
                        result = '<span class="text-danger">CAO</span>';
                    }
                }
                calculator.find('.whr-value').text(whr.toFixed(2));
                calculator.find('.whr-result').html(result);
                calculator.find('.result-container').show();
            });
        });
    </script>
</div>