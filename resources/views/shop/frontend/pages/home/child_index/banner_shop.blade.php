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
            $urlImgDesktop = "https://tdoctor.vn/public/fileUpload/quangCao/" . $val['banner_shop'];
            $urlImgMobile= "https://tdoctor.vn/public/fileUpload/quangCao/" . $val['banner_mobile'];
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

            $xhtmlMobile .= "<a href='". $address ."'>
                                <li class='item_banner_home text-center'>
                                    <img style='width:100%' src='" . $urlImgMobile . "' alt='' />
                                </li>
                            </a>";
             */
        @endphp
    @endforeach
    <div class="row">
        <div class="banner_doitac_desktop">
            <div class="col-12">
                <div id="carouselDesktop" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        {!! $indicatorsDesktop !!}
                      </ol>
                    <div class="carousel-inner">
                        {!! $xhtmlDesktop !!}
                    </div>
                    <a class="carousel-control-prev" href="#carouselDesktop" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselDesktop" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
        <div class="banner_doitac_mobile">
            <div class="col-12">
                <div id="carouselMobile" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        {!! $indicatorsMobile !!}
                      </ol>
                    <div class="carousel-inner">
                        {!! $xhtmlMobile !!}
                    </div>
                    <a class="carousel-control-prev" href="#carouselMobile" role="button" data-slide="prev">
                      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                      <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselMobile" role="button" data-slide="next">
                      <span class="carousel-control-next-icon" aria-hidden="true"></span>
                      <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>
        </div>
    </div>

@endif