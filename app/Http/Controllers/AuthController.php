<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class AuthController extends Controller
{
  public function login()
  {
    return view('auth.login');
  }
  public function redirect($provider)
  {
    return Socialite::driver($provider)->redirect();
  }

  public function callback($provider)
  {
    $user = Socialite::driver($provider)->user();

    $user = User::firstOrCreate([
      'email' => $user->getEmail()
    ], [
      'name' => $user->getName(),
      'provider' => $provider,
      'avatar' => $user->getAvatar(),
      'password' => bcrypt(Str::random(24))
    ]);
    
    Auth::login($user, true);

    return redirect()->route('home');
  }

  public function logout(Request $request)
  {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('login');
  }
}
