<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComputerRequest;
use App\Http\Resources\ComputerCollection;
use App\Models\Computers;

class ComputerController extends Controller
{

  public function get(ComputerRequest $computerRequest)
  {
    return new ComputerCollection(
      Computers::inRandomOrder("id")->with('media')->paginate($computerRequest->query('per_page', 10))
    );
  }
}
