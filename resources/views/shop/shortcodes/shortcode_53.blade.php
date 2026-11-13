
<style>
#pregnancy-calculator-53 table{border-collapse:collapse;width:100%}
#pregnancy-calculator-53 table td,#pregnancy-calculator-53 table th{border:1px solid #ddd;padding:8px}
#pregnancy-calculator-53 table tr td:first-child,#pregnancy-calculator-53 table tr th:first-child{max-width:400px}
#pregnancy-calculator-53 table th{background-color:#187681;color:#fff}
#pregnancy-calculator-53 table td{background-color:#ebf3f4;text-align:left}
#pregnancy-calculator-53 table td:last-child{min-width:150px}
#pregnancy-calculator-53 input[type="radio"]{margin-left:10px;margin-right:5px}
#pregnancy-calculator-53 .mandatory-star{color:#ff0000}
#pregnancy-calculator-53 .result-container{display:none;margin-top:15px;padding:12px;background:#ebf3f4;border:1px solid #187681;border-radius:4px}
#pregnancy-calculator-53 .result-container ul{margin:8px 0 8px 20px}
</style>

<div id="pregnancy-calculator-53" class="wpt_test fill_form">
    <div class="content">
        <div class="calculator-table-form blue">
            <form id="health_form_53">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Chọn chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label>Tuổi <span class="mandatory-star">*</span></label></td>
                            <td>
                                <div>
                                    <input type="radio" id="age_53_0" name="age" value="under_17" class="risk-yes" required>
                                    <label for="age_53_0">Dưới 17</label>
                                </div>
                                <div>
                                    <input type="radio" id="age_53_1" name="age" value="17_35" class="risk-no">
                                    <label for="age_53_1">Từ 17 đến 35</label>
                                </div>
                                <div>
                                    <input type="radio" id="age_53_2" name="age" value="over_35" class="risk-yes">
                                    <label for="age_53_2">Trên 35</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="height_53">Chiều cao <span class="mandatory-star">*</span></label></td>
                            <td>
                                <span style="display:flex;align-items:center">
                                    <input type="number" max="200" min="50" id="height_53" required name="height" class="form-control form-control-sm" style="max-width:100px;margin-right:15px"> cm
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><label for="weight_53">Cân nặng trước khi sinh <span class="mandatory-star">*</span></label></td>
                            <td>
                                <span style="display:flex;align-items:center">
                                    <input type="number" max="200" min="20" id="weight_53" required name="weight" class="form-control form-control-sm" style="max-width:100px;margin-right:15px"> kg
                                </span>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Số lần mang thai <span class="mandatory-star">*</span></label></td>
                            <td>
                                <div>
                                    <input type="radio" required id="pregnancy_53_1" name="pregnancy_count" value="one" class="risk-no">
                                    <label for="pregnancy_53_1">1 lần</label>
                                </div>
                                <div>
                                    <input type="radio" id="pregnancy_53_2" name="pregnancy_count" value="over_two" class="risk-yes">
                                    <label for="pregnancy_53_2">Trên 2 lần</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><label>Phương pháp sinh lần trước? <span class="mandatory-star">*</span></label></td>
                            <td>
                                <div>
                                    <input type="radio" required id="delivery_53_1" name="delivery" value="normal" class="risk-no">
                                    <label for="delivery_53_1">Sinh thường</label>
                                </div>
                                <div>
                                    <input type="radio" id="delivery_53_2" name="delivery" value="cesarean" class="risk-yes">
                                    <label for="delivery_53_2">Sinh mổ</label>
                                </div>
                                <div>
                                    <input type="radio" id="delivery_53_3" name="delivery" value="forceps" class="risk-neutral">
                                    <label for="delivery_53_3">Sinh bằng forceps</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Bạn có nghiện thuốc lá, rượu hoặc cả hai trong lần mang thai này hoặc trước khi mang thai không? <span class="mandatory-star">*</span></label>
                            </td>
                            <td>
                                <div>
                                    <input type="radio" required id="substance_53_yes" name="substance" value="yes" class="risk-yes">
                                    <label for="substance_53_yes">Có</label>
                                </div>
                                <div>
                                    <input type="radio" id="substance_53_no" name="substance" value="no" class="risk-no">
                                    <label for="substance_53_no">Không</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Bạn có đang bị cao huyết áp, đái tháo đường thai kỳ, thiếu máu, HIV hoặc các bệnh liên quan không? <span class="mandatory-star">*</span></label>
                            </td>
                            <td>
                                <div>
                                    <input type="radio" required id="disease_53_yes" name="disease" value="yes" class="risk-yes">
                                    <label for="disease_53_yes">Có</label>
                                </div>
                                <div>
                                    <input type="radio" id="disease_53_no" name="disease" value="no" class="risk-no">
                                    <label for="disease_53_no">Không</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Trong lần thai kỳ này, bạn có đang mang nhiều hơn 1 em bé không? <span class="mandatory-star">*</span></label>
                            </td>
                            <td>
                                <div>
                                    <input type="radio" required id="multiple_53_yes" name="multiple" value="yes" class="risk-yes">
                                    <label for="multiple_53_yes">Có</label>
                                </div>
                                <div>
                                    <input type="radio" id="multiple_53_no" name="multiple" value="no" class="risk-no">
                                    <label for="multiple_53_no">Không</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>Lần mang thai này, bạn có bị dọa sảy thai ở giai đoạn nào chưa? <span class="mandatory-star">*</span></label>
                            </td>
                            <td>
                                <div>
                                    <input type="radio" required id="miscarriage_53_yes" name="miscarriage" value="yes" class="risk-yes">
                                    <label for="miscarriage_53_yes">Có</label>
                                </div>
                                <div>
                                    <input type="radio" id="miscarriage_53_no" name="miscarriage" value="no" class="risk-no">
                                    <label for="miscarriage_53_no">Không</label>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align:center">
                                <button type="submit" class="btn btn-primary btn-sm">Kiểm tra</button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>

    <div class="result-container">
        <b>Kết quả:</b>
        <div class="result-text"></div>
    </div>
</div>

<script>
jQuery(document).ready(function($){
    var $box = $('#pregnancy-calculator-53');
    var $form = $box.find('#health_form_53');

    $form.on('submit',function(event){
        event.preventDefault();

        var hasRisk = $box.find('.risk-yes:checked').length > 0;
        var $result = $box.find('.result-text');

        $result.empty();

        if(hasRisk){
            $result.append($('<p>').text('Bạn có một hoặc nhiều yếu tố cần lưu ý trong thai kỳ. Hãy trao đổi với bác sĩ sản khoa để được đánh giá và hướng dẫn chăm sóc phù hợp.'));

            $result.append($('<p>').text('Bạn nên chú ý chăm sóc sức khỏe bản thân và thai nhi. Một số thực phẩm có chứa acid folic gồm:'));

            var foods = [
                'Mì ống',
                'Gạo trắng',
                'Rau xanh',
                'Đậu',
                'Quả hạch',
                'Bánh mì',
                'Trái cây: đu đủ, nho, chuối, dâu tây'
            ];

            var $list = $('<ul>');
            $.each(foods,function(index,food){
                $list.append($('<li>').text(food));
            });
            $result.append($list);

            $result.append($('<p>').text('Uống đủ nước theo nhu cầu cơ thể và hướng dẫn của nhân viên y tế.'));
        }else{
            $result.text('Theo các lựa chọn bạn cung cấp, công cụ chưa ghi nhận những yếu tố nguy cơ được liệt kê trong bảng hỏi. Điều này không đồng nghĩa thai kỳ chắc chắn không có nguy cơ. Bạn vẫn nên khám thai định kỳ theo lịch hẹn.');
        }

        $box.find('.result-container').show();
    });
});
</script>
