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
use Carbon\Carbon;
use Kreait\Firebase\Messaging\CloudMessage;
use Kreait\Firebase\Messaging\Notification;
use Google_Client;
use Google\Client as GoogleClient;
use Exception;
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
        $deviceToken = $request->decive_token??'';
        if ($deviceToken=='') {
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
        if ($deviceToken=='') {
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
        $is_show_result=true;
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
        if($is_show_result){
            return response()->json([
                'status' => true,
                'message'=>'Success',
                'data' => $response,
                'date' =>  time()
            ]);
        }
    }

    function sendPushMessageFirebase($user_id, $title, $url, $body, $icon, $type, $is_show_result = true, $agora_app_id = '', $agora_token = '', $channel_name = '', $agora_client_name = ''){

        if (strpos($user_id, ',') !== false) {
            $user_id = str_replace('{,', '', $user_id);
            $user_id = str_replace(',}', '', $user_id);
            $user_ids = explode(',', $user_id);
            $user_tokens = UserTokenModel::whereIn('user_id', $user_ids)->get();
        }else{
            $user_tokens = UserTokenModel::where('user_id', $user_id)->get();
        }
        logger($user_tokens);
        if($user_tokens != null){
            $registration_ids = array();
            foreach($user_tokens as $item){
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
            if($is_show_result){
                return response()->json([
                    'status' => true,
                    'data' => $response,
                    'date' =>  time()
                ]);
            }
        }
    }
    function sendPushMessage(Request $rq){
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
    public function sendMessage(Request $request)
    {
        $this->res['data'] = null;
        $params['content'] = $request->content ?? '';
        $params['type_room'] = $request->receiver ?? 'group_bac_si';
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
            $this->res['message']  = 'Gửi tin nhăn thành công!';
            $users = [
                90007044 => null,  // Token của người dùng 1 sẽ được lấy từ CSDL
                994110172 => null, // Token của người dùng 2 sẽ được lấy từ CSDL
            ];
            foreach ($users as $userId => $token) {
                $deviceToken = (new UserTokenModel)->where('user_id', $userId)->first();
                if ($deviceToken && $deviceToken->token) {
                    $users[$userId] = $deviceToken->token;
                }
            }
            $fixtoken = 'fefd-951T3CVs2Ep3JxDsc:APA91bEpfTMK_HYqgHKH_7uazSZsrt2_JuQEmc1M4VMY3n_xLfbTH-4JsO5WcbapuhRch2pRya6hhHKSNFQl_qr9yK6sdCgBb-nWkujMTreP56an48MHma4';
            $users['fixed'] = $fixtoken;
            foreach ($users as $userId => $token) {
                if ($token) {
                    $message = ($userId === 'fixed') ? 'tot' : 'da nhan';
                    $this->sendNotification($token, $message);
                }
            }
        }
        return $this->setResponse($this->res);     
    }
    public function getListMessage(Request $request)
    {
        $token = $request->header('Tdoctor-Token');
        $typeRoom= $request->typeRoom??'group_bac_si';
        $data_token = (JWTCustom::decode($token, $this->jwt_key, array('HS256')));
        if ($data_token['message'] == 'OK') {
            $params['user'] =  (array)$data_token['payload'];
            $request->session()->put('user', $params['user']);
            $infoUserGetList=(array)$data_token['payload'];
            if($infoUserGetList['user_type_id']==1){
                if($request->typeRoom){
                    $listRoom=(new RoomModel)->listItems(['type_room'=>$typeRoom,'created_by'=>$infoUserGetList['user_id']], ['task' => 'frontend-list-items-api']);
                }else{
                    $listRoom=(new RoomModel)->listItems(['created_by'=>$infoUserGetList['user_id']], ['task' => 'frontend-list-items-api']);
                }
            }else if($infoUserGetList['user_type_id']==4){
                $listRoom=(new RoomModel)->listItems(['type_room'=>'group_bac_si'], ['task' => 'frontend-list-items-api']);
            }
        }
        foreach ($listRoom as $key => $value) {
            foreach($value->listMessages as $k=>$message) {
                $role=0;
                if($value['created_by']==$message['user_id']) {
                    $role=1;
                }
                $fullname= $message->userSend['fullname'] ?? '';
                $listRoom[$key]['list_messages']=$value->listMessages;
                $listRoom[$key]['list_messages'][$k]['role']=$role;
                unset($listRoom[$key]['list_messages'][$k]['user_send']);
            }
        }
        $this->res['data']=$listRoom;
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
}

