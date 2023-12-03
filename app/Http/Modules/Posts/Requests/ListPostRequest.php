<?php

namespace App\Http\Modules\Posts\Requests;

use App\Http\Base\Requests\BaseRequest;

class ListPostRequest extends BaseRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
        ];
    }

}
