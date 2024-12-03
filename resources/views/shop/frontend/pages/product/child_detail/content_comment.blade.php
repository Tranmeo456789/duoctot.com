@php
use App\Helpers\MyFunction;
@endphp
<div class="question-often mt-3">
  <div class="title-rating">
    Bình luận
  </div>
  <div class="content-quest">
    <span class="btn btn-primary create-comment" data-user="{{Session::get('user')['user_id'] ?? ''}}" data-url="{{route('fe.product.addCommentProduct')}}" data-product="{{$item['id']??$productId}}" data-parentid="0">Gửi bình luận</span>
  </div>
  <ul class="list-comment position-relative">
    <!-- <div class="btnselecthc">
      <div class="dropdown">
        <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Mới nhất</button>
        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
          <a class="dropdown-item" href="#">Cũ nhất</a>
          <a class="dropdown-item" href="#">Hữu ích nhất</a>
        </div>
      </div>
    </div> -->
    @if(count($commentProduct)>0)
    @foreach($commentProduct as $val)
    @include("$moduleName.partial.comment",['commentProduct'=>$val])
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
