<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Site;

class SiteController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index()
  {
    return Site::all();
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
    return Site::findOrFail($id);
  }
}
