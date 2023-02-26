<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\Routing\Exception\RouteNotFoundException;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
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
        $this->renderable(function (Exception $e, $request) {
            return $this->handleException($request, $e);
        });
    }

    public function handleException($request, Exception $exception)
    {
        if ($request->is('api/*')) {
            if ($exception instanceof AuthenticationException) {
                return response()->json(['success' => false, 'message' => 'Unauthorized!!'], 401);
            }
            if ($exception instanceof RouteNotFoundException) {
                return response()->json(['success' => false, 'message' => 'The specified URL cannot be found!!'], 404);
            }
            if ($exception instanceof NotFoundHttpException) {
                return response()->json(['success' => false, 'message' => 'The specified URL cannot be found!!'], 404);
            }
            if ($exception instanceof MethodNotAllowedHttpException) {
                return response()->json(['success' => false, 'message' => 'Method not supported for this URL!!'], 500);
            }
        }
    }

    protected function invalidJson($request, ValidationException $exception)
    {
        return response()->json([
            'success' => false,
            'message' => $exception->getMessage(),
            'errors' => $exception->errors(),
        ], $exception->status);
    }
}
