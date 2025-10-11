<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for customer order items or products bought.
 */
class OrderItems extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'order_id',
        'product_name',
        'quantity',
        'product_id',
        'price_per_item',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, "order_id");
    }
}
