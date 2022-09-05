<?php

namespace App\Model\Shop;
use Illuminate\Database\Eloquent\Model;

class Img_product extends Model
{
    protected $fillable = [
        'id','image','product_id'
    ];
    protected $primaryKey = 'id';
    protected $table = 'img_products';
    public function product(){
        return $this->belongsTo('App\Model\Shop\Product');
    }


}
