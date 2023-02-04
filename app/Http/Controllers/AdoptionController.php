<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Adoption;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdoptionController extends Controller
{
    public function dataAdoption()
    {
        
        return view('admin.adoptions.index',[
            
            'adoptions' =>  Adoption::latest('adoptions.created_at')->filter(request(['search', 'category']))->paginate(7)->withQueryString(),
            'categories' => Category::all()
        ]);       
    
    }
    
    public function show(Adoption $adoption, $id)
    {
        $adoption = Adoption::find($id);
        $pet = Pet::find($id);
        return view('admin.adoptions.show',[
            'adoption' => $adoption,
        ]);
    }

    public function store(Request $request, $id)
    {       
        $validatedData = $request->validate([
            'reason' => 'required',
            'approval_file' => 'required|file:pdf,word',
            'quantity' => 'required|integer|min:1',
            'confirm' => 'required'
        ]);
        
        if($request->file('approval_file')){
            $validatedData['approval_file'] = $request->file('approval_file')->store('files');
        }
        $pet = Pet::find($id);
        $validatedData['pet_id'] = $pet->id;
        $validatedData['category_id'] = $pet->category->id;
        $validatedData['user_id'] = Auth()->user()->id;
        Adoption::create($validatedData);

        return redirect('/profile')->with('success', 'adoption Succesfully');
    }
    
    public function approve(Request $request,$id)
    {
        $adoption = Adoption::findOrFail($id);
        $pet = Pet::findOrFail($adoption->pet_id); 
        $pet->decrement('quantity', $adoption->quantity); // mengurangi quantity pada tabel pet
        if($pet->quantity == 0){
            $pet->status = 'Unavailable';
            $pet->save();
        }
 
        $adoption->approve();
        $adoption->code = rand(5,99999); // generate kode unik
        $adoption->save();
        $notification = new Notification([
            'user_id' => $adoption->user_id,
            'notifiable_type' => Adoption::class,
            'type' => 'Adoption Approved',
            'notifiable_id' => $adoption->id,
            'data' => 'Congratulations Your Adoption is Approved, Please Do The Next Step',
        ]);
        $notification->save();
        
        return redirect()->back()->with('success', 'adoption request approved!');
    }
    public function decline($id)
    {
        $adoption = Adoption::findOrFail($id);
        $adoption->decline();

        $notification = new Notification([
            'user_id' => $adoption->user_id,
            'notifiable_type' => Adoption::class,
            'type' => 'Adoption Declined',
            'notifiable_id' => $adoption->id,
            'data' => 'Sorry Your Adoption is Declined, Try It Next Time',
        ]);
        $notification->save();
    
        return redirect()->back()->with('success', 'adoption request declined!');
    }


    public function update(Request $request,$id)
    {
        $adoption = Adoption::findOrFail($id);


        $rules = [
            'approval_file' => 'required|file:pdf,word',
        ];

    $validatedData = $request->validate($rules);
    if($request->file('approval_file')){
        $validatedData['approval_file'] = $request->file('approval_file')->store('files');
    }

    $validatedData['user_id'] = Auth()->user()->id;
    Adoption::where('id', $adoption->id)
    ->update($validatedData);
    $adoption->status = 'Inprogress'; // generate kode unik
        $adoption->save();
    return back()->with('success', 'file has been Submited!');
    }

    public function destroy($id)    
    {
        $adoption = Adoption::find($id);
        $adoption->delete($adoption);
        return back()->with('success', 'adoption Berhasil Dihapus');
    } 
}


