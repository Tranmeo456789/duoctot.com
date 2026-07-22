@forelse($listProductRelate as $val)
<a href="{{route('fe.product.detail',$val['slug'])}}" class="article-item">
    <div class="article-thumb">
        <img src="{{asset('public'.$val['image'])}}" alt="" title="">
    </div>
    <div class="article-body">
        <span class="article-tag">{{$val->catPost->name??''}}</span>
        <div class="article-title">{{$val['name']??''}}</div>
        <div class="article-desc">{{$val['meta_description']??''}}</div>
    </div>
</a>
@empty
<p class="text-muted mb-0">Chưa có sản phẩm nào.</p>
@endforelse