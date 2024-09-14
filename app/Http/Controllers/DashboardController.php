<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
  public function index()
  {
    $enrollments = Enrollment::where('user_id', Auth::user()->id)->get();
    return view('dashboard.index', compact('enrollments'));
  }
}
