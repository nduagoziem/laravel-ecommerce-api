<?php

namespace App\Http\Controllers;

use App\Models\Phone;
use Illuminate\Http\Request;
use App\Http\Requests\PhoneRequest;
use App\Http\Resources\PhoneCollection;

class PhoneController extends Controller
{
  //
  public function get(PhoneRequest $request)
  {
    return new PhoneCollection(
      Phone::inRandomOrder("id")->with('media')->paginate($request->query('per_page', 10))
    );
  }
}
