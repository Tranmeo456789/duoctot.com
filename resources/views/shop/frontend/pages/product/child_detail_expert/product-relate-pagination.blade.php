@if($listProductRelate->lastPage() > 1)
<nav>
    <ul class="pagination justify-content-center mb-0" id="productPagination">
        <li class="page-item {{ $listProductRelate->currentPage() == 1 ? 'disabled' : '' }}">
            <a class="page-link" href="#" data-page="{{ $listProductRelate->currentPage() - 1 }}">‹</a>
        </li>
        @for($i = 1; $i <= $listProductRelate->lastPage(); $i++)
            <li class="page-item {{ $listProductRelate->currentPage() == $i ? 'active' : '' }}">
                <a class="page-link" href="#" data-page="{{ $i }}">{{ $i }}</a>
            </li>
        @endfor
        <li class="page-item {{ $listProductRelate->currentPage() == $listProductRelate->lastPage() ? 'disabled' : '' }}">
            <a class="page-link" href="#" data-page="{{ $listProductRelate->currentPage() + 1 }}">›</a>
        </li>
    </ul>
</nav>
@endif