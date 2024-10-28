<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class SitePostCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $siteId, $postId)
    {
      $post = Post::where('site_id', $siteId)
        ->where('id', $postId)
        ->where('active', true)
        ->firstOrFail();
      
      return $post->comments()->with(['user', 'children'])->paginate(30);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(string $siteId, $postId, Request $request)
    {
      $request->validate([
        'content' => 'required',
        'parent_id' => 'nullable|exists:comments,id'
      ]);
      $post = Post::where('site_id', $siteId)
        ->where('id', $postId)
        ->where('active', true)
        ->firstOrFail();

      $parent = $post->comments()
        ->where('id', $request->parent_id ?? 0)
        ->first();

      $comment = new Comment();
      $comment->user_id = Auth::user()->id;
      $comment->site_id = $siteId;
      $comment->content = $request->content;
      $comment->parent_id = $parent ? $parent->id : null;
      $post->comments()->save($comment);
      
      return $comment;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
