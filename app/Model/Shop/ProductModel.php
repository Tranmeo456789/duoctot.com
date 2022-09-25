<?php

namespace App\Model\Shop;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use App\Model\Shop\Size;
use Illuminate\Support\Str;
class ProductModel extends BackEndModel
{
    public function __construct()
    {
        $this->table               = 'products';
        $this->controllerName      = 'product';
        $this->folderUpload        = '';
        $this->crudNotAccepted     = ['_token', 'btn_save'];
    }
    public function listItems($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == "user-list-items") {
            $query = $this::select('id','name','type','code','cat_product_id','producer_id',
                                    'tick','type_price','price','price_vat','coefficient',
                                    'type_vat','packing','unit_id','sell_area','amout_max',
                                    'inventory','inventory_min','general_info','prescribe','dosage','trademark',
                                    'dosage_forms','country_id','specification','benefit',
                                    'preserve','note','image','featurer','long','wide','high',
                                    'mass', 'created_at', 'updated_at');
            $result =  $query->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }
        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id','name','type','code','cat_product_id','producer_id',
                                    'tick','type_price','price','price_vat','coefficient',
                                    'type_vat','packing','unit_id','sell_area','amout_max',
                                    'inventory','inventory_min','general_info','prescribe','dosage','trademark',
                                    'dosage_forms','country_id','specification','benefit',
                                    'preserve','note','image','featurer','long','wide','high',
                                    'mass')
                            ->where('id', $params['id'])
                            ->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null)
    {
        $image = '';
        if(isset($params['image'])) {
            $file = $params['image'];
            $filename = $file->getClientOriginalName();
            $path = $file->move('public/shop/uploads/images/product', $file->getClientOriginalName());
            $image = $filename;
        }
        $local_buy = implode(',', $params['local_buy']);
             $feature='';
             if(isset($params['feature'])){
                $feature=implode(',', $params['feature']);
             }
             $tick='';
             if(isset($params['tick'])){
                $tick=implode(',', $params['tick']);
             }
        if ($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
             self::insert([
                 'name' => $params['name'],
                 'type' => $params['type'],
                 'code' => $params['code'],
                 'cat_id' => (int)$params['cat_id'],
                 'producer_id' => (int)$params['producer_id'],
                 'tick' => $tick,
                  'type_price' => $params['type_price'],
                  'price' => $params['price'],
                  'price_vat' => $params['price_vat'],
                 'coefficient' => $params['coefficient'],
                 'type_vat' => $params['type_vat'],
                 'packing' => $params['packing'],
                 'unit' => $params['unit'],
                 'local_buy' => $local_buy,
                 'amout_max' => $params['amout_max'],
                 'inventory' => $params['inventory'],
                 'general_info' => $params['general_info'],
                 'trademark' => $params['trademark'],
                 'dosage_forms' => $params['dosage_forms'],
                 'made_country' => $params['made_country'],
                 'specification' => $params['specification'],
                 'benefit' => $params['benefit'],
                 'preserve' => $params['preserve'],
                 'note' => $params['note'],
                 'image'=>$image,
                'feature'=>$feature,
                  'longs'=>$params['longs'],
                  'wides'=>$params['wides'],
                 'highs'=>$params['highs'],
                 'mass'=>$params['mass'],
             ]);
        }
        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            self::where('id', $params['id'])->update([
                'name' => $params['name'],
                'type' => $params['type'],
                'code' => $params['code'],
                'cat_id' => (int)$params['cat_id'],
                'producer_id' => (int)$params['producer_id'],
                'tick' => $tick,
                 'type_price' => $params['type_price'],
                 'price' => $params['price'],
                 'price_vat' => $params['price_vat'],
                'coefficient' => $params['coefficient'],
                'type_vat' => $params['type_vat'],
                'packing' => $params['packing'],
                'unit' => $params['unit'],
                'local_buy' => $local_buy,
                'amout_max' => $params['amout_max'],
                'inventory' => $params['inventory'],
                'general_info' => $params['general_info'],
                'trademark' => $params['trademark'],
                'dosage_forms' => $params['dosage_forms'],
                'made_country' => $params['made_country'],
                'specification' => $params['specification'],
                'benefit' => $params['benefit'],
                'preserve' => $params['preserve'],
                'note' => $params['note'],
                'image'=>$image,
               'feature'=>$feature,
                 'longs'=>$params['longs'],
                 'wides'=>$params['wides'],
                'highs'=>$params['highs'],
                'mass'=>$params['mass'],
            ]);
        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }
    }
    public function cat(){
        return $this->belongsTo('App\Model\Shop\Cat_productModel');
    }
}
