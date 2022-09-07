<?php

namespace App\Model\Shop;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
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
            $query = $this::select('id','name','type','code','cat_id','producer_id','size_id','tick','type_price','price','price_vat','coefficient','type_vat','packing','unit','local_buy','amout_max','inventory','general_info','point','dosage','contraindication','trademark','dosage_forms','made_country','specification','benefit','preserve','note', 'created_at', 'updated_at');

            $result =  $query->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }
        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id','name','type','code','cat_id','producer_id','size_id','tick','type_price','price','price_vat','coefficient','type_vat','packing','unit','local_buy','amout_max','inventory','general_info','point','dosage','contraindication','trademark','dosage_forms','made_country','specification','benefit','preserve','note')
                ->where('id', $params['id'])->first();
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
        
        if ($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
            //self::insert($this->prepareParams($params)); 
             self::insert([
                 'name' => $params['name'],
                 'type' => $params['type'],
                 'code' => $params['code'],
                 'cat_id' => $params['cat_id'],
                 'producer_id' => $params['producer_id'],
                 'size_id' => $params['size_id'],
                 'tick' => $params['tick'],
                 'type_price' => $params['type_price'],
                 'price' => $params['price'],
                 'price_vat' => $params['price_vat'],
                 'coefficient' => $params['coefficient'],
                 'type_vat' => $params['type_vat'],
                 'packing' => $params['packing'],
                 'unit' => $params['unit'],
                 'local_buy' => $params['local_buy'],
                 'amout_max' => $params['amout_max'],
                 'inventory' => $params['inventory'],
                 'general_info' => $params['general_info'],
                 'contraindication' => $params['contraindication'],
                 'trademark' => $params['trademark'],
                 'dosage_forms' => $params['dosage_forms'],
                 'made_country' => $params['made_country'],
                 'specification' => $params['specification'],
                 'benefit' => $params['benefit'],
                 'preserve' => $params['preserve'],
                 'note' => $params['note'],              
             ]);
        }
        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            //self::where('id', $params['id'])->update($this->prepareParams($params));
            self::where('id', $params['id'])->update([
                'name' => $params['name'],
                 'type' => $params['type'],
                 'code' => $params['code'],
                 'cat_id' => $params['cat_id'],
                 'producer_id' => $params['producer_id'],
                 'size_id' => $params['size_id'],
                 'tick' => $params['tick'],
                 'type_price' => $params['type_price'],
                 'price' => $params['price'],
                 'price_vat' => $params['price_vat'],
                 'coefficient' => $params['coefficient'],
                 'type_vat' => $params['type_vat'],
                 'packing' => $params['packing'],
                 'unit' => $params['unit'],
                 'local_buy' => $params['local_buy'],
                 'amout_max' => $params['amout_max'],
                 'inventory' => $params['inventory'],
                 'general_info' => $params['general_info'],
                 'contraindication' => $params['contraindication'],
                 'trademark' => $params['trademark'],
                 'dosage_forms' => $params['dosage_forms'],
                 'made_country' => $params['made_country'],
                 'specification' => $params['specification'],
                 'benefit' => $params['benefit'],
                 'preserve' => $params['preserve'],
                 'note' => $params['note'],                
            ]);
        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }
    }
}
