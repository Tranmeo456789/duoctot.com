<?php

namespace App\Model\Shop;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use Illuminate\Support\Str;
use Kalnoy\Nestedset\NodeTrait;
use App\Model\Shop\ProductModel;
use App\Model\Shop\CollaboratorsUserModel;
use App\Model\Shop\CollaboratorsClinicDoctor;
use DB;
class CatProductModel extends BackEndModel
{
    use NodeTrait;
    protected $table  = 'cat_product';
    protected $guarded = [];

    public function scopeOfCollaboratorCode($query)
    {
        if (\Session::has('user')){
            $user = \Session::get('user');

            $refer_id = $user->refer_id ;
            $collaborator = CollaboratorsUserModel::where('code',$refer_id)->first();

            if ($collaborator)  {
                $collaborator_code = $collaborator->code;

                $arrUserID = CollaboratorsClinicDoctor::select("user_id")
                                ->where("collaborators_clinic_doctor.collaborator_code",$collaborator_code)
                                ->first();

                if (!empty($arrUserID)) {
                    $query->whereIn('user_id',$arrUserID['user_id']);
                }
            }
        }

        return $query;
    }
    public function listItems($params = null, $options = null)
    {
        $result = null;
        $result = null;

        if ($options['task'] == "admin-list-items") {
            $query = self::withDepth()
                ->having('depth', '>', 0)
                ->defaultOrder();

            $query = $query->get()
                ->toFlatTree();

            $result = $query;
        }
        if ($options['task'] == "admin-list-items-in-selectbox-quan-ly") {
            $query = self::select('id', 'name')
                ->withDepth()->defaultOrder();
            if (isset($params['id'])) {
                $currNode = self::find($params['id']);
                $query = self::select('id', 'name')
                    ->where('_lft', '<', $currNode->_lft)
                    ->orWhere('_lft', '>', $currNode->_rgt);
            }
            //  $query->OfGetChild();
            $nodes = $query->get()->toFlatTree();
            // $parentDepth = \Auth::user()->getCurrentToChuc()->depth;
            foreach ($nodes as $value) {
                $result[$value['id']] = str_repeat(config('myconfig.template.char_level'), $value['depth']) . $value['name'];
            }
        }
        if ($options['task'] == "admin-list-items-in-selectbox") {
            $query = self::select('id', 'name')
                ->withDepth()->defaultOrder()
                ->where('id', '<>', 1);
            $nodes = $query->get()->toFlatTree();
            foreach ($nodes as $value) {
                $result[$value['id']] = str_repeat(config('myconfig.template.char_level'), $value['depth'] - 1) . $value['name'];
            }
        }
        if ($options['task'] == "frontend-list-items-level-2"){
            $user = \Session::get('user');

            $refer_id = $user->refer_id ;
            $collaborator = CollaboratorsUserModel::where('code',$refer_id)->first();
            $whereProduct = "";
            if ($collaborator)  {
                $collaborator_code = $collaborator->code;

                $arrUserID = CollaboratorsClinicDoctor::select("user_id")
                                ->where("collaborators_clinic_doctor.collaborator_code",$collaborator_code)
                                ->first();

                if (!empty($arrUserID)) {
                    $arrUserID = "(". implode(',',$arrUserID['user_id']).")";
                    $whereProduct = "AND `user_id` IN $arrUserID";
                }
            }

            $query = self::select(DB::raw("cat_product.id,cat_product.name,cat_product.image,cat_product.slug,
                                (  select count(1) - 1
                                    from `cat_product` as `_d`
                                    where `cat_product`.`_lft` between `_d`.`_lft` and `_d`.`_rgt`
                                ) as `depth`,
                                (  select count(p.id)
                                    from `products` as `p`
                                    where `p`.`cat_product_parent_id` = `cat_product`.`id`
                                    $whereProduct
                                ) as `number_product`
                           "))
                         ->where('cat_product.status','=','active')
                         ->having('depth','=',2)
                         ->orderBy('cat_product._lft');
            $result = $query->get()
                            ->toArray();
        }
        if ($options['task'] == "frontend-list-items-by-parent-id"){


            $query = self::select('id','name','image','slug')
                         ->where('status','=','active')
                         ->where('parent_id',$params['parent_id'])
                         ->orderBy('_lft');
            $result = $query->get()
                            ->toArray();
        }
        return $result;
    }
    public function countItems($params = null, $options  = null)
    {

        $result = null;

        if ($options['task'] == 'admin-count-items-group-by-status') {
            $query = $this::groupBy('status')
                ->select(DB::raw('status , COUNT(id) as count'))
                ->where('id', '<>', 1);

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
            self::create($this->prepareParams($params), $parent);
        }

        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            $params['slug'] =  Str::slug($params['name']);
            $params['updated_by'] = \Session::get('user')['user_id'];
            $parent = self::find($params['parent_id']);
            $query = $current = self::find($params['id']);
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
    public function move($params = null, $options = null)
    {
        $this->setModifiedHistory($params);
        $params['updated_by'] = \Session::get('user')['user_id'];
        $node = self::find($params['id']);
        self::where('id', $params['id'])
            ->update(
                [
                    'updated_at' => $params['updated_at'],
                    'updated_by' => $params['updated_by']
                ]
            );
        if ($params['type'] == 'down') $node->down();
        if ($params['type'] == 'up') $node->up();
    }
    public static function getChild($id='')
    {
        $item = self::find($id);
        $query = self::select('id','name')
                    ->where('_lft','>=',$item->_lft)
                    ->where('_lft','<=',$item->_rgt);

        return $result = $query->pluck('id')->toArray();
    }
    // public function child()
    // {
    //     return $this->hasMany('App\Model\Shop\CatProductModel','parent_id');
    // }
    // public function products()
    // {
    //     return $this->hasMany('App\Model\Shop\ProductModel','cat_product_id');
    // }
    // public function productsOfChild(){
    //     return $this->hasManyThrough('App\Model\Shop\ProductModel',
    //                         'App\Model\Shop\CatProductModel',
    //                         'parent_id','cat_product_id','id')
    //                         ->selectRaw('COUNT(products.id) as total')
    //                         ->groupBy('parent_id');
    //             ;

    // }
    public function productsOfChild()
    {
        return $this->hasMany('App\Model\Shop\ProductModel','cat_product_parent_id');
    }
}
