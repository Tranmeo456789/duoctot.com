
<style>
#dementia-calculator-57 table { border-collapse: collapse; width: 100%; }
#dementia-calculator-57 table td, #dementia-calculator-57 table th { border: 1px solid #ddd; padding: 8px; }
#dementia-calculator-57 table tr td:first-child, #dementia-calculator-57 table tr th:first-child { text-align: left; }
#dementia-calculator-57 table tr td:last-child { text-align: left; min-width: 150px; }
#dementia-calculator-57 table th { background-color: #187681; color: #fff; }
#dementia-calculator-57 table td { background-color: #ebf3f4; text-align: left; }
#dementia-calculator-57 input[type="radio"], #dementia-calculator-57 input[type="checkbox"] { margin: 5px 5px 10px; display: inline !important; }
#dementia-calculator-57 .mandatory-star { color: #ff0000; }
#dementia-calculator-57 .result-container { display: none; margin-top: 15px; padding: 12px; background: #ebf3f4; border-left: 4px solid #187681; }
#dementia-calculator-57 .result-container b { color: #187681; }
</style>

<div id="dementia-calculator-57" class="wpt_test fill_form">
    <div class="content">
        <div class="calculator-table-form blue">
            <form id="health_form_57">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Nhập các thông tin chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label>Giới tính <span class="mandatory-star">*</span></label></td>
                            <td>
                                <span>
                                    <input type="radio" id="sex_male_57" value="0" required name="sex">
                                    <label for="sex_male_57">Nam</label>
                                    <input type="radio" id="sex_female_57" value="1" name="sex">
                                    <label for="sex_female_57">Nữ</label>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="age_57">Tuổi <span class="mandatory-star">*</span></label></td>
                            <td>
                                <select name="age" id="age_57" class="form-control form-control-sm" required style="max-width: 200px; margin-right: 15px">
                                    <option value="" selected disabled>--Hãy chọn--</option>
                                    <option value="60">Dưới 65</option>
                                    <option value="65">65</option>
                                    <option value="70">70</option>
                                    <option value="75">75</option>
                                    <option value="80">80</option>
                                    <option value="85">85</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Tiền sử sa sút trí tuệ trong gia đình <span class="mandatory-star">*</span></label></td>
                            <td>
                                <div><input type="checkbox" class="history-57 no" id="brx_1_57" name="history[]" value="0"><label for="brx_1_57">Không có</label></div>
                                <div><input type="checkbox" class="history-57 yes" id="brx_2_57" name="history[]" value="1"><label for="brx_2_57">Bố</label></div>
                                <div><input type="checkbox" class="history-57 yes" id="brx_3_57" name="history[]" value="1"><label for="brx_3_57">Mẹ</label></div>
                                <div><input type="checkbox" class="history-57 yes" id="brx_4_57" name="history[]" value="1"><label for="brx_4_57">Anh</label></div>
                                <div><input type="checkbox" class="history-57 yes" id="brx_5_57" name="history[]" value="1"><label for="brx_5_57">Chị</label></div>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Nguy cơ bệnh mạch máu <span class="mandatory-star">*</span></label></td>
                            <td>
                                <div><input type="checkbox" class="blood-risk-57 no" id="br_1_57" name="blood_risk[]" value="0"><label for="br_1_57">Không có</label></div>
                                <div><input type="checkbox" class="blood-risk-57 yes" id="br_2_57" name="blood_risk[]" value="1"><label for="br_2_57">Bệnh huyết áp</label></div>
                                <div><input type="checkbox" class="blood-risk-57 yes" id="br_3_57" name="blood_risk[]" value="1"><label for="br_3_57">Đái tháo đường</label></div>
                                <div><input type="checkbox" class="blood-risk-57 yes" id="br_4_57" name="blood_risk[]" value="1"><label for="br_4_57">Bệnh tim</label></div>
                                <div><input type="checkbox" class="blood-risk-57 yes" id="br_5_57" name="blood_risk[]" value="1"><label for="br_5_57">Cholesterol</label></div>
                                <div><input type="checkbox" class="blood-risk-57 yes" id="br_6_57" name="blood_risk[]" value="1"><label for="br_6_57">Hút thuốc</label></div>
                                <div><input type="checkbox" class="blood-risk-57 yes" id="br_7_57" name="blood_risk[]" value="1"><label for="br_7_57">Đột quỵ não</label></div>
                                <div><input type="checkbox" class="blood-risk-57 yes" id="br_8_57" name="blood_risk[]" value="1"><label for="br_8_57">Béo phì</label></div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align: center">
                                <button type="submit" class="btn btn-primary btn-sm">Kiểm tra</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>

    <div class="result-container">
        <span><b>Kết quả: </b><i class="result-text"></i></span>
    </div>
</div>

<script>
(function($) {
    $(document).ready(function() {
        var $container = $('#dementia-calculator-57');
        var $form = $container.find('#health_form_57');

        function updateCheckboxGroup(groupSelector) {
            var $group = $container.find(groupSelector);
            var $none = $group.filter('.no');
            var $yes = $group.filter('.yes');

            $none.on('change', function() {
                if ($(this).is(':checked')) {
                    $yes.prop('checked', false).prop('disabled', true);
                } else {
                    $yes.prop('disabled', false);
                }
            });

            $yes.on('change', function() {
                if ($(this).is(':checked')) {
                    $none.prop('checked', false);
                }
            });
        }

        updateCheckboxGroup('.blood-risk-57');
        updateCheckboxGroup('.history-57');

        $form.on('submit', function(event) {
            event.preventDefault();

            var age = parseInt($form.find('[name="age"]').val(), 10);
            var yesCount = $container.find('.yes:checked').length;
            var highRisk = false;

            if (age >= 80) {
                highRisk = true;
            } else if (age === 75 && yesCount > 0) {
                highRisk = true;
            } else if (age === 70 && yesCount > 2) {
                highRisk = true;
            } else if (age === 65 && yesCount > 3) {
                highRisk = true;
            } else if (age === 60 && yesCount > 4) {
                highRisk = true;
            }

            var result = highRisk
                ? 'Bạn có nguy cơ cao mắc sa sút trí tuệ'
                : 'Bạn có nguy cơ thấp mắc sa sút trí tuệ';

            $container.find('.result-text').text(result);
            $container.find('.result-container').show();
        });
    });
})(jQuery);
</script>
