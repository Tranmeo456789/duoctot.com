@extends('shop.layouts.frontend')

@section('content')
<div class="mt-3 wp-inner write-content-ai">
    <div class="row">
        <div class="d-none d-lg-block col-lg-3">
            <a href="#unit1"><h6>Chương 1</h6></a>
            <a href="#commont-info"><h6>2.1.Thông tin chung</h6></a>
            <a href="#login-register"><h6>2.2.Đăng ký - Đăng nhập</h6></a>
            <a href="#feauter-content"><h6>2.3.Tính năng nổi bật của Bard</h6></a>
            <a href="#chatgpt"><h6>3.ChatGPT</h6></a>
            <a href="#unit2"><h6>CHƯƠNG 2: Góc nhìn cá nhân về AI</h6></a>
        </div>
        <div class="col-12 col-lg-9">
            <h3 class="text-primary">AI CƠ BẢN: TỪ 0 ĐẾN 0.1 ĐỦ ĐỂ BẠN TIẾP CẬN VỚI AI</h3>
            <h5 class="text-primary" id="unit1">CHƯƠNG 1: Các AI miễn phí và hỗ trợ tốt cho việc tạo nội dung</h5>
            <h6 class="text-primary font-weight-bold">1.<a href="https://poe.com" target="_blank">Poe.com</a></h6>
            <div class="pl-1">
                <h6 class="text-info">1.1.Thông tin chung về Poe AI (<a href="https://poe.com" target="_blank">https://poe.com</a>)</h6>
                <p>-Poe - Fast, Helpful AI Chat là một nền tảng trò chuyện trực tuyến được trang bị trí tuệ nhân tạo mạnh mẽ.</p>
                <p>-Với Poe, bạn có thể trò chuyện với các chatbot AI đa năng để nhận được hỗ trợ và giải đáp các câu hỏi. Các chatbot trên Poe.com được đào tạo để cung cấp thông tin và giải quyết các vấn đề phổ biến trong nhiều lĩnh vực khác nhau.</p>
                <p>-Các ưu điểm của poe:
                <div>●Dễ dàng đăng ký với tài khoản Google hoặc Apple.</div>
                <div>●Sử dụng đa nền tảng: bạn có thể truy cập trực tiếp trên trình duyệt web hoặc tải app poe trên Appstore và CHplay để tiện sử dụng.</div>
                <div>●Có khá nhiều bot AI để bạn lựa chọn.</div>
                <div>●Có luôn lựa chọn miễn phí và trả phí tuỳ theo nhu cầu của bạn.</div>
                Tuy nhiên ý kiến cá nhân của mình vẫn thấy giao diện của poe vẫn khá tiếp cận với người mới.<span class="text-warning"> Để đơn giản nhất bạn chỉ cần tập trung vào các từ khoá “Explore”, “Your bots”, “All chats” để tiếp cận lúc đầu.</span>
                </p>
                <h6 class="text-info mt-2">1.2.Một số bot AI có thể sử dụng bước đầu trên poe AI</h6>
                <p>Tham khảo thêm tại: <a href="https://youtu.be/XJmibdHc1Sg?si=bXi5BCrNdlkZlpGp" target="_blank"> https://youtu.be/XJmibdHc1Sg?si=bXi5BCrNdlkZlpGp</a></p>
                <p class="font-weight-bold">Assistant:</p>
                <p>-Assistant là một chatbot AI trên nền tảng Poe.com. Nó được xây dựng trên kiến trúc GPT-3.5 của OpenAI, giúp nó có khả năng hiểu và tương tác với ngôn ngữ tự nhiên một cách thông minh. Assistant có thể trả lời các câu hỏi, cung cấp thông tin chung và hỗ trợ trong nhiều lĩnh vực khác nhau. Với khả năng tư duy logic và kiến thức phong phú, Assistant là một chatbot đáng tin cậy để tương tác và nhận thông tin hữu ích.</p>
                <p>-Assistant có ưu điểm hiểu được tiếng Việt để trao đổi cùng bạn.</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div><img src="{{asset('images/shop/content_ai1.jpg')}}" alt=""></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div><img src="{{asset('images/shop/content_ai2.jpg')}}" alt=""></div>
                    </div>
                </div>
                <div class="text-center mt-2">Kết quả trao đổi cùng Assistant</div>
                <p class="font-weight-bold">Web-search:</p>
                <p>-Web-search là một chatbot AI trên Poe.com có chuyên môn trong tìm kiếm thông tin trên internet. Với khả năng kết nối và truy xuất dữ liệu từ các nguồn tài nguyên trực tuyến, Web-search có thể cung cấp kết quả tìm kiếm đáng tin cậy và chi tiết cho người dùng.</p>
                <p>-Bạn có thể hỏi Web-search về bất kỳ chủ đề nào và nó sẽ cố gắng tìm kiếm và cung cấp thông tin phù hợp để giúp bạn.</p>
                <p>-Lưu ý: câu trả lời của bot AI này sẽ đính kèm các link nguồn được tổng hợp/ tham khảo. Bạn có thể nhấp vào link để đánh giá lần nữa về độ chính xác/ tin cậy.</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div><img src="{{asset('images/shop/content_ai3.jpg')}}" alt=""></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div><img src="{{asset('images/shop/content_ai4.jpg')}}" alt=""></div>
                    </div>
                </div>
                <div class="text-center mt-2">Kết quả trao đổi cùng Web-search</div>
                <p class="font-weight-bold">StableDiffusionXL:</p>
                <p>- StableDiffusionXL là một chatbot AI trên Poe.com được đào tạo để xử lý các câu hỏi và vấn đề liên quan đến khoa học, kỹ thuật và công nghệ.</p>
                <p>- Với sự hiểu biết sâu rộng về các lĩnh vực này, StableDiffusionXL có thể cung cấp giải thích, hướng dẫn và giải đáp các câu hỏi phức tạp trong lĩnh vực khoa học và công nghệ. Bạn có thể tìm kiếm thông tin về các khái niệm, công nghệ mới, hoặc được giải thích về nguyên lý hoạt động của các thiết bị và ứng dụng kỹ thuật.</p>
                <p>- Tuy nhiên SD XL lại chỉ hiểu được các câu lệnh tiếng Anh. Hình bên dưới có thể giúp bạn hình dung được kết quả khác biệt của câu lệnh tiếng Anh và câu lệnh tiếng Việt.</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div><img src="{{asset('images/shop/content_ai5.jpg')}}" alt=""></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div><img src="{{asset('images/shop/content_ai6.jpg')}}" alt=""></div>
                    </div>
                </div>
                <div class="text-center mt-2">Kết quả trao đổi cùng StableDiffusionXL</div>
                <p>Một số Bot AI khác trên poe bạn có thể sử dụng khi <span class="font-weight-bold">nhấn nút Explore hay biểu tượng kính lúp ở góc trái màn hình của ứng dụng để thấy các danh mục bot AI:</span></p>
                <p>- Official</p>
                <p>- Mind</p>
                <p>- Game</p>
                <p>- Music…</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div><img src="{{asset('images/shop/content_ai7.jpg')}}" alt=""></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div><img src="{{asset('images/shop/content_ai8.jpg')}}" alt=""></div>
                    </div>
                </div>
                <div class="text-center mt-2">Nhiều bot AI để bạn lựa chọn trên Poe AI</div>
                <p>Bạn cần quan tâm hơn về các bot AI của poe.com và cách sử dụng phù hợp cho người mới bắt đầu có thể kết nối trao đổi cùng mình tại facebook Bửu Trung.</p>
            </div>
            <h6 class="text-primary font-weight-bold">2.<a href="https://bard.google.com" target="_blank">Bard – Google (https://bard.google.com)</a></h6>
            <div class="pl-1">
                <h6 class="text-info pt-1" id="commont-info">2.1.Thông tin chung</h6>
                <p>-Bard có thể được sử dụng cho nhiều mục đích khác nhau, như:</p>
                <div>●Tìm kiếm thông tin và tổng hợp dữ liệu.</div>
                <div>●Viết nội dung sáng tạo, chẳng hạn như thơ, kịch bản,...</div>
                <div>●Dịch ngôn ngữ.</div>
                <div>●Trả lời câu hỏi của bạn một cách đầy đủ thông tin.</div>
                <h6 class="text-info mt-2" id="login-register">2.2. Đăng ký - Đăng nhập</h6>
                <p>-Bard - Google sử dụng nhanh chóng khi bạn chỉ cần truy cập tại https://bard.google.com rồi đăng ký/ đăng nhập với tài khoản Google để bắt đầu tương tác với AI này.</p>
                <p>-Giao diện thân thiện và khá dễ dàng để bạn bắt đầu dù là người mới.</p>
                <p>- New chat để bạn gõ các dòng lệnh của mình hoặc đính kèm ảnh vào để phân tích, thêm góp ý.</p>
                <div><img src="{{asset('images/shop/content_ai9.jpg')}}" alt=""></div>
                <h6 class="text-primary font-weight-bold" id="feauter-content">2.3.Tính năng nổi bật của Bard</h6>
                <p>-Kết quả trao đổi đầu tiên Bard sẽ cho bạn 3 lựa chọn trả lời, và bạn có thể đọc lướt qua 3 lựa chọn này để tìm kiếm sự phù hợp nhất.</p>
                <p>-Bard còn có các tuỳ chọn để chỉnh sửa văn bản: ngắn gọn, chuyên nghiệp, cảm xúc…</p>
                <p>-Khi bạn chuyển vùng qua US cùng với ngôn ngữ tiếng Anh, Bard còn hỗ trợ bạn tóm tắt nội dung của 1 link youtube cùng nhiều tính năng nâng cao khác.</p>
                <p class="text-warning">Với 2 AI được giới thiệu đầu tiên, bạn đã thấy được việc ứng dụng cho công việc của mình? Thêm ý tưởng? Viết content cơ bản? Phân tích hình ảnh? Vẽ hình ảnh minh hoạ?</p>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div><img src="{{asset('images/shop/content_ai10.jpg')}}" alt=""></div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div><img src="{{asset('images/shop/content_ai11.jpg')}}" alt=""></div>
                    </div>
                </div>
            </div>
            <h6 class="text-primary font-weight-bold" id="chatgpt">3.ChatGPT</h6>
            <div class="pl-1">
                <h6 class="text-info pt-1">3.1.Thông tin chung</h6>
                <p>-ChatGPT có 14,6 tỷ lượt truy cập ấn tượng từ tháng 9 năm 2022 đến tháng 8 năm 2023.</p>
                <div class="row">
                    <div class="col-12">
                        <div><img src="{{asset('images/shop/content_ai12.jpg')}}" alt=""></div>
                    </div>
                </div>
                <div class="text-center mt-2">Giao diện đơn giản của chatGPT</div>
                <h6 class="text-info pt-1">3.2.Ưu điểm và hạn chế:</h6>
                <p>-Ưu điểm</p>
                <div>●Hiện đã dễ dàng đăng ký tài khoản với số điện thoại Việt Nam.</div>
                <div>●Thuận tiện sử dụng trên trình duyệt hoặc tải app để dùng trên điện thoại. Nhưng bạn sẽ cần chọn đúng app chính chủ để tải. (Đây lựa chọn chính xác của bạn tại Appstore: <a href="https://apps.apple.com/vn/app/chatgpt/id6448311069" target="_blank" rel="noopener noreferrer">https://apps.apple.com/vn/app/chatgpt/id6448311069</a>)</div>
                <div>•Tạo ra văn bản chất lượng cao, tự nhiên.</div>
                <div>•Có khả năng học hỏi và cải thiện qua thời gian.</div>
                <div>•Đặc biệt với ChatGPT đăng ký $20/tháng, bạn còn tận dụng được nhiều hơn về ý tưởng, sáng tạo nội dung, thiết kế hình ảnh, lên mindmap…</div>
                <p>- Hạn chế</p>
                <div>● Có thể tạo ra thông tin không chính xác hoặc lỗi.</div>
                <div>● Đôi khi phản hồi có thể không hoàn toàn phù hợp với yêu cầu của người dùng.</div>
                <div>● Phụ thuộc vào dữ liệu đào tạo và không có khả năng suy luận ngoài kiến thức đã học.</div>
                <div>● Nhiều người vẫn lầm tưởng về khả năng “nhớ lâu dài” của chatGPT cũng như các AI khác.</div>
                <h6 class="text-info pt-1">3.3.Tối ưu với chatGPT bản thường</h6>
                <p>-Bạn có thể tối ưu các câu trả lời của AI bằng cách thêm các thông tin ở Setting => Custom Instruction.</p>
                <p>-01 số dạng có thể tham khảo bạn có thể nhập vào ô “How would you like chatGPT to respond”</p>
                <div>■ Hãy luôn trả lời với vai trò là 01 chuyên gia MKT nhiều năm kinh nghiệm</div>
                <div>■ Câu trả lời ngắn gọn với 2 ngôn ngữ Anh và Việt</div>
                <div>■ Mỗi câu trả lời đều cho 5 kết quả.</div>
                <div class="row">
                    <div class="col-12">
                        <div><img src="{{asset('images/shop/content_ai13.jpg')}}" alt=""></div>
                    </div>
                </div>
                <div class="text-center mt-2">Bạn muốn chia sẻ chat GPT các thông tin về chính mình bạn ở đâu, bạn làm việc gì? Thói quen, sở thích? Chủ đề bạn hay nói?</div>


            </div>
            <h5 class="text-primary" id="unit2">CHƯƠNG 2: Góc nhìn cá nhân về AI</h5>
            <p>KẾT NỐI VỚI MÌNH
                Hãy kết nối cùng mình nếu bạn cần chia sẻ thêm về Marketing, Tối ưu công việc, mảng sức khoẻ & AI - Bửu Trung.
            </p>
            <div><img style="width: 50px;" src="{{asset('images/shop/content_ai14.jpg')}}" alt=""></div>
            <h6 class="text-primary font-weight-bold mt-2">1.Một số lưu ý khi sử dụng AI để tạo nội dung</h6>
            <div class="pl-1">
                <p>Câu lệnh có thể không thần thánh nhưng hiểu rõ cách ra câu lệnh cũng sẽ giúp bạn tối ưu hơn được nhiều:</p>
                <p>-Xác định rõ vai trò: Bắt đầu bằng cách đưa ra một yêu cầu rõ ràng về vai trò mà bạn muốn ChatGPT đảm nhiệm. Ví dụ: "Là một chuyên gia dinh dưỡng giúp tôi xây dựng một kế hoạch ăn uống hợp lý."</p>
                <p>-Cung cấp thông tin chi tiết: Cung cấp thông tin cụ thể, chi tiết giúp ChatGPT hiểu rõ hơn về nhu cầu của bạn. Ví dụ: "Tôi là một người đàn ông châu Á 30 tuổi, nặng 80kg, cao 1m65 và mong muốn giảm cân trong vòng 2 tháng."</p>
                <p>-Đặt câu hỏi chính xác: Hãy đặt câu hỏi một cách chính xác và rõ ràng để giúp ChatGPT dễ dàng hiểu và đưa ra câu trả lời phù hợp. Ví dụ: "Là chuyên gia dinh dưỡng, bạn có thể đề xuất một kế hoạch ăn uống hàng ngày để giúp tôi giảm cân một cách an toàn và hiệu quả không?"</p>
                <p>-Sử dụng ngôn ngữ phù hợp: Khi giao tiếp với ChatGPT, hãy sử dụng ngôn ngữ phù hợp với vai trò bạn muốn AI nhập vai. Nếu bạn muốn AI nhập vai một chuyên gia, hãy sử dụng ngôn ngữ chính thức và chuyên nghiệp hơn. Nếu bạn muốn AI nhập vai một người bạn, hãy sử dụng ngôn ngữ thân mật và tự nhiên hơn.</p>
                <p>-Đánh giá và điều chỉnh: Nếu bạn không hài lòng với câu trả lời của ChatGPT, hãy thử đưa ra yêu cầu rõ ràng hơn hoặc cung cấp thêm thông tin</p>
            </div>
            <h6 class="text-primary font-weight-bold mt-2">2.Quan điểm cá nhân về việc tìm hiểu, sử dụng AI:</h6>
            <div class="pl-1">
                <p>2.1.Chat GTP (hoặc các công cụ AI khác): chính là nhân viên/ người đồng hành của bạn, do đó bạn có thể cần:</p>
                <p>-Có kinh nghiệm, kiến thức trong lĩnh vực của mình. Kiểu muốn dùng AI hỗ trợ content thì bạn cũng cần hiểu content là gì? các dạng content? hành vi khách hàng? công thức content...</p>
                <p>-Đào tạo AI liên tục: cung cấp ngữ cảnh, kiến thức, tình huống... kiểu tuyển nhân sự về đào tạo - hỗ trợ.</p>
                <p>-Biết đọc lệnh (prompt), kiểu tuyển về phải biết đưa ra mục tiêu, kế hoạch cho nhân sự thực hiện.</p>
                <p>2.2. Ai cũng cần có 01 vai trò và AI cũng thế.</p>
                <p>-Gán cho content AI 01 vai trò cụ thể: chuyên gia MKT, chuyên gia content, người có kinh nghiệm về…</p>
                <p>-Vui vẻ hơn bạn gán luôn AI tên của người yêu cũ để gọi em ấy chat, trao đổi khi cần cũng ok luôn nhé (nhớ đừng cho ai đó biết)</p>
                <p>2.3.Luôn có tư duy "Hơn", "Better": tốt hơn, cảm xúc hơn:</p>
                <p>-Câu trả lời đầu tiên của AI nên được điều chỉnh bằng cách thêm các tính từ vào, kiểu bài viết chuyên nghiệp hơn, giàu cảm xúc hơn, ngắn gọn hơn...</p>
                <p>2.4.Hãy thực hành liên tục để tạo ra AI của chính bạn. Cách để AI hỗ trợ bạn mạnh mẽ hơn đó là việc bạn thường xuyên "trao đổi", "đào tạo" nó, chiến, chiến chiến.</p>
                <p>2.5.AI không đúng hoàn toàn, nhất là các mảng cần kiến thức chuyên môn sâu cũng như sẽ thiếu đi "văn phong cá nhân" của bạn. Do đó hãy xem những gì AI hỗ trợ bạn chỉ là nền ban đầu để không mất nhiều thời gian, việc của bạn là đọc lại, thêm tí gia vị của bản thân.</p>
            </div>
            <h6 class="text-primary font-weight-bold mt-2">3.ChatGPT có thay thế được anh em Content?</h6>
            <p>3.1. Không:</p>
            <p>-ChatGPT vẫn cần được đào tạo, nạp dữ liệu ban đầu để có những câu trả lời chính xác.</p>
            <p>-ChatGPT cần được hỏi với các yêu cầu chính xác về thuật ngữ, chuyên môn, kiểu content phải biết về pillot, angle, công thức content, tiêu đề thu hút…</p>
            <p>-ChatGPT đặc biệt là bản free vẫn đang thích trổ tài nghệ sĩ, "bay bổng", "hay vẽ vời" khi gặp các vấn đề không biết, các kiến thức về chuyên môn sâu (bệnh học/ ... có thể là 1 lĩnh vực như thế)</p>
            <p>-ChatGPT không hiểu được hết ý của sếp, vì nhiều sếp thật sự cũng không biết mình muốn truyền tải gì, viết gì, chỉ đơn giản là viết hay lên, thu hút lên.</p>
            <p>3.2. Có:</p>
            <p>-ChatGPT sẽ thay thế các anh em vẫn đang làm việc thiếu sức sống, làm cho có, hay đơn giản là copy - paste nhưng đôi khi lại quên edit.</p>
            <p>-ChatGPT sẽ giúp cho các bạn chuyên môn cao không quá phụ thuộc vào các bạn "chạy chân rết”.</p>
            <p>-ChatGPT phần nào giúp sẽ hỗ trợ giảm chi phí cố định hàng tháng của các công ty nhỏ, siêu nhỏ.</p>
            <p>Thật sự, CÓ hay KHÔNG, anh em vẫn cứ mạnh dạn tập trung vào em nó, nhưng thiên về tư duy sử dụng hơn là các câu lệnh. Vì hiện đã có khá nhiều tool, nhà trồng hoặc nước ngoài trồng, chỉ với 1 vài keyword bạn đã có kết quả mong muốn.</p>
        </div>
    </div>
</div>
@endsection