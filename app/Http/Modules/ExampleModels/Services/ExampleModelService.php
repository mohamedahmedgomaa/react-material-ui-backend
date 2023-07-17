<?php

namespace App\Http\Modules\ExampleModels\Services;

use App\Http\Base\Services\BaseApiService;
use App\Http\Modules\ExampleModels\Repositories\ExampleModelRepository;

class ExampleModelService extends BaseApiService
{

    /**
     * @param ExampleModelRepository $repository
     */
    public function __construct(ExampleModelRepository $repository)
    {
        parent::__construct($repository);
    }

}
