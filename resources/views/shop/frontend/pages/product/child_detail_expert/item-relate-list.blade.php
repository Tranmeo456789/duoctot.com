@forelse($listItemRelate as $val)
<a href="{{route('fe.post.detail',$val['slug'])}}" class="article-item">
    <div class="article-thumb">
        <img src="{{asset('public'.$val['image'])}}" alt="" title="">
    </div>
    <div class="article-body">
        <span class="article-tag">{{$val->catPost->name??''}}</span>
        <div class="article-title">{{$val['title']??''}}</div>
        <div class="article-desc">{{$val['description']??''}}</div>
    </div>
</a>
@empty
<p class="text-muted mb-0">Chưa có bài viết nào.</p>
@endforelse