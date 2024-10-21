<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Site;
use App\Models\Post;
use App\Models\Comment;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SiteCommentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($siteId)
    {
      $site = Site::findOrFail($siteId);
      $comments = Comment::whereHas('post', function($query) use ($siteId) {
        $query->where('site_id', $siteId);
      })->orderBy('updated_at', 'desc')->paginate(40);

      return view('sites.comments.index', compact('site', 'comments'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($siteId, Request $request, string $id)
    {
      $comment = Comment::where('id', $id)->whereHas('post', function($query) use ($siteId) {
        $query->where('site_id', $siteId);
      })->firstOrFail();
      $comment->approved_at = now();
      $comment->save();

      flash('Comment approved successfully')->success();

      return redirect()->route('sites.comments.index', $siteId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($siteId, string $id)
    {
      $comment = Comment::where('id', $id)->whereHas('post', function($query) use ($siteId) {
        $query->where('site_id', $siteId);
      })->firstOrFail();
      // delete children comments
      $comment->children()->delete();
      $comment->delete();

      flash('Comment deleted successfully')->success();
      return redirect()->route('sites.comments.index', $siteId);
    }
}
