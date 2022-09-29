<div class="">
    <div class="title_catdetail mb-2 d-flex">
        <div class="icon-cat-product"><img src="{{asset('images/shop/vuongwin.png')}}" alt=""></div>
        <span>{{$catc1['name']}}</span>
    </div>

    <ul class="body_catdetail1">
        <div class="row">
            @foreach($_SESSION['cat_product'] as $catp2)
            @if($catc1['id']==$catp2['parent_id'])
            <div class="col-lg-3 col-xl-3 col-6 delplcol">
                <li class="py-2">
                    <a href="{{route('fe.cat3',[parent_cat($catc1->id)->slug,$catc1->slug,$catp2->slug])}}">
                        <div class="itemct4">
                            <div>
                                <div class="rimg-center5">
                                    <img src="{{asset($catp2['image'])}}" alt="">
                                </div>
                            </div>
                            <div class="align-self-center set-linehname"><span>{{$catp2['name']}}</span> </div>
                        </div>
                    </a>
                </li>
            </div>
            @endif
            @endforeach
        </div>
    </ul>
</div>