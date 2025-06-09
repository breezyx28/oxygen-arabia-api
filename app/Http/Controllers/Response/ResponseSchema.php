<?php

namespace App\Http\Controllers\Response;

use \App\Http\Controllers\Response\ErrorForm;
use \App\Http\Controllers\Response\SuccessForm;
use Symfony\Component\HttpFoundation\JsonResponse;

trait ResponseSchema
{
    public function Success(string $message = 'done successfuly!', mixed $data = []): JsonResponse
    {
        return response()->json(new SuccessForm(message: $message, data: $data));
    }

    public function Error(string $message, string|array|null $errors = null): JsonResponse
    {
        return response()->json(new ErrorForm(message: $message, errors: $errors));
    }

    public function SuccessWithCookie(string $message = 'done successfuly!', mixed $data = [], $cookie = null): JsonResponse
    {
        // Create the cookie
        $cookie = cookie('cookie-data', $cookie, 1440, null, null, false, true); // 60 = 1 hour

        return response()->json(new SuccessForm(message: $message, data: $data))->cookie($cookie);
    }
}
