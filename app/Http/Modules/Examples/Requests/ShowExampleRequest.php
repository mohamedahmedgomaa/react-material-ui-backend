<?php

namespace App\Http\Modules\Examples\Requests;

use App\Http\Base\Requests\BaseRequest;

class ShowExampleRequest extends BaseRequest
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
