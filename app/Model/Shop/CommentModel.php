<?php

namespace App\Model\Shop;

use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
class CommentModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'comment';
        $this->controllerName      = 'comment';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','btn_save'];
    }

    public function listItems($params = null, $options = null) {
        $result = null;
        if($options['task'] == "user-list-items") {
            $query = $this::select('id', 'content','created_by', 'created_at', 'updated_at');
            $result =  $query->orderBy('id', 'desc')
                            ->paginate($params['pagination']['totalItemsPerPage']);
        }
        if($options['task'] == "list-items-frontend") {
            $query = $this::select('id','user_id','product_id','parent_id','level','content','created_by', 'created_at', 'updated_at');
            if (isset($params['product_id'])) {
                $query->where('product_id', $params['product_id']);
            }
            $result =  $query->orderBy('id', 'desc')->get();
        }
        return $result;
    }
    public function getItem($params = null, $options = null) {
        $result = null;
        if($options['task'] == 'get-item') {
            $result = self::select('id', 'content')
                            ->where('id', $params['id'])->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null) {

        if($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
            self::insert($this->prepareParams($params));
        }

        if($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
           self::where('id', $params['id'])->delete();
        }
    }
    public function userComment(){
        return $this->belongsTo('App\Model\Shop\UsersModel','user_id','user_id');
    }
}
