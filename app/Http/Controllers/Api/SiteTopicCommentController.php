<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class SiteTopicCommentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index(string $siteId, string $slug)
  {
    $topic = Topic::where('site_id', $siteId)
      ->where('slug', $slug)
      ->whereNotNull('approved_at')
      ->firstOrFail();
      
    return $topic->comments()->with(['user', 'children'])->paginate(30);
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store(string $siteId, string $slug, Request $request)
  {
    $request->validate([
      'content' => 'required',
      'parent_id' => 'nullable|exists:comments,id'
    ]);

    $topic = Topic::where('site_id', $siteId)
      ->where('slug', $slug)
      ->whereNotNull('approved_at')
      ->firstOrFail();

    $parent = $topic->comments()
      ->where('id', $request->parent_id ?? 0)
      ->first();

    $comment = new Comment();
    $comment->user_id = Auth::user()->id;
    $comment->site_id = $siteId;
    $comment->content = $request->content;
    $comment->parent_id = $parent ? $parent->id : null;
    $topic->comments()->save($comment);
    
    return $comment;
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
