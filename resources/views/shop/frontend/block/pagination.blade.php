@php
$currentPage = $items->currentPage();
$lastPage = $items->lastPage();
$visiblePages = 4;
$firstPage = 1;

$startPage = max($firstPage, $currentPage - floor($visiblePages / 2));

$endPage = min($lastPage, $startPage + $visiblePages - 1);

@endphp

<div class="pagination mt-3">
    @if ($startPage > $firstPage)
        <a href="{{ $items->url($currentPage - 1) }}" class="arrow">&laquo;</a>
        <a href="{{ $items->url($firstPage) }}" class="arrow">{{ $firstPage }}</a>
        <span class="ellipsis">...</span>
    @endif

    @for ($i = $startPage; $i <= $endPage; $i++)
        <a href="{{ $items->url($i) }}" class="{{ ($i == $currentPage) ? 'active' : '' }}">{{ $i }}</a>
    @endfor

    @if ($endPage < $lastPage)
        <span class="ellipsis">...</span>
        <a href="{{ $items->url($lastPage) }}">{{ $lastPage }}</a>
        <a href="{{ $items->url($currentPage + 1) }}" class="arrow">&raquo;</a>
    @endif
</div>