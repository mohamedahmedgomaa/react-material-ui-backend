<?php

namespace App\Http\Modules\Examples\Controllers;

use App\Http\Base\Controllers\BaseApiController;
use App\Http\Modules\Examples\Requests\Example\CreateUserRequest;
use App\Http\Modules\Examples\Requests\Example\DeleteExampleRequest;
use App\Http\Modules\Examples\Requests\Example\ListExampleRequest;
use App\Http\Modules\Examples\Requests\Example\ShowExampleRequest;
use App\Http\Modules\Examples\Requests\Example\UpdateExampleRequest;
use Illuminate\Http\Request;
use App\Http\Modules\Examples\Services\ExampleService;

class ExampleController extends BaseApiController
{
    /**
     * ExampleController Constructor
     *
     * @param ExampleService $service
     *
     */
    public function __construct(ExampleService $service)
    {
        parent::__construct($service,[
            'index' => ListExampleRequest::class,
            'show' => ShowExampleRequest::class,
            'store' => CreateUserRequest::class,
            'update' => UpdateExampleRequest::class,
            'destroy' => DeleteExampleRequest::class,
        ]);
    }
}
