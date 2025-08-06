<?php

namespace App\Http\Requests\Auth;

use App\Models\Customer;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class RegisterCustomerRequest extends FormRequest
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
            "name" => "required|string",
            "email" => "required|string|lowercase|email|max:255|unique:" . Customer::class,
            "password" => "required|min:8|regex:/\d/",
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'This email has already been taken.',
            'email.email' => 'Email must be a valid email address.',
            'password.min' => 'Password should be at least 8 characters long.',
            'password.regex' => 'Password should have at least one number.',
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $error = (new ValidationException($validator))->errors();

        throw new HttpResponseException(response()->json([
            'error' => $error,
        ], 422));
    }
}
