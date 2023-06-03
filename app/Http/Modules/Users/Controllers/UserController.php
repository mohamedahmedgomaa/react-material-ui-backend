<?php

namespace App\Http\Modules\Users\Controllers;

use App\Http\Base\Controllers\BaseApiController;
use App\Http\Modules\Users\Requests\LoginRequest;
use App\Http\Modules\Users\Requests\ResetPasswordRequest;
use App\Http\Modules\Users\Requests\SendOTPRequest;
use App\Http\Modules\Users\Requests\User\CreateUserRequest;
use App\Http\Modules\Users\Requests\User\DeleteUserRequest;
use App\Http\Modules\Users\Requests\User\ListUserRequest;
use App\Http\Modules\Users\Requests\User\RegisterUserRequest;
use App\Http\Modules\Users\Requests\User\ShowUserRequest;
use App\Http\Modules\Users\Requests\User\UpdateUserRequest;
use App\Http\Modules\Users\Services\UserService;
use Illuminate\Http\Request;

class UserController extends BaseApiController
{
    /**
     * UserController Constructor
     *
     * @param UserService $service
     *
     */
    public function __construct(UserService $service)
    {
        parent::__construct($service,[
            'index' => ListUserRequest::class,
            'show' => ShowUserRequest::class,
            'store' => CreateUserRequest::class,
            'update' => UpdateUserRequest::class,
            'destroy' => DeleteUserRequest::class,
        ]);
    }

    public function register(RegisterUserRequest $request)
    {
        return $this->service->register($request);
    }

    public function login(LoginRequest $request)
    {
        return $this->service->login($request);
    }

    public function me()
    {
        return $this->service->me();
    }

    public function refresh()
    {
        return $this->service->refresh();
    }
    public function logout()
    {
        return $this->service->logout();
    }

//    public function resetPassword(ResetPasswordRequest $request)
//    {
//        return $this->service->resetPassword($request);
//    }


//    public function sendOTP(SendOTPRequest $request)
//    {
//        return $this->service->sendOTP($request);
//    }
}
