<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class ProductRequest extends AjaxFormRequest
{
    private $table            = 'products';
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = $this->id;
        $condName  = "bail|required|between:1,255|unique:$this->table,name";
        $condType  = "bail|required";
        $condCode  =  "bail|required";
        $condCatid  =  "bail|required";
        $condProducerid  =  "bail|required";
        $condTrademark  =  "bail|required";
        $condMade_country  =  "bail|required";
        $condPrice  =  "bail|required";
        $condInventory  =  "bail|required";
        $condPrice_vat  =  "bail|required";
        $condGeneral_info  =  "bail|required";
        $condBenefit  =  "bail|required";
        $condImage = "image";
        $condUnit  =  "bail|required";
        $condLongs  =  "bail|numeric";
        $condWides  =  "bail|numeric";
        $condHighs  =  "bail|numeric";
        $condMass  =  "bail|numeric";
        if (!empty($id)) { // edit
            $condName  .= ",$id";
        }
        return  [
            'name'              => $condName,
            'type'              => $condType,
            'image'             => $condImage,
            'code'              => $condCode,
            'cat_id'            => $condCatid,
            'producer_id'        => $condProducerid,
            'trademark'         => $condTrademark,
            'made_country'      => $condMade_country,
            'price'             => $condPrice,
            'unit'              => $condUnit,
            'inventory'         => $condInventory,
            'price_vat'             => $condPrice_vat,
            'general_info'         => $condGeneral_info,
            'benefit'         => $condBenefit,
            'longs' => $condLongs,
            'wides' => $condWides,
            'highs' => $condHighs,
            'mass' => $condMass,
        ];
    }
    public function attributes()
    {
        $arrAttr['name'] = 'Tên thuốc';
        $arrAttr['image'] = 'Trường';
        $arrAttr['type'] = 'Loại thuốc';
        $arrAttr['code'] = 'Mã thuốc';
        $arrAttr['cat_id'] = 'Danh mục';
        $arrAttr['producer_id'] = 'Nhà sản xuất';
        $arrAttr['trademark'] = 'Thương hiệu thuốc';
        $arrAttr['made_country'] = 'Nước sản xuất';
        $arrAttr['price'] = 'Giá bán';
        $arrAttr['inventory'] = 'Tồn kho';
        $arrAttr['price_vat'] = 'Giá bán';
        $arrAttr['general_info'] = 'Thông tin chung';
        $arrAttr['benefit'] = 'Công dụng';
        $arrAttr['unit'] = 'Đơn vị';

        return $arrAttr;
    }
}
