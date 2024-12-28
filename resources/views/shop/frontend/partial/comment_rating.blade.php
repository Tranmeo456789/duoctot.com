@php
use App\Helpers\MyFunction;

$timeComment = MyFunction::formatDateFrontend($val['created_at']);
$fullname = $val['fullname'] ?? '';
$content = $val['content'] ?? '';
$words = explode(' ', $fullname);
$lastWord = end($words);
if ($lastWord) {
$firstLetter = mb_substr($lastWord, 0, 1);
} else {
$firstLetter = 'T';
}
@endphp
@if($val['parent_id']==0)
<li>
    <div class="d-flex">
        @for ($i = 0; $i < $val['level']; $i++) <div style="width:30px;"></div>@endfor
        <div>
            <div class="commentq position-relative">
                <span class="name">{{ $fullname }}</span>
                <span class="text-muted">{{ $timeComment }}</span>
                @if($val['rating']>0)
                <div class="d-flex mb-1">
                    <span class="pr-1">{{$val['rating']}}</span>
                    <span class="star star-medium" data-rating="1">★</span>
                </div>
                @endif
                <p>{{ $content }}</p>
                <div class="roud-img text-light rounded-circle text-uppercase">{{$firstLetter}}</div>
            </div>
            <p class="mt-1">
                <span class="text-primary repply-comment btn" data-commenter-name="{{ $fullname }}" data-comment-id="{{ $val['id'] }}" data-rating="0">Trả lời</span>
            </p>
        </div>
    </div>
</li>
@else
<li>
    <div class="d-flex">
        @for ($i = 0; $i < $val['level']; $i++) <div style="width:30px;"></div>@endfor
        <div>
            <div class="commentq position-relative">
                <div class="comment_reply-branch__NKquM"></div>
                <span class="name">{{ $fullname }}</span>
                <span class="text-muted">{{ $timeComment }}</span>
                <p>{{ $content }}</p>
                <div class="roud-img text-light rounded-circle text-uppercase">{{$firstLetter}}</div>
            </div>
            <p class="mt-1">
                <span class="text-primary repply-comment btn" data-commenter-name="{{ $fullname }}" data-comment-id="{{ $val['parent_id'] }}" data-rating="0">Trả lời</span>
            </p>
        </div>
    </div>
</li>
@endif
