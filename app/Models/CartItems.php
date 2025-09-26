<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'cart_id',
        'product_id',
        'name',
        'price',
        "in_stock",
        "quantity",
        "image_path",
    ];

    public function carts()
    {
        return $this->belongsTo(Cart::class, "cart_id");
    }

    public function product()
    {
        return $this->morphTo();
    }
}
