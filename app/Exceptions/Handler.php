<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\{
    Facades\Log,
    Str
};
use Symfony\Component\HttpFoundation\{
    Response,
    Exception\BadRequestException
};
use Symfony\Component\HttpKernel\Exception\{
    NotFoundHttpException,
    UnauthorizedHttpException,
    MethodNotAllowedHttpException
};

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
     * Register the exception handling callbacks for the application.
     */
    // public function register(): void
    // {
    //     $this->reportable(function (Throwable $e) {
    //         //
    //     });
    // }

    public function register(): void
    {
        $this->renderable(function (Throwable $exception) {
            Log::alert('Exception Handler Trap', [
                'error' => $exception->getMessage()
            ]);

            if ($exception instanceof NotFoundHttpException) {
                return response()->json([
                    'success' => false,
                    'error' => $exception->getMessage(),
                    'message' => 'wrong route'
                ], Response::HTTP_NOT_FOUND);
            }

            if ($exception instanceof ModelNotFoundException) {
                return response()->json([
                    'success' => false,
                    'error' => $exception->getMessage(),
                    'message' => 'not exists'
                ], Response::HTTP_NOT_FOUND);
            }

            if ($exception instanceof MethodNotAllowedHttpException) {

                return response()->json([
                    'success' => false,
                    'error' => $exception->getMessage(),
                    'message' => 'wrong Method'
                ], Response::HTTP_METHOD_NOT_ALLOWED);
            }

            if ($exception instanceof BadRequestException) {

                return response()->json([
                    'success' => false,
                    'error' => $exception->getMessage(),
                    'message' => 'bad request'
                ], Response::HTTP_BAD_REQUEST);
            }

            if ($exception instanceof UnauthorizedHttpException) {

                return response()->json([
                    'success' => false,
                    'error' => $exception->getMessage(),
                    'message' => 'Unauthorized'
                ], Response::HTTP_UNAUTHORIZED);
            }

            if (Response::HTTP_INTERNAL_SERVER_ERROR) {

                // check if we are Unauthenticated
                $unauthenticated = Str::contains($exception->getMessage(), 'Unauthenticated');

                if ($unauthenticated == true) {

                    return response()->json([
                        'success' => false,
                        'error' => $exception->getMessage(),
                        'message' => 'You are un unauthenticated .... please login'
                    ], 401);
                }

                return response()->json([
                    'success' => false,
                    'error' => $exception->getMessage(),
                    'message' => 'internal server error'
                ], 500);
            }

            return response()->json([
                'success' => false,
                'error' => $exception->getMessage(),
                'message' => ""
            ]);
        });
    }
}
