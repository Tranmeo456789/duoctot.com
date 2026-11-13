
<style>
#bmr-calculator-23 .calculator-table-form table{width:100%;background:#ebf3f4;border:1px solid #eee;border-bottom:2px solid #187681;border-collapse:collapse;box-shadow:0 0 20px rgba(0,0,0,.1),0 10px 20px rgba(0,0,0,.05);}
#bmr-calculator-23 .calculator-table-form td{border:1px solid #fff;padding:10px;color:#000;}
#bmr-calculator-23 .calculator-table-form tr.table-head{background:#187681;color:#fff;text-align:left;}
#bmr-calculator-23 .calculator-table-form tr.table-head td{color:#fff;font-weight:bold;}
#bmr-calculator-23 input[type=number]{width:100%;max-width:250px;min-height:36px;padding:5px 8px;background:#fff;border:1px solid #ccc;outline:none;box-sizing:border-box;}
#bmr-calculator-23 input[type=number]:focus{border-color:#187681;}
#bmr-calculator-23 input[type=radio]{margin-right:5px;}
#bmr-calculator-23 .flat-btn{cursor:pointer;margin:5px;background:#187681;border:0;border-radius:3px;color:#fff!important;font-size:14px;padding:10px 20px;text-decoration:none!important;}
#bmr-calculator-23 .flat-btn:hover{opacity:.9;color:#fff!important;}
#bmr-calculator-23 .required,#bmr-calculator-23 .mandatory-star{color:#c00;}
#bmr-calculator-23 .red{color:red;font-weight:bold;}
#bmr-calculator-23 .calc-result{padding-top:10px;display:none;}
</style>
<div id="bmr-calculator-23">
    <div class="calculator-table-form blue">
        <form class="bmr-form">
            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr class="table-head">
                        <td colspan="2">Nhập chi tiết của bạn</td>
                    </tr>
                    <tr>
                        <td>Giới tính <span class="mandatory-star">*</span></td>
                        <td>
                            <label>
                                <input type="radio" name="opt_mw" value="m" checked>
                                Đàn ông
                            </label>
                            &nbsp;
                            <label>
                                <input type="radio" name="opt_mw" value="w">
                                Phụ nữ
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>Tuổi <span class="mandatory-star">*</span></td>
                        <td>
                            <input type="number" name="age" min="18" max="99" placeholder="18 - 99" required>
                        </td>
                    </tr>
                    <tr>
                        <td>Chiều cao <span class="mandatory-star">*</span></td>
                        <td>
                            <input type="number" name="height" min="1" max="300" step="any" placeholder="170" required>
                            cm
                        </td>
                    </tr>
                    <tr>
                        <td>Trọng lượng <span class="mandatory-star">*</span></td>
                        <td>
                            <input type="number" name="pounds" min="1" max="500" step="any" placeholder="70" required>
                            kg
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span class="required">* Yêu cầu</span>
                            <input type="submit" value="Tính toán" class="flat-btn">
                            <input type="reset" value="Nhập lại" class="flat-btn">
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>
    </div>
    <div class="calculator-table-form blue calc-result">
        <table cellpadding="0" cellspacing="0">
            <tbody>
                <tr class="table-head">
                    <td>Kết quả</td>
                </tr>
                <tr>
                    <td>
                        Với độ tuổi, chiều cao và cân nặng của bạn,
                        tỷ lệ trao đổi chất khi nghỉ ngơi hoặc tỷ lệ
                        trao đổi chất cơ bản (BMR) của bạn là
                        <span class="red ketqua1">0</span> calo/ngày.
                        <br><br>
                        Con số này là cơ sở tham khảo cho việc ăn uống
                        và tiêu thụ calo. Bạn có thể lập kế hoạch duy trì
                        cân nặng hiện tại, giảm cân hoặc tăng cân dựa
                        trên số liệu này.
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
(function($) {
    $(document).ready(function() {
        var calculator = $('#bmr-calculator-23');
        function formatNumber(value) {
            return value.toLocaleString('en-US', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 2
            });
        }
        calculator.find('.bmr-form').on('submit', function(event) {
            event.preventDefault();
            var age = parseInt(calculator.find('[name="age"]').val(), 10);
            var height = parseFloat(calculator.find('[name="height"]').val());
            var weight = parseFloat(calculator.find('[name="pounds"]').val());
            var gender = calculator.find('[name="opt_mw"]:checked').val();
            if (
                !isFinite(age) ||
                !isFinite(height) ||
                !isFinite(weight) ||
                age < 18 || age > 99 ||
                height <= 0 || weight <= 0
            ) {
                alert('Vui lòng nhập tuổi, chiều cao và cân nặng hợp lệ.');
                return false;
            }
            var ketqua;
            if (gender === 'm') {
                // Công thức Mifflin-St Jeor dành cho nam
                ketqua = (10 * weight) + (6.25 * height) - (5 * age) + 5;
            } else {
                // Công thức Mifflin-St Jeor dành cho nữ
                ketqua = (10 * weight) + (6.25 * height) - (5 * age) - 161;
            }
            calculator.find('.ketqua1').text(formatNumber(ketqua));
            calculator.find('.calc-result').show();
            return false;
        });
        calculator.find('.bmr-form').on('reset', function() {
            calculator.find('.calc-result').hide();
            calculator.find('.ketqua1').text('0');
        });
    });
})(jQuery);
</script>