<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePost;
use Illuminate\Http\Request;
use App\User;
use App\Post;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $posts = Post::orderBy('created_at', 'DESC')->simplePaginate(10);

        return view('home.index', [
            'posts' => $posts
        ]);
    }

    public function showLogin(Request $request)
    {
        return view('home.login');
    }

    public function showLogout(Request $request)
    {
        return view('home.logout');
    }

    public function showPostForm()
    {
        return view('home.add');
    }

    public function create(CreatePost $request)
    {
        $post          = new Post;
        $post->image   = base64_encode(file_get_contents($request->image->getRealPath()));
        $post->caption = $request->caption;
        Auth::user()->posts()->save($post);

        return redirect()->route('home');
    }

    public function destroy(Request $request)
    {
        Post::find($request->post_id)->delete();

        return redirect()->route('home');
    }
}
