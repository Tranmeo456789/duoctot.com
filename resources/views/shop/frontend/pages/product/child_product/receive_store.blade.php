@php
use App\Model\Shop\WardModel;
@endphp
<div class="col-12">
    <div class="row">
        <div class="col-xl-5 col-lg-12 marb-form">
            <div class="form-group">
                <select name="city3" class="form-control city3 select2 choose-store" id="city3">
                    @foreach($itemsProvince as $key => $city)
                    <option value="{{$key}}" {{ 79 == $key? "selected" : ''}}>{{$city}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xl-5 col-lg-12 marb-form">
            <div class="form-group">
                <select name="district3" class="form-control district2 select2 choose-store" id="district3">
                    <option value="">--Chọn quận huyện--</option>
                    @foreach($itemsDistrictHCM as $key => $districtdHCM)
                    <option value="{{$key}}">{{$districtdHCM}}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-xl-10 col-lg-12">
            <div class="position-relative list-local-store">
                <div>
                    <p class="font-weight-bold mt-2">Có <span class="number-store-local">{{count($storeHCM)}}</span> nhà thuốc tại <span class="dcadrress">Hồ Chí Minh</span></p>
                </div>
                @foreach($storeHCM as $item)
                    @php
                        $details = $item->details->pluck('value', 'user_field')->toArray();
                    @endphp
                    @if ($details != null)
                    @if ($details['address'] != null)
                        @php
                            $wards = (new WardModel)->getItem(['id' => $details['ward_id']], ['task' => 'get-item-full']);
                            $ward = $wards->name;
                            $district = $wards->district->name;
                            $province = $wards->district->province->name;
                        @endphp
                           
                        <div class="local_drugstore d-flex justify-content-between flex-wrap">
                            <div>
                                <div class="form-group m-0">
                                    <div class="form-check1 m-0">
                                        <input type="hidden" name="shop_id" value="{{$item['user_id']}}">
                                        <input class="form-check-input dcshop" type="radio" name="dcshop" value="{{$details['address']}}, {{$ward}}, {{$district}}, {{$province}}">
                                        <label class="form-check-label" for="">
                                            {{$details['address']}}, {{$ward}}, {{$district}}, {{$province}}</span>
                                        </label>
                                    </div>
                                </div>
                                <span class="text-success">Có hàng</span>
                            </div>
                            <div><a href="">Xem bản đồ</a></div>
                        </div>
                    @endif
                    @endif
                @endforeach
            </div>
        </div>
    </div>
</div>