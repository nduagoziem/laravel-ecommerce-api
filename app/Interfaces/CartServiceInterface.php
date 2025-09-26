<?php

namespace App\Interfaces;

use App\Models\{Cart, CartItems};
use Illuminate\Database\Eloquent\Collection;

/**
 * Blueprint for cart services
 */
interface CartServiceInterface
{
    /**
     * Gets the cart of the logged in customer from the Cart Model
     * @param int $customerId
     * @return Cart
     */
    public function getCart(int $customerId): Cart;

    /**
     * Logged in customer adds to cart
     * @param int $customerId
     * @param string $productName
     * @param int $productId
     * @param string $image_path
     * @param int $quantity
     * @return CartItems
     */
    public function addToCart(int $customerId, string $productName, int $productId, string $image_path, int $quantity = 1): CartItems;

    /**
     * Shows the cart of the logged in customer to the frontend
     * @param int $customerId
     * @return Collection
     */
    public function showCart(int $customerId): Collection;

    /**
     * Logged in customer updates quantity of items in cart
     * @param int $customerId
     * @param string $productName
     * @param int $productId
     * @param int $quantity
     */
    public function updateCart (int $customerId, string $productName, int $productId, int $quantity);

    /**
     * Logged in customer removes from cart
     * @param int $customerId
     * @param string $productName
     * @param int $productId
     */
    public function removeFromCart(int $customerId, string $productName, int $productId);

    /**
     * Clearing of expired carts - 30 days minimum
     * @param int $customerId
     * @return void
     */
    public function clear(int $customerId): void;
    
    /**
     * Recalculates the cart totals for each customer 
     * @param \App\Models\Cart $cart
     * @return Cart
     */
    public function recalculate(Cart $cart): Cart;
}
