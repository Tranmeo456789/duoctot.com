
<style>
#alcohol-screening-75 .calculator-table-form {margin:0 auto 20px;color:#000;width:90%;line-height:130%;}
#alcohol-screening-75 .calculator-table-form table {width:100%;color:#000;}
#alcohol-screening-75 .calculator-table-form td {border-left:1px solid #fff;border-right:0;border-bottom:1px solid #fff;padding:10px 5px;vertical-align:top;text-align:left;}
#alcohol-screening-75 .calculator-table-form td:first-child {border-left:none;}
#alcohol-screening-75 .calculator-table-form tr:last-child td {border-bottom:none;}
#alcohol-screening-75 .calculator-table-form.blue table {background:#E6F4FE;border:1px solid #0F5885;}
#alcohol-screening-75 .calculator-table-form.pink table {background:#FBE4FD;border:1px solid #AD0054;}
#alcohol-screening-75 .calculator-table-form.blue td:first-child {background:#CFEAFC;}
#alcohol-screening-75 .calculator-table-form.pink td:first-child {background:#FFD6EB;}
#alcohol-screening-75 .calculator-table-form tr.table-head td {color:#fff;font-weight:bold;}
#alcohol-screening-75 .calculator-table-form.blue tr.table-head td {background:#0F5885;}
#alcohol-screening-75 .calculator-table-form.pink tr.table-head td {background:#AD0054;}
#alcohol-screening-75 .calculator-table-form input[type=radio] {margin-right:5px;}
#alcohol-screening-75 .calculator-table-form .flat-btn {border:0;color:#fff;margin-left:5px;cursor:pointer;font-size:13px;font-weight:600;padding:8px 15px;display:inline-block;background:#0F5885;}
#alcohol-screening-75 .calculator-table-form.pink .flat-btn {background:#AD0054;}
#alcohol-screening-75 .calculator-table-form.blue .flat-btn:hover {background:#0779A3;}
#alcohol-screening-75 .calculator-table-form.pink .flat-btn:hover {background:#D62060;}
#alcohol-screening-75 .required {color:#B30000;text-align:left;float:left;padding-top:15px;}
#alcohol-screening-75 .mandatory-star {color:#f00;}
#alcohol-screening-75 .result-box {padding-top:20px;display:none;}
#alcohol-screening-75 .result-box table {width:100%;}
#alcohol-screening-75 .result-score {color:#f00;font-size:20px;font-weight:bold;}
#alcohol-screening-75 .question-title {font-weight:bold;}
#alcohol-screening-75 select {max-width:100%;padding:6px;}
@media(max-width:767px) {
    #alcohol-screening-75 .calculator-table-form {width:100%;}
    #alcohol-screening-75 .calculator-table-form table {font-size:13px;}
}
</style>

<div id="alcohol-screening-75" class="wpt_test fill_form">
    <div class="content">
        <div class="calculator-table-form blue" id="gendercolor_75">
            <form id="alcohol_form_75" method="post">
                <table cellpadding="5" width="100%" class="bluebox2 tv12blue">
                    <tbody>
                        <tr>
                            <td width="50%" class="tbold">Giới tính</td>
                            <td>
                                <label><input type="radio" name="sex_75" value="male"> Nam</label>
                                <label><input type="radio" name="sex_75" value="female"> Nữ</label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" class="tbold">Chọn tuổi của bạn</td>
                            <td width="50%">
                                <select name="age_75" id="age_75">
                                    <option value="-1">Chọn</option>
                                    @for($age = 10; $age <= 80; $age++)
                                        <option value="{{ $age }}">{{ $age }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table id="ques_75" border="0" cellpadding="5" cellspacing="0" width="100%" class="questionfont bluebox2">
                    <tbody>
                        <tr>
                            <td>
                                <b class="question-title">1. Bạn có thường xuyên uống bia/rượu không?</b><br><br>
                                <label><input type="radio" name="q1_75" value="0"> Không bao giờ</label><br>
                                <label><input type="radio" name="q1_75" value="1"> Hàng tháng hoặc ít hơn</label><br>
                                <label><input type="radio" name="q1_75" value="2"> 2 đến 4 lần một tháng</label><br>
                                <label><input type="radio" name="q1_75" value="3"> 2 đến 3 lần một tuần</label><br>
                                <label><input type="radio" name="q1_75" value="4"> 4 lần trở lên một tuần</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="question-title">2. Thông thường bạn uống bao nhiêu ly mỗi lần bạn ăn nhậu?</b><br><br>
                                <label><input type="radio" name="q2_75" value="0"> 1 hoặc 2</label><br>
                                <label><input type="radio" name="q2_75" value="1"> 3 hoặc 4</label><br>
                                <label><input type="radio" name="q2_75" value="2"> 5 hoặc 6</label><br>
                                <label><input type="radio" name="q2_75" value="3"> 7 hoặc 9</label><br>
                                <label><input type="radio" name="q2_75" value="4"> 10 trở lên</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="question-title">3. Bạn có thường uống từ 5 ly trở lên mỗi lần nhậu hay không?</b><br><br>
                                <label><input type="radio" name="q3_75" value="0"> Không bao giờ</label><br>
                                <label><input type="radio" name="q3_75" value="1"> Ít hơn hàng tháng</label><br>
                                <label><input type="radio" name="q3_75" value="2"> Hàng tháng</label><br>
                                <label><input type="radio" name="q3_75" value="3"> Hàng tuần</label><br>
                                <label><input type="radio" name="q3_75" value="4"> Hàng ngày hoặc gần như hàng ngày</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="question-title">4. Trong năm qua, bạn có thường xuyên phát hiện mình không thể ngưng uống rượu/bia khi đã bắt đầu uống hay không?</b><br><br>
                                <label><input type="radio" name="q4_75" value="0"> Không bao giờ</label><br>
                                <label><input type="radio" name="q4_75" value="1"> Ít hơn hàng tháng</label><br>
                                <label><input type="radio" name="q4_75" value="2"> Hàng tháng</label><br>
                                <label><input type="radio" name="q4_75" value="3"> Hàng tuần</label><br>
                                <label><input type="radio" name="q4_75" value="4"> Hàng ngày hoặc gần như hàng ngày</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="question-title">5. Trong năm qua, bạn có thường xuyên không làm được những điều bình thường (chạy xe, lên cầu thang,...) sau khi đã uống rượu/bia hay không?</b><br><br>
                                <label><input type="radio" name="q5_75" value="0"> Không bao giờ</label><br>
                                <label><input type="radio" name="q5_75" value="1"> Ít hơn hàng tháng</label><br>
                                <label><input type="radio" name="q5_75" value="2"> Hàng tháng</label><br>
                                <label><input type="radio" name="q5_75" value="3"> Hàng tuần</label><br>
                                <label><input type="radio" name="q5_75" value="4"> Hàng ngày hoặc gần như hàng ngày</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="question-title">6. Trong năm qua, bạn có thường xuyên uống rượu vào buổi sáng để bắt đầu sau một đêm sử dụng nhiều rượu không?</b><br><br>
                                <label><input type="radio" name="q6_75" value="0"> Không bao giờ</label><br>
                                <label><input type="radio" name="q6_75" value="1"> Ít hơn hàng tháng</label><br>
                                <label><input type="radio" name="q6_75" value="2"> 2 hay 4 lần hàng tháng</label><br>
                                <label><input type="radio" name="q6_75" value="3"> 2 hay 3 lần hàng tuần</label><br>
                                <label><input type="radio" name="q6_75" value="4"> Trên 4 lần mỗi tuần</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="question-title">7. Trong năm qua, bạn có thường xuyên cảm thấy tội lỗi hoặc hối tiếc sau khi uống rượu không?</b><br><br>
                                <label><input type="radio" name="q7_75" value="0"> 1 hoặc 2 lần</label><br>
                                <label><input type="radio" name="q7_75" value="1"> 3 hoặc 4 lần</label><br>
                                <label><input type="radio" name="q7_75" value="2"> 5 hoặc 6 lần</label><br>
                                <label><input type="radio" name="q7_75" value="3"> 7 hoặc 9 lần</label><br>
                                <label><input type="radio" name="q7_75" value="4"> Trên 10 lần</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="question-title">8. Trong năm qua, bạn có thường xuyên quên những gì đã xảy ra vào đêm hôm trước do rượu không?</b><br><br>
                                <label><input type="radio" name="q8_75" value="0"> Không bao giờ</label><br>
                                <label><input type="radio" name="q8_75" value="1"> Ít hơn hàng tháng</label><br>
                                <label><input type="radio" name="q8_75" value="2"> Hàng tháng</label><br>
                                <label><input type="radio" name="q8_75" value="3"> Hàng tuần</label><br>
                                <label><input type="radio" name="q8_75" value="4"> Hàng ngày hoặc gần như hàng ngày</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="question-title">9. Bạn hoặc người khác có bị thương bởi hậu quả của uống rượu không?</b><br><br>
                                <label><input type="radio" name="q9_75" value="0"> Không</label><br>
                                <label><input type="radio" name="q9_75" value="2"> Có, nhưng không phải trong năm trước</label><br>
                                <label><input type="radio" name="q9_75" value="4"> Có, trong năm ngoái</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <b class="question-title">10. Đã có ai trong gia đình, bạn bè hoặc nhân viên y tế lo lắng về việc uống rượu/bia quá đà của bạn và đề nghị bạn giảm tiêu thụ rượu/bia không?</b><br><br>
                                <label><input type="radio" name="q10_75" value="0"> Không</label><br>
                                <label><input type="radio" name="q10_75" value="2"> Có, nhưng không phải trong năm trước</label><br>
                                <label><input type="radio" name="q10_75" value="4"> Có, trong năm ngoái</label>
                            </td>
                        </tr>
                        <tr>
                            <td align="center">
                                <span class="required">(* Yêu cầu)</span>
                                <input type="button" value="Kiểm tra" class="flat-btn" id="submit_btn_75">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>

        <div class="calculator-table-form blue result-box" id="form_kq2_75">
            <table>
                <tbody>
                    <tr class="table-head">
                        <td height="20" colspan="2" align="center">Kiểm tra tự sàng lọc rượu/bia - Kết quả</td>
                    </tr>
                    <tr>
                        <td><b>Số điểm của bạn là</b></td>
                        <td width="162" align="center" class="bluebox2">
                            <span class="result-score" id="total_75"></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="justify" class="tv12blue bluebox2">
                            <p id="content_75"></p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
jQuery(function($) {
    var $root = $('#alcohol-screening-75');

    $root.find('input[name="sex_75"]').on('change', function() {
        var isMale = $(this).val() === 'male';
        $root.find('#gendercolor_75, #form_kq2_75').removeClass('blue pink').addClass(isMale ? 'blue' : 'pink');
    });

    $root.find('#submit_btn_75').on('click', function() {
        var sex = $root.find('input[name="sex_75"]:checked').val();
        var age = $root.find('#age_75').val();

        if (sex !== 'male' && sex !== 'female') {
            alert('Bạn chưa chọn giới tính');
            return;
        }

        if (age === '-1') {
            alert('Vui lòng chọn tuổi của bạn!');
            return;
        }

        var total = 0;

        for (var i = 1; i <= 10; i++) {
            var answer = $root.find('input[name="q' + i + '_75"]:checked');

            if (!answer.length) {
                alert('Bạn chưa trả lời đầy đủ 10 câu hỏi!');
                return;
            }

            total += parseInt(answer.val(), 10);
        }

        var result = '';

        if (total <= 7) {
            result = 'Rủi ro thấp. Có thể bạn không gặp vấn đề với rượu. Hãy uống có chừng mực hoặc không uống.';
        } else if (total <= 15) {
            result = 'Rủi ro trung bình. Đôi khi bạn có thể uống quá nhiều. Điều này có thể khiến bạn hoặc những người khác gặp rủi ro. Cố gắng cắt giảm rượu hoặc ngừng uống rượu hoàn toàn.';
        } else if (total <= 19) {
            result = 'Rủi ro cao. Việc uống rượu có thể gây hại cho bạn. Điều quan trọng là bạn phải cắt giảm lượng rượu hoặc ngừng uống rượu hoàn toàn. Hãy hỏi bác sĩ để được tư vấn về cách tốt nhất để cắt giảm.';
        } else {
            result = 'Có thể bạn đang gặp vấn đề nghiêm trọng liên quan đến việc sử dụng rượu. Việc sử dụng rượu có thể gây hại cho bạn. Hãy trao đổi với bác sĩ hoặc chuyên gia y tế để được đánh giá và hỗ trợ.';
        }

        $root.find('#total_75').text(total);
        $root.find('#content_75').text(result);
        $root.find('#form_kq2_75').show();
    });
});
</script>
