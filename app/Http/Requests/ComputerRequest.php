<?php

namespace App\Http\Requests;

use App\Models\Computers;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Client\Request;

class ComputerRequest extends FormRequest
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

    public function computerGetRequest()
    {
        $perPage = request()->query('per_page', 10);
        $computers = Computers::inRandomOrder("id")->paginate($perPage);

        // Transform the data
        $computers
            ->getCollection()
            ->transform(function ($computer) {
                $images = $computer->computer_images;
                if (is_string($images) && !empty($images)) {
                    $images = [$images];
                } elseif (!is_array($images)) {
                    $images = [];
                }
                $images = array_map(fn($img) => asset("storage/{$img}"), $images);
                return [
                    'id' => $computer->id,
                    'name' => $computer->name,
                    'pc_images' => $images,
                    'tags' => $computer->tags,
                    'price' => $computer->price,
                    'stock' => $computer->stock,
                    'description' => $computer->description,
                ];
            });

        return response()->json([
            'data' => $computers->items(),
            'current_page' => $computers->currentPage(),
            'last_page' => $computers->lastPage(),
            'per_page' => $computers->perPage(),
            'total' => $computers->total(),
        ]);
    }
}
