<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Accessories extends Model
{
    protected $casts = [
        'accessories_images' => 'array',
    ];
}
