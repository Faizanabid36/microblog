<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function changeDP(Request $request)
    {
        User::updateOrCreate(['id' => auth()->id()], [
                'avatar' => storeFile($request->avatar, auth()->id())
            ]
        );
        return back()->withMesage('Picture changed successfully');
    }

    public function editProfile($user_id)
    {
        $user = User::whereId($user_id)->firstOrFail();

        return view('profile', compact('user'));
    }

    public function updateProfile(UpdateProfileRequest $request)
    {
        if (auth()->user()->email != encrypt_string($request->email) && !is_null(User::whereEmail(encrypt_string($request->email))->first()))
            return back()->withErrors(['Email has already been taken']);

        User::whereId(auth()->user()->id)->update([
                "name" => encrypt_string($request->name),
                "email" => encrypt_string($request->email)
            ]
        );
        return back()->withSuccess('Profile Updated');
    }
}
