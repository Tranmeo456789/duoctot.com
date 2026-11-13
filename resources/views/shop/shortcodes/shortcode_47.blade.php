<style>
#smoking-calculator-47 table{border-collapse:collapse;width:100%}
#smoking-calculator-47 table td,#smoking-calculator-47 table th{border:1px solid #ddd;padding:8px}
#smoking-calculator-47 table tr td:first-child,#smoking-calculator-47 table tr th:first-child{width:1px;text-align:left;white-space:nowrap}
#smoking-calculator-47 table th{background-color:#187681;color:#fff}
#smoking-calculator-47 table td{background-color:#ebf3f4}
#smoking-calculator-47 input[type="radio"]{margin-left:20px;margin-right:5px}
#smoking-calculator-47 .mandatory-star{color:#ff0000}
#smoking-calculator-47 .result-container{display:none;margin-top:15px;padding:12px;background:#ebf3f4;border:1px solid #187681;border-radius:4px}
#smoking-calculator-47 .form-control{max-width:170px}
</style>
<div id="smoking-calculator-47" class="wpt_test fill_form">
    <div class="content">
        <div class="calculator-table-form blue">
            <form id="health_form_47">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Nhập các chỉ số</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label for="age_47">Tuổi <span class="mandatory-star">*</span></label></td>
                            <td>
                                <input type="number" max="200" min="0" id="age_47" required name="age" class="form-control form-control-sm" style="max-width:100px;margin-right:15px">
                            </td>
                        </tr>
                        <tr>
                            <td><label>Giới tính <span class="mandatory-star">*</span></label></td>
                            <td>
                                <span>
                                    <input type="radio" id="sex_male_47" value="0" required name="sex">
                                    <label for="sex_male_47">Nam</label>
                                    <input type="radio" id="sex_female_47" value="1" name="sex">
                                    <label for="sex_female_47">Nữ</label>
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="date_start_47">Ngày bắt đầu hút <span class="mandatory-star">*</span><br>(gần đúng)</label></td>
                            <td>
                                <input type="date" id="date_start_47" required name="date_start" class="form-control form-control-sm">
                            </td>
                        </tr>
                        <tr>
                            <td><label>Bạn đã bỏ thuốc chưa <span class="mandatory-star">*</span></label></td>
                            <td>
                                <span>
                                    <input type="radio" id="quit_smoking_no_47" value="false" required name="quit_smoking">
                                    <label for="quit_smoking_no_47">Chưa</label>
                                    <input type="radio" id="quit_smoking_yes_47" value="true" name="quit_smoking">
                                    <label for="quit_smoking_yes_47">Đã bỏ</label>
                                </span>
                            </td>
                        </tr>
                        <tr id="date_to_container_47" style="display:none">
                            <td><label for="date_to_47">Ngày bỏ thuốc <span class="mandatory-star">*</span><br>(gần đúng)</label></td>
                            <td>
                                <input type="date" id="date_to_47" disabled required name="date_to" class="form-control form-control-sm">
                            </td>
                        </tr>
                        <tr>
                            <td><label for="count_47">Số điếu hút mỗi ngày <span class="mandatory-star">*</span></label></td>
                            <td>
                                <input type="number" id="count_47" min="1" max="200" required name="count" class="form-control form-control-sm" style="max-width:100px;margin-right:15px">
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align:center">
                                <button type="submit" class="btn btn-primary btn-sm">Tính toán</button>
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
jQuery(document).ready(function($){
    var $box = $('#smoking-calculator-47');
    var $form = $box.find('#health_form_47');
    var $dateTo = $box.find('#date_to_47');
    var $dateToContainer = $box.find('#date_to_container_47');
    $box.find('input[name="quit_smoking"]').on('change',function(){
        if($(this).val()==='true' && $(this).is(':checked')){
            $dateToContainer.show();
            $dateTo.prop('disabled',false);
        }else{
            $dateToContainer.hide();
            $dateTo.prop('disabled',true).val('');
        }
    });
    $form.on('submit',function(event){
        event.preventDefault();
        if(!this.checkValidity()){
            this.reportValidity();
            return;
        }
        var age = parseInt($box.find('[name="age"]').val(),10);
        var count = parseFloat($box.find('[name="count"]').val());
        var dateStartValue = $box.find('[name="date_start"]').val();
        var quitSmoking = $box.find('[name="quit_smoking"]:checked').val();
        var dateToValue = $dateTo.val();
        if(age < 0 || age > 200 || count <= 0){
            alert('Vui lòng kiểm tra lại tuổi và số điếu hút mỗi ngày.');
            return;
        }
        var dateStart = new Date(dateStartValue + 'T00:00:00');
        var dateTo = quitSmoking === 'true'
            ? new Date(dateToValue + 'T00:00:00')
            : new Date();
        var today = new Date();
        today.setHours(0,0,0,0);
        if(isNaN(dateStart.getTime()) || dateStart > today){
            alert('Ngày bắt đầu hút không hợp lệ.');
            return;
        }
        if(isNaN(dateTo.getTime()) || dateTo < dateStart || dateTo > today){
            alert('Ngày bỏ thuốc phải nằm sau ngày bắt đầu hút và không vượt quá ngày hiện tại.');
            return;
        }
        var days = Math.round((dateTo - dateStart) / 86400000);
        if(days < 0){
            alert('Khoảng thời gian hút thuốc không hợp lệ.');
            return;
        }
        var badDay = Math.round(days * count * 11 / (60 * 24));
        $box.find('.result-text').text('Bạn mất khoảng ' + badDay + ' ngày trong cuộc đời do hút thuốc.');
        $box.find('.result-container').show();
    });
});
</script>