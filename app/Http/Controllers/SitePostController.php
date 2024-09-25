<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Post;

class SitePostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($siteId)
    {
      $site = Site::findOrFail($siteId);
      $posts = Post::where('site_id', $siteId)->orderBy('updated_at', 'desc')->get();
      return view('sites.posts.index', compact('site', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($siteId)
    {
      $site = Site::findOrFail($siteId);
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
