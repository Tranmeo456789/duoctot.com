<div id="shortcode-120" class="sc120">
    <style>
        #shortcode-120 {
            font-size: 14px;
            color: #222;
            width: 100%;
        }
        #shortcode-120 * { box-sizing: border-box; }
        #shortcode-120 .sc120-form {
            background: #ebf3f4;
            border: 1px solid #eee;
            border-bottom: 3px solid #187681;
            box-shadow: 0 0 20px rgba(0,0,0,.07);
            border-radius: 4px;
            padding: 12px;
        }
        #shortcode-120 table {
            width: 100%;
            border-collapse: collapse;
            margin: 0;
        }
        #shortcode-120 td {
            border: 1px solid #fff;
            padding: 10px;
            vertical-align: middle;
        }
        #shortcode-120 .sc120-heading {
            background: #187681;
            color: #fff;
            font-weight: 600;
        }
        #shortcode-120 input[type="text"] {
            width: 100%;
            max-width: 220px;
            min-height: 36px;
            border: 1px solid #ccc;
            padding: 6px 9px;
            border-radius: 3px;
            background: #fff;
        }
        #shortcode-120 input[type="radio"] {
            margin-right: 4px;
        }
        #shortcode-120 .sc120-btn {
            display: inline-block;
            padding: 11px 22px;
            border: 0;
            border-radius: 4px;
            background: #187681;
            color: #fff !important;
            cursor: pointer;
            font-size: 14px;
            margin: 8px 0;
        }
        #shortcode-120 .sc120-btn:hover {
            background: #125d65;
        }
        #shortcode-120 .sc120-required {
            color: #e45b00;
        }
        #shortcode-120 .sc120-error {
            color: #c00;
            display: none;
            padding: 8px 0;
        }
        #shortcode-120 .sc120-result {
            display: none;
            margin-top: 20px;
            border-radius: 4px;
            overflow: hidden;
            background: #fff;
            border: 1px solid #d9e6eb;
        }
        #shortcode-120 .sc120-result-title {
            background: #187681;
            color: #fff;
            padding: 13px 15px;
            font-size: 18px;
            font-weight: 600;
        }
        #shortcode-120 .sc120-result-inner {
            padding: 15px;
        }
        #shortcode-120 .sc120-group {
            display: none;
        }
        #shortcode-120 .sc120-tabs {
            display: flex;
            flex-direction: column;
            gap: 3px;
        }
        #shortcode-120 .sc120-tab {
            display: block;
            width: 100%;
            text-align: left;
            padding: 10px;
            background: #fff;
            border: 1px solid #e4e9ed;
            border-radius: 3px;
            color: #176a9a;
            cursor: pointer;
            font-size: 14px;
            line-height: 1.5;
        }
        #shortcode-120 .sc120-tab.active {
            color: #663300;
            background: #e6f4fe;
            border-color: #b8d9ef;
            font-weight: 600;
        }
        #shortcode-120 .sc120-content {
            background: #e6f4fe;
            border-radius: 4px;
            padding: 15px;
            line-height: 1.7;
            text-align: justify;
            min-height: 200px;
        }
        #shortcode-120 .sc120-content strong {
            color: #663300;
        }
        #shortcode-120 .sc120-layout {
            display: grid;
            grid-template-columns: minmax(180px, 30%) minmax(0, 70%);
            gap: 12px;
        }
        #shortcode-120 .sc120-tips {
            display: none;
            margin-top: 20px;
            line-height: 1.7;
            padding: 15px;
            background: #f6f9fa;
            border-left: 3px solid #187681;
            border-radius: 3px;
        }
        #shortcode-120 .sc120-tips h3 {
            margin: 0 0 10px;
            font-size: 18px;
        }
        #shortcode-120 .sc120-tips p {
            margin: 0 0 10px;
        }
        #shortcode-120 .sc120-note {
            margin-top: 15px;
            font-size: 13px;
            color: #555;
            line-height: 1.6;
        }
        @media(max-width: 650px) {
            #shortcode-120 .sc120-form td {
                padding: 8px 6px;
            }
            #shortcode-120 .sc120-layout {
                grid-template-columns: 1fr;
            }
            #shortcode-120 .sc120-tabs {
                display: grid;
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }
            #shortcode-120 .sc120-content {
                min-height: 0;
            }
        }
    </style>

    <div class="sc120-form">
        <form class="sc120-input-form">
            <table>
                <tbody>
                    <tr class="sc120-heading">
                        <td colspan="2">Chọn chi tiết của bạn ở đây</td>
                    </tr>
                    <tr>
                        <td width="50%">
                            Hướng dẫn sàng lọc sức khỏe cho
                            <span class="sc120-required">*</span>
                        </td>
                        <td width="50%">
                            <label>
                                <input type="radio" name="sc120_hsgfor" value="1">
                                Trẻ sơ sinh
                            </label>
                            <br><br>
                            <label>
                                <input type="radio" name="sc120_hsgfor" value="2">
                                Trẻ em
                            </label>
                            <br><br>
                            <label>
                                <input type="radio" name="sc120_hsgfor" value="3" checked>
                                Người lớn
                            </label>
                        </td>
                    </tr>
                    <tr>
                        <td>Giới tính <span class="sc120-required">*</span></td>
                        <td>
                            <label>
                                <input type="radio" name="sc120_sex" value="b" checked>
                                Nam
                            </label>
                            &nbsp;&nbsp;
                            <label>
                                <input type="radio" name="sc120_sex" value="g">
                                Nữ
                            </label>
                        </td>
                    </tr>
                    <tr class="sc120-age-row">
                        <td>Tuổi <span class="sc120-required">*</span></td>
                        <td>
                            <input type="text" class="sc120-age" maxlength="2"
                                   inputmode="numeric" placeholder="Nhập tuổi">
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" style="text-align:center;">
                            <span class="sc120-required">* Yêu cầu</span>
                            <br>
                            <button type="submit" class="sc120-btn">Tính toán</button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="sc120-error"></div>
        </form>
    </div>

    <div class="sc120-result">
        <div class="sc120-result-title">Hướng dẫn sàng lọc sức khỏe</div>
        <div class="sc120-result-inner">
            <div class="sc120-result-info"></div>

            <!-- Người lớn -->
            <div class="sc120-group" data-group="3">
                <div class="sc120-layout">
                    <div class="sc120-tabs">
                        <button type="button" class="sc120-tab active" data-content="adult1">Huyết áp</button>
                        <button type="button" class="sc120-tab" data-content="adult2">Cholesterol</button>
                        <button type="button" class="sc120-tab" data-content="adult3">Ung thư đại trực tràng</button>
                        <button type="button" class="sc120-tab" data-content="adult4">Cân nặng</button>
                        <button type="button" class="sc120-tab" data-content="adult5">Kiểm tra mắt</button>
                        <button type="button" class="sc120-tab" data-content="adult6">Chăm sóc răng miệng</button>
                    </div>

                    <div class="sc120-content">
                        <div data-content-panel="adult1">
                            <strong>Khi nào nên được tiến hành?</strong><br><br>
                            Người trên 18 tuổi được khuyến cáo kiểm tra huyết áp mỗi 2 năm nếu huyết áp bình thường (120/80 mmHg) và ít nhất mỗi 3 tháng nếu cao huyết áp (149/90 mmHg).
                            <br><br>
                            <strong>Kiểm tra những gì và làm thế nào để tiến hành?</strong><br><br>
                            Huyết áp được kiểm tra bằng cách sử dụng thiết bị gọi là máy đo huyết áp. Nó có một bao đo quấn quanh cánh tay của bệnh nhân và một ống nghe đặt trên đường đi của động mạch cánh tay. Áp lực ở bao đo tăng lên đến khi nghe được nhịp đập đầu tiên và sau đó áp lực giảm dần đến khi không nghe thấy tiếng đó nữa. Điểm nghe thấy tiếng đập đầu tiên là huyết áp tâm thu (khi tim co bóp), điểm mất tiếng đập là huyết áp tâm trương (khi tim nghỉ).
                            <br><br>
                            <strong>Tại sao chúng ta nên kiểm tra?</strong><br><br>
                            Tăng huyết áp thường không có triệu chứng cho đến khi xuất hiện biến chứng như đột quỵ, đau tim, suy tim hoặc suy thận. Sàng lọc giúp phát hiện sớm và kiểm soát huyết áp bằng thuốc, chế độ ăn và thay đổi lối sống.
                        </div>

                        <div data-content-panel="adult2" style="display:none;">
                            <strong>Khi nào nên được tiến hành?</strong><br><br>
                            Khuyến cáo người lớn trên 20 tuổi nên sàng lọc cholesterol mỗi 5 năm và thường xuyên hơn ở độ tuổi ngoài 35 tuổi. Những người có nguy cơ tim mạch, hút thuốc, huyết áp cao, béo phì hoặc tiểu đường nên kiểm tra sớm hơn.
                            <br><br>
                            <strong>Kiểm tra những gì và làm thế nào để tiến hành?</strong><br><br>
                            Xét nghiệm máu kiểm tra cholesterol toàn phần, triglycerid, HDL và LDL cholesterol được thực hiện để đánh giá lượng mỡ trong máu. Việc nhịn ăn trước xét nghiệm tùy theo chỉ định của bác sĩ.
                            <br><br>
                            <strong>Tại sao chúng ta nên kiểm tra?</strong><br><br>
                            Lượng lipid dư thừa trong thành mạch có thể cản trở dòng máu tới các cơ quan quan trọng như tim và não, làm tăng nguy cơ đau tim và đột quỵ.
                        </div>

                        <div data-content-panel="adult3" style="display:none;">
                            <strong>Khi nào nên được tiến hành?</strong><br><br>
                            Nội dung gốc khuyến cáo mọi người ngoài 50 tuổi nên sàng lọc ung thư đại trực tràng. Người có nguy cơ cao cần trao đổi với bác sĩ để được tư vấn thời điểm bắt đầu sàng lọc phù hợp.
                            <br><br>
                            <strong>Kiểm tra những gì và làm thế nào để tiến hành?</strong><br><br>
                            Có nhiều xét nghiệm sàng lọc ung thư đại trực tràng, ví dụ nội soi đại tràng, thụt bari đối quang kép và xét nghiệm phân. Bác sĩ sẽ tư vấn phương pháp phù hợp. Tần suất sàng lọc phụ thuộc vào loại xét nghiệm và nguy cơ của mỗi người.
                            <br><br>
                            <strong>Tại sao chúng ta nên kiểm tra?</strong><br><br>
                            Ung thư đại trực tràng là một trong những loại ung thư phổ biến. Sàng lọc giúp phát hiện sớm những bất thường và tổn thương ở đại tràng, trực tràng.
                        </div>

                        <div data-content-panel="adult4" style="display:none;">
                            <strong>Khi nào nên được tiến hành?</strong><br><br>
                            Chỉ số khối cơ thể (BMI) có thể được kiểm tra định kỳ để theo dõi tình trạng cân nặng.
                            <br><br>
                            <strong>Kiểm tra những gì và làm thế nào để tiến hành?</strong><br><br>
                            BMI là công cụ sử dụng cân nặng và chiều cao để ước tính tình trạng cân nặng. Theo phân loại dành cho người châu Á được nêu trong nội dung gốc, BMI dưới 18.5 là thiếu cân; 18.5–22.9 là bình thường; từ 23 là thừa cân và từ 25 là béo phì.
                            <br><br>
                            <strong>Tại sao chúng ta nên kiểm tra?</strong><br><br>
                            Thừa cân và béo phì làm tăng nguy cơ mắc các bệnh tim mạch, tiểu đường và huyết áp cao. Theo dõi BMI giúp nhận biết tình trạng cân nặng, nhưng BMI không thay thế đánh giá sức khỏe toàn diện.
                        </div>

                        <div data-content-panel="adult5" style="display:none;">
                            <strong>Khi nào nên được tiến hành?</strong><br><br>
                            Việc kiểm tra mắt nên được thực hiện định kỳ theo khuyến cáo của bác sĩ chuyên khoa mắt.
                            <br><br>
                            <strong>Kiểm tra những gì và làm thế nào để tiến hành?</strong><br><br>
                            Bác sĩ chuyên khoa mắt kiểm tra các tật khúc xạ như cận thị, viễn thị, nhãn áp, tầm nhìn ngoại vi, nhận thức màu sắc, chuyển động nhãn cầu và tình trạng nhiễm trùng mắt. Quy trình có thể khác nhau tùy tình trạng của bệnh nhân.
                            <br><br>
                            <strong>Tại sao chúng ta nên kiểm tra?</strong><br><br>
                            Khám mắt giúp phát hiện sớm các bất thường và bệnh lý về mắt, từ đó hỗ trợ điều trị kịp thời.
                        </div>

                        <div data-content-panel="adult6" style="display:none;">
                            <strong>Khi nào nên được tiến hành?</strong><br><br>
                            Nên gặp nha sĩ kiểm tra mỗi 6 tháng hoặc theo lời khuyên của bác sĩ.
                            <br><br>
                            <strong>Kiểm tra những gì và làm thế nào để tiến hành?</strong><br><br>
                            Nha sĩ tìm kiếm dấu hiệu bệnh lý răng miệng và sâu răng, làm sạch răng và lợi, đồng thời có thể khám miệng và vùng cổ.
                            <br><br>
                            <strong>Tại sao chúng ta nên kiểm tra?</strong><br><br>
                            Kiểm tra răng miệng thường xuyên giúp phát hiện sớm các vấn đề về răng miệng và sâu răng, hỗ trợ điều trị hiệu quả và giữ răng sạch khỏe.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trẻ sơ sinh -->
            <div class="sc120-group" data-group="1">
                <div class="sc120-layout">
                    <div class="sc120-tabs">
                        <button type="button" class="sc120-tab active" data-content="baby1">Khám thể chất</button>
                        <button type="button" class="sc120-tab" data-content="baby2">Kiểm tra thính lực</button>
                        <button type="button" class="sc120-tab" data-content="baby3">Kiểm tra bệnh tim</button>
                        <button type="button" class="sc120-tab" data-content="baby4">Xét nghiệm máu gót chân</button>
                        <button type="button" class="sc120-tab" data-content="baby5">Kiểm tra mắt</button>
                    </div>

                    <div class="sc120-content">
                        <div data-content-panel="baby1">
                            <strong>Khi nào nên được tiến hành?</strong><br><br>
                            Khám bác sĩ trong vòng 3 ngày và tái khám trong 6–7 tuần sau sinh.
                            <br><br>
                            <strong>Kiểm tra những gì và làm thế nào để tiến hành?</strong><br><br>
                            Khám tổng thể từ đầu đến chân cần tiến hành cho bé càng sớm càng tốt sau sinh để phát hiện các bất thường thể chất. Mắt trẻ được kiểm tra xem có đục thủy tinh thể không; kiểm tra lồng ngực, nhịp thở, bụng, khớp hông, gót chân và các ngón chân. Trẻ nam được kiểm tra cơ quan sinh dục và vị trí lỗ tiểu.
                            <br><br>
                            <strong>Tại sao chúng ta nên kiểm tra?</strong><br><br>
                            Khám sức khỏe tổng quát giúp đánh giá tình trạng sức khỏe của em bé và phát hiện những bất thường cần theo dõi hoặc điều trị.
                        </div>

                        <div data-content-panel="baby2" style="display:none;">
                            <strong>Khi nào nên được tiến hành?</strong><br><br>
                            Các xét nghiệm sàng lọc thính lực ở trẻ sơ sinh nên được thực hiện trong vòng 1 tháng sau sinh.
                            <br><br>
                            <strong>Kiểm tra những gì và làm thế nào để tiến hành?</strong><br><br>
                            Phản xạ âm ốc tai (OAE) là âm thanh được tạo ra trong tai có chức năng bình thường. Một đầu dò được đưa vào ống tai của em bé, phát ra kích thích âm thanh nhỏ và thu nhận phản hồi từ tai.
                            <br><br>
                            Phản ứng thân não thính giác (ABR) có thể được thực hiện ở những trẻ không đạt thử nghiệm OAE. Âm thanh được truyền vào tai trẻ thông qua tai nghe và phản ứng được ghi nhận bằng các điện cực đặt trên đầu.
                            <br><br>
                            <strong>Tại sao chúng ta nên kiểm tra?</strong><br><br>
                            Phát hiện mất thính lực sớm ở trẻ sơ sinh giúp hạn chế các vấn đề về phát âm và cải thiện chất lượng cuộc sống khi trẻ lớn lên.
                        </div>

                        <div data-content-panel="baby3" style="display:none;">
                            <strong>Khi nào nên được tiến hành?</strong><br><br>
                            Trẻ sơ sinh nên được sàng lọc bệnh tim trong vòng 2 ngày sau sinh.
                            <br><br>
                            <strong>Kiểm tra những gì và làm thế nào để tiến hành?</strong><br><br>
                            Tim trẻ được kiểm tra các dị tật tim bẩm sinh và rối loạn khác bằng phương pháp đo độ bão hòa oxy qua mạch đập. Phương pháp này có thể phát hiện một số bất thường trước khi trẻ có biểu hiện bệnh.
                            <br><br>
                            <strong>Tại sao chúng ta nên kiểm tra?</strong><br><br>
                            Phát hiện sớm bệnh tim bẩm sinh giúp bác sĩ đánh giá và đưa ra phương pháp theo dõi hoặc điều trị phù hợp.
                        </div>

                        <div data-content-panel="baby4" style="display:none;">
                            <strong>Khi nào nên được tiến hành?</strong><br><br>
                            Xét nghiệm sàng lọc máu gót chân cho trẻ sơ sinh thường được thực hiện trong những ngày đầu sau sinh theo hướng dẫn của cơ sở y tế.
                            <br><br>
                            <strong>Kiểm tra những gì và làm thế nào để tiến hành?</strong><br><br>
                            Máu lấy từ gót chân trẻ được dùng làm mẫu xét nghiệm để phát hiện một số bệnh lý. Các tình trạng được kiểm tra phụ thuộc vào chương trình sàng lọc tại địa phương.
                            <br><br>
                            Một số bệnh có thể được sàng lọc gồm:
                            <br>1. Phenylketonuria (PKU): rối loạn chuyển hóa phenylalanine.
                            <br>2. Bệnh hồng cầu hình liềm: rối loạn di truyền ảnh hưởng đến hồng cầu.
                            <br>3. Tăng sản tuyến thượng thận bẩm sinh: rối loạn sản xuất hormone tuyến thượng thận.
                            <br>4. Homocystinuria: rối loạn chuyển hóa axit amin.
                            <br>5. Galactosemia: rối loạn chuyển hóa galactose.
                            <br>6. Thiếu hụt biotinidase: rối loạn chuyển hóa biotin.
                            <br>7. Bệnh nước tiểu mùi si-rô cây phong (MSUD): rối loạn chuyển hóa axit amin.
                            <br>8. Suy giáp bẩm sinh: tình trạng thiếu hormone tuyến giáp.
                            <br><br>
                            <strong>Tại sao chúng ta nên kiểm tra?</strong><br><br>
                            Một số trẻ mắc bệnh chuyển hóa có thể trông khỏe mạnh lúc mới sinh. Sàng lọc và phát hiện sớm giúp trẻ được đánh giá, điều trị hoặc theo dõi kịp thời.
                        </div>

                        <div data-content-panel="baby5" style="display:none;">
                            Nên đưa trẻ đi kiểm tra mắt định kỳ theo khuyến cáo của bác sĩ nhi khoa hoặc bác sĩ chuyên khoa mắt.
                        </div>
                    </div>
                </div>
            </div>

            <!-- Trẻ em -->
            <div class="sc120-group" data-group="2">
                <div class="sc120-layout">
                    <div class="sc120-tabs">
                        <button type="button" class="sc120-tab active" data-content="child1">Chiều cao và cân nặng</button>
                        <button type="button" class="sc120-tab" data-content="child2">Thính giác</button>
                        <button type="button" class="sc120-tab" data-content="child3">Thị lực</button>
                        <button type="button" class="sc120-tab" data-content="child4">Khám nha khoa</button>
                    </div>

                    <div class="sc120-content">
                        <div data-content-panel="child1">
                            <strong>Khi nào nên được tiến hành?</strong><br><br>
                            Tất cả trẻ em nên được kiểm tra chiều cao và cân nặng định kỳ.
                            <br><br>
                            <strong>Kiểm tra những gì và làm thế nào để tiến hành?</strong><br><br>
                            Bác sĩ có thể cân, đo chiều cao cho trẻ và so sánh với biểu đồ tăng trưởng phù hợp với độ tuổi và giới tính. Sử dụng công cụ tính BMI cho trẻ có thể giúp ích. BMI của trẻ cần được đánh giá theo biểu đồ tăng trưởng theo tuổi và giới tính, không áp dụng trực tiếp ngưỡng BMI người lớn.
                            <br><br>
                            <strong>Tại sao chúng ta nên kiểm tra?</strong><br><br>
                            Theo dõi chiều cao và cân nặng giúp nhận biết sớm các vấn đề về tăng trưởng và dinh dưỡng, từ đó có hướng tư vấn phù hợp.
                        </div>

                        <div data-content-panel="child2" style="display:none;">
                            <strong>Khi nào nên được tiến hành?</strong><br><br>
                            Đánh giá thính lực nên được tiến hành càng sớm càng tốt. Trẻ bắt đầu tới trường từ 3–5 tuổi nên được kiểm tra thính lực. Trẻ sinh non, có thai kỳ phức tạp, tăng bilirubin khi sinh, nằm NICU kéo dài, nhiễm trùng tai hoặc có tiền sử gia đình mất thính lực cần được chú ý.
                            <br><br>
                            <strong>Kiểm tra những gì và làm thế nào để tiến hành?</strong><br><br>
                            Khám sức khỏe được thực hiện để kiểm tra các vấn đề trong tai như tích tụ ráy tai, nhiễm trùng và dị vật. Trẻ có thể được yêu cầu kiểm tra phản ứng thân não thính giác (ABR). Trong ABR, kích thích âm thanh được truyền vào tai và phản ứng được ghi nhận bằng các điện cực.
                            <br><br>
                            <strong>Tại sao chúng ta nên kiểm tra?</strong><br><br>
                            Phát hiện sớm tình trạng mất thính lực có thể hạn chế các vấn đề xã hội, tình cảm và học tập. Can thiệp sớm có thể giúp cải thiện kết quả phát triển của trẻ.
                        </div>

                        <div data-content-panel="child3" style="display:none;">
                            <strong>Khi nào nên được tiến hành?</strong><br><br>
                            Kiểm tra mắt nên được thực hiện trong độ tuổi từ 2–5 tuổi và định kỳ theo khuyến cáo của bác sĩ.
                            <br><br>
                            <strong>Kiểm tra những gì và làm thế nào để tiến hành?</strong><br><br>
                            Bác sĩ chuyên khoa mắt kiểm tra các tật khúc xạ như cận thị, viễn thị, nhãn áp, thị lực ngoại vi, nhận thức màu sắc, chuyển động nhãn cầu và tình trạng nhiễm trùng mắt.
                            <br><br>
                            <strong>Tại sao chúng ta nên kiểm tra?</strong><br><br>
                            Khám mắt giúp phát hiện sớm các bất thường về mắt, hỗ trợ điều trị và lựa chọn kính phù hợp nếu trẻ có tật khúc xạ.
                        </div>

                        <div data-content-panel="child4" style="display:none;">
                            <strong>Khi nào nên được tiến hành?</strong><br><br>
                            Hãy đưa trẻ đi khám răng định kỳ 6 tháng một lần hoặc theo khuyến cáo của bác sĩ.
                            <br><br>
                            <strong>Kiểm tra những gì và làm thế nào để tiến hành?</strong><br><br>
                            Nha sĩ tìm kiếm dấu hiệu bất thường, bệnh lý răng miệng và sâu răng. Nha sĩ cũng làm sạch răng và lợi, đồng thời có thể kiểm tra miệng và cổ.
                            <br><br>
                            <strong>Tại sao chúng ta nên kiểm tra?</strong><br><br>
                            Khám răng định kỳ giúp phát hiện sớm các dấu hiệu bệnh lý răng miệng và hỗ trợ điều trị hiệu quả, đồng thời giúp chăm sóc răng sữa ở trẻ em.
                        </div>
                    </div>
                </div>
            </div>

            <div class="sc120-note">
                <strong>Lưu ý:</strong> Đây là nội dung tham khảo, không thay thế việc khám và tư vấn trực tiếp của bác sĩ. Thời điểm và phương pháp sàng lọc có thể khác nhau tùy độ tuổi, tiền sử bệnh, yếu tố nguy cơ và hướng dẫn chuyên môn hiện hành.
            </div>

            <div class="sc120-tips">
                <h3>Các mẹo ngăn ngừa bệnh tật</h3>
                <p>Hãy chắc chắn rằng bạn tiêm vắc xin đúng lịch theo hướng dẫn của cơ sở y tế. Hệ miễn dịch giúp cơ thể phòng ngừa nhiều bệnh tật.</p>
                <p>Hãy tập thể dục và duy trì cân nặng hợp lý. Béo phì là một yếu tố nguy cơ của nhiều bệnh tim mạch. Duy trì chế độ ăn uống phù hợp giúp nâng cao sức khỏe.</p>
                <p>Tránh hút thuốc và hạn chế đồ uống có cồn. Những thói quen này có thể ảnh hưởng tiêu cực đến sức khỏe lâu dài.</p>
                <p>Nếu có quan hệ tình dục, hãy sử dụng biện pháp bảo vệ để phòng tránh các bệnh lây truyền qua đường tình dục và thực hiện sàng lọc khi cần thiết.</p>
                <p>Phụ nữ chuẩn bị mang thai hoặc đang mang thai nên trao đổi với bác sĩ về việc bổ sung vitamin B12, axit folic và các vi chất cần thiết.</p>
                <p>Kiểm tra sức khỏe định kỳ giúp phát hiện sớm các vấn đề sức khỏe và hỗ trợ chăm sóc sức khỏe lâu dài.</p>
            </div>
        </div>
    </div>

    <script>
        (function () {
            'use strict';

            function initShortcode120() {
                var root = document.getElementById('shortcode-120');

                if (!root || root.getAttribute('data-sc120-ready') === '1') {
                    return;
                }

                var form = root.querySelector('.sc120-input-form');
                var ageRow = root.querySelector('.sc120-age-row');
                var ageInput = root.querySelector('.sc120-age');
                var errorBox = root.querySelector('.sc120-error');
                var result = root.querySelector('.sc120-result');
                var tips = root.querySelector('.sc120-tips');

                if (!form || !result || !tips || !errorBox || !ageInput || !ageRow) {
                    return;
                }

                root.setAttribute('data-sc120-ready', '1');

                // Ẩn kết quả ngay khi tải trang.
                result.style.display = 'none';
                tips.style.display = 'none';

                function selectedValue(name) {
                    var checked = root.querySelector('input[name="' + name + '"]:checked');
                    return checked ? checked.value : '';
                }

                function showError(message, focusElement) {
                    errorBox.textContent = message;
                    errorBox.style.display = 'block';

                    if (focusElement) {
                        focusElement.focus();
                    }
                }

                function updateAgeVisibility() {
                    var group = selectedValue('sc120_hsgfor');

                    if (group === '1') {
                        ageRow.style.display = 'none';
                        ageInput.value = '';
                    } else {
                        ageRow.style.display = '';
                    }
                }

                // Ẩn/hiện trường tuổi theo đối tượng.
                root.addEventListener('change', function (event) {
                    if (event.target && event.target.name === 'sc120_hsgfor') {
                        updateAgeVisibility();
                    }
                });

                // Chỉ cho nhập số tuổi.
                ageInput.addEventListener('input', function () {
                    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 2);
                });

                // Xử lý chuyển tab.
                root.addEventListener('click', function (event) {
                    var tab = event.target.closest('.sc120-tab');

                    if (!tab || !root.contains(tab)) {
                        return;
                    }

                    event.preventDefault();

                    var groupElement = tab.closest('.sc120-group');

                    if (!groupElement) {
                        return;
                    }

                    var contentId = tab.getAttribute('data-content');
                    var tabs = groupElement.querySelectorAll('.sc120-tab');
                    var panels = groupElement.querySelectorAll('[data-content-panel]');

                    for (var i = 0; i < tabs.length; i++) {
                        tabs[i].classList.remove('active');
                    }

                    tab.classList.add('active');

                    for (var j = 0; j < panels.length; j++) {
                        panels[j].style.display =
                            panels[j].getAttribute('data-content-panel') === contentId
                                ? ''
                                : 'none';
                    }
                });

                // Xử lý nút Tính toán.
                form.addEventListener('submit', function (event) {
                    event.preventDefault();
                    event.stopPropagation();

                    errorBox.style.display = 'none';
                    errorBox.textContent = '';

                    var group = selectedValue('sc120_hsgfor');
                    var sex = selectedValue('sc120_sex');
                    var ageValue = ageInput.value.trim();
                    var age = parseInt(ageValue, 10);

                    if (group !== '1' && group !== '2' && group !== '3') {
                        showError('Bạn chưa chọn đối tượng sàng lọc sức khỏe.');
                        return;
                    }

                    if (group === '2' || group === '3') {
                        if (!ageValue) {
                            showError('Vui lòng nhập tuổi!', ageInput);
                            return;
                        }

                        if (!/^\d+$/.test(ageValue)) {
                            showError('Tuổi phải là số nguyên hợp lệ!', ageInput);
                            return;
                        }

                        if (group === '2' && (age < 1 || age > 17)) {
                            showError('Hướng dẫn kiểm tra sức khỏe cho trẻ em dành cho người từ 1–17 tuổi!', ageInput);
                            return;
                        }

                        if (group === '3' && (age < 18 || age > 99)) {
                            showError('Hướng dẫn kiểm tra sức khỏe cho người lớn dành cho người từ 18–99 tuổi!', ageInput);
                            return;
                        }
                    }

                    if (sex !== 'b' && sex !== 'g') {
                        showError('Bạn chưa chọn giới tính!');
                        return;
                    }

                    var groupName = group === '1'
                        ? 'Trẻ sơ sinh'
                        : (group === '2' ? 'Trẻ em' : 'Người lớn');

                    var sexName = sex === 'b' ? 'Nam' : 'Nữ';
                    var info = root.querySelector('.sc120-result-info');

                    info.innerHTML = '';

                    var p1 = document.createElement('p');
                    var strong1 = document.createElement('strong');

                    strong1.textContent = 'Đối tượng: ';
                    p1.appendChild(strong1);
                    p1.appendChild(document.createTextNode(groupName));
                    info.appendChild(p1);

                    var p2 = document.createElement('p');
                    var strong2 = document.createElement('strong');

                    strong2.textContent = 'Giới tính: ';
                    p2.appendChild(strong2);
                    p2.appendChild(document.createTextNode(sexName));
                    info.appendChild(p2);

                    if (group !== '1') {
                        var p3 = document.createElement('p');
                        var strong3 = document.createElement('strong');

                        strong3.textContent = 'Tuổi: ';
                        p3.appendChild(strong3);
                        p3.appendChild(document.createTextNode(String(age)));
                        info.appendChild(p3);
                    }

                    // Ẩn toàn bộ nhóm trước khi hiển thị nhóm được chọn.
                    var allGroups = root.querySelectorAll('.sc120-group');

                    for (var k = 0; k < allGroups.length; k++) {
                        allGroups[k].style.display = 'none';
                    }

                    var activeGroup = root.querySelector(
                        '.sc120-group[data-group="' + group + '"]'
                    );

                    if (activeGroup) {
                        activeGroup.style.display = 'block';

                        var tabs = activeGroup.querySelectorAll('.sc120-tab');
                        var panels = activeGroup.querySelectorAll('[data-content-panel]');

                        for (var m = 0; m < tabs.length; m++) {
                            tabs[m].classList.toggle('active', m === 0);
                        }

                        for (var n = 0; n < panels.length; n++) {
                            panels[n].style.display = n === 0 ? '' : 'none';
                        }
                    }

                    // Chỉ hiện kết quả sau khi người dùng bấm Tính toán.
                    result.style.display = 'block';
                    tips.style.display = 'block';

                    result.scrollIntoView({
                        behavior: 'smooth',
                        block: 'start'
                    });
                });

                updateAgeVisibility();
            }

            // Đảm bảo script chạy được dù shortcode được tải trước hay sau DOM.
            if (document.readyState === 'loading') {
                document.addEventListener('DOMContentLoaded', initShortcode120);
            } else {
                initShortcode120();
            }
        })();
    </script>
</div>