<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Http\Resources\PhoneResource;

class PhoneController extends Controller
{
  public function get(): PhoneResource
  {
    $fields = request()->query('fields', ['*']);
    $per_page = request()->query('per_page', 16);

    // Ensures 'id' is included so that relationships with spatie media library works.
    // Ensures 'hashid' is included if 'hashid' is not present.
    if ($fields !== ['*'] && !in_array('id', $fields) && !in_array('hashid', $fields)) {
      $fields[] = 'id';
      $fields[] = 'hashid';
    }

    $phones = Phone::with('media')
      ->select($fields)
      ->inRandomOrder('id')
      ->paginate($per_page);

    return new PhoneResource($phones);
  }
}
