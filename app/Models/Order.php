<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Model for customer order info like name, email, address etc
 */
class Order extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'customer_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'address',
        'country',
        'apartment_name',
        'state',
        'postal_code',
        'city',
        'reference',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, "customer_id");
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItems::class, "order_id");
    }
}
