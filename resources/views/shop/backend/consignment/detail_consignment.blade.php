@extends('shop.layouts.backend')

@section('title',$pageTitle)
@section('content')

<section class="content">
    @include("$moduleName.blocks.notify")
    <div class="card mt-2 ml-1">
        <div class="card-body">
            <div class="mb-3 font-weight-bold">
                <span class="mr-4" style="font-size:24px">Thông tin chung</span><span class="badge badge-success">Chờ nhận hàng</span>
            </div>
            <div class="row">
                <div class="col-4">
                    <div class="form-group">
                        <label for="intro">Mã phiếu gửi hàng</label>
                        <input class="form-control" type="text" name="" id="" value="PGH667788" disabled>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="intro">Ngày gửi dự kiến</label>
                        <input class="form-control" type="text" name="" id="" value="10/10/2022" disabled>
                    </div>
                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="intro">Kho gửi Hàng</label>
                        <input class="form-control" type="text" name="" id="" value="Hà Nội" disabled>
                    </div>
                </div>
            </div>
            <label for="intro">Ghi chú</label>
            <textarea name="" class="form-control" id="" cols="" rows="3" placeholder="Thêm ghi chú tại đây"></textarea>

        </div>
    </div>
    <div class="card mt-2 ml-1">
        <div class="card-body">
            <div class="mb-3 font-weight-bold">
                <span class="mr-4" style="font-size:24px">Danh sách sản phẩm thêm vào phiếu gửi hàng</span>
            </div>
            <table class="table table-striped table-checkall" style="font-size:14px!important; border: none; table-layout: auto;width: 100%">
                <thead>
                    <tr>
                        <th scope="col">Sản phẩm</th>
                        <th scope="col">SL dự kiến</th>
                        <th scope="col">SL thực nhận</th>
                        <th scope="col">Đơn vị</th>
                        <th scope="col" >Lô</th>
                        <th scope="col" >Hạn sử dụng</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="">
                        <td style="width: 35%">
                        <div style="" class="d-flex">
                                <img style="width:60px;height:60px" src="image/images.jpg" alt="">
                                <div style="" class="info-product ml-3">
                                    <p class="text-success font-weight-bold">Tăm Bông Ráy Tai Hoa Trà My(12g)</p>
                                    <p>ID: 8866</p>
                                    <p>Mã: TB11</p>
                                </div>
                            </div>
                        </td>
                        <td style="width: 15%"><span>5</span></td>
                        <td style="width: 15%"><span>0</span></td>
                        <td style="width: 10%">Hộp</td>
                        <td style="width: 10%">138</td>
                        <td style="width: 15%">22-10-2025</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
    </section>
@endsection