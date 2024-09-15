<?php

namespace App\Http\Controllers;
use App\Models\Post;

use Illuminate\Http\Request;

class SitePostController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index($site, Request $request)
  {
    $posts = Post::where('site', $site);
    if ($request->has('q')) {
      $posts->where(function($query) use ($request) {
        $query->where('name', 'like', '%' . $request->q . '%')
          ->orWhere('content', 'like', '%' . $request->q . '%');
      });
    }
    return view('site.posts.index', compact('posts'));
  }

  /**
   * Show the form for creating a new resource.
   */
  public function create($site)
  {
    $post = new Post();
    return view('site.posts.create', compact('post'));
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
