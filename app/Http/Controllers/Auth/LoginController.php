<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use App\User;
use Socialite;

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

    use AuthenticatesUsers;

    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:user')->except('logout');
    }

    protected function guard()
    {
        return Auth::guard('user');
    }

    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        try {
            $providerUser = \Socialite::with($provider)->user();
        } catch(\Exception $e) {
            return redirect('/login')->with('oauth_error', '予期せぬエラーが発生しました');
        }
        
        $name = $providerUser->getName();
        $twitter_nickname = $providerUser->getNickname();
        $twitter_id = $providerUser->getId();
        $query = User::query();
        $query->where('twitter_id', '=', $twitter_id);
        $user = $query->first();

        if(!empty($user)){
            Auth::login(User::firstOrCreate([
                'twitter_id'=>$twitter_id
            ]));

            $user->name = $name;
            $user->twitter_url = 'https://twitter.com/'.$twitter_nickname;
            $user->save();
            
            return redirect($this->redirectTo);

        } else{
            Auth::login(User::firstOrCreate([
                'twitter_id'=>$twitter_id
                
            ],[
                'name'=>$name,
                'twitter_url'=>'https://twitter.com/'.$twitter_nickname
            ]));
            
            return redirect($this->redirectTo);
        }
        /*return redirect('/login')->with('oauth_error', 'メールアドレスが取得できませんでした');*/
    }
}

