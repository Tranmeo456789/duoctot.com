<style>
    .bg-info_page {
        background: #05afe3;
        color: white;
        padding-bottom: 20px;
        padding-top: 20px;
        font-size: 18px;
    }

    .bg-info_page em {
        color: white;
    }

    .bg-info_page h5 {
        color: white;
        font-weight: bold;
        margin-bottom: 0;
        font-size: 25px;
        padding-bottom: 10px;
    }
</style>
<div class="container bg-info_page">
    <div class="has-bg clr row">
        <div class="span col-4 col-sm-2 m alone text-center mb-3">
            <a href="{{route('fe.product.listPhongKham')}}">
                <h5 class="counter ctr1">5380</h5>
                <em>Phòng khám</em>
            </a>
        </div>
        <div class="span col-4 col-sm-2 m alone text-center mb-3">
            <a href="{{route('fe.product.listBacSi')}}">
                <h5 class="counter ctr2">3530</h5>
                <em>Bác sĩ</em>
            </a>
        </div>
        <div class="span col-4 col-sm-2 m alone text-center mb-3">
            <a href="{{route('fe.product.listDrugstore')}}">
                <h5 class="counter ctr3">20000</h5>
                <em>Nhà thuốc</em>
            </a>
        </div>
        <div class="span col-4 col-sm-2 m alone text-center mb-3">
            <h5 class="counter ctr4">31856</h5>
            <em>Bệnh nhân</em>
        </div>
        <div class="span col-4 col-sm-2 m alone text-center mb-3">
            <a href="{{route('fe.product.listNhaCungCap')}}">
                <h5 class="counter ctr4">200</h5>
                <em>Nhà cung cấp</em>
            </a>
        </div>
        <div class="span col-4 col-sm-2 m alone text-center mb-3">
            <a href="">
                <h5 class="counter ctr4">9000</h5>
                <em>Sản phẩm</em>
            </a>
        </div>
    </div>
</div>