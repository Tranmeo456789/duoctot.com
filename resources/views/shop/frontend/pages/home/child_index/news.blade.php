@php
    use App\Helpers\MyFunction;
/* $newFirst=['thumb'=>'news2.png','title'=>'Lupus ban đỏ và thai nghén: Bệnh Lupus Ảnh Hưởng Như Thế Nào Đến Quá Trình Mang Thai?','time'=>'1 tuần trước'];
$thumbFirst = asset('images/shop/') . '/' . $newFirst['thumb'];
$listNews=[
['thumb'=>'news3.png','title'=>'Tiêm Rãnh Cười Có Hại Không? Có Những Phương Pháp Xóa Rãnh Cười','time'=>'1 tuần trước'],
['thumb'=>'news4.png','title'=>'Siêu âm đầu dò bị chảy máu có đáng ngại không?','time'=>'1 tuần trước'],
['thumb'=>'news5.png','title'=>'Tổng quan về phương pháp tiêm rãnh cười','time'=>'1 tuần trước'],
['thumb'=>'news8.png','title'=>'Ho có đờm kéo dài: triệu chứng, nguyên nhân và cách giảm đau rát họng cho trẻ','time'=>'1 tuần trước'],
['thumb'=>'news7.png','title'=>'Tdoctor - ung thư gan: nguyên nhân, triệu chứng, điều trị và cách phòng tránh','time'=>'1 tuần trước']
];
*/
    $firstAricle = $itemsArticle[0];

    $thumbFirstAricle = 'https://tdoctor.vn/public/images/' .  $firstAricle['image'];
    $linkFirstAricle  = 'https://tdoctor.vn/' . $firstAricle['article_url']  . '-' . $firstAricle['article_id'] . '.html';
    unset($itemsArticle[0]);
@endphp
<div><img src="{{asset('images/shop/baner.png')}}" alt=""></div>
<div class="newsh mt-3 mt-lg-5">
    @include("$moduleName.templates.box_title_product",['title' => 'Tin tức và góc sức khỏe','classBackground'=>'bg-info','img'=>'news1.png'])
    <div class="row px-2">
        <div class="col-xl-6 col-lg-12 news-content-right px-0 mb-xl-0 mb-lg-3">
            <a href="{{$linkFirstAricle}}" class="wp-thumb-first d-block" target ='_blank' >
                <img src="{{$thumbFirstAricle}}" alt="">

                <p class="truncate2 pb-0 px-2">{{$firstAricle['article_title']}}</p>

            </a>
            <div class="px-2 py-1">
                <div class="text-mute icon-oclock d-flex align-items-center">
                    <img src="{{asset('images/shop/oclock.png')}}" alt="">
                    <div class="ml-2">{{MyFunction::formatDateFrontend($firstAricle['created_at'])}}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 px-0">
            <div class="news-content-left">
                <ul class="list-unstyled">
                    @foreach($itemsArticle as $val)
                    @php
                        $thumb = 'https://tdoctor.vn/public/images/' .  $val['image'];
                        $link = 'https://tdoctor.vn/' . $val['article_url'] . '-' . $val['article_id'] . '.html';
                        $linkChuyenMuc = 'https://tdoctor.vn/chuyenmuc/' . $val->catalog->name_url . '-' .  $val->catalog->id;
                    @endphp
                    <li class="d-flex">
                        <a href="{{$link}}" target ='_blank' class="wp-thumb-item d-block">
                            <img src="{{$thumb}}" alt="">
                        </a>
                        <div class="nctright pl-2">
                            <div class="news-known d-flex mb-1">
                                <a href="{{$linkChuyenMuc}}">{{$val->catalog->name}}</a>
                            </div>
                            <a class="title-new-left mb-1" href="{{$link}}" target ='_blank'  >
                                <p class="truncate2 pb-0">{{$val['article_title']}}</p>
                            </a>
                            <div class="icon-oclock d-flex align-items-center">
                                <img src="{{asset('images/shop/oclock.png')}}" alt="">
                                <div class="ml-2">{{MyFunction::formatDateFrontend($val['created_at'])}}</div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>