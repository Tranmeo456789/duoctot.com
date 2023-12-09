@if(isset($countProduct) && $countProduct > 0)
<span class="mt-2 d-flex justify-content-center w-100 align-items-center">
    <span class="view-btn-add-product p-2 btn" data-type="{{$type??''}}" data-idcat="{{$idCat??null}}" data-offset="20" data-href="{{route('fe.product.loadMoreProducts')}}">
        <span size="20" class="mr-2 css-wi4pw5">
            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M18.9516 10.4793C19.2944 10.8392 19.2806 11.4088 18.9207 11.7517L12.6201 17.7533C12.2725 18.0844 11.7262 18.0844 11.3786 17.7533L5.07808 11.7517C4.71818 11.4088 4.70433 10.8392 5.04716 10.4793C5.38999 10.1193 5.95967 10.1055 6.31958 10.4483L11.9994 15.8586L17.6792 10.4483C18.0391 10.1055 18.6088 10.1193 18.9516 10.4793ZM18.9516 5.67926C19.2944 6.03916 19.2806 6.60884 18.9207 6.95167L12.6201 12.9533C12.2725 13.2844 11.7262 13.2844 11.3786 12.9533L5.07808 6.95167C4.71818 6.60884 4.70433 6.03916 5.04716 5.67926C5.38999 5.31935 5.95967 5.3055 6.31958 5.64833L11.9994 11.0586L17.6792 5.64833C18.0391 5.30551 18.6088 5.31935 18.9516 5.67926Z" fill="currentColor"></path>
            </svg>
        </span>
        <span class="css-15sc8tc">Xem thêm <span class="visibility-number-product">{{$countProduct??null}}</span> sản phẩm</span>
    </span>
</span>
@endif