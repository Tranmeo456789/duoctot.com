<?php
namespace App\Http\Controllers\Shop\Api;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Http\Requests;
use App\Http\Controllers\Shop\Api\ApiController;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\MessagesModel as MainModel;
use App\Model\Shop\MessagesModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\UserTokenModel;
use App\Model\Shop\RoomModel;
use App\Model\Shop\RoomUserModel;
use \Firebase\JWTCustom\JWTCustom as JWTCustom;

class MessageController extends ApiController
{
    protected $limit;
    public function __construct(Request $request)
    {
        $this->limit = isset($request->limit) ? $request->limit : 50;
        $this->model = new MainModel();
    }
    public function sendMessage(Request $request)
    {
        $this->res['data'] = null;
        $params['content'] = $request->content ?? '';
        $params['type_room'] = $request->typeRoom ?? 'group_bac_si';
        $params['page']=$request->page ?? 1;
        $params['perPage']=$request->perPage ?? 20;
        $token = $request->header('Tdoctor-Token');
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $params['user'] =  (array)$data_token['payload'];
            $request->session()->put('user', $params['user']);
            $infoUserSend=(array)$data_token['payload'];
            if(!$request->roomId){
                $existRoom=(new RoomModel)->where('created_by',$infoUserSend['user_id'])
                ->where('type_room',$params['type_room'])->first();
                if(!$existRoom){
                    $paramsRoom['name'] = 'room_'.$infoUserSend['user_id'].'_'.$params['type_room'];
                    $paramsRoom['type_room'] = $params['type_room'];
                    $paramsRoom['created_by'] = $infoUserSend['user_id'];
                    $roomCurrent=(new RoomModel)->saveItem($paramsRoom,['task'=>'add-item']);
                }else{
                    $roomCurrent=$existRoom;
                }
                $paramsMessage=[];
                $paramsMessage['room_id'] = $roomCurrent->id;
                $paramsMessage['content'] = $params['content'];
                $paramsMessage['user_id'] = $infoUserSend['user_id'];
                $this->model->saveItem($paramsMessage, ['task' => 'add-item']);
            }else{
                $paramsMessage['room_id'] = $request->roomId ?? 0;
                $paramsMessage['content'] = $params['content'];
                $paramsMessage['user_id'] = $infoUserSend['user_id'];
                $this->model->saveItem($paramsMessage, ['task' => 'add-item']);

            }
            $this->res['data']  = $this->model->listItems(['room_id'=>$paramsMessage['room_id']],['task'=>'frontend-list-items-api']);
            $this->res['message']  = 'Gửi tin nhăn thành công!';
        }
        return $this->setResponse($this->res);     
        //     if ($receiver && $receiver->token) {
        //         // Gửi thông báo FCM tới thiết bị của người nhận
        //         $this->sendNotification($receiver->token, $content);
        //     }
    }

    private function sendNotification($fcmToken, $message)
    {
        $credentialsPath = config('firebase.firebase_medixLink_credentials');
        
        // Khởi tạo Firebase
        $firebase = (new \Kreait\Firebase\Factory)->withServiceAccount($credentialsPath)->createMessaging();
    
        // Tạo thông báo
        $notification = \Kreait\Firebase\Messaging\Notification::create('Bạn có tin nhắn mới', $message);
    
        // Tạo thông báo FCM
        $fcmMessage = \Kreait\Firebase\Messaging\CloudMessage::withTarget('token', $fcmToken)
            ->withNotification($notification);
    
        // Gửi thông báo
        try {
            $firebase->send($fcmMessage);
        } catch (\Exception $e) {
            \Log::error('Failed to send notification: ' . $e->getMessage());
        }
    }
    public function getListMessage(Request $request)
    {
        $token = $request->header('Tdoctor-Token');
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $params['user'] =  (array)$data_token['payload'];
            $request->session()->put('user', $params['user']);
            $infoUserGetList=(array)$data_token['payload'];
            if($infoUserGetList['user_type_id']==1){
                $listRoom=(new RoomModel)->listItems(['created_by'=>$infoUserGetList['user_id']], ['task' => 'frontend-list-items-api']);
            }else if($infoUserGetList['user_type_id']==4){
                $listRoom=(new RoomModel)->listItems(['type_room'=>'group_bac_si'], ['task' => 'frontend-list-items-api']);
            }
        }
        $this->res['data']=$listRoom;
        return $this->setResponse($this->res);
    }
}
