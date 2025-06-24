<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Main extends Model
{
    use HasFactory;

    protected $table = 'main';

    protected $casts = [
        'hero_slider_imgs' => 'array',
        'hero_card_1' => 'array',
        'hero_card_2' => 'array',
        'section_2_icons' => 'array',
        'section_3_card_1_features' => 'array',
        'section_3_card_2_features' => 'array',
        'section_3_card_3_features' => 'array',
        'section_5_card_card' => 'array',
        'section_6_slider' => 'array',
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
                'hero_cover',
                'section_3_card_1_icon',
                'section_3_card_2_icon',
                'section_3_card_3_icon',
                'section_4_cover',
                'section_5_card_img',
            ];
            foreach ($singleImageFields as $field) {
                if (isset($record->attributes[$field]) && !empty($record->attributes[$field])) {
                    $record->$field = $record->getImageUrlFromValue($record->attributes[$field]);
                }
            }

            // Manually transform arrays of image paths
            $arrayImageFields = [
                'hero_slider_imgs',
                'section_2_icons',
            ];
            foreach ($arrayImageFields as $field) {
                if (isset($record->attributes[$field])) {
                    $images = is_string($record->attributes[$field]) ? json_decode($record->attributes[$field], true) : $record->attributes[$field];
                    if (is_array($images)) {
                        $record->$field = array_map(fn($img) => $record->getImageUrlFromValue($img), $images);
                    }
                }
            }

            // Handle nested data structures with file paths
            $nestedFields = [
                'section_6_slider' => ['icon'], // field => array of file keys
            ];

            foreach ($nestedFields as $field => $fileKeys) {
                if (isset($record->attributes[$field])) {
                    $data = is_string($record->attributes[$field]) ? json_decode($record->attributes[$field], true) : $record->attributes[$field];
                    if (is_array($data)) {
                        $record->$field = $record->transformNestedFilePaths($data, $fileKeys);
                    }
                }
            }
        }

        return $record;
    }

    /**
     * Transform file paths in nested data structures
     */
    protected function transformNestedFilePaths($data, $fileKeys)
    {
        if (!is_array($data)) {
            return $data;
        }

        return array_map(function ($item) use ($fileKeys) {
            if (is_array($item)) {
                foreach ($fileKeys as $fileKey) {
                    // Always ensure the file key exists in the response
                    if (isset($item[$fileKey])) {
                        if (is_string($item[$fileKey]) && !empty($item[$fileKey])) {
                            $item[$fileKey] = $this->getImageUrlFromValue($item[$fileKey]);
                        } else {
                            $item[$fileKey] = null;
                        }
                    } else {
                        // If the file key doesn't exist, add it as null
                        $item[$fileKey] = null;
                    }
                }
            }
            return $item;
        }, $data);
    }
}
