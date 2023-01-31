<?php

namespace App\Http\Controllers;

use Midtrans\Snap;
use Midtrans\Config;
use App\Models\Donate;
use App\Models\Shelter;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Models\DonateShelter;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DonateShelterController extends Controller
{
    public function transaction($id){
        $donateShelter = DonateShelter::find($id);
        
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
        'order_id' => $donateShelter->id,
        'gross_amount' => $donateShelter->amount,
    ),

    'items_details' => array(
        'shelter_id' => $donateShelter->shelter_id,
        'code' => $donateShelter->code,
    ),
    
    'customer_details' => array(
        'name' => Auth::user()->name,
        'email' => Auth::user()->email,
        'phone' => Auth::user()->phone,
    ),
);
$snapToken = \Midtrans\Snap::getSnapToken($params);
return view('donate-shelter', compact('snapToken', 'donateShelter'))->with('success', 'Donate Succesfully');


    }
    public function callbackShelter(Request $request)
    {
        $serverKey = config('app.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                $donateShelter = DonateShelter::find($request->order_id);
                    $donateShelter->update(['status' => 'paid']);
    
                    $shelter = Shelter::find($donateShelter->shelter_id);
                    $shelter->update(['status' => 'completed']);
                
            }
        }
    }
    

    public function store(Request $request)
    {         

        $validatedData = $request->validate([
            'code' => 'nullable',
            'shelter_id' => 'required',
            'amount' => 'required|numeric|min:50000',
            'comment' => 'nullable',            
        ]);

        $validatedData['user_id'] = Auth()->user()->id;
        $donateShelter = DonateShelter::create($validatedData);


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
        'order_id' => $donateShelter->id,
        'gross_amount' => $donateShelter->amount,
    ),

    'items_details' => array(
        'shelter_id' => $donateShelter->shelter_id,
        'code' => $donateShelter->code,
    ),
    
    'customer_details' => array(
        'name' => Auth::user()->name,
        'email' => Auth::user()->email,
        'phone' => Auth::user()->phone,
    ),
);

$snapToken = \Midtrans\Snap::getSnapToken($params);
return view('donate-shelter', compact('snapToken', 'donateShelter'))->with('success', 'Donate Succesfully');
    }
}
