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
            'pets' =>  Pet::with(['category'])->latest()->filter(request(['search', 'category']))->Paginate()->withQueryString(),
            'categories' => Category::all(),
        ]);
    }

    public function petAll(){
        $categories = Category::all();
        return view('pets.index', compact('categories'), [
            "pets" => Pet::with(['category'])->latest()->filter(request(['search' , 'category']))->paginate(8)->withQueryString(),
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

        return redirect('/dashboard/pets')->with('success', 'New Pets Has Been Added!');
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
                'quantity' => 'nullable|integer|min:1'
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

        return redirect('/dashboard/pets')->with('success', 'Pet Has Been Updated!');
    }


    public function destroy(Pet $pet)
    {
        if($pet->image){
            Storage::delete($pet->image);
}

        Pet::destroy($pet->id);
        return back()->with('success', 'Pet Has been Deleted !');
    }
    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Pet::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }

    public function search(Request $request)
    {
    if($request->ajax())
    {
    $output="";
            $pets = Pet::with(['category'])->latest()->filter(request(['search', 'category']))->Paginate(7)->withQueryString();
    if($pets)
    {
        foreach ($pets as $key => $pet) {
            $output .= '<tr>'.
            '<td>'.($key+1).'</td>'.
            '<td>'.$pet->name.'</td>'.
            '<td>'.$pet->category->name.'</td>'.
            '<td>'.$pet->quantity.'</td>'.
            '<td>'.$pet->status.'</td>'.
            '<td>'
            .'<a href="/dashboard/pets/'. $pet->slug.' " class="btn btn-primary rounded-0"><i class="bi bi-eye"></i></a>
            <a href="/dashboard/pets/'. $pet->slug.' /edit" class="btn btn-warning rounded-0"><i class="bi bi-pen"></i></a>
            <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header d-block">
                  <h5 class="modal-title" id="exampleModalLabel">Delete Pet</h5>
                  <p class="text-muted">Are You Sure Delete This Pet ?</p>
                </div>
                <div class="modal-body d-flex justify-content-between">
                  <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
                  <form action="/dashboard/pets/'. $pet->slug .'" method="post">
                  '. csrf_field() .'
                  '. method_field('DELETE') .'
                  <button type="submit" class="btn btn-danger rounded-0">
                    <i class="bi bi-trash"></i>
                  </button>
                  
                </form>
                
                </div>
              </div>
            </div>
          </div>
            <button type="button" class="btn btn-danger rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal3">
            <i class="bi bi-trash"></i>
            </button>'
        .'</td>'.
        
        
            '</tr>';
        }
        return Response($output);
        }
        
       }
    }
}
