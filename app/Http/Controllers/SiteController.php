<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Site;

class SiteController extends Controller
{
  public function show($site)
  {
    $site = Site::findOrFail($site);
    return view('sites.show', compact('site'));
  }
}
