<?php

namespace App\Http\Modules\ExampleCommands\Requests;

use App\Http\Base\Requests\BaseRequest;

class UpdateExampleCommandRequest extends BaseRequest
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
