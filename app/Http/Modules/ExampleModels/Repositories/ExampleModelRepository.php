<?php

namespace App\Http\Modules\ExampleModels\Repositories;

use App\Http\Base\Repositories\BaseApiRepository;
use App\Http\Modules\ExampleModels\Models\ExampleModel;

class ExampleModelRepository extends BaseApiRepository
{
    /**
     * Examples constructor.
     *
     * @param ExampleModel $model
     */
    public function __construct(ExampleModel $model)
    {
        $this->model = $model;
    }

}
