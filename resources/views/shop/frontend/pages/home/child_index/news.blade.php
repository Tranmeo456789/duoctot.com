@php
use App\Helpers\MyFunction;

$firstAricle = $itemsArticle[0];
unset($itemsArticle[0]);
@endphp
<div class="text-center"><img class="lazy" data-src="{{asset('images/shop/banner12.jpeg')}}" alt="tdoctor" style="max-width: 600px;width:100%"></div>
<div class="newsh mt-3 mt-lg-5">
    @include("$moduleName.templates.box_title_product",['title' => 'Tin tức và góc sức khỏe','classBackground'=>'bg-info','img'=>'news1.png'])
    <div class="row px-2">
        <div class="col-xl-6 col-lg-12 news-content-right px-0 mb-xl-0 mb-lg-3">
            <a href="{{route('fe.post.detail',$firstAricle['slug'])}}" class="wp-thumb-first d-block">
                <div class="text-center">
                    <img class="lazy" data-src="{{asset($firstAricle['image'])}}" alt="{{$firstAricle['title']}}" style="max-height: 400px;">
                </div>
                <p class="truncate2 pb-0 px-2">{{$firstAricle['title']}}</p>
            </a>
            <div class="px-2 py-1">
                <div class="text-mute icon-oclock d-flex align-items-center">
                    <img src="{{asset('images/shop/oclock.png')}}" alt="tdoctor">
                    <div class="ml-2">{{MyFunction::formatDateFrontend($firstAricle['created_at'])}}</div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 px-0">
            <div class="news-content-left">
                <ul class="list-unstyled">
                    @foreach($itemsArticle as $val)
                    <li class="d-flex">
                        <a href="{{route('fe.post.detail',$val['slug'])}}" class="wp-thumb-item d-block">
                            <img class="lazy" data-src="{{asset($val['image'])}}" alt="{{$val['title']}}">
                        </a>
                        <div class="nctright pl-2">
                            <div class="news-known d-flex mb-1">
                                <a href="{{route('fe.post.listPostOfCat',$val->catPost->name_url)}}">{{$val->catPost->name??''}}</a>
                            </div>
                            <a class="title-new-left mb-1" href="{{route('fe.post.detail',$val['slug'])}}">
                                <p class="truncate2 pb-0">{{$val['title']}}</p>
                            </a>
                            <div class="icon-oclock d-flex align-items-center">
                                <img src="{{asset('images/shop/oclock.png')}}" alt="tdoctor">
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