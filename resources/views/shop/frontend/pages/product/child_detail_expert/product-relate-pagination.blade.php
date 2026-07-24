@if($listProductRelate->lastPage() > 1)
@php
    $current = $listProductRelate->currentPage();
    $last = $listProductRelate->lastPage();
    $onEachSide = 1; // số trang hiện quanh trang hiện tại (bên trái/phải)
    $pages = [];
    // Luôn hiện 2 trang đầu
    for ($i = 1; $i <= min(2, $last); $i++) {
        $pages[] = $i;
    }
    // Trang quanh trang hiện tại
    $start = max($current - $onEachSide, 3);
    $end = min($current + $onEachSide, $last - 2);
    if ($start > 3) {
        $pages[] = '...';
    }
    for ($i = $start; $i <= $end; $i++) {
        if ($i > 2 && $i < $last - 1) {
            $pages[] = $i;
        }
    }
    if ($end < $last - 2) {
        $pages[] = '...';
    }
    // Luôn hiện 2 trang cuối
    for ($i = max($last - 1, 3); $i <= $last; $i++) {
        if (!in_array($i, $pages)) {
            $pages[] = $i;
        }
    }
    // Loại trùng, giữ thứ tự
    $pages = array_values(array_unique($pages, SORT_REGULAR));
@endphp
<div class="pagination-scroll-wrapper">
    <nav>
        <ul class="pagination justify-content-center mb-0" id="productPagination">
            <li class="page-item {{ $current == 1 ? 'disabled' : '' }}">
                <a class="page-link" href="#" data-page="{{ $current - 1 }}">«</a>
            </li>
            @foreach($pages as $p)
                @if($p === '...')
                    <li class="page-item disabled">
                        <span class="page-link">…</span>
                    </li>
                @else
                    <li class="page-item {{ $current == $p ? 'active' : '' }}">
                        <a class="page-link" href="#" data-page="{{ $p }}">{{ $p }}</a>
                    </li>
                @endif
            @endforeach
            <li class="page-item {{ $current == $last ? 'disabled' : '' }}">
                <a class="page-link" href="#" data-page="{{ $current + 1 }}">»</a>
            </li>
        </ul>
    </nav>
</div>
@endif