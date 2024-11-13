<?php

namespace App\Http\Controllers\Shop\FrontEnd;

use App\Events\RedisEvent;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Shop\FrontEnd\ShopFrontEndController;
use App\Model\Shop\MessagesModel as MainModel;
use Illuminate\Support\Facades\Session;
class MessagesController extends ShopFrontEndController
{
    public function __construct()
    {
        $this->controllerName     = 'messages';
        $this->pathViewController = "$this->moduleName.pages.$this->controllerName.";
        $this->pageTitle          = 'messages';
        parent::__construct();
        $this->model = new MainModel();
    }
    public function chatTest()
    {
        $messages=$this->model->listItems(null, ['task'  => 'frontend-list-items']);
        return view($this->pathViewController . 'chat', compact('messages'));
    }
    public function sendMessages(Request $request){
        $params['author'] =$request->author;
        $params['content'] =$request->content;
        $messages = $this->model->saveItem($params, ['task' => 'add-item']);
        event(
            $e = new RedisEvent($messages)
        );
        return redirect()->back();
    }
    public function noticeDeviceToken(Request $request){
        return view($this->pathViewController . 'notice_device_token');
    }
}
