<?php

namespace App\Exceptions;

use App\Traits\RestResponse;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Validation\ValidationException;

class Handler extends ExceptionHandler
{
    use RestResponse;
    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     *
     * @return void
     */
    public function register()
    {
        // $this->reportable(function (Throwable $e) {
        //     //
        // });
        $this->renderable(function (Throwable $exception, $request) {
            if ($exception instanceof ModelNotFoundException) {
                $model = strtolower(class_basename($exception->getModel()));
                return $this->error(
                    $request->getPathInfo(),
                    $exception,
                    __('messages.no-exist-instance', ['model' => $model], config('app.locale')),
                    Response::HTTP_NOT_FOUND
                );
                // __('messages.no-exist-instance', ['model' => $this->translateNameModel($model)], config('app.locale')), Response::HTTP_NOT_FOUND);
            }
            if ($exception instanceof NotFoundHttpException) {
                $code = $exception->getStatusCode();
                //                return $this->error($request->getPathInfo(), $exception, $exception->getMessage(), $code);
                return $this->error($request->getPathInfo(), $exception, __('messages.not-found', [], config('app.locale')), $code);
            }

            if ($exception instanceof MethodNotAllowedHttpException) {
                return $this->error($request->getPathInfo(), $exception, __('messages.method-not-allowed', [], config('app.locale')), Response::HTTP_METHOD_NOT_ALLOWED);
            }

            if ($exception instanceof HttpException) {
                $code = $exception->getStatusCode();
                return $this->error($request->getPathInfo(), $exception, __('messages.method-not-allowed', [], config('app.locale')), $code);
            }

            if ($exception instanceof AuthorizationException) {
                return $this->error(
                    $request->getPathInfo(),
                    $exception,
                    __('messages.forbidden', [], config('app.locale')),
                    Response::HTTP_FORBIDDEN
                );
            }

            if ($exception instanceof ValidationException) {

                $errors = $exception->validator->errors()->all();

                return $this->error(
                    $request->getPathInfo(),
                    $exception,
                    $errors,
                    Response::HTTP_BAD_REQUEST
                );

                // $errors = $exception->validator->errors()->all();

                // return $this->error(
                //     $request->getPathInfo(),
                //     $exception,
                //     $errors,
                //     Response::HTTP_BAD_REQUEST
                // );
            }
            if ($exception instanceof DatabaseException) {
                if (config('app.debug')) {
                    return $this->error($request->getPathInfo(), $exception, $exception->getMessage(), $exception->getStatusCode());
                }
                return $this->error($request->getPathInfo(), $exception, __('messages.error-database', [], config('app.locale')), $exception->getStatusCode());
            }


            if (
                $exception instanceof UnprocessableException
                || $exception instanceof ConflictException
                || $exception instanceof BadRequestException
                || $exception instanceof NotContentException
                || $exception instanceof NotFoundException
            ) {

                $code = $exception->getStatusCode();
                $message = $exception->getMessage();
                return $this->error($request->getPathInfo(), $exception, $message, $code);
            }



            if ($exception->getCode() >= 500) {
                return $this->error($request->getPathInfo(), $exception, $exception->getMessage(), $exception->getCode());
            }
            if (config('app.debug')) {
                //return parent::render($request, $exception);
                return $this->error($request->getPathInfo(), $exception, $exception->getMessage(), Response::HTTP_INTERNAL_SERVER_ERROR);
            }

            return $this->error($request->getPathInfo(), $exception, __('messages.internal-server-error', [], config('app.locale')), Response::HTTP_INTERNAL_SERVER_ERROR);
        });
    }
}
