@php
    use App\Model\Shop\QuangCaoModel;

    $itemsQuangCao = QuangCaoModel::where('status', 'active')->get();
    $xhtmlDesktop = '';
    $xhtmlMobile = '';
@endphp
@if (count($itemsQuangCao) > 0)
    @foreach($itemsQuangCao as $val)
        @php
            $urlImgDesktop = 'https:://tdoctor.vn/public/fileUpload/quangCao/'  . $val['banner_shop'];
            $urlImgMobile= 'https:://tdoctor.vn/public/fileUpload/quangCao/' . $val['banner_mobile'];
            $address = $val['url']??'#';

            $xhtmlDesktop .= "<a href='". $address ."'>
                                    <li class='item_banner_home text-center'>
                                        <img style='width:100%' src='" . $urlImgDesktop . "' alt=''>
                                    </li>
                                </a>";
            $xhtmlMobile .= "<a href='". $address ."'>
                            <li class='item_banner_home text-center'>
                                <img style='width:100%' src='" . $urlImgMobile . "' alt=''>
                            </li>
                        </a>";
        @endphp
    @endforeach
    <div class="row">
        <div class="col-12">
            <ul class="banner_doitac banner_doitac_desktop">
                {!! $xhtmlDesktop !!}
            </ul>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <ul class="banner_doitac banner_doitac_mobile">
                {!! $xhtmlDesktop !!}
            </ul>
        </div>
    </div>
@endif