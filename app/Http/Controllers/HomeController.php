<?php

namespace App\Http\Controllers;

use App\Post;
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

    public function timeline()
    {
        $posts=Post::whereUserId(Auth()->id())->orderBy('created_at', 'DESC')->get();
        return view('timeline',compact('posts'));
    }
}
