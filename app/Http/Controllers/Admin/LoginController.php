<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

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

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    protected $redirectTo = RouteServiceProvider::ADMIN_HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest:admin')->except('logout');
    }

    public function showLoginForm()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
   {
       $request->validate([
           'email' => 'email|required',
           'password' => 'required',
       ]);
       if(Auth::guard('admin')->attempt(['email'=>$request->email,'password'=>$request->password])){
           return redirect('admin/home');//リダイレクト先は好きなところへ
       }else{
           return redirect()->back()->with('ログインに失敗しました');
       }
   }
 
    protected function guard()
    {
        return Auth::guard('admin');
    }
    
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->flush();
        $request->session()->regenerate();
 
        return redirect('/admin/login');
    }
}
