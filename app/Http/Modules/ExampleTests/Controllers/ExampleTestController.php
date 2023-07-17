<?php

namespace App\Http\Modules\ExampleTests\Controllers;


use App\Http\Base\Controllers\BaseApiController;
use App\Http\Modules\ExampleTests\Requests\CreateExampleTestRequest;
use App\Http\Modules\ExampleTests\Requests\DeleteExampleTestRequest;
use App\Http\Modules\ExampleTests\Requests\ListExampleTestRequest;
use App\Http\Modules\ExampleTests\Requests\ShowExampleTestRequest;
use App\Http\Modules\ExampleTests\Requests\UpdateExampleTestRequest;
use App\Http\Modules\ExampleTests\Services\ExampleTestService;

class ExampleTestController extends BaseApiController
{

    /**
     * @param ExampleTestService $service
     */
    public function __construct(ExampleTestService $service)
    {
        parent::__construct($service,[
            'index' => ListExampleTestRequest::class,
            'show' => ShowExampleTestRequest::class,
            'store' => CreateExampleTestRequest::class,
            'update' => UpdateExampleTestRequest::class,
            'destroy' => DeleteExampleTestRequest::class,
        ]);
    }

}
