@php
use App\Helpers\Template;
use App\Helpers\Hightlight;
$xhtmlAreaSeach = Template::showAreaSearch($controllerName, $params['search']);
$arrTypeUser = config('myconfig.template.type_user');
$temp=0;
@endphp

@extends('shop.layouts.backend')

@section('title',$pageTitle)
@section('content')

<section class="content">
    <div class="container-fluid">
        @include("$moduleName.blocks.notify")
        <div class="card card-outline card-primary mb800-0">
            <div class="card-body my-card-filter">
                <div class="row">
                    <div class="col-12 col-md-7">{!! $xhtmlAreaSeach !!}</div>
                </div>
            </div>
        </div>
        <div class="card card-outline card-primary">
            @include("$moduleName.blocks.x_title", ['title' => 'Danh sách người dùng đã nhập mã giới thiệu'])
            <div class="card-body p-0">
                <div class="set-withscreen">
                    <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
                        <thead>
                            <tr class="row-heading">
                                <th>#</th>
                                <th>Họ tên</th>
                                <th>Email, Số điện thoại</th>
                                <th>Thuộc đối tượng</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($items) > 0)
                            @foreach ($items as $val)
                            @php
                            $temp++;
                            $email = Hightlight::show($val->email, $params['search'], 'email') ?? '';
                            $fullname = Hightlight::show($val->fullname, $params['search'], 'fullname') ?? '';
                            $phone = Hightlight::show($val->phone, $params['search'], 'phone') ?? '';
                            $userType=$arrTypeUser[$val->user_type_id]??'';
                            @endphp
                            <tr>
                                <th scope="row" style="width: 5%">{{$temp}}</th>
                                <td style="width: 30%">{!! $fullname !!}</td>
                                <td style="width: 40%">
                                    <div>{!! $email !!}</div>
                                    <div class="font-weight-bold">{!! $phone !!}</div>
                                </td>
                                <td style="width: 25%">{{$userType}}</td>
                            </tr>
                            @endforeach
                            @else
                            @include("$moduleName.blocks.list_empty", ['colspan' => 6])
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="card-footer my-card-pagination clearfix">
                @include("$moduleName.blocks.pagination",['paginator'=>$items])
            </div>
        </div>

    </div>
</section>
@endsection