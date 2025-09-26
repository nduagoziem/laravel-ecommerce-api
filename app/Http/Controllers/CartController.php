<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Resources\CartItemsResource;
use Illuminate\Support\Facades\Auth;
use App\Interfaces\CartServiceInterface;

class CartController extends Controller
{
    protected CartServiceInterface $cartService;

    public function __construct(CartServiceInterface $cartServiceInterface)
    {
        $this->cartService = $cartServiceInterface;
    }
    public function addToCart(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string",
            "imagePath" => "required|string",
            'productId' => 'required|integer',
        ]);

        try {

            $this->cartService->addToCart(Auth::guard("customer")->id(), $data["name"], $data["productId"], $data["imagePath"]);

            return response()->json([
                "success" => true,
                "message" => "Added to Cart."
            ]);
        } catch (\Exception $e) {

            return response()->json([
                "success" => false,
                "error" => $e->getMessage()
            ]);
        }
    }

    public function showCart(): CartItemsResource
    {

        $cart = $this->cartService->showCart(Auth::guard("customer")->id());

        return new CartItemsResource($cart);
    }

    public function updateCart(Request $request)
    {
        $data = $request->validate([
            "name" => "required|string",
            'productId' => 'required|integer',
            'quantity' => 'sometimes|integer|min:1',
        ]);

        $this->cartService->updateCart(Auth::guard("customer")->id(), $data["name"], $data["productId"], $data["quantity"]);
    }

    public function removeFromCart(Request $request): JsonResponse
    {
        $data = $request->validate([
            "name" => "required|string",
            'productId' => 'required|integer',
        ]);

        $this->cartService->removeFromCart(Auth::guard("customer")->id(), $data["name"], $data["productId"]);

        return response()->json([
            "success" => true,
            "message" => "Removed from cart",
        ]);
    }

    public function clear(): JsonResponse
    {

        $this->cartService->clear(Auth::guard("customer")->id());

        return response()->json([
            "message" => "Your cart has been cleared",
        ]);
    }

    public function recalculate(): JsonResponse
    {
        $cart = $this->cartService->getCart(Auth::guard("customer")->id());
        $total = $this->cartService->recalculate($cart);
        return response()->json([
            "message" => $total->total
        ]);
    }
}
