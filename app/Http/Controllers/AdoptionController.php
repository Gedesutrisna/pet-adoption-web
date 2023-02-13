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
            
            'adoptions' =>  Adoption::with(['category'])->latest('adoptions.created_at')->filter(request(['search']))->paginate(7)->withQueryString(),
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

    public function store(Request $request)
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
        
        $pet = Pet::find($request->pet_id);
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


    // public function update(Request $request,$id)
    // {
    //     $adoption = Adoption::findOrFail($id);


    //     $rules = [
    //         'approval_file' => 'required|file:pdf,word',
    //     ];

    // $validatedData = $request->validate($rules);
    // if($request->file('approval_file')){
    //     $validatedData['approval_file'] = $request->file('approval_file')->store('files');
    // }

    // $validatedData['user_id'] = Auth()->user()->id;
    // Adoption::where('id', $adoption->id)
    // ->update($validatedData);
    // $adoption->status = 'Inprogress'; // generate kode unik
    //     $adoption->save();
    // return back()->with('success', 'file has been Submited!');
    // }

    public function destroy($id)    
    {
        $adoption = Adoption::find($id);
        $adoption->delete($adoption);
        return back()->with('success', 'adoption Berhasil Dihapus');
    } 


    public function search(Request $request)
    {
    if($request->ajax())
    {
    $output="";
            $adoptions = Adoption::with(['category'])->latest('adoptions.created_at')->filter(request(['search']))->paginate(7)->withQueryString();

if($adoptions)
    {
        foreach ($adoptions as $key => $adoption) {
            $output .= ' <tr class="adoption-row" data-status="'. $adoption->status .'">'.

            '<td>'.($key+1).'</td>'.
            '<td>'.$adoption->user->name.'</td>'.
            '<td>'.$adoption->user->email.'</td>'.
            '<td>'.$adoption->category->name.'</td>'.
            '<td>'.$adoption->pet->name.'</td>'.
            '<td>'.$adoption->quantity.'</td>'.
            '<td>'.$adoption->status.'</td>'.
            '<td>'
            .'<a href="/dashboard/adoption/'. $adoption->id.' " class="btn btn-primary rounded-0"><i class="bi bi-eye"></i></a>
            <div class="modal fade" id="exampleModal3" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header d-block">
                  <h5 class="modal-title" id="exampleModalLabel">Delete Adoption</h5>
                  <p class="text-muted">Are You Sure Delete This Submission ?</p>
                </div>
                <div class="modal-body d-flex justify-content-between">
                  <button type="button" class="btn btn-secondary rounded-0" data-bs-dismiss="modal"><i class="bi bi-x-circle"></i></button>
                  <form action="/dashboard/adoptions/'. $adoption->id .'" method="post">
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


