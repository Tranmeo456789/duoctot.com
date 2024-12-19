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
use GuzzleHttp\Client;
use App\Services\FirebaseService;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Google_Client;
use Google\Client as GoogleClient;
use Exception;
use Illuminate\Support\Facades\Redis;

class MessageController extends ApiController
{
    protected $limit;
    protected $firebaseService;
    public function __construct(Request $request)
    {
        $this->limit = isset($request->limit) ? $request->limit : 50;
        $this->model = new MainModel();
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
    private function sendNotification1($fcmToken, $message)
    {
        $credentialsPath = config('firebase.firebase_medixLink_credentials');
        // Kiểm tra nếu file chứng chỉ không tồn tại
        if (!file_exists($credentialsPath)) {
            \Log::error('Firebase credentials file not found at: ' . $credentialsPath);
            return response()->json(['error' => 'Firebase credentials file not found.'], 500); // Trả về lỗi nếu không tìm thấy chứng chỉ
        }
        // Kiểm tra nếu không có quyền đọc file chứng chỉ
        if (!is_readable($credentialsPath)) {
            \Log::error('Firebase credentials file is not readable at: ' . $credentialsPath);
            return response()->json(['error' => 'Firebase credentials file is not readable.'], 500); // Trả về lỗi nếu file không thể đọc được
        }
        try {
            // Khởi tạo Firebase với chứng chỉ hợp lệ
            $firebase = (new \Kreait\Firebase\Factory)->withServiceAccount($credentialsPath)->createMessaging();
            // Tạo thông báo
            $notification = \Kreait\Firebase\Messaging\Notification::create('Bạn có tin nhắn mới', $message);
            // Tạo thông báo FCM
            $fcmMessage = \Kreait\Firebase\Messaging\CloudMessage::withTarget('token', $fcmToken)
                ->withNotification($notification);
            // Gửi thông báo
            $firebase->send($fcmMessage);
        } catch (\Exception $e) {
            \Log::error('Failed to send notification: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send notification: ' . $e->getMessage()], 500); // Trả về lỗi nếu không thể gửi thông báo
        }
    }
    public function sendNotification2($fcmToken, $message)
    {
        $client = new Client();
        $response = $client->post('https://fcm.googleapis.com/fcm/send', [
            'headers' => [
                'Authorization' => 'key=' . config('firebase.server_key'),
                'Content-Type'  => 'application/json',
            ],
            'json' => [
                'to' => $fcmToken,
                'notification' => [
                    'title' => 'Thông báo mới',
                    'body' => $message,
                ],
                'priority' => 'high', // Đặt độ ưu tiên cho thông báo (high/normal)
            ]
        ]);
        // Kiểm tra phản hồi từ Firebase
        $responseBody = json_decode($response->getBody(), true);
        // Kiểm tra nếu có lỗi
        if (isset($responseBody['failure']) && $responseBody['failure'] > 0) {
            // Xử lý lỗi, ví dụ như token không hợp lệ
            \Log::error('FCM Error: ' . json_encode($responseBody));
        } else {
            // Nếu thông báo gửi thành công
            \Log::info('FCM notification sent successfully.');
        }
        return $responseBody;
    }

    public function receiveNoticeToDeciveToKen(Request $request)
    {
        $deviceToken = $request->decive_token ?? '';
        if ($deviceToken == '') {
            return response()->json(['error' => 'Device token is required.'], 400);
        }
        if (!is_string($deviceToken) || strlen($deviceToken) < 10) {
            return response()->json(['error' => 'Invalid device token format.'], 400); // Trả về lỗi nếu token không hợp lệ
        }
        try {
            $this->sendNotification1($deviceToken, 'đã nhận thông báo');
            return response()->json(['success' => 'Notification sent successfully.'], 200);
        } catch (\Exception $e) {
            \Log::error('Error sending notification: ' . $e->getMessage());
            return response()->json(['error' => 'Failed to send notification.'], 500); // Trả về lỗi nếu không gửi được thông báo
        }
    }
    public function receiveNoticeToDeviceToKen2(Request $request)
    {
        $deviceToken = $request->device_token;
        if ($deviceToken == '') {
            return response()->json(['error' => 'Device token is required.'], 400);
        }
        if (!is_string($deviceToken) || strlen($deviceToken) < 10) {
            return response()->json(['error' => 'Invalid device token format.'], 400);
        }
        $deviceToken = trim($request->device_token);
        $post_data = array(
            'to' => $deviceToken,
            'notification' => array(
                'title' => 'title',
                'click_action' => 'click_action',
                'body' => 'body'
            ),
            'data' => array(
                'click_action' => 'click_action',
                'icon' => 'icon'
            )
        );
        $is_show_result = true;
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($post_data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: key=AAAA1ZEv8zo:APA91bHNlGpAbsDXqF2qW-jo08NNQ8Ln4zbXyIyHRWv9LMaB0-fHMR5_8-t6r86b9gb0ltHmYQCnQjF32rP-103jLGa8jLuVDgMefP1lpHDI7QSwZ9osrwHQo0_qP00MqSv41fmRKNjK',
                'Content-Type: application/json'
            ),
        ));
        $response = curl_exec($curl);
        curl_close($curl);
        if ($is_show_result) {
            return response()->json([
                'status' => true,
                'message' => 'Success',
                'data' => $response,
                'date' =>  time()
            ]);
        }
    }

    function sendPushMessageFirebase($user_id, $title, $url, $body, $icon, $type, $is_show_result = true, $agora_app_id = '', $agora_token = '', $channel_name = '', $agora_client_name = '')
    {

        if (strpos($user_id, ',') !== false) {
            $user_id = str_replace('{,', '', $user_id);
            $user_id = str_replace(',}', '', $user_id);
            $user_ids = explode(',', $user_id);
            $user_tokens = UserTokenModel::whereIn('user_id', $user_ids)->get();
        } else {
            $user_tokens = UserTokenModel::where('user_id', $user_id)->get();
        }
        logger($user_tokens);
        if ($user_tokens != null) {
            $registration_ids = array();
            foreach ($user_tokens as $item) {
                $registration_ids[] = base64_decode($item->token);
            }
            $post_data = array(
                'registration_ids' => $registration_ids,
                'notification' => array(
                    'title' => $title,
                    'click_action' => $url,
                    'body' => $body,
                    'agora_app_id' => $agora_app_id,
                    'agora_token' => $agora_token,
                    'channel_name' => $channel_name,
                    'agora_client_name' => $agora_client_name
                ),
                'data' => array(
                    'click_action' => $url,
                    'icon' => $icon,
                    'type' => $type,
                    'agora_app_id' => $agora_app_id,
                    'agora_token' => $agora_token,
                    'channel_name' => $channel_name,
                    'agora_client_name' => $agora_client_name
                )
            );
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://fcm.googleapis.com/fcm/send',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => json_encode($post_data),
                CURLOPT_HTTPHEADER => array(
                    'Authorization: key=AAAA1ZEv8zo:APA91bHNlGpAbsDXqF2qW-jo08NNQ8Ln4zbXyIyHRWv9LMaB0-fHMR5_8-t6r86b9gb0ltHmYQCnQjF32rP-103jLGa8jLuVDgMefP1lpHDI7QSwZ9osrwHQo0_qP00MqSv41fmRKNjK',
                    'Content-Type: application/json'
                ),
            ));

            $response = curl_exec($curl);
            $log = [
                'TIMESTAMP' => Carbon::now()->format('Y-m-d H:i:s'),
                'JOB' => "Send Notification Successfully",
                'DATA' => $post_data,
                'OUTPUT' => $response,
            ];

            logger($log);
            curl_close($curl);
            if ($is_show_result) {
                return response()->json([
                    'status' => true,
                    'data' => $response,
                    'date' =>  time()
                ]);
            }
        }
    }
    function sendPushMessage(Request $rq)
    {
        if (isset(Session::get('user')->user_id)) {
            $user_id = str_replace('room_', '', $rq->chat_to);
            $title = $rq->title;
            $url = $rq->url;
            $body = $rq->body;
            $icon = $rq->icon;
            $type = $rq->type;
            $this->sendPushMessageFirebase($user_id, $title, $url, $body, $icon, $type);
        }
        return response()->json([
            'status' => false,
            'data' => [],
            'date' =>  time()
        ]);
    }
    private function sendNotificationFromReciver($deviceToken = '', $title = 'Thông báo', $body = '', $nameRoom = 'shop', $roomId = '1', $content='')
    {
        if (empty($deviceToken)) {
            return response()->json([
                'status' => true,
                'message' => 'No device token provided, no notification sent.',
            ]);
        }
        $messageData = [
            'title' => $title,
            'body' => $body,
            'data' => [
                'key1' => 'value1',
                'key2' => 'value2',
                'nameRoom' => $nameRoom,
                'roomId' => $roomId,
                'content' => $content,
            ]
        ];
        try {
            $client = new Google_Client();
            $filePath = public_path('firebase/firebase.json');
            $client->setAuthConfig($filePath);
            $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
            $accessToken = $client->fetchAccessTokenWithAssertion();
            $url = 'https://fcm.googleapis.com/v1/projects/medix-link/messages:send';
            $postData = [
                'message' => [
                    'token' => $deviceToken,
                    'notification' => [
                        'title' => $messageData['title'],
                        'body' => $messageData['body']
                    ],
                    'data' => $messageData['data'] ?? []
                ]
            ];
            $response = $this->sendCurlRequest($url, $accessToken['access_token'], $postData);
            return response()->json([
                'status' => true,
                'message' => 'Notification sent successfully',
                'data' => $response
            ]);
        } catch (Exception $e) {
            return response()->json([
                'status' => true,
                'message' => 'Notification sent with some errors',
                'data' => $e->getMessage()
            ]);
        }
    }
    // public function sendMessage(Request $request)
    // {
    //     $this->res['data'] = null;
    //     $params['content'] = $request->content ?? '';
    //     $params['type_room'] = $request->typeRoom ?? 'group_bac_si';
    //     $token = $request->header('Tdoctor-Token');
    //     $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
    //     if ($data_token['message'] == 'OK') {
    //         $params['user'] =  (array)$data_token['payload'];
    //         $request->session()->put('user', $params['user']);
    //         $infoUserSend = (array)$data_token['payload'];
    //         $roomIdCurrent = 0;
    //         if (!$request->roomId || !is_numeric($request->roomId)) {
    //             $existRoom = (new RoomModel)->where('created_by', $infoUserSend['user_id'])
    //                 ->where('type_room', $params['type_room'])->first();
    //             if (!$existRoom) {
    //                 $paramsRoom['name'] = 'room_' . $infoUserSend['user_id'] . '_' . $params['type_room'];
    //                 $paramsRoom['type_room'] = $params['type_room'];
    //                 $paramsRoom['created_by'] = $infoUserSend['user_id'];
    //                 $roomCurrent = (new RoomModel)->saveItem($paramsRoom, ['task' => 'add-item']);
    //                 (new RoomUserModel)->saveItem(['room_id' => $roomCurrent['id'], 'user_id' => $infoUserSend['user_id']], ['task' => 'add-item']);
    //                 if ($params['type_room'] == 'group_bac_si') {
    //                     (new RoomUserModel)->saveItem(['room_id' => $roomCurrent['id'], 'user_id' => 90007044], ['task' => 'add-item']);
    //                 } else if ($params['type_room'] == 'group_duoc_si') {
    //                     (new RoomUserModel)->saveItem(['room_id' => $roomCurrent['id'], 'user_id' => 1014110310], ['task' => 'add-item']);
    //                 }
    //             } else {
    //                 $roomCurrent = $existRoom;
    //             }
    //             $paramsMessage = [];
    //             $paramsMessage['room_id'] = $roomCurrent->id;
    //             $roomIdCurrent = $roomCurrent->id;
    //             $paramsMessage['content'] = $params['content'];
    //             $paramsMessage['user_id'] = $infoUserSend['user_id'];
    //             $this->model->saveItem($paramsMessage, ['task' => 'add-item']);
    //         } else {
    //             $paramsMessage['room_id'] = $request->roomId ?? 0;
    //             $roomIdCurrent = $request->roomId ?? 0;
    //             $paramsMessage['content'] = $params['content'];
    //             $paramsMessage['user_id'] = $infoUserSend['user_id'];
    //             $this->model->saveItem($paramsMessage, ['task' => 'add-item']);
    //         }
    //         $listUserInRoom = RoomUserModel::where('room_id', $roomIdCurrent)->pluck('user_id');
    //         $title='Tin nhắn mới';
    //         $body=$params['content'];
    //         foreach ($listUserInRoom as $value) {
    //             if($value!=$infoUserSend['user_id']){
    //                 $UserTokenCurrent=UserTokenModel::where('user_id', $value)->first();
    //                 $deciveToken=$UserTokenCurrent['token']??'';
    //                 $this->sendNotificationFromReciver($deciveToken,$title,$body);
    //             }
    //         }
    //         $this->res['data'] = [];
    //         $this->res['message']  = 'Gửi tin nhắn thành công!';
    //     }
    //     return $this->setResponse($this->res);
    // }
    public function sendMessage(Request $request)
    {
        $this->res['data'] = null;
        $params['content'] = $request->content ?? '';
        //$params['type_room'] = $request->typeRoom ?? 'group_bac_si';
        $roomId = $request->roomId ?? 1;
        $token = $request->header('Tdoctor-Token');
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $params['user'] =  (array)$data_token['payload'];
            $infoUserSend = (array)$data_token['payload'];
            $paramsMessage['room_id'] = $roomId;
            $paramsMessage['content'] = $params['content'];
            $paramsMessage['user_id'] = $infoUserSend['user_id'] ?? 1;
            $this->model->saveItem($paramsMessage, ['task' => 'add-item']);
            $this->res['data'] = [];
            $this->res['message'] = 'Gửi tin nhắn thành công!';
        }
        return $this->setResponse($this->res);
    }
    public function saveMessageAxios(Request $request)
    {
        $params = [
            'content' => $request->content ?? '',
            'room_id' => strval($request->room_id) ?? '1',
            'user_id' => $request->user_id ?? 994110172,
        ];
        $this->model->saveItem($params, ['task' => 'add-item']);
        $userSend = UsersModel::where('user_id', $params['user_id'])->first();
        if($userSend){
            $nameRoom = $userSend['fullname'] ?? '';
        }
        // Lấy các token của người dùng trong phòng (ngoại trừ người gửi)
        $listUserInRoom = RoomUserModel::where('room_id', $params['room_id'])
                                        ->where('user_id', '!=', $params['user_id'])
                                        ->pluck('user_id');
        $userTokens = UserTokenModel::whereIn('user_id', $listUserInRoom)->pluck('token')->toArray();
        // Gửi thông báo nếu có người dùng trong phòng
        if (count($userTokens) > 0) {
            $title = 'Tin nhắn mới';
            $body = $params['content'];
            $content = $params['content'];
            $nameRoom = $nameRoom ?? 'Unknown';
            $roomId = $params['room_id'] ?? 'Unknown';
            foreach ($userTokens as $deviceToken) {
                if ($deviceToken) {
                    $this->sendNotificationFromReciver($deviceToken, $title, $body, $nameRoom, $roomId, $content);
                }
            }
        }
    }
    public function getListMessage(Request $request)
    {
        $token = $request->header('Tdoctor-Token') ?? 'hhhhh';
        $typeRoom = $request->typeRoom ?? 'group_bac_si';
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        $roomCurrent= [];
        $paramsMess['page'] = $request->page ?? 1;
        $paramsMess['perPage'] = $request->perPage ?? 10;
        if ($data_token['message'] == 'OK') {
            $params['user'] =  (array)$data_token['payload'];
            $infoUserGetList = (array)$data_token['payload'];
            $roomCurrent = RoomModel::where('type_room', $typeRoom)->where('created_by', $infoUserGetList['user_id'])->first();
            if (!$roomCurrent) {
                $paramsRoom['name'] = 'room_' . $infoUserGetList['user_id'] . '_' . $typeRoom;
                $paramsRoom['type_room'] = $typeRoom;
                $paramsRoom['created_by'] = $infoUserGetList['user_id'];
                $roomCurrent = (new RoomModel)->saveItem($paramsRoom, ['task' => 'add-item']);
                $idUserGetList=$infoUserGetList['user_id'];
                (new RoomUserModel)->saveItem(['room_id' => $roomCurrent['id'], 'user_id' => $idUserGetList], ['task' => 'add-item']);
                if ($typeRoom == 'group_bac_si') {
                    (new RoomUserModel)->saveItem(['room_id' => $roomCurrent['id'], 'user_id' => 90007044], ['task' => 'add-item']);
                    $paramsMessageFirst = [
                        'content' => 'Chào bạn. Bạn đang cần tư vấn về vấn đề gì ạ?',
                        'room_id' => $roomCurrent['id'] ?? 1,
                        'user_id' => 90007044,
                    ];
                    $this->model->saveItem($paramsMessageFirst, ['task' => 'add-item']);
                } else if ($typeRoom == 'group_duoc_si') {
                    (new RoomUserModel)->saveItem(['room_id' => $roomCurrent['id'], 'user_id' => 1014110310], ['task' => 'add-item']);
                    $paramsMessageFirst = [
                        'content' => 'Chào bạn. Bạn đang cần tư vấn về vấn đề gì ạ?',
                        'room_id' => $roomCurrent['id'] ?? 1,
                        'user_id' => 1014110310,
                    ];
                    $this->model->saveItem($paramsMessageFirst, ['task' => 'add-item']);
                }elseif ($typeRoom == 'shop_chat') {
                    $userCurent= UsersModel::where('user_id',$idUserGetList)->first();
                    if($userCurent){
                        $refRegister = $userCurent['ref_register'];
                        if(!empty($refRegister)){
                            $userShareCodeRef=UsersModel::where('codeRef',$refRegister)->first();
                            if($userShareCodeRef){
                                (new RoomUserModel)->saveItem(['room_id' => $roomCurrent['id'], 'user_id' => $userShareCodeRef->user_id], ['task' => 'add-item']);
                                $paramsMessageFirst = [
                                    'content' => 'Chào bạn. Bạn đang cần tư vấn về vấn đề gì ạ?',
                                    'room_id' => $roomCurrent['id'] ?? 1,
                                    'user_id' => $userShareCodeRef->user_id,
                                ];
                                $this->model->saveItem($paramsMessageFirst, ['task' => 'add-item']);
                            }
                        }else{
                            (new RoomUserModel)->saveItem(['room_id' => $roomCurrent['id'], 'user_id' => 864108238], ['task' => 'add-item']);
                            $paramsMessageFirst = [
                                'content' => 'Chào bạn. Bạn đang cần tư vấn về vấn đề gì ạ?',
                                'room_id' => $roomCurrent['id'] ?? 1,
                                'user_id' => 864108238,
                            ];
                            $this->model->saveItem($paramsMessageFirst, ['task' => 'add-item']);
                        }
                    }
                }
                
            }
        }
        if(!empty($roomCurrent)){
            $paramsMess['room_id'] = $roomCurrent->id;
            $listMessage = (new MessagesModel)->listItems($paramsMess, ['task' => 'frontend-list-items-api']);
            $listMessage = $listMessage->reverse()->values();
            foreach ($listMessage as $key => $value) {
                $role = 0;
                if ($roomCurrent['created_by'] == $value['user_id']) {
                    $role = 1;
                }
                $listMessage[$key]['role'] = $role;
                $listMessage[$key]['user_send'] = $value->userSend();
            }
            $roomCurrent['list_message'] = $listMessage;
        }
        
        $this->res['data'] = $roomCurrent;
        return $this->setResponse($this->res);
    }
    public function functionCreateRoomAndSaveMessageFirst($createdBy, $typeRoom, $userReceiver) {
        // Kiểm tra phòng đã tồn tại chưa
        $roomCurrent = RoomModel::where('created_by', $createdBy)->where('user_receiver', $userReceiver)->first();
        if (empty($roomCurrent)) {
            // Nếu phòng chưa tồn tại, tạo phòng mới
            $paramsRoom = [
                'name' => 'room_' . $createdBy . '_' . $typeRoom,
                'type_room' => $typeRoom,
                'created_by' => $createdBy,
                'user_receiver' => $userReceiver,
            ];
            // Lưu phòng
            $roomCurrent = (new RoomModel)->saveItem($paramsRoom, ['task' => 'add-item']);
            // Thêm người dùng vào phòng
            (new RoomUserModel)->saveItem(['room_id' => $roomCurrent['id'], 'user_id' => $createdBy], ['task' => 'add-item']);
            (new RoomUserModel)->saveItem(['room_id' => $roomCurrent['id'], 'user_id' => $userReceiver], ['task' => 'add-item']);
            // Gửi tin nhắn đầu tiên
            $paramsMessageFirst = [
                'content' => 'Chào bạn. Bạn đang cần tư vấn về vấn đề gì ạ?',
                'room_id' => $roomCurrent['id'] ?? 1,
                'user_id' => $userReceiver,
            ];
            if($typeRoom=='group_bac_si'){
                $paramsMessageFirst['content']='Chào bạn. Bạn đang muốn tư vấn về vấn đề gì ạ? Bạn cần cung cấp thông tin sau:
 1. Tuổi giới tính của bệnh nhân.
 2. Các bệnh cũ đã mắc, các thuốc đang dùng thường xuyên.
 3. Các triệu chứng hiện tại, thời điểm bắt đầu xuất hiện triệu chứng(mô tả càng chi tiết càng tốt).
 4. Các thông tin khác nếu có.';
            }
            $this->model->saveItem($paramsMessageFirst, ['task' => 'add-item']);
        }
        // Trả về phòng đã tạo
        return $roomCurrent;
    }
    public function createRoom(Request $request)
    {
        $token = $request->header('Tdoctor-Token') ?? 'hhhhh';
        $typeRoom = $request->typeRoom ?? 'group_bac_si';
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        $roomCurrent = [];  
        if ($data_token['message'] == 'OK') {
            $infoUserGetList = (array)$data_token['payload'];
            $idUserGetList = $infoUserGetList['user_id'];
            if ($typeRoom == 'shop_chat') {
                $userCurent = UsersModel::where('user_id', $idUserGetList)->first();
                if ($userCurent) {
                    $refRegister = $userCurent['ref_register'];
                    $typeRoom = 'group_bac_si';
                    $userReceiverId = 90007044;
                    // Kiểm tra xem người dùng có mã giới thiệu hay không
                    if (!empty($refRegister)) {
                        $userShareCodeRef = UsersModel::where('codeRef', $refRegister)->first();
                        if ($userShareCodeRef) {
                            $userReceiverId = $userShareCodeRef['user_id'];
                            $typeRoom = 'shop_chat';
                        }
                    }
                    // Tạo phòng và tin nhắn đầu tiên, và nhận lại phòng đã tạo
                    $roomCurrent = $this->functionCreateRoomAndSaveMessageFirst($idUserGetList, $typeRoom, $userReceiverId);
                }
            } else if ($typeRoom == 'group_bac_si') {
                $roomCurrent = $this->functionCreateRoomAndSaveMessageFirst($idUserGetList, $typeRoom, 90007044);
            } else if ($typeRoom == 'group_duoc_si') {
                $roomCurrent = $this->functionCreateRoomAndSaveMessageFirst($idUserGetList, $typeRoom, 1014110310);
            }
        }
        // Kiểm tra và cập nhật tên phòng dựa trên thông tin người nhận
        $idUserReceiver = $roomCurrent['user_receiver'] ?? 864108238;
        $userReceiver = UsersModel::where('user_id', $idUserReceiver)->first();
        if ($userReceiver) {
            $roomCurrent->name = $userReceiver['fullname'] ?? 'No Name';
        } else {
            $roomCurrent->name = 'No Name';
        }
        $this->res['data'] = $roomCurrent;
        return $this->setResponse($this->res);
    }
    public function getListMessageInRoomId(Request $request)
    {
        $params = [];
        $params['room_id'] = $request->roomId ?? 0;
        $params['page'] = $request->page ?? 1;
        $params['perPage'] = $request->perPage ?? 10;
        $roomCurrent = (new RoomModel)->getItem(['id' => $params['room_id']], ['task' => 'get-item']);
        $listMessage = (new MessagesModel)->listItems($params, ['task' => 'frontend-list-items-api']);
        $listMessage = $listMessage->reverse()->values();
        $roomCurrent['created_by'] = 0;
        $message['user_id'] = 0;
        foreach ($listMessage as $k => $message) {
            $role = 0;
            if ($roomCurrent['created_by'] == $message['user_id']) {
                $role = 1;
            }
            $listMessage[$k]['role'] = $role;
        }
        $this->res['data'] = $listMessage;
        return $this->setResponse($this->res);
    }
    public function getListRoomOfUser(Request $request)
    {
        $token = $request->header('Tdoctor-Token') ?? 'hhhhh';
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        $listRoom = [];
        $this->res['data']=[];
        if ($data_token['message'] == 'OK') {
            $params['user'] =  (array)$data_token['payload'];
            $infoUserGetList = (array)$data_token['payload'];
            $userIdGetList=$infoUserGetList['user_id'];
            if ($infoUserGetList['user_type_id'] == 2) {
                $listRoom = (new RoomModel)->listItems(['type_room' => 'group_bac_si'], ['task' => 'frontend-list-items-api']);
            } else if ($infoUserGetList['user_type_id'] == 5) {
                $listRoom = (new RoomModel)->listItems(['type_room' => 'group_duoc_si'], ['task' => 'frontend-list-items-api']);
            }else{
                $groupIdRoomOfUser = RoomUserModel::where('user_id', $userIdGetList)->pluck('room_id');
                $listRoom = (new RoomModel)->listItems(['group_id' => $groupIdRoomOfUser], ['task' => 'frontend-list-items-api']);
            }
            if(!empty($listRoom)){
                foreach ($listRoom as $key => $value) {
                    $userReceiverInRoom = RoomUserModel::where('user_id','<>',$userIdGetList)->where('room_id',$value['id'])->first();
                    $idUserReceiver=$userReceiverInRoom['user_id'] ?? 1;
                    $userReceiver=UsersModel::where('user_id',$idUserReceiver)->first();
                    if($userReceiver){
                        $listRoom[$key]['user_receiver'] = $userReceiver['fullname']??'No Name';
                    }else{
                        $listRoom[$key]['user_receiver'] = null;
                    }
                    $item = $value->listMessageLast()->first();
                    if($item){
                        $role = 0;
                        if ($value['created_by'] == $item['user_id']) {
                            $role = 1;
                        }
                        $item['role'] = $role;
                        $listRoom[$key]['list_messages'] = $item;
                        $userCreatedRoom = UsersModel::where('user_id', $value['created_by'])->first();
                        $listRoom[$key]['list_messages']['user_send'] = [
                            'user_id' => $userCreatedRoom->user_id ?? '',
                            'fullname' => $userCreatedRoom->fullname ?? '',
                            'email' => $userCreatedRoom->email ?? '',
                            'phone' => $userCreatedRoom->phone ?? ''
                        ];
                    }else{
                        $listRoom[$key]['list_messages'] = null;
                    }
                }
            }
            $this->res['data'] = $listRoom;
        }
        return $this->setResponse($this->res);
    }
    public function getListMessageDoctor(Request $request)
    {
        $token = $request->header('Tdoctor-Token') ?? 'hhhhh';
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        $listRoom = [];
        if ($data_token['message'] == 'OK') {
            $params['user'] =  (array)$data_token['payload'];
            $infoUserGetList = (array)$data_token['payload'];
            $userIdGetList=$infoUserGetList['user_id'];
            if ($infoUserGetList['user_type_id'] == 2) {
                $listRoom = (new RoomModel)->listItems(['type_room' => 'group_bac_si'], ['task' => 'frontend-list-items-api']);
            } else if ($infoUserGetList['user_type_id'] == 5) {
                $listRoom = (new RoomModel)->listItems(['type_room' => 'group_duoc_si'], ['task' => 'frontend-list-items-api']);
            }else{
                $groupIdRoomOfUser = RoomUserModel::where('user_id', $userIdGetList)->pluck('room_id');
                $listRoom = (new RoomModel)->listItems(['group_id' => $groupIdRoomOfUser], ['task' => 'frontend-list-items-api']);
            }
        }
        if(!empty($listRoom)){
            foreach ($listRoom as $key => $value) {
                $userReceiverInRoom = RoomUserModel::where('user_id','<>',$value['created_by'])->where('room_id',$value['id'])->first();
                $idUserReceiver=$userReceiverInRoom['user_id'] ?? 1;
                $userReceiver=UsersModel::where('user_id',$idUserReceiver)->first();
                if($userReceiver){
                    $listRoom[$key]['user_receiver'] = $userReceiver['fullname']??'No Name';
                }else{
                    $listRoom[$key]['user_receiver'] = null;
                }
                $item = $value->listMessageLast()->first();
                if($item){
                    $role = 0;
                    if ($value['created_by'] == $item['user_id']) {
                        $role = 1;
                    }
                    $item['role'] = $role;
                    $listRoom[$key]['list_messages'] = $item;
                    $userCreatedRoom = UsersModel::where('user_id', $value['created_by'])->first();
                    $listRoom[$key]['list_messages']['user_send'] = [
                        'user_id' => $userCreatedRoom->user_id ?? '',
                        'fullname' => $userCreatedRoom->fullname ?? '',
                        'email' => $userCreatedRoom->email ?? '',
                        'phone' => $userCreatedRoom->phone ?? ''
                    ];
                }else{
                    $listRoom[$key]['list_messages'] = null;
                }
            }
        }
        $this->res['data'] = $listRoom;
        return $this->setResponse($this->res);
    }
    public function sendNotification3(Request $request)
    {
        // Lấy thông tin từ request
        $deviceToken = str_replace(' ', '', $request->device_token ?? '');
        $title = $request->title;
        $body = $request->body;
        // Kiểm tra nếu thiếu bất kỳ thông tin cần thiết nào
        if (empty($deviceToken) || empty($title) || empty($body)) {
            return response()->json(['error' => 'Missing parameters'], 400);
        }
        // Dữ liệu thông báo
        $messageData = [
            'title' => $title,
            'body' => $body,
            'data' => [
                'key1' => 'value1', // Dữ liệu tùy chọn thêm cho ứng dụng
                'key2' => 'value2',
            ]
        ];
        // Khởi tạo Google Client
        try {
            $client = new Google_Client();

            // Đảm bảo rằng tệp firebase_credentials.json tồn tại
            $filePath = public_path('firebase/firebase.json');
            if (!file_exists($filePath)) {
                \Log::error("Tệp firebase_credentials.json không tồn tại tại: " . $filePath);
                return response()->json(['error' => 'Firebase credentials file not found.'], 500);
            }
            // Cấu hình Google Client với firebase_credentials.json
            $client->setAuthConfig($filePath);
            $client->addScope('https://www.googleapis.com/auth/firebase.messaging');
            // Kiểm tra và lấy Access Token
            $accessToken = $client->fetchAccessTokenWithAssertion();
            if (isset($accessToken['error'])) {
                \Log::error("Lỗi khi lấy Access Token từ Google: " . json_encode($accessToken['error']));
                return response()->json(['error' => 'Unable to get access token'], 500);
            }
            // Gửi thông báo đến deviceToken qua Firebase
            $url = 'https://fcm.googleapis.com/v1/projects/medix-link/messages:send'; // Thay YOUR_PROJECT_ID với ID dự án Firebase của bạn
            $postData = [
                'message' => [
                    'token' => $deviceToken,
                    'notification' => [
                        'title' => $messageData['title'],
                        'body' => $messageData['body']
                    ],
                    'data' => $messageData['data'] ?? []
                ]
            ];
            // Gửi yêu cầu POST đến FCM
            $response = $this->sendCurlRequest($url, $accessToken['access_token'], $postData);
            // Kiểm tra lỗi từ phản hồi của Firebase
            if (isset($response['error'])) {
                \Log::error("Lỗi gửi thông báo từ Firebase: " . json_encode($response['error']));
                return response()->json(['error' => 'Error sending notification: ' . json_encode($response['error'])], 500);
            }
            // Thành công
            return response()->json([
                'status' => true,
                'message' => 'Notification sent successfully',
                'data' => $response
            ]);
        } catch (Exception $e) {
            // Ghi lại thông tin lỗi
            \Log::error("Lỗi trong quá trình cấu hình Firebase: " . $e->getMessage());
            return response()->json(['error' => 'Failed to send notification: ' . $e->getMessage()], 500);
        }
    }
    /**
     * Gửi yêu cầu cURL
     *
     * @param string $url
     * @param string $accessToken
     * @param array $postData
     * @return mixed
     */
    private function sendCurlRequest($url, $accessToken, $postData)
    {
        $ch = curl_init();
        curl_setopt_array($ch, [
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST => true,
            CURLOPT_HTTPHEADER => [
                'Authorization: Bearer ' . $accessToken,
                'Content-Type: application/json'
            ],
            CURLOPT_POSTFIELDS => json_encode($postData)
        ]);
        $response = curl_exec($ch);
        curl_close($ch);
        return json_decode($response, true);
    }
    public function sendImageMessage(Request $request){
        $token = $request->header('Tdoctor-Token') ?? 'hhhhh';
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        $roomId = $request->roomId ?? 1;  
        $messageCurrent = [];
        $content = '';
        if ($data_token['message'] == 'OK') {
            $infoUserGetList = (array)$data_token['payload'];
            $idUserGetList = $infoUserGetList['user_id'];
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $destinationPath = public_path('fileUpload/message'); 
                $file->move($destinationPath, $fileName);
                $content = asset('/laravel-filemanager/fileUpload/message/' . $fileName);
            }
            $params = [
                'content' => $content,
                'room_id' => $roomId,
                'user_id' => $idUserGetList,
                'type' => 'image'
            ];
            $messageCurrent = $this->model->saveItem($params, ['task' => 'add-item']);
        }
        $this->res['data'] = [];
        $this->res['message'] = 'Gửi tin nhắn thành công!';
        return $this->setResponse($this->res);
    }
    public function saveMessageImage(Request $request){
        $imageContent = '';
        if ($request->has('image_content')){
            $base64Image = $request->image_content;
            // Giải mã chuỗi Base64 thành dữ liệu nhị phân
            $imageData = base64_decode($base64Image, true);
            if ($imageData !== false && !empty($imageData)) {
                // Tạo tên file duy nhất (sử dụng timestamp hoặc UUID)
                $fileName = 'image_' . time() . '.jpg'; 
                // Đặt đường dẫn lưu ảnh trong thư mục public/fileUpload/message
                $destinationPath = public_path('fileUpload/message');
                // Kiểm tra nếu thư mục chưa tồn tại thì tạo mới
                if (!file_exists($destinationPath)) {
                    mkdir($destinationPath, 0777, true); // Tạo thư mục nếu chưa có
                }
                // Lưu dữ liệu nhị phân vào tệp
                $filePath = $destinationPath . '/' . $fileName;
                file_put_contents($filePath, $imageData);
                // Tạo đường dẫn URL của ảnh đã lưu (để trả lại cho client)
                $imageContent = asset('/laravel-filemanager/fileUpload/message/' . $fileName);
            }
        }
        $params = [
            'content' => $request->content ?? '',
            'image_content' => $imageContent,
            'room_id' => strval($request->room_id) ?? '1',
            'user_id' => $request->user_id ?? 994110172,
            'type' => $request->type ?? 'text'
        ];
        $this->model->saveItem($params, ['task' => 'add-item']);
        $userSend = UsersModel::where('user_id', $params['user_id'])->first();
        if($userSend){
            $nameRoom = $userSend['fullname'] ?? '';
        }
        // Lấy các token của người dùng trong phòng (ngoại trừ người gửi)
        $listUserInRoom = RoomUserModel::where('room_id', $params['room_id'])
                                        ->where('user_id', '!=', $params['user_id'])
                                        ->pluck('user_id');
        $userTokens = UserTokenModel::whereIn('user_id', $listUserInRoom)->pluck('token')->toArray();
        // Gửi thông báo nếu có người dùng trong phòng
        if (count($userTokens) > 0) {
            $title = 'Tin nhắn mới';
            $body = $params['content'];
            $content = $params['content'];
            $nameRoom = $nameRoom ?? 'Unknown';
            $roomId = $params['room_id'] ?? 'Unknown';
            foreach ($userTokens as $deviceToken) {
                if ($deviceToken) {
                    $this->sendNotificationFromReciver($deviceToken, $title, $body, $nameRoom, $roomId, $content);
                }
            }
        }
    }
}
