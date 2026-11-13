<style>
#cancer-calculator-50 table{border-collapse:collapse;width:100%}
#cancer-calculator-50 table td,#cancer-calculator-50 table th{border:1px solid #ddd;padding:8px}
#cancer-calculator-50 table tr td:first-child,#cancer-calculator-50 table tr th:first-child{width:1px;white-space:nowrap}
#cancer-calculator-50 table th{background-color:#187681;color:#fff}
#cancer-calculator-50 table td{background-color:#ebf3f4}
#cancer-calculator-50 select{width:100%;max-width:100%}
#cancer-calculator-50 .mandatory-star{color:#ff0000}
#cancer-calculator-50 .result-container{display:none;margin-top:15px;padding:12px;background:#ebf3f4;border:1px solid #187681;border-radius:4px}
#cancer-calculator-50 .result-container p{margin:5px 0}
</style>
<div id="cancer-calculator-50" class="wpt_test fill_form">
    <div class="content">
        <div class="calculator-table-form blue">
            <form id="health_form_50">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">Tính toán nguy cơ ung thư trong suốt cuộc đời</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><label for="condition_50">Điều kiện <span class="mandatory-star">*</span></label></td>
                            <td>
                                <select id="condition_50" required name="condition" class="form-control form-control-sm">
                                    <option selected disabled value="">--Hãy chọn--</option>
                                    <option value="breast">Ung thư vú</option>
                                    <option value="cancer">Ung thư</option>
                                    <option value="unknown_primary">Ung thư vùng nguyên phát không xác định</option>
                                    <option value="cervical">Ung thư cổ tử cung</option>
                                    <option value="colorectal">Ung thư đại trực tràng</option>
                                    <option value="kidney">Ung thư thận</option>
                                    <option value="lung">Ung thư phổi</option>
                                    <option value="malignant">Ung thư ác tính</option>
                                    <option value="lymphoma">Ung thư hạch Lympho không Hodgkin (một loại tế bào máu)</option>
                                    <option value="ovarian">Ung thư buồng trứng</option>
                                    <option value="pancreatic">Ung thư tuyến tụy (tuyến tiết dịch tụy giúp tiêu hóa thức ăn, sản xuất Insulin)</option>
                                    <option value="pituitary">Ung thư tuyến yên (tuyến tiết hooc môn sinh trưởng, nằm trong não)</option>
                                    <option value="prostate">Ung thư tiền liệt tuyến (tuyến nằm ở cổ bàng quang, thuộc hệ thống sinh dục nam)</option>
                                    <option value="stomach">Ung thư dạ dày</option>
                                    <option value="uterine">Ung thư tử cung</option>
                                </select>
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
        <b>Kết quả:</b>
        <div class="result-text"></div>
    </div>
</div>
<script>
jQuery(document).ready(function($){
    var $box = $('#cancer-calculator-50');
    var $form = $box.find('#health_form_50');
    var cancerData = {
        breast: {
            rate: '6.25%',
            description: 'Tỷ lệ mắc là 1 trên 16 phụ nữ ở Hoa Kỳ (NWHIC), cứ 11 phụ nữ thì có 1 phụ nữ mắc ung thư vú ở Úc năm 2000 (AIHW và AACR, cơ sở dữ liệu tử vong quốc gia AIHW, Y tế Úc 2004).'
        },
        cancer: {
            rate: '33.33%',
            description: 'Tỷ lệ: Khoảng 1 trong 3, 38% phụ nữ và 43% nam giới (theo Thống kê ung thư Canada, Viện Ung thư Quốc gia Canada, 2004).'
        },
        unknown_primary: {
            rate: '0.67%',
            description: 'Tỷ lệ: 1 trên 75 phụ nữ và 1 trên 83 nam giới sẽ phát triển ung thư nguyên phát không xác định trong cuộc đời của họ ở Úc năm 2000 (AIHW và AACR, cơ sở dữ liệu tử vong quốc gia AIHW, Y tế Úc 2004, AIHW).'
        },
        cervical: {
            rate: '0.85%',
            description: 'Tỷ lệ: 1 trên 117 phụ nữ có nguy cơ mắc trong đời ở Hoa Kỳ (Sự kiện và số liệu về ung thư, Hiệp hội Ung thư Hoa Kỳ, 2004).'
        },
        colorectal: {
            rate: '1.92%',
            description: 'Tỷ lệ: 1 trên 26 phụ nữ và 1 trên 17 nam giới sẽ phát triển ung thư đại trực tràng trong đời ở Úc năm 2000 (AIHW và AACR, cơ sở dữ liệu tử vong quốc gia AIHW, Y tế Úc 2004, AIHW).'
        },
        kidney: {
            rate: '0.35%',
            description: 'Tỷ lệ: 1 trên 43 phụ nữ và 1 trên 76 nam giới sẽ phát triển ung thư thận trong đời ở Úc năm 2000 (AIHW và AACR, cơ sở dữ liệu tử vong quốc gia AIHW, Y tế Úc 2004, AIHW).'
        },
        lung: {
            rate: '5.88%',
            description: 'Tỷ lệ và nội dung mô tả được giữ theo dữ liệu trong shortcode gốc.'
        },
        malignant: {
            rate: '1.43%',
            description: 'Tỷ lệ: 1 trên 35 phụ nữ và 1 trên 25 nam giới sẽ phát triển khối u ác tính trong đời ở Úc năm 2000 (AIHW và AACR, cơ sở dữ liệu tử vong quốc gia AIHW, Y tế Úc 2004, AIHW).'
        },
        lymphoma: {
            rate: '0.57%',
            description: 'Tỷ lệ: 1 trên 88 phụ nữ phát triển u lympho không Hodgkin (một loại ung thư tế bào máu) trong đời ở Úc năm 2000 (AIHW và AACR, cơ sở dữ liệu tử vong quốc gia AIHW, Y tế Úc 2004, AIHW).'
        },
        ovarian: {
            rate: '1.4%',
            description: 'Tỷ lệ: 1 trên 108 phụ nữ sẽ phát triển ung thư buồng trứng trong đời ở Úc năm 2000 (AIHW và AACR, cơ sở dữ liệu tử vong quốc gia AIHW, Y tế Úc 2004, AIHW).'
        },
        pancreatic: {
            rate: '0.26%',
            description: 'Tỷ lệ và nội dung mô tả được giữ theo dữ liệu trong shortcode gốc.'
        },
        pituitary: {
            rate: '25%',
            description: '25% số người có khối u tuyến yên ác tính sau khi phân tích sau mổ nhưng hầu hết không có triệu chứng.'
        },
        prostate: {
            rate: '4.55%',
            description: 'Tỷ lệ 1 trên 11 nam giới sẽ phát triển ung thư tiền liệt tuyến trong đời ở Úc năm 2000 (AIHW và AACR, cơ sở dữ liệu tử vong quốc gia AIHW, Y tế Úc 2004, AIHW).'
        },
        stomach: {
            rate: '0.51%',
            description: 'Tỷ lệ: 1 trên 99 nam giới sẽ phát triển ung thư tiền liệt tuyến trong đời ở Úc năm 2000 (AIHW và AACR, cơ sở dữ liệu tử vong quốc gia AIHW, Y tế Úc 2004, AIHW).'
        },
        uterine: {
            rate: '0.67%',
            description: 'Tỷ lệ: 1 trên 75 phụ nữ sẽ phát triển ung thư tiền liệt tuyến trong đời ở Úc năm 2000 (AIHW và AACR, cơ sở dữ liệu tử vong quốc gia AIHW, Y tế Úc 2004, AIHW).'
        }
    };
    $form.on('submit',function(event){
        event.preventDefault();
        var condition = $box.find('[name="condition"]').val();
        if(!condition || !cancerData[condition]){
            alert('Vui lòng chọn một điều kiện.');
            return;
        }
        var item = cancerData[condition];
        $box.find('.result-text').empty()
            .append($('<p>').append($('<b>').text('Nguy cơ: ' + item.rate)))
            .append($('<p>').text(item.description));

        $box.find('.result-container').show();
    });
});
</script>