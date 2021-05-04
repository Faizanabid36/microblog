<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // If no user exists or has entered incorrect password, we send it back with validation message
        if (is_null($user) || custom_hash($request->password) != $user->password)
            return back()->withErrors(['These Credentials do not match our records']);

        // The user with this email exists, now we need to verify password
        else {
            // When both the password and the email matches, we allow user to login and take him to home
            auth()->login($user);
            return redirect()->route('home');
        }
    }

    public function logout(Request $request)
    {
        // user is stored in session, so we flush it and the user is automicatically logged out
        \session()->flush();
        // Restricting user to access to private routes.
        Auth::logout();
        return back();
    }
}
