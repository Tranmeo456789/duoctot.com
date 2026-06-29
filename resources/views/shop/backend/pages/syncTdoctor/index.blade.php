<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Đồng bộ từ Tdoctor</title>
</head>

<body>
    <h6>{{$notification ?? 'Trang chủ Sync'}}</h6>
    <h6>Đã đồng bộ {{$totalInserted ?? 0}} bản ghi</h6>
    <ul>
        <li class="nav-item">
            <ul class="nav nav-treeview">
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.transferUsers')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sync Users</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.transferUserToken')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sync UserToken</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.transferUserValues')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sync UserValues</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.transferWarehouses')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sync Warehouses</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.transferProducers')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sync Producers</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.transferUnits')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sync Units</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.transferTrademarks')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sync Trademarks</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.transferProducts')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sync Products</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.productWarehouse')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sync Warehouse</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.transferImportCoupon')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sync ImportCoupon</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.transferShopProductAdd')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Sync ShopProductAdd</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.updateProductsBySlug')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Cập nhật dữ liệu bảng Product</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.deleteAllCacheproduct')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Xóa cache tất cả sản phẩm</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.clearSearchCache')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Xóa cache tất cả từ khóa tìm kiếm</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.clearUserCache')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Xóa cache tất cả user</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.clearListBacSiCache')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Xóa cache danh sách Bác sĩ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.clearListDuocSiCache')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Xóa cache danh sách Dược sĩ</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.clearListNhaThuocCache')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Xóa cache danh sách Nhà thuốc</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.clearListBenhVienCache')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Xóa cache danh sách Bệnh Viện</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.clearListPhongKhamCache')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Xóa cache danh sách Phòng Khám</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.clearListShopChungCache')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Xóa cache danh sách Shop Chung</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.clearListTrinhDuocVienCache')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Xóa cache danh sách Trình Dược Viên</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.clearListMeVaBeCache')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Xóa cache danh sách Mẹ và Bé</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{route('fe.SyncTdoctor.clearListThamMyVien')}}" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Xóa cache danh sách Thẩm Mỹ Viện</p>
                    </a>
                </li>
            </ul>
        </li>
    </ul>
</body>

</html>