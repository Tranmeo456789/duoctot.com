<div class="calculator-table-form blue bsa-calculator" id="bsa-calculator-17">
    <form class="bsa-form" style="display:inline;">
        <table cellpadding="0" cellspacing="0" width="100%">
            <tbody>
                <tr class="table-head">
                    <td colspan="2">Chọn chi tiết của bạn</td>
                </tr>
                <tr>
                    <td align="center">Cân nặng (kg)</td>
                    <td>
                        <input type="number"
                               name="cannang"
                               placeholder="Cân nặng"
                               min="1"
                               max="500"
                               step="0.1"
                               required>
                    </td>
                </tr>
                <tr>
                    <td align="center">Chiều cao (cm)</td>
                    <td>
                        <input type="number"
                               name="chieucao"
                               placeholder="Chiều cao"
                               min="1"
                               max="300"
                               step="0.1"
                               required>
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span class="required">* Yêu cầu</span>
                        <button class="flat-btn" type="submit">
                            Tính toán
                        </button>
                        <button class="flat-btn" type="reset">
                            Nhập lại
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<div class="calculator-table-form blue bsa-result"
     id="bsa-result-17"
     style="padding-top:20px; display:none;">
    <table cellpadding="5" cellspacing="0" width="100%">
        <tbody>
            <tr class="table-head">
                <td colspan="2">Kết quả</td>
            </tr>
            <tr>
                <td colspan="2" align="center">
                    Với chiều cao và cân nặng đã cho, diện tích bề mặt cơ thể của bạn là
                    <strong class="tv12red tbold">
                        <span class="bsa-value"></span> m<sup>2</sup>
                    </strong>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script>
jQuery(document).ready(function ($) {
    var calculator = $('#bsa-calculator-17');
    var result = $('#bsa-result-17');
    calculator.find('.bsa-form').on('submit', function (event) {
        event.preventDefault();
        var weight = parseFloat(calculator.find('[name="cannang"]').val());
        var height = parseFloat(calculator.find('[name="chieucao"]').val());

        if (
            isNaN(weight) ||
            isNaN(height) ||
            weight <= 0 ||
            height <= 0
        ) {
            alert('Vui lòng nhập cân nặng và chiều cao hợp lệ.');
            return;
        }
        // Công thức Mosteller tính diện tích bề mặt cơ thể
        var bsa = Math.sqrt((weight * height) / 3600);
        result.find('.bsa-value').text(
            bsa.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',')
        );
        result.show();
    });
    calculator.find('.bsa-form').on('reset', function () {
        result.hide();
        result.find('.bsa-value').text('');
    });
});
</script>