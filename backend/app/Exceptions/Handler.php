<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Validation\ValidationException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\UserNotDefinedException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
        if ($exception instanceof ValidationException) {
            return response()->json(['status' => false, 'data' => $exception->errors()], 402);
        }
        if ($exception instanceof TokenExpiredException) {
            return response()->json(['status' => false, 'message' => "Token was expired", 'type' => 1], 402);
        }

        if ($exception instanceof UserNotDefinedException) {
            return response()->json(['status' => false, 'message' => "email or/and password are incorrect"], 402);
        }

        if ($exception instanceof Exception) {
            return response()->json(['status' => false, 'message' => "Something wrong happen"], 402);

        }

        return parent::render($request, $exception);
    }
}
