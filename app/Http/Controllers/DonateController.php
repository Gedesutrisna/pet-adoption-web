<?php

namespace App\Http\Controllers;

use Money\Money;
use Midtrans\Snap;
use App\Models\Pet;
use Money\Currency;
use Midtrans\Config;
use App\Models\Shelter;
use App\Models\Adoption;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Models\DonateShelter;
use App\Models\AdoptionDonate;
use App\Models\CampaignDonate;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Client\Events\RequestSending;

class DonateController extends Controller
{

    public function transaction(AdoptionDonate $adoptionDonate, CampaignDonate $campaignDonate, DonateShelter $donateShelter, $id, $type)
    {
        // Set your Merchant Server Key
        \Midtrans\Config::$serverKey = config('app.server_key');
        // Set to Development/Sandbox Environment (default). Set to true for Production Environment (accept real transaction).
        \Midtrans\Config::$isProduction = false;
        // Set sanitization on (default)
        \Midtrans\Config::$isSanitized = true;
        // Set 3DS transaction for credit card to true
        \Midtrans\Config::$is3ds = true;
     
        $donate = null;
        if ($type == 'adoption') {
            $donate = $adoptionDonate->find($id);
        } elseif ($type == 'campaign') {
            $donate = $campaignDonate->find($id);
        } elseif ($type == 'shelter') {
            $donate = $donateShelter->find($id);
        }
     
        if ($donate) {
            $params = array(
                'transaction_details' => array(
                    'order_id' => $donate->id,
                    'gross_amount' => $donate->amount,
                ),
    
                'items_details' => array(
                    'campaign_id' => $donate->campaign_id,
                    'adoption_id' => $donate->adoption_id,
                    'shelter_id' => $donate->shelter_id,
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
        } else {
            return redirect()->back()->with('error', 'Donate Not Found');
        }
    }
    public function callBack(Request $request)
    {
        $serverKey = config('app.server_key');
        $hashed = hash("sha512", $request->order_id . $request->status_code . $request->gross_amount . $serverKey);
        if ($hashed == $request->signature_key) {
            if ($request->transaction_status == 'capture') {
                if (!empty($donate = AdoptionDonate::find($request->order_id))) {
                    $donate->update(['status' => 'Paid']);
                    if ($donate->adoption->status == 'Approved') {
                        $donate->adoption->update(['status' => 'Completed']);
                    }
                } elseif (!empty($donate = CampaignDonate::find($request->order_id))) {
                    $donate->update(['status' => 'Paid']);
                } elseif (!empty($donate = DonateShelter::find($request->order_id))) {
                    $donate->update(['status' => 'Paid']);
                    if ($donate->shelter->status == 'Approved') {
                        $donate->shelter->update(['status' => 'Completed']);
                    }
                }
                
            }
        }
    }
    
    public function dataDonate(AdoptionDonate $adoptionDonate, CampaignDonate $campaignDonate, DonateShelter $donateShelter)
    {
        $adoptionDonates = AdoptionDonate::latest('adoption_donates.created_at')->filter(request(['search', 'category']))->paginate(7)->withQueryString();
        $campaignDonates = CampaignDonate::latest('campaign_donates.created_at')->filter(request(['search', 'category']))->paginate(7)->withQueryString();
        $donateShelters = DonateShelter::latest('donate_shelters.created_at')->filter(request(['search', 'category']))->paginate(7)->withQueryString();
        return view('admin.donates.index', compact('campaignDonates','adoptionDonates','donateShelters'),[
            
        ]);
    }
    public function data()
    {
        $pets = Pet::all();
        $campaigns = Campaign::all();
        $shelters = Shelter::all();
        $adoptions = Adoption::all();
            //chart

            $campaignDonate = CampaignDonate::where('status', 'Paid')->sum('amount');
            $adoptionDonate = AdoptionDonate::where('status', 'Paid')->sum('amount');
            $donateShelter = DonateShelter::where('status', 'Paid')->sum('amount');

        return view('admin.index', compact( 'pets','campaignDonate','adoptionDonate','donateShelter','campaigns','shelters','adoptions',));

    } 


    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'code' => 'nullable',
            'amount' => 'required|numeric|min:50000',
            'comment' => 'nullable',            
        ]);

        $validatedData['user_id'] = Auth()->user()->id;
        
        if ($request->campaign_id) {
            $campaign = Campaign::find($request->campaign_id);
            $validatedData['campaign_id'] = $campaign->id;
            if ($validatedData['amount'] >= $campaign->donation_target) {
                return redirect()->back()->with(['error' => 'Jumlah donasi melebihi target donasi campaign']);
            }
            $donate = new CampaignDonate();

        } else if ($request->adoption_id) {
            $adoption = Adoption::find($request->adoption_id);
            $validatedData['adoption_id'] = $adoption->id;
            $validatedData['code'] = $adoption->code;
            $donate = new AdoptionDonate();
            
        } else if ($request->shelter_id) {
            $shelter = Shelter::find($request->shelter_id);
            $validatedData['shelter_id'] = $shelter->id;
            $validatedData['code'] = $shelter->code;
            $donate = new DonateShelter();
        }
        
        $donate->fill($validatedData);
        $donate->save();

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
        'gross_amount' => $request->amount,
    ),

    'items_details' => array(
        'campaign_id' => $request->campaign_id,
        'adoption_id' => $request->adoption_id,
        'shelter_id' => $request->shelter_id,
        'code' => $request->code,
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


    public function destroyShelter($id)    
    {
        $donateShelter = DonateShelter::find($id);
        $donateShelter->delete($donateShelter);
        return back()->with('success', 'donate Berhasil Dihapus');
    } 
    public function destroyAdoption($id)    
    {
        $adoptionDonate = AdoptionDonate::find($id);
        $adoptionDonate->delete($adoptionDonate);
        return back()->with('success', 'donate Berhasil Dihapus');
    } 
    public function destroyCampaign($id)    
    {
        $campaignDonate = CampaignDonate::find($id);
        $campaignDonate->delete($campaignDonate);
        return back()->with('success', 'donate Berhasil Dihapus');
    } 


}
