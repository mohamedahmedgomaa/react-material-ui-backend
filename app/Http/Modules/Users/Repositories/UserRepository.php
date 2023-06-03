<?php

namespace App\Http\Modules\Users\Repositories;

use App\Http\Base\Repositories\BaseApiRepository;
use App\Http\Base\Networks\NetworkClient;
use App\Http\Base\Responses\HTTPCode;
use App\Http\Modules\Users\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class UserRepository extends BaseApiRepository
{
    /**
     * SPBalanceRepository constructor.
     *
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param $request
     * @return bool
     * @throws ValidationException
     */
    public function login($request): bool
    {
        if ($token = !auth()->attempt($request->only(['email', 'password']))) {
            throw ValidationException::withMessages([
                'password' => [trans('auth.failed')],
            ]);
        }
        return $token;
    }

    /**
     * @param string $id
     * @return mixed
     */
    public function createPersonalToken(string $id): mixed
    {
        $objToken = $this->model->find($id)->createToken(User::PersonalToken);
        $strToken = $objToken->accessToken;
        $expiration = $objToken->token;
        $expiration->expires_at = \Illuminate\Support\Carbon::now()->addHours(3);
        $expiration->save();
        return $strToken;
    }

    public function findOneByPhone(string $phone): User
    {
        return $this->model::where('phone', $phone)->first();
    }

    public function findOneByEmail(string $email)
    {
        return $this->model::where('email', $email)->first();
    }

    public function authDataWithToken()
    {
        return [
            'user' => auth(User::Guard)->user(),
            'token' => $this->createPersonalToken(auth()->id()),
        ];
    }

    /**
     * @return bool
     */
    public function logout(): bool
    {
        return auth(User::Guard)->logout() ?? true;
    }

}
