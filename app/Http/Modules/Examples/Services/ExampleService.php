<?php

namespace App\Http\Modules\Examples\Services;


use App\Http\Base\Requests\BaseRequest;
use App\Http\Base\Services\BaseApiService;
use App\Http\Modules\Examples\Repositories\ExampleRepository;
use Illuminate\Http\JsonResponse;

class ExampleService extends BaseApiService
{
    /**
     *  UserService constructor.
     *
     * @param ExampleRepository $repository
     */
    public function __construct(ExampleRepository $repository)
    {
        parent::__construct($repository);
    }
}
