<?php

namespace App\Http\Modules\ExampleModels\Requests;

use App\Http\Base\Requests\BaseRequest;

class DeleteExampleModelRequest extends BaseRequest
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
