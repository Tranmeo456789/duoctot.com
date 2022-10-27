<div class="card card-info">
    @include("$moduleName.blocks.x_title", ['title' => 'Thông tin khách hàng'])
    <div class="card-body p-0">
        <table class="table table-bordered table-striped table-hover table-head-fixed text-wrap" id="tbList">
            <thead>
                <tr>
                    <th class="text-center">Họ và tên</th>
                    <th class="text-center">Số điện thoại</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Địa chỉ</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $details = $item->details->pluck('value','user_field')->toArray()??[];
                @endphp
                <tr class="">
                    <td style="width: 20%">{{$item->fullname}}</td>
                    <td style="width: 20%">{{$item->phone}}</td>
                    <td style="width: 20%">{{$item->email}}</td>
                    <td style="width: 40%">{{$details['address'] ?? null}}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>