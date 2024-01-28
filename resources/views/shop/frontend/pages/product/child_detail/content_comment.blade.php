@php
use App\Helpers\MyFunction;
@endphp
<div class="question-often mt-3">
  <h1>
    Bình luận
  </h1>
  <div class="content-quest">
    <textarea name="content" placeholder="Nhập nội dung câu hỏi"></textarea>
    @if(Session::has('user'))
    <span class="btn btn-primary submit-comment" data-user="{{Session::get('user')['user_id']}}" data-url="{{route('fe.product.addCommentProduct')}}" data-product="{{$item['id']??$productId}}" data-parentid="0">Gửi bình luận</span>
    @else
    <span class="btn btn-primary no-login">Gửi bình luận</span>
    @endif
  </div>
  <ul class="list-comment position-relative">
    <div class="btnselecthc">
      <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mới nhất</button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">Cũ nhất</a>
          <a class="dropdown-item" href="#">Hữu ích nhất</a>
        </div>
      </div>
    </div>
    @if(count($commentProduct)>0)
    @foreach($commentProduct as $val)
      @include("$moduleName.partial.comment",['commentProduct'=>$val])
    @endforeach
    @endif
  </ul>
</div>
<div class="modal fade" id="replyModal" tabindex="-1" role="dialog" aria-labelledby="replyModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="replyModalLabel">Trả lời</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="content-quest">
          <textarea name="content" placeholder="Nhập nội dung câu hỏi"></textarea>
          @if(Session::has('user'))
          <span class="btn btn-primary submit-comment" data-user="{{Session::get('user')['user_id']}}" data-url="{{route('fe.product.addCommentProduct')}}" data-product="{{$item['id']??$productId}}" data-parentid="">Gửi bình luận</span>
          @else
          <span class="btn btn-primary no-login">Gửi bình luận</span>
          @endif
        </div>
      </div>
    </div>
  </div>
</div>