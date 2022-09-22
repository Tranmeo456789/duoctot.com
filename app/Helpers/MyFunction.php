<?php
namespace App\Helpers;

class MyFunction {
    public static function array_fill_muti_values ($arrData) {
        foreach ($arrData as $key=>$item) {
            $arrData[$key] = implode(' ',$item);
        }
        return $arrData;
    }

}
