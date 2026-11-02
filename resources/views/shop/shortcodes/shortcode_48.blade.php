
<style>
    .shortcode-48 {
        width: 100%;
        margin: 15px 0;
        font-family: Arial, sans-serif;
    }

    .shortcode-48 table {
        border-collapse: collapse;
        width: 100%;
        background: #ebf3f4;
        border: 1px solid #ddd;
        border-bottom: 2px solid #187681;
        box-shadow: 0 0 20px rgba(0, 0, 0, .1);
    }

    .shortcode-48 table td,
    .shortcode-48 table th {
        border: 1px solid #fff;
        padding: 10px;
    }

    .shortcode-48 table th {
        background: #187681;
        color: #fff;
        text-align: left;
    }

    .shortcode-48 table td {
        color: #000;
    }

    .shortcode-48 input[type="number"] {
        max-width: 120px;
        width: 100%;
        min-height: 32px;
        padding: 5px;
        border: 1px solid #ccc;
        background: #fff;
        box-sizing: border-box;
    }

    .shortcode-48 input[type="radio"] {
        margin-left: 10px;
        margin-right: 5px;
    }

    .shortcode-48 .mandatory-star,
    .shortcode-48 .required {
        color: #c00;
    }

    .shortcode-48 .flat-btn {
        cursor: pointer;
        margin: 10px;
        background: #187681;
        border: 0;
        border-radius: 3px;
        color: #fff;
        font-size: 15px;
        padding: 10px 25px;
    }

    .shortcode-48 .flat-btn:hover {
        background: #125c64;
        color: #fff;
    }

    .shortcode-48 .result-container {
        margin-top: 12px;
    }

    .shortcode-48 .result-container table {
        background: #fff;
        border: 2px solid #187681;
    }

    .shortcode-48 .result-container th {
        background: #187681;
        color: #fff;
    }

    .shortcode-48 .result-container td {
        background: #ebf3f4;
        padding: 12px;
    }

    .shortcode-48 .result-text {
        color: #187681;
        font-weight: bold;
    }

    @media (max-width: 576px) {
        .shortcode-48 table td {
            padding: 8px;
        }

        .shortcode-48 .flat-btn {
            margin: 5px;
        }
    }
</style>

<div class="shortcode-48">
    <div class="calculator-table-form blue">

        <form class="health-form-48">
            <table>
                <thead>
                    <tr>
                        <th colspan="2">Đo lường nguy cơ loãng xương</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td>
                            <label>Tuổi <span class="mandatory-star">*</span></label>
                        </td>
                        <td>
                            <input type="number"
                                   name="age"
                                   min="0"
                                   max="200"
                                   required>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>Cân nặng (Kg)
                                <span class="mandatory-star">*</span>
                            </label>
                        </td>
                        <td>
                            <input type="number"
                                   name="weight"
                                   min="10"
                                   max="200"
                                   step="any"
                                   required>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                Bạn có uống thuốc chứa estrogen không?
                                <span class="mandatory-star">*</span>
                                <br>
                                (Ví dụ: thuốc tránh thai hoặc hormon thay thế)
                            </label>
                        </td>
                        <td>
                            <input type="radio" value="1"
                                   name="estrogen" required>
                            <label>Có</label>

                            <input type="radio" value="0"
                                   name="estrogen">
                            <label>Không</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                Bạn có mắc bệnh viêm khớp dạng thấp không?
                                <span class="mandatory-star">*</span>
                            </label>
                        </td>
                        <td>
                            <input type="radio" value="4"
                                   name="polyarthritis" required>
                            <label>Có</label>

                            <input type="radio" value="0"
                                   name="polyarthritis">
                            <label>Không</label>
                        </td>
                    </tr>

                    <tr>
                        <td>
                            <label>
                                Tiền sử gãy xương
                                <span class="mandatory-star">*</span>
                            </label>
                        </td>
                        <td>
                            <div>
                                <input type="radio" value="0"
                                       name="fracture" required>
                                <label>Không</label>
                            </div>

                            <div>
                                <input type="radio" value="4"
                                       name="fracture">
                                <label>Gãy 1 vị trí</label>
                            </div>

                            <div>
                                <input type="radio" value="8"
                                       name="fracture">
                                <label>Gãy 2 vị trí</label>
                            </div>

                            <div>
                                <input type="radio" value="12"
                                       name="fracture">
                                <label>Gãy 3 vị trí trở lên</label>
                            </div>
                        </td>
                    </tr>

                    <tr>
                        <td colspan="2" style="text-align:center">
                            <span class="required">* Bắt buộc</span>

                            <button type="submit" class="flat-btn">
                                Tính toán
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </form>

    </div>

    <div class="result-container" style="display:none">
        <table>
            <thead>
                <tr>
                    <th>Kết quả</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <b>Kết quả:</b>
                        <span class="result-text"></span>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

<script>
(function () {
    var scripts = document.currentScript;
    var root = scripts.previousElementSibling;

    if (!root || !root.classList.contains('shortcode-48')) {
        return;
    }

    var form = root.querySelector('.health-form-48');

    if (!form || form.dataset.initialized) {
        return;
    }

    form.dataset.initialized = '1';

    form.addEventListener('submit', function (event) {
        event.preventDefault();

        var data = new FormData(form);

        var age = parseFloat(data.get('age'));
        var weight = parseFloat(data.get('weight'));
        var estrogen = parseInt(data.get('estrogen'), 10);
        var polyarthritis = parseInt(data.get('polyarthritis'), 10);
        var fracture = parseInt(data.get('fracture'), 10);

        var point = polyarthritis
            + fracture
            + estrogen
            + 0.3 * age
            + weight * 0.22;

        var result = '';

        if (point <= 6) {
            result = 'Nguy cơ thấp';
        } else if (point >= 7 && point <= 15) {
            result = 'Nguy cơ trung bình';
        } else if (point >= 16) {
            result = 'Nguy cơ cao';
        }

        root.querySelector('.result-text').textContent =
            result + ' (Điểm: ' + point.toFixed(2) + ')';

        root.querySelector('.result-container').style.display = 'block';
    });
})();
</script>