<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{   
    protected $fillable = [
        'id','name','type','code','cat_id','producer_id','size_id','tick','type_price','price','price_vat','coefficient','type_vat','packing','unit','local_buy','amout_max','inventory','general_info','point','dosage','contraindication','trademark','dosage_forms','made_country','specification','benefit','preserve','note'
    ];
    protected $primaryKey = 'id';
    protected $table = 'products';
    public function imgs(){
        return $this->hasMany('App\Model\Shop\Img_product');
    }
    public function cat(){
        return $this->belongsTo('App\Model\Shop\Cat_product');
    }

}
