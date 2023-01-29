<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Models\Shelter;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class ShelterController extends Controller
{
    public function index()
    {
        return view('shelters.index',[
            'shelters' => Shelter::where('user_id', Auth()->user())->get(),
            'categories' => Category::all()
        ]);
    }
    public function dataShelter(Request $request)
    {
        return view('admin.shelters.index',[
            "shelters" => Shelter::latest()->filter(request(['search' , 'category']))->paginate(7)->withQueryString(),
            'categories' => Category::all()
        ]);       
 
    }

    public function show(Shelter $shelter, $id)
    {  
        $shelter = Shelter::find($id);
        $user = User::find($id);
        return view('admin.shelters.show',[
            'shelter' => $shelter,
            'user' => $user
        ]);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'category_id' => 'required',
            'image' => 'required|file',
            'file' => 'required|file:pdf,word',
            'reason' => 'nullable',
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('images');
        }
        if($request->file('file')){
            $validatedData['file'] = $request->file('file')->store('files');
        }

        $validatedData['user_id'] = Auth()->user()->id;

        Shelter::create($validatedData);

        return redirect('/profile')->with('success', 'Shelter Succesfully');
    }
    public function update(Request $request,$id)
    {
        $shelter = Shelter::findOrFail($id);


        $rules = [
            'approval_file' => 'required|file:pdf,word',
        ];

    $validatedData = $request->validate($rules);
    if($request->file('approval_file')){
        $validatedData['approval_file'] = $request->file('approval_file')->store('files');
    }

    $validatedData['user_id'] = Auth()->user()->id;
    Shelter::where('id', $shelter->id)
    ->update($validatedData);
    $shelter->code = rand(5,99999); // generate kode unik
    $shelter->status = 'approved'; // generate kode unik
        $shelter->save();
    return back()->with('success', 'file has been Submited!');
    }


    public function approve(Request $request,$id)
    {
        $shelter = Shelter::findOrFail($id);
        // $shelter->code = rand(5,99999); // generate kode unik
// mendapatkan path file
$filePath = public_path('storage/files/file.pdf');

// mengecek apakah file ada
if (File::exists($filePath)) {
    // mengambil file dan mengubahnya menjadi binary
    $file = File::get($filePath);
    $file = base64_encode($file);
    $filePath = 'storage/files/file.pdf';
    $shelter->approval_file = $filePath;    
    }
        $shelter->save();
        $shelter->approve();
        return redirect()->back()->with('succes', 'shelter request approved!');
    }
    public function decline($id)
    {
        $shelter = Shelter::findOrFail($id);
        $shelter->decline();
        return redirect()->back()->with('succes', 'shelter request declined!');
    }
    public function destroy($id)    
    {
        $shelter = Shelter::find($id);
        $shelter->delete($shelter);
        return back()->with('success', 'shelter Berhasil Dihapus');
    } 


}

