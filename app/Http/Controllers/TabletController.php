<?php

namespace App\Http\Controllers;

use App\Models\Tablets;
use App\Http\Resources\TabletResource;

class TabletController extends Controller
{
  public function get(): TabletResource
  {
    $fields = request()->query('fields', ['*']);
    $per_page = request()->query('per_page', 16);

    // Ensures 'id' is included so that relationships with spatie media library works.
    // Ensures 'hashid' is included if 'hashid' is not present.
    if ($fields !== ['*'] && !in_array('id', $fields) && !in_array('hashid', $fields)) {
      $fields[] = 'id';
      $fields[] = 'hashid';
    }

    $tablets = Tablets::with('media')
      ->select($fields)
      ->inRandomOrder('id')
      ->paginate($per_page);

    return new TabletResource($tablets);
  }
}
