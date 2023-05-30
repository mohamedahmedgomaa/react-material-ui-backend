<?php

namespace App\Http\Modules\Examples\Repositories;

use App\Http\Base\Repositories\BaseApiRepository;
use App\Http\Modules\Examples\Models\Example;

class ExampleRepository extends BaseApiRepository
{
    /**
     * Examples constructor.
     *
     * @param Example $model
     */
    public function __construct(Example $model)
    {
        $this->model = $model;
    }
}
