<div class="col-xl-5 col-lg-12">
    <div class="form-group">
        <input class="form-control name2" type="text" id="name2" name="name2" value="{{$item->fullname??''}}" autocomplete="off" placeholder="Nhập họ tên">
    </div>
</div>
<div class="col-xl-5 col-lg-12">
    <div class="form-group">
        <input class="form-control phone2 phonecart3" type="text" id="phone2" name="phone2" value="{{$item->phone??''}}" autocomplete="off" placeholder="Nhập số điện thoại">
    </div>
</div>
<div class="col-xl-5 col-lg-12 marb-form">
    <div class="form-group form-position-relative">
        <select name="city2" class="form-control choose city2 select2" id="city">
            @if(isset($item))
            @foreach($itemsProvince as $key => $city)
            <option value="{{$key}}" {{$item->province_id==$key? 'selected' : ''}}>{{$city}}</option>
            @endforeach
            @endif
        </select>
    </div>
</div>
<div class="col-xl-5 col-lg-12 marb-form">
    <div class="form-group form-position-relative">
        <select name="district2" class="form-control choose district2 select2" id="district2">
            <option value="">--Chọn quận huyện--</option>
            @if(isset($item))
            @foreach($itemsDistrict as $key => $district)
            <option value="{{$key}}" {{$item->district_id==$key? 'selected' : ''}}>{{$district}}</option>
            @endforeach
            @endif
        </select>
    </div>
</div>
<div class="col-xl-10 col-lg-12 marb-form">
    <div class="form-group form-position-relative">
        <select name="wards2" class="form-control wards2 select2" id="wards2">
            <option value="">--Chọn xã phường--</option>
            @if(isset($wardc))
            @foreach($itemsWard as $key => $ward)
            <option value="{{$key}}" {{$wardc==$key?'selected':''}}>{{$ward}}</option>
            @endforeach
            @endif
        </select>
    </div>
</div>
<div class="col-xl-10 col-lg-12">
    <div class="form-group">
        <input class="form-control addressdetail2" type="text" id="addressdetail2" name="addressdetail2" autocomplete="off" placeholder="Nhập địa chỉ *">
    </div>
</div>