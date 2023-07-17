<?php

namespace App\Http\Modules\ExampleModels\Requests;

use App\Http\Base\Requests\BaseRequest;

class ListExampleModelRequest extends BaseRequest
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
