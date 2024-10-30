<?php

namespace App\Http\Controllers;

use App\Models\Attr;
use App\Models\Site;
use Illuminate\Http\Request;

class SiteAttrController extends Controller
{
  /**
   * Display a listing of the resource.
   */
  public function index($siteId, Request $request)
  {
    $attrs = Attr::where('site_id', $siteId);
    if($request->has('attributableType')) {
      $attrs = $attrs->where('attributable_type', $request->attributableType);
    }
    return response()->json($attrs->distinct()->pluck('name'));
  }


  /**
   * Store a newly created resource in storage.
   */
  public function store($siteId, Request $request)
  {
    $site = Site::findOrFail($siteId);

    $request->validate([
      'name' => 'required|string|max:50',
      'attributable_type' => 'required',
      'attributable_id' => 'required',
      'value' => 'required|string',
    ]);

    $attr = new Attr();
    $attr->site_id = $site->id;
    $attr->name = $request->name;
    $attr->attributable_type = $request->attributable_type;
    $attr->attributable_id = $request->attributable_id;
    $attr->value = $request->value;
    $attr->save();

    return response()->json($attr);
  }

  /**
   * Update the specified resource in storage.
   */
  public function update($siteId, Request $request, $id)
  {
    $request->validate([
      'value' => 'required|string',
    ]);
    $attr = Attr::where('site_id', $siteId)->firstOrFail($id);
    $attr->value = $request->value;
    $attr->save();

    return response()->json($attr);
  }

  /**
   * Remove the specified resource from storage.
   */
  public function destroy($siteId, $id)
  {
    $attr = Attr::where('site_id', $siteId)->findOrFail($id);
    $attr->delete();
    return response()->json($attr);
  }
}
