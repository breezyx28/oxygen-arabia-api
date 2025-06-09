<?php

namespace App\Http\Controllers\Response;

class SuccessForm
{
    public bool $success = true;
    public string $message = 'done successfuly!';
    public mixed $data = [];

    public function __construct(string $message, mixed $data = [])
    {
        // $this->success,
        $this->message = $message;
        $this->data = $data;

        foreach ($this as $key => $value) {
            if ($this->$key === null) {
                unset($this->$key);
            }
        }
    }
}
