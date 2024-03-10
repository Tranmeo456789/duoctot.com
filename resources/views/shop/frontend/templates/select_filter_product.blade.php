@php
$typeObject=$typeObject??'tre_em';
$idCat=$itemCatCurent['id'] ?? null;
@endphp

@if(isset($typeOrderBy))
    <div class="wp-slect-customer">
        <div class="slect-customer">
            <div class="d-flex gap-2">
                @foreach($items as $k=>$item)
                <div>
                    <span class="slect-item-customer {{$typeOrderBy == $item['slug'] ? 'active-slect' : ''}}" data-orderby="{{$item['slug']}}" data-href="{{route('fe.home.ajaxfilter')}}" data-offset="20" data-type="product_cat" data-idcat="{{$idCat}}">
                        <p>{{$item['name']}}</p>
                        <div class="icon-sticky">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.5 16.5858L4.70711 12.7929C4.31658 12.4024 3.68342 12.4024 3.29289 12.7929C2.90237 13.1834 2.90237 13.8166 3.29289 14.2071L7.79289 18.7071C8.18342 19.0976 8.81658 19.0976 9.20711 18.7071L20.2071 7.70711C20.5976 7.31658 20.5976 6.68342 20.2071 6.29289C19.8166 5.90237 19.1834 5.90237 18.7929 6.29289L8.5 16.5858Z" fill="currentColor"></path>
                                </svg>
                            </span>
                        </div>
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@else
    <div class="wp-slect-customer">
        <div class="slect-customer">
            <div class="d-flex gap-2">
                @foreach($items as $k=>$item)
                <div>
                    <span class="slect-item-customer {{$typeObject == $item['slug'] ? 'active-slect' : ''}}" data-object="{{$item['slug']}}" data-href="{{route('fe.home.ajaxfilter')}}" data-offset="10">
                        <p>{{$item['name']}}</p>
                        <div class="icon-sticky">
                            <span>
                                <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M8.5 16.5858L4.70711 12.7929C4.31658 12.4024 3.68342 12.4024 3.29289 12.7929C2.90237 13.1834 2.90237 13.8166 3.29289 14.2071L7.79289 18.7071C8.18342 19.0976 8.81658 19.0976 9.20711 18.7071L20.2071 7.70711C20.5976 7.31658 20.5976 6.68342 20.2071 6.29289C19.8166 5.90237 19.1834 5.90237 18.7929 6.29289L8.5 16.5858Z" fill="currentColor"></path>
                                </svg>
                            </span>
                        </div>
                    </span>
                </div>
                @endforeach
            </div>
        </div>
    </div>
@endif