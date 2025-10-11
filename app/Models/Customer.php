<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany as HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 *  Authentication model for customers.
 */
class Customer extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function cart(): HasMany
    {
        return $this->hasMany(Cart::class, "customer_id");
    }

    public function order(): HasMany
    {
        return $this->hasMany(Order::class, "customer_id");
    }
}
