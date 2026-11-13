
<style>
#pregnancy-weight-72 .calculator-table-form { margin: 0 auto 20px; color: #000; width: 90%; line-height: 130%; }
#pregnancy-weight-72 .calculator-table-form table { width: 100%; color: #000; }
#pregnancy-weight-72 .calculator-table-form td { border-left: 1px solid #fff; border-right: 0; border-bottom: 1px solid #fff; padding: 10px 5px; vertical-align: top; text-align: left; }
#pregnancy-weight-72 .calculator-table-form td:first-child { border-left: none; }
#pregnancy-weight-72 .calculator-table-form.pink table { background: #FBE4FD; border: 1px solid #AD0054; }
#pregnancy-weight-72 .calculator-table-form.pink td:first-child { background: #FFD6EB; }
#pregnancy-weight-72 .calculator-table-form tr.table-head td { color: #fff; font-weight: bold; font-size: 14px; background: #AD0054; }
#pregnancy-weight-72 .calculator-table-form .flat-btn { border: 0; color: #fff; margin-left: 5px; cursor: pointer; background: #AD0054; font-size: 13px; font-weight: 600; padding: 8px 15px; display: inline-block; }
#pregnancy-weight-72 .calculator-table-form .flat-btn:hover { background: #D62060; }
#pregnancy-weight-72 .calculator-table-form .form-control { font-size: 18px !important; }
#pregnancy-weight-72 .mandatory-star { color: #f00; }
#pregnancy-weight-72 .result-table { padding-top: 20px; display: none; }
#pregnancy-weight-72 .result-table td { padding: 10px; }
#pregnancy-weight-72 .result-value { color: #B30035; font-weight: bold; }
#pregnancy-weight-72 .calc-error { display: none; color: #b30000; margin: 10px 0; }
@media (max-width: 767px) {
    #pregnancy-weight-72 .calculator-table-form { width: 100%; }
    #pregnancy-weight-72 .calculator-table-form td { padding: 8px 5px; }
}
</style>

<div id="pregnancy-weight-72" class="wpt_test fill_form">
    <div class="content">
        <div class="calculator-table-form pink">
            <form id="pregnancy_form_72" style="display:inline">
                <table class="content16" border="0" cellpadding="5" cellspacing="1">
                    <tbody>
                        <tr class="table-head">
                            <td colspan="2">Nhập các thông tin chi tiết</td>
                        </tr>
                        <tr>
                            <td width="50%">Tuổi <span class="mandatory-star">*</span></td>
                            <td width="50%">
                                <input type="number" name="age" min="16" max="50" step="1" maxlength="2" style="max-width:100px;">
                            </td>
                        </tr>
                        <tr>
                            <td width="50%">Hiện đang mang thai bao nhiêu tháng? <span class="mandatory-star">*</span></td>
                            <td width="50%">
                                <select name="month" id="month_72">
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                    <option value="6">6</option>
                                    <option value="7">7</option>
                                    <option value="8">8</option>
                                    <option value="9">9</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%">Chiều cao <span class="mandatory-star">*</span></td>
                            <td width="50%">
                                <select name="cm" id="cm_72">
                                    @for($height = 121; $height <= 212; $height++)
                                        <option value="{{ $height }}" {{ $height == 170 ? 'selected' : '' }}>{{ $height }}</option>
                                    @endfor
                                </select>
                                cm
                            </td>
                        </tr>
                        <tr>
                            <td width="50%">Cân nặng trước khi mang thai <span class="mandatory-star">*</span></td>
                            <td width="50%">
                                <input type="number" name="bkilos" min="31" max="130" step="0.1" style="max-width:120px;"> Kg
                            </td>
                        </tr>
                        <tr>
                            <td width="50%">Cân nặng hiện tại <span class="mandatory-star">*</span></td>
                            <td width="50%">
                                <input type="number" name="kilos" min="31" max="130" step="0.1" style="max-width:120px;"> Kg
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="text-align:center">
                                <span class="mandatory-star">*</span> Yêu cầu
                                <button type="submit" class="flat-btn">Tính toán</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
            <div class="calc-error"></div>
        </div>

        <div class="calculator-table-form pink result-table">
            <table width="100%" cellpadding="7" cellspacing="0">
                <tbody>
                    <tr class="table-head">
                        <td colspan="2">Kết quả</td>
                    </tr>
                    <tr>
                        <td>Cân nặng hiện tại của bạn</td>
                        <td><span class="result-value kilo-ht"></span> kg</td>
                    </tr>
                    <tr>
                        <td>Cân nặng của bạn trước khi mang thai</td>
                        <td><span class="result-value kilo-mt"></span> kg</td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center">
                            <p>Bạn đã tăng được: <span class="result-value so-sanh"></span></p>
                            <p>
                                Cân nặng lý tưởng của bạn ở tháng thứ
                                <span class="result-value month-result"></span>
                                của thai kỳ là từ
                                <span class="result-value weight-to"></span>
                                đến
                                <span class="result-value weight-from"></span> kg
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
(function($) {
    $(document).ready(function() {
        var $container = $('#pregnancy-weight-72');
        var $form = $container.find('#pregnancy_form_72');

        $form.on('submit', function(event) {
            event.preventDefault();

            var age = parseInt($form.find('[name="age"]').val(), 10);
            var month = parseInt($form.find('[name="month"]').val(), 10);
            var cm = parseFloat($form.find('[name="cm"]').val());
            var bkilos = parseFloat($form.find('[name="bkilos"]').val());
            var kilos = parseFloat($form.find('[name="kilos"]').val());

            var error = '';

            if (!age || age < 16 || age > 50) {
                error = 'Vui lòng nhập độ tuổi hợp lệ từ 16 đến 50 tuổi!';
                $form.find('[name="age"]').focus();
            } else if (!cm || cm <= 0) {
                error = 'Vui lòng chọn chiều cao của bạn!';
                $form.find('[name="cm"]').focus();
            } else if (!bkilos || bkilos <= 30 || bkilos > 130) {
                error = 'Vui lòng nhập cân nặng trước khi mang thai từ 31 đến 130 kg!';
                $form.find('[name="bkilos"]').focus();
            } else if (!kilos || kilos <= 30 || kilos > 130) {
                error = 'Vui lòng nhập cân nặng hiện tại từ 31 đến 130 kg!';
                $form.find('[name="kilos"]').focus();
            } else if (kilos <= bkilos) {
                error = 'Vui lòng kiểm tra cân nặng hiện tại. Cân nặng hiện tại phải lớn hơn cân nặng trước khi mang thai!';
                $form.find('[name="kilos"]').focus();
            }

            if (error) {
                $container.find('.calc-error').text(error).show();
                $container.find('.result-table').hide();
                return;
            }

            $container.find('.calc-error').hide();

            var weightGain = kilos - bkilos;
            var bmi = bkilos / ((cm / 100) * (cm / 100));
            var weightTo = 0;
            var weightFrom = 0;

            if (bmi < 18.5) {
                weightTo = bkilos + 1.4;
                weightFrom = bkilos + 2;
            } else if (bmi >= 18.5 && bmi <= 24.9) {
                weightTo = bkilos + 1.3;
                weightFrom = bkilos + 1.78;
            } else if (bmi >= 25 && bmi <= 29.9) {
                weightTo = bkilos + 0.76;
                weightFrom = bkilos + 1.26;
            } else if (bmi >= 30) {
                weightTo = bkilos + 0.56;
                weightFrom = bkilos + 1;
            }

            $container.find('.kilo-ht').text(kilos.toFixed(1));
            $container.find('.kilo-mt').text(bkilos.toFixed(1));
            $container.find('.so-sanh').text(weightGain.toFixed(1) + ' kg');
            $container.find('.month-result').text(month);
            $container.find('.weight-to').text(weightTo.toFixed(2));
            $container.find('.weight-from').text(weightFrom.toFixed(2));

            $container.find('.result-table').show();
        });
    });
})(jQuery);
</script>
