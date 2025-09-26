<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class LoginCustomerRequest extends FormRequest
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
            "email" => "required|string|lowercase|email|max:255",
            "password" => "required",
        ];
    }

    public function messages(): array
    {
        return [
            "email.required" => "Email field can't be empty.",
            'email.lowercase' => 'Email must be lowercase characters.',
            'email.email' => 'Email must be a valid email address.',
            "password.required" => "Password field can't be empty.",
        ];
    }

    protected function failedValidation(Validator $validator): never
    {
        $error = (new ValidationException($validator))->errors();

        throw new HttpResponseException(response()->json([
            'error' => $error,
        ], 422));
    }
}
