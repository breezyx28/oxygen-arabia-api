<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Form extends Model
{
    use HasFactory;

    protected $table = 'form';

    protected $casts = [
        'option_most_interested_options' => 'array',
    ];

    protected function getImageUrl($attribute)
    {
        $value = $this->attributes[$attribute];
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }
        return $value ? asset(Storage::url($value)) : null;
    }

    // Helper to generate the full URL for a given value
    protected function getImageUrlFromValue($value)
    {
        if (!$value) return null;
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }
        return url("/storage/{$value}");
    }

    /**
     * Get the last record from the database.
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public static function getLastRecord()
    {
        $record = self::latest()->first();

        if ($record) {
            // Manually transform single image paths
            $singleImageFields = [
                'form_person_img',
            ];
            foreach ($singleImageFields as $field) {
                if (isset($record->attributes[$field]) && !empty($record->attributes[$field])) {
                    $record->$field = $record->getImageUrlFromValue($record->attributes[$field]);
                }
            }
        }

        return $record;
    }
}
