<?php

namespace App\Http\Modules\ExampleTests\Repositories;

use App\Http\Base\Repositories\BaseApiRepository;
use App\Http\Modules\ExampleTests\Models\ExampleTest;

class ExampleTestRepository extends BaseApiRepository
{
    /**
     * Examples constructor.
     *
     * @param ExampleTest $model
     */
    public function __construct(ExampleTest $model)
    {
        $this->model = $model;
    }

}
