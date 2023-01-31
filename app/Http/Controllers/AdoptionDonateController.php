<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Adoption;
use Illuminate\Http\Request;
use App\Models\AdoptionDonate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdoptionDonateController extends Controller
{

    public function transaction($id){
        $adoptionDonate = AdoptionDonate::find($id);
        
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
        'order_id' => $adoptionDonate->id,
        'gross_amount' => $adoptionDonate->amount,
    ),

    'items_details' => array(
        'adoption_id' => $adoptionDonate->adoption_id,
        'code' => $adoptionDonate->code,
    ),
    
    'customer_details' => array(
        'name' => Auth::user()->name,
        'email' => Auth::user()->email,
        'phone' => Auth::user()->phone,
    ),
);
$snapToken = \Midtrans\Snap::getSnapToken($params);
return view('adoption-Donate', compact('snapToken', 'adoptionDonate'))->with('success', 'Donate Succesfully');


    }

    public function callbackAdoption(Request $request)
    {
        $serverKey = config('app.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $adoptionDonate = AdoptionDonate::find($request->order_id);
                $adoptionDonate->update(['status' => 'paid']);

                $adoption = Adoption::find($adoptionDonate->adoption_id);
                $adoption->update(['status' => 'completed']);
            }
        }
    }
    public function store(Request $request)
    {         

        $validatedData = $request->validate([
            'code' => 'nullable',
            'adoption_id' => 'required',
            'amount' => 'required|numeric|min:50000',
            'comment' => 'nullable',            
        ]);

        $validatedData['user_id'] = Auth()->user()->id;
        $adoptionDonate = AdoptionDonate::create($validatedData);

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
        'order_id' => $adoptionDonate->id,
        'gross_amount' => $adoptionDonate->amount,
    ),

    'items_details' => array(
        'adoption_id' => $adoptionDonate->adoption_id,
        'code' => $adoptionDonate->code,
    ),
    
    'customer_details' => array(
        'name' => Auth::user()->name,
        'email' => Auth::user()->email,
        'phone' => Auth::user()->phone,
    ),
);
$snapToken = \Midtrans\Snap::getSnapToken($params);
        return view('adoption-Donate', compact('snapToken', 'adoptionDonate'))->with('success', 'Donate Succesfully');
    }
    
}
