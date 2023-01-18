<?php

namespace App\Http\Controllers;

use Money\Money;
use Money\Currency;
use App\Models\Donate;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DonateController extends Controller
{
    public function index()
    {
        return view('donates.index',[
            'donates' => Donate::where('user_id', Auth()->user())->get(),
            'campaigns' => Campaign::latest()->take(1)->get()
        ]);
    }
    public function datadonate()
    {
        $donates = Donate::all();
        return view('admin.donates.index', compact('donates'));       
 
    }
    public function show(Donate $donate, $id)
    {
        $donate = Donate::find($id);
        return view('admin.donates.show',[
            'donate' => $donate
        ]);
    }

    public function store(Request $request)
    {         

        $validatedData = $request->validate([
            'name' => 'required|max:255',
            'adoption_id' => 'nullable',
            'campaign_id' => 'nullable',
            'shelter_id' => 'nullable',
            'email' => 'required|max:255',
            'amount' => 'required|numeric|min:50000',
            'comment' => 'nullable',
        ]);


        $validatedData['user_id'] = Auth()->user()->id;

        Donate::create($validatedData);

        return back()->with('success', 'Donate Succesfully');
    }


    public function destroy($id)    
    {
        $donate = Donate::find($id);
        $donate->delete($donate);
        return back()->with('success', 'donate Berhasil Dihapus');
    } 


}
