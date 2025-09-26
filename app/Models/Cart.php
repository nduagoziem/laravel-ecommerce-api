<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = ['customer_id', 'total'];

    public function customer()
    {
        return $this->belongsTo(Customer::class, "customer_id");
    }

    public function cartItems()
    {
        return $this->hasMany(CartItems::class, "cart_id");
    }
}
