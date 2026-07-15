{{--
    Chấm tròn nhỏ hiển thị điểm SEO (kiểu đèn tín hiệu Yoast), dùng trong danh sách sản phẩm/bài viết.
    Cách dùng: @include('shop.backend.partials.seo-score-dot', ['score' => $product->score_seo])
    Nếu $score là null/rỗng thì không hiển thị gì cả.
--}}
@if(isset($score) && $score !== null && $score !== '')
    @php
        $scoreValue = (int) $score;
        if ($scoreValue >= 80) {
            $dotColor = '#2ecc71';
            $gradeLabel = 'Tốt';
        } elseif ($scoreValue >= 50) {
            $dotColor = '#f39c12';
            $gradeLabel = 'Trung bình';
        } else {
            $dotColor = '#e74c3c';
            $gradeLabel = 'Kém';
        }
        $dotStyle = 'display:inline-block;width:10px;height:10px;border-radius:50%;background:' . $dotColor . ';';
        $wrapStyle = 'display:inline-flex;align-items:center;gap:5px;font-size:12px;font-weight:700';
    @endphp
    <span class="seo-score-dot-badge" title="SEO: {{ $scoreValue }}/100 ({{ $gradeLabel }})" style="{{ $wrapStyle }}">
        SEO
        <span style="{{ $dotStyle }}"></span>
    </span>
@endif