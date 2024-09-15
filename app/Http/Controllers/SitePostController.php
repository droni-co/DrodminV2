<?php

namespace App\Http\Controllers;
use App\Models\Post;
use App\Models\Site;

use Illuminate\Http\Request;

class SitePostController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index($site, Request $request)
  {
    $site = Site::findOrFail($site);
    $posts = Post::where('site_id', $site->id);
    if ($request->has('q')) {
      $posts->where(function($query) use ($request) {
        $query->where('name', 'like', '%' . $request->q . '%')
          ->orWhere('content', 'like', '%' . $request->q . '%');
      });
    }
    $posts = $posts->paginate(20);

    return view('sites.posts.index', compact('site', 'posts'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create($site)
  {
    $site = Site::findOrFail($site);
    $post = new Post();
    return view('sites.posts.create', compact('site', 'post'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(Request $request)
  {
      //
  }

  /**
   * Display the specified resource.
   */
  public function show(string $id)
  {
      //
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
