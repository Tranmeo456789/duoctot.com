<style>
#creatinine-calculator-19 .calculator-table-form tr:last-child td{text-align:left;}
#creatinine-calculator-19 .calculator-table-form table{width:100%;background:#ebf3f4;border:1px solid #eee;border-bottom:2px solid #187681;border-collapse:collapse;box-shadow:0 0 20px rgba(0,0,0,.1),0 10px 20px rgba(0,0,0,.05);}
#creatinine-calculator-19 .calculator-table-form td{border:1px solid #fff;padding:10px;color:#000;}
#creatinine-calculator-19 .calculator-table-form tr.table-head{background:#187681;color:#fff;text-align:left;}
#creatinine-calculator-19 .calculator-table-form tr.table-head td{color:#fff;font-weight:bold;}
#creatinine-calculator-19 input[type=number]{width:100%;max-width:250px;min-height:36px;padding:5px 8px;background:#fff;border:1px solid #ccc;outline:none;box-sizing:border-box;}
#creatinine-calculator-19 input[type=number]:focus{border-color:#187681;}
#creatinine-calculator-19 .flat-btn{cursor:pointer;margin:5px;background:#187681;border:0;border-radius:3px;color:#fff!important;font-size:14px;padding:10px 20px;text-decoration:none!important;}
#creatinine-calculator-19 .flat-btn:hover{opacity:.9;color:#fff!important;}
#creatinine-calculator-19 .required{color:#c00;}
#creatinine-calculator-19 .calc-result{padding-top:20px;display:none;}
</style>
<div id="creatinine-calculator-19">
    <div class="calculator-table-form blue">
        <form class="creatinine-form" style="display:inline">
            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr class="table-head">
                        <td colspan="2">Nhập chi tiết của bạn</td>
                    </tr>
                    <tr>
                        <td align="center">Nồng độ Creatinin huyết tương (PCr)* (mg/dL)</td>
                        <td>
                            <input type="number" name="giatri1" placeholder="Nhập số" min="0.01" step="any" required>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">Nồng độ Creatinin nước tiểu (UCr)* (mg/dL)</td>
                        <td>
                            <input type="number" name="giatri2" placeholder="Nhập số" min="0.01" step="any" required>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">Thể tích nước tiểu toàn bộ* (mL)</td>
                        <td>
                            <input type="number" name="giatri3" placeholder="Nhập số" min="0.01" step="any" required>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">Thời gian thu mẫu nước tiểu* (phút)</td>
                        <td>
                            <input type="number" name="giatri4" placeholder="Nhập số" min="0.01" step="any" required>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">Chiều cao* (cm)</td>
                        <td>
                            <input type="number" name="giatri5" placeholder="Nhập chiều cao" min="0.01" step="any" required>
                        </td>
                    </tr>
                    <tr>
                        <td align="center">Cân nặng* (kg)</td>
                        <td>
                            <input type="number" name="giatri6" placeholder="Nhập cân nặng" min="0.01" step="any" required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span class="required">* Yêu cầu</span>
                            <input class="flat-btn" type="submit" value="Tính toán">
                            <input class="flat-btn" type="reset" value="Nhập lại">
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
                    <td colspan="2">Kết quả</td>
                </tr>
                <tr>
                    <td align="center">Hệ số thanh thải Creatinin</td>
                    <td class="ketqua1"></td>
                </tr>
                <tr>
                    <td align="center">Hệ số thanh thải Creatinin hiệu chỉnh</td>
                    <td class="ketqua2"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
(function($) {
    $(document).ready(function() {
        var calculator = $('#creatinine-calculator-19');
        function formatTienTe(data) {
            return data.toLocaleString('en-US', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 2
            });
        }
        calculator.find('.creatinine-form').on('submit', function(event) {
            event.preventDefault();
            var giatri1 = parseFloat(calculator.find('[name="giatri1"]').val());
            var giatri2 = parseFloat(calculator.find('[name="giatri2"]').val());
            var giatri3 = parseFloat(calculator.find('[name="giatri3"]').val());
            var giatri4 = parseFloat(calculator.find('[name="giatri4"]').val());
            var giatri5 = parseFloat(calculator.find('[name="giatri5"]').val());
            var giatri6 = parseFloat(calculator.find('[name="giatri6"]').val());
            if (
                !isFinite(giatri1) || !isFinite(giatri2) ||
                !isFinite(giatri3) || !isFinite(giatri4) ||
                !isFinite(giatri5) || !isFinite(giatri6) ||
                giatri1 <= 0 || giatri2 <= 0 ||
                giatri3 <= 0 || giatri4 <= 0 ||
                giatri5 <= 0 || giatri6 <= 0
            ) {
                alert('Vui lòng nhập đầy đủ các giá trị hợp lệ.');
                return false;
            }
            // Diện tích bề mặt cơ thể (BSA) theo công thức Mosteller
            var bsa = Math.sqrt((giatri5 * giatri6) / 3600);
            // Hệ số thanh thải Creatinin theo công thức gốc
            var ketqua1 = (giatri2 * giatri3) / (giatri1 * giatri4);
            // Hiệu chỉnh theo diện tích bề mặt cơ thể 1,73 m2
            var ketqua2 = ketqua1 * 1.73 / bsa;
            calculator.find('.ketqua1').text(formatTienTe(ketqua1) + ' mL/phút');
            calculator.find('.ketqua2').text(formatTienTe(ketqua2) + ' mL/phút/1,73 m²');
            calculator.find('.calc-result').show();
            return false;
        });
        calculator.find('.creatinine-form').on('reset', function() {
            calculator.find('.calc-result').hide();
            calculator.find('.ketqua1, .ketqua2').text('');
        });
    });
})(jQuery);
</script>
