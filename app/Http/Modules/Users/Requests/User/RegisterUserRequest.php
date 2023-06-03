<?php

namespace App\Http\Modules\Users\Requests\User;

use App\Http\Base\Requests\BaseRequest;
use Illuminate\Support\Facades\Hash;

class RegisterUserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        // TODO check policy
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:100',
            'phone' => 'required|unique:users,phone',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ];
    }

    protected function passedValidation()
    {
        if($this->has('password'))
        {
            $this->merge(['password' => Hash::make($this->password)]);
        }
    }
}
