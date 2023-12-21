@php
$newFirst=['thumb'=>'news2.png','title'=>'Lupus ban đỏ và thai nghén: Bệnh Lupus Ảnh Hưởng Như Thế Nào Đến Quá Trình Mang Thai?','time'=>'1 tuần trước'];
$thumbFirst = asset('images/shop/') . '/' . $newFirst['thumb'];
$listNews=[
['thumb'=>'news3.png','title'=>'Tiêm Rãnh Cười Có Hại Không? Có Những Phương Pháp Xóa Rãnh Cười','time'=>'1 tuần trước'],
['thumb'=>'news4.png','title'=>'Siêu âm đầu dò bị chảy máu có đáng ngại không?','time'=>'1 tuần trước'],
['thumb'=>'news5.png','title'=>'Tổng quan về phương pháp tiêm rãnh cười','time'=>'1 tuần trước'],
['thumb'=>'news8.png','title'=>'Ho có đờm kéo dài: triệu chứng, nguyên nhân và cách giảm đau rát họng cho trẻ','time'=>'1 tuần trước'],
['thumb'=>'news7.png','title'=>'Tdoctor - ung thư gan: nguyên nhân, triệu chứng, điều trị và cách phòng tránh','time'=>'1 tuần trước']
];
@endphp
<div><img src="{{asset('images/shop/baner.png')}}" alt=""></div>
<div class="newsh mt-3 mt-lg-5">
    @include("$moduleName.templates.box_title_product",['title' => 'Tin tức và góc sức khỏe','classBackground'=>'bg-info','img'=>'news1.png'])
    <div class="row px-2">
        <div class="col-xl-6 col-lg-12 news-content-right px-0 mb-xl-0 mb-lg-3">
            <a href="" class="wp-thumb-first d-block">
                <img src="{{$thumbFirst}}" alt="">
                <a href="#">
                    <p class="truncate2 pb-0 px-2">{{$newFirst['title']}}</p>
                </a>
            </a>
            <div class="px-2 py-1">
                <div class="text-mute icon-oclock d-flex align-items-center">
                    <img src="{{asset('images/shop/oclock.png')}}" alt="">
                    <div class="ml-2">{{$newFirst['time']}}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 px-0">
            <div class="news-content-left">
                <ul class="list-unstyled">
                    @foreach($listNews as $val)
                    @php
                    $thumb = asset('images/shop/') . '/' . $val['thumb'];
                    @endphp
                    <li class="d-flex">
                        <a href="" class="wp-thumb-item d-block"><img src="{{$thumb}}" alt=""></a>
                        <div class="nctright pl-2">
                            <div class="news-known d-flex mb-1">
                                <a href="">Phòng và chữa bệnh</a>
                            </div>
                            <a class="title-new-left mb-1">
                                <p class="truncate2 pb-0">{{$val['title']}}</p>
                            </a>
                            <div class="icon-oclock d-flex align-items-center">
                                <img src="{{asset('images/shop/oclock.png')}}" alt="">
                                <div class="ml-2">{{$val['time']}}</div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    </div>
</div>