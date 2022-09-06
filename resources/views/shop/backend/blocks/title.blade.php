<div class="card-header font-weight-bold">
    {{$pageTitle ?? ''}}
    @if (isset($pageIndex) && ($pageIndex))
        <a href='{{route("$controllerName.add")}}' class="btn btn-primary btn-info float-right">Thêm mới</a>
    @else
    <a href='{{route("$controllerName")}}' class="btn btn-primary btn-info float-right">Quay về</a>
    @endif
</div>
