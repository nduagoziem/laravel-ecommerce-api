<?php

namespace App\Http\Controllers;

use App\Models\Accessories;
use App\Http\Resources\AccessoriesCollection;

class AccessoriesController extends Controller
{
  //
  public function get()
  {

    $fields = request()->query('fields', ['*']);
    $per_page = request()->query('per_page', 10);

    // Ensures 'id' is included so that relationships with spatie media library works.
    // Ensure 'hashid' is included if 'id' is not present.
    if ($fields !== ['*'] && !in_array('id', $fields) && !in_array('hashid', $fields)) {
      $fields[] = 'id';
      $fields[] = 'hashid';
    }

    return new AccessoriesCollection(
      Accessories::inRandomOrder("id")
        ->with('media')
        ->select($fields)
        ->paginate($per_page)
    );
  }
}
