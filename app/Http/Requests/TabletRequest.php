<?php

namespace App\Http\Requests;

use App\Models\Tablets;
use Illuminate\Foundation\Http\FormRequest;

class TabletRequest extends FormRequest
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

    public function tabletGetRequest()
    {
        $perPage = request()->query('per_page', 10);
        $tablets = Tablets::inRandomOrder("id")->paginate($perPage);

        // Transform the data
        $tablets
            ->getCollection()
            ->transform(function ($tablet) {
                $images = $tablet->tablet_images;
                if (is_string($images) && !empty($images)) {
                    $images = [$images];
                } elseif (!is_array($images)) {
                    $images = [];
                }
                $images = array_map(fn($img) => asset("storage/{$img}"), $images);
                return [
                    'id' => $tablet->id,
                    'name' => $tablet->name,
                    'tablet_images' => $images,
                    'tags' => $tablet->tags,
                    'price' => $tablet->price,
                    'stock' => $tablet->stock,
                    'description' => $tablet->description,
                ];
            });

        return response()->json([
            'data' => $tablets->items(),
            'current_page' => $tablets->currentPage(),
            'last_page' => $tablets->lastPage(),
            'per_page' => $tablets->perPage(),
            'total' => $tablets->total(),
        ]);
    }
}
