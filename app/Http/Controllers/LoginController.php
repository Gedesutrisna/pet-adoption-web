<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function login(Request $request)
    {
            $credentials = $request->validate([
                 'email' => 'required|email',
                 'password' => 'required'
             ]);
     
             if(Auth::attempt($credentials)){
                 $request->session()->regenerate();
                 return redirect()->intended('/')->with('success', 'Login Successfully!');  
             }elseif(Auth::guard('admin')->attempt($credentials)){
                $request->session()->regenerate();
                return redirect()->intended('/dashboard')->with('success', 'Login Successfully!');
             }
             return back()->with('loginError', 'login failed!');

    }
    public function logout(Request $request){
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
return redirect('/');
    }

}