<style>
#ktv-calculator-20 .calculator-table-form table{width:100%;background:#ebf3f4;border:1px solid #eee;border-bottom:2px solid #187681;border-collapse:collapse;box-shadow:0 0 20px rgba(0,0,0,.1),0 10px 20px rgba(0,0,0,.05);}
#ktv-calculator-20 .calculator-table-form td{border:1px solid #fff;padding:10px;color:#000;}
#ktv-calculator-20 .calculator-table-form tr.table-head{background:#187681;color:#fff;text-align:left;}
#ktv-calculator-20 .calculator-table-form tr.table-head td{color:#fff;font-weight:bold;}
#ktv-calculator-20 input[type=number]{width:100%;max-width:250px;min-height:36px;padding:5px 8px;background:#fff;border:1px solid #ccc;outline:none;box-sizing:border-box;}
#ktv-calculator-20 input[type=number]:focus{border-color:#187681;}
#ktv-calculator-20 .flat-btn{cursor:pointer;margin:5px;background:#187681;border:0;border-radius:3px;color:#fff!important;font-size:14px;padding:10px 20px;text-decoration:none!important;}
#ktv-calculator-20 .flat-btn:hover{opacity:.9;color:#fff!important;}
#ktv-calculator-20 .required{color:#c00;}
#ktv-calculator-20 .red{color:red;font-weight:bold;}
#ktv-calculator-20 .calc-result{padding-top:10px;display:none;}
#ktv-calculator-20 .note{font-style:italic;font-size:12px;padding:10px;}
#ktv-calculator-20 .calc-result tr:last-child td{text-align:left;}
</style>
<div id="ktv-calculator-20">
    <div class="calculator-table-form blue">
        <form class="ktv-form">
            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr class="table-head">
                        <td colspan="2">Nhập chi tiết</td>
                    </tr>
                    <tr>
                        <td>Nồng độ urê máu trước khi lọc</td>
                        <td>
                            <input type="number" name="a" min="0.01" step="any" placeholder="Nhập số" required> mg/dL
                        </td>
                    </tr>
                    <tr>
                        <td>Nồng độ urê máu sau khi lọc (đo sau 2–5 phút lọc máu)</td>
                        <td>
                            <input type="number" name="b" min="0.01" step="any" placeholder="Nhập số" required> mg/dL
                        </td>
                    </tr>
                    <tr>
                        <td>Thời gian lọc máu</td>
                        <td>
                            <input type="number" name="c" min="0.01" step="any" placeholder="Nhập số" required> Giờ
                        </td>
                    </tr>
                    <tr>
                        <td>Thể tích lọc</td>
                        <td>
                            <input type="number" name="d" min="0.01" step="any" placeholder="Nhập số" required> Lít
                        </td>
                    </tr>
                    <tr>
                        <td>Trọng lượng cơ thể sau khi lọc</td>
                        <td>
                            <input type="number" name="e" min="0.01" step="any" placeholder="Nhập số" required> kg
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <span class="required">* Bắt buộc</span>
                            <input type="submit" class="flat-btn" value="Tính toán">
                            <input type="reset" class="flat-btn" value="Nhập lại">
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
                        Kt/V cho các giá trị đã nhập là
                        <span class="red"><b class="ketqua1">0</b></span>.
                    </td>
                </tr>
                <tr>
                    <td>
                        Giảm urê (URR) của bạn là
                        <span class="red"><b class="ketqua2">0%</b></span>
                    </td>
                </tr>
                <tr>
                    <td class="ketqua3"></td>
                </tr>
                <tr>
                    <td>
                        <div class="note">
                            Lưu ý: Máy tính này chỉ đo độ thanh thải urê qua thẩm tách máu.
                            Giá trị Kt/V cần đạt có thể khác nhau tùy từng đối tượng.
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
(function($) {
    $(document).ready(function() {
        var calculator = $('#ktv-calculator-20');
        function formatNumber(value) {
            return value.toLocaleString('en-US', {
                minimumFractionDigits: 0,
                maximumFractionDigits: 2
            });
        }
        calculator.find('.ktv-form').on('submit', function(event) {
            event.preventDefault();
            var a = parseFloat(calculator.find('[name="a"]').val());
            var b = parseFloat(calculator.find('[name="b"]').val());
            var c = parseFloat(calculator.find('[name="c"]').val());
            var d = parseFloat(calculator.find('[name="d"]').val());
            var e = parseFloat(calculator.find('[name="e"]').val());
            if (
                !isFinite(a) || !isFinite(b) ||
                !isFinite(c) || !isFinite(d) ||
                !isFinite(e) ||
                a <= 0 || b <= 0 || c <= 0 ||
                d <= 0 || e <= 0 || b > a
            ) {
                alert('Vui lòng nhập các giá trị hợp lệ. Urê sau lọc không được lớn hơn urê trước lọc.');
                return false;
            }
            var ratio = b / a;
            var urr = (1 - ratio) * 100;
            // Công thức Kt/V theo code gốc
            var ktv = -Math.log(ratio - (0.008 * c)) + (4 - 3.5 * ratio) * (d / e);
            if (!isFinite(ktv) || ratio - (0.008 * c) <= 0) {
                alert('Không thể tính Kt/V với các giá trị đã nhập. Vui lòng kiểm tra lại dữ liệu.');
                return false;
            }
            calculator.find('.ketqua1').text(formatNumber(ktv));
            calculator.find('.ketqua2').text(formatNumber(urr) + '%');
            if (urr < 65) {
                calculator.find('.ketqua3').text('Cuộc lọc máu không đạt hiệu quả theo ngưỡng URR 65% trong công cụ này. Bạn nên hỏi ý kiến bác sĩ chuyên khoa thận.');
            } else {
                calculator.find('.ketqua3').text('Cuộc lọc máu đạt ngưỡng URR 65% trong công cụ này. Nếu còn nghi ngờ, hãy hỏi ý kiến bác sĩ chuyên khoa thận.');
            }
            calculator.find('.calc-result').show();
            return false;
        });
        calculator.find('.ktv-form').on('reset', function() {
            calculator.find('.calc-result').hide();
            calculator.find('.ketqua1, .ketqua2, .ketqua3').text('');
        });
    });
})(jQuery);
</script>