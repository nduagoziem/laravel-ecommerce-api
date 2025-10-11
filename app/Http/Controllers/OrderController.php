<?php

namespace App\Http\Controllers;

use App\DTO\Order\CreateOrderDTO;
use App\Http\Requests\OrderRequest;
use Emmy\Ego\Factory\PaymentFactory;
use App\Interfaces\OrderServiceInterface;

class OrderController extends Controller
{

    protected OrderServiceInterface $orderService;

    public function __construct(OrderServiceInterface $orderServiceInterface)
    {
        $this->orderService = $orderServiceInterface;
    }

    public function orderAndPay(OrderRequest $orderRequest)
    {
        $data = $orderRequest->validated();

        try {
            $createOrderDTO = new CreateOrderDTO(
                $data["first_name"],
                $data["last_name"],
                $data["email"],
                $data["phone_number"],
                $data["address"],
                $data["country"],
                $data["apartment_name"],
                $data["state"],
                $data["postal_code"],
                $data["city"],
            );

            $this->orderService->createOrder($createOrderDTO);
            $this->orderService->createOrderItemsFromCartItems();
            $amount = $this->orderService->getTotalAmountOfGoods();
            $reference = $this->orderService->getOrderReference();

            $paymentData = [
                "email" => $data["email"],
                "amount" => $amount->total * 100, // Paystack method - Always multiply by 100
                "reference" => $reference,
                "callback_url" => config("ego.credentials.paystack.callback_url"),
            ];

            $paymentFactory = new PaymentFactory();
            $paymentFactory->prepareForPayment($paymentData);
            $response = $paymentFactory->pay();

            return response()->json([
                "success" => true,
                "message" => $response,
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "error" => $e->getMessage(),
            ]);
        }
    }
}
