<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;
use Illuminate\Http\File;
use Illuminate\Support\Str;

class SiteAttachmentController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index($siteId, Request $request)
  {
    $site = Site::findOrFail($siteId);
    $attachments = Attachment::where('site_id', $siteId);
    if($request->has('search')) {
      $attachments = $attachments->where('name', 'like', '%'.$request->search.'%');
    }
    if($request->has('accept')) {
      $attachments = $attachments->where('mime_type', 'like', '%'.explode('/', $request->accept)[0].'%');
    }
    $attachments = $attachments->orderBy('created_at', 'desc')->paginate(24);

    if($request->ajax()) {
      return response()->json($attachments);
    }
    return view('sites.attachments.index', compact('site', 'attachments'));
  }

  /**
   * Store a newly created resource in storage.
   */
  public function store($siteId, Request $request)
  {
    $request->validate([
      'file' => 'required|file|max:1024|mimes:gif,png,jpg,jpeg,pdf,doc,docx,xls,xlsx,ppt,pptx',
      'width' => 'integer',
      'height' => 'integer',
    ]);

    
    $attachment = new Attachment();
    $attachment->user_id = Auth::user()->id;
    $attachment->site_id = $siteId;
    $attachment->name = $request->file('file')->getClientOriginalName();
    // transform image
    if($request->width > 0 && $request->height > 0) {
      $img = Image::read($request->file('file'));
      $imgfinal = (string) $img->cover($request->width, $request->height)->toWebp(60);
      // Store File Temporary
      $randomStr = Str::random(40).".webp";
      Storage::disk('local')->put('tmp/'.$randomStr, $imgfinal);
      $imgfinal = new File(Storage::path('tmp/'.$randomStr));
      $attachment->path = Storage::disk('digitalocean')->putFile($siteId.'/'.Auth::user()->id, $imgfinal, 'public');
      // Delete temporary file
      Storage::disk('local')->delete('tmp/'.$randomStr);
    } else {
      $attachment->path = Storage::disk('digitalocean')->putFile($siteId.'/'.Auth::user()->id, $request->file('file'), 'public');
    }
    $attachment->size = $request->file('file')->getSize();
    $attachment->extension = $request->file('file')->extension();
    $attachment->mime_type = $request->file('file')->getMimeType();
    $attachment->save();

    if($request->ajax()) {
      return response()->json($attachment);
    }

    flash('Attachment uploaded successfully.')->success();
    return redirect()->route('sites.attachments.index', $siteId);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($siteId, string $id)
  {
    $attachment = Attachment::where('site_id', $siteId)->findOrFail($id);
    Storage::disk('digitalocean')->delete($attachment->path);
    $attachment->delete();

    flash('Attachment deleted successfully.')->success();
    return redirect()->route('sites.attachments.index', $siteId);
  }
}
