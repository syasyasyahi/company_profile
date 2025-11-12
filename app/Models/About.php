<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class About extends Model
{
    protected $fillable = [
         'image',
         'title',
         'description',
         'features'
    ];

    protected $casts = ['features' => 'array'];
}
