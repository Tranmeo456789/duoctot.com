<div class="overlay"></div>
<div class="wp-inner">
    <div class="row mx-0" style="padding: 110px 0px;" >
        <div class="search-form-inner" style="background-color: #c3c3c3;">
            <div class="row mx-1">
                <div class="col-md-3 col-sm-6 col-12 pr-0">
                    <div class="form-group row mb-0">
                        <div class="col-12">
                            <input type="text" name="keyword" value="" class="form-control"
                                placeholder="Từ khóa" style="padding:8px 32px; border-radius: 50px;border:none">
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12 pr-0">
                    <div class="form-group row mb-0">
                        <div class="col-12">
                            <div class="input-group" >
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-info"
                                        style="border-radius: 50px;border-top-right-radius: 0;
                                        border-bottom-right-radius: 0;
                                        border:none; background-color:#fff;line-height: unset;">
                                        <i class="fas fa-map-marker-alt"></i>
                                    </span>
                                </div>
                                <select class="form-control select2 provice"
                                    style="padding:8px 16px;;border:none;border-radius: 50px;
                                    border-top-left-radius: 0;
                                    border-bottom-left-radius: 0;" data-placeholder='Tỉnh Thành'>
                                    <option>Tỉnh thành</option>
                                    @foreach ($itemsProvince as $keyProvince => $valProvince)
                                        <option value="{{$keyProvince}}">{{$valProvince}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12 pr-0">
                    <div class="form-group row pr-0 mb-0">
                        <div class="col-12 px-0">
                            <div class="input-group" >
                                <input type="text" name="date"
                                value="" class="form-control datemask"
                                placeholder="dd/mm/yyyy" style="padding:8px 32px;border:0;
                                border-radius: 50px;
                                border-top-right-radius: 0;
                                        border-bottom-right-radius: 0;">
                                <div class="input-group-prepend">
                                    <span class="input-group-text text-info"
                                        style="border-radius: 50px;border-top-left-radius: 0;
                                        border-bottom-left-radius: 0;
                                        border:none; background-color:#fff;
                                        line-height: unset;">
                                        <i class="fas fa-calendar-alt"></i>
                                    </span>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="form-group row mb-0">
                        <div class="col-12 px-0 text-right">
                            <button class="btn btn-info" style="border-radius:50px;text-transform:capitalize;padding:7px 40px;">Search</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>