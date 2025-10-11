<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => "required|string|max:255",
            'last_name' => "required|string|max:255",
            'email' => "required|string|email|max:255",
            'phone_number' => "required|string",
            'address'  => "required|string|max:255",
            'country' => "required|string",
            'apartment_name' => "nullable|string|max:255",
            'state' => "required|string",
            'postal_code' => "nullable|string",
            'city' => "required|string",
        ];
    }
}
