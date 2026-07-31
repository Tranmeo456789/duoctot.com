<div class="container-slider mt-0 mt-lg-2 position-relative">
    @if(empty($albumImageCurrent))
    <div class="text-center">
        <img class="image-zoom-popup" src="{{ $imageSrc }}" alt="tdoctor" style="max-height: 250px;">
    </div>
    @else
    <button class="prev-btn position-absolute" style="left: 0;">‹</button>
    <div class="list_thumb_user cS-hidden">
        <div class="swiper-slide text-center">
            <img src="{{ $imageSrc }}" alt="tdoctor" style="max-height: 250px;">
        </div>
        @foreach($albumImageCurrent as $val)
        <div class="swiper-slide text-center">
            <img src="{{ asset('public/fileUpload/user/'.$val) }}" class="img-thumbnail image-zoom-popup" loading="lazy" alt="tdoctor" style="max-height: 250px;" />
        </div>
        @endforeach
    </div>
    <button class="next-btn position-absolute" style="right: 0;">›</button>
    @endif
</div>