<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SiteTopicController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index($siteId, Request $request)
  {
    $options = [
      'itemsPerPage' => $request->itemsPerPage ?? 20,
      'sortBy' => $request->sortBy ?? 'created_at',
      'sortDesc' => $request->sortDesc ?? 'true',
      'q' => $request->q ?? null,
      'group' => $request->group ?? null,
    ];

    $topics = Topic::where('site_id', $siteId)->whereNotNull('approved_at');

    if ($options['group']) {
      $topics = $topics->where('group', $options['group']);
    }

    if ($options['q']) {
      $topics = $topics->where(function ($query) use ($options) {
        $query->where('name', 'like', '%' . $options['q'] . '%')
          ->orWhere('content', 'like', '%' . $options['q'] . '%');
      });
    }

    $topics = $topics->with(['user'])
      ->orderBy($options['sortBy'], $options['sortDesc'] == 'true' ? 'desc' : 'asc')
      ->paginate($options['itemsPerPage']);
    $topics->data = $topics->makeHidden(['content']);
    return response()->json($topics);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store($siteId, Request $request)
  {
    $request->validate([
      'name' => 'required',
      'content' => 'required'
    ]);

    $slug = Str::slug($request->name);
    if (Topic::where('site_id', $siteId)->where('slug', $slug)->exists()) {
      $slug = $slug . '-' . Str::random(5);
    }
    $topic = new Topic();
    $topic->site_id = $siteId;
    $topic->user_id = Auth::user()->id;
    $topic->slug = $slug;
    $topic->name = $request->name;
    $topic->content = $request->content;
    $topic->group = $request->group;
    $topic->save();

    return $topic;
  }

  /**
   * Display the specified resource.
   */
  public function show($siteId, string $slug)
  {
    return Topic::where('site_id', $siteId)
      ->where('slug', $slug)
      ->whereNotNull('approved_at')
      ->with(['user', 'comments'])
      ->firstOrFail();
  }

  /**
   * Update the specified resource in storage.
   */
  public function update($siteId, Request $request, string $slug)
  {
    $request->validate([
      'name' => 'required',
      'content' => 'required'
    ]);
    $topic = Topic::where('site_id', $siteId)
    ->where('slug', $slug)
    ->where('user_id', Auth::user()->id)
    ->where('created_at', '>', now()->subMinutes(2))
    ->firstOrFail();

    $topic->name = $request->name;
    $topic->content = $request->content;

    return $topic;
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy(string $id)
  {
      //
  }
}
