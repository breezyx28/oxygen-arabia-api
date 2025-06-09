<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function current_user()
    {
        return $this->Success(data: auth()->user());
    }
}
