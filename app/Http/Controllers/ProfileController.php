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
    public function editProfile($user_id)
    {
        $user=User::whereId($user_id)->first();
        
        return view('profile',compact('user'));
    }
    public function updateProfile(Request $request)
    {
        $user=User::updateOrCreate(
            [
                'id'=>$request->user_id
            ],
            [
                "name"=>encrypt_string($request->name),
                "email"=>encrypt_string($request->email)
            ]
            
        );
        return back();
    }
}
