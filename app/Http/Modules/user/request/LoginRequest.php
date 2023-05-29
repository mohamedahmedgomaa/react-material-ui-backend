<?php

namespace App\Http\modules\user\request;

use App\Http\common\base\request\BaseRequest;

class LoginRequest extends BaseRequest
{
    public function authorize(): bool
    {
        // TODO check policy
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|email', // |exists:users,email
            'otp' => 'required|numeric|digits:4', // |exists:users,mobile_otp,email,'.$this->email
            'password' => 'required',
        ];
    }
}
