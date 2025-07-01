<?php

namespace App\Http\Requests;

use App\Models\Phone;
use Illuminate\Foundation\Http\FormRequest;

class PhoneRequest extends FormRequest
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
            //
        ];
    }

    public function phoneGetRequest()
    {
        $perPage = request()->query('per_page', 10);
        $phones = Phone::inRandomOrder("id")->paginate($perPage);

        // Transform the data
        $phones
            ->getCollection()
            ->transform(function ($phone) {
                $images = $phone->phone_images;
                if (is_string($images) && !empty($images)) {
                    $images = [$images];
                } elseif (!is_array($images)) {
                    $images = [];
                }
                $images = array_map(fn($img) => asset("storage/{$img}"), $images);
                return [
                    'id' => $phone->id,
                    'name' => $phone->name,
                    'phone_images' => $images,
                    'tags' => $phone->tags,
                    'price' => $phone->price,
                    'stock' => $phone->stock,
                    'description' => $phone->description,
                ];
            });

        return response()->json([
            'data' => $phones->items(),
            'current_page' => $phones->currentPage(),
            'last_page' => $phones->lastPage(),
            'per_page' => $phones->perPage(),
            'total' => $phones->total(),
        ]);
    }
}
