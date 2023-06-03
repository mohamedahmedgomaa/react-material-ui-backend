<?php

use App\Http\Modules\Users\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
//
//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::apiResources([
    'example' => App\Http\Modules\Examples\Controllers\ExampleController::class,
]);

Route::group(['middleware' => ['json.response']], function () {

    Route::post('login', [UserController::class, 'login'])->name('login');
    Route::post('register', [UserController::class, 'register'])->name('register');

    Route::group(['middleware' => ['auth:api']], function () {

        Route::get('me', [UserController::class, 'me'])->name('me');

        Route::apiResources([
            'user' => UserController::class,
        ]);
    });
});
