<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class CouponImportModel extends Model
{
    protected $fillable = [
        'id','code_coupon','warehouse_id','user_id','qty_total','list_product'
    ];
    protected $primaryKey = 'id';
    protected $table = 'coupon_import';
}
