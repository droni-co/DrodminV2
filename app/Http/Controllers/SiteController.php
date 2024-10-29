<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Enrollment;
use Illuminate\Support\Facades\Auth;
use App\Models\Site;
use App\Models\Post;
use App\Models\Category;
use App\Models\Comment;

class SiteController extends Controller
{
  public function index()
  {
    $enrollments = Enrollment::where('user_id', Auth::user()->id)->get();
    return view('sites.index', compact('enrollments'));
  }
  public function show($siteId)
  {
    $site = Site::findOrFail($siteId);
    $lastPosts = Post::where('site_id', $siteId)->orderBy('created_at', 'desc')->limit(3)->get();
    $lastComments = Comment::where('site_id', $siteId)->orderBy('updated_at', 'desc')->limit(10)->get();
    
    return view('sites.show', compact('site', 'lastPosts', 'lastComments'));
  }
  public function search(Request $request, $siteId)
  {
    $site = Site::findOrFail($siteId);
    $results = [];
    $posts = Post::where('site_id', $siteId)
      ->where('name', 'like', "%{$request->q}%")
      ->orWhere('description', 'like', "%{$request->q}%")
      ->limit(10)
      ->get();
    foreach ($posts as $post) {
      $post->model = 'post';
      $results[] = $post;
    }

    $categories = Category::where('site_id', $siteId)
      ->where('name', 'like', "%{$request->q}%")
      ->orWhere('description', 'like', "%{$request->q}%")
      ->limit(5)
      ->get();
    foreach ($categories as $category) {
      $category->model = 'category';
      $results[] = $category;
    }

    // sort results by created_at desc
    usort($results, function ($a, $b) {
      return $a['updated_at'] < $b['updated_at'];
    });
    return view('sites.search', compact('site', 'results'));
  }
}
