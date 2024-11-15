<?php

namespace App\Model\Shop;
use Session;
use App\Http\Requests\Request;
use Illuminate\Database\Eloquent\Model;
use App\Model\Shop\BackEndModel;
use App\Helpers\HttpClient;
use Illuminate\Support\Str;
use DB;
class RoomUserModel extends BackEndModel
{
    protected $casts = [];
    public function __construct()
    {
        $this->table               = 'room_user';
        $this->controllerName      = 'room_user';
        $this->folderUpload        = 'room_user';
        $filedSearch               = array_key_exists($this->controllerName, config('myconfig.config.search')) ? $this->controllerName : 'default';
        $this->fieldSearchAccepted = array_diff(config('myconfig.config.search.' . $filedSearch),['all']);
        $this->crudNotAccepted     = ['_token', 'btn_save','file-del','files'];
    }
    public function saveItem($params = null, $options = null)
    {
        if ($options['task'] == 'add-item') {
           self::insertGetId ($this->prepareParams($params));
        }
        if ($options['task'] == 'edit-item') {
            self::getItem($params,['task'=>'get-item']);
            self::where('id', $params['id'])->update($this->prepareParams($params));
        }
    }
    public function deleteItem($params = null, $options = null)
    {
        if($options['task'] == 'delete-item') {
           self::where('id', $params['id'])->delete();
        }
    }
}
