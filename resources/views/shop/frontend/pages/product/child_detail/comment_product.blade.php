<div class="question-often mt-3">
    <div class="title-rating">
        Câu hỏi thường gặp
    </div>
    <ul class="list-question">
        <li class="catparentc">
            <h3 class="">Thực phẩm chức năng hỗ trợ sức khỏe tình dục nam giới có tác dụng gì?<img src="{{asset('images/shop/hoi.png')}}" alt="">
                <div class="vissubmenu"><i class="fas fa-angle-down"></i></div>
            </h3>
            <div class="submenua1">
                <ul>
                    <p>* Giúp kích hoạt cơ chế sản sinh Hormone sinh dục nam nội sinh một cách tự nhiên.</p>
                    <p>* Bổ thận tráng dương, tăng cường sinh lý, phục hồi khả năng sinh lý nam giới.</p>
                    <p>* Hỗ trợ điều trị rối loạn cương dương, xuất tinh sớm, di tinh, mộng tinh… làm chậm quá trình mãn dục nam.</p>
                    <p>* Giúp tăng cường lưu thông máu, tăng cường ham muốn, khắc phục tình trạng rối loạn cương dương ở nam giới.</p>
                </ul>
            </div>
        </li>
    </ul>
</div>
<div class="content-comment-product">
    @include("$moduleName.pages.$controllerName.child_detail.content_comment")
</div>
<div class="question-often content-rating-product mt-3">
    @include("$moduleName.pages.$controllerName.child_detail.content_rating")
</div>
<div class="modal" id="ratingModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ratingModalLabel">Đánh giá sản phẩm</h5>
                <button type="button" class="close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex mb-2">
                    <div> <img src="{{asset($item['image'])}}" style="max-width: 100px; max-height:100px;" /></div>
                    <div class="font-weight-bold">{{$item['name']}}</div>
                </div>
                <div class="rating text-center mb-2" id="starRating">
                    <span class="star star-big active" data-rating="1">★</span>
                    <span class="star star-big active" data-rating="2">★</span>
                    <span class="star star-big active" data-rating="3">★</span>
                    <span class="star star-big active" data-rating="4">★</span>
                    <span class="star star-big active" data-rating="5">★</span>
                </div>
                <div class="content-quest">
                    <textarea name="content" placeholder="Nhập nội dung (Vui lòng gõ tiếng Việt có dấu)..."></textarea>
                    <span class="btn btn-primary submit-comment rounded-pill btn-block" data-user="{{Session::has('user') ? Session::get('user')['user_id'] : ''}}" data-url="{{route('fe.product.addCommentProduct')}}" data-product="{{$item['id']??$productId}}" data-parentid="0" data-rating="5">Gửi</span>
                </div>
            </div>
        </div>
    </div>
</div>