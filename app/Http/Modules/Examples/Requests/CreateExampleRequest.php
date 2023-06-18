<?php

namespace App\Http\Modules\Examples\Requests;

use App\Http\Base\Requests\BaseRequest;

class CreateExampleRequest extends BaseRequest
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
            'image' => 'required',
        ];
    }
}
