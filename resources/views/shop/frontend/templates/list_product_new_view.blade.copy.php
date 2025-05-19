@php
    use App\Helpers\MyFunction;
    use App\Model\Shop\ProductModel;
    $productViewed = [];
    if (isset($_COOKIE['productViewed'])){
        $productViewed = json_decode($_COOKIE['productViewed'],true);
        
        if (isset($params['id']) && $params['id'] == array_key_first($productViewed)){
            unset($productViewed[$params['id']]);
        }
        $params['group_id']=array_keys($productViewed);
        $productViewed = (new ProductModel())->listItems(['group_id'=> $params['group_id']], ['task' => 'frontend-list-items']);
    }
@endphp
@if(count($productViewed) > 0)
    <div class="viewnproduct">
        @include("$moduleName.templates.box_title_product",['title' => 'Vừa mới xem','img'=>'mat.png'])
        <ul class="clearfix list-unstyled ls_product">
            @foreach($productViewed as $key=>$val)
            <li class="position-relative">
                <a href="{{route('fe.product.detail',$val['slug']??'')}}">
                    <div class="d-flex justify-content-center wp-img-thumb-product"><img class="lazy" src="{{asset($val['image'])}}" alt="{{$val['name']}}"></div>
                    <div class="mt-3 px-2">
                        <div class="wp-name-product">
                            <p class="truncate3">{{$val['name']}}</p>
                        </div>
                        <span class="text-info">...</span>
                    </div>
                </a>
            </li>
            @endforeach
        </ul>
    </div>
@endif