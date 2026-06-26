<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use Illuminate\Support\Facades\Cache;
class QuestionModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'question';
        $this->controllerName      = 'question';
        $this->folderUpload        = 'question' ;
        $this->crudNotAccepted     = ['_token','btn_save'];
    }
    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "user-list-items") {
            $query = $this::select('id','ques','ans','product_id','created_by', 'created_at', 'updated_at');
            if (isset($params['product_id'])) {
                $query->where('product_id', $params['product_id']);
            }
            $result =  $query->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);
        }
        if($options['task'] == "list-items-frontend") {
            $query = $this::select('id','ques','ans','product_id','created_by', 'created_at', 'updated_at');
            if (isset($params['product_id'])) {
                $query->where('product_id', $params['product_id']);
            }
            if (isset($params['shop_id'])) {
                $query->where('shop_id', $params['shop_id']);
            }
            if (isset($params['rating'])) {
                $query->whereNotNull('rating')->where('rating', '!=', '');
            }else {
                $query->where(function($q) {
                    $q->whereNull('rating')
                      ->orWhere('rating', '');
                });
            }
            $result =  $query->get();
            $result = self::buildTree($result);
        }
        
        return $result;
    }
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item') {
            $result = self::select('id','ques','ans','product_id','created_by', 'created_at', 'updated_at')
                            ->where('id', $params['id'])->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null) {
        if($options['task'] == 'add-item') {
            $this->setCreatedHistoryHasParamsCreatedAt($params);
            self::insert($this->prepareParams($params));
        }
        if($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
        Cache::tags(['duoctot_product'])->flush();
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
           self::where('id', $params['id'])->delete();
        }
    }
    
}
