@php
    use App\Model\Shop\QuangCaoModel;

    $itemsQuangCao = QuangCaoModel::where('status', 'active')->get();
    $xhtmlDesktop = '';
    $xhtmlMobile = '';
    $indicatorsDesktop = '';
    $indicatorsMobile = '';
@endphp
@if (count($itemsQuangCao) > 0)
    @foreach($itemsQuangCao as $key => $val)
        @php
            $urlImgDesktop = 'https://tdoctor.vn/public/fileUpload/quangCao/'  . $val['banner_shop'];
            $urlImgMobile= 'https://tdoctor.vn/public/fileUpload/quangCao/' . $val['banner_mobile'];
            $address = $val['url']??'#';
            $active = ($key == 0) ?"active":'';
            $indicatorsDesktop .=  "<li data-target='#carouselDesktop' data-slide-to='$key' class='$active'></li>";
            $indicatorsMobile .=  "<li data-target='#carouselMobile' data-slide-to='$key' class='$active'></li>";
            $xhtmlDesktop .= " <div class='carousel-item  $active' >
                <a href='". $address ."'>
                    <img class='d-block w-100' src='" . $urlImgDesktop . "' alt='Second slide'>
                </a>
              </div>";
            $xhtmlMobile .= " <div class='carousel-item  $active' >
                <a href='". $address ."'>
                    <img class='d-block w-100' src='" . $urlImgMobile . "' alt='Second slide'>
                </a>
              </div>";
           /* $xhtmlDesktop .= "<a href='". $address ."'>
                                <li class='item_banner_home text-center'>
                                    <img style='width:100%' src='" . $urlImgDesktop . "' alt='' />
                                </li>
                            </a>";

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
                        */
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