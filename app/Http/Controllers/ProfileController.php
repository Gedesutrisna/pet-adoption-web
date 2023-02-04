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
        $notifications = Notification::all();
        return view('profile.index',compact('notifications'));
    }
    public function read(Notification $notification)
{
    $notification->update(['read_at' => now()]);
    return back();
}

    public function dataDonate()
    {    
        return view('profile.data-Donate');
    }
    public function dataAdoption()
    {  
        return view('profile.data-Adoption');
    }
    public function dataShelter()
    {    
        return view('profile.data-Shelter');
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
