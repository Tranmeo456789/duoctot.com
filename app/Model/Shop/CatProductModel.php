<?php

namespace App\Model\Shop;

use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use DB;
class CatProductModel extends BackEndModel
{
    use NodeTrait;
    protected $table  = 'cat_product';
    protected $guarded = [];

    public function listItems($params = null, $options = null)
    {
        $result = null;
        $result = null;

        if($options['task'] == "admin-list-items") {
            $query = self::withDepth()
                        ->having('depth','>',0)
                        ->defaultOrder();

            $query = $query->get()
                            ->toFlatTree();

            $result = $query;
        }
        if($options['task'] == "admin-list-items-in-selectbox-quan-ly") {
            $query= self::select('id','name')
                        ->withDepth()->defaultOrder();
            if (isset($params['id'])){
                $currNode = self::find($params['id']);
                $query= self::select('id','name')
                            ->where('_lft','<',$currNode->_lft)
                            ->orWhere('_lft','>',$currNode->_rgt);
            }
          //  $query->OfGetChild();
            $nodes = $query->get()->toFlatTree();
            // $parentDepth = \Auth::user()->getCurrentToChuc()->depth;
            foreach ($nodes as $value) {
                $result[$value['id']] = str_repeat(config('myconfig.template.char_level'),$value['depth']) . $value['name'];
            }
        }
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query= self::select('id','name')
                        ->withDepth()->defaultOrder()
                        ->where('id','<>',1);
            $nodes = $query->get()->toFlatTree();
            foreach ($nodes as $value) {
                $result[$value['id']] = str_repeat(config('myconfig.template.char_level'),$value['depth']-1) . $value['name'];
            }
        }
        return $result;
    }
    public function countItems($params = null, $options  = null) {

        $result = null;

        if($options['task'] == 'admin-count-items-group-by-status') {
            $query = $this::groupBy('status')
                        ->select(DB::raw('status , COUNT(id) as count') )
                        ->where('id','<>',1);

            $result = $query->get()->toArray();
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

        if ($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
            $params['slug'] =  Str::slug($params['name']);
            $params['created_by'] = \Session::get('user')['user_id'];

            $parent = self::find($params['parent_id']);
            self::create($this->prepareParams($params),$parent);
        }

        if($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            $params['slug'] =  Str::slug($params['name']);
            $params['updated_by'] = \Session::get('user')['user_id'];
            $parent = self::find($params['parent_id']);
            $query = $current= self::find($params['id']);
            $query->update($this->prepareParams($params));
            if ($current->parent_id != $params['parent_id']) $query->prependToNode($params)->save();
        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if ($options['task'] == 'delete-item') {
            self::where('id', $params['id'])->delete();
        }
    }
    public function move($params = null, $options = null) {
        $this->setModifiedHistory($params);
        $params['updated_by'] = \Session::get('user')['user_id'];
        $node = self::find($params['id']);
        self::where('id',$params['id'])
            ->update(
                    ['updated_at'=>$params['updated_at'],
                    'updated_by'=> $params['updated_by']
            ]);
        if ($params['type']=='down') $node->down();
        if ($params['type']=='up') $node->up();
    }

    public function products(){
        return $this->hasMany('App\Model\Shop\ProductModel');
    }


}
