<?php

namespace App\Http\modules\user\request\user;

use App\Http\common\base\request\BaseRequest;

class GetUserRequest extends BaseRequest
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
