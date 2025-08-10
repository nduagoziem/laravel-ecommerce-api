<?php

namespace App\Http\Controllers\Auth;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\RegisterCustomerRequest;
use App\Http\Requests\Auth\LoginCustomerRequest;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    // Authentication Controller for Customers

    public function register(RegisterCustomerRequest $registerCustomerRequest): JsonResponse
    {
        $data = $registerCustomerRequest->validated();

        $customer = Customer::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        Auth::login($customer, true);

        return response()->json([
            "success" => true,
            'message' => "Your account was created successfully.",
        ], 201);
    }

    public function login(LoginCustomerRequest $loginCustomerRequest): JsonResponse
    {
        $data = $loginCustomerRequest->validated();

        $customer = Customer::where("email", $data["email"])->first();
        $password = Hash::check($data["password"], $customer->password);

        if (!$customer && !$password) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.',
            ], 401);
        }

        Auth::login($customer, true);

        return response()->json([
            "success" => true,
            "message" => "Login successful."
        ], 200);
    }

    // public function logout(Request $request, Response $response): JsonResponse
    // {

    //     Auth::guard("web")->logout();

    //     $request->session()->invalidate();

    //     $response = "Logged Out.";

    //     return response()->json([
    //         "message" => $response
    //     ], 200);
    // }
}
