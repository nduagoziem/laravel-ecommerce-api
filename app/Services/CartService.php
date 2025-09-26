<?php

namespace App\Services;

use Illuminate\Support\Facades\DB;
use App\Interfaces\CartServiceInterface;
use Illuminate\Database\Eloquent\Collection;
use App\Models\{Accessories, Cart, CartItems, Computers, Phone, Tablets};

class CartService implements CartServiceInterface
{
    public function getCart(int $customerId): Cart
    {
        return Cart::firstOrCreate(['customer_id' => $customerId], ["total" => 0]);
    }

    public function addToCart(int $customerId, string $productName, int $productId, string $image_path, int $quantity = 1): CartItems
    {
        return DB::transaction(function () use ($customerId, $productName, $productId, $image_path, $quantity) {

            $cart = $this->getCart($customerId);

            // Find product from the correct model
            $models = [Phone::class, Computers::class, Tablets::class, Accessories::class];
            $product = null;

            foreach ($models as $model) {
                $product = $model::where('name', $productName)->where('id', $productId)->first();
                if ($product) break;
            }

            if (!$product) {
                throw new \Exception('Product not found or Out of Stock', 400);
            }

            // Check if item already exists in cart
            $exists = $cart->cartItems()->where("name", $productName)->where('product_id', $productId)->exists();
            if ($exists) {
                throw new \Exception('Item is in cart already.', 400);
            }

            $items = $cart->cartItems()->create([
                "name" => $productName,
                'product_id' => $productId,
                "image_path" => $image_path,
                'quantity' => $quantity,
                "price" => $product->price, // Correct price from the DB
                "in_stock" => $product->stock, // Stock level (Number) from the DB
            ]);

            $this->recalculate($cart);

            return $items->fresh();
        });
    }

    public function showCart(int $customerId): Collection
    {
        $cart = $this->getCart($customerId);
        $cartId = $cart?->id;

        return CartItems::where("cart_id", $cartId)->get(["*"]);
    }

    public function updateCart(int $customerId, string $productName, int $productId, int $quantity)
    {
        return DB::transaction(function () use ($customerId, $productName, $productId, $quantity) {
            $cart = $this->getCart($customerId);

            $items = $cart->cartItems()->where("name", $productName)->where("product_id", $productId)->first();

            $items->quantity = max(1, $quantity);
            $items->save();

            $this->recalculate($cart);

            return $items->fresh();
        });
    }

    public function removeFromCart(int $customerId, string $productName, int $productId)
    {
        return DB::transaction(function () use ($customerId, $productName, $productId) {

            $cart = $this->getCart($customerId);

            // Product Name is used so as to avoid errors when two or more products have the same ID
            $deleted = $cart->cartItems()->where("name", $productName)->where("product_id", $productId)->delete();

            $this->recalculate($cart);

            return $deleted;
        });
    }

    public function clear(int $customerId): void
    {
        DB::transaction(function () use ($customerId) {

            $cart = $this->getCart($customerId);

            $cart->delete();
        });
    }

    public function recalculate(Cart $cart): Cart
    {
        $total = 0;

        // Sum up totals from each cart item
        $total = $cart->cartItems()->get()->sum(fn($item) => $item->price * $item->quantity);

        $cart->update([
            'total' => $total
        ]);

        return $cart->refresh();
    }
}
