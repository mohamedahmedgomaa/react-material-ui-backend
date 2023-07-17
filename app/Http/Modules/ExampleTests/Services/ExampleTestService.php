<?php

namespace App\Http\Modules\ExampleTests\Services;

use App\Http\Base\Services\BaseApiService;
use App\Http\Modules\ExampleTests\Repositories\ExampleTestRepository;

class ExampleTestService extends BaseApiService
{

    /**
     * @param ExampleTestRepository $repository
     */
    public function __construct(ExampleTestRepository $repository)
    {
        parent::__construct($repository);
    }

}
