<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

use Socialite;
use App\User;
use Auth;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers {
        logout as performLogout;
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // ソーシャルサービスのログインボタンからリンク
    public function socialLogin($social)
    {
        return Socialite::driver($social)->redirect();
    }

    // Callback
    public function handleProviderCallback($social)
    {
        $social_user = Socialite::driver($social)->stateless()->user();

        $user = User::where('social_type', $social)
            ->where('social_id', $social_user->getID())
            ->first();

        if ($user) {
            Auth::login($user);

            return redirect()->route('home');
        } else {
            $new_user = new User;

            $new_user->social_type    = $social;
            $new_user->social_id      = $social_user->getID();
            $new_user->social_account = $social_user->getNickname();
            $new_user->social_icon    = $this->getIconBinary($social_user);
            $new_user->save();

            Auth::login($new_user);

            return redirect()->route('home');
        }
    }

    public function getIconBinary($social_user)
    {
        $icon_url  = $social_user->getAvatar();
        $icon_data = file_get_contents($icon_url);
        return base64_encode($icon_data);
    }

    public function logout(Request $request)
    {
        $this->performLogout($request);

        return redirect()->route('home');
    }
}
