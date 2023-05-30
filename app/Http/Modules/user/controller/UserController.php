<?php

namespace App\Http\modules\user\controller;

use App\Http\common\base\controller\BaseApiController;
use App\Http\modules\user\request\LoginRequest;
use App\Http\modules\user\request\ResetPasswordRequest;
use App\Http\modules\user\request\SendOTPRequest;
use App\Http\modules\user\service\ExampleService;
use Illuminate\Http\Request;

class UserController extends BaseApiController
{
    /**
     * UserController Constructor
     *
     * @param ExampleService $service
     *
     */
    public function __construct(ExampleService $service)
    {
        parent::__construct($service,[
            'index' => GetUserRequest::class,
//            'show' => GetUserRequest::class,
//            'store' => CreateTeamsAppointmentRequest::class,
//            'update' => UpdateTeamsAppointmentRequest::class,
//            'destroy' => DeleteTeamsAppointmentRequest::class,
        ]);
    }

    public function sendOTP(SendOTPRequest $request)
    {
        return $this->service->sendOTP($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->service->login($request);
    }

    public function resetPassword(ResetPasswordRequest $request)
    {
        return $this->service->resetPassword($request);
    }

    public function me()
    {
        return $this->service->me();
    }


    public function sendFCM (Request $request){
        $headers = array(
            'Authorization: key=' . env('FCM_SERVER_KEY'),
            'Content-Type: application/json',
        );

        $fcmFields = $request->get("fields");
/*
     $fcmFields = [
            "to" => $device_token,
//            "contentAvailable" => true,
//            "mutableContent" => true,
//            "data" => [
//                "payload" => $data
//            ],
//            "notification" => [
//                'click_action' => "ACTUAL_SERVICE_LIST",
//                'title' => "Order update",
//                'body' => $body,
//                'sound' => "notificationSound.wav",
//            ],
            "apns" => [
                "headers" => [
                    //"apns-priority" => "5",
                    'apns-push-type' => 'liveactivity',
                    "apns_topic" => "com.munjz.push-type.liveactivity"
                ],
                "payload" => [
                    "aps" => [
                        "timestamp" => time(),
                        "event" => "update",
                        "content-state" => [
                            "status" => 1
                        ],
                        "requestId" => $data['request_no'],
                        "serviceName" => $data['category'],
                        "serviceImage" => "no image"
                    ],

                    "alert" => [
                        "title" => "Race Update",
                        "body" => "Tony Stark is now leading the race!",
                        'sound' => "notificationSound.wav",
                    ]
                ]
            ]
        ];*/


        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmFields));
        $result = curl_exec($ch);
        if ($result === FALSE) {
            $info['msg'] = 'error';
            $info['result'] = curl_error($ch);
        } else {
            $info['msg'] = 'success';
            $info['result'] = $result;
        }
        curl_close($ch);

        return response()->json($info);
    }
}
