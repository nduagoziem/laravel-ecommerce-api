<?php

namespace App\Http\Controllers;

use App\Http\Resources\ComputerResource;
use App\Models\Computers;

class ComputerController extends Controller
{
  public function get(): ComputerResource
  {
    $fields = request()->query('fields', ['*']);
    $per_page = request()->query('per_page', 16);

    // Ensures 'id' is included so that relationships with spatie media library works.
    // Ensures 'hashid' is included if 'hashid' is not present.
    if ($fields !== ['*'] && !in_array('id', $fields) && !in_array('hashid', $fields)) {
      $fields[] = 'id';
      $fields[] = 'hashid';
    }

    $computers = Computers::with('media')
      ->select($fields)
      ->inRandomOrder('id')
      ->paginate($per_page);

    return new ComputerResource($computers);
  }
}
