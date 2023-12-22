<div class="wp-list-alphabet">
    <div class="d-flex list-alphabet mb-3">
        @php
        $listAlphabet=['A','B','C','D','E','F','G','H','I','J','K','L','M','N','O','P','Q','R','S','T','U','V','W','X','Y','Z'];
        @endphp
        @foreach($listAlphabet as $val)
            <span class="filter-product-alphabet">{{$val}}</span>
        @endforeach
    </div>
</div>

<div class="row">
    @foreach($items as $val)
    <div class="col-12 col-md-6 col-lg-3">
        <div class="item-product-simple">
            <a href="{{route('fe.product.detail',$val['slug'])}}" title="">
                <p class="truncate2">{{$val['name']}}</p>
            </a>
        </div>
    </div>
    @endforeach
</div>
@include("$moduleName.block.pagination")