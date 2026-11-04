
<div class="calculator-table-form blue respiratory-calculator" style="padding:15px;" id="respiratory-calculator-13">
    <form class="respiratory-form" method="post">
        <table cellpadding="0" cellspacing="0" class="tv12black" width="100%">
            <tbody>
                <tr>
                    <td style="padding:8px 5px;">Ngày sinh</td>
                    <td style="padding:8px 5px;">
                        <select class="formcolor birth-month" style="width:90px;">
                            @for ($i = 1; $i <= 12; $i++)
                                <option value="{{ $i }}">Tháng {{ $i }}</option>
                            @endfor
                        </select>
                        <select class="formcolor birth-day" style="width:65px;">
                            @for ($i = 1; $i <= 31; $i++)
                                <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                        <select class="formcolor birth-year" style="width:85px;">
                            @for ($i = date('Y') - 60; $i <= date('Y'); $i++)
                                <option value="{{ $i }}" {{ $i == date('Y') ? 'selected' : '' }}>
                                    {{ $i }}
                                </option>
                            @endfor
                        </select>
                    </td>
                </tr>
                <tr>
                    <td colspan="2" style="padding:10px 5px;">
                        <button type="submit" class="flat-btn">Tính toán</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>
<div class="calculator-table-form blue respiratory-result"
     style="padding-top:20px; display:none;"
     id="respiratory-result-13">
    <table cellspacing="0" cellpadding="4" width="100%" border="0"
           class="bluebox2 CalcDarkBgWhite1">
        <tbody>
            <tr>
                <td>Đếm hơi thở</td>
                <td>
                    <input type="text" class="highlight_field light-gray-grd respiratory-timer" readonly>
                </td>
            </tr>
            <tr>
                <td>Tốc độ hô hấp</td>
                <td>
                    <font color="#FF0000">
                        <b class="respiratory-range">8-16</b>
                    </font>
                    hơi thở mỗi phút
                </td>
            </tr>
        </tbody>
    </table>
</div>
<script>
jQuery(document).ready(function ($) {
    var calculator = $('#respiratory-calculator-13');
    var result = $('#respiratory-result-13');
    calculator.find('.respiratory-form').on('submit', function (event) {
        event.preventDefault();
        var month = parseInt(calculator.find('.birth-month').val(), 10);
        var day = parseInt(calculator.find('.birth-day').val(), 10);
        var year = parseInt(calculator.find('.birth-year').val(), 10);
        var birthDate = new Date(year, month - 1, day);
        var today = new Date();
        // Kiểm tra ngày sinh hợp lệ
        if (
            birthDate.getFullYear() !== year ||
            birthDate.getMonth() !== month - 1 ||
            birthDate.getDate() !== day ||
            birthDate > today
        ) {
            alert('Vui lòng chọn ngày sinh hợp lệ.');
            return;
        }
        // Tính tuổi theo tháng
        var ageMonths = (today.getFullYear() - year) * 12
            + (today.getMonth() - (month - 1));
        if (today.getDate() < day) {
            ageMonths--;
        }
        // Tính số ngày thực tế từ ngày sinh
        var timeDifference = today.getTime() - birthDate.getTime();
        var ageInMonths = timeDifference / 1000 / 60 / 60 / 24 / 30;
        var range = '';
        var average = 0;
        if (ageInMonths < 3) {
            range = '34-57';
            average = (34 + 57) / 2;
        } else if (ageInMonths < 6) {
            range = '33-55';
            average = (33 + 55) / 2;
        } else if (ageInMonths < 9) {
            range = '31-52';
            average = (31 + 52) / 2;
        } else if (ageInMonths < 12) {
            range = '30-50';
            average = (30 + 50) / 2;
        } else if (ageInMonths < 18) {
            range = '28-46';
            average = (28 + 46) / 2;
        } else if (ageInMonths < 24) {
            range = '25-40';
            average = (25 + 40) / 2;
        } else if (ageInMonths < 36) {
            range = '22-34';
            average = (22 + 34) / 2;
        } else if (ageInMonths < 48) {
            range = '21-29';
            average = (21 + 29) / 2;
        } else if (ageInMonths < 72) {
            range = '20-27';
            average = (20 + 27) / 2;
        } else if (ageInMonths < 96) {
            range = '18-24';
            average = (18 + 24) / 2;
        } else if (ageMonths < 12 * 12) {
            range = '16-22';
            average = (16 + 22) / 2;
        } else if (ageMonths < 15 * 12) {
            range = '15-21';
            average = (15 + 21) / 2;
        } else if (ageMonths < 18 * 12) {
            range = '13-19';
            average = (13 + 19) / 2;
        } else {
            range = '8-16';
            average = (8 + 16) / 2;
        }
        // Thời gian đếm hơi thở theo mức trung bình
        var timer = Math.round(timeDifference / 1000 / 60 * average);
        result.find('.respiratory-range').text(range);
        result.find('.respiratory-timer').val(timer);
        result.show();
    });
});
</script>