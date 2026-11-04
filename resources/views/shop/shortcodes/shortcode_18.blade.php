<style>
    .na-calculator {
        width: 100%;
        margin: 15px 0;
        font-size: 14px;
    }
    .na-calculator .red {
        color: red;
        font-weight: bold;
    }
    .na-calculator table {
        width: 100%;
        background: #ebf3f4;
        border: 1px solid #eee;
        border-bottom: 2px solid #187681;
        box-shadow: 0 0 20px rgba(0,0,0,.1),
                    0 10px 20px rgba(0,0,0,.05);
        border-collapse: collapse;
    }
    .na-calculator td {
        border: 1px solid #fff;
        padding: 10px;
        color: #000;
    }
    .na-calculator tr.table-head {
        background: #187681;
        color: #fff;
        text-align: left;
    }
    .na-calculator tr.table-head td {
        color: #fff;
        font-weight: bold;
    }
    .na-calculator input[type="number"] {
        width: 100%;
        max-width: 220px;
        min-height: 36px;
        padding: 5px 8px;
        background: #fff;
        border: 1px solid #ccc;
        outline: none;
        box-sizing: border-box;
    }
    .na-calculator input[type="number"]:focus {
        border-color: #187681;
    }
    .na-calculator .flat-btn {
        cursor: pointer;
        margin: 5px;
        background: #187681;
        border: 0;
        border-radius: 3px;
        color: #fff !important;
        font-size: 14px;
        padding: 10px 20px;
        text-decoration: none !important;
    }
    .na-calculator .flat-btn:hover {
        opacity: .9;
        color: #fff !important;
    }
    .na-calculator .mandatory-star,
    .na-calculator .required {
        color: #c00;
    }
    .na-calculator .na-result {
        margin-top: 15px;
        padding-top: 10px;
    }
    .na-calculator .na-result table {
        background: #fff;
        border: 2px solid #187681;
    }
    .na-calculator .na-result td {
        padding: 12px;
    }
    .na-calculator .na-note {
        font-size: 12px;
        font-style: italic;
        margin-top: 10px;
    }
</style>
<div class="na-calculator" id="na-calculator-18">
    <form class="na-form">
        <table cellpadding="5" cellspacing="1">
            <tbody>
                <tr class="table-head">
                    <td colspan="2">Nhập chi tiết của bạn</td>
                </tr>
                <tr>
                    <td>
                        Natri (Na)
                        <span class="mandatory-star">*</span>
                    </td>
                    <td>
                        <input
                            type="number"
                            name="na"
                            min="1"
                            max="500"
                            step="any"
                            placeholder="Nhập Natri"
                            required
                        >
                        mg/dl
                    </td>
                </tr>
                <tr>
                    <td>
                        Glucose
                        <span class="mandatory-star">*</span>
                    </td>
                    <td>
                        <input
                            type="number"
                            name="gluc"
                            min="1"
                            max="2000"
                            step="any"
                            placeholder="Nhập Glucose"
                            required
                        >
                        mg/dl
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center;">
                        <span class="required">*</span>
                        <span class="required">Bắt buộc</span>
                        <button type="submit" class="flat-btn">
                            Tính toán
                        </button>
                        <button type="reset" class="flat-btn">
                            Reset
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <div class="na-result" style="display:none;">
        <div class="calculator-table-form">
            <table cellpadding="0" cellspacing="0">
                <tbody>
                    <tr class="table-head">
                        <td>Kết quả</td>
                    </tr>
                    <tr>
                        <td>
                            Đối với mức Natri và Glucose đã cho,
                            Natri đã hiệu chỉnh là
                            <span class="red na-result-value">0</span>
                            mg/dl.
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
<script>
(function ($) {
    $(document).ready(function () {
        var calculator = $('#na-calculator-18');
        calculator.find('.na-form').on('submit', function (event) {
            event.preventDefault();
            var na = parseFloat(calculator.find('[name="na"]').val());
            var gluc = parseFloat(calculator.find('[name="gluc"]').val());
            if (
                !isFinite(na) ||
                !isFinite(gluc) ||
                na <= 0 ||
                gluc <= 0
            ) {
                alert('Vui lòng nhập Natri và Glucose hợp lệ.');
                return false;
            }
            // Công thức Natri hiệu chỉnh theo code gốc
            var ketqua = na + 1.6 * (gluc - 100) / 100;
            calculator.find('.na-result-value').text(
                ketqua.toFixed(2)
            );
            calculator.find('.na-result').show();
            return false;
        });
        calculator.find('.na-form').on('reset', function () {
            calculator.find('.na-result').hide();
            calculator.find('.na-result-value').text('0');
        });
    });
})(jQuery);
</script>