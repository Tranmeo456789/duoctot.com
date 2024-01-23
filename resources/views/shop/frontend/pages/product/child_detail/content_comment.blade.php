@php
    use App\Helpers\MyFunction;
 @endphp
<div class="question-often mt-3">
    <h1>
        Bình luận
    </h1>
    <div class="content-quest">
        <textarea name="content" id="" placeholder="Nhập nội dung câu hỏi"></textarea>
        @if(Session::has('user'))
        <span class="btn btn-primary submit-comment" data-user="{{Session::get('user')['user_id']}}" data-url="{{route('fe.product.addCommentProduct')}}" data-product="{{$item['id']??$productId}}">Gửi bình luận</span>
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
            @php
                $timeComment = MyFunction::formatDateFrontend($val['created_at']);
            @endphp
            <li>
                <div class="commentq position-relative">
                    <span class="name">{{$val->userComment->fullname??''}} </span><span class="text-muted">{{$timeComment}}</span>
                    <p>{{$val['content']}}</p>
                    <div class="roud-img"><img src="{{asset('images/shop/TT.png')}}" alt=""></div>
                </div>
                <!-- <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                <div class="tplv">
                    <div class="commenta">
                        <span class="name">QuỳnhDT32</span><span class="cdntl">Quản trị viên</span><span class="text-muted">2 ngày trước</span>
                        <p>Chào Bạn Trịnh công bảo,Dạ sản phẩm hiện có hàng tại một số chi nhánh thuộc khu vực Thành Phố Huế gần khu vực thị xã Hương Trà ạ.Bạn vui lòng liên hệ tổng đài miễn phí 18006928 để được hỗ trợ tư vấn và đặt hàng.Thân mến!</p>
                        <p><a href="">Trả lời</a><span>*</span><a href="">Thích</a></p>
                    </div>
                </div> -->
            </li>
            @endforeach
        @endif
    </ul>
</div>