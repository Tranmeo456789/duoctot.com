<div class="container-slider mt-0 mt-lg-2 position-relative">
    @if(empty($albumImageCurrent))
    <div class="text-center">
        <img class="border border-secondary rounded" src="{{ $imageSrc }}" alt="tdoctor">
    </div>
    @else
    <button class="prev-btn position-absolute" style="left: 0;">‹</button>
    <div class="banner_doitac cS-hidden">
        <div class="swiper-slide text-center">
            <img class="border border-secondary rounded" src="{{ $imageSrc }}" alt="tdoctor">
        </div>
        @foreach($albumImageCurrent as $val)
        <div class="swiper-slide text-center">
            <img src="{{ asset('laravel-filemanager/fileUpload/user/'.$val) }}" class="img-thumbnail" loading="lazy" alt="tdoctor" />
        </div>
        @endforeach
    </div>
    <button class="next-btn position-absolute" style="right: 0;">›</button>
    @endif
</div>