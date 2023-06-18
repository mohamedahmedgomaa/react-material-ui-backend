<?php

namespace App\Http\Modules\ExampleCommands\Controllers;


use App\Http\Base\Controllers\BaseApiController;
use App\Http\Modules\ExampleCommands\Requests\CreateExampleCommandRequest;
use App\Http\Modules\ExampleCommands\Requests\DeleteExampleCommandRequest;
use App\Http\Modules\ExampleCommands\Requests\ListExampleCommandRequest;
use App\Http\Modules\ExampleCommands\Requests\ShowExampleCommandRequest;
use App\Http\Modules\ExampleCommands\Requests\UpdateExampleCommandRequest;
use App\Http\Modules\ExampleCommands\Services\ExampleCommandService;

class ExampleCommandController extends BaseApiController
{

    /**
     * @param ExampleCommandService $service
     */
    public function __construct(ExampleCommandService $service)
    {
        parent::__construct($service,[
            'index' => ListExampleCommandRequest::class,
            'show' => ShowExampleCommandRequest::class,
            'store' => CreateExampleCommandRequest::class,
            'update' => UpdateExampleCommandRequest::class,
            'destroy' => DeleteExampleCommandRequest::class,
        ]);
    }

}
