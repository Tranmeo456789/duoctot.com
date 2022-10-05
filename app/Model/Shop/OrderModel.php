<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $fillable = [
        'id','code_order','customer_id','total','info_product','qty_total','name','phone','address','address_detail','delivery_form','request_invoice','status','status_control','payment'
    ];
    protected $primaryKey = 'id';
    protected $table = 'orders';
}
