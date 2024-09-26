<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use App\Models\Site;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class SiteAttachmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($siteId, Request $request)
    {
      $site = Site::findOrFail($siteId);
      $attachments = Attachment::where('site_id', $siteId)->orderBy('created_at', 'desc')->paginate(24);
      return view('sites.attachments.index', compact('site', 'attachments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($siteId, Request $request)
    {
      $request->validate([
        'file' => 'required|file|max:1024',
      ]);
      $attachment = new Attachment();
      $attachment->user_id = Auth::user()->id;
      $attachment->site_id = $siteId;
      $attachment->name = $request->file('file')->getClientOriginalName();
      $attachment->path = $request->file('file')->store('attachments');
      $attachment->size = $request->file('file')->getSize();
      $attachment->extension = $request->file('file')->extension();
      $attachment->mime_type = $request->file('file')->getMimeType();
      $attachment->save();

      flash('Attachment uploaded successfully.')->success();
      return redirect()->route('sites.attachments.index', $siteId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
