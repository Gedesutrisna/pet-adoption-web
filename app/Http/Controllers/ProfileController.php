<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Models\Shelter;
use App\Models\Adoption;
use App\Models\Category;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\AdoptionDonate;
use App\Models\CampaignDonate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\DonateShelter;

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
        $adoptionDonates = AdoptionDonate::latest('adoption_donates.created_at')->filter(request(['search']))->paginate(7)->withQueryString();
        $campaignDonates = CampaignDonate::latest('campaign_donates.created_at')->filter(request(['search']))->paginate(7)->withQueryString();
        $donateShelters = DonateShelter::latest('donate_shelters.created_at')->filter(request(['search']))->paginate(7)->withQueryString();
        return view('profile.data-Donate', compact('campaignDonates', 'adoptionDonates', 'donateShelters'), [

        ]);
    }
    public function dataAdoption()
    {  
        return view('profile.data-Adoption',[
            'adoptions' =>  Adoption::with(['category'])->latest('adoptions.created_at')->filter(request(['search']))->paginate(7)->withQueryString(),
            'categories' => Category::all()
        ]);       
    }
    public function dataShelter()
    {    
        return view('profile.data-Shelter',[
            'shelters' =>  Shelter::with(['category'])->latest('shelters.created_at')->filter(request(['search']))->paginate(7)->withQueryString(),
            'categories' => Category::all()
        ]);       
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
                'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg', 
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
