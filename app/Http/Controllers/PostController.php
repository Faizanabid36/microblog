<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePostRequest;
use App\Post;

class PostController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePostRequest $request)
    {
//        encrypts the post data and save it in database.
        Post::create([
                "user_id" => auth()->id(),
                "post_body" => encrypt_string($request->post_body)
            ]
        );
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy( $id)
    {
        Post::whereId($id)->delete();
        return back();
    }
}
