<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;
use App\Models\Enrollment;

class SiteAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
      $enrollment = Enrollment::where('user_id', Auth::id())
        ->where('site_id', $request->route('site'))
        ->where('role', 'admin')
        ->first();
      if (!Auth::user() || !$enrollment) {
        return redirect()->route('home');
      }
      return $next($request);
    }
}
