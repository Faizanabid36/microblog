<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        // Checks if the email or password field is not empty and email should be proper and valid means
        //  it should contain @ and . symbol
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        // Check if there is user in the database with the similar email.
        $user = User::where('email', encrypt_string($request->email))->first();
        // If no user exists, we send it back with validation message
        if (is_null($user))
            return back()->withErrors(['User does not exist with given email']);
        else {
            // The user with this email exists, now we need to verify password
            dd($user->password);
        }
    }
}
