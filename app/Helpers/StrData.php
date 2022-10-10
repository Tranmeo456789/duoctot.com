<?php
namespace App\Helpers;
class StrData {
    public static function count_store($temp=null, $province=null,$district=null) {
        if($district==null){
            $str_count_store = '<div>
            <p class="font-weight-bold mt-2">Có <span class="number-store-local">
            <input class="count-store" type="text" name="count_store" value="'.$temp.'" readonly>
            </span> nhà thuốc tại <span class="dcadrress">'.$province.'</span></p></div>';
        }else{
            $str_count_store = '<div><p class="font-weight-bold mt-2">Có <span class="number-store-local">
            <input class="count-store" type="text" name="count_store" value="'.$temp.'" readonly>
            </span> nhà thuốc tại <span class="dcadrress">'.$province.', '.$district.'</span></p></div>';
        }
        return $str_count_store;
    }
    public static function list_store($store_id=null, $address_store=null) {
        $list_store='
        <div class="local_drugstore d-flex justify-content-between flex-wrap">
            <div>
                <div class="form-group m-0">
                    <div class="form-check1 m-0">
                        <input type="hidden" name="shop_id" value="'.$store_id.'">
                        <input class="form-check-input dcshop" type="radio" name="dcshop" value="'.$address_store.'">
                        <label class="form-check-label" for="">
                            '.$address_store.'
                        </label>
                    </div>
                </div>
                <span class="text-success">Có hàng</span>
            </div>
            <div><a href="">Xem bản đồ</a></div>
        </div>
';
        return $list_store;
    }
}
