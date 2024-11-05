<?php
namespace App\Http\Controllers\Shop\Api;
use Illuminate\Http\Request;
use Kreait\Firebase\Factory;
use App\Http\Requests;
use App\Http\Controllers\Shop\Api\ApiController;
use App\Model\Shop\DistrictModel;
use App\Model\Shop\MessagesModel as MainModel;
use App\Model\Shop\UsersModel;
use App\Model\Shop\UserValuesModel;
use \Firebase\JWTCustom\JWTCustom as JWTCustom;

class UserController extends ApiController
{
    protected $limit;
    public function __construct(Request $request)
    {
        $this->limit = isset($request->limit) ? $request->limit : 50;
        $this->model = new MainModel();
    }
    /**
     * Gửi tin nhắn từ người dùng thứ 1 đến người dùng thứ 2 và gửi thông báo
     */
    public function sendMessage(Request $request)
    {
        // Kiểm tra dữ liệu đầu vào
        $request->validate([
            'sender_id' => 'required|exists:users,id',
            'receiver_id' => 'required|exists:users,id',
            'message' => 'required|string',
        ]);

        // Lưu tin nhắn vào cơ sở dữ liệu
        $message = $this->model->create([
            'sender_id' => $request->sender_id,
            'receiver_id' => $request->receiver_id,
            'message' => $request->message,
            'status' => 'sent',
        ]);

        // Lấy FCM Token của người nhận
        $receiver = UsersModel::findOrFail($request->receiver_id);
        $receiverFcmToken = $receiver->fcm_token;

        // Nếu có FCM token của người nhận, gửi thông báo
        if ($receiverFcmToken) {
            $this->sendNotification($receiverFcmToken, $request->message);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Tin nhắn đã được gửi và thông báo đã được gửi đến người nhận.',
            'data' => $message
        ]);
    }

    /**
     * Gửi thông báo tới người dùng thông qua FCM
     */
    private function sendNotification($fcmToken, $message)
    {
        // Đường dẫn tới tệp credentials Firebase
        $credentialsPath = config('firebase.firebase_project_1_credentials');

        // Khởi tạo Firebase
        $firebase = (new Factory)->withServiceAccount($credentialsPath)->createMessaging();

        // Tạo thông báo
        $notification = \Kreait\Firebase\Messaging\Notification::create('Bạn có tin nhắn mới', $message);

        // Tạo message gửi FCM
        $fcmMessage = \Kreait\Firebase\Messaging\CloudMessage::withTarget('token', $fcmToken)
            ->withNotification($notification);

        // Gửi thông báo
        try {
            $firebase->send($fcmMessage);
        } catch (\Exception $e) {
            // Xử lý lỗi gửi thông báo
            \Log::error('Failed to send notification: ' . $e->getMessage());
        }
    }
}
