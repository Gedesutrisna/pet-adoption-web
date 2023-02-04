<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use App\Models\Campaign;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class CampaignController extends Controller
{
    public function index()
    {
        return view('admin.campaigns.index',[
            'campaigns' =>  Campaign::latest()->filter(request(['search', 'category']))->paginate(7)->withQueryString(),
            'categories' => Category::all()
        ]);
    }

    public function campaignAll(){
        $categories = Category::all();
        return view('campaigns.index', compact('categories'), [
            "campaigns" => Campaign::latest()->Paginate(4)->withQueryString()
        ]);
    }
    public function campaign(Campaign $campaign){
        return view('campaigns.show', [
            "campaign" => $campaign
        ]);
    }


    public function create()
    {
        return view('admin.campaigns.create',[
            'categories' => Category::all()
        ]);
    }

    public function store(Request $request)
    {         

        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'body' => 'required',
            'category_id' => 'required',
            'image' => 'image|file',
            'donation_target' => 'required',
            'date_target' => 'required',
        ]);

        
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('images');
        }
        
        $validatedData['date_target'] = date('Y-m-d', strtotime($validatedData['date_target']));
        $validatedData['admin_id'] = Auth::guard('admin')->user()->id;
        $validatedData['short_body'] = Str::limit(strip_tags ($request->body), 50);
        Campaign::create($validatedData);
        return redirect('/dashboard/campaigns')->with('success', 'New campaign Has Been Added!');
    }


    public function show(Campaign $campaign)
    {
        return view('admin.campaigns.show',[
            'campaign' => $campaign
        ]);
    }


    public function edit(Campaign $campaign)
    {
        return view('admin.campaigns.edit',[
            'campaign' => $campaign,
            'categories' => Category::all()
        ]); 
    }

    public function update(Request $request, Campaign $campaign)
    {
            $rules = [
                'title' => 'max:255',
                'body' => 'required',
                'category_id' => 'required',
                'image' => 'image|file',
                'donation_target' => 'required',
                'date_target' => 'required',
        ];

        if($request->slug  != $campaign->slug){
            $rules['slug'] = 'required|unique:campaigns';

        }
        $validatedData = $request->validate($rules);

  
        if($request->file('image')){
            $validatedData['image'] = $request->file('image')->store('images');
            if($campaign->image){
                Storage::delete($campaign->image);
            }
        }

        $validatedData['admin_id'] = Auth::guard('admin')->user()->id;
        $validatedData['short_body'] = Str::limit(strip_tags ($request->body), 200);

        Campaign::where('id', $campaign->id)
        ->update($validatedData);

        return redirect('/dashboard/campaigns')->with('success', 'Campaign Has Been Updated!');
    }


    public function destroy(Campaign $campaign)
    {
        if($campaign->image){
            Storage::delete($campaign->image);
}

        Campaign::destroy($campaign->id);
        return back()->with('success', 'Campaign Has been deleted !');
    }
    public function checkSlug(Request $request){
        $slug = SlugService::createSlug(Campaign::class, 'slug', $request->title);
        return response()->json(['slug' => $slug]);
    }
}
