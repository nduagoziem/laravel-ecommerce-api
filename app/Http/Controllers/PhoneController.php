<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;
use App\Http\Requests\PhoneRequest;

class PhoneController extends Controller
{
  //
  public function get(PhoneRequest $request)
  {
    return $request->phoneGetRequest();
  }
}
