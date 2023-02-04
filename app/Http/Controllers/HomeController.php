<?php

namespace App\Http\Controllers;

use App\Models\Shelter;
use App\Models\Adoption;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $adoptions = Adoption::all();
        $campaign = Campaign::all();
        $shelter = Shelter::all();
        return view('home');
    }
}
