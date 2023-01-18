<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Adoption;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdoptionController extends Controller
{
    public function dataAdoption()
    {
        $adoptions = Adoption::all();
        return view('admin.adoptions.index', compact('adoptions'),[
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
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'reason' => 'required',
            'ktp' => 'required|file',
            'quantity' => 'required|integer|min:1'
        ]);
    
        if($request->file('ktp')){
            $validatedData['ktp'] = $request->file('ktp')->store('ktps');
        }
    
        $pet = Pet::find($id);
        $validatedData['pet_id'] = $pet->id;
        $validatedData['category_id'] = $pet->category->id;
        $validatedData['user_id'] = Auth()->user()->id;
        Adoption::create($validatedData);
        return redirect('/profile')->with('success', 'adoption Succesfully');
    }
    
    public function approve($id)
    {
        $adoption = Adoption::findOrFail($id);
        $pet = Pet::findOrFail($adoption->pet_id); // mencari data pet yang digunakan pada form adoption
        $pet->decrement('quantity', $pet->quantity); // mengurangi quantity pada tabel pet
        if($pet->quantity == 0){
            $pet->status = 'unavailable';
            $pet->save();
        }
        $adoption->approve();
        return redirect()->back()->with('succes', 'adoption request approved!');
    }
    public function decline($id)
    {
        $adoption = Adoption::findOrFail($id);
        $adoption->decline();
        return redirect()->back()->with('succes', 'adoption request declined!');
    }



    public function edit(Adoption $adoption)
    {
        //
    }

    public function update(Request $request,)
    {

    }

    public function destroy(Adoption $adoption,  Pet $pet)
    {

    }
}


