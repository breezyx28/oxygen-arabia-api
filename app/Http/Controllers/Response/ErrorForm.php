<?php

namespace App\Http\Controllers\Response;

class ErrorForm
{
    public bool $success = false;
    public string $message;
    public array $data;
    public string|array|null $errors;

    public function __construct(string $message, string|array|null $errors = null, array $data = [])
    {
        // every initalized property (property with value) in this "Class" will be displayed or visual else will be hidden

        // $this->success; ("success" property has it init value = false ,so no need to re-initialized it)

        $this->message = $message;
        $this->data = $data;
        $this->errors = $errors;

        foreach ($this as $key => $value) {
            if ($this->$key === null || $this->$key === []) {
                unset($this->$key);
            }
        }
    }
}
