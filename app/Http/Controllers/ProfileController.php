<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Models\Adoption;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {    

        return view('profile.index');
    }
    public function dataDonate()
    {    
        return view('profile.dataDonate');
    }
    public function dataAdoption()
    {  
        return view('profile.dataAdoption');
    }
    public function dataShelter()
    {    
        return view('profile.dataShelter');
    }
    

    public function update(Request $request, User $user)
    {
            $validatedData = $request->validate([
                'name' => 'nullable|max:255',
                'username' => 'nullable|max:255',
                'email' => 'nullable|max:100|email:dns',
                'phone' => 'nullable|digits_between:10,15',
                'image' => 'nullable|image|file',
                'ktp' => 'nullable|file',
            ]);
            if($request->file('image')){
                $validatedData['image'] = $request->file('image')->store('avatars');
            }
            if($request->file('ktp')){
                $validatedData['ktp'] = $request->file('ktp')->store('ktps');
            }
    
            if($user->image){
                Storage::delete($user->image);
    }
    
            if($user->ktp){
                Storage::delete($user->ktp);
    }
    
            Auth()->user()->update($validatedData);
            
            return back()->with('toast_success', 'Profile Update Successfully!');
   
    }

}
