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

        // If no user exists, we send it back with validation message
        if (is_null($user))
            return back()->withErrors(['User does not exist with given email']);

        else {
            // The user with this email exists, now we need to verify password
            // check it using our own made hash function
            if (custom_hash($request->password) != $user->password) {

                // send it back with validation message because the passwords didn't match
                return back()->withErrors(['Incorrect Password entered']);
            } else {
                // When both the password and the email matches, we allow user to login and take him to home
                if (!Auth::attempt($request->only(['email', 'password']))) {
                    return redirect()->route('home');
                }
            }
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
