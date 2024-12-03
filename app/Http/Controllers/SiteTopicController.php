<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Topic;

class SiteTopicController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(string $siteId)
  {
    $site = Site::findOrFail($siteId);
    $topics = Topic::where('site_id', $siteId)->orderBy('updated_at', 'desc')->paginate(20);
    return view('sites.topics.index', compact('site', 'topics'));
  }

  /**
   * Show the form for editing the specified resource.
   */
  public function edit(string $siteId, string $id)
  {
    $site = Site::findOrFail($siteId);
    $topic = Topic::where('site_id', $siteId)->findOrFail($id);
    return view('sites.topics.edit', compact('site', 'topic'));
  }

  /**
   * Update the specified resource in storage.
   */
  public function update(string $siteId, Request $request, string $id)
  {
    $site = Site::findOrFail($siteId);
    $topic = Topic::where('site_id', $siteId)->findOrFail($id);

    $topic->approved_at = $request->approved_at ? now() : null;
    $topic->save();

    flash('Topic updated successfully')->success();

    return redirect()->route('sites.topics.index', $siteId)->with('success', 'Topic updated successfully');
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
      //
  }
}
