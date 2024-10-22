<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class SitePostController extends Controller
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
      'category' => $request->category ?? null,
    ];

    $posts = Post::where('site_id', $siteId)->where('active', true);

    if ($options['category']) {
      $posts = $posts->whereHas('categories', function ($query) use ($options) {
        $query->where('slug', $options['category']);
      });
    }

    if ($options['q']) {
      $posts = $posts->where(function ($query) use ($options) {
        $query->where('name', 'like', '%' . $options['q'] . '%')
          ->orWhere('description', 'like', '%' . $options['q'] . '%');
      });
    }
    $posts = $posts->with(['categories'])
      ->orderBy($options['sortBy'], $options['sortDesc'] == 'true' ? 'desc' : 'asc')
      ->paginate($options['itemsPerPage']);
    $posts->data = $posts->makeHidden(['content']);
    return response()->json($posts);
  }

  /**
   * Display the specified resource.
   */
  public function show($siteId, string $id)
  {
    return Post::where('site_id', $siteId)
      ->where('id', $id)
      ->where('active', true)
      ->with(['categories', 'user'])
      ->firstOrFail();
  }
}
