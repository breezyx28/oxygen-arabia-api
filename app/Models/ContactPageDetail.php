<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactPageDetail extends Model
{
    use HasFactory;

    /**
     * Get the last record from the database.
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public static function getLastRecord()
    {
        return self::latest()->first();
    }
}
