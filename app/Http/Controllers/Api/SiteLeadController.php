<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Lead;
use App\Models\User;

class SiteLeadController extends Controller
{
  /**
   * Store a newly created resource in storage.
   */
  public function store(string $siteId, Request $request)
  {
    $validated = $request->validate([
      'name' => 'required|string',
      'email' => 'required|email',
      'phone' => 'required|string'
    ]);

    $user = User::where('email', $validated['email'])->first();

    $lead = new Lead();
    $lead->user_id = $user ? $user->id : null;
    $lead->site_id = $siteId;
    $lead->name = $validated['name'];
    $lead->email = $validated['email'];
    $lead->phone = $validated['phone'];
    $lead->location = $request->location;
    $lead->subject = $request->subject;
    $lead->message = $request->message;
    $lead->referrer = $request->referrer;
    $lead->info = $request->info;
    $lead->status = 'new';
    $lead->save();
    
    return response()->json($lead, 201);
  }

}
