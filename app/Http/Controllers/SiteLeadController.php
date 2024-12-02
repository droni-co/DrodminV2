<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Lead;

class SiteLeadController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index($siteId)
  {
    $site = Site::findOrFail($siteId);
    $leads = Lead::where('site_id', $siteId)->orderBy('updated_at', 'desc')->paginate(20);
    return view('sites.leads.index', compact('site', 'leads'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $id)
  {
      //
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
