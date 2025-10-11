<?php

namespace App\Interfaces;

use App\DTO\Order\CreateOrderDTO;
use App\Models\Cart;
use App\Models\Order;

/**
 * Blueprint for order services
 */

interface OrderServiceInterface
{
    /**
     * Receives order info from the client and creates it.
     * @param \App\DTO\Order\CreateOrderDTO $createOrderDTO
     */
    public function createOrder(CreateOrderDTO $createOrderDTO);

    /**
     * Creates order items from the customer's cart.
     */
    public function createOrderItemsFromCartItems();

    /**
     * Gets the latest reference of a customer for payment.
     */
    public function getOrderReference();

    /**
     * Gets the total amount of goods a customer is to pay for from the database.
     */
    public function getTotalAmountOfGoods();
}
