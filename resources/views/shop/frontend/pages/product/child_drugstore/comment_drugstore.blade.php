<!-- <div class="content-comment-product">
    @include("$moduleName.pages.$controllerName.child_drugstore.content_comment")
</div> -->
<div class="question-often content-rating-product mt-3">
    @include("$moduleName.pages.$controllerName.child_drugstore.content_rating")
</div>
<div class="modal" id="ratingModal">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ratingModalLabel">Đánh giá Shop</h5>
                <button type="button" class="close" data-dismiss="modal">
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
                    <div class="row mb-3">
                        <div class="col-12 mb-3">
                            <input name="fullname" value="{{ e(Session::get('user')['fullname'] ?? '') }}" placeholder='Họ và tên'>
                        </div>
                        <div class="col-12">
                            <input name="phone" value="{{ e(Session::get('user')['phone'] ?? '') }}" placeholder='Số điện thoại'>
                        </div>
                    </div>
                    <textarea name="content" placeholder="Nhập nội dung (Vui lòng gõ tiếng Việt có dấu)..."></textarea>
                    <span class="btn btn-primary submit-comment rounded-pill btn-block" data-user="{{Session::has('user') ? Session::get('user')['user_id'] : ''}}" data-url="{{route('fe.product.addCommentProduct')}}" data-shop="{{$userInfo['user_id']??$shopId}}" data-parentid="0" data-rating="5">Gửi</span>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal" id="replyModal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="replyModalLabel">Trả lời</h5>
        <button type="button" class="close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="content-quest">
            <div class="row mb-3">
                <div class="col-12 mb-3">
                    <input name="fullname" value="{{ e(Session::get('user')['fullname'] ?? '') }}" placeholder='Họ và tên'>
                </div>
                <div class="col-12">
                    <input name="phone" value="{{ e(Session::get('user')['phone'] ?? '') }}" placeholder='Số điện thoại'>
                </div>
            </div>
          <textarea name="content" placeholder="Nhập nội dung câu hỏi"></textarea>
          <span class="btn btn-primary submit-comment" data-user="{{Session::get('user')['user_id'] ?? ''}}" data-url="{{route('fe.product.addCommentProduct')}}" data-shop="{{$userInfo['user_id']??$shopId}}" data-parentid="">Gửi bình luận</span>
        </div>
      </div>
    </div>
  </div>
</div>
<style>
  .modal {
    background-color: rgba(0, 0, 0, 0.5); 
  }
</style>