<?php

namespace App\Model\Shop;
use Session;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use App\Helpers\HttpClient;
use Illuminate\Support\Str;
use DB;
class RoomModel extends BackEndModel
{
    protected $casts = [];
    public function __construct()
    {
        $this->table               = 'rooms';
        $this->controllerName      = 'rooms';
        $this->folderUpload        = 'rooms';
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
            $query = $this::select('id','name','updated_at','type_room','created_by');
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
            $query->orderBy('created_at', 'desc');
            if (isset($params['pagination']['totalItemsPerPage'])){
                $result =  $query->paginate($params['pagination']['totalItemsPerPage']);
            }else{
                $result = $query->get();
            }
        }
        if ($options['task'] == "frontend-list-items-api") {
            $query = $this::select('id','name','type_room','created_by');
            if (isset($params['created_by'])){
                $query->where('created_by',$params['created_by']);
            }
            if (isset($params['type_room'])){
                $query->where('type_room',$params['type_room']);
            }
            if (isset($params['page'])) {
                $currentPage = isset($params['page']) ? (int)$params['page'] : 1;
                $perPage = isset($params['perPage']) ? (int)$params['perPage'] : 20;
                $result = $query->paginate($perPage, ['*'], 'page', $currentPage);
            } else {
                $result = $query->get();
            }
        }
        return $result;
    }
    public function getItem($params = null, $options = null)
    {
        $result = null;
        if ($options['task'] == 'get-item') {
            $result = self::select('id','name','type_room','updated_at','created_by')
                            ->where('id', $params['id'])
                            ->first();
        }
        return $result;
    }
    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'add-item') {
            $this->setCreatedHistory($params);
            $roomId = self::insertGetId ($this->prepareParams($params));
            $room = self::find($roomId);
        }
        if ($options['task'] == 'edit-item') {
            $this->setModifiedHistory($params);
            $room = self::getItem($params,['task'=>'get-item']);
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
        return $room;
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
           self::where('id', $params['id'])->delete();
        }
    }
    public function listMessages() {
        return $this->hasMany('App\Model\Shop\MessagesModel', 'room_id', 'id')
                    ->select('id', 'content', 'user_id','room_id','created_at');
    }
}
