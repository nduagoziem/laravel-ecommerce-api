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

    $fields = request()->query('fields', ['*']);
    $per_page = request()->query('per_page', 16);

    // Ensures 'id' is included so that relationships with spatie media library works.
    // Ensure 'hashid' is included.
    if ($fields !== ['*'] && !in_array('id', $fields) && !in_array('hashid', $fields)) {
      $fields[] = 'id';
      $fields[] = 'hashid';
    }

    return new AccessoriesResource(
      Accessories::inRandomOrder("id")
        ->with('media')
        ->select($fields)
        ->paginate($per_page)
    );
  }
}
