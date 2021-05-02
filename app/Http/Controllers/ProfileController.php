<?php

namespace App\Http\Controllers;

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
}
