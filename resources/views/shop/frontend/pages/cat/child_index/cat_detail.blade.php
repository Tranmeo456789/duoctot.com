<div class="">
    <div class="title_catdetail mb-2 d-flex">
        <div class="roud25b-img"><img src="{{asset('images/shop/Cntn.png')}}" alt=""></div>
        <span>{{$catc1['name']}}</span>
    </div>
    <ul class="body_catdetail">
        <div class="row">
        @foreach($_SESSION['cat_product'] as $catp2)
        @if($catc1['id']==$catp2['parent_id'])
            <div class="col-lg-3 col-xl-3 col-6 delplcol">
                <li class="py-2">
                    <a href="">
                        <div class="itemct4">
                            <div class="rimg-center5">
                                <img src="{{asset('public/shop/uploads/images/product/'.$catp2['image'])}}" alt="">
                            </div>
                            <div class="align-self-center"><span>{{$catp2['name']}}</span> </div>
                        </div>
                    </a>
                </li>
            </div>
            @endif
        @endforeach                  
        </div>
    </ul>
</div>