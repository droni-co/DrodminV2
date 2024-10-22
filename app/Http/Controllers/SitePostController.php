<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SitePostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($siteId, Request $request)
    {
      $site = Site::findOrFail($siteId);
      $posts = Post::where('site_id', $siteId)->orderBy('updated_at', 'desc');
      if ($request->has('search')) {
        $posts->where('name', 'like', '%' . $request->search . '%');
      }
      $posts = $posts->paginate(10);
      return view('sites.posts.index', compact('site', 'posts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($siteId)
    {
      $site = Site::findOrFail($siteId);
      $post = new Post();
      $categories = Category::where('site_id', $siteId)->orderBy('name')->get();
      return view('sites.posts.create', compact('site', 'post', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($siteId, Request $request)
    {
      $request->validate([
        'name' => 'required|min:5|max:255',
        'content' => 'required',
        'categories' => 'array',
      ]);
      $slug = Str::slug($request->name, '-');
      if (Post::where('slug', $slug)->where('site_id', $siteId)->exists()) {
        $slug = $slug . '-' . time();
      }

      $post = new Post();
      $post->site_id = $siteId;
      $post->user_id = Auth::user()->id;
      $post->name = $request->name;
      $post->slug = $slug;
      $post->description = $request->description;
      $post->picture = $request->picture;
      $post->format = $request->format;
      $post->content = $request->content;
      $post->props = $request->props ?? '[]';
      $post->active = $request->active ?? false;
      $post->save();

      $post->categories()->attach($request->categories);

      flash('Post created successfully!')->success();
      return redirect()->route('sites.posts.index', $siteId);
    }

    /**
     * Display the specified resource.
     */
    public function show($siteId, string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($siteId, string $id)
    {
      $site = Site::findOrFail($siteId);
      $post = Post::where('site_id', $siteId)->where('id', $id)->firstOrFail();
      $categories = Category::where('site_id', $siteId)->orderBy('name')->get();
      return view('sites.posts.edit', compact('site', 'post', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($siteId, Request $request, string $id)
    {
      $request->validate([
        'name' => 'required|min:5|max:255',
        'content' => 'required',
        'categories' => 'array',
      ]);
      $post = Post::where('site_id', $siteId)->where('id', $id)->firstOrFail();
      $post->name = $request->name;
      $post->description = $request->description;
      $post->picture = $request->picture;
      $post->format = $request->format;
      $post->content = $request->content;
      $post->props = $request->props ?? '[]';
      $post->active = $request->active ?? false;
      $post->save();

      $post->categories()->sync($request->categories);

      flash('Post updated successfully!')->success();
      return redirect()->route('sites.posts.index', $siteId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $siteId, string $id, Request $request)
    {
      $post = Post::where('site_id', $siteId)->where('id', $id)->firstOrFail();
      $request->validate([
        'validator' => 'required|in:' . $post->slug,
      ]);

      $post->delete();

      flash('Post deleted successfully!')->success();
      return redirect()->route('sites.posts.index', $siteId);
      

    }
}
