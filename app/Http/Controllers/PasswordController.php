<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class PasswordController extends Controller
{
    public function update(Request $request, User $user)
    {       
        $user = auth()->user();
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->with('toast_error', 'Current password is incorrect.');
        }
        
        
        $request->validate([
        'new_password' => 'required',
        'new_confirm_password' => 'same:new_password',
    ]);

    $user->password = Hash::make($request->new_password);

            return back()->with('toast_success', 'Password Change Successfully!');
   
    }

}

