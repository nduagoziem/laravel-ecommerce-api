<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use App\Http\Resources\PhoneCollection;

class PhoneController extends Controller
{
  //
  public function get()
  {
    $query = Phone::query();
    $fields = request()->query('fields', ['*']);
    $hashid = request()->query('hashid');
    $brand = request()->query('brand');
    $per_page = request()->query('per_page', 16);

    // Ensures 'id' is included so that relationships with spatie media library works.
    // Ensures 'hashid' is included if 'id' is not present.
    if ($fields !== ['*'] && !in_array('id', $fields) && !in_array('hashid', $fields)) {
      $fields[] = 'id';
      $fields[] = 'hashid';
    }

    if ($hashid) {
      $query->where('hashid', $hashid);
    } else if ($brand) {
      $query->where("brand", $brand);
    } else {
      $query->inRandomOrder("id");
    }

    $phones = $query->with('media')->select($fields)->paginate($per_page);

    return new PhoneCollection($phones);
  }
}
