<div class="content-header">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6">
                <h1>{{ $pageTitle }}</h1>
            </div>
            <div class="col-md-6 d-flex justify-content-end">
                @if (isset($pageIndex) && ($pageIndex))
                <a href='{{route("$controllerName.add")}}' class="btn btn-primary btn-info float-right">Thêm mới</a>
            @else
                <a href='{{route("$controllerName")}}' class="btn btn-primary btn-info float-right">Quay về</a>
            @endif
            </div>
        </div> <!-- /.row -->
    </div><!-- /.container-fluid -->
</div>