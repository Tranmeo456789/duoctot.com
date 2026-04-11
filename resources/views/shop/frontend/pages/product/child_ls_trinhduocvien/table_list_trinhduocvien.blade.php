<div class="table-responsive table-list-drugstore">
    <table class="table table-bordered">
        <thead class="custom-thead">
            <tr>
                <th style="width: 15%;" class="text-center">Hình ảnh TDV</th>
                <th style="width: 50%;" class="text-center">Thông tin TDV</th>
                <th class="d-none d-md-table-cell text-center" style="width: 20%;">Dịch vụ</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $val)
            <tr>
                <td>
                    <div class="wp-img">
                        <a href="{{ $val->linkShop }}">
                            <img 
                                src="{{ $val->imgThumb }}" 
                                alt="tdoctor"
                                loading="lazy"
                                width="100"
                                height="100"
                            >
                        </a>
                    </div>
                </td>
                <td>
                    <a href="{{ $val->linkShop }}" class="text-danger font-weight-bold">
                        {{ $val->fullname }}
                    </a>
                    <div class="info-drustore mt-2">
                        <ul class="list-unstyled address__list">
                            <li class="mb-2">
                                <img src="{{ asset('public/images/shop/dc1.png') }}" width="30">
                                <span>Địa chỉ: {{ $val->address }}</span>
                            </li>
                            <li class="mb-2">
                                <img src="{{ asset('public/images/shop/dc3.png') }}" width="30">
                                <span>Mở cửa: 6h - 22h</span>
                            </li>
                            <li>
                                <img src="{{ asset('public/images/shop/dc4.png') }}" width="30">
                                <span>Số điện thoại: {{ $val->phoneFormatted }}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="text-center">
                        <a href="{{ $val->linkShop }}" class="btn btn-sm btn-primary">
                            Chi tiết
                        </a>
                    </div>
                </td>
                <td class="d-none d-md-table-cell">
                    @php
                        $services = [
                            'Nhà thuốc chính hãng',
                            'Dược sỹ tư vấn tại chỗ',
                            'Giao hàng tận nơi',
                            'Chuyên thuốc theo toa',
                            'Mua lẻ với giá sỉ',
                            'Đổi trả nguyên giá'
                        ];
                    @endphp
                    @foreach($services as $service)
                        <div class="icheck-info">
                            <input type="checkbox" checked readonly>
                            <label>{{ $service }}</label>
                        </div>
                    @endforeach
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
        {!! $items->appends(request()->input())->links('shop.frontend.pages.pagination.pagination_admin') !!}
    </div>
</div>