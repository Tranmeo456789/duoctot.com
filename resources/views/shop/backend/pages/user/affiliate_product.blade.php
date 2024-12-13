@php
use App\Model\Shop\ProductModel;
use App\Model\Shop\AffiliateProductModel;
use App\Helpers\MyFunction;
use App\Helpers\Hightlight;
use App\Helpers\Template;
use Illuminate\Support\Str;

$xhtmlAreaSeach = Template::showAreaSearch('product', $params['search']);

@endphp
@extends('shop.layouts.backend')

@section('title','Chi tiết sản phẩm đại lý')
@section('content')
<section class="content">
    <div class="card card-outline card-primary mb800-0">
        <div class="card-body my-card-filter">
            <div class="row">
                <div class="col-12 col-md-7">{!! $xhtmlAreaSeach !!}</div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <table class="mb-0 table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
                        <tbody>
                            <tr>
                                <td colspan="3" style="width: 100%" class="text-center">
                                    <div class="wp-link-affiliate">
                                        <div>
                                            <p>Thông tin user affiliate: {{$userInfo['fullname']}}-{{$userInfo['phone']}}-{{$userInfo['email']}}</p>
                                        </div>
                                        @php
                                            $slugName = Str::slug($userInfo['fullname']);                                        
                                            $codeRef = $userInfo['codeRef'];
                                            $slug = $userInfo['slug'];
                                        @endphp
                                        <div class="text-center">Link chung</div>
                                        <div class="wp-link-affiliate">
                                            <a href="{{ url('/') . '?codeRef=' . $userInfo['codeRef'] }}" class="text-primary value-link d-inline-block" target="_blank">{{ url('/') . '?codeRef=' . $userInfo['codeRef'] }}</a>
                                            <span class="btn btn-sm btn-danger d-inline-block ml-2 btn-copy-link">
                                                <i class="far fa-copy"></i>
                                            </span>
                                        </div>
                                        
                                        <div class="text-center mt-2">Link Shop</div>
                                        <div class="wp-link-affiliate mb-3">
                                            <a href="{{ route('fe.product.drugstore', $slug) . '?codeRef=' . $userInfo['codeRef'] }}" class="text-primary value-link d-inline-block" target="_blank">{{ route('fe.product.drugstore', $slug) . '?codeRef=' . $userInfo['codeRef'] }}</a>
                                            <span class="btn btn-sm btn-danger d-inline-block ml-2 btn-copy-link">
                                                <i class="far fa-copy"></i>
                                            </span>
                                        </div>   
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2" style="width: 85%" class='text-center'>
                                    <span class="font-weight-bold">Tổng SLTT link</span>
                                </td>
                                <td scope="row" style="width: 15%" class="text-center">{{$sumLinkCount??0}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12">
                <div class="card card-outline card-primary">
                    <div class="mb-2"><small class="pl-2">*Ghi chú: hoa hồng sản phẩm được tính % theo tiền lãi của sản phẩm trên link của bạn khi đơn hàng hoàn tất</small></div>
                    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
                        <thead>
                            <tr class="row-heading">
                                <th>STT</th>
                                <th>Thông tin sản phẩm</th>
                                <th>SLTT link</th>
                            </tr>
                        </thead>
                        @php
                        $index=0;
                        $codeRef=$userInfo['codeRef'];
                        $sumQuantity=0;
                        $sumMoney=0;
                        @endphp
                        <tbody>
                        @if($infoProduct->count()>0)
                            @foreach ($infoProduct as $val)
                                @php
                                $index++;
                                $linkAffiliate=route('fe.product.detail', ['slug' => $val['slug'], 'codeRef' => $codeRef]);
                                $name = Hightlight::show($val['name'], $params['search'], 'name');
                                $moneyDiscountRef=($val['discount_ref']*$val['discount_tdoctor']/10000)*$val['price']??0;
                                $sumClick = array_key_exists($val->id, $infoProductClick) ? $infoProductClick[$val->id] : 0;
                                @endphp
                            <tr>
                                <td scope="row" style="width: 5%">{{$index}}</td>
                                <td style="width: 80%" class='name'>
                                    <div><span class="text-success">{!! $name !!}</span></div>
                                    <div>Giá: <span class="text-danger">{{MyFunction::formatNumber($val['price'])}} đ</span></div>
                                    <div>Hoa hồng(~): <span class="text-danger">{{MyFunction::formatNumber($moneyDiscountRef)}} vnđ</span></div>
                                    <div class="wp-link-affiliate">Link affiliate:
                                        <span class="btn btn-sm btn-primary show-link"><i class="fas fa-eye"></i></span>
                                        <a href="{{$linkAffiliate}}" class="text-primary value-link" target="_blank">{{$linkAffiliate}}</a>
                                        <span class="btn btn-sm btn-danger d-inline-block ml-2 btn-copy-link">
                                            <i class="far fa-copy"></i>
                                        </span>
                                    </div>
                                </td>
                                <td scope="row" style="width: 15%" class="text-center">{{ $sumClick }}</td>
                            </tr>
                            @endforeach
                        @else
                            @include("$moduleName.blocks.list_empty", ['colspan' => 2])
                        @endif
                        </tbody>
                    </table>
                </div>
                <div class="card-footer my-card-pagination clearfix">
                    @include("$moduleName.blocks.pagination",['paginator'=>$infoProduct])
                </div>
            </div>
            
        </div>
    </div>
</section>
@endsection