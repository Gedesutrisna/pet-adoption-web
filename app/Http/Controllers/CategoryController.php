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
            'categories' => Category::latest()->filter(request(['search', 'category']))->paginate(7)->withQueryString(),
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

        return redirect('dashboard/categories')->with('success', 'Category Has Been Updated !');

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

    public function search(Request $request)
    {
    if($request->ajax())
    {
    $output="";
            $categories = Category::latest()->filter(request(['search']))->paginate(7)->withQueryString();

if($categories)
    {
        foreach ($categories as $key => $category) {
            $output .= '<tr>'.
            '<td>'.($key+1).'</td>'.
            '<td>'.$category->name.'</td>'.
            '<td>'
            .' <button type="button" class="btn btn-warning rounded-0" data-bs-toggle="modal" data-bs-target="#exampleModal2">
            <i class="bi bi-pen"></i>
            </button>
                    <!-- Modal -->
    <div class="modal fade" id="exampleModal2" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Create Category</h5>
          </div>
          <div class="modal-body">
            <form method="POST" action="/dashboard/categories/'. $category->slug .'">
              '. csrf_field() .'
              '. method_field('PUT') .'
              <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name"
                 autofocus value="'.old('name', $category->name) .'">
              </div>
              <div class="mb-3">
                <input type="hidden" class="form-control" id="slug" name="slug"
                 value="'. old('slug', $category->slug) .'">
              </div>
              <div class="button d-flex justify-content-between">
  
              <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
              <button type="submit" style="background-color: #193A6A; 
              color: white;
              padding: 8px 16px;
              border: none;
              font-size: 13px;
              cursor: pointer;">Update Category</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
            <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header d-block">
                  <h5 class="modal-title" id="exampleModalLabel">Delete Category</h5>
                  <p class="text-muted">Are You Sure Delete This Category ?</p>
                </div>
                <div class="modal-body d-flex justify-content-between">
                  <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
                  <form action="/dashboard/categories/'. $category->id .'" method="post">
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
