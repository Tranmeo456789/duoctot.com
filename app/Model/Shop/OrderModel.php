<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;

class OrderModel extends Model
{
    protected $fillable = [
        'id','code_order','customer_id','total','qty_total','qty_per','product_id','name','phone','address','address_detail','delivery_form','request_invoice','status'
    ];
    protected $primaryKey = 'id';
    protected $table = 'orders';
}
