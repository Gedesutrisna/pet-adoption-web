<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Models\Shelter;
use App\Models\Adoption;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProfileController extends Controller
{
    public function index()
    {    
        $user = Auth::user();
        $user->with(['campaignDonate', 'adoptionDonate', 'donateShelter','adoption','shelter']);
   
        return view('profile.index',compact('user'));
    }
    
    
    public function dataDonate()
    {    
        $user = Auth::user();
        $user->with(['campaignDonate', 'adoptionDonate', 'donateShelter']);
        
        return view('profile.data-Donate',compact('user'));
    }
    public function dataAdoption()
    {  
        $user = Auth::user();
        $user->with(['adoption']);
        return view('profile.data-Adoption',compact('user'));
    }
    public function dataShelter()
    {    
        $user = Auth::user();
        $user->with(['shelter']);
        return view('profile.data-Shelter',compact('user'));
    }
    public function adoptionSingle($id)
    {
        $adoption = Adoption::find($id);
        return view('profile.Adoption',compact('adoption'));
    }
    public function shelterSingle($id)
    {    
        $shelter = Shelter::find($id);
        return view('profile.Shelter',compact('shelter'));
    }
    

    public function update(Request $request, User $user)
    {
            $validatedData = $request->validate([
                'name' => 'nullable|max:255',
                'username' => 'nullable|max:255',
                'email' => 'nullable|max:100|email:dns',
                'phone' => 'nullable|digits_between:10,15',
                'address' => 'nullable|max:255',
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
