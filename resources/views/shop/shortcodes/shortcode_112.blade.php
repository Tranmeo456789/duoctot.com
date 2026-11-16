
<div class="shortcode-112" id="mineral-calculator-112">
<style>
.shortcode-112 {
    width: 100%;
    color: #222;
    line-height: 1.5;
    font-size: 14px;
}

.shortcode-112 *,
.shortcode-112 *:before,
.shortcode-112 *:after {
    box-sizing: border-box;
}

.shortcode-112 .mineral-form,
.shortcode-112 .mineral-result {
    width: 100%;
    margin: 0 auto 20px;
    border: 1px solid #c5dfef;
    background: #e6f4fe;
    border-radius: 8px;
    overflow: hidden;
}

.shortcode-112 table {
    width: 100%;
    border-collapse: collapse;
    color: #222;
    margin: 0;
}

.shortcode-112 td {
    padding: 10px;
    border-bottom: 1px solid #fff;
    vertical-align: middle;
}

.shortcode-112 .table-head td {
    background: #0f5885;
    color: #fff;
    font-weight: 700;
}

.shortcode-112 .field-label {
    width: 40%;
    background: #cfeafc;
    font-weight: 600;
}

.shortcode-112 .required-star {
    color: #d00;
}

.shortcode-112 input[type=radio],
.shortcode-112 input[type=checkbox] {
    margin-right: 5px;
    cursor: pointer;
}

.shortcode-112 input[type=number] {
    max-width: 100%;
    min-height: 38px;
    padding: 6px 10px;
    border: 1px solid #bbb;
    border-radius: 4px;
    background: #fff;
}

.shortcode-112 .mineral-input {
    width: 120px;
}

.shortcode-112 .mineral-list {
    display: grid;
    grid-template-columns: repeat(3, minmax(0, 1fr));
    gap: 12px;
}

.shortcode-112 .mineral-option {
    display: flex;
    align-items: center;
    padding: 9px 7px;
    background: #fff;
    border: 1px solid #d7e8f5;
    border-radius: 5px;
    cursor: pointer;
    margin: 0;
    transition: .2s;
}

.shortcode-112 .mineral-option:hover {
    border-color: #0f5885;
    background: #f4fbff;
}

.shortcode-112 .mineral-option input {
    flex-shrink: 0;
}

.shortcode-112 .mineral-option.is-selected {
    border-color: #0f5885;
    background: #eaf6ff;
}

.shortcode-112 .flat-btn {
    display: inline-block;
    border: 0;
    border-radius: 4px;
    background: #0f5885;
    color: #fff;
    font-size: 14px;
    font-weight: 600;
    padding: 11px 25px;
    cursor: pointer;
    transition: .2s;
}

.shortcode-112 .flat-btn:hover {
    background: #0779a3;
}

.shortcode-112 .flat-btn:disabled {
    opacity: .6;
    cursor: not-allowed;
}

.shortcode-112 .result-item {
    margin: 12px;
    padding: 15px;
    background: #fff;
    border: 1px solid #d4e5f1;
    border-radius: 6px;
}

.shortcode-112 .result-item h4 {
    margin: 0 0 12px;
    color: #0f5885;
    font-size: 17px;
    line-height: 1.5;
}

.shortcode-112 .result-amount {
    color: #d00000;
    font-weight: 700;
}

.shortcode-112 .mineral-description {
    line-height: 1.7;
}

.shortcode-112 .mineral-description ul {
    margin: 5px 0 12px 20px;
    padding-left: 15px;
}

.shortcode-112 .mineral-description p {
    margin: 5px 0;
}

.shortcode-112 .result-note {
    margin: 12px;
    padding: 12px;
    background: #fff8e5;
    border-left: 4px solid #e0a000;
    border-radius: 4px;
    font-size: 13px;
}

.shortcode-112 .error-message {
    display: none;
    margin: 12px;
    padding: 10px;
    color: #a00000;
    background: #fff0f0;
    border: 1px solid #f1caca;
    border-radius: 4px;
}

.shortcode-112 .mineral-submit-area {
    text-align: center;
}

.shortcode-112 .mineral-hint {
    font-size: 12px;
    color: #555;
    margin-top: 7px;
}

.shortcode-112 .mineral-result {
    display: none;
}

@media(max-width:767px) {
    .shortcode-112 .field-label {
        width: 38%;
    }

    .shortcode-112 td {
        padding: 8px 6px;
    }

    .shortcode-112 .mineral-list {
        grid-template-columns: repeat(2, minmax(0, 1fr));
    }

    .shortcode-112 .mineral-input {
        width: 100px;
    }

    .shortcode-112 .result-item {
        margin: 8px;
        padding: 12px;
    }
}

@media(max-width:420px) {
    .shortcode-112 .mineral-list {
        grid-template-columns: 1fr 1fr;
        gap: 5px;
    }

    .shortcode-112 .result-item h4 {
        font-size: 15px;
    }

    .shortcode-112 .flat-btn {
        width: 100%;
    }
}
</style>

@php
$minerals112 = array(
    array('id'=>1,'name'=>'Canxi','description'=>'<p><strong>Chức năng của Canxi:</strong> Cần thiết để thực hiện một số chức năng trao đổi chất như:</p><ul><li>Truyền tín hiệu thần kinh.</li><li>Chức năng nội bào và bài tiết nội tiết tố.</li><li>Cung cấp cấu trúc và sức mạnh cho xương và răng.</li></ul><p><strong>Các triệu chứng suy giảm canxi:</strong></p><ul><li>Tê và ngứa ran ngón tay.</li><li>Chuột rút cơ bắp.</li><li>Co giật, hôn mê.</li><li>Kém ăn.</li><li>Nhịp tim bất thường.</li><li>Suy giảm canxi trong thời gian dài gây loãng xương.</li></ul><p><strong>Các triệu chứng hấp thụ quá mức:</strong></p><ul><li>Táo bón.</li><li>Suy thận.</li><li>Vôi hóa mạch máu và mô mềm.</li><li>Tăng canxi niệu.</li><li>Sỏi thận.</li></ul>'),

    array('id'=>2,'name'=>'Đồng','description'=>'<p><strong>Chức năng:</strong> Là khoáng chất vi lượng thiết yếu, giúp duy trì:</p><ul><li>Mạch máu.</li><li>Dây thần kinh.</li><li>Hệ thống miễn dịch.</li><li>Xương.</li></ul><p><strong>Các triệu chứng suy giảm:</strong></p><ul><li>Suy giảm đồng có thể gây thiếu máu và loãng xương.</li><li>Rối loạn chuyển hóa đồng có thể dẫn đến bệnh Menkes, đặc trưng bởi chậm phát triển và suy thoái hệ thần kinh.</li></ul><p><strong>Các triệu chứng hấp thụ quá mức:</strong></p><ul><li>Bệnh Wilson do đồng lắng đọng trong gan, não và các cơ quan khác.</li><li>Viêm gan.</li><li>Vấn đề về thận.</li><li>Rối loạn não.</li></ul>'),

    array('id'=>3,'name'=>'Flo-rua','description'=>'<p><strong>Chức năng:</strong></p><ul><li>Giúp duy trì sức khỏe cấu trúc xương.</li><li>Được sử dụng với liều lượng thấp hơn để điều trị chứng mất xương do mãn kinh.</li><li>Một lượng nhỏ Flo-rua có thể ngăn ngừa sâu răng.</li></ul><p><strong>Các triệu chứng suy giảm:</strong></p><ul><li>Sự thiếu hụt Flo-rua có thể làm suy yếu xương và răng, tăng nguy cơ sâu răng.</li></ul><p><strong>Các triệu chứng hấp thụ quá mức:</strong></p><ul><li>Quá nhiều Flo-rua trong chế độ ăn uống là rất hiếm.</li><li>Trẻ sơ sinh hấp thụ quá nhiều Flo-rua có thể bị thay đổi màu sắc răng.</li></ul>'),

    array('id'=>4,'name'=>'Sắt','description'=>'<p><strong>Vai trò của Sắt:</strong> Là khoáng chất quan trọng giúp hình thành Hemoglobin và myoglobin, các protein vận chuyển oxy trong cơ thể. Sắt cũng là thành phần của nhiều protein khác.</p><p><strong>Các triệu chứng thiếu sắt:</strong></p><ul><li>Thiếu năng lượng.</li><li>Khó thở.</li><li>Đau đầu.</li><li>Cáu gắt.</li><li>Chóng mặt.</li><li>Giảm cân.</li></ul><p><strong>Các triệu chứng hấp thụ quá mức:</strong></p><ul><li>Mệt mỏi, chán ăn.</li><li>Chóng mặt, buồn nôn, nôn mửa.</li><li>Đau đầu, sụt cân.</li><li>Khó thở, da xanh xao.</li><li>Quá nhiều sắt có thể do sử dụng thực phẩm bổ sung quá mức hoặc rối loạn di truyền.</li></ul>'),

    array('id'=>5,'name'=>'Magie','description'=>'<p><strong>Chức năng Magie:</strong> Là khoáng chất cần thiết giúp:</p><ul><li>Hình thành protein.</li><li>Sản xuất và vận chuyển năng lượng.</li><li>Duy trì hoạt động bình thường của một số enzym.</li><li>Co và thư giãn cơ.</li></ul><p><strong>Các triệu chứng suy giảm Magie:</strong></p><ul><li>Yếu cơ, hưng phấn và buồn ngủ.</li><li>Trường hợp nghiêm trọng có thể gây co cơ dai dẳng, mê sảng, tê, ảo giác và ngứa ran.</li></ul><p><strong>Các triệu chứng hấp thụ quá mức:</strong> Không phổ biến vì lượng Magie dư thừa thường được cơ thể loại bỏ.</p>'),

    array('id'=>6,'name'=>'Phốt pho','description'=>'<p><strong>Chức năng:</strong></p><ul><li>Phốt pho chiếm khoảng 1% tổng trọng lượng cơ thể. Khoảng 80% có trong xương và răng.</li><li>Cần thiết để hình thành protein, DNA, RNA và ATP.</li></ul><p><strong>Các triệu chứng suy giảm:</strong></p><ul><li>Ăn mất ngon.</li><li>Sự lo âu.</li><li>Các vấn đề về xương khớp.</li><li>Mệt mỏi, vấn đề hô hấp.</li><li>Khó chịu, tê liệt, yếu đuối.</li><li>Thay đổi trọng lượng bất thường.</li></ul><p><strong>Các triệu chứng hấp thụ quá mức:</strong></p><ul><li>Phốt pho trong máu tăng có thể kết hợp với canxi và lắng đọng ở mô mềm.</li><li>Có liên quan đến nguy cơ mắc bệnh tim.</li><li>Có thể gây tiêu chảy, vôi hóa cơ quan và mô mềm, cản trở hấp thu một số khoáng chất.</li></ul>'),

    array('id'=>7,'name'=>'Kali','description'=>'<p><strong>Chức năng của Kali:</strong></p><ul><li>Hình thành protein và cơ bắp.</li><li>Duy trì sự phát triển bình thường của cơ thể.</li><li>Kiểm soát hoạt động điện của tim.</li><li>Hỗ trợ các quá trình trao đổi chất.</li></ul><p><strong>Các triệu chứng suy giảm Kali:</strong></p><ul><li>Làm suy yếu cơ.</li><li>Tăng huyết áp.</li><li>Gây nhịp tim bất thường.</li></ul><p><strong>Các triệu chứng hấp thụ quá mức:</strong> Tăng kali máu có thể gây nhịp tim bất thường và nguy hiểm.</p>'),

    array('id'=>8,'name'=>'Selen','description'=>'<p><strong>Chức năng Selen:</strong></p><ul><li>Khoảng 28% đến 46% tổng hàm lượng Selen trong cơ thể có trong cơ xương.</li><li>Giúp sửa chữa DNA và có đặc tính chống oxy hóa.</li><li>Đóng vai trò trong quá trình tổng hợp và chuyển hóa hormone tuyến giáp.</li></ul><p><strong>Các vấn đề khi suy giảm Selen:</strong></p><ul><li>Suy giảm Selen cùng với căng thẳng bổ sung có thể gây bệnh.</li><li>Bệnh nhân giảm Selen bị nhiễm virus có thể phát triển bệnh Keshan.</li></ul><p><strong>Các triệu chứng hấp thụ Selen quá mức:</strong></p><ul><li>Hôi miệng.</li><li>Rụng tóc và móng.</li><li>Buồn nôn, mệt mỏi, tiêu chảy.</li><li>Bất thường hệ thần kinh.</li><li>Ngộ độc cấp tính có thể gây vấn đề tiêu hóa, thần kinh, hô hấp và thận.</li></ul>'),

    array('id'=>9,'name'=>'Kẽm','description'=>'<p><strong>Chức năng Kẽm:</strong></p><ul><li>Là nguyên tố vi lượng thiết yếu có trong mọi tế bào.</li><li>Giúp hệ miễn dịch hoạt động bình thường.</li><li>Tham gia tăng trưởng tế bào, phân chia tế bào và làm lành vết thương.</li></ul><p><strong>Các triệu chứng suy giảm Kẽm:</strong></p><ul><li>Nhiễm trùng tái phát.</li><li>Suy sinh dục.</li><li>Rụng tóc, kém ăn.</li><li>Vấn đề về khứu giác.</li><li>Loét da và tăng trưởng chậm.</li></ul><p><strong>Các triệu chứng hấp thụ quá mức:</strong></p><ul><li>Tiêu thụ nhiều Kẽm dạng bổ sung có thể gây tiêu chảy, chuột rút bụng và nôn mửa.</li><li>Một số sản phẩm xịt mũi chứa Kẽm có thể gây mất khứu giác.</li></ul>')
);

$minerals112Json = json_encode(
    $minerals112,
    JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
);
@endphp

<div class="mineral-form">
    <form class="mineral-form-112" onsubmit="return false;">
        <table>
            <tbody>
                <tr class="table-head">
                    <td colspan="2">Lượng tiêu thụ chất khoáng khuyến nghị cho:</td>
                </tr>

                <tr>
                    <td class="field-label">Nhóm tuổi <span class="required-star">*</span></td>
                    <td>
                        <label><input type="radio" name="rmifor_112" value="1"> Trẻ sơ sinh (0–12 tháng)</label><br>
                        <label><input type="radio" name="rmifor_112" value="2"> Trẻ em (1–17 tuổi)</label><br>
                        <label><input type="radio" name="rmifor_112" value="3" checked> Người trưởng thành (18 tuổi trở lên)</label>
                    </td>
                </tr>

                <tr>
                    <td class="field-label">Giới tính <span class="required-star">*</span></td>
                    <td>
                        <label><input type="radio" name="sex_112" value="male" checked> Nam</label>
                        &nbsp;&nbsp;
                        <label><input type="radio" name="sex_112" value="female"> Nữ</label>
                    </td>
                </tr>

                <tr>
                    <td class="field-label">Tuổi <span class="required-star">*</span></td>
                    <td>
                        <input type="number" name="age_112" class="mineral-input" min="18" max="99" value="18" required>
                        <span class="age-unit-112">Tuổi</span>
                    </td>
                </tr>

                <tr class="pregnancy-row-112" style="display:none">
                    <td class="field-label">Bạn có đang mang thai không?</td>
                    <td>
                        <label><input type="radio" name="pregnant_112" value="yes"> Có</label>
                        &nbsp;
                        <label><input type="radio" name="pregnant_112" value="no" checked> Không</label>
                    </td>
                </tr>

                <tr class="breastfeeding-row-112" style="display:none">
                    <td class="field-label">Bạn có đang nuôi con bằng sữa mẹ không?</td>
                    <td>
                        <label><input type="radio" name="breastfeeding_112" value="yes"> Có</label>
                        &nbsp;
                        <label><input type="radio" name="breastfeeding_112" value="no" checked> Không</label>
                    </td>
                </tr>

                <tr class="table-head">
                    <td colspan="2">Khoáng chất (chọn tối đa 3 loại)</td>
                </tr>

                <tr>
                    <td colspan="2">
                        <div class="mineral-list">
                            @foreach($minerals112 as $mineral)
                                <label class="mineral-option">
                                    <input type="checkbox" name="slt_mineral_112[]" value="{{ $mineral['id'] }}">
                                    {{ $mineral['name'] }}
                                </label>
                            @endforeach
                        </div>
                    </td>
                </tr>

                <tr>
                    <td colspan="2" class="mineral-submit-area">
                        <span class="required-star">*</span> Thông tin bắt buộc
                        <br><br>
                        <button type="button" class="flat-btn mineral-submit-112">Kiểm tra</button>
                        <div class="mineral-hint">Vui lòng chọn tối đa 3 loại khoáng chất.</div>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="error-message mineral-error-112" role="alert" aria-live="polite"></div>
    </form>
</div>

<div class="mineral-result">
    <table>
        <tbody>
            <tr class="table-head">
                <td>Kết quả lượng khoáng chất khuyến nghị</td>
            </tr>
            <tr>
                <td class="mineral-results-content-112"></td>
            </tr>
        </tbody>
    </table>

    <div class="result-note">
        <strong>Lưu ý:</strong> Đây là lượng khuyến nghị tham khảo theo nhóm tuổi và giới tính, không phải liều điều trị hoặc chỉ định sử dụng thực phẩm bổ sung. Nhu cầu thực tế có thể thay đổi theo tình trạng sức khỏe và chế độ ăn. Phụ nữ mang thai hoặc cho con bú nên trao đổi với nhân viên y tế để được tư vấn.
    </div>
</div>

<script type="application/json" class="mineral-data-112">{!! $minerals112Json !!}</script>

<script>
(function() {
    'use strict';

    function initMineral112(root) {
        if (!root || root.getAttribute('data-initialized') === '1') {
            return;
        }

        root.setAttribute('data-initialized', '1');

        var form = root.querySelector('.mineral-form-112');
        var ageInput = form.querySelector('[name="age_112"]');
        var errorBox = form.querySelector('.mineral-error-112');
        var resultBox = root.querySelector('.mineral-result');
        var resultContent = root.querySelector('.mineral-results-content-112');
        var pregnancyRow = form.querySelector('.pregnancy-row-112');
        var breastfeedingRow = form.querySelector('.breastfeeding-row-112');
        var ageUnit = form.querySelector('.age-unit-112');
        var submitButton = form.querySelector('.mineral-submit-112');

        var minerals = [];

        try {
            minerals = JSON.parse(
                root.querySelector('.mineral-data-112').textContent
            );
        } catch (e) {
            showError('Không thể tải dữ liệu khoáng chất. Vui lòng tải lại trang.');
            return;
        }

        function getChecked(name) {
            var el = form.querySelector('input[name="' + name + '"]:checked');
            return el ? el.value : '';
        }

        function showError(message) {
            errorBox.textContent = message;
            errorBox.style.display = 'block';
            resultBox.style.display = 'none';
        }

        function clearError() {
            errorBox.textContent = '';
            errorBox.style.display = 'none';
        }

        function clearResult() {
            clearError();
            resultBox.style.display = 'none';
        }

        function setRadio(name, value) {
            var el = form.querySelector(
                'input[name="' + name + '"][value="' + value + '"]'
            );

            if (el) {
                el.checked = true;
            }
        }

        function updatePregnancyFields() {
            var group = getChecked('rmifor_112');
            var sex = getChecked('sex_112');
            var age = parseInt(ageInput.value, 10);

            var show = (
                group !== '1' &&
                sex === 'female' &&
                !isNaN(age) &&
                age > 13 &&
                age < 51
            );

            pregnancyRow.style.display = show ? '' : 'none';
            breastfeedingRow.style.display = show ? '' : 'none';

            if (!show) {
                setRadio('pregnant_112', 'no');
                setRadio('breastfeeding_112', 'no');
            }
        }

        function updateAgeSettings(resetAge) {
            var group = getChecked('rmifor_112');
            var min, max, defaultAge;

            if (group === '1') {
                min = 0;
                max = 12;
                defaultAge = 6;
                ageUnit.textContent = 'Tháng';
            } else if (group === '2') {
                min = 1;
                max = 17;
                defaultAge = 10;
                ageUnit.textContent = 'Tuổi';
            } else {
                min = 18;
                max = 99;
                defaultAge = 18;
                ageUnit.textContent = 'Tuổi';
            }

            ageInput.min = min;
            ageInput.max = max;

            var currentAge = parseInt(ageInput.value, 10);

            if (
                resetAge ||
                isNaN(currentAge) ||
                currentAge < min ||
                currentAge > max
            ) {
                ageInput.value = defaultAge;
            }

            updatePregnancyFields();
            clearResult();
        }

        function getValue(id, age, sex, pregnant, breastfeeding, group) {
            var female = sex === 'female';
            var infant = group === '1';
            var years = infant ? 0 : age;
            var months = age;

            if (id === 1) {
                if (infant) return months <= 6 ? '210 mg/ngày' : '270 mg/ngày';
                if (years <= 3) return '500 mg/ngày';
                if (years <= 8) return '800 mg/ngày';
                if (years <= 18) return '1300 mg/ngày';
                if (years <= 50) return '1000 mg/ngày';
                return '1200 mg/ngày';
            }

            if (id === 2) {
                if (infant) return months <= 6 ? '200 mcg/ngày' : '220 mcg/ngày';
                if (years <= 3) return '340 mcg/ngày';
                if (years <= 8) return '440 mcg/ngày';
                if (years <= 13) return '700 mcg/ngày';
                if (female && pregnant) return '1000 mcg/ngày';
                if (female && breastfeeding) return '1300 mcg/ngày';
                if (years <= 18) return '890 mcg/ngày';
                return '900 mcg/ngày';
            }

            if (id === 3) {
                if (infant) return months <= 6 ? '0.01 mg/ngày' : '0.5 mg/ngày';
                if (years <= 3) return '0.7 mg/ngày';
                if (years <= 8) return '1 mg/ngày';
                if (years <= 13) return '2 mg/ngày';
                if (years <= 18) return '3 mg/ngày';
                return female ? '3 mg/ngày' : '4 mg/ngày';
            }

            if (id === 4) {
                if (infant) return months <= 6 ? '0.27 mg/ngày' : '11 mg/ngày';
                if (years <= 3) return '7 mg/ngày';
                if (years <= 8) return '10 mg/ngày';
                if (years <= 13) return '8 mg/ngày';

                if (female) {
                    if (pregnant) return '27 mg/ngày';
                    if (breastfeeding) return years <= 18 ? '10 mg/ngày' : '9 mg/ngày';
                    if (years <= 18) return '15 mg/ngày';
                    if (years <= 50) return '18 mg/ngày';
                }

                if (years <= 18) return '11 mg/ngày';
                return '8 mg/ngày';
            }

            if (id === 5) {
                if (infant) return months <= 6 ? '30 mg/ngày' : '75 mg/ngày';
                if (years <= 3) return '80 mg/ngày';
                if (years <= 8) return '130 mg/ngày';
                if (years <= 13) return '240 mg/ngày';

                if (female) {
                    if (years <= 18) return pregnant ? '400 mg/ngày' : '360 mg/ngày';
                    if (years <= 30) return pregnant ? '350 mg/ngày' : '310 mg/ngày';
                    if (years <= 50) return pregnant ? '360 mg/ngày' : '320 mg/ngày';
                    return '320 mg/ngày';
                }

                if (years <= 18) return '410 mg/ngày';
                if (years <= 30) return '400 mg/ngày';
                return '420 mg/ngày';
            }

            if (id === 6) {
                if (infant) return months <= 6 ? '100 mg/ngày' : '275 mg/ngày';
                if (years <= 3) return '460 mg/ngày';
                if (years <= 8) return '500 mg/ngày';
                if (years <= 18) return '1250 mg/ngày';
                return '700 mg/ngày';
            }

            if (id === 7) {
                if (infant) return months <= 6 ? '0.4 g/ngày' : '0.7 g/ngày';
                if (years <= 3) return '3 g/ngày';
                if (years <= 8) return '3.8 g/ngày';
                if (years <= 13) return '4.5 g/ngày';
                return '4.7 g/ngày';
            }

            if (id === 8) {
                if (infant) return months <= 6 ? '15 mcg/ngày' : '20 mcg/ngày';
                if (years <= 3) return '20 mcg/ngày';
                if (years <= 8) return '30 mcg/ngày';
                if (years <= 13) return '40 mcg/ngày';
                if (female && pregnant) return '60 mcg/ngày';
                if (female && breastfeeding) return '70 mcg/ngày';
                return '55 mcg/ngày';
            }

            if (id === 9) {
                if (infant) return months <= 6 ? '2 mg/ngày' : '3 mg/ngày';
                if (years <= 3) return '3 mg/ngày';
                if (years <= 8) return '5 mg/ngày';
                if (years <= 13) return '8 mg/ngày';

                if (female) {
                    if (pregnant) return years <= 18 ? '12 mg/ngày' : '11 mg/ngày';
                    if (breastfeeding) return years <= 18 ? '13 mg/ngày' : '12 mg/ngày';
                    return years <= 18 ? '9 mg/ngày' : '8 mg/ngày';
                }

                return '11 mg/ngày';
            }

            return 'Chưa có dữ liệu';
        }

        function escapeHtml(value) {
            return String(value).replace(/[&<>"']/g, function(char) {
                var map = {
                    '&': '&amp;',
                    '<': '&lt;',
                    '>': '&gt;',
                    '"': '&quot;',
                    "'": '&#039;'
                };

                return map[char];
            });
        }

        function renderResults() {
            var group = getChecked('rmifor_112');
            var sex = getChecked('sex_112');
            var ageValue = ageInput.value;
            var age = Number(ageValue);

            var selected = form.querySelectorAll(
                'input[name="slt_mineral_112[]"]:checked'
            );

            var pregnant = getChecked('pregnant_112') === 'yes';
            var breastfeeding = getChecked('breastfeeding_112') === 'yes';

            clearError();
            resultBox.style.display = 'none';

            if (!group) {
                showError('Vui lòng chọn nhóm tuổi.');
                return;
            }

            if (!sex) {
                showError('Vui lòng chọn giới tính.');
                return;
            }

            if (
                ageValue === '' ||
                !/^\d+$/.test(ageValue) ||
                !isFinite(age)
            ) {
                showError('Vui lòng nhập tuổi hợp lệ.');
                return;
            }

            if (group === '1' && (age < 0 || age > 12)) {
                showError('Nhóm trẻ sơ sinh áp dụng cho trẻ từ 0 đến 12 tháng tuổi.');
                return;
            }

            if (group === '2' && (age < 1 || age > 17)) {
                showError('Nhóm trẻ em áp dụng cho trẻ từ 1 đến 17 tuổi.');
                return;
            }

            if (group === '3' && (age < 18 || age > 99)) {
                showError('Nhóm người trưởng thành áp dụng cho người từ 18 đến 99 tuổi.');
                return;
            }

            if (selected.length === 0) {
                showError('Vui lòng chọn ít nhất một khoáng chất.');
                return;
            }

            if (selected.length > 3) {
                showError('Vui lòng chỉ chọn tối đa 3 khoáng chất.');
                return;
            }

            if (sex === 'female' && group !== '1' && age > 13 && age < 51) {
                if (!getChecked('pregnant_112')) {
                    showError('Vui lòng chọn tình trạng mang thai.');
                    return;
                }

                if (!getChecked('breastfeeding_112')) {
                    showError('Vui lòng chọn tình trạng cho con bú.');
                    return;
                }

                if (pregnant) {
                    breastfeeding = false;
                }
            } else {
                pregnant = false;
                breastfeeding = false;
            }

            var html = '';

            for (var i = 0; i < selected.length; i++) {
                var id = parseInt(selected[i].value, 10);
                var mineral = null;

                for (var j = 0; j < minerals.length; j++) {
                    if (parseInt(minerals[j].id, 10) === id) {
                        mineral = minerals[j];
                        break;
                    }
                }

                if (!mineral) {
                    continue;
                }

                var amount = getValue(
                    id,
                    age,
                    sex,
                    pregnant,
                    breastfeeding,
                    group
                );

                html += '<div class="result-item">';
                html += '<h4>Lượng ' + escapeHtml(mineral.name);
                html += ' cần thiết cho bạn là: ';
                html += '<span class="result-amount">' + amount + '</span></h4>';
                html += '<div class="mineral-description">';
                html += mineral.description;
                html += '</div></div>';
            }

            if (!html) {
                showError('Không tìm thấy dữ liệu khoáng chất đã chọn.');
                return;
            }

            resultContent.innerHTML = html;
            resultBox.style.display = 'block';

            setTimeout(function() {
                var top = resultBox.getBoundingClientRect().top +
                    window.pageYOffset - 100;

                window.scrollTo({
                    top: top,
                    behavior: 'smooth'
                });
            }, 100);
        }

        // Nhóm tuổi
        var groupRadios = form.querySelectorAll('[name="rmifor_112"]');

        for (var i = 0; i < groupRadios.length; i++) {
            groupRadios[i].addEventListener('change', function() {
                updateAgeSettings(true);
            });
        }

        // Giới tính
        var sexRadios = form.querySelectorAll('[name="sex_112"]');

        for (var j = 0; j < sexRadios.length; j++) {
            sexRadios[j].addEventListener('change', function() {
                updatePregnancyFields();
                clearResult();
            });
        }

        // Tuổi
        ageInput.addEventListener('input', function() {
            updatePregnancyFields();
            clearResult();
        });

        // Thai kỳ và cho con bú
        var pregnancyInputs = form.querySelectorAll(
            '[name="pregnant_112"], [name="breastfeeding_112"]'
        );

        for (var k = 0; k < pregnancyInputs.length; k++) {
            pregnancyInputs[k].addEventListener('change', clearResult);
        }

        // Chọn khoáng chất
        var mineralInputs = form.querySelectorAll(
            '[name="slt_mineral_112[]"]'
        );

        for (var m = 0; m < mineralInputs.length; m++) {
            mineralInputs[m].addEventListener('change', function() {
                var checked = form.querySelectorAll(
                    '[name="slt_mineral_112[]"]:checked'
                );

                if (checked.length > 3) {
                    this.checked = false;
                    showError('Bạn chỉ được chọn tối đa 3 khoáng chất.');
                } else {
                    clearResult();
                }

                updateMineralStyles();
            });
        }

        function updateMineralStyles() {
            var options = form.querySelectorAll('.mineral-option');

            for (var i = 0; i < options.length; i++) {
                var checkbox = options[i].querySelector('input');

                if (checkbox && checkbox.checked) {
                    options[i].classList.add('is-selected');
                } else {
                    options[i].classList.remove('is-selected');
                }
            }
        }

        // Nút kiểm tra
        submitButton.addEventListener('click', function(e) {
            e.preventDefault();
            renderResults();
        });

        // Ngăn submit form ngoài ý muốn
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            renderResults();
        });

        // Khởi tạo
        updateAgeSettings(false);
        updateMineralStyles();
    }

    function startMineral112() {
        var roots = document.querySelectorAll('.shortcode-112');

        for (var i = 0; i < roots.length; i++) {
            initMineral112(roots[i]);
        }
    }

    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', startMineral112);
    } else {
        startMineral112();
    }
})();
</script>
</div>
