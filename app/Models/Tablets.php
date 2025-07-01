<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tablets extends Model
{
    protected $casts = [
        'tablet_images' => 'array',
    ];
}
