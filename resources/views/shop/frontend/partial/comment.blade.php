@php
    use App\Helpers\MyFunction;

    $timeComment = MyFunction::formatDateFrontend($val['created_at']);
    $fullname = $val->userComment->fullname ?? '';
    $content = $val['content'];
    $words = explode(' ', $fullname);
    $lastWord = end($words);
    if ($lastWord) {
        $firstLetter = mb_substr($lastWord, 0, 1); 
    } else {
        $firstLetter = 'T';
    }
@endphp

<li>
    <div class="d-flex">
        @for ($i = 0; $i < $val['level']; $i++)
            <div style="width:30px;"></div>
        @endfor
        <div>
            <div class="commentq position-relative">
                <span class="name">{{ $fullname }}</span>
                <span class="text-muted">{{ $timeComment }}</span>
                <p>{{ $content }}</p>
                <div class="roud-img text-light rounded-circle text-uppercase">{{$firstLetter}}</div>
            </div>
            <p class="mt-1">
                <span
                    class="text-primary repply-comment btn"
                    data-toggle="modal"
                    data-target="#replyModal"
                    data-commenter-name="{{ $fullname }}"
                    data-comment-id="{{ $val['id'] }}"
                >Trả lời</span>
            </p>
        </div>
    </div>
</li>
