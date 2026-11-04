
<style>
    .pulse-calculator {
        margin: 15px 0;
        width: 100%;
    }
    .pulse-calculator table {
        border-collapse: collapse;
        width: 100%;
        background: #ebf3f4;
        border-bottom: 2px solid #187681;
        box-shadow: 0 0 10px rgba(0,0,0,.08);
    }
    .pulse-calculator table td,
    .pulse-calculator table th {
        border: 1px solid #ddd;
        padding: 10px;
    }
    .pulse-calculator .table-head {
        background: #187681;
        color: #fff;
        font-weight: bold;
    }
    .pulse-calculator select {
        min-height: 36px;
        padding: 5px 10px;
        border: 1px solid #ccc;
        background: #fff;
        width: 100%;
        max-width: 300px;
    }
    .pulse-calculator .flat-btn {
        cursor: pointer;
        background: #187681;
        border: 0;
        border-radius: 3px;
        color: #fff;
        padding: 10px 20px;
        margin: 5px;
    }
    .pulse-calculator .flat-btn:hover {
        background: #125c65;
        color: #fff;
    }
    .pulse-calculator .mandatory-star,
    .pulse-calculator .required {
        color: #c00;
    }
    .pulse-calculator .pulse-result {
        display: none;
        margin-top: 20px;
    }
    .pulse-calculator .pulse-result-value {
        color: #f00;
        font-weight: bold;
    }
    .pulse-calculator .calcnote {
        font-size: 13px;
        font-style: italic;
        padding: 10px;
    }
</style>
<div class="pulse-calculator">
    <form class="pulse-form">
        <table>
            <tbody>
                <tr class="table-head">
                    <td colspan="2">Chọn chi tiết của bạn</td>
                </tr>
                <tr>
                    <td>
                        Tuổi <span class="mandatory-star">*</span>
                    </td>
                    <td>
                        <select name="slt_age" required>
                            <option value="0">0-1 tháng tuổi</option>
                            <option value="1">1-11 tháng tuổi</option>
                            <option value="2">1-2 tuổi</option>
                            <option value="3">3-4 tuổi</option>
                            <option value="4">5-6 tuổi</option>
                            <option value="5">7-9 tuổi</option>
                            <option value="6">Trên 10 tuổi</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="text-align:center">
                        <span class="required">* Yêu cầu</span>
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
    <div class="pulse-result">
        <table>
            <tbody>
                <tr class="table-head">
                    <td colspan="2">Kết quả</td>
                </tr>
                <tr>
                    <td>Nhịp tim bình thường</td>
                    <td>
                        <span class="pulse-result-value"></span>
                        nhịp mỗi phút
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <div class="calcnote">
                            Lưu ý: Nên hỏi ý kiến bác sĩ để được tư vấn
                            trong trường hợp có nghi ngờ hoặc cần điều trị.
                        </div>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<script>
(function ($) {
    $(document).ready(function () {
        $('.pulse-calculator').each(function () {
            var calculator = $(this);
            calculator.find('.pulse-form').on('submit', function (event) {
                event.preventDefault();
                var age = calculator.find('[name="slt_age"]').val();
                var results = {
                    0: '70-190',
                    1: '80-160',
                    2: '80-130',
                    3: '80-120',
                    4: '75-115',
                    5: '70-100',
                    6: '60-100'
                };
                calculator.find('.pulse-result-value').text(results[age]);
                calculator.find('.pulse-result').show();
            });
            calculator.find('.pulse-form').on('reset', function () {
                calculator.find('.pulse-result').hide();
            });

        });
    });
})(jQuery);
</script>
