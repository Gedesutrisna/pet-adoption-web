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
            'main_campaigns' => Campaign::latest()->take(1)->get(),
            'submain_campaigns' => Campaign::latest()->take(5)->get()
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
        'code' => $donate->code, 
    ),
    'customer_details' => array(
        'name' => Auth()->user()->name,
        'email' => Auth()->user()->email,
        'phone' => Auth()->user()->phone,
    ),
);
$snapToken = \Midtrans\Snap::getSnapToken($params);
return view('donate', compact( 'snapToken', 'donate'))->with('success', 'Donate Succesfully');
}

    public function callBack(Request $request)
    {
        $serverKey = config('app.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $donate = Donate::find($request->order_id);
                $donate->update(['status' => 'paid']);
                if($donate->adoption_id){
                    $adoption = Adoption::where('code', $request->adoption_id)->first();
                    if($adoption && $adoption->status !== 'completed'){
                        $adoption->update(['status' => 'completed']);
                    }
                }
            }
        }
    }

    public function datadonate()
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
        // $total_amount = Donate::sum('amount');
        // $total_amount_others = Donate::whereNull('adoption_id')->whereNull('shelter_id')->whereNull('campaign_id')->sum('amount');
        // $total_amount_campaign = Donate::whereNotNull('campaign_id')->sum('amount');
        // $total_amount_adoption = Donate::whereNotNull('adoption_id')->sum('amount');
        // $total_amount_shelter = Donate::whereNotNull('shelter_id')->sum('amount');

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
        //status
        // if($request->adoption_id){
        //     $adoption = Adoption::where('code', $request->adoption_id)->first();
        //     if($adoption && $adoption->status !== 'completed'){
        //         $validatedData['adoption_id'] = $adoption->id;
        //         $adoption->status = 'completed';
        //         $adoption->save();
        //     }
        // }
    
        // if($request->shelter_id){
        //     $shelter = Shelter::where('code', $request->shelter_id)->first();
        //     if($shelter && $shelter->status !== 'completed'){
        //         $validatedData['shelter_id'] = $shelter->id;
        //         $shelter->status = 'completed';
        //         $shelter->save();
        //     }
        // }

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

    // 'items_details' => array(
    //     'campaign_id' => $donate->campaign_id,
    //     'shelter_id' => $donate->shelter_id,
    //     'adoption_id' => $donate->adoption_id,
    // ),
    
    'customer_details' => array(
        'name' => Auth::user()->name,
        'email' => Auth::user()->email,
        'phone' => Auth::user()->phone,
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('donate', compact('snapToken', 'donate'))->with('success', 'Donate Succesfully');
    }


    public function destroy($id)    
    {
        $donate = Donate::find($id);
        $donate->delete($donate);
        return back()->with('success', 'donate Berhasil Dihapus');
    } 


}
