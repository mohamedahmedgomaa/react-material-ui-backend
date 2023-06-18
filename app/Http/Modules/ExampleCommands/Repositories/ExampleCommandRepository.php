<?php

namespace App\Http\Modules\ExampleCommands\Repositories;

use App\Http\Base\Repositories\BaseApiRepository;
use App\Http\Modules\ExampleCommands\Models\ExampleCommand;

class ExampleCommandRepository extends BaseApiRepository
{
    /**
     * Examples constructor.
     *
     * @param ExampleCommand $model
     */
    public function __construct(ExampleCommand $model)
    {
        $this->model = $model;
    }

}
