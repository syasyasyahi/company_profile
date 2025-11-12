<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guide extends Model
{
    protected $fillable = [
        'image',
        'name',
        'expertise',
        'social_media'
    ];

    protected $casts = ['social_media' => 'array'];

}
