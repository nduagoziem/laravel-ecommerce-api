<?php

namespace App\Http\Controllers\Auth;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\Auth\RegisterCustomerRequest;

class CustomerController extends Controller
{
    // Authentication Controller for Customers

    public function register(RegisterCustomerRequest $registerCustomerRequest): JsonResponse
    {
        $data = $registerCustomerRequest->validated();

        Customer::create([
            'name' => $data['name'],
            'email' => strtolower($data['email']),
            'password' => bcrypt($data['password']),
        ]);

        return response()->json([
            "success" => true,
            'message' => "Your account was created successfully.",
        ], 200);
    }
    public function logout(Request $request, Response $response): JsonResponse
    {

        Auth::guard("web")->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        $response = "Logged Out.";

        return response()->json([
            "message" => $response
        ], 200);
    }
}
