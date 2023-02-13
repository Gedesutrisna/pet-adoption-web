<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\User;
use App\Models\Shelter;
use App\Models\Category;
use Illuminate\Support\Str;
use App\Models\Notification;
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
            'shelters' =>  Shelter::with(['category'])->latest('shelters.created_at')->filter(request(['search']))->paginate(7)->withQueryString(),
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
            'image' => 'required|image:png,jpg,',
            'file' => 'required|file:pdf,word',
            'approval_file' => 'required|file:pdf,word',
            'reason' => 'nullable',
        ]);

        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('images');
        }
        if($request->file('file')){
            $validatedData['file'] = $request->file('file')->store('files');
        }
        if($request->file('approval_file')){
            $validatedData['approval_file'] = $request->file('approval_file')->store('files');
        }

        $validatedData['user_id'] = Auth()->user()->id;

        Shelter::create($validatedData);
        return redirect('/profile')->with('success', 'Shelter Succesfully');
    }
    

    public function approve(Request $request,$id)
    {
        $shelter = Shelter::findOrFail($id);
        $shelter->approve();
        $shelter->code = rand(5,99999); // generate kode unik
        $shelter->save();
        $notification = new Notification([
            'user_id' => $shelter->user_id,
            'notifiable_type' => Shelter::class,
            'type' => 'Shelter Approved',
            'notifiable_id' => $shelter->id,
            'data' => 'Congratulations Your Shelter is Approved, Please Do The Next Step',
        ]);
        $notification->save();
        return redirect()->back()->with('success', 'shelter request approved!');
    }
    public function decline($id)
    {
        $shelter = Shelter::findOrFail($id);
        $shelter->decline();
        $notification = new Notification([
            'user_id' => $shelter->user_id,
            'notifiable_type' => Shelter::class,
            'type' => 'Shelter Declined',
            'notifiable_id' => $shelter->id,
            'data' => 'Sorry Your Shelter is Declined, Try It Next Time',
        ]);
        $notification->save();

        return redirect()->back()->with('success', 'shelter request declined!');
    }


    public function destroy($id)    
    {
        $shelter = Shelter::find($id);
        $shelter->delete($shelter);
        return back()->with('success', 'shelter Berhasil Dihapus');
    } 

    public function search(Request $request)
    {
    if($request->ajax())
    {
    $output="";
            $shelters = Shelter::with(['category'])->latest('shelters.created_at')->filter(request(['search']))->paginate(7)->withQueryString();

if($shelters)
    {
        foreach ($shelters as $key => $shelter) {
            $output .= '<tr>'.
            '<td>'.($key+1).'</td>'.
            '<td>'.$shelter->user->name.'</td>'.
            '<td>'.$shelter->user->email.'</td>'.
            '<td>'.$shelter->category->name.'</td>'.
            '<td>'.$shelter->status.'</td>'.
            '<td>'
            .'<a href="/dashboard/shelter/'. $shelter->id.' " class="btn btn-primary rounded-0"><i class="bi bi-eye"></i></a>
            <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header d-block">
                  <h5 class="modal-title" id="exampleModalLabel">Delete Shelter</h5>
                  <p class="text-muted">Are You Sure Delete This Submission ?</p>
                </div>
                <div class="modal-body d-flex justify-content-between">
                  <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
                  <form action="/dashboard/shelters/'. $shelter->id .'" method="post">
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

