<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CategoryController extends Controller
{
    public function index()
    {
        return view('admin.categories.index',[
            'categories' => Category::all(),
        ]);
    }

   
    public function create()
    {
        return view('admin.categories.create', [
            'categories' => Category::all(),
        ]);
    }

    
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $validatedData['admin_id'] = Auth::guard('admin')->user()->id;

        Category::create($validatedData);

        return redirect('/dashboard/categories')->with('success', 'New Category Has Been Added!');
    }

  
    public function show(Category $category)
    {
        //
    }

    
    public function edit(Category $category)
    {
        return view('admin.categories.edit',[
            'category' => $category ,
        ]);
    }
    public function update(Request $request, Category $category)
    {
        $rules = [
            'name' => 'required|max:255',
        ];

    if($request->slug  != $category->slug){
        $rules['slug'] = 'required|unique:categories';

    }

        $validatedData = $request->validate($rules);
        $validatedData['admin_id'] = Auth::guard('admin')->user()->id;

        Category::where('id', $category->id)->update($validatedData);

        return redirect('dashboard/categories')->with('success', 'Ctategory Has Been Updated !');

    }

   
    public function destroy(Category $category)
    {
        Category::destroy($category->id);
        return back()->with('success', 'Category Has Been Deleted');
    }

    
    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Category::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
   
}
