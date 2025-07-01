<?php

namespace App\Http\Controllers;

use App\Http\Requests\AccessoriesRequest;
use App\Models\Accessories;
use Illuminate\Http\Request;

class AccessoriesController extends Controller
{
  //
  public function get(AccessoriesRequest $accessoriesRequest)
  {
    return $accessoriesRequest->accessoriesGetRequest();
  }
}
