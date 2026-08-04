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

    .bg-info_page .data-counter {
        color: white;
        font-weight: bold;
        margin-bottom: 0;
        font-size: 25px;
        padding-bottom: 10px;
    }
</style>
<div class="bg-info_page container-fluid">
    <div class="has-bg clr row">
        <div class="span col-4 col-sm-2 m alone text-center py-2">
            <a href="{{route('fe.product.listPhongKham')}}">
                <div class="counter data-counter">5.450</div>
                <em>Phòng khám</em>
            </a>
        </div>
        <div class="span col-4 col-sm-2 m alone text-center py-2">
            <a href="{{route('fe.product.listBacSi')}}">
                <div class="counter data-counter">3.540</div>
                <em>Bác sĩ</em>
            </a>
        </div>
        <div class="span col-4 col-sm-2 m alone text-center py-2">
            <a href="{{route('fe.product.listDrugstore')}}">
                <div class="counter data-counter">26.020</div>
                <em>Nhà thuốc</em>
            </a>
        </div>
        <div class="span col-4 col-sm-2 m alone text-center py-2">
            <div class="counter data-counter">2,3 triệu</div>
            <em>Bệnh nhân</em>
        </div>
        <div class="span col-4 col-sm-2 m alone text-center py-2">
            <a href="{{route('fe.product.listNhaCungCap')}}">
                <div class="counter data-counter">520</div>
                <em>Nhà cung cấp</em>
            </a>
        </div>
        <div class="span col-4 col-sm-2 m alone text-center py-2">
            <a href="">
                <div class="counter data-counter">11.500</div>
                <em>Sản phẩm</em>
            </a>
        </div>
    </div>
</div>