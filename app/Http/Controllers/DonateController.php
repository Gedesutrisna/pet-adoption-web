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
    public function index()
    {
        
        return view('donates.index',[
            'campaigndonate' => CampaignDonate::all(),
            'donateshelter' => DonateShelter::all(),
            'mainCampaigns' => Campaign::latest()->take(1)->get(),
            'submainCampaigns' => Campaign::latest()->take(5)->get()

        ]);
    }
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
                    $donate->update(['status' => 'paid']);
                    if ($donate->adoption->status == 'approved') {
                        $donate->adoption->update(['status' => 'completed']);
                    }
                } elseif (!empty($donate = CampaignDonate::find($request->order_id))) {
                    $donate->update(['status' => 'paid']);
                } elseif (!empty($donate = DonateShelter::find($request->order_id))) {
                    $donate->update(['status' => 'paid']);
                    if ($donate->shelter->status == 'approved') {
                        $donate->shelter->update(['status' => 'completed']);
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

            $campaignDonate = CampaignDonate::where('status', 'paid')->sum('amount');
            $adoptionDonate = AdoptionDonate::where('status', 'paid')->sum('amount');
            $donateShelter = DonateShelter::where('status', 'paid')->sum('amount');

        return view('admin.index', compact( 'pets','campaignDonate','adoptionDonate','donateShelter','campaigns','shelters','adoptions',));

    } 

    public function show($type, $id)
    {
        if ($type === 'donateshelter') {
            $instance = DonateShelter::find($id);
        } else if ($type === 'adoptiondonate') {
            $instance = AdoptionDonate::find($id);
        } else if ($type === 'campaigndonate') {
            $instance = CampaignDonate::find($id);
        }
        
        return view('admin.donates.show', [
            'donate' => $instance
        ]);
    }
    

    public function store(Request $request)
    {

        $validatedData = $request->validate([
            'code' => 'nullable',
            'campaign_id' => 'nullable',
            'adoption_id' => 'nullable',
            'shelter_id' => 'nullable',
            'amount' => 'required|numeric|min:50000',
            'comment' => 'nullable',            
        ]);

        $validatedData['user_id'] = Auth()->user()->id;
    
        if ($request->campaign_id) {
            $campaign = Campaign::find($request->campaign_id);
            if ($validatedData['amount'] >= $campaign->donation_target) {
                return redirect()->back()->with(['error' => 'Jumlah donasi melebihi target donasi campaign']);
            }
            $donate = new CampaignDonate();

        } else if ($request->adoption_id) {
            $adoption = Adoption::find($request->adoption_id);
            $validatedData['adoption_id'] = $adoption->id;
            $donate = new AdoptionDonate();

        } else if ($request->shelter_id) {
            $shelter = Shelter::find($request->shelter_id);
            $validatedData['shelter_id'] = $shelter->id;
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


    // public function destroy($id)    
    // {
    //     $donate = Donate::find($id);
    //     $donate->delete($donate);
    //     return back()->with('success', 'donate Berhasil Dihapus');
    // } 


}
