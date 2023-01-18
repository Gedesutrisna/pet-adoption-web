<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Shelter;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

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
      
        $shelters = Shelter::where('status', 'pending')->get();
        $shelters = Shelter::all();
        $shelter = Shelter::all();

        if(request('category')){
            $category = Category::firstWhere('slug', request('category'));
        }


        return view('admin.shelters.index', compact('shelters','shelter'),[
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
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'category_id' => 'required',
            'image' => 'required|file',
            'ktp' => 'required|file',
            'file' => 'required|file:pdf,word',
            'reason' => 'nullable',
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('images');
        }
        if($request->file('ktp')){
            $validatedData['ktp'] = $request->file('ktp')->store('ktps');
        }
        if($request->file('file')){
            $validatedData['file'] = $request->file('file')->store('files');
        }

        $validatedData['user_id'] = Auth()->user()->id;

        Shelter::create($validatedData);

        return back()->with('success', 'Shelter Succesfully');
    }

    public function approve($id)
    {
        $shelter = Shelter::findOrFail($id);
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

