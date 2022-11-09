<?php

namespace App\Model\Shop;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use App\Model\Shop\ProductModel;
use DB;
class SearchModel extends BackEndModel
{
    public function __construct() {
        $this->table               = 'keyword_search';
        $this->controllerName      = 'search';
        $this->folderUpload        = '' ;
        $this->crudNotAccepted     = ['_token','btn_search'];
    }
    public function listItems($params = null, $options = null){
        $result = null;
        if ($options['task'] == 'list-keyword-search-most') {
            $query = self::select('id','keyword','number_search','created_at');                         
            $query->orderBy('number_search', 'DESC');
            if(isset($params['limit'])){
                 $query->limit($params['limit']);
            }

            $result=$query->get();
        }
        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id','keyword','number_search')
                            ->where('keyword', $params['keyword'])
                            ->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'add-item-home') {
            $this->setCreatedHistory($params);
            $params['number_search'] = 1;
            self::insert($this->prepareParams($params));
        }
        if ($options['task'] == 'update-number-search-item') {
            $this->setModifiedHistory($params);
            $params['number_search'] = $params['number_search'] + 1;
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }
   
    
}
