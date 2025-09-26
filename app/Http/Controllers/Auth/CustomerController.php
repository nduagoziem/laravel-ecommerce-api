<?php

namespace App\Http\Controllers\Auth;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\Auth\LoginCustomerRequest;
use App\Http\Requests\Auth\RegisterCustomerRequest;

class CustomerController extends Controller
{
    // Authentication Controller for Customers

    public function register(RegisterCustomerRequest $registerCustomerRequest): JsonResponse
    {
        $data = $registerCustomerRequest->validated();

        $customer = Customer::create([
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'password' => Hash::make($data['password']),
        ]);

        $registerCustomerRequest->session()->regenerate();

        Auth::guard("customer")->login($customer, true);

        return response()->json([
            "success" => true,
            'message' => "Your account was created successfully.",
        ], 201);
    }

    public function login(LoginCustomerRequest $loginCustomerRequest): JsonResponse
    {
        $data = $loginCustomerRequest->validated();

        $customer = Customer::where("email", strtolower($data['email']))->first();

        if (!$customer || !Hash::check($data['password'], $customer->password)) {
            return response()->json([
                'success' => false,
                'message' => 'Invalid credentials.',
            ], 401);
        }

        $loginCustomerRequest->session()->regenerate();

        Auth::guard('customer')->login($customer, true);

        return response()->json([
            "success" => true,
            "message" => "Login successful."
        ], 200);
    }

    public function getLoggedInCustomer(): JsonResponse
    {
        $name = Auth::guard("customer")->user()->name;
        $email = Auth::guard("customer")->user()->email;

        return response()->json([
            "success" => true,
            "message" => [
                "name" => $name,
                "email" => $email,
            ]
        ], 200);
    }

    public function logout(Request $request): JsonResponse
    {
        Auth::guard('customer')->logout();

        $request->session()->invalidate();

        return response()->json(['message' => 'Logged out.'], 200);
    }
}
