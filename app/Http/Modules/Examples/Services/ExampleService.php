<?php

namespace App\Http\Modules\Examples\Services;


use App\Http\Base\Services\BaseApiService;
use App\Http\Modules\Examples\Repositories\ExampleRepository;

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
