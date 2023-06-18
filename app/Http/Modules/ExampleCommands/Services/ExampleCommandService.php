<?php

namespace App\Http\Modules\ExampleCommands\Services;

use App\Http\Base\Services\BaseApiService;
use App\Http\Modules\ExampleCommands\Repositories\ExampleCommandRepository;

class ExampleCommandService extends BaseApiService
{

    /**
     * @param ExampleCommandRepository $repository
     */
    public function __construct(ExampleCommandRepository $repository)
    {
        parent::__construct($repository);
    }

}
