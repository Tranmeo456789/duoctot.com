<div class="col-12">
    <div class="form-group mb-0">
        <div class="form-check">
            <input class="form-check-input" type="checkbox" name="req_export" value="Yêu cầu xuất hóa đơn" id="reqexport">
            <label class="form-check-label mb-0" for="">
                Yêu cầu xuất hóa đơn
            </label>
        </div>
    </div>
    <div class="hidden_noreqes row">
        <div class="form-group col-12">
            <div class="form-check">
                <input class="form-check-input identity" type="radio" name="identity" id="company" value="Công ty" checked="checked">
                <label class="form-check-label" for="company">
                    Công ty
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input identity" type="radio" name="identity" id="person" value="Cá nhân">
                <label class="form-check-label" for="person">
                    Cá nhân
                </label>
            </div>
        </div>
        <div class="company col-12">
            <div class="row">
                <div class="col-xl-5 col-lg-12">
                    <div class="form-group">
                        <input class="form-control" id="namecompany" type="text" name="namecompany" autocomplete="off" placeholder="Nhập tên công ty">
                    </div>
                </div>
                <div class="col-xl-5 col-lg-12">
                    <div class="form-group">
                        <input class="form-control" id="taxcode" type="text" name="taxcode" autocomplete="off" placeholder="Nhập mã số thuế">
                    </div>
                </div>
                <div class="col-xl-5 col-lg-12">
                    <div class="form-group">
                        <input class="form-control" type="text" id="addresscompany" name="addresscompany" autocomplete="off" placeholder="Nhập địa chỉ công ty">
                    </div>
                </div>
            </div>
        </div>
        <div class="person col-12">
            <div class="row">
                <div class="col-xl-5 col-lg-12">
                    <div class="form-group">
                        <input class="form-control" type="text" id="name1" name="name1" autocomplete="off" placeholder="Nhập tên">
                    </div>
                </div>
                <div class="col-xl-5 col-lg-12">
                    <div class="form-group">
                        <input class="form-control phonecart2" type="text" id="phone1" name="phone1" autocomplete="off" placeholder="Nhập số điện thoại">
                    </div>
                </div>
                <div class="col-xl-5 col-lg-12">
                    <div class="form-group">
                        <input class="form-control" type="text" id="address1" name="address1" autocomplete="off" placeholder="Nhập địa chỉ">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>