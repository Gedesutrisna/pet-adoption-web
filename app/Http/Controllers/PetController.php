<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Admin;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Tests\Models\Post;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PetController extends Controller
{ 
    public function index(Request $request)
    {
        return view('admin.pets.index',[
            'pets' =>  Pet::latest()->filter(request(['search', 'category']))->get(),
            'categories' => Category::all(),
        ]);
    }

    public function petAll(){
        $categories = Category::all();
        return view('pets.index', compact('categories'), [
            "pets" => Pet::latest()->filter(request(['search' , 'category']))->paginate(6)->withQueryString(),
        ]);
    }
    public function pet(Pet $pet){
        return view('pets.show', [
            "pet" => $pet
        ]);
    }

    public function create()
    {
        return view('admin.pets.create',[
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {         

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'category_id' => 'required',
            'image' => 'required|image|file',
            'quantity' => 'required|integer|min:1'
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('images');
        }

        $validatedData['admin_id'] = Auth::guard('admin')->user()->id;
        $validatedData['short_description'] = Str::limit(strip_tags ($request->description), 50);

        Pet::create($validatedData);

        return redirect('/dashboard/pets')->with('success', 'New pets Has Been Added!');
    }


    public function show(Pet $pet)
    {
        return view('admin.pets.show',[
            'pet' => $pet
        ]); 
    }


    public function edit(Pet $pet)
    {
        return view('admin.pets.edit',[
            'pet' => $pet,
            'categories' => Category::all()
        ]); 
    }

    public function update(Request $request, Pet $pet)
    {
            $rules = [
                'name' => 'required|max:255',
                'description' => 'required',
                'category_id' => 'required',
                'image' => 'image|file',
                'quantity' => 'required|integer|min:1'
            ];

        if($request->slug  != $pet->slug){
            $rules['slug'] = 'required|unique:pets';

        }
        $validatedData = $request->validate($rules);
  
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('images');
            if($pet->image){
                Storage::delete($pet->image);
            }
        }
        $validatedData['admin_id'] = Auth::guard('admin')->user()->id;
        $validatedData['short_description'] = Str::limit(strip_tags ($request->description), 50);

        Pet::where('id', $pet->id)
        ->update($validatedData);

        return redirect('/dashboard/pets')->with('success', 'pet Has Been Updated!');
    }


    public function destroy(Pet $pet)
    {
        if($pet->image){
            Storage::delete($pet->image);
}

        Pet::destroy($pet->id);
        return back()->with('success', 'pet Has been deleted !');
    }
    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Pet::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
