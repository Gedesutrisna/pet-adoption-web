<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Adoption;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;

class AdoptionController extends Controller
{
    public function dataAdoption()
    {
        return view('admin.adoptions.index',[
            'adoptions' =>  Adoption::latest()->filter(request(['search', 'category']))->paginate(7)->withQueryString(),
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
            'quantity' => 'required|integer|min:1',
            'confirm' => 'required'
        ]);
    
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
            $pet->status = 'unavailable';
            $pet->save();
        }
  // mendapatkan path file
$filePath = public_path('storage/files/file.pdf');

// mengecek apakah file ada
if (File::exists($filePath)) {
    // mengambil file dan mengubahnya menjadi binary
    $file = File::get($filePath);
    $file = base64_encode($file);
    $filePath = 'storage/files/file.pdf';
    $adoption->approval_file = $filePath;    
    }
        $adoption->save();
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
    $adoption->code = rand(5,99999); // generate kode unik
    $adoption->status = 'approved'; // generate kode unik
        $adoption->save();
    return back()->with('success', 'file has been Submited!');
    }

    public function destroy(Adoption $adoption,  Pet $pet)
    {

    }
}


