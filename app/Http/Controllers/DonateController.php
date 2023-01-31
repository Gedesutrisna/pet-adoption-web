<?php

namespace App\Http\Controllers;

use Money\Money;
use Midtrans\Snap;
use App\Models\Pet;
use Money\Currency;
use Midtrans\Config;
use App\Models\Donate;
use App\Models\Shelter;
use App\Models\Adoption;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Client\Events\RequestSending;

class DonateController extends Controller
{
    public function index()
    {
        return view('donates.index',[
            'donates' => Donate::where('user_id', Auth()->user())->get(),
            'mainCampaigns' => Campaign::latest()->take(1)->get(),
            'submainCampaigns' => Campaign::latest()->take(5)->get()
        ]);
    }
    public function transaction(Donate $donate,$id)
    {
        $donate = Donate::find($id);
                // Set your Merchant Server Key
\Midtrans\Config::$serverKey = config('app.server_key');
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;
 
$params = array(
    'transaction_details' => array(
        'order_id' => $donate->id,
        'gross_amount' => $donate->amount,
    ),
    'items_details' => array(
        'campaign_id' => $donate->campaign_id,
        'code' => $donate->code, 
    ),
    'customer_details' => array(
        'name' => Auth()->user()->name,
        'email' => Auth()->user()->email,
        'phone' => Auth()->user()->phone,
    ),
);
$snapToken = \Midtrans\Snap::getSnapToken($params);
return view('profile.donate', compact( 'snapToken', 'donate'))->with('success', 'Donate Succesfully');
}

    public function callbackCampaign(Request $request)
    {
        $serverKey = config('app.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $donate = Donate::find($request->order_id);
                $donate->update(['status' => 'paid']);
            }
        }
    }

    public function dataDonate()
    {
        $donates = Donate::all();
      
    
        return view('admin.donates.index', compact('donates',),[
            
            'donates' => Donate::latest()->filter(request(['search']))->get(),
        ]);
    } 
    public function data()
    {
        $pets = Pet::all();
        $campaigns = Campaign::all();
        $shelters = Shelter::all();
        $adoptions = Adoption::all();
        $donates = Donate::all();

        return view('admin.index', compact('donates', 'pets','campaigns','shelters','adoptions'));

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
            'code' => 'nullable',
            'campaign_id' => 'nullable',
            'amount' => 'required|numeric|min:50000',
            'comment' => 'nullable',            
        ]);

        //validasi donasi target pada campaign
        if($request->campaign_id){
            $campaign = Campaign::find($request->campaign_id);
            if($validatedData['amount'] >= $campaign->donation_target){
                return redirect()->back()->with(['error' => 'Jumlah donasi melebihi target donasi campaign']);
            }
        }

        $validatedData['user_id'] = Auth()->user()->id;
       $donate = Donate::create($validatedData);


// Set your Merchant Server Key
\Midtrans\Config::$serverKey = config('app.server_key');
// Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
\Midtrans\Config::$isProduction = false;
// Set sanitization on (default)
\Midtrans\Config::$isSanitized = true;
// Set 3DS transaction for credit card to true
\Midtrans\Config::$is3ds = true;
 
$params = array(
    'transaction_details' => array(
        'order_id' => $donate->id,
        'gross_amount' => $donate->amount,
    ),

    'items_details' => array(
        'campaign_id' => $donate->campaign_id,
        'code' => $donate->code, 

    ),
    
    'customer_details' => array(
        'name' => Auth::user()->name,
        'email' => Auth::user()->email,
        'phone' => Auth::user()->phone,
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('profile.donate', compact('snapToken', 'donate'))->with('success', 'Donate Succesfully');
    }


    public function destroy($id)    
    {
        $donate = Donate::find($id);
        $donate->delete($donate);
        return back()->with('success', 'donate Berhasil Dihapus');
    } 


}
