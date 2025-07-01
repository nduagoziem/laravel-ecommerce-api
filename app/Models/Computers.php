<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Computers extends Model
{
    protected $casts = [
        'computer_images' => 'array',
    ];
}
