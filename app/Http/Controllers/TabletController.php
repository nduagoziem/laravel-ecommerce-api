<?php

namespace App\Http\Controllers;

use App\Http\Requests\TabletRequest;
use App\Models\Tablets;
use Illuminate\Http\Request;

class TabletController extends Controller
{
  //
  public function get(TabletRequest $tabletRequest)
  {
    return $tabletRequest->tabletGetRequest();
  }
}
