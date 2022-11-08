<div class="form-search-inner">
    <h1>Tra Cứu Thuốc, TPCN, Bệnh lý...</h1>
    <form action="{{route('fe.search.saveHome')}}" method="POST">
        <input type="hidden" name="_token" value="<?php echo csrf_token(); ?>">
        <div class="position-relative">
            <input type="search" name="keyword" value="" placeholder="Nhập từ khóa...">
            <button type="submit" name="btn-search" value="1">
                <img src="{{asset('images/shop/icon-search.png')}}" alt="">
            </button>
        </div>
    </form>
    <h5 class="mt-3 mb-2">Tra cứu hàng đầu</h5>
        <ul class="d-flex justify-content-between">
            <li>
                <a>đau đầu</a>
            </li>
            <li>
                <a>mỏi vai gáy</a>
            </li>
            <li>
                <a>hoạt huyết dưỡng não</a>
            </li>
            <li>
                <a>thuốc ho</a>
            </li>
            <li>
                <a>thuốc cảm cúm</a>
            </li>
            <li>
                <a>thuốc cảm cúm</a>
            </li>
        </ul>
</div>