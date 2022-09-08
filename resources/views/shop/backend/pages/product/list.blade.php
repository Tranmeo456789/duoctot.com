<table class="table table-striped" id="tbList" style="font-size:14px!important; border: none; table-layout: auto;width: 100%">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Sản phẩm</th>
            <th scope="col">Đơn vị</th>
            <th scope="col">Ngày tạo</th>
            <th scope="col">Tổng đơn đặt hàng</th>
            <th scope="col">Tồn trong kho của tôi</th>
            <th scope="col">Trạng thái</th>
            <th scope="col">Thao tác</th>
        </tr>
    </thead>
    @php
    $temp=0;
    @endphp
    <tbody>
        @foreach ($items as $val)
        @php
        $temp++;
        $arr_images=explode(",",$val->image);
        @endphp
        <tr>
            <td style="width: 3%">{{$temp}}</td>
            <td style="width: 35%">
                <div class="d-flex">
                    <div class="d-flex align-items-center">
                        <img style="width:40px" src="{{asset('public/shop/uploads/images/product/'.$arr_images[0])}}" alt="">
                    </div>
                    <div class="info-product ml-3">
                        <p class="text-success font-weight-bold">{{$val->name}}</p>
                        <p>ID: {{$val->id}}</p>
                        <p>Mã: {{$val->code}}</p>
                    </div>
                </div>
            </td>
            <td style="width: 5%">{{$val->unit}}</td>
            <td style="width: 11%">{{$val->create_at}}</td>
            <td style="width: 10%">0</td>
            <td style="width: 13%">{{$val->inventory}}</td>
            <td style="width: 8%"><span class="badge badge-success">Chờ kiểm duyệt</span></td>
            <td style="width: 15%">
                <a href="{{route('fe.product.detail',$val->id)}}" class="btn btn-info btn-sm rounded-0 text-white " type="button" data-toggle="tooltip" data-placement="top" title="Xem sản phẩm trên web"><i class="fas fa-eye rounded-circle"></i></a>
                <a href="{{route("$controllerName.edit",$val->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                <a data-href="{{route("$controllerName.delete",$val->id)}}" class="btn btn-sm btn-danger btn-delete text-white" data-id="{{$val->id}}" data-toggle="tooltip" data-placement="top" title="Xóa" data-token="{{csrf_token()}}">
                    <i class="fa fa-trash"></i>
                </a>
                <a href="{{route('dropzone.list_img',$val->id)}}" class="btn btn-danger btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Thêm ảnh sản phẩm"><i class="fas fa-plus"></i></a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>