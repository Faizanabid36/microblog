<?php

namespace App\Http\Controllers;

use App\Post;
use App\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return string
     */
    public function index(Request $request)
    {
        $posts = Post::orderBy('created_at', 'DESC')->paginate(3);

        if ($request->ajax()) {
            return renderPosts($posts);
        }
        return view('home', compact('posts'));
    }

    public function timeline($id)
    {
        $user = User::whereId($id)->firstOrFail();
        $posts = Post::whereUserId($user->id)->orderBy('created_at', 'DESC')->get();
        return view('timeline', compact('posts', 'user'));
    }
}
