<?php

namespace App\Model\Shop;
use Session;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use App\Helpers\HttpClient;
use Illuminate\Support\Str;
use DB;
class MessagesModel extends BackEndModel
{
    protected $casts = [];
    public function __construct()
    {
        $this->table               = 'messages';
        $this->controllerName      = 'messages';
        $this->folderUpload        = 'messages';
        $filedSearch               = array_key_exists($this->controllerName, config('myconfig.config.search')) ? $this->controllerName : 'default';
        $this->fieldSearchAccepted = array_diff(config('myconfig.config.search.' . $filedSearch),['all']);
        $this->crudNotAccepted     = ['_token', 'btn_save','file-del','files'];
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
            $query = $this::select('id','name','name_url','meta_desc','meta_key','parent_id','created_at','updated_at','created_by', 'updated_by')->ofUser();
            if (isset($params['group_id'])){
                $query->whereIn('id',$params['group_id']);
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
            $query->orderBy('created_at', 'asc');
            if (isset($params['pagination']['totalItemsPerPage'])){
                $result =  $query->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $result = $query->get();
            }
        }
        if ($options['task'] == "frontend-list-items") {
            $query = $this::select('id','author','content','room_id','user_id','created_at','updated_at','created_by', 'updated_by');
            if (isset($params['group_id'])){
                $query->whereIn('id',$params['group_id']);
            }
            if (isset($params['room_id'])){
                $query->where('room_id',$params['room_id']);
            }
            if(isset($params['offset'])){
                $query->skip($params['offset']);
            }
            if(isset($params['take'])){
                $query->take($params['take']);
            }
            $query->orderBy('id', 'asc');
            if(isset($params['limit'])){
                $result=$query->paginate($params['limit']);
            }else{
                $result =  $query->get();
            }
        }
        if ($options['task'] == "frontend-list-items-api") {
            $query = $this::with('userSend')->select('id','content','user_id','room_id','created_at')->orderBy('id', 'desc');
            if (isset($params['room_id'])) {
                $query = $query->where('room_id',$params['room_id']);
            }
            if (isset($params['page'])) {
                $currentPage = isset($params['page']) ? (int)$params['page'] : 1;
                $perPage = isset($params['perPage']) ? (int)$params['perPage'] : 20;
                $result = $query->paginate($perPage, ['*'], 'page', $currentPage);
            } else {
                $result = $query->get();
            }
        }
        if($options['task'] == "admin-list-items-in-selectbox") {
            $query = $this->select('id', 'name')->OfUser();
            $result = $query->orderBy('name', 'asc')->pluck('name', 'id')->toArray();
        }
        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id','name','name_url','meta_desc','meta_key','parent_id','created_at','updated_at','created_by', 'updated_by')
                            ->where('id', $params['id'])
                            ->first();
        }
        if ($options['task'] == 'frontend-get-item') {
            $query = self::select('id','name','name_url','meta_desc','meta_key','parent_id','created_at','updated_at','created_by', 'updated_by');
            if(isset($params['id'])){
                $query->where('id', $params['id']);
            }
            if(isset($params['name_url'])){
                $query->where('name_url', $params['name_url']);
            }
            $result = $query->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
            $messageId = self::insertGetId ($this->prepareParams($params));
            $message = self::find($messageId);
        }
        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            $message = self::getItem($params,['task'=>'get-item']);
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
        return $message;
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
           self::where('id', $params['id'])->delete();
        }
    }
    public function userSend() {
        return $this->belongsTo('App\Model\Shop\UsersModel', 'user_id', 'user_id')
                    ->select('user_id', 'fullname','user_type_id');
    }
}
