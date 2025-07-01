<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    protected $casts = [
        'phone_images' => 'array',
    ];
}
