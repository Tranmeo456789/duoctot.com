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