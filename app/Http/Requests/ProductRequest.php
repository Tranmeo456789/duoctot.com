<?php

namespace App\Http\Requests;

use App\Http\Requests\AjaxFormRequest;
use Config;

class ProductRequest extends AjaxFormRequest
{
    private $table           = 'products';
    private $tableCatProduct = 'cat_product';
    private $tableProducer   = 'producers';
    private $tableTrademark  = 'trademarks';
    private $tableCountry    = 'country';
    private $tableUnit = 'units';
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
        $condType  = "bail|required|in:" . implode(',',array_keys(config('myconfig.template.type_product')));
        $condCode  =  "bail|required";
        $condImage  =  "bail|required";
        $condCatPrduct  = "";
        //$condCatPrduct  =  "bail|required|exists:$this->tableCatProduct,id";
        $condProducer  =  "bail|required|exists:$this->tableProducer,id";
        $condTrademark  =  "bail|required|exists:$this->tableTrademark,id";
        $condCountry  =  "bail|required|exists:$this->tableCountry,id";
        $condPrice  =  "bail|required|numeric";
        $condTypePrice  =  "bail|required|in:"  . implode(',',array_keys(config('myconfig.template.type_price')));
        $condInventory  =  ($this->invenotry_min != '')?"bail|required|numeric":'';
        $condPriceVat  =  "bail|required|numeric";
        $condGeneralInfo  =  "bail|required";
        $condBenefit  =  "bail|required";
        $condUnit  =  "bail|required|exists:$this->tableUnit,id";
        $condLongs  =  "bail|numeric";
        $condWides  =  "bail|numeric";
        $condHighs  =  "bail|numeric";
        $condMass  =  "bail|numeric";
        if (!empty($id)) { // edit
            $condName  .= ",$id";
        }
        $rulesAlbumImage = array();
        $condAlbumImage = "image";
        if ((!empty($this->albumImage)) && count($this->albumImage) > 0) {
            $albumImage = $this->albumImage;
            foreach ($albumImage as $key => $file) {
                $rulesAlbumImage['albumImage.'.$key] = $condAlbumImage;
            }
        }

        $rules =  [
            'name'           => $condName,
            'type'           => $condType,
            'image'          => $condImage,
            'code'           => $condCode,
            'cat_product_id' => $condCatPrduct,
            'producer_id'    => $condProducer,
            'trademark_id'   => $condTrademark,
            'country_id'     => $condCountry,
            'price'          => $condPrice,
            'type_price'          => $condTypePrice,
            'unit_id'        => $condUnit,
            'inventory_min'  => $condInventory,
            'price_vat'      => $condPriceVat,
            'general_info'   => $condGeneralInfo,
            'benefit'        => $condBenefit,
            'longs'          => $condLongs,
            'wides'          => $condWides,
            'highs'          => $condHighs,
            'mass'           => $condMass,
        ];
        return array_merge($rules, $rulesAlbumImage);
    }
    public function attributes()
    {
        $arrAttr = config('myconfig.template.label');
        $arrAttr['name'] = 'Tên thuốc';
        $arrAttr['code'] = 'Mã thuốc';
        return $arrAttr;
    }
}
