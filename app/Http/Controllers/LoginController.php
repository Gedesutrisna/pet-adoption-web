<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function index(){
        return view('auth.login');
    }
    public function login(Request $request)
    {
            $credentials = $request->validate([
                 'email' => 'required|email',
                 'password' => 'required',
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





    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
  
  
    public function handleProviderCallback(\Request $request)
    {
        try {
            $user_google    = Socialite::driver('google')->user();
            $user           = Auth::where('email', $user_google->getEmail())->first();

            
            if($user != null){
                \login($user, true);
                return redirect()->route('home');
            }else{
                $create = Auth::Create([
                    'email'             => $user_google->getEmail(),
                    'name'              => $user_google->getName(),
                    'password'          => 0,
                    'email_verified_at' => now()
                ]);
        
                
                \login($create, true);
                return redirect()->route('home');
            }
        } catch (\Exception $e) {
            return redirect()->route('login');
        }


    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }
    public function handleFacebookCallback()
   {
       try {
       
           $user = Socialite::driver('facebook')->user();
        
           $finduser = Auth::where('facebook_id', $user->id)->first();
        
           if($finduser){
        
               \login($finduser);
      
               return redirect()->route('home');
        
           }else{
               $newUser = Auth::updateOrCreate(['email' => $user->email],[
                       'name' => $user->name,
                       'facebook_id'=> $user->id,
                       'password' => encrypt('123456dummy')
                   ]);
       
               \login($newUser);
       
               return redirect()->route('home');
           }
      
       } catch (Exception $e) {
           dd($e->getMessage());
       }
   }

}