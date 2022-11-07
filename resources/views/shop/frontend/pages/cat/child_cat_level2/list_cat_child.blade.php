@php
use App\Helpers\MyFunction;
use App\Model\Shop\CatProductModel;

$listCatAll=CatProductModel::all();
@endphp
<div class="">
    <div class="title_catdetail mb-2 d-flex">
        <div class="icon-cat-product"><img src="{{asset('images/shop/vuongwin.png')}}" alt=""></div>
        <span>{{$itemCatCurent['name']}}</span>
    </div>
    <ul class="body_catdetail1">
        <div class="row">
            @foreach($listCatAll as $child)
            @if($itemCatCurent['id']==$child['parent_id'])
            <div class="col-lg-3 col-xl-3 col-6 delplcol">
                <li class="py-2">
                    <a href="{{route('fe.cat3',[$itemCatParent['slug'],$itemCatCurent['slug'],$child['slug']])}}">
                        <div class="itemct4">
                            <div>
                                <div class="rimg-center5">
                                    <img src="{{asset($child['image'])}}" alt="">
                                </div>
                            </div>
                            <div class="align-self-center set-linehname"><span>{{$child['name']}}</span> </div>
                        </div>
                    </a>
                </li>
            </div>
            @endif
            @endforeach
        </div>
    </ul>
</div>