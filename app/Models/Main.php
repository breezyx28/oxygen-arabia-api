<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Main extends Model
{
    use HasFactory;

    protected $table = 'main';

    protected $casts = [
        'hero_slider_imgs' => 'array',
        'section_2_icons' => 'array',
        'section_6_slider' => 'array',
        'hero_card_1' => 'array',
        'hero_card_2' => 'array',
        'section_3_card_1_features' => 'array',
        'section_3_card_2_features' => 'array',
        'section_3_card_3_features' => 'array',
        'section_5_card_card' => 'array',
    ];

    protected function getImageUrl($attribute)
    {
        $value = $this->attributes[$attribute];
        if (filter_var($value, FILTER_VALIDATE_URL)) {
            return $value;
        }
        return $value ? asset(Storage::url($value)) : null;
    }

    public function getHeroCoverAttribute()
    {
        return $this->getImageUrl('hero_cover');
    }

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
