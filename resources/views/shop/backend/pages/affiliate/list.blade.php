@php
    use App\Helpers\Hightlight;
    use App\Helpers\MyFunction;
    use App\Model\Shop\CouponPaymentModel;
    use App\Model\Shop\AffiliateModel;
    use App\Model\Shop\AffiliateProductModel;
    $arrTypeUser = config('myconfig.template.type_user');
@endphp
<table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
    <thead>
        <tr class="row-heading">
            <th>STT</th>
            <th>Mã đại lý</th>
            <th>Thông tin đại lý</th>
            <th>Số dư(hoa hồng)</th>
            <th>Tác vụ</th>
        </tr>
    </thead>
    @php
        $index=0;
    @endphp
    <tbody>
        @if($items->count()>0)
            @foreach ($items as $val)
            @php
                $index++;
                $codeRef = Hightlight::show($val->code_ref, $params['search'], 'code_ref');
                $userRef=$val->userRef;
                $fullname = Hightlight::show($userRef['fullname'], $params['search'], 'fullname');
                $phone = Hightlight::show($userRef['phone'], $params['search'], 'phone');
                $email = Hightlight::show($userRef['email'], $params['search'], 'email');
                $sumPayment=(new CouponPaymentModel)->sumMoney(['code_ref'=>$codeRef],['task'=>'tinh-tong-tien-affiliate']);
                $sumMoney=(new AffiliateModel)->sumMoneyRefAffiliate($codeRef);
                $sumLinkCount = AffiliateProductModel::where('code_ref', $codeRef)->sum('sum_click')+$val['sum_click'];
                $restMoney=$sumMoney-$sumPayment;
            @endphp
            <tr>
                <th scope="row" style="width: 10%">{{$index}}</th>
                <td style="width: 25%" class='name'><p>{!! $codeRef !!}</p></td>
                <td style="width: 35%" class='text-justify'>
                    <div>Họ tên: {!! $fullname !!}</div>
                    <div>Số ĐT: {!! $phone !!}</div>
                    <div>Email: {!! $email !!}</div>
                    <div>Thuộc đối tượng: {{$arrTypeUser[$userRef->user_type_id??1]}}</div>
                    <div>Số lượng traffic: {{$sumLinkCount??''}}</div>
                </td>
                <td style="width: 15%" class='text-center'><p>{{MyFunction::formatNumber($restMoney??0)}} đ</p></td>
                <td style="width: 25%">
                    <a href="{{route("$controllerName.detail",$val->id)}}" class="btn btn-info btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="xem chi tiết"><i class="fa fa-eye"></i></a>
                    <a href="{{route("$controllerName.edit",$val->id)}}" class="btn btn-success btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Sửa"><i class="fa fa-edit"></i></a>
                    <a href="{{route("couponPayment.add",['codeRef'=>$val['code_ref']])}}" class="btn btn-warning btn-sm rounded-0 text-white" type="button" data-toggle="tooltip" data-placement="top" title="Thanh toán bằng tay hoa hồng"><i class="fas fa-money-check-alt"></i></a>
                    <a data-href="{{route("$controllerName.delete",$val->id)}}" class="btn btn-sm btn-danger btn-delete text-white" data-id="{{$val->id}}" data-toggle="tooltip" data-placement="top" title="Xóa"  data-token="{{csrf_token()}}" >
                        <i class="fa fa-trash"></i>
                    </a>
                </td>
            </tr>
            @endforeach
        @else
            @include("$moduleName.blocks.list_empty", ['colspan' => 5])
        @endif
    </tbody>
</table>