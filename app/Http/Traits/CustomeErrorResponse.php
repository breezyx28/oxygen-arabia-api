<?php

namespace App\Http\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

trait CustomeErrorResponse
{
    protected function failedValidation(Validator $validator)
    {

        $errors = $validator->errors()->messages();
        $formattedErrors = [];

        foreach ($errors as $field => $messages) {
            $formattedErrors[$field] = $messages[0];
        }

        throw new HttpResponseException(response()->json([
            'message' => 'The given data was invalid.',
            'errors' => $formattedErrors,
        ], 422));
    }
}
