<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactController extends Controller
{

    public function store(Request $request)
    {

        $validatedData = $request->validate([

            'message' => 'required',
        ]);

        Contact::create($validatedData);

        return back()->with('success', 'Contact Succesfully');
    

    }

}
