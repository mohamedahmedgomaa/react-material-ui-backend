<?php

namespace App\Http\modules\user\request;

use App\Http\common\base\request\BaseRequest;

class SendOTPRequest extends BaseRequest
{
    public function authorize(): bool
    {
        // TODO check policy
        return true;
    }

    public function rules(): array
    {
        return [
            'email' => 'required|exists:users,email',
            'password' => 'required',
        ];
    }
}
