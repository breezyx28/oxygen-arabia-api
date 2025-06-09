<?php

namespace App\Http\Traits;

trait CheckTrait
{
    public function currentTime()
    {
        return date('H:i:s', time());
    }

    public function currentDate()
    {
        return date('Y-m-d', time());
    }
}
