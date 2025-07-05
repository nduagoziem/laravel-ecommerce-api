<?php

namespace App\Http\Controllers;

use App\Models\Accessories;
use Illuminate\Http\Request;
use App\Http\Requests\AccessoriesRequest;
use App\Http\Resources\AccessoriesCollection;

class AccessoriesController extends Controller
{
  //
  public function get(AccessoriesRequest $accessoriesRequest)
  {
    return new AccessoriesCollection(
      Accessories::inRandomOrder("id")->with('media')->paginate($accessoriesRequest->query('per_page', 10))
    );
  }
}
