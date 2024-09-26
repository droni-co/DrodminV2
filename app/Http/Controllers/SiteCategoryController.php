<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Site;
use App\Models\Category;
use Illuminate\Support\Str;

class SiteCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($siteId)
    {
      $site = Site::findOrFail($siteId);
      $categories = Category::where('site_id', $siteId)->orderBy('updated_at', 'desc')->paginate(10);
      return view('sites.categories.index', compact('site', 'categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create($siteId)
    {
      $site = Site::findOrFail($siteId);
      $category = new Category();
      return view('sites.categories.create', compact('site', 'category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store($siteId, Request $request)
    {
      $request->validate([
        'name' => 'required|string|max:255',
      ]);

      $slug = Str::slug($request->name, '-');
      if (Category::where('slug', $slug)->where('site_id', $siteId)->exists()) {
        $slug = $slug . '-' . time();
      }

      $category = new Category();
      $category->site_id = $siteId;
      $category->slug = $slug;
      $category->name = $request->name;
      $category->description = $request->description;
      $category->picture = $request->picture;
      $category->save();

      flash('Category created successfully.')->success();
      return redirect()->route('sites.categories.index', $siteId);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($siteId, string $id)
    {
      $site = Site::findOrFail($siteId);
      $category = Category::where('site_id', $siteId)->findOrFail($id);

      return view('sites.categories.edit', compact('site', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($siteId, Request $request, string $id)
    {
      $request->validate([
        'name' => 'required|string|max:255',
      ]);

      $category = Category::where('site_id', $siteId)->findOrFail($id);
      $category->name = $request->name;
      $category->description = $request->description;
      $category->picture = $request->picture;
      $category->save();

      flash('Category updated successfully.')->success();
      return redirect()->route('sites.categories.index', $siteId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($siteId, string $id, Request $request)
    {
      $category = Category::where('site_id', $siteId)->findOrFail($id);
      $request->validate([
        'validator' => 'required|in:' . $category->slug,
      ]);
      $category->delete();

      flash('Category deleted successfully.')->success();
      return redirect()->route('sites.categories.index', $siteId);
    }
}
