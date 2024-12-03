@php
use App\Helpers\MyFunction;
@endphp
<div class="question-often mt-3">
  <div class="title-rating">Bình luận</div>
  <div class="content-quest">
    <span class="btn btn-primary create-comment" data-user="{{Session::get('user')['user_id'] ?? ''}}" data-url="{{route('fe.product.addCommentProduct')}}" data-shop="{{$userInfo['user_id']??$shopId}}" data-parentid="0">Gửi bình luận</span>
  </div>
  <ul class="list-comment position-relative">
    @if(count($commentShop)>0)
    @foreach($commentShop as $val)
    @include("$moduleName.partial.comment",['$commentShop'=>$val])
    @endforeach
    @endif
    <!-- <li>
      <div class="pb-3">
        <div class="commentq position-relative">
          <span class="name">Trần Hùng</span>
          <span class="text-muted">16/02/2024</span>
          <p>Sản phẩm tốt</p>
          <div class="roud-img text-light rounded-circle text-uppercase">H</div>
        </div>
      </div>
    </li>
    <li>
      <div class="pb-3">
        <div class="commentq position-relative">
          <span class="name">Nguyễn Mạnh Tường</span>
          <span class="text-muted">12/12/2023</span>
          <p>Tôi đã dùng cảm thấy chất lượng và nhân viên hỗ trợ nhiệt tình</p>
          <div class="roud-img text-light rounded-circle text-uppercase">T</div>
        </div>
      </div>
    </li>
    <li>
      <div class="pb-3">
        <div class="commentq position-relative">
          <span class="name">Mỹ Linh</span>
          <span class="text-muted">10/12/2023</span>
          <p>Tốt!</p>
          <div class="roud-img text-light rounded-circle text-uppercase">L</div>
        </div>
      </div>
    </li> -->
  </ul>
</div>
