<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class ProfileController extends Controller
{
    public function changeDP(Request $request)
    {
        User::updateOrCreate(
            [
                'id'=>auth()->id()
            ],
            [
                'avatar'=>storeFile($request->avatar,auth()->id())
            ]
            );
        return back();
    }
}
