<?php

namespace App\Exceptions;

use App\Http\Base\Requests\BaseRequest;
use App\Http\Base\Responses\HTTPCode;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\CssSelector\Exception\InternalErrorException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];


    /**
     * Report or log an exception.
     * @param Throwable $exception
     * @return void
     * @throws Throwable
     */
    public function report(Throwable $exception)
    {
        if (env('SENTRY_ENABLED', 0)) {
            if (app()->bound('sentry') && $this->shouldReport($exception)) {
                app('sentry')->captureException($exception);
            }
        }

        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param Request $request
     * @param Throwable $exception
     *
     * @return Response
     *
     * @throws Throwable
     */
    public function render($request, Throwable $exception): Response
    {
        if ($exception instanceof NotFoundHttpException) {
            $code = HTTPCode::NotFound;
            $error = trans('errors.page_not_found');
        } elseif ($exception instanceof InternalErrorException) {
            $code = HTTPCode::InternalError;
            $error = trans('errors.internal_server_error');
            $this->logThis($error, $exception);
        } elseif ($exception instanceof ValidationException) {
            $code = HTTPCode::ValidatorError;
            $error = BaseRequest::validateRequest($exception->validator);
        } elseif ($exception instanceof ModelNotFoundException) {
            $code = HTTPCode::NotFound;
            $error = trans('errors.record_not_found');
        } elseif ($exception instanceof AuthenticationException) {
            $code = HTTPCode::Unauthorized;
            $error = trans('errors.not_authenticate');
        } else {
            $code = HTTPCode::BadRequest;
            $error = $exception->getMessage();
        }

        return response()->json([
            "status" => $code,
            "errors" => $error,
        ], $code);
    }


    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }
}
