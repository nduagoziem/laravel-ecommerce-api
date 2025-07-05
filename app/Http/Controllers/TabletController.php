<?php

namespace App\Http\Controllers;

use App\Models\Tablets;
use Illuminate\Http\Request;
use App\Http\Requests\TabletRequest;
use App\Http\Resources\TabletCollection;

class TabletController extends Controller
{
  //
  public function get(TabletRequest $tabletRequest)
  {
    return new TabletCollection(
      Tablets::inRandomOrder("id")->with('media')->paginate($tabletRequest->query('per_page', 10))
    );
  }
}
