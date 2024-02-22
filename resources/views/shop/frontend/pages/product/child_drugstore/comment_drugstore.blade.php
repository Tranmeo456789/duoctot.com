<div class="content-comment-product">
    @include("$moduleName.pages.$controllerName.child_drugstore.content_comment")
</div>
<div class="question-often content-rating-product mt-3">
    @include("$moduleName.pages.$controllerName.child_drugstore.content_rating")
</div>
<div class="modal fade" id="ratingModal" tabindex="-1" role="dialog" aria-labelledby="ratingModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ratingModalLabel">Đánh giá sản phẩm</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex mb-2">
                    <div class="font-weight-bold">{{$userInfo['fullname']}}</div>
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
                    <span class="btn btn-primary submit-comment rounded-pill btn-block" data-user="{{Session::has('user') ? Session::get('user')['user_id'] : ''}}" data-url="{{route('fe.product.addCommentProduct')}}" data-shop="{{$userInfo['user_id']??$shopId}}" data-parentid="0" data-rating="5">Gửi</span>
                </div>
            </div>
        </div>
    </div>
</div>