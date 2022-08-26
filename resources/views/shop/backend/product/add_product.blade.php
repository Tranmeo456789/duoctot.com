@extends('shop.layouts.backend')

@section('title', 'Thêm sản phẩm')

@section('header_title', 'Thêm sản phẩm')

@section('body_content') 
    <div class="card mt-2 ml-1">
        <div class="card-header font-weight-bold">
            Thêm sản phẩm
        </div>
        <div class="card-body">
            <form>
                <div class="form-group">
                    <label for="name">Tên sản phẩm <span class="text-danger" >*</span></label>
                    <input class="form-control" type="text" name="" id="" placeholder="Nhập tên sản phẩm" >
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="name">Loại sản phẩm<span class="text-danger" >*</span></label>
                            <select class="form-control" id="">
                                <option>Chọn loại sản phẩm</option>
                                <option>Sản phẩm loại thường</option>
                                <option>Quà tặng</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="intro">Mã sản phẩm<span class="text-danger" >*</span></label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="name">Ngành hàng<span class="text-danger" >*</span></label>
                            <select class="form-control" id="">
                                <option>Chọn ngành hàng</option>
                                <option>Dược mỹ phẩm</option>
                                <option>Hàng tiêu dùng</option>
                                <option>Thiết bị y tế</option>
                                <option>Thuốc</option>
                                <option>Vật tư y tế</option>

                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="intro">Nhà sản xuất<span class="text-danger" >*</span></label>
                            <select class="form-control" id="">
                                <option>Chọn nhà sản xuất</option>
                                <option>Công ty cổ phần dược</option>
                                <option>Công ty cổ phần dược HD</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="name">Chiều dài (mm)</label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="intro">Chiều rộng(mm)</label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="name">Chiều cao (mm)</label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="intro">Khối lượng (gram)</label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <input type="checkbox" name="checkall">
                            <label for="name">Hàng dễ vỡ</label>
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <input type="checkbox" name="checkall">
                            <label for="intro">Hàng bảo quản lạnh</label>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="name">Loại giá bán hàng<span class="text-danger" >*</span></label>
                            <select class="form-control" id="">
                                <option>Giá bán hàng niêm yết</option>
                                <option>Giá bán hàng theo doanh thu</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="intro">Giá bán sản phẩm(chưa VAT)<span class="text-danger" >*</span></label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="intro">Hệ số VAT(%)</label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="intro">Loại VAT</label>
                            <select class="form-control" id="">
                                <option>Có VAT</option>
                                <option>a</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="intro">Giá bán sản phẩm(chưa VAT)<span class="text-danger" >*</span></label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="intro">Quy cách đóng gói<span class="text-danger" >*</span></label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                    <div class="col-lg-3 col-sm-6">
                        <div class="form-group">
                            <label for="intro">Đơn vị<span class="text-danger" >*</span></label>
                            <select class="form-control" id="">
                                <option>Hộp</option>
                                <option>Chai</option>
                                <option>Gói</option>
                                <option>Túi</option>
                                <option>Tube</option>
                                <option>Hũ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="intro">Đăng ký bán sản phẩm tại<span class="text-danger" >*</span></label>
                            <select id="choices-multiple-remove-button" placeholder="Chọn khu vực" multiple>
                                <option value="">Toàn quốc</option>
                                <option value="">Hà Nội</option>
                                <option value="">TP Hồ Chí Minh</option>
                                <option value="">Đà Nẵng</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="intro">Số lượng đặt hàng tối đa</label>
                            <input class="form-control" type="text" name="" id="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-sm-12">
                        <div class="form-group">
                            <label for="intro">Tồn trong kho của tôi<span class="text-danger" >*</span></label>
                            <input class="form-control" type="number" name="" id="">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name">Hình ảnh sản phẩm<span class="text-danger" >*</span></label>
                    <div class="wrap">
                        <div class="dandev-reviews">
                            <div class="form_upload">
                                <label class="dandev_insert_attach"><span>Chọn hình ảnh sản phẩm</span></label>
                            </div>
                            <div class="list_attach">
                                <ul class="dandev_attach_view">
                                </ul>
                                <div><span class="dandev_insert_attach"><i class="dandev-plus">+</i></span></div>
                            </div>
                        </div>
                    </div>
                </div>
                <input style="height:1px;border:none;background: white;" class="form-control" type="text" name="" id="" disabled>
                <label for="intro">Thông tin chung</label>
                 <textarea name="" class="form-control" id="intro" cols="30" rows="5"></textarea>
                <div class="form-group">
                    <label for="intro">Chỉ định</label>
                    <textarea name="" class="form-control" id="intro" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="intro">Liều lượng - Cách dùng</label>
                    <textarea name="" class="form-control" id="intro" cols="30" rows="5"></textarea>
                </div>
                <div class="form-group">
                    <label for="intro">Chống chỉ định</label>
                    <textarea name="" class="form-control" id="intro" cols="30" rows="5"></textarea>
                </div>
                <div class="text-center"><button type="submit" class="btn btn-primary">Thêm mới</button></div>
            </form>
        </div>
    </div>

@endsection