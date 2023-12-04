@php
use App\Model\Shop\CatProductModel;

$listCatAll=(new CatProductModel())->listItems(null, ['task'  => 'list-items-front-end']);
@endphp
<div class="">
    <div>@include("$moduleName.templates.box_title_product",['title' => $itemCatCurent['name'],'img'=>'vuongwin.png'])</div>
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