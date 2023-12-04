<div class="list-product-short bg-white">
    @isset($items)
        <div>
            <p class="py-2 px-3 title-keyword">Hiển thị kết quả cho từ khóa: {{$keyword ?? ''}}</p>
            @if (!empty($items) && count($items) > 0)
                <ul class="list-name-product pb-3">
                    @foreach ($items as $val)
                        <li class="py-2 px-3"><a href="{{route('fe.product.detail',$val['id'])}}">{{ $val->name }}</a></li>
                    @endforeach
                </ul>
            @else
                <p class="px-3 py-2">Không tìm thấy kết quả với từ khóa “{{$keyword ?? ''}}”</p>
            @endif
        </div>
    @else
        <div class="px-4 py-2">
            <p class="mb-3">Bạn có thể tìm kiếm theo tên thuốc</p>
            <img loading="lazy" decoding="async" alt="Tdoctor" src="https://nhathuoclongchau.com.vn/estore-images/static/others/skeleton-product.png">
        </div>
    @endisset
</div>
