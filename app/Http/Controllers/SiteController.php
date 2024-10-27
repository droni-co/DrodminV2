<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use App\Models\Site;

class SiteController extends Controller
{
  public function index()
  {
    $enrollments = Enrollment::where('user_id', Auth::user()->id)->get();
    return view('sites.index', compact('enrollments'));
  }
  public function show($siteId)
  {
    $site = Site::findOrFail($siteId);
    return view('sites.show', compact('site'));
  }
}
