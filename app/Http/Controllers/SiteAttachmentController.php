<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use App\Models\Site;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

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
    ]);
    $attachment = new Attachment();
    $attachment->user_id = Auth::user()->id;
    $attachment->site_id = $siteId;
    $attachment->name = $request->file('file')->getClientOriginalName();
    $attachment->path = Storage::disk('digitalocean')->putFile($siteId.'/'.Auth::user()->id, request()->file, 'public');
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

  public function import($siteId, Request $request)
  {
    $request->validate([
      'file' => 'required|file|max:1024|mimes:csv,txt',
    ]);
    $file = $request->file('file');
    $fileContent = fopen($file->getRealPath(), 'r');

    $header = fgetcsv($fileContent, null, ';');
    $rows = [];
    while($row = fgetcsv($fileContent, null, ';')) {
      $rows[] = array_combine($header, $row);
    }

    foreach($rows as $row) {
      $tmp = explode('.', $row['name']);
      $attachment = new Attachment();
      $attachment->user_id = Auth::user()->id;
      $attachment->site_id = $siteId;
      $attachment->name = $row['name'];
      $attachment->path = $row['path'];
      $attachment->size = $row['size'];
      $attachment->extension = end($tmp);
      $attachment->mime_type = $row['mime'];
      $attachment->save();
    }

    flash('Attachments imported successfully.')->success();
    return redirect()->route('sites.attachments.index', $siteId);
  }
}
