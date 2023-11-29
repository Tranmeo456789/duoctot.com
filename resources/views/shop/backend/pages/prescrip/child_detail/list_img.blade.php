@php
    use App\Helpers\Template as Template;
    use App\Helpers\MyFunction;
@endphp
<div class="card card-info">
    @include("$moduleName.blocks.x_title", ['title' => 'Ảnh khách hàng upload'])
    <div class="card-body p-0">
        <div class="row">
            @if(!empty($albumImageCurrent))
                @foreach($albumImageCurrent as $val)
                    <div class="col-6">
                        <img src="{{asset('fileUpload/prescrip/'.$val)}}" alt="">
                    </div>
                @endforeach
            @else
            <div class="col-6">Không có ảnh được upload</div>
            @endif
        </div>
    </div>
</div>