<?php

namespace App\Http\Controllers;

use App\Http\Requests\ComputerRequest;

class ComputerController extends Controller
{
  
  public function get(ComputerRequest $computerRequest)
  {
    return $computerRequest->computerGetRequest();
  }
}
