<?php
namespace App\Helpers;
use Config;
class MyFunction {
    public static function array_fill_muti_values ($arrData) {
        foreach ($arrData as $key=>$item) {
            $arrData[$key] = implode(' ',$item);
        }
        return $arrData;
    }
    public static function formatDateFrontend($dateTime)
    {
        if ($dateTime == '') return null;
        if ($dateTime == '0000-00-00') return null;
        return date_format(date_create($dateTime), Config::get('myconfig.format.short_time'));
    }
    public static function formatDateMySQL($dateTime)
    {
        return date_format(date_create_from_format(Config::get('myconfig.format.short_time'),$dateTime), Config::get('myconfig.format.my_sql_date'));
    }
    public static function formatNumber($number)
    {
        return number_format ($number, Config::get('myconfig.format.number_decimals'),Config::get('myconfig.format.dec_point'),Config::get('myconfig.format.thousands_sep'));
    }
}
