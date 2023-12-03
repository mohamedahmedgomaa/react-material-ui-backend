<?php

namespace App\Http\Modules\Posts\Controllers;


use App\Http\Base\Controllers\BaseApiController;
use App\Http\Modules\Posts\Requests\CreatePostRequest;
use App\Http\Modules\Posts\Requests\DeletePostRequest;
use App\Http\Modules\Posts\Requests\ListPostRequest;
use App\Http\Modules\Posts\Requests\ShowPostRequest;
use App\Http\Modules\Posts\Requests\UpdatePostRequest;
use App\Http\Modules\Posts\Services\PostService;

class PostController extends BaseApiController
{

    /**
     * @param PostService $service
     */
    public function __construct(PostService $service)
    {
        parent::__construct($service,[
            'index' => ListPostRequest::class,
            'show' => ShowPostRequest::class,
            'store' => CreatePostRequest::class,
            'update' => UpdatePostRequest::class,
            'destroy' => DeletePostRequest::class,
        ]);
    }

}
