@php
    use App\Model\Shop\ConfigModel;

    $hotline = ConfigModel::where('name', 'hotline_duoc')->first()->content ?? '';

@endphp
<div class="table-responsive table-list-drugstore">
    <table class="table table-bordered">
        <thead class="custom-thead">
            <tr>
                <th style="width: 15%;" class="text-center">Hình ảnh Shop</th>
                <th style="width: 50%;" class="text-center">Thông tin Shop</th>
                <th class="d-none d-md-table-cell text-center" style="width: 20%;">Dịch vụ</th>
                <th class="d-none d-md-table-cell text-center" style="width: 15%;">Khu vực</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $val)
            @php
                $drugstore = isset($val->drugstore)?$val->drugstore:null;
                $imgThumb = '';

                if (isset($val['details']['image']) && $val['details']['image'] != ''){
                    $imgThumb = 'https://tdoctor.net' .$val['details']['image'] ;
                } else{
                    if (isset($drugstore['profile_image'])){
                        $imgThumb = 'https://tdoctor.vn/public/images/health_facilities/'. $drugstore['profile_image'];
                    }
                }
                $slug = $val['details']['slug']??($drugstore['drugstore_url']??'');
                $linkShop = route('home') . '/' . $slug . '.html?shopId=' . $val['user_id'];
            @endphp
            <tr>
                <td>
                    <div class="wp-img">
                        <a href="{{$linkShop}}">
                            <img src="{{$imgThumb}}" alt="">
                        </a>
                    </div>
                </td>
                <td>
                    <a href="{{$linkShop}}" class="text-danger font-weight-bold">
                        <span>{{$val['fullname']}}</span>
                    </a>
                    <div class="info-drustore mt-2">
                        <ul class="list-unstyled address__list">
                            <li class="mb-2">
                                <img src="{{asset('public/images/shop/dc1.png')}}" alt="Head Office Tdoctor.vn">
                                <span>Địa chỉ : {{$val['details']['address']??($drugstore['drugstore_address']??'')}}</span>
                            </li>
                            <li class="mb-2">
                                <img src="{{asset('public/images/shop/dc3.png')}}" alt="Hotline Tdoctor.vn">
                                <span>Mở cửa: lúc 6h sáng đến 10h tối</span>
                            </li>
                            <li>
                                <img src="{{asset('public/images/shop/dc4.png')}}" alt="MST của Tdoctor.vn">
                                <span>Số điện thoại: {{($val['phone'] != '') ?$val['phone']:$hotline}}</span>
                            </li>
                        </ul>
                    </div>
                    <div class="text-center">
                        <a href="{{$linkShop}}" class="btn btn-sm btn-primary">Chi tiết</a>
                    </div>
                </td>
                <td class="d-none d-md-table-cell">
                    <div class="icheck-info">
                        <input type="checkbox" class="check-input-readonly" checked readonly />
                        <label for="someCheckboxId">Nhà thuốc chính hãng</label>
                    </div>
                    <div class="icheck-info">
                        <input type="checkbox" class="check-input-readonly" checked readonly />
                        <label for="someCheckboxId">Dược sỹ tư vấn tại chỗ</label>
                    </div>
                    <div class="icheck-info">
                        <input type="checkbox" class="check-input-readonly" checked readonly />
                        <label for="someCheckboxId">Giao hàng tận nơi</label>
                    </div>
                    <div class="icheck-info">
                        <input type="checkbox" class="check-input-readonly" checked readonly />
                        <label for="someCheckboxId">Dược sỹ tư vấn tại chỗ</label>
                    </div>
                    <div class="icheck-info">
                        <input type="checkbox" class="check-input-readonly" checked readonly />
                        <label for="someCheckboxId">Chuyên thuốc theo toa</label>
                    </div>
                    <div class="icheck-info">
                        <input type="checkbox" class="check-input-readonly" checked readonly />
                        <label for="someCheckboxId">Mua lẻ với giá sỉ</label>
                    </div>
                    <div class="icheck-info">
                        <input type="checkbox" class="check-input-readonly" checked readonly />
                        <label for="someCheckboxId">Đổi trả nguyên giá</label>
                    </div>
                </td>
                <td class="d-none d-md-table-cell">Khu vực 1</td>
            </tr>
            @endforeach
        </tbody>
    </table>
    <div class="pagination">
   		{!! $items->appends(request()->input())->links('shop.frontend.pages.pagination.pagination_admin'); !!}
    </div>
</div>