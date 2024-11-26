<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Enrollment;
use App\Models\User;

class SiteEnrollmentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index($siteId)
  {
    $site = Site::findOrFail($siteId);
    $enrollments = Enrollment::where('site_id', $siteId)->orderBy('updated_at', 'desc')->paginate(20);
    return view('sites.enrollments.index', compact('site', 'enrollments'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store($siteId, Request $request)
  {
    $validated = $request->validate([
      'email' => 'required|email',
      'role' => 'required|string',
    ]);
    $user = User::where('email', $validated['email'])->first();
    if(!$user) {
      flash('User not found.')->error();
      return redirect()->route('sites.enrollments.index', $siteId);
    }

    $enrollment = Enrollment::firstOrCreate([
      'user_id' => $user->id,
      'site_id' => $siteId
    ]);

    $enrollment->role = $validated['role'];
    $enrollment->save();

    flash('User enrolled successfully.')->success();

    return redirect()->route('sites.enrollments.index', $siteId);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(Request $request, string $id)
  {
      //
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
      //
  }
}
