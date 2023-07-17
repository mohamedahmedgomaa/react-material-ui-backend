<?php

namespace App\Http\Modules\ExampleTests\Requests;

use App\Http\Base\Requests\BaseRequest;

class ListExampleTestRequest extends BaseRequest
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
