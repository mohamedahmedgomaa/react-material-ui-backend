<?php

namespace App\Http\Modules\Users\Requests\User;

use App\Http\Base\Requests\BaseRequest;

class ListUserRequest extends BaseRequest
{
    public function authorize(): bool
    {
        // TODO check policy
        return true;
    }

    public function rules(): array
    {
        return [

        ];
    }
}
