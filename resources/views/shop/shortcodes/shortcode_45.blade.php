<style>
    #stroke_form_45 {
        width: 100%;
    }
    #stroke_form_45 table {
        border-collapse: collapse;
        width: 100%;
    }
    #stroke_form_45 table td,
    #stroke_form_45 table th {
        border: 1px solid #ddd;
        padding: 8px;
    }
    #stroke_form_45 table tr td:first-child {
        width: 40%;
        text-align: left;
    }
    #stroke_form_45 table tr td:last-child {
        width: 60%;
        text-align: left;
    }
    #stroke_form_45 table th {
        background-color: #187681;
        color: #fff;
    }
    #stroke_form_45 table td {
        background-color: #ebf3f4;
    }
    #stroke_form_45 input[type="radio"],
    #stroke_form_45 input[type="checkbox"] {
        margin: 5px 5px 10px;
        display: inline-block;
    }
    #stroke_form_45 label {
        cursor: pointer;
    }
    #stroke_form_45 .mandatory-star {
        color: #ff0000;
    }
    #stroke_form_45 .disease-item {
        display: flex;
        align-items: center;
        margin-bottom: 5px;
    }
    #stroke_form_45 button {
        cursor: pointer;
    }
    #stroke_result_45 {
        display: none;
        margin-top: 15px;
        padding: 12px;
        background: #ebf3f4;
        border-left: 3px solid #187681;
    }
    #stroke_result_45 p {
        margin-bottom: 8px;
    }
    #stroke_result_45 li {
        margin-bottom: 5px;
    }
    @media(max-width: 576px) {
        #stroke_form_45 table tr td:first-child {
            width: 45%;
        }
        #stroke_form_45 table tr td:last-child {
            width: 55%;
        }
    }
</style>
<div class="wpt_test fill_form">
    <div class="content">
        <div class="calculator-table-form blue">
            <form id="stroke_form_45">
                <table>
                    <thead>
                        <tr>
                            <th colspan="2">
                                Đo lường nguy cơ nhiễm virus cúm lợn H1N1
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <label>Độ tuổi
                                    <span class="mandatory-star">*</span>
                                </label>
                            </td>
                            <td>
                                <div>
                                    <input type="radio" id="age_0_45"
                                           value="Dưới 5 hoặc trên 65 tuổi"
                                           required name="age">
                                    <label for="age_0_45">Dưới 5 tuổi</label>
                                </div>
                                <div>
                                    <input type="radio" id="age_1_45"
                                           value="false" name="age">
                                    <label for="age_1_45">Từ 5 đến 65 tuổi</label>
                                </div>

                                <div>
                                    <input type="radio" id="age_2_45"
                                           value="Dưới 5 hoặc trên 65 tuổi"
                                           name="age">
                                    <label for="age_2_45">Trên 65 tuổi</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Bạn có bị thừa cân/béo phì không (chỉ số BMI > 27)?
                                    <span class="mandatory-star">*</span>
                                </label>
                            </td>
                            <td>
                                <input type="radio" id="overweight_yes_45"
                                       value="Thừa cân/béo phì"
                                       required name="overweight">
                                <label for="overweight_yes_45">Có</label>

                                <input type="radio" id="overweight_no_45"
                                       value="false" name="overweight">
                                <label for="overweight_no_45">Không</label>
                            </td>
                        </tr>
                        <tr id="pregnant_container_45" style="display:none;">
                            <td>
                                <label>
                                    Bạn có mang thai không?
                                    <span class="mandatory-star">*</span>
                                </label>
                            </td>
                            <td>
                                <input type="radio" id="pregnant_yes_45"
                                       value="Mang thai"
                                       name="pregnant">
                                <label for="pregnant_yes_45">Có</label>

                                <input type="radio" id="pregnant_no_45"
                                       value="false" name="pregnant">
                                <label for="pregnant_no_45">Không</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Bạn có đang sử dụng các liệu pháp điều trị dưới đây không?
                                    <span class="mandatory-star">*</span>
                                </label>
                            </td>
                            <td>
                                <div>
                                    <input type="radio" id="therapy_0_45"
                                           value="Dùng Aspirin dài ngày hoặc thuốc giảm miễn dịch"
                                           required name="therapy">
                                    <label for="therapy_0_45">
                                        Uống aspirin dài ngày
                                    </label>
                                </div>
                                <div>
                                    <input type="radio" id="therapy_1_45"
                                           value="Dùng Aspirin dài ngày hoặc thuốc giảm miễn dịch"
                                           name="therapy">
                                    <label for="therapy_1_45">
                                        Các thuốc có thể làm giảm miễn dịch
                                        (Steroid, Cyclosporin)
                                    </label>
                                </div>
                                <div>
                                    <input type="radio" id="therapy_no_45"
                                           value="false" name="therapy">
                                    <label for="therapy_no_45">Không</label>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Bạn có đang làm việc trong các trang trại lợn không?
                                    <span class="mandatory-star">*</span>
                                </label>
                            </td>
                            <td>
                                <input type="radio" id="working_yes_45"
                                       value="Làm việc trong trang trại lợn"
                                       required name="working">
                                <label for="working_yes_45">Có</label>
                                <input type="radio" id="working_no_45"
                                       value="false" name="working">
                                <label for="working_no_45">Không</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Bạn có tiếp xúc trực tiếp với người mắc virus cúm H1N1 không?
                                    <span class="mandatory-star">*</span>
                                </label>
                            </td>
                            <td>
                                <input type="radio" id="contact_yes_45"
                                       value="Tiếp xúc với người nhiễm H1N1"
                                       required name="contact">
                                <label for="contact_yes_45">Có</label>

                                <input type="radio" id="contact_no_45"
                                       value="false" name="contact">
                                <label for="contact_no_45">Không</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Bạn có đến quốc gia có ca nhiễm cúm lợn hay không?
                                    <span class="mandatory-star">*</span>
                                </label>
                            </td>
                            <td>
                                <input type="radio" id="country_yes_45"
                                       value="Đến quốc gia có ca nhiễm cúm lợn"
                                       required name="country">
                                <label for="country_yes_45">Có</label>

                                <input type="radio" id="country_no_45"
                                       value="false" name="country">
                                <label for="country_no_45">Không</label>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <label>
                                    Bạn có đang mắc các bệnh mạn tính dưới đây không?
                                    <span class="mandatory-star">*</span>
                                </label>
                            </td>
                            <td>
                                <div class="disease-item">
                                    <input id="diseases_1_45"
                                           value="Đái tháo đường"
                                           type="checkbox" class="diseases_45">
                                    <label for="diseases_1_45">Đái tháo đường</label>
                                </div>
                                <div class="disease-item">
                                    <input id="diseases_2_45"
                                           value="Hen phế quản"
                                           type="checkbox" class="diseases_45">
                                    <label for="diseases_2_45">Hen phế quản</label>
                                </div>
                                <div class="disease-item">
                                    <input id="diseases_3_45"
                                           value="Bệnh tim mạch"
                                           type="checkbox" class="diseases_45">
                                    <label for="diseases_3_45">Bệnh tim mạch</label>
                                </div>
                                <div class="disease-item">
                                    <input id="diseases_4_45"
                                           value="Giãn phế nang"
                                           type="checkbox" class="diseases_45">
                                    <label for="diseases_4_45">Giãn phế nang</label>
                                </div>
                                <div class="disease-item">
                                    <input id="diseases_5_45"
                                           value="Tổn thương phổi"
                                           type="checkbox" class="diseases_45">
                                    <label for="diseases_5_45">Tổn thương phổi</label>
                                </div>
                                <div class="disease-item">
                                    <input id="diseases_6_45"
                                           value="Bệnh lý thận"
                                           type="checkbox" class="diseases_45">
                                    <label for="diseases_6_45">Bệnh lý thận</label>
                                </div>
                                <div class="disease-item">
                                    <input id="diseases_7_45"
                                           value="Bệnh lý tự miễn"
                                           type="checkbox" class="diseases_45">
                                    <label for="diseases_7_45">Bệnh lý tự miễn</label>
                                </div>
                                <div class="disease-item">
                                    <input id="diseases_8_45"
                                           value="Các bệnh gan như xơ gan"
                                           type="checkbox" class="diseases_45">
                                    <label for="diseases_8_45">Các bệnh gan như xơ gan</label>
                                </div>
                                <div class="disease-item">
                                    <input id="diseases_9_45"
                                           value="Bệnh lý máu"
                                           type="checkbox" class="diseases_45">
                                    <label for="diseases_9_45">Bệnh lý máu</label>
                                </div>
                                <div class="disease-item">
                                    <input id="diseases_no_45"
                                           type="checkbox"
                                           value="false"
                                           class="diseases_no_45">
                                    <label for="diseases_no_45">
                                        Không có các bệnh trên
                                    </label>
                                </div>

                            </td>
                        </tr>

                    </tbody>
                    <tfoot>
                        <tr>
                            <td colspan="2" style="text-align:center">
                                <button type="submit" class="btn btn-primary btn-sm">
                                    Đánh giá nguy cơ
                                </button>
                            </td>
                        </tr>
                    </tfoot>
                </table>
            </form>
        </div>
    </div>
</div>
<div id="stroke_result_45">
    <p><b id="result_title_45"></b></p>
    <ul id="result_list_45"></ul>
</div>
<script>
(function () {
    var form = document.getElementById('stroke_form_45');
    if (!form || form.getAttribute('data-initialized') === '1') {
        return;
    }
    form.setAttribute('data-initialized', '1');
    var ageInputs = form.querySelectorAll('input[name="age"]');
    var pregnantContainer = document.getElementById('pregnant_container_45');
    var pregnantInputs = pregnantContainer.querySelectorAll('input');
    var diseases = form.querySelectorAll('.diseases_45');
    var diseasesNo = form.querySelector('.diseases_no_45');
    function updatePregnant() {
        var show = form.querySelector('#age_1_45').checked;
        pregnantContainer.style.display = show ? '' : 'none';
        pregnantInputs.forEach(function (input) {
            input.disabled = !show;
            input.required = show && input.id === 'pregnant_yes_45';
        });
    }
    ageInputs.forEach(function (input) {
        input.addEventListener('change', updatePregnant);
    });
    function updateDiseases() {
        var checked = form.querySelectorAll('.diseases_45:checked').length;
        diseases.forEach(function (input) {
            if (input !== diseasesNo) {
                input.disabled = diseasesNo.checked;
                if (diseasesNo.checked) {
                    input.checked = false;
                }
            }
        });
        diseases[0].required = !diseasesNo.checked && checked === 0;
    }
    diseases.forEach(function (input) {
        input.addEventListener('change', updateDiseases);
    });
    diseasesNo.addEventListener('change', updateDiseases);
    updatePregnant();
    updateDiseases();
    form.addEventListener('submit', function (event) {
        event.preventDefault();
        var html = [];
        var count = 0;
        var fields = [
            'age',
            'overweight',
            'pregnant',
            'therapy',
            'working',
            'contact',
            'country'
        ];
        fields.forEach(function (name) {
            var selected = form.querySelector('input[name="' + name + '"]:checked');
            if (selected && selected.value !== 'false') {
                html.push('<li>' + selected.value + '</li>');
                count++;
            }
        });
        if (!diseasesNo.checked) {
            form.querySelectorAll('.diseases_45:checked').forEach(function (input) {
                html.push('<li>' + input.value + '</li>');
                count++;
            });
        }
        var title = document.getElementById('result_title_45');
        var result = document.getElementById('result_list_45');
        var container = document.getElementById('stroke_result_45');
        if (count > 0) {
            title.textContent = 'Bạn có ' + count +
                ' yếu tố nguy cơ cao nhiễm virus cúm H1N1:';
            result.innerHTML = html.join('');
        } else {
            title.textContent =
                'Xin chúc mừng!! Bạn không có yếu tố nguy cơ cao nhiễm virus cúm H1N1 nào cả.';
            result.innerHTML = '';
        }
        container.style.display = 'block';
    });
})();
</script>
