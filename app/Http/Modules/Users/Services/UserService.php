<?php

namespace App\Http\Modules\Users\Services;


use App\Http\Base\Networks\HttpCode;
use App\Http\base\Services\BaseApiService;
use App\Http\Modules\Users\Models\User;
use App\Http\Modules\Users\Enums\ResetRequestTypes;
use App\Http\Modules\Users\Repositories\UserRepository;
use App\Http\Modules\Users\Requests\LoginRequest;
use App\Http\Modules\Users\Requests\ResetPasswordRequest;
use App\Http\Modules\Users\Requests\SendOTPRequest;
use App\Http\Modules\Users\Requests\User\CreateUserRequest;
use App\Http\Modules\Users\Requests\User\RegisterUserRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserService extends BaseApiService
{
    /**
     *  UserService constructor.
     *
     * @param UserRepository $repository
     */
    public function __construct(UserRepository $repository)
    {
        parent::__construct($repository);
    }

    public function register(RegisterUserRequest $request): JsonResponse
    {
        $user = $this->repository->save($request->all());
        return $this->responseWithData([
            'user' => $user,
            'token' => $this->repository->createPersonalToken($user->id),
        ])->setStatusCode(HttpCode::HTTP_OK);
    }

    /**
     * @throws ValidationException
     */
    public function login(LoginRequest $request): JsonResponse
    {
        $this->repository->login($request);

        $user = $this->repository->authDataWithToken();

        return $this->responseWithData($user)->setStatusCode(HttpCode::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $user = $this->repository->authDataWithToken();
        return $this->responseWithData($user)->setStatusCode(HttpCode::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $this->repository->logout();
        return $this->responseWithMessage('Successfully logged out')->setStatusCode(HttpCode::HTTP_OK);
    }

    /**
     * @return JsonResponse
     */
    public function refresh(): JsonResponse
    {
        $user = $this->repository->authDataWithToken();
        return $this->responseWithData($user)->setStatusCode(HttpCode::HTTP_OK);
    }


}
