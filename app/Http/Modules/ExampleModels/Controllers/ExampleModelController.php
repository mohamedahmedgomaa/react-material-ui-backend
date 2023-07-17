<?php

namespace App\Http\Modules\ExampleModels\Controllers;


use App\Http\Base\Controllers\BaseApiController;
use App\Http\Modules\ExampleModels\Requests\CreateExampleModelRequest;
use App\Http\Modules\ExampleModels\Requests\DeleteExampleModelRequest;
use App\Http\Modules\ExampleModels\Requests\ListExampleModelRequest;
use App\Http\Modules\ExampleModels\Requests\ShowExampleModelRequest;
use App\Http\Modules\ExampleModels\Requests\UpdateExampleModelRequest;
use App\Http\Modules\ExampleModels\Services\ExampleModelService;

class ExampleModelController extends BaseApiController
{

    /**
     * @param ExampleModelService $service
     */
    public function __construct(ExampleModelService $service)
    {
        parent::__construct($service,[
            'index' => ListExampleModelRequest::class,
            'show' => ShowExampleModelRequest::class,
            'store' => CreateExampleModelRequest::class,
            'update' => UpdateExampleModelRequest::class,
            'destroy' => DeleteExampleModelRequest::class,
        ]);
    }

}
