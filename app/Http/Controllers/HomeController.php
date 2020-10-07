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
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $posts = User::join('posts', 'users.id', '=', 'posts.uid')
            ->orderBy('posts.id', 'DESC')
            ->paginate(10);
        // dd($posts);
        return view('pages.home', compact('posts'));
    }
}