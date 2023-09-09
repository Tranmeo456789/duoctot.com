<div class="card card-outline card-info">
    <div class="card-body px-2">
        <div class="form-group row">
            <div class="col-12">
                <div class="input-group" >
                    <div class="input-group-prepend">
                        <span class="input-group-text text-info"
                            style="border-radius: 50px;border-top-right-radius: 0;border-right:0;
                            border-bottom-right-radius: 0;background-color:#fff;line-height: unset;">
                            <i class="fas fa-map-marker-alt"></i>
                        </span>
                    </div>
                    <select class="form-control select2 district"
                        style="padding:8px 16px;border-radius: 50px;
                       " data-placeholder='Tỉnh Thành'>
                        <option>Quận, huyện</option>
                        @foreach ($itemsDistrict as $keyDistrict  => $valDistrict )
                            <option value="{{$keyDistrict}}">{{$valDistrict}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
        <div class="form-group row mt-2">
            <div class="col-12">
                <input type="text" name="form_price" value="" class="form-control"
                    placeholder="Giá từ" style="padding:8px 32px; border-radius: 50px;">
            </div>
        </div>
        <div class="form-group row  mt-2">
            <div class="col-12">
                <input type="text" name="to_price" value="" class="form-control"
                    placeholder="Giá đến" style="padding:8px 32px; border-radius: 50px;">
            </div>
        </div>
        <div class="form-group row mt-3">
            <div class="col-12 px-0 text-center">
                <button class="btn btn-info" style="border-radius:50px;text-transform:capitalize;padding:10px 40px;"><i class='fa fa-search'></i> &nbsp;Filter</button>
            </div>
        </div>
    </div>
</div>
<div class="card card-outline card-info mt-3">
    <div class="card-header">
        <h5 class="card-title mb-0">Tất cả</h5>
    </div>
    <div class="card-body p-2">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a href="{{route('fe.booking_online',['cate' => 'doctor'])}}" class="nav-link pl-0">
                    <i class="fas fa-heartbeat"></i> Bác sĩ
                    <span class="float-right badge bg-info text-white">{{$itemDoctorCount}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link pl-0">
                    <i class="fas fa-heartbeat"></i> Bệnh viện
                    <span class="float-right badge bg-info text-white">31</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('fe.booking_online',['cate' => 'clinic'])}}" class="nav-link pl-0">
                    <i class="fas fa-heartbeat"></i> Phòng khám
                    <span class="float-right badge bg-info text-white">{{$itemClinicCount}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{route('fe.booking_online',['cate' => 'drugstore'])}}" class="nav-link pl-0">
                    <i class="fas fa-heartbeat"></i> Nhà thuốc
                    <span class="float-right badge bg-info text-white">{{$itemDrugstoreCount}}</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link pl-0">
                    <i class="fas fa-heartbeat"></i> Công ty dược phẩm
                </a>
            </li>
            <li class="nav-item">
                <a href="#" class="nav-link pl-0">
                    <i class="fas fa-heartbeat"></i> Thẩm mỹ viện
                </a>
            </li>
        </ul>
    </div>
</div>