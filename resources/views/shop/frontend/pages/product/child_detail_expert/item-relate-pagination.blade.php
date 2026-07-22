@if($listItemRelate->lastPage() > 1)
<nav>
    <ul class="pagination justify-content-center mb-0" id="itemPagination">
        <li class="page-item {{ $listItemRelate->currentPage() == 1 ? 'disabled' : '' }}">
            <a class="page-link" href="#" data-page="{{ $listItemRelate->currentPage() - 1 }}">‹</a>
        </li>
        @for($i = 1; $i <= $listItemRelate->lastPage(); $i++)
            <li class="page-item {{ $listItemRelate->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="#" data-page="{{ $i }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="page-item {{ $listItemRelate->currentPage() == $listItemRelate->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="#" data-page="{{ $listItemRelate->currentPage() + 1 }}">›</a>
        </li>
    </ul>
</nav>
@endif