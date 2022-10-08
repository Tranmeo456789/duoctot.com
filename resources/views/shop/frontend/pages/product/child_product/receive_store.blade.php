<div class="col-12">
    <div class="row">
        <div class="col-xl-5 col-lg-12 marb-form">
            <div class="form-group">
                <select name="city3" class="form-control city2 select2" id="city2">
                    <option value="">--Chọn tỉnh thành phố--</option>
                    @foreach($itemsProvince as $key => $city)
                    <option value="{{$key}}">{{$city}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xl-5 col-lg-12 marb-form">
            <div class="form-group">
                <select name="district3" class="form-control district2 select2" id="district3">
                    <option value="">--Chọn quận huyện--</option>
                </select>
            </div>
        </div>
        <div class="col-10">
            <div class="position-relative">
                <p class="font-weight-bold mt-2">Có 2 nhà thuốc tại <span class="dcadrress">Hà Đông, Hà Nội</span></p>
                <div class="local_drugstore d-flex justify-content-between flex-wrap">
                    <div class="">
                        <div class="form-group m-0">
                            <div class="form-check1 m-0">
                                <input class="form-check-input dcshop" type="radio" name="dcshop" value="Tầng 01, Lô TM03, Tòa nhà CT6, Khu đô thị Văn Khê, P. La Khê,">
                                <label class="form-check-label" for="">
                                    Tầng 01, Lô TM03, Tòa nhà CT6, Khu đô thị Văn Khê, P. La Khê, <span class="dcadrress">Hà Đông, Hà Nội</span>
                                </label>
                            </div>
                        </div>
                        <span class="text-success">Có hàng</span>
                    </div>
                    <div><a href="">Xem bản đồ</a></div>
                </div>
                <div class="local_drugstore d-flex justify-content-between flex-wrap">
                    <div class="">
                        <div class="form-group m-0">
                            <div class="form-check m-0">
                                <input class="form-check-input dcshop" type="radio" name="dcshop" value="Tầng 01, Lô TM03, Tòa nhà CT6, Khu đô thị Văn Khê, P. La Khê,">
                                <label class="form-check-label" for="">
                                    Số 33, Nguyễn Công Trứ <span class="dcadrress">Hà Đông, Hà Nội</span>
                                </label>
                            </div>
                        </div>
                        <span class="text-success">Có hàng</span>
                    </div>
                    <div><a href="">Xem bản đồ</a></div>
                </div>
            </div>
        </div>
    </div>
</div>