<div id="health-calculator-41">
    <style>
        #health-calculator-41 table { border-collapse: collapse; width: 100%; }
        #health-calculator-41 table td, #health-calculator-41 table th { border: 1px solid #ddd; padding: 8px; }
        #health-calculator-41 table tr td:first-child, #health-calculator-41 table tr th:first-child { width: 1px; text-align: left; white-space: nowrap; }
        #health-calculator-41 table th { background-color: #187681; color: #fff; }
        #health-calculator-41 input[type="radio"], #health-calculator-41 input[type="checkbox"] { margin-left: 20px; margin-right: 5px; }
        #health-calculator-41 input[type="number"], #health-calculator-41 select { max-width: 200px; width: 100%; }
        #health-calculator-41 .mandatory-star { color: #ff0000; }
        #health-calculator-41 .result-container { display: none; margin-top: 15px; padding: 12px; background: #ebf3f4; border: 1px solid #ddd; }
        #health-calculator-41 .result-container p { margin-bottom: 8px; }
    </style>
    <div class="wpt_test fill_form">
        <div class="content">
            <div class="calculator-table-form blue">
                <form class="health-form-41">
                    <table>
                        <thead>
                            <tr>
                                <th colspan="2">Tính giảm cân</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td><label>Giới tính <span class="mandatory-star">*</span></label></td>
                                <td>
                                    <input type="radio" id="health-male-41" value="sex_male" name="sex" required>
                                    <label for="health-male-41">Nam</label>
                                    <input type="radio" id="health-female-41" value="sex_female" name="sex">
                                    <label for="health-female-41">Nữ</label>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="health-age-41">Tuổi <span class="mandatory-star">*</span></label></td>
                                <td>
                                    <input type="number" min="1" max="150" name="age" id="health-age-41" class="form-control form-control-sm" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="health-height-41">Chiều cao (cm) <span class="mandatory-star">*</span></label></td>
                                <td>
                                    <input type="number" name="height" min="50" max="250" id="health-height-41" class="form-control form-control-sm" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="health-weight-41">Cân nặng hiện tại (kg) <span class="mandatory-star">*</span></label></td>
                                <td>
                                    <input type="number" min="10" max="200" name="weight" id="health-weight-41" class="form-control form-control-sm" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="health-target-41">Mục tiêu <span class="mandatory-star">*</span></label></td>
                                <td>
                                    <select name="target" id="health-target-41" class="form-control form-control-sm" required>
                                        <option selected disabled value="">--Hãy chọn--</option>
                                        <option value="tc">Tăng cân</option>
                                        <option value="gc">Giảm cân</option>
                                        <option value="dt">Duy trì cân nặng</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="health-target-weight-41">Cân nặng mục tiêu (kg) <span class="mandatory-star">*</span></label></td>
                                <td>
                                    <input type="number" name="target_weight" id="health-target-weight-41" min="10" max="200" class="form-control form-control-sm" required>
                                </td>
                            </tr>
                            <tr>
                                <td><label for="health-lifestyle-41">Lối sống <span class="mandatory-star">*</span></label></td>
                                <td>
                                    <select name="life_style" id="health-lifestyle-41" class="form-control form-control-sm" required>
                                        <option selected disabled value="">--Hãy chọn--</option>
                                        <option value="1.375">Hoạt động nhẹ</option>
                                        <option value="1.55">Hoạt động vừa phải</option>
                                        <option value="1.725">Hoạt động mạnh</option>
                                        <option value="1.9">Rất tích cực</option>
                                    </select>
                                </td>
                            </tr>
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2" style="text-align: center;">
                                    <button type="submit" class="btn btn-primary btn-sm">Xác nhận</button>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </form>
            </div>
        </div>
    </div>
    <div class="result-container">
        <div><b>Kết quả:</b></div>
        <p class="bmr-result"></p>
        <p class="tdee-result"></p>
        <p class="calorie-result"></p>
    </div>
    <script>
        jQuery(document).ready(function ($) {
            var calculator = $('#health-calculator-41');
            calculator.find('.health-form-41').on('submit', function (event) {
                event.preventDefault();
                var gender = calculator.find('[name="sex"]:checked').val();
                var age = parseFloat(calculator.find('[name="age"]').val());
                var height = parseFloat(calculator.find('[name="height"]').val());
                var weight = parseFloat(calculator.find('[name="weight"]').val());
                var target = calculator.find('[name="target"]').val();
                var targetWeight = parseFloat(calculator.find('[name="target_weight"]').val());
                var activity = parseFloat(calculator.find('[name="life_style"]').val());
                if (!gender || isNaN(age) || isNaN(height) || isNaN(weight) ||
                    isNaN(targetWeight) || !target || isNaN(activity)) {
                    alert('Vui lòng nhập đầy đủ thông tin.');
                    return;
                }
                if (age < 1 || age > 150 || height < 50 || height > 250 ||
                    weight < 10 || weight > 200 || targetWeight < 10 || targetWeight > 200) {
                    alert('Vui lòng kiểm tra lại tuổi, chiều cao và cân nặng.');
                    return;
                }
                if (target === 'tc' && targetWeight <= weight) {
                    alert('Cân nặng mục tiêu phải lớn hơn cân nặng hiện tại khi chọn tăng cân.');
                    return;
                }
                if (target === 'gc' && targetWeight >= weight) {
                    alert('Cân nặng mục tiêu phải nhỏ hơn cân nặng hiện tại khi chọn giảm cân.');
                    return;
                }
                if (target === 'dt' && targetWeight !== weight) {
                    alert('Khi chọn duy trì cân nặng, cân nặng mục tiêu nên bằng cân nặng hiện tại.');
                    return;
                }
                var bmr;
                if (gender === 'sex_female') {
                    bmr = (9.247 * weight) + (3.098 * height) - (4.330 * age) + 447.593;
                } else {
                    bmr = (13.397 * weight) + (4.799 * height) - (5.677 * age) + 88.362;
                }
                var tdee = bmr * activity;
                var result = '';
                if (target === 'tc') {
                    result = 'Bạn nên nạp vào cơ thể khoảng <b>' +
                        Math.round(tdee * 1.1).toLocaleString('vi-VN') +
                        ' đến ' +
                        Math.round(tdee * 1.2).toLocaleString('vi-VN') +
                        ' calo/ngày</b> để tăng cân.';
                } else if (target === 'gc') {
                    result = 'Theo công thức gốc, bạn nên nạp ít hơn mức duy trì là <b>' +
                        Math.round(tdee).toLocaleString('vi-VN') +
                        ' calo/ngày</b> để giảm cân.';
                } else {
                    result = 'Bạn nên nạp khoảng <b>' +
                        Math.round(tdee).toLocaleString('vi-VN') +
                        ' calo/ngày</b> để duy trì cân nặng.';
                }
                calculator.find('.bmr-result').html('BMR (chuyển hóa cơ bản): <b>' + Math.round(bmr).toLocaleString('vi-VN') + ' calo/ngày</b>.');
                calculator.find('.tdee-result').html('TDEE (năng lượng tiêu hao mỗi ngày): <b>' + Math.round(tdee).toLocaleString('vi-VN') + ' calo/ngày</b>.');
                calculator.find('.calorie-result').html(result);
                calculator.find('.result-container').show();
            });
        });
    </script>
</div>