<?php

namespace App\Http\Modules\Users\Requests;


use App\Http\Base\Requests\BaseRequest;

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
            'password' => 'required',
        ];
    }
}
