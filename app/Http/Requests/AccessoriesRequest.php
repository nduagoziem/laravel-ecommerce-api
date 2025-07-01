<?php

namespace App\Http\Requests;

use App\Models\Accessories;
use Illuminate\Foundation\Http\FormRequest;

class AccessoriesRequest extends FormRequest
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

    public function accessoriesGetRequest()
    {
        $perPage = request()->query('per_page', 10);
        $accessories = Accessories::inRandomOrder("id")->paginate($perPage);

        // Transform the data
        $accessories
            ->getCollection()
            ->transform(function ($accessories) {
                $images = $accessories->accessories_images;
                if (is_string($images) && !empty($images)) {
                    $images = [$images];
                } elseif (!is_array($images)) {
                    $images = [];
                }
                $images = array_map(fn($img) => asset("storage/{$img}"), $images);
                return [
                    'id' => $accessories->id,
                    'name' => $accessories->name,
                    'accessories_images' => $images,
                    'tags' => $accessories->tags,
                    'price' => $accessories->price,
                    'stock' => $accessories->stock,
                    'description' => $accessories->description,
                ];
            });

        return response()->json([
            'data' => $accessories->items(),
            'current_page' => $accessories->currentPage(),
            'last_page' => $accessories->lastPage(),
            'per_page' => $accessories->perPage(),
            'total' => $accessories->total(),
        ]);
    }
}
