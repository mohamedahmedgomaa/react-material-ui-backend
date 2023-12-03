<?php

namespace App\Http\Modules\Posts\Services;

use App\Http\Base\Services\BaseApiService;
use App\Http\Modules\Posts\Repositories\PostRepository;

class PostService extends BaseApiService
{

    /**
     * @param PostRepository $repository
     */
    public function __construct(PostRepository $repository)
    {
        parent::__construct($repository);
    }

}
