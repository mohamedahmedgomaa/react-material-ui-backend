<?php

namespace App\Http\Modules\Examples\Requests\Example;

use App\Http\Base\Requests\BaseRequest;

class UpdateExampleRequest extends BaseRequest
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
