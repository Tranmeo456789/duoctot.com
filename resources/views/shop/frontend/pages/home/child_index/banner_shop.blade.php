@php
    use App\Model\Shop\QuangCaoModel;

    $itemsQuangCao = QuangCaoModel::where('status', 'active')->get();
    $xhtmlDesktop = '';
    $xhtmlMobile = '';
@endphp
@if (count($itemsQuangCao) > 0)
    @foreach($itemsQuangCao as $val)
        @php
            $urlImgDesktop = 'https://tdoctor.vn/public/fileUpload/quangCao/'  . $val['banner_shop'];
            $urlImgMobile= 'https://tdoctor.vn/public/fileUpload/quangCao/' . $val['banner_mobile'];
            $address = $val['url']??'#';

            $xhtmlDesktop .= "<a class='item d-block' href='". $address ."'>
                                    <div class='item_banner_home text-center'>
                                        <img style='width:100%' src='" . $urlImgDesktop . "' alt=''>
                                    </div>
                                </a>";
            $xhtmlMobile .= "<a class='item d-block' href='". $address ."'>
                            <div class='item_banner_home text-center'>
                                <img style='width:100%' src='" . $urlImgMobile . "' alt=''>
                            </div>
                        </a>";
        @endphp
    @endforeach
    
    <div id="banner_doitac">
        <div class="banner_doitac d-none d-md-block">
        {!! $xhtmlDesktop !!}
        </div>
        <div class="banner_doitac d-block d-md-none">
        {!! $xhtmlMobile !!}
        </div>
    </div>
@endif