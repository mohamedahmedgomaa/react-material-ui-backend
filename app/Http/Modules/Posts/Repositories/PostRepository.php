<?php

namespace App\Http\Modules\Posts\Repositories;

use App\Http\Base\Repositories\BaseApiRepository;
use App\Http\Modules\Posts\Models\Post;

class PostRepository extends BaseApiRepository
{
    /**
     * Examples constructor.
     *
     * @param Post $model
     */
    public function __construct(Post $model)
    {
        $this->model = $model;
    }

}
