<div class="list-product-short bg-white">
    @isset($items)
        <div>
            <p class="py-2 px-3 title-keyword">Hiển thị kết quả cho từ khóa: {{$keyword ?? ''}}</p>
            @if (!empty($items) && count($items) > 0)
                <ul class="list-name-product pb-3">
                    @foreach ($items->take(5) as $val)
                        <li class="py-2 px-3"><a href="{{route('fe.product.detail',$val['slug'])}}">{{ $val->name }}</a></li>
                    @endforeach
                    <p class="text-center font-weight-bold">{{count($items)}} kết quả được tìm thấy</p>
                </ul>
            @else
                <p class="px-3 py-2">Không tìm thấy kết quả với từ khóa “{{$keyword ?? ''}}”</p>
            @endif
        </div>
    @else
        <div class="px-4 py-2">
            <p>@lang('lang.you_can_search_by_name_or_drug_function')</p>
            <!-- <img loading="lazy" decoding="async" alt="Tdoctor" src="{{asset('images/shop/skeleton-product.png')}}"> -->
        </div>
    @endisset
</div>
