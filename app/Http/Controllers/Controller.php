<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Response\ResponseSchema;
use App\Http\Traits\ResourcesTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests, ResponseSchema, ResourcesTrait;
}
