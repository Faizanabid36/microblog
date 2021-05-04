<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class RegistrationController extends Controller
{
    public function register(Request $request)
    {
        //Encrypt the email
        $request->merge(['email' => encrypt_string(strtolower($request->email))]);


        // Checks if the email or password field is not empty and email should be proper and valid means
        //  it should contain @ and . symbol
        // name should not be empty and should not be greater than 255 characters along with email
        // also check that emaIl should be uniqe, if another uses this email, display error message
        // password min length should be 8 and should match with confirmation password field
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|string|max:255|unique:users',
            'password' => 'required|string|min:8|confirmed'
        ]);

        $user = User::create([
            // remove all the white spaces from name file, encrypt it and store it in database
            'name' => encrypt_string(trim($request->name)),
            // convert email to lower case before storing in database, and store the encrypted email
            'email' => $request->email,
            // use the custom hash method to hash the password, see helpers.php
            'password' => custom_hash($request->password),
        ]);

        // automatically login the user
        auth()->login($user);

        return redirect()->route('home');
    }
}
