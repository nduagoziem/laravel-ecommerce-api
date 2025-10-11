<?php

namespace App\Services;

use Carbon\Carbon;
use App\Models\Cart;
use App\Models\Order;
use App\Models\CartItems;
use App\Models\OrderItems;
use Illuminate\Support\Str;
use App\DTO\Order\CreateOrderDTO;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\CartServiceInterface;
use App\Interfaces\OrderServiceInterface;

class OrderService implements OrderServiceInterface
{

    protected CartServiceInterface $cartService;

    public function __construct(CartServiceInterface $cartServiceInterface)
    {
        $this->cartService = $cartServiceInterface;
    }


    /**
     * @inheritDoc
     */
    public function createOrder(CreateOrderDTO $createOrderDTO)
    {
        DB::transaction(function () use ($createOrderDTO) {

            $customerId = Auth::guard("customer")->id();

            Order::create([
                "customer_id" => $customerId,
                'first_name' => $createOrderDTO->first_name,
                'last_name' => $createOrderDTO->last_name,
                'email' => $createOrderDTO->email,
                'phone_number' => $createOrderDTO->phone_number,
                'address' => $createOrderDTO->address,
                'country' => $createOrderDTO->country,
                'apartment_name' => $createOrderDTO->apartment_name,
                'state' => $createOrderDTO->state,
                'postal_code' => $createOrderDTO->postal_code,
                'city' => $createOrderDTO->city,
                'reference' => "ORD" . Carbon::now()->format('YmdHis'),

            ]);
        });
    }

    /**
     * @inheritDoc
     * @throws \Exception
     * @return void
     */
    public function createOrderItemsFromCartItems()
    {
        DB::transaction(function () {
            $customerId = Auth::guard("customer")->id();

            $cart = $this->cartService->getCart($customerId);
            if (!$cart) {
                throw new \Exception("Your cart is empty.");
            }
            $cartItems = CartItems::where("cart_id", $cart->id)->get();

            $order = Order::where("customer_id", $customerId)->latest("created_at")->first(); // The latest order of a customer.

            // Loop through each cart item and create order items
            foreach ($cartItems as $cartItem) {
                OrderItems::create([
                    'order_id' => $order->id,
                    'product_name' => $cartItem->name,
                    'quantity' => $cartItem->quantity,
                    'product_id' => $cartItem->id,
                    'price_per_item' => $cartItem->price,
                ]);
            }
        });
    }

    public function getOrderReference(): string
    {
        $customerId = Auth::guard("customer")->id();

        $order = Order::where("customer_id", $customerId)->latest("created_at")->first(); // The latest order of a customer.

        return $order->reference;
    }

    public function getTotalAmountOfGoods(): Cart
    {
        $customerId = Auth::guard("customer")->id();

        $cart = $this->cartService->getCart($customerId);

        return $this->cartService->recalculate($cart);
    }
}
