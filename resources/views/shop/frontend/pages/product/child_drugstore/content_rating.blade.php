@php
use App\Model\Shop\CommentModel;
$averageRating=(new CommentModel)->averageRating(['shop_id'=>$userInfo['user_id']],['task' => 'rating-star-average'])??'';
$ratingPercentages=(new CommentModel)->ratingPercentages(['shop_id'=>$userInfo['user_id']],['task' => 'rating-percentage-star'])??[];
@endphp
<div class="title-rating">Đánh Giá & Nhận Xét
    <!-- <span class="coutn-dn">3</span> -->
</div>
<div class="average-rating">
    <div class="d-flex justify-content-between flex-wrap">
        <div class="average-rating-left text-center">
            <p>Trung bình</p>
            <span class="sst">{{$averageRating}}/5</span>
            <div class="rating text-warning" id="starRating">
                <span class="star" data-rating="1">★</span>
                <span class="star" data-rating="2">★</span>
                <span class="star" data-rating="3">★</span>
                <span class="star" data-rating="4">★</span>
                <span class="star" data-rating="5">★</span>
            </div>
            <!-- <span class="text-muted">3 đánh giá</span> -->
        </div>
        <div class="col-md-6 col-12">
            @for ($i = 5; $i >= 1; $i--)
            <div class="d-flex align-items-center justify-content-center pb-1">
                <small class="text-muted mr-2">{{$i}} <span class="star" data-rating="1">★</span></small>
                <div class="progress mr-2" style="width:80%;height:10px">
                    <div class="progress-bar bg-warning" role="progressbar" style="width: {{$ratingPercentages[$i]}}%" aria-valuenow="{{$ratingPercentages[$i]}}" aria-valuemin="0" aria-valuemax="100"></div>
                </div>
                <small class="text-muted" style="width:26px">{{$ratingPercentages[$i]}}%</small>
            </div>
            @endfor
        </div>
        <div class="average-rating-right text-center d-flex align-self-center">
            <div class="">
                <span class="btn btn-primary show-form-rating">Gửi đánh giá</span>
            </div>
        </div>
    </div>
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
    @if(count($ratingShop)>0)
    @foreach($ratingShop as $val)
    @include("$moduleName.partial.comment_rating",['$ratingShop'=>$val])
    @endforeach
    @endif
</ul>
<!-- <p class="text-center"><a href="" class="add-comment">Xem thêm bình luận <i class="fas fa-angle-down"></i></a></p> -->