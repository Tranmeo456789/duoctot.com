
<style>
    .whtr-calculator,
    .whtr-result {
        width: 90%;
        margin: 0 auto 20px;
        color: #000;
        line-height: 130%;
    }
    .whtr-calculator table,
    .whtr-result table {
        width: 100%;
        color: #000;
        background: #E6F4FE;
        border: 1px solid #0F5885;
    }
    .whtr-calculator td,
    .whtr-result td {
        border-bottom: 1px solid #fff;
        padding: 10px 5px;
        vertical-align: top;
        text-align: left;
    }
    .whtr-calculator tr:last-child td,
    .whtr-result tr:last-child td {
        border-bottom: none;
    }
    .whtr-calculator td:first-child {
        background: #CFEAFC;
    }
    .whtr-calculator .table-head td,
    .whtr-result .table-head td {
        background: #0F5885;
        color: #fff;
        font-weight: bold;
        font-size: 14px;
    }
    .whtr-calculator input[type="radio"] {
        margin-right: 5px;
    }
    .whtr-calculator .flat-btn {
        border: 0;
        background: #0F5885;
        color: #fff !important;
        font-size: 13px;
        font-weight: 600;
        padding: 8px 15px;
        display: inline-block;
        cursor: pointer;
        margin-left: 5px;
    }
    .whtr-calculator .flat-btn:hover {
        background: #0779A3;
    }
    .whtr-calculator .required {
        color: #B30000;
        padding-top: 15px;
        display: inline-block;
    }
    .whtr-calculator .form-control {
        font-size: 16px;
    }
    @media (max-width: 480px) {
        .whtr-calculator,
        .whtr-result {
            width: 100%;
        }
    }
</style>
<div class="whtr-calculator" id="whtr-calculator-14">
    <form class="whtr-form" method="post">
        <table cellpadding="5" cellspacing="0" width="100%">
            <tbody>
                <tr class="table-head">
                    <td colspan="2">Nhập chi tiết</td>
                </tr>
                <tr>
                    <td>Giới tính <span style="color:red">*</span></td>
                    <td>
                        <label>
                            <input type="radio" name="sex" value="Male" checked>
                            Nam giới
                        </label>
                        &nbsp;
                        <label>
                            <input type="radio" name="sex" value="Female">
                            Nữ giới
                        </label>
                    </td>
                </tr>
                <tr>
                    <td>Chiều cao <span style="color:red">*</span></td>
                    <td>
                        <input type="number" name="height" min="1" max="300"
                               style="width:100px" placeholder="170" required>
                        &nbsp;cm
                    </td>
                </tr>
                <tr>
                    <td>Kích thước vòng eo <span style="color:red">*</span></td>
                    <td>
                        <input type="number" name="txtWaist" min="1" max="300"
                               style="width:100px" placeholder="80" required>
                        &nbsp;cm
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <span class="required">* Yêu cầu</span>
                        <button class="flat-btn" type="submit">Tính toán</button>
                        <button class="flat-btn" type="reset">Reset</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<div class="whtr-result" id="whtr-result-14" style="display:none; padding-top:20px;">
    <table cellpadding="5" cellspacing="1">
        <tbody>
            <tr class="table-head">
                <td colspan="2">Kết quả</td>
            </tr>
            <tr>
                <td colspan="2">
                    Tỷ lệ vòng eo trên chiều cao của bạn là
                    <font color="red">
                        <b><span class="ketqua"></span>%</b>
                    </font>.
                    Tỷ lệ này chỉ ra rằng bạn đang ở
                    <b><span class="ketqua-text"></span></b>.
                    <p class="ketqua-text1"></p>
                    <p class="ketqua-text2"></p>
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script>
jQuery(document).ready(function ($) {
    var calculator = $('#whtr-calculator-14');
    var result = $('#whtr-result-14');
    var underweightText = 'Trọng lượng cơ thể của bạn thấp khi so sánh với các khuyến nghị tiêu chuẩn. Thiếu cân khiến bạn dễ bị nhiễm trùng, các vấn đề tiêu hóa và hiếm khi bị ung thư. Nguyên nhân nhẹ cân có thể do thiếu chất dinh dưỡng, không tiêu thụ đủ calo hoặc do rối loạn ăn uống. Tham khảo ý kiến bác sĩ hoặc chuyên gia dinh dưỡng để tăng cân bình thường.';
    var healthyText = 'Tiếp tục ăn uống lành mạnh và tập thể dục 150 phút mỗi tuần để giữ cân nặng của bạn trong phạm vi khuyến nghị.';
    var overweightText = 'Bạn có thể có nhiều mỡ trong cơ thể hơn do lối sống ít vận động. Thừa cân là một yếu tố nguy cơ của bệnh tim, tiểu đường và tăng huyết áp. Chúng tôi khuyên bạn nên tăng cường hoạt động và tập thể dục ít nhất 150 phút mỗi tuần để giảm cân và lấy lại vóc dáng.';
    var obeseText = 'Béo phì làm giảm tuổi thọ của bạn và khiến bạn dễ mắc các bệnh khác nhau, đặc biệt là bệnh tim, tiểu đường, ngưng thở khi ngủ, viêm xương khớp, liệt dương và một số loại ung thư. Ngay cả một chế độ tập thể dục ngắn cũng có thể giúp bạn tăng tốc độ trao đổi chất hằng ngày và giúp bạn tăng lượng calo tiêu thụ và giảm cân. Tham khảo ý kiến của chuyên gia dinh dưỡng, chuyên gia thể dục và bác sĩ của bạn để cải thiện lối sống và tối ưu hóa cân nặng của bạn.';
    calculator.find('.whtr-form').on('submit', function (event) {
        event.preventDefault();
        var height = parseFloat(calculator.find('[name="height"]').val());
        var waist = parseFloat(calculator.find('[name="txtWaist"]').val());
        var sex = calculator.find('[name="sex"]:checked').val();
        if (!height || !waist || height <= 0 || waist <= 0) {
            alert('Vui lòng nhập chiều cao và vòng eo hợp lệ.');
            return;
        }
        var whtr = waist / height;
        var whtrPercent = (whtr * 100).toFixed(2).replace(/\.00$/, '');
        var category = '';
        var description = '';
        if (whtr <= 0.34) {
            category = 'Cực kì mảnh mai';
            description = underweightText;
        } else if (sex === 'Male') {
            if (whtr <= 0.42) {
                category = 'Mảnh mai';
                description = underweightText;
            } else if (whtr <= 0.52) {
                category = 'Khỏe mạnh';
                description = healthyText;
            } else if (whtr <= 0.62) {
                category = 'Thừa cân';
                description = overweightText;
            } else {
                category = 'Bệnh béo phì';
                description = obeseText;
            }
        } else {
            if (whtr <= 0.41) {
                category = 'Mảnh mai';
                description = underweightText;
            } else if (whtr <= 0.48) {
                category = 'Khỏe mạnh';
                description = healthyText;
            } else if (whtr <= 0.57) {
                category = 'Thừa cân';
                description = overweightText;
            } else {
                category = 'Bệnh béo phì';
                description = obeseText;
            }
        }
        var riskText = '';
        if (whtr > 0.5) {
            riskText = 'WHtR > 0.5: Cho thấy nguy cơ mắc bệnh tiểu đường, bệnh tim mạch, đột quỵ cao hơn và tuổi thọ thấp hơn.';
        } else {
            riskText = 'WHtR < 0.5: Được coi là lành mạnh đối với cả nam và nữ trên toàn thế giới.';
        }
        result.find('.ketqua').text(whtrPercent);
        result.find('.ketqua-text').text(category);
        result.find('.ketqua-text1').text(description);
        result.find('.ketqua-text2').text(riskText);

        result.show();
    });
    calculator.find('.whtr-form').on('reset', function () {
        result.hide();
    });
});
</script>