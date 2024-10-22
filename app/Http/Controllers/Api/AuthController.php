<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
  public function login(Request $request)
  {
    $request->validate([
      'provider' => 'required',
      'token' => 'required'
    ]);
    /** @disregard */
    $socialiteUser = Socialite::driver($request->provider)->userFromToken($request->token);
    if(!$socialiteUser->getEmail()) {
      return response()->json([
        'message' => 'Email not provided by the socialite provider'
      ], 400);
    }
    
    $user = User::firstOrCreate([
      'email' => $socialiteUser->getEmail(),
      'provider' => $request->provider
    ], [
      'name' => $socialiteUser->getName(),
      'avatar' => $socialiteUser->getAvatar(),
      'password' => bcrypt(Str::random(24))
    ]);
    
    $token = $user->createToken('auth_token')->plainTextToken;

    return response()->json([
      'token' => $token
    ]);
  }
  public function me() {
    return Auth::user();
  }
  public function logout(Request $request) {
    /** @disregard */
    Auth::user()->currentAccessToken()->delete();
    return response()->json([
      'message' => 'Logged out'
    ]);
  }
}
