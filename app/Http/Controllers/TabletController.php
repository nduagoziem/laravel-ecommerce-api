<?php

namespace App\Http\Controllers;

use App\Models\Tablets;
use App\Http\Resources\TabletResource;
use Filament\Tables\Table;

class TabletController extends Controller
{
  public function get(): TabletResource
  {
    $query = Tablets::query();
    $fields = request()->query('fields', ['*']);
    $hashid = request()->query('hashid');
    $brand = request()->query('brand');
    $per_page = request()->query('per_page', 16);

    // Ensures 'id' is included so that relationships with spatie media library works.
    // Ensures 'hashid' is included.
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

    $tablets = $query
    ->with('media')
    ->select($fields)
    ->paginate($per_page);

    return new TabletResource($tablets);
  }
}
