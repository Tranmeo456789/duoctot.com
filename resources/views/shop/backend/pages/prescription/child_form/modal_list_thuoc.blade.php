<table class="table table-hover">
    <thead>
        <tr>
            <th>Mã</th>
            <th>Hoạt chất</th>
            <th>Tên thuốc</th>
            <th>Tên TDV</th>
            <th>ĐVT</th>
            <th>SKU</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @if($items && count($items) > 0)
            @foreach($items as $product)
            <tr>
                <td>{{ $product->code }}</td>
                <td></td>
                <td>{{ $product->name }}</td>
                <td></td>
                <td></td>
                <td></td>
                <td>
                    <button type="button" class="btn btn-primary btn-sm btn-them-thuoc-vao-tam"
                        data-id="{{ $product->id }}"
                        data-ma="{{ $product->code }}"
                        data-ten-thuoc="{{ $product->name }}">
                        Thêm
                    </button>
                </td>
            </tr>
            @endforeach
        @else
            <tr><td colspan="7" class="text-center">Không có dữ liệu</td></tr>
        @endif
    </tbody>
</table>

@if($items)
<div class="d-flex justify-content-center">
    {{ $items->links() }}
</div>
@endif