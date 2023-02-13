<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Shelter;
use App\Models\Adoption;
use App\Models\Campaign;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $pets = Pet::all();
        $petsByDog = $pets->where('category_id', '1')->sortByDesc('created_at')->take(3);
        $petsByCat = $pets->where('category_id', '2')->sortByDesc('created_at')->take(3);
        return view('home',compact('pets','petsByDog','petsByCat'));
    }
}
