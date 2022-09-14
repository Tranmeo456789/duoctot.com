<?php

namespace App\Model\Shop;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use Illuminate\Support\Str;
class Cat_productModel extends BackEndModel
{
    public function __construct()
    {
        $this->table               = 'cat_products';
        $this->controllerName      = 'cat_product';
        $this->folderUpload        = '';
        $this->crudNotAccepted     = ['_token', 'btn_save'];
    }

    public function listItems($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == "user-list-items") {
            $query = $this::select('id', 'name', 'parent_id', 'image', 'slug', 'created_at', 'updated_at');

            $result =  $query->orderBy('id', 'desc')
                ->paginate($params['pagination']['totalItemsPerPage']);
        }
        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id', 'name', 'parent_id', 'image', 'slug')
                ->where('id', $params['id'])->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null)
    {
        $image = ''; 
        if(isset($params['image'])){
            $file = $params['image'];
            $filename = $file->getClientOriginalName();
            $path = $file->move('public/shop/uploads/images/product', $file->getClientOriginalName());
            $image = $filename; 
        }       
        
        if ($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);  
             self::insert([
                 'name' => $params['name'],
                'image' => $image,
                 'parent_id' => $params['parent_id'],
                 'slug'  => Str::slug($params['name']),               
             ]);
        }
        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            self::where('id', $params['id'])->update([
                'name' => $params['name'],
               'image' => $image,
                'parent_id' => $params['parent_id'],
                'slug'  => Str::slug($params['name']),               
            ]);
        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }
    }
    public function products(){
        return $this->hasMany('App\Model\Shop\ProductModel');
    }
    
      
}
