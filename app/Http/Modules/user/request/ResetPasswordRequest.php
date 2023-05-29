<?php

namespace App\Http\modules\user\request;

use App\Http\common\base\request\BaseRequest;

class ResetPasswordRequest extends BaseRequest
{
    public function authorize(): bool
    {
        // TODO check policy
        return true;
    }

    public function rules(): array
    {
        return [
            "type" => ['required', "in:check,validate,reset"],
            'phone' => ['required', 'string', 'max:10'],

            "account_type" => ['required_if:type,validate,reset', "in:user,sub_user"],

            'otp' => ['required_if:type,==,validate,reset', 'numeric', 'digits:4'],

            'password' => ['required_if:type,==,reset', 'string',
               // Password::min(8)->mixedCase()->numbers()->symbols()->uncompromised(), 'confirmed'
            ],
        ];
    }
}
