
<style>
#eating-disorder-76 .calculator-table-form {margin:0 auto 20px;color:#000;width:90%;line-height:130%;}
#eating-disorder-76 .calculator-table-form table {width:100%;color:#000;}
#eating-disorder-76 .calculator-table-form td {border-left:1px solid #fff;border-right:0;border-bottom:1px solid #fff;padding:10px 5px;vertical-align:top;text-align:left;}
#eating-disorder-76 .calculator-table-form td:first-child {border-left:none;}
#eating-disorder-76 .calculator-table-form tr:last-child td {border-bottom:none;}
#eating-disorder-76 .calculator-table-form.blue table {background:#E6F4FE;border:1px solid #0F5885;}
#eating-disorder-76 .calculator-table-form.pink table {background:#FBE4FD;border:1px solid #AD0054;}
#eating-disorder-76 .calculator-table-form.blue td:first-child {background:#CFEAFC;}
#eating-disorder-76 .calculator-table-form.pink td:first-child {background:#FFD6EB;}
#eating-disorder-76 .calculator-table-form tr.table-head td {color:#fff;font-weight:bold;}
#eating-disorder-76 .calculator-table-form.blue tr.table-head td {background:#0F5885;}
#eating-disorder-76 .calculator-table-form.pink tr.table-head td {background:#AD0054;}
#eating-disorder-76 .calculator-table-form input[type=radio] {margin-right:5px;}
#eating-disorder-76 .calculator-table-form .flat-btn {border:0;color:#fff;margin-left:5px;cursor:pointer;font-size:13px;font-weight:600;padding:8px 15px;display:inline-block;background:#0F5885;}
#eating-disorder-76 .calculator-table-form.pink .flat-btn {background:#AD0054;}
#eating-disorder-76 .calculator-table-form.blue .flat-btn:hover {background:#0779A3;}
#eating-disorder-76 .calculator-table-form.pink .flat-btn:hover {background:#D62060;}
#eating-disorder-76 .required {color:#B30000;text-align:left;float:left;padding-top:15px;}
#eating-disorder-76 .mandatory-star {color:#f00;}
#eating-disorder-76 .result-box {padding-top:20px;display:none;}
#eating-disorder-76 select {max-width:100%;padding:6px;}
#eating-disorder-76 .question-table td {padding:12px 8px;}
@media(max-width:767px) {
    #eating-disorder-76 .calculator-table-form {width:100%;}
    #eating-disorder-76 .calculator-table-form table {font-size:13px;}
}
</style>

<div id="eating-disorder-76" class="wpt_test fill_form">
    <div class="content">
        <div class="calculator-table-form blue" id="gendercolor_76">
            <form id="eating_form_76" method="post">
                <table cellpadding="5" width="100%" class="bluebox2 tv12blue">
                    <tbody>
                        <tr>
                            <td width="50%" class="tbold">Giới tính</td>
                            <td>
                                <label><input type="radio" name="sex_76" value="male"> Nam</label>
                                <label><input type="radio" name="sex_76" value="female"> Nữ</label>
                            </td>
                        </tr>
                        <tr>
                            <td width="50%" class="tbold">Chọn tuổi của bạn</td>
                            <td width="50%">
                                <select name="age_76" id="age_76">
                                    <option value="-1">Chọn</option>
                                    @for($age = 10; $age <= 80; $age++)
                                        <option value="{{ $age }}">{{ $age }}</option>
                                    @endfor
                                </select>
                            </td>
                        </tr>
                    </tbody>
                </table>

                <table cellspacing="0" cellpadding="5" border="0" width="100%" class="bluebox2 question-table">
                    <tbody>
                        <tr>
                            <td class="tv11black tbold bgblue2 blueline1" align="center" width="70%">Trả lời tất cả các câu hỏi</td>
                            <td class="tv11black tbold bgblue2 blueline1" align="center" width="15%">Có</td>
                            <td class="tv11black tbold bgblue2 blueline1" align="center" width="15%">Không</td>
                        </tr>
                        <tr>
                            <td class="tv12blue blueline1" height="50">1. Bạn có cảm thấy khó chịu, bứt rứt khi ăn quá nhiều hay không? <span class="mandatory-star">*</span></td>
                            <td class="blueline1" align="center"><input name="rd1_76" type="radio" value="1"></td>
                            <td class="blueline1" align="center"><input name="rd1_76" type="radio" value="0"></td>
                        </tr>
                        <tr>
                            <td class="tv12blue blueline1" height="50">2. Bạn có lo lắng rằng mình mất kiểm soát ăn uống hay không? <span class="mandatory-star">*</span></td>
                            <td class="blueline1" align="center"><input name="rd2_76" type="radio" value="1"></td>
                            <td class="blueline1" align="center"><input name="rd2_76" type="radio" value="0"></td>
                        </tr>
                        <tr>
                            <td class="tv12blue blueline1" height="50">3. Trong vòng 3 tháng gần đây, bạn có tụt 5kg cân nặng của mình hay không? <span class="mandatory-star">*</span></td>
                            <td class="blueline1" align="center"><input name="rd3_76" type="radio" value="1"></td>
                            <td class="blueline1" align="center"><input name="rd3_76" type="radio" value="0"></td>
                        </tr>
                        <tr>
                            <td class="tv12blue blueline1" height="50">4. Bạn có tin rằng bản thân mình béo nhưng người xung quanh lại nói bạn quá gầy hay không? <span class="mandatory-star">*</span></td>
                            <td class="blueline1" align="center"><input name="rd4_76" type="radio" value="1"></td>
                            <td class="blueline1" align="center"><input name="rd4_76" type="radio" value="0"></td>
                        </tr>
                        <tr>
                            <td class="tv12blue blueline1" height="50">5. Bạn có cho rằng thức ăn thống trị cuộc sống của bạn hay không? <span class="mandatory-star">*</span></td>
                            <td class="blueline1" align="center"><input name="rd5_76" type="radio" value="1"></td>
                            <td class="blueline1" align="center"><input name="rd5_76" type="radio" value="0"></td>
                        </tr>
                        <tr>
                            <td colspan="3" align="center" height="50">
                                <span class="required">(* Yêu cầu)</span>
                                <input type="button" value="Nộp" name="continue" class="flat-btn" id="submit_btn_76">
                            </td>
                        </tr>
                    </tbody>
                </table>
            </form>
        </div>

        <div class="calculator-table-form blue result-box" id="form_kq2_76">
            <table cellpadding="0" cellspacing="0" width="100%">
                <tbody>
                    <tr class="table-head">
                        <td colspan="2" style="text-align:center;">Kết quả - kiểm tra chứng biếng ăn và chứng háu ăn</td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <p style="margin:0;text-align:center;">
                                <br>
                                Cảm ơn bạn đã làm bài kiểm tra.
                                <br><br>
                                <b id="content_76"></b>
                                <br><br>
                            </p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
jQuery(function($) {
    var $root = $('#eating-disorder-76');

    $root.find('input[name="sex_76"]').on('change', function() {
        var isMale = $(this).val() === 'male';
        $root.find('#gendercolor_76, #form_kq2_76').removeClass('blue pink').addClass(isMale ? 'blue' : 'pink');
    });

    $root.find('#submit_btn_76').on('click', function() {
        var sex = $root.find('input[name="sex_76"]:checked').val();
        var age = $root.find('#age_76').val();

        if (sex !== 'male' && sex !== 'female') {
            alert('Bạn chưa chọn giới tính');
            return;
        }

        if (age === '-1') {
            alert('Vui lòng chọn tuổi của bạn!');
            return;
        }

        var total = 0;

        for (var i = 1; i <= 5; i++) {
            var answer = $root.find('input[name="rd' + i + '_76"]:checked');

            if (!answer.length) {
                alert('Bạn chưa trả lời đầy đủ 5 câu hỏi!');
                return;
            }

            total += parseInt(answer.val(), 10);
        }

        var result = '';

        if (total <= 1) {
            result = 'Bạn không có xu hướng mắc chứng biếng ăn hay chứng háu ăn theo kết quả bảng hỏi này. Tuy nhiên, nếu bạn nghi ngờ mình gặp phải rối loạn ăn uống, hãy đến gặp bác sĩ chuyên khoa Tâm thần, Dinh dưỡng hoặc Tiêu hóa để được đánh giá.';
        } else {
            result = 'Bạn có khả năng có các dấu hiệu liên quan đến chứng biếng ăn hoặc chứng háu ăn. Bạn nên đến gặp bác sĩ chuyên khoa Tâm thần hoặc Tiêu hóa để được đánh giá và tư vấn.';
        }

        $root.find('#content_76').text(result);
        $root.find('#form_kq2_76').show();
    });
});
</script>
