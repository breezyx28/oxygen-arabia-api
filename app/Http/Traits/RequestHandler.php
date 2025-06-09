<?php

namespace App\Http\Traits;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Support\Facades\Log;

trait RequestHandler
{
    public $string = 'required|string|max:191';
    public $updateString = 'nullable|string|max:191';
    /**
     * Set Exception as a json reponse
     */
    protected function failedValidation(Validator $validator)
    {
        $errors = $validator->errors();
        $messages = [];
        foreach ($errors->getMessages() as $key => $message) {
            $messages[$key] = $message;
        }
        throw new HttpResponseException(response()->json(['success' => false, 'errors' => $messages], 200));
    }
}
