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
        ->with(['categories', 'user'])
        ->firstOrFail();
      
      return Comment::where('post_id', $post->id)
        ->whereNotNull('approved_at')
        ->whereNull('parent_id')
        ->with(['user', 'children'])
        ->paginate(30);
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
        ->with(['categories', 'user'])
        ->firstOrFail();

      $parent = Comment::where('post_id', $post->id)
        ->where('id', $request->parent_id ?? 0)
        ->first();

      $comment = new Comment();
      $comment->content = $request->content;
      $comment->parent_id = $parent ? $parent->id : null;
      $comment->post_id = $post->id;
      $comment->user_id = Auth::user()->id;
      $comment->save();
      
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
