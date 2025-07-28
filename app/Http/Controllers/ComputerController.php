<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComputerResource;
use App\Models\Computers;

class ComputerController extends Controller
{
  public function get(): ComputerResource
  {
    $query = Computers::query();
    $fields = request()->query('fields', ['*']);
    $hashid = request()->query('hashid');
    $brand = request()->query('brand');
    $searchRequest = request()->query('search');
    $per_page = request()->query('per_page', 16);

    // Ensures 'id' is included so that relationships with spatie media library works.
    // Ensures 'hashid' is included.
    if ($fields !== ['*'] && !in_array('id', $fields) && !in_array('hashid', $fields)) {
      $fields[] = 'id';
      $fields[] = 'hashid';
    }

    switch (true) {
      case $hashid !== null:
        $query->where('hashid', $hashid);
        break;

      case $brand !== null && $searchRequest !== null:
        $query
          ->where('brand', $brand)
          ->where('name', 'ILIKE', "%{$searchRequest}%")
          ->select($fields);
        break;

      case $brand !== null:
        $query->where('brand', $brand);
        break;

      case $searchRequest !== null:
        $query->where('name', 'ILIKE', "%{$searchRequest}%");
        break;

      default:
        $query->select($fields);
        break;
    }

    $computers = $query
      ->with('media')
      ->paginate($per_page);

    return new ComputerResource($computers);
  }
}
