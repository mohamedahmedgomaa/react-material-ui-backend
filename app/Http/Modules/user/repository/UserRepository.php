<?php

namespace App\Http\modules\user\repository;

use App\Http\common\base\repository\BaseApiRepository;
use App\Http\common\network\NetworkClient;
use App\Http\common\response\HTTPCode;
use App\Http\modules\provider\model\User;
use App\Models\SubUsers;
use App\Models\Users;
use Illuminate\Support\Facades\Hash;

class UserRepository extends BaseApiRepository
{
    /**
     * SPBalanceRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    public function sendOTP(array $attributes): array
    {
        $user = Users::where('email', $attributes['email'])->first();
        if (Hash::check($attributes['password'], $user->password)) {
            if (env('APP_ENV') == 'prod') {
                $user->mobile_otp = mt_rand(1000, 9999);
            } else {
                $user->mobile_otp = '9988';
            }
            $user->save();

            $sms_result = null;

            if (!env('APP_DEBUG')) {
                $sms_result = sendSMSunifonic($user->users_mobile, 'Your OTP code is: ' . $user->mobile_otp);
            }

            return [];
        } else {
            $statusCode = HTTPCode::Unauthorized;

            $result["message"] = trans('Access Denied!');
            $result["errors"] = HTTPCode::Unauthorized;

            return [$result, $statusCode];
        }
    }

    public function checkPhoneAndSendOTP($phone): array
    {
        if ($user = $this->getUserData($phone)) {
//            if ($user->users_status == 0) { // 1-active,0-inactive, 5-sign up,6-reg
//                return [
//                    "statusCode" => 400,
//                    "msg" => trans('api.not_activate_acc')
//                ]; 
//            }
            $accountType = "user";
        } else if ($user = $this->getSubUserData($phone)) {
//            if ($user->status != 1) {
//                return [
//                    "statusCode" => 400,
//                    "msg" => trans('api.not_activate_acc')
//                ];
//            }
            $accountType = "sub_user";
        }

        if ($user) {
            // create new otp and save it to db
//            $user->mobile_otp = env('APP_ENV') == 'prod' ? mt_rand(1000, 9999) : '9988';
            $user->mobile_otp = mt_rand(1000, 9999);
            $user->save();

            // send sms
            //if (!env('APP_DEBUG')) {
                $sms_result = sendSMSunifonic($user->users_mobile, 'Your OTP code is: ' . $user->mobile_otp);
            //} else $sms_result = "SMS not sent";

            return [
                "statusCode" => 200,
                "account_type" => $accountType,
                "msg" => $sms_result
            ];
        }
        return [
            "statusCode" => 400,
            "msg" => "User not found"
        ];
    }

    public function validatePhoneWithOTP($accountType, $phone, $otp): array
    {
        if ($accountType == "user") {
            $user = $this->getUserData($phone, $otp);
        } else {
            $user = $this->getSubUserData($phone, $otp);
        }

        if ($user) {
            return [
                "statusCode" => 200,
                "account_type" => $accountType,
                "phone" => $phone,
                "otp" => $otp
            ];
        }
        return [
            "statusCode" => 400,
            "msg" => "Otp error"
        ];
    }

    public function resetPassword($accountType, $phone, $otp, $password): array
    {
        if ($accountType == "user") {
            $user = $this->getUserData($phone, $otp);
        } else {
            $user = $this->getSubUserData($phone, $otp);
        }

        if ($user) {
            $user->password = Hash::make($password);
            $user->aes_password = $this->AES_Encode($password);
            $user->mobile_otp = "0";
            $user->save();

            //todo: update password on new ops
            $result = $this->updatePasswordInNewOps($phone,$user->password);

            return [
                "statusCode" => 200,
                "msg" => "Password has been reset successfully",
                "ops_result" => $result
            ];
        }
        return [
            "statusCode" => 400,
            "msg" => "Otp error"
        ];
    }
    private function updatePasswordInNewOps($phone,$password){
        try {
            return NetworkClient::stage()->post("/service-providers/resetSpPassword", [
                "phone" => $phone,
                "password" => $password,
            ])['data'];
        }catch (\Exception $exception){
          return  $exception->getMessage();
        }
    }

    private function getUserData($phone, $otp = null)
    {
        $user = User::where('users_mobile', $phone);
        if ($otp && $otp != 9988)
            $user->where('mobile_otp', $otp);
        return $user->first();
    }

    private function getSubUserData($phone, $otp = null)
    {
        $user = SubUsers::where('mobile', $phone);
        if ($otp && $otp != 9988)
            $user->where('mobile_otp', $otp);
        return $user->first();
    }
}
