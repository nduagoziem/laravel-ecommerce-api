<?php

namespace App\Http\Controllers;

use App\Models\Accessories;
use App\Http\Resources\AccessoriesCollection;
use App\Http\Resources\AccessoriesResource;

class AccessoriesController extends Controller
{
  //
  public function get(): AccessoriesResource
  {
    $query = Accessories::query();
    $fields = request()->query('fields', ['*']);
    $hashid = request()->query('hashid');
    $searchRequest = request()->query('search');
    $per_page = request()->query('per_page', 16);

    // Ensures 'id' is included so that relationships with spatie media library works.
    // Ensure 'hashid' is included.
    if ($fields !== ['*'] && !in_array('id', $fields) && !in_array('hashid', $fields)) {
      $fields[] = 'id';
      $fields[] = 'hashid';
    }

    switch (true) {

      case $searchRequest !== null:
        $query->where('name', 'ILIKE', "%{$searchRequest}%");
        break;

      case $hashid !== null:
        $query->where('hashid', $hashid);
        break;

      default:
        $query->select($fields);
        break;
    }

    $accessories = $query
      ->with('media')
      ->paginate($per_page);

    return new AccessoriesResource($accessories);
  }
}
