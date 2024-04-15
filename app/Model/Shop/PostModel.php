<?php

namespace App\Model\Shop;
use Session;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use App\Model\Shop\WarehouseModel;
use App\Model\Shop\CatProductModel;
use App\Helpers\HttpClient;
use Illuminate\Support\Str;
use DB;
class PostModel extends BackEndModel
{
    protected $casts = [];
    public function __construct()
    {
        $this->table               = 'posts';
        $this->controllerName      = 'post';
        $this->folderUpload        = 'post';
        $filedSearch               = array_key_exists($this->controllerName, config('myconfig.config.search')) ? $this->controllerName : 'default';
        $this->fieldSearchAccepted = array_diff(config('myconfig.config.search.' . $filedSearch),['all']);
        $this->crudNotAccepted     = ['_token', 'btn_save','file-del','files'];
    }
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
                    $query->whereIn('user_id',$arrUserID->user_id);
                }
            }
        }

        return $query;
    }
    public function scopeOfUser($query)
    {
        if (\Session::has('user')){
            $user = \Session::get('user');
            if($user['is_admin']==1 || $user['is_admin']==2){
                return  $query;
            }else{
                return  $query->where('user_id',$user->user_id);
            }
        }
        return $query;
    }
    public function listItems($params = null, $options = null)
    {
        $result = null;
        $user = Session::get('user');
        if ($options['task'] == "user-list-items") {
            $query = $this::with('catPost')->select('id','title','content','slug','image','cat_post_id','created_at', 'updated_at')->ofUser();
            if (isset($params['group_id'])){
                $query->whereIn('id',$params['group_id']);
            }
            if ((isset($params['filter']['status_post'])) && ($params['filter']['status_post'] != 'all')) {
                $query = $query->where('status_post',$params['filter']['status_post']);
            }
            if (isset($params['search']['value']) && ($params['search']['value'] !== ""))  {
                if($params['search']['field'] == "all") {
                    $query->where(function($query) use ($params){
                        foreach($this->fieldSearchAccepted as $column){
                            $query->orWhereRaw("LOWER($column)" . ' LIKE BINARY ' .  "LOWER('%{$params['search']['value']}%')" );
                        }
                    });
                } else if(in_array($params['search']['field'], $this->fieldSearchAccepted)) {
                        $query->whereRaw("LOWER({$params['search']['field']})" . " LIKE BINARY " .  "LOWER('%{$params['search']['value']}%')" );
                }
            }
            $query->orderBy('created_at', 'desc');
            if (isset($params['pagination']['totalItemsPerPage'])){
                $result =  $query->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $result = $query->get();
            }
        }
        if ($options['task'] == "frontend-list-items") {
            $query = $this::with('catPost')->select('id','title','content','slug','image','cat_post_id','created_at', 'updated_at');
            if (isset($params['group_id'])){
                $query->whereIn('id',$params['group_id']);
            }
            if(isset($params['offset'])){
                $query->skip($params['offset']);
            }
            if(isset($params['take'])){
                $query->take($params['take']);
            }
            $query= $query->OfCollaboratorCode();
            $query->orderBy('id', 'desc');
            if(isset($params['limit'])){
                $result=$query->paginate($params['limit']);
            }else{
                $result =  $query->get();
            }
        }
        
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name')
                        ->where('id','>',1)
                        ->OfUser();
            if(isset($params['status_post'])){
                $query=$query->where('status_post',$params['status_post']);
            }
            $result = $query->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        }
        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id','title','content','slug','image','cat_post_id','created_at', 'updated_at')
                            ->where('id', $params['id'])
                            ->OfCollaboratorCode()
                            ->first();
        }
        if ($options['task'] == 'frontend-get-item') {
            $query = self::select('id','title','content','slug','image','cat_post_id','created_at', 'updated_at');
            if(isset($params['id'])){
                $query->where('id', $params['id']);
            }
            if(isset($params['slug'])){
                $query->where('slug', $params['slug']);
            }
            $result = $query->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
            self::insertGetId ($this->prepareParams($params));
        }
        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            $item = self::getItem($params,['task'=>'get-item']);
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
           self::where('id', $params['id'])->delete();
        }
    }
    public function catPost(){
        return $this->belongsTo('App\Model\Shop\CatalogModel','cat_post_id','id');
    }
}
